<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Política de Privacidade</title>


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

        .privacy-card {

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
           INTRODUÇÃO
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

        .privacy-section {

            margin-bottom: 28px;

        }


        .privacy-section:last-child {

            margin-bottom: 0;

        }


        .privacy-section h3 {

            color:
                var(--branco);

            font-size: 18px;

            font-weight: 600;

            margin-bottom: 10px;

        }


        .privacy-section h3 span {

            color:
                var(--roxo-claro);

            margin-right: 5px;

        }


        .privacy-section p {

            color:
                var(--cinza);

            font-size: 14px;

            line-height: 1.7;

            margin-bottom: 9px;

        }


        .privacy-section ul {

            padding-left: 22px;

            margin-top: 8px;

        }


        .privacy-section li {

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
           BOTÃO
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


            .privacy-card {

                padding:
                    22px 18px;

                border-radius: 20px;

            }


            .intro h2 {

                font-size: 20px;

            }


            .privacy-section h3 {

                font-size: 16px;

            }


            .privacy-section p,
            .privacy-section li {

                font-size: 13px;

            }

        }


        @media (max-width: 400px) {

            .privacy-card {

                padding:
                    20px 15px;

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
                    Privacidade
                </h1>

                <p>
                    Saiba como seus dados são tratados no SilentHelp.
                </p>

            </div>


        </header>


        <!-- =================================================
             POLÍTICA DE PRIVACIDADE
        ================================================== -->

        <section class="privacy-card">


            <!-- INTRODUÇÃO -->

            <div class="intro">

                <h2>
                    Política de Privacidade
                </h2>

                <p>
                    A privacidade e a segurança das informações
                    dos usuários são importantes para o SilentHelp.
                    Esta página explica, de forma simples, como
                    os dados podem ser utilizados dentro da
                    aplicação.
                </p>

            </div>


            <!-- 1 -->

            <div class="privacy-section">

                <h3>
                    <span>1.</span>
                    Informações coletadas
                </h3>

                <p>
                    Dependendo dos recursos utilizados, o
                    SilentHelp poderá trabalhar com informações
                    necessárias para o funcionamento da aplicação.
                </p>

                <ul>

                    <li>
                        Informações da conta do usuário.
                    </li>

                    <li>
                        Informações relacionadas ao dispositivo.
                    </li>

                    <li>
                        Dados de localização quando autorizados.
                    </li>

                    <li>
                        Preferências e configurações do aplicativo.
                    </li>

                </ul>

            </div>


            <!-- 2 -->

            <div class="privacy-section">

                <h3>
                    <span>2.</span>
                    Uso das informações
                </h3>

                <p>
                    As informações podem ser utilizadas para
                    permitir o funcionamento dos recursos do
                    SilentHelp e melhorar a experiência do usuário.
                </p>

                <p>
                    Entre as finalidades estão a utilização de
                    recursos de segurança, gerenciamento da conta,
                    notificações e funcionamento das configurações.
                </p>

            </div>


            <!-- 3 -->

            <div class="privacy-section">

                <h3>
                    <span>3.</span>
                    Localização
                </h3>

                <p>
                    A localização somente deverá ser utilizada
                    quando o usuário conceder a permissão
                    necessária ao aplicativo.
                </p>

                <div class="highlight">

                    <p>
                        O usuário pode controlar as permissões
                        de localização diretamente pelas
                        configurações do dispositivo.
                    </p>

                </div>

            </div>


            <!-- 4 -->

            <div class="privacy-section">

                <h3>
                    <span>4.</span>
                    Proteção dos dados
                </h3>

                <p>
                    O SilentHelp busca adotar medidas para
                    proteger as informações utilizadas pela
                    aplicação contra acessos não autorizados,
                    alterações indevidas ou uso inadequado.
                </p>

                <p>
                    Nenhum sistema conectado à internet pode
                    garantir segurança absoluta, por isso o
                    usuário também deve proteger suas credenciais
                    e seu dispositivo.
                </p>

            </div>


            <!-- 5 -->

            <div class="privacy-section">

                <h3>
                    <span>5.</span>
                    Compartilhamento de informações
                </h3>

                <p>
                    As informações do usuário devem ser tratadas
                    de acordo com a finalidade para a qual foram
                    coletadas e com as permissões concedidas.
                </p>

                <p>
                    O acesso a determinadas informações poderá
                    ocorrer quando necessário para o funcionamento
                    de recursos do sistema ou quando exigido por
                    obrigação legal.
                </p>

            </div>


            <!-- 6 -->

            <div class="privacy-section">

                <h3>
                    <span>6.</span>
                    Notificações
                </h3>

                <p>
                    O SilentHelp poderá utilizar notificações
                    para informar o usuário sobre acontecimentos,
                    atualizações ou informações relacionadas aos
                    recursos de segurança.
                </p>

                <p>
                    As notificações podem ser controladas nas
                    configurações do dispositivo e do aplicativo.
                </p>

            </div>


            <!-- 7 -->

            <div class="privacy-section">

                <h3>
                    <span>7.</span>
                    Dados do dispositivo
                </h3>

                <p>
                    Algumas informações técnicas do dispositivo
                    podem ser utilizadas para permitir o correto
                    funcionamento dos recursos da aplicação.
                </p>

            </div>


            <!-- 8 -->

            <div class="privacy-section">

                <h3>
                    <span>8.</span>
                    Controle do usuário
                </h3>

                <p>
                    O usuário pode gerenciar determinadas
                    permissões e preferências por meio das
                    configurações disponíveis no SilentHelp
                    e no próprio dispositivo.
                </p>

                <ul>

                    <li>
                        Ativar ou desativar a localização.
                    </li>

                    <li>
                        Controlar notificações.
                    </li>

                    <li>
                        Alterar preferências de segurança.
                    </li>

                    <li>
                        Gerenciar configurações do dispositivo.
                    </li>

                </ul>

            </div>


            <!-- 9 -->

            <div class="privacy-section">

                <h3>
                    <span>9.</span>
                    Privacidade de menores
                </h3>

                <p>
                    O uso da aplicação deve respeitar as regras
                    e requisitos legais aplicáveis à idade do
                    usuário e ao tratamento de dados pessoais.
                </p>

            </div>


            <!-- 10 -->

            <div class="privacy-section">

                <h3>
                    <span>10.</span>
                    Alterações desta política
                </h3>

                <p>
                    Esta Política de Privacidade poderá ser
                    atualizada quando houver alterações nos
                    recursos, nas práticas do sistema ou nas
                    exigências aplicáveis.
                </p>

            </div>


            <!-- 11 -->

            <div class="privacy-section">

                <h3>
                    <span>11.</span>
                    Consentimento
                </h3>

                <p>
                    Ao utilizar os recursos do SilentHelp que
                    dependem de determinadas permissões, o
                    usuário poderá ser solicitado a autorizar
                    o acesso às informações necessárias para
                    aquela funcionalidade.
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