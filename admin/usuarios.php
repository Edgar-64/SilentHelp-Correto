<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SilentHelp - Usuárias</title>

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

            --sidebar: #0c0910;

            --card: rgba(20, 17, 27, .90);
            --card-hover: rgba(28, 22, 37, .95);

            --borda: rgba(255, 255, 255, .08);
            --borda-roxa: rgba(168, 85, 247, .35);

            --branco: #ffffff;
            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;

            --sombra: 0 20px 60px rgba(0, 0, 0, .35);
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                radial-gradient(
                    circle at 55% -10%,
                    rgba(168, 85, 247, .16),
                    transparent 35%
                ),

                radial-gradient(
                    circle at 100% 40%,
                    rgba(112, 45, 181, .08),
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


        body::before {

            content: "";

            position: fixed;

            inset: 0;

            pointer-events: none;

            background-image:

                radial-gradient(
                    rgba(255,255,255,.035) 1px,
                    transparent 1px
                );

            background-size: 28px 28px;

            opacity: .20;

            z-index: -1;
        }


        button,
        input,
        select {
            font-family: inherit;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

        .admin-layout {

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

            width: 245px;

            height: 100vh;

            display: flex;

            flex-direction: column;

            padding: 25px 15px;

            background:
                linear-gradient(
                    180deg,
                    #0d0911,
                    #09070c
                );

            border-right:
                1px solid
                rgba(255,255,255,.07);

            z-index: 1000;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                3px
                12px
                30px;
        }


        .logo-heart {

            width: 40px;
            height: 40px;

            color: var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 13px
                    rgba(168,85,247,.35)
                );
        }


        .logo-text {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;
        }


        .logo-text .silent {
            color: var(--roxo-2);
        }


        .logo-text .help {
            color: white;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu-title {

            padding:
                0
                13px
                10px;

            color: #68616f;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1.2px;
        }


        .menu {

            display: flex;

            flex-direction: column;

            gap: 5px;
        }


        .menu-button {

            position: relative;

            width: 100%;

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                12px
                13px;

            border: none;

            border-radius: 13px;

            background: transparent;

            color: #817a89;

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

            color: var(--roxo-claro);

            background:
                rgba(168,85,247,.07);

            transform:
                translateX(2px);
        }


        .menu-button.active {

            color: var(--roxo-claro);

            background:
                linear-gradient(
                    100deg,
                    rgba(168,85,247,.16),
                    rgba(168,85,247,.05)
                );
        }


        .menu-button.active::before {

            content: "";

            position: absolute;

            left: 0;

            top: 8px;
            bottom: 8px;

            width: 3px;

            border-radius:
                0
                5px
                5px
                0;

            background:
                var(--roxo-2);

            box-shadow:
                0 0 12px
                rgba(168,85,247,.65);
        }


        /* =====================================================
           PERFIL ADMIN
        ===================================================== */

        .admin-profile {

            margin-top: auto;

            padding-top: 18px;

            border-top:
                1px solid
                rgba(255,255,255,.07);
        }


        .admin-user {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                10px
                9px;
        }


        .admin-avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    145deg,
                    var(--roxo),
                    var(--roxo-escuro)
                );

            font-size: 14px;

            font-weight: 750;

            box-shadow:
                0 8px 20px
                rgba(168,85,247,.20);
        }


        .admin-info {

            min-width: 0;
        }


        .admin-info strong {

            display: block;

            font-size: 12px;

            margin-bottom: 2px;
        }


        .admin-info span {

            display: block;

            color: var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           CONTEÚDO
        ===================================================== */

        .main-content {

            width: calc(100% - 245px);

            margin-left: 245px;

            padding:
                32px
                38px
                60px;
        }


        .content-wrapper {

            max-width: 1250px;

            margin: auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .top-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 30px;
        }


        .title-area h1 {

            font-size: 31px;

            font-weight: 650;

            letter-spacing: -.8px;

            margin-bottom: 6px;
        }


        .title-area h1 span {
            color: var(--roxo-claro);
        }


        .title-area p {

            color: var(--cinza);

            font-size: 13px;
        }


        .header-actions {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .notification {

            position: relative;

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
                rgba(255,255,255,.035);

            color: var(--roxo-claro);

            cursor: pointer;
        }


        .notification svg {

            width: 20px;
            height: 20px;
        }


        .notification-badge {

            position: absolute;

            top: -5px;
            right: -5px;

            width: 18px;
            height: 18px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--vermelho);

            color: white;

            border:
                2px solid
                var(--fundo);

            font-size: 9px;

            font-weight: 800;
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

            padding: 16px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                rgba(18,16,24,.72);
        }


        .search-box {

            position: relative;

            flex: 1;

            max-width: 420px;
        }


        .search-box svg {

            position: absolute;

            left: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            width: 18px;
            height: 18px;

            color: var(--cinza-2);
        }


        .search-box input {

            width: 100%;

            height: 42px;

            padding:
                0
                14px
                0
                42px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            outline: none;

            background:
                rgba(255,255,255,.035);

            color: white;

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
            color: #686270;
        }


        .filter-select {

            height: 42px;

            padding:
                0
                14px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255,255,255,.035);

            color: var(--cinza);

            outline: none;

            font-size: 12px;

            cursor: pointer;
        }


        .filter-select option {

            background: #15111b;

            color: white;
        }


        /* =====================================================
           TABELA
        ===================================================== */

        .table-card {

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    rgba(20,18,27,.94),
                    rgba(10,9,14,.96)
                );

            box-shadow: var(--sombra);
        }


        .table-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                20px
                22px;

            border-bottom:
                1px solid
                rgba(255,255,255,.06);
        }


        .table-header h2 {

            font-size: 17px;

            font-weight: 600;
        }


        .user-count {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            min-width: 28px;

            height: 25px;

            padding: 0 8px;

            margin-left: 7px;

            border-radius: 8px;

            background:
                rgba(168,85,247,.12);

            color:
                var(--roxo-claro);

            font-size: 11px;

            font-weight: 750;
        }


        .table-container {

            width: 100%;

            overflow-x: auto;
        }


        table {

            width: 100%;

            border-collapse: collapse;

            min-width: 850px;
        }


        thead {

            background:
                rgba(255,255,255,.025);
        }


        th {

            padding:
                13px
                18px;

            color:
                #77717f;

            font-size: 10px;

            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: .7px;

            white-space: nowrap;
        }


        td {

            padding:
                16px
                18px;

            border-top:
                1px solid
                rgba(255,255,255,.045);

            color: var(--cinza);

            font-size: 12px;

            vertical-align: middle;
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
           USUÁRIA
        ===================================================== */

        .user-cell {

            display: flex;

            align-items: center;

            gap: 11px;

            min-width: 190px;
        }


        .user-avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 11px;

            background:
                rgba(168,85,247,.13);

            color:
                var(--roxo-claro);

            font-size: 12px;

            font-weight: 750;
        }


        .user-name {

            color: white;

            font-size: 12px;

            font-weight: 650;

            margin-bottom: 3px;
        }


        .user-id {

            color:
                var(--cinza-2);

            font-size: 9px;
        }


        .email {

            color: var(--cinza);

            white-space: nowrap;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding:
                6px
                9px;

            border-radius: 8px;

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .3px;
        }


        .status-dot {

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }


        .status.active {

            color: var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .status.inactive {

            color: var(--cinza);

            background:
                rgba(255,255,255,.06);
        }


        /* =====================================================
           DISPOSITIVO
        ===================================================== */

        .device {

            display: flex;

            align-items: center;

            gap: 7px;

            white-space: nowrap;
        }


        .device svg {

            width: 17px;
            height: 17px;

            color:
                var(--roxo-claro);
        }


        .device.connected {
            color: var(--verde);
        }


        .device.connected svg {
            color: var(--verde);
        }


        .device.none {
            color: var(--cinza-2);
        }


        /* =====================================================
           DATA
        ===================================================== */

        .date {

            white-space: nowrap;

            color: var(--cinza);
        }


        /* =====================================================
           AÇÕES
        ===================================================== */

        .actions {

            display: flex;

            align-items: center;

            gap: 6px;
        }


        .action-button {

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
                rgba(255,255,255,.025);

            color:
                var(--cinza-2);

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s,
                color .2s,
                transform .2s;
        }


        .action-button svg {

            width: 16px;
            height: 16px;
        }


        .action-button:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(168,85,247,.35);

            background:
                rgba(168,85,247,.09);

            color:
                var(--roxo-claro);
        }


        .action-button.toggle-on:hover {

            border-color:
                rgba(255,93,115,.35);

            background:
                rgba(255,93,115,.08);

            color:
                var(--vermelho);
        }


        .action-button.toggle-off:hover {

            border-color:
                rgba(85,223,145,.35);

            background:
                rgba(85,223,145,.08);

            color:
                var(--verde);
        }


        /* =====================================================
           SEM RESULTADOS
        ===================================================== */

        .no-results {

            display: none;

            padding: 55px 20px;

            text-align: center;

            color: var(--cinza);
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

            color: white;

            font-size: 16px;

            margin-bottom: 5px;
        }


        .no-results p {

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

            padding: 26px;

            border:
                1px solid
                rgba(168,85,247,.35);

            border-radius: 23px;

            background:
                linear-gradient(
                    145deg,
                    #1c1525,
                    #0b0910
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
                transform: translateY(10px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }


        .modal-header {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 22px;
        }


        .modal-avatar {

            width: 52px;
            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background:
                rgba(168,85,247,.13);

            color:
                var(--roxo-claro);

            font-weight: 750;
        }


        .modal-header h2 {

            font-size: 19px;

            margin-bottom: 3px;
        }


        .modal-header p {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .detail-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 9px;

            margin-bottom: 20px;
        }


        .detail {

            padding: 13px;

            border:
                1px solid
                rgba(255,255,255,.06);

            border-radius: 12px;

            background:
                rgba(5,5,8,.55);
        }


        .detail.full {
            grid-column: 1 / -1;
        }


        .detail label {

            display: block;

            color:
                var(--cinza-2);

            font-size: 9px;

            text-transform: uppercase;

            letter-spacing: .5px;

            margin-bottom: 5px;
        }


        .detail strong {

            color: white;

            font-size: 12px;

            font-weight: 600;
        }


        .modal-close {

            width: 100%;

            height: 43px;

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


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            right: 25px;

            bottom: 25px;

            padding:
                13px
                18px;

            border:
                1px solid
                rgba(168,85,247,.35);

            border-radius: 12px;

            background:
                rgba(24,21,30,.96);

            color: white;

            font-size: 12px;

            box-shadow:
                0 15px 45px
                rgba(0,0,0,.45);

            transform:
                translateY(20px);

            opacity: 0;

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

        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .main-content {

                width: calc(100% - 210px);

                margin-left: 210px;

                padding:
                    25px
                    22px;
            }

        }


        @media (max-width: 700px) {

            .sidebar {

                position: fixed;

                width: 65px;

                padding:
                    20px
                    8px;
            }


            .logo {

                justify-content: center;

                padding:
                    0 0 25px;
            }


            .logo-heart {

                width: 34px;
                height: 34px;
            }


            .logo-text,
            .menu-title,
            .menu-button span,
            .admin-info {

                display: none;
            }


            .menu-button {

                justify-content: center;

                padding:
                    13px 5px;
            }


            .menu-button.active::before {

                left: -8px;
            }


            .admin-user {

                justify-content: center;

                padding:
                    8px 0;
            }


            .main-content {

                width: calc(100% - 65px);

                margin-left: 65px;

                padding:
                    22px
                    15px
                    35px;
            }


            .top-header {

                align-items: flex-start;
            }


            .title-area h1 {

                font-size: 25px;
            }


            .title-area p {

                font-size: 11px;

                line-height: 1.5;
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

        }


        @media (max-width: 480px) {

            .main-content {

                padding:
                    20px
                    10px;
            }


            .title-area h1 {

                font-size: 22px;
            }


            .notification {

                width: 38px;
                height: 38px;
            }


            .table-header {

                padding:
                    16px;
            }


            .modal-content {

                padding:
                    21px
                    17px;
            }


            .detail-grid {

                grid-template-columns: 1fr;
            }


            .detail.full {

                grid-column: auto;
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
            margin-top: 0;
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


<div class="admin-layout">


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

            <a href="usuarios.php" class="sidebar-link active">
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
         CONTEÚDO PRINCIPAL
    ====================================================== -->

    <main class="main-content">


        <div class="content-wrapper">


            <!-- HEADER -->

            <header class="top-header">

                <div class="title-area">

                    <h1>
                        Gerenciar <span>usuárias</span>
                    </h1>

                    <p>
                        Visualize e gerencie as contas cadastradas no SilentHelp.
                    </p>

                </div>


                <div class="header-actions">

                    <button
                        class="notification"
                        onclick="showToast('Você não possui novas notificações.')"
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

                        <span class="notification-badge">
                            2
                        </span>

                    </button>

                </div>

            </header>



            <!-- =================================================
                 FILTROS
            ================================================== -->

            <section class="toolbar">


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
                        placeholder="Buscar por nome ou e-mail..."
                        oninput="searchUsers()"
                    >

                </div>


                <select
                    class="filter-select"
                    id="statusFilter"
                    onchange="filterStatus()"
                >

                    <option value="all">
                        Todas as contas
                    </option>

                    <option value="active">
                        Ativas
                    </option>

                    <option value="inactive">
                        Desativadas
                    </option>

                </select>

            </section>



            <!-- =================================================
                 TABELA
            ================================================== -->

            <section class="table-card">


                <div class="table-header">

                    <h2>

                        Usuárias cadastradas

                        <span
                            class="user-count"
                            id="userCount"
                        >
                            6
                        </span>

                    </h2>

                </div>


                <div class="table-container">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Usuária
                                </th>

                                <th>
                                    E-mail
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Dispositivo
                                </th>

                                <th>
                                    Data de cadastro
                                </th>

                                <th>
                                    Ações
                                </th>

                            </tr>

                        </thead>


                        <tbody id="userTable">


                            <!-- USUÁRIA 1 -->

                            <tr
                                data-status="active"
                                data-name="Ana Carolina"
                                data-email="ana.carolina@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            AC
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Ana Carolina
                                            </div>

                                            <div class="user-id">
                                                ID #SH001
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        ana.carolina@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status active">

                                        <span class="status-dot"></span>

                                        Ativa

                                    </span>

                                </td>


                                <td>

                                    <div class="device connected">

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

                                        SH-001

                                    </div>

                                </td>


                                <td>

                                    <span class="date">
                                        02/08/2026
                                    </span>

                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Ana Carolina','AC','ana.carolina@email.com','Ativa','SH-001','02/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-on"
                                            onclick="toggleUser(this)"
                                            title="Desativar conta"
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
                                                    r="9"
                                                />

                                                <line
                                                    x1="8"
                                                    y1="12"
                                                    x2="16"
                                                    y2="12"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <!-- USUÁRIA 2 -->

                            <tr
                                data-status="active"
                                data-name="Beatriz Souza"
                                data-email="beatriz.souza@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            BS
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Beatriz Souza
                                            </div>

                                            <div class="user-id">
                                                ID #SH002
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        beatriz.souza@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status active">

                                        <span class="status-dot"></span>

                                        Ativa

                                    </span>

                                </td>


                                <td>

                                    <div class="device connected">

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

                                        SH-002

                                    </div>

                                </td>


                                <td>
                                    04/08/2026
                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Beatriz Souza','BS','beatriz.souza@email.com','Ativa','SH-002','04/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-on"
                                            onclick="toggleUser(this)"
                                            title="Desativar conta"
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
                                                    r="9"
                                                />

                                                <line
                                                    x1="8"
                                                    y1="12"
                                                    x2="16"
                                                    y2="12"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <!-- USUÁRIA 3 -->

                            <tr
                                data-status="active"
                                data-name="Camila Oliveira"
                                data-email="camila.oliveira@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            CO
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Camila Oliveira
                                            </div>

                                            <div class="user-id">
                                                ID #SH003
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        camila.oliveira@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status active">

                                        <span class="status-dot"></span>

                                        Ativa

                                    </span>

                                </td>


                                <td>

                                    <div class="device connected">

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

                                        SH-003

                                    </div>

                                </td>


                                <td>
                                    06/08/2026
                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Camila Oliveira','CO','camila.oliveira@email.com','Ativa','SH-003','06/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-on"
                                            onclick="toggleUser(this)"
                                            title="Desativar conta"
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
                                                    r="9"
                                                />

                                                <line
                                                    x1="8"
                                                    y1="12"
                                                    x2="16"
                                                    y2="12"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <!-- USUÁRIA 4 -->

                            <tr
                                data-status="inactive"
                                data-name="Daniela Martins"
                                data-email="daniela.martins@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            DM
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Daniela Martins
                                            </div>

                                            <div class="user-id">
                                                ID #SH004
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        daniela.martins@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status inactive">

                                        <span class="status-dot"></span>

                                        Desativada

                                    </span>

                                </td>


                                <td>

                                    <div class="device none">

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

                                        </svg>

                                        Nenhum

                                    </div>

                                </td>


                                <td>
                                    07/08/2026
                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Daniela Martins','DM','daniela.martins@email.com','Desativada','Nenhum dispositivo','07/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-off"
                                            onclick="toggleUser(this)"
                                            title="Ativar conta"
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
                                                    r="9"
                                                />

                                                <path
                                                    d="m8 12 2.5 2.5L16 9"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <!-- USUÁRIA 5 -->

                            <tr
                                data-status="active"
                                data-name="Fernanda Lima"
                                data-email="fernanda.lima@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            FL
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Fernanda Lima
                                            </div>

                                            <div class="user-id">
                                                ID #SH005
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        fernanda.lima@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status active">

                                        <span class="status-dot"></span>

                                        Ativa

                                    </span>

                                </td>


                                <td>

                                    <div class="device connected">

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

                                        SH-005

                                    </div>

                                </td>


                                <td>
                                    09/08/2026
                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Fernanda Lima','FL','fernanda.lima@email.com','Ativa','SH-005','09/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-on"
                                            onclick="toggleUser(this)"
                                            title="Desativar conta"
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
                                                    r="9"
                                                />

                                                <line
                                                    x1="8"
                                                    y1="12"
                                                    x2="16"
                                                    y2="12"
                                                />

                                            </svg>

                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <!-- USUÁRIA 6 -->

                            <tr
                                data-status="active"
                                data-name="Gabriela Santos"
                                data-email="gabriela.santos@email.com"
                            >

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            GS
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                Gabriela Santos
                                            </div>

                                            <div class="user-id">
                                                ID #SH006
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <span class="email">
                                        gabriela.santos@email.com
                                    </span>
                                </td>


                                <td>

                                    <span class="status active">

                                        <span class="status-dot"></span>

                                        Ativa

                                    </span>

                                </td>


                                <td>

                                    <div class="device connected">

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

                                        SH-006

                                    </div>

                                </td>


                                <td>
                                    11/08/2026
                                </td>


                                <td>

                                    <div class="actions">

                                        <button
                                            class="action-button"
                                            onclick="viewUser('Gabriela Santos','GS','gabriela.santos@email.com','Ativa','SH-006','11/08/2026')"
                                            title="Visualizar detalhes"
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
                                                    d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="3"
                                                />

                                            </svg>

                                        </button>


                                        <button
                                            class="action-button toggle-on"
                                            onclick="toggleUser(this)"
                                            title="Desativar conta"
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
                                                    r="9"
                                                />

                                                <line
                                                    x1="8"
                                                    y1="12"
                                                    x2="16"
                                                    y2="12"
                                                />

                                            </svg>

                                        </button>

                                    </div>

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

                        <h3>
                            Nenhuma usuária encontrada
                        </h3>

                        <p>
                            Tente alterar os termos da pesquisa ou o filtro.
                        </p>

                    </div>

                </div>

            </section>

        </div>

    </main>

</div>



<!-- =====================================================
     MODAL DETALHES
====================================================== -->

<div
    class="modal"
    id="userModal"
    onclick="closeModalOutside(event)"
>

    <div class="modal-content">


        <div class="modal-header">

            <div
                class="modal-avatar"
                id="modalAvatar"
            >
                AC
            </div>


            <div>

                <h2 id="modalName">
                    Ana Carolina
                </h2>

                <p>
                    Detalhes da conta
                </p>

            </div>

        </div>


        <div class="detail-grid">


            <div class="detail">

                <label>
                    Nome
                </label>

                <strong id="modalUserName">
                    -
                </strong>

            </div>


            <div class="detail">

                <label>
                    Status
                </label>

                <strong id="modalStatus">
                    -
                </strong>

            </div>


            <div class="detail full">

                <label>
                    E-mail
                </label>

                <strong id="modalEmail">
                    -
                </strong>

            </div>


            <div class="detail">

                <label>
                    Dispositivo
                </label>

                <strong id="modalDevice">
                    -
                </strong>

            </div>


            <div class="detail">

                <label>
                    Data de cadastro
                </label>

                <strong id="modalDate">
                    -
                </strong>

            </div>

        </div>


        <button
            class="modal-close"
            onclick="closeModal()"
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
       TOAST
    ===================================================== */

    let toastTimer;


    function showToast(message) {

        const toast =
            document.getElementById("toast");

        toast.textContent = message;

        toast.classList.add("show");

        clearTimeout(toastTimer);

        toastTimer = setTimeout(() => {

            toast.classList.remove("show");

        }, 2500);

    }



    /* =====================================================
       VISUALIZAR USUÁRIA
    ===================================================== */

    function viewUser(
        name,
        initials,
        email,
        status,
        device,
        date
    ) {

        document.getElementById(
            "modalAvatar"
        ).textContent = initials;


        document.getElementById(
            "modalName"
        ).textContent = name;


        document.getElementById(
            "modalUserName"
        ).textContent = name;


        document.getElementById(
            "modalEmail"
        ).textContent = email;


        document.getElementById(
            "modalStatus"
        ).textContent = status;


        document.getElementById(
            "modalDevice"
        ).textContent = device;


        document.getElementById(
            "modalDate"
        ).textContent = date;


        document.getElementById(
            "userModal"
        ).classList.add("show");

    }



    function closeModal() {

        document.getElementById(
            "userModal"
        ).classList.remove("show");

    }



    function closeModalOutside(event) {

        if (
            event.target.id ===
            "userModal"
        ) {

            closeModal();

        }

    }



    /* =====================================================
       ATIVAR / DESATIVAR CONTA
    ===================================================== */

    function toggleUser(button) {

        const row =
            button.closest("tr");

        const status =
            row.querySelector(".status");


        if (
            row.dataset.status === "active"
        ) {

            row.dataset.status = "inactive";

            status.classList.remove("active");

            status.classList.add("inactive");

            status.innerHTML = `
                <span class="status-dot"></span>
                Desativada
            `;


            button.classList.remove(
                "toggle-on"
            );

            button.classList.add(
                "toggle-off"
            );

            button.title =
                "Ativar conta";


            button.innerHTML = `

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

            `;


            showToast(
                "Conta desativada com sucesso."
            );

        } else {

            row.dataset.status = "active";

            status.classList.remove("inactive");

            status.classList.add("active");

            status.innerHTML = `
                <span class="status-dot"></span>
                Ativa
            `;


            button.classList.remove(
                "toggle-off"
            );

            button.classList.add(
                "toggle-on"
            );

            button.title =
                "Desativar conta";


            button.innerHTML = `

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

                    <line
                        x1="8"
                        y1="12"
                        x2="16"
                        y2="12"
                    />

                </svg>

            `;


            showToast(
                "Conta ativada com sucesso."
            );

        }


        searchUsers();

    }



    /* =====================================================
       PESQUISA
    ===================================================== */

    function searchUsers() {

        const input =
            document
                .getElementById("searchInput")
                .value
                .toLowerCase()
                .trim();


        const rows =
            document.querySelectorAll(
                "#userTable tr"
            );


        let visible = 0;


        rows.forEach(row => {

            const name =
                row.dataset.name
                    .toLowerCase();

            const email =
                row.dataset.email
                    .toLowerCase();


            const matches =
                name.includes(input) ||
                email.includes(input);


            const statusMatch =
                checkStatusFilter(row);


            if (
                matches &&
                statusMatch
            ) {

                row.style.display = "";

                visible++;

            } else {

                row.style.display = "none";

            }

        });


        updateCount(visible);

    }



    /* =====================================================
       FILTRO DE STATUS
    ===================================================== */

    function filterStatus() {

        searchUsers();

    }



    function checkStatusFilter(row) {

        const filter =
            document
                .getElementById("statusFilter")
                .value;


        if (filter === "all") {
            return true;
        }


        return row.dataset.status === filter;

    }



    /* =====================================================
       CONTADOR
    ===================================================== */

    function updateCount(customCount) {

        const rows =
            document.querySelectorAll(
                "#userTable tr"
            );


        let count = 0;


        rows.forEach(row => {

            if (
                row.style.display !== "none"
            ) {

                count++;

            }

        });


        if (
            customCount !== undefined
        ) {

            count = customCount;

        }


        document.getElementById(
            "userCount"
        ).textContent = count;


        const noResults =
            document.getElementById(
                "noResults"
            );


        if (count === 0) {

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
       ESC
    ===================================================== */

    document.addEventListener(
        "keydown",
        function(event) {

            if (event.key === "Escape") {

                closeModal();

            }

        }
    );

</script>

<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>