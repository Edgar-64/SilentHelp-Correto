<?php require_once __DIR__ . '/auth.php';?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SilentHelp - Responsável</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

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

        .history-item {
            display: flex;
            gap: 13px;
            padding: 15px 20px;
            border-top: 1px solid rgba(255, 255, 255, .05);
        }

        .history-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(166, 92, 255, .12);
            color: var(--roxo-claro);
        }

        .history-item strong {
            display: block;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .history-item span {
            color: var(--cinza);
            font-size: 12px;
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
    </style>
</head>

<body>

    <main class="app">
        <!-- HEADER -->
        <header class="header">
            <div class="logo">
                <svg class="logo-heart" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 54 C27 50 7 38 7 21 C7 12 13 7 21 7 C26 7 30 10 32 14 C34 10 38 7 43 7 C51 7 57 12 57 21 C57 38 37 50 32 54Z" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="logo-text">
                    <span class="silent">silent</span><span class="help">help</span>
                </div>
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
                <p id="alertDescription">Julia solicitou ajuda. A localização está sendo compartilhada com você.</p>
            </div>
            <div class="alert-time">Há 2 min</div>
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
                        <div class="avatar">J</div>
                        <div>
                            <h3>Julia</h3>
                            <p>Pessoa protegida</p>
                        </div>
                    </div>

                    <!-- INFORMAÇÕES -->
                    <div class="info-list">
                        <div class="info-row">
                            <div class="info-row-icon">📱</div>
                            <div class="info-row-text">
                                <small>DISPOSITIVO</small>
                                <strong id="deviceStatus">Conectado</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">🔋</div>
                            <div class="info-row-text">
                                <small>BATERIA</small>
                                <strong>87%</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">📡</div>
                            <div class="info-row-text">
                                <small>CONEXÃO</small>
                                <strong>Sinal excelente</strong>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-row-icon">📍</div>
                            <div class="info-row-text">
                                <small>GPS</small>
                                <strong id="gpsStatus">Funcionando</strong>
                            </div>
                        </div>
                    </div>

                    <!-- COORDENADAS -->
                    <div class="coordinates">
                        <div class="coordinates-title">📍 Coordenadas atuais</div>
                        <p>
                            Latitude: <strong id="latitude">-23.026600</strong><br>
                            Longitude: <strong id="longitude">-45.555300</strong>
                        </p>
                    </div>

                    <button class="my-location-button" onclick="minhaLocalizacao()">📍 Ver minha localização no mapa</button>
                </section>

                <!-- CARD DE ATENDIMENTO -->
                <section class="card attendance-card">
                    <h2>Atendimento</h2>
                    <p id="attendanceText">Você está acompanhando este alerta. Mantenha o contato com a pessoa e verifique a localização.</p>

                    <button class="attend-button" id="attendButton" onclick="confirmarAtendimento()">✓ &nbsp; Estou acompanhando</button>
                    <button class="finish-button" onclick="abrirFinalizacao()">Encerrar atendimento</button>
                </section>
            </div>

        </div>

        <!-- HISTÓRICO -->
        <section class="card history">
            <div class="card-header">
                <h2>Histórico do alerta</h2>
            </div>

            <div class="history-item">
                <div class="history-icon">🚨</div>
                <div>
                    <strong>Alerta recebido</strong>
                    <span>Julia solicitou ajuda.</span>
                </div>
            </div>

            <div class="history-item">
                <div class="history-icon">📍</div>
                <div>
                    <strong>Localização compartilhada</strong>
                    <span>Localização disponibilizada para o responsável.</span>
                </div>
            </div>

            <div class="history-item">
                <div class="history-icon">📱</div>
                <div>
                    <strong>Dispositivo conectado</strong>
                    <span>Comunicação estabelecida com o SilentHelp.</span>
                </div>
            </div>
        </section>

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

    <!-- CHAT FLUTUANTE DE JULIA -->
    <button type="button" class="chat-float-button" id="chatFloatButton" onclick="alternarChatJulia()" aria-label="Abrir conversa com Julia" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8.5 8.5 0 0 1-3.6-.8L4 20l1.2-3.7A7.4 7.4 0 0 1 4 11.5 7.5 7.5 0 0 1 12 4a7.5 7.5 0 0 1 8 7.5z"/>
            <path d="M8.5 12h.01M12 12h.01M15.5 12h.01"/>
        </svg>
        <span class="chat-unread" id="chatUnread">1</span>
    </button>

    <section class="responsible-chat" id="juliaChat" aria-hidden="true" aria-label="Conversa com Julia">
        <header class="chat-header">
            <div class="chat-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="8" r="3.5"/>
                    <path d="M5 20c0-4 3-6 7-6s7 2 7 6"/>
                </svg>
            </div>
            <div class="chat-header-info">
                <strong>Julia</strong>
                <span class="chat-online"><span class="chat-online-dot"></span>Disponível para conversar</span>
            </div>
            <button type="button" class="chat-close" onclick="fecharChatJulia()" aria-label="Fechar conversa">×</button>
        </header>
        <div class="chat-messages" id="juliaChatMessages" aria-live="polite"></div>
        <form class="chat-input-area" onsubmit="enviarChatJulia(event)">
            <input type="text" class="chat-input" id="juliaChatInput" placeholder="Digite uma mensagem para Julia..." autocomplete="off" maxlength="500">
            <button type="submit" class="chat-send" aria-label="Enviar mensagem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 2L11 13"/><path d="M22 2l-7 20-4-9-9-4z"/>
                </svg>
            </button>
        </form>
    </section>

    <!-- TOAST DE NOTIFICAÇÕES -->
    <div id="toast" class="toast"></div>

    <!-- LEAFLET SCRIPT -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        /* CONFIGURAÇÕES GERAIS */
        let latitude = -23.0266;
        let longitude = -45.5553;

        /* MAPA LEAFLET */
        const map = L.map("map").setView([latitude, longitude], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution: "&copy; OpenStreetMap"
        }).addTo(map);

        const heartIcon = L.divIcon({
            className: "",
            html: `
                <div style="width:70px;height:70px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(166,92,255,.18);border:2px solid #c58aff;box-shadow:0 0 25px rgba(166,92,255,.5);">
                    <div style="width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#a65cff;color:white;font-size:23px;box-shadow:0 0 18px rgba(166,92,255,.7);">
                        ♥️
                    </div>
                </div>`,
            iconSize: [70, 70],
            iconAnchor: [35, 35]
        });

        let personMarker = L.marker([latitude, longitude], { icon: heartIcon }).addTo(map);

        let accuracyCircle = L.circle([latitude, longitude], {
            radius: 120,
            color: "#a65cff",
            fillColor: "#a65cff",
            fillOpacity: .08,
            weight: 1
        }).addTo(map);

        personMarker.bindPopup(`<strong>Julia</strong><br>Pessoa que pediu ajuda<br><small>Localização compartilhada</small>`);

        /* FUNÇÕES DE LOCALIZAÇÃO */
        function atualizarLocalizacao() {
            const botao = document.querySelector(".update-button");
            botao.innerHTML = "⏳ Atualizando...";
            botao.disabled = true;

            setTimeout(() => {
                latitude += (Math.random() - .5) * .001;
                longitude += (Math.random() - .5) * .001;

                atualizarMapa(latitude, longitude);
                document.getElementById("locationText").textContent = "Atualizada agora";
                botao.innerHTML = "✓ Localização atualizada";
                mostrarMensagem("Localização atualizada.");

                setTimeout(() => {
                    botao.innerHTML = "🔄 Atualizar localização";
                    botao.disabled = false;
                }, 1800);
            }, 800);
        }

        function atualizarMapa(lat, lng) {
            personMarker.setLatLng([lat, lng]);
            accuracyCircle.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            document.getElementById("latitude").textContent = lat.toFixed(6);
            document.getElementById("longitude").textContent = lng.toFixed(6);
        }

        setInterval(() => {
            latitude += (Math.random() - .5) * .0002;
            longitude += (Math.random() - .5) * .0002;
            atualizarMapa(latitude, longitude);
            document.getElementById("locationText").textContent = "Atualizada agora";
        }, 10000);

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

                    if (window.myMarker) window.myMarker.remove();

                    window.myMarker = L.marker([minhaLat, minhaLng])
                        .addTo(map)
                        .bindPopup("<strong>Você</strong><br>Localização do responsável.")
                        .openPopup();

                    map.setView([minhaLat, minhaLng], 15);
                    mostrarMensagem("Sua localização foi encontrada.");
                },
                error => {
                    let mensagem = "Não foi possível obter sua localização.";
                    if (error.code === 1) mensagem = "Permita o acesso à localização no navegador.";
                    mostrarMensagem(mensagem);
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }

        /* FUNÇÕES DE MODAL E ATENDIMENTO */
        function confirmarAtendimento() {
            document.getElementById("attendanceText").textContent = "Você confirmou que está acompanhando Julia. A localização continuará disponível enquanto o alerta estiver ativo.";
            const botao = document.getElementById("attendButton");
            botao.innerHTML = "✓ Atendimento confirmado";
            botao.style.background = "rgba(85,223,145,.12)";
            botao.style.color = "#55df91";
            botao.style.border = "1px solid rgba(85,223,145,.4)";

            mostrarMensagem("Atendimento confirmado.");
        }

        function abrirFinalizacao() {
            document.getElementById("finishModal").classList.add("show");
        }

        function fecharFinalizacao() {
            document.getElementById("finishModal").classList.remove("show");
        }

        function finalizarAtendimento() {
            fecharFinalizacao();
            document.querySelector(".alert-card").style.borderColor = "rgba(85,223,145,.4)";
            document.querySelector(".alert-card").style.background = "rgba(85,223,145,.08)";
            document.getElementById("alertTitle").textContent = "Atendimento encerrado";
            document.getElementById("alertDescription").textContent = "O acompanhamento deste alerta foi encerrado.";
            document.getElementById("liveText").textContent = "ENCERRADO";
            document.querySelector(".live").style.color = "#aaaab3";
            document.querySelector(".live-dot").style.background = "#aaaab3";

            mostrarMensagem("Atendimento encerrado.");
        }

        /* SISTEMA DE TOAST */
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

        /* LÓGICA DO CHAT FLUTUANTE DA JULIA */
        const JULIA_CHAT_KEY = "silentHelpChatJulia";

        function chatJuliaMensagens() {
            try { return JSON.parse(localStorage.getItem(JULIA_CHAT_KEY)) || []; }
            catch (e) { return []; }
        }

        function chatJuliaSalvar(m) {
            localStorage.setItem(JULIA_CHAT_KEY, JSON.stringify(m.slice(-80)));
        }

        function chatJuliaHora() {
            return new Date().toLocaleTimeString("pt-BR", { hour: "2-digit", minute: "2-digit" });
        }

        function chatJuliaEsc(s) {
            return String(s).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function renderizarChatJulia() {
            const container = document.getElementById("juliaChatMessages");
            if (!container) return;
            container.innerHTML = "";
            chatJuliaMensagens().forEach(m => {
                const b = document.createElement("div");
                b.className = "chat-message " + (m.remetente === "julia" ? "julia" : "responsavel");
                b.innerHTML = chatJuliaEsc(m.texto) + '<span class="chat-time">' + chatJuliaEsc(m.hora) + '</span>';
                container.appendChild(b);
            });
            container.scrollTop = container.scrollHeight;
        }

        function iniciarChatJulia() {
            let m = chatJuliaMensagens();
            if (!m.length) {
                m = [{ remetente: "julia", texto: "Oi! 💜 Estou aqui. Pode falar comigo quando quiser.", hora: chatJuliaHora() }];
                chatJuliaSalvar(m);
            }
            renderizarChatJulia();
        }

        function alternarChatJulia() {
            const c = document.getElementById("juliaChat");
            const b = document.getElementById("chatFloatButton");
            const u = document.getElementById("chatUnread");
            const aberto = c.classList.toggle("show");

            c.setAttribute("aria-hidden", String(!aberto));
            b.setAttribute("aria-expanded", String(aberto));

            if (u && aberto) u.style.display = "none";
            if (aberto) {
                renderizarChatJulia();
                setTimeout(() => document.getElementById("juliaChatInput")?.focus(), 150);
            }
        }

        function fecharChatJulia() {
            document.getElementById("juliaChat")?.classList.remove("show");
            document.getElementById("juliaChat")?.setAttribute("aria-hidden", "true");
            document.getElementById("chatFloatButton")?.setAttribute("aria-expanded", "false");
        }

        function adicionarChatJulia(remetente, texto) {
            let m = chatJuliaMensagens();
            m.push({ remetente, texto, hora: chatJuliaHora() });
            chatJuliaSalvar(m);
            renderizarChatJulia();
        }

        function enviarChatJulia(e) {
            e.preventDefault();
            const input = document.getElementById("juliaChatInput");
            const texto = input.value.trim();
            if (!texto) return;

            adicionarChatJulia("responsavel", texto);
            input.value = "";
            setTimeout(() => adicionarChatJulia("julia", "Recebi sua mensagem. 💜 Estou aqui com você e vou acompanhar o que você precisar."), 700);
        }

        /* EVENTOS GERAIS */
        document.getElementById("finishModal").addEventListener("click", function (e) {
            if (e.target === this) fecharFinalizacao();
        });

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape") {
                fecharFinalizacao();
                fecharChatJulia();
            }
        });

        /* INICIALIZAÇÃO */
        iniciarChatJulia();
    </script>
<script src="assets/db-sync.js"></script>
</body>

</html>