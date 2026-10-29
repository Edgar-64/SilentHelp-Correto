<?php
require_once __DIR__ . '/auth.php';

$usuario = exigirLogin();

if (($usuario['tipo'] ?? '') !== 'responsavel') {
    header('Location: inicio.php');
    exit;
}

$nomeResponsavel = $usuario['nome'] ?? 'Responsável';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SilentHelp - Responsável</title>

    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.css">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --roxo: #a65cff;
            --roxo-claro: #c58aff;
            --roxo-escuro: #6e32ad;
            --fundo: #050507;
            --card: #101015;
            --card-2: #15151c;
            --borda: #292933;
            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;
            --verde: #55df91;
            --vermelho: #ff5d73;
            --vermelho-escuro: #b82f48;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at 50% -10%, rgba(166, 92, 255, .15), transparent 35%), var(--fundo);
            color: var(--branco);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            overflow-x: hidden;
        }

        button {
            font-family: inherit;
        }

        button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        /* APP LAYOUT */
        .app {
            width: 100%;
            max-width: 1100px;
            margin: auto;
            padding: 25px 25px 120px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-heart {
            width: 48px;
            height: 48px;
            color: var(--roxo);
            filter: drop-shadow(0 0 10px rgba(166, 92, 255, .3));
        }

        .logo-text {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .logo-text .silent {
            color: var(--roxo);
        }

        .logo-text .help {
            color: white;
        }

        .responsible-badge {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 16px;
            border: 1px solid rgba(166, 92, 255, .35);
            border-radius: 20px;
            background: rgba(166, 92, 255, .09);
            color: var(--roxo-claro);
            font-size: 14px;
        }

        .responsible-badge span {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--verde);
            box-shadow: 0 0 8px rgba(85, 223, 145, .6);
        }

        /* TITULO */
        .page-title {
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-size: 34px;
            margin-bottom: 5px;
        }

        .page-title p {
            color: var(--cinza);
            font-size: 16px;
        }

        /* ALERTA */
        .alert-card {
            position: relative;
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 93, 115, .55);
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(255, 93, 115, .14), rgba(120, 20, 40, .08));
        }

        .alert-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: rgba(255, 93, 115, .16);
            color: var(--vermelho);
            font-size: 29px;
        }

        .alert-info {
            flex: 1;
        }

        .alert-info h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .alert-info p {
            color: var(--cinza);
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-time {
            color: var(--vermelho);
            font-size: 13px;
            font-weight: 600;
        }

        /* GRID & CARDS */
        .main-grid {
            display: grid;
            grid-template-columns: 1.35fr .65fr;
            gap: 20px;
            align-items: start;
        }

        .card {
            border: 1px solid var(--borda);
            border-radius: 25px;
            background: linear-gradient(145deg, #111116, #0b0b10);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 500;
        }

        .live {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--verde);
            font-size: 13px;
        }

        .live-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--verde);
            box-shadow: 0 0 9px rgba(85, 223, 145, .7);
        }

        /* MAPA */
        #map {
            width: 100%;
            height: 450px;
            background: #17171c;
        }

        .map-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 16px 20px;
        }

        .location-status {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--cinza);
            font-size: 14px;
        }

        .location-status strong {
            color: white;
            font-weight: 500;
        }

        .update-button {
            border: 1px solid rgba(166, 92, 255, .45);
            background: rgba(166, 92, 255, .09);
            color: var(--roxo-claro);
            padding: 11px 15px;
            border-radius: 13px;
            cursor: pointer;
            transition: .2s;
        }

        .update-button:hover {
            background: rgba(166, 92, 255, .17);
            border-color: var(--roxo);
        }

        /* PERFIL & INFO */
        .person-card {
            padding: 22px;
        }

        .person {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 22px;
        }

        .avatar {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--roxo), var(--roxo-escuro));
            font-size: 23px;
            font-weight: 600;
        }

        .person h3 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .person p {
            color: var(--cinza);
            font-size: 14px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px;
            border: 1px solid #25252d;
            border-radius: 15px;
            background: #0d0d12;
        }

        .info-row-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(166, 92, 255, .12);
            color: var(--roxo-claro);
            font-size: 18px;
        }

        .info-row-text {
            flex: 1;
        }

        .info-row-text small {
            display: block;
            color: var(--cinza-escuro);
            font-size: 11px;
            margin-bottom: 3px;
        }

        .info-row-text strong {
            font-size: 14px;
            font-weight: 500;
        }

        .coordinates {
            margin-top: 18px;
            padding: 15px;
            border-radius: 15px;
            background: rgba(166, 92, 255, .07);
            border: 1px solid rgba(166, 92, 255, .2);
        }

        .coordinates-title {
            color: var(--roxo-claro);
            font-size: 13px;
            margin-bottom: 8px;
        }

        .coordinates p {
            color: var(--cinza);
            font-size: 13px;
            line-height: 1.6;
        }

        .coordinates strong {
            color: white;
        }

        .attendance-card {
            margin-top: 20px;
            padding: 22px;
        }

        .attendance-card h2 {
            font-size: 20px;
            margin-bottom: 7px;
        }

        .attendance-card p {
            color: var(--cinza);
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 17px;
        }

        .attend-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            background: linear-gradient(90deg, #9b50e7, #a85cff);
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .attend-button:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
        }

        .finish-button {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            border: 1px solid rgba(85, 223, 145, .4);
            border-radius: 15px;
            background: rgba(85, 223, 145, .08);
            color: var(--verde);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .history {
            margin-top: 20px;
        }

        .history-subtitle {
            margin-top: 5px;
            color: var(--cinza);
            font-size: 12px;
        }

        .history-counter {
            padding: 6px 10px;
            border: 1px solid rgba(166, 92, 255, .25);
            border-radius: 20px;
            background: rgba(166, 92, 255, .10);
            color: var(--roxo-claro);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px;
        }

        .history-entry {
            padding: 15px;
            border: 1px solid var(--borda);
            border-radius: 15px;
            background: linear-gradient(145deg, #14141b, #0d0d12);
        }

        .history-entry-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .history-entry-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .history-entry-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 93, 115, .12);
            font-size: 19px;
        }

        .history-entry-title {
            font-size: 14px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .history-entry-date {
            display: block;
            margin-top: 5px;
            color: var(--cinza-escuro);
            font-size: 11px;
        }

        .history-status {
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .history-status.open {
            color: var(--vermelho);
            background: rgba(255, 93, 115, .12);
        }

        .history-status.attended {
            color: #55df91;
            background: rgba(85, 223, 145, .12);
            border: 1px solid rgba(85, 223, 145, .3);
        }

        .history-status.resolved {
            color: var(--verde);
            background: rgba(85, 223, 145, .12);
        }

        .history-status.other {
            color: var(--roxo-claro);
            background: rgba(166, 92, 255, .12);
        }

        .history-entry-message {
            margin: 14px 0 0;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, .06);
            color: var(--cinza);
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .history-empty {
            margin: 16px;
            padding: 28px 16px;
            border: 1px dashed var(--borda);
            border-radius: 15px;
            text-align: center;
        }

        .history-empty-icon {
            font-size: 27px;
        }

        .history-empty strong {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

        .history-empty p {
            margin-top: 6px;
            color: var(--cinza);
            font-size: 12px;
            line-height: 1.5;
        }

        @media (max-width: 550px) {
            .history-entry-top {
                flex-direction: column;
            }

            .history-entry-top>.history-status {
                margin-left: 50px;
            }
        }

        /* CHAT FLUTUANTE */
        .chat-float-button {
            position: fixed;
            right: 28px;
            bottom: 30px;
            width: 62px;
            height: 62px;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 50%;
            background: linear-gradient(145deg, #b96dff, #8f43d1);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1800;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .45), 0 0 30px rgba(168, 85, 247, .28);
            transition: .2s
        }

        .chat-float-button:hover {
            transform: translateY(-3px) scale(1.04)
        }

        .chat-float-button svg {
            width: 29px;
            height: 29px
        }

        .chat-unread {
            position: absolute;
            top: -2px;
            right: -1px;
            min-width: 21px;
            height: 21px;
            padding: 0 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--vermelho);
            color: #fff;
            border: 2px solid var(--fundo);
            font-size: 10px;
            font-weight: 800
        }

        .responsible-chat {
            position: fixed;
            right: 28px;
            bottom: 104px;
            width: min(380px, calc(100vw - 30px));
            height: min(560px, calc(100vh - 130px));
            min-height: 420px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(166, 92, 255, .34);
            border-radius: 25px;
            background: linear-gradient(145deg, rgba(29, 22, 38, .98), rgba(10, 9, 14, .98));
            box-shadow: 0 30px 90px rgba(0, 0, 0, .62), 0 0 35px rgba(168, 85, 247, .12);
            backdrop-filter: blur(22px);
            z-index: 1700;
            opacity: 0;
            visibility: hidden;
            transform: translateY(18px) scale(.96);
            pointer-events: none;
            transition: .22s
        }

        .responsible-chat.show {
            opacity: 1;
            visibility: visible;
            transform: none;
            pointer-events: auto
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 17px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            background: rgba(168, 85, 247, .055)
        }

        .chat-avatar {
            width: 43px;
            height: 43px;
            min-width: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(168, 85, 247, .28);
            border-radius: 14px;
            background: rgba(168, 85, 247, .12);
            color: var(--roxo-claro)
        }

        .chat-avatar svg {
            width: 24px;
            height: 24px
        }

        .chat-header-info {
            flex: 1
        }

        .chat-header-info strong {
            display: block;
            font-size: 15px;
            margin-bottom: 3px
        }

        .chat-online {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--verde);
            font-size: 11px
        }

        .chat-online-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--verde);
            box-shadow: 0 0 9px rgba(85, 223, 145, .65)
        }

        .chat-close {
            width: 35px;
            height: 35px;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 11px;
            background: rgba(255, 255, 255, .035);
            color: var(--cinza);
            cursor: pointer;
            font-size: 21px
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .chat-message {
            max-width: 82%;
            padding: 10px 12px;
            border-radius: 15px;
            font-size: 13px;
            line-height: 1.45;
            word-wrap: break-word
        }

        .chat-message.julia {
            align-self: flex-start;
            border: 1px solid rgba(255, 255, 255, .065);
            border-top-left-radius: 5px;
            background: rgba(255, 255, 255, .055);
            color: #eee
        }

        .chat-message.responsavel {
            align-self: flex-end;
            border: 1px solid rgba(168, 85, 247, .25);
            border-top-right-radius: 5px;
            background: linear-gradient(145deg, rgba(168, 85, 247, .25), rgba(112, 45, 181, .22));
            color: #fff
        }

        .chat-time {
            display: block;
            margin-top: 4px;
            color: var(--cinza-escuro);
            font-size: 9px;
            text-align: right
        }

        .chat-input-area {
            display: flex;
            gap: 8px;
            padding: 11px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            background: rgba(7, 6, 10, .55)
        }

        .chat-input {
            flex: 1;
            min-width: 0;
            height: 43px;
            padding: 0 13px;
            border: 1px solid rgba(255, 255, 255, .09);
            border-radius: 13px;
            outline: none;
            background: rgba(255, 255, 255, .045);
            color: #fff;
            font-size: 13px
        }

        .chat-input::placeholder {
            color: #777181
        }

        .chat-input:focus {
            border-color: rgba(168, 85, 247, .55)
        }

        .chat-send {
            width: 43px;
            height: 43px;
            min-width: 43px;
            border: 0;
            border-radius: 13px;
            background: linear-gradient(145deg, #b96dff, #8f43d1);
            color: #fff;
            cursor: pointer
        }

        .chat-send svg {
            width: 19px;
            height: 19px
        }

        /* TOAST & MODAIS */
        .toast {
            position: fixed;
            left: 50%;
            bottom: 30px;
            transform: translate(-50%, 30px);
            opacity: 0;
            pointer-events: none;
            z-index: 5000;
            padding: 14px 22px;
            border-radius: 14px;
            background: #19191f;
            border: 1px solid var(--roxo);
            color: white;
            transition: .3s;
            text-align: center;
            max-width: 90%;
        }

        .toast.show {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        .modal {
            position: fixed;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, .78);
            backdrop-filter: blur(7px);
            z-index: 4000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 420px;
            padding: 28px;
            border-radius: 24px;
            border: 1px solid var(--roxo);
            background: linear-gradient(145deg, #1b1622, #0c0c10);
            text-align: center;
        }

        .modal-icon {
            font-size: 45px;
            margin-bottom: 12px;
        }

        .modal-content h2 {
            margin-bottom: 9px;
        }

        .modal-content p {
            color: var(--cinza);
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
        }

        .modal-buttons button {
            flex: 1;
            padding: 13px;
            border-radius: 13px;
            cursor: pointer;
            font-weight: 600;
        }

        .cancel {
            border: 1px solid var(--borda);
            background: #17171c;
            color: white;
        }

        .confirm {
            border: none;
            background: var(--roxo);
            color: white;
        }

        .my-location-button {
            width: 100%;
            margin-top: 12px;
            padding: 13px;
            border: 1px solid rgba(85, 223, 145, .35);
            border-radius: 14px;
            background: rgba(85, 223, 145, .08);
            color: var(--verde);
            cursor: pointer;
            font-weight: 600;
        }

        /* MEDIA QUERIES */
        @media (max-width: 800px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            #map {
                height: 380px;
            }
        }

        @media (max-width: 700px) {
            .chat-float-button {
                right: 18px;
                bottom: 20px;
                width: 58px;
                height: 58px
            }

            .responsible-chat {
                right: 12px;
                bottom: 88px;
                width: calc(100vw - 24px);
                height: min(570px, calc(100vh - 105px));
                min-height: 400px;
                border-radius: 22px
            }
        }

        @media (max-width: 550px) {
            .app {
                padding: 18px 15px 100px;
            }

            .logo-text {
                font-size: 25px;
            }

            .logo-heart {
                width: 40px;
                height: 40px;
            }

            .responsible-badge {
                padding: 9px 11px;
                font-size: 12px;
            }

            .page-title h1 {
                font-size: 27px;
            }

            .alert-card {
                align-items: flex-start;
            }

            .alert-time {
                display: none;
            }

            #map {
                height: 330px;
            }

            .map-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .update-button {
                width: 100%;
            }
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

    <main class="app">
        <!-- HEADER -->
        <header class="header">
            <div class="logo">
                <?php include 'components/logo.php'; ?>
            </div>
            <div class="responsible-badge">
                <span></span> Modo Responsável

            </div>
        </header>

        <!-- TITULO -->
        <section class="page-title">
            <h1>Central de Segurança</h1>
            <p>Acompanhe a pessoa que pediu ajuda em tempo real.</p>
        </section>

        <!-- ALERTA -->
        <section class="alert-card">
            <div class="alert-icon">🚨</div>
            <div class="alert-info">
                <h2 id="alertTitle">Alerta de emergência recebido</h2>
                <p id="alertDescription">Aguardando informações do próximo alerta.</p>
            </div>
            <div class="alert-time" id="alertTime">Aguardando</div>
        </section>

        <!-- GRID PRINCIPAL -->
        <div class="main-grid">

            <!-- CARD DO MAPA -->
            <section class="card">
                <div class="card-header">
                    <h2>📍 Localização da pessoa</h2>
                    <div class="live">
                        <span class="live-dot"></span>
                        <span id="liveText">AO VIVO</span>
                    </div>
                </div>

                <div id="map"></div>

                <div class="map-footer">
                    <div class="location-status">
                        <span>📍</span>
                        <div>Localização atual: <strong id="locationText">Atualizada agora</strong></div>
                    </div>
                    <button class="update-button" onclick="atualizarLocalizacao()">🔄 Atualizar localização</button>
                </div>
            </section>

            <!-- CARD DE DADOS -->
            <div>
                <section class="card person-card">
                    <div class="person">
                        <div class="avatar" id="personAvatar">P</div>
                        <div>
                            <h3 id="personName">Pessoa protegida</h3>
                            <p>Pessoa protegida</p>
                        </div>
                    </div>

                    <!-- INFORMAÇÕES -->
                    <div class="info-list">
                        <div class="info-row">
                            <div class="info-row-icon">📱</div>
                            <div class="info-row-text">
                                <small>DISPOSITIVO</small>
                                <strong id="deviceStatus">Aguardando alerta</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">🔋</div>
                            <div class="info-row-text">
                                <small>BATERIA</small>
                                <strong id="batteryStatus">--</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">📡</div>
                            <div class="info-row-text">
                                <small>CONEXÃO</small>
                                <strong id="connectionStatus">Aguardando</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">📍</div>
                            <div class="info-row-text">
                                <small>GPS</small>
                                <strong id="gpsStatus">Aguardando localização</strong>
                            </div>
                        </div>
                    </div>

                    <!-- COORDENADAS -->
                    <div class="coordinates">
                        <div class="coordinates-title">📍 Coordenadas atuais</div>
                        <p>
                            Latitude: <strong id="latitude">--</strong><br>
                            Longitude: <strong id="longitude">--</strong>
                        </p>
                    </div>

                    <button class="my-location-button" onclick="minhaLocalizacao()">📍 Ver minha localização no
                        mapa</button>
                </section>

                <!-- CARD DE ATENDIMENTO -->
                <section class="card attendance-card">
                    <h2>Atendimento</h2>
                    <p id="attendanceText">Quando um alerta estiver ativo, você poderá confirmar o acompanhamento por
                        aqui.</p>

                    <button class="attend-button" id="attendButton" onclick="confirmarAtendimento()">✓ &nbsp; Estou
                        acompanhando</button>
                    <button class="finish-button" onclick="abrirFinalizacao()">Encerrar atendimento</button>
                </section>
            </div>

        </div>

        <!-- HISTÓRICO DOS 5 ALERTAS MAIS RECENTES -->
        <section class="card history">
            <div class="card-header">
                <div>
                    <h2>Histórico de alertas</h2>
                    <p class="history-subtitle">Os 5 registros mais recentes do banco de dados</p>
                </div>
                <span class="history-counter" id="historyCounter">0 alertas</span>
            </div>

            <div id="alertHistory" class="history-list">
                <div class="history-empty">
                    <div class="history-empty-icon">⏳</div>
                    <strong>Carregando histórico...</strong>
                    <p>Buscando os alertas registrados no sistema.</p>
                </div>
            </div>
        </section>
        <button class="logout-button" onclick="sairConta()">
            Sair da conta
        </button>
    </main>

    <!-- MODAIS -->
    <div id="finishModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">✅</div>
            <h2>Encerrar atendimento?</h2>
            <p>Confirme somente se a situação estiver resolvida e não for mais necessário acompanhar a localização.</p>
            <div class="modal-buttons">
                <button class="cancel" onclick="fecharFinalizacao()">Cancelar</button>
                <button class="confirm" onclick="finalizarAtendimento()">Encerrar</button>
            </div>
        </div>
    </div>

    <!-- CHAT FLUTUANTE -->
    <button type="button" class="chat-float-button" id="chatFloatButton" onclick="alternarChatJulia()"
        aria-label="Abrir conversa" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path
                d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8.5 8.5 0 0 1-3.6-.8L4 20l1.2-3.7A7.4 7.4 0 0 1 4 11.5 7.5 7.5 0 0 1 12 4a7.5 7.5 0 0 1 8 7.5z" />
            <path d="M8.5 12h.01M12 12h.01M15.5 12h.01" />
        </svg>
        <span class="chat-unread" id="chatUnread">1</span>
    </button>

    <section class="responsible-chat" id="juliaChat" aria-hidden="true" aria-label="Conversa com pessoa protegida">
        <header class="chat-header">
            <div class="chat-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="8" r="3.5" />
                    <path d="M5 20c0-4 3-6 7-6s7 2 7 6" />
                </svg>
            </div>
            <div class="chat-header-info">
                <strong id="chatContactName">Pessoa protegida</strong>
                <span class="chat-online">
                    <span class="chat-online-dot"></span>
                    Conversa ativa
                </span>
            </div>
            <button type="button" class="chat-close" onclick="fecharChatJulia()" aria-label="Fechar conversa">×</button>
        </header>
        <div class="chat-messages" id="juliaChatMessages" aria-live="polite"></div>
        <form class="chat-input-area" onsubmit="enviarChatJulia(event)">
            <input type="text" class="chat-input" id="juliaChatInput" placeholder="Digite uma mensagem..."
                autocomplete="off" maxlength="500">
            <button type="submit" class="chat-send" aria-label="Enviar mensagem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M22 2L11 13" />
                    <path d="M22 2l-7 20-4-9-9-4z" />
                </svg>
            </button>
        </form>
    </section>

    <!-- TOAST DE NOTIFICAÇÕES -->
    <div id="toast" class="toast"></div>
    <!-- MAPLIBRE GL + adaptador de compatibilidade -->
    <script src="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.js"></script>
    <script>
        /* Adaptador de compatibilidade: preserva as chamadas do mapa existentes
           enquanto a renderização é feita pelo MapLibre GL. */
        (function () {
            let circleCounter = 0;

            function makeMap(container, options = {}) {
                const native = new maplibregl.Map({
                    container,
                    style: "https://tiles.openfreemap.org/styles/liberty",
                    center: [-45.5553, -23.0266],
                    zoom: 13,
                    attributionControl: options.attributionControl !== false
                });
                native.addControl(new maplibregl.NavigationControl({ showCompass: false }), "bottom-right");
                const wrapper = {
                    _native: native,
                    setView(coords, zoom) {
                        native.flyTo({ center: [coords[1], coords[0]], zoom: zoom || native.getZoom(), essential: true });
                        return wrapper;
                    },
                    removeLayer(item) {
                        if (item && typeof item._remove === "function") item._remove();
                        return wrapper;
                    },
                    hasLayer(item) { return !!item && item._visible === true; },
                    invalidateSize() { native.resize(); return wrapper; },
                    flyTo(options) {
                        const opts = { ...options };
                        if (Array.isArray(opts.center)) opts.center = [opts.center[1], opts.center[0]];
                        native.flyTo(opts);
                        return wrapper;
                    },
                    on(event, callback) { native.on(event, callback); return wrapper; }
                };
                return wrapper;
            }

            function makeMarker(coords, options = {}) {
                const iconOptions = options.icon && options.icon.options ? options.icon.options : {};
                const el = document.createElement("div");
                if (iconOptions.html != null) {
                    el.className = iconOptions.className || "";
                    el.innerHTML = iconOptions.html;
                    if (iconOptions.iconSize) {
                        el.style.width = iconOptions.iconSize[0] + "px";
                        el.style.height = iconOptions.iconSize[1] + "px";
                    }
                } else {
                    el.className = "sh-map-marker";
                }
                const marker = {
                    _visible: false, _nativeMarker: null, _popup: null, _map: null,
                    _coords: coords,
                    addTo(map) {
                        this._map = map;
                        this._nativeMarker = new maplibregl.Marker({ element: el, anchor: "center" })
                            .setLngLat([this._coords[1], this._coords[0]]).addTo(map._native);
                        if (this._popup) this._nativeMarker.setPopup(this._popup);
                        this._visible = true;
                        return this;
                    },
                    setLatLng(next) {
                        this._coords = next;
                        if (this._nativeMarker) this._nativeMarker.setLngLat([next[1], next[0]]);
                        return this;
                    },
                    bindPopup(html) {
                        this._popup = new maplibregl.Popup({ offset: 24, maxWidth: "280px" }).setHTML(html);
                        if (this._nativeMarker) this._nativeMarker.setPopup(this._popup);
                        return this;
                    },
                    remove() { this._remove(); return this; },
                    _remove() {
                        if (this._nativeMarker) this._nativeMarker.remove();
                        this._nativeMarker = null;
                        this._visible = false;
                    }
                };
                return marker;
            }

            function circleFeature(coords, radius) {
                const lat = coords[0], lng = coords[1], points = [];
                for (let i = 0; i <= 64; i++) {
                    const angle = (i / 64) * Math.PI * 2;
                    const dLat = (radius / 111320) * Math.cos(angle);
                    const dLng = (radius / (111320 * Math.max(0.01, Math.cos(lat * Math.PI / 180)))) * Math.sin(angle);
                    points.push([lng + dLng, lat + dLat]);
                }
                return { type: "Feature", properties: {}, geometry: { type: "Polygon", coordinates: [points] } };
            }

            function makeCircle(coords, options = {}) {
                const id = "sh-responsavel-circle-" + (++circleCounter);
                const radius = Math.max(10, Number(options.radius) || 100);
                const circle = {
                    _visible: false, _map: null, _coords: coords,
                    addTo(map) {
                        this._map = map;
                        const add = () => {
                            const native = map._native;
                            if (!native.getSource(id)) {
                                native.addSource(id, { type: "geojson", data: circleFeature(this._coords, radius) });
                                native.addLayer({
                                    id: id + "-fill", type: "fill", source: id,
                                    paint: { "fill-color": options.fillColor || options.color || "#a65cff", "fill-opacity": options.fillOpacity ?? 0.08 }
                                });
                                native.addLayer({
                                    id: id + "-line", type: "line", source: id,
                                    paint: { "line-color": options.color || "#a65cff", "line-width": options.weight || 1 }
                                });
                            }
                            this._visible = true;
                        };
                        if (map._native.isStyleLoaded()) add(); else map._native.once("load", add);
                        return this;
                    },
                    setLatLng(next) {
                        this._coords = next;
                        const native = this._map && this._map._native;
                        const source = native && native.getSource(id);
                        if (source) source.setData(circleFeature(next, radius));
                        return this;
                    },
                    remove() { this._remove(); return this; },
                    _remove() {
                        const native = this._map && this._map._native;
                        if (native && native.isStyleLoaded()) {
                            [id + "-line", id + "-fill"].forEach(layer => { if (native.getLayer(layer)) native.removeLayer(layer); });
                            if (native.getSource(id)) native.removeSource(id);
                        }
                        this._visible = false;
                    }
                };
                return circle;
            }

            window.L = {
                map: makeMap,
                tileLayer: function () { return { addTo: function () { return this; } }; },
                divIcon: function (options) { return { options }; },
                marker: makeMarker,
                circle: makeCircle
            };
        })();
    </script>

    <script>
        const RESPONSAVEL_ID = <?= (int) ($usuario['id'] ?? 0) ?>;
        const RESPONSAVEL_NOME = <?= json_encode($nomeResponsavel, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

        let latitude = null;
        let longitude = null;
        let alertaAtual = null;
        let atendimentoConfirmado = false;
        const alertasNotificadosNestaPagina = new Set();

        function formatarTempo(timestamp) {
            if (!timestamp) return "Sem horário";
            const data = new Date(Number(timestamp));
            if (Number.isNaN(data.getTime())) return "Sem horário";

            const diff = Math.max(0, Date.now() - data.getTime());
            const minutos = Math.floor(diff / 60000);

            if (minutos < 1) return "Agora";
            if (minutos === 1) return "Há 1 min";
            if (minutos < 60) return `Há ${minutos} min`;

            const horas = Math.floor(minutos / 60);
            if (horas === 1) return "Há 1 hora";
            if (horas < 24) return `Há ${horas} horas`;

            return data.toLocaleDateString("pt-BR");
        }

        function escaparHTML(texto) {
            return String(texto ?? "")
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function aplicarDadosDoAlerta() {
            const nome =
                alertaAtual?.usuario_nome ||
                alertaAtual?.nome_usuario ||
                alertaAtual?.usuario ||
                "Pessoa protegida";

            document.getElementById("personName").textContent = nome;
            document.getElementById("personAvatar").textContent =
                nome.trim().charAt(0).toUpperCase() || "P";

            const status = String(alertaAtual?.status || "").toLowerCase();
            const ativo = ["open", "aberto", "aberta", "attended", "atendido", "atendida", "enviado", "recebido", "em_atendimento"].includes(status);

            if (!alertaAtual) {
                document.getElementById("alertTitle").textContent = "Nenhum alerta ativo";
                document.getElementById("alertDescription").textContent =
                    "Quando uma pessoa protegida enviar um alerta, as informações aparecerão aqui.";
                document.getElementById("alertTime").textContent = "Aguardando";
                document.getElementById("liveText").textContent = "AGUARDANDO";
                document.getElementById("deviceStatus").textContent = "Aguardando alerta";
                document.getElementById("connectionStatus").textContent = "Aguardando";
                document.getElementById("gpsStatus").textContent = "Aguardando localização";
                document.getElementById("latitude").textContent = "--";
                document.getElementById("longitude").textContent = "--";
                return;
            }

            document.getElementById("alertTitle").textContent =
                ativo ? "Alerta de emergência recebido" : "Alerta encerrado";

            const detalheAlerta = String(alertaAtual.mensagem || alertaAtual.message || alertaAtual.tipo || "Alerta de emergência");
            document.getElementById("alertDescription").textContent = ativo
                ? `${nome}: ${detalheAlerta}`
                : `${nome} teve um alerta registrado: ${detalheAlerta}`;

            document.getElementById("alertTime").textContent =
                formatarTempo(alertaAtual.timestamp);

            document.getElementById("deviceStatus").textContent = "Conectado";
            document.getElementById("connectionStatus").textContent = "Conectado";
            document.getElementById("gpsStatus").textContent =
                alertaAtual.localizacao === "Compartilhada"
                    ? "Funcionando"
                    : "Não compartilhado";

            const lat = Number(alertaAtual.latitude);
            const lng = Number(alertaAtual.longitude);

            if (Number.isFinite(lat) && Number.isFinite(lng)) {
                latitude = lat;
                longitude = lng;
                atualizarMapa(latitude, longitude);
            } else {
                document.getElementById("latitude").textContent = "--";
                document.getElementById("longitude").textContent = "--";
            }

            document.getElementById("liveText").textContent =
                ativo ? "AO VIVO" : "ENCERRADO";

            document.getElementById("liveText").style.color =
                ativo ? "#55df91" : "#aaaab3";

            if (!ativo) {
                document.querySelector(".alert-card").style.borderColor =
                    "rgba(85,223,145,.4)";
                document.querySelector(".alert-card").style.background =
                    "rgba(85,223,145,.08)";
            }
        }

        function atualizarHistorico(alertas) {
            const container = document.getElementById("alertHistory");
            const contador = document.getElementById("historyCounter");
            if (!container) return;

            const lista = Array.isArray(alertas) ? alertas.slice(0, 5) : [];

            if (contador) {
                contador.textContent = `${lista.length} ${lista.length === 1 ? "alerta" : "alertas"}`;
            }

            if (lista.length === 0) {
                container.innerHTML = `
                    <div class="history-empty">
                        <div class="history-empty-icon">ℹ️</div>
                        <strong>Nenhum alerta encontrado</strong>
                        <p>Os alertas registrados aparecerão aqui quando existirem.</p>
                    </div>`;
                return;
            }

            const escapar = valor => escaparHTML(String(valor ?? ""));

            container.innerHTML = lista.map(alerta => {
                const tipoOriginal = String(alerta.tipo ?? alerta.type ?? "Alerta");
                const tipo = tipoOriginal.replaceAll("_", " ");
                const statusOriginal = String(alerta.status ?? "open").toLowerCase();

                let statusClasse = "other";
                let statusTexto = statusOriginal.replaceAll("_", " ") || "Não informado";

                if (["open", "aberto", "aberta", "pending", "pendente"].includes(statusOriginal)) {
                    statusClasse = "open";
                    statusTexto = "Aberto";
                } else if (["attended", "atendido", "atendida", "em_atendimento"].includes(statusOriginal)) {
                    statusClasse = "attended";
                    statusTexto = "Atendido";
                } else if (["resolved", "resolvido", "resolvida", "closed", "fechado", "fechada", "encerrado", "encerrada"].includes(statusOriginal)) {
                    statusClasse = "resolved";
                    statusTexto = "Resolvido";
                }

                let dataFormatada = "Data não informada";
                const valorData = alerta.created_at ?? alerta.data ?? alerta.timestamp;
                if (valorData) {
                    let data;
                    if (typeof valorData === "number" || /^\d{10,13}$/.test(String(valorData))) {
                        const numero = Number(valorData);
                        data = new Date(String(valorData).length <= 10 ? numero * 1000 : numero);
                    } else {
                        data = new Date(String(valorData).replace(" ", "T"));
                    }
                    if (!Number.isNaN(data.getTime())) {
                        dataFormatada = data.toLocaleString("pt-BR", {
                            day: "2-digit", month: "2-digit", year: "numeric",
                            hour: "2-digit", minute: "2-digit"
                        });
                    } else {
                        dataFormatada = String(valorData);
                    }
                }

                const mensagem = alerta.message ?? alerta.mensagem ?? "Sem mensagem registrada.";
                const icone = /emerg[eê]ncia|sos/i.test(tipo) ? "🚨" : "🔔";

                return `
                    <article class="history-entry">
                        <div class="history-entry-top">
                            <div class="history-entry-heading">
                                <div class="history-entry-icon">${icone}</div>
                                <div>
                                    <div class="history-entry-title">${escapar(tipo)}</div>
                                    <time class="history-entry-date">${escapar(dataFormatada)}</time>
                                </div>
                            </div>
                            <span class="history-status ${statusClasse}">${escapar(statusTexto)}</span>
                        </div>
                        <p class="history-entry-message">${escapar(mensagem)}</p>
                    </article>`;
            }).join("");
        }

        async function carregarHistoricoAlertas() {
            const container = document.getElementById("alertHistory");
            if (!container) return;

            try {
                const resposta = await fetch("api.php?action=responsible_alert_history", {
                    method: "GET",
                    credentials: "same-origin",
                    cache: "no-store",
                    headers: { "Accept": "application/json" }
                });

                const dados = await resposta.json();
                if (!resposta.ok || !dados.ok) {
                    throw new Error(dados.message || "Não foi possível carregar o histórico.");
                }

                atualizarHistorico(Array.isArray(dados.alertas) ? dados.alertas : []);
            } catch (erro) {
                console.error("Erro ao carregar histórico de alertas:", erro);
                container.innerHTML = `
                    <div class="history-empty">
                        <div class="history-empty-icon">⚠️</div>
                        <strong>Não foi possível carregar o histórico</strong>
                        <p>Verifique a conexão e se a API de histórico está configurada.</p>
                    </div>`;
                const contador = document.getElementById("historyCounter");
                if (contador) contador.textContent = "Indisponível";
            }
        }

        /* MAPA */
        const mapaInicial = [-23.0266, -45.5553];

        const map = L.map("map").setView(mapaInicial, 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap"
        }).addTo(map);

        const heartIcon = L.divIcon({
            className: "",
            html: `
                <div style="width:70px;height:70px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(166,92,255,.18);border:2px solid #c58aff;box-shadow:0 0 25px rgba(166,92,255,.5);">
                    <div style="width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#a65cff;color:white;font-size:23px;box-shadow:0 0 18px rgba(166,92,255,.7);">♥️</div>
                </div>`,
            iconSize: [70, 70],
            iconAnchor: [35, 35]
        });

        let personMarker = L.marker(mapaInicial, { icon: heartIcon }).addTo(map);
        let accuracyCircle = L.circle(mapaInicial, {
            radius: 120,
            color: "#a65cff",
            fillColor: "#a65cff",
            fillOpacity: .08,
            weight: 1
        }).addTo(map);

        function atualizarMapa(lat, lng) {
            personMarker.setLatLng([lat, lng]);
            accuracyCircle.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            document.getElementById("latitude").textContent = Number(lat).toFixed(6);
            document.getElementById("longitude").textContent = Number(lng).toFixed(6);
            document.getElementById("locationText").textContent = "Atualizada agora";

            const nome =
                document.getElementById("personName")?.textContent ||
                "Pessoa protegida";

            personMarker.bindPopup(
                `<strong>${escaparHTML(nome)}</strong><br>Pessoa protegida<br><small>Localização compartilhada</small>`
            );
        }

        function atualizarLocalizacao() {
            const botao = document.querySelector(".update-button");

            if (!alertaAtual) {
                mostrarMensagem("Não há um alerta para atualizar.");
                return;
            }

            const lat = Number(alertaAtual.latitude);
            const lng = Number(alertaAtual.longitude);

            if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                mostrarMensagem("Este alerta não possui coordenadas.");
                return;
            }

            botao.disabled = true;
            botao.innerHTML = "⏳ Atualizando...";

            setTimeout(() => {
                atualizarMapa(lat, lng);
                botao.innerHTML = "✓ Localização atualizada";
                mostrarMensagem("Localização do alerta atualizada.");

                setTimeout(() => {
                    botao.innerHTML = "🔄 Atualizar localização";
                    botao.disabled = false;
                }, 1500);
            }, 400);
        }

        function minhaLocalizacao() {
            if (!navigator.geolocation) {
                mostrarMensagem("Seu navegador não suporta localização.");
                return;
            }

            mostrarMensagem("Obtendo sua localização...");

            navigator.geolocation.getCurrentPosition(
                position => {
                    const minhaLat = position.coords.latitude;
                    const minhaLng = position.coords.longitude;

                    if (window.myMarker) {
                        window.myMarker.remove();
                    }

                    window.myMarker = L.marker([minhaLat, minhaLng])
                        .addTo(map)
                        .bindPopup("<strong>Você</strong><br>Localização do responsável.")
                        .openPopup();

                    map.setView([minhaLat, minhaLng], 15);
                    mostrarMensagem("Sua localização foi encontrada.");
                },
                error => {
                    let mensagem = "Não foi possível obter sua localização.";
                    if (error.code === 1) {
                        mensagem = "Permita o acesso à localização no navegador.";
                    }
                    mostrarMensagem(mensagem);
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }

        /* ATENDIMENTO */
        async function confirmarAtendimento() {
            if (!alertaAtual) {
                mostrarMensagem("Não há alerta ativo para acompanhar.");
                return;
            }

            const botao = document.getElementById("attendButton");
            if (botao.disabled) return;

            const textoOriginal = botao.innerHTML;
            botao.disabled = true;
            botao.innerHTML = "⏳ Registrando atendimento...";

            try {
                const resposta = await fetch("api.php?action=attend_alert", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id: Number(alertaAtual.id) })
                });

                const dados = await resposta.json();
                if (!resposta.ok || !dados.ok) {
                    throw new Error(dados.message || "Não foi possível registrar o atendimento.");
                }

                alertaAtual.status = "attended";
                atendimentoConfirmado = true;

                const nome = document.getElementById("personName").textContent || "a pessoa protegida";
                document.getElementById("attendanceText").textContent =
                    `Você está acompanhando ${nome}. O alerta foi marcado como atendido no sistema.`;

                botao.innerHTML = "✓ Atendimento registrado";
                botao.style.background = "rgba(85,223,145,.12)";
                botao.style.color = "#55df91";
                botao.style.border = "1px solid rgba(85,223,145,.4)";

                mostrarMensagem("Atendimento registrado no banco de dados.");
                if (typeof carregarHistoricoAlertas === "function") {
                    carregarHistoricoAlertas();
                }
            } catch (erro) {
                botao.disabled = false;
                botao.innerHTML = textoOriginal;
                mostrarMensagem(erro.message || "Erro ao registrar atendimento.");
            }
        }

        function atendimentoDoAlertaConfirmado(idAlerta) {
            if (!alertaAtual || Number(alertaAtual.id) !== Number(idAlerta)) return false;
            const status = String(alertaAtual.status || "").trim().toLowerCase();
            return ["attended", "atendido", "atendida", "em_atendimento"].includes(status)
                || atendimentoConfirmado;
        }

        function abrirFinalizacao() {
            if (!alertaAtual || !Number(alertaAtual.id)) {
                mostrarMensagem("Não há alerta para encerrar.");
                return;
            }
            if (!atendimentoDoAlertaConfirmado(alertaAtual.id)) {
                mostrarMensagem("Clique em ‘Estou acompanhando’ antes de encerrar o atendimento.");
                return;
            }
            document.getElementById("finishModal")?.classList.add("show");
        }

        function fecharFinalizacao() {
            document.getElementById("finishModal")?.classList.remove("show");
        }

        async function finalizarAtendimento() {
            if (!alertaAtual?.id) {
                mostrarMensagem("Não há alerta para encerrar.");
                return;
            }
            const botao = document.querySelector("#finishModal .confirm");
            if (botao) { botao.disabled = true; botao.textContent = "Encerrando..."; }
            try {
                const resposta = await fetch("api.php?action=resolve_alert", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: { "Content-Type": "application/json", "Accept": "application/json" },
                    body: JSON.stringify({ id: Number(alertaAtual.id) })
                });
                const dados = await resposta.json();
                if (!resposta.ok || !dados.ok) throw new Error(dados.message || "Não foi possível encerrar o atendimento.");
                alertaAtual.status = "resolved";
                atendimentoConfirmado = false;
                aplicarDadosDoAlerta();
                fecharFinalizacao();
                mostrarMensagem("Atendimento encerrado e salvo no banco de dados.");
                await carregarHistoricoAlertas();
                await carregarAlertaSOS();
            } catch (erro) {
                mostrarMensagem(erro.message || "Erro ao encerrar atendimento.");
            } finally {
                if (botao) { botao.disabled = false; botao.textContent = "Encerrar"; }
            }
        }

        /* TOAST */
        let toastTimeout;

        function mostrarMensagem(mensagem) {
            const toast = document.getElementById("toast");
            toast.textContent = mensagem;
            toast.classList.add("show");

            clearTimeout(toastTimeout);

            toastTimeout = setTimeout(() => {
                toast.classList.remove("show");
            }, 3000);
        }

        /* =====================================================
   CHAT REAL COM USUÁRIO PROTEGIDO
===================================================== */

        let chatDados = null;


        /* =====================================================
           FORMATAR HORÁRIO
        ===================================================== */

        function chatHora(data) {

            if (!data) {
                return "";
            }

            const dataObj = new Date(
                data.replace(" ", "T")
            );


            if (isNaN(dataObj.getTime())) {
                return "";
            }


            return dataObj.toLocaleTimeString(
                "pt-BR",
                {
                    hour: "2-digit",
                    minute: "2-digit"
                }
            );
        }


        /* =====================================================
           CARREGAR CHAT
        ===================================================== */

        async function carregarChat() {

            try {

                const resposta = await fetch(
                    "api.php?action=chat&mode=get",
                    {
                        method: "GET",
                        credentials: "same-origin"
                    }
                );


                const dados =
                    await resposta.json();


                if (!dados.ok) {

                    console.warn(
                        "Chat:",
                        dados.message
                    );

                    return;
                }


                chatDados = dados;


                /*
                 * Atualiza nome da pessoa no cabeçalho
                 * se existir o elemento.
                 */

                const nomeContato =
                    document.getElementById(
                        "chatContactName"
                    );


                if (
                    nomeContato &&
                    dados.contato
                ) {

                    nomeContato.textContent =
                        dados.contato.nome;
                }


                renderizarChat();


            } catch (erro) {

                console.error(
                    "Erro ao carregar chat:",
                    erro
                );
            }
        }


        /* =====================================================
           RENDERIZAR
        ===================================================== */

        function renderizarChat() {

            const container =
                document.getElementById(
                    "juliaChatMessages"
                );


            if (!container || !chatDados) {
                return;
            }


            container.innerHTML = "";


            if (
                !chatDados.messages ||
                chatDados.messages.length === 0
            ) {

                container.innerHTML = `
            <div class="chat-empty">
                <span>💜</span>
                <p>
                    Nenhuma mensagem ainda.
                </p>
            </div>
        `;

                return;
            }


            chatDados.messages.forEach(
                function (mensagem) {

                    const bolha =
                        document.createElement(
                            "div"
                        );


                    const minhaMensagem =
                        Number(
                            mensagem.sender_id
                        ) ===
                        Number(
                            chatDados.usuario_id
                        );


                    bolha.className =
                        "chat-message " +
                        (
                            minhaMensagem
                                ? "responsavel"
                                : "julia"
                        );


                    bolha.innerHTML = `
                ${escaparHTML(
                        mensagem.message
                    )}

                <span class="chat-time">
                    ${escaparHTML(
                        chatHora(
                            mensagem.created_at
                        )
                    )}
                </span>
            `;


                    container.appendChild(
                        bolha
                    );
                }
            );


            container.scrollTop =
                container.scrollHeight;
        }


        /* =====================================================
           INICIALIZAÇÃO
        ===================================================== */

        function iniciarChat() {

            carregarChat();
        }


        /* =====================================================
           ABRIR CHAT
        ===================================================== */

        function alternarChatJulia() {

            const chat =
                document.getElementById(
                    "juliaChat"
                );


            const botao =
                document.getElementById(
                    "chatFloatButton"
                );


            const unread =
                document.getElementById(
                    "chatUnread"
                );


            if (!chat) {
                return;
            }


            const aberto =
                chat.classList.toggle(
                    "show"
                );


            chat.setAttribute(
                "aria-hidden",
                String(!aberto)
            );


            botao?.setAttribute(
                "aria-expanded",
                String(aberto)
            );


            if (unread && aberto) {

                unread.style.display =
                    "none";
            }


            if (aberto) {

                carregarChat();


                setTimeout(
                    () => {

                        document
                            .getElementById(
                                "juliaChatInput"
                            )
                            ?.focus();

                    },
                    150
                );
            }
        }


        /* =====================================================
           FECHAR CHAT
        ===================================================== */

        function fecharChatJulia() {

            document
                .getElementById(
                    "juliaChat"
                )
                ?.classList.remove(
                    "show"
                );


            document
                .getElementById(
                    "juliaChat"
                )
                ?.setAttribute(
                    "aria-hidden",
                    "true"
                );


            document
                .getElementById(
                    "chatFloatButton"
                )
                ?.setAttribute(
                    "aria-expanded",
                    "false"
                );
        }

        /* =====================================================
   ALERTA SOS DO BANCO
===================================================== */

        // 1. Pede permissão para notificações push do navegador assim que abrir a página
        if ("Notification" in window && Notification.permission !== "granted") {
            Notification.requestPermission();
        }

        // 2. Função que dispara a vibração e a notificação nativa
        function dispararAlertaResponsavel(alerta) {
            // Toca padrão de vibração no telemóvel (suportado por dispositivos móveis)
            if ("vibrate" in navigator) {
                navigator.vibrate([500, 200, 500, 200, 1000]);
            }

            // Dispara Notificação Nativa do Sistema/Navegador
            if (Notification.permission === "granted") {
                const notif = new Notification("🚨 ALERTA DE EMERGÊNCIA!", {
                    body: `A pessoa protegida enviou um alerta. Clique para acompanhar.`,
                    tag: "alerta-emergencia",
                    renotify: true
                });

                notif.onclick = function () {
                    window.focus();
                    confirmarAtendimento(); // Aciona o botão de acompanhar automaticamente ao clicar na notificação
                };
            }
        }

        let verificandoAlerta = false;

        async function carregarAlertaSOS() {
            if (verificandoAlerta) return;
            verificandoAlerta = true;
            try {
                const resposta = await fetch("api.php?action=responsible_alert", {
                    method: "GET",
                    credentials: "same-origin",
                    cache: "no-store",
                    headers: { "Accept": "application/json" }
                });
                const dados = await resposta.json();
                if (!resposta.ok || !dados.ok) {
                    console.warn("SOS:", dados.message || "Falha ao consultar alertas.");
                    return;
                }

                const alerta = dados.alerta;
                if (!alerta) {
                    alertaAtual = null;
                    atendimentoConfirmado = false;
                    aplicarDadosDoAlerta();
                    return;
                }

                const idNovo = Number(alerta.id);
                const idAnterior = Number(alertaAtual?.id || 0);
                alertaAtual = {
                    id: idNovo,
                    usuario_id: alerta.usuario_id,
                    usuario_nome: alerta.usuario_nome,
                    tipo: alerta.tipo,
                    mensagem: alerta.mensagem,
                    status: alerta.status,
                    latitude: alerta.latitude,
                    longitude: alerta.longitude,
                    localizacao: alerta.localizacao,
                    timestamp: alerta.timestamp
                };
                const statusAtual = String(alerta.status || "").trim().toLowerCase();
                atendimentoConfirmado = ["attended", "atendido", "atendida", "em_atendimento"].includes(statusAtual);
                aplicarDadosDoAlerta();

                // Notifica uma única vez por ID, somente quando o alerta é novo e está aberto.
                const jaNotificado = alertasNotificadosNestaPagina.has(idNovo);
                if (idNovo !== idAnterior && !jaNotificado && ["open", "aberto", "aberta", "pending", "pendente"].includes(statusAtual)) {
                    alertasNotificadosNestaPagina.add(idNovo);
                    
                    // Dispara a vibração e a notificação nativa aqui!
                    dispararAlertaResponsavel(alerta);
                    
                    mostrarMensagem("🚨 Novo alerta de emergência recebido!");
                }
            } catch (erro) {
                console.error("Erro ao verificar SOS:", erro);
            } finally {
                verificandoAlerta = false;
            }
        }


        /* =====================================================
           ENVIAR MENSAGEM
        ===================================================== */

        async function enviarChatJulia(evento) {

            evento.preventDefault();


            const input =
                document.getElementById(
                    "juliaChatInput"
                );


            if (!input) {
                return;
            }


            const texto =
                input.value.trim();


            if (!texto) {
                return;
            }


            input.disabled = true;


            try {

                const resposta =
                    await fetch(
                        "api.php?action=chat&mode=send",
                        {
                            method: "POST",

                            credentials:
                                "same-origin",

                            headers: {
                                "Content-Type":
                                    "application/json"
                            },

                            body: JSON.stringify({
                                message: texto
                            })
                        }
                    );


                const dados =
                    await resposta.json();


                if (!dados.ok) {

                    mostrarMensagem(
                        dados.message ||
                        "Não foi possível enviar a mensagem."
                    );

                    return;
                }


                input.value = "";


                await carregarChat();


            } catch (erro) {

                console.error(
                    "Erro ao enviar mensagem:",
                    erro
                );


                mostrarMensagem(
                    "Erro ao conectar com o servidor."
                );


            } finally {

                input.disabled = false;
                input.focus();
            }
        }

        /* EVENTOS */
        document.getElementById("finishModal").addEventListener("click", function (evento) {
            if (evento.target === this) {
                fecharFinalizacao();
            }
        });

        document.addEventListener("keydown", function (evento) {
            if (evento.key === "Escape") {
                fecharFinalizacao();
                fecharChatJulia();
            }
        });

        /* INICIALIZAÇÃO */
        window.addEventListener("load", function () {

            /*
             * Carrega o chat
             */
            iniciarChat();


            /*
             * Carrega o SOS imediatamente
             */
            carregarAlertaSOS();


            /*
             * Verifica novos SOS a cada 3 segundos
             */
            setInterval(() => {

                carregarAlertaSOS();

            }, 3000);


            /*
             * Verifica novas mensagens do chat
             */
            setInterval(() => {

                carregarChat();

            }, 3000);


            /*
             * Atualiza o tempo do alerta
             */
            setInterval(() => {

                if (alertaAtual) {

                    const elemento =
                        document.getElementById(
                            "alertTime"
                        );

                    if (elemento) {

                        elemento.textContent =
                            formatarTempo(
                                alertaAtual.timestamp
                            );
                    }
                }

            }, 30000);

        });

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
                    function () {

                        window.location.href =
                            "logout.php";

                    },
                    800
                );

            }

        }
        async function carregarBateriaProtegido() {
            const elemento = document.getElementById("batteryStatus");
            if (!elemento) return;
            try {
                const resposta = await fetch("api.php?action=responsible_battery", {
                    credentials: "same-origin", cache: "no-store"
                });
                const dados = await resposta.json();
                if (!resposta.ok || !dados.ok) throw new Error(dados.message || "Falha ao consultar bateria");
                if (dados.level === null || dados.level === undefined) {
                    elemento.textContent = dados.updated_at ? "Sem leitura recente" : "Indisponível";
                    elemento.style.color = "";
                    return;
                }
                elemento.textContent = dados.level + "%";
                elemento.style.color = dados.level <= 20 ? "#e85c6b" : (dados.level <= 50 ? "#d99a24" : "#32b99a");
                elemento.title = dados.updated_at ? "Última atualização: " + dados.updated_at : "";
            } catch (erro) {
                console.warn("Erro ao carregar bateria da pessoa protegida:", erro);
                elemento.textContent = "Indisponível";
            }
        }

        carregarBateriaProtegido();
        setInterval(carregarBateriaProtegido, 15000);

        // Carrega os 5 alertas mais recentes do banco e atualiza periodicamente.
        carregarHistoricoAlertas();
        setInterval(carregarHistoricoAlertas, 15000);

    </script>
    <script src="assets/db-sync.js"></script>
</body>

</html>