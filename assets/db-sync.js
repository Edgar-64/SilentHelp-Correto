(function () {

    const api = location.pathname.includes('/admin/')
        ? '../api.php'
        : 'api.php';

    const originalSet = Storage.prototype.setItem;
    const originalRemove = Storage.prototype.removeItem;

    const synced = new Set([
        'silenthelp_usuario',
        'silenthelp_contatos',
        'silenthelp_relatos',
        'silenthelpCodigoResponsavel',
        'silenthelpNome',
        'silenthelpEmail',
        'silenthelpTelefone',
        'silenthelpFotoPerfil'
    ]);

    let hydrating = false;

    async function post(action, data) {
        try {
            return await fetch(
                api + '?action=' + encodeURIComponent(action),
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(data || {})
                }
            ).then(response => response.json());

        } catch (e) {
            console.error(e);

            return {
                ok: false
            };
        }
    }

    Storage.prototype.setItem = function (key, value) {

        originalSet.call(this, key, value);

        if (
            this !== localStorage ||
            hydrating ||
            !synced.has(key)
        ) {
            return;
        }

        let obj;

        try {
            obj = JSON.parse(value);
        } catch (_) {
            obj = value;
        }

        if (key === 'silenthelp_contatos') {

            post('save_contacts', {
                contatos: Array.isArray(obj) ? obj : []
            });

        } else if (key === 'silenthelp_relatos') {

            // Relatos novos são enviados pela página.
            // O cache local continua sendo mantido.

        } else if (key === 'silenthelp_usuario' && obj && obj.nome) {

            // Não sincroniza o perfil automaticamente.
            // O cadastro já salva os dados no banco.
        }
    };

    Storage.prototype.removeItem = function (key) {
        originalRemove.call(this, key);
    };

    async function bootstrap() {

        const r = await post('bootstrap');

        if (!r.ok) {
            return;
        }

        hydrating = true;

        originalSet.call(
            localStorage,
            'silenthelp_usuario',
            JSON.stringify(r.user)
        );

        originalSet.call(
            localStorage,
            'silenthelp_contatos',
            JSON.stringify(r.contatos || [])
        );

        originalSet.call(
            localStorage,
            'silenthelp_relatos',
            JSON.stringify(r.relatos || [])
        );

        originalSet.call(
            localStorage,
            'silenthelp_logado',
            'true'
        );

        originalSet.call(
            sessionStorage,
            'silenthelp_usuario',
            JSON.stringify(r.user)
        );

        originalSet.call(
            sessionStorage,
            'silenthelp_logado',
            'true'
        );

        hydrating = false;

        window.SilentHelpDB = r;

        document.dispatchEvent(
            new CustomEvent(
                'silenthelp-db-ready',
                {
                    detail: r
                }
            )
        );
    }

    if (
        !/login\.php$|cadastro\.php$|login-admin\.php$|splash\.php$/
        .test(location.pathname)
    ) {
        bootstrap();
    }

    window.SilentHelpAPI = {
        post
    };

})();