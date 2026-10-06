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

    <meta
        name="description"
        content="SilentHelp - Segurança e proteção"
    >

    <title>SilentHelp</title>


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

            --lilas: #c58aff;
            --lilas-claro: #d9b3ff;
            --lilas-escuro: #6e32ad;

            --branco: #ffffff;

            --fundo: #050507;

            --cinza: #aaaab3;
            --cinza-escuro: #777781;

        }


        /* =====================================================
           BODY
        ===================================================== */

        html,
        body {

            width: 100%;
            height: 100%;

        }


        body {

            min-height: 100vh;

            display: flex;

            justify-content: center;
            align-items: center;

            overflow: hidden;

            background:

                radial-gradient(
                    circle at 50% 45%,
                    rgba(197, 138, 255, 0.13),
                    transparent 30%
                ),

                radial-gradient(
                    circle at 50% 0%,
                    rgba(166, 92, 255, 0.10),
                    transparent 40%
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

        }


        /* =====================================================
           SPLASH
        ===================================================== */

        .splash {

            width: 100%;
            height: 100vh;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            position: relative;

            animation:
                splashEntrada 1.2s ease forwards;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: clamp(
                48px,
                11vw,
                82px
            );

            font-weight: 700;

            line-height: 1;

            letter-spacing: -3px;

            user-select: none;

            animation:
                logoEntrada 1.2s
                cubic-bezier(.2,.8,.2,1)
                forwards;

        }


        /* =====================================================
           SILENT
        ===================================================== */

        .silent {

            color: var(--lilas);

            text-shadow:

                0 0 10px
                rgba(197, 138, 255, .18),

                0 0 30px
                rgba(197, 138, 255, .10);

        }


        /* =====================================================
           HELP
        ===================================================== */

        .help {

            color: var(--branco);

        }


        /* =====================================================
           LINHA ABAIXO DA LOGO
        ===================================================== */

        .logo-line {

            width: 0;

            height: 2px;

            margin-top: 20px;

            border-radius: 50px;

            background:

                linear-gradient(
                    90deg,
                    transparent,
                    var(--lilas),
                    transparent
                );

            animation:
                linhaEntrada 1.2s
                ease forwards;

            animation-delay: .45s;

        }


        /* =====================================================
           SUBTÍTULO
        ===================================================== */

        .subtitle {

            margin-top: 18px;

            color: var(--cinza);

            font-size: 12px;

            font-weight: 400;

            letter-spacing: 3px;

            text-transform: uppercase;

            opacity: 0;

            animation:
                subtituloEntrada 1s
                ease forwards;

            animation-delay: .75s;

        }


        /* =====================================================
           CARREGAMENTO
        ===================================================== */

        .loading-container {

            position: absolute;

            bottom: 45px;

            left: 50%;

            transform:
                translateX(-50%);

            display: flex;

            flex-direction: column;

            align-items: center;

            gap: 12px;

            width: 150px;

        }


        /* =====================================================
           TEXTO CARREGANDO
        ===================================================== */

        .loading-text {

            color: var(--cinza-escuro);

            font-size: 11px;

            letter-spacing: 1.5px;

        }


        /* =====================================================
           BARRA
        ===================================================== */

        .loading-bar {

            width: 120px;

            height: 3px;

            overflow: hidden;

            border-radius: 50px;

            background:
                rgba(255,255,255,.08);

        }


        .loading-progress {

            width: 0%;

            height: 100%;

            border-radius: 50px;

            background:

                linear-gradient(
                    90deg,
                    var(--lilas-escuro),
                    var(--lilas)
                );

            animation:
                carregamento 2.5s
                ease-in-out
                forwards;

        }


        /* =====================================================
           PONTO DECORATIVO
        ===================================================== */

        .decoracao {

            position: absolute;

            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: var(--lilas);

            opacity: .35;

            box-shadow:

                0 0 15px
                var(--lilas);

        }


        .decoracao-1 {

            top: 25%;

            left: 20%;

        }


        .decoracao-2 {

            top: 34%;

            right: 17%;

            width: 4px;
            height: 4px;

        }


        .decoracao-3 {

            bottom: 28%;

            left: 15%;

            width: 3px;
            height: 3px;

        }


        .decoracao-4 {

            bottom: 25%;

            right: 20%;

            width: 5px;
            height: 5px;

        }


        /* =====================================================
           ANIMAÇÃO SPLASH
        ===================================================== */

        @keyframes splashEntrada {

            0% {

                opacity: 0;

            }

            100% {

                opacity: 1;

            }

        }


        /* =====================================================
           ANIMAÇÃO LOGO
        ===================================================== */

        @keyframes logoEntrada {

            0% {

                opacity: 0;

                transform:
                    translateY(15px)
                    scale(.96);

            }

            100% {

                opacity: 1;

                transform:
                    translateY(0)
                    scale(1);

            }

        }


        /* =====================================================
           ANIMAÇÃO LINHA
        ===================================================== */

        @keyframes linhaEntrada {

            0% {

                width: 0;

                opacity: 0;

            }

            100% {

                width: 170px;

                opacity: 1;

            }

        }


        /* =====================================================
           ANIMAÇÃO SUBTÍTULO
        ===================================================== */

        @keyframes subtituloEntrada {

            0% {

                opacity: 0;

                transform:
                    translateY(8px);

            }

            100% {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        /* =====================================================
           ANIMAÇÃO CARREGAMENTO
        ===================================================== */

        @keyframes carregamento {

            0% {

                width: 0%;

            }

            100% {

                width: 100%;

            }

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 600px) {

            .logo {

                font-size: 52px;

                letter-spacing: -2px;

            }


            .logo-line {

                margin-top: 17px;

            }


            .subtitle {

                font-size: 9px;

                letter-spacing: 2px;

            }


            .loading-container {

                bottom: 35px;

            }

        }


        @media (max-width: 380px) {

            .logo {

                font-size: 45px;

            }


            .subtitle {

                font-size: 8px;

                letter-spacing: 1.5px;

            }

        }


    </style>

</head>


<body>


    <!-- =====================================================
         SPLASH SCREEN
    ====================================================== -->

    <main class="splash">


        <!-- DECORAÇÕES -->

        <span class="decoracao decoracao-1"></span>

        <span class="decoracao decoracao-2"></span>

        <span class="decoracao decoracao-3"></span>

        <span class="decoracao decoracao-4"></span>


        <!-- =================================================
             LOGO
        ================================================== -->

        <div class="logo">

            <span class="silent">
                Silent
            </span>

            <span class="help">
                Help
            </span>

        </div>


        <!-- LINHA -->

        <div class="logo-line"></div>


        <!-- SUBTÍTULO -->

        <div class="subtitle">

            Segurança e proteção

        </div>


        <!-- =================================================
             CARREGAMENTO
        ================================================== -->

        <div class="loading-container">

            <span class="loading-text">

                Carregando...

            </span>


            <div class="loading-bar">

                <div
                    class="loading-progress"
                ></div>

            </div>

        </div>


    </main>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /*
         * Tempo da Splash Screen
         *
         * 2800 = 2,8 segundos
         */

        const TEMPO_SPLASH = 2800;


        /*
         * Depois da Splash,
         * abre a página inicial.
         */

        setTimeout(function () {

            window.location.href =
                "login.php";

        }, TEMPO_SPLASH);


    </script>


<script src="assets/db-sync.js"></script>
</body>

</html>