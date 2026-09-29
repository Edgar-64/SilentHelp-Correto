<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Contatos de Confiança</title>

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
           CARDS DE RESUMO
        ===================================================== */

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 15px;

            margin-bottom: 25px;
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

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .summary-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            color:
                var(--roxo-claro);

            background:
                rgba(168,85,247,.10);
        }


        .summary-icon svg {

            width: 23px;
            height: 23px;
        }


        .summary-info span {

            display: block;

            color:
                var(--cinza);

            font-size: 11px;

            margin-bottom: 4px;
        }


        .summary-info strong {

            display: block;

            font-size: 23px;

            font-weight: 700;
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


        .filter-group input,
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
        }


        .filter-group input:focus,
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
           TABELA
        ===================================================== */

        .table-card {

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                rgba(18,16,24,.85);

            box-shadow:
                var(--sombra);
        }


        .table-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                20px 22px;

            border-bottom:
                1px solid
                var(--borda);
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

            border-collapse: collapse;

            min-width: 800px;
        }


        thead {

            background:
                rgba(255,255,255,.025);
        }


        th {

            padding:
                14px 18px;

            color:
                var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: .5px;

            white-space: nowrap;
        }


        td {

            padding:
                16px 18px;

            border-top:
                1px solid
                var(--borda);

            color:
                var(--cinza);

            font-size: 12px;

            white-space: nowrap;
        }


        tbody tr {

            transition:
                .2s;
        }


        tbody tr:hover {

            background:
                rgba(168,85,247,.035);
        }


        /* =====================================================
           CONTATO
        ===================================================== */

        .contact-cell {

            display: flex;

            align-items: center;

            gap: 11px;
        }


        .contact-avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(168,85,247,.12);

            color:
                var(--roxo-claro);

            font-size: 11px;

            font-weight: 700;
        }


        .contact-name strong {

            display: block;

            color:
                white;

            font-size: 12px;

            margin-bottom: 3px;
        }


        .contact-name span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           USUÁRIA
        ===================================================== */

        .user-name {

            color:
                white;

            font-weight: 600;
        }


        /* =====================================================
           QUANTIDADE
        ===================================================== */

        .quantity {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 32px;

            height: 28px;

            padding:
                0 9px;

            border-radius: 8px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding:
                6px 9px;

            border-radius: 8px;

            font-size: 9px;

            font-weight: 700;
        }


        .status::before {

            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;
        }


        .status.active {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .status.active::before {

            background:
                var(--verde);

            box-shadow:
                0 0 7px
                rgba(85,223,145,.5);
        }


        .status.inactive {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.05);
        }


        .status.inactive::before {

            background:
                var(--cinza-2);
        }


        /* =====================================================
           BOTÃO DETALHES
        ===================================================== */

        .details-button {

            height: 32px;

            padding:
                0 11px;

            border:
                1px solid
                rgba(168,85,247,.20);

            border-radius: 9px;

            background:
                rgba(168,85,247,.06);

            color:
                var(--roxo-claro);

            font-size: 10px;

            font-weight: 650;

            cursor: pointer;

            transition: .2s;
        }


        .details-button:hover {

            background:
                rgba(168,85,247,.15);

            border-color:
                rgba(168,85,247,.35);
        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal-overlay {

            position: fixed;

            inset: 0;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(0,0,0,.70);

            backdrop-filter:
                blur(7px);

            z-index: 3000;
        }


        .modal-overlay.show {

            display: flex;
        }


        .modal {

            width: 100%;

            max-width: 470px;

            padding: 25px;

            border:
                1px solid
                rgba(168,85,247,.20);

            border-radius: 22px;

            background:
                #121018;

            box-shadow:
                0 30px 80px
                rgba(0,0,0,.5);
        }


        .modal-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 20px;
        }


        .modal-header h2 {

            font-size: 20px;

            font-weight: 650;
        }


        .close-button {

            width: 35px;
            height: 35px;

            border:
                1px solid
                var(--borda);

            border-radius: 10px;

            background:
                rgba(255,255,255,.03);

            color:
                var(--cinza);

            cursor: pointer;
        }


        .modal-info {

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 12px;
        }


        .info-box {

            padding: 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255,255,255,.025);
        }


        .info-box.full {

            grid-column:
                1 / -1;
        }


        .info-box span {

            display: block;

            color:
                var(--cinza-2);

            font-size: 10px;

            margin-bottom: 5px;
        }


        .info-box strong {

            color:
                white;

            font-size: 12px;
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 1050px) {

            .summary-grid {

                grid-template-columns:
                    repeat(2, 1fr);
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

                border-right: none;

                border-top:
                    1px solid
                    var(--borda);

                flex-direction: row;

                align-items: center;

                justify-content: center;
            }


            .logo,
            .admin-label,
            .sidebar-bottom {

                display: none;
            }


            .nav {

                width: 100%;

                flex-direction: row;

                justify-content: space-around;
            }


            .nav-button {

                width: auto;

                min-height: 58px;

                flex: 1;

                justify-content: center;

                flex-direction: column;

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


            .top-header {

                margin-bottom: 20px;
            }


            .page-title h1 {

                font-size: 24px;
            }


            .page-title p {

                font-size: 11px;
            }


            .summary-grid {

                grid-template-columns:
                    1fr;
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


            .modal-info {

                grid-template-columns:
                    1fr;
            }


            .info-box.full {

                grid-column:
                    auto;
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

            <a href="mapa-admin.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                <span>Mapa de ocorrências</span>
                
            </a>

            <a href="dispositivos.php" class="sidebar-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="9" y1="18" x2="15" y2="18"/></svg>
                <span>Dispositivos</span>
                
            </a>

            <a href="contatos-admin.php" class="sidebar-link active">
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


        <!-- HEADER -->

        <header class="top-header">

            <div class="page-title">

                <h1>
                    Contatos de <span>confiança</span>
                </h1>

                <p>
                    Visualize os contatos cadastrados pelas usuárias.
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
             RESUMO
        ================================================== -->

        <section class="summary-grid">


            <!-- TOTAL DE CONTATOS -->

            <div class="summary-card">

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
                            d="M16 11a4 4 0 0 0 0-8"
                        />

                    </svg>

                </div>


                <div class="summary-info">

                    <span>
                        Total de contatos
                    </span>

                    <strong id="totalContacts">
                        8
                    </strong>

                </div>

            </div>



            <!-- USUÁRIAS COM CONTATOS -->

            <div class="summary-card">

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
                            d="M16 8h5"
                        />

                        <path
                            d="M18.5 5.5v5"
                        />

                    </svg>

                </div>


                <div class="summary-info">

                    <span>
                        Usuárias com contatos
                    </span>

                    <strong id="totalUsers">
                        5
                    </strong>

                </div>

            </div>



            <!-- CONTATOS ATIVOS -->

            <div class="summary-card">

                <div class="summary-icon">

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
                            r="9"
                        />

                        <path
                            d="m8 12 2.5 2.5L16 9"
                        />

                    </svg>

                </div>


                <div class="summary-info">

                    <span>
                        Contatos ativos
                    </span>

                    <strong id="activeContacts">
                        7
                    </strong>

                </div>

            </div>


        </section>



        <!-- =================================================
             FILTROS
        ================================================== -->

        <section class="filters-card">


            <div class="filter-group">

                <label for="search">
                    Buscar contato
                </label>

                <input
                    type="text"
                    id="search"
                    placeholder="Nome ou telefone..."
                >

            </div>


            <div class="filter-group">

                <label for="statusFilter">
                    Status
                </label>

                <select id="statusFilter">

                    <option value="todos">
                        Todos
                    </option>

                    <option value="active">
                        Ativo
                    </option>

                    <option value="inactive">
                        Inativo
                    </option>

                </select>

            </div>


            <div class="filter-group">

                <label for="userFilter">
                    Usuária
                </label>

                <select id="userFilter">

                    <option value="todos">
                        Todas as usuárias
                    </option>

                    <option value="Ana Silva">
                        Ana Silva
                    </option>

                    <option value="Beatriz Santos">
                        Beatriz Santos
                    </option>

                    <option value="Carla Oliveira">
                        Carla Oliveira
                    </option>

                    <option value="Mariana Costa">
                        Mariana Costa
                    </option>

                    <option value="Juliana Souza">
                        Juliana Souza
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
             TABELA
        ================================================== -->

        <section class="table-card">


            <div class="table-header">

                <h2>
                    Contatos cadastrados
                </h2>

                <span id="contactCount">
                    8 contatos
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                Nome do contato
                            </th>

                            <th>
                                Telefone
                            </th>

                            <th>
                                Usuária vinculada
                            </th>

                            <th>
                                Contatos da usuária
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Ação
                            </th>

                        </tr>

                    </thead>


                    <tbody id="contactsTable">


                        <!-- CONTATO 1 -->

                        <tr
                            data-status="active"
                            data-user="Ana Silva"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        CS
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Carlos Silva
                                        </strong>

                                        <span>
                                            Contato principal
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 99999-1111
                            </td>


                            <td class="user-name">
                                Ana Silva
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Carlos Silva',
                                        '(12) 99999-1111',
                                        'Ana Silva',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 2 -->

                        <tr
                            data-status="active"
                            data-user="Ana Silva"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        MS
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Maria Silva
                                        </strong>

                                        <span>
                                            Contato de confiança
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 98888-2222
                            </td>


                            <td class="user-name">
                                Ana Silva
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Maria Silva',
                                        '(12) 98888-2222',
                                        'Ana Silva',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 3 -->

                        <tr
                            data-status="active"
                            data-user="Beatriz Santos"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        JS
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            João Santos
                                        </strong>

                                        <span>
                                            Contato principal
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 97777-3333
                            </td>


                            <td class="user-name">
                                Beatriz Santos
                            </td>


                            <td>

                                <span class="quantity">
                                    1
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'João Santos',
                                        '(12) 97777-3333',
                                        'Beatriz Santos',
                                        '1',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 4 -->

                        <tr
                            data-status="active"
                            data-user="Carla Oliveira"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        RO
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Ricardo Oliveira
                                        </strong>

                                        <span>
                                            Contato principal
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 96666-4444
                            </td>


                            <td class="user-name">
                                Carla Oliveira
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Ricardo Oliveira',
                                        '(12) 96666-4444',
                                        'Carla Oliveira',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 5 -->

                        <tr
                            data-status="active"
                            data-user="Carla Oliveira"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        LO
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Lucas Oliveira
                                        </strong>

                                        <span>
                                            Contato de confiança
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 95555-5555
                            </td>


                            <td class="user-name">
                                Carla Oliveira
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Lucas Oliveira',
                                        '(12) 95555-5555',
                                        'Carla Oliveira',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 6 -->

                        <tr
                            data-status="inactive"
                            data-user="Mariana Costa"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        PC
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Pedro Costa
                                        </strong>

                                        <span>
                                            Contato de confiança
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 94444-6666
                            </td>


                            <td class="user-name">
                                Mariana Costa
                            </td>


                            <td>

                                <span class="quantity">
                                    1
                                </span>

                            </td>


                            <td>

                                <span class="status inactive">
                                    Inativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Pedro Costa',
                                        '(12) 94444-6666',
                                        'Mariana Costa',
                                        '1',
                                        'Inativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 7 -->

                        <tr
                            data-status="active"
                            data-user="Juliana Souza"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        FS
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Fernanda Souza
                                        </strong>

                                        <span>
                                            Contato principal
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 93333-7777
                            </td>


                            <td class="user-name">
                                Juliana Souza
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Fernanda Souza',
                                        '(12) 93333-7777',
                                        'Juliana Souza',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>



                        <!-- CONTATO 8 -->

                        <tr
                            data-status="active"
                            data-user="Juliana Souza"
                        >

                            <td>

                                <div class="contact-cell">

                                    <div class="contact-avatar">
                                        AS
                                    </div>

                                    <div class="contact-name">

                                        <strong>
                                            Amanda Souza
                                        </strong>

                                        <span>
                                            Contato de confiança
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>
                                (12) 92222-8888
                            </td>


                            <td class="user-name">
                                Juliana Souza
                            </td>


                            <td>

                                <span class="quantity">
                                    2
                                </span>

                            </td>


                            <td>

                                <span class="status active">
                                    Ativo
                                </span>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="showDetails(
                                        'Amanda Souza',
                                        '(12) 92222-8888',
                                        'Juliana Souza',
                                        '2',
                                        'Ativo'
                                    )"
                                >
                                    Ver detalhes
                                </button>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>



<!-- =====================================================
     MODAL
====================================================== -->

<div
    class="modal-overlay"
    id="modalOverlay"
    onclick="closeModal(event)"
>


    <div
        class="modal"
        onclick="event.stopPropagation()"
    >


        <div class="modal-header">

            <h2>
                Detalhes do contato
            </h2>

            <button
                class="close-button"
                onclick="closeModal()"
            >
                ×
            </button>

        </div>


        <div class="modal-info">


            <div class="info-box">

                <span>
                    Nome
                </span>

                <strong id="modalName">
                    -
                </strong>

            </div>


            <div class="info-box">

                <span>
                    Telefone
                </span>

                <strong id="modalPhone">
                    -
                </strong>

            </div>


            <div class="info-box">

                <span>
                    Usuária vinculada
                </span>

                <strong id="modalUser">
                    -
                </strong>

            </div>


            <div class="info-box">

                <span>
                    Quantidade de contatos
                </span>

                <strong id="modalQuantity">
                    -
                </strong>

            </div>


            <div class="info-box full">

                <span>
                    Status
                </span>

                <strong id="modalStatus">
                    -
                </strong>

            </div>


        </div>

    </div>

</div>



<script>

    /* =====================================================
       NAVEGAÇÃO
    ===================================================== */

    function goTo(page) {

        window.location.href = page;

    }



    /* =====================================================
       FILTROS
    ===================================================== */

    function applyFilters() {

        const search =
            document
                .getElementById("search")
                .value
                .toLowerCase()
                .trim();


        const status =
            document
                .getElementById("statusFilter")
                .value;


        const user =
            document
                .getElementById("userFilter")
                .value;


        const rows =
            document.querySelectorAll(
                "#contactsTable tr"
            );


        let visible = 0;


        rows.forEach(row => {

            const text =
                row.textContent
                    .toLowerCase();


            const rowStatus =
                row.dataset.status;


            const rowUser =
                row.dataset.user;


            const searchMatch =
                search === "" ||
                text.includes(search);


            const statusMatch =
                status === "todos" ||
                rowStatus === status;


            const userMatch =
                user === "todos" ||
                rowUser === user;


            if (
                searchMatch &&
                statusMatch &&
                userMatch
            ) {

                row.style.display = "";

                visible++;

            }

            else {

                row.style.display = "none";

            }

        });


        document.getElementById(
            "contactCount"
        ).textContent =
            visible +
            (
                visible === 1
                    ? " contato"
                    : " contatos"
            );

    }



    /* =====================================================
       BUSCA AUTOMÁTICA
    ===================================================== */

    document
        .getElementById("search")
        .addEventListener(
            "input",
            applyFilters
        );



    /* =====================================================
       DETALHES
    ===================================================== */

    function showDetails(
        name,
        phone,
        user,
        quantity,
        status
    ) {

        document.getElementById(
            "modalName"
        ).textContent =
            name;


        document.getElementById(
            "modalPhone"
        ).textContent =
            phone;


        document.getElementById(
            "modalUser"
        ).textContent =
            user;


        document.getElementById(
            "modalQuantity"
        ).textContent =
            quantity;


        document.getElementById(
            "modalStatus"
        ).textContent =
            status;


        document.getElementById(
            "modalOverlay"
        ).classList.add("show");

    }



    /* =====================================================
       FECHAR MODAL
    ===================================================== */

    function closeModal(event) {

        if (
            !event ||
            event.target.id ===
            "modalOverlay"
        ) {

            document.getElementById(
                "modalOverlay"
            ).classList.remove("show");

        }

    }



    /* =====================================================
       NOTIFICAÇÃO
    ===================================================== */

    function showNotification(
        message =
            "Você não possui novas notificações."
    ) {

        alert(message);

    }

</script>


<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>