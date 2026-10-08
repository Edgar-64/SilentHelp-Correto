<?php require_once __DIR__ . '/../auth.php'; exigirAdmin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Dashboard Administrativo</title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
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
            --card-2: #18141f;

            --borda: rgba(255, 255, 255, .08);
            --borda-roxa: rgba(168, 85, 247, .35);

            --branco: #ffffff;
            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;
            --azul: #6ea8ff;

            --sombra:
                0 20px 60px rgba(0, 0, 0, .30);
        }

        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                radial-gradient(
                    circle at 30% -10%,
                    rgba(168, 85, 247, .18),
                    transparent 32%
                ),

                radial-gradient(
                    circle at 100% 20%,
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

        body::before {

            content: "";

            position: fixed;

            inset: 0;

            pointer-events: none;

            background-image:

                radial-gradient(
                    rgba(255, 255, 255, .035) 1px,
                    transparent 1px
                );

            background-size: 28px 28px;

            opacity: .22;

            z-index: -1;
        }

        button {
            font-family: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        /* =====================================================
           LAYOUT PRINCIPAL
        ===================================================== */

        .admin-layout {

            min-height: 100vh;

            display: flex;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            width: 255px;

            padding: 25px 17px;

            background:
                rgba(12, 10, 16, .96);

            border-right:
                1px solid
                var(--borda);

            z-index: 1000;

            display: flex;

            flex-direction: column;

            transition:
                transform .3s ease;
        }

        /* =====================================================
           LOGO
        ===================================================== */

        .brand {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                5px
                10px
                30px;

            text-decoration: none;

            color: white;
        }

        .brand-heart {

            width: 39px;
            height: 39px;

            color: var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 13px
                    rgba(168, 85, 247, .35)
                );
        }

        .brand-name {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;
        }

        .brand-name .silent {
            color: var(--roxo-2);
        }

        .brand-name .help {
            color: white;
        }

        /* =====================================================
           PERFIL ADMIN
        ===================================================== */

        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                13px
                11px;

            margin-bottom: 24px;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                rgba(255, 255, 255, .025);
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

            font-weight: 700;

            font-size: 14px;
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

            color: var(--cinza-2);

            font-size: 10px;
        }

        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        .nav-label {

            color: var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            padding:
                0
                12px
                9px;
        }

        .sidebar-nav {

            display: flex;

            flex-direction: column;

            gap: 5px;
        }

        .sidebar-link {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                12px
                13px;

            border: 1px solid transparent;

            border-radius: 13px;

            background: transparent;

            color: var(--cinza);

            text-decoration: none;

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

            flex-shrink: 0;
        }

        .sidebar-link:hover {

            color: white;

            background:
                rgba(168, 85, 247, .08);

            transform: translateX(2px);
        }

        .sidebar-link.active {

            color: var(--roxo-claro);

            background:
                linear-gradient(
                    100deg,
                    rgba(168, 85, 247, .16),
                    rgba(168, 85, 247, .06)
                );

            border:
                1px solid
                rgba(168, 85, 247, .18);
        }

        .sidebar-link .link-badge {

            margin-left: auto;

            min-width: 20px;
            height: 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 7px;

            background:
                rgba(255, 93, 115, .12);

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
           CONTEÚDO
        ===================================================== */

        .main-content {

            width: calc(100% - 255px);

            margin-left: 255px;

            padding:
                28px
                32px
                50px;
        }

        .content-container {

            width: 100%;

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

        .mobile-menu {

            display: none;

            width: 42px;
            height: 42px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255, 255, 255, .03);

            color: white;

            cursor: pointer;
        }

        .mobile-menu svg {

            width: 21px;
            height: 21px;
        }

        .welcome h1 {

            font-size: 32px;

            font-weight: 550;

            letter-spacing: -1px;

            margin-bottom: 5px;
        }

        .welcome h1 span {

            color: var(--roxo-claro);

            font-weight: 700;
        }

        .welcome p {

            color: var(--cinza);

            font-size: 13px;

            line-height: 1.5;
        }

        .header-actions {

            display: flex;

            align-items: center;

            gap: 9px;
        }

        .header-button {

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
                rgba(255, 255, 255, .03);

            color: var(--cinza);

            cursor: pointer;

            transition:
                .2s;
        }

        .header-button:hover {

            color: var(--roxo-claro);

            border-color:
                var(--borda-roxa);

            background:
                rgba(168, 85, 247, .08);
        }

        .header-button svg {

            width: 20px;
            height: 20px;
        }

        .notification-dot {

            position: absolute;

            top: 7px;
            right: 7px;

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background:
                var(--vermelho);

            box-shadow:
                0 0 8px
                rgba(255, 93, 115, .6);
        }

        /* =====================================================
           FILTRO DE PERÍODO
        ===================================================== */

        .period-filter {

            display: flex;

            align-items: center;

            gap: 5px;

            padding: 4px;

            border:
                1px solid
                var(--borda);

            border-radius: 13px;

            background:
                rgba(255, 255, 255, .025);
        }

        .period-button {

            border: none;

            padding:
                8px
                11px;

            border-radius: 9px;

            background: transparent;

            color: var(--cinza-2);

            font-size: 10px;

            cursor: pointer;

            transition: .2s;
        }

        .period-button:hover {

            color: white;
        }

        .period-button.active {

            background:
                rgba(168, 85, 247, .14);

            color:
                var(--roxo-claro);
        }

        /* =====================================================
           CARDS DE MÉTRICAS
        ===================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(5, 1fr);

            gap: 13px;

            margin-bottom: 22px;
        }

        .stat-card {

            position: relative;

            min-height: 142px;

            padding: 18px;

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 19px;

            background:

                linear-gradient(
                    145deg,
                    rgba(22, 19, 29, .92),
                    rgba(11, 10, 14, .96)
                );

            box-shadow:
                0 12px 35px
                rgba(0, 0, 0, .18);

            transition:
                transform .2s,
                border-color .2s;
        }

        .stat-card::after {

            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            right: -45px;
            bottom: -45px;

            border-radius: 50%;

            background:
                var(--stat-color);

            opacity: .06;

            filter: blur(5px);
        }

        .stat-card:hover {

            transform: translateY(-3px);

            border-color:
                rgba(168, 85, 247, .25);
        }

        .stat-card.users {
            --stat-color: var(--roxo);
        }

        .stat-card.devices {
            --stat-color: var(--azul);
        }

        .stat-card.emergency {
            --stat-color: var(--vermelho);
        }

        .stat-card.resolved {
            --stat-color: var(--verde);
        }

        .stat-card.active {
            --stat-color: var(--amarelo);
        }

        .stat-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 17px;
        }

        .stat-icon {

            width: 39px;
            height: 39px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color: var(--stat-color);

            background:
                color-mix(
                    in srgb,
                    var(--stat-color) 10%,
                    transparent
                );
        }

        .stat-icon svg {

            width: 20px;
            height: 20px;
        }

        .stat-change {

            font-size: 9px;

            font-weight: 700;

            color: var(--verde);
        }

        .stat-number {

            font-size: 27px;

            font-weight: 700;

            letter-spacing: -.5px;

            margin-bottom: 5px;
        }

        .stat-label {

            color: var(--cinza);

            font-size: 11px;
        }

        /* =====================================================
           GRID DO DASHBOARD
        ===================================================== */

        .dashboard-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1.55fr)
                minmax(320px, .9fr);

            gap: 18px;

            margin-bottom: 18px;
        }

        /* =====================================================
           CARDS GERAIS
        ===================================================== */

        .dashboard-card {

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    rgba(20, 18, 26, .90),
                    rgba(10, 10, 14, .96)
                );

            box-shadow:
                var(--sombra);

            overflow: hidden;
        }

        .card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                19px
                20px
                15px;
        }

        .card-title h2 {

            font-size: 17px;

            font-weight: 650;

            margin-bottom: 4px;
        }

        .card-title p {

            color: var(--cinza-2);

            font-size: 10px;
        }

        .card-action {

            border: none;

            background: transparent;

            color: var(--roxo-claro);

            font-size: 10px;

            font-weight: 650;

            cursor: pointer;
        }

        .card-action:hover {

            text-decoration: underline;
        }

        /* =====================================================
           GRÁFICO
        ===================================================== */

        .chart-area {

            height: 310px;

            padding:
                10px
                20px
                20px;

            display: flex;

            flex-direction: column;
        }

        .chart {

            flex: 1;

            display: flex;

            align-items: flex-end;

            gap: 15px;

            padding:
                20px
                0
                0;

            border-bottom:
                1px solid
                rgba(255, 255, 255, .06);

            position: relative;
        }

        .chart-grid {

            position: absolute;

            left: 0;
            right: 0;
            top: 20px;
            bottom: 0;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            pointer-events: none;
        }

        .chart-grid-line {

            width: 100%;

            border-top:
                1px dashed
                rgba(255, 255, 255, .055);
        }

        .bar-group {

            height: 100%;

            flex: 1;

            display: flex;

            align-items: flex-end;

            justify-content: center;

            position: relative;

            z-index: 2;
        }

        .bar {

            width: 58%;

            min-width: 12px;

            max-width: 38px;

            border-radius:
                8px
                8px
                2px
                2px;

            background:
                linear-gradient(
                    to top,
                    var(--roxo-escuro),
                    var(--roxo-2)
                );

            box-shadow:
                0 0 18px
                rgba(168, 85, 247, .12);

            transition:
                height .5s ease,
                filter .2s;
        }

        .bar:hover {

            filter:
                brightness(1.25);
        }

        .bar-labels {

            display: flex;

            gap: 15px;

            padding-top: 9px;
        }

        .bar-label {

            flex: 1;

            text-align: center;

            color: var(--cinza-2);

            font-size: 9px;
        }

        /* =====================================================
           RESUMO DE ALERTAS
        ===================================================== */

        .alert-summary {

            padding:
                0
                20px
                20px;
        }

        .summary-row {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                11px
                0;

            border-bottom:
                1px solid
                rgba(255, 255, 255, .045);
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-dot {

            width: 9px;
            height: 9px;

            min-width: 9px;

            border-radius: 50%;
        }

        .summary-dot.emergency {
            background: var(--vermelho);
        }

        .summary-dot.resolved {
            background: var(--verde);
        }

        .summary-dot.active {
            background: var(--amarelo);
        }

        .summary-dot.test {
            background: var(--azul);
        }

        .summary-row span {

            color: var(--cinza);

            font-size: 11px;

            flex: 1;
        }

        .summary-row strong {

            font-size: 12px;
        }

        /* =====================================================
           ÚLTIMOS ALERTAS
        ===================================================== */

        .recent-card {

            margin-bottom: 18px;
        }

        .recent-list {

            display: flex;

            flex-direction: column;
        }

        .recent-alert {

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                13px
                20px;

            border-top:
                1px solid
                rgba(255, 255, 255, .045);

            cursor: pointer;

            transition:
                background .2s;
        }

        .recent-alert:hover {

            background:
                rgba(168, 85, 247, .045);
        }

        .recent-icon {

            width: 40px;
            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color: var(--roxo-claro);

            background:
                rgba(168, 85, 247, .09);
        }

        .recent-icon svg {

            width: 19px;
            height: 19px;
        }

        .recent-icon.emergency {

            color: var(--vermelho);

            background:
                rgba(255, 93, 115, .08);
        }

        .recent-icon.test {

            color: var(--azul);

            background:
                rgba(110, 168, 255, .08);
        }

        .recent-info {

            flex: 1;

            min-width: 0;
        }

        .recent-info strong {

            display: block;

            font-size: 12px;

            margin-bottom: 4px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .recent-info span {

            color: var(--cinza-2);

            font-size: 9px;
        }

        .recent-status {

            padding:
                5px
                8px;

            border-radius: 7px;

            font-size: 8px;

            font-weight: 700;

            white-space: nowrap;
        }

        .recent-status.resolved {

            color: var(--verde);

            background:
                rgba(85, 223, 145, .08);
        }

        .recent-status.active {

            color: var(--amarelo);

            background:
                rgba(244, 201, 93, .08);
        }

        .recent-status.cancelled {

            color: var(--cinza);

            background:
                rgba(255, 255, 255, .06);
        }

        /* =====================================================
           FOOTER DO CARD
        ===================================================== */

        .card-footer {

            padding:
                12px
                20px;

            border-top:
                1px solid
                rgba(255, 255, 255, .045);

            text-align: center;
        }

        .card-footer button {

            border: none;

            background: transparent;

            color: var(--roxo-claro);

            font-size: 10px;

            font-weight: 650;

            cursor: pointer;
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
                rgba(0, 0, 0, .78);

            backdrop-filter:
                blur(9px);

            z-index: 5000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {

            width: 100%;

            max-width: 440px;

            padding: 25px;

            border:
                1px solid
                var(--borda-roxa);

            border-radius: 23px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29, 22, 38, .98),
                    rgba(10, 9, 14, .99)
                );

            box-shadow:
                0 30px 90px
                rgba(0, 0, 0, .65);

            animation:
                modalIn .25s ease;
        }

        @keyframes modalIn {

            from {
                opacity: 0;
                transform: translateY(12px) scale(.97);
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

            margin-bottom: 20px;
        }

        .modal-icon {

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            color: var(--roxo-claro);

            background:
                rgba(168, 85, 247, .11);
        }

        .modal-icon svg {

            width: 23px;
            height: 23px;
        }

        .modal-header h2 {

            font-size: 18px;

            margin-bottom: 3px;
        }

        .modal-header p {

            color: var(--cinza-2);

            font-size: 10px;
        }

        .detail-list {

            display: flex;

            flex-direction: column;

            gap: 8px;

            margin-bottom: 20px;
        }

        .detail-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                12px
                13px;

            border:
                1px solid
                rgba(255, 255, 255, .055);

            border-radius: 12px;

            background:
                rgba(5, 5, 8, .55);
        }

        .detail-row span {

            color: var(--cinza);

            font-size: 11px;
        }

        .detail-row strong {

            color: white;

            font-size: 11px;

            text-align: right;
        }

        .close-modal {

            width: 100%;

            padding: 12px;

            border:
                1px solid
                rgba(168, 85, 247, .28);

            border-radius: 12px;

            background:
                rgba(168, 85, 247, .08);

            color: var(--roxo-claro);

            cursor: pointer;

            font-size: 12px;

            font-weight: 650;
        }

        .close-modal:hover {

            background:
                rgba(168, 85, 247, .14);
        }

        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 25px;

            transform:
                translate(-50%, 20px);

            opacity: 0;

            pointer-events: none;

            padding:
                12px
                18px;

            border:
                1px solid
                rgba(168, 85, 247, .35);

            border-radius: 13px;

            background:
                rgba(25, 21, 31, .96);

            color: white;

            font-size: 12px;

            box-shadow:
                0 15px 45px
                rgba(0, 0, 0, .45);

            z-index: 7000;

            transition:
                opacity .25s,
                transform .25s;
        }

        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }

        /* =====================================================
           OVERLAY MOBILE
        ===================================================== */

        .sidebar-overlay {

            position: fixed;

            inset: 0;

            background:
                rgba(0, 0, 0, .65);

            display: none;

            z-index: 900;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 1150px) {

            .stats-grid {

                grid-template-columns:
                    repeat(3, 1fr);
            }

            .dashboard-grid {

                grid-template-columns:
                    1fr;
            }
        }

        @media (max-width: 850px) {

            .sidebar {

                transform:
                    translateX(-100%);
            }

            .sidebar.open {

                transform:
                    translateX(0);
            }

            .main-content {

                width: 100%;

                margin-left: 0;

                padding:
                    20px
                    18px
                    40px;
            }

            .mobile-menu {

                display: flex;

                align-items: center;

                justify-content: center;
            }

            .top-header {

                align-items: flex-start;
            }

            .welcome {

                display: flex;

                align-items: center;

                gap: 10px;
            }
        }

        @media (max-width: 650px) {

            .top-header {

                flex-wrap: wrap;
            }

            .header-actions {

                width: 100%;

                justify-content: space-between;
            }

            .period-filter {

                flex: 1;

                justify-content: center;
            }

            .stats-grid {

                grid-template-columns:
                    repeat(2, 1fr);

                gap: 9px;
            }

            .stat-card {

                min-height: 125px;

                padding: 14px;
            }

            .stat-number {

                font-size: 24px;
            }

            .chart {

                gap: 7px;
            }

            .bar-labels {

                gap: 7px;
            }

            .recent-status {

                display: none;
            }
        }

        @media (max-width: 430px) {

            .main-content {

                padding:
                    17px
                    13px
                    30px;
            }

            .welcome h1 {

                font-size: 25px;
            }

            .welcome p {

                font-size: 11px;
            }

            .stats-grid {

                gap: 7px;
            }

            .stat-card {

                padding: 12px;

                min-height: 115px;

                border-radius: 15px;
            }

            .stat-icon {

                width: 34px;
                height: 34px;
            }

            .stat-icon svg {

                width: 17px;
                height: 17px;
            }

            .stat-number {

                font-size: 21px;
            }

            .stat-label {

                font-size: 9px;
            }

            .stat-change {

                font-size: 8px;
            }

            .dashboard-card {

                border-radius: 17px;
            }

            .card-header {

                padding:
                    16px
                    15px
                    12px;
            }

            .chart-area {

                padding:
                    8px
                    15px
                    15px;

                height: 270px;
            }

            .recent-alert {

                padding:
                    12px
                    15px;
            }

            .recent-icon {

                width: 36px;
                height: 36px;

                min-width: 36px;
            }

            .recent-info strong {

                font-size: 11px;
            }

            .recent-info span {

                font-size: 8px;
            }
        }

    </style>

    <style id="admin-sidebar-structure">

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
            cursor: default;
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

        .sidebar .brand-name .silent {
            color: var(--roxo-2, #b76cff);
        }

        .sidebar .brand-name .help {
            color: white;
        }

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
            background: linear-gradient(
                135deg,
                var(--roxo, #a855f7),
                var(--roxo-escuro, #702db5)
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
            color: var(--cinza-2, #817b8c);
            font-size: 10px;
        }

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
            transition:
                background .2s,
                color .2s,
                transform .2s;
        }

        .sidebar .sidebar-link svg {
            width: 19px;
            height: 19px;
            flex: 0 0 19px;
        }

        .sidebar .sidebar-link:hover {
            color: white;
            background: rgba(168, 85, 247, .08);
            transform: translateX(2px);
        }

        .sidebar .sidebar-link.active {
            color: var(--roxo-claro, #d0a0ff);
            background: linear-gradient(
                100deg,
                rgba(168, 85, 247, .16),
                rgba(168, 85, 247, .06)
            );
            border-color: rgba(168, 85, 247, .18);
        }

        .sidebar .sidebar-link .link-badge {
            margin-left: auto;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: rgba(255, 93, 115, .12);
            color: #ff8798;
            font-size: 9px;
            font-weight: 750;
        }

        .sidebar .sidebar-bottom {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--borda, rgba(255, 255, 255, .08));
        }

        .sidebar .sidebar-bottom .sidebar-link {
            margin: 0;
        }

        /* =====================================================
           BARRA DE ROLAGEM
        ===================================================== */

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
            background: linear-gradient(
                180deg,
                #c084fc 0%,
                #8b4dcc 55%,
                #5f2f91 100%
            );
            border: 2px solid #0c0a10;
            border-radius: 999px;
            box-shadow: 0 0 9px rgba(168, 85, 247, .35);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(
                180deg,
                #d8a7ff 0%,
                #a855f7 55%,
                #7030b5 100%
            );
            box-shadow: 0 0 13px rgba(168, 85, 247, .55);
        }

        ::-webkit-scrollbar-corner {
            background: #0c0a10;
        }

        .logout-button {
            width: 100%;

            padding: 16px;

            border: 1px solid rgba(255, 101, 122, .25);
            border-radius: 17px;

            background: rgba(255, 101, 122, .06);
            color: var(--vermelho);

            font-size: 15px;
            font-weight: 600;

            cursor: pointer;
            transition: .2s;
        }

        .logout-button:hover {
            background: rgba(255, 101, 122, .12);
            border-color: rgba(255, 101, 122, .45);
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

            <a href="admin.php" class="sidebar-link active">

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

            <a href="usuarios.php" class="sidebar-link">

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

            <a href="alertas.php" class="sidebar-link">

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

            <a href="mapa-admin.php" class="sidebar-link">

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

            <a href="dispositivos.php" class="sidebar-link">

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

            <a href="contatos-admin.php" class="sidebar-link">

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

            <a href="relatorios.php" class="sidebar-link">

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

            <a href="config-admin.php" class="sidebar-link">

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

        <!-- =====================================================
             SAIR
             SEM CONFIRMAÇÃO
        ====================================================== -->

        <div class="sidebar-bottom">

            <?php include '../components/logout.php'; ?>

        </div>

    </aside>

    <!-- =====================================================
         OVERLAY MOBILE
    ====================================================== -->

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()"
    ></div>

    <!-- =====================================================
         CONTEÚDO PRINCIPAL
    ====================================================== -->

    <main class="main-content">

        <div class="content-container">

            <!-- HEADER -->

            <header class="top-header">

                <div class="welcome">

                    <button
                        class="mobile-menu"
                        onclick="toggleSidebar()"
                        aria-label="Abrir menu"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                        >

                            <line
                                x1="4"
                                y1="6"
                                x2="20"
                                y2="6"
                            />

                            <line
                                x1="4"
                                y1="12"
                                x2="20"
                                y2="12"
                            />

                            <line
                                x1="4"
                                y1="18"
                                x2="20"
                                y2="18"
                            />

                        </svg>

                    </button>

                    <div>

                        <h1>
                            Olá, <span>Administrador</span>
                        </h1>

                        <p>
                            Acompanhe o funcionamento e a segurança do SilentHelp.
                        </p>

                    </div>

                </div>

                <div class="header-actions">

                    <div class="period-filter">

                        <button
                            class="period-button"
                            onclick="changePeriod(this, 'Hoje')"
                        >
                            Hoje
                        </button>

                        <button
                            class="period-button active"
                            onclick="changePeriod(this, '7 dias')"
                        >
                            7 dias
                        </button>

                        <button
                            class="period-button"
                            onclick="changePeriod(this, '30 dias')"
                        >
                            30 dias
                        </button>

                    </div>

                    <button
                        class="header-button"
                        onclick="refreshDashboard()"
                        aria-label="Atualizar"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <polyline
                                points="23 4 23 10 17 10"
                            />

                            <polyline
                                points="1 20 1 14 7 14"
                            />

                            <path
                                d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10"
                            />

                            <path
                                d="M20.49 15A9 9 0 0 1 5.64 18.36L1 14"
                            />

                        </svg>

                    </button>

                    <button
                        class="header-button"
                        onclick="showToast('Você possui 3 novos alertas.')"
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

                        <span class="notification-dot"></span>

                    </button>

                </div>

            </header>

            <!-- =================================================
                 MÉTRICAS
            ================================================== -->

            <section class="stats-grid">

                <div class="stat-card users">

                    <div class="stat-top">

                        <div class="stat-icon">

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

                        </div>

                        <span class="stat-change">
                            +8,4%
                        </span>

                    </div>

                    <div class="stat-number" id="usersCount">
                        248
                    </div>

                    <div class="stat-label">
                        Total de usuários
                    </div>

                </div>

                <div class="stat-card devices">

                    <div class="stat-top">

                        <div class="stat-icon">

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

                        </div>

                        <span class="stat-change">
                            +5,2%
                        </span>

                    </div>

                    <div class="stat-number" id="devicesCount">
                        231
                    </div>

                    <div class="stat-label">
                        Dispositivos cadastrados
                    </div>

                </div>

                <div class="stat-card emergency">

                    <div class="stat-top">

                        <div class="stat-icon">

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

                        <span
                            class="stat-change"
                            style="color:var(--vermelho);"
                        >
                            +2 hoje
                        </span>

                    </div>

                    <div class="stat-number" id="emergencyCount">
                        34
                    </div>

                    <div class="stat-label">
                        Alertas de emergência
                    </div>

                </div>

                <div class="stat-card resolved">

                    <div class="stat-top">

                        <div class="stat-icon">

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

                        <span class="stat-change">
                            94,1%
                        </span>

                    </div>

                    <div class="stat-number" id="resolvedCount">
                        198
                    </div>

                    <div class="stat-label">
                        Alertas resolvidos
                    </div>

                </div>

                <div class="stat-card active">

                    <div class="stat-top">

                        <div class="stat-icon">

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

                                <polyline
                                    points="12 7 12 12 15 14"
                                />

                            </svg>

                        </div>

                        <span
                            class="stat-change"
                            style="color:var(--amarelo);"
                        >
                            Atenção
                        </span>

                    </div>

                    <div class="stat-number" id="activeCount">
                        3
                    </div>

                    <div class="stat-label">
                        Alertas ativos
                    </div>

                </div>

            </section>

            <!-- =================================================
                 GRÁFICO + RESUMO
            ================================================== -->

            <section class="dashboard-grid">

                <!-- GRÁFICO -->

                <div class="dashboard-card">

                    <div class="card-header">

                        <div class="card-title">

                            <h2>
                                Alertas registrados
                            </h2>

                            <p>
                                Quantidade de alertas nos últimos 7 dias
                            </p>

                        </div>

                        <button
                            class="card-action"
                            onclick="showToast('Abrindo relatório de alertas...')"
                        >
                            Ver relatório
                        </button>

                    </div>

                    <div class="chart-area">

                        <div class="chart">

                            <div class="chart-grid">

                                <div class="chart-grid-line"></div>
                                <div class="chart-grid-line"></div>
                                <div class="chart-grid-line"></div>
                                <div class="chart-grid-line"></div>
                                <div class="chart-grid-line"></div>

                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:45%;"
                                    title="Segunda: 18 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:64%;"
                                    title="Terça: 26 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:53%;"
                                    title="Quarta: 21 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:78%;"
                                    title="Quinta: 31 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:68%;"
                                    title="Sexta: 27 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:88%;"
                                    title="Sábado: 35 alertas"
                                ></div>
                            </div>

                            <div class="bar-group">
                                <div
                                    class="bar"
                                    style="height:59%;"
                                    title="Domingo: 24 alertas"
                                ></div>
                            </div>

                        </div>

                        <div class="bar-labels">

                            <div class="bar-label">Seg</div>
                            <div class="bar-label">Ter</div>
                            <div class="bar-label">Qua</div>
                            <div class="bar-label">Qui</div>
                            <div class="bar-label">Sex</div>
                            <div class="bar-label">Sáb</div>
                            <div class="bar-label">Dom</div>

                        </div>

                    </div>

                </div>

                <!-- RESUMO -->

                <div class="dashboard-card">

                    <div class="card-header">

                        <div class="card-title">

                            <h2>
                                Resumo dos alertas
                            </h2>

                            <p>
                                Distribuição por situação
                            </p>

                        </div>

                    </div>

                    <div class="alert-summary">

                        <div class="summary-row">

                            <span class="summary-dot emergency"></span>

                            <span>
                                Emergência
                            </span>

                            <strong>
                                34
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span class="summary-dot resolved"></span>

                            <span>
                                Resolvidos
                            </span>

                            <strong>
                                198
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span class="summary-dot active"></span>

                            <span>
                                Ativos
                            </span>

                            <strong>
                                3
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span class="summary-dot test"></span>

                            <span>
                                Testes
                            </span>

                            <strong>
                                42
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span
                                class="summary-dot"
                                style="background:var(--cinza-2);"
                            ></span>

                            <span>
                                Cancelados
                            </span>

                            <strong>
                                18
                            </strong>

                        </div>

                    </div>

                </div>

            </section>

            <!-- =================================================
                 ÚLTIMOS ALERTAS
            ================================================== -->

            <section class="dashboard-card recent-card">

                <div class="card-header">

                    <div class="card-title">

                        <h2>
                            Últimos alertas registrados
                        </h2>

                        <p>
                            Acompanhe as ocorrências mais recentes
                        </p>

                    </div>

                    <button
                        class="card-action"
                        onclick="window.location.href='alertas.php'"
                    >
                        Ver todos
                    </button>

                </div>

                <div class="recent-list">

                    <!-- ALERTA 1 -->

                    <div
                        class="recent-alert"
                        onclick="openAlert(
                            'Alerta de emergência',
                            '15/08/2026, 10:42',
                            'Maria Silva',
                            'Taubaté - SP',
                            'Resolvido'
                        )"
                    >

                        <div class="recent-icon emergency">

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

                        <div class="recent-info">

                            <strong>
                                Alerta de emergência
                            </strong>

                            <span>
                                Maria Silva • Hoje, 10:42
                            </span>

                        </div>

                        <span class="recent-status resolved">
                            Resolvido
                        </span>

                    </div>

                    <!-- ALERTA 2 -->

                    <div
                        class="recent-alert"
                        onclick="openAlert(
                            'Alerta de emergência',
                            '15/08/2026, 09:28',
                            'Ana Oliveira',
                            'Taubaté - SP',
                            'Ativo'
                        )"
                    >

                        <div class="recent-icon emergency">

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

                        <div class="recent-info">

                            <strong>
                                Alerta de emergência
                            </strong>

                            <span>
                                Ana Oliveira • Hoje, 09:28
                            </span>

                        </div>

                        <span class="recent-status active">
                            Ativo
                        </span>

                    </div>

                    <!-- ALERTA 3 -->

                    <div
                        class="recent-alert"
                        onclick="openAlert(
                            'Teste de segurança',
                            '15/08/2026, 08:15',
                            'Juliana Costa',
                            'São José dos Campos - SP',
                            'Concluído'
                        )"
                    >

                        <div class="recent-icon test">

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

                        <div class="recent-info">

                            <strong>
                                Teste de segurança
                            </strong>

                            <span>
                                Juliana Costa • Hoje, 08:15
                            </span>

                        </div>

                        <span class="recent-status resolved">
                            Concluído
                        </span>

                    </div>

                    <!-- ALERTA 4 -->

                    <div
                        class="recent-alert"
                        onclick="openAlert(
                            'Alerta de emergência',
                            '14/08/2026, 21:37',
                            'Camila Santos',
                            'Taubaté - SP',
                            'Resolvido'
                        )"
                    >

                        <div class="recent-icon emergency">

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

                        <div class="recent-info">

                            <strong>
                                Alerta de emergência
                            </strong>

                            <span>
                                Camila Santos • Ontem, 21:37
                            </span>

                        </div>

                        <span class="recent-status resolved">
                            Resolvido
                        </span>

                    </div>

                    <!-- ALERTA 5 -->

                    <div
                        class="recent-alert"
                        onclick="openAlert(
                            'Verificação do dispositivo',
                            '14/08/2026, 17:20',
                            'Beatriz Souza',
                            'Taubaté - SP',
                            'Concluído'
                        )"
                    >

                        <div class="recent-icon test">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <path
                                    d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                                />

                                <path
                                    d="m9 12 2 2 4-4"
                                />

                            </svg>

                        </div>

                        <div class="recent-info">

                            <strong>
                                Verificação do dispositivo
                            </strong>

                            <span>
                                Beatriz Souza • 14/08/2026, 17:20
                            </span>

                        </div>

                        <span class="recent-status resolved">
                            Concluído
                        </span>

                    </div>

                </div>

                <div class="card-footer">

                    <button
                        onclick="window.location.href='alertas.php'"
                    >
                        Visualizar todos os alertas →
                    </button>

                </div>

            </section>

        </div>

    </main>

</div>

<!-- =====================================================
     MODAL
====================================================== -->

<div
    class="modal"
    id="alertModal"
    onclick="closeModalOutside(event)"
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

            <div>

                <h2 id="modalTitle">
                    Detalhes do alerta
                </h2>

                <p>
                    Informações registradas pelo sistema
                </p>

            </div>

        </div>

        <div class="detail-list">

            <div class="detail-row">

                <span>
                    Data e horário
                </span>

                <strong id="modalDate">
                    -
                </strong>

            </div>

            <div class="detail-row">

                <span>
                    Usuária
                </span>

                <strong id="modalUser">
                    -
                </strong>

            </div>

            <div class="detail-row">

                <span>
                    Localização
                </span>

                <strong id="modalLocation">
                    -
                </strong>

            </div>

            <div class="detail-row">

                <span>
                    Status
                </span>

                <strong id="modalStatus">
                    -
                </strong>

            </div>

        </div>

        <button
            class="close-modal"
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
       TOAST
    ===================================================== */

    let toastTimer;

    function showToast(message) {

        const toast =
            document.getElementById("toast");

        toast.textContent = message;

        toast.classList.add("show");

        clearTimeout(toastTimer);

        toastTimer =
            setTimeout(() => {

                toast.classList.remove("show");

            }, 2600);
    }

    /* =====================================================
       SIDEBAR MOBILE
    ===================================================== */

    function toggleSidebar() {

        document
            .getElementById("sidebar")
            .classList.toggle("open");

        document
            .getElementById("sidebarOverlay")
            .classList.toggle("show");
    }

    function closeSidebar() {

        document
            .getElementById("sidebar")
            .classList.remove("open");

        document
            .getElementById("sidebarOverlay")
            .classList.remove("show");
    }

    /* =====================================================
       PERÍODO
    ===================================================== */

    function changePeriod(button, period) {

        document
            .querySelectorAll(".period-button")
            .forEach(btn => {

                btn.classList.remove("active");

            });

        button.classList.add("active");

        showToast(
            "Período alterado para: " + period
        );
    }

    /* =====================================================
       ATUALIZAR DASHBOARD
    ===================================================== */

    function refreshDashboard() {

        showToast(
            "Dashboard atualizado com sucesso."
        );

        const button =
            document.querySelector(
                ".header-button"
            );

        button.style.transform =
            "rotate(180deg)";

        setTimeout(() => {

            button.style.transform =
                "rotate(0deg)";

        }, 450);
    }

    /* =====================================================
       MODAL DE ALERTA
    ===================================================== */

    function openAlert(
        title,
        date,
        user,
        location,
        status
    ) {

        document.getElementById(
            "modalTitle"
        ).textContent = title;

        document.getElementById(
            "modalDate"
        ).textContent = date;

        document.getElementById(
            "modalUser"
        ).textContent = user;

        document.getElementById(
            "modalLocation"
        ).textContent = location;

        document.getElementById(
            "modalStatus"
        ).textContent = status;

        document
            .getElementById("alertModal")
            .classList.add("show");
    }

    function closeModal() {

        document
            .getElementById("alertModal")
            .classList.remove("show");
    }

    function closeModalOutside(event) {

        if (
            event.target.id ===
            "alertModal"
        ) {

            closeModal();

        }
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

                closeModal();

                closeSidebar();

            }

        }
    );

    /* =====================================================
       FECHAR SIDEBAR AO REDIMENSIONAR
    ===================================================== */

    window.addEventListener(
        "resize",
        function() {

            if (
                window.innerWidth > 850
            ) {

                closeSidebar();

            }

        }
    );

    function sairConta() {

            const confirmar =
                confirm(
                    "Deseja realmente sair da sua conta?"
                );


            if (confirmar) {

                mostrarMensagem(
                    "Saindo da conta..."
                );


                setTimeout(
                    function() {

                        window.location.href =
                            "logout.php";

                    },
                    800
                );

            }

        }

</script>

<script src="../assets/db-sync.js"></script>
<script src="../assets/admin-db.js"></script>
</body>

</html>