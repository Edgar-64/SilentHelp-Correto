<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Cadastro</title>


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
        button,
        select {

            font-family: inherit;

        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {

            width: 100%;

            max-width: 560px;

        }


        /* =====================================================
           LOGO
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

        }


        .logo-icon svg {

            width: 28px;

            height: 28px;

        }


        .logo-text {

            font-size: 25px;

            font-weight: 700;

            letter-spacing: -.5px;

        }


        .logo-text span {

            color:
                var(--roxo-claro);

        }


        /* =====================================================
           CARD
        ===================================================== */

        .register-card {

            width: 100%;

            padding: 32px;

            background:

                linear-gradient(
                    145deg,
                    rgba(22,18,29,.98),
                    rgba(10,10,15,.98)
                );

            border:
                1px solid
                var(--borda);

            border-radius: 28px;

            box-shadow:
                0 25px 70px
                rgba(0,0,0,.4);

        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .card-header {

            text-align: center;

            margin-bottom: 28px;

        }


        .card-header h1 {

            font-size: 28px;

            font-weight: 600;

            margin-bottom: 8px;

        }


        .card-header p {

            color: var(--cinza);

            font-size: 14px;

            line-height: 1.5;

        }


        /* =====================================================
           TIPO DE CONTA
        ===================================================== */

        .account-type {

            margin-bottom: 28px;

        }


        .account-title {

            text-align: center;

            color: var(--cinza);

            font-size: 13px;

            margin-bottom: 14px;

        }


        .type-options {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 12px;

        }


        .type-option {

            position: relative;

            cursor: pointer;

        }


        .type-option input {

            position: absolute;

            opacity: 0;

            pointer-events: none;

        }


        .type-card {

            min-height: 125px;

            padding: 18px 14px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            gap: 8px;

            border: 1px solid var(--borda);

            border-radius: 18px;

            background: #09090d;

            transition: .25s;

        }


        .type-card:hover {

            border-color:
                rgba(166,92,255,.5);

            transform:
                translateY(-2px);

        }


        .type-option input:checked + .type-card {

            border-color:
                var(--roxo);

            background:
                rgba(166,92,255,.10);

            box-shadow:
                0 0 0 2px
                rgba(166,92,255,.08);

        }


        .type-icon {

            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 13px;

            background:
                rgba(166,92,255,.12);

            color:
                var(--roxo-claro);

        }


        .type-icon svg {

            width: 22px;

            height: 22px;

        }


        .type-card strong {

            font-size: 14px;

        }


        .type-card small {

            color: var(--cinza);

            font-size: 11px;

            line-height: 1.4;

        }


        /* =====================================================
           SEÇÃO
        ===================================================== */

        .form-section {

            margin-bottom: 24px;

        }


        .section-label {

            display: flex;

            align-items: center;

            gap: 9px;

            color:
                var(--roxo-claro);

            font-size: 15px;

            font-weight: 600;

            margin-bottom: 15px;

        }


        .section-label svg {

            width: 19px;

            height: 19px;

        }


        /* =====================================================
           GRUPO
        ===================================================== */

        .form-group {

            margin-bottom: 16px;

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
                0 15px
                0 45px;

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
                rgba(166,92,255,.08);

        }


        /* =====================================================
           BOTÃO SENHA
        ===================================================== */

        .password-toggle {

            position: absolute;

            right: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            border: none;

            background: transparent;

            color:
                var(--cinza);

            cursor: pointer;

            padding: 5px;

        }


        .password-toggle:hover {

            color:
                var(--roxo-claro);

        }


        .password-toggle svg {

            width: 19px;

            height: 19px;

        }


        /* =====================================================
           ÁREA PROTEGIDA
        ===================================================== */

        #areaProtegida {

            display: block;

        }


        /* =====================================================
           ÁREA RESPONSÁVEL
        ===================================================== */

        #areaResponsavel {

            display: none;

        }


        /* =====================================================
           CARD DE INFORMAÇÃO
        ===================================================== */

        .info-card {

            padding: 18px;

            border:
                1px solid
                rgba(166,92,255,.22);

            border-radius: 18px;

            background:
                rgba(166,92,255,.045);

            margin-bottom: 20px;

        }


        .info-content {

            display: flex;

            align-items: flex-start;

            gap: 10px;

        }


        .info-content svg {

            width: 20px;

            height: 20px;

            min-width: 20px;

            color:
                var(--roxo-claro);

            margin-top: 1px;

        }


        .info-content p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.5;

        }


        /* =====================================================
           CONTATO DE EMERGÊNCIA
        ===================================================== */

        .emergency-card {

            padding: 18px;

            border:
                1px solid
                rgba(166,92,255,.22);

            border-radius: 18px;

            background:
                rgba(166,92,255,.045);

            margin-bottom: 10px;

        }


        .emergency-info {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            margin-bottom: 17px;

        }


        .emergency-info svg {

            width: 20px;

            height: 20px;

            min-width: 20px;

            color:
                var(--roxo-claro);

            margin-top: 1px;

        }


        .emergency-info p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.5;

        }


        /* =====================================================
           TERMOS
        ===================================================== */

        .terms {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            margin:
                8px 0 20px;

        }


        .terms input {

            width: 18px;

            height: 18px;

            min-width: 18px;

            margin-top: 1px;

            accent-color:
                var(--roxo);

            cursor: pointer;

        }


        .terms label {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.5;

            cursor: pointer;

        }


        .terms a {

            color:
                var(--roxo-claro);

            text-decoration: none;

        }


        .terms a:hover {

            text-decoration: underline;

        }


        /* =====================================================
           BOTÃO CADASTRAR
        ===================================================== */

        .register-button {

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
                rgba(166,92,255,.12);

        }


        .register-button:hover {

            transform:
                translateY(-2px);

            box-shadow:

                0 12px 30px
                rgba(166,92,255,.23);

        }


        .register-button:active {

            transform:
                translateY(0);

        }


        /* =====================================================
           LOGIN
        ===================================================== */

        .login {

            text-align: center;

            margin-top: 23px;

            color:
                var(--cinza);

            font-size: 13px;

        }


        .login a {

            color:
                var(--roxo-claro);

            font-weight: 600;

            text-decoration: none;

        }


        .login a:hover {

            text-decoration: underline;

        }


        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security {

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 7px;

            margin-top: 20px;

            color:
                var(--cinza-escuro);

            font-size: 11px;

            text-align: center;

        }


        .security svg {

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
                min(
                    calc(100% - 30px),
                    450px
                );

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


            .logo {

                margin-bottom: 20px;

            }


            .register-card {

                padding:
                    23px 18px;

                border-radius:
                    23px;

            }


            .card-header h1 {

                font-size: 24px;

            }


            .card-header {

                margin-bottom: 23px;

            }


            .form-group input {

                height: 48px;

            }

        }


        @media (max-width: 430px) {

            .type-options {

                grid-template-columns: 1fr;

            }


            .type-card {

                min-height: 105px;

            }

        }


        @media (max-width: 380px) {

            .logo-text {

                font-size: 22px;

            }


            .register-card {

                padding:
                    20px 15px;

            }

        }

    </style>

</head>


<body>


<div class="container">


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
                    d="M20.8 8.7
                       C20.8 13.8
                       12 20
                       12 20
                       S3.2 13.8
                       3.2 8.7
                       C3.2 5.9
                       5.4 4
                       8 4
                       C9.7 4
                       11.1 4.9
                       12 6.2
                       C12.9 4.9
                       14.3 4
                       16 4
                       C18.6 4
                       20.8 5.9
                       20.8 8.7Z"
                />

            </svg>

        </div>


        <div class="logo-text">

            Silent<span>Help</span>

        </div>

    </div>



    <!-- =================================================
         CARD
    ================================================== -->

    <main class="register-card">


        <!-- CABEÇALHO -->

        <header class="card-header">

            <h1>
                Criar sua conta
            </h1>

            <p>
                Escolha como você participará do
                sistema SilentHelp.
            </p>

        </header>



        <!-- =================================================
             TIPO DE CONTA
        ================================================== -->

        <section class="account-type">

            <div class="account-title">

                Como você deseja se cadastrar?

            </div>


            <div class="type-options">


                <!-- PESSOA PROTEGIDA -->

                <label class="type-option">

                    <input
                        type="radio"
                        name="tipoConta"
                        value="protegida"
                        checked
                        onchange="alterarTipoConta()"
                    >


                    <div class="type-card">

                        <div class="type-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    d="M12 3
                                       l8 3v5
                                       c0 5.2-3.4 8.7-8 10
                                       c-4.6-1.3-8-4.8-8-10V6l8-3Z"
                                />

                                <path
                                    d="M8.5 12
                                       l2.3 2.3
                                       4.5-5"
                                />

                            </svg>

                        </div>

                        <strong>
                            Pessoa protegida
                        </strong>

                        <small>
                            Quero utilizar o SilentHelp
                            para minha segurança.
                        </small>

                    </div>

                </label>



                <!-- RESPONSÁVEL -->

                <label class="type-option">

                    <input
                        type="radio"
                        name="tipoConta"
                        value="responsavel"
                        onchange="alterarTipoConta()"
                    >


                    <div class="type-card">

                        <div class="type-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <circle
                                    cx="9"
                                    cy="8"
                                    r="3"
                                />

                                <circle
                                    cx="17"
                                    cy="9"
                                    r="2.5"
                                />

                                <path
                                    d="M3 20
                                       c0-3.5 2.7-6 6-6
                                       s6 2.5 6 6"
                                />

                                <path
                                    d="M15 14
                                       c3 0 5 2 5 5"
                                />

                            </svg>

                        </div>

                        <strong>
                            Responsável
                        </strong>

                        <small>
                            Quero receber alertas e
                            ajudar uma pessoa protegida.
                        </small>

                    </div>

                </label>

            </div>

        </section>



        <!-- =================================================
             DADOS PESSOAIS
        ================================================== -->

        <section class="form-section">


            <div class="section-label">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <circle
                        cx="12"
                        cy="8"
                        r="4"
                    />

                    <path
                        d="M4 21c0-4 3.5-7 8-7s8 3 8 7"
                    />

                </svg>

                Dados pessoais

            </div>



            <!-- NOME -->

            <div class="form-group">

                <label for="nome">
                    Nome completo
                </label>


                <div class="input-wrapper">

                    <span class="input-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle
                                cx="12"
                                cy="8"
                                r="4"
                            />

                            <path
                                d="M4 21c0-4 3.5-7 8-7s8 3 8 7"
                            />

                        </svg>

                    </span>


                    <input
                        type="text"
                        id="nome"
                        placeholder="Digite seu nome completo"
                        autocomplete="name"
                        required
                    >

                </div>

            </div>



            <!-- EMAIL -->

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



            <!-- TELEFONE -->

            <div class="form-group">

                <label for="telefone">
                    Telefone
                </label>


                <div class="input-wrapper">

                    <span class="input-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M6.5 3h3l1.5 5-2 1.5
                                   a14 14 0 0 0 5.5 5.5
                                   l1.5-2 5 1.5v3
                                   c0 1.1-.9 2-2 2
                                   C10.7 19.5 4.5 13.3
                                   4.5 5c0-1.1.9-2 2-2Z"
                            />

                        </svg>

                    </span>


                    <input
                        type="tel"
                        id="telefone"
                        placeholder="(00) 00000-0000"
                        autocomplete="tel"
                        maxlength="15"
                        required
                    >

                </div>

            </div>

        </section>



        <!-- =================================================
             SEGURANÇA DA CONTA
        ================================================== -->

        <section class="form-section">


            <div class="section-label">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <rect
                        x="4"
                        y="10"
                        width="16"
                        height="11"
                        rx="2"
                    />

                    <path
                        d="M8 10V7a4 4 0 0 1 8 0v3"
                    />

                </svg>

                Segurança da conta

            </div>



            <!-- SENHA -->

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
                                x="4"
                                y="10"
                                width="16"
                                height="11"
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
                        placeholder="Crie uma senha"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="password-toggle"
                        onclick="alternarSenha('senha', this)"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M2 12s3.5-6 10-6
                                   10 6 10 6
                                   -3.5 6-10 6
                                   -10-6-10-6Z"
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



            <!-- CONFIRMAR SENHA -->

            <div class="form-group">

                <label for="confirmarSenha">
                    Confirmar senha
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
                                x="4"
                                y="10"
                                width="16"
                                height="11"
                                rx="2"
                            />

                            <path
                                d="M8 10V7a4 4 0 0 1 8 0v3"
                            />

                        </svg>

                    </span>


                    <input
                        type="password"
                        id="confirmarSenha"
                        placeholder="Digite a senha novamente"
                        autocomplete="new-password"
                        required
                    >


                    <button
                        type="button"
                        class="password-toggle"
                        onclick="alternarSenha('confirmarSenha', this)"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M2 12s3.5-6 10-6
                                   10 6 10 6
                                   -3.5 6-10 6
                                   -10-6-10-6Z"
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

        </section>



        <!-- =================================================
             ÁREA DA PESSOA PROTEGIDA
        ================================================== -->

        <div id="areaProtegida">


            <section class="form-section">


                <div class="section-label">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 3
                               l8 3v5
                               c0 5.2-3.4 8.7-8 10
                               c-4.6-1.3-8-4.8-8-10V6l8-3Z"
                        />

                        <path
                            d="M12 8v4"
                        />

                        <circle
                            cx="12"
                            cy="15.5"
                            r=".8"
                            fill="currentColor"
                            stroke="none"
                        />

                    </svg>

                    Contato de emergência

                </div>


                <div class="emergency-card">


                    <div class="emergency-info">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                d="M12 8v4"
                            />

                            <circle
                                cx="12"
                                cy="16"
                                r=".8"
                                fill="currentColor"
                                stroke="none"
                            />

                        </svg>


                        <p>

                            Cadastre uma pessoa de confiança
                            que poderá receber os alertas
                            de segurança enviados pelo
                            SilentHelp.

                        </p>

                    </div>



                    <!-- NOME CONTATO -->

                    <div class="form-group">

                        <label for="contatoEmergencia">
                            Nome do contato
                        </label>


                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >

                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="4"
                                    />

                                    <path
                                        d="M4 21c0-4 3.5-7 8-7s8 3 8 7"
                                    />

                                </svg>

                            </span>


                            <input
                                type="text"
                                id="contatoEmergencia"
                                placeholder="Ex.: Maria Silva"
                            >

                        </div>

                    </div>



                    <!-- TELEFONE CONTATO -->

                    <div class="form-group">

                        <label for="telefoneEmergencia">
                            Telefone do contato
                        </label>


                        <div class="input-wrapper">

                            <span class="input-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >

                                    <path
                                        d="M6.5 3h3l1.5 5-2 1.5
                                           a14 14 0 0 0 5.5 5.5
                                           l1.5-2 5 1.5v3
                                           c0 1.1-.9 2-2 2
                                           C10.7 19.5 4.5 13.3
                                           4.5 5c0-1.1.9-2 2-2Z"
                                    />

                                </svg>

                            </span>


                            <input
                                type="tel"
                                id="telefoneEmergencia"
                                placeholder="(00) 00000-0000"
                                maxlength="15"
                            >

                        </div>

                    </div>

                </div>

            </section>


        </div>



        <!-- =================================================
             ÁREA DO RESPONSÁVEL
        ================================================== -->

        <div id="areaResponsavel">


            <section class="form-section">


                <div class="section-label">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <circle
                            cx="9"
                            cy="8"
                            r="3"
                        />

                        <circle
                            cx="17"
                            cy="9"
                            r="2.5"
                        />

                        <path
                            d="M3 20
                               c0-3.5 2.7-6 6-6
                               s6 2.5 6 6"
                        />

                        <path
                            d="M15 14
                               c3 0 5 2 5 5"
                        />

                    </svg>

                    Vínculo de responsável

                </div>


                <div class="info-card">

                    <div class="info-content">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                d="M12 11v5"
                            />

                            <circle
                                cx="12"
                                cy="7.5"
                                r=".8"
                                fill="currentColor"
                                stroke="none"
                            />

                        </svg>


                        <p>

                            Para ser responsável, você deverá
                            estar vinculado a uma pessoa que
                            utiliza o SilentHelp. Utilize o
                            código de convite fornecido por ela.

                        </p>

                    </div>

                </div>



                <!-- CÓDIGO -->

                <div class="form-group">

                    <label for="codigoConvite">

                        Código de convite

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
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="14"
                                    rx="2"
                                />

                                <path
                                    d="M8 9h8M8 13h5"
                                />

                            </svg>

                        </span>


                        <input
                            type="text"
                            id="codigoConvite"
                            placeholder="Ex.: SH-8F4K2"
                            maxlength="12"
                        >

                    </div>

                </div>


                <!-- RELAÇÃO -->

                <div class="form-group">

                    <label for="relacao">

                        Relação com a pessoa

                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    d="M12 21
                                       s-7-4.5-7-10
                                       a4 4 0 0 1
                                       7-2.5
                                       A4 4 0 0 1
                                       19 11
                                       c0 5.5-7 10-7 10Z"
                                />

                            </svg>

                        </span>


                        <input
                            type="text"
                            id="relacao"
                            placeholder="Ex.: Mãe, irmã, amiga..."
                        >

                    </div>

                </div>

            </section>


        </div>



        <!-- =================================================
             TERMOS
        ================================================== -->

        <div class="terms">

            <input
                type="checkbox"
                id="termos"
            >


            <label for="termos">

                Li e concordo com os

                <a
                    href="#"
                    onclick="mostrarTermos(event)"
                >
                    termos de uso
                </a>

                e a política de privacidade
                do SilentHelp.

            </label>

        </div>



        <!-- =================================================
             BOTÃO
        ================================================== -->

        <button
            type="button"
            class="register-button"
            onclick="cadastrar()"
        >

            Criar minha conta

        </button>



        <!-- =================================================
             LOGIN
        ================================================== -->

        <div class="login">

            Já possui uma conta?

            <a href="login.php">
                Entrar
            </a>

        </div>



        <!-- =================================================
             SEGURANÇA
        ================================================== -->

        <div class="security">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="M12 3
                       l8 3v5
                       c0 5.2-3.4 8.7-8 10
                       c-4.6-1.3-8-4.8-8-10V6l8-3Z"
                />

                <path
                    d="M8.5 12l2.3 2.3
                       4.5-5"
                />

            </svg>

            Seus dados são utilizados para
            a segurança da conta.

        </div>


    </main>

</div>



<!-- =====================================================
     TOAST
====================================================== -->

<div
    id="toast"
    class="toast"
></div>



<script>


    /* =====================================================
       ALTERAR TIPO DE CONTA
    ===================================================== */

    function alterarTipoConta() {

        const tipo =
            document.querySelector(
                'input[name="tipoConta"]:checked'
            ).value;


        const areaProtegida =
            document.getElementById(
                "areaProtegida"
            );


        const areaResponsavel =
            document.getElementById(
                "areaResponsavel"
            );


        if (tipo === "protegida") {

            areaProtegida.style.display =
                "block";

            areaResponsavel.style.display =
                "none";

        }

        else {

            areaProtegida.style.display =
                "none";

            areaResponsavel.style.display =
                "block";

        }

    }



    /* =====================================================
       MÁSCARA DE TELEFONE
    ===================================================== */

    function aplicarMascaraTelefone(input) {

        input.addEventListener(
            "input",
            function () {

                let valor =
                    input.value.replace(
                        /\D/g,
                        ""
                    );


                if (valor.length > 11) {

                    valor =
                        valor.substring(
                            0,
                            11
                        );

                }


                if (valor.length > 6) {

                    valor =
                        valor.replace(
                            /^(\d{2})(\d{5})(\d{0,4}).*/,
                            "($1) $2-$3"
                        );

                }

                else if (valor.length > 2) {

                    valor =
                        valor.replace(
                            /^(\d{2})(\d{0,5})/,
                            "($1) $2"
                        );

                }

                else {

                    valor =
                        valor.replace(
                            /^(\d*)/,
                            "($1"
                        );

                }


                input.value = valor;

            }
        );

    }



    aplicarMascaraTelefone(
        document.getElementById(
            "telefone"
        )
    );


    aplicarMascaraTelefone(
        document.getElementById(
            "telefoneEmergencia"
        )
    );



    /* =====================================================
       MOSTRAR / OCULTAR SENHA
    ===================================================== */

    function alternarSenha(
        id,
        botao
    ) {

        const campo =
            document.getElementById(id);


        if (
            campo.type ===
            "password"
        ) {

            campo.type =
                "text";


            botao.innerHTML = `

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <path d="M3 3l18 18"/>

                    <path
                        d="M10.6 10.6
                           a2 2 0 0 0
                           2.8 2.8"
                    />

                    <path
                        d="M9.9 5.2
                           A10.6 10.6 0 0 1
                           12 5
                           c6.5 0
                           10 7
                           10 7"
                    />

                </svg>

            `;

        }

        else {

            campo.type =
                "password";


            botao.innerHTML = `

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <path
                        d="M2 12s3.5-6 10-6
                           10 6 10 6
                           -3.5 6-10 6
                           -10-6-10-6Z"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="3"
                    />

                </svg>

            `;

        }

    }



    /* =====================================================
       CADASTRO
    ===================================================== */

    async function cadastrar() {

        const nome = document.getElementById("nome").value.trim();
        const email = document.getElementById("email").value.trim().toLowerCase();
        const telefone = document.getElementById("telefone").value.trim();
        const senha = document.getElementById("senha").value;
        const confirmarSenha = document.getElementById("confirmarSenha").value;
        const termos = document.getElementById("termos").checked;
        const tipo = document.querySelector('input[name="tipoConta"]:checked')?.value || 'protegida';

        if (!nome || !email || !telefone || !senha || !confirmarSenha) {
            mostrarToast("Preencha todos os campos obrigatórios.", "error"); return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            mostrarToast("Digite um e-mail válido.", "error"); return;
        }
        if (senha.length < 6) { mostrarToast("A senha deve ter pelo menos 6 caracteres.", "error"); return; }
        if (senha !== confirmarSenha) { mostrarToast("As senhas não coincidem.", "error"); return; }
        if (!termos) { mostrarToast("Você precisa aceitar os termos de uso.", "error"); return; }

        const dados = {nome,email,telefone,senha,tipo};
        if (tipo === 'protegida') {
            dados.contatoEmergencia = document.getElementById("contatoEmergencia")?.value.trim() || '';
            dados.telefoneEmergencia = document.getElementById("telefoneEmergencia")?.value.trim() || '';
            if (!dados.contatoEmergencia || !dados.telefoneEmergencia) {
                mostrarToast("Preencha os dados do contato de emergência.", "error"); return;
            }
        } else {
            dados.codigoConvite = document.getElementById("codigoConvite")?.value.trim().toUpperCase() || '';
            dados.relacao = document.getElementById("relacao")?.value.trim() || '';
            if (!dados.codigoConvite || !dados.relacao) {
                mostrarToast("Informe o código de convite e sua relação.", "error"); return;
            }
        }

        const resposta = await window.SilentHelpAPI.post('register', dados);
        if (!resposta.ok) { mostrarToast(resposta.message || "Não foi possível criar a conta.", "error"); return; }

        sessionStorage.setItem("silenthelp_logado", "true");
        sessionStorage.setItem("silenthelp_usuario", JSON.stringify(resposta.user));
        localStorage.setItem("silenthelp_usuario", JSON.stringify(resposta.user));
        mostrarToast("Conta criada com sucesso!", "success");
        setTimeout(() => window.location.href = tipo === 'responsavel' ? 'responsavel.php' : 'index.php', 1200);
    }


    /* =====================================================
       TERMOS
    ===================================================== */

    function mostrarTermos(event) {

        event.preventDefault();


        mostrarToast(
            "Os termos de uso serão apresentados nesta seção."
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
       CÓDIGO DE CONVITE
    ===================================================== */

    document
        .getElementById("codigoConvite")
        .addEventListener(
            "input",
            function () {

                this.value =
                    this.value
                        .toUpperCase()
                        .replace(
                            /[^A-Z0-9-]/g,
                            ""
                        );

            }
        );

</script>


<script src="assets/db-sync.js"></script>
</body>

</html>