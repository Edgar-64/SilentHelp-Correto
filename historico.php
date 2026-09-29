<?php
require_once __DIR__ . '/auth.php';
exigirLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Histórico de Alertas</title>

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
            --fundo-2: #0b0910;
            --card: rgba(18, 16, 24, .82);
            --card-2: rgba(25, 22, 32, .82);
            --borda: rgba(255, 255, 255, .075);
            --borda-roxa: rgba(168, 85, 247, .35);
            --branco: #ffffff;
            --cinza: #aaa5b4;
            --cinza-2: #817b8c;
            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;

            --sombra:
                0 20px 60px rgba(0, 0, 0, .35);
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
                radial-gradient(
                    circle at 0% 70%,
                    rgba(168, 85, 247, .06),
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
            font-size: 16px;
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

            mask-image:
                linear-gradient(
                    to bottom,
                    black,
                    transparent 70%
                );

            opacity: .25;
            z-index: -1;
        }

        button {
            font-family: inherit;
        }

        button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {
            width: 100%;
            max-width: 1080px;

            margin: auto;

            padding:
                28px
                25px
                50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 35px;
        }


        /* =====================================================
           LOGO / BOTÃO INÍCIO
        ===================================================== */

        .logo-button {
            display: inline-flex;
            align-items: center;

            gap: 12px;

            border: none;
            background: transparent;

            color: white;

            padding: 5px;

            border-radius: 16px;

            cursor: pointer;

            transition:
                transform .2s,
                background .2s;
        }

        .logo-button:hover {
            transform: translateY(-2px);

            background:
                rgba(168, 85, 247, .07);
        }

        .logo-heart {
            width: 51px;
            height: 51px;

            color: var(--roxo-2);

            filter:
                drop-shadow(
                    0 0 16px
                    rgba(168, 85, 247, .35)
                );
        }

        .logo-text {
            font-size: 34px;
            font-weight: 750;

            letter-spacing: -1.5px;
        }

        .logo-text .silent {
            color: var(--roxo-2);
        }

        .logo-text .help {
            color: white;
        }


        /* =====================================================
           NOTIFICAÇÃO
        ===================================================== */

        .notification {
            position: relative;

            width: 50px;
            height: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 16px;

            background:
                rgba(255, 255, 255, .035);

            color: var(--roxo-claro);

            cursor: pointer;

            backdrop-filter:
                blur(15px);

            transition:
                transform .2s,
                background .2s,
                border-color .2s;
        }

        .notification:hover {
            transform: translateY(-3px);

            background:
                rgba(168, 85, 247, .10);

            border-color:
                var(--borda-roxa);
        }

        .notification svg {
            width: 24px;
            height: 24px;
        }

        .notification-badge {
            position: absolute;

            top: -5px;
            right: -5px;

            min-width: 21px;
            height: 21px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                var(--vermelho);

            color: white;

            font-size: 10px;
            font-weight: 800;

            border:
                2px solid
                var(--fundo);

            box-shadow:
                0 0 12px
                rgba(255, 93, 115, .3);
        }


        /* =====================================================
           TÍTULO
        ===================================================== */

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 40px;
            font-weight: 500;

            letter-spacing: -1.2px;

            margin-bottom: 7px;
        }

        .page-title h1 span {
            color: var(--roxo-claro);
            font-weight: 700;
        }

        .page-title p {
            color: var(--cinza);

            font-size: 16px;
            line-height: 1.6;
        }


        /* =====================================================
           RESUMO
        ===================================================== */

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 13px;

            margin-bottom: 28px;
        }

        .summary-card {
            min-height: 105px;

            padding: 18px;

            border:
                1px solid
                var(--borda);

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    rgba(20, 18, 26, .88),
                    rgba(10, 10, 14, .92)
                );

            box-shadow:
                var(--sombra);

            transition:
                transform .2s,
                border-color .2s;
        }

        .summary-card:hover {
            transform: translateY(-3px);

            border-color:
                rgba(168, 85, 247, .30);
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 13px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(168, 85, 247, .10);

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
            color: var(--cinza);
            font-size: 13px;
        }

        .summary-card.success .summary-icon {
            color: var(--verde);

            background:
                rgba(85, 223, 145, .08);
        }

        .summary-card.danger .summary-icon {
            color: var(--vermelho);

            background:
                rgba(255, 93, 115, .08);
        }


        /* =====================================================
           CABEÇALHO DO HISTÓRICO
        ===================================================== */

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 17px;
        }

        .history-title {
            display: flex;
            align-items: center;

            gap: 10px;
        }

        .history-title h2 {
            font-size: 22px;
            font-weight: 600;

            letter-spacing: -.3px;
        }

        .history-count {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 27px;
            height: 27px;

            padding: 0 8px;

            border-radius: 9px;

            background:
                rgba(168, 85, 247, .12);

            color:
                var(--roxo-claro);

            font-size: 12px;
            font-weight: 750;
        }

        .clear-button {
            padding:
                10px
                14px;

            border:
                1px solid
                rgba(255, 93, 115, .20);

            border-radius: 12px;

            background:
                rgba(255, 93, 115, .055);

            color:
                #ff8999;

            font-size: 12px;
            font-weight: 650;

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s,
                transform .2s;
        }

        .clear-button:hover {
            transform: translateY(-2px);

            background:
                rgba(255, 93, 115, .10);

            border-color:
                rgba(255, 93, 115, .40);
        }


        /* =====================================================
           FILTROS
        ===================================================== */

        .filters {
            display: flex;
            align-items: center;

            gap: 8px;

            margin-bottom: 18px;

            overflow-x: auto;

            padding-bottom: 3px;
        }

        .filter-button {
            flex-shrink: 0;

            padding:
                10px
                15px;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255, 255, 255, .025);

            color:
                var(--cinza);

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s,
                color .2s;
        }

        .filter-button:hover {
            border-color:
                rgba(168, 85, 247, .30);

            color:
                var(--roxo-claro);
        }

        .filter-button.active {
            background:
                rgba(168, 85, 247, .13);

            border-color:
                rgba(168, 85, 247, .35);

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           LISTA DE ALERTAS
        ===================================================== */

        .alert-list {
            display: flex;

            flex-direction: column;

            gap: 12px;
        }

        .alert-card {
            position: relative;

            display: flex;
            align-items: center;

            gap: 16px;

            padding: 19px;

            border:
                1px solid
                rgba(255, 255, 255, .065);

            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    rgba(20, 18, 26, .88),
                    rgba(10, 10, 14, .94)
                );

            box-shadow:
                0 12px 35px
                rgba(0, 0, 0, .18);

            transition:
                transform .2s,
                border-color .2s,
                background .2s;

            cursor: pointer;
        }

        .alert-card:hover {
            transform: translateY(-2px);

            border-color:
                rgba(168, 85, 247, .30);

            background:
                linear-gradient(
                    145deg,
                    rgba(28, 22, 37, .92),
                    rgba(11, 10, 15, .95)
                );
        }

        .alert-icon {
            width: 56px;
            height: 56px;

            min-width: 56px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background:
                rgba(168, 85, 247, .10);

            color:
                var(--roxo-claro);

            border:
                1px solid
                rgba(168, 85, 247, .12);
        }

        .alert-icon svg {
            width: 27px;
            height: 27px;
        }

        .alert-icon.emergency {
            background:
                rgba(255, 93, 115, .09);

            color:
                var(--vermelho);

            border-color:
                rgba(255, 93, 115, .15);
        }

        .alert-icon.test {
            background:
                rgba(85, 223, 145, .08);

            color:
                var(--verde);

            border-color:
                rgba(85, 223, 145, .14);
        }

        .alert-info {
            flex: 1;
            min-width: 0;
        }

        .alert-name {
            display: flex;
            align-items: center;

            flex-wrap: wrap;

            gap: 8px;

            margin-bottom: 5px;
        }

        .alert-name h3 {
            font-size: 16px;
            font-weight: 650;
        }

        .alert-status {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding:
                4px
                8px;

            border-radius: 7px;

            font-size: 9px;
            font-weight: 750;

            text-transform: uppercase;

            letter-spacing: .4px;
        }

        .alert-status-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background:
                currentColor;
        }

        .alert-status.resolved {
            color:
                var(--verde);

            background:
                rgba(85, 223, 145, .08);
        }

        .alert-status.cancelled {
            color:
                var(--cinza);

            background:
                rgba(255, 255, 255, .06);
        }

        .alert-meta {
            display: flex;

            align-items: center;

            flex-wrap: wrap;

            gap: 7px;

            color:
                var(--cinza);

            font-size: 12px;
        }

        .alert-meta span {
            display: flex;

            align-items: center;

            gap: 4px;
        }

        .meta-separator {
            color: var(--cinza-2);
        }

        .alert-action {
            width: 40px;
            height: 40px;

            min-width: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 12px;

            background:
                rgba(255, 255, 255, .025);

            color:
                var(--cinza-2);

            cursor: pointer;

            transition:
                background .2s,
                color .2s,
                border-color .2s,
                transform .2s;
        }

        .alert-action:hover {
            transform: translateX(2px);

            background:
                rgba(168, 85, 247, .09);

            border-color:
                rgba(168, 85, 247, .35);

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           ESTADO VAZIO
        ===================================================== */

        .empty-state {
            display: none;

            padding: 50px 25px;

            text-align: center;

            border:
                1px solid
                var(--borda);

            border-radius: 23px;

            background:
                rgba(18, 16, 24, .70);
        }

        .empty-state.show {
            display: block;
        }

        .empty-icon {
            width: 65px;
            height: 65px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin:
                0 auto
                15px;

            border-radius: 20px;

            background:
                rgba(168, 85, 247, .09);

            color:
                var(--roxo-claro);
        }

        .empty-state h3 {
            font-size: 18px;

            margin-bottom: 6px;
        }

        .empty-state p {
            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {
            position: fixed;

            left: 50%;
            bottom: 30px;

            transform:
                translate(-50%, 25px);

            opacity: 0;

            pointer-events: none;

            z-index: 5000;

            width: max-content;
            max-width: 90%;

            padding:
                14px
                21px;

            border:
                1px solid
                rgba(168, 85, 247, .45);

            border-radius: 15px;

            background:
                rgba(24, 21, 30, .94);

            color: white;

            font-size: 14px;

            text-align: center;

            box-shadow:
                0 15px 45px
                rgba(0, 0, 0, .45);

            backdrop-filter:
                blur(15px);

            transition:
                opacity .3s,
                transform .3s;
        }

        .toast.show {
            opacity: 1;

            transform:
                translate(-50%, 0);
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
                blur(10px);

            z-index: 3000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 450px;

            padding: 28px;

            border:
                1px solid
                rgba(168, 85, 247, .38);

            border-radius: 25px;

            background:
                linear-gradient(
                    145deg,
                    rgba(29, 22, 38, .98),
                    rgba(10, 9, 14, .98)
                );

            box-shadow:
                0 30px 90px
                rgba(0, 0, 0, .65);
        }

        .modal-top {
            display: flex;
            align-items: center;

            gap: 13px;

            margin-bottom: 22px;
        }

        .modal-icon {
            width: 55px;
            height: 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background:
                rgba(168, 85, 247, .12);

            color:
                var(--roxo-claro);
        }

        .modal-top h2 {
            font-size: 21px;

            font-weight: 650;

            margin-bottom: 3px;
        }

        .modal-top p {
            color:
                var(--cinza);

            font-size: 12px;
        }

        .detail-list {
            display: flex;

            flex-direction: column;

            gap: 9px;

            margin-bottom: 21px;
        }

        .detail-item {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding:
                13px
                14px;

            border:
                1px solid
                rgba(255, 255, 255, .06);

            border-radius: 13px;

            background:
                rgba(7, 7, 11, .60);
        }

        .detail-item span {
            color:
                var(--cinza);

            font-size: 12px;
        }

        .detail-item strong {
            color:
                white;

            font-size: 12px;

            font-weight: 600;

            text-align: right;
        }

        .modal-close {
            width: 100%;

            padding: 14px;

            border:
                1px solid
                rgba(168, 85, 247, .30);

            border-radius: 13px;

            background:
                rgba(168, 85, 247, .08);

            color:
                var(--roxo-claro);

            font-size: 13px;

            font-weight: 650;

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s;
        }

        .modal-close:hover {
            background:
                rgba(168, 85, 247, .14);

            border-color:
                rgba(168, 85, 247, .50);
        }


        /* =====================================================
           MODAL CONFIRMAÇÃO
        ===================================================== */

        .confirm-modal {
            text-align: center;
        }

        .confirm-icon {
            width: 62px;
            height: 62px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin:
                0 auto
                15px;

            border-radius: 18px;

            background:
                rgba(255, 93, 115, .09);

            color:
                var(--vermelho);
        }

        .confirm-modal h2 {
            font-size: 21px;

            margin-bottom: 8px;
        }

        .confirm-modal p {
            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.6;

            margin-bottom: 20px;
        }

        .modal-buttons {
            display: flex;

            gap: 9px;
        }

        .modal-buttons button {
            flex: 1;

            padding: 13px;

            border-radius: 13px;

            font-size: 13px;

            font-weight: 650;

            cursor: pointer;
        }

        .cancel-button {
            border:
                1px solid
                var(--borda);

            background:
                rgba(255, 255, 255, .035);

            color:
                white;
        }

        .delete-button {
            border: none;

            background:
                linear-gradient(
                    100deg,
                    #c73f57,
                    #ff5d73
                );

            color: white;
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .app {
                padding:
                    19px
                    15px
                    40px;
            }

            .header {
                margin-bottom: 28px;
            }

            .logo-heart {
                width: 43px;
                height: 43px;
            }

            .logo-text {
                font-size: 30px;
            }

            .notification {
                width: 45px;
                height: 45px;
            }

            .page-title h1 {
                font-size: 31px;
            }

            .page-title p {
                font-size: 14px;
            }

            .summary-grid {
                grid-template-columns:
                    repeat(3, 1fr);

                gap: 8px;
            }

            .summary-card {
                padding: 13px;
                min-height: 95px;
            }

            .summary-icon {
                width: 32px;
                height: 32px;
            }

            .summary-number {
                font-size: 21px;
            }

            .summary-card p {
                font-size: 10px;
            }

            .history-header {
                align-items: flex-start;
            }

            .history-title h2 {
                font-size: 19px;
            }

            .clear-button {
                padding:
                    9px
                    11px;

                font-size: 10px;
            }

            .alert-card {
                padding: 15px;
                gap: 12px;
            }

            .alert-icon {
                width: 48px;
                height: 48px;
                min-width: 48px;
            }

            .alert-name h3 {
                font-size: 14px;
            }

            .alert-meta {
                font-size: 10px;
            }

            .alert-action {
                width: 36px;
                height: 36px;
                min-width: 36px;
            }
        }

        @media (max-width: 480px) {

            .logo-text {
                font-size: 27px;
            }

            .page-title h1 {
                font-size: 28px;
            }

            .page-title p {
                font-size: 13px;
            }

            .summary-grid {
                gap: 6px;
            }

            .summary-card {
                padding: 10px;
            }

            .summary-number {
                font-size: 19px;
            }

            .summary-card p {
                font-size: 9px;
            }

            .summary-icon {
                width: 29px;
                height: 29px;
            }

            .history-title h2 {
                font-size: 17px;
            }

            .history-count {
                min-width: 24px;
                height: 24px;
                font-size: 10px;
            }

            .alert-card {
                align-items: flex-start;
            }

            .alert-icon {
                width: 43px;
                height: 43px;
                min-width: 43px;
                border-radius: 13px;
            }

            .alert-name {
                gap: 5px;
            }

            .alert-name h3 {
                font-size: 13px;
            }

            .alert-status {
                font-size: 7px;
                padding:
                    3px
                    6px;
            }

            .alert-meta {
                display: block;
                line-height: 1.7;
            }

            .alert-meta .meta-separator {
                display: none;
            }

            .alert-action {
                width: 32px;
                height: 32px;
                min-width: 32px;
            }

            .modal-content {
                padding:
                    23px
                    18px;
            }

            .modal-top h2 {
                font-size: 19px;
            }

            .modal-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 360px) {

            .logo-text {
                font-size: 24px;
            }

            .notification {
                width: 42px;
                height: 42px;
            }

            .page-title h1 {
                font-size: 24px;
            }

            .summary-number {
                font-size: 17px;
            }

            .summary-card p {
                font-size: 8px;
            }

            .alert-card {
                padding: 12px;
            }

            .alert-name h3 {
                font-size: 12px;
            }

            .alert-meta {
                font-size: 9px;
            }
        }

    </style>

</head>


<body>

<div class="app">


    <!-- =====================================================
         HEADER
    ===================================================== -->

    <header class="header">

        <button
            class="logo-button"
            onclick="goTo('index.php')"
        >

            <svg
                class="logo-heart"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
            >
                <path
                    d="M20.8 8.7
                       C20.8 5.7 18.5 3.5 15.7 3.5
                       C13.9 3.5 12.4 4.4 11.5 5.8
                       C10.6 4.4 9.1 3.5 7.3 3.5
                       C4.5 3.5 2.2 5.7 2.2 8.7
                       C2.2 13.8 7.1 17.3 11.5 20.5
                       C15.9 17.3 20.8 13.8 20.8 8.7Z"
                />
            </svg>

            <span class="logo-text">
                <span class="silent">Silent</span><span class="help">Help</span>
            </span>

        </button>


        <button
            class="notification"
            onclick="goTo('notificacoes.php')"
            aria-label="Notificações"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
            >
                <path
                    d="M18 8
                       C18 5 16.2 3 13.5 2.5
                       M6 8
                       C6 4.7 8.4 2 12 2
                       C15.6 2 18 4.7 18 8
                       C18 14 20 16 20 16
                       H4
                       C4 16 6 14 6 8Z"
                />

                <path
                    d="M10 20
                       C10.5 21.3 11.2 22 12 22
                       C12.8 22 13.5 21.3 14 20"
                />
            </svg>

            <span
                class="notification-badge"
                id="notificationBadge"
            >
                2
            </span>

        </button>

    </header>



    <!-- =====================================================
         CONTEÚDO
    ===================================================== -->

    <main>


        <!-- TÍTULO -->

        <section class="page-title">

            <h1>
                Histórico de <span>Alertas</span>
            </h1>

            <p>
                Consulte os registros de emergência e verificações do seu dispositivo.
            </p>

        </section>



        <!-- =================================================
             RESUMO
        ================================================= -->

        <section class="summary-grid">


            <div class="summary-card">

                <div class="summary-top">

                    <div class="summary-icon">
                        📋
                    </div>

                    <strong
                        class="summary-number"
                        id="totalAlerts"
                    >
                        0
                    </strong>

                </div>

                <p>
                    Total de alertas
                </p>

            </div>



            <div class="summary-card danger">

                <div class="summary-top">

                    <div class="summary-icon">
                        🆘
                    </div>

                    <strong
                        class="summary-number"
                        id="emergencyAlerts"
                    >
                        0
                    </strong>

                </div>

                <p>
                    Emergências
                </p>

            </div>



            <div class="summary-card success">

                <div class="summary-top">

                    <div class="summary-icon">
                        ✓
                    </div>

                    <strong
                        class="summary-number"
                        id="resolvedAlerts"
                    >
                        0
                    </strong>

                </div>

                <p>
                    Resolvidos
                </p>

            </div>


        </section>



        <!-- =================================================
             CABEÇALHO HISTÓRICO
        ================================================= -->

        <section class="history-header">

            <div class="history-title">

                <h2>
                    Histórico
                </h2>

                <span
                    class="history-count"
                    id="historyCount"
                >
                    0
                </span>

            </div>


            <button
                class="clear-button"
                onclick="openClearModal()"
            >
                Limpar
            </button>

        </section>



        <!-- =================================================
             FILTROS
        ================================================= -->

        <div class="filters">

            <button
                class="filter-button active"
                onclick="filterAlerts('all', this)"
            >
                Todos
            </button>


            <button
                class="filter-button"
                onclick="filterAlerts('emergency', this)"
            >
                Emergência
            </button>


            <button
                class="filter-button"
                onclick="filterAlerts('test', this)"
            >
                Testes
            </button>


            <button
                class="filter-button"
                onclick="filterAlerts('cancelled', this)"
            >
                Cancelados
            </button>

        </div>



        <!-- =================================================
             LISTA
        ================================================= -->

        <div
            class="alert-list"
            id="alertList"
        >
        </div>



        <!-- =================================================
             ESTADO VAZIO
        ================================================= -->

        <div
            class="empty-state"
            id="emptyState"
        >

            <div class="empty-icon">
                📋
            </div>

            <h3>
                Nenhum alerta encontrado
            </h3>

            <p>
                Quando houver registros de alertas ou verificações,
                eles aparecerão aqui.
            </p>

        </div>

    </main>

</div>



<!-- =========================================================
     MODAL DE DETALHES
========================================================= -->

<div
    class="modal"
    id="detailsModal"
    onclick="fecharModalFora(event)"
>

    <div
        class="modal-content"
        onclick="event.stopPropagation()"
    >

        <div class="modal-top">

            <div class="modal-icon">
                🆘
            </div>

            <div>

                <h2 id="detailTitle">
                    Detalhes do alerta
                </h2>

                <p>
                    Informações do registro
                </p>

            </div>

        </div>


        <div class="detail-list">


            <div class="detail-item">

                <span>
                    Data
                </span>

                <strong id="detailDate">
                    -
                </strong>

            </div>



            <div class="detail-item">

                <span>
                    Status
                </span>

                <strong id="detailStatus">
                    -
                </strong>

            </div>



            <div class="detail-item">

                <span>
                    Localização
                </span>

                <strong id="detailLocation">
                    -
                </strong>

            </div>



            <div class="detail-item">

                <span>
                    Contatos
                </span>

                <strong id="detailContacts">
                    -
                </strong>

            </div>


        </div>


        <button
            class="modal-close"
            onclick="closeDetails()"
        >
            Fechar
        </button>

    </div>

</div>



<!-- =========================================================
     MODAL CONFIRMAÇÃO
========================================================= -->

<div
    class="modal"
    id="clearModal"
    onclick="fecharClearFora(event)"
>

    <div
        class="modal-content confirm-modal"
        onclick="event.stopPropagation()"
    >

        <div class="confirm-icon">
            ⚠
        </div>


        <h2>
            Limpar histórico?
        </h2>


        <p>
            Todos os registros de alertas serão apagados
            deste dispositivo. Essa ação não poderá ser desfeita.
        </p>


        <div class="modal-buttons">

            <button
                class="cancel-button"
                onclick="closeClearModal()"
            >
                Cancelar
            </button>


            <button
                class="delete-button"
                onclick="clearHistory()"
            >
                Limpar histórico
            </button>

        </div>

    </div>

</div>



<!-- =========================================================
     TOAST
========================================================= -->

<div
    class="toast"
    id="toast"
>
    <span id="toastMessage"></span>
</div>



<script>

const HISTORY_KEY =
    "historicoAlertasSilentHelp";

let alertas = [];

let filtroAtual = "all";

let toastTimer = null;


/* =========================================================
   TOAST
========================================================= */

function showToast(mensagem) {

    const toast =
        document.getElementById("toast");

    const texto =
        document.getElementById("toastMessage");


    if (!toast || !texto) {
        return;
    }


    texto.textContent = mensagem;


    toast.classList.add("show");


    clearTimeout(toastTimer);


    toastTimer = setTimeout(() => {

        toast.classList.remove("show");

    }, 3000);
}


/* =========================================================
   ESCAPAR HTML
========================================================= */

function escapeHTML(valor) {

    if (
        valor === null ||
        valor === undefined
    ) {
        return "";
    }


    return String(valor)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}


/* =========================================================
   CARREGAR HISTÓRICO
========================================================= */

function carregarHistorico() {

    try {

        const dados =
            localStorage.getItem(
                HISTORY_KEY
            );


        if (!dados) {

            alertas = [];

            renderizarHistorico();

            return;
        }


        const historico =
            JSON.parse(dados);


        if (Array.isArray(historico)) {

            alertas = historico;

        } else {

            alertas = [];

        }

    } catch (erro) {

        console.error(
            "Erro ao carregar histórico:",
            erro
        );

        alertas = [];

        showToast(
            "Erro ao carregar histórico."
        );
    }


    renderizarHistorico();
}


/* =========================================================
   TIPO DO ALERTA
========================================================= */

function normalizarTipo(alerta) {

    const tipo = String(
        alerta?.tipo ||
        alerta?.type ||
        alerta?.categoria ||
        ""
    ).toLowerCase();


    if (
        tipo.includes("cancel")
    ) {
        return "cancelled";
    }


    if (
        tipo.includes("test") ||
        tipo.includes("check") ||
        tipo.includes("verific")
    ) {
        return "test";
    }


    if (
        tipo.includes("emerg") ||
        tipo.includes("sos") ||
        tipo.includes("alert")
    ) {
        return "emergency";
    }


    const titulo = String(
        alerta?.titulo ||
        alerta?.title ||
        ""
    ).toLowerCase();


    if (
        titulo.includes("teste") ||
        titulo.includes("verificação") ||
        titulo.includes("check-up") ||
        titulo.includes("checkup")
    ) {
        return "test";
    }


    if (
        titulo.includes("cancel")
    ) {
        return "cancelled";
    }


    return "emergency";
}


/* =========================================================
   STATUS
========================================================= */

function normalizarStatus(alerta) {

    const status = String(
        alerta?.status ||
        alerta?.situacao ||
        ""
    ).toLowerCase();


    if (
        status.includes("resolv") ||
        status.includes("conclu") ||
        status.includes("atend")
    ) {
        return "Resolvido";
    }


    if (
        status.includes("cancel")
    ) {
        return "Cancelado";
    }


    if (
        normalizarTipo(alerta) === "test"
    ) {
        return "Concluído";
    }


    return "Registrado";
}


/* =========================================================
   TÍTULO
========================================================= */

function obterTitulo(alerta) {

    if (alerta?.titulo) {
        return alerta.titulo;
    }


    if (alerta?.title) {
        return alerta.title;
    }


    if (alerta?.nome) {
        return alerta.nome;
    }


    const tipo =
        normalizarTipo(alerta);


    if (tipo === "test") {
        return "Verificação do dispositivo";
    }


    if (tipo === "cancelled") {
        return "Alerta cancelado";
    }


    return "Alerta de emergência";
}


/* =========================================================
   DATA
========================================================= */

function obterData(alerta) {

    return (
        alerta?.dataHora ||
        alerta?.data_hora ||
        alerta?.data ||
        alerta?.created_at ||
        alerta?.createdAt ||
        alerta?.timestamp ||
        ""
    );
}


function formatarData(valor) {

    if (!valor) {
        return "Data não informada";
    }


    const data =
        new Date(valor);


    if (
        isNaN(data.getTime())
    ) {
        return String(valor);
    }


    return data.toLocaleString(
        "pt-BR",
        {
            day: "2-digit",
            month: "2-digit",
            year: "numeric",
            hour: "2-digit",
            minute: "2-digit"
        }
    );
}


/* =========================================================
   LOCALIZAÇÃO
========================================================= */

function obterLocalizacao(alerta) {

    return (
        alerta?.localizacao ||
        alerta?.local ||
        alerta?.endereco ||
        alerta?.location ||
        "Localização não informada"
    );
}


/* =========================================================
   CONTATOS
========================================================= */

function obterContatos(alerta) {

    if (
        Array.isArray(alerta?.contatos)
    ) {

        return alerta.contatos
            .map(contato => {

                if (
                    typeof contato === "string"
                ) {
                    return contato;
                }


                return (
                    contato?.nome ||
                    contato?.telefone ||
                    "Contato"
                );

            })
            .join(", ");
    }


    return (
        alerta?.contatos ||
        alerta?.contato ||
        alerta?.responsavel ||
        "Não informado"
    );
}


/* =========================================================
   ÍCONE
========================================================= */

function obterIcone(alerta) {

    const tipo =
        normalizarTipo(alerta);


    if (tipo === "test") {
        return "📱";
    }


    if (tipo === "cancelled") {
        return "✕";
    }


    return "🆘";
}


/* =========================================================
   RENDERIZAR
========================================================= */

function renderizarHistorico() {

    const lista =
        document.getElementById(
            "alertList"
        );

    const vazio =
        document.getElementById(
            "emptyState"
        );


    if (!lista || !vazio) {
        return;
    }


    lista.innerHTML = "";


    let registros =
        [...alertas];


    if (
        filtroAtual !== "all"
    ) {

        registros =
            registros.filter(
                alerta =>
                    normalizarTipo(alerta)
                    === filtroAtual
            );
    }


    if (
        registros.length === 0
    ) {

        lista.style.display = "none";

        vazio.classList.add("show");

    } else {

        lista.style.display = "flex";

        vazio.classList.remove("show");


        registros.forEach(
            alerta => {

                lista.appendChild(
                    criarCard(alerta)
                );

            }
        );
    }


    atualizarResumo();
}


/* =========================================================
   CRIAR CARD
========================================================= */

function criarCard(alerta) {

    const card =
        document.createElement("article");


    const tipo =
        normalizarTipo(alerta);


    const titulo =
        obterTitulo(alerta);


    const data =
        formatarData(
            obterData(alerta)
        );


    const status =
        normalizarStatus(alerta);


    const localizacao =
        obterLocalizacao(alerta);


    const contatos =
        obterContatos(alerta);


    card.className =
        "alert-card";


    const classeIcone =
        tipo === "emergency"
            ? "emergency"
            : tipo === "test"
                ? "test"
                : "";


    const classeStatus =
        status === "Resolvido"
            ? "resolved"
            : status === "Cancelado"
                ? "cancelled"
                : "";


    card.innerHTML = `

        <div class="alert-icon ${classeIcone}">
            ${obterIcone(alerta)}
        </div>


        <div class="alert-info">

            <div class="alert-name">

                <h3>
                    ${escapeHTML(titulo)}
                </h3>

                <span class="alert-status ${classeStatus}">

                    <span class="alert-status-dot"></span>

                    ${escapeHTML(status)}

                </span>

            </div>


            <div class="alert-meta">

                <span>
                    📅
                    ${escapeHTML(data)}
                </span>

                <span class="meta-separator">
                    •
                </span>

                <span>
                    📍
                    ${escapeHTML(localizacao)}
                </span>

            </div>

        </div>


        <button
            class="alert-action"
            type="button"
            aria-label="Ver detalhes"
        >
            →
        </button>

    `;


    const botao =
        card.querySelector(
            ".alert-action"
        );


    botao.addEventListener(
        "click",
        function(event) {

            event.stopPropagation();

            openDetails(
                titulo,
                data,
                status,
                localizacao,
                contatos
            );
        }
    );


    card.addEventListener(
        "click",
        function() {

            openDetails(
                titulo,
                data,
                status,
                localizacao,
                contatos
            );
        }
    );


    return card;
}


/* =========================================================
   ATUALIZAR RESUMO
========================================================= */

function atualizarResumo() {

    const total =
        alertas.length;


    const emergencias =
        alertas.filter(
            alerta =>
                normalizarTipo(alerta)
                === "emergency"
        ).length;


    const resolvidos =
        alertas.filter(
            alerta => {

                const status =
                    normalizarStatus(
                        alerta
                    ).toLowerCase();


                return (
                    status.includes("resolv") ||
                    status.includes("conclu")
                );
            }
        ).length;


    document.getElementById(
        "totalAlerts"
    ).textContent = total;


    document.getElementById(
        "emergencyAlerts"
    ).textContent =
        emergencias;


    document.getElementById(
        "resolvedAlerts"
    ).textContent =
        resolvidos;


    document.getElementById(
        "historyCount"
    ).textContent =
        total === 1
            ? "1"
            : total;
}


/* =========================================================
   FILTROS
========================================================= */

function filterAlerts(
    tipo,
    botao
) {

    filtroAtual = tipo;


    document
        .querySelectorAll(
            ".filter-button"
        )
        .forEach(
            elemento => {

                elemento.classList.remove(
                    "active"
                );

            }
        );


    if (botao) {

        botao.classList.add(
            "active"
        );
    }


    renderizarHistorico();
}


/* =========================================================
   MODAL DETALHES
========================================================= */

function openDetails(
    titulo,
    data,
    status,
    localizacao,
    contatos
) {

    document.getElementById(
        "detailTitle"
    ).textContent =
        titulo || "-";


    document.getElementById(
        "detailDate"
    ).textContent =
        data || "-";


    document.getElementById(
        "detailStatus"
    ).textContent =
        status || "-";


    document.getElementById(
        "detailLocation"
    ).textContent =
        localizacao || "-";


    document.getElementById(
        "detailContacts"
    ).textContent =
        contatos || "-";


    document.getElementById(
        "detailsModal"
    ).classList.add("show");


    document.body.style.overflow =
        "hidden";
}


function closeDetails() {

    document.getElementById(
        "detailsModal"
    ).classList.remove("show");


    document.body.style.overflow =
        "";
}


function fecharModalFora(event) {

    if (
        event.target.id ===
        "detailsModal"
    ) {

        closeDetails();
    }
}


/* =========================================================
   MODAL LIMPAR
========================================================= */

function openClearModal() {

    if (
        alertas.length === 0
    ) {

        showToast(
            "Não há histórico para limpar."
        );

        return;
    }


    document.getElementById(
        "clearModal"
    ).classList.add("show");


    document.body.style.overflow =
        "hidden";
}


function closeClearModal() {

    document.getElementById(
        "clearModal"
    ).classList.remove("show");


    document.body.style.overflow =
        "";
}


function fecharClearFora(event) {

    if (
        event.target.id ===
        "clearModal"
    ) {

        closeClearModal();
    }
}


/* =========================================================
   LIMPAR HISTÓRICO
========================================================= */

function clearHistory() {

    localStorage.removeItem(
        HISTORY_KEY
    );


    alertas = [];


    filtroAtual = "all";


    document
        .querySelectorAll(
            ".filter-button"
        )
        .forEach(
            botao => {

                botao.classList.remove(
                    "active"
                );

            }
        );


    const primeiro =
        document.querySelector(
            ".filter-button"
        );


    if (primeiro) {

        primeiro.classList.add(
            "active"
        );
    }


    closeClearModal();


    renderizarHistorico();


    showToast(
        "Histórico apagado com sucesso."
    );
}


/* =========================================================
   NAVEGAÇÃO
========================================================= */

function goTo(pagina) {

    window.location.href =
        pagina;
}


/* =========================================================
   TECLA ESC
========================================================= */

document.addEventListener(
    "keydown",
    function(event) {

        if (
            event.key === "Escape"
        ) {

            closeDetails();

            closeClearModal();
        }

    }
);


/* =========================================================
   INICIAR
========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function() {

        carregarHistorico();

    }
);

</script>


<script src="assets/db-sync.js"></script>

</body>
</html>