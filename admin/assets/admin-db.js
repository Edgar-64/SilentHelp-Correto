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
        if (!response.ok) return [];
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
        if (!recentList) return;

        const recent = items.slice(0, 5);
        recentList.innerHTML = recent.length
            ? recent.map(item => {
                const status = String(item.status || "").toLowerCase();
                const type = String(item.tipo || "").toLowerCase();
                const statusClass = status === "open" ? "active" : status === "resolved" ? "resolved" : "cancelled";
                const iconClass = type === "emergency" || type === "emergencia" ? "emergency" : "test";
                return `
                    <div class="recent-alert" onclick="openAlert(
                        '${escapeHTML(item.titulo).replace(/'/g, "\\'")}',
                        '${escapeHTML(formatDateTime(item.data_inicio)).replace(/'/g, "\\'")}',
                        '${escapeHTML(item.usuario || "Usuário").replace(/'/g, "\\'")}',
                        '${escapeHTML(item.latitude && item.longitude ? item.latitude + ', ' + item.longitude : 'Localização não informada').replace(/'/g, "\\'")}',
                        '${escapeHTML(statusLabel(item.status)).replace(/'/g, "\\'")}'
                    )">
                        <div class="recent-icon ${iconClass}">
                            <span style="font-size:18px">!</span>
                        </div>
                        <div class="recent-info">
                            <strong>${escapeHTML(item.titulo || "Alerta")}</strong>
                            <span>${escapeHTML(item.usuario || "Usuário")} • ${escapeHTML(formatDateTime(item.data_inicio))}</span>
                        </div>
                        <span class="recent-status ${statusClass}">${escapeHTML(statusLabel(item.status))}</span>
                    </div>`;
            }).join("")
            : `<div style="padding:25px;text-align:center;color:var(--cinza)">Nenhum alerta registrado.</div>`;
    }

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
            chart2.data.labels = typeLabels;
            chart2.data.datasets[0].data = typeLabels.map(t => byType[t]);
            chart2.update();
        }

        const total = Object.values(byDay).reduce((a, b) => a + b, 0);
        document.getElementById("totalAlertas")?.replaceChildren(document.createTextNode(String(total)));
        document.getElementById("totalUsuarios")?.replaceChildren(document.createTextNode(String(stats.usuarios || 0)));
        document.getElementById("totalDispositivos")?.replaceChildren(document.createTextNode(String(stats.dispositivos || 0)));
        document.getElementById("totalAtivos")?.replaceChildren(document.createTextNode(String(stats.ativos || 0)));
        document.getElementById("emergencyCount")?.replaceChildren(document.createTextNode(String(byType.emergency || byType.emergencia || 0)));
    }

    async function setupMap() {
        if (!document.getElementById("map")) return;
        const response = await api.post("admin_alerts");
        if (!response.ok || !window.L || !window.map) return;

        const map = window.map;
        const items = (response.items || []).filter(i => i.latitude != null && i.longitude != null);
        map.eachLayer(layer => {
            if (!(layer instanceof L.TileLayer)) map.removeLayer(layer);
        });

        const colors = { open: "#f4c95d", resolved: "#55df91", cancelled: "#817b8c" };
        items.forEach(item => {
            const status = String(item.status || "resolved").toLowerCase();
            const color = colors[status] || "#ff5d73";
            const marker = L.circleMarker([Number(item.latitude), Number(item.longitude)], {
                radius: 8, color: "#ffffff", weight: 2, fillColor: color, fillOpacity: 1
            }).addTo(map);
            marker.bindPopup(`<strong>${escapeHTML(item.titulo || "Alerta")}</strong><br>Usuário: ${escapeHTML(item.usuario || "—")}<br>Status: ${escapeHTML(statusLabel(status))}<br>${escapeHTML(formatDateTime(item.data_inicio))}`);
        });

        document.getElementById("mapTotal")?.replaceChildren(document.createTextNode(String(items.length)));
        document.getElementById("mapActive")?.replaceChildren(document.createTextNode(String(items.filter(i => i.status === "open").length)));
    }

    async function init() {
        const path = location.pathname.toLowerCase();

        if (path.endsWith("/admin.php")) {
            const stats = await loadStats();
            const alerts = await loadAlerts();
            if (stats) {
                const emergency = alerts.filter(i => ["emergency", "emergencia"].includes(String(i.tipo).toLowerCase())).length;
                document.getElementById("emergencyCount")?.replaceChildren(document.createTextNode(String(emergency)));
            }
            renderDashboardAlerts(alerts);
        }

        if (path.endsWith("/usuarios.php")) renderUsers(await loadUsers());
        if (path.endsWith("/alertas.php")) renderAlerts(await loadAlerts());
        if (path.endsWith("/dispositivos.php")) renderDevices(await loadDevices());
        if (path.endsWith("/contatos-admin.php")) renderContacts(await loadContacts());
        if (path.endsWith("/relatorios.php")) await setupReports();
        if (path.endsWith("/config-admin.php")) await setupConfig();
        if (path.endsWith("/mapa-admin.php")) await setupMap();
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
