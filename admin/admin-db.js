(function () {
    "use strict";

    // O painel administrativo usa a API que fica dentro da própria pasta /admin.
    // Não reutilizar window.SilentHelpAPI: o db-sync.js global pode apontar para
    // a API da raiz, que não contém as rotas admin_* deste painel.
    // O CSS é carregado também por arquivo externo nas páginas PHP; este fallback
    // ajuda páginas administrativas que ainda não tenham o <link> no <head>.
    (function ensureAdminModalStylesheet(){
        if (document.querySelector('link[data-sh-admin-modal-css]')) return;
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'assets/admin-modals.css?v=20261027b';
        link.dataset.shAdminModalCss = '1';
        document.head.appendChild(link);
    })();

    const api = {
            post: async (action, data = {}) => {
                const response = await fetch("api.php?action=" + encodeURIComponent(action), {
                    method: "POST",
                    headers: { "Content-Type": "application/json", "Accept": "application/json" },
                    credentials: "same-origin",
                    body: JSON.stringify(data)
                });
                const raw = await response.text();
                let result;
                try { result = JSON.parse(raw); }
                catch (_) { throw new Error("A API não retornou JSON válido (HTTP " + response.status + "). Confira o caminho de api.php e os erros do PHP."); }
                if (!response.ok && result && !result.message) result.message = "Falha na API (HTTP " + response.status + ").";
                return result;
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
        if (["active", "open", "online"].includes(s)) return s === "open" ? "Em aberto" : "Ativo";
        if (["attended", "atendido", "atendida", "em_atendimento"].includes(s)) return "Atendido";
        if (["encerrado", "encerrada", "resolved", "resolvido", "resolvida", "closed"].includes(s)) return "Encerrado";
        if (["offline"].includes(s)) return "Offline";
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
                <tr data-id="${Number(item.id)}" data-status="${status}" data-name="${escapeHTML(item.nome)}" data-email="${escapeHTML(item.email)}">
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
                            <button class="action-button ${active ? "toggle-on" : "toggle-off"}" onclick="toggleUser(this)" title="${active ? "Desativar" : "Ativar"} conta">${active ? "Desativar" : "Ativar"}</button>
                            <button class="action-button" onclick="editUser(${Number(item.id)})">Editar</button>
                            <button class="action-button" style="color:#ff667d" onclick="deleteUser(${Number(item.id)})">Excluir</button>
                        </div>
                    </td>
                </tr>`;
        }).join("");

        document.getElementById("userCount")?.replaceChildren(document.createTextNode(String(items.length)));
    }

    window.SilentHelpAdminRenderAlerts = function(items) { renderAlerts(items); };

    function normalizeAlertStatus(value) {
        const s = String(value ?? "").trim().toLowerCase().replace(/[\s-]+/g, "_");
        if (["open", "aberto", "aberta"].includes(s)) return "open";
        if (["attended", "atendido", "atendida", "em_atendimento"].includes(s)) return "attended";
        if (["encerrado", "encerrada", "resolved", "resolvido", "resolvida", "closed"].includes(s)) return "encerrado";
        return s;
    }

    function alertStatusLabel(value) {
        return ({ open: "Em aberto", attended: "Atendido", encerrado: "Encerrado" })[normalizeAlertStatus(value)] || String(value ?? "");
    }

    function renderAlerts(items) {
        const table = document.getElementById("alertTable");
        if (!table) return;

        const countStatus = status => items.filter(item => normalizeAlertStatus(item.status) === status).length;
        const emergencyCount = items.filter(item => String(item.tipo || "").toLowerCase() === "emergencia").length;
        document.getElementById("totalAlerts")?.replaceChildren(document.createTextNode(String(items.length)));
        document.getElementById("emergencyAlerts")?.replaceChildren(document.createTextNode(String(emergencyCount)));
        document.getElementById("testAlerts")?.replaceChildren(document.createTextNode(String(countStatus("attended"))));
        document.getElementById("cancelledAlerts")?.replaceChildren(document.createTextNode(String(countStatus("encerrado"))));

        if (!items.length) {
            table.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:24px">Nenhum alerta registrado no banco de dados.</td></tr>';
            document.getElementById("alertCount")?.replaceChildren(document.createTextNode("0"));
            return;
        }

        table.innerHTML = items.map(item => {
            const id = Number(item.id);
            const status = normalizeAlertStatus(item.status);
            const statusClass = status === "open" ? "status-active" : status === "attended" ? "status-resolved" : "status-cancelled";
            const type = String(item.tipo || "emergencia").replaceAll("_", " ");
            const user = item.usuario || "";
            const date = item.data_inicio ? formatDateTime(item.data_inicio) : "";
            const hasLocation = item.latitude !== null && item.latitude !== undefined && item.latitude !== "" && item.longitude !== null && item.longitude !== undefined && item.longitude !== "" && Number.isFinite(Number(item.latitude)) && Number.isFinite(Number(item.longitude));
            const location = hasLocation
                ? `<a href="https://www.google.com/maps?q=${encodeURIComponent(item.latitude + ',' + item.longitude)}" target="_blank" rel="noopener noreferrer">${escapeHTML(Number(item.latitude).toFixed(6))}, ${escapeHTML(Number(item.longitude).toFixed(6))}</a>`
                : "";
            return `<tr data-id="${id}" data-type="${escapeHTML(type)}" data-status="${escapeHTML(status)}">
                <td><span class="type-badge type-emergency"><span class="type-dot"></span>${escapeHTML(type)}</span></td>
                <td><div class="user-cell"><div class="user-avatar">${escapeHTML(user ? initials(user) : "")}</div><div><div class="user-name">${escapeHTML(user)}</div></div></div></td>
                <td>${escapeHTML(date)}</td>
                <td><div class="location">${location}</div></td>
                <td><span class="status ${statusClass}"><span class="status-dot"></span>${escapeHTML(alertStatusLabel(status))}</span></td>
                <td><button class="details-button" onclick='openDetails(${JSON.stringify(item.titulo || item.descricao || "")},${JSON.stringify(user)},${JSON.stringify(date)},${JSON.stringify(hasLocation ? `${item.latitude}, ${item.longitude}` : "")},${JSON.stringify(alertStatusLabel(status))},"")'>Detalhes</button></td>
                <td><div class="actions" style="display:flex;gap:6px;flex-wrap:wrap"><button type="button" class="action-button" onclick="editAlert(${id})">Editar</button><button type="button" class="action-button" style="color:#ff667d" onclick="deleteAlert(${id})">Deletar</button></div></td>
            </tr>`;
        }).join("");

        document.getElementById("alertCount")?.replaceChildren(document.createTextNode(String(items.length)));
        // Reaplica o filtro atualmente selecionado após renderizar os dados do banco.
        const activeFilter = document.querySelector(".filters .filter.active");
        if (activeFilter && typeof window.filterAlerts === "function") {
            const match = activeFilter.getAttribute("onclick")?.match(/filterAlerts\('([^']+)'/);
            window.filterAlerts(match?.[1] || "all", activeFilter);
        }
    }


    function ensureAdminModal() {
        if (document.getElementById("shAdminModal")) return;
        const style = document.createElement("style");
        style.textContent = `
        .sh-modal-backdrop{position:fixed;inset:0;background:rgba(5,3,10,.78);backdrop-filter:blur(7px);z-index:99998;display:flex;align-items:center;justify-content:center;padding:18px}
        .sh-modal-backdrop[hidden]{display:none!important}
        .sh-modal{width:min(560px,100%);max-height:90vh;overflow:auto;background:#14101c;color:#f8f5ff;border:1px solid rgba(168,85,247,.35);border-radius:18px;box-shadow:0 24px 90px #0009;padding:24px}
        .sh-modal h2{font-size:1.25rem;margin:0 0 7px}.sh-modal p{color:#aaa5b4;margin:0 0 18px}
        .sh-modal-form{display:grid;grid-template-columns:1fr 1fr;gap:14px}.sh-field{display:flex;flex-direction:column;gap:6px;min-width:0}.sh-field.full{grid-column:1/-1}
        .sh-field label{font-size:.86rem;color:#d9d0e5}.sh-field input,.sh-field select,.sh-field textarea{width:100%;min-height:42px;border:1px solid #393044;border-radius:9px;background:#0d0a12;color:#fff;padding:10px;font:inherit;outline:none}
        .sh-field input:focus,.sh-field select:focus,.sh-field textarea:focus{border-color:#b76cff;box-shadow:0 0 0 3px #a855f722}
        .sh-modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:22px;flex-wrap:wrap}
        .sh-btn{border:1px solid transparent;border-radius:9px;padding:10px 15px;font-weight:700;cursor:pointer;transition:.18s ease;font:inherit}
        .sh-btn:hover{filter:brightness(1.12);transform:translateY(-1px)}.sh-btn:focus-visible{outline:3px solid #d0a0ff;outline-offset:2px}
        .sh-btn-primary{background:linear-gradient(135deg,#a855f7,#7c3aed);color:white}.sh-btn-muted{background:#24202c;color:#eee;border-color:#393044}.sh-btn-danger{background:#dc3658;color:white}
        @media(max-width:520px){.sh-modal{padding:18px}.sh-modal-form{grid-template-columns:1fr}.sh-field.full{grid-column:auto}.sh-modal-actions .sh-btn{flex:1}}
        button.action-button,button.details-button,button.filter,button[type=submit],.btn,.button{border-radius:9px!important;transition:background .18s ease,border-color .18s ease,transform .18s ease,box-shadow .18s ease!important}
        button.action-button{padding:8px 12px!important;border:1px solid rgba(168,85,247,.3)!important;background:#21172e!important;color:#e8d7ff!important;font-weight:650!important;cursor:pointer}
        button.action-button:hover{background:#39214f!important;border-color:#b76cff!important;transform:translateY(-1px)}
        button.action-button[style*="ff667d"],button.action-button.danger{background:#351621!important;color:#ff9aaa!important;border-color:#783044!important}
        button.details-button{padding:8px 12px!important;background:#21172e!important;border:1px solid #4a2e61!important;color:#e8d7ff!important;cursor:pointer}
        `;
        document.head.appendChild(style);
        const backdrop = document.createElement("div");
        backdrop.id = "shAdminModal";
        backdrop.className = "sh-modal-backdrop";
        backdrop.hidden = true;
        backdrop.style.display = "none";
        backdrop.innerHTML = `<section class="sh-modal" role="dialog" aria-modal="true" aria-labelledby="shModalTitle"><h2 id="shModalTitle"></h2><p id="shModalDescription"></p><form id="shModalForm"><div class="sh-modal-form" id="shModalFields"></div><div class="sh-modal-actions"><button type="button" class="sh-btn sh-btn-muted" id="shModalCancel">Cancelar</button><button type="submit" class="sh-btn sh-btn-primary" id="shModalSubmit">Salvar alterações</button></div></form></section>`;
        document.body.appendChild(backdrop);
        backdrop.addEventListener("click", e => { if(e.target===backdrop) closeAdminModal(); });
        document.getElementById("shModalCancel").onclick = closeAdminModal;
        document.addEventListener("keydown", e => { if(e.key==="Escape") closeAdminModal(); });
    }
    function closeAdminModal(){const el=document.getElementById("shAdminModal");if(el){el.hidden=true;el.style.display="none";}}
    function showAdminForm({title,description="",fields=[],submit="Salvar alterações",danger=false,onSubmit}) {
        ensureAdminModal();
        const modal=document.getElementById("shAdminModal"), form=document.getElementById("shModalForm");
        document.getElementById("shModalTitle").textContent=title;
        document.getElementById("shModalDescription").textContent=description;
        document.getElementById("shModalSubmit").textContent=submit;
        document.getElementById("shModalSubmit").className="sh-btn "+(danger?"sh-btn-danger":"sh-btn-primary");
        const container=document.getElementById("shModalFields");
        container.innerHTML=fields.map((f,i)=>{
            const id="shField"+i, value=String(f.value??"");
            let control;
            if(f.type==="select") control=`<select id="${id}" name="${escapeHTML(f.name)}" ${f.required===false?"":"required"}>${(f.options||[]).map(o=>`<option value="${escapeHTML(o.value)}" ${String(o.value)===value?"selected":""}>${escapeHTML(o.label)}</option>`).join("")}</select>`;
            else if(f.type==="textarea") control=`<textarea id="${id}" name="${escapeHTML(f.name)}" rows="3" ${f.required===false?"":"required"}>${escapeHTML(value)}</textarea>`;
            else control=`<input id="${id}" name="${escapeHTML(f.name)}" type="${escapeHTML(f.type||"text")}" value="${escapeHTML(value)}" ${f.required===false?"":"required"} ${f.min!==undefined?`min="${f.min}"`:""} ${f.max!==undefined?`max="${f.max}"`:""} ${f.step?`step="${f.step}"`:""} ${f.placeholder?`placeholder="${escapeHTML(f.placeholder)}"`:""}>`;
            return `<div class="sh-field ${f.full?"full":""}"><label for="${id}">${escapeHTML(f.label)}</label>${control}</div>`;
        }).join("");
        form.onsubmit=async e=>{
            e.preventDefault();
            e.stopPropagation();
            if (typeof onSubmit !== "function") {
                window.showToast?.("Não foi possível executar esta ação. Reabra o modal e tente novamente.");
                return;
            }
            const data={};
            new FormData(form).forEach((v,k)=>data[k]=v);
            const btn=document.getElementById("shModalSubmit");
            btn.disabled=true;
            btn.textContent="Processando…";
            try {
                await onSubmit(data);
                closeAdminModal();
            } catch(err) {
                console.error("Falha ao enviar formulário administrativo:", err);
                const message = err?.message || "Ocorreu um erro ao salvar. Confira a conexão com a API e tente novamente.";
                window.showToast?.(message);
                const description = document.getElementById("shModalDescription");
                if (description) description.textContent = message;
            } finally {
                btn.disabled=false;
                btn.textContent=submit;
            }
        };
        modal.hidden=false;
        modal.style.display="flex";
        modal.querySelector("input,select,textarea")?.focus();
    }
    function confirmAdminDelete({title,description,submit="Excluir",onConfirm}) {
        showAdminForm({title,description,submit,danger:true,fields:[],onSubmit:async()=>{await onConfirm();closeAdminModal();}});
    }


    window.editAlert = async function (id) {
        const response=await api.post("admin_alerts"), item=response?.items?.find(x=>Number(x.id)===Number(id));
        if(!response?.ok||!item)return window.showToast?.("Não foi possível carregar este alerta.");
        showAdminForm({title:`Editar alerta #${id}`,description:"Altere os dados e salve para atualizar o banco.",fields:[
            {name:"message",label:"Mensagem",type:"textarea",value:item.titulo||item.descricao||"",full:true},
            {name:"status",label:"Status",type:"select",value:normalizeAlertStatus(item.status),options:[{value:"open",label:"Aberto"},{value:"attended",label:"Em atendimento"},{value:"encerrado",label:"Encerrado"}]},
            {name:"latitude",label:"Latitude",type:"number",step:"any",required:false,value:item.latitude??""},
            {name:"longitude",label:"Longitude",type:"number",step:"any",required:false,value:item.longitude??""}
        ],onSubmit:async d=>{const latitude=d.latitude.trim()===""?null:Number(d.latitude),longitude=d.longitude.trim()===""?null:Number(d.longitude);
            if((latitude===null)!==(longitude===null)||(latitude!==null&&(!Number.isFinite(latitude)||latitude < -90||latitude>90||!Number.isFinite(longitude)||longitude < -180||longitude>180)))throw Error("Informe latitude e longitude válidas ou deixe ambas vazias.");
            const r=await api.post("admin_update_alert",{id:Number(id),message:d.message,status:d.status,latitude,longitude});if(!r?.ok)throw Error(r?.message||"Falha ao atualizar alerta.");
            closeAdminModal();window.showToast?.("Alerta atualizado.");renderAlerts(await loadAlerts());}});
    };
    window.deleteAlert = async function(id) {
        confirmAdminDelete({title:`Excluir alerta #${id}?`,description:"Esta ação não pode ser desfeita.",onConfirm:async()=>{const r=await api.post("admin_delete_alert",{id:Number(id)});if(!r?.ok)throw Error(r?.message||"Falha ao excluir alerta.");window.showToast?.("Alerta excluído.");renderAlerts(await loadAlerts());}});
    };

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
                <tr data-id="${Number(item.id)}" data-status="${escapeHTML(status)}" data-search="${escapeHTML((item.device_code || "") + " " + user)}">
                    <td><div class="device-id"><strong>${escapeHTML(item.device_code || ("#" + item.id))}</strong><small>${escapeHTML(item.nome || "Dispositivo")}</small></div></td>
                    <td><div class="user-cell"><div class="user-avatar">${escapeHTML(initials(user))}</div><div>${escapeHTML(user)}</div></div></td>
                    <td><span class="status ${status}"><span class="status-dot"></span>${escapeHTML(statusLabel(status))}</span></td>
                    <td>${escapeHTML(item.last_seen ? formatDateTime(item.last_seen) : "—")}</td>
                    <td>—</td>
                    <td><div class="location">—</div></td>
                    <td><button class="details-button" onclick='openDevice(${JSON.stringify(item.device_code || item.id)},${JSON.stringify(user)},${JSON.stringify(statusLabel(status))},${JSON.stringify(item.last_seen ? formatDateTime(item.last_seen) : "Sem comunicação")},"Não informado","Não informado")'>Detalhes</button> <button class="action-button" onclick="editDevice(${Number(item.id)})">Editar</button> <button class="action-button" style="color:#ff667d" onclick="deleteDevice(${Number(item.id)})">Excluir</button></td>
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
                <tr data-id="${Number(item.id)}" data-status="${status}" data-user="${escapeHTML(item.usuario || "")}">
                    <td><div class="contact-cell"><div class="contact-avatar">${escapeHTML(initials(item.nome))}</div><div class="contact-name">${escapeHTML(item.nome)}</div></div></td>
                    <td>${escapeHTML(item.telefone)}</td>
                    <td class="user-name">${escapeHTML(item.usuario || "—")}</td>
                    <td><span class="quantity">${Number(item.principal) === 1 ? "Principal" : "Secundário"}</span></td>
                    <td><span class="status ${status}"><span class="status-dot"></span>${status === "active" ? "Ativo" : "Cadastrado"}</span></td>
                    <td><button class="details-button" onclick='showDetails(${JSON.stringify(item.nome)},${JSON.stringify(item.telefone)},${JSON.stringify(item.usuario || "—")},${JSON.stringify(Number(item.principal) === 1 ? "Principal" : "Secundário")},${JSON.stringify(status === "active" ? "Ativo" : "Cadastrado")})'>Detalhes</button> <button class="action-button" onclick="editContact(${Number(item.id)})">Editar</button> <button class="action-button" style="color:#ff667d" onclick="deleteContact(${Number(item.id)})">Excluir</button></td>
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

            const colors = { open: "#f4c95d", active: "#f4c95d", attended: "#55b8ff", encerrado: "#55df91", resolved: "#55df91", cancelled: "#817b8c", canceled: "#817b8c" };
            const bounds = [];
            items.forEach(item => {
                const lat = Number(item.latitude);
                const lng = Number(item.longitude);
                // Ignora coordenadas inválidas ou fora dos limites geográficos.
                if (!Number.isFinite(lat) || !Number.isFinite(lng) || lat < -90 || lat > 90 || lng < -180 || lng > 180) return;

                const status = String(item.status || "").trim().toLowerCase();
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

    async function fetchItems(action) { const r = await api.post(action); if (!r || !r.ok) throw new Error(r?.message || "Falha ao consultar o banco."); return r.items || []; }

    function addAdminActionButton(tableId,label,handler) {
        const table=document.getElementById(tableId);if(!table||document.getElementById("btn-"+tableId))return;
        const button=document.createElement("button");button.id="btn-"+tableId;button.type="button";button.textContent=label;
        button.className="sh-btn sh-btn-primary";button.style.margin="0 0 12px";button.addEventListener("click",handler);table.parentElement.insertBefore(button,table);
    }
    addAdminActionButton("userTable","+ Cadastrar usuário",()=>showAdminForm({title:"Cadastrar usuário",description:"Preencha os dados da nova conta.",fields:[
        {name:"nome",label:"Nome completo"},{name:"email",label:"E-mail",type:"email"},{name:"telefone",label:"Telefone",required:false},
        {name:"tipo",label:"Tipo de conta",type:"select",value:"protegida",options:[{value:"protegida",label:"Pessoa protegida"},{value:"responsavel",label:"Responsável"}]},
        {name:"senha",label:"Senha inicial",type:"password"}],onSubmit:async d=>{if(d.senha.length<6)throw Error("A senha precisa ter pelo menos 6 caracteres.");const r=await api.post("admin_create_user",d);if(!r?.ok)throw Error(r?.message||"Falha ao cadastrar usuário.");closeAdminModal();window.showToast?.("Usuário cadastrado.");renderUsers(await loadUsers());}}));
    addAdminActionButton("contactsTable","+ Cadastrar contato",()=>showAdminForm({title:"Cadastrar contato",description:"Informe o ID do usuário ao qual o contato pertence.",fields:[
        {name:"usuario_id",label:"ID do usuário",type:"number"},{name:"nome",label:"Nome do contato"},{name:"telefone",label:"Telefone"},{name:"relacao",label:"Parentesco / relação",required:false},
        {name:"principal",label:"Contato principal",type:"select",value:"0",options:[{value:"0",label:"Não"},{value:"1",label:"Sim"}]}],
        onSubmit:async d=>{const r=await api.post("admin_save_contact",{...d,usuario_id:Number(d.usuario_id),principal:d.principal==="1"});if(!r?.ok)throw Error(r?.message||"Falha ao salvar contato.");closeAdminModal();window.showToast?.("Contato cadastrado.");renderContacts(await loadContacts());}}));

    window.editUser=async function(id){const list=await fetchItems("admin_users"),x=list.find(i=>Number(i.id)===Number(id));if(!x)return window.showToast?.("Usuário não encontrado.");
        showAdminForm({title:`Editar usuário #${id}`,fields:[{name:"nome",label:"Nome",value:x.nome},{name:"email",label:"E-mail",type:"email",value:x.email},{name:"telefone",label:"Telefone",required:false,value:x.telefone||""},{name:"tipo",label:"Tipo",type:"select",value:x.tipo,options:[{value:"protegida",label:"Pessoa protegida"},{value:"responsavel",label:"Responsável"}]}],onSubmit:async d=>{const r=await api.post("admin_update_user",{id:Number(id),...d});if(!r?.ok)throw Error(r?.message||"Falha ao editar usuário.");closeAdminModal();window.showToast?.("Usuário atualizado.");renderUsers(await loadUsers());}});};
    window.deleteUser=async function(id){confirmAdminDelete({title:`Excluir usuário #${id}?`,description:"A exclusão remove também os vínculos e dados dependentes associados a esta conta. Esta ação não pode ser desfeita.",onConfirm:async()=>{const r=await api.post("admin_delete_user",{id:Number(id)});if(!r?.ok)throw Error(r?.message||"Falha ao excluir usuário.");window.showToast?.("Usuário excluído.");renderUsers(await loadUsers());}});};
    window.editDevice=async function(id){const list=await fetchItems("admin_devices"),x=list.find(i=>Number(i.id)===Number(id));if(!x)return window.showToast?.("Dispositivo não encontrado.");
        showAdminForm({title:`Editar dispositivo #${id}`,fields:[{name:"usuario_id",label:"ID do usuário proprietário",type:"number",value:x.usuario_id},{name:"nome",label:"Nome",value:x.nome},{name:"device_code",label:"Código único",value:x.device_code},{name:"status",label:"Status",type:"select",value:x.status,options:["online","offline","connected","disconnected"].map(v=>({value:v,label:v}))}],onSubmit:async d=>{const r=await api.post("admin_save_device",{id:Number(id),...d,usuario_id:Number(d.usuario_id)});if(!r?.ok)throw Error(r?.message||"Falha ao salvar dispositivo.");closeAdminModal();window.showToast?.("Dispositivo atualizado.");renderDevices(await loadDevices());}});};
    window.deleteDevice=async function(id){confirmAdminDelete({title:`Excluir dispositivo #${id}?`,description:"O dispositivo será removido permanentemente.",onConfirm:async()=>{const r=await api.post("admin_delete_device",{id:Number(id)});if(!r?.ok)throw Error(r?.message||"Falha ao excluir dispositivo.");window.showToast?.("Dispositivo excluído.");renderDevices(await loadDevices());}});};
    window.editContact=async function(id){const list=await fetchItems("admin_contacts"),x=list.find(i=>Number(i.id)===Number(id));if(!x)return window.showToast?.("Contato não encontrado.");
        showAdminForm({title:`Editar contato #${id}`,fields:[{name:"usuario_id",label:"ID do usuário proprietário",type:"number",value:x.usuario_id},{name:"nome",label:"Nome",value:x.nome},{name:"telefone",label:"Telefone",value:x.telefone},{name:"relacao",label:"Parentesco / relação",required:false,value:x.relacao||""},{name:"principal",label:"Contato principal",type:"select",value:String(x.principal),options:[{value:"0",label:"Não"},{value:"1",label:"Sim"}]}],onSubmit:async d=>{const r=await api.post("admin_save_contact",{id:Number(id),...d,usuario_id:Number(d.usuario_id),principal:d.principal==="1"});if(!r?.ok)throw Error(r?.message||"Falha ao salvar contato.");closeAdminModal();window.showToast?.("Contato atualizado.");renderContacts(await loadContacts());}});};
    window.deleteContact=async function(id){confirmAdminDelete({title:`Excluir contato #${id}?`,description:"O contato será removido permanentemente.",onConfirm:async()=>{const r=await api.post("admin_delete_contact",{id:Number(id)});if(!r?.ok)throw Error(r?.message||"Falha ao excluir contato.");window.showToast?.("Contato excluído.");renderContacts(await loadContacts());}});};

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
