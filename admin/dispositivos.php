<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp Admin - Dispositivos</title>

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
            --roxo-claro: #d0a0ff;
            --roxo-escuro: #702db5;

            --fundo: #07060a;
            --fundo-2: #0d0a12;

            --card: #121018;
            --card-2: #19151f;

            --borda: rgba(255,255,255,.08);

            --branco: #ffffff;
            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;
            --azul: #65a9ff;

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
                    circle at 50% -15%,
                    rgba(168,85,247,.18),
                    transparent 35%
                ),

                radial-gradient(
                    circle at 100% 30%,
                    rgba(112,45,181,.10),
                    transparent 30%
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

            padding: 25px 16px;

            background:
                rgba(13,10,18,.96);

            border-right:
                1px solid
                var(--borda);

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
                0 12px
                25px;
        }


        .logo-icon {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            color: var(--roxo-claro);

            filter:
                drop-shadow(
                    0 0 12px
                    rgba(168,85,247,.35)
                );
        }


        .logo-icon svg {

            width: 38px;
            height: 38px;
        }


        .logo-text {

            font-size: 23px;

            font-weight: 750;

            letter-spacing: -.8px;
        }


        .logo-text .silent {

            color:
                var(--roxo-claro);
        }


        .logo-text .help {

            color:
                white;
        }


        .admin-label {

            display: block;

            margin-top: 2px;

            color:
                var(--cinza-2);

            font-size: 9px;

            text-transform: uppercase;

            letter-spacing: 1.5px;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu {

            display: flex;

            flex-direction: column;

            gap: 6px;
        }


        .menu-title {

            padding:
                14px
                12px
                8px;

            color:
                var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        .menu-button {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                13px
                14px;

            border: none;

            border-radius: 13px;

            background: transparent;

            color:
                var(--cinza);

            font-size: 13px;

            font-weight: 550;

            text-align: left;

            cursor: pointer;

            transition:
                background .2s,
                color .2s,
                transform .2s;
        }


        .menu-button svg {

            width: 20px;
            height: 20px;

            flex-shrink: 0;
        }


        .menu-button:hover {

            background:
                rgba(168,85,247,.08);

            color:
                var(--roxo-claro);

            transform:
                translateX(2px);
        }


        .menu-button.active {

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


        .menu-button.active svg {

            color:
                var(--roxo);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main {

            width: calc(100% - 250px);

            margin-left: 250px;

            padding: 30px 35px 60px;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 32px;
        }


        .page-title h1 {

            font-size: 30px;

            font-weight: 650;

            letter-spacing: -.8px;

            margin-bottom: 6px;
        }


        .page-title p {

            color:
                var(--cinza);

            font-size: 13px;
        }


        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                7px 12px 7px 7px;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                rgba(255,255,255,.025);
        }


        .admin-avatar {

            width: 37px;
            height: 37px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                linear-gradient(
                    145deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            font-size: 13px;

            font-weight: 750;
        }


        .admin-info strong {

            display: block;

            font-size: 12px;
        }


        .admin-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           CARDS RESUMO
        ===================================================== */

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 15px;

            margin-bottom: 28px;
        }


        .summary-card {

            padding: 20px;

            border:
                1px solid
                var(--borda);

            border-radius: 19px;

            background:
                linear-gradient(
                    145deg,
                    rgba(22,19,29,.9),
                    rgba(10,9,13,.95)
                );

            box-shadow:
                var(--sombra);
        }


        .summary-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 18px;
        }


        .summary-icon {

            width: 40px;
            height: 40px;

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


        .summary-number {

            font-size: 27px;

            font-weight: 700;
        }


        .summary-card p {

            color:
                var(--cinza);

            font-size: 12px;
        }


        .summary-card.online .summary-icon {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .summary-card.offline .summary-icon {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.08);
        }


        .summary-card.battery .summary-icon {

            color:
                var(--amarelo);

            background:
                rgba(244,201,93,.08);
        }


        /* =====================================================
           TOOLBAR
        ===================================================== */

        .toolbar {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 18px;
        }


        .search-box {

            position: relative;

            flex: 1;

            max-width: 450px;
        }


        .search-box svg {

            position: absolute;

            left: 14px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 18px;
            height: 18px;

            color:
                var(--cinza-2);
        }


        .search-box input {

            width: 100%;

            padding:
                13px
                15px
                13px
                43px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            outline: none;

            background:
                rgba(255,255,255,.035);

            color:
                white;

            font-size: 12px;

            transition:
                border-color .2s,
                background .2s;
        }


        .search-box input:focus {

            border-color:
                rgba(168,85,247,.45);

            background:
                rgba(168,85,247,.04);
        }


        .search-box input::placeholder {

            color:
                var(--cinza-2);
        }


        .filter-select {

            padding:
                12px 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            outline: none;

            background:
                #15121b;

            color:
                var(--cinza);

            font-size: 12px;

            cursor: pointer;
        }


        .filter-select:focus {

            border-color:
                rgba(168,85,247,.45);
        }


        /* =====================================================
           TABELA
        ===================================================== */

        .table-card {

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                rgba(17,15,22,.88);

            overflow: hidden;

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

            font-size: 17px;

            font-weight: 600;
        }


        .device-count {

            padding:
                5px 9px;

            border-radius: 8px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);

            font-size: 10px;

            font-weight: 700;
        }


        .table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        table {

            width: 100%;

            min-width: 950px;

            border-collapse: collapse;
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
                17px 18px;

            border-top:
                1px solid
                rgba(255,255,255,.045);

            color:
                var(--cinza);

            font-size: 12px;

            white-space: nowrap;
        }


        tbody tr {

            transition:
                background .2s;
        }


        tbody tr:hover {

            background:
                rgba(168,85,247,.035);
        }


        /* =====================================================
           ID DISPOSITIVO
        ===================================================== */

        .device-id {

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .device-icon {

            width: 34px;
            height: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);
        }


        .device-icon svg {

            width: 18px;
            height: 18px;
        }


        .device-id strong {

            color:
                white;

            font-size: 11px;

            font-weight: 650;
        }


        /* =====================================================
           USUÁRIA
        ===================================================== */

        .user-cell {

            display: flex;

            align-items: center;

            gap: 9px;
        }


        .user-avatar {

            width: 32px;
            height: 32px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background:
                rgba(208,160,255,.10);

            color:
                var(--roxo-claro);

            font-size: 10px;

            font-weight: 700;
        }


        .user-cell strong {

            display: block;

            color:
                white;

            font-size: 11px;
        }


        .user-cell span {

            display: block;

            margin-top: 2px;

            color:
                var(--cinza-2);

            font-size: 9px;
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

            font-weight: 750;

            text-transform: uppercase;
        }


        .status-dot {

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background:
                currentColor;
        }


        .status.online {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .status.offline {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.08);
        }


        /* =====================================================
           BATERIA
        ===================================================== */

        .battery {

            display: flex;

            align-items: center;

            gap: 8px;
        }


        .battery-icon {

            width: 28px;
            height: 13px;

            border:
                1px solid
                currentColor;

            border-radius: 4px;

            position: relative;

            padding: 2px;
        }


        .battery-icon::after {

            content: "";

            position: absolute;

            right: -4px;

            top: 3px;

            width: 3px;
            height: 5px;

            border-radius: 0 2px 2px 0;

            background:
                currentColor;
        }


        .battery-level {

            height: 100%;

            border-radius: 2px;

            background:
                currentColor;
        }


        .battery.high {

            color:
                var(--verde);
        }


        .battery.medium {

            color:
                var(--amarelo);
        }


        .battery.low {

            color:
                var(--vermelho);
        }


        /* =====================================================
           LOCALIZAÇÃO
        ===================================================== */

        .location {

            display: flex;

            align-items: center;

            gap: 6px;
        }


        .location svg {

            width: 15px;
            height: 15px;

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           BOTÃO DETALHES
        ===================================================== */

        .details-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding:
                8px 11px;

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

            transition:
                background .2s,
                border-color .2s,
                transform .2s;
        }


        .details-button:hover {

            transform:
                translateY(-1px);

            background:
                rgba(168,85,247,.12);

            border-color:
                rgba(168,85,247,.40);
        }


        .details-button svg {

            width: 14px;
            height: 14px;
        }


        /* =====================================================
           SEM RESULTADOS
        ===================================================== */

        .no-results {

            display: none;

            padding: 50px 20px;

            text-align: center;
        }


        .no-results.show {

            display: block;
        }


        .no-results svg {

            width: 42px;
            height: 42px;

            color:
                var(--roxo-claro);

            margin-bottom: 12px;
        }


        .no-results h3 {

            font-size: 16px;

            margin-bottom: 5px;
        }


        .no-results p {

            color:
                var(--cinza);

            font-size: 12px;
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
                rgba(0,0,0,.78);

            backdrop-filter:
                blur(10px);

            z-index: 3000;
        }


        .modal.show {

            display: flex;
        }


        .modal-content {

            width: 100%;

            max-width: 470px;

            padding: 27px;

            border:
                1px solid
                rgba(168,85,247,.30);

            border-radius: 23px;

            background:
                linear-gradient(
                    145deg,
                    #1c1724,
                    #0b090e
                );

            box-shadow:
                0 30px 90px
                rgba(0,0,0,.65);

            animation:
                modalIn .2s ease;
        }


        @keyframes modalIn {

            from {

                opacity: 0;

                transform:
                    translateY(12px)
                    scale(.98);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);
            }
        }


        .modal-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 23px;
        }


        .modal-title {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .modal-device-icon {

            width: 50px;
            height: 50px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background:
                rgba(168,85,247,.10);

            color:
                var(--roxo-claro);
        }


        .modal-device-icon svg {

            width: 25px;
            height: 25px;
        }


        .modal-title h2 {

            font-size: 19px;

            margin-bottom: 3px;
        }


        .modal-title p {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        .close-modal {

            width: 34px;
            height: 34px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 9px;

            background:
                rgba(255,255,255,.03);

            color:
                var(--cinza);

            cursor: pointer;
        }


        .close-modal:hover {

            color:
                white;

            background:
                rgba(255,255,255,.07);
        }


        .close-modal svg {

            width: 17px;
            height: 17px;
        }


        .details-grid {

            display: grid;

            grid-template-columns:
                repeat(2,1fr);

            gap: 9px;

            margin-bottom: 20px;
        }


        .detail-box {

            padding: 14px;

            border:
                1px solid
                rgba(255,255,255,.06);

            border-radius: 12px;

            background:
                rgba(7,7,11,.55);
        }


        .detail-box.full {

            grid-column:
                1 / -1;
        }


        .detail-box span {

            display: block;

            margin-bottom: 6px;

            color:
                var(--cinza-2);

            font-size: 9px;

            text-transform: uppercase;

            letter-spacing: .4px;
        }


        .detail-box strong {

            color:
                white;

            font-size: 12px;

            font-weight: 600;
        }


        .modal-close-button {

            width: 100%;

            padding: 13px;

            border:
                1px solid
                rgba(168,85,247,.30);

            border-radius: 12px;

            background:
                rgba(168,85,247,.08);

            color:
                var(--roxo-claro);

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;
        }


        .modal-close-button:hover {

            background:
                rgba(168,85,247,.14);
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
                rgba(168,85,247,.35);

            border-radius: 12px;

            background:
                rgba(25,21,32,.96);

            color:
                white;

            font-size: 12px;

            box-shadow:
                0 15px 45px
                rgba(0,0,0,.45);

            opacity: 0;

            transform:
                translateY(15px);

            pointer-events: none;

            transition:
                opacity .25s,
                transform .25s;

            z-index: 5000;
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
                    repeat(2,1fr);
            }
        }


        @media (max-width: 800px) {

            .sidebar {

                width: 70px;

                padding:
                    20px 9px;
            }


            .logo {

                justify-content: center;

                padding:
                    0 0 25px;
            }


            .logo-text,
            .admin-label,
            .menu-title,
            .menu-button span {

                display: none;
            }


            .menu-button {

                justify-content: center;

                padding: 13px;
            }


            .main {

                width:
                    calc(100% - 70px);

                margin-left: 70px;

                padding:
                    25px 20px 50px;
            }


            .topbar {

                align-items:
                    flex-start;
            }
        }


        @media (max-width: 600px) {

            .main {

                padding:
                    20px 14px 40px;
            }


            .summary-grid {

                grid-template-columns:
                    repeat(2,1fr);

                gap: 9px;
            }


            .summary-card {

                padding: 15px;
            }


            .summary-number {

                font-size: 23px;
            }


            .toolbar {

                flex-direction: column;

                align-items: stretch;
            }


            .search-box {

                max-width: none;
            }


            .filter-select {

                width: 100%;
            }


            .admin-profile {

                display: none;
            }


            .page-title h1 {

                font-size: 25px;
            }


            .details-grid {

                grid-template-columns:
                    1fr;
            }


            .detail-box.full {

                grid-column:
                    auto;
            }


            .toast {

                left: 15px;
                right: 15px;

                bottom: 15px;

                text-align: center;
            }
        }


        @media (max-width: 380px) {

            .sidebar {

                width: 58px;
            }


            .main {

                width:
                    calc(100% - 58px);

                margin-left: 58px;
            }


            .summary-number {

                font-size: 20px;
            }


            .summary-card p {

                font-size: 10px;
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

            <a href="dispositivos.php" class="sidebar-link active">
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


        <!-- TOPBAR -->

        <header class="topbar">


            <div class="page-title">

                <h1>
                    Dispositivos
                </h1>

                <p>
                    Gerencie os dispositivos SilentHelp cadastrados no sistema.
                </p>

            </div>


            <div class="admin-profile">

                <div class="admin-avatar">
                    AD
                </div>

                <div class="admin-info">

                    <strong>
                        Administrador
                    </strong>

                    <span>
                        Painel SilentHelp
                    </span>

                </div>

            </div>

        </header>



        <!-- =================================================
             RESUMO
        ================================================== -->

        <section class="summary-grid">


            <div class="summary-card">

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
                                x="5"
                                y="2"
                                width="14"
                                height="20"
                                rx="2"
                            />

                            <path
                                d="M9 18h6"
                            />

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="totalDevices"
                    >
                        8
                    </strong>

                </div>

                <p>
                    Dispositivos cadastrados
                </p>

            </div>



            <div class="summary-card online">

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
                                d="M5 12.55a11 11 0 0 1 14.08 0"
                            />

                            <path
                                d="M8.5 16a6 6 0 0 1 7 0"
                            />

                            <path
                                d="M12 19h.01"
                            />

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="onlineDevices"
                    >
                        6
                    </strong>

                </div>

                <p>
                    Dispositivos online
                </p>

            </div>



            <div class="summary-card offline">

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
                                d="M1 1l22 22"
                            />

                            <path
                                d="M16.72 11.06A10.94 10.94 0 0 1 19 12.55"
                            />

                            <path
                                d="M5 12.55a10.94 10.94 0 0 1 5.18-1.85"
                            />

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="offlineDevices"
                    >
                        2
                    </strong>

                </div>

                <p>
                    Dispositivos offline
                </p>

            </div>



            <div class="summary-card battery">

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
                                x="2"
                                y="7"
                                width="18"
                                height="10"
                                rx="2"
                            />

                            <path
                                d="M22 10v4"
                            />

                            <path
                                d="M6 10v4"
                            />

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="lowBattery"
                    >
                        2
                    </strong>

                </div>

                <p>
                    Bateria abaixo de 30%
                </p>

            </div>

        </section>



        <!-- =================================================
             BUSCA E FILTROS
        ================================================== -->

        <div class="toolbar">


            <div class="search-box">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    />

                    <path
                        d="m20 20-4-4"
                    />

                </svg>


                <input
                    type="text"
                    id="searchInput"
                    placeholder="Buscar por ID ou usuária..."
                    oninput="searchDevices()"
                >

            </div>


            <select
                class="filter-select"
                id="statusFilter"
                onchange="filterStatus()"
            >

                <option value="all">
                    Todos os dispositivos
                </option>

                <option value="online">
                    Online
                </option>

                <option value="offline">
                    Offline
                </option>

            </select>

        </div>



        <!-- =================================================
             TABELA
        ================================================== -->

        <section class="table-card">


            <div class="table-header">

                <h2>
                    Dispositivos cadastrados
                </h2>

                <span
                    class="device-count"
                    id="tableCount"
                >
                    8 dispositivos
                </span>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>
                                ID do dispositivo
                            </th>

                            <th>
                                Usuária vinculada
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Última comunicação
                            </th>

                            <th>
                                Bateria
                            </th>

                            <th>
                                Localização
                            </th>

                            <th>
                                Ação
                            </th>

                        </tr>

                    </thead>


                    <tbody id="deviceTable">


                        <!-- DISPOSITIVO 1 -->

                        <tr
                            data-status="online"
                            data-search="SH-001 Maria Silva"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

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

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-001
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        MS
                                    </div>

                                    <div>

                                        <strong>
                                            Maria Silva
                                        </strong>

                                        <span>
                                            maria@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 13:42
                            </td>


                            <td>

                                <div class="battery high">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:85%"
                                        ></div>

                                    </div>

                                    85%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Taubaté - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-001',
                                        'Maria Silva',
                                        'Online',
                                        'Hoje, 13:42',
                                        '85%',
                                        'Taubaté - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 2 -->

                        <tr
                            data-status="online"
                            data-search="SH-002 Ana Souza"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-002
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        AS
                                    </div>

                                    <div>

                                        <strong>
                                            Ana Souza
                                        </strong>

                                        <span>
                                            ana@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 13:39
                            </td>


                            <td>

                                <div class="battery high">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:72%"
                                        ></div>

                                    </div>

                                    72%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    São José dos Campos - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-002',
                                        'Ana Souza',
                                        'Online',
                                        'Hoje, 13:39',
                                        '72%',
                                        'São José dos Campos - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 3 -->

                        <tr
                            data-status="offline"
                            data-search="SH-003 Julia Santos"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-003
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        JS
                                    </div>

                                    <div>

                                        <strong>
                                            Julia Santos
                                        </strong>

                                        <span>
                                            julia@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status offline">

                                    <span class="status-dot"></span>

                                    Offline

                                </span>

                            </td>


                            <td>
                                Hoje, 08:17
                            </td>


                            <td>

                                <div class="battery low">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:18%"
                                        ></div>

                                    </div>

                                    18%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Taubaté - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-003',
                                        'Julia Santos',
                                        'Offline',
                                        'Hoje, 08:17',
                                        '18%',
                                        'Taubaté - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 4 -->

                        <tr
                            data-status="online"
                            data-search="SH-004 Beatriz Oliveira"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-004
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        BO
                                    </div>

                                    <div>

                                        <strong>
                                            Beatriz Oliveira
                                        </strong>

                                        <span>
                                            beatriz@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 13:30
                            </td>


                            <td>

                                <div class="battery medium">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:46%"
                                        ></div>

                                    </div>

                                    46%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Pindamonhangaba - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-004',
                                        'Beatriz Oliveira',
                                        'Online',
                                        'Hoje, 13:30',
                                        '46%',
                                        'Pindamonhangaba - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 5 -->

                        <tr
                            data-status="online"
                            data-search="SH-005 Camila Ferreira"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-005
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        CF
                                    </div>

                                    <div>

                                        <strong>
                                            Camila Ferreira
                                        </strong>

                                        <span>
                                            camila@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 13:25
                            </td>


                            <td>

                                <div class="battery high">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:91%"
                                        ></div>

                                    </div>

                                    91%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Taubaté - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-005',
                                        'Camila Ferreira',
                                        'Online',
                                        'Hoje, 13:25',
                                        '91%',
                                        'Taubaté - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 6 -->

                        <tr
                            data-status="offline"
                            data-search="SH-006 Larissa Costa"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-006
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        LC
                                    </div>

                                    <div>

                                        <strong>
                                            Larissa Costa
                                        </strong>

                                        <span>
                                            larissa@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status offline">

                                    <span class="status-dot"></span>

                                    Offline

                                </span>

                            </td>


                            <td>
                                Ontem, 22:41
                            </td>


                            <td>

                                <div class="battery low">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:24%"
                                        ></div>

                                    </div>

                                    24%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Tremembé - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-006',
                                        'Larissa Costa',
                                        'Offline',
                                        'Ontem, 22:41',
                                        '24%',
                                        'Tremembé - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 7 -->

                        <tr
                            data-status="online"
                            data-search="SH-007 Fernanda Alves"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-007
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        FA
                                    </div>

                                    <div>

                                        <strong>
                                            Fernanda Alves
                                        </strong>

                                        <span>
                                            fernanda@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 13:10
                            </td>


                            <td>

                                <div class="battery medium">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:39%"
                                        ></div>

                                    </div>

                                    39%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Caçapava - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-007',
                                        'Fernanda Alves',
                                        'Online',
                                        'Hoje, 13:10',
                                        '39%',
                                        'Caçapava - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>



                        <!-- DISPOSITIVO 8 -->

                        <tr
                            data-status="online"
                            data-search="SH-008 Gabriela Lima"
                        >

                            <td>

                                <div class="device-id">

                                    <div class="device-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >

                                            <rect
                                                x="5"
                                                y="2"
                                                width="14"
                                                height="20"
                                                rx="2"
                                            />

                                            <path
                                                d="M9 18h6"
                                            />

                                        </svg>

                                    </div>

                                    <strong>
                                        SH-008
                                    </strong>

                                </div>

                            </td>


                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        GL
                                    </div>

                                    <div>

                                        <strong>
                                            Gabriela Lima
                                        </strong>

                                        <span>
                                            gabriela@email.com
                                        </span>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="status online">

                                    <span class="status-dot"></span>

                                    Online

                                </span>

                            </td>


                            <td>
                                Hoje, 12:58
                            </td>


                            <td>

                                <div class="battery high">

                                    <div class="battery-icon">

                                        <div
                                            class="battery-level"
                                            style="width:68%"
                                        ></div>

                                    </div>

                                    68%

                                </div>

                            </td>


                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
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

                                    Taubaté - SP

                                </div>

                            </td>


                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDevice(
                                        'SH-008',
                                        'Gabriela Lima',
                                        'Online',
                                        'Hoje, 12:58',
                                        '68%',
                                        'Taubaté - SP'
                                    )"
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
                                            r="9"
                                        />

                                        <path
                                            d="M12 10v6"
                                        />

                                        <path
                                            d="M12 7h.01"
                                        />

                                    </svg>

                                    Detalhes

                                </button>

                            </td>

                        </tr>


                    </tbody>

                </table>


                <div
                    class="no-results"
                    id="noResults"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.6"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="3"
                            y="3"
                            width="18"
                            height="18"
                            rx="3"
                        />

                        <path
                            d="m9 9 6 6"
                        />

                        <path
                            d="m15 9-6 6"
                        />

                    </svg>

                    <h3>
                        Nenhum dispositivo encontrado
                    </h3>

                    <p>
                        Tente alterar os filtros ou o termo de busca.
                    </p>

                </div>

            </div>

        </section>

    </main>

</div>



<!-- =====================================================
     MODAL DETALHES
====================================================== -->

<div
    class="modal"
    id="deviceModal"
    onclick="closeModalOutside(event)"
>


    <div class="modal-content">


        <div class="modal-top">


            <div class="modal-title">


                <div class="modal-device-icon">

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

                        <path
                            d="M9 18h6"
                        />

                    </svg>

                </div>


                <div>

                    <h2>
                        Detalhes do dispositivo
                    </h2>

                    <p>
                        Informações do dispositivo SilentHelp
                    </p>

                </div>

            </div>


            <button
                class="close-modal"
                onclick="closeDeviceModal()"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M18 6 6 18"/>

                    <path d="m6 6 12 12"/>

                </svg>

            </button>

        </div>



        <div class="details-grid">


            <div class="detail-box">

                <span>
                    ID do dispositivo
                </span>

                <strong id="modalDeviceId">
                    -
                </strong>

            </div>


            <div class="detail-box">

                <span>
                    Status
                </span>

                <strong id="modalStatus">
                    -
                </strong>

            </div>


            <div class="detail-box">

                <span>
                    Usuária vinculada
                </span>

                <strong id="modalUser">
                    -
                </strong>

            </div>


            <div class="detail-box">

                <span>
                    Bateria
                </span>

                <strong id="modalBattery">
                    -
                </strong>

            </div>


            <div class="detail-box">

                <span>
                    Última comunicação
                </span>

                <strong id="modalCommunication">
                    -
                </strong>

            </div>


            <div class="detail-box">

                <span>
                    Localização
                </span>

                <strong id="modalLocation">
                    -
                </strong>

            </div>


            <div class="detail-box full">

                <span>
                    Identificação
                </span>

                <strong>
                    Dispositivo cadastrado e vinculado ao sistema SilentHelp.
                </strong>

            </div>


        </div>


        <button
            class="modal-close-button"
            onclick="closeDeviceModal()"
        >
            Fechar
        </button>

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
       NAVEGAÇÃO
    ===================================================== */

    function goTo(page) {

        window.location.href = page;

    }



    /* =====================================================
       MODAL
    ===================================================== */

    function openDevice(
        id,
        user,
        status,
        communication,
        battery,
        location
    ) {

        document.getElementById(
            "modalDeviceId"
        ).textContent = id;


        document.getElementById(
            "modalUser"
        ).textContent = user;


        document.getElementById(
            "modalStatus"
        ).textContent = status;


        document.getElementById(
            "modalCommunication"
        ).textContent = communication;


        document.getElementById(
            "modalBattery"
        ).textContent = battery;


        document.getElementById(
            "modalLocation"
        ).textContent = location;


        document.getElementById(
            "deviceModal"
        ).classList.add("show");

    }



    function closeDeviceModal() {

        document.getElementById(
            "deviceModal"
        ).classList.remove("show");

    }



    function closeModalOutside(event) {

        if (
            event.target.id ===
            "deviceModal"
        ) {

            closeDeviceModal();

        }

    }



    /* =====================================================
       BUSCA
    ===================================================== */

    function searchDevices() {

        const input =
            document.getElementById(
                "searchInput"
            );

        const search =
            input.value
                .toLowerCase()
                .trim();


        const status =
            document.getElementById(
                "statusFilter"
            ).value;


        applyFilters(
            search,
            status
        );

    }



    /* =====================================================
       FILTRO STATUS
    ===================================================== */

    function filterStatus() {

        const search =
            document.getElementById(
                "searchInput"
            ).value
                .toLowerCase()
                .trim();


        const status =
            document.getElementById(
                "statusFilter"
            ).value;


        applyFilters(
            search,
            status
        );

    }



    /* =====================================================
       APLICAR FILTROS
    ===================================================== */

    function applyFilters(
        search,
        status
    ) {

        const rows =
            document.querySelectorAll(
                "#deviceTable tr"
            );


        let visible = 0;


        rows.forEach(row => {

            const rowSearch =
                row.dataset.search
                    .toLowerCase();


            const rowStatus =
                row.dataset.status;


            const matchesSearch =
                rowSearch.includes(search);


            const matchesStatus =
                status === "all" ||
                rowStatus === status;


            if (
                matchesSearch &&
                matchesStatus
            ) {

                row.style.display =
                    "";

                visible++;

            } else {

                row.style.display =
                    "none";

            }

        });


        document.getElementById(
            "tableCount"
        ).textContent =
            visible +
            (
                visible === 1
                    ? " dispositivo"
                    : " dispositivos"
            );


        const noResults =
            document.getElementById(
                "noResults"
            );


        if (visible === 0) {

            noResults.classList.add(
                "show"
            );

        } else {

            noResults.classList.remove(
                "show"
            );

        }

    }



    /* =====================================================
       TOAST
    ===================================================== */

    function showToast(message) {

        const toast =
            document.getElementById(
                "toast"
            );


        toast.textContent =
            message;


        toast.classList.add(
            "show"
        );


        setTimeout(() => {

            toast.classList.remove(
                "show"
            );

        }, 2500);

    }



    /* =====================================================
       ESC
    ===================================================== */

    document.addEventListener(
        "keydown",
        function(event) {

            if (
                event.key === "Escape"
            ) {

                closeDeviceModal();

            }

        }
    );

</script>


<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>