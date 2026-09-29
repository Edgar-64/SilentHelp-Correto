<?php require_once __DIR__ . '/auth.php'; exigirLogin(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Meu Diário - SilentHelp</title>

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


        button,
        input,
        textarea {
            font-family: inherit;
        }


        button {
            -webkit-tap-highlight-color: transparent;
        }


        button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {

            width: 100%;

            max-width: 850px;

            margin: 0 auto;

            padding:
                28px
                25px
                50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        header {

            position: relative;

            display: flex;

            align-items: center;

            gap: 15px;

            padding:
                24px
                25px;

            border-bottom:
                1px solid
                rgba(255, 255, 255, .06);

            background:

                radial-gradient(
                    circle at 15% 0%,
                    rgba(168, 85, 247, .16),
                    transparent 35%
                ),

                rgba(7, 6, 10, .82);

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            box-shadow:
                0 10px 40px
                rgba(0, 0, 0, .22);
        }


        .header-content {

            flex: 1;
        }


        .voltar {

            width: 45px;
            height: 45px;

            min-width: 45px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                rgba(255, 255, 255, .09);

            border-radius: 15px;

            background:
                rgba(255, 255, 255, .035);

            color:
                var(--roxo-claro);

            font-size: 24px;

            cursor: pointer;

            transition:
                transform .2s,
                background .2s,
                border-color .2s;
        }


        .voltar:hover {

            transform:
                translateX(-3px);

            background:
                rgba(168, 85, 247, .10);

            border-color:
                var(--borda-roxa);
        }


        /* =====================================================
           TÍTULO + CORAÇÃO
        ===================================================== */

        header h1 {

            display: flex;

            align-items: center;

            gap: 9px;

            font-size: 28px;

            font-weight: 700;

            letter-spacing: -.6px;

            margin-bottom: 4px;
        }


        header h1 span {
            color: var(--roxo-2);
        }


        /* =====================================================
           CORAÇÃO CONTORNADO ROXO
        ===================================================== */

        .coracao-roxo {

            width: 29px;
            height: 29px;

            display: inline-block;

            flex-shrink: 0;

            stroke: var(--roxo-2);

            stroke-width: 2.3;

            fill: none;

            stroke-linecap: round;

            stroke-linejoin: round;

            filter:
                drop-shadow(
                    0 0 6px
                    rgba(168, 85, 247, .35)
                );
        }


        .coracao-modal {

            width: 26px;
            height: 26px;

            vertical-align: middle;

            margin-right: 7px;
        }


        header p {

            color: var(--cinza);

            font-size: 14px;

            line-height: 1.5;
        }


        /* =====================================================
           NOVO REGISTRO
        ===================================================== */

        .novo-registro {

            width: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            border:
                1px solid
                rgba(168, 85, 247, .35);

            background:

                linear-gradient(
                    100deg,
                    #8f43d1,
                    #a855f7,
                    #b96dff
                );

            color: white;

            padding: 16px;

            border-radius: 15px;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            margin-bottom: 32px;

            box-shadow:
                0 10px 30px
                rgba(168, 85, 247, .18);

            transition:
                transform .2s,
                filter .2s,
                box-shadow .2s;
        }


        .novo-registro:hover {

            transform:
                translateY(-2px);

            filter:
                brightness(1.08);

            box-shadow:
                0 14px 35px
                rgba(168, 85, 247, .28);
        }


        .novo-registro:active {
            transform: scale(.98);
        }


        /* =====================================================
           TÍTULO DA LISTA
        ===================================================== */

        .titulo-lista {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 21px;

            font-weight: 600;

            letter-spacing: -.3px;

            margin-bottom: 16px;
        }


        .titulo-lista::before {

            content: "";

            width: 4px;
            height: 22px;

            border-radius: 5px;

            background:
                linear-gradient(
                    to bottom,
                    var(--roxo-2),
                    var(--roxo)
                );

            box-shadow:
                0 0 12px
                rgba(168, 85, 247, .5);
        }


        /* =====================================================
           SEM RELATOS
        ===================================================== */

        .sem-relatos {

            padding: 45px 25px;

            text-align: center;

            border:
                1px solid
                var(--borda);

            border-radius: 22px;

            background:

                linear-gradient(
                    145deg,
                    rgba(20, 18, 26, .88),
                    rgba(10, 10, 14, .92)
                );

            box-shadow:
                var(--sombra);

            color:
                var(--cinza);
        }


        .sem-relatos .icone {

            width: 70px;
            height: 70px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin:
                0 auto
                15px;

            border:
                1px solid
                rgba(168, 85, 247, .20);

            border-radius: 20px;

            background:
                rgba(168, 85, 247, .09);

            font-size: 34px;
        }


        .sem-relatos p {

            font-size: 14px;

            line-height: 1.6;
        }


        /* =====================================================
           CARD DO RELATO
        ===================================================== */

        .relato-card {

            position: relative;

            padding: 21px;

            margin-bottom: 15px;

            overflow: hidden;

            border:
                1px solid
                rgba(255, 255, 255, .075);

            border-left:
                4px solid
                var(--roxo);

            border-radius: 20px;

            background:

                radial-gradient(
                    circle at 0% 50%,
                    rgba(168, 85, 247, .10),
                    transparent 32%
                ),

                linear-gradient(
                    145deg,
                    rgba(20, 18, 26, .90),
                    rgba(10, 10, 14, .94)
                );

            box-shadow:
                0 12px 35px
                rgba(0, 0, 0, .22);

            transition:
                transform .2s,
                border-color .2s,
                box-shadow .2s;
        }


        .relato-card::after {

            content: "";

            position: absolute;

            width: 160px;
            height: 160px;

            right: -80px;
            top: -90px;

            border-radius: 50%;

            background:
                rgba(168, 85, 247, .07);

            filter: blur(20px);

            pointer-events: none;
        }


        .relato-card:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(168, 85, 247, .30);

            box-shadow:
                0 18px 45px
                rgba(0, 0, 0, .30);
        }


        .relato-topo {

            position: relative;

            z-index: 2;

            display: flex;

            justify-content: space-between;

            align-items: flex-start;

            gap: 10px;

            margin-bottom: 15px;
        }


        .relato-data {

            color:
                var(--roxo-claro);

            font-size: 12px;

            font-weight: 700;

            letter-spacing: .2px;

            margin-bottom: 5px;
        }


        .relato-pessoa {

            font-size: 18px;

            font-weight: 650;

            color:
                var(--branco);
        }


        .relato-texto {

            position: relative;

            z-index: 2;

            font-size: 14px;

            line-height: 1.7;

            color:
                var(--cinza);

            white-space: pre-wrap;

            word-break: break-word;
        }


        .relato-info {

            position: relative;

            z-index: 2;

            margin-top: 12px;

            margin-bottom: 5px;

            font-size: 13px;

            color:
                var(--cinza);
        }


        .relato-info strong {

            color:
                var(--roxo-claro);
        }


        /* =====================================================
           BOTÕES DO RELATO
        ===================================================== */

        .botoes-relato {

            position: relative;

            z-index: 2;

            display: flex;

            gap: 8px;

            margin-top: 18px;

            padding-top: 14px;

            border-top:
                1px solid
                rgba(255, 255, 255, .055);
        }


        .btn-excluir {

            border:
                1px solid
                rgba(255, 93, 115, .20);

            background:
                rgba(255, 93, 115, .07);

            color:
                #ff8293;

            padding:
                9px
                14px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: 600;

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s,
                transform .2s;
        }


        .btn-excluir:hover {

            background:
                rgba(255, 93, 115, .13);

            border-color:
                rgba(255, 93, 115, .35);

            transform:
                translateY(-1px);
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

            -webkit-backdrop-filter:
                blur(10px);

            z-index: 3000;

            overflow-y: auto;
        }


        .modal.ativo {
            display: flex;
        }


        .modal-conteudo {

            position: relative;

            width: 100%;

            max-width: 560px;

            max-height:
                calc(100vh - 40px);

            overflow-y: auto;

            padding: 29px;

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


        .modal-conteudo::-webkit-scrollbar {
            width: 5px;
        }


        .modal-conteudo::-webkit-scrollbar-thumb {

            background:
                rgba(168, 85, 247, .35);

            border-radius: 10px;
        }


        .fechar {

            position: absolute;

            right: 18px;
            top: 17px;

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid
                rgba(255, 255, 255, .08);

            border-radius: 12px;

            background:
                rgba(255, 255, 255, .035);

            color:
                var(--cinza);

            font-size: 22px;

            cursor: pointer;

            transition:
                background .2s,
                color .2s;
        }


        .fechar:hover {

            background:
                rgba(255, 255, 255, .08);

            color:
                white;
        }


        .modal-conteudo h2 {

            display: flex;

            align-items: center;

            font-size: 23px;

            font-weight: 650;

            color:
                var(--branco);

            margin-bottom: 7px;
        }


        .modal-conteudo .subtitulo {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 23px;
        }


        /* =====================================================
           FORMULÁRIO
        ===================================================== */

        .campo {

            display: flex;

            flex-direction: column;

            gap: 6px;

            margin-bottom: 15px;
        }


        .campo label {

            display: block;

            font-size: 13px;

            font-weight: 600;

            color:
                #eee;
        }


        .campo input,
        .campo textarea {

            width: 100%;

            border:
                1px solid
                rgba(255, 255, 255, .09);

            border-radius: 13px;

            outline: none;

            background:
                rgba(7, 7, 11, .72);

            color:
                white;

            padding:
                12px
                13px;

            font-size: 14px;

            transition:
                border-color .2s,
                background .2s,
                box-shadow .2s;
        }


        .campo input::placeholder,
        .campo textarea::placeholder {
            color: #686270;
        }


        .campo input:focus,
        .campo textarea:focus {

            border-color:
                rgba(168, 85, 247, .60);

            background:
                rgba(168, 85, 247, .045);

            box-shadow:
                0 0 0 3px
                rgba(168, 85, 247, .08);
        }


        .campo textarea {

            min-height: 95px;

            resize: vertical;
        }


        .campo textarea#relato {
            min-height: 125px;
        }


        /* =====================================================
           BOTÃO SALVAR
        ===================================================== */

        .btn-salvar {

            width: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 7px;

            border:
                1px solid
                rgba(168, 85, 247, .35);

            background:

                linear-gradient(
                    100deg,
                    #8f43d1,
                    #a855f7,
                    #b96dff
                );

            color:
                white;

            padding: 14px;

            border-radius: 13px;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            margin-top: 5px;

            box-shadow:
                0 10px 30px
                rgba(168, 85, 247, .18);

            transition:
                transform .2s,
                filter .2s,
                box-shadow .2s;
        }


        .btn-salvar:hover {

            transform:
                translateY(-2px);

            filter:
                brightness(1.08);

            box-shadow:
                0 14px 35px
                rgba(168, 85, 247, .30);
        }


        .btn-salvar:active {
            transform: scale(.98);
        }


        /* =====================================================
           MENSAGEM
        ===================================================== */

        .mensagem {

            position: fixed;

            left: 50%;

            bottom: 25px;

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

            color:
                white;

            font-size: 14px;

            text-align: center;

            box-shadow:
                0 15px 45px
                rgba(0, 0, 0, .45);

            backdrop-filter:
                blur(15px);

            -webkit-backdrop-filter:
                blur(15px);

            transition:
                opacity .3s,
                transform .3s;
        }


        .mensagem.mostrar {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            header {

                padding:
                    19px
                    15px;
            }


            .container {

                padding:
                    20px
                    15px
                    35px;
            }


            .voltar {

                width: 42px;
                height: 42px;

                min-width: 42px;
            }


            header h1 {
                font-size: 23px;
            }


            header p {
                font-size: 12px;
            }


            .coracao-roxo {
                width: 25px;
                height: 25px;
            }


            .novo-registro {
                padding: 15px;
            }


            .titulo-lista {
                font-size: 19px;
            }


            .relato-card {
                padding: 18px;
            }


            .relato-pessoa {
                font-size: 17px;
            }


            .modal {
                padding: 10px;
            }


            .modal-conteudo {

                padding:
                    25px
                    19px;

                border-radius: 22px;

                max-height:
                    calc(100vh - 20px);
            }
        }


        @media (max-width: 480px) {

            header {
                gap: 11px;
            }


            .voltar {

                width: 40px;
                height: 40px;

                min-width: 40px;

                font-size: 21px;
            }


            header h1 {
                font-size: 20px;
            }


            header p {
                font-size: 11px;
            }


            .coracao-roxo {
                width: 23px;
                height: 23px;
            }


            .container {
                padding-top: 17px;
            }


            .novo-registro {

                padding: 14px;

                font-size: 14px;

                border-radius: 13px;
            }


            .relato-card {
                border-radius: 17px;
            }


            .relato-data {
                font-size: 11px;
            }


            .relato-pessoa {
                font-size: 16px;
            }


            .relato-texto {
                font-size: 13px;
            }


            .relato-info {
                font-size: 12px;
            }


            .modal-conteudo h2 {
                font-size: 20px;
            }


            .coracao-modal {
                width: 23px;
                height: 23px;
            }


            .modal-conteudo .subtitulo {
                font-size: 13px;
            }


            .campo label {
                font-size: 12px;
            }


            .campo input,
            .campo textarea {
                font-size: 13px;
            }


            .mensagem {

                bottom: 18px;

                font-size: 13px;

                padding:
                    12px
                    16px;
            }
        }


        @media (max-width: 360px) {

            header h1 {
                font-size: 18px;
            }


            header p {
                font-size: 10px;
            }


            .coracao-roxo {
                width: 21px;
                height: 21px;
            }


            .container {
                padding-left: 12px;
                padding-right: 12px;
            }


            .titulo-lista {
                font-size: 17px;
            }


            .relato-card {
                padding: 15px;
            }


            .modal-conteudo {
                padding: 23px 15px;
            }
        }

    </style>

</head>


<body>


    <!-- =====================================================
         CABEÇALHO
    ===================================================== -->

    <header>

        <button
            class="voltar"
            onclick="voltarPagina()"
            aria-label="Voltar"
        >
            ←
        </button>


        <div class="header-content">

            <h1>

               

                <span>
                    Meu Diário
                </span>

            </h1>


            <p>
                Registre acontecimentos importantes de forma privada.
            </p>

        </div>

    </header>


    <!-- =====================================================
         CONTEÚDO
    ===================================================== -->

    <main class="container">


        <button
            class="novo-registro"
            onclick="abrirModal()"
        >
            ＋ Novo registro
        </button>


        <h2 class="titulo-lista">
            Meus registros
        </h2>


        <div id="listaRelatos"></div>


    </main>


    <!-- =====================================================
         MODAL NOVO REGISTRO
    ===================================================== -->

    <div
        class="modal"
        id="modal"
    >

        <div class="modal-conteudo">


            <button
                class="fechar"
                onclick="fecharModal()"
                aria-label="Fechar"
            >
                ×
            </button>


            <h2>

                <!-- CORAÇÃO CONTORNADO ROXO -->

                <svg
                    class="coracao-roxo coracao-modal"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >

                    <path
                        d="M20.84 4.61
                           a5.5 5.5 0 0 0-7.78 0
                           L12 5.67
                           l-1.06-1.06
                           a5.5 5.5 0 0 0-7.78 7.78
                           l1.06 1.06
                           L12 21.23
                           l7.78-7.78
                           1.06-1.06
                           a5.5 5.5 0 0 0 0-7.78z"
                    />

                </svg>


                Novo registro

            </h2>


            <p class="subtitulo">
                Registre as informações que deseja guardar.
            </p>


            <form id="formularioDiario">


                <!-- DATA -->

                <div class="campo">

                    <label for="data">
                        📅 Data
                    </label>

                    <input
                        type="date"
                        id="data"
                        required
                    >

                </div>


                <!-- HORÁRIO -->

                <div class="campo">

                    <label for="horario">
                        🕐 Horário
                    </label>

                    <input
                        type="time"
                        id="horario"
                        required
                    >

                </div>


                <!-- PESSOA -->

                <div class="campo">

                    <label for="pessoa">
                        👤 Pessoa envolvida
                    </label>

                    <input
                        type="text"
                        id="pessoa"
                        placeholder="Digite o nome ou identificação"
                    >

                </div>


                <!-- LOCAL -->

                <div class="campo">

                    <label for="local">
                        📍 Local
                    </label>

                    <input
                        type="text"
                        id="local"
                        placeholder="Onde aconteceu?"
                    >

                </div>


                <!-- RELATO -->

                <div class="campo">

                    <label for="relato">
                        📝 Relato
                    </label>

                    <textarea
                        id="relato"
                        placeholder="Escreva o que aconteceu..."
                        required
                    ></textarea>

                </div>


                <!-- OBSERVAÇÕES -->

                <div class="campo">

                    <label for="observacoes">
                        💬 Observações
                    </label>

                    <textarea
                        id="observacoes"
                        placeholder="Adicione alguma observação..."
                    ></textarea>

                </div>


                <!-- SALVAR -->

                <button
                    type="submit"
                    class="btn-salvar"
                >
                    💾 Salvar relato
                </button>


            </form>

        </div>

    </div>


    <!-- =====================================================
         MENSAGEM
    ===================================================== -->

    <div
        class="mensagem"
        id="mensagem"
    >
        Relato salvo com sucesso!
    </div>


    <!-- =====================================================
         JAVASCRIPT
    ===================================================== -->

    <script>


        /* =====================================================
           CONFIGURAÇÃO DO STORAGE
        ===================================================== */

        const CHAVE_STORAGE = "silenthelp_relatos";


        /* =====================================================
           ELEMENTOS
        ===================================================== */

        const modal =
            document.getElementById("modal");

        const formulario =
            document.getElementById("formularioDiario");

        const listaRelatos =
            document.getElementById("listaRelatos");

        const mensagem =
            document.getElementById("mensagem");


        /* =====================================================
           ABRIR MODAL
        ===================================================== */

        function abrirModal() {

            modal.classList.add("ativo");

            document.body.style.overflow = "hidden";

            preencherDataHora();

            setTimeout(() => {

                document.getElementById("pessoa").focus();

            }, 100);

        }


        /* =====================================================
           FECHAR MODAL
        ===================================================== */

        function fecharModal() {

            modal.classList.remove("ativo");

            document.body.style.overflow = "";

        }


        /* =====================================================
           DATA E HORÁRIO AUTOMÁTICOS
        ===================================================== */

        function preencherDataHora() {

            const agora = new Date();


            const ano =
                agora.getFullYear();


            const mes =
                String(
                    agora.getMonth() + 1
                ).padStart(2, "0");


            const dia =
                String(
                    agora.getDate()
                ).padStart(2, "0");


            const hora =
                String(
                    agora.getHours()
                ).padStart(2, "0");


            const minuto =
                String(
                    agora.getMinutes()
                ).padStart(2, "0");


            document.getElementById("data").value =
                `${ano}-${mes}-${dia}`;


            document.getElementById("horario").value =
                `${hora}:${minuto}`;

        }


        /* =====================================================
           OBTER RELATOS
        ===================================================== */

        function obterRelatos() {

            const dados =
                localStorage.getItem(
                    CHAVE_STORAGE
                );


            if (!dados) {
                return [];
            }


            try {

                const relatos =
                    JSON.parse(dados);


                return Array.isArray(relatos)
                    ? relatos
                    : [];


            } catch (erro) {

                console.error(
                    "Erro ao ler relatos:",
                    erro
                );

                return [];

            }

        }


        /* =====================================================
           SALVAR RELATOS
        ===================================================== */

        function salvarRelatos(relatos) {

            localStorage.setItem(
                CHAVE_STORAGE,
                JSON.stringify(relatos)
            );

        }


        /* =====================================================
           SALVAR NOVO RELATO
        ===================================================== */

        formulario.addEventListener(
            "submit",
            function(event) {

                event.preventDefault();


                const data =
                    document
                    .getElementById("data")
                    .value;


                const horario =
                    document
                    .getElementById("horario")
                    .value;


                const pessoa =
                    document
                    .getElementById("pessoa")
                    .value
                    .trim();


                const local =
                    document
                    .getElementById("local")
                    .value
                    .trim();


                const relato =
                    document
                    .getElementById("relato")
                    .value
                    .trim();


                const observacoes =
                    document
                    .getElementById("observacoes")
                    .value
                    .trim();


                if (!relato) {

                    mostrarMensagem(
                        "Digite o relato antes de salvar."
                    );

                    return;

                }


                const novoRelato = {

                    id: Date.now(),

                    data: data,

                    horario: horario,

                    pessoa: pessoa,

                    local: local,

                    relato: relato,

                    observacoes: observacoes

                };


                const relatos =
                    obterRelatos();


                relatos.push(
                    novoRelato
                );


                salvarRelatos(
                    relatos
                );

                if (window.SilentHelpAPI) {
                    window.SilentHelpAPI.post("save_diary", novoRelato);
                }


                formulario.reset();


                fecharModal();


                mostrarRelatos();


                mostrarMensagem(
                    "Relato salvo com sucesso!"
                );

            }
        );


        /* =====================================================
           MOSTRAR RELATOS
        ===================================================== */

        function mostrarRelatos() {

            const relatos =
                obterRelatos();


            if (relatos.length === 0) {

                listaRelatos.innerHTML = `

                    <div class="sem-relatos">

                        <div class="icone">
                            📖
                        </div>

                        <p>
                            Você ainda não possui registros.
                        </p>

                        <p style="margin-top: 6px;">
                            Clique em "Novo registro" para adicionar um.
                        </p>

                    </div>

                `;

                return;

            }


            relatos.sort(
                (a, b) =>
                    Number(b.id) -
                    Number(a.id)
            );


            listaRelatos.innerHTML = "";


            relatos.forEach(
                function(item) {


                    const card =
                        document.createElement(
                            "div"
                        );


                    card.className =
                        "relato-card";


                    let dataFormatada =
                        item.data || "";


                    if (item.data) {

                        const partes =
                            item.data.split("-");


                        if (partes.length === 3) {

                            dataFormatada =
                                `${partes[2]}/${partes[1]}/${partes[0]}`;

                        }

                    }


                    card.innerHTML = `

                        <div class="relato-topo">

                            <div>

                                <div class="relato-data">

                                    📅 ${escaparHTML(dataFormatada)}

                                    ${
                                        item.horario
                                            ? " • " +
                                              escaparHTML(item.horario)
                                            : ""
                                    }

                                </div>


                                <div class="relato-pessoa">

                                    ${escaparHTML(
                                        item.pessoa ||
                                        "Sem pessoa informada"
                                    )}

                                </div>

                            </div>

                        </div>


                        ${
                            item.local
                                ?
                                `
                                <div class="relato-info">

                                    📍 <strong>Local:</strong>

                                    ${escaparHTML(
                                        item.local
                                    )}

                                </div>
                                `
                                :
                                ""
                        }


                        <div class="relato-info">

                            📝 <strong>Relato:</strong>

                        </div>


                        <div class="relato-texto">

                            ${escaparHTML(
                                item.relato
                            )}

                        </div>


                        ${
                            item.observacoes
                                ?
                                `
                                <div class="relato-info">

                                    💬 <strong>Observações:</strong>

                                </div>

                                <div class="relato-texto">

                                    ${escaparHTML(
                                        item.observacoes
                                    )}

                                </div>
                                `
                                :
                                ""
                        }


                        <div class="botoes-relato">

                            <button
                                class="btn-excluir"
                                onclick="excluirRelato(${Number(item.id)})"
                            >

                                🗑 Excluir

                            </button>

                        </div>

                    `;


                    listaRelatos.appendChild(
                        card
                    );

                }
            );

        }


        /* =====================================================
           EXCLUIR RELATO
        ===================================================== */

        function excluirRelato(id) {

            const confirmar =
                confirm(
                    "Deseja realmente excluir este relato?"
                );


            if (!confirmar) {
                return;
            }


            let relatos =
                obterRelatos();


            relatos =
                relatos.filter(
                    item =>
                        Number(item.id) !==
                        Number(id)
                );


            salvarRelatos(
                relatos
            );

            if (window.SilentHelpAPI) {
                window.SilentHelpAPI.post("delete_diary", {id: id});
            }


            mostrarRelatos();


            mostrarMensagem(
                "Relato excluído."
            );

        }


        /* =====================================================
           PROTEGER HTML
        ===================================================== */

        function escaparHTML(texto) {

            return String(texto)

                .replace(
                    /&/g,
                    "&amp;"
                )

                .replace(
                    /</g,
                    "&lt;"
                )

                .replace(
                    />/g,
                    "&gt;"
                )

                .replace(
                    /"/g,
                    "&quot;"
                )

                .replace(
                    /'/g,
                    "&#039;"
                );

        }


        /* =====================================================
           MENSAGEM
        ===================================================== */

        function mostrarMensagem(texto) {

            mensagem.textContent =
                texto;


            mensagem.classList.add(
                "mostrar"
            );


            setTimeout(
                function() {

                    mensagem.classList.remove(
                        "mostrar"
                    );

                },
                2500
            );

        }


        /* =====================================================
           VOLTAR
        ===================================================== */

        function voltarPagina() {

            if (
                document.referrer &&
                history.length > 1
            ) {

                history.back();

            } else {

                window.location.href =
                    "index.php";

            }

        }


        /* =====================================================
           FECHAR CLICANDO FORA
        ===================================================== */

        modal.addEventListener(
            "click",
            function(event) {

                if (
                    event.target === modal
                ) {

                    fecharModal();

                }

            }
        );


        /* =====================================================
           ESC FECHA MODAL
        ===================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (
                    event.key === "Escape" &&
                    modal.classList.contains("ativo")
                ) {

                    fecharModal();

                }

            }
        );


        /* =====================================================
           CARREGAR RELATOS
        ===================================================== */

        document.addEventListener(
            "DOMContentLoaded",
            function() {

                mostrarRelatos();

            }
        );

    </script>

<script src="assets/db-sync.js"></script>
</body>

</html>