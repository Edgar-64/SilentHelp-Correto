(function(){
  const api='../api.php';
  async function get(action){ try{return await fetch(api+'?action='+action,{credentials:'same-origin'}).then(r=>r.json())}catch(e){return {ok:false}} }
  const esc=s=>String(s??'').replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#039;','"':'&quot;'}[c]));
  async function load(){
    const path=location.pathname;
    if(path.endsWith('/admin.php')){
      const r=await get('admin_stats'); if(!r.ok)return; const s=r.stats;
      ['usersCount','devicesCount','emergencyCount','resolvedCount','activeCount'].forEach((id,i)=>{const e=document.getElementById(id); if(e)e.textContent=[s.usuarios,s.dispositivos,s.alertas,s.resolvidos,s.ativos][i]});
    }
    if(path.endsWith('/usuarios.php')){
      const r=await get('admin_users'); if(!r.ok)return; const t=document.getElementById('userTable'); if(!t)return;
      t.innerHTML=r.items.map(u=>`<tr><td>${esc(u.nome)}</td><td>${esc(u.email)}</td><td>${u.ativo?'Ativo':'Inativo'}</td><td>—</td><td>${esc(u.criado_em)}</td><td>—</td></tr>`).join('');
      const c=document.getElementById('userCount'); if(c)c.textContent=r.items.length;
    }
    if(path.endsWith('/alertas.php')){
      const r=await get('admin_alerts'); if(!r.ok)return; const t=document.getElementById('alertTable'); if(!t)return;
      t.innerHTML=r.items.map(a=>`<tr data-type="${esc(a.tipo)}"><td>${esc(a.tipo)}</td><td>${esc(a.usuario)}</td><td>${esc(a.data_inicio)}</td><td>—</td><td>${esc(a.status)}</td><td>${esc(a.titulo)}</td></tr>`).join('');
      [['totalAlerts',r.items.length],['emergencyAlerts',r.items.filter(a=>a.tipo==='emergencia').length],['testAlerts',r.items.filter(a=>a.tipo==='teste').length],['cancelledAlerts',r.items.filter(a=>a.status==='cancelado').length],['alertCount',r.items.length]].forEach(([id,v])=>{const e=document.getElementById(id);if(e)e.textContent=v});
    }
    if(path.endsWith('/dispositivos.php')){
      const r=await get('admin_devices'); if(!r.ok)return; const t=document.getElementById('deviceTable'); if(!t)return;
      t.innerHTML=r.items.map(d=>`<tr><td>${esc(d.identificador)}</td><td>${esc(d.usuario||'Não vinculada')}</td><td>${esc(d.status)}</td><td>${esc(d.ultimo_acesso||'—')}</td><td>—</td><td>—</td></tr>`).join('');
      const online=r.items.filter(d=>d.status==='online').length, off=r.items.length-online;
      [['totalDevices',r.items.length],['onlineDevices',online],['offlineDevices',off],['lowBattery',0]].forEach(([id,v])=>{const e=document.getElementById(id);if(e)e.textContent=v});
    }
    if(path.endsWith('/contatos-admin.php')){
      const r=await get('admin_contacts'); if(!r.ok)return; const t=document.getElementById('contactsTable'); if(!t)return;
      t.innerHTML=r.items.map(c=>`<tr><td>${esc(c.nome)}</td><td>${esc(c.telefone)}</td><td>${esc(c.usuario)}</td><td>—</td><td>${c.ativo?'Ativo':'Inativo'}</td><td>—</td></tr>`).join('');
      [['totalContacts',r.items.length],['totalUsers',new Set(r.items.map(c=>c.usuario)).size],['activeContacts',r.items.filter(c=>c.ativo).length],['contactCount',r.items.length]].forEach(([id,v])=>{const e=document.getElementById(id);if(e)e.textContent=v});
    }
    if(path.endsWith('/relatorios.php')){
      const r=await get('admin_report'); if(!r.ok)return; const total=r.items.reduce((a,x)=>a+Number(x.quantidade),0); const e=document.getElementById('totalAlertas');if(e)e.textContent=total;
      const u=await get('admin_users'),d=await get('admin_devices'); if(document.getElementById('totalUsuarios'))document.getElementById('totalUsuarios').textContent=u.items?.length||0; if(document.getElementById('totalDispositivos'))document.getElementById('totalDispositivos').textContent=d.items?.length||0; if(document.getElementById('totalAtivos'))document.getElementById('totalAtivos').textContent=(d.items||[]).filter(x=>x.status==='online').length;
    }
  }
  if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',load);else load();
})();
