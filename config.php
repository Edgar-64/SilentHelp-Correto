<?php

require_once __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
if (isset($_GET['logout']) && $_GET['logout'] === '1') {

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
$usuario = exigirLogin();

$nomeUsuario = $usuario["nome"] ?? "Usuário";

$primeiraLetra = mb_strtoupper(
    mb_substr($nomeUsuario, 0, 1, 'UTF-8'),
    'UTF-8'
);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Configurações</title>

    <style>

        /* =====================================================
           RESET
        ====================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* =====================================================
           VARIÁVEIS
        ====================================================== */

        :root {
            --roxo: #a65cff;
            --roxo-claro: #c58aff;
            --roxo-escuro: #6e32ad;

            --fundo: #050507;
            --fundo-card: #101015;

            --borda: #292933;

            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;

            --verde: #55df91;
            --vermelho: #ff5c70;
        }


        /* =====================================================
           BODY
        ====================================================== */

        body {
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, 0.14),
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

        button {
            font-family: inherit;
        }


        /* =====================================================
           APP
        ====================================================== */

        .app {
            width: 100%;
            max-width: 900px;

            margin: 0 auto;

            padding:
                24px
                24px
                125px;
        }


        /* =====================================================
           CABEÇALHO
        ====================================================== */

        .header {
            display: flex;
            align-items: center;

            gap: 16px;

            margin-bottom: 30px;
        }

        .back-button {
            width: 46px;
            height: 46px;
            min-width: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--borda);
            border-radius: 14px;

            background: var(--fundo-card);

            color: var(--roxo-claro);

            cursor: pointer;

            transition: 0.2s;
        }

        .back-button:hover {
            background:
                rgba(166, 92, 255, 0.12);

            border-color:
                var(--roxo);
        }

        .back-button svg {
            width: 23px;
            height: 23px;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 30px;
            line-height: 1.15;

            font-weight: 600;

            margin-bottom: 5px;
        }

        .header-text p {
            color: var(--cinza);

            font-size: 14px;
            line-height: 1.4;
        }


        /* =====================================================
           SEÇÕES
        ====================================================== */

        .settings-section {
            margin-bottom: 26px;
        }

        .settings-section:last-of-type {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 17px;
            line-height: 1.2;

            font-weight: 500;

            color: var(--roxo-claro);

            margin-bottom: 10px;

            padding-left: 4px;
        }


        /* =====================================================
           CARD
        ====================================================== */

        .settings-card {
            width: 100%;

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0b0b10
                );
        }


        /* =====================================================
           ITEM
        ====================================================== */

        .setting-item {
            min-height: 76px;

            display: flex;
            align-items: center;

            gap: 14px;

            padding:
                13px
                17px;

            border-bottom:
                1px solid
                rgba(255, 255, 255, 0.05);

            transition: 0.2s;
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .setting-item:hover {
            background:
                rgba(166, 92, 255, 0.05);
        }


        /* =====================================================
           ÍCONE
        ====================================================== */

        .setting-icon {
            width: 46px;
            height: 46px;
            min-width: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                rgba(166, 92, 255, 0.12);

            color:
                var(--roxo-claro);
        }

        .setting-icon svg {
            width: 24px;
            height: 24px;
        }


        /* =====================================================
           TEXTO
        ====================================================== */

        .setting-info {
            flex: 1;
            min-width: 0;
        }

        .setting-info h3 {
            font-size: 15px;
            line-height: 1.25;

            font-weight: 500;

            margin-bottom: 4px;
        }

        .setting-info p {
            color: var(--cinza);

            font-size: 12.5px;
            line-height: 1.4;
        }


        /* =====================================================
           TOGGLE
        ====================================================== */

        .toggle {
            position: relative;

            width: 50px;
            height: 29px;
            min-width: 50px;

            border: none;
            border-radius: 30px;

            background: #303039;

            cursor: pointer;

            transition: 0.25s;
        }

        .toggle::after {
            content: "";

            position: absolute;

            width: 21px;
            height: 21px;

            top: 4px;
            left: 4px;

            border-radius: 50%;

            background: #ffffff;

            transition: 0.25s;
        }

        .toggle.active {
            background:
                var(--roxo);
        }

        .toggle.active::after {
            left: 25px;
        }


        /* =====================================================
           SETA
        ====================================================== */

        .arrow-button {
            width: 36px;
            height: 36px;
            min-width: 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;

            background: transparent;

            color: var(--cinza);

            cursor: pointer;

            font-size: 26px;
            line-height: 1;

            transition: 0.2s;
        }

        .arrow-button:hover {
            color:
                var(--roxo-claro);
        }


        /* =====================================================
           STATUS DO DISPOSITIVO
        ====================================================== */

        .device-status {
            display: flex;
            align-items: center;

            gap: 7px;

            color:
                var(--verde);

            font-size: 12.5px;
            line-height: 1.3;

            margin-top: 4px;
        }

        .device-dot {
            width: 8px;
            height: 8px;
            min-width: 8px;

            border-radius: 50%;

            background:
                var(--verde);

            box-shadow:
                0 0 8px
                rgba(85, 223, 145, 0.6);
        }


        /* =====================================================
           CONTA
        ====================================================== */

        .account-card {
            width: 100%;

            padding: 18px;

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0b0b10
                );
        }

        .account-info {
            display: flex;
            align-items: center;

            gap: 14px;
        }

        .account-avatar {
            width: 56px;
            height: 56px;
            min-width: 56px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    145deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            color: white;

            font-size: 20px;
            font-weight: 600;
        }

        .account-text {
            min-width: 0;
        }

        .account-text h3 {
            font-size: 16px;
            line-height: 1.2;

            margin-bottom: 4px;
        }

        .account-text p {
            color: var(--cinza);

            font-size: 12.5px;
            line-height: 1.35;
        }


        /* =====================================================
           LOGOUT
        ====================================================== */

        .logout-button {
            width: 100%;

            margin-top: 14px;

            padding: 14px;

            border:
                1px solid
                rgba(255, 92, 112, 0.35);

            border-radius: 14px;

            background:
                rgba(255, 92, 112, 0.07);

            color:
                var(--vermelho);

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }

        .logout-button:hover {
            background:
                rgba(255, 92, 112, 0.13);

            border-color:
                var(--vermelho);
        }


        /* =====================================================
           VERSÃO
        ====================================================== */

        .version {
            text-align: center;

            color:
                var(--cinza-escuro);

            font-size: 11.5px;

            margin-top: 22px;

            padding-bottom: 5px;
        }


        /* =====================================================
           MENU INFERIOR
        ====================================================== */

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

            height: 82px;

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 0;

            padding: 5px;

            align-items: stretch;

            background:
                rgba(18, 18, 22, 0.97);

            border:
                1px solid
                rgba(255, 255, 255, 0.04);

            border-radius: 26px;

            backdrop-filter:
                blur(15px);

            -webkit-backdrop-filter:
                blur(15px);

            z-index: 1000;
        }

        .nav-button {
            width: 100%;
            height: 100%;

            min-width: 0;

            display: flex;

            flex-direction: column;

            justify-content: center;
            align-items: center;

            gap: 5px;

            padding: 0;

            border: none;

            background: transparent;

            color: #85858e;

            cursor: pointer;

            font-size: 12px;
            line-height: 1.2;

            transition: 0.2s;
        }

        .nav-button svg {
            width: 25px;
            height: 25px;

            flex-shrink: 0;
        }

        .nav-button.active {
            color:
                var(--roxo-claro);
        }

        .nav-button:hover {
            color:
                var(--roxo-claro);
        }


        /* =====================================================
           TOAST
        ====================================================== */

        .toast {
            position: fixed;

            left: 50%;
            bottom: 120px;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            z-index: 5000;

            padding:
                13px
                20px;

            border-radius: 14px;

            background: #18181f;

            border:
                1px solid
                var(--roxo);

            color: white;

            transition: 0.3s;

            text-align: center;

            max-width: 90%;

            font-size: 13px;
        }

        .toast.show {
            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        /* =====================================================
           MODAL
        ====================================================== */

        .modal {
            position: fixed;

            inset: 0;

            display: none;

            justify-content: center;
            align-items: center;

            padding: 20px;

            background:
                rgba(0, 0, 0, 0.78);

            backdrop-filter:
                blur(8px);

            -webkit-backdrop-filter:
                blur(8px);

            z-index: 3000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 430px;

            padding: 26px;

            border:
                1px solid
                var(--roxo);

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    #1b1622,
                    #0c0c10
                );

            text-align: center;
        }

        .modal-icon {
            width: 62px;
            height: 62px;

            margin:
                0 auto 14px;

            display: flex;

            justify-content: center;
            align-items: center;

            border-radius: 50%;

            background:
                rgba(255, 92, 112, 0.10);

            color:
                var(--vermelho);

            font-size: 28px;
        }

        .modal-content h2 {
            font-size: 21px;

            margin-bottom: 9px;
        }

        .modal-content p {
            color: var(--cinza);

            font-size: 14px;

            line-height: 1.5;

            margin-bottom: 22px;
        }

        .modal-buttons {
            display: flex;

            gap: 10px;
        }

        .modal-buttons button {
            flex: 1;

            padding: 13px;

            border-radius: 13px;

            cursor: pointer;

            font-weight: 600;

            font-size: 14px;
        }

        .cancel-button {
            border:
                1px solid
                var(--borda);

            background: #17171c;

            color: white;
        }

        .confirm-button {
            border: none;

            background:
                var(--roxo);

            color: white;
        }


        /* =====================================================
           RESPONSIVO
        ====================================================== */

        @media (max-width: 700px) {

            .app {
                padding:
                    18px
                    15px
                    115px;
            }

            .header {
                gap: 13px;

                margin-bottom: 25px;
            }

            .back-button {
                width: 43px;
                height: 43px;
                min-width: 43px;

                border-radius: 13px;
            }

            .back-button svg {
                width: 21px;
                height: 21px;
            }

            .header-text h1 {
                font-size: 26px;
            }

            .header-text p {
                font-size: 13px;
            }

            .settings-section {
                margin-bottom: 23px;
            }

            .section-title {
                font-size: 16px;

                margin-bottom: 9px;
            }

            .settings-card {
                border-radius: 18px;
            }

            .setting-item {
                min-height: 70px;

                gap: 11px;

                padding:
                    11px
                    12px;
            }

            .setting-icon {
                width: 42px;
                height: 42px;
                min-width: 42px;

                border-radius: 13px;
            }

            .setting-icon svg {
                width: 22px;
                height: 22px;
            }

            .setting-info h3 {
                font-size: 14px;
            }

            .setting-info p {
                font-size: 11.5px;
            }

            .toggle {
                width: 47px;
                height: 28px;
                min-width: 47px;
            }

            .toggle::after {
                width: 20px;
                height: 20px;

                top: 4px;
                left: 4px;
            }

            .toggle.active::after {
                left: 23px;
            }

            .arrow-button {
                width: 32px;
                height: 32px;
                min-width: 32px;

                font-size: 24px;
            }

            .device-status {
                font-size: 11.5px;
            }

            .account-card {
                padding: 15px;

                border-radius: 18px;
            }

            .account-avatar {
                width: 52px;
                height: 52px;
                min-width: 52px;

                font-size: 19px;
            }

            .account-text h3 {
                font-size: 15px;
            }

            .account-text p {
                font-size: 11.5px;
            }

            .logout-button {
                margin-top: 12px;

                padding: 13px;

                border-radius: 13px;

                font-size: 13px;
            }

            .version {
                margin-top: 20px;
            }

            .bottom-nav {
                width:
                    calc(100% - 24px);

                height: 76px;

                bottom: 9px;

                border-radius: 23px;
            }

            .nav-button {
                gap: 4px;

                font-size: 10px;
            }

            .nav-button svg {
                width: 23px;
                height: 23px;
            }

            .toast {
                bottom: 105px;

                font-size: 12px;
            }
        }


        /* =====================================================
           CELULARES PEQUENOS
        ====================================================== */

        @media (max-width: 400px) {

            .app {
                padding:
                    16px
                    12px
                    110px;
            }

            .header {
                margin-bottom: 22px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .header-text p {
                font-size: 12px;
            }

            .section-title {
                font-size: 15px;
            }

            .setting-info p {
                max-width: 180px;
            }

            .account-card {
                padding: 14px;
            }

            .account-avatar {
                width: 48px;
                height: 48px;
                min-width: 48px;
            }

            .bottom-nav {
                height: 74px;

                bottom: 8px;
            }

            .nav-button {
                gap: 3px;

                font-size: 9px;
            }

            .nav-button svg {
                width: 21px;
                height: 21px;
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
                onclick="abrirPagina('index.php')"
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
                    Configurações
                </h1>

                <p>
                    Personalize sua experiência no SilentHelp.
                </p>

            </div>

        </header>


        <!-- =================================================
             SEGURANÇA
        ================================================== -->

        <section class="settings-section">

            <h2 class="section-title">
                Segurança
            </h2>


            <div class="settings-card">


                <!-- LOCALIZAÇÃO -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="2.5"
                            />

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Localização
                        </h3>

                        <p>
                            Permitir localização durante emergências.
                        </p>

                    </div>


                    <button
                        class="toggle active"
                        onclick="alternarToggle(this, 'Localização', 'localizacao')"
                        aria-label="Ativar ou desativar localização"
                    ></button>

                </div>


                <!-- MODO DISCRETO -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M3 12s3.5-6 9-6 9 6 9 6-3.5 6-9 6-9-6-9-6z"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="2.5"
                            />

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Modo discreto
                        </h3>

                        <p>
                            Oculta informações sensíveis da tela.
                        </p>

                    </div>


                    <button
                        class="toggle"
                        onclick="alternarToggle(this, 'Modo discreto', 'modoDiscreto')"
                        aria-label="Ativar ou desativar modo discreto"
                    ></button>

                </div>


                <!-- ALERTAS -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M12 3l8 3v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3z"
                            />

                            <path d="M12 8v4"/>

                            <circle
                                cx="12"
                                cy="15.5"
                                r=".7"
                                fill="currentColor"
                            />

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Alertas de segurança
                        </h3>

                        <p>
                            Receba avisos importantes do SilentHelp.
                        </p>

                    </div>


                    <button
                        class="toggle active"
                        onclick="alternarToggle(this, 'Alertas de segurança', 'alertas')"
                        aria-label="Ativar ou desativar alertas"
                    ></button>

                </div>

            </div>

        </section>


        <!-- =================================================
             NOTIFICAÇÕES
        ================================================== -->

        <section class="settings-section">

            <h2 class="section-title">
                Notificações
            </h2>


            <div class="settings-card">


                <!-- NOTIFICAÇÕES -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                            />

                            <path d="M10 21h4"/>

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Notificações
                        </h3>

                        <p>
                            Ativar notificações do aplicativo.
                        </p>

                    </div>


                    <button
                        class="toggle active"
                        onclick="alternarToggle(this, 'Notificações', 'notificacoes')"
                        aria-label="Ativar ou desativar notificações"
                    ></button>

                </div>


                <!-- SONS -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M4 10v4h4l5 4V6l-5 4H4z"
                            />

                            <path
                                d="M16 9a4 4 0 0 1 0 6"
                            />

                            <path
                                d="M18.5 6.5a8 8 0 0 1 0 11"
                            />

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Sons
                        </h3>

                        <p>
                            Reproduzir sons para notificações.
                        </p>

                    </div>


                    <button
                        class="toggle"
                        onclick="alternarToggle(this, 'Sons', 'sons')"
                        aria-label="Ativar ou desativar sons"
                    ></button>

                </div>

            </div>

        </section>


        <!-- =================================================
             DISPOSITIVO
        ================================================== -->

        <section class="settings-section">

            <h2 class="section-title">
                Dispositivo
            </h2>


            <div class="settings-card">


                <!-- MEU DISPOSITIVO -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <rect
                                x="6"
                                y="2"
                                width="12"
                                height="20"
                                rx="2"
                            />

                            <path d="M10 18h4"/>

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Meu dispositivo
                        </h3>

                        <div
                            class="device-status"
                            id="deviceStatus"
                        >

                            <span class="device-dot"></span>

                            Verificando dispositivo...

                        </div>

                    </div>


                    <button
                        class="arrow-button"
                        onclick="verificarDispositivo()"
                        aria-label="Verificar dispositivo"
                    >
                        ›
                    </button>

                </div>


                <!-- BATERIA -->

                <div class="setting-item">

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <rect
                                x="3"
                                y="7"
                                width="17"
                                height="10"
                                rx="2"
                            />

                            <path d="M21 10v4"/>

                            <path d="M6 10h8"/>

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Bateria
                        </h3>

                        <p id="bateriaTexto">
                            Verificando nível da bateria...
                        </p>

                    </div>


                    <span
                        id="bateriaStatus"
                        style="
                            color: var(--verde);
                            font-size: 12px;
                            font-weight: 600;
                        "
                    >
                        --
                    </span>

                </div>

            </div>

        </section>


        <!-- =================================================
             CONTA
        ================================================== -->

        <section class="settings-section">

            <h2 class="section-title">
                Conta
            </h2>


            <div class="account-card">

                <div class="account-info">


                    <div class="account-avatar">

                        <?= htmlspecialchars($primeiraLetra) ?>

                    </div>


                    <div class="account-text">

                        <h3>

                            <?= htmlspecialchars($nomeUsuario) ?>

                        </h3>

                        <p>
                            Conta protegida pelo SilentHelp
                        </p>

                    </div>

                </div>


                <button
                    class="logout-button"
                    onclick="abrirLogout()"
                >
                    Sair da conta
                </button>

            </div>

        </section>


        <!-- =================================================
             INFORMAÇÕES
        ================================================== -->

        <section class="settings-section">

            <h2 class="section-title">
                Informações
            </h2>


            <div class="settings-card">


                <!-- TERMOS -->

                <div
                    class="setting-item"
                    onclick="abrirPagina('termos.php')"
                    style="cursor: pointer;"
                >

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M6 2h9l5 5v15H6z"
                            />

                            <path
                                d="M14 2v6h6"
                            />

                            <path d="M9 13h6"/>

                            <path d="M9 17h5"/>

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Termos de uso
                        </h3>

                        <p>
                            Consulte os termos do SilentHelp.
                        </p>

                    </div>


                    <button
                        class="arrow-button"
                        onclick="
                            event.stopPropagation();
                            abrirPagina('termos.php');
                        "
                        aria-label="Abrir termos de uso"
                    >
                        ›
                    </button>

                </div>


                <!-- PRIVACIDADE -->

                <div
                    class="setting-item"
                    onclick="abrirPagina('privacidade.php')"
                    style="cursor: pointer;"
                >

                    <div class="setting-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M12 3l8 3v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3z"
                            />

                            <path
                                d="M8 12l2.5 2.5L16 9"
                            />

                        </svg>

                    </div>


                    <div class="setting-info">

                        <h3>
                            Privacidade
                        </h3>

                        <p>
                            Saiba como seus dados são protegidos.
                        </p>

                    </div>


                    <button
                        class="arrow-button"
                        onclick="
                            event.stopPropagation();
                            abrirPagina('privacidade.php');
                        "
                        aria-label="Abrir privacidade"
                    >
                        ›
                    </button>

                </div>

            </div>

        </section>


        <!-- =================================================
             VERSÃO
        ================================================== -->

        <div class="version">

            SilentHelp • Versão 1.0.0

        </div>

    </main>


    <!-- =====================================================
         MENU INFERIOR
    ====================================================== -->

    <nav class="bottom-nav">


        <!-- INÍCIO -->

        <button
            class="nav-button"
            onclick="abrirPagina('index.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="currentColor"
            >

                <path
                    d="M3 11.5L12 4l9 7.5v8.5a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z"
                />

            </svg>

            <span>
                Início
            </span>

        </button>


        <!-- MAPA -->

        <button
            class="nav-button"
            onclick="abrirPagina('mapa.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
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


        <!-- CONFIGURAÇÕES -->

        <button
            class="nav-button active"
            onclick="abrirPagina('config.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <circle
                    cx="12"
                    cy="12"
                    r="3"
                />

                <path
                    d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2 2-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-3v-.8a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-2-2 .1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1h-.8v-3h.8a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L6 7.9l2-2 .1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V4h3v.8a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 2 2-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 .3 1.9 1.7 1.7 0 0 0 1.6 1h.8v3h-.8a1.7 1.7 0 0 0-1.6 1z"
                />

            </svg>

            <span>
                Config.
            </span>

        </button>


        <!-- PERFIL -->

        <button
            class="nav-button"
            onclick="abrirPagina('perfil.php')"
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
         MODAL LOGOUT
    ====================================================== -->

    <div
        id="logoutModal"
        class="modal"
    >

        <div class="modal-content">


            <div class="modal-icon">
                ↪
            </div>


            <h2>
                Sair da conta?
            </h2>


            <p>
                Você precisará entrar novamente
                para acessar sua conta.
            </p>


            <div class="modal-buttons">

                <button
                    class="cancel-button"
                    onclick="fecharLogout()"
                >
                    Cancelar
                </button>


                <button
                    class="confirm-button"
                    onclick="confirmarLogout()"
                >
                    Sair
                </button>

            </div>

        </div>

    </div>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        id="toast"
        class="toast"
    ></div>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =================================================
           NAVEGAÇÃO
        ================================================== */

        function abrirPagina(pagina) {
            window.location.href = pagina;
        }


        /* =================================================
           TOGGLES
        ================================================== */

        function alternarToggle(botao, nome, chave) {

            botao.classList.toggle("active");

            const ativo =
                botao.classList.contains("active");

            localStorage.setItem(
                "silenthelp_" + chave,
                ativo ? "1" : "0"
            );

            mostrarMensagem(
                nome +
                (ativo ? " ativado." : " desativado.")
            );
        }


        function carregarToggles() {

            const toggles =
                document.querySelectorAll(".toggle");

            toggles.forEach(function (botao) {

                const onclick =
                    botao.getAttribute("onclick");

                if (!onclick) {
                    return;
                }

                const resultado =
                    onclick.match(/'([^']+)'\)/);

                /*
                    As configurações são carregadas
                    diretamente pelas chaves abaixo.
                */

            });

            carregarTogglePorChave(
                "localizacao",
                0
            );

            carregarTogglePorChave(
                "modoDiscreto",
                1
            );

            carregarTogglePorChave(
                "alertas",
                2
            );

            carregarTogglePorChave(
                "notificacoes",
                3
            );

            carregarTogglePorChave(
                "sons",
                4
            );
        }


        function carregarTogglePorChave(chave, indice) {

            const valor =
                localStorage.getItem(
                    "silenthelp_" + chave
                );

            if (valor === null) {
                return;
            }

            const toggles =
                document.querySelectorAll(".toggle");

            const botao = toggles[indice];

            if (!botao) {
                return;
            }

            if (valor === "1") {
                botao.classList.add("active");
            } else {
                botao.classList.remove("active");
            }
        }


        /* =================================================
           LOGOUT
        ================================================== */

        function abrirLogout() {

            document
                .getElementById("logoutModal")
                .classList
                .add("show");
        }


        function fecharLogout() {

            document
                .getElementById("logoutModal")
                .classList
                .remove("show");
        }


        function confirmarLogout() {

            window.location.href =
                "config.php?logout=1";
        }


        /* =================================================
           TOAST
        ================================================== */

        function mostrarMensagem(mensagem) {

            const toast =
                document.getElementById("toast");

            toast.textContent =
                mensagem;

            toast.classList.add("show");

            setTimeout(function () {

                toast.classList.remove("show");

            }, 2500);
        }


        /* =================================================
           VERIFICAÇÃO DO DISPOSITIVO
        ================================================== */

        function verificarDispositivo() {

            const status =
                document.getElementById("deviceStatus");

            if (navigator.onLine) {

                status.innerHTML =
                    '<span class="device-dot"></span>' +
                    'Dispositivo conectado';

                mostrarMensagem(
                    "Dispositivo conectado à internet."
                );

            } else {

                status.innerHTML =
                    '<span class="device-dot" style="background: var(--vermelho);"></span>' +
                    'Sem conexão com a internet';

                mostrarMensagem(
                    "O dispositivo está offline."
                );
            }
        }


        /* =================================================
           BATERIA
        ================================================== */

        async function verificarBateria() {

            const texto =
                document.getElementById("bateriaTexto");

            const status =
                document.getElementById("bateriaStatus");

            if (!("getBattery" in navigator)) {

                texto.textContent =
                    "Informação de bateria não disponível neste navegador.";

                status.textContent =
                    "--";

                return;
            }

            try {

                const bateria =
                    await navigator.getBattery();

                atualizarBateria(bateria);

                bateria.addEventListener(
                    "levelchange",
                    function () {
                        atualizarBateria(bateria);
                    }
                );

            } catch (erro) {

                texto.textContent =
                    "Não foi possível verificar a bateria.";

                status.textContent =
                    "--";
            }
        }


        function atualizarBateria(bateria) {

            const porcentagem =
                Math.round(
                    bateria.level * 100
                );

            const texto =
                document.getElementById("bateriaTexto");

            const status =
                document.getElementById("bateriaStatus");

            texto.textContent =
                "Nível atual: " +
                porcentagem +
                "%";

            if (porcentagem <= 20) {

                status.textContent =
                    "BAIXA";

                status.style.color =
                    "var(--vermelho)";

            } else if (porcentagem <= 50) {

                status.textContent =
                    "MÉDIA";

                status.style.color =
                    "#ffd166";

            } else {

                status.textContent =
                    "BOA";

                status.style.color =
                    "var(--verde)";
            }
        }


        /* =================================================
           ONLINE / OFFLINE
        ================================================== */

        window.addEventListener(
            "online",
            verificarDispositivo
        );

        window.addEventListener(
            "offline",
            verificarDispositivo
        );


        /* =================================================
           FECHAR MODAL CLICANDO FORA
        ================================================== */

        document
            .getElementById("logoutModal")
            .addEventListener(
                "click",
                function(event) {

                    if (
                        event.target === this
                    ) {

                        fecharLogout();
                    }
                }
            );


        /* =================================================
           ESC
        ================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (
                    event.key === "Escape"
                ) {

                    fecharLogout();
                }
            }
        );


        /* =================================================
           INICIALIZAÇÃO
        ================================================== */

        document.addEventListener(
            "DOMContentLoaded",
            function() {

                carregarToggles();

                verificarDispositivo();

                verificarBateria();

            }
        );

    </script>


    <script src="assets/db-sync.js"></script>

</body>

</html>