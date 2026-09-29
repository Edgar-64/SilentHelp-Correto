<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
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


        .alert-meta svg {

            width: 14px;
            height: 14px;
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


        .alert-action svg {

            width: 19px;
            height: 19px;
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


        .empty-icon svg {

            width: 30px;
            height: 30px;
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


        .modal-icon svg {

            width: 27px;
            height: 27px;
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

            padding: 13px 14px;

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


        .confirm-icon svg {

            width: 29px;
            height: 29px;
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


            .summary-icon svg {

                width: 17px;
                height: 17px;
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


            .alert-icon svg {

                width: 23px;
                height: 23px;
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


            .alert-action svg {

                width: 17px;
                height: 17px;
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


    <!-- =====================================================
         APP
    ====================================================== -->

    <main class="app">


        <!-- =================================================
             HEADER
        ================================================== -->

        <header class="header">


            <!--
                AGORA O SILENTHELP É UM BOTÃO
                QUE VOLTA PARA index.php
            -->

            <button
                class="logo-button"
                onclick="goTo('index.php')"
                aria-label="Ir para página inicial"
            >

                <svg
                    class="logo-heart"
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


                <div class="logo-text">

                    <span class="silent">
                        Silent
                    </span>

                    <span class="help">
                        Help
                    </span>

                </div>

            </button>



            <!-- NOTIFICAÇÃO -->

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

        </header>



        <!-- =================================================
             TÍTULO
        ================================================== -->

        <section class="page-title">

            <h1>
                Histórico de <span>alertas</span>
            </h1>

            <p>
                Consulte os alertas registrados pelo seu dispositivo
                e acompanhe as atividades de segurança.
            </p>

        </section>



        <!-- =================================================
             RESUMO
        ================================================== -->

        <section class="summary-grid">


            <!-- TOTAL -->

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

                            <path
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                            />

                            <path
                                d="m9 12 2 2 4-4"
                            />

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



            <!-- EMERGÊNCIAS -->

            <div class="summary-card danger">

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

                    <strong
                        class="summary-number"
                        id="emergencyAlerts"
                    >
                        3
                    </strong>

                </div>

                <p>
                    Alertas de emergência
                </p>

            </div>



            <!-- RESOLVIDOS -->

            <div class="summary-card success">

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

                    <strong
                        class="summary-number"
                        id="resolvedAlerts"
                    >
                        7
                    </strong>

                </div>

                <p>
                    Alertas resolvidos
                </p>

            </div>

        </section>



        <!-- =================================================
             HISTÓRICO
        ================================================== -->

        <section class="history-section">


            <div class="history-header">

                <div class="history-title">

                    <h2>
                        Alertas registrados
                    </h2>

                    <span
                        class="history-count"
                        id="historyCount"
                    >
                        8
                    </span>

                </div>


                <button
                    class="clear-button"
                    onclick="openClearModal()"
                >
                    Limpar histórico
                </button>

            </div>



            <!-- FILTROS -->

            <div class="filters">

                <button
                    class="filter-button active"
                    data-filter="all"
                    onclick="filterAlerts('all', this)"
                >
                    Todos
                </button>


                <button
                    class="filter-button"
                    data-filter="emergency"
                    onclick="filterAlerts('emergency', this)"
                >
                    Emergência
                </button>


                <button
                    class="filter-button"
                    data-filter="test"
                    onclick="filterAlerts('test', this)"
                >
                    Testes
                </button>


                <button
                    class="filter-button"
                    data-filter="cancelled"
                    onclick="filterAlerts('cancelled', this)"
                >
                    Cancelados
                </button>

            </div>



            <!-- =================================================
                 LISTA DE ALERTAS
            ================================================== -->

            <div
                class="alert-list"
                id="alertList"
            >


                <!-- ALERTA 1 -->

                <article
                    class="alert-card"
                    data-type="emergency"
                >

                    <div class="alert-icon emergency">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Alerta de emergência
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Resolvido

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>

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

                                    <polyline
                                        points="12 7 12 12 15 14"
                                    />

                                </svg>

                                Hoje, 10:42

                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>

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

                                Localização registrada

                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Alerta de emergência',
                            'Hoje, 10:42',
                            'Resolvido',
                            'Localização registrada',
                            '3 contatos'
                        )"
                        aria-label="Ver detalhes"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 2 -->

                <article
                    class="alert-card"
                    data-type="test"
                >

                    <div class="alert-icon test">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Teste de segurança
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Concluído

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                Hoje, 08:15
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Teste manual
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Teste de segurança',
                            'Hoje, 08:15',
                            'Concluído',
                            'Teste manual',
                            'Nenhum contato acionado'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 3 -->

                <article
                    class="alert-card"
                    data-type="emergency"
                >

                    <div class="alert-icon emergency">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Alerta de emergência
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Resolvido

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                Ontem, 21:37
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Localização registrada
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Alerta de emergência',
                            'Ontem, 21:37',
                            'Resolvido',
                            'Localização registrada',
                            '3 contatos'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 4 -->

                <article
                    class="alert-card"
                    data-type="cancelled"
                >

                    <div class="alert-icon">

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

                            <path d="m9 9 6 6"/>

                            <path d="m15 9-6 6"/>

                        </svg>

                    </div>


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Alerta cancelado
                            </h3>

                            <span class="alert-status cancelled">

                                <span class="alert-status-dot"></span>

                                Cancelado

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                14/08/2026, 17:20
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Cancelado manualmente
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Alerta cancelado',
                            '14/08/2026, 17:20',
                            'Cancelado',
                            'Cancelado manualmente',
                            'Nenhum contato acionado'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 5 -->

                <article
                    class="alert-card"
                    data-type="test"
                >

                    <div class="alert-icon test">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Verificação do dispositivo
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Concluído

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                13/08/2026, 14:05
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Sistema funcionando
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Verificação do dispositivo',
                            '13/08/2026, 14:05',
                            'Concluído',
                            'Sistema funcionando',
                            'Nenhum contato acionado'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 6 -->

                <article
                    class="alert-card"
                    data-type="emergency"
                >

                    <div class="alert-icon emergency">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Alerta de emergência
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Resolvido

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                12/08/2026, 22:18
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                GPS ativado
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Alerta de emergência',
                            '12/08/2026, 22:18',
                            'Resolvido',
                            'GPS ativado',
                            '3 contatos'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 7 -->

                <article
                    class="alert-card"
                    data-type="test"
                >

                    <div class="alert-icon test">

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


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Teste de segurança
                            </h3>

                            <span class="alert-status resolved">

                                <span class="alert-status-dot"></span>

                                Concluído

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                10/08/2026, 09:30
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Teste automático
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Teste de segurança',
                            '10/08/2026, 09:30',
                            'Concluído',
                            'Teste automático',
                            'Nenhum contato acionado'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>



                <!-- ALERTA 8 -->

                <article
                    class="alert-card"
                    data-type="cancelled"
                >

                    <div class="alert-icon">

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

                            <path d="m9 9 6 6"/>

                            <path d="m15 9-6 6"/>

                        </svg>

                    </div>


                    <div class="alert-info">

                        <div class="alert-name">

                            <h3>
                                Alerta cancelado
                            </h3>

                            <span class="alert-status cancelled">

                                <span class="alert-status-dot"></span>

                                Cancelado

                            </span>

                        </div>


                        <div class="alert-meta">

                            <span>
                                08/08/2026, 18:45
                            </span>

                            <span class="meta-separator">
                                •
                            </span>

                            <span>
                                Cancelado pelo usuário
                            </span>

                        </div>

                    </div>


                    <button
                        class="alert-action"
                        onclick="openDetails(
                            'Alerta cancelado',
                            '08/08/2026, 18:45',
                            'Cancelado',
                            'Cancelado pelo usuário',
                            'Nenhum contato acionado'
                        )"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="m9 18 6-6-6-6"/>

                        </svg>

                    </button>

                </article>

            </div>



            <!-- =================================================
                 ESTADO VAZIO
            ================================================== -->

            <div
                class="empty-state"
                id="emptyState"
            >

                <div class="empty-icon">

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

                <h3>
                    Nenhum alerta encontrado
                </h3>

                <p>
                    Não existem alertas desse tipo no histórico.
                </p>

            </div>

        </section>

    </main>



    <!-- =====================================================
         MODAL DETALHES
    ====================================================== -->

    <div
        class="modal"
        id="detailsModal"
        onclick="closeModalOutside(event)"
    >

        <div class="modal-content">


            <div class="modal-top">

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
                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                        />

                        <path
                            d="m9 12 2 2 4-4"
                        />

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


                <div class="detail-item">

                    <span>
                        Data e horário
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
                        Registro
                    </span>

                    <strong id="detailLocation">
                        -
                    </strong>

                </div>


                <div class="detail-item">

                    <span>
                        Contatos acionados
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



    <!-- =====================================================
         MODAL LIMPAR
    ====================================================== -->

    <div
        class="modal"
        id="clearModal"
        onclick="closeClearOutside(event)"
    >

        <div class="modal-content confirm-modal">


            <div class="confirm-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <polyline
                        points="3 6 5 6 21 6"
                    />

                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"
                    />

                    <path
                        d="M10 11v6"
                    />

                    <path
                        d="M14 11v6"
                    />

                    <path
                        d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"
                    />

                </svg>

            </div>


            <h2>
                Limpar histórico?
            </h2>


            <p>
                Todos os alertas exibidos nesta página serão
                removidos do histórico local.
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



    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>



    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

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

            toastTimer = setTimeout(() => {

                toast.classList.remove("show");

            }, 2600);
        }



        /* =====================================================
           FILTROS
        ===================================================== */

        function filterAlerts(type, button) {

            const buttons =
                document.querySelectorAll(
                    ".filter-button"
                );

            buttons.forEach(btn => {

                btn.classList.remove("active");

            });

            button.classList.add("active");


            const cards =
                document.querySelectorAll(
                    ".alert-card"
                );

            let visible = 0;


            cards.forEach(card => {

                const cardType =
                    card.dataset.type;

                if (
                    type === "all" ||
                    cardType === type
                ) {

                    card.style.display = "flex";

                    visible++;

                } else {

                    card.style.display = "none";

                }

            });


            document.getElementById(
                "historyCount"
            ).textContent = visible;


            const empty =
                document.getElementById(
                    "emptyState"
                );


            if (visible === 0) {

                empty.classList.add("show");

            } else {

                empty.classList.remove("show");

            }

        }



        /* =====================================================
           MODAL DETALHES
        ===================================================== */

        function openDetails(
            title,
            date,
            status,
            location,
            contacts
        ) {

            document.getElementById(
                "detailTitle"
            ).textContent = title;

            document.getElementById(
                "detailDate"
            ).textContent = date;

            document.getElementById(
                "detailStatus"
            ).textContent = status;

            document.getElementById(
                "detailLocation"
            ).textContent = location;

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



        function closeModalOutside(event) {

            if (
                event.target.id ===
                "detailsModal"
            ) {

                closeDetails();

            }

        }



        /* =====================================================
           MODAL LIMPAR
        ===================================================== */

        function openClearModal() {

            document.getElementById(
                "clearModal"
            ).classList.add("show");

        }



        function closeClearModal() {

            document.getElementById(
                "clearModal"
            ).classList.remove("show");

        }



        function closeClearOutside(event) {

            if (
                event.target.id ===
                "clearModal"
            ) {

                closeClearModal();

            }

        }



        /* =====================================================
           LIMPAR HISTÓRICO
        ===================================================== */

        function clearHistory() {

            const cards =
                document.querySelectorAll(
                    ".alert-card"
                );


            cards.forEach(card => {

                card.remove();

            });


            document.getElementById(
                "totalAlerts"
            ).textContent = "0";


            document.getElementById(
                "emergencyAlerts"
            ).textContent = "0";


            document.getElementById(
                "resolvedAlerts"
            ).textContent = "0";


            document.getElementById(
                "historyCount"
            ).textContent = "0";


            document.getElementById(
                "emptyState"
            ).classList.add("show");


            closeClearModal();


            showToast(
                "Histórico de alertas limpo."
            );

        }



        /* =====================================================
           NAVEGAÇÃO DO SILENTHELP
        ===================================================== */

        function goTo(page) {

            window.location.href = page;

        }



        /* =====================================================
           ESC PARA FECHAR MODAIS
        ===================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (event.key === "Escape") {

                    closeDetails();

                    closeClearModal();

                }

            }
        );

    </script>

<script src="assets/db-sync.js"></script>
</body>

</html>