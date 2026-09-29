<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Contatos de Confiança</title>

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

            --fundo-card: #101015;
            --fundo-card-2: #15151c;

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

            background:

                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, .15),
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

            overflow-x: hidden;

        }


        button,
        input,
        select {

            font-family: inherit;

        }


        button {

            -webkit-tap-highlight-color: transparent;

        }


        /* =====================================================
           APP
        ===================================================== */

        .app {

            width: 100%;

            max-width: 900px;

            margin: auto;

            padding:
                25px
                25px
                155px;

        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 28px;

        }


        .back-button {

            width: 48px;
            height: 48px;

            min-width: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                var(--fundo-card);

            color:
                var(--roxo-claro);

            cursor: pointer;

            transition: .2s;

        }


        .back-button:hover {

            background:
                rgba(166, 92, 255, .12);

            border-color:
                var(--roxo);

            transform:
                translateX(-2px);

        }


        .back-button svg {

            width: 25px;
            height: 25px;

        }


        .header-text {

            min-width: 0;

        }


        .header-text h1 {

            font-size: 30px;

            font-weight: 600;

            margin-bottom: 5px;

        }


        .header-text p {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.5;

        }


        /* =====================================================
           CARD INTRODUÇÃO
        ===================================================== */

        .intro-card {

            padding: 25px;

            margin-bottom: 22px;

            border:
                1px solid
                rgba(166, 92, 255, .25);

            border-radius: 23px;

            background:

                linear-gradient(
                    145deg,
                    #17121d,
                    #0b0b10
                );

        }


        .intro-top {

            display: flex;

            align-items: flex-start;

            gap: 15px;

        }


        .intro-icon {

            width: 55px;
            height: 55px;

            min-width: 55px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background:
                rgba(166, 92, 255, .13);

            color:
                var(--roxo-claro);

        }


        .intro-icon svg {

            width: 29px;
            height: 29px;

        }


        .intro-text h2 {

            font-size: 20px;

            font-weight: 600;

            margin-bottom: 7px;

        }


        .intro-text p {

            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.6;

        }


        /* =====================================================
           AVISO
        ===================================================== */

        .security-info {

            display: flex;

            align-items: flex-start;

            gap: 13px;

            padding: 17px;

            margin-bottom: 25px;

            border:
                1px solid
                rgba(166, 92, 255, .23);

            border-radius: 18px;

            background:
                rgba(166, 92, 255, .06);

        }


        .security-info-icon {

            width: 40px;
            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

        }


        .security-info-icon svg {

            width: 21px;
            height: 21px;

        }


        .security-info h3 {

            font-size: 14px;

            margin-bottom: 4px;

        }


        .security-info p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.6;

        }


        /* =====================================================
           TÍTULO DA LISTA
        ===================================================== */

        .section-title {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 13px;

        }


        .section-title h2 {

            color:
                var(--roxo-claro);

            font-size: 18px;

            font-weight: 500;

        }


        /* =====================================================
           BOTÃO ADICIONAR
        ===================================================== */

        .add-button {

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            padding:
                10px 15px;

            border: none;

            border-radius: 12px;

            background:
                var(--roxo);

            color:
                white;

            font-size: 12px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

        }


        .add-button:hover {

            background:
                var(--roxo-escuro);

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 20px
                rgba(166, 92, 255, .18);

        }


        .add-button svg {

            width: 17px;
            height: 17px;

        }


        /* =====================================================
           CARD DOS CONTATOS
        ===================================================== */

        .contacts-card {

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:

                linear-gradient(
                    145deg,
                    #111116,
                    #0b0b10
                );

        }


        /* =====================================================
           CONTATO
        ===================================================== */

        .contact {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 18px;

            border-bottom:
                1px solid
                rgba(255,255,255,.05);

            transition: .2s;

        }


        .contact:last-child {

            border-bottom: none;

        }


        .contact:hover {

            background:
                rgba(166, 92, 255, .05);

        }


        /* =====================================================
           AVATAR
        ===================================================== */

        .contact-avatar {

            width: 52px;
            height: 52px;

            min-width: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background:
                rgba(166, 92, 255, .13);

            color:
                var(--roxo-claro);

            font-size: 18px;

            font-weight: 600;

        }


        /* =====================================================
           INFORMAÇÕES
        ===================================================== */

        .contact-info {

            flex: 1;

            min-width: 0;

        }


        .contact-info h3 {

            font-size: 15px;

            font-weight: 500;

            margin-bottom: 5px;

            word-break: break-word;

        }


        .contact-info p {

            color:
                var(--cinza);

            font-size: 12px;

            margin-bottom: 6px;

        }


        .contact-type {

            display: inline-block;

            padding:
                4px 8px;

            border-radius: 8px;

            background:
                rgba(85, 223, 145, .09);

            color:
                var(--verde);

            font-size: 10px;

        }


        /* =====================================================
           CONTATO PRINCIPAL
        ===================================================== */

        .principal-badge {

            display: inline-flex;

            align-items: center;

            gap: 4px;

            margin-left: 5px;

            padding:
                3px 7px;

            border-radius: 7px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

            font-size: 9px;

        }


        /* =====================================================
           AÇÕES
        ===================================================== */

        .contact-actions {

            display: flex;

            align-items: center;

            gap: 7px;

        }


        .action-button {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                transparent;

            color:
                var(--cinza);

            cursor: pointer;

            transition: .2s;

        }


        .action-button:hover {

            color:
                var(--roxo-claro);

            border-color:
                var(--roxo);

            background:
                rgba(166, 92, 255, .08);

        }


        .action-button.delete:hover {

            color:
                var(--vermelho);

            border-color:
                var(--vermelho);

            background:
                rgba(255, 92, 112, .08);

        }


        .action-button svg {

            width: 18px;
            height: 18px;

        }


        /* =====================================================
           ESTADO VAZIO
        ===================================================== */

        .empty {

            display: none;

            text-align: center;

            padding: 45px 20px;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:
                #101015;

        }


        .empty.show {

            display: block;

        }


        .empty svg {

            width: 45px;
            height: 45px;

            margin-bottom: 12px;

            color:
                var(--roxo-claro);

        }


        .empty h3 {

            font-size: 16px;

            margin-bottom: 7px;

        }


        .empty p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.5;

        }


        /* =====================================================
           PRIVACIDADE
        ===================================================== */

        .privacy-info {

            display: flex;

            align-items: flex-start;

            gap: 9px;

            margin-top: 17px;

            color:
                var(--cinza);

            font-size: 11px;

            line-height: 1.5;

        }


        .privacy-info svg {

            width: 17px;
            height: 17px;

            min-width: 17px;

            color:
                var(--roxo-claro);

        }


        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security-card {

            display: flex;

            align-items: flex-start;

            gap: 14px;

            padding: 20px;

            margin-top: 25px;

            border:
                1px solid
                rgba(85, 223, 145, .18);

            border-radius: 20px;

            background:
                rgba(85, 223, 145, .05);

        }


        .security-icon {

            width: 45px;
            height: 45px;

            min-width: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                rgba(85, 223, 145, .10);

            color:
                var(--verde);

        }


        .security-icon svg {

            width: 23px;
            height: 23px;

        }


        .security-text h3 {

            font-size: 14px;

            font-weight: 500;

            margin-bottom: 5px;

        }


        .security-text p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.6;

        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal {

            position: fixed;

            inset: 0;

            display: none;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background:
                rgba(0,0,0,.72);

            backdrop-filter:
                blur(8px);

            -webkit-backdrop-filter:
                blur(8px);

            z-index: 3000;

        }


        .modal.show {

            display: flex;

        }


        .modal-card {

            width: 100%;

            max-width: 440px;

            padding: 25px;

            border:
                1px solid
                var(--borda);

            border-radius: 24px;

            background:

                linear-gradient(
                    145deg,
                    #15151c,
                    #0d0d12
                );

            box-shadow:
                0 25px 70px
                rgba(0,0,0,.45);

            animation:
                modalEntrada .2s ease;

        }


        @keyframes modalEntrada {

            from {

                opacity: 0;

                transform:
                    translateY(15px)
                    scale(.98);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

            }

        }


        /* =====================================================
           MODAL HEADER
        ===================================================== */

        .modal-header {

            display: flex;

            align-items: center;
            justify-content: space-between;

            margin-bottom: 22px;

        }


        .modal-header h2 {

            font-size: 20px;

            font-weight: 600;

        }


        .close-button {

            width: 36px;
            height: 36px;

            border: none;

            border-radius: 10px;

            background:
                rgba(255,255,255,.05);

            color:
                var(--cinza);

            font-size: 20px;

            cursor: pointer;

        }


        .close-button:hover {

            color: white;

            background:
                rgba(255,255,255,.1);

        }


        /* =====================================================
           FORMULÁRIO
        ===================================================== */

        .form-group {

            margin-bottom: 17px;

        }


        .form-group label {

            display: block;

            margin-bottom: 7px;

            color:
                var(--cinza);

            font-size: 12px;

        }


        .form-group input,
        .form-group select {

            width: 100%;

            height: 50px;

            padding:
                0 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            outline: none;

            background:
                #0b0b10;

            color:
                white;

            font-size: 14px;

        }


        .form-group input::placeholder {

            color:
                #60606a;

        }


        .form-group input:focus,
        .form-group select:focus {

            border-color:
                var(--roxo);

            box-shadow:
                0 0 0 3px
                rgba(166,92,255,.08);

        }


        .form-group select {

            cursor: pointer;

        }


        .form-group select option {

            background:
                #101015;

            color:
                white;

        }


        /* =====================================================
           BOTÕES DO MODAL
        ===================================================== */

        .modal-actions {

            display: flex;

            gap: 10px;

            margin-top: 5px;

        }


        .save-button {

            flex: 1;

            height: 50px;

            border: none;

            border-radius: 13px;

            background:

                linear-gradient(
                    135deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            color:
                white;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

        }


        .save-button:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 8px 25px
                rgba(166,92,255,.20);

        }


        .cancel-button {

            height: 50px;

            padding:
                0 18px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            background:
                transparent;

            color:
                var(--cinza);

            cursor: pointer;

        }


        .cancel-button:hover {

            color: white;

            border-color:
                var(--cinza);

        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 130px;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            z-index: 5000;

            padding:
                14px 20px;

            border-radius: 14px;

            background:
                #18181f;

            border:
                1px solid
                var(--roxo);

            color:
                white;

            transition: .3s;

            text-align: center;

            max-width: 90%;

        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);

        }


        /* =====================================================
           MENU INFERIOR
        ===================================================== */

        .bottom-nav {

            position: fixed;

            left: 50%;

            bottom: 15px;

            transform:
                translateX(-50%);

            width:
                min(
                    calc(100% - 30px),
                    850px
                );

            height: 100px;

            display: grid;

            grid-template-columns:
                repeat(5, 1fr);

            background:
                rgba(18,18,22,.97);

            border:
                1px solid
                rgba(255,255,255,.07);

            border-radius: 28px;

            backdrop-filter:
                blur(15px);

            -webkit-backdrop-filter:
                blur(15px);

            z-index: 1000;

        }


        .nav-button {

            display: flex;

            flex-direction: column;

            justify-content: center;
            align-items: center;

            gap: 7px;

            border: none;

            background:
                transparent;

            color:
                #85858e;

            cursor: pointer;

            font-size: 15px;

            transition: .2s;

        }


        .nav-button svg {

            width: 31px;
            height: 31px;

        }


        .nav-button.active,
        .nav-button:hover {

            color:
                var(--roxo-claro);

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .app {

                padding:
                    18px
                    15px
                    120px;

            }


            .header {

                gap: 12px;

            }


            .header-text h1 {

                font-size: 26px;

            }


            .header-text p {

                font-size: 13px;

            }


            .back-button {

                width: 43px;
                height: 43px;

                min-width: 43px;

            }


            .intro-card {

                padding: 20px;

            }


            .security-info {

                padding: 14px;

            }


            .contact {

                padding: 14px;

                gap: 10px;

            }


            .contact-avatar {

                width: 44px;
                height: 44px;

                min-width: 44px;

                border-radius: 13px;

                font-size: 15px;

            }


            .contact-info h3 {

                font-size: 13px;

            }


            .contact-info p {

                font-size: 11px;

            }


            .action-button {

                width: 34px;
                height: 34px;

            }


            .bottom-nav {

                height: 82px;

                bottom: 10px;

                width:
                    calc(100% - 20px);

                border-radius: 24px;

            }


            .nav-button {

                font-size: 12px;

                gap: 5px;

            }


            .nav-button svg {

                width: 25px;
                height: 25px;

            }

        }


        @media (max-width: 480px) {

            .section-title {

                align-items: flex-start;

            }


            .section-title h2 {

                font-size: 16px;

            }


            .add-button {

                padding:
                    9px 11px;

            }


            .add-button span {

                display: none;

            }


            .contact {

                align-items: flex-start;

            }


            .contact-actions {

                flex-direction: column;

            }


            .modal-card {

                padding: 20px;

            }


            .modal-actions {

                flex-direction: column;

            }


            .cancel-button {

                width: 100%;

            }

        }


        @media (max-width: 360px) {

            .nav-button {

                font-size: 10px;

            }


            .nav-button svg {

                width: 23px;
                height: 23px;

            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

    <main class="app">


        <!-- =================================================
             CABEÇALHO
        ================================================== -->

        <header class="header">

            <button
                class="back-button"
                id="backButton"
                aria-label="Voltar"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M19 12H5"/>

                    <path d="M12 19l-7-7 7-7"/>

                </svg>

            </button>


            <div class="header-text">

                <h1>
                    Contatos de confiança
                </h1>

                <p>
                    Cadastre quem poderá receber seu alerta de segurança.
                </p>

            </div>

        </header>


        <!-- =================================================
             INTRODUÇÃO
        ================================================== -->

        <section class="intro-card">

            <div class="intro-top">

                <div class="intro-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
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

                </div>


                <div class="intro-text">

                    <h2>
                        Pessoas de confiança
                    </h2>

                    <p>
                        Cadastre pessoas que você confia para
                        facilitar o contato durante uma situação
                        de emergência ou quando um alerta de
                        segurança for acionado.
                    </p>

                </div>

            </div>

        </section>


        <!-- =================================================
             AVISO
        ================================================== -->

        <section class="security-info">

            <div class="security-info-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                    />

                    <path d="M10 21h4"/>

                </svg>

            </div>


            <div>

                <h3>
                    Como funciona?
                </h3>

                <p>
                    Quando um alerta de segurança for acionado,
                    os contatos cadastrados poderão ser utilizados
                    pelo sistema para comunicação.
                </p>

            </div>

        </section>


        <!-- =================================================
             TÍTULO DA LISTA
        ================================================== -->

        <div class="section-title">

            <h2>
                Meus contatos
            </h2>


            <button
                class="add-button"
                id="addButton"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                >

                    <path d="M12 5v14"/>

                    <path d="M5 12h14"/>

                </svg>

                <span>
                    Adicionar contato
                </span>

            </button>

        </div>


        <!-- =================================================
             LISTA
        ================================================== -->

        <section
            class="contacts-card"
            id="contactsCard"
        >

        </section>


        <!-- =================================================
             ESTADO VAZIO
        ================================================== -->

        <div
            class="empty"
            id="emptyContacts"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round"
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


            <h3>
                Nenhum contato cadastrado
            </h3>


            <p>
                Adicione uma pessoa de confiança
                para situações de emergência.
            </p>

        </div>


        <!-- =================================================
             PRIVACIDADE
        ================================================== -->

        <div class="privacy-info">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <path
                    d="M12 3l8 3v5c0 5.2-3.4 8.7-8 10-4.6-1.3-8-4.8-8-10V6l8-3Z"
                />

                <rect
                    x="9"
                    y="10"
                    width="6"
                    height="5"
                    rx="1"
                />

                <path
                    d="M10 10V8a2 2 0 0 1 4 0v2"
                />

            </svg>


            <span>
                Os contatos são armazenados localmente neste
                navegador. Em uma versão conectada a um servidor,
                essas informações deverão ser protegidas
                adequadamente.
            </span>

        </div>


        <!-- =================================================
             SEGURANÇA
        ================================================== -->

        <section class="security-card">

            <div class="security-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path
                        d="M12 3l8 3v5c0 5.2-3.4 8.7-8 10-4.6-1.3-8-4.8-8-10V6l8-3Z"
                    />

                    <path
                        d="M8.5 12l2.3 2.3 4.9-5"
                    />

                </svg>

            </div>


            <div class="security-text">

                <h3>
                    Sua segurança é prioridade
                </h3>

                <p>
                    Utilize apenas contatos de pessoas em quem
                    você realmente confia. Eles serão utilizados
                    para as funções de segurança autorizadas
                    dentro do SilentHelp.
                </p>

            </div>

        </section>


    </main>


    <!-- =====================================================
         MODAL
    ====================================================== -->

    <div
        class="modal"
        id="modal"
    >

        <div class="modal-card">


            <div class="modal-header">

                <h2 id="modalTitle">
                    Novo contato
                </h2>


                <button
                    class="close-button"
                    id="closeButton"
                    aria-label="Fechar"
                >
                    ×
                </button>

            </div>


            <form
                id="contactForm"
            >


                <!-- NOME -->

                <div class="form-group">

                    <label for="nome">
                        Nome
                    </label>

                    <input
                        type="text"
                        id="nome"
                        placeholder="Ex.: Maria Silva"
                        autocomplete="name"
                        maxlength="80"
                        required
                    >

                </div>


                <!-- RELAÇÃO -->

                <div class="form-group">

                    <label for="relacao">
                        Relação
                    </label>

                    <select
                        id="relacao"
                        required
                    >

                        <option value="">
                            Selecione
                        </option>

                        <option value="Mãe">
                            Mãe
                        </option>

                        <option value="Pai">
                            Pai
                        </option>

                        <option value="Irmã">
                            Irmã
                        </option>

                        <option value="Irmão">
                            Irmão
                        </option>

                        <option value="Amiga">
                            Amiga
                        </option>

                        <option value="Amigo">
                            Amigo
                        </option>

                        <option value="Familiar">
                            Familiar
                        </option>

                        <option value="Responsável">
                            Responsável
                        </option>

                        <option value="Pessoa de confiança">
                            Pessoa de confiança
                        </option>

                        <option value="Outro">
                            Outro
                        </option>

                    </select>

                </div>


                <!-- TELEFONE -->

                <div class="form-group">

                    <label for="telefone">
                        Telefone
                    </label>

                    <input
                        type="tel"
                        id="telefone"
                        placeholder="(00) 00000-0000"
                        autocomplete="tel"
                        maxlength="15"
                        required
                    >

                </div>


                <!-- BOTÕES -->

                <div class="modal-actions">

                    <button
                        type="button"
                        class="cancel-button"
                        id="cancelButton"
                    >
                        Cancelar
                    </button>


                    <button
                        type="submit"
                        class="save-button"
                    >
                        Salvar contato
                    </button>

                </div>


            </form>

        </div>

    </div>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>


    <!-- =====================================================
         MENU INFERIOR
    ====================================================== -->

    <nav class="bottom-nav">


        <!-- INÍCIO -->

        <button
            class="nav-button"
            data-page="index.php"
        >

            <svg
                viewBox="0 0 24 24"
                fill="currentColor"
            >

                <path
                    d="M3 10.8L12 3l9 7.8v9.2a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z"
                />

            </svg>

            <span>
                Início
            </span>

        </button>


        <!-- MAPA -->

        <button
            class="nav-button"
            data-page="mapa.php"
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
                    d="M9 18l-6 3V6l6-3 6 3 6-3v15l-6 3-6-3z"
                />

                <path d="M9 3v15"/>

                <path d="M15 6v15"/>

            </svg>

            <span>
                Mapa
            </span>

        </button>


        <!-- HISTÓRICO -->

        <button
            class="nav-button"
            data-page="historico.php"
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
                    d="M6 2h9l5 5v15H6z"
                />

                <path
                    d="M14 2v6h6"
                />

                <circle
                    cx="16"
                    cy="17"
                    r="3"
                />

                <path
                    d="M16 15v2l1 1"
                />

            </svg>

            <span>
                Histórico
            </span>

        </button>


        <!-- CONFIGURAÇÕES -->

        <button
            class="nav-button active"
            data-page="config.php"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >

                <circle
                    cx="12"
                    cy="12"
                    r="3"
                />

                <path
                    d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2 2-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-3v-.8a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-2-2 .1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-.3-1.9 1.7 1.7 0 0 0-1.6-1h-.8v-3h.8a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L6 7.9l2-2 .1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V4h3v.8a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 2 2-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 .3 1.9 1.7 1.7 0 0 0 1.6 1h.8v3h-.8a1.7 1.7 0 0 0-1.6 1z"
                />

            </svg>

            <span>
                Config.
            </span>

        </button>


        <!-- PERFIL -->

        <button
            class="nav-button"
            data-page="perfil.php"
        >

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

            <span>
                Perfil
            </span>

        </button>


    </nav>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =====================================================
           CONFIGURAÇÃO
        ===================================================== */

        const STORAGE_KEY =
            "silenthelp_contatos";


        let contatoEditando = null;

        let toastTimer = null;


        /* =====================================================
           ELEMENTOS
        ===================================================== */

        const modal =
            document.getElementById("modal");

        const contactForm =
            document.getElementById("contactForm");

        const nomeInput =
            document.getElementById("nome");

        const telefoneInput =
            document.getElementById("telefone");

        const relacaoInput =
            document.getElementById("relacao");

        const contactsCard =
            document.getElementById("contactsCard");

        const emptyContacts =
            document.getElementById("emptyContacts");

        const modalTitle =
            document.getElementById("modalTitle");

        const toast =
            document.getElementById("toast");


        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        function abrirPagina(pagina) {

            if (!pagina) {
                return;
            }

            window.location.href = pagina;

        }


        document
            .querySelectorAll(".nav-button")
            .forEach(function(button) {

                button.addEventListener(
                    "click",
                    function() {

                        const pagina =
                            button.dataset.page;

                        abrirPagina(pagina);

                    }
                );

            });


        document
            .getElementById("backButton")
            .addEventListener(
                "click",
                function() {

                    abrirPagina("config.php");

                }
            );


        /* =====================================================
           TOAST
        ===================================================== */

        function mostrarMensagem(mensagem) {

            toast.textContent =
                mensagem;

            toast.classList.add("show");

            clearTimeout(toastTimer);

            toastTimer =
                setTimeout(
                    function() {

                        toast.classList.remove("show");

                    },
                    2500
                );

        }


        /* =====================================================
           LOCAL STORAGE
        ===================================================== */

        function obterContatos() {

            const dados =
                localStorage.getItem(
                    STORAGE_KEY
                );


            if (!dados) {

                return [];

            }


            try {

                const contatos =
                    JSON.parse(dados);


                if (
                    Array.isArray(contatos)
                ) {

                    return contatos;

                }

            } catch (erro) {

                console.error(
                    "Erro ao ler contatos:",
                    erro
                );

            }


            return [];

        }


        function salvarContatos(contatos) {

            try {

                localStorage.setItem(
                    STORAGE_KEY,
                    JSON.stringify(contatos)
                );

                return true;

            } catch (erro) {

                console.error(
                    "Erro ao salvar:",
                    erro
                );

                mostrarMensagem(
                    "Erro ao salvar os contatos."
                );

                return false;

            }

        }


        /* =====================================================
           SEGURANÇA HTML
        ===================================================== */

        function escaparHTML(texto) {

            return String(texto)

                .replace(
                    /&/g,
                    "&amp;"
                )

                .replace(
                    /</g,
                    "&lt;"
                )

                .replace(
                    />/g,
                    "&gt;"
                )

                .replace(
                    /"/g,
                    "&quot;"
                )

                .replace(
                    /'/g,
                    "&#039;"
                );

        }


        /* =====================================================
           FORMATAÇÃO DO TELEFONE
        ===================================================== */

        function limparTelefone(telefone) {

            return String(telefone)
                .replace(/\D/g, "");

        }


        function formatarTelefone(telefone) {

            let numeros =
                limparTelefone(
                    telefone
                )
                .slice(0, 11);


            if (
                numeros.length <= 2
            ) {

                return numeros;

            }


            if (
                numeros.length <= 6
            ) {

                return numeros.replace(
                    /^(\d{2})(\d+)/,
                    "($1) $2"
                );

            }


            if (
                numeros.length <= 10
            ) {

                return numeros.replace(
                    /^(\d{2})(\d{4})(\d+)/,
                    "($1) $2-$3"
                );

            }


            return numeros.replace(
                /^(\d{2})(\d{5})(\d{4})$/,
                "($1) $2-$3"
            );

        }


        telefoneInput.addEventListener(
            "input",
            function() {

                telefoneInput.value =
                    formatarTelefone(
                        telefoneInput.value
                    );

            }
        );


        /* =====================================================
           RENDERIZAR CONTATOS
        ===================================================== */

        function renderizarContatos() {

            const contatos =
                obterContatos();


            contactsCard.innerHTML =
                "";


            if (
                contatos.length === 0
            ) {

                contactsCard.style.display =
                    "none";

                emptyContacts.classList.add(
                    "show"
                );

                return;

            }


            contactsCard.style.display =
                "block";

            emptyContacts.classList.remove(
                "show"
            );


            contatos.forEach(
                function(contato) {

                    const item =
                        document.createElement(
                            "div"
                        );


                    item.className =
                        "contact";


                    const inicial =
                        contato.nome
                            .charAt(0)
                            .toUpperCase();


                    item.innerHTML = `

                        <div class="contact-avatar">
                            ${escaparHTML(inicial)}
                        </div>


                        <div class="contact-info">

                            <h3>

                                ${escaparHTML(
                                    contato.nome
                                )}

                                ${
                                    contato.principal
                                    ?
                                    `
                                    <span class="principal-badge">
                                        Principal
                                    </span>
                                    `
                                    :
                                    ""
                                }

                            </h3>


                            <p>
                                ${escaparHTML(
                                    contato.telefone
                                )}
                            </p>


                            <span class="contact-type">
                                ${escaparHTML(
                                    contato.relacao
                                )}
                            </span>

                        </div>


                        <div class="contact-actions">


                            <!-- LIGAR -->

                            <button
                                class="action-button"
                                data-action="call"
                                data-id="${contato.id}"
                                title="Ligar"
                                aria-label="Ligar"
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
                                        d="M22 16.9v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 3.1 5.2 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .7 2.9a2 2 0 0 1-.5 2.1L9 10.9a16 16 0 0 0 4.1 4.1l1.2-1.3a2 2 0 0 1 2.1-.5c.9.4 1.9.6 2.9.7A2 2 0 0 1 22 16.9z"
                                    />

                                </svg>

                            </button>


                            <!-- PRINCIPAL -->

                            <button
                                class="action-button"
                                data-action="principal"
                                data-id="${contato.id}"
                                title="Definir como principal"
                                aria-label="Definir como principal"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="${
                                        contato.principal
                                        ?
                                        "currentColor"
                                        :
                                        "none"
                                    }"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <path
                                        d="M12 21s-7-4.35-9.5-8.5C.7 8.9 2.4 5 6.5 5c2.2 0 4 1.2 5.5 3 1.5-1.8 3.3-3 5.5-3 4.1 0 5.8 3.9 4 7.5C19 16.65 12 21 12 21z"
                                    />

                                </svg>

                            </button>


                            <!-- EDITAR -->

                            <button
                                class="action-button"
                                data-action="edit"
                                data-id="${contato.id}"
                                title="Editar"
                                aria-label="Editar"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <path d="M12 20h9"/>

                                    <path
                                        d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5z"
                                    />

                                </svg>

                            </button>


                            <!-- EXCLUIR -->

                            <button
                                class="action-button delete"
                                data-action="delete"
                                data-id="${contato.id}"
                                title="Excluir"
                                aria-label="Excluir"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >

                                    <path d="M3 6h18"/>

                                    <path d="M8 6V4h8v2"/>

                                    <path
                                        d="M19 6l-1 15H6L5 6"
                                    />

                                    <path d="M10 11v6"/>

                                    <path d="M14 11v6"/>

                                </svg>

                            </button>

                        </div>

                    `;


                    contactsCard.appendChild(
                        item
                    );

                }
            );

        }


        /* =====================================================
           EVENTOS DOS BOTÕES DOS CONTATOS
        ===================================================== */

        contactsCard.addEventListener(
            "click",
            function(event) {

                const botao =
                    event.target.closest(
                        "button[data-action]"
                    );


                if (!botao) {

                    return;

                }


                const id =
                    Number(
                        botao.dataset.id
                    );


                const acao =
                    botao.dataset.action;


                if (
                    acao === "call"
                ) {

                    ligarContato(id);

                }


                if (
                    acao === "principal"
                ) {

                    definirPrincipal(id);

                }


                if (
                    acao === "edit"
                ) {

                    editarContato(id);

                }


                if (
                    acao === "delete"
                ) {

                    removerContato(id);

                }

            }
        );


        /* =====================================================
           ABRIR MODAL
        ===================================================== */

        function abrirModal() {

            contatoEditando =
                null;


            modalTitle.textContent =
                "Novo contato";


            contactForm.reset();


            modal.classList.add(
                "show"
            );


            setTimeout(
                function() {

                    nomeInput.focus();

                },
                100
            );

        }


        document
            .getElementById("addButton")
            .addEventListener(
                "click",
                abrirModal
            );


        /* =====================================================
           FECHAR MODAL
        ===================================================== */

        function fecharModal() {

            modal.classList.remove(
                "show"
            );


            contactForm.reset();


            contatoEditando =
                null;

        }


        document
            .getElementById("closeButton")
            .addEventListener(
                "click",
                fecharModal
            );


        document
            .getElementById("cancelButton")
            .addEventListener(
                "click",
                fecharModal
            );


        /* =====================================================
           FECHAR CLICANDO FORA
        ===================================================== */

        modal.addEventListener(
            "click",
            function(event) {

                if (
                    event.target === modal
                ) {

                    fecharModal();

                }

            }
        );


        /* =====================================================
           ESC
        ===================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (
                    event.key === "Escape" &&
                    modal.classList.contains("show")
                ) {

                    fecharModal();

                }

            }
        );


        /* =====================================================
           SALVAR CONTATO
        ===================================================== */

        contactForm.addEventListener(
            "submit",
            function(event) {

                event.preventDefault();


                const nome =
                    nomeInput.value.trim();


                const telefone =
                    telefoneInput.value.trim();


                const relacao =
                    relacaoInput.value;


                /* ---------------------------------------------
                   VALIDAÇÃO DO NOME
                --------------------------------------------- */

                if (!nome) {

                    mostrarMensagem(
                        "Digite o nome do contato."
                    );

                    nomeInput.focus();

                    return;

                }


                /* ---------------------------------------------
                   VALIDAÇÃO DA RELAÇÃO
                --------------------------------------------- */

                if (!relacao) {

                    mostrarMensagem(
                        "Selecione a relação."
                    );

                    relacaoInput.focus();

                    return;

                }


                /* ---------------------------------------------
                   VALIDAÇÃO DO TELEFONE
                --------------------------------------------- */

                const numero =
                    limparTelefone(
                        telefone
                    );


                if (
                    numero.length < 10
                ) {

                    mostrarMensagem(
                        "Digite um telefone válido."
                    );

                    telefoneInput.focus();

                    return;

                }


                const contatos =
                    obterContatos();


                /* ---------------------------------------------
                   TELEFONE DUPLICADO
                --------------------------------------------- */

                const duplicado =
                    contatos.some(
                        function(contato) {

                            if (
                                contatoEditando !== null &&
                                contato.id ===
                                contatoEditando
                            ) {

                                return false;

                            }


                            return (
                                limparTelefone(
                                    contato.telefone
                                ) === numero
                            );

                        }
                    );


                if (duplicado) {

                    mostrarMensagem(
                        "Este telefone já está cadastrado."
                    );

                    telefoneInput.focus();

                    return;

                }


                /* ---------------------------------------------
                   EDITAR
                --------------------------------------------- */

                if (
                    contatoEditando !== null
                ) {

                    const indice =
                        contatos.findIndex(
                            function(contato) {

                                return (
                                    contato.id ===
                                    contatoEditando
                                );

                            }
                        );


                    if (
                        indice === -1
                    ) {

                        mostrarMensagem(
                            "Contato não encontrado."
                        );

                        fecharModal();

                        return;

                    }


                    contatos[indice].nome =
                        nome;


                    contatos[indice].telefone =
                        formatarTelefone(
                            telefone
                        );


                    contatos[indice].relacao =
                        relacao;


                    if (
                        salvarContatos(
                            contatos
                        )
                    ) {

                        renderizarContatos();

                        fecharModal();

                        mostrarMensagem(
                            "Contato atualizado com sucesso."
                        );

                    }


                    return;

                }


                /* ---------------------------------------------
                   NOVO CONTATO
                --------------------------------------------- */

                const novoContato = {

                    id:
                        Date.now(),

                    nome:
                        nome,

                    telefone:
                        formatarTelefone(
                            telefone
                        ),

                    relacao:
                        relacao,

                    principal:
                        contatos.length === 0

                };


                contatos.push(
                    novoContato
                );


                if (
                    salvarContatos(
                        contatos
                    )
                ) {

                    renderizarContatos();

                    fecharModal();


                    if (
                        novoContato.principal
                    ) {

                        mostrarMensagem(
                            "Contato cadastrado como principal!"
                        );

                    } else {

                        mostrarMensagem(
                            "Contato adicionado com sucesso."
                        );

                    }

                }

            }
        );


        /* =====================================================
           EDITAR CONTATO
        ===================================================== */

        function editarContato(id) {

            const contatos =
                obterContatos();


            const contato =
                contatos.find(
                    function(item) {

                        return (
                            item.id === id
                        );

                    }
                );


            if (!contato) {

                mostrarMensagem(
                    "Contato não encontrado."
                );

                return;

            }


            contatoEditando =
                id;


            modalTitle.textContent =
                "Editar contato";


            nomeInput.value =
                contato.nome;


            telefoneInput.value =
                contato.telefone;


            relacaoInput.value =
                contato.relacao;


            modal.classList.add(
                "show"
            );


            setTimeout(
                function() {

                    nomeInput.focus();

                },
                100
            );

        }


        /* =====================================================
           DEFINIR PRINCIPAL
        ===================================================== */

        function definirPrincipal(id) {

            const contatos =
                obterContatos();


            const contato =
                contatos.find(
                    function(item) {

                        return (
                            item.id === id
                        );

                    }
                );


            if (!contato) {

                return;

            }


            if (
                contato.principal
            ) {

                mostrarMensagem(
                    "Este contato já é o principal."
                );

                return;

            }


            contatos.forEach(
                function(item) {

                    item.principal =
                        item.id === id;

                }
            );


            if (
                salvarContatos(
                    contatos
                )
            ) {

                renderizarContatos();

                mostrarMensagem(
                    contato.nome +
                    " agora é o contato principal."
                );

            }

        }


        /* =====================================================
           EXCLUIR CONTATO
        ===================================================== */

        function removerContato(id) {

            const contatos =
                obterContatos();


            const contato =
                contatos.find(
                    function(item) {

                        return (
                            item.id === id
                        );

                    }
                );


            if (!contato) {

                return;

            }


            const confirmar =
                confirm(
                    "Deseja remover " +
                    contato.nome +
                    " dos contatos de confiança?"
                );


            if (!confirmar) {

                return;

            }


            const eraPrincipal =
                contato.principal;


            let novosContatos =
                contatos.filter(
                    function(item) {

                        return (
                            item.id !== id
                        );

                    }
                );


            /* ---------------------------------------------
               SE O PRINCIPAL FOR EXCLUÍDO
            --------------------------------------------- */

            if (
                eraPrincipal &&
                novosContatos.length > 0
            ) {

                novosContatos.forEach(
                    function(item, indice) {

                        item.principal =
                            indice === 0;

                    }
                );

            }


            if (
                salvarContatos(
                    novosContatos
                )
            ) {

                renderizarContatos();

                mostrarMensagem(
                    "Contato removido com sucesso."
                );

            }

        }


        /* =====================================================
           LIGAR
        ===================================================== */

        function ligarContato(id) {

            const contatos =
                obterContatos();


            const contato =
                contatos.find(
                    function(item) {

                        return (
                            item.id === id
                        );

                    }
                );


            if (!contato) {

                mostrarMensagem(
                    "Contato não encontrado."
                );

                return;

            }


            const telefone =
                limparTelefone(
                    contato.telefone
                );


            if (
                telefone.length < 10
            ) {

                mostrarMensagem(
                    "Número de telefone inválido."
                );

                return;

            }


            window.location.href =
                "tel:" +
                telefone;

        }


        /* =====================================================
           INICIALIZAÇÃO
        ===================================================== */

        document.addEventListener(
            "DOMContentLoaded",
            function() {

                renderizarContatos();

                console.log(
                    "SilentHelp carregado."
                );

                console.log(
                    "Contatos:",
                    obterContatos()
                );

            }
        );

    </script>

<script src="assets/db-sync.js"></script>
</body>

</html>