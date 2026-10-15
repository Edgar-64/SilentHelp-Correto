(function () {
    "use strict";

    const api = (window.SilentHelpAPI && typeof window.SilentHelpAPI.post === "function")
        ? window.SilentHelpAPI
        : {
            post: async (action, data = {}) => {
                const response = await fetch("../api.php?action=" + encodeURIComponent(action), {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    credentials: "same-origin",
                    body: JSON.stringify(data)
                });
                return response.json();
            }
        };

    const escapeHTML = value => String(value ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

    const initials = name => String(name || "")
        .trim()
        .split(/\s+/)
        .slice(0, 2)
        .map(part => part[0] || "")
        .join("")
        .toUpperCase();

    const formatDate = value => {
        if (!value) return "—";
        const date = new Date(String(value).replace(" ", "T"));
        if (Number.isNaN(date.getTime())) return escapeHTML(value);
        return date.toLocaleDateString("pt-BR");
    };

    const formatDateTime = value => {
        if (!value) return "—";
        const date = new Date(String(value).replace(" ", "T"));
        if (Number.isNaN(date.getTime())) return escapeHTML(value);
        return date.toLocaleDateString("pt-BR") + " às " +
            date.toLocaleTimeString("pt-BR", { hour: "2-digit", minute: "2-digit" });
    };

    const statusLabel = status => {
        const s = String(status || "").toLowerCase();
        if (["active", "open", "online"].includes(s)) return "Ativo";
        if (["resolved", "offline"].includes(s)) return s === "resolved" ? "Resolvido" : "Offline";
        if (["cancelled", "canceled"].includes(s)) return "Cancelado";
        if (["inactive", "inativo", "desativada", "desativado"].includes(s)) return "Desativada";
        return status || "—";
    };

    const userActive = item => {
        const s = String(item.status || "").toLowerCase();
        return !["inactive", "inativo", "disabled", "desativada", "desativado"].includes(s);
    };

    async function loadStats() {
        const response = await api.post("admin_stats");
        if (!response.ok) return null;

        const stats = response.stats || {};
        const set = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = value ?? 0;
        };

        set("usersCount", stats.usuarios);
        set("devicesCount", stats.dispositivos);
        set("resolvedCount", stats.resolvidos);
        set("activeCount", stats.ativos);

        return stats;
    }

    async function loadAlerts() {
        const response = await api.post("admin_alerts");
        if (!response || !response.ok) {
            throw new Error(response?.message || "Não foi possível carregar os alertas do banco de dados.");
        }
        return Array.isArray(response.items) ? response.items : [];
    }

    async function loadUsers() {
        const response = await api.post("admin_users");
        if (!response.ok) return [];
        return Array.isArray(response.items) ? response.items : [];
    }

    async function loadDevices() {
        const response = await api.post("admin_devices");
        if (!response.ok) return [];
        return Array.isArray(response.items) ? response.items : [];
    }

    async function loadContacts() {
        const response = await api.post("admin_contacts");
        if (!response.ok) return [];
        return Array.isArray(response.items) ? response.items : [];
    }

    function renderDashboardAlerts(items) {
        const recentList = document.querySelector(".recent-list");
        const count = (predicate) => items.filter(predicate).length;
        const normalizedType = item => String(item.tipo || "").trim().toLowerCase();
        const normalizedStatus = item => String(item.status || "").trim().toLowerCase();

        const emergency = count(item => ["emergency", "emergencia"].includes(normalizedType(item)));
        const tests = count(item => ["test", "teste", "safety_test"].includes(normalizedType(item)));
        const resolved = count(item => ["resolved", "resolvido", "resolvida", "closed", "concluido", "concluído"].includes(normalizedStatus(item)));
        const active = count(item => ["open", "active", "ativo", "ativa", "em_atendimento"].includes(normalizedStatus(item)));
        const cancelled = count(item => ["cancelled", "canceled", "cancelado", "cancelada"].includes(normalizedStatus(item)));

        const setText = (id, value) => {
            const el = document.getElementById(id);
            if (el) el.textContent = String(value);
        };
        setText("summaryEmergency", emergency);
        setText("summaryResolved", resolved);
        setText("summaryActive", active);
        setText("summaryTests", tests);
        setText("summaryCancelled", cancelled);
        setText("emergencyCount", emergency);

        const badge = document.getElementById("sidebarAlertCount");
        if (badge) {
            badge.textContent = String(active);
            badge.hidden = active === 0;
        }

        if (!recentList) return;
        const recent = items.slice(0, 5);
        recentList.innerHTML = recent.length
            ? recent.map(item => {
                const status = normalizedStatus(item);
                const type = normalizedType(item);
                const isResolved = ["resolved", "resolvido", "resolvida", "closed", "concluido", "concluído"].includes(status);
                const isActive = ["open", "active", "ativo", "ativa", "em_atendimento"].includes(status);
                const statusClass = isActive ? "active" : isResolved ? "resolved" : "cancelled";
                const iconClass = ["emergency", "emergencia"].includes(type) ? "emergency" : "test";
                const title = item.titulo || item.descricao || "Alerta";
                const date = formatDateTime(item.data_inicio);
                const user = item.usuario || "Usuário não identificado";
                const location = item.latitude != null && item.longitude != null
                    ? `${item.latitude}, ${item.longitude}`
                    : "Localização não informada";
                const details = [title, date, user, location, statusLabel(item.status)];
                return `
                    <div class="recent-alert" role="button" tabindex="0"
                         data-alert-details="${escapeHTML(JSON.stringify(details))}">
                        <div class="recent-icon ${iconClass}">
                            <span style="font-size:18px">!</span>
                        </div>
                        <div class="recent-info">
                            <strong>${escapeHTML(title)}</strong>
                            <span>${escapeHTML(user)} • ${escapeHTML(date)}</span>
                        </div>
                        <span class="recent-status ${statusClass}">${escapeHTML(statusLabel(item.status))}</span>
                    </div>`;
            }).join("")
            : `<div style="padding:25px;text-align:center;color:var(--cinza)">Nenhum alerta registrado no banco de dados.</div>`;

        recentList.querySelectorAll("[data-alert-details]").forEach(el => {
            const open = () => {
                try {
                    const [title, date, user, location, status] = JSON.parse(el.dataset.alertDetails);
                    if (typeof window.openAlert === "function") window.openAlert(title, date, user, location, status);
                } catch (error) {
                    console.error("Não foi possível abrir os detalhes do alerta.", error);
                }
            };
            el.addEventListener("click", open);
            el.addEventListener("keydown", event => {
                if (event.key === "Enter" || event.key === " ") {
                    event.preventDefault();
                    open();
                }
            });
        });
    }

    window.showAlertNotification = async function () {
        try {
            const items = await loadAlerts();
            const active = items.filter(item =>
                ["open", "active", "ativo", "ativa", "em_atendimento"].includes(String(item.status || "").toLowerCase())
            ).length;
            if (typeof window.showToast === "function") {
                window.showToast(active ? `Existem ${active} alerta(s) ativo(s) registrado(s) no banco.` : "Não há alertas ativos registrados no banco.");
            }
        } catch (error) {
            if (typeof window.showToast === "function") window.showToast(error.message);
            else console.error(error);
        }
    };
    function renderUsers(items) {
        const table = document.getElementById("userTable");
        if (!table) return;

        table.innerHTML = items.map(item => {
            const active = userActive(item);
            const status = active ? "active" : "inactive";
            return `
                <tr data-status="${status}" data-name="${escapeHTML(item.nome)}" data-email="${escapeHTML(item.email)}">
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">${escapeHTML(initials(item.nome))}</div>
                            <div>
                                <div class="user-name">${escapeHTML(item.nome)}</div>
                                <div class="user-id">ID #${escapeHTML(item.id)}</div>
                            </div>
                        </div>
                    </td>
                    <td><span class="email">${escapeHTML(item.email)}</span></td>
                    <td>
                        <span class="status ${status}">
                            <span class="status-dot"></span>
                            ${active ? "Ativa" : "Desativada"}
                        </span>
                    </td>
                    <td><div class="device none">—</div></td>
                    <td><span class="date">${formatDate(item.criado_em)}</span></td>
                    <td>
                        <div class="actions">
                            <button class="action-button" onclick='viewUser(${JSON.stringify(item.nome)},${JSON.stringify(initials(item.nome))},${JSON.stringify(item.email)},${JSON.stringify(active ? "Ativa" : "Desativada")},"Nenhum dispositivo",${JSON.stringify(formatDate(item.criado_em))})' title="Visualizar">
                                Ver
                            </button>
                            <button class="action-button ${active ? "toggle-on" : "toggle-off"}" onclick="toggleUser(this)" title="${active ? "Desativar" : "Ativar"} conta">
                                ${active ? "Desativar" : "Ativar"}
                            </button>
                        </div>
                    </td>
                </tr>`;
        }).join("");

        document.getElementById("userCount")?.replaceChildren(document.createTextNode(String(items.length)));
    }

    function renderAlerts(items) {
        const table = document.getElementById("alertTable");
        if (!table) return;

        const emergency = items.filter(i => ["emergency", "emergencia"].includes(String(i.tipo).toLowerCase())).length;
        const test = items.filter(i => String(i.tipo).toLowerCase() === "test").length;
        const cancelled = items.filter(i => ["cancelled", "cancelado"].includes(String(i.status).toLowerCase()) || String(i.tipo).toLowerCase() === "cancelled").length;

        document.getElementById("totalAlerts")?.replaceChildren(document.createTextNode(String(items.length)));
        document.getElementById("emergencyAlerts")?.replaceChildren(document.createTextNode(String(emergency)));
        document.getElementById("testAlerts")?.replaceChildren(document.createTextNode(String(test)));
        document.getElementById("cancelledAlerts")?.replaceChildren(document.createTextNode(String(cancelled)));
        const activeCount = items.filter(i => ["open", "active", "ativo", "ativa", "em_atendimento"].includes(String(i.status || "").toLowerCase())).length;
        const badge = document.getElementById("sidebarAlertCount");
        if (badge) {
            badge.textContent = String(activeCount);
            badge.hidden = activeCount === 0;
        }

        if (!items.length) {
            table.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:24px">Nenhum alerta registrado no banco de dados.</td></tr>';
            document.getElementById("alertCount")?.replaceChildren(document.createTextNode("0"));
            return;
        }

        table.innerHTML = items.map(item => {
            const typeRaw = String(item.tipo || "emergency").toLowerCase();
            const type = typeRaw === "emergencia" ? "emergency" : typeRaw === "teste" ? "test" : typeRaw === "cancelado" ? "cancelled" : typeRaw;
            const status = String(item.status || "").toLowerCase();
            const statusClass = status === "open" ? "active" : status === "resolved" ? "resolved" : "cancelled";
            const location = item.latitude != null && item.longitude != null
                ? `${item.latitude}, ${item.longitude}`
                : "Não informada";
            return `
                <tr data-type="${escapeHTML(type)}">
                    <td><span class="type-badge type-${escapeHTML(type)}"><span class="type-dot"></span>${escapeHTML(type === "emergency" ? "Emergência" : type === "test" ? "Teste" : "Cancelado")}</span></td>
                    <td><div class="user-cell"><div class="user-avatar">${escapeHTML(initials(item.usuario || "Usuário"))}</div><div><div class="user-name">${escapeHTML(item.usuario || "Usuário")}</div><div class="user-email">${escapeHTML(item.usuario || "")}</div></div></div></td>
                    <td>${escapeHTML(formatDateTime(item.data_inicio))}</td>
                    <td><div class="location">${escapeHTML(location)}</div></td>
                    <td><span class="status status-${statusClass}"><span class="status-dot"></span>${escapeHTML(statusLabel(item.status))}</span></td>
                    <td><button class="details-button" onclick='openDetails(${JSON.stringify(item.titulo || "Alerta")},${JSON.stringify(item.usuario || "Usuário")},${JSON.stringify(formatDateTime(item.data_inicio))},${JSON.stringify(location)},${JSON.stringify(statusLabel(item.status))},"—")'>Detalhes</button></td>
                </tr>`;
        }).join("");

        document.getElementById("alertCount")?.replaceChildren(document.createTextNode(String(items.length)));
    }

    function renderDevices(items) {
        const table = document.getElementById("deviceTable");
        if (!table) return;

        const online = items.filter(i => String(i.status).toLowerCase() === "online").length;
        const offline = items.length - online;
        document.getElementById("totalDevices")?.replaceChildren(document.createTextNode(String(items.length)));
        document.getElementById("onlineDevices")?.replaceChildren(document.createTextNode(String(online)));
        document.getElementById("offlineDevices")?.replaceChildren(document.createTextNode(String(offline)));
        document.getElementById("lowBattery")?.replaceChildren(document.createTextNode("—"));
        document.getElementById("tableCount")?.replaceChildren(document.createTextNode(String(items.length)));

        table.innerHTML = items.map(item => {
            const status = String(item.status || "offline").toLowerCase();
            const user = item.usuario || "Não vinculado";
            return `
                <tr data-status="${escapeHTML(status)}" data-search="${escapeHTML((item.device_code || "") + " " + user)}">
                    <td><div class="device-id"><strong>${escapeHTML(item.device_code || ("#" + item.id))}</strong><small>${escapeHTML(item.nome || "Dispositivo")}</small></div></td>
                    <td><div class="user-cell"><div class="user-avatar">${escapeHTML(initials(user))}</div><div>${escapeHTML(user)}</div></div></td>
                    <td><span class="status ${status}"><span class="status-dot"></span>${escapeHTML(statusLabel(status))}</span></td>
                    <td>${escapeHTML(item.last_seen ? formatDateTime(item.last_seen) : "—")}</td>
                    <td>—</td>
                    <td><div class="location">—</div></td>
                    <td><button class="details-button" onclick='openDevice(${JSON.stringify(item.device_code || item.id)},${JSON.stringify(user)},${JSON.stringify(statusLabel(status))},${JSON.stringify(item.last_seen ? formatDateTime(item.last_seen) : "Sem comunicação")},"Não informado","Não informado")'>Detalhes</button></td>
                </tr>`;
        }).join("");
    }

    function renderContacts(items) {
        const table = document.getElementById("contactsTable");
        if (!table) return;

        const users = new Set(items.map(i => i.usuario_id));
        const active = items.filter(i => Number(i.principal) === 1).length;
        document.getElementById("totalContacts")?.replaceChildren(document.createTextNode(String(items.length)));
        document.getElementById("totalUsers")?.replaceChildren(document.createTextNode(String(users.size)));
        document.getElementById("activeContacts")?.replaceChildren(document.createTextNode(String(active)));
        document.getElementById("contactCount")?.replaceChildren(document.createTextNode(String(items.length)));

        table.innerHTML = items.map(item => {
            const status = Number(item.principal) === 1 ? "active" : "inactive";
            return `
                <tr data-status="${status}" data-user="${escapeHTML(item.usuario || "")}">
                    <td><div class="contact-cell"><div class="contact-avatar">${escapeHTML(initials(item.nome))}</div><div class="contact-name">${escapeHTML(item.nome)}</div></div></td>
                    <td>${escapeHTML(item.telefone)}</td>
                    <td class="user-name">${escapeHTML(item.usuario || "—")}</td>
                    <td><span class="quantity">${Number(item.principal) === 1 ? "Principal" : "Secundário"}</span></td>
                    <td><span class="status ${status}"><span class="status-dot"></span>${status === "active" ? "Ativo" : "Cadastrado"}</span></td>
                    <td><button class="details-button" onclick='showDetails(${JSON.stringify(item.nome)},${JSON.stringify(item.telefone)},${JSON.stringify(item.usuario || "—")},${JSON.stringify(Number(item.principal) === 1 ? "Principal" : "Secundário")},${JSON.stringify(status === "active" ? "Ativo" : "Cadastrado")})'>Detalhes</button></td>
                </tr>`;
        }).join("");
    }

    async function setupConfig() {
        if (!document.getElementById("nome")) return;
        try {
            const response = await api.post("bootstrap");
            if (response.ok && response.user) {
                document.getElementById("nome").value = response.user.nome || "";
                document.getElementById("email").value = response.user.email || "";
            }
        } catch (e) {
            console.error(e);
        }

        window.salvarDados = async function () {
            const nome = document.getElementById("nome").value.trim();
            const email = document.getElementById("email").value.trim().toLowerCase();
            if (!nome || !email) return alert("Preencha o nome e o e-mail.");
            const response = await api.post("save_profile", { nome, email, telefone: "" });
            alert(response.ok ? "Dados do administrador atualizados com sucesso!" : (response.message || "Não foi possível salvar."));
        };

        window.alterarSenha = async function () {
            const atual = document.getElementById("senhaAtual").value;
            const nova = document.getElementById("novaSenha").value;
            const confirmar = document.getElementById("confirmarSenha").value;
            if (!atual || !nova || !confirmar) return alert("Preencha todos os campos de senha.");
            if (nova.length < 6) return alert("A nova senha deve possuir pelo menos 6 caracteres.");
            if (nova !== confirmar) return alert("A confirmação da senha não corresponde.");
            const response = await api.post("change_password", { atual, nova });
            if (!response.ok) return alert(response.message || "Não foi possível alterar a senha.");
            alert("Senha alterada com sucesso!");
            document.getElementById("senhaAtual").value = "";
            document.getElementById("novaSenha").value = "";
            document.getElementById("confirmarSenha").value = "";
        };
    }

    async function setupReports() {
        if (!document.getElementById("periodChart")) return;
        const response = await api.post("admin_report");
        if (!response.ok) return;
        const items = response.items || [];
        const alertsResponse = await api.post("admin_alerts");
        if (!alertsResponse || !alertsResponse.ok) {
            throw new Error(alertsResponse?.message || "Não foi possível carregar os alertas para o relatório.");
        }
        const alerts = Array.isArray(alertsResponse.items) ? alertsResponse.items : [];
        const stats = await loadStats() || {};

        const byDay = {};
        const byType = {};
        items.forEach(item => {
            byDay[item.dia] = (byDay[item.dia] || 0) + Number(item.quantidade || 0);
            byType[item.tipo] = (byType[item.tipo] || 0) + Number(item.quantidade || 0);
        });

        const labels = Object.keys(byDay).slice(-7);
        const values = labels.map(d => byDay[d]);
        const chart1 = window.Chart && Chart.getChart(document.getElementById("periodChart"));
        if (chart1) {
            chart1.data.labels = labels.map(d => formatDate(d));
            chart1.data.datasets[0].data = values;
            chart1.update();
        }

        const chart2 = window.Chart && Chart.getChart(document.getElementById("typeChart"));
        if (chart2) {
            const typeLabels = Object.keys(byType);
            const typeLabel = t => ({ emergency: "Emergência", emergencia: "Emergência", test: "Teste", teste: "Teste", cancelled: "Cancelado", cancelado: "Cancelado" }[String(t).toLowerCase()] || String(t));
            chart2.data.labels = typeLabels.map(typeLabel);
            chart2.data.datasets[0].data = typeLabels.map(t => byType[t]);
            chart2.update();
        }

        const total = Object.values(byDay).reduce((a, b) => a + b, 0);
        document.getElementById("totalAlertas")?.replaceChildren(document.createTextNode(String(total)));
        document.getElementById("totalUsuarios")?.replaceChildren(document.createTextNode(String(stats.usuarios || 0)));
        document.getElementById("totalDispositivos")?.replaceChildren(document.createTextNode(String(stats.dispositivos || 0)));
        document.getElementById("totalAtivos")?.replaceChildren(document.createTextNode(String(stats.ativos || 0)));
        document.getElementById("emergencyCount")?.replaceChildren(document.createTextNode(String(byType.emergency || byType.emergencia || 0)));

        const table = document.getElementById("reportSummaryTable");
        if (table) {
            const totalAlerts = alerts.length;
            if (!totalAlerts) {
                table.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:24px">Nenhum alerta registrado no banco de dados.</td></tr>';
            } else {
                const groups = {};
                alerts.forEach(alert => {
                    const rawType = String(alert.tipo || "outro").toLowerCase();
                    const label = ({ emergency: "Emergência", emergencia: "Emergência", test: "Teste", teste: "Teste", cancelled: "Cancelado", cancelado: "Cancelado" }[rawType] || rawType);
                    if (!groups[label]) groups[label] = { total: 0, statuses: {} };
                    groups[label].total++;
                    const status = statusLabel(alert.status);
                    groups[label].statuses[status] = (groups[label].statuses[status] || 0) + 1;
                });
                table.innerHTML = Object.entries(groups).map(([label, data]) => {
                    const percent = ((data.total / totalAlerts) * 100).toLocaleString("pt-BR", { maximumFractionDigits: 1 }) + "%";
                    const mostCommonStatus = Object.entries(data.statuses).sort((a, b) => b[1] - a[1])[0]?.[0] || "—";
                    return `<tr><td>${escapeHTML(label)}</td><td>${data.total}</td><td>${percent}</td><td>${escapeHTML(mostCommonStatus)}</td></tr>`;
                }).join("");
            }
        }
    }

    async function setupMap() {
        if (!document.getElementById("map")) return;
        const response = await api.post("admin_alerts");
        if (!response || !response.ok) {
            throw new Error(response?.message || "Não foi possível carregar as ocorrências do banco.");
        }

        const allItems = Array.isArray(response.items) ? response.items : [];
        const items = allItems.filter(i =>
            i.latitude !== null && i.latitude !== undefined && i.latitude !== "" &&
            i.longitude !== null && i.longitude !== undefined && i.longitude !== "" &&
            Number.isFinite(Number(i.latitude)) && Number.isFinite(Number(i.longitude))
        );

        if (window.L && window.map) {
            const map = window.map;
            map.eachLayer(layer => {
                if (!(layer instanceof L.TileLayer)) map.removeLayer(layer);
            });

            const colors = { open: "#f4c95d", active: "#f4c95d", resolved: "#55df91", cancelled: "#817b8c", canceled: "#817b8c" };
            const bounds = [];
            items.forEach(item => {
                const lat = Number(item.latitude);
                const lng = Number(item.longitude);
                // Ignora coordenadas inválidas ou fora dos limites geográficos.
                if (!Number.isFinite(lat) || !Number.isFinite(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) return;

                const status = String(item.status || "").toLowerCase();
                const color = colors[status] || "#ff5d73";
                const marker = L.circleMarker([lat, lng], {
                    radius: 8, color: "#ffffff", weight: 2, fillColor: color, fillOpacity: 1
                }).addTo(map);
                const popup = `<strong>${escapeHTML(item.titulo || "Alerta de emergência")}</strong><br>` +
                    `Usuária: ${escapeHTML(item.usuario || "Não identificada")}<br>` +
                    `Status: ${escapeHTML(statusLabel(status))}<br>` +
                    `Data: ${escapeHTML(formatDateTime(item.data_inicio))}<br>` +
                    `Coordenadas: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                marker.bindPopup(popup);
                bounds.push([lat, lng]);
            });

            // Enquadra automaticamente todos os alertas que possuem localização real.
            if (bounds.length === 1) {
                map.setView(bounds[0], 16);
            } else if (bounds.length > 1) {
                map.fitBounds(bounds, { padding: [35, 35], maxZoom: 16 });
            }
        }

        const activeCount = allItems.filter(i => ["open", "active", "ativo", "ativa", "em_atendimento"].includes(String(i.status || "").toLowerCase())).length;
        document.getElementById("mapTotal")?.replaceChildren(document.createTextNode(String(allItems.length)));
        document.getElementById("mapActive")?.replaceChildren(document.createTextNode(String(activeCount)));
        const occurrenceCount = document.getElementById("occurrenceCount");
        if (occurrenceCount) occurrenceCount.textContent = `${allItems.length} ocorrência(s)`;

        const list = document.getElementById("occurrenceList");
        if (list) {
            list.innerHTML = allItems.length ? allItems.slice(0, 10).map(item => {
                const status = String(item.status || "").toLowerCase();
                const active = ["open", "active", "ativo", "ativa", "em_atendimento"].includes(status);
                const resolved = ["resolved", "resolvido", "resolvida", "closed", "concluido", "concluído"].includes(status);
                const cls = active ? "active" : resolved ? "resolved" : "cancelled";
                const title = item.titulo || item.descricao || "Alerta";
                return `<article class="occurrence" data-status="${cls}">
                    <div class="occurrence-icon"><span>!</span></div>
                    <div class="occurrence-info">
                        <h3>${escapeHTML(title)}</h3>
                        <p>Usuária: ${escapeHTML(item.usuario || "Não identificada")} • ${escapeHTML(formatDateTime(item.data_inicio))}</p>
                        <p>Localização: ${item.latitude != null && item.longitude != null ? escapeHTML(`${item.latitude}, ${item.longitude}`) : "Não informada"}</p>
                    </div>
                    <span class="status ${cls}">${escapeHTML(statusLabel(item.status))}</span>
                </article>`;
            }).join("") : '<div style="padding:24px;text-align:center;color:var(--cinza)">Nenhuma ocorrência registrada no banco de dados.</div>';
        }
    }

    async function init() {
        const path = location.pathname.toLowerCase();

        try {
            if (path.endsWith("/admin.php")) {
                await loadStats();
                renderDashboardAlerts(await loadAlerts());
            }

            if (path.endsWith("/usuarios.php")) renderUsers(await loadUsers());
            if (path.endsWith("/alertas.php")) renderAlerts(await loadAlerts());
            if (path.endsWith("/dispositivos.php")) renderDevices(await loadDevices());
            if (path.endsWith("/contatos-admin.php")) renderContacts(await loadContacts());
            if (path.endsWith("/relatorios.php")) await setupReports();
            if (path.endsWith("/config-admin.php")) await setupConfig();
            if (path.endsWith("/mapa-admin.php")) await setupMap();
        } catch (error) {
            console.error("Falha ao carregar dados do SilentHelp:", error);
            const recentList = document.querySelector(".recent-list");
            if (recentList) {
                recentList.innerHTML = `<div style="padding:25px;text-align:center;color:var(--vermelho)">Erro ao consultar os alertas no banco de dados. Verifique a API e a conexão com o banco.</div>`;
            }
            const table = document.getElementById("alertTable");
            if (table) table.innerHTML = `<tr><td colspan="6">Não foi possível consultar os alertas no banco de dados.</td></tr>`;
        }
    }

    // Substitui o toggle fictício da página de usuários por alteração persistente.
    window.toggleUser = async function (button) {
        const row = button.closest("tr");
        if (!row) return;
        const idText = row.querySelector(".user-id")?.textContent || "";
        const id = parseInt(idText.replace(/\D/g, ""), 10);
        if (!id) return;

        const active = row.dataset.status === "active";
        const response = await api.post("admin_toggle_user", { id, ativo: !active });
        if (!response.ok) {
            if (typeof showToast === "function") showToast(response.message || "Não foi possível alterar o usuário.");
            return;
        }

        row.dataset.status = active ? "inactive" : "active";
        const status = row.querySelector(".status");
        if (status) {
            status.className = "status " + (active ? "inactive" : "active");
            status.innerHTML = `<span class="status-dot"></span>${active ? "Desativada" : "Ativa"}`;
        }
        button.className = "action-button " + (active ? "toggle-off" : "toggle-on");
        button.textContent = active ? "Ativar" : "Desativar";
        if (typeof showToast === "function") showToast(active ? "Conta desativada com sucesso." : "Conta ativada com sucesso.");
    };

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
