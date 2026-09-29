<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Alertas</title>

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
            --fundo-2: #0b0910;

            --card: rgba(18, 16, 24, .90);

            --borda: rgba(255, 255, 255, .075);
            --borda-roxa: rgba(168, 85, 247, .35);

            --branco: #ffffff;
            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;

            --azul: #63a8ff;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                radial-gradient(
                    circle at 50% -15%,
                    rgba(168, 85, 247, .20),
                    transparent 35%
                ),

                radial-gradient(
                    circle at 100% 25%,
                    rgba(112, 45, 181, .12),
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
           FUNDO
        ===================================================== */

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

            opacity: .25;

            z-index: -1;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

        .layout {

            min-height: 100vh;

            display: flex;
        }


        /* =====================================================
           MENU LATERAL
        ===================================================== */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            width: 245px;

            padding: 28px 17px;

            background:
                rgba(12, 10, 17, .96);

            border-right:
                1px solid
                var(--borda);

            z-index: 1000;

            display: flex;

            flex-direction: column;
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


        .logo-heart {

            width: 40px;
            height: 40px;

            color:
                var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 14px
                    rgba(168,85,247,.35)
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
                #ffffff;
        }


        /* =====================================================
           PERFIL ADMIN
        ===================================================== */

        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                14px 12px;

            margin-bottom: 22px;

            border:
                1px solid
                rgba(255,255,255,.06);

            border-radius: 15px;

            background:
                rgba(255,255,255,.025);
        }


        .admin-avatar {

            width: 39px;
            height: 39px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(168,85,247,.14);

            color:
                var(--roxo-claro);
        }


        .admin-avatar svg {

            width: 21px;
            height: 21px;
        }


        .admin-info {

            min-width: 0;
        }


        .admin-info strong {

            display: block;

            font-size: 13px;

            margin-bottom: 3px;
        }


        .admin-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .menu-title {

            color:
                #686170;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            padding:
                0 13px;

            margin-bottom: 8px;
        }


        .menu {

            display: flex;

            flex-direction: column;

            gap: 5px;
        }


        .menu-button {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                13px 14px;

            border: none;

            border-radius: 13px;

            background: transparent;

            color:
                #85808e;

            cursor: pointer;

            text-align: left;

            font-size: 13px;

            transition:
                .2s;
        }


        .menu-button svg {

            width: 20px;
            height: 20px;

            flex-shrink: 0;
        }


        .menu-button:hover {

            color:
                var(--roxo-claro);

            background:
                rgba(168,85,247,.07);
        }


        .menu-button.active {

            color:
                var(--roxo-claro);

            background:
                linear-gradient(
                    100deg,
                    rgba(168,85,247,.16),
                    rgba(168,85,247,.05)
                );

            border:
                1px solid
                rgba(168,85,247,.15);
        }


        /* =====================================================
           RODAPÉ MENU
        ===================================================== */

        .sidebar-bottom {

            margin-top: auto;
        }


        .logout {

            color:
                #a79fab;
        }


        .logout:hover {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.07);
        }


        /* =====================================================
           CONTEÚDO
        ===================================================== */

        .content {

            width: calc(100% - 245px);

            margin-left: 245px;

            padding:
                35px 38px
                70px;
        }


        .content-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 32px;
        }


        .page-title h1 {

            font-size: 34px;

            font-weight: 600;

            letter-spacing: -1px;

            margin-bottom: 6px;
        }


        .page-title h1 span {

            color:
                var(--roxo-claro);
        }


        .page-title p {

            color:
                var(--cinza);

            font-size: 14px;
        }


        /* =====================================================
           BOTÃO ATUALIZAR
        ===================================================== */

        .refresh-button {

            display: flex;

            align-items: center;

            gap: 8px;

            padding:
                11px 16px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255,255,255,.035);

            color:
                var(--cinza);

            cursor: pointer;

            font-size: 12px;

            transition: .2s;
        }


        .refresh-button:hover {

            color:
                var(--roxo-claro);

            border-color:
                var(--borda-roxa);

            background:
                rgba(168,85,247,.08);
        }


        .refresh-button svg {

            width: 17px;
            height: 17px;
        }


        /* =====================================================
           CARDS RESUMO
        ===================================================== */

        .summary-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 15px;

            margin-bottom: 30px;
        }


        .summary-card {

            padding: 20px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(20,18,26,.90),
                    rgba(10,10,14,.94)
                );

            transition: .2s;
        }


        .summary-card:hover {

            transform:
                translateY(-3px);

            border-color:
                var(--borda-roxa);
        }


        .summary-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 15px;
        }


        .summary-icon {

            width: 39px;
            height: 39px;

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

            width: 20px;
            height: 20px;
        }


        .summary-number {

            font-size: 26px;

            font-weight: 700;
        }


        .summary-card p {

            color:
                var(--cinza);

            font-size: 12px;
        }


        .summary-card.emergency
        .summary-icon {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.09);
        }


        .summary-card.test
        .summary-icon {

            color:
                var(--azul);

            background:
                rgba(99,168,255,.09);
        }


        .summary-card.cancelled
        .summary-icon {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.06);
        }


        /* =====================================================
           PAINEL
        ===================================================== */

        .panel {

            border:
                1px solid
                var(--borda);

            border-radius: 21px;

            background:
                rgba(18,16,24,.84);

            overflow: hidden;

            box-shadow:
                0 20px 60px
                rgba(0,0,0,.22);
        }


        .panel-header {

            padding:
                21px 23px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            border-bottom:
                1px solid
                rgba(255,255,255,.055);
        }


        .panel-title {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .panel-title h2 {

            font-size: 18px;

            font-weight: 600;
        }


        .count {

            min-width: 27px;
            height: 27px;

            padding:
                0 8px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background:
                rgba(168,85,247,.12);

            color:
                var(--roxo-claro);

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           FILTROS
        ===================================================== */

        .filters {

            display: flex;

            align-items: center;

            gap: 8px;

            padding:
                17px 23px;

            border-bottom:
                1px solid
                rgba(255,255,255,.045);

            overflow-x: auto;
        }


        .filter {

            flex-shrink: 0;

            padding:
                9px 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 10px;

            background:
                rgba(255,255,255,.025);

            color:
                var(--cinza);

            cursor: pointer;

            font-size: 11px;

            font-weight: 600;

            transition: .2s;
        }


        .filter:hover {

            color:
                var(--roxo-claro);

            border-color:
                var(--borda-roxa);
        }


        .filter.active {

            color:
                var(--roxo-claro);

            background:
                rgba(168,85,247,.13);

            border-color:
                rgba(168,85,247,.35);
        }


        /* =====================================================
           TABELA
        ===================================================== */

        .table-wrapper {

            width: 100%;

            overflow-x: auto;
        }


        table {

            width: 100%;

            min-width: 900px;

            border-collapse: collapse;
        }


        th {

            padding:
                14px 20px;

            text-align: left;

            color:
                #777180;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .7px;

            background:
                rgba(255,255,255,.018);

            border-bottom:
                1px solid
                rgba(255,255,255,.055);
        }


        td {

            padding:
                16px 20px;

            border-bottom:
                1px solid
                rgba(255,255,255,.045);

            color:
                var(--cinza);

            font-size: 12px;

            vertical-align: middle;
        }


        tr:last-child td {

            border-bottom: none;
        }


        tbody tr {

            transition: .2s;
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

            gap: 10px;

            min-width: 155px;
        }


        .user-avatar {

            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(168,85,247,.11);

            color:
                var(--roxo-claro);

            font-size: 12px;

            font-weight: 700;
        }


        .user-name {

            color:
                white;

            font-weight: 600;

            margin-bottom: 3px;
        }


        .user-email {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           TIPO
        ===================================================== */

        .type-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding:
                6px 9px;

            border-radius: 8px;

            font-size: 9px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .3px;
        }


        .type-dot {

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background:
                currentColor;
        }


        .type-emergency {

            color:
                var(--vermelho);

            background:
                rgba(255,93,115,.09);
        }


        .type-test {

            color:
                var(--azul);

            background:
                rgba(99,168,255,.09);
        }


        .type-cancelled {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.06);
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


        .status-dot {

            width: 6px;
            height: 6px;

            border-radius: 50%;

            background:
                currentColor;
        }


        .status-resolved {

            color:
                var(--verde);

            background:
                rgba(85,223,145,.08);
        }


        .status-active {

            color:
                var(--amarelo);

            background:
                rgba(244,201,93,.08);
        }


        .status-cancelled {

            color:
                var(--cinza);

            background:
                rgba(255,255,255,.05);
        }


        /* =====================================================
           LOCALIZAÇÃO
        ===================================================== */

        .location {

            display: flex;

            align-items: center;

            gap: 6px;

            color:
                var(--cinza);
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

            width: 35px;
            height: 35px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 10px;

            background:
                rgba(255,255,255,.025);

            color:
                var(--cinza-2);

            cursor: pointer;

            transition: .2s;
        }


        .details-button:hover {

            color:
                var(--roxo-claro);

            border-color:
                var(--borda-roxa);

            background:
                rgba(168,85,247,.09);
        }


        .details-button svg {

            width: 17px;
            height: 17px;
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

            max-width: 480px;

            padding: 28px;

            border:
                1px solid
                rgba(168,85,247,.35);

            border-radius: 24px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29,22,38,.98),
                    rgba(10,9,14,.98)
                );

            box-shadow:
                0 30px 90px
                rgba(0,0,0,.65);
        }


        .modal-header {

            display: flex;

            align-items: center;

            gap: 13px;

            margin-bottom: 22px;
        }


        .modal-icon {

            width: 52px;
            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background:
                rgba(168,85,247,.11);

            color:
                var(--roxo-claro);
        }


        .modal-icon svg {

            width: 25px;
            height: 25px;
        }


        .modal-header h2 {

            font-size: 20px;

            margin-bottom: 3px;
        }


        .modal-header p {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .detail-list {

            display: flex;

            flex-direction: column;

            gap: 9px;

            margin-bottom: 20px;
        }


        .detail {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                13px 14px;

            border:
                1px solid
                rgba(255,255,255,.055);

            border-radius: 12px;

            background:
                rgba(5,5,9,.55);
        }


        .detail span {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .detail strong {

            color:
                white;

            font-size: 11px;

            text-align: right;
        }


        .close-button {

            width: 100%;

            padding:
                13px;

            border:
                1px solid
                rgba(168,85,247,.30);

            border-radius: 12px;

            background:
                rgba(168,85,247,.08);

            color:
                var(--roxo-claro);

            font-weight: 650;

            cursor: pointer;

            transition: .2s;
        }


        .close-button:hover {

            background:
                rgba(168,85,247,.15);
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 25px;

            transform:
                translate(-50%,20px);

            opacity: 0;

            pointer-events: none;

            padding:
                13px 20px;

            border:
                1px solid
                rgba(168,85,247,.40);

            border-radius: 13px;

            background:
                rgba(25,22,32,.95);

            color:
                white;

            font-size: 12px;

            z-index: 5000;

            transition: .3s;
        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%,0);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 1000px) {

            .sidebar {

                width: 210px;
            }


            .content {

                width: calc(100% - 210px);

                margin-left: 210px;

                padding:
                    28px 22px;
            }


            .summary-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }
        }


        @media (max-width: 750px) {

            .sidebar {

                position: fixed;

                top: auto;

                left: 0;
                right: 0;

                bottom: 0;

                width: 100%;

                height: 72px;

                padding: 5px 8px;

                border-right: none;

                border-top:
                    1px solid
                    var(--borda);

                flex-direction: row;

                align-items: center;

                justify-content: center;
            }


            .sidebar .brand,
            .sidebar .admin-profile,
            .sidebar .nav-label,
            .sidebar .sidebar-bottom {

                display: none;
            }


            .sidebar-nav {

                width: 100%;

                display: grid !important;

                grid-template-columns:
                    repeat(5, 1fr);

                gap: 3px;
            }


            .sidebar-link {

                flex-direction: column;

                justify-content: center;

                gap: 3px;

                padding: 7px 3px !important;

                font-size: 9px !important;

                text-align: center !important;
            }


            .sidebar-link svg {

                width: 20px !important;
                height: 20px !important;
            }


            .sidebar .link-badge {

                position: absolute;

                top: 3px;

                right: 15px;

                min-width: 16px;

                height: 16px;
            }


            .content {

                width: 100%;

                margin-left: 0;

                padding:
                    25px 15px
                    95px;
            }


            .content-header {

                align-items: flex-start;
            }


            .page-title h1 {

                font-size: 28px;
            }


            .page-title p {

                font-size: 12px;
            }


            .refresh-button {

                padding:
                    10px;
            }


            .refresh-button span {

                display: none;
            }


            .summary-grid {

                gap: 9px;
            }


            .summary-card {

                padding: 15px;
            }


            .summary-number {

                font-size: 22px;
            }
        }


        @media (max-width: 480px) {

            .summary-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }


            .summary-card p {

                font-size: 10px;
            }


            .panel-header {

                padding:
                    17px;
            }


            .filters {

                padding:
                    13px 17px;
            }


            .modal-content {

                padding:
                    22px 18px;
            }
        }


        /* =====================================================
           ESTRUTURA SIDEBAR ADMIN
        ===================================================== */

        .sidebar {

            width: 250px;

            min-height: 100vh;

            padding: 25px 17px;

            overflow-y: auto;

            background:
                rgba(12, 10, 16, .96);

            border-right:
                1px solid
                var(--borda);

            z-index: 1000;
        }


        .sidebar .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                5px 10px 30px;

            color: white;

            text-decoration: none;

            cursor: default;
        }


        .sidebar .brand-heart {

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


        .sidebar .brand-name {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;

            white-space: nowrap;
        }


        /* =====================================================
           SILENT ROXO
           HELP BRANCO
        ===================================================== */

        .sidebar .brand-name .silent {

            color:
                var(--roxo-2);
        }


        .sidebar .brand-name .help {

            color:
                #ffffff;
        }


        .sidebar .admin-profile {

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


        .sidebar .admin-avatar {

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


        .sidebar .admin-info {

            min-width: 0;
        }


        .sidebar .admin-info strong {

            display: block;

            margin-bottom: 3px;

            font-size: 13px;
        }


        .sidebar .admin-info span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        .sidebar .nav-label {

            color:
                var(--cinza-2);

            padding:
                0 12px 9px;

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


        .sidebar .sidebar-link svg {

            width: 19px;
            height: 19px;

            flex:
                0 0 19px;
        }


        .sidebar .sidebar-link:hover {

            color: white;

            background:
                rgba(168,85,247,.08);

            transform:
                translateX(2px);
        }


        .sidebar .sidebar-link.active {

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


        .sidebar .sidebar-link .link-badge {

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


        .sidebar .sidebar-bottom {

            margin-top: auto;

            padding-top: 15px;

            border-top:
                1px solid
                var(--borda);
        }


        .sidebar .sidebar-bottom .sidebar-link {

            margin: 0;
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


        <div class="brand">

            <svg
                class="brand-heart"
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


            <div class="brand-name">

                <span class="silent">Silent</span><span class="help">Help</span>

            </div>

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
                    Painel administrativo
                </span>

            </div>

        </div>


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

                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>

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

                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                </svg>

                <span>
                    Usuárias
                </span>

            </a>


            <a
                href="alertas.php"
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

                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>

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

                    <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                    <circle cx="12" cy="10" r="2.5"/>

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

                    <rect x="5" y="2" width="14" height="20" rx="2"/>
                    <line x1="9" y1="18" x2="15" y2="18"/>

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

                    <circle cx="9" cy="7" r="4"/>
                    <path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>

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

                    <path d="M3 3v18h18"/>
                    <path d="m7 16 4-5 3 3 5-7"/>

                </svg>

                <span>
                    Relatórios
                </span>

            </a>


            <a
                href="config-admin.php"
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

                    <circle cx="12" cy="12" r="3"/>

                    <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-2v-.48a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2h.48A1.7 1.7 0 0 0 8.04 11a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.42-1.42.06.06A1.7 1.7 0 0 0 11 8.04 1.7 1.7 0 0 0 12.03 6.48V6h2v.48A1.7 1.7 0 0 0 15.06 8a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 18.04 11c.24.63.84 1.03 1.56 1.03H20v2h-.48A1.7 1.7 0 0 0 19.4 15Z"/>

                </svg>

                <span>
                    Configurações
                </span>

            </a>

        </nav>


        <div class="sidebar-bottom">

            <a
                href="login-admin.php"
                class="sidebar-link"
                onclick="logout(); return false;"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>

                </svg>

                <span>
                    Sair
                </span>

            </a>

        </div>

    </aside>



    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

    <main class="content">


        <header class="content-header">

            <div class="page-title">

                <h1>
                    Gerenciamento de
                    <span>alertas</span>
                </h1>

                <p>
                    Acompanhe todos os alertas registrados pelo SilentHelp.
                </p>

            </div>


            <button
                class="refresh-button"
                onclick="refreshAlerts()"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <polyline points="23 4 23 10 17 10"/>
                    <polyline points="1 20 1 14 7 14"/>
                    <path d="M3.51 9a9 9 0 0 1 14.13-3.36L23 10"/>
                    <path d="M20.49 15a9 9 0 0 1-14.13 3.36L1 14"/>

                </svg>

                <span>
                    Atualizar
                </span>

            </button>

        </header>



        <!-- =====================================================
             RESUMO
        ====================================================== -->

        <section class="summary-grid">


            <div class="summary-card">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/>
                            <path d="m9 12 2 2 4-4"/>

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="totalAlerts"
                    >
                        8
                    </strong>

                </div>

                <p>
                    Total de alertas
                </p>

            </div>


            <div class="summary-card emergency">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/>

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="emergencyAlerts"
                    >
                        3
                    </strong>

                </div>

                <p>
                    Emergências
                </p>

            </div>


            <div class="summary-card test">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 2.5 2.5L16 9"/>

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="testAlerts"
                    >
                        3
                    </strong>

                </div>

                <p>
                    Testes
                </p>

            </div>


            <div class="summary-card cancelled">

                <div class="summary-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <circle cx="12" cy="12" r="9"/>
                            <path d="m9 9 6 6"/>
                            <path d="m15 9-6 6"/>

                        </svg>

                    </div>

                    <strong
                        class="summary-number"
                        id="cancelledAlerts"
                    >
                        2
                    </strong>

                </div>

                <p>
                    Cancelados
                </p>

            </div>

        </section>



        <!-- =====================================================
             TABELA
        ====================================================== -->

        <section class="panel">


            <div class="panel-header">

                <div class="panel-title">

                    <h2>
                        Todos os alertas
                    </h2>

                    <span
                        class="count"
                        id="alertCount"
                    >
                        8
                    </span>

                </div>

            </div>


            <div class="filters">

                <button
                    class="filter active"
                    onclick="filterAlerts('all', this)"
                >
                    Todos
                </button>

                <button
                    class="filter"
                    onclick="filterAlerts('emergency', this)"
                >
                    Emergência
                </button>

                <button
                    class="filter"
                    onclick="filterAlerts('test', this)"
                >
                    Teste
                </button>

                <button
                    class="filter"
                    onclick="filterAlerts('cancelled', this)"
                >
                    Cancelado
                </button>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>Tipo</th>
                            <th>Usuária</th>
                            <th>Data e horário</th>
                            <th>Localização</th>
                            <th>Status</th>
                            <th>Detalhes</th>

                        </tr>

                    </thead>


                    <tbody id="alertTable">


                        <tr data-type="emergency">

                            <td>
                                <span class="type-badge type-emergency">
                                    <span class="type-dot"></span>
                                    Emergência
                                </span>
                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        JP
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Julia Padilha
                                        </div>

                                        <div class="user-email">
                                            julia@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                15/08/2026<br>
                                10:42
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                        <circle cx="12" cy="10" r="2.5"/>

                                    </svg>

                                    Taubaté - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-resolved">
                                    <span class="status-dot"></span>
                                    Resolvido
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Alerta de emergência',
                                        'Julia Padilha',
                                        '15/08/2026 às 10:42',
                                        'Taubaté - SP',
                                        'Resolvido',
                                        '3 contatos acionados'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="test">

                            <td>

                                <span class="type-badge type-test">
                                    <span class="type-dot"></span>
                                    Teste
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        MS
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Maria Silva
                                        </div>

                                        <div class="user-email">
                                            maria@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                15/08/2026<br>
                                08:15
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    São Paulo - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-resolved">
                                    <span class="status-dot"></span>
                                    Concluído
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Teste de segurança',
                                        'Maria Silva',
                                        '15/08/2026 às 08:15',
                                        'São Paulo - SP',
                                        'Concluído',
                                        'Nenhum contato acionado'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="emergency">

                            <td>

                                <span class="type-badge type-emergency">
                                    <span class="type-dot"></span>
                                    Emergência
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        AC
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Ana Costa
                                        </div>

                                        <div class="user-email">
                                            ana@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                14/08/2026<br>
                                21:37
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    Campinas - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-active">
                                    <span class="status-dot"></span>
                                    Ativo
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Alerta de emergência',
                                        'Ana Costa',
                                        '14/08/2026 às 21:37',
                                        'Campinas - SP',
                                        'Ativo',
                                        '3 contatos acionados'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="cancelled">

                            <td>

                                <span class="type-badge type-cancelled">
                                    <span class="type-dot"></span>
                                    Cancelado
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        CS
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Carla Souza
                                        </div>

                                        <div class="user-email">
                                            carla@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                14/08/2026<br>
                                17:20
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    Taubaté - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-cancelled">
                                    <span class="status-dot"></span>
                                    Cancelado
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Alerta cancelado',
                                        'Carla Souza',
                                        '14/08/2026 às 17:20',
                                        'Taubaté - SP',
                                        'Cancelado',
                                        'Nenhum contato acionado'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="test">

                            <td>

                                <span class="type-badge type-test">
                                    <span class="type-dot"></span>
                                    Teste
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        BS
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Beatriz Santos
                                        </div>

                                        <div class="user-email">
                                            beatriz@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                13/08/2026<br>
                                14:05
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    Taubaté - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-resolved">
                                    <span class="status-dot"></span>
                                    Concluído
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Verificação do dispositivo',
                                        'Beatriz Santos',
                                        '13/08/2026 às 14:05',
                                        'Taubaté - SP',
                                        'Concluído',
                                        'Nenhum contato acionado'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="emergency">

                            <td>

                                <span class="type-badge type-emergency">
                                    <span class="type-dot"></span>
                                    Emergência
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        LM
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Larissa Martins
                                        </div>

                                        <div class="user-email">
                                            larissa@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                12/08/2026<br>
                                22:18
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    São José dos Campos - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-resolved">
                                    <span class="status-dot"></span>
                                    Resolvido
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Alerta de emergência',
                                        'Larissa Martins',
                                        '12/08/2026 às 22:18',
                                        'São José dos Campos - SP',
                                        'Resolvido',
                                        '3 contatos acionados'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="test">

                            <td>

                                <span class="type-badge type-test">
                                    <span class="type-dot"></span>
                                    Teste
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        RS
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Renata Silva
                                        </div>

                                        <div class="user-email">
                                            renata@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                10/08/2026<br>
                                09:30
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    São Paulo - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-resolved">
                                    <span class="status-dot"></span>
                                    Concluído
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Teste de segurança',
                                        'Renata Silva',
                                        '10/08/2026 às 09:30',
                                        'São Paulo - SP',
                                        'Concluído',
                                        'Nenhum contato acionado'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

                                </button>

                            </td>

                        </tr>


                        <tr data-type="cancelled">

                            <td>

                                <span class="type-badge type-cancelled">
                                    <span class="type-dot"></span>
                                    Cancelado
                                </span>

                            </td>

                            <td>

                                <div class="user-cell">

                                    <div class="user-avatar">
                                        JS
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            Juliana Santos
                                        </div>

                                        <div class="user-email">
                                            juliana@email.com
                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>
                                08/08/2026<br>
                                18:45
                            </td>

                            <td>

                                <div class="location">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>

                                    </svg>

                                    Taubaté - SP

                                </div>

                            </td>

                            <td>

                                <span class="status status-cancelled">
                                    <span class="status-dot"></span>
                                    Cancelado
                                </span>

                            </td>

                            <td>

                                <button
                                    class="details-button"
                                    onclick="openDetails(
                                        'Alerta cancelado',
                                        'Juliana Santos',
                                        '08/08/2026 às 18:45',
                                        'Taubaté - SP',
                                        'Cancelado',
                                        'Nenhum contato acionado'
                                    )"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >

                                        <path d="m9 18 6-6-6-6"/>

                                    </svg>

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
     MODAL DETALHES
====================================================== -->

<div
    class="modal"
    id="detailsModal"
    onclick="closeOutside(event)"
>

    <div class="modal-content">


        <div class="modal-header">

            <div class="modal-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>

                </svg>

            </div>


            <div>

                <h2 id="detailTitle">
                    Detalhes do alerta
                </h2>

                <p>
                    Informações registradas pelo SilentHelp
                </p>

            </div>

        </div>


        <div class="detail-list">


            <div class="detail">

                <span>
                    Usuária
                </span>

                <strong id="detailUser">
                    -
                </strong>

            </div>


            <div class="detail">

                <span>
                    Data e horário
                </span>

                <strong id="detailDate">
                    -
                </strong>

            </div>


            <div class="detail">

                <span>
                    Localização
                </span>

                <strong id="detailLocation">
                    -
                </strong>

            </div>


            <div class="detail">

                <span>
                    Status
                </span>

                <strong id="detailStatus">
                    -
                </strong>

            </div>


            <div class="detail">

                <span>
                    Contatos acionados
                </span>

                <strong id="detailContacts">
                    -
                </strong>

            </div>

        </div>


        <button
            class="close-button"
            onclick="closeDetails()"
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
       FILTROS
    ===================================================== */

    function filterAlerts(type, button) {

        const buttons =
            document.querySelectorAll(".filter");


        buttons.forEach(btn => {

            btn.classList.remove("active");

        });


        button.classList.add("active");


        const rows =
            document.querySelectorAll(
                "#alertTable tr"
            );


        let visible = 0;


        rows.forEach(row => {

            const rowType =
                row.dataset.type;


            if (
                type === "all" ||
                rowType === type
            ) {

                row.style.display = "";

                visible++;

            } else {

                row.style.display = "none";

            }

        });


        document.getElementById(
            "alertCount"
        ).textContent = visible;

    }


    /* =====================================================
       MODAL
    ===================================================== */

    function openDetails(
        title,
        user,
        date,
        location,
        status,
        contacts
    ) {

        document.getElementById(
            "detailTitle"
        ).textContent = title;


        document.getElementById(
            "detailUser"
        ).textContent = user;


        document.getElementById(
            "detailDate"
        ).textContent = date;


        document.getElementById(
            "detailLocation"
        ).textContent = location;


        document.getElementById(
            "detailStatus"
        ).textContent = status;


        document.getElementById(
            "detailContacts"
        ).textContent = contacts;


        document.getElementById(
            "detailsModal"
        ).classList.add("show");

    }


    function closeDetails() {

        document.getElementById(
            "detailsModal"
        ).classList.remove("show");

    }


    function closeOutside(event) {

        if (
            event.target.id ===
            "detailsModal"
        ) {

            closeDetails();

        }

    }


    /* =====================================================
       ATUALIZAR
    ===================================================== */

    function refreshAlerts() {

        showToast(
            "Lista de alertas atualizada."
        );

    }


    /* =====================================================
       SAIR
       SEM CONFIRMAÇÃO
    ===================================================== */

    function logout() {

        window.location.href =
            "login-admin.php";

    }


    /* =====================================================
       TOAST
    ===================================================== */

    let toastTimer;


    function showToast(message) {

        const toast =
            document.getElementById("toast");


        toast.textContent =
            message;


        toast.classList.add("show");


        clearTimeout(toastTimer);


        toastTimer = setTimeout(() => {

            toast.classList.remove("show");

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

                closeDetails();

            }

        }
    );

</script>


<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>