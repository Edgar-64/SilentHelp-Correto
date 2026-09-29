<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="theme-color"
        content="#050507"
    >

    <title>SilentHelp - Escanear QR Code</title>


    <!-- =====================================================
         BIBLIOTECA QR CODE
    ====================================================== -->

    <script
        src="https://unpkg.com/html5-qrcode"
        type="text/javascript">
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
           VARIÁVEIS
        ===================================================== */

        :root {

            --roxo: #a65cff;

            --roxo-claro: #c58aff;

            --roxo-escuro: #6f32ad;

            --fundo: #050507;

            --card: #101015;

            --card-2: #15151c;

            --card-3: #1a1921;

            --borda: #292933;

            --borda-roxa:
                rgba(166, 92, 255, .35);

            --branco: #ffffff;

            --cinza: #a8a8b1;

            --cinza-escuro: #777781;

            --verde: #55df91;

            --vermelho: #ff5c70;

        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            color: var(--branco);

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;

            background:

                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, .18),
                    transparent 38%
                ),

                radial-gradient(
                    circle at 100% 70%,
                    rgba(111, 50, 173, .08),
                    transparent 30%
                ),

                var(--fundo);

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

            max-width: 760px;

            min-height: 100vh;

            margin: auto;

            padding:
                22px
                22px
                50px;

        }


        /* =====================================================
           TOPO
        ===================================================== */

        .top {

            display: flex;

            align-items: center;

            gap: 15px;

            margin-bottom: 28px;

        }


        .back-button {

            width: 46px;

            height: 46px;

            min-width: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                rgba(16, 16, 21, .85);

            color:
                var(--branco);

            cursor: pointer;

            transition: .25s;

        }


        .back-button:hover {

            color:
                var(--roxo-claro);

            border-color:
                var(--roxo);

            background:
                rgba(166, 92, 255, .10);

            transform:
                translateX(-2px);

        }


        .back-button svg {

            width: 23px;

            height: 23px;

        }


        .top-title {

            display: flex;

            flex-direction: column;

        }


        .top-title h1 {

            font-size: 25px;

            font-weight: 600;

            letter-spacing: -.3px;

        }


        .top-title p {

            color:
                var(--cinza);

            font-size: 13px;

            margin-top: 3px;

        }


        /* =====================================================
           HERO QR
        ===================================================== */

        .qr-header {

            display: flex;

            justify-content: center;

            margin:
                5px
                0
                20px;

        }


        .qr-icon {

            width: 78px;

            height: 78px;

            display: flex;

            align-items: center;

            justify-content: center;

            border:
                1px solid
                var(--borda-roxa);

            border-radius: 24px;

            background:
                linear-gradient(
                    145deg,
                    rgba(166, 92, 255, .17),
                    rgba(166, 92, 255, .06)
                );

            color:
                var(--roxo-claro);

            box-shadow:
                0 12px 35px
                rgba(166, 92, 255, .10);

        }


        .qr-icon svg {

            width: 44px;

            height: 44px;

        }


        /* =====================================================
           INTRO
        ===================================================== */

        .intro {

            text-align: center;

            margin-bottom: 26px;

        }


        .intro h2 {

            font-size: 28px;

            font-weight: 600;

            margin-bottom: 9px;

        }


        .intro p {

            max-width: 520px;

            margin: auto;

            color:
                var(--cinza);

            font-size: 15px;

            line-height: 1.6;

        }


        /* =====================================================
           SCANNER CARD
        ===================================================== */

        .scanner-card {

            position: relative;

            padding: 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 28px;

            background:
                linear-gradient(
                    145deg,
                    #16131d,
                    #0b0b10
                );

            box-shadow:
                0 20px 60px
                rgba(0, 0, 0, .30);

            overflow: hidden;

        }


        /* =====================================================
           LEITOR
        ===================================================== */

        #reader {

            width: 100%;

            min-height: 330px;

            overflow: hidden;

            border-radius: 21px;

            background:
                #000;

        }


        #reader video {

            width: 100% !important;

            height: auto !important;

            object-fit: cover;

            border-radius: 20px;

        }


        /* =====================================================
           CONTROLES DA BIBLIOTECA
        ===================================================== */

        #reader__dashboard {

            padding:
                12px !important;

            background:
                #0d0d12 !important;

        }


        #reader__dashboard_section {

            color:
                var(--cinza) !important;

        }


        #reader__dashboard_section_csr button {

            background:
                var(--roxo) !important;

            color:
                white !important;

            border:
                none !important;

            border-radius:
                10px !important;

            padding:
                10px 16px !important;

            font-weight:
                600 !important;

            cursor:
                pointer !important;

        }


        #reader__dashboard_section_csr button:hover {

            background:
                var(--roxo-escuro) !important;

        }


        #reader__dashboard_section_swaplink {

            color:
                var(--roxo-claro) !important;

        }


        #reader select {

            background:
                #181820 !important;

            color:
                white !important;

            border:
                1px solid
                var(--borda) !important;

            border-radius:
                10px !important;

            padding:
                8px !important;

        }


        /* =====================================================
           MOLDURA
        ===================================================== */

        .scan-overlay {

            position: absolute;

            top: 14px;

            left: 14px;

            right: 14px;

            height: 330px;

            pointer-events: none;

            border-radius: 21px;

            z-index: 5;

        }


        .corner {

            position: absolute;

            width: 48px;

            height: 48px;

            border-color:
                var(--roxo-claro);

            border-style:
                solid;

            filter:
                drop-shadow(
                    0 0 7px
                    rgba(166, 92, 255, .7)
                );

        }


        .corner.top-left {

            top: 25px;

            left: 25px;

            border-width:
                4px 0 0 4px;

            border-radius:
                12px 0 0 0;

        }


        .corner.top-right {

            top: 25px;

            right: 25px;

            border-width:
                4px 4px 0 0;

            border-radius:
                0 12px 0 0;

        }


        .corner.bottom-left {

            bottom: 25px;

            left: 25px;

            border-width:
                0 0 4px 4px;

            border-radius:
                0 0 0 12px;

        }


        .corner.bottom-right {

            bottom: 25px;

            right: 25px;

            border-width:
                0 4px 4px 0;

            border-radius:
                0 0 12px 0;

        }


        /* =====================================================
           LINHA DO SCANNER
        ===================================================== */

        .scan-line {

            position: absolute;

            left: 13%;

            right: 13%;

            top: 50%;

            height: 2px;

            background:
                linear-gradient(
                    90deg,
                    transparent,
                    var(--roxo-claro),
                    transparent
                );

            box-shadow:
                0 0 14px
                var(--roxo);

            animation:
                scan 2.2s
                infinite
                ease-in-out;

        }


        @keyframes scan {

            0% {

                transform:
                    translateY(-95px);

                opacity: .25;

            }

            50% {

                opacity: 1;

            }

            100% {

                transform:
                    translateY(95px);

                opacity: .25;

            }

        }


        /* =====================================================
           INSTRUÇÃO
        ===================================================== */

        .instruction {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding:
                17px
                5px
                4px;

            color:
                var(--cinza);

            font-size: 13px;

        }


        .instruction-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background:
                var(--verde);

            box-shadow:
                0 0 8px
                rgba(85, 223, 145, .5);

        }


        /* =====================================================
           BOTÃO GALERIA
        ===================================================== */

        .gallery-button {

            width: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            margin-top: 18px;

            padding: 16px;

            border:
                1px solid
                var(--borda);

            border-radius: 17px;

            background:
                #15151c;

            color:
                var(--roxo-claro);

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: .25s;

        }


        .gallery-button:hover {

            border-color:
                var(--roxo);

            background:
                rgba(166, 92, 255, .10);

            transform:
                translateY(-1px);

        }


        .gallery-button svg {

            width: 21px;

            height: 21px;

        }


        /* =====================================================
           RESULTADO
        ===================================================== */

        .result {

            display: none;

            margin-top: 22px;

            padding: 22px;

            border:
                1px solid
                rgba(85, 223, 145, .30);

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    #121a17,
                    #0b0d0e
                );

        }


        .result.show {

            display: block;

            animation:
                resultAppear .3s ease;

        }


        @keyframes resultAppear {

            from {

                opacity: 0;

                transform:
                    translateY(10px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        .result-header {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 15px;

        }


        .success-icon {

            width: 44px;

            height: 44px;

            min-width: 44px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                rgba(85, 223, 145, .13);

            color:
                var(--verde);

        }


        .success-icon svg {

            width: 22px;

            height: 22px;

        }


        .result-header h3 {

            font-size: 17px;

            font-weight: 600;

        }


        .result-header p {

            color:
                var(--cinza);

            font-size: 12px;

            margin-top: 3px;

        }


        .result-content {

            padding: 15px;

            min-height: 48px;

            border:
                1px solid
                rgba(255,255,255,.05);

            border-radius: 13px;

            background:
                #08090c;

            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.5;

            word-break: break-word;

            margin-bottom: 15px;

        }


        .result-actions {

            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 10px;

        }


        .result-actions button {

            padding: 13px;

            border-radius: 12px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

        }


        .copy-button {

            background:
                #191920;

            color:
                white;

            border:
                1px solid
                var(--borda);

        }


        .copy-button:hover {

            border-color:
                var(--roxo);

            color:
                var(--roxo-claro);

        }


        .open-button {

            background:
                var(--roxo);

            color:
                white;

            border:
                none;

        }


        .open-button:hover {

            background:
                var(--roxo-escuro);

        }


        /* =====================================================
           BOTÃO NOVO SCAN
        ===================================================== */

        .new-scan-button {

            width: 100%;

            margin-top: 10px;

            padding: 12px;

            border:
                1px solid
                rgba(166, 92, 255, .25);

            border-radius: 12px;

            background:
                rgba(166, 92, 255, .07);

            color:
                var(--roxo-claro);

            font-weight: 600;

            cursor: pointer;

        }


        /* =====================================================
           DICAS
        ===================================================== */

        .tips {

            margin-top: 25px;

            padding: 21px;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0c0c10
                );

        }


        .tips-header {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 17px;

        }


        .tips-header-icon {

            width: 36px;

            height: 36px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 11px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

        }


        .tips-header-icon svg {

            width: 19px;

            height: 19px;

        }


        .tips h3 {

            font-size: 16px;

            font-weight: 600;

        }


        .tip {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            margin-bottom: 14px;

            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.5;

        }


        .tip:last-child {

            margin-bottom: 0;

        }


        .tip-number {

            width: 25px;

            height: 25px;

            min-width: 25px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                rgba(166, 92, 255, .14);

            color:
                var(--roxo-claro);

            font-size: 11px;

            font-weight: 700;

        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 25px;

            z-index: 9999;

            max-width:
                calc(100% - 30px);

            padding:
                14px
                20px;

            border:
                1px solid
                var(--roxo);

            border-radius: 14px;

            background:
                #18181f;

            color:
                white;

            text-align: center;

            opacity: 0;

            pointer-events: none;

            transform:
                translate(-50%, 80px);

            transition:
                .3s ease;

            box-shadow:
                0 10px 35px
                rgba(0,0,0,.35);

        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 600px) {

            .app {

                padding:
                    18px
                    15px
                    35px;

            }


            .top {

                margin-bottom: 22px;

            }


            .top-title h1 {

                font-size: 21px;

            }


            .qr-icon {

                width: 70px;

                height: 70px;

                border-radius: 21px;

            }


            .qr-icon svg {

                width: 39px;

                height: 39px;

            }


            .intro h2 {

                font-size: 24px;

            }


            .intro p {

                font-size: 14px;

            }


            .scanner-card {

                padding: 9px;

                border-radius: 23px;

            }


            #reader {

                min-height: 280px;

                border-radius: 18px;

            }


            .scan-overlay {

                top: 9px;

                left: 9px;

                right: 9px;

                height: 280px;

                border-radius: 18px;

            }


            .corner {

                width: 37px;

                height: 37px;

            }


            .corner.top-left {

                top: 18px;

                left: 18px;

            }


            .corner.top-right {

                top: 18px;

                right: 18px;

            }


            .corner.bottom-left {

                bottom: 18px;

                left: 18px;

            }


            .corner.bottom-right {

                bottom: 18px;

                right: 18px;

            }


            .scan-line {

                left: 12%;

                right: 12%;

            }


            .result-actions {

                grid-template-columns: 1fr;

            }

        }


        @media (max-width: 380px) {

            .intro h2 {

                font-size: 22px;

            }


            .top-title h1 {

                font-size: 19px;

            }


            .scanner-card {

                padding: 7px;

            }

        }

    </style>

</head>


<body>


    <main class="app">


        <!-- =================================================
             TOPO
        ================================================== -->

        <header class="top">

            <button
                class="back-button"
                onclick="voltarHome()"
                aria-label="Voltar para a página inicial"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >

                    <path d="M19 12H5"></path>

                    <path d="M12 19l-7-7 7-7"></path>

                </svg>

            </button>


            <div class="top-title">

                <h1>
                    Escanear QR Code
                </h1>

                <p>
                    SilentHelp
                </p>

            </div>

        </header>


        <!-- =================================================
             ÍCONE
        ================================================== -->

        <div class="qr-header">

            <div class="qr-icon">

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
                    ></rect>

                    <rect
                        x="14"
                        y="3"
                        width="7"
                        height="7"
                    ></rect>

                    <rect
                        x="3"
                        y="14"
                        width="7"
                        height="7"
                    ></rect>

                    <path d="M14 14h3v3h-3z"></path>

                    <path d="M18 18h3v3h-3z"></path>

                    <path d="M18 14v2"></path>

                    <path d="M14 18h2"></path>

                </svg>

            </div>

        </div>


        <!-- =================================================
             INTRODUÇÃO
        ================================================== -->

        <section class="intro">

            <h2>
                Escaneie um QR Code
            </h2>

            <p>
                Aponte a câmera para um QR Code
                de um local protegido pelo SilentHelp.
            </p>

        </section>


        <!-- =================================================
             SCANNER
        ================================================== -->

        <section class="scanner-card">


            <div id="reader"></div>


            <div class="scan-overlay">

                <div class="corner top-left"></div>

                <div class="corner top-right"></div>

                <div class="corner bottom-left"></div>

                <div class="corner bottom-right"></div>

                <div class="scan-line"></div>

            </div>


            <div class="instruction">

                <span class="instruction-dot"></span>

                Posicione o QR Code dentro da moldura

            </div>


        </section>


        <!-- =================================================
             GALERIA
        ================================================== -->

        <button
            class="gallery-button"
            onclick="abrirGaleria()"
        >

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
                    y="4"
                    width="18"
                    height="16"
                    rx="2"
                ></rect>

                <circle
                    cx="8.5"
                    cy="9"
                    r="1.5"
                ></circle>

                <path
                    d="M21 15l-5-5L5 20"
                ></path>

            </svg>

            Selecionar QR Code da galeria

        </button>


        <input
            type="file"
            id="qrInput"
            accept="image/*"
            hidden
        >


        <!-- =================================================
             RESULTADO
        ================================================== -->

        <section
            id="result"
            class="result"
        >

            <div class="result-header">

                <div class="success-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="M5 12l4 4L19 6"></path>

                    </svg>

                </div>


                <div>

                    <h3>
                        QR Code identificado
                    </h3>

                    <p>
                        Leitura realizada com sucesso
                    </p>

                </div>

            </div>


            <div
                id="resultContent"
                class="result-content"
            ></div>


            <div class="result-actions">

                <button
                    class="copy-button"
                    onclick="copiarResultado()"
                >

                    📋 Copiar conteúdo

                </button>


                <button
                    class="open-button"
                    onclick="abrirResultado()"
                >

                    🔗 Abrir conteúdo

                </button>

            </div>


            <button
                class="new-scan-button"
                onclick="novoScan()"
            >

                ↻ Escanear outro QR Code

            </button>

        </section>


        <!-- =================================================
             DICAS
        ================================================== -->

        <section class="tips">


            <div class="tips-header">

                <div class="tips-header-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path
                            d="M9 18h6"
                        ></path>

                        <path
                            d="M10 22h4"
                        ></path>

                        <path
                            d="M8 14c-1.2-.9-2-2.3-2-4a6 6 0 0 1 12 0c0 1.7-.8 3.1-2 4-.8.6-1 1.1-1 2H9c0-.9-.2-1.4-1-2z"
                        ></path>

                    </svg>

                </div>


                <h3>
                    Dicas para escanear
                </h3>

            </div>


            <div class="tip">

                <span class="tip-number">
                    1
                </span>

                <span>
                    Mantenha o celular estável durante a leitura.
                </span>

            </div>


            <div class="tip">

                <span class="tip-number">
                    2
                </span>

                <span>
                    Certifique-se de que o QR Code esteja bem iluminado.
                </span>

            </div>


            <div class="tip">

                <span class="tip-number">
                    3
                </span>

                <span>
                    Mantenha o QR Code completamente dentro da moldura.
                </span>

            </div>


        </section>


    </main>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div
        id="toast"
        class="toast"
        role="status"
        aria-live="polite"
    ></div>


    <script>


        /* =====================================================
           VARIÁVEIS
        ===================================================== */

        let ultimoResultado = "";

        let scanner = null;

        let scannerAtivo = false;

        let processando = false;


        /* =====================================================
           INICIAR SCANNER
        ===================================================== */

        function iniciarScanner() {

            if (scannerAtivo) {

                return;

            }


            scanner =
                new Html5Qrcode("reader");


            const larguraTela =
                window.innerWidth;


            const tamanhoQr =
                larguraTela < 600
                    ? 220
                    : 280;


            const config = {

                fps: 10,

                qrbox: {
                    width: tamanhoQr,
                    height: tamanhoQr
                },

                aspectRatio: 1,

                rememberLastUsedCamera: true

            };


            scanner
                .start(
                    {
                        facingMode:
                            "environment"
                    },
                    config,
                    onScanSuccess,
                    onScanError
                )
                .then(function() {

                    scannerAtivo = true;

                })
                .catch(function(error) {

                    console.log(
                        "Erro ao iniciar câmera:",
                        error
                    );


                    mostrarToast(
                        "Não foi possível acessar a câmera. Verifique as permissões do navegador."
                    );

                });

        }


        /* =====================================================
           SUCESSO
        ===================================================== */

        function onScanSuccess(
            decodedText
        ) {

            if (processando) {

                return;

            }


            processando = true;


            ultimoResultado =
                decodedText;


            document
                .getElementById(
                    "resultContent"
                )
                .textContent =
                decodedText;


            document
                .getElementById(
                    "result"
                )
                .classList
                .add("show");


            mostrarToast(
                "✓ QR Code identificado!"
            );


            pausarScanner();

        }


        /* =====================================================
           ERRO DE LEITURA
        ===================================================== */

        function onScanError(
            errorMessage
        ) {

            /*
                Não mostramos erros aqui.
                A biblioteca verifica vários frames
                por segundo e isso causaria mensagens
                excessivas.
            */

        }


        /* =====================================================
           PAUSAR SCANNER
        ===================================================== */

        function pausarScanner() {

            if (
                scanner &&
                scannerAtivo
            ) {

                try {

                    scanner.pause(true);

                } catch (erro) {

                    console.log(erro);

                }

            }

        }


        /* =====================================================
           NOVO SCAN
        ===================================================== */

        function novoScan() {

            ultimoResultado = "";

            processando = false;


            document
                .getElementById(
                    "result"
                )
                .classList
                .remove("show");


            if (
                scanner &&
                scannerAtivo
            ) {

                try {

                    scanner.resume();

                } catch (erro) {

                    console.log(erro);

                }

            } else {

                iniciarScanner();

            }

        }


        /* =====================================================
           GALERIA
        ===================================================== */

        function abrirGaleria() {

            document
                .getElementById(
                    "qrInput"
                )
                .click();

        }


        /* =====================================================
           QR CODE DA GALERIA
        ===================================================== */

        document
            .getElementById("qrInput")
            .addEventListener(
                "change",
                async function(event) {

                    const arquivo =
                        event.target.files[0];


                    if (!arquivo) {

                        return;

                    }


                    try {

                        mostrarToast(
                            "Lendo imagem..."
                        );


                        const scannerImagem =
                            new Html5Qrcode(
                                "reader"
                            );


                        const resultado =
                            await scannerImagem.scanFile(
                                arquivo,
                                true
                            );


                        mostrarResultado(
                            resultado
                        );


                        await scannerImagem.clear();


                    } catch (erro) {

                        console.log(erro);


                        mostrarToast(
                            "Não encontramos um QR Code nessa imagem."
                        );

                    }


                    event.target.value = "";

                }
            );


        /* =====================================================
           MOSTRAR RESULTADO
        ===================================================== */

        function mostrarResultado(
            resultado
        ) {

            ultimoResultado =
                resultado;


            document
                .getElementById(
                    "resultContent"
                )
                .textContent =
                resultado;


            document
                .getElementById(
                    "result"
                )
                .classList
                .add("show");


            processando = true;


            mostrarToast(
                "✓ QR Code identificado!"
            );

        }


        /* =====================================================
           COPIAR
        ===================================================== */

        async function copiarResultado() {

            if (!ultimoResultado) {

                mostrarToast(
                    "Nenhum conteúdo para copiar."
                );

                return;

            }


            try {

                await navigator
                    .clipboard
                    .writeText(
                        ultimoResultado
                    );


                mostrarToast(
                    "✓ Conteúdo copiado!"
                );


            } catch (erro) {

                mostrarToast(
                    "Não foi possível copiar o conteúdo."
                );

            }

        }


        /* =====================================================
           ABRIR RESULTADO
        ===================================================== */

        function abrirResultado() {

            if (!ultimoResultado) {

                mostrarToast(
                    "Nenhum conteúdo encontrado."
                );

                return;

            }


            const conteudo =
                ultimoResultado.trim();


            if (
                conteudo.startsWith(
                    "http://"
                )
                ||
                conteudo.startsWith(
                    "https://"
                )
            ) {

                window.open(
                    conteudo,
                    "_blank",
                    "noopener,noreferrer"
                );

            } else {

                mostrarToast(
                    "Este QR Code contém informações, não um link."
                );

            }

        }


        /* =====================================================
           VOLTAR
        ===================================================== */

        function voltarHome() {

            pararScanner();


            window.location.href =
                "index.php";

        }


        /* =====================================================
           PARAR SCANNER
        ===================================================== */

        async function pararScanner() {

            if (!scanner) {

                return;

            }


            try {

                if (scannerAtivo) {

                    await scanner.stop();

                    scannerAtivo = false;

                }

            } catch (erro) {

                console.log(
                    "Erro ao parar scanner:",
                    erro
                );

            }

        }


        /* =====================================================
           TOAST
        ===================================================== */

        let toastTimeout;


        function mostrarToast(
            mensagem
        ) {

            const toast =
                document.getElementById(
                    "toast"
                );


            toast.textContent =
                mensagem;


            toast.classList.add(
                "show"
            );


            clearTimeout(
                toastTimeout
            );


            toastTimeout =
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
           INICIAR QUANDO A PÁGINA CARREGAR
        ===================================================== */

        window.addEventListener(
            "load",
            function() {

                iniciarScanner();

            }
        );


        /* =====================================================
           LIMPAR CÂMERA AO SAIR
        ===================================================== */

        window.addEventListener(
            "beforeunload",
            function() {

                pararScanner();

            }
        );


    </script>


<script src="assets/db-sync.js"></script>
</body>

</html>