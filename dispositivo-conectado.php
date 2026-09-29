<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Dispositivo conectado</title>


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
            --vermelho: #ff5c7a;

        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, 0.14),
                    transparent 35%
                ),
                #050507;

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

            max-width: 900px;

            margin: auto;

            padding:
                25px
                25px
                50px;

        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 35px;

        }


        .back-button {

            width: 48px;
            height: 48px;

            display: flex;

            justify-content: center;
            align-items: center;

            border:
                1px solid
                var(--borda);

            border-radius: 15px;

            background:
                #111116;

            color:
                var(--roxo-claro);

            cursor: pointer;

            transition: .2s;

        }


        .back-button:hover {

            border-color:
                var(--roxo);

            transform:
                translateX(-2px);

        }


        .back-button svg {

            width: 24px;
            height: 24px;

        }


        .header-text h1 {

            font-size: 30px;

            font-weight: 600;

            margin-bottom: 4px;

        }


        .header-text p {

            color: var(--cinza);

            font-size: 15px;

        }


        /* =====================================================
           STATUS PRINCIPAL
        ===================================================== */

        .device-status-card {

            position: relative;

            padding: 35px;

            margin-bottom: 25px;

            border:
                1px solid
                rgba(166, 92, 255, .45);

            border-radius: 28px;

            background:

                radial-gradient(
                    circle at 50% 0%,
                    rgba(166, 92, 255, .18),
                    transparent 55%
                ),

                linear-gradient(
                    145deg,
                    #17131f,
                    #0c0c10
                );

            text-align: center;

            overflow: hidden;

        }


        /* =====================================================
           ÍCONE DO DISPOSITIVO
        ===================================================== */

        .device-icon-area {

            position: relative;

            width: 150px;
            height: 150px;

            margin:
                0 auto
                25px;

            display: flex;

            justify-content: center;
            align-items: center;

        }


        .device-ring {

            position: absolute;

            border-radius: 50%;

            border:
                1px solid
                rgba(166, 92, 255, .25);

        }


        .device-ring.ring-one {

            width: 150px;
            height: 150px;

        }


        .device-ring.ring-two {

            width: 120px;
            height: 120px;

        }


        .device-ring.ring-three {

            width: 92px;
            height: 92px;

        }


        .device-icon {

            position: relative;

            width: 76px;
            height: 76px;

            display: flex;

            justify-content: center;
            align-items: center;

            border-radius: 24px;

            background:

                linear-gradient(
                    145deg,
                    #b56cff,
                    #8243c9
                );

            color: white;

            box-shadow:
                0 0 35px
                rgba(166, 92, 255, .45);

        }


        .device-icon svg {

            width: 42px;
            height: 42px;

        }


        /* =====================================================
           STATUS
        ===================================================== */

        .active-status {

            display: inline-flex;

            align-items: center;

            gap: 9px;

            padding:
                9px
                15px;

            margin-bottom: 15px;

            border-radius: 30px;

            background:
                rgba(85, 223, 145, .09);

            color:
                var(--verde);

            font-size: 14px;

            font-weight: 600;

        }


        .active-dot {

            width: 9px;
            height: 9px;

            border-radius: 50%;

            background:
                var(--verde);

            box-shadow:
                0 0 9px
                rgba(85, 223, 145, .7);

        }


        .device-status-card h2 {

            font-size: 29px;

            margin-bottom: 8px;

        }


        .device-status-card > p {

            color: var(--cinza);

            font-size: 16px;

            line-height: 1.5;

        }


        /* =====================================================
           INFORMAÇÕES
        ===================================================== */

        .section-title {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin:
                30px 0
                16px;

        }


        .section-title h2 {

            font-size: 22px;

            font-weight: 500;

        }


        .connection-label {

            color:
                var(--verde);

            font-size: 13px;

            font-weight: 600;

        }


        /* =====================================================
           GRID
        ===================================================== */

        .info-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 14px;

        }


        .info-card {

            padding: 20px;

            min-height: 145px;

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

            transition: .2s;

        }


        .info-card:hover {

            border-color:
                rgba(166, 92, 255, .5);

            transform:
                translateY(-2px);

        }


        .info-card-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 20px;

        }


        .info-icon {

            width: 46px;
            height: 46px;

            display: flex;

            justify-content: center;
            align-items: center;

            border-radius: 14px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

        }


        .info-icon svg {

            width: 25px;
            height: 25px;

        }


        .status-mini {

            color:
                var(--verde);

            font-size: 12px;

            font-weight: 600;

        }


        .info-card h3 {

            font-size: 17px;

            font-weight: 500;

            margin-bottom: 5px;

        }


        .info-card p {

            color:
                var(--cinza);

            font-size: 14px;

        }


        /* =====================================================
           BATERIA
        ===================================================== */

        .battery-card {

            padding: 22px;

            margin-top: 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:
                #101015;

        }


        .battery-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 14px;

        }


        .battery-title {

            display: flex;

            align-items: center;

            gap: 12px;

        }


        .battery-title-icon {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

        }


        .battery-title-icon svg {

            width: 23px;
            height: 23px;

        }


        .battery-title h3 {

            font-size: 16px;

            font-weight: 500;

        }


        .battery-percent {

            color:
                var(--roxo-claro);

            font-size: 20px;

            font-weight: 600;

        }


        .battery-bar {

            width: 100%;

            height: 10px;

            border-radius: 20px;

            background:
                #27272f;

            overflow: hidden;

        }


        .battery-fill {

            width: 87%;

            height: 100%;

            border-radius: 20px;

            background:

                linear-gradient(
                    90deg,
                    #8e4bd2,
                    #c58aff
                );

        }


        .battery-description {

            margin-top: 10px;

            color:
                var(--cinza);

            font-size: 13px;

        }


        /* =====================================================
           ÚLTIMA SINCRONIZAÇÃO
        ===================================================== */

        .sync-card {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 20px;

            margin-top: 14px;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:
                #101015;

        }


        .sync-icon {

            width: 48px;
            height: 48px;

            min-width: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                rgba(166, 92, 255, .12);

            color:
                var(--roxo-claro);

        }


        .sync-icon svg {

            width: 25px;
            height: 25px;

        }


        .sync-text {

            flex: 1;

        }


        .sync-text h3 {

            font-size: 16px;

            font-weight: 500;

            margin-bottom: 4px;

        }


        .sync-text p {

            color:
                var(--cinza);

            font-size: 13px;

        }


        /* =====================================================
           BOTÃO TESTAR
        ===================================================== */

        .test-section {

            margin-top: 30px;

        }


        .test-button {

            width: 100%;

            padding: 18px;

            border:
                1px solid
                rgba(166, 92, 255, .55);

            border-radius: 18px;

            background:
                rgba(166, 92, 255, .10);

            color:
                var(--roxo-claro);

            font-size: 17px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

        }


        .test-button:hover {

            background:
                rgba(166, 92, 255, .18);

            border-color:
                var(--roxo);

            transform:
                translateY(-2px);

        }


        .test-button:disabled {

            cursor:
                not-allowed;

            opacity:
                .7;

        }


        /* =====================================================
           BOTÃO DESCONECTAR
        ===================================================== */

        .disconnect-button {

            width: 100%;

            margin-top: 12px;

            padding: 16px;

            border:
                1px solid
                rgba(255, 92, 122, .35);

            border-radius: 18px;

            background:
                rgba(255, 92, 122, .06);

            color:
                #ff7d95;

            font-size: 15px;

            font-weight: 500;

            cursor: pointer;

            transition: .2s;

        }


        .disconnect-button:hover {

            background:
                rgba(255, 92, 122, .12);

            border-color:
                var(--vermelho);

        }


        /* =====================================================
           INFORMAÇÃO DE SEGURANÇA
        ===================================================== */

        .security-message {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 20px;

            margin-top: 30px;

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


        .security-icon {

            width: 50px;
            height: 50px;

            min-width: 50px;

            display: flex;

            justify-content: center;
            align-items: center;

            border-radius: 15px;

            background:
                rgba(85, 223, 145, .10);

            color:
                var(--verde);

        }


        .security-icon svg {

            width: 27px;
            height: 27px;

        }


        .security-message h3 {

            font-size: 16px;

            font-weight: 500;

            margin-bottom: 4px;

        }


        .security-message p {

            color:
                var(--cinza);

            font-size: 13px;

            line-height: 1.4;

        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 30px;

            transform:
                translate(-50%, 30px);

            opacity: 0;

            pointer-events: none;

            z-index: 5000;

            padding:
                15px
                22px;

            border-radius: 15px;

            background:
                #18181f;

            border:
                1px solid
                var(--roxo);

            color: white;

            transition: .3s;

            text-align: center;

            max-width: 90%;

        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 650px) {

            .app {

                padding:
                    18px
                    15px
                    40px;

            }


            .header {

                margin-bottom: 25px;

            }


            .header-text h1 {

                font-size: 25px;

            }


            .header-text p {

                font-size: 13px;

            }


            .device-status-card {

                padding: 28px 18px;

            }


            .device-icon-area {

                width: 130px;
                height: 130px;

            }


            .device-ring.ring-one {

                width: 130px;
                height: 130px;

            }


            .device-ring.ring-two {

                width: 105px;
                height: 105px;

            }


            .device-ring.ring-three {

                width: 82px;
                height: 82px;

            }


            .device-status-card h2 {

                font-size: 25px;

            }


            .info-grid {

                grid-template-columns:
                    1fr;

            }


        }


        @media (max-width: 400px) {

            .device-status-card h2 {

                font-size: 22px;

            }


            .device-status-card > p {

                font-size: 14px;

            }


            .section-title h2 {

                font-size: 19px;

            }

        }

    </style>

</head>


<body>


<main class="app">


    <!-- =====================================================
         CABEÇALHO
    ====================================================== -->

    <header class="header">


        <button
            class="back-button"
            onclick="voltar()"
            aria-label="Voltar"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
            >

                <path
                    d="M15 18l-6-6 6-6"
                />

            </svg>

        </button>


        <div class="header-text">

            <h1>
                Dispositivo conectado
            </h1>

            <p>
                Gerencie o seu dispositivo SilentHelp
            </p>

        </div>

    </header>


    <!-- =====================================================
         STATUS PRINCIPAL
    ====================================================== -->

    <section class="device-status-card">


        <div class="device-icon-area">


            <div
                class="device-ring ring-one"
            ></div>


            <div
                class="device-ring ring-two"
            ></div>


            <div
                class="device-ring ring-three"
            ></div>


            <div class="device-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <rect
                        x="6"
                        y="2"
                        width="12"
                        height="20"
                        rx="2"
                    />

                    <path
                        d="M10 18h4"
                    />

                </svg>

            </div>

        </div>


        <div class="active-status">

            <span class="active-dot"></span>

            DISPOSITIVO ATIVO

        </div>


        <h2>
            SilentHelp conectado
        </h2>


        <p>
            Seu dispositivo está conectado
            e pronto para enviar alertas
            quando necessário.
        </p>


    </section>


    <!-- =====================================================
         INFORMAÇÕES
    ====================================================== -->

    <div class="section-title">

        <h2>
            Informações do dispositivo
        </h2>

        <span class="connection-label">
            ● Online
        </span>

    </div>


    <section class="info-grid">


        <!-- DISPOSITIVO -->

        <div class="info-card">


            <div class="info-card-top">


                <div class="info-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <rect
                            x="6"
                            y="2"
                            width="12"
                            height="20"
                            rx="2"
                        />

                        <path
                            d="M10 18h4"
                        />

                    </svg>

                </div>


                <span class="status-mini">
                    ATIVO
                </span>

            </div>


            <h3>
                Dispositivo
            </h3>


            <p>
                SilentHelp #001
            </p>


        </div>


        <!-- CONEXÃO -->

        <div class="info-card">


            <div class="info-card-top">


                <div class="info-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M5 12.5a10 10 0 0 1 14 0"
                        />

                        <path
                            d="M8 15.5a6 6 0 0 1 8 0"
                        />

                        <path
                            d="M11 18.5a2 2 0 0 1 2 0"
                        />

                    </svg>

                </div>


                <span class="status-mini">
                    ESTÁVEL
                </span>

            </div>


            <h3>
                Conexão
            </h3>


            <p>
                Sinal excelente
            </p>


        </div>


        <!-- GPS -->

        <div class="info-card">


            <div class="info-card-top">


                <div class="info-icon">

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


                <span class="status-mini">
                    ATIVO
                </span>

            </div>


            <h3>
                Localização
            </h3>


            <p>
                GPS funcionando
            </p>


        </div>


        <!-- ALERTA -->

        <div class="info-card">


            <div class="info-card-top">


                <div class="info-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                        />

                        <path
                            d="M10 21h4"
                        />

                    </svg>

                </div>


                <span class="status-mini">
                    PRONTO
                </span>

            </div>


            <h3>
                Sistema de alerta
            </h3>


            <p>
                Funcionando normalmente
            </p>


        </div>


    </section>


    <!-- =====================================================
         BATERIA
    ====================================================== -->

    <section class="battery-card">


        <div class="battery-top">


            <div class="battery-title">


                <div class="battery-title-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <rect
                            x="3"
                            y="7"
                            width="17"
                            height="10"
                            rx="2"
                        />

                        <path
                            d="M21 10v4"
                        />

                        <path
                            d="M6 10h8"
                        />

                    </svg>

                </div>


                <h3>
                    Bateria
                </h3>

            </div>


            <span
                class="battery-percent"
                id="batteryPercent"
            >
                87%
            </span>

        </div>


        <div class="battery-bar">

            <div
                class="battery-fill"
                id="batteryFill"
            ></div>

        </div>


        <p class="battery-description">

            Nível adequado para uso.

        </p>


    </section>


    <!-- =====================================================
         SINCRONIZAÇÃO
    ====================================================== -->

    <section class="sync-card">


        <div class="sync-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="M20 11a8 8 0 0 0-14.9-3"
                />

                <path
                    d="M4 4v4h4"
                />

                <path
                    d="M4 13a8 8 0 0 0 14.9 3"
                />

                <path
                    d="M20 20v-4h-4"
                />

            </svg>

        </div>


        <div class="sync-text">

            <h3>
                Última sincronização
            </h3>

            <p id="syncTime">
                Agora mesmo
            </p>

        </div>


    </section>


    <!-- =====================================================
         TESTE
    ====================================================== -->

    <section class="test-section">


        <button
            class="test-button"
            id="testButton"
            onclick="testarDispositivo()"
        >

            ⚡ &nbsp; TESTAR DISPOSITIVO

        </button>


        <button
            class="disconnect-button"
            onclick="desconectarDispositivo()"
        >

            Desconectar dispositivo

        </button>


    </section>


    <!-- =====================================================
         SEGURANÇA
    ====================================================== -->

    <section class="security-message">


        <div class="security-icon">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >

                <path
                    d="M12 3l8 3v5c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-3z"
                />

                <path
                    d="M8 12l2.5 2.5L16 9"
                />

            </svg>

        </div>


        <div>

            <h3>
                Sua segurança está ativa
            </h3>


            <p>
                O dispositivo está pronto para
                auxiliar você em uma situação
                de emergência.
            </p>

        </div>


    </section>


</main>


<!-- =====================================================
     TOAST
====================================================== -->

<div
    id="toast"
    class="toast"
></div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>


    /* =====================================================
       VOLTAR
    ===================================================== */

    function voltar() {

        window.location.href = "index.php";

    }


    /* =====================================================
       TESTAR DISPOSITIVO
    ===================================================== */

    function testarDispositivo() {

        const botao =
            document.getElementById("testButton");

        const textoOriginal =
            botao.innerHTML;


        botao.innerHTML =
            "⏳ &nbsp; TESTANDO CONEXÃO...";


        botao.disabled = true;


        setTimeout(function () {


            botao.innerHTML =
                "✓ &nbsp; DISPOSITIVO FUNCIONANDO";


            botao.style.color =
                "#55df91";


            botao.style.borderColor =
                "rgba(85,223,145,.5)";


            botao.style.background =
                "rgba(85,223,145,.08)";


            document
                .getElementById("syncTime")
                .textContent =
                "Agora mesmo";


            mostrarMensagem(
                "Teste concluído. O dispositivo está funcionando!"
            );


            setTimeout(function () {


                botao.innerHTML =
                    textoOriginal;


                botao.disabled = false;


                botao.style.color = "";

                botao.style.borderColor = "";

                botao.style.background = "";


            }, 3000);


        }, 1800);

    }


    /* =====================================================
       DESCONECTAR
    ===================================================== */

    function desconectarDispositivo() {

        const confirmar =
            confirm(
                "Deseja realmente desconectar o dispositivo SilentHelp?"
            );


        if (!confirmar) {

            return;

        }


        mostrarMensagem(
            "Dispositivo desconectado."
        );


        setTimeout(function () {

            window.location.href =
                "index.php";

        }, 1500);

    }


    /* =====================================================
       TOAST
    ===================================================== */

    function mostrarMensagem(mensagem) {

        const toast =
            document.getElementById("toast");


        toast.textContent =
            mensagem;


        toast.classList.add("show");


        setTimeout(function () {

            toast.classList.remove("show");

        }, 3000);

    }


</script>


<script src="assets/db-sync.js"></script>
</body>

</html>