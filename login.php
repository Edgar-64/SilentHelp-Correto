<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

            align-items: center;

            justify-content: center;

            padding: 25px;

            background:

                radial-gradient(circle at 50% 0%,
                    rgba(166, 92, 255, .18),
                    transparent 38%),

                radial-gradient(circle at 0% 100%,
                    rgba(110, 50, 173, .10),
                    transparent 35%),

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


        button,
        input {

            font-family: inherit;

        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .login-container {

            width: 100%;

            max-width: 440px;

        }


        /* =====================================================
           BOTÃO VOLTAR
        ===================================================== */

        .back-button {

            width: 45px;

            height: 45px;

            border: 1px solid var(--borda);

            border-radius: 14px;

            background: var(--card);

            color: var(--roxo-claro);

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            margin-bottom: 25px;

            transition: .2s;

        }


        .back-button:hover {

            border-color: var(--roxo);

            background:
                rgba(166, 92, 255, .10);

            transform:
                translateX(-2px);

        }


        .back-button svg {

            width: 22px;

            height: 22px;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo-area {

            text-align: center;

            margin-bottom: 28px;

        }


        .logo {

            width: 78px;

            height: 78px;

            margin: 0 auto 16px;

            border-radius: 25px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:

                linear-gradient(145deg,
                    rgba(166, 92, 255, .20),
                    rgba(110, 50, 173, .12));

            border:
                1px solid rgba(166, 92, 255, .35);

            box-shadow:

                0 0 35px rgba(166, 92, 255, .10);

        }


        .logo svg {

            width: 43px;

            height: 43px;

            color:
                var(--roxo-claro);

        }


        .logo-area h1 {

            font-size: 28px;

            font-weight: 600;

            letter-spacing: -.5px;

        }


        .logo-area h1 span {

            color:
                var(--roxo-claro);

        }


        .logo-area p {

            color:
                var(--cinza);

            font-size: 14px;

            margin-top: 7px;

        }


        /* =====================================================
           CARD LOGIN
        ===================================================== */

        .login-card {

            padding: 30px;

            background:

                linear-gradient(145deg,
                    #141219,
                    #0c0c11);

            border:
                1px solid var(--borda);

            border-radius: 26px;

            box-shadow:

                0 20px 60px rgba(0, 0, 0, .30);

        }


        .login-title {

            margin-bottom: 25px;

        }


        .login-title h2 {

            font-size: 22px;

            font-weight: 600;

            margin-bottom: 6px;

        }


        .login-title p {

            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.5;

        }


        /* =====================================================
           CAMPOS
        ===================================================== */

        .form-group {

            margin-bottom: 18px;

        }


        .form-group label {

            display: block;

            font-size: 13px;

            font-weight: 500;

            margin-bottom: 8px;

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

            width: 19px;

            height: 19px;

            color:
                var(--cinza-escuro);

            pointer-events: none;

        }


        .form-group input {

            width: 100%;

            height: 50px;

            padding:
                0 48px;

            background:
                #09090e;

            border:
                1px solid var(--borda);

            border-radius: 14px;

            outline: none;

            color:
                var(--branco);

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

                0 0 0 3px rgba(166, 92, 255, .08);

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

            width: 28px;

            height: 28px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background: transparent;

            color:
                var(--cinza-escuro);

            cursor: pointer;

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

            background: transparent;

            color:
                var(--roxo-claro);

            font-size: 12px;

            cursor: pointer;

        }


        .forgot-password:hover {

            text-decoration: underline;

        }


        /* =====================================================
           BOTÃO LOGIN
        ===================================================== */

        .login-button {

            width: 100%;

            height: 52px;

            border: none;

            border-radius: 15px;

            background:

                linear-gradient(135deg,
                    var(--roxo),
                    var(--roxo-escuro));

            color:
                var(--branco);

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

            box-shadow:

                0 8px 25px rgba(166, 92, 255, .15);

        }


        .login-button:hover {

            transform:
                translateY(-2px);

            box-shadow:

                0 12px 30px rgba(166, 92, 255, .25);

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

            background: transparent;

            color:
                var(--roxo-claro);

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            margin-left: 4px;

        }


        .register-button:hover {

            text-decoration: underline;

        }


        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security-info {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            margin-top: 20px;

            color:
                var(--cinza-escuro);

            font-size: 11px;

        }


        .security-info svg {

            width: 15px;

            height: 15px;

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

            padding:
                14px 20px;

            border-radius: 14px;

            background:
                #18181f;

            border:
                1px solid var(--roxo);

            color:
                white;

            font-size: 13px;

            text-align: center;

            max-width: 90%;

            z-index: 9999;

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

        @media (max-width: 500px) {

            body {

                padding: 18px;

                align-items: flex-start;

            }


            .login-container {

                padding-top: 10px;

            }


            .logo-area {

                margin-bottom: 22px;

            }


            .logo {

                width: 68px;

                height: 68px;

                border-radius: 21px;

            }


            .logo svg {

                width: 38px;

                height: 38px;

            }


            .logo-area h1 {

                font-size: 25px;

            }


            .login-card {

                padding:
                    22px 18px;

                border-radius: 22px;

            }


            .login-options {

                align-items: flex-start;

            }

        }
    </style>

</head>


<body>


    <main class="login-container">


        <!-- =================================================
             VOLTAR
        ================================================== -->

        <button class="back-button" onclick="abrirPagina('index.php')" aria-label="Voltar para o início">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">

                <path d="M19 12H5" />

                <path d="M12 19l-7-7 7-7" />

            </svg>

        </button>



        <!-- =================================================
             LOGO
        ================================================== -->

        <section class="logo-area">


            <div class="logo">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">

                    <!-- ESCUDO -->

                    <path d="M12 3
                           C9.5 5.4 6.3 6.2 4 6.4
                           V11
                           C4 16.2 7.2 19.3 12 21
                           C16.8 19.3 20 16.2 20 11
                           V6.4
                           C17.7 6.2 14.5 5.4 12 3Z" />


                    <!-- CORAÇÃO -->

                    <path d="M8.5 12
                           C8.5 10.7 9.5 9.8 10.7 9.8
                           C11.4 9.8 11.8 10.1 12 10.6
                           C12.2 10.1 12.6 9.8 13.3 9.8
                           C14.5 9.8 15.5 10.7 15.5 12
                           C15.5 13.8 12 16 12 16
                           C12 16 8.5 13.8 8.5 12Z" />

                </svg>

            </div>


            <h1>
                Silent<span>Help</span>
            </h1>


            <p>
                Segurança, cuidado e proteção.
            </p>


        </section>



        <!-- =================================================
             CARD DE LOGIN
        ================================================== -->

        <section class="login-card">


            <div class="login-title">

                <h2>
                    Bem-vinda de volta
                </h2>

                <p>
                    Entre na sua conta para acessar
                    os recursos do SilentHelp.
                </p>

            </div>



            <form id="loginForm" onsubmit="fazerLogin(event)">


                <!-- =================================================
                     E-MAIL
                ================================================== -->

                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>


                    <div class="input-wrapper">

                        <input type="email" id="email" placeholder="Digite seu e-mail" autocomplete="email" required>


                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">

                            <rect x="3" y="5" width="18" height="14" rx="2" />

                            <path d="M3 7l9 6 9-6" />

                        </svg>

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

                        <input type="password" id="senha" placeholder="Digite sua senha" autocomplete="current-password"
                            required>


                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">

                            <rect x="5" y="10" width="14" height="10" rx="2" />

                            <path d="M8 10V7
                                   a4 4 0 0 1 8 0v3" />

                        </svg>


                        <button type="button" class="password-button" onclick="mostrarSenha()"
                            aria-label="Mostrar senha" id="passwordToggle">

                            <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                <path d="M2 12s3.5-6 10-6
                                       10 6 10 6
                                       -3.5 6-10 6
                                       -10-6-10-6Z" />

                                <circle cx="12" cy="12" r="2.5" />

                            </svg>

                        </button>

                    </div>

                </div>



                <!-- =================================================
                     OPÇÕES
                ================================================== -->

                <div class="login-options">


                    <label class="remember">

                        <input type="checkbox" id="lembrar">

                        <span>
                            Lembrar de mim
                        </span>

                    </label>


                    <button type="button" class="forgot-password" onclick="recuperarSenha()">

                        Esqueci minha senha

                    </button>


                </div>



                <!-- =================================================
                     ENTRAR
                ================================================== -->

                <button type="submit" class="login-button">

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

                <button type="button" class="register-button" onclick="abrirPagina('cadastro.php')">

                    Criar conta

                </button>

            </div>


        </section>



        <!-- =================================================
             SEGURANÇA
        ================================================== -->

        <div class="security-info">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                <path d="M12 3
                       l8 3v5
                       c0 5.2-3.4 8.7-8 10
                       c-4.6-1.3-8-4.8-8-10V6l8-3Z" />

                <path d="M8.5 12l2.3 2.3
                       4.5-5" />

            </svg>

            <span>
                Seus dados são protegidos pelo SilentHelp
            </span>

        </div>


    </main>



    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div class="toast" id="toast"></div>



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
                                .checked = true;

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
                senha.type ===
                "password"
            ) {

                senha.type =
                    "text";


                eyeIcon.innerHTML = `

                    <path
                        d="M3 3l18 18"
                    />

                    <path
                        d="M10.6 10.6
                           a2 2 0 0 0
                           2.8 2.8"
                    />

                    <path
                        d="M9.9 5.2
                           A10.8 10.8 0 0 1
                           12 5
                           c6.5 0 10 7 10 7
                           a18.3 18.3 0 0 1
                           -3.2 3.9"
                    />

                    <path
                        d="M6.2 6.2
                           C3.7 8.1 2 12 2 12
                           s3.5 7 10 7
                           c1.3 0 2.5-.3 3.5-.7"
                    />

                `;

            }

            else {

                senha.type =
                    "password";


                eyeIcon.innerHTML = `

                    <path
                        d="M2 12s3.5-6 10-6
                           10 6 10 6
                           -3.5 6-10 6
                           -10-6-10-6Z"
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
            const email = document.getElementById("email").value.trim().toLowerCase();
            const senha = document.getElementById("senha").value;
            const lembrar = document.getElementById("lembrar").checked;
            const botao = document.querySelector(".login-button");

            if (!email) { mostrarToast("Digite seu e-mail.", "error"); return; }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { mostrarToast("Digite um e-mail válido.", "error"); return; }
            if (!senha) { mostrarToast("Digite sua senha.", "error"); return; }

            const resposta = await window.SilentHelpAPI.post('login', { email, senha });
            if (!resposta.ok) { mostrarToast(resposta.message || "E-mail ou senha incorretos.", "error"); return; }

            if (lembrar) localStorage.setItem("silenthelp_login", JSON.stringify({ email }));
            else localStorage.removeItem("silenthelp_login");

            sessionStorage.setItem("silenthelp_logado", "true");
            sessionStorage.setItem("silenthelp_usuario", JSON.stringify(resposta.user));
            localStorage.setItem("silenthelp_usuario", JSON.stringify(resposta.user));
            if (botao) {
                botao.disabled = true;
                botao.textContent = "Entrando...";
            }

            mostrarToast("Login realizado com sucesso!", "success");

            setTimeout(() => {
                window.location.href = "index.php";
            }, 800);
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
                "Para redefinir a senha, será necessário implementar a recuperação de senha no sistema.",
                ""
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



        /* =====================================================
           ENTER NO FORMULÁRIO
        ===================================================== */

        document
            .getElementById("loginForm")
            .addEventListener(
                "keydown",
                function (event) {

                    if (
                        event.key === "Enter"
                    ) {

                        /*
                         * O formulário já possui
                         * o evento submit.
                         */

                    }

                }
            );

    </script>


    <script src="assets/db-sync.js"></script>
</body>

</html>