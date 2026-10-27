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

<style id="silenthelp-responsive-admin">
/* Botão de menu aparece apenas em telas compactas */
.sh-menu-toggle { display: none; }
/* Ajustes responsivos globais do painel SilentHelp */
:root { --sh-sidebar-width: 260px; }
@media (max-width: 1000px) {
  body { overflow-x: hidden; }
  #sidebar.sidebar {
    position: fixed !important; top: 0 !important; bottom: 0 !important; left: 0 !important; right: auto !important;
    width: min(285px, 86vw) !important; height: 100dvh !important; max-height: 100dvh !important;
    display: flex !important; flex-direction: column !important; align-items: stretch !important;
    padding: 22px 14px !important; overflow-y: auto !important; overflow-x: hidden !important;
    transform: translateX(-110%) !important; transition: transform .25s ease !important;
    z-index: 1201 !important; border-right: 1px solid rgba(255,255,255,.12) !important; border-top: 0 !important;
    box-shadow: 16px 0 40px rgba(0,0,0,.35) !important;
  }
  #sidebar.sidebar.open { transform: translateX(0) !important; }
  #sidebar .brand, #sidebar .admin-profile, #sidebar .nav-label, #sidebar .sidebar-bottom { display: initial; }
  #sidebar .sidebar-nav { display: flex !important; flex-direction: column !important; width: 100% !important; gap: 5px !important; overflow: visible !important; }
  #sidebar .sidebar-link { display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: flex-start !important; gap: 12px !important; padding: 12px 13px !important; font-size: 13px !important; text-align: left !important; white-space: normal !important; }
  #sidebar .sidebar-link svg { flex: 0 0 20px !important; width: 20px !important; height: 20px !important; }
  #sidebar .link-badge { position: static !important; margin-left: auto !important; }
  .sh-sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.62); backdrop-filter: blur(2px); z-index: 1200; opacity: 0; visibility: hidden; transition: opacity .2s ease, visibility .2s ease; }
  .sh-sidebar-overlay.show { opacity: 1; visibility: visible; }
  .sh-menu-toggle { display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; flex: 0 0 42px; border: 1px solid rgba(255,255,255,.14); border-radius: 12px; background: #17121d; color: #fff; cursor: pointer; font-size: 22px; line-height: 1; box-shadow: 0 4px 16px rgba(0,0,0,.18); }
  .sh-menu-toggle:focus-visible { outline: 2px solid #b76cff; outline-offset: 3px; }
  body.sh-sidebar-active { overflow: hidden !important; }
  .main, .main-content, .content, .content-wrapper, .content-container { width: 100% !important; max-width: 100% !important; margin-left: 0 !important; }
  .main, .main-content, .content { min-width: 0 !important; }
  .layout { display: block !important; width: 100% !important; }
  .content, .main, .main-content, .content-wrapper, .content-container { box-sizing: border-box; }
  .content-header, .page-header, .header-content { min-width: 0; flex-wrap: wrap; gap: 12px; }
  .filters { display: flex !important; flex-wrap: wrap !important; gap: 8px !important; overflow: visible !important; padding: 14px !important; }
  .filter { flex: 0 1 auto; min-height: 38px; white-space: nowrap; }
  .table-container, .table-wrapper, .data-table-wrapper, .table-responsive { max-width: 100%; overflow-x: auto !important; -webkit-overflow-scrolling: touch; }
  table { max-width: 100%; }
  input, select, textarea { max-width: 100%; }
}
@media (max-width: 600px) {
  .sh-menu-toggle { width: 40px; height: 40px; flex-basis: 40px; }
  .content, .main, .main-content, .content-wrapper, .content-container { padding-left: 14px !important; padding-right: 14px !important; }
  .filters { display: grid !important; grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .filter { width: 100%; padding: 10px 8px !important; text-align: center; font-size: 12px !important; }
  .summary-grid, .stats-grid, .cards-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  .modal, .modal-content, .dialog { max-width: calc(100vw - 24px) !important; }
}
@media (max-width: 380px) {
  .filters { grid-template-columns: minmax(0, 1fr); }
  .summary-grid, .stats-grid, .cards-grid { grid-template-columns: minmax(0, 1fr) !important; }
}

</style>
<link rel="stylesheet" href="assets/admin-modals.css?v=20261027b">
</head>


<body>


<div class="layout">


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar" id="sidebar">


        <div class="brand">

            <?php include '../components/logo.php'; ?>

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

           <?php include '../components/logout.php'; ?>

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
                        0
                    </strong>

                </div>

                <p>
                    Atendidos
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
                        0
                    </strong>

                </div>

                <p>
                    Encerrados
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
                    onclick="filterAlerts('open', this)"
                >
                    Em aberto
                </button>

                <button
                    class="filter"
                    onclick="filterAlerts('attended', this)"
                >
                    Atendidos
                </button>

                <button
                    class="filter"
                    onclick="filterAlerts('encerrado', this)"
                >
                    Encerrados
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
                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody id="alertTable">
                        <tr><td colspan="7" style="text-align:center;padding:24px">Carregando alertas do banco...</td></tr>
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
        // Os valores usados aqui seguem a coluna alerts.status do MySQL:
        // open, attended e encerrado. Normalizamos espaços e maiúsculas
        // para evitar que diferenças de apresentação quebrem os filtros.
        const normalizarStatusFiltro = (valor) => {
            const status = String(valor || "")
                .trim()
                .toLowerCase()
                .replace(/[\s-]+/g, "_");

            if (["open", "aberto", "aberta", "pending", "pendente"].includes(status)) return "open";
            if (["attended", "atendido", "atendida", "em_atendimento", "in_progress", "em_andamento"].includes(status)) return "attended";
            if (["encerrado", "encerrada", "closed", "fechado", "fechada", "resolved", "resolvido", "resolvida", "concluido", "concluida"].includes(status)) return "encerrado";
            return status;
        };

        document.querySelectorAll(".filters .filter").forEach((btn) => {
            btn.classList.toggle("active", btn === button);
        });

        const rows = document.querySelectorAll("#alertTable tr[data-status]");
        let visible = 0;

        rows.forEach((row) => {
            const rowStatus = normalizarStatusFiltro(row.dataset.status);
            const mostrar = type === "all" || rowStatus === normalizarStatusFiltro(type);
            row.hidden = !mostrar;
            row.style.display = mostrar ? "" : "none";
            if (mostrar) visible++;
        });

        const contador = document.getElementById("alertCount");
        if (contador) contador.textContent = String(visible);
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

    async function refreshAlerts() {
        try {
            const response = await fetch("../api.php?action=admin_alerts", {
                method: "POST", credentials: "same-origin",
                headers: { "Content-Type": "application/json" }, body: "{}"
            });
            const data = await response.json();
            if (!data.ok) throw new Error(data.message || "Falha ao atualizar");
            if (window.SilentHelpAdminRenderAlerts) window.SilentHelpAdminRenderAlerts(data.items || []);
            else location.reload();
            showToast("Alertas atualizados.");
        } catch (error) {
            showToast(error.message || "Não foi possível atualizar os alertas.");
        }
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
<script src="assets/admin-db.js"></script>
<script id="silenthelp-responsive-admin-js">
(function () {
  function setupSilentHelpSidebar() {
    var sidebar = document.getElementById('sidebar');
    if (!sidebar || document.body.dataset.shSidebarReady === '1') return;
    document.body.dataset.shSidebarReady = '1';

    var overlay = document.getElementById('sidebarOverlay');
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.id = 'sidebarOverlay';
      overlay.className = 'sh-sidebar-overlay';
      overlay.setAttribute('aria-hidden', 'true');
      document.body.appendChild(overlay);
    } else {
      overlay.classList.add('sh-sidebar-overlay');
    }

    var toggle = document.querySelector('.mobile-menu, .menu-toggle, [data-sidebar-toggle]');
    if (!toggle) {
      toggle = document.createElement('button');
      toggle.type = 'button';
      toggle.className = 'sh-menu-toggle';
      toggle.setAttribute('aria-label', 'Abrir menu lateral');
      toggle.setAttribute('aria-controls', 'sidebar');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.innerHTML = '&#9776;';
      var main = document.querySelector('.main-content, .content, .main, main') || document.body;
      var header = main.querySelector('.content-header, .page-header, header, .header-content');
      if (header) header.insertBefore(toggle, header.firstChild);
      else document.body.insertBefore(toggle, document.body.firstChild);
    }

    function openSidebar() {
      sidebar.classList.add('open');
      overlay.classList.add('show');
      document.body.classList.add('sh-sidebar-active');
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', 'Fechar menu lateral');
      overlay.setAttribute('aria-hidden', 'false');
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
      overlay.classList.remove('show');
      document.body.classList.remove('sh-sidebar-active');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Abrir menu lateral');
      overlay.setAttribute('aria-hidden', 'true');
    }
    function toggleSidebar() {
      if (sidebar.classList.contains('open')) closeSidebar(); else openSidebar();
    }

    // Existing buttons may call their own toggleSidebar function; this listener
    // makes the behavior consistent across every admin page.
    toggle.addEventListener('click', function (event) {
      event.preventDefault();
      toggleSidebar();
    });
    overlay.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeSidebar();
    });
    sidebar.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.matchMedia('(max-width: 1000px)').matches) closeSidebar();
      });
    });
    window.addEventListener('resize', function () {
      if (!window.matchMedia('(max-width: 1000px)').matches) closeSidebar();
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', setupSilentHelpSidebar);
  else setupSilentHelpSidebar();
})();

</script>
</body>

</html>