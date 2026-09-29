<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Termos de Uso</title>


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

            --borda: #292933;

            --branco: #ffffff;
            --cinza: #aaaab3;
            --cinza-escuro: #777781;

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
                80px;

        }


        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {

            display: flex;

            align-items: center;

            gap: 18px;

            margin-bottom: 30px;

        }


        /* =====================================================
           BOTÃO VOLTAR
        ===================================================== */

        .back-button {

            width: 48px;

            height: 48px;

            min-width: 48px;

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
           TÍTULO
        ===================================================== */

        .header-text h1 {

            font-size: 32px;

            font-weight: 600;

            margin-bottom: 4px;

        }


        .header-text p {

            color:
                var(--cinza);

            font-size: 14px;

        }


        /* =====================================================
           CARD PRINCIPAL
        ===================================================== */

        .terms-card {

            border:
                1px solid
                var(--borda);

            border-radius: 24px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0b0b10
                );

            padding: 30px;

        }


        /* =====================================================
           TÍTULO DA PÁGINA
        ===================================================== */

        .intro {

            padding-bottom: 25px;

            margin-bottom: 25px;

            border-bottom:
                1px solid
                rgba(255,255,255,.06);

        }


        .intro h2 {

            color:
                var(--roxo-claro);

            font-size: 23px;

            margin-bottom: 10px;

        }


        .intro p {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.6;

        }


        /* =====================================================
           SEÇÕES
        ===================================================== */

        .term-section {

            margin-bottom: 28px;

        }


        .term-section:last-child {

            margin-bottom: 0;

        }


        .term-section h3 {

            color:
                var(--branco);

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 10px;

        }


        .term-section h3 span {

            color:
                var(--roxo-claro);

            margin-right: 5px;

        }


        .term-section p {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 9px;

        }


        .term-section ul {

            padding-left: 22px;

            margin-top: 8px;

        }


        .term-section li {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 6px;

        }


        /* =====================================================
           DESTAQUE
        ===================================================== */

        .highlight {

            margin-top: 15px;

            padding: 17px;

            border:
                1px solid
                rgba(166,92,255,.25);

            border-radius: 15px;

            background:
                rgba(166,92,255,.07);

        }


        .highlight p {

            margin: 0;

            color:
                #d6c2eb;

        }


        /* =====================================================
           DATA
        ===================================================== */

        .update {

            margin-top: 30px;

            padding-top: 20px;

            border-top:
                1px solid
                rgba(255,255,255,.06);

            color:
                var(--cinza-escuro);

            font-size: 12px;

            text-align: center;

        }


        /* =====================================================
           BOTÃO VOLTAR
        ===================================================== */

        .bottom-button {

            display: flex;

            justify-content: center;

            margin-top: 25px;

        }


        .return-button {

            padding:
                14px 25px;

            border: none;

            border-radius: 14px;

            background:
                var(--roxo);

            color:
                white;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;

        }


        .return-button:hover {

            background:
                var(--roxo-escuro);

            transform:
                translateY(-2px);

        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 700px) {

            .app {

                padding:
                    18px
                    15px
                    60px;

            }


            .header {

                margin-bottom: 25px;

            }


            .header-text h1 {

                font-size: 26px;

            }


            .header-text p {

                font-size: 13px;

            }


            .back-button {

                width: 43px;

                height: 43px;

                min-width: 43px;

            }


            .terms-card {

                padding: 22px 18px;

                border-radius: 20px;

            }


            .intro h2 {

                font-size: 20px;

            }


            .term-section h3 {

                font-size: 16px;

            }


            .term-section p,
            .term-section li {

                font-size: 13px;

            }

        }


        @media (max-width: 400px) {

            .terms-card {

                padding: 20px 15px;

            }

        }

    </style>

</head>


<body>


    <main class="app">


        <!-- =================================================
             CABEÇALHO
        ================================================== -->

        <header class="header">


            <button
                class="back-button"
                onclick="voltarConfiguracoes()"
                aria-label="Voltar"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path d="M19 12H5"/>

                    <path
                        d="M12 19l-7-7 7-7"
                    />

                </svg>

            </button>


            <div class="header-text">

                <h1>
                    Termos de Uso
                </h1>

                <p>
                    Conheça as condições de utilização do SilentHelp.
                </p>

            </div>


        </header>


        <!-- =================================================
             TERMOS
        ================================================== -->

        <section class="terms-card">


            <!-- INTRODUÇÃO -->

            <div class="intro">

                <h2>
                    Termos de Uso do SilentHelp
                </h2>

                <p>
                    Ao utilizar o SilentHelp, você concorda
                    com os termos e condições apresentados
                    nesta página.
                </p>

            </div>


            <!-- 1 -->

            <div class="term-section">

                <h3>
                    <span>1.</span>
                    Sobre o SilentHelp
                </h3>

                <p>
                    O SilentHelp é uma solução tecnológica
                    desenvolvida com o objetivo de oferecer
                    recursos de apoio à segurança e facilitar
                    o acesso a informações durante situações
                    de emergência.
                </p>

            </div>


            <!-- 2 -->

            <div class="term-section">

                <h3>
                    <span>2.</span>
                    Uso do aplicativo
                </h3>

                <p>
                    O usuário deve utilizar o SilentHelp
                    de maneira responsável e de acordo com
                    a finalidade para a qual o sistema foi
                    desenvolvido.
                </p>

                <p>
                    É responsabilidade do usuário manter
                    seus dados de acesso seguros e não
                    compartilhar suas credenciais com
                    terceiros.
                </p>

            </div>


            <!-- 3 -->

            <div class="term-section">

                <h3>
                    <span>3.</span>
                    Recursos de segurança
                </h3>

                <p>
                    Alguns recursos do SilentHelp podem
                    utilizar informações como localização,
                    notificações e dados relacionados ao
                    dispositivo para oferecer suas
                    funcionalidades.
                </p>

                <div class="highlight">

                    <p>
                        O SilentHelp é uma ferramenta de
                        apoio e não substitui serviços
                        oficiais de emergência ou atendimento
                        profissional.
                    </p>

                </div>

            </div>


            <!-- 4 -->

            <div class="term-section">

                <h3>
                    <span>4.</span>
                    Localização
                </h3>

                <p>
                    Quando autorizada pelo usuário, a
                    localização poderá ser utilizada para
                    recursos relacionados à segurança e
                    situações de emergência.
                </p>

                <p>
                    O usuário pode controlar as permissões
                    de localização por meio das configurações
                    disponíveis no dispositivo.
                </p>

            </div>


            <!-- 5 -->

            <div class="term-section">

                <h3>
                    <span>5.</span>
                    Conta do usuário
                </h3>

                <p>
                    O usuário é responsável pelas informações
                    fornecidas durante o cadastro e deve
                    mantê-las atualizadas sempre que
                    necessário.
                </p>

                <ul>

                    <li>
                        Não compartilhar sua senha.
                    </li>

                    <li>
                        Manter seus dados atualizados.
                    </li>

                    <li>
                        Utilizar sua conta de maneira
                        responsável.
                    </li>

                </ul>

            </div>


            <!-- 6 -->

            <div class="term-section">

                <h3>
                    <span>6.</span>
                    Privacidade
                </h3>

                <p>
                    O SilentHelp busca proteger as informações
                    fornecidas pelos usuários e utilizar os
                    dados de acordo com sua finalidade.
                </p>

                <p>
                    Para informações detalhadas sobre a
                    utilização e proteção dos dados, consulte
                    a Política de Privacidade.
                </p>

            </div>


            <!-- 7 -->

            <div class="term-section">

                <h3>
                    <span>7.</span>
                    Uso responsável
                </h3>

                <p>
                    O sistema deve ser utilizado de forma
                    responsável, respeitando outras pessoas,
                    os recursos disponíveis e as leis
                    aplicáveis.
                </p>

            </div>


            <!-- 8 -->

            <div class="term-section">

                <h3>
                    <span>8.</span>
                    Disponibilidade
                </h3>

                <p>
                    O funcionamento de determinados recursos
                    pode depender da conexão com a internet,
                    permissões do dispositivo, disponibilidade
                    de serviços externos ou funcionamento do
                    próprio aparelho.
                </p>

            </div>


            <!-- 9 -->

            <div class="term-section">

                <h3>
                    <span>9.</span>
                    Alterações dos termos
                </h3>

                <p>
                    Estes termos poderão ser atualizados
                    sempre que necessário para acompanhar
                    mudanças no aplicativo, nos recursos
                    oferecidos ou nas necessidades do serviço.
                </p>

            </div>


            <!-- 10 -->

            <div class="term-section">

                <h3>
                    <span>10.</span>
                    Aceitação
                </h3>

                <p>
                    Ao continuar utilizando o SilentHelp,
                    o usuário declara estar ciente das
                    condições apresentadas nestes Termos
                    de Uso.
                </p>

            </div>


            <!-- DATA -->

            <div class="update">

                Última atualização: Agosto de 2026

            </div>


        </section>


        <!-- =================================================
             BOTÃO
        ================================================== -->

        <div class="bottom-button">

            <button
                class="return-button"
                onclick="voltarConfiguracoes()"
            >

                Voltar para configurações

            </button>

        </div>


    </main>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        function voltarConfiguracoes() {

            window.location.href = "config.php";

        }

    </script>


<script src="assets/db-sync.js"></script>
</body>

</html>