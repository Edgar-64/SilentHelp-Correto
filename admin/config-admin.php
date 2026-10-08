<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Configurações</title>

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
            --card-2: #191520;

            --borda: rgba(255,255,255,.08);

            --branco: #ffffff;

            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;

            --sombra:
                0 20px 60px rgba(0,0,0,.35);
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                radial-gradient(
                    circle at 30% -10%,
                    rgba(168,85,247,.18),
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


        /* =====================================================
           LAYOUT
        ===================================================== */

        .layout {

            display: flex;

            min-height: 100vh;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            width: 250px;

            min-height: 100vh;

            padding: 25px 17px;

            background:
                rgba(12,10,16,.96);

            border-right:
                1px solid
                var(--borda);

            display: flex;

            flex-direction: column;

            overflow-y: auto;

            z-index: 1000;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                5px 10px
                30px;

            color: white;
        }


        .brand-heart {

            width: 39px;
            height: 39px;

            color:
                var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 13px
                    rgba(168,85,247,.35)
                );
        }


        .brand-name {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;
        }


        .brand-name .silent {

            color:
                var(--roxo-2);
        }


        .brand-name .help {

            color:
                white;
        }


        /* =====================================================
           PERFIL ADMIN
        ===================================================== */

        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                13px 11px;

            margin-bottom: 24px;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                rgba(255,255,255,.025);
        }


        .admin-avatar {

            width: 39px;
            height: 39px;

            min-width: 39px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            color: white;

            font-weight: 700;

            font-size: 14px;
        }


        .admin-info {

            min-width: 0;
        }


        .admin-info strong {

            display: block;

            margin-bottom: 3px;

            font-size: 13px;
        }


        .admin-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           LABEL
        ===================================================== */

        .nav-label {

            color:
                var(--cinza-2);

            padding:
                0 12px
                9px;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* =====================================================
           NAV
        ===================================================== */

        .sidebar-nav {

            display: flex;

            flex-direction: column;

            gap: 5px;

            width: 100%;
        }


        .sidebar-link {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                12px 13px;

            border:
                1px solid transparent;

            border-radius: 13px;

            background: transparent;

            color:
                var(--cinza);

            text-decoration: none;

            font-family: inherit;

            font-size: 13px;

            line-height: 1.2;

            text-align: left;

            cursor: pointer;

            transition:
                background .2s,
                color .2s,
                transform .2s;
        }


        .sidebar-link svg {

            width: 19px;
            height: 19px;

            flex:
                0 0 19px;
        }


        .sidebar-link:hover {

            color: white;

            background:
                rgba(168,85,247,.08);

            transform:
                translateX(2px);
        }


        .sidebar-link.active {

            color:
                var(--roxo-claro);

            background:
                linear-gradient(
                    100deg,
                    rgba(168,85,247,.16),
                    rgba(168,85,247,.06)
                );

            border-color:
                rgba(168,85,247,.18);
        }


        .link-badge {

            margin-left: auto;

            min-width: 20px;
            height: 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 7px;

            background:
                rgba(255,93,115,.12);

            color:
                #ff8798;

            font-size: 9px;

            font-weight: 750;
        }


        /* =====================================================
           RODAPÉ SIDEBAR
        ===================================================== */

        .sidebar-bottom {

            margin-top: auto;

            padding-top: 15px;

            border-top:
                1px solid
                var(--borda);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            width:
                calc(100% - 250px);

            margin-left: 250px;

            padding:
                30px 35px 50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .top-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 28px;
        }


        .page-title h1 {

            font-size: 30px;

            font-weight: 650;

            letter-spacing: -.7px;

            margin-bottom: 6px;
        }


        .page-title h1 span {

            color:
                var(--roxo-claro);
        }


        .page-title p {

            color:
                var(--cinza);

            font-size: 13px;
        }


        .header-button {

            width: 43px;
            height: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            background:
                rgba(255,255,255,.03);

            color:
                var(--roxo-claro);

            cursor: pointer;

            transition: .2s;
        }


        .header-button:hover {

            background:
                rgba(168,85,247,.08);

            border-color:
                rgba(168,85,247,.25);
        }


        .header-button svg {

            width: 20px;
            height: 20px;
        }


        /* =====================================================
           GRID
        ===================================================== */

        .settings-grid {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 18px;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .settings-card {

            padding: 22px;

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                rgba(18,16,24,.88);

            box-shadow:
                var(--sombra);
        }


        .settings-card.full {

            grid-column:
                1 / -1;
        }


        .card-header {

            display: flex;

            align-items: center;

            gap: 13px;

            margin-bottom: 20px;
        }


        .card-icon {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);
        }


        .card-icon svg {

            width: 21px;
            height: 21px;
        }


        .card-header h2 {

            font-size: 16px;

            font-weight: 650;

            margin-bottom: 3px;
        }


        .card-header p {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           FORMULÁRIO
        ===================================================== */

        .form-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 15px;
        }


        .form-group {

            display: flex;

            flex-direction: column;

            gap: 7px;
        }


        .form-group.full {

            grid-column:
                1 / -1;
        }


        .form-group label {

            color:
                var(--cinza);

            font-size: 11px;

            font-weight: 600;
        }


        .form-group input,
        .form-group select {

            width: 100%;

            height: 43px;

            padding:
                0 12px;

            border:
                1px solid
                var(--borda);

            border-radius: 11px;

            outline: none;

            background:
                #0d0b11;

            color:
                white;

            font-family: inherit;

            font-size: 12px;

            transition: .2s;
        }


        .form-group input:focus,
        .form-group select:focus {

            border-color:
                rgba(168,85,247,.55);

            box-shadow:
                0 0 0 3px
                rgba(168,85,247,.08);
        }


        /* =====================================================
           BOTÃO SALVAR
        ===================================================== */

        .save-button {

            margin-top: 17px;

            height: 42px;

            padding:
                0 18px;

            border: none;

            border-radius: 11px;

            background:
                linear-gradient(
                    100deg,
                    var(--roxo-escuro),
                    var(--roxo)
                );

            color: white;

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;

            transition: .2s;
        }


        .save-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(168,85,247,.25);
        }


        /* =====================================================
           NOTIFICAÇÕES
        ===================================================== */

        .notification-list {

            display: flex;

            flex-direction: column;

            gap: 13px;
        }


        .notification-item {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                13px 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            background:
                rgba(255,255,255,.02);
        }


        .notification-info {

            display: flex;

            align-items: center;

            gap: 11px;
        }


        .notification-info svg {

            width: 19px;
            height: 19px;

            color:
                var(--roxo-claro);

            flex-shrink: 0;
        }


        .notification-info strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;
        }


        .notification-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           SWITCH
        ===================================================== */

        .switch {

            position: relative;

            width: 43px;
            height: 24px;

            flex-shrink: 0;
        }


        .switch input {

            opacity: 0;

            width: 0;
            height: 0;
        }


        .slider {

            position: absolute;

            inset: 0;

            border-radius: 20px;

            background:
                #302b36;

            cursor: pointer;

            transition: .2s;
        }


        .slider::before {

            content: "";

            position: absolute;

            width: 18px;
            height: 18px;

            left: 3px;
            top: 3px;

            border-radius: 50%;

            background: white;

            transition: .2s;
        }


        .switch input:checked + .slider {

            background:
                var(--roxo);
        }


        .switch input:checked + .slider::before {

            transform:
                translateX(19px);
        }


        /* =====================================================
           CONFIGURAÇÕES DO SISTEMA
        ===================================================== */

        .system-options {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }


        .system-option {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                14px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            background:
                rgba(255,255,255,.02);
        }


        .system-option-info strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;
        }


        .system-option-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           SAIR
        ===================================================== */

        .logout-card {

            margin-top: 18px;

            padding:
                20px 22px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            border:
                1px solid
                rgba(255,93,115,.15);

            border-radius: 18px;

            background:
                rgba(255,93,115,.04);
        }


        .logout-info {

            display: flex;

            align-items: center;

            gap: 13px;
        }


        .logout-icon {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(255,93,115,.08);

            color:
                var(--vermelho);
        }


        .logout-icon svg {

            width: 21px;
            height: 21px;
        }


        .logout-info strong {

            display: block;

            font-size: 13px;

            margin-bottom: 4px;
        }


        .logout-info span {

            color:
                var(--cinza);

            font-size: 10px;
        }


        .logout-button {

            height: 40px;

            padding:
                0 17px;

            border:
                1px solid
                rgba(255,93,115,.25);

            border-radius: 10px;

            background:
                rgba(255,93,115,.08);

            color:
                var(--vermelho);

            font-size: 11px;

            font-weight: 700;

            cursor: pointer;

            transition: .2s;
        }


        .logout-button:hover {

            background:
                rgba(255,93,115,.15);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 1000px) {

            .sidebar {

                width: 215px;
            }


            .main {

                width:
                    calc(100% - 215px);

                margin-left: 215px;

                padding:
                    25px 20px 40px;
            }
        }


        @media (max-width: 800px) {

            .settings-grid {

                grid-template-columns: 1fr;
            }


            .settings-card.full {

                grid-column: auto;
            }


            .system-options {

                grid-template-columns: 1fr;
            }
        }


        @media (max-width: 700px) {

            .sidebar {

                position: fixed;

                width: 100%;

                height: 70px;

                bottom: 0;
                top: auto;
                left: 0;

                padding:
                    5px 10px;

                border-right: none;

                border-top:
                    1px solid
                    var(--borda);

                flex-direction: row;

                align-items: center;

                justify-content: center;
            }


            .brand,
            .admin-profile,
            .nav-label,
            .sidebar-bottom {

                display: none;
            }


            .sidebar-nav {

                width: 100%;

                flex-direction: row;

                justify-content: space-around;

                gap: 2px;
            }


            .sidebar-link {

                width: auto;

                min-height: 58px;

                flex: 1;

                justify-content: center;

                flex-direction: column;

                gap: 3px;

                padding: 4px;

                font-size: 9px;

                text-align: center;
            }


            .sidebar-link svg {

                width: 21px;
                height: 21px;
            }


            .link-badge {

                position: absolute;

                margin-left: 25px;

                margin-top: -28px;

                min-width: 16px;
                height: 16px;

                font-size: 8px;
            }


            .main {

                width: 100%;

                margin-left: 0;

                padding:
                    20px
                    15px
                    90px;
            }


            .top-header {

                margin-bottom: 20px;
            }


            .page-title h1 {

                font-size: 24px;
            }


            .page-title p {

                font-size: 11px;
            }


            .form-grid {

                grid-template-columns: 1fr;
            }


            .form-group.full {

                grid-column: auto;
            }


            .logout-card {

                align-items: flex-start;

                flex-direction: column;
            }


            .logout-button {

                width: 100%;
            }
        }


        @media (max-width: 420px) {

            .settings-card {

                padding: 17px;
            }


            .card-header h2 {

                font-size: 15px;
            }


            .notification-item {

                padding: 11px;
            }
        }


        /* =====================================================
           BARRA DE ROLAGEM
        ===================================================== */

        html {

            scrollbar-width: thin;

            scrollbar-color:
                #9b5de5
                #0c0a10;
        }


        .sidebar,
        body {

            scrollbar-width: thin;

            scrollbar-color:
                #9b5de5
                transparent;
        }


        ::-webkit-scrollbar {

            width: 10px;
            height: 10px;
        }


        ::-webkit-scrollbar-track {

            background:
                #0c0a10;

            border-left:
                1px solid
                rgba(255,255,255,.05);
        }


        ::-webkit-scrollbar-thumb {

            min-height: 42px;

            background:
                linear-gradient(
                    180deg,
                    #c084fc 0%,
                    #8b4dcc 55%,
                    #5f2f91 100%
                );

            border:
                2px solid
                #0c0a10;

            border-radius:
                999px;

            box-shadow:
                0 0 9px
                rgba(168,85,247,.35);
        }


        ::-webkit-scrollbar-thumb:hover {

            background:
                linear-gradient(
                    180deg,
                    #d8a7ff 0%,
                    #a855f7 55%,
                    #7030b5 100%
                );

            box-shadow:
                0 0 13px
                rgba(168,85,247,.55);
        }


        ::-webkit-scrollbar-corner {

            background:
                #0c0a10;
        }

    </style>

</head>


<body>


<div class="layout">


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar" id="sidebar">


        <!-- LOGO SILENTHELP -->

        <div class="brand">

            <?php include '../components/logo.php'; ?>

        </div>


        <!-- PERFIL -->

        <div class="admin-profile">

            <div class="admin-avatar">
                AD
            </div>


            <div class="admin-info">

                <strong>
                    Administrador
                </strong>

                <span>
                    Painel administrativo
                </span>

            </div>

        </div>


        <!-- MENU -->

        <div class="nav-label">
            Principal
        </div>


        <nav class="sidebar-nav">


            <a
                href="admin.php"
                class="sidebar-link"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="3"
                        y="3"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="14"
                        y="3"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="3"
                        y="14"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="14"
                        y="14"
                        width="7"
                        height="7"
                        rx="1"
                    />

                </svg>

                <span>
                    Dashboard
                </span>

            </a>


            <a
                href="usuarios.php"
                class="sidebar-link"
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
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        d="M22 21v-2a4 4 0 0 0-3-3.87"
                    />

                    <path
                        d="M16 3.13a4 4 0 0 1 0 7.75"
                    />

                </svg>

                <span>
                    Usuárias
                </span>

            </a>


            <a
                href="alertas.php"
                class="sidebar-link"
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
                        d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                    />

                    <line
                        x1="12"
                        y1="9"
                        x2="12"
                        y2="13"
                    />

                    <line
                        x1="12"
                        y1="17"
                        x2="12.01"
                        y2="17"
                    />

                </svg>

                <span>
                    Alertas
                </span>

                <span class="link-badge">
                    3
                </span>

            </a>


            <a
                href="mapa-admin.php"
                class="sidebar-link"
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
                        d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"
                    />

                    <circle
                        cx="12"
                        cy="10"
                        r="2.5"
                    />

                </svg>

                <span>
                    Mapa de ocorrências
                </span>

            </a>


            <a
                href="dispositivos.php"
                class="sidebar-link"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <rect
                        x="5"
                        y="2"
                        width="14"
                        height="20"
                        rx="2"
                    />

                    <line
                        x1="9"
                        y1="18"
                        x2="15"
                        y2="18"
                    />

                </svg>

                <span>
                    Dispositivos
                </span>

            </a>


            <a
                href="contatos-admin.php"
                class="sidebar-link"
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
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2"
                    />

                    <path
                        d="M16 3.13a4 4 0 0 1 0 7.75"
                    />

                    <path
                        d="M22 21v-2a4 4 0 0 0-3-3.87"
                    />

                </svg>

                <span>
                    Contatos
                </span>

            </a>


            <a
                href="relatorios.php"
                class="sidebar-link"
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
                        d="M3 3v18h18"
                    />

                    <path
                        d="m7 16 4-5 3 3 5-7"
                    />

                </svg>

                <span>
                    Relatórios
                </span>

            </a>


            <a
                href="config-admin.php"
                class="sidebar-link active"
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
                        d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-2v-.48a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2h.48A1.7 1.7 0 0 0 8.04 11a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.42-1.42.06.06A1.7 1.7 0 0 0 11 8.04 1.7 1.7 0 0 0 12.03 6.48V6h2v.48A1.7 1.7 0 0 0 15.06 8a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 18.04 11c.24.63.84 1.03 1.56 1.03H20v2h-.48A1.7 1.7 0 0 0 19.4 15Z"
                    />

                </svg>

                <span>
                    Configurações
                </span>

            </a>


        </nav>


        <!-- SAIR -->

        <div class="sidebar-bottom">

            <?php include '../components/logout.php'; ?>

        </div>


    </aside>



    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

    <main class="main">


        <!-- HEADER -->

        <header class="top-header">

            <div class="page-title">

                <h1>
                    <span>Configurações</span>
                </h1>

                <p>
                    Gerencie as configurações do painel administrativo.
                </p>

            </div>


            <button
                class="header-button"
                onclick="showNotification()"
                aria-label="Notificações"
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
                        d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                    />

                    <path
                        d="M13.73 21a2 2 0 0 1-3.46 0"
                    />

                </svg>

            </button>

        </header>



        <!-- =================================================
             CARDS
        ================================================== -->

        <div class="settings-grid">


            <!-- DADOS DO ADMINISTRADOR -->

            <section class="settings-card">

                <div class="card-header">

                    <div class="card-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >

                            <circle
                                cx="12"
                                cy="8"
                                r="4"
                            />

                            <path
                                d="M4 21a8 8 0 0 1 16 0"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2>
                            Dados do administrador
                        </h2>

                        <p>
                            Atualize seus dados de acesso.
                        </p>

                    </div>

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label for="nome">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            value="Administrador"
                        >

                    </div>


                    <div class="form-group">

                        <label for="email">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            value="admin@silenthelp.com"
                        >

                    </div>

                </div>


                <button
                    class="save-button"
                    onclick="salvarDados()"
                >
                    Salvar alterações
                </button>

            </section>



            <!-- ALTERAR SENHA -->

            <section class="settings-card">

                <div class="card-header">

                    <div class="card-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="11"
                                rx="2"
                            />

                            <path
                                d="M8 10V7a4 4 0 0 1 8 0v3"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2>
                            Alterar senha
                        </h2>

                        <p>
                            Mantenha sua conta protegida.
                        </p>

                    </div>

                </div>


                <div class="form-grid">

                    <div class="form-group full">

                        <label for="senhaAtual">
                            Senha atual
                        </label>

                        <input
                            type="password"
                            id="senhaAtual"
                            placeholder="Digite sua senha atual"
                        >

                    </div>


                    <div class="form-group">

                        <label for="novaSenha">
                            Nova senha
                        </label>

                        <input
                            type="password"
                            id="novaSenha"
                            placeholder="Nova senha"
                        >

                    </div>


                    <div class="form-group">

                        <label for="confirmarSenha">
                            Confirmar senha
                        </label>

                        <input
                            type="password"
                            id="confirmarSenha"
                            placeholder="Confirme a senha"
                        >

                    </div>

                </div>


                <button
                    class="save-button"
                    onclick="alterarSenha()"
                >
                    Alterar senha
                </button>

            </section>



            <!-- NOTIFICAÇÕES -->

            <section class="settings-card">

                <div class="card-header">

                    <div class="card-icon">

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

                            <path
                                d="M13.73 21a2 2 0 0 1-3.46 0"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2>
                            Notificações
                        </h2>

                        <p>
                            Escolha quais avisos deseja receber.
                        </p>

                    </div>

                </div>


                <div class="notification-list">


                    <div class="notification-item">

                        <div class="notification-info">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >

                                <path
                                    d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                                />

                                <line
                                    x1="12"
                                    y1="9"
                                    x2="12"
                                    y2="13"
                                />

                                <line
                                    x1="12"
                                    y1="17"
                                    x2="12.01"
                                    y2="17"
                                />

                            </svg>


                            <div>

                                <strong>
                                    Alertas de emergência
                                </strong>

                                <span>
                                    Receber avisos de novos alertas.
                                </span>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="notificacaoAlterada()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>



                    <div class="notification-item">

                        <div class="notification-info">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <rect
                                    x="7"
                                    y="2"
                                    width="10"
                                    height="20"
                                    rx="2"
                                />

                                <line
                                    x1="10"
                                    y1="18"
                                    x2="14"
                                    y2="18"
                                />

                            </svg>


                            <div>

                                <strong>
                                    Dispositivos
                                </strong>

                                <span>
                                    Avisar sobre novos dispositivos.
                                </span>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="notificacaoAlterada()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>



                    <div class="notification-item">

                        <div class="notification-info">

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
                                    d="M4 21a8 8 0 0 1 16 0"
                                />

                            </svg>


                            <div>

                                <strong>
                                    Contas de usuárias
                                </strong>

                                <span>
                                    Avisar sobre alterações nas contas.
                                </span>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="notificacaoAlterada()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>

                </div>

            </section>



            <!-- CONFIGURAÇÕES DO SISTEMA -->

            <section class="settings-card">

                <div class="card-header">

                    <div class="card-icon">

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
                                d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.8 1.8-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.04 1.56V22h-2.55v-.1a1.7 1.7 0 0 0-1.04-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.8-1.8.06-.06A1.7 1.7 0 0 0 8.1 17a1.7 1.7 0 0 0-1.56-1.04H6.4v-2.55h.14A1.7 1.7 0 0 0 8.1 12a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.8-1.8.06.06a1.7 1.7 0 0 0 1.88.34 1.7 1.7 0 0 0 1.04-1.56V5h2.55v.1a1.7 1.7 0 0 0 1.04 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.8 1.8-.06.06A1.7 1.7 0 0 0 19.4 10c.27.63.89 1.04 1.56 1.04H21v2.55h-.04A1.7 1.7 0 0 0 19.4 15Z"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2>
                            Configurações do sistema
                        </h2>

                        <p>
                            Ajuste o funcionamento do SilentHelp.
                        </p>

                    </div>

                </div>


                <div class="system-options">


                    <div class="system-option">

                        <div class="system-option-info">

                            <strong>
                                Monitoramento automático
                            </strong>

                            <span>
                                Monitorar dispositivos conectados.
                            </span>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="sistemaAlterado()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>



                    <div class="system-option">

                        <div class="system-option-info">

                            <strong>
                                Registro de atividades
                            </strong>

                            <span>
                                Registrar ações administrativas.
                            </span>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="sistemaAlterado()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>



                    <div class="system-option">

                        <div class="system-option-info">

                            <strong>
                                Atualização automática
                            </strong>

                            <span>
                                Atualizar informações automaticamente.
                            </span>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                checked
                                onchange="sistemaAlterado()"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>



                    <div class="system-option">

                        <div class="system-option-info">

                            <strong>
                                Modo de manutenção
                            </strong>

                            <span>
                                Colocar o sistema em manutenção.
                            </span>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                onchange="modoManutencao(this)"
                            >

                            <span class="slider"></span>

                        </label>

                    </div>


                </div>


                <button
                    class="save-button"
                    onclick="salvarSistema()"
                >
                    Salvar configurações
                </button>

            </section>


        </div>


    </main>

</div>



<script>

    /* =====================================================
       NOTIFICAÇÃO
    ===================================================== */

    function showNotification(
        message = "Você não possui novas notificações."
    ) {

        alert(message);

    }


    /* =====================================================
       SALVAR DADOS
    ===================================================== */

    function salvarDados() {

        const nome =
            document
                .getElementById("nome")
                .value
                .trim();

        const email =
            document
                .getElementById("email")
                .value
                .trim();


        if (!nome || !email) {

            alert(
                "Preencha o nome e o e-mail."
            );

            return;
        }


        alert(
            "Dados do administrador atualizados com sucesso!"
        );

    }


    /* =====================================================
       ALTERAR SENHA
    ===================================================== */

    function alterarSenha() {

        const atual =
            document
                .getElementById("senhaAtual")
                .value;

        const nova =
            document
                .getElementById("novaSenha")
                .value;

        const confirmar =
            document
                .getElementById("confirmarSenha")
                .value;


        if (!atual || !nova || !confirmar) {

            alert(
                "Preencha todos os campos de senha."
            );

            return;
        }


        if (nova !== confirmar) {

            alert(
                "A confirmação da senha não corresponde."
            );

            return;
        }


        if (nova.length < 6) {

            alert(
                "A nova senha deve possuir pelo menos 6 caracteres."
            );

            return;
        }


        alert(
            "Senha alterada com sucesso!"
        );


        document
            .getElementById("senhaAtual")
            .value = "";

        document
            .getElementById("novaSenha")
            .value = "";

        document
            .getElementById("confirmarSenha")
            .value = "";

    }


    /* =====================================================
       NOTIFICAÇÕES
    ===================================================== */

    function notificacaoAlterada() {

        alert(
            "Preferência de notificação atualizada."
        );

    }


    /* =====================================================
       SISTEMA
    ===================================================== */

    function sistemaAlterado() {

        // A alteração será aplicada ao clicar
        // em "Salvar configurações".

    }


    function salvarSistema() {

        alert(
            "Configurações do sistema salvas com sucesso!"
        );

    }


    /* =====================================================
       MODO DE MANUTENÇÃO
    ===================================================== */

    function modoManutencao(element) {

        if (element.checked) {

            const confirmar =
                confirm(
                    "Deseja realmente ativar o modo de manutenção?"
                );


            if (!confirmar) {

                element.checked = false;

                return;
            }


            alert(
                "Modo de manutenção ativado."
            );

        } else {

            alert(
                "Modo de manutenção desativado."
            );

        }

    }


    /* =====================================================
       LOGOUT
       DIRECIONA PARA login-admin.php
    ===================================================== */

    function logout(event) {

        if (event) {

            event.preventDefault();

        }


        const confirmar =
            confirm(
                "Deseja realmente sair da conta administrativa?"
            );


        if (!confirmar) {

            return false;
        }


        /*
         * Login administrativo
         */

        window.location.href =
            "login-admin.php";


        return false;

    }

</script>


<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>