<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Relatórios</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


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

            width: 250px;

            height: 100vh;

            padding: 25px 16px;

            background:
                rgba(12,10,16,.96);

            border-right:
                1px solid
                var(--borda);

            display: flex;

            flex-direction: column;

            z-index: 1000;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                5px 10px
                28px;
        }


        .logo-heart {

            width: 42px;
            height: 42px;

            color:
                var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 13px
                    rgba(168,85,247,.4)
                );
        }


        .logo-text {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;
        }


        .logo-text .silent {

            color:
                var(--roxo-2);
        }


        .logo-text .help {

            color:
                white;
        }


        /* =====================================================
           ADMIN LABEL
        ===================================================== */

        .admin-label {

            padding:
                0 12px
                10px;

            color:
                var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* =====================================================
           NAV
        ===================================================== */

        .nav {

            display: flex;

            flex-direction: column;

            gap: 6px;
        }


        .nav-button {

            width: 100%;

            min-height: 48px;

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                0 14px;

            border: none;

            border-radius: 13px;

            background:
                transparent;

            color:
                var(--cinza);

            font-size: 13px;

            font-weight: 600;

            text-align: left;

            cursor: pointer;

            transition:
                .2s;
        }


        .nav-button svg {

            width: 20px;
            height: 20px;

            flex-shrink: 0;
        }


        .nav-button:hover {

            background:
                rgba(168,85,247,.08);

            color:
                var(--roxo-claro);
        }


        .nav-button.active {

            background:
                linear-gradient(
                    100deg,
                    rgba(168,85,247,.18),
                    rgba(168,85,247,.06)
                );

            color:
                var(--roxo-claro);

            border:
                1px solid
                rgba(168,85,247,.18);
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


        .admin-user {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                10px;
        }


        .avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(168,85,247,.15);

            color:
                var(--roxo-claro);

            font-size: 13px;

            font-weight: 700;
        }


        .admin-user strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;
        }


        .admin-user span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            width:
                calc(100% - 250px);

            margin-left:
                250px;

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
        }


        .header-button svg {

            width: 20px;
            height: 20px;
        }


        /* =====================================================
           FILTROS
        ===================================================== */

        .filters-card {

            display: flex;

            align-items: flex-end;

            gap: 15px;

            padding: 18px;

            margin-bottom: 22px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                rgba(18,16,24,.85);

            box-shadow:
                var(--sombra);
        }


        .filter-group {

            flex: 1;

            min-width: 150px;
        }


        .filter-group label {

            display: block;

            margin-bottom: 7px;

            color:
                var(--cinza);

            font-size: 11px;

            font-weight: 600;
        }


        .filter-group select {

            width: 100%;

            height: 42px;

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

            font-family:
                inherit;

            cursor: pointer;
        }


        .filter-group select:focus {

            border-color:
                rgba(168,85,247,.5);
        }


        .filter-button {

            height: 42px;

            padding:
                0 20px;

            border: none;

            border-radius: 11px;

            background:
                linear-gradient(
                    100deg,
                    var(--roxo-escuro),
                    var(--roxo)
                );

            color:
                white;

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;

            transition:
                .2s;
        }


        .filter-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(168,85,247,.25);
        }


        /* =====================================================
           CARDS DE RESUMO
        ===================================================== */

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 15px;

            margin-bottom: 22px;
        }


        .summary-card {

            padding: 20px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                rgba(18,16,24,.85);

            box-shadow:
                var(--sombra);

            transition:
                .2s;
        }


        .summary-card:hover {

            transform:
                translateY(-3px);

            border-color:
                rgba(168,85,247,.25);
        }


        .summary-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 15px;
        }


        .summary-icon {

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


        .summary-icon svg {

            width: 21px;
            height: 21px;
        }


        .summary-card.alertas
        .summary-icon {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.09);
        }


        .summary-card.dispositivos
        .summary-icon {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.09);
        }


        .summary-card.usuarios
        .summary-icon {

            color:
                var(--roxo-claro);

            background:
                rgba(168,85,247,.10);
        }


        .summary-card.ativos
        .summary-icon {

            color:
                var(--amarelo);

            background:
                rgba(244,201,93,.09);
        }


        .summary-card h3 {

            color:
                var(--cinza);

            font-size: 11px;

            font-weight: 600;

            margin-bottom: 7px;
        }


        .summary-card strong {

            font-size: 28px;

            font-weight: 700;
        }


        /* =====================================================
           BOTÃO EXPORTAR
        ===================================================== */

        .export-section {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 20px;
        }


        .export-section h2 {

            font-size: 19px;

            font-weight: 600;
        }


        .export-button {

            display: flex;

            align-items: center;

            gap: 8px;

            height: 42px;

            padding:
                0 17px;

            border:
                1px solid
                rgba(168,85,247,.30);

            border-radius: 11px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;

            transition:
                .2s;
        }


        .export-button:hover {

            background:
                rgba(168,85,247,.18);

            transform:
                translateY(-2px);
        }


        .export-button svg {

            width: 18px;
            height: 18px;
        }


        /* =====================================================
           GRÁFICOS
        ===================================================== */

        .charts-grid {

            display: grid;

            grid-template-columns:
                1.5fr 1fr;

            gap: 18px;

            margin-bottom: 22px;
        }


        .chart-card {

            padding: 20px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                rgba(18,16,24,.85);

            box-shadow:
                var(--sombra);
        }


        .chart-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 22px;
        }


        .chart-header h2 {

            font-size: 16px;

            font-weight: 600;
        }


        .chart-header span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        .chart-area {

            position: relative;

            height: 280px;

            width: 100%;
        }


        canvas {

            width: 100% !important;

            height: 100% !important;
        }


        /* =====================================================
           TABELA
        ===================================================== */

        .table-card {

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                rgba(18,16,24,.85);

            overflow: hidden;

            box-shadow:
                var(--sombra);
        }


        .table-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 20px;
        }


        .table-header h2 {

            font-size: 18px;

            font-weight: 600;
        }


        .table-header span {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        table {

            width: 100%;

            border-collapse:
                collapse;

            min-width: 650px;
        }


        th {

            padding:
                13px 20px;

            background:
                rgba(255,255,255,.025);

            color:
                var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-align: left;

            text-transform:
                uppercase;

            letter-spacing:
                .5px;
        }


        td {

            padding:
                15px 20px;

            border-top:
                1px solid
                var(--borda);

            color:
                var(--cinza);

            font-size: 11px;
        }


        td strong {

            color:
                white;

            font-size: 12px;
        }


        .badge {

            display: inline-block;

            padding:
                5px 9px;

            border-radius: 7px;

            font-size: 9px;

            font-weight: 700;
        }


        .badge.emergency {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.08);
        }


        .badge.test {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .badge.cancelled {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.05);
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            right: 25px;
            bottom: 25px;

            padding:
                13px 18px;

            border:
                1px solid
                rgba(168,85,247,.25);

            border-radius: 12px;

            background:
                #17131d;

            color:
                white;

            font-size: 12px;

            box-shadow:
                0 15px 40px
                rgba(0,0,0,.35);

            opacity: 0;

            transform:
                translateY(20px);

            pointer-events:
                none;

            transition:
                .3s;

            z-index: 3000;
        }


        .toast.show {

            opacity: 1;

            transform:
                translateY(0);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 1100px) {

            .summary-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }


            .charts-grid {

                grid-template-columns:
                    1fr;
            }
        }


        @media (max-width: 900px) {

            .sidebar {

                width: 215px;
            }


            .main {

                width:
                    calc(100% - 215px);

                margin-left:
                    215px;

                padding:
                    25px 20px;
            }


            .filters-card {

                flex-wrap: wrap;
            }


            .filter-group {

                min-width:
                    calc(50% - 10px);
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

                border-right:
                    none;

                border-top:
                    1px solid
                    var(--borda);

                flex-direction:
                    row;

                align-items:
                    center;

                justify-content:
                    center;
            }


            .logo,
            .admin-label,
            .sidebar-bottom {

                display: none;
            }


            .nav {

                width: 100%;

                flex-direction:
                    row;

                justify-content:
                    space-around;
            }


            .nav-button {

                width: auto;

                min-height: 58px;

                flex: 1;

                justify-content:
                    center;

                flex-direction:
                    column;

                gap: 3px;

                padding: 4px;

                font-size: 8px;

                text-align: center;
            }


            .nav-button svg {

                width: 20px;
                height: 20px;
            }


            .main {

                width: 100%;

                margin-left: 0;

                padding:
                    20px
                    15px
                    90px;
            }


            .page-title h1 {

                font-size: 24px;
            }


            .page-title p {

                font-size: 11px;
            }


            .summary-grid {

                grid-template-columns:
                    1fr 1fr;

                gap: 10px;
            }


            .summary-card {

                padding: 15px;
            }


            .summary-card strong {

                font-size: 23px;
            }


            .filters-card {

                flex-direction:
                    column;

                align-items:
                    stretch;
            }


            .filter-group {

                width: 100%;
            }


            .filter-button {

                width: 100%;
            }


            .export-section {

                align-items:
                    flex-start;

                gap: 12px;

                flex-direction:
                    column;
            }


            .chart-card {

                padding: 15px;
            }


            .chart-area {

                height: 240px;
            }
        }


        @media (max-width: 420px) {

            .summary-grid {

                grid-template-columns:
                    1fr;
            }


            .header-button {

                width: 40px;
                height: 40px;
            }
        }

    </style>
<style id="admin-sidebar-structure">
        /* Estrutura comum da sidebar administrativa */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            min-height: 100vh;
            padding: 25px 17px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: rgba(12, 10, 16, .96);
            border-right: 1px solid var(--borda, rgba(255, 255, 255, .08));
            z-index: 1000;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 30px;
            color: white;
            text-decoration: none;
        }

        .sidebar .brand-heart {
            width: 39px;
            height: 39px;
            color: var(--roxo-2, #b76cff);
            filter: drop-shadow(0 0 13px rgba(168, 85, 247, .35));
        }

        .sidebar .brand-name {
            font-size: 25px;
            font-weight: 750;
            letter-spacing: -1px;
        }

        .sidebar .brand-name .silent { color: var(--roxo-2, #b76cff); }
        .sidebar .brand-name .help { color: white; }

        .sidebar .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 13px 11px;
            margin-bottom: 24px;
            border: 1px solid var(--borda, rgba(255, 255, 255, .08));
            border-radius: 15px;
            background: rgba(255, 255, 255, .025);
        }

        .sidebar .admin-avatar {
            width: 39px;
            height: 39px;
            min-width: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--roxo, #a855f7), var(--roxo-escuro, #702db5));
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .sidebar .admin-info { min-width: 0; }
        .sidebar .admin-info strong { display: block; margin-bottom: 3px; font-size: 13px; }
        .sidebar .admin-info span { color: var(--cinza-2, #817b8c); font-size: 10px; }

        .sidebar .nav-label {
            color: var(--cinza-2, #817b8c);
            padding: 0 12px 9px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 100%;
        }

        .sidebar .sidebar-link {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            border: 1px solid transparent;
            border-radius: 13px;
            background: transparent;
            color: var(--cinza, #aaa5b4);
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.2;
            text-align: left;
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .sidebar .sidebar-link svg { width: 19px; height: 19px; flex: 0 0 19px; }
        .sidebar .sidebar-link:hover { color: white; background: rgba(168, 85, 247, .08); transform: translateX(2px); }
        .sidebar .sidebar-link.active { color: var(--roxo-claro, #d0a0ff); background: linear-gradient(100deg, rgba(168, 85, 247, .16), rgba(168, 85, 247, .06)); border-color: rgba(168, 85, 247, .18); }
        .sidebar .sidebar-link .link-badge { margin-left: auto; min-width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border-radius: 7px; background: rgba(255, 93, 115, .12); color: #ff8798; font-size: 9px; font-weight: 750; }

        .sidebar .sidebar-bottom { margin-top: auto; padding-top: 15px; border-top: 1px solid var(--borda, rgba(255, 255, 255, .08)); }
        .sidebar .sidebar-bottom .sidebar-link { margin: 0; }
    

        /* Barra de rolagem personalizada da área admin */
        html {
            scrollbar-width: thin;
            scrollbar-color: #9b5de5 #0c0a10;
        }

        .sidebar,
        body {
            scrollbar-width: thin;
            scrollbar-color: #9b5de5 transparent;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0c0a10;
            border-left: 1px solid rgba(255, 255, 255, .05);
        }

        ::-webkit-scrollbar-thumb {
            min-height: 42px;
            background: linear-gradient(180deg, #c084fc 0%, #8b4dcc 55%, #5f2f91 100%);
            border: 2px solid #0c0a10;
            border-radius: 999px;
            box-shadow: 0 0 9px rgba(168, 85, 247, .35);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #d8a7ff 0%, #a855f7 55%, #7030b5 100%);
            box-shadow: 0 0 13px rgba(168, 85, 247, .55);
        }

        ::-webkit-scrollbar-corner {
            background: #0c0a10;
        }

    </style>
</head>


<body>


<div class="layout">


    <!-- =====================================================
         MENU LATERAL
    ====================================================== -->

    <aside class="sidebar" id="sidebar">
    <div class="brand">
        <?php include '../components/logo.php'; ?>
    </div>

    <div class="admin-profile">
        <div class="admin-avatar">AD</div>
        <div class="admin-info">
            <strong>Administrador</strong>
            <span>Painel administrativo</span>
        </div>
    </div>

    <div class="nav-label">Principal</div>
    <nav class="sidebar-nav">
            <a href="admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                <span>Dashboard</span>
                
            </a>

            <a href="usuarios.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <span>Usuárias</span>
                
            </a>

            <a href="alertas.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <span>Alertas</span>
                <span class="link-badge">3</span>
            </a>

            <a href="mapa-admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                <span>Mapa de ocorrências</span>
                
            </a>

            <a href="dispositivos.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="9" y1="18" x2="15" y2="18"/></svg>
                <span>Dispositivos</span>
                
            </a>

            <a href="contatos-admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="4"/><path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/></svg>
                <span>Contatos</span>
                
            </a>

            <a href="relatorios.php" class="sidebar-link active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m7 16 4-5 3 3 5-7"/></svg>
                <span>Relatórios</span>
                
            </a>

            <a href="config-admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-2v-.48a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2h.48A1.7 1.7 0 0 0 8.04 11a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.42-1.42.06.06A1.7 1.7 0 0 0 11 8.04 1.7 1.7 0 0 0 12.03 6.48V6h2v.48A1.7 1.7 0 0 0 15.06 8a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 18.04 11c.24.63.84 1.03 1.56 1.03H20v2h-.48A1.7 1.7 0 0 0 19.4 15Z"/></svg>
                <span>Configurações</span>
                
            </a>
    </nav>

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
                    <span>Relatórios</span>
                </h1>

                <p>
                    Consulte e gere informações do sistema SilentHelp.
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
             FILTROS
        ================================================== -->

        <section class="filters-card">


            <div class="filter-group">

                <label for="periodo">
                    Período
                </label>

                <select id="periodo">

                    <option value="hoje">
                        Hoje
                    </option>

                    <option value="7dias">
                        Últimos 7 dias
                    </option>

                    <option value="30dias">
                        Últimos 30 dias
                    </option>

                    <option value="ano">
                        Este ano
                    </option>

                    <option value="todos">
                        Todo o período
                    </option>

                </select>

            </div>


            <div class="filter-group">

                <label for="tipo">
                    Tipo de alerta
                </label>

                <select id="tipo">

                    <option value="todos">
                        Todos os tipos
                    </option>

                    <option value="emergency">
                        Emergência
                    </option>

                    <option value="test">
                        Teste
                    </option>

                    <option value="cancelled">
                        Cancelado
                    </option>

                </select>

            </div>


            <button
                class="filter-button"
                onclick="applyFilters()"
            >

                Gerar relatório

            </button>

        </section>



        <!-- =================================================
             RESUMO
        ================================================== -->

        <section class="summary-grid">


            <!-- ALERTAS -->

            <article class="summary-card alertas">

                <div class="summary-top">

                    <div class="summary-icon">

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

                    </div>

                </div>

                <h3>
                    Alertas registrados
                </h3>

                <strong id="totalAlertas">
                    128
                </strong>

            </article>


            <!-- USUÁRIAS -->

            <article class="summary-card usuarios">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >

                            <circle
                                cx="9"
                                cy="8"
                                r="4"
                            />

                            <path
                                d="M2 21a7 7 0 0 1 14 0"
                            />

                            <path
                                d="M16 4.5a4 4 0 0 1 0 7"
                            />

                        </svg>

                    </div>

                </div>

                <h3>
                    Usuárias cadastradas
                </h3>

                <strong id="totalUsuarios">
                    86
                </strong>

            </article>


            <!-- DISPOSITIVOS -->

            <article class="summary-card dispositivos">

                <div class="summary-top">

                    <div class="summary-icon">

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
                                y1="5"
                                x2="14"
                                y2="5"
                            />

                        </svg>

                    </div>

                </div>

                <h3>
                    Dispositivos ativos
                </h3>

                <strong id="totalDispositivos">
                    73
                </strong>

            </article>


            <!-- ALERTAS ATIVOS -->

            <article class="summary-card ativos">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                d="M12 7v5l3 2"
                            />

                        </svg>

                    </div>

                </div>

                <h3>
                    Alertas ativos
                </h3>

                <strong id="totalAtivos">
                    4
                </strong>

            </article>

        </section>



        <!-- =================================================
             EXPORTAÇÃO
        ================================================== -->

        <section class="export-section">

            <h2>
                Análise dos dados
            </h2>


            <button
                class="export-button"
                onclick="exportReport()"
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
                        d="M12 3v12"
                    />

                    <path
                        d="m7 10 5 5 5-5"
                    />

                    <path
                        d="M5 21h14"
                    />

                </svg>

                Exportar relatório

            </button>

        </section>



        <!-- =================================================
             GRÁFICOS
        ================================================== -->

        <section class="charts-grid">


            <!-- ALERTAS POR PERÍODO -->

            <article class="chart-card">

                <div class="chart-header">

                    <h2>
                        Alertas por período
                    </h2>

                    <span>
                        Últimos 7 dias
                    </span>

                </div>


                <div class="chart-area">

                    <canvas
                        id="periodChart"
                    ></canvas>

                </div>

            </article>



            <!-- ALERTAS POR TIPO -->

            <article class="chart-card">

                <div class="chart-header">

                    <h2>
                        Alertas por tipo
                    </h2>

                    <span>
                        Distribuição
                    </span>

                </div>


                <div class="chart-area">

                    <canvas
                        id="typeChart"
                    ></canvas>

                </div>

            </article>

        </section>



        <!-- =================================================
             TABELA
        ================================================== -->

        <section class="table-card">


            <div class="table-header">

                <h2>
                    Resumo dos alertas
                </h2>

                <span>
                    Dados do período selecionado
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Quantidade
                            </th>

                            <th>
                                Percentual
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <tr>

                            <td>
                                <span class="badge emergency">
                                    Emergência
                                </span>
                            </td>

                            <td>
                                <strong id="emergencyCount">
                                    52
                                </strong>
                            </td>

                            <td>
                                40,6%
                            </td>

                            <td>
                                Maior ocorrência
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge test">
                                    Teste
                                </span>
                            </td>

                            <td>
                                <strong>
                                    61
                                </strong>
                            </td>

                            <td>
                                47,7%
                            </td>

                            <td>
                                Testes realizados
                            </td>

                        </tr>


                        <tr>

                            <td>
                                <span class="badge cancelled">
                                    Cancelado
                                </span>
                            </td>

                            <td>
                                <strong>
                                    15
                                </strong>
                            </td>

                            <td>
                                11,7%
                            </td>

                            <td>
                                Cancelamentos
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>



<!-- =====================================================
     TOAST
====================================================== -->

<div
    class="toast"
    id="toast"
>
    Relatório atualizado.
</div>



<!-- =====================================================
     CHART.JS
====================================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    /* =====================================================
       NAVEGAÇÃO
    ===================================================== */

    function goTo(page) {

        window.location.href = page;

    }



    /* =====================================================
       GRÁFICO POR PERÍODO
    ===================================================== */

    const periodCtx =
        document
            .getElementById("periodChart")
            .getContext("2d");


    new Chart(
        periodCtx,
        {

            type: "line",

            data: {

                labels: [
                    "09/08",
                    "10/08",
                    "11/08",
                    "12/08",
                    "13/08",
                    "14/08",
                    "15/08"
                ],

                datasets: [

                    {
                        label: "Alertas",

                        data: [
                            12,
                            18,
                            15,
                            22,
                            17,
                            25,
                            19
                        ],

                        borderColor:
                            "#a855f7",

                        backgroundColor:
                            "rgba(168,85,247,.12)",

                        borderWidth: 2,

                        tension: .4,

                        fill: true,

                        pointRadius: 4,

                        pointBackgroundColor:
                            "#b76cff"
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    x: {

                        grid: {
                            color:
                                "rgba(255,255,255,.05)"
                        },

                        ticks: {
                            color:
                                "#817b8c",

                            font: {
                                size: 10
                            }
                        }

                    },

                    y: {

                        beginAtZero: true,

                        grid: {
                            color:
                                "rgba(255,255,255,.05)"
                        },

                        ticks: {

                            color:
                                "#817b8c",

                            font: {
                                size: 10
                            }

                        }

                    }

                }

            }

        }
    );



    /* =====================================================
       GRÁFICO POR TIPO
    ===================================================== */

    const typeCtx =
        document
            .getElementById("typeChart")
            .getContext("2d");


    new Chart(
        typeCtx,
        {

            type: "doughnut",

            data: {

                labels: [
                    "Emergência",
                    "Teste",
                    "Cancelado"
                ],

                datasets: [

                    {

                        data: [
                            52,
                            61,
                            15
                        ],

                        backgroundColor: [

                            "#ff5d73",
                            "#55df91",
                            "#817b8c"

                        ],

                        borderColor:
                            "#121018",

                        borderWidth: 4

                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: "68%",

                plugins: {

                    legend: {

                        position: "bottom",

                        labels: {

                            color:
                                "#aaa5b4",

                            padding: 18,

                            font: {
                                size: 10
                            }

                        }

                    }

                }

            }

        }
    );



    /* =====================================================
       FILTROS
    ===================================================== */

    function applyFilters() {

        const periodo =
            document
                .getElementById("periodo")
                .value;

        const tipo =
            document
                .getElementById("tipo")
                .value;


        let total = 128;


        if (periodo === "hoje") {

            total = 19;

        }

        else if (periodo === "7dias") {

            total = 128;

        }

        else if (periodo === "30dias") {

            total = 487;

        }

        else if (periodo === "ano") {

            total = 3120;

        }

        else if (periodo === "todos") {

            total = 5680;

        }


        if (tipo === "emergency") {

            total =
                Math.round(total * .406);

        }

        else if (tipo === "test") {

            total =
                Math.round(total * .477);

        }

        else if (tipo === "cancelled") {

            total =
                Math.round(total * .117);

        }


        document
            .getElementById("totalAlertas")
            .textContent = total;


        showToast(
            "Relatório atualizado com os filtros selecionados."
        );

    }



    /* =====================================================
       EXPORTAR RELATÓRIO
    ===================================================== */

    function exportReport() {

        const periodo =
            document
                .getElementById("periodo")
                .value;

        const tipo =
            document
                .getElementById("tipo")
                .value;


        const data = [

            ["RELATÓRIO SILENTHELP"],

            [],

            ["Período", periodo],

            ["Tipo de alerta", tipo],

            [],

            ["Indicador", "Quantidade"],

            [
                "Alertas registrados",
                document
                    .getElementById("totalAlertas")
                    .textContent
            ],

            [
                "Usuárias cadastradas",
                document
                    .getElementById("totalUsuarios")
                    .textContent
            ],

            [
                "Dispositivos ativos",
                document
                    .getElementById("totalDispositivos")
                    .textContent
            ],

            [
                "Alertas ativos",
                document
                    .getElementById("totalAtivos")
                    .textContent
            ]

        ];


        const csv =
            data
                .map(
                    row =>
                        row
                            .map(
                                value =>
                                    `"${value}"`
                            )
                            .join(";")
                )
                .join("\n");


        const blob =
            new Blob(
                [csv],
                {
                    type:
                        "text/csv;charset=utf-8;"
                }
            );


        const url =
            URL.createObjectURL(blob);


        const link =
            document.createElement("a");


        link.href = url;

        link.download =
            "relatorio-silenthelp.csv";


        document
            .body
            .appendChild(link);


        link.click();


        document
            .body
            .removeChild(link);


        URL.revokeObjectURL(url);


        showToast(
            "Relatório exportado com sucesso."
        );

    }



    /* =====================================================
       NOTIFICAÇÃO
    ===================================================== */

    function showNotification() {

        showToast(
            "Você não possui novas notificações."
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


        toast.classList.add("show");


        setTimeout(
            () => {

                toast.classList.remove("show");

            },
            3000
        );

    }

</script>

<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>