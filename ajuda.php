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
        content="SilentHelp - Ajuda e suporte"
    >

    <title>SilentHelp - Ajuda e suporte</title>

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
            --roxo-escuro: #6e32ad;
            --fundo: #050507;
            --fundo-card: #101015;
            --fundo-card-2: #15151c;
            --borda: #292933;
            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;
            --verde: #55df91;
            --vermelho: #ff657a;
        }

        /* =====================================================
           BODY
        ===================================================== */

        body {
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 50% -10%,
                    rgba(166, 92, 255, .15),
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

        button,
        textarea {
            font-family: inherit;
        }

        /* =====================================================
           APP
        ===================================================== */

        .app {
            width: 100%;
            max-width: 900px;
            margin: auto;
            padding: 25px;
        }

        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .back-button {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid var(--borda);
            border-radius: 15px;

            background: var(--fundo-card);
            color: var(--roxo-claro);

            cursor: pointer;
            transition: .2s;
        }

        .back-button:hover {
            border-color: var(--roxo);
            background: #18131f;
            transform: translateX(-2px);
        }

        .back-button:active {
            transform: scale(.95);
        }

        .back-button svg {
            width: 24px;
            height: 24px;
        }

        .header-title {
            font-size: 25px;
            font-weight: 600;
            text-align: center;
        }

        .header-space {
            width: 48px;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .help-hero {
            padding: 30px 25px;
            margin-bottom: 28px;

            text-align: center;

            border: 1px solid rgba(166, 92, 255, .35);
            border-radius: 28px;

            background:
                radial-gradient(
                    circle at 50% 0%,
                    rgba(166, 92, 255, .18),
                    transparent 60%
                ),
                linear-gradient(
                    145deg,
                    #15111c,
                    #0c0c10
                );
        }

        .help-icon {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 22px;

            background: rgba(166, 92, 255, .15);
            color: var(--roxo-claro);

            font-size: 38px;

            box-shadow:
                0 0 30px
                rgba(166, 92, 255, .12);
        }

        .help-hero h2 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .help-hero p {
            color: var(--cinza);
            font-size: 14px;
            line-height: 1.6;

            max-width: 600px;
            margin: auto;
        }

        /* =====================================================
           TÍTULO
        ===================================================== */

        .section-title {
            font-size: 21px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        /* =====================================================
           LISTA
        ===================================================== */

        .help-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 28px;
        }

        /* =====================================================
           ITEM DE AJUDA
        ===================================================== */

        .help-card {
            width: 100%;
            min-height: 82px;

            display: flex;
            align-items: center;

            gap: 15px;
            padding: 16px 18px;

            border: 1px solid var(--borda);
            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0c0c10
                );

            color: var(--branco);
            text-align: left;

            cursor: pointer;

            transition:
                transform .2s,
                border-color .2s,
                background .2s;
        }

        .help-card:hover {
            border-color: rgba(166, 92, 255, .45);

            background:
                linear-gradient(
                    145deg,
                    #15111c,
                    #0c0c10
                );

            transform: translateY(-1px);
        }

        .help-card:active {
            transform: scale(.99);
        }

        /* =====================================================
           ÍCONE
        ===================================================== */

        .help-card-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: rgba(166, 92, 255, .12);
            color: var(--roxo-claro);
        }

        .help-card-icon svg {
            width: 25px;
            height: 25px;
        }

        /* =====================================================
           CONTEÚDO
        ===================================================== */

        .help-card-content {
            flex: 1;
        }

        .help-card-content h3 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .help-card-content p {
            color: var(--cinza);
            font-size: 13px;
            line-height: 1.4;
        }

        .help-arrow {
            color: var(--cinza-escuro);
            font-size: 27px;

            transition:
                transform .2s;
        }

        .help-card.open .help-arrow {
            transform: rotate(90deg);
            color: var(--roxo-claro);
        }

        /* =====================================================
           RESPOSTA
        ===================================================== */

        .answer-box {
            display: none;

            margin-top: -10px;
            padding: 20px;

            border:
                1px solid
                rgba(166, 92, 255, .25);

            border-radius:
                0 0 18px 18px;

            background:
                rgba(166, 92, 255, .05);

            color: var(--cinza);

            font-size: 14px;
            line-height: 1.7;

            animation:
                aparecer .2s ease;
        }

        .answer-box.show {
            display: block;
        }

        .answer-box strong {
            display: block;

            color: var(--branco);

            font-size: 15px;
            margin-bottom: 8px;
        }

        .answer-box b {
            color: var(--branco);
        }

        @keyframes aparecer {

            from {
                opacity: 0;

                transform:
                    translateY(-5px);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0);
            }
        }

        /* =====================================================
           SUPORTE
        ===================================================== */

        .support-card {
            padding: 22px;
            margin-bottom: 25px;

            border:
                1px solid
                rgba(166, 92, 255, .30);

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(166, 92, 255, .10),
                    rgba(166, 92, 255, .04)
                );
        }

        .support-card h3 {
            font-size: 18px;
            margin-bottom: 7px;
        }

        .support-card p {
            color: var(--cinza);
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        /* =====================================================
           BOTÃO SUPORTE
        ===================================================== */

        .support-button {
            width: 100%;

            padding: 14px 18px;

            border: none;
            border-radius: 15px;

            background: var(--roxo);
            color: white;

            font-size: 14px;
            font-weight: 600;

            cursor: pointer;
            transition: .2s;
        }

        .support-button:hover {
            background: var(--roxo-escuro);
            transform: translateY(-1px);
        }

        .support-button:active {
            transform: scale(.98);
        }

        /* =====================================================
           FORMULÁRIO DE SUPORTE
        ===================================================== */

        .support-form {
            display: none;

            margin-top: 18px;
            padding: 18px;

            border:
                1px solid
                rgba(166, 92, 255, .25);

            border-radius: 18px;

            background:
                rgba(5, 5, 7, .55);

            animation:
                aparecer .25s ease;
        }

        .support-form.show {
            display: block;
        }

        .support-form label {
            display: block;

            margin-bottom: 8px;

            color: var(--branco);

            font-size: 13px;
            font-weight: 500;
        }

        .support-form textarea {
            width: 100%;
            min-height: 130px;

            padding: 14px;

            resize: vertical;

            border:
                1px solid
                var(--borda);

            border-radius: 14px;

            outline: none;

            background: #0b0b10;
            color: var(--branco);

            font-size: 14px;
            line-height: 1.5;

            transition:
                border-color .2s,
                box-shadow .2s;
        }

        .support-form textarea::placeholder {
            color: var(--cinza-escuro);
        }

        .support-form textarea:focus {
            border-color: var(--roxo);

            box-shadow:
                0 0 0 3px
                rgba(166, 92, 255, .10);
        }

        /* =====================================================
           AÇÕES DO FORMULÁRIO
        ===================================================== */

        .support-actions {
            display: flex;
            gap: 10px;
            margin-top: 12px;
        }

        .support-send,
        .support-cancel {
            flex: 1;

            padding: 13px 15px;

            border-radius: 13px;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;
            transition: .2s;
        }

        .support-send {
            border: none;

            background:
                var(--roxo);

            color: white;
        }

        .support-send:hover {
            background:
                var(--roxo-escuro);

            transform:
                translateY(-1px);
        }

        .support-cancel {
            border:
                1px solid
                var(--borda);

            background:
                #1a1a21;

            color:
                var(--cinza);
        }

        .support-cancel:hover {
            color:
                var(--branco);

            border-color:
                var(--roxo);
        }

        /* =====================================================
           STATUS DO SUPORTE
        ===================================================== */

        .support-status {
            display: none;

            margin-top: 10px;
            padding: 10px;

            border-radius: 10px;

            background:
                rgba(85, 223, 145, .08);

            color:
                var(--verde);

            font-size: 12px;
            line-height: 1.5;
        }

        .support-status.show {
            display: block;
        }

        /* =====================================================
           SEGURANÇA
        ===================================================== */

        .security-info {
            padding: 20px;
            margin-bottom: 25px;

            border:
                1px solid
                rgba(85, 223, 145, .20);

            border-radius: 20px;

            background:
                rgba(85, 223, 145, .05);
        }

        .security-info-header {
            display: flex;
            align-items: center;

            gap: 12px;
            margin-bottom: 10px;
        }

        .security-info-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                rgba(85, 223, 145, .10);

            color:
                var(--verde);
        }

        .security-info-icon svg {
            width: 22px;
            height: 22px;
        }

        .security-info h3 {
            font-size: 16px;
            font-weight: 500;
        }

        .security-info p {
            color: var(--cinza);

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
                translate(-50%, 30px);

            opacity: 0;
            pointer-events: none;

            z-index: 5000;

            width:
                max-content;

            max-width: 90%;

            padding:
                14px 20px;

            border:
                1px solid
                var(--roxo);

            border-radius: 15px;

            background:
                #18181f;

            color:
                white;

            text-align:
                center;

            transition:
                .3s;
        }

        .toast.show {
            opacity: 1;

            transform:
                translate(-50%, 0);
        }

        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .app {
                padding:
                    18px
                    15px;
            }

            .header-title {
                font-size: 21px;
            }

            .help-hero {
                padding:
                    25px 18px;
            }

            .help-hero h2 {
                font-size: 22px;
            }

            .help-card {
                min-height: 78px;

                padding:
                    15px;
            }

            .help-card-icon {
                width: 46px;
                height: 46px;
                min-width: 46px;
            }

            .help-card-content h3 {
                font-size: 15px;
            }

            .help-card-content p {
                font-size: 12px;
            }
        }

        @media (max-width: 400px) {

            .header-title {
                font-size: 19px;
            }

            .help-hero h2 {
                font-size: 20px;
            }

            .help-card {
                gap: 10px;
                padding: 13px;
            }

            .help-card-icon {
                width: 42px;
                height: 42px;
                min-width: 42px;
            }

            .help-card-icon svg {
                width: 21px;
                height: 21px;
            }

            .help-card-content h3 {
                font-size: 14px;
            }

            .help-card-content p {
                font-size: 11px;
            }

            .help-arrow {
                font-size: 22px;
            }

            .support-actions {
                flex-direction: column;
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
                type="button"
                onclick="voltarPerfil()"
                aria-label="Voltar para o perfil"
                title="Voltar"
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

            <h1 class="header-title">
                Ajuda e suporte
            </h1>

            <div class="header-space"></div>

        </header>

        <!-- =================================================
             HERO
        ================================================== -->

        <section class="help-hero">

            <div class="help-icon">
                🆘
            </div>

            <h2>
                Como podemos ajudar?
            </h2>

            <p>
                Encontre informações sobre o SilentHelp,
                tire suas dúvidas e saiba como utilizar
                os recursos do aplicativo.
            </p>

        </section>

        <!-- =================================================
             CENTRAL DE AJUDA
        ================================================== -->

        <h2 class="section-title">
            Central de ajuda
        </h2>

        <div class="help-list">

            <!-- COMO USAR -->

            <button
                class="help-card"
                type="button"
                onclick="mostrarAjuda('comoUsar', this)"
                aria-expanded="false"
            >

                <div class="help-card-icon">

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

                        <path
                            d="M12 8v8"
                        />

                        <path
                            d="M8 12h8"
                        />

                    </svg>

                </div>

                <div class="help-card-content">

                    <h3>
                        Como usar o SilentHelp
                    </h3>

                    <p>
                        Aprenda a utilizar os principais recursos do aplicativo.
                    </p>

                </div>

                <span class="help-arrow">
                    ›
                </span>

            </button>

            <div
                id="comoUsar"
                class="answer-box"
            >

                <strong>
                    Como usar o SilentHelp
                </strong>

                Navegue pelas diferentes áreas do
                aplicativo para acessar os recursos
                disponíveis.

                <br><br>

                <b>Início:</b>
                acesso à tela principal e aos recursos
                disponíveis.

                <br><br>

                <b>Mapa:</b>
                visualize o recurso de localização disponível
                no aplicativo.

                <br><br>

                <b>Ajuda:</b>
                encontre respostas para dúvidas e entre
                em contato com o suporte.

                <br><br>

                <b>Perfil:</b>
                consulte seus dados pessoais e contatos
                de confiança.

            </div>

            <!-- FAQ -->

            <button
                class="help-card"
                type="button"
                onclick="mostrarAjuda('faq', this)"
                aria-expanded="false"
            >

                <div class="help-card-icon">

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

                        <path
                            d="M9.5 9a2.5 2.5 0 1 1 4.2 1.8c-.9.7-1.7 1.2-1.7 2.7"
                        />

                        <circle
                            cx="12"
                            cy="16.5"
                            r=".8"
                            fill="currentColor"
                            stroke="none"
                        />

                    </svg>

                </div>

                <div class="help-card-content">

                    <h3>
                        Perguntas frequentes
                    </h3>

                    <p>
                        Encontre respostas para dúvidas comuns.
                    </p>

                </div>

                <span class="help-arrow">
                    ›
                </span>

            </button>

            <div
                id="faq"
                class="answer-box"
            >

                <strong>
                    Perguntas frequentes
                </strong>

                <b>O que é o SilentHelp?</b>

                <br>

                O SilentHelp é uma solução de apoio que
                reúne recursos de proteção, localização
                e suporte.

                <br><br>

                <b>Onde encontro meus contatos?</b>

                <br>

                Acesse seu perfil e selecione a opção
                de contatos de confiança.

                <br><br>

                <b>Posso alterar meus dados?</b>

                <br>

                Alguns dados podem ser alterados diretamente
                na área de perfil.

                <br><br>

                <b>O aplicativo precisa estar conectado?</b>

                <br>

                Alguns recursos podem depender de conexão
                com a internet ou dos serviços disponíveis
                no dispositivo.

            </div>

            <!-- FALAR COM SUPORTE -->

            <button
                class="help-card"
                type="button"
                onclick="falarComSuporte()"
            >

                <div class="help-card-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.5 9.5 0 0 1-4-.9L3 21l1.5-4A8.4 8.4 0 0 1 3 12a8.5 8.5 0 0 1 18-.5Z"
                        />

                        <path
                            d="M8 12h.01"
                        />

                        <path
                            d="M12 12h.01"
                        />

                        <path
                            d="M16 12h.01"
                        />

                    </svg>

                </div>

                <div class="help-card-content">

                    <h3>
                        Falar com suporte
                    </h3>

                    <p>
                        Entre em contato para receber ajuda.
                    </p>

                </div>

                <span class="help-arrow">
                    ›
                </span>

            </button>

            <!-- DISPOSITIVO -->

            <button
                class="help-card"
                type="button"
                onclick="mostrarAjuda('dispositivo', this)"
                aria-expanded="false"
            >

                <div class="help-card-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <rect
                            x="5"
                            y="2"
                            width="14"
                            height="20"
                            rx="2"
                        />

                        <path
                            d="M9 18h6"
                        />

                        <path
                            d="M9 5h6"
                        />

                    </svg>

                </div>

                <div class="help-card-content">

                    <h3>
                        Problemas com o dispositivo
                    </h3>

                    <p>
                        Soluções para problemas de conexão e funcionamento.
                    </p>

                </div>

                <span class="help-arrow">
                    ›
                </span>

            </button>

            <div
                id="dispositivo"
                class="answer-box"
            >

                <strong>
                    Problemas com o dispositivo
                </strong>

                Se o dispositivo não estiver funcionando,
                verifique primeiro se ele está ligado
                corretamente.

                <br><br>

                <b>1.</b>
                Verifique a bateria.

                <br>

                <b>2.</b>
                Confirme se os componentes estão conectados.

                <br>

                <b>3.</b>
                Verifique a conexão disponível.

                <br>

                <b>4.</b>
                Reinicie o dispositivo.

                <br><br>

                Caso o problema continue, utilize a opção
                <b>Falar com suporte</b> para solicitar
                orientação.

            </div>

            <!-- SEGURANÇA -->

            <button
                class="help-card"
                type="button"
                onclick="mostrarAjuda('seguranca', this)"
                aria-expanded="false"
            >

                <div class="help-card-icon">

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

                <div class="help-card-content">

                    <h3>
                        Informações de segurança
                    </h3>

                    <p>
                        Orientações importantes para utilizar o SilentHelp.
                    </p>

                </div>

                <span class="help-arrow">
                    ›
                </span>

            </button>

            <div
                id="seguranca"
                class="answer-box"
            >

                <strong>
                    Informações de segurança
                </strong>

                Mantenha seus dados de acesso protegidos
                e não compartilhe senhas ou informações
                pessoais com pessoas desconhecidas.

                <br><br>

                Mantenha o aplicativo e o dispositivo
                atualizados para utilizar corretamente
                os recursos disponíveis.

                <br><br>

                Em uma situação de perigo imediato,
                procure ajuda de emergência e pessoas
                de confiança próximas a você.

            </div>

        </div>

        <!-- =================================================
             SUPORTE
        ================================================== -->

        <section class="support-card">

            <h3>
                Precisa de mais ajuda?
            </h3>

            <p>
                Se você não encontrou a resposta que
                procurava, entre em contato com nossa
                equipe de suporte.
            </p>

            <button
                id="supportOpenButton"
                class="support-button"
                type="button"
                onclick="falarComSuporte()"
            >
                Falar com suporte
            </button>

            <div
                id="supportForm"
                class="support-form"
            >

                <label for="supportMessage">
                    Escreva sua mensagem
                </label>

                <textarea
                    id="supportMessage"
                    maxlength="1000"
                    placeholder="Descreva sua dúvida ou o problema que está acontecendo..."
                ></textarea>

                <div class="support-actions">

                    <button
                        class="support-send"
                        type="button"
                        onclick="enviarSuporte()"
                    >
                        Enviar mensagem
                    </button>

                    <button
                        class="support-cancel"
                        type="button"
                        onclick="fecharSuporte()"
                    >
                        Cancelar
                    </button>

                </div>

                <div
                    id="supportStatus"
                    class="support-status"
                    role="status"
                    aria-live="polite"
                ></div>

            </div>

        </section>

        <!-- =================================================
             INFORMAÇÕES DE SEGURANÇA
        ================================================== -->

        <section class="security-info">

            <div class="security-info-header">

                <div class="security-info-icon">

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

                <h3>
                    Sua segurança é importante
                </h3>

            </div>

            <p>
                O SilentHelp é uma ferramenta de apoio.
                Em uma situação de perigo imediato,
                procure ajuda de emergência e pessoas
                de confiança próximas a você.
            </p>

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

    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =====================================================
           CONFIGURAÇÃO DO SUPORTE
        ===================================================== */

        const EMAIL_SUPORTE =
            "suporte@silenthelp.com";

        /* =====================================================
           VOLTAR PARA O PERFIL
        ===================================================== */

        function voltarPerfil() {

            window.location.href =
                "perfil.php";

        }

        /* =====================================================
           ABRIR / FECHAR AJUDA
        ===================================================== */

        function mostrarAjuda(id, botao) {

            const caixa =
                document.getElementById(id);

            if (!caixa) {
                return;
            }

            const estavaAberta =
                caixa.classList.contains("show");

            // Fecha todas as respostas

            document
                .querySelectorAll(".answer-box")
                .forEach(function(elemento) {

                    elemento.classList.remove("show");

                });

            // Remove estado dos botões

            document
                .querySelectorAll(".help-card")
                .forEach(function(elemento) {

                    elemento.classList.remove("open");

                    elemento.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                });

            // Abre a selecionada

            if (!estavaAberta) {

                caixa.classList.add("show");

                if (botao) {

                    botao.classList.add("open");

                    botao.setAttribute(
                        "aria-expanded",
                        "true"
                    );

                }

                setTimeout(function() {

                    caixa.scrollIntoView({

                        behavior: "smooth",
                        block: "nearest"

                    });

                }, 50);

            }

        }

        /* =====================================================
           ABRIR FORMULÁRIO DE SUPORTE
        ===================================================== */

        function falarComSuporte() {

            const formulario =
                document.getElementById("supportForm");

            const campo =
                document.getElementById("supportMessage");

            const botao =
                document.getElementById("supportOpenButton");

            if (!formulario || !campo) {
                return;
            }

            if (formulario.classList.contains("show")) {

                campo.focus();

                formulario.scrollIntoView({

                    behavior: "smooth",
                    block: "center"

                });

                return;
            }

            formulario.classList.add("show");

            if (botao) {

                botao.textContent =
                    "Formulário aberto";

            }

            // Fecha respostas abertas

            document
                .querySelectorAll(".answer-box")
                .forEach(function(elemento) {

                    elemento.classList.remove("show");

                });

            document
                .querySelectorAll(".help-card")
                .forEach(function(elemento) {

                    elemento.classList.remove("open");

                    elemento.setAttribute(
                        "aria-expanded",
                        "false"
                    );

                });

            setTimeout(function() {

                formulario.scrollIntoView({

                    behavior: "smooth",
                    block: "center"

                });

                campo.focus();

            }, 100);

        }

        /* =====================================================
           FECHAR FORMULÁRIO
        ===================================================== */

        function fecharSuporte() {

            const formulario =
                document.getElementById("supportForm");

            const campo =
                document.getElementById("supportMessage");

            const status =
                document.getElementById("supportStatus");

            const botao =
                document.getElementById("supportOpenButton");

            if (formulario) {

                formulario.classList.remove("show");

            }

            if (campo) {

                campo.value = "";

            }

            if (status) {

                status.classList.remove("show");
                status.textContent = "";

            }

            if (botao) {

                botao.textContent =
                    "Falar com suporte";

            }

        }

        /* =====================================================
           ENVIAR MENSAGEM
        ===================================================== */

        function enviarSuporte() {

            const campo =
                document.getElementById("supportMessage");

            const status =
                document.getElementById("supportStatus");

            if (!campo || !status) {
                return;
            }

            const mensagem =
                campo.value.trim();

            if (!mensagem) {

                status.textContent =
                    "Escreva uma mensagem antes de enviar.";

                status.style.background =
                    "rgba(255, 101, 122, .08)";

                status.style.color =
                    "var(--vermelho)";

                status.classList.add("show");

                campo.focus();

                return;
            }

            /* =================================================
               CRIA E-MAIL
            ================================================== */

            const assunto =
                encodeURIComponent(
                    "Ajuda e suporte - SilentHelp"
                );

            const corpo =
                encodeURIComponent(
                    "Olá, equipe SilentHelp!\n\n" +
                    "Preciso de ajuda com:\n\n" +
                    mensagem +
                    "\n\n" +
                    "Enviado pelo aplicativo SilentHelp."
                );

            const mailto =
                "mailto:" +
                EMAIL_SUPORTE +
                "?subject=" +
                assunto +
                "&body=" +
                corpo;

            status.textContent =
                "Abrindo seu aplicativo de e-mail para enviar a mensagem...";

            status.style.background =
                "rgba(85, 223, 145, .08)";

            status.style.color =
                "var(--verde)";

            status.classList.add("show");

            window.location.href =
                mailto;

        }

        /* =====================================================
           TECLA ESC
        ===================================================== */

        document.addEventListener(
            "keydown",
            function(event) {

                if (event.key === "Escape") {

                    document
                        .querySelectorAll(".answer-box")
                        .forEach(function(elemento) {

                            elemento.classList.remove("show");

                        });

                    document
                        .querySelectorAll(".help-card")
                        .forEach(function(elemento) {

                            elemento.classList.remove("open");

                            elemento.setAttribute(
                                "aria-expanded",
                                "false"
                            );

                        });

                    fecharSuporte();

                }

            }
        );

        /* =====================================================
           CARREGAMENTO
        ===================================================== */

        document.addEventListener(
            "DOMContentLoaded",
            function() {

                console.log(
                    "SilentHelp - Ajuda e suporte carregado."
                );

            }
        );

    </script>

    <script src="assets/db-sync.js"></script>

</body>

</html>