<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Mapa</title>


    <!-- =====================================================
         LEAFLET
    ====================================================== -->

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>


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
           CORES
        ===================================================== */

        :root {

            --roxo: #a65cff;
            --roxo-claro: #c58aff;
            --roxo-escuro: #6e32ad;

            --fundo: #050507;
            --fundo-card: #101015;
            --fundo-card-2: #15151c;

            --borda: #292933;

            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;

            --verde: #55df91;
            --vermelho: #ff5c70;
            --amarelo: #ffc857;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, .16),
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


        button {
            font-family: inherit;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {

            width: 100%;

            max-width: 1000px;

            margin: auto;

            padding:
                22px
                22px
                125px;
        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {

            display: flex;

            align-items: center;

            gap: 15px;

            margin-bottom: 22px;
        }


        /* =====================================================
           BOTÃO VOLTAR
        ===================================================== */

        .back-button {

            width: 47px;
            height: 47px;

            min-width: 47px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                var(--fundo-card);

            color:
                var(--roxo-claro);

            cursor: pointer;

            transition: .2s;
        }


        .back-button:hover {

            background:
                rgba(166, 92, 255, .12);

            border-color:
                var(--roxo);
        }


        .back-button svg {

            width: 25px;
            height: 25px;
        }


        /* =====================================================
           CABEÇALHO TEXTO
        ===================================================== */

        .header-text {

            flex: 1;
        }


        .header-text h1 {

            font-size: 30px;

            font-weight: 600;

            margin-bottom: 3px;
        }


        .header-text p {

            color:
                var(--cinza);

            font-size: 14px;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            display: flex;

            align-items: center;

            gap: 7px;

            padding:
                8px 12px;

            border-radius: 20px;

            background:
                rgba(85, 223, 145, .09);

            color:
                var(--verde);

            font-size: 11px;

            font-weight: 600;

            white-space: nowrap;
        }


        .status-dot {

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background:
                var(--verde);

            box-shadow:
                0 0 8px
                rgba(85, 223, 145, .6);
        }


        /* =====================================================
           CARD PRINCIPAL DO MAPA
        ===================================================== */

        .map-card {

            position: relative;

            width: 100%;

            height: 560px;

            overflow: hidden;

            border:
                1px solid
                var(--borda);

            border-radius: 26px;

            background:
                #0c0c11;

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .35);
        }


        /* =====================================================
           MAPA
        ===================================================== */

        #map {

            width: 100%;
            height: 100%;

            background:
                #0d0d12;
        }


        /* =====================================================
           LEAFLET
        ===================================================== */

        .leaflet-control-zoom {

            border:
                1px solid
                var(--borda) !important;

            box-shadow:
                0 8px 20px
                rgba(0, 0, 0, .35) !important;
        }


        .leaflet-control-zoom a {

            background:
                #15151c !important;

            color:
                var(--roxo-claro) !important;

            border-color:
                var(--borda) !important;
        }


        .leaflet-control-zoom a:hover {

            background:
                #21152d !important;
        }


        .leaflet-control-attribution {

            background:
                rgba(10, 10, 15, .85) !important;

            color:
                #999 !important;
        }


        .leaflet-control-attribution a {

            color:
                var(--roxo-claro) !important;
        }


        /* =====================================================
           BOTÃO LOCALIZAÇÃO
        ===================================================== */

        .location-button {

            position: absolute;

            right: 18px;
            top: 18px;

            z-index: 500;

            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                rgba(16, 16, 21, .95);

            color:
                var(--roxo-claro);

            cursor: pointer;

            box-shadow:
                0 8px 25px
                rgba(0, 0, 0, .35);

            transition: .2s;
        }


        .location-button:hover {

            background:
                rgba(166, 92, 255, .18);

            border-color:
                var(--roxo);
        }


        .location-button svg {

            width: 24px;
            height: 24px;
        }


        /* =====================================================
           LEGENDA
        ===================================================== */

        .map-legend {

            position: absolute;

            left: 18px;
            bottom: 18px;

            z-index: 500;

            padding:
                13px 15px;

            border:
                1px solid
                rgba(255, 255, 255, .08);

            border-radius: 15px;

            background:
                rgba(10, 10, 15, .93);

            backdrop-filter:
                blur(12px);

            box-shadow:
                0 8px 25px
                rgba(0, 0, 0, .3);
        }


        .legend-title {

            font-size: 12px;

            color:
                var(--branco);

            font-weight: 600;

            margin-bottom: 9px;
        }


        .legend-item {

            display: flex;

            align-items: center;

            gap: 8px;

            color:
                var(--cinza);

            font-size: 11px;

            margin-top: 6px;
        }


        .legend-dot {

            width: 10px;
            height: 10px;

            border-radius: 50%;
        }


        .legend-dot.safe {

            background:
                var(--verde);

            box-shadow:
                0 0 8px
                rgba(85, 223, 145, .5);
        }


        .legend-dot.you {

            background:
                var(--roxo-claro);

            box-shadow:
                0 0 8px
                rgba(166, 92, 255, .5);
        }


        /* =====================================================
           INFORMAÇÕES
        ===================================================== */

        .info-section {

            margin-top: 24px;
        }


        .section-title {

            color:
                var(--roxo-claro);

            font-size: 18px;

            font-weight: 500;

            margin-bottom: 12px;

            padding-left: 4px;
        }


        .location-info {

            display: flex;

            align-items: center;

            gap: 14px;

            padding: 18px;

            border:
                1px solid
                var(--borda);

            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0b0b10
                );
        }


        .location-info-icon {

            width: 47px;
            height: 47px;

            min-width: 47px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);
        }


        .location-info-icon svg {

            width: 25px;
            height: 25px;
        }


        .location-info-text {

            flex: 1;
        }


        .location-info-text h3 {

            font-size: 14px;

            font-weight: 500;

            margin-bottom: 4px;
        }


        .location-info-text p {

            color:
                var(--cinza);

            font-size: 12px;

            line-height: 1.4;
        }


        /* =====================================================
           LOCAIS SEGUROS
        ===================================================== */

        .safe-section {

            margin-top: 25px;
        }


        .safe-card {

            display: flex;

            align-items: center;

            gap: 13px;

            padding: 16px;

            margin-bottom: 10px;

            border:
                1px solid
                var(--borda);

            border-radius: 18px;

            background:
                var(--fundo-card);

            transition: .2s;

            cursor: pointer;
        }


        .safe-card:hover {

            border-color:
                rgba(166, 92, 255, .5);

            background:
                #13131a;
        }


        .safe-icon {

            width: 43px;
            height: 43px;

            min-width: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                rgba(85, 223, 145, .1);

            color:
                var(--verde);
        }


        .safe-icon svg {

            width: 22px;
            height: 22px;
        }


        .safe-text {

            flex: 1;
        }


        .safe-text h3 {

            font-size: 14px;

            font-weight: 500;

            margin-bottom: 3px;
        }


        .safe-text p {

            color:
                var(--cinza);

            font-size: 12px;
        }


        .safe-arrow {

            color:
                var(--cinza-escuro);
        }


        .safe-arrow svg {

            width: 19px;
            height: 19px;
        }


        /* =====================================================
           BOTÃO ROTA
        ===================================================== */

        .route-button {

            width: 100%;

            margin-top: 15px;

            padding: 15px;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            border:
                1px solid
                rgba(166, 92, 255, .4);

            border-radius: 16px;

            background:
                rgba(166, 92, 255, .09);

            color:
                var(--roxo-claro);

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;
        }


        .route-button:hover {

            background:
                rgba(166, 92, 255, .16);

            border-color:
                var(--roxo);
        }


        .route-button svg {

            width: 19px;
            height: 19px;
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 110px;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            z-index: 9999;

            padding:
                14px 20px;

            border:
                1px solid
                var(--roxo);

            border-radius: 14px;

            background:
                #18181f;

            color:
                var(--branco);

            font-size: 13px;

            text-align: center;

            max-width: 90%;

            transition: .3s;
        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        /* =====================================================
           MENU INFERIOR
           IGUAL AO MENU ANTERIOR
           4 OPÇÕES
        ===================================================== */

        .bottom-nav {

            position: fixed;

            left: 50%;

            bottom: 15px;

            transform:
                translateX(-50%);

            width:
                min(
                    calc(100% - 30px),
                    950px
                );

            height: 78px;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            align-items: stretch;

            padding: 5px;

            background:
                rgba(18, 18, 22, .97);

            border:
                1px solid
                rgba(255, 255, 255, .04);

            border-radius: 24px;

            backdrop-filter:
                blur(15px);

            -webkit-backdrop-filter:
                blur(15px);

            z-index: 1000;

            box-shadow:
                0 12px 35px
                rgba(0, 0, 0, .35);
        }


        /* =====================================================
           BOTÕES DO MENU
        ===================================================== */

        .nav-button {

            width: 100%;
            height: 100%;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            gap: 4px;

            border: none;

            border-radius: 19px;

            background:
                transparent;

            color:
                #85858e;

            cursor: pointer;

            font-size: 12px;

            transition:
                background .2s ease,
                color .2s ease;
        }


        /* =====================================================
           ÍCONES
        ===================================================== */

        .nav-button svg {

            width: 24px;
            height: 24px;

            flex-shrink: 0;
        }


        /* =====================================================
           ATIVO
        ===================================================== */

        .nav-button.active {

            color:
                var(--roxo-claro);

            background:
                rgba(166, 92, 255, .10);
        }


        /* =====================================================
           HOVER
        ===================================================== */

        .nav-button:hover {

            color:
                var(--roxo-claro);

            background:
                rgba(166, 92, 255, .07);
        }


        /* =====================================================
           MARCADOR USUÁRIO
        ===================================================== */

        .custom-marker {

            width: 48px;
            height: 48px;

            border-radius:
                50% 50% 50% 0;

            transform:
                rotate(-45deg);

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                var(--roxo);

            border:
                3px solid
                white;

            box-shadow:
                0 5px 18px
                rgba(166, 92, 255, .55);
        }


        .custom-marker svg {

            width: 23px;
            height: 23px;

            transform:
                rotate(45deg);
        }


        /* =====================================================
           MARCADOR SEGURO
        ===================================================== */

        .safe-marker {

            width: 40px;
            height: 40px;

            border-radius:
                50% 50% 50% 0;

            transform:
                rotate(-45deg);

            display: flex;

            align-items: center;
            justify-content: center;

            background:
                var(--verde);

            border:
                3px solid
                white;

            box-shadow:
                0 5px 15px
                rgba(85, 223, 145, .45);
        }


        .safe-marker svg {

            width: 20px;
            height: 20px;

            transform:
                rotate(45deg);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .app {

                padding:
                    18px
                    15px
                    115px;
            }


            .header-text h1 {

                font-size: 25px;
            }


            .status {

                display: none;
            }


            .map-card {

                height: 470px;

                border-radius: 22px;
            }


            .map-legend {

                left: 12px;

                bottom: 12px;
            }


            .location-info {

                padding: 15px;
            }


            /* MENU MOBILE */

            .bottom-nav {

                width:
                    calc(100% - 24px);

                height: 70px;

                bottom: 10px;

                padding: 4px;

                border-radius: 21px;
            }


            .nav-button {

                gap: 3px;

                font-size: 10px;

                border-radius: 17px;
            }


            .nav-button svg {

                width: 22px;

                height: 22px;
            }


            .toast {

                bottom: 90px;
            }
        }


        /* =====================================================
           CELULARES PEQUENOS
        ===================================================== */

        @media (max-width: 400px) {

            .header-text h1 {

                font-size: 22px;
            }


            .map-card {

                height: 430px;
            }


            .location-info-icon {

                width: 42px;

                height: 42px;

                min-width: 42px;
            }


            .bottom-nav {

                height: 66px;

                bottom: 8px;

                width:
                    calc(100% - 18px);
            }


            .nav-button {

                font-size: 9px;
            }


            .nav-button svg {

                width: 21px;

                height: 21px;
            }
        }

        /* Ajuste comum do menu principal */
        .bottom-nav {
            width: min(calc(100% - 30px), 850px);
            height: 82px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0;
            padding: 5px;
            align-items: stretch;
            box-sizing: border-box;
        }

        .nav-button {
            width: 100%;
            height: 100%;
            min-width: 0;
            gap: 5px;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            line-height: 1.2;
        }

        .nav-button svg {
            width: 25px;
            height: 25px;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .bottom-nav {
                width: calc(100% - 24px);
                height: 76px;
                padding: 5px;
            }

            .nav-button {
                gap: 4px;
                font-size: 10px;
            }

            .nav-button svg {
                width: 23px;
                height: 23px;
            }
        }

        @media (max-width: 400px) {
            .bottom-nav {
                height: 74px;
            }

            .nav-button {
                gap: 3px;
                font-size: 9px;
            }

            .nav-button svg {
                width: 21px;
                height: 21px;
            }
        }
    </style>

</head>


<body>


    <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

    <main class="app">


        <!-- =================================================
             CABEÇALHO
        ================================================== -->

        <header class="header">

            <button
                class="back-button"
                onclick="voltarHome()"
                aria-label="Voltar"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path d="M19 12H5"/>

                    <path d="M12 19l-7-7 7-7"/>

                </svg>

            </button>


            <div class="header-text">

                <h1>
                    Mapa
                </h1>

                <p>
                    Locais seguros próximos a você
                </p>

            </div>


            <div class="status">

                <span class="status-dot"></span>

                Localização ativa

            </div>

        </header>


        <!-- =================================================
             MAPA
        ================================================== -->

        <section class="map-card">

            <div id="map"></div>


            <button
                class="location-button"
                onclick="localizarUsuario()"
                aria-label="Minha localização"
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
                        r="7"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="2"
                        fill="currentColor"
                    />

                    <path d="M12 2v3"/>

                    <path d="M12 19v3"/>

                    <path d="M2 12h3"/>

                    <path d="M19 12h3"/>

                </svg>

            </button>


            <div class="map-legend">

                <div class="legend-title">
                    Legenda
                </div>


                <div class="legend-item">

                    <span class="legend-dot you"></span>

                    Sua localização

                </div>


                <div class="legend-item">

                    <span class="legend-dot safe"></span>

                    Local seguro

                </div>

            </div>

        </section>


        <!-- =================================================
             LOCALIZAÇÃO
        ================================================== -->

        <section class="info-section">

            <h2 class="section-title">
                Sua localização
            </h2>


            <div class="location-info">

                <div class="location-info-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"
                        />

                        <circle
                            cx="12"
                            cy="10"
                            r="2.5"
                        />

                    </svg>

                </div>


                <div class="location-info-text">

                    <h3>
                        Localização do dispositivo
                    </h3>

                    <p id="locationText">
                        Aguardando localização...
                    </p>

                </div>

            </div>

        </section>


        <!-- =================================================
             LOCAIS SEGUROS
        ================================================== -->

        <section class="safe-section">

            <h2 class="section-title">
                Locais seguros próximos
            </h2>


            <!-- LOCAL 1 -->

            <div
                class="safe-card"
                onclick="selecionarLocal(0)"
            >

                <div class="safe-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path d="M3 21h18"/>

                        <path d="M5 21V7l7-4 7 4v14"/>

                        <path d="M9 21v-5h6v5"/>

                        <path d="M9 9h1"/>

                        <path d="M14 9h1"/>

                    </svg>

                </div>


                <div class="safe-text">

                    <h3>
                        Posto de atendimento
                    </h3>

                    <p>
                        Local seguro para atendimento
                    </p>

                </div>


                <div class="safe-arrow">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M9 18l6-6-6-6"/>

                    </svg>

                </div>

            </div>


            <!-- LOCAL 2 -->

            <div
                class="safe-card"
                onclick="selecionarLocal(1)"
            >

                <div class="safe-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0z"
                        />

                        <circle
                            cx="12"
                            cy="10"
                            r="2.5"
                        />

                    </svg>

                </div>


                <div class="safe-text">

                    <h3>
                        Ponto SilentHelp
                    </h3>

                    <p>
                        Ponto de apoio cadastrado
                    </p>

                </div>


                <div class="safe-arrow">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M9 18l6-6-6-6"/>

                    </svg>

                </div>

            </div>


            <!-- LOCAL 3 -->

            <div
                class="safe-card"
                onclick="selecionarLocal(2)"
            >

                <div class="safe-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                        />

                        <path
                            d="M8 12l2.5 2.5L16 9"
                        />

                    </svg>

                </div>


                <div class="safe-text">

                    <h3>
                        Área protegida
                    </h3>

                    <p>
                        Região com suporte SilentHelp
                    </p>

                </div>


                <div class="safe-arrow">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M9 18l6-6-6-6"/>

                    </svg>

                </div>

            </div>


            <!-- BOTÃO ROTA -->

            <button
                class="route-button"
                onclick="abrirRotas()"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <circle
                        cx="6"
                        cy="19"
                        r="2"
                    />

                    <circle
                        cx="18"
                        cy="5"
                        r="2"
                    />

                    <path
                        d="M8 18c4 0 4-12 8-12"
                    />

                </svg>

                Encontrar o local seguro mais próximo

            </button>

        </section>

    </main>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        class="toast"
        id="toast"
    ></div>


    <!-- =====================================================
         MENU INFERIOR
         IGUAL AO ANTERIOR
         SEM HISTÓRICO
    ====================================================== -->

    <nav class="bottom-nav">

        <!-- INÍCIO -->

        <button
            class="nav-button"
            onclick="abrirPagina('index.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="currentColor"
            >

                <path
                    d="M3 11.5L12 4l9 7.5v8.5a1 1 0 0 1-1 1h-5v-6h-6v6H4a1 1 0 0 1-1-1z"
                />

            </svg>

            <span>
                Início
            </span>

        </button>


        <!-- MAPA -->

        <button
            class="nav-button active"
            onclick="abrirPagina('mapa.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="M9 18l-6 3V6l6-3 6 3 6-3v15l-6 3-6-3z"
                />

                <path d="M9 3v15"/>

                <path d="M15 6v15"/>

            </svg>

            <span>
                Mapa
            </span>

        </button>


        <!-- CONFIGURAÇÕES -->

        <button
            class="nav-button"
            onclick="abrirPagina('config.php')"
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
                    r="3"
                />

                <path
                    d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2 2-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-3v-.8a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-2-2 .1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-.3-1.9 1.7 1.7 0 0 0-1.6-1h-.8v-3h.8a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L6 7.9l2-2 .1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V4h3v.8a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9.3l.1-.1 2 2-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 .3 1.9 1.7 1.7 0 0 0 1.6 1h.8v3h-.8a1.7 1.7 0 0 0-1.6 1z"
                />

            </svg>

            <span>
                Config.
            </span>

        </button>


        <!-- PERFIL -->

        <button
            class="nav-button"
            onclick="abrirPagina('perfil.php')"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <circle
                    cx="12"
                    cy="8"
                    r="4"
                />

                <path
                    d="M4 21c0-4 3.5-7 8-7s8 3 8 7"
                />

            </svg>

            <span>
                Perfil
            </span>

        </button>

    </nav>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =====================================================
           VARIÁVEIS
        ===================================================== */

        let mapa = null;

        let marcadorUsuario = null;

        let precisaoUsuario = null;

        let usuarioLatitude = null;

        let usuarioLongitude = null;


        /* =====================================================
           LOCAIS SEGUROS
        ===================================================== */

        const locaisSeguros = [

            {
                nome: "Posto de atendimento",
                descricao: "Local seguro para atendimento",
                latitude: -23.0264,
                longitude: -45.5554
            },

            {
                nome: "Ponto SilentHelp",
                descricao: "Ponto de apoio cadastrado",
                latitude: -23.0200,
                longitude: -45.5600
            },

            {
                nome: "Área protegida",
                descricao: "Região com suporte SilentHelp",
                latitude: -23.0320,
                longitude: -45.5480
            }

        ];


        /* =====================================================
           ÍCONE USUÁRIO
        ===================================================== */

        const iconeUsuario = L.divIcon({

            className: "",

            html: `

                <div class="custom-marker">

                    <svg
                        viewBox="0 0 24 24"
                        fill="white"
                        stroke="white"
                        stroke-width="1.2"
                    >

                        <path
                            d="M12 21s-7-4.35-7-10A7 7 0 0 1 19 11c0 5.65-7 10-7 10z"
                        />

                    </svg>

                </div>

            `,

            iconSize: [48, 48],

            iconAnchor: [24, 48],

            popupAnchor: [0, -45]

        });


        /* =====================================================
           ÍCONE SEGURO
        ===================================================== */

        const iconeSeguro = L.divIcon({

            className: "",

            html: `

                <div class="safe-marker">

                    <svg
                        viewBox="0 0 24 24"
                        fill="white"
                        stroke="white"
                        stroke-width="1.5"
                    >

                        <path
                            d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                        />

                        <path
                            d="M8 12l2.5 2.5L16 9"
                            fill="none"
                        />

                    </svg>

                </div>

            `,

            iconSize: [40, 40],

            iconAnchor: [20, 40],

            popupAnchor: [0, -38]

        });


        /* =====================================================
           INICIAR MAPA
        ===================================================== */

        function iniciarMapa() {

            const latitudeInicial = -23.0264;

            const longitudeInicial = -45.5554;


            mapa = L.map("map", {

                zoomControl: true,

                attributionControl: true

            }).setView(

                [
                    latitudeInicial,
                    longitudeInicial
                ],

                14

            );


            L.tileLayer(

                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",

                {

                    maxZoom: 19,

                    attribution:
                        "&copy; OpenStreetMap contributors"

                }

            ).addTo(mapa);


            locaisSeguros.forEach(

                function(local, index) {

                    const marcador = L.marker(

                        [
                            local.latitude,
                            local.longitude
                        ],

                        {
                            icon: iconeSeguro
                        }

                    ).addTo(mapa);


                    marcador.bindPopup(`

                        <div style="
                            min-width:180px;
                            font-family:Arial,sans-serif;
                        ">

                            <strong>
                                ${local.nome}
                            </strong>

                            <br>

                            <span style="
                                color:#666;
                                font-size:12px;
                            ">
                                ${local.descricao}
                            </span>

                            <br><br>

                            <button
                                onclick="selecionarLocal(${index})"
                                style="
                                    width:100%;
                                    padding:8px;
                                    border:none;
                                    border-radius:8px;
                                    background:#a65cff;
                                    color:white;
                                    cursor:pointer;
                                "
                            >
                                Ver localização
                            </button>

                        </div>

                    `);

                }

            );


            localizarUsuario();

        }


        /* =====================================================
           LOCALIZAR USUÁRIO
        ===================================================== */

        function localizarUsuario() {

            if (!navigator.geolocation) {

                mostrarToast(
                    "Seu navegador não suporta localização."
                );

                return;

            }


            mostrarToast(
                "Obtendo sua localização..."
            );


            navigator.geolocation.getCurrentPosition(

                function(posicao) {

                    usuarioLatitude =
                        posicao.coords.latitude;

                    usuarioLongitude =
                        posicao.coords.longitude;


                    atualizarLocalizacao(

                        usuarioLatitude,

                        usuarioLongitude,

                        posicao.coords.accuracy

                    );

                },

                function(erro) {

                    console.log(
                        "Erro de localização:",
                        erro
                    );


                    document
                        .getElementById("locationText")
                        .textContent =
                        "Não foi possível obter sua localização.";


                    mostrarToast(
                        "Não foi possível obter sua localização."
                    );

                },

                {

                    enableHighAccuracy: true,

                    timeout: 10000,

                    maximumAge: 0

                }

            );

        }


        /* =====================================================
           ATUALIZAR LOCALIZAÇÃO
        ===================================================== */

        function atualizarLocalizacao(

            latitude,
            longitude,
            precisao

        ) {

            if (marcadorUsuario) {

                mapa.removeLayer(
                    marcadorUsuario
                );

            }


            if (precisaoUsuario) {

                mapa.removeLayer(
                    precisaoUsuario
                );

            }


            marcadorUsuario = L.marker(

                [
                    latitude,
                    longitude
                ],

                {
                    icon: iconeUsuario
                }

            ).addTo(mapa);


            marcadorUsuario.bindPopup(`

                <div style="
                    font-family:Arial,sans-serif;
                    text-align:center;
                    min-width:150px;
                ">

                    <strong>
                        ❤️ Você está aqui
                    </strong>

                    <br>

                    <span style="
                        color:#666;
                        font-size:12px;
                    ">
                        Localização aproximada
                    </span>

                </div>

            `);


            precisaoUsuario = L.circle(

                [
                    latitude,
                    longitude
                ],

                {

                    radius:
                        Math.min(
                            precisao || 100,
                            500
                        ),

                    color:
                        "#a65cff",

                    fillColor:
                        "#a65cff",

                    fillOpacity:
                        .08,

                    weight:
                        1

                }

            ).addTo(mapa);


            mapa.setView(

                [
                    latitude,
                    longitude
                ],

                16,

                {
                    animate: true
                }

            );


            document
                .getElementById("locationText")
                .textContent =

                "Localização obtida com sucesso. Precisão aproximada: " +

                Math.round(
                    precisao || 0
                ) +

                " metros.";


            mostrarToast(
                "✓ Sua localização foi encontrada."
            );

        }


        /* =====================================================
           SELECIONAR LOCAL
        ===================================================== */

        function selecionarLocal(index) {

            const local =
                locaisSeguros[index];


            if (!local || !mapa) {
                return;
            }


            mapa.setView(

                [
                    local.latitude,
                    local.longitude
                ],

                17,

                {
                    animate: true
                }

            );


            mostrarToast(
                "Local seguro selecionado."
            );

        }


        /* =====================================================
           ROTAS
        ===================================================== */

        function abrirRotas() {

            if (

                usuarioLatitude === null ||

                usuarioLongitude === null

            ) {

                mostrarToast(
                    "Primeiro precisamos encontrar sua localização."
                );


                localizarUsuario();

                return;

            }


            let menorDistancia =
                Infinity;

            let localMaisProximo =
                null;


            locaisSeguros.forEach(

                function(local) {

                    const distancia =
                        calcularDistancia(

                            usuarioLatitude,
                            usuarioLongitude,

                            local.latitude,
                            local.longitude

                        );


                    if (
                        distancia <
                        menorDistancia
                    ) {

                        menorDistancia =
                            distancia;

                        localMaisProximo =
                            local;

                    }

                }

            );


            if (!localMaisProximo) {
                return;
            }


            const url =

                "https://www.google.com/maps/dir/?api=1" +

                "&origin=" +

                usuarioLatitude +

                "," +

                usuarioLongitude +

                "&destination=" +

                localMaisProximo.latitude +

                "," +

                localMaisProximo.longitude;


            window.open(
                url,
                "_blank"
            );


            mostrarToast(
                "Abrindo rota para o local seguro mais próximo."
            );

        }


        /* =====================================================
           DISTÂNCIA
        ===================================================== */

        function calcularDistancia(

            lat1,
            lon1,
            lat2,
            lon2

        ) {

            const R = 6371;


            const dLat =
                grausParaRad(
                    lat2 - lat1
                );


            const dLon =
                grausParaRad(
                    lon2 - lon1
                );


            const a =

                Math.sin(dLat / 2) *
                Math.sin(dLat / 2)

                +

                Math.cos(
                    grausParaRad(lat1)
                ) *

                Math.cos(
                    grausParaRad(lat2)
                ) *

                Math.sin(dLon / 2) *
                Math.sin(dLon / 2);


            const c =

                2 *

                Math.atan2(

                    Math.sqrt(a),

                    Math.sqrt(
                        1 - a
                    )

                );


            return R * c;

        }


        /* =====================================================
           GRAUS PARA RADIANOS
        ===================================================== */

        function grausParaRad(graus) {

            return graus *
                Math.PI /
                180;

        }


        /* =====================================================
           VOLTAR
        ===================================================== */

        function voltarHome() {

            window.location.href =
                "index.php";

        }


        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        function abrirPagina(pagina) {

            window.location.href =
                pagina;

        }


        /* =====================================================
           TOAST
        ===================================================== */

        function mostrarToast(mensagem) {

            const toast =
                document.getElementById("toast");


            toast.textContent =
                mensagem;


            toast.classList.add(
                "show"
            );


            clearTimeout(
                window.toastTimeout
            );


            window.toastTimeout =
                setTimeout(

                    function() {

                        toast.classList.remove(
                            "show"
                        );

                    },

                    2800

                );

        }


        /* =====================================================
           INICIAR
        ===================================================== */

        window.addEventListener(

            "load",

            function() {

                iniciarMapa();

            }

        );


        /* =====================================================
           REDIMENSIONAR MAPA
        ===================================================== */

        window.addEventListener(

            "resize",

            function() {

                if (mapa) {

                    mapa.invalidateSize();

                }

            }

        );

    </script>

<script src="assets/db-sync.js"></script>
</body>

</html>