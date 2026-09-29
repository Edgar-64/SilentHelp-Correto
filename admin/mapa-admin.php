<?php require_once __DIR__ . '/../auth.php';?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Mapa de Ocorrências</title>

    <!-- =====================================================
         LEAFLET
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

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
           MENU LATERAL
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

            cursor: default;
        }


        .logo-heart {

            width: 42px;
            height: 42px;

            color: var(--roxo-2);

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

            background: transparent;

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
           RODAPÉ DO MENU
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
           CONTEÚDO
        ===================================================== */

        .main {

            width: calc(100% - 250px);

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

            margin-bottom: 18px;

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

            font-family: inherit;

            cursor: pointer;
        }


        .filter-group select:focus {

            border-color:
                rgba(168,85,247,.5);
        }


        .filter-button {

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


        .filter-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(168,85,247,.25);
        }


        /* =====================================================
           LEGENDA
        ===================================================== */

        .legend {

            display: flex;

            align-items: center;

            gap: 18px;

            padding:
                0 4px
                14px;

            color:
                var(--cinza);

            font-size: 11px;
        }


        .legend-item {

            display: flex;

            align-items: center;

            gap: 7px;
        }


        .legend-dot {

            width: 10px;
            height: 10px;

            border-radius: 50%;
        }


        .legend-dot.emergency {

            background:
                var(--vermelho);

            box-shadow:
                0 0 8px
                rgba(255,93,115,.5);
        }


        .legend-dot.test {

            background:
                var(--verde);
        }


        .legend-dot.cancelled {

            background:
                var(--cinza-2);
        }


        .legend-dot.active {

            background:
                var(--amarelo);

            box-shadow:
                0 0 8px
                rgba(244,201,93,.5);
        }


        /* =====================================================
           MAPA
        ===================================================== */

        .map-card {

            position: relative;

            width: 100%;

            height: 580px;

            overflow: hidden;

            border:
                1px solid
                rgba(168,85,247,.20);

            border-radius: 22px;

            background:
                #15131a;

            box-shadow:
                0 20px 60px
                rgba(0,0,0,.35);
        }


        #map {

            width: 100%;

            height: 100%;
        }


        /* =====================================================
           CONTADOR DO MAPA
        ===================================================== */

        .map-stats {

            position: absolute;

            top: 15px;
            left: 15px;

            display: flex;

            gap: 8px;

            z-index: 500;

            pointer-events: none;
        }


        .map-stat {

            padding:
                9px 12px;

            border:
                1px solid
                rgba(255,255,255,.10);

            border-radius: 11px;

            background:
                rgba(12,10,16,.90);

            backdrop-filter:
                blur(12px);

            font-size: 11px;

            color:
                var(--cinza);
        }


        .map-stat strong {

            color: white;

            margin-right: 4px;
        }


        .map-stat.active strong {

            color:
                var(--amarelo);
        }


        /* =====================================================
           OCORRÊNCIAS
        ===================================================== */

        .occurrences {

            margin-top: 25px;
        }


        .section-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 14px;
        }


        .section-header h2 {

            font-size: 19px;

            font-weight: 600;
        }


        .section-header span {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .occurrence-list {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }


        .occurrence {

            display: flex;

            align-items: center;

            gap: 13px;

            padding: 15px;

            border:
                1px solid
                var(--borda);

            border-radius: 16px;

            background:
                rgba(18,16,24,.85);

            transition: .2s;
        }


        .occurrence:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(168,85,247,.3);
        }


        .occurrence-icon {

            width: 43px;
            height: 43px;

            min-width: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(255,93,115,.09);

            color:
                var(--vermelho);
        }


        .occurrence-icon.test {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .occurrence-icon.cancelled {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.05);
        }


        .occurrence-icon svg {

            width: 21px;
            height: 21px;
        }


        .occurrence-info {

            flex: 1;

            min-width: 0;
        }


        .occurrence-info h3 {

            font-size: 13px;

            margin-bottom: 4px;
        }


        .occurrence-info p {

            color:
                var(--cinza);

            font-size: 10px;
        }


        .status {

            padding:
                5px 8px;

            border-radius: 7px;

            font-size: 9px;

            font-weight: 700;
        }


        .status.active {

            color:
                var(--amarelo);

            background:
                rgba(244,201,93,.08);
        }


        .status.resolved {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .status.cancelled {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.05);
        }


        /* =====================================================
           LEAFLET
        ===================================================== */

        .leaflet-container {

            background:
                #17151c;
        }


        .leaflet-control-zoom a {

            background:
                #17151c !important;

            color:
                white !important;

            border-color:
                rgba(255,255,255,.1) !important;
        }


        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {

            background:
                #17131d;

            color:
                white;
        }


        .leaflet-popup-content {

            margin: 14px;

            min-width: 180px;
        }


        .popup-title {

            font-size: 14px;

            font-weight: 700;

            margin-bottom: 6px;
        }


        .popup-line {

            color:
                #aaa5b4;

            font-size: 11px;

            margin-top: 4px;
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {

                width: 215px;
            }


            .main {

                width: calc(100% - 215px);

                margin-left: 215px;

                padding:
                    25px 20px;
            }


            .occurrence-list {

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


            .logo,
            .brand,
            .admin-label,
            .sidebar-bottom {

                display: none;
            }


            .nav {

                width: 100%;

                flex-direction: row;

                justify-content: space-around;

                gap: 2px;
            }


            .nav-button {

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


            .nav-button svg {

                width: 21px;
                height: 21px;
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


            .filters-card {

                flex-direction: column;

                align-items: stretch;
            }


            .filter-group {

                width: 100%;
            }


            .filter-button {

                width: 100%;
            }


            .legend {

                flex-wrap: wrap;

                gap: 10px;
            }


            .map-card {

                height: 470px;
            }


            .map-stats {

                flex-wrap: wrap;

                max-width: 90%;
            }


            .map-stat {

                font-size: 9px;

                padding:
                    7px 9px;
            }
        }


        @media (max-width: 420px) {

            .map-card {

                height: 420px;
            }


            .section-header h2 {

                font-size: 17px;
            }


            .occurrence {

                padding: 12px;
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
            cursor: default;
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
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar" id="sidebar">
    <div class="brand">
        <svg class="brand-heart" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="brand-name"><span class="silent">Silent</span><span class="help">Help</span></div>
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

            <a href="mapa-admin.php" class="sidebar-link active">
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

            <a href="relatorios.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m7 16 4-5 3 3 5-7"/></svg>
                <span>Relatórios</span>
                
            </a>

            <a href="config-admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-2v-.48a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2h.48A1.7 1.7 0 0 0 8.04 11a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.42-1.42.06.06A1.7 1.7 0 0 0 11 8.04 1.7 1.7 0 0 0 12.03 6.48V6h2v.48A1.7 1.7 0 0 0 15.06 8a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 18.04 11c.24.63.84 1.03 1.56 1.03H20v2h-.48A1.7 1.7 0 0 0 19.4 15Z"/></svg>
                <span>Configurações</span>
                
            </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="login-admin.php" class="sidebar-link" onclick="if (typeof logout === 'function') { logout(); return false; }">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            <span>Sair</span>
        </a>
    </div>
</aside>



    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

    <main class="main">


        <!-- =================================================
             HEADER
        ================================================== -->

        <header class="top-header">

            <div class="page-title">

                <h1>
                    Mapa de <span>ocorrências</span>
                </h1>

                <p>
                    Acompanhe a localização dos alertas registrados.
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

                    <option value="todos">
                        Todos os períodos
                    </option>

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


            <div class="filter-group">

                <label for="status">
                    Status
                </label>

                <select id="status">

                    <option value="todos">
                        Todos
                    </option>

                    <option value="active">
                        Ativos
                    </option>

                    <option value="resolved">
                        Resolvidos
                    </option>

                    <option value="cancelled">
                        Cancelados
                    </option>

                </select>

            </div>


            <button
                class="filter-button"
                onclick="applyFilters()"
            >

                Aplicar filtros

            </button>

        </section>



        <!-- =================================================
             LEGENDA
        ================================================== -->

        <div class="legend">

            <div class="legend-item">

                <span class="legend-dot emergency"></span>

                Emergência

            </div>


            <div class="legend-item">

                <span class="legend-dot active"></span>

                Alerta ativo

            </div>


            <div class="legend-item">

                <span class="legend-dot test"></span>

                Teste

            </div>


            <div class="legend-item">

                <span class="legend-dot cancelled"></span>

                Cancelado

            </div>

        </div>



        <!-- =================================================
             MAPA
        ================================================== -->

        <section class="map-card">


            <div class="map-stats">

                <div class="map-stat">

                    <strong id="mapTotal">
                        8
                    </strong>

                    ocorrências

                </div>


                <div class="map-stat active">

                    <strong id="mapActive">
                        2
                    </strong>

                    ativas

                </div>

            </div>


            <div id="map"></div>

        </section>



        <!-- =================================================
             OCORRÊNCIAS RECENTES
        ================================================== -->

        <section class="occurrences">


            <div class="section-header">

                <h2>
                    Ocorrências recentes
                </h2>

                <span id="occurrenceCount">
                    4 ocorrências
                </span>

            </div>


            <div
                class="occurrence-list"
                id="occurrenceList"
            >


                <!-- OCORRÊNCIA 1 -->

                <article
                    class="occurrence"
                    data-type="emergency"
                    data-status="active"
                >

                    <div class="occurrence-icon">

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

                    </div>


                    <div class="occurrence-info">

                        <h3>
                            Alerta de emergência
                        </h3>

                        <p>
                            Usuária: Ana Silva • Hoje, 10:42
                        </p>

                    </div>


                    <span class="status active">
                        Ativo
                    </span>

                </article>



                <!-- OCORRÊNCIA 2 -->

                <article
                    class="occurrence"
                    data-type="emergency"
                    data-status="resolved"
                >

                    <div class="occurrence-icon">

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

                    </div>


                    <div class="occurrence-info">

                        <h3>
                            Alerta de emergência
                        </h3>

                        <p>
                            Usuária: Beatriz Santos • Hoje, 08:15
                        </p>

                    </div>


                    <span class="status resolved">
                        Resolvido
                    </span>

                </article>



                <!-- OCORRÊNCIA 3 -->

                <article
                    class="occurrence"
                    data-type="test"
                    data-status="resolved"
                >

                    <div class="occurrence-icon test">

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
                                d="m8 12 2.5 2.5L16 9"
                            />

                        </svg>

                    </div>


                    <div class="occurrence-info">

                        <h3>
                            Teste de segurança
                        </h3>

                        <p>
                            Usuária: Carla Oliveira • Ontem, 21:37
                        </p>

                    </div>


                    <span class="status resolved">
                        Resolvido
                    </span>

                </article>



                <!-- OCORRÊNCIA 4 -->

                <article
                    class="occurrence"
                    data-type="cancelled"
                    data-status="cancelled"
                >

                    <div class="occurrence-icon cancelled">

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
                                d="m9 9 6 6"
                            />

                            <path
                                d="m15 9-6 6"
                            />

                        </svg>

                    </div>


                    <div class="occurrence-info">

                        <h3>
                            Alerta cancelado
                        </h3>

                        <p>
                            Usuária: Mariana Costa • 14/08/2026
                        </p>

                    </div>


                    <span class="status cancelled">
                        Cancelado
                    </span>

                </article>

            </div>

        </section>

    </main>

</div>



<!-- =====================================================
     LEAFLET
====================================================== -->

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

    /* =====================================================
       MAPA
    ===================================================== */

    const map =
        L.map("map").setView(
            [-23.0227, -45.5550],
            13
        );


    L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution:
                '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);



    /* =====================================================
       ÍCONES
    ===================================================== */

    function createIcon(color) {

        return L.divIcon({

            className: "",

            html: `
                <div style="
                    width: 18px;
                    height: 18px;
                    border-radius: 50%;
                    background: ${color};
                    border: 3px solid white;
                    box-shadow: 0 0 14px ${color};
                "></div>
            `,

            iconSize: [18,18],

            iconAnchor: [9,9],

            popupAnchor: [0,-10]

        });

    }


    const emergencyIcon =
        createIcon("#ff5d73");


    const activeIcon =
        createIcon("#f4c95d");


    const testIcon =
        createIcon("#55df91");


    const cancelledIcon =
        createIcon("#817b8c");



    /* =====================================================
       OCORRÊNCIAS
    ===================================================== */

    const occurrences = [

        {
            lat: -23.0227,
            lng: -45.5550,
            type: "emergency",
            status: "active",
            title: "Alerta de emergência",
            user: "Ana Silva",
            date: "Hoje, 10:42"
        },

        {
            lat: -23.0305,
            lng: -45.5480,
            type: "emergency",
            status: "resolved",
            title: "Alerta de emergência",
            user: "Beatriz Santos",
            date: "Hoje, 08:15"
        },

        {
            lat: -23.0150,
            lng: -45.5620,
            type: "test",
            status: "resolved",
            title: "Teste de segurança",
            user: "Carla Oliveira",
            date: "Ontem, 21:37"
        },

        {
            lat: -23.0380,
            lng: -45.5700,
            type: "cancelled",
            status: "cancelled",
            title: "Alerta cancelado",
            user: "Mariana Costa",
            date: "14/08/2026"
        },

        {
            lat: -23.0100,
            lng: -45.5400,
            type: "emergency",
            status: "active",
            title: "Alerta de emergência",
            user: "Juliana Souza",
            date: "13/08/2026"
        },

        {
            lat: -23.0270,
            lng: -45.5750,
            type: "test",
            status: "resolved",
            title: "Teste de segurança",
            user: "Fernanda Lima",
            date: "12/08/2026"
        },

        {
            lat: -23.0450,
            lng: -45.5500,
            type: "emergency",
            status: "resolved",
            title: "Alerta de emergência",
            user: "Larissa Alves",
            date: "11/08/2026"
        },

        {
            lat: -23.0180,
            lng: -45.5300,
            type: "cancelled",
            status: "cancelled",
            title: "Alerta cancelado",
            user: "Camila Rocha",
            date: "10/08/2026"
        }

    ];


    let markers = [];



    /* =====================================================
       ADICIONAR MARCADORES
    ===================================================== */

    function renderMarkers() {

        markers.forEach(marker => {

            map.removeLayer(marker);

        });

        markers = [];


        occurrences.forEach(item => {

            let icon;


            if (
                item.type === "emergency" &&
                item.status === "active"
            ) {

                icon = activeIcon;

            }

            else if (
                item.type === "emergency"
            ) {

                icon = emergencyIcon;

            }

            else if (
                item.type === "test"
            ) {

                icon = testIcon;

            }

            else {

                icon = cancelledIcon;

            }


            const marker =
                L.marker(
                    [item.lat, item.lng],
                    { icon }
                ).addTo(map);


            marker.bindPopup(`

                <div class="popup-title">
                    ${item.title}
                </div>

                <div class="popup-line">
                    Usuária: ${item.user}
                </div>

                <div class="popup-line">
                    Data: ${item.date}
                </div>

                <div class="popup-line">
                    Status: ${getStatusName(item.status)}
                </div>

            `);


            marker.data = item;

            markers.push(marker);

        });

    }


    renderMarkers();



    /* =====================================================
       STATUS
    ===================================================== */

    function getStatusName(status) {

        if (status === "active") {
            return "Ativo";
        }

        if (status === "resolved") {
            return "Resolvido";
        }

        if (status === "cancelled") {
            return "Cancelado";
        }

        return status;
    }



    /* =====================================================
       FILTROS
    ===================================================== */

    function applyFilters() {

        const type =
            document.getElementById("tipo").value;

        const status =
            document.getElementById("status").value;


        markers.forEach(marker => {

            const item =
                marker.data;


            const typeMatch =
                type === "todos" ||
                item.type === type;


            const statusMatch =
                status === "todos" ||
                item.status === status;


            if (
                typeMatch &&
                statusMatch
            ) {

                if (!map.hasLayer(marker)) {

                    marker.addTo(map);

                }

            }

            else {

                if (map.hasLayer(marker)) {

                    map.removeLayer(marker);

                }

            }

        });


        updateMapCounters();


        updateOccurrenceList(
            type,
            status
        );


        showNotification(
            "Filtros aplicados com sucesso."
        );

    }



    /* =====================================================
       CONTADORES
    ===================================================== */

    function updateMapCounters() {

        const visible =
            markers.filter(
                marker =>
                    map.hasLayer(marker)
            );


        const active =
            visible.filter(
                marker =>
                    marker.data.status === "active"
            );


        document.getElementById(
            "mapTotal"
        ).textContent =
            visible.length;


        document.getElementById(
            "mapActive"
        ).textContent =
            active.length;

    }



    /* =====================================================
       LISTA
    ===================================================== */

    function updateOccurrenceList(
        type,
        status
    ) {

        const cards =
            document.querySelectorAll(
                ".occurrence"
            );


        let visible = 0;


        cards.forEach(card => {

            const cardType =
                card.dataset.type;

            const cardStatus =
                card.dataset.status;


            const typeMatch =
                type === "todos" ||
                cardType === type;


            const statusMatch =
                status === "todos" ||
                cardStatus === status;


            if (
                typeMatch &&
                statusMatch
            ) {

                card.style.display =
                    "flex";

                visible++;

            }

            else {

                card.style.display =
                    "none";

            }

        });


        document.getElementById(
            "occurrenceCount"
        ).textContent =
            visible +
            (
                visible === 1
                    ? " ocorrência"
                    : " ocorrências"
            );

    }



    /* =====================================================
       NOTIFICAÇÃO
    ===================================================== */

    function showNotification(
        message = "Você não possui novas notificações."
    ) {

        alert(message);

    }



    /* =====================================================
       NAVEGAÇÃO
    ===================================================== */

    function goTo(page) {

        window.location.href =
            page;

    }

</script>

<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>