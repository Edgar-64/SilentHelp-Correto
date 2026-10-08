<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Login</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           CORES
        ===================================================== */

        :root {

            --roxo: #a65cff;
            --roxo-claro: #c58aff;
            --roxo-escuro: #6e32ad;

            --fundo: #050507;
            --card: #101015;
            --card-2: #15151c;

            --borda: #292933;

            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;

            --verde: #55df91;
            --vermelho: #ff5c70;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 30px 15px;

            background:

                radial-gradient(
                    circle at 50% 0%,
                    rgba(166, 92, 255, .18),
                    transparent 35%
                ),

                radial-gradient(
                    circle at 90% 90%,
                    rgba(110, 50, 173, .08),
                    transparent 35%
                ),

                var(--fundo);

            color: var(--branco);

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }


        input,
        button {
            font-family: inherit;
        }


        /* =====================================================
           CONTAINER PRINCIPAL
        ===================================================== */

        .login-container {

            width: 100%;

            max-width: 440px;

            margin: 0 auto;
        }


        /* =====================================================
           BOTÃO ADMINISTRADOR
        ===================================================== */

        .admin-toggle {

            position: fixed;

            top: 20px;
            right: 20px;

            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(166, 92, 255, .3);

            border-radius: 14px;

            background: rgba(166, 92, 255, .08);

            color: var(--roxo-claro);

            cursor: pointer;

            transition: .25s;

            z-index: 1000;
        }


        .admin-toggle:hover {

            background: rgba(166, 92, 255, .18);

            border-color: var(--roxo);

            transform: translateY(-2px);

            box-shadow:
                0 8px 25px
                rgba(166, 92, 255, .15);
        }


        .admin-toggle svg {

            width: 22px;
            height: 22px;
        }


        /* =====================================================
           LOGO
           MESMO PADRÃO DO CADASTRO
        ===================================================== */

        .logo {

            display: flex;

            justify-content: center;
            align-items: center;

            gap: 10px;

            margin-bottom: 25px;
        }


        .logo-icon {

            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background:
                rgba(166, 92, 255, .13);

            border:
                1px solid
                rgba(166, 92, 255, .3);

            color:
                var(--roxo-claro);

            transition: .25s;
        }


        .logo-icon:hover {

            background:
                rgba(166, 92, 255, .18);

            border-color:
                rgba(166, 92, 255, .5);

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 25px
                rgba(166, 92, 255, .15);
        }


        .logo-icon svg {

            width: 28px;
            height: 28px;
        }


        .logo-text {

            font-size: 25px;

            font-weight: 700;

            letter-spacing: -.5px;

            color:
                var(--branco);
        }


        .logo-text span {

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           CARD DE LOGIN
        ===================================================== */

        .login-card {

            width: 100%;

            padding: 32px;

            background:

                linear-gradient(
                    145deg,
                    rgba(22, 18, 29, .98),
                    rgba(10, 10, 15, .98)
                );

            border:
                1px solid
                var(--borda);

            border-radius: 28px;

            box-shadow:
                0 25px 70px
                rgba(0, 0, 0, .4);
        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .login-title {

            text-align: center;

            margin-bottom: 28px;
        }


        .login-title h1 {

            font-size: 28px;

            font-weight: 600;

            margin-bottom: 8px;
        }


        .login-title p {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.5;
        }


        /* =====================================================
           FORMULÁRIO
        ===================================================== */

        .form-group {

            margin-bottom: 18px;
        }


        .form-group label {

            display: block;

            font-size: 13px;

            font-weight: 500;

            margin-bottom: 7px;

            color:
                var(--branco);
        }


        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            left: 15px;

            top: 50%;

            transform:
                translateY(-50%);

            color:
                var(--cinza-escuro);

            pointer-events: none;
        }


        .input-icon svg {

            width: 18px;
            height: 18px;
        }


        .form-group input {

            width: 100%;

            height: 50px;

            padding:
                0 48px 0 45px;

            border:
                1px solid
                var(--borda);

            border-radius: 14px;

            background:
                #09090d;

            color:
                var(--branco);

            outline: none;

            font-size: 14px;

            transition: .2s;
        }


        .form-group input::placeholder {

            color:
                var(--cinza-escuro);
        }


        .form-group input:focus {

            border-color:
                var(--roxo);

            box-shadow:
                0 0 0 3px
                rgba(166, 92, 255, .08);
        }


        /* =====================================================
           MOSTRAR SENHA
        ===================================================== */

        .password-button {

            position: absolute;

            right: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            border: none;

            background:
                transparent;

            color:
                var(--cinza);

            cursor: pointer;

            padding: 5px;
        }


        .password-button:hover {

            color:
                var(--roxo-claro);
        }


        .password-button svg {

            width: 19px;
            height: 19px;
        }


        /* =====================================================
           OPÇÕES
        ===================================================== */

        .login-options {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin:
                4px 0 22px;

            gap: 10px;
        }


        .remember {

            display: flex;

            align-items: center;

            gap: 8px;

            color:
                var(--cinza);

            font-size: 12px;

            cursor: pointer;
        }


        .remember input {

            width: 15px;
            height: 15px;

            accent-color:
                var(--roxo);

            cursor: pointer;
        }


        .forgot-password {

            border: none;

            background:
                transparent;

            color:
                var(--roxo-claro);

            font-size: 12px;

            cursor: pointer;
        }


        .forgot-password:hover {

            text-decoration:
                underline;
        }


        /* =====================================================
           BOTÃO ENTRAR
        ===================================================== */

        .login-button {

            width: 100%;

            height: 52px;

            border: none;

            border-radius: 15px;

            background:

                linear-gradient(
                    135deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            color:
                var(--branco);

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: .25s;

            box-shadow:
                0 8px 25px
                rgba(166, 92, 255, .12);
        }


        .login-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 12px 30px
                rgba(166, 92, 255, .23);
        }


        .login-button:active {

            transform:
                translateY(0);
        }


        .login-button:disabled {

            opacity: .7;

            cursor: wait;

            transform: none;
        }


        /* =====================================================
           DIVISOR
        ===================================================== */

        .divider {

            display: flex;

            align-items: center;

            gap: 12px;

            margin:
                25px 0;

            color:
                var(--cinza-escuro);

            font-size: 12px;
        }


        .divider::before,
        .divider::after {

            content: "";

            height: 1px;

            flex: 1;

            background:
                var(--borda);
        }


        /* =====================================================
           CADASTRO
        ===================================================== */

        .register-area {

            text-align: center;

            color:
                var(--cinza);

            font-size: 13px;
        }


        .register-button {

            border: none;

            background:
                transparent;

            color:
                var(--roxo-claro);

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            margin-left: 4px;
        }


        .register-button:hover {

            text-decoration:
                underline;
        }


        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security-info {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            margin-top: 20px;

            color:
                var(--cinza-escuro);

            font-size: 11px;

            text-align: center;
        }


        .security-info svg {

            width: 15px;
            height: 15px;

            min-width: 15px;

            color:
                var(--verde);
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 30px;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            z-index: 9999;

            width:
                min(calc(100% - 30px), 450px);

            padding:
                15px 20px;

            border-radius: 15px;

            background:
                #18181f;

            border:
                1px solid
                var(--roxo);

            color:
                var(--branco);

            text-align: center;

            font-size: 13px;

            transition: .3s;
        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        .toast.success {

            border-color:
                var(--verde);
        }


        .toast.error {

            border-color:
                var(--vermelho);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 600px) {

            body {

                align-items:
                    flex-start;

                padding:
                    20px 14px;
            }


            .login-container {

                padding-top:
                    5px;
            }


            .logo {

                margin-bottom:
                    20px;
            }


            .login-card {

                padding:
                    23px 18px;

                border-radius:
                    23px;
            }


            .login-title h1 {

                font-size:
                    24px;
            }


            .login-title {

                margin-bottom:
                    23px;
            }


            .form-group input {

                height:
                    48px;
            }


            .login-options {

                align-items:
                    flex-start;
            }
        }


        @media (max-width: 380px) {

            .logo-text {

                font-size:
                    22px;
            }


            .logo-icon {

                width: 44px;
                height: 44px;
            }


            .login-card {

                padding:
                    21px 15px;
            }
        }

    </style>

</head>


<body>


    <!-- =====================================================
         BOTÃO ÁREA ADMINISTRATIVA
    ====================================================== -->

    <button
        type="button"
        class="admin-toggle"
        onclick="window.location.href='admin/login-admin.php'"
        title="Área administrativa"
        aria-label="Área administrativa"
    >

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
        >

            <path
                d="
                    M12 3
                    l8 3
                    v5
                    c0 5.2-3.4 8.7-8 10
                    c-4.6-1.3-8-4.8-8-10
                    V6l8-3Z
                "
            />

            <path
                d="M9 12l2 2 4-4"
            />

        </svg>

    </button>


    <!-- =====================================================
         CONTAINER PRINCIPAL
    ====================================================== -->

    <main class="login-container">


        <!-- =================================================
             LOGO
        ================================================== -->

        <div class="logo">


            <div class="logo-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <path
                        d="
                            M20.8 8.7
                            C20.8 13.8 12 20 12 20
                            S3.2 13.8 3.2 8.7
                            C3.2 5.9 5.4 4 8 4
                            C9.7 4 11.1 4.9 12 6.2
                            C12.9 4.9 14.3 4 16 4
                            C18.6 4 20.8 5.9 20.8 8.7Z
                        "
                    />

                </svg>

            </div>


            <div class="logo-text">

                Silent<span>Help</span>

            </div>


        </div>


        <!-- =================================================
             CARD DE LOGIN
        ================================================== -->

        <section class="login-card">


            <!-- CABEÇALHO -->

            <div class="login-title">

                <h1>
                    Bem-vinda de volta
                </h1>

                <p>
                    Entre na sua conta para acessar
                    os recursos do SilentHelp.
                </p>

            </div>


            <!-- =================================================
                 FORMULÁRIO
            ================================================== -->

            <form
                id="loginForm"
                onsubmit="fazerLogin(event)"
            >


                <!-- =================================================
                     E-MAIL
                ================================================== -->

                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>


                    <div class="input-wrapper">


                        <span class="input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />

                                <path
                                    d="M3 7l9 6 9-6"
                                />

                            </svg>

                        </span>


                        <input
                            type="email"
                            id="email"
                            placeholder="Digite seu e-mail"
                            autocomplete="email"
                            required
                        >


                    </div>

                </div>


                <!-- =================================================
                     SENHA
                ================================================== -->

                <div class="form-group">

                    <label for="senha">
                        Senha
                    </label>


                    <div class="input-wrapper">


                        <span class="input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <rect
                                    x="5"
                                    y="10"
                                    width="14"
                                    height="10"
                                    rx="2"
                                />

                                <path
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                />

                            </svg>

                        </span>


                        <input
                            type="password"
                            id="senha"
                            placeholder="Digite sua senha"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="password-button"
                            onclick="mostrarSenha()"
                            aria-label="Mostrar senha"
                        >

                            <svg
                                id="eyeIcon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    d="
                                        M2 12
                                        s3.5-6 10-6
                                        10 6 10 6
                                        -3.5 6-10 6
                                        -10-6-10-6Z
                                    "
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="2.5"
                                />

                            </svg>

                        </button>


                    </div>

                </div>


                <!-- =================================================
                     OPÇÕES
                ================================================== -->

                <div class="login-options">


                    <label class="remember">

                        <input
                            type="checkbox"
                            id="lembrar"
                        >

                        <span>
                            Lembrar de mim
                        </span>

                    </label>


                    <button
                        type="button"
                        class="forgot-password"
                        onclick="recuperarSenha()"
                    >

                        Esqueci minha senha

                    </button>


                </div>


                <!-- =================================================
                     BOTÃO ENTRAR
                ================================================== -->

                <button
                    type="submit"
                    class="login-button"
                >

                    Entrar na conta

                </button>


            </form>


            <!-- =================================================
                 DIVISOR
            ================================================== -->

            <div class="divider">

                ou

            </div>


            <!-- =================================================
                 CADASTRO
            ================================================== -->

            <div class="register-area">

                Ainda não possui uma conta?

                <button
                    type="button"
                    class="register-button"
                    onclick="abrirPagina('cadastro.php')"
                >

                    Criar conta

                </button>

            </div>


        </section>


        <!-- =================================================
             SEGURANÇA
        ================================================== -->

        <div class="security-info">


            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="
                        M12 3
                        l8 3
                        v5
                        c0 5.2-3.4 8.7-8 10
                        c-4.6-1.3-8-4.8-8-10
                        V6l8-3Z
                    "
                />

                <path
                    d="M8.5 12l2.3 2.3 4.5-5"
                />

            </svg>


            <span>
                Seus dados são protegidos pelo SilentHelp
            </span>


        </div>


    </main>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>


        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        function abrirPagina(pagina) {

            window.location.href = pagina;

        }


        /* =====================================================
           CARREGAR LOGIN SALVO
        ===================================================== */

        window.addEventListener(
            "DOMContentLoaded",
            function () {

                const loginSalvo =
                    localStorage.getItem(
                        "silenthelp_login"
                    );


                if (loginSalvo) {

                    try {

                        const dados =
                            JSON.parse(loginSalvo);


                        if (dados.email) {

                            document
                                .getElementById("email")
                                .value =
                                dados.email;


                            document
                                .getElementById("lembrar")
                                .checked =
                                true;

                        }

                    }

                    catch (erro) {

                        localStorage.removeItem(
                            "silenthelp_login"
                        );

                    }

                }

            }
        );


        /* =====================================================
           MOSTRAR / OCULTAR SENHA
        ===================================================== */

        function mostrarSenha() {

            const senha =
                document.getElementById("senha");


            const eyeIcon =
                document.getElementById("eyeIcon");


            if (
                senha.type === "password"
            ) {

                senha.type = "text";


                eyeIcon.innerHTML = `

                    <path
                        d="M3 3l18 18"
                    />

                    <path
                        d="
                            M10.6 10.6
                            a2 2 0 0 0
                            2.8 2.8
                        "
                    />

                    <path
                        d="
                            M9.9 5.2
                            A10.8 10.8 0 0 1
                            12 5
                            c6.5 0 10 7 10 7
                            a18.3 18.3 0 0 1
                            -3.2 3.9
                        "
                    />

                    <path
                        d="
                            M6.2 6.2
                            C3.7 8.1 2 12 2 12
                            s3.5 7 10 7
                            c1.3 0 2.5-.3 3.5-.7
                        "
                    />

                `;

            }

            else {

                senha.type = "password";


                eyeIcon.innerHTML = `

                    <path
                        d="
                            M2 12
                            s3.5-6 10-6
                            10 6 10 6
                            -3.5 6-10 6
                            -10-6-10-6Z
                        "
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="2.5"
                    />

                `;

            }

        }


        /* =====================================================
           LOGIN
        ===================================================== */

        async function fazerLogin(event) {

            event.preventDefault();


            const email =
                document
                    .getElementById("email")
                    .value
                    .trim()
                    .toLowerCase();


            const senha =
                document
                    .getElementById("senha")
                    .value;


            const lembrar =
                document
                    .getElementById("lembrar")
                    .checked;


            const botao =
                document.querySelector(
                    ".login-button"
                );


            if (!email) {

                mostrarToast(
                    "Digite seu e-mail.",
                    "error"
                );

                return;

            }


            if (
                !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
            ) {

                mostrarToast(
                    "Digite um e-mail válido.",
                    "error"
                );

                return;

            }


            if (!senha) {

                mostrarToast(
                    "Digite sua senha.",
                    "error"
                );

                return;

            }


            try {

                const resposta =
                    await window.SilentHelpAPI.post(
                        "login",
                        {
                            email,
                            senha
                        }
                    );


                if (
                    !resposta ||
                    !resposta.ok
                ) {

                    mostrarToast(
                        resposta?.message ||
                        "E-mail ou senha incorretos.",
                        "error"
                    );

                    return;

                }


                if (
                    !resposta.user ||
                    !resposta.user.tipo
                ) {

                    mostrarToast(
                        "Não foi possível identificar o tipo da conta.",
                        "error"
                    );

                    return;

                }


                /* =========================================
                   LEMBRAR LOGIN
                ========================================= */

                if (lembrar) {

                    localStorage.setItem(
                        "silenthelp_login",
                        JSON.stringify({
                            email
                        })
                    );

                }

                else {

                    localStorage.removeItem(
                        "silenthelp_login"
                    );

                }


                /* =========================================
                   SESSÃO
                ========================================= */

                sessionStorage.setItem(
                    "silenthelp_logado",
                    "true"
                );


                sessionStorage.setItem(
                    "silenthelp_usuario",
                    JSON.stringify(
                        resposta.user
                    )
                );


                localStorage.setItem(
                    "silenthelp_usuario",
                    JSON.stringify(
                        resposta.user
                    )
                );


                /* =========================================
                   BOTÃO
                ========================================= */

                if (botao) {

                    botao.disabled = true;

                    botao.textContent =
                        "Entrando...";

                }


                mostrarToast(
                    "Login realizado com sucesso!",
                    "success"
                );


                /* =========================================
                   REDIRECIONAMENTO
                ========================================= */

                setTimeout(
                    () => {

                        if (
                            resposta.user.tipo ===
                            "admin"
                        ) {

                            window.location.href =
                                "admin/admin.php";

                        }

                        else if (
                            resposta.user.tipo ===
                            "responsavel"
                        ) {

                            window.location.href =
                                "responsavel.php";

                        }

                        else if (
                            resposta.user.tipo ===
                            "protegida"
                        ) {

                            window.location.href =
                                "inicio.php";

                        }

                        else {

                            if (botao) {

                                botao.disabled =
                                    false;

                                botao.textContent =
                                    "Entrar na conta";

                            }


                            mostrarToast(
                                "Tipo de conta inválido.",
                                "error"
                            );

                        }

                    },
                    800
                );

            }


            catch (erro) {

                console.error(
                    "Erro no login:",
                    erro
                );


                if (botao) {

                    botao.disabled = false;

                    botao.textContent =
                        "Entrar na conta";

                }


                mostrarToast(
                    "Não foi possível conectar ao servidor.",
                    "error"
                );

            }

        }


        /* =====================================================
           RECUPERAR SENHA
        ===================================================== */

        function recuperarSenha() {

            const usuarioSalvo =
                localStorage.getItem(
                    "silenthelp_usuario"
                );


            if (!usuarioSalvo) {

                mostrarToast(
                    "Nenhuma conta cadastrada. Crie sua conta primeiro.",
                    "error"
                );

                return;

            }


            mostrarToast(
                "Para redefinir a senha, será necessário implementar a recuperação de senha no sistema."
            );

        }


        /* =====================================================
           TOAST
        ===================================================== */

        function mostrarToast(
            mensagem,
            tipo = ""
        ) {

            const toast =
                document.getElementById(
                    "toast"
                );


            toast.textContent =
                mensagem;


            toast.className =
                "toast show " +
                tipo;


            setTimeout(
                function () {

                    toast.className =
                        "toast";

                },
                3000
            );

        }

    </script>


    <!-- =====================================================
         API / BANCO DE DADOS
    ====================================================== -->

    <script src="assets/db-sync.js"></script>


</body>

</html>