<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Login</title>


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
           VARIÁVEIS
        ===================================================== */

        :root {

            --roxo: #a855f7;
            --roxo-2: #b76cff;
            --roxo-claro: #d0a0ff;
            --roxo-escuro: #702db5;

            --fundo: #07060a;
            --fundo-2: #0d0a12;

            --card: #121018;

            --borda: rgba(255,255,255,.08);

            --branco: #ffffff;

            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --vermelho: #ff5d73;

            --sombra:
                0 25px 70px rgba(0,0,0,.45);
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

                radial-gradient(
                    circle at 50% -10%,
                    rgba(168,85,247,.22),
                    transparent 38%
                ),

                radial-gradient(
                    circle at 0% 100%,
                    rgba(112,45,181,.12),
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


        /* =====================================================
           CONTAINER
        ===================================================== */

        .login-container {

            width: 100%;

            max-width: 440px;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo-area {

            display: flex;

            flex-direction: column;

            align-items: center;

            margin-bottom: 28px;
        }


        .logo {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            margin-bottom: 13px;
        }


        .logo-heart {

            width: 45px;

            height: 45px;

            color: var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 14px
                    rgba(168,85,247,.45)
                );
        }


        .logo-text {

            font-size: 29px;

            font-weight: 750;

            letter-spacing: -1.2px;
        }


        .logo-text .silent {

            color:
                var(--roxo-2);
        }


        .logo-text .help {

            color:
                white;
        }


        .admin-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding:
                6px 11px;

            border:
                1px solid
                rgba(168,85,247,.22);

            border-radius: 20px;

            background:
                rgba(168,85,247,.08);

            color:
                var(--roxo-claro);

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .8px;
        }


        .admin-badge svg {

            width: 13px;

            height: 13px;
        }


        /* =====================================================
           CARD LOGIN
        ===================================================== */

        .login-card {

            padding: 32px;

            border:
                1px solid
                rgba(168,85,247,.16);

            border-radius: 24px;

            background:
                linear-gradient(
                    145deg,
                    rgba(25,21,32,.96),
                    rgba(13,10,18,.96)
                );

            box-shadow:
                var(--sombra);
        }


        /* =====================================================
           TÍTULO
        ===================================================== */

        .login-header {

            margin-bottom: 26px;
        }


        .login-header h1 {

            font-size: 25px;

            font-weight: 650;

            letter-spacing: -.5px;

            margin-bottom: 7px;
        }


        .login-header h1 span {

            color:
                var(--roxo-claro);
        }


        .login-header p {

            color:
                var(--cinza);

            font-size: 12px;

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

            margin-bottom: 8px;

            color:
                #ddd8e3;

            font-size: 12px;

            font-weight: 600;
        }


        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            left: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 19px;

            height: 19px;

            color:
                var(--cinza-2);

            pointer-events: none;
        }


        .form-group input {

            width: 100%;

            height: 48px;

            padding:
                0 45px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            outline: none;

            background:
                rgba(7,6,10,.65);

            color:
                white;

            font-family: inherit;

            font-size: 13px;

            transition:
                .2s;
        }


        .form-group input::placeholder {

            color:
                #686270;
        }


        .form-group input:focus {

            border-color:
                rgba(168,85,247,.65);

            box-shadow:
                0 0 0 3px
                rgba(168,85,247,.08);
        }


        .form-group input:focus + .input-icon {

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           MOSTRAR SENHA
        ===================================================== */

        .password-toggle {

            position: absolute;

            right: 12px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 30px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background: transparent;

            color:
                var(--cinza-2);

            cursor: pointer;

            border-radius: 8px;
        }


        .password-toggle:hover {

            color:
                var(--roxo-claro);

            background:
                rgba(168,85,247,.08);
        }


        .password-toggle svg {

            width: 18px;

            height: 18px;
        }


        /* =====================================================
           OPÇÕES
        ===================================================== */

        .form-options {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            margin:
                2px 0 22px;
        }


        .remember {

            display: flex;

            align-items: center;

            gap: 7px;

            color:
                var(--cinza);

            font-size: 11px;

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

            font-family: inherit;

            font-size: 11px;

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

            height: 49px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    100deg,
                    var(--roxo-escuro),
                    var(--roxo)
                );

            color:
                white;

            font-family: inherit;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 25px
                rgba(168,85,247,.18);

            transition:
                .2s;
        }


        .login-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 14px 30px
                rgba(168,85,247,.28);
        }


        .login-button:active {

            transform:
                translateY(0);
        }


        .login-button svg {

            width: 18px;

            height: 18px;
        }


        /* =====================================================
           MENSAGEM
        ===================================================== */

        .message {

            display: none;

            margin-top: 15px;

            padding: 11px 13px;

            border-radius: 10px;

            font-size: 11px;

            line-height: 1.4;

            text-align: center;
        }


        .message.error {

            display: block;

            color:
                #ff9aaa;

            background:
                rgba(255,93,115,.08);

            border:
                1px solid
                rgba(255,93,115,.15);
        }


        .message.success {

            display: block;

            color:
                #80e8ad;

            background:
                rgba(85,223,145,.08);

            border:
                1px solid
                rgba(85,223,145,.15);
        }


        /* =====================================================
           DIVISOR
        ===================================================== */

        .divider {

            display: flex;

            align-items: center;

            gap: 12px;

            margin:
                24px 0 18px;

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        .divider::before,
        .divider::after {

            content: "";

            flex: 1;

            height: 1px;

            background:
                var(--borda);
        }


        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security-info {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            color:
                var(--cinza-2);

            font-size: 10px;

            text-align: center;
        }


        .security-info svg {

            width: 15px;

            height: 15px;

            color:
                var(--roxo-claro);

            flex-shrink: 0;
        }


        /* =====================================================
           VOLTAR
        ===================================================== */

        .back-link {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            margin-top: 20px;

            border: none;

            background: transparent;

            color:
                var(--cinza);

            font-family: inherit;

            font-size: 11px;

            cursor: pointer;
        }


        .back-link:hover {

            color:
                var(--roxo-claro);
        }


        .back-link svg {

            width: 15px;

            height: 15px;
        }


        /* =====================================================
           MODAL RECUPERAÇÃO
        ===================================================== */

        .modal-overlay {

            position: fixed;

            inset: 0;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(0,0,0,.72);

            backdrop-filter:
                blur(7px);

            z-index: 2000;
        }


        .modal-overlay.show {

            display: flex;
        }


        .modal {

            width: 100%;

            max-width: 400px;

            padding: 28px;

            border:
                1px solid
                rgba(168,85,247,.18);

            border-radius: 20px;

            background:
                #121018;

            box-shadow:
                0 25px 80px
                rgba(0,0,0,.55);

            animation:
                modalIn .2s ease;
        }


        @keyframes modalIn {

            from {

                opacity: 0;

                transform:
                    translateY(10px)
                    scale(.98);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        .modal-icon {

            width: 45px;

            height: 45px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 16px;

            border-radius: 13px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);
        }


        .modal-icon svg {

            width: 22px;

            height: 22px;
        }


        .modal h2 {

            font-size: 20px;

            margin-bottom: 7px;
        }


        .modal p {

            color:
                var(--cinza);

            font-size: 11px;

            line-height: 1.5;

            margin-bottom: 20px;
        }


        .modal-actions {

            display: flex;

            gap: 10px;

            margin-top: 18px;
        }


        .modal-button {

            flex: 1;

            height: 43px;

            border: none;

            border-radius: 10px;

            font-family: inherit;

            font-size: 11px;

            font-weight: 650;

            cursor: pointer;
        }


        .modal-button.cancel {

            background:
                rgba(255,255,255,.05);

            color:
                var(--cinza);
        }


        .modal-button.confirm {

            background:
                linear-gradient(
                    100deg,
                    var(--roxo-escuro),
                    var(--roxo)
                );

            color:
                white;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 25px;

            transform:
                translate(-50%, 80px);

            padding:
                12px 18px;

            border:
                1px solid
                rgba(168,85,247,.18);

            border-radius: 11px;

            background:
                #17131d;

            color:
                white;

            font-size: 11px;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,.4);

            opacity: 0;

            transition:
                .25s;

            z-index: 3000;
        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 500px) {

            body {

                padding:
                    18px;
            }


            .login-card {

                padding:
                    24px 20px;

                border-radius:
                    20px;
            }


            .logo-text {

                font-size:
                    26px;
            }


            .logo-heart {

                width:
                    40px;

                height:
                    40px;
            }


            .login-header h1 {

                font-size:
                    22px;
            }


            .form-options {

                align-items:
                    flex-start;

                flex-direction:
                    column;

                gap: 12px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         LOGIN
    ====================================================== -->

    <div class="login-container">


        <!-- LOGO -->

        <div class="logo-area">

            <div class="logo">

                <svg
                    class="logo-heart"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                </svg>


                <div class="logo-text">

                    <span class="silent">
                        Silent
                    </span>

                    <span class="help">
                        Help
                    </span>

                </div>

            </div>


            <div class="admin-badge">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="3"
                        y="11"
                        width="18"
                        height="10"
                        rx="2"
                    />

                    <path
                        d="M7 11V7a5 5 0 0 1 10 0v4"
                    />

                </svg>

                Área administrativa

            </div>

        </div>



        <!-- =================================================
             CARD
        ================================================== -->

        <div class="login-card">


            <div class="login-header">

                <h1>
                    Acesso ao <span>painel</span>
                </h1>

                <p>
                    Entre com suas credenciais para acessar
                    o painel administrativo do SilentHelp.
                </p>

            </div>



            <!-- FORM -->

            <form
                id="loginForm"
                onsubmit="login(event)"
            >


                <!-- E-MAIL -->

                <div class="form-group">

                    <label for="email">
                        E-mail
                    </label>


                    <div class="input-wrapper">

                        <input
                            type="email"
                            id="email"
                            placeholder="Digite seu e-mail"
                            autocomplete="email"
                            required
                        >


                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <path
                                d="m3 7 9 6 9-6"
                            />

                        </svg>

                    </div>

                </div>



                <!-- SENHA -->

                <div class="form-group">

                    <label for="password">
                        Senha
                    </label>


                    <div class="input-wrapper">

                        <input
                            type="password"
                            id="password"
                            placeholder="Digite sua senha"
                            autocomplete="current-password"
                            required
                        >


                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="3"
                                y="11"
                                width="18"
                                height="10"
                                rx="2"
                            />

                            <path
                                d="M7 11V7a5 5 0 0 1 10 0v4"
                            />

                        </svg>


                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Mostrar senha"
                        >

                            <svg
                                id="eyeIcon"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path
                                    d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                />

                            </svg>

                        </button>

                    </div>

                </div>



                <!-- OPÇÕES -->

                <div class="form-options">


                    <label class="remember">

                        <input
                            type="checkbox"
                            id="remember"
                        >

                        Lembrar acesso

                    </label>


                    <button
                        type="button"
                        class="forgot-password"
                        onclick="openRecovery()"
                    >

                        Esqueci minha senha

                    </button>

                </div>



                <!-- ENTRAR -->

                <button
                    type="submit"
                    class="login-button"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path
                            d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"
                        />

                        <polyline
                            points="10 17 15 12 10 7"
                        />

                        <line
                            x1="15"
                            y1="12"
                            x2="3"
                            y2="12"
                        />

                    </svg>

                    Entrar no painel

                </button>


                <div
                    id="message"
                    class="message"
                ></div>


            </form>



            <!-- DIVISOR -->

            <div class="divider">
                acesso protegido
            </div>



            <!-- SEGURANÇA -->

            <div class="security-info">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                    />

                    <path
                        d="m9 12 2 2 4-4"
                    />

                </svg>

                Ambiente administrativo protegido

            </div>

        </div>



        <!-- VOLTAR -->

        <button
            class="back-link"
            onclick="goBack()"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path
                    d="m15 18-6-6 6-6"
                />

            </svg>

            Voltar

        </button>

    </div>



    <!-- =====================================================
         MODAL RECUPERAÇÃO
    ====================================================== -->

    <div
        class="modal-overlay"
        id="recoveryModal"
        onclick="closeRecoveryOutside(event)"
    >

        <div class="modal">


            <div class="modal-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M4 4h16v16H4z"
                    />

                    <path
                        d="m4 7 8 5 8-5"
                    />

                </svg>

            </div>


            <h2>
                Recuperar senha
            </h2>


            <p>
                Informe o e-mail cadastrado para receber
                as instruções de recuperação da senha.
            </p>


            <div class="form-group">

                <label for="recoveryEmail">
                    E-mail
                </label>


                <div class="input-wrapper">

                    <input
                        type="email"
                        id="recoveryEmail"
                        placeholder="admin@silenthelp.com"
                    >


                    <svg
                        class="input-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="14"
                            rx="2"
                        />

                        <path
                            d="m3 7 9 6 9-6"
                        />

                    </svg>

                </div>

            </div>


            <div class="modal-actions">

                <button
                    type="button"
                    class="modal-button cancel"
                    onclick="closeRecovery()"
                >
                    Cancelar
                </button>


                <button
                    type="button"
                    class="modal-button confirm"
                    onclick="sendRecovery()"
                >
                    Enviar instruções
                </button>

            </div>

        </div>

    </div>



    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>



    <script>

        /* =====================================================
           LOGIN
        ===================================================== */

        async function login(event) {
            event.preventDefault();
            const email = document.getElementById("email").value.trim().toLowerCase();
            const senha = document.getElementById("password").value;
            const message = document.getElementById("message");
            const resposta = await window.SilentHelpAPI.post('admin_login', {email, senha});
            if (!resposta.ok) {
                message.className = "message error";
                message.textContent = resposta.message || "Credenciais inválidas.";
                return;
            }
            message.className = "message success";
            message.textContent = "Login realizado com sucesso. Entrando no painel...";
            setTimeout(() => window.location.href = "admin.php", 500);
        }\n\n\n        function togglePassword() {

            const password =
                document.getElementById("password");


            const icon =
                document.getElementById("eyeIcon");


            if (
                password.type === "password"
            ) {

                password.type =
                    "text";


                icon.innerHTML = `

                    <path
                        d="M3 3l18 18"
                    />

                    <path
                        d="M10.58 10.58a2 2 0 0 0 2.83 2.83"
                    />

                    <path
                        d="M9.88 4.24A10.7 10.7 0 0 1 12 4c6.5 0 10 8 10 8a17.4 17.4 0 0 1-3.03 4.11"
                    />

                    <path
                        d="M6.61 6.61C3.5 8.5 2 12 2 12s3.5 8 10 8a10.7 10.7 0 0 0 3.73-.68"
                    />

                `;

            }

            else {

                password.type =
                    "password";


                icon.innerHTML = `

                    <path
                        d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                    />

                `;

            }

        }



        /* =====================================================
           RECUPERAÇÃO
        ===================================================== */

        function openRecovery() {

            document
                .getElementById("recoveryModal")
                .classList
                .add("show");


            setTimeout(
                function () {

                    document
                        .getElementById("recoveryEmail")
                        .focus();

                },
                100
            );

        }



        function closeRecovery() {

            document
                .getElementById("recoveryModal")
                .classList
                .remove("show");

        }



        function closeRecoveryOutside(event) {

            if (
                event.target ===
                document.getElementById(
                    "recoveryModal"
                )
            ) {

                closeRecovery();

            }

        }



        /* =====================================================
           ENVIAR RECUPERAÇÃO
        ===================================================== */

        function sendRecovery() {

            const email =
                document
                    .getElementById("recoveryEmail")
                    .value
                    .trim();


            if (!email) {

                showToast(
                    "Digite seu e-mail."
                );

                return;

            }


            if (
                !email.includes("@")
            ) {

                showToast(
                    "Digite um e-mail válido."
                );

                return;

            }


            closeRecovery();


            showToast(
                "Instruções de recuperação enviadas para o e-mail informado."
            );

        }



        /* =====================================================
           TOAST
        ===================================================== */

        function showToast(message) {

            const toast =
                document.getElementById("toast");


            toast.textContent =
                message;


            toast.classList.add(
                "show"
            );


            setTimeout(
                function () {

                    toast.classList.remove(
                        "show"
                    );

                },
                3000
            );

        }



        /* =====================================================
           VOLTAR
        ===================================================== */

        function goBack() {

            if (
                document.referrer
            ) {

                window.history.back();

            }

            else {

                window.location.href =
                    "index.php";

            }

        }



        /* =====================================================
           ENTER NO MODAL
        ===================================================== */

        document
            .getElementById("recoveryEmail")
            .addEventListener(
                "keydown",
                function(event) {

                    if (
                        event.key === "Enter"
                    ) {

                        event.preventDefault();

                        sendRecovery();

                    }

                }
            );


    </script>

<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>