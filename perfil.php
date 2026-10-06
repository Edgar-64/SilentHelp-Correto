<?php
require_once __DIR__ . '/auth.php';

$usuario = exigirLogin();

$nomeUsuario = $usuario['nome'] ?? 'Usuário';
$emailUsuario = $usuario['email'] ?? 'Não informado';
$telefoneUsuario = $usuario['telefone'] ?? 'Não informado';

$nomeUsuario = htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8');
$emailUsuario = htmlspecialchars($emailUsuario, ENT_QUOTES, 'UTF-8');
$telefoneUsuario = htmlspecialchars($telefoneUsuario, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SilentHelp - Perfil</title>

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
                140px;
        }

        /* =====================================================
           CABEÇALHO
        ===================================================== */

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 30px;
        }

        .back-button {
            width: 48px;
            height: 48px;

            border: 1px solid var(--borda);
            border-radius: 15px;

            background: var(--fundo-card);
            color: var(--roxo-claro);

            display: flex;
            justify-content: center;
            align-items: center;

            cursor: pointer;
            transition: .2s;
        }

        .back-button:hover {
            border-color: var(--roxo);
            background: #18131f;
        }

        .back-button svg {
            width: 24px;
            height: 24px;
        }

        .header-title {
            font-size: 25px;
            font-weight: 600;
        }

        .header-space {
            width: 48px;
        }

        /* =====================================================
           PERFIL PRINCIPAL
        ===================================================== */

        .profile-card {
            position: relative;

            padding: 30px 25px;
            margin-bottom: 25px;

            text-align: center;

            border: 1px solid rgba(166, 92, 255, .35);
            border-radius: 28px;

            background:
                radial-gradient(
                    circle at 50% 0%,
                    rgba(166, 92, 255, .16),
                    transparent 50%
                ),
                linear-gradient(
                    145deg,
                    #15111c,
                    #0c0c10
                );
        }

        /* =====================================================
           FOTO
        ===================================================== */

        .profile-photo-container {
            position: relative;

            width: 115px;
            height: 115px;

            margin: auto auto 18px;
        }

        .profile-photo {
            width: 115px;
            height: 115px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 50%;
            border: 3px solid var(--roxo);

            background:
                linear-gradient(
                    145deg,
                    #b56cff,
                    #6e32ad
                );

            color: white;

            font-size: 42px;
            font-weight: 600;

            box-shadow:
                0 0 30px
                rgba(166, 92, 255, .25);

            overflow: hidden;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;

            object-fit: cover;
            display: block;
        }

        /* =====================================================
           BOTÃO EDITAR FOTO
        ===================================================== */

        .edit-photo {
            position: absolute;

            right: -3px;
            bottom: -3px;

            width: 39px;
            height: 39px;

            display: flex;
            justify-content: center;
            align-items: center;

            border: 3px solid #101015;
            border-radius: 50%;

            background: var(--roxo);
            color: white;

            cursor: pointer;
            transition: .2s;
        }

        .edit-photo:hover {
            background: var(--roxo-claro);
            transform: scale(1.06);
        }

        .edit-photo svg {
            width: 18px;
            height: 18px;
        }

        #inputFoto {
            display: none;
        }

        /* =====================================================
           NOME
        ===================================================== */

        .profile-name {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-email {
            color: var(--cinza);
            font-size: 15px;
            margin-bottom: 18px;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            padding: 8px 14px;

            border-radius: 20px;

            background: rgba(85, 223, 145, .09);
            color: var(--verde);

            font-size: 13px;
            font-weight: 600;
        }

        .profile-status-dot {
            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: var(--verde);

            box-shadow:
                0 0 8px
                rgba(85, 223, 145, .6);
        }

        /* =====================================================
           SEÇÕES
        ===================================================== */

        .section-title {
            font-size: 21px;
            font-weight: 500;

            margin-bottom: 15px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* =====================================================
           ITEM DO PERFIL
        ===================================================== */

        .profile-item {
            display: flex;
            align-items: center;

            gap: 15px;

            padding: 17px;

            border: 1px solid var(--borda);
            border-radius: 19px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0c0c10
                );

            transition: .2s;
            cursor: pointer;
        }

        .profile-item:hover {
            border-color: rgba(166, 92, 255, .45);
            transform: translateY(-1px);
        }

        .item-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: rgba(166, 92, 255, .12);
            color: var(--roxo-claro);
        }

        .item-icon svg {
            width: 22px;
            height: 22px;
        }

        .item-content {
            flex: 1;
        }

        .item-label {
            color: var(--cinza);
            font-size: 12px;

            margin-bottom: 4px;
        }

        .item-value {
            font-size: 16px;
            font-weight: 500;

            word-break: break-word;
        }

        .item-arrow {
            color: var(--cinza-escuro);
            font-size: 25px;
        }

        /* =====================================================
           CÓDIGO DO RESPONSÁVEL
        ===================================================== */

        .responsible-card {
            padding: 20px;

            border: 1px solid var(--borda);
            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0c0c10
                );

            margin-bottom: 25px;
        }

        .responsible-card p {
            color: var(--cinza);
            font-size: 13px;
            margin-bottom: 15px;
        }

        .code-box-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .code-display {
            flex: 1;

            padding: 14px;

            background: var(--fundo);

            border: 1px dashed var(--roxo);
            border-radius: 14px;

            font-family: monospace;
            font-size: 18px;
            font-weight: bold;

            text-align: center;
            letter-spacing: 2px;

            color: var(--roxo-claro);
        }

        .action-code-btn {
            padding: 14px 18px;

            border: none;
            border-radius: 14px;

            background: var(--roxo);
            color: white;

            font-weight: 600;
            font-size: 14px;

            cursor: pointer;
            transition: .2s;

            white-space: nowrap;
        }

        .action-code-btn:hover {
            background: var(--roxo-claro);
        }

        .action-code-btn.secondary {
            background: rgba(166, 92, 255, 0.15);
            color: var(--roxo-claro);

            border: 1px solid rgba(166, 92, 255, 0.3);
        }

        .action-code-btn.secondary:hover {
            background: rgba(166, 92, 255, 0.25);
        }

        .code-actions {
            display: flex;
            gap: 10px;

            margin-top: 10px;
        }

        .code-actions button {
            flex: 1;
        }

        /* =====================================================
           AJUDA E SUPORTE
        ===================================================== */

        .security-section {
            margin-bottom: 25px;
        }

        .security-card {
            display: flex;
            align-items: center;

            gap: 15px;
            padding: 19px;

            border: 1px solid var(--borda);
            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #111116,
                    #0c0c10
                );

            cursor: pointer;
            transition: .2s;
        }

        .security-card:hover {
            border-color: rgba(166, 92, 255, .45);
            transform: translateY(-1px);
        }

        .security-card-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 15px;

            background: rgba(166, 92, 255, .13);
            color: var(--roxo-claro);
        }

        .security-card-icon svg {
            width: 24px;
            height: 24px;
        }

        .security-card-content {
            flex: 1;
        }

        .security-card-content h3 {
            font-size: 16px;
            font-weight: 500;

            margin-bottom: 4px;
        }

        .security-card-content p {
            color: var(--cinza);
            font-size: 13px;
        }

        .security-arrow {
            color: var(--cinza-escuro);
            font-size: 25px;
        }

        /* =====================================================
           CONTATOS
        ===================================================== */

        .contacts-card {
            display: flex;
            align-items: center;

            gap: 15px;
            padding: 20px;

            margin-bottom: 25px;

            border: 1px solid rgba(166, 92, 255, .30);
            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    rgba(166, 92, 255, .10),
                    rgba(166, 92, 255, .04)
                );

            cursor: pointer;
            transition: .2s;
        }

        .contacts-card:hover {
            border-color: var(--roxo);

            background:
                linear-gradient(
                    145deg,
                    rgba(166, 92, 255, .16),
                    rgba(166, 92, 255, .06)
                );

            transform: translateY(-2px);
        }

        .contacts-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;

            display: flex;
            justify-content: center;
            align-items: center;

            border-radius: 16px;

            background: rgba(166, 92, 255, .16);
            color: var(--roxo-claro);
        }

        .contacts-icon svg {
            width: 27px;
            height: 27px;
        }

        .contacts-content {
            flex: 1;
        }

        .contacts-content h3 {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .contacts-content p {
            color: var(--cinza);
            font-size: 13px;

            margin-bottom: 8px;
        }

        .add-contact-text {
            display: inline-flex;
            align-items: center;

            gap: 6px;

            color: var(--roxo-claro);

            font-size: 13px;
            font-weight: 600;
        }

        .add-contact-plus {
            width: 19px;
            height: 19px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: var(--roxo);
            color: white;

            font-size: 15px;
        }

        .contacts-arrow {
            color: var(--roxo-claro);
            font-size: 27px;
        }

        /* =====================================================
           SAIR
        ===================================================== */

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

        /* =====================================================
           MENU INFERIOR
        ===================================================== */

        .bottom-nav {
            position: fixed;

            left: 50%;
            bottom: 15px;

            transform: translateX(-50%);

            width: min(
                calc(100% - 30px),
                850px
            );

            height: 82px;

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            align-items: stretch;

            padding: 5px;

            background: rgba(18, 18, 22, .97);

            border:
                1px solid
                rgba(255, 255, 255, .04);

            border-radius: 28px;

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);

            z-index: 1000;
            overflow: hidden;
        }

        .nav-button {
            width: 100%;
            height: 100%;

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;

            gap: 5px;

            padding: 0;

            border: none;
            outline: none;

            background: transparent;

            color: #85858e;

            cursor: pointer;

            font-size: 12px;
            font-weight: 500;

            transition:
                color .2s,
                background .2s;
        }

        .nav-button svg {
            width: 25px;
            height: 25px;

            flex-shrink: 0;
        }

        .nav-button span {
            white-space: nowrap;
        }

        .nav-button.active,
        .nav-button:hover {
            color: var(--roxo-claro);
        }

        /* =====================================================
           TOAST
        ===================================================== */

        .toast {
            position: fixed;

            left: 50%;
            bottom: 130px;

            transform: translate(-50%, 30px);

            opacity: 0;
            pointer-events: none;

            z-index: 5000;

            padding: 15px 22px;

            border-radius: 15px;

            background: #18181f;

            border: 1px solid var(--roxo);

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

        @media (max-width: 700px) {

            .app {
                padding:
                    18px
                    15px
                    120px;
            }

            .header-title {
                font-size: 21px;
            }

            .profile-card {
                padding:
                    25px 18px;
            }

            .profile-photo,
            .profile-photo-container {
                width: 100px;
                height: 100px;
            }

            .profile-name {
                font-size: 25px;
            }

            .bottom-nav {
                width:
                    calc(100% - 24px);

                height: 76px;

                bottom: 10px;

                border-radius: 24px;
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

            .header-title {
                font-size: 19px;
            }

            .profile-name {
                font-size: 23px;
            }

            .item-value {
                font-size: 14px;
            }

            .profile-item {
                padding: 14px;
            }

            .contacts-card {
                padding: 16px;
            }

            .contacts-content h3 {
                font-size: 15px;
            }

            .bottom-nav {
                width:
                    calc(100% - 20px);

                height: 74px;

                bottom: 8px;

                border-radius: 22px;
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

    <main class="app">

        <!-- =================================================
             CABEÇALHO
        ================================================== -->

        <header class="header">

            <button
                class="back-button"
                onclick="voltarInicio()"
                aria-label="Voltar"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path d="M15 18l-6-6 6-6" />

                </svg>

            </button>

            <h1 class="header-title">
                Meu Perfil
            </h1>

            <div class="header-space"></div>

        </header>


        <!-- =================================================
             PERFIL PRINCIPAL
        ================================================== -->

        <section class="profile-card">

            <div class="profile-photo-container">

                <div
                    class="profile-photo"
                    id="profilePhoto"
                >
                    <?= htmlspecialchars(strtoupper(substr($usuario['nome'] ?? 'U', 0, 1)), ENT_QUOTES, 'UTF-8') ?>
                </div>

                <button
                    class="edit-photo"
                    onclick="editarFoto()"
                    title="Alterar foto"
                    aria-label="Alterar foto"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path d="M12 20h9" />

                        <path
                            d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                        />

                    </svg>

                </button>

                <input
                    type="file"
                    id="inputFoto"
                    accept="image/*"
                >

            </div>


            <h2
                class="profile-name"
                id="nomePerfil"
            >
                <?= $nomeUsuario ?>
            </h2>


            <p
                class="profile-email"
                id="emailPerfil"
            >
                <?= $emailUsuario ?>
            </p>


            <div class="profile-status">

                <span class="profile-status-dot"></span>

                Conta protegida

            </div>

        </section>


        <!-- =================================================
             DADOS PESSOAIS
        ================================================== -->

        <section class="info-section">

            <h2 class="section-title">
                Dados pessoais
            </h2>

            <div class="info-list">

                <!-- NOME -->

                <div
                    class="profile-item"
                    onclick="editarNome()"
                >

                    <div class="item-icon">

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

                    </div>


                    <div class="item-content">

                        <div class="item-label">
                            Nome
                        </div>

                        <div
                            class="item-value"
                            id="nomeUsuario"
                        >
                            <?= $nomeUsuario ?>
                        </div>

                    </div>


                    <span class="item-arrow">
                        ›
                    </span>

                </div>


                <!-- EMAIL -->

                <div
                    class="profile-item"
                    onclick="editarEmail()"
                >

                    <div class="item-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <path
                                d="M3 7l9 6 9-6"
                            />

                        </svg>

                    </div>


                    <div class="item-content">

                        <div class="item-label">
                            E-mail
                        </div>

                        <div
                            class="item-value"
                            id="emailUsuario"
                        >
                            <?= $emailUsuario ?>
                        </div>

                    </div>


                    <span class="item-arrow">
                        ›
                    </span>

                </div>


                <!-- TELEFONE -->

                <div
                    class="profile-item"
                    onclick="editarTelefone()"
                >

                    <div class="item-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                d="M6 2h4l2 5-2.5 2.5a15 15 0 0 0 5 5L17 12l5 2v4c0 1-1 2-2 2C10 20 4 14 4 4c0-1 1-2 2-2z"
                            />

                        </svg>

                    </div>


                    <div class="item-content">

                        <div class="item-label">
                            Telefone
                        </div>

                        <div
                            class="item-value"
                            id="telefoneUsuario"
                        >
                            <?= $telefoneUsuario ?>
                        </div>

                    </div>


                    <span class="item-arrow">
                        ›
                    </span>

                </div>

            </div>

        </section>


        <!-- =================================================
             CÓDIGO PARA O RESPONSÁVEL
        ================================================== -->

        <section class="info-section">

            <h2 class="section-title">
                Código para o Responsável
            </h2>

            <div class="responsible-card">

                <p>
                    Gere um código de vínculo para o responsável utilizar ao criar a conta dele no sistema:
                </p>


                <div class="code-box-wrapper">

                    <div
                        class="code-display"
                        id="codigoResponsavelDisplay"
                    >
                        -------
                    </div>

                </div>


                <div class="code-actions">

                    <button
                        class="action-code-btn secondary"
                        onclick="gerarCodigoResponsavel()"
                    >
                        Gerar Código
                    </button>


                    <button
                        class="action-code-btn"
                        onclick="copiarCodigoResponsavel()"
                    >
                        Copiar Código
                    </button>

                </div>

            </div>

        </section>


        <!-- =================================================
             AJUDA E SUPORTE
        ================================================== -->

        <section class="security-section">

            <h2 class="section-title">
                Ajuda e suporte
            </h2>


            <div
                class="security-card"
                onclick="abrirAjuda()"
                role="button"
                tabindex="0"
                onkeydown="
                    if(event.key === 'Enter' || event.key === ' ')
                        abrirAjuda()
                "
            >

                <div class="security-card-icon">

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


                <div class="security-card-content">

                    <h3>
                        Ajuda e suporte
                    </h3>

                    <p>
                        Tire dúvidas e encontre ajuda
                    </p>

                </div>


                <span class="security-arrow">
                    ›
                </span>

            </div>

        </section>


        <!-- =================================================
             CONTATOS DE CONFIANÇA
        ================================================== -->

        <section
            class="contacts-card"
            onclick="abrirContatos()"
            role="button"
            tabindex="0"
        >

            <div class="contacts-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <circle
                        cx="9"
                        cy="8"
                        r="3"
                    />

                    <path
                        d="M3 20c0-3.5 2.5-6 6-6s6 2.5 6 6"
                    />

                    <path
                        d="M17 11a3 3 0 1 0 0-6"
                    />

                    <path
                        d="M17 14c2.5 0 4 1.7 4 4"
                    />

                </svg>

            </div>


            <div class="contacts-content">

                <h3>
                    Contatos de confiança
                </h3>

                <p>
                    Adicione pessoas para receber seus alertas
                </p>

                <span class="add-contact-text">

                    <span class="add-contact-plus">
                        +
                    </span>

                    Adicionar contato

                </span>

            </div>


            <span class="contacts-arrow">
                ›
            </span>

        </section>


        <!-- =================================================
             SAIR
        ================================================== -->

        <button
            class="logout-button"
            onclick="sairConta()"
        >
            Sair da conta
        </button>

    </main>


    <!-- =====================================================
         MENU INFERIOR
    ====================================================== -->

    <nav class="bottom-nav">

        <!-- INÍCIO -->

        <button
            class="nav-button"
            onclick="abrirPagina('inicio.php')"
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
            class="nav-button"
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

                <path d="M9 3v15" />

                <path d="M15 6v15" />

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
                    d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-2 2-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21h-3v-.8a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-2-2 .1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-.3-1.9 1.7 1.7 0 0 0-1.6-1h-.8v-3h.8a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9L6 7.9l2-2 .1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V4h3v.8a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 2 2-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 .3 1.9 1.7 1.7 0 0 0 1.6 1h.8v3h-.8a1.7 1.7 0 0 0-1.6 1z"
                />

            </svg>

            <span>
                Config.
            </span>

        </button>


        <!-- PERFIL -->

        <button
            class="nav-button active"
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
           NAVEGAÇÃO
        ===================================================== */

        function abrirPagina(pagina) {
            window.location.href = pagina;
        }

        function voltarInicio() {
            window.location.href = "inicio.php";
        }

        function abrirAjuda() {
            window.location.href = "ajuda.php";
        }

        function abrirContatos() {
            window.location.href =
                "contatos-emergencia.php";
        }


        /* =====================================================
           FOTO DE PERFIL
        ===================================================== */

        function editarFoto() {

            document
                .getElementById("inputFoto")
                .click();

        }


        document
            .getElementById("inputFoto")
            .addEventListener(
                "change",
                function(event) {

                    const arquivo =
                        event.target.files[0];

                    if (!arquivo) {
                        return;
                    }

                    if (!arquivo.type.startsWith("image/")) {

                        mostrarMensagem(
                            "Selecione uma imagem válida."
                        );

                        return;
                    }


                    const leitor =
                        new FileReader();


                    leitor.onload =
                        function(e) {

                            const imagem =
                                e.target.result;


                            localStorage.setItem(
                                "silenthelpFotoPerfil",
                                imagem
                            );


                            mostrarFoto(imagem);


                            mostrarMensagem(
                                "Foto de perfil atualizada!"
                            );

                        };


                    leitor.onerror =
                        function() {

                            mostrarMensagem(
                                "Não foi possível carregar a foto."
                            );

                        };


                    leitor.readAsDataURL(arquivo);

                }
            );


        function mostrarFoto(imagem) {

            const container =
                document.getElementById(
                    "profilePhoto"
                );


            container.innerHTML = "";


            const img =
                document.createElement("img");


            img.src = imagem;
            img.alt = "Foto de perfil";


            container.appendChild(img);

        }


        /* =====================================================
           DADOS DO USUÁRIO
        ===================================================== */

        const dadosPadrao = {

            nome:
                <?= json_encode($usuario['nome'] ?? 'Usuário', JSON_UNESCAPED_UNICODE) ?>,

            email:
                <?= json_encode($usuario['email'] ?? 'Não informado', JSON_UNESCAPED_UNICODE) ?>,

            telefone:
                <?= json_encode($usuario['telefone'] ?? 'Não informado', JSON_UNESCAPED_UNICODE) ?>

        };


        /* =====================================================
           CARREGAR DADOS
        ===================================================== */

        function carregarDados() {

            const nomeSalvo =
                localStorage.getItem(
                    "silenthelpNome"
                ) || dadosPadrao.nome;


            const emailSalvo =
                localStorage.getItem(
                    "silenthelpEmail"
                ) || dadosPadrao.email;


            const telefoneSalvo =
                localStorage.getItem(
                    "silenthelpTelefone"
                ) || dadosPadrao.telefone;


            document
                .getElementById("nomeUsuario")
                .textContent =
                nomeSalvo;


            document
                .getElementById("nomePerfil")
                .textContent =
                nomeSalvo;


            document
                .getElementById("emailUsuario")
                .textContent =
                emailSalvo;


            document
                .getElementById("emailPerfil")
                .textContent =
                emailSalvo;


            document
                .getElementById("telefoneUsuario")
                .textContent =
                telefoneSalvo;

        }


        /* =====================================================
           GERENCIAR CÓDIGO DO RESPONSÁVEL
        ===================================================== */

        function gerarCodigoResponsavel() {

            const caracteres =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

            let codigo = "";


            for (let i = 0; i < 6; i++) {

                codigo +=
                    caracteres.charAt(
                        Math.floor(
                            Math.random() *
                            caracteres.length
                        )
                    );

            }


            localStorage.setItem(
                "silenthelpCodigoResponsavel",
                codigo
            );


            document
                .getElementById(
                    "codigoResponsavelDisplay"
                )
                .textContent =
                codigo;


            mostrarMensagem(
                "Novo código gerado com sucesso!"
            );

        }


        function carregarCodigoResponsavel() {

            const codigoSalvo =
                localStorage.getItem(
                    "silenthelpCodigoResponsavel"
                );


            if (codigoSalvo) {

                document
                    .getElementById(
                        "codigoResponsavelDisplay"
                    )
                    .textContent =
                    codigoSalvo;

            }

        }


        function copiarCodigoResponsavel() {

            const codigo =
                document
                    .getElementById(
                        "codigoResponsavelDisplay"
                    )
                    .textContent;


            if (
                codigo === "-------" ||
                !codigo
            ) {

                mostrarMensagem(
                    "Gere um código primeiro."
                );

                return;

            }


            if (
                navigator.clipboard &&
                navigator.clipboard.writeText
            ) {

                navigator.clipboard
                    .writeText(codigo)
                    .then(function() {

                        mostrarMensagem(
                            "Código copiado para a área de transferência!"
                        );

                    })
                    .catch(function() {

                        mostrarMensagem(
                            "Erro ao copiar o código."
                        );

                    });

            } else {

                mostrarMensagem(
                    "Seu navegador não permite copiar automaticamente."
                );

            }

        }


        /* =====================================================
           EDITAR NOME
        ===================================================== */

        function editarNome() {

            const nomeAtual =
                document
                    .getElementById("nomeUsuario")
                    .textContent
                    .trim();


            const novoNome =
                prompt(
                    "Digite seu novo nome:",
                    nomeAtual
                );


            if (
                novoNome === null ||
                novoNome.trim() === ""
            ) {

                return;

            }


            const nomeFinal =
                novoNome.trim();


            localStorage.setItem(
                "silenthelpNome",
                nomeFinal
            );


            document
                .getElementById("nomeUsuario")
                .textContent =
                nomeFinal;


            document
                .getElementById("nomePerfil")
                .textContent =
                nomeFinal;


            mostrarMensagem(
                "Nome atualizado com sucesso!"
            );

        }


        /* =====================================================
           EDITAR E-MAIL
        ===================================================== */

        function editarEmail() {

            const emailAtual =
                document
                    .getElementById("emailUsuario")
                    .textContent
                    .trim();


            const novoEmail =
                prompt(
                    "Digite seu novo e-mail:",
                    emailAtual
                );


            if (
                novoEmail === null ||
                novoEmail.trim() === ""
            ) {

                return;

            }


            const emailFinal =
                novoEmail.trim();


            if (
                !emailFinal.includes("@") ||
                !emailFinal.includes(".")
            ) {

                mostrarMensagem(
                    "Digite um e-mail válido."
                );

                return;

            }


            localStorage.setItem(
                "silenthelpEmail",
                emailFinal
            );


            document
                .getElementById("emailUsuario")
                .textContent =
                emailFinal;


            document
                .getElementById("emailPerfil")
                .textContent =
                emailFinal;


            mostrarMensagem(
                "E-mail atualizado com sucesso!"
            );

        }


        /* =====================================================
           EDITAR TELEFONE
        ===================================================== */

        function editarTelefone() {

            const telefoneAtual =
                document
                    .getElementById("telefoneUsuario")
                    .textContent
                    .trim();


            const novoTelefone =
                prompt(
                    "Digite seu telefone:",
                    telefoneAtual
                );


            if (
                novoTelefone === null ||
                novoTelefone.trim() === ""
            ) {

                return;

            }


            const telefoneFinal =
                novoTelefone.trim();


            localStorage.setItem(
                "silenthelpTelefone",
                telefoneFinal
            );


            document
                .getElementById("telefoneUsuario")
                .textContent =
                telefoneFinal;


            mostrarMensagem(
                "Telefone atualizado com sucesso!"
            );

        }


        /* =====================================================
           CARREGAR FOTO SALVA
        ===================================================== */

        function carregarFotoPerfil() {

            const fotoSalva =
                localStorage.getItem(
                    "silenthelpFotoPerfil"
                );


            if (fotoSalva) {

                mostrarFoto(fotoSalva);

            }

        }


        /* =====================================================
           SAIR
        ===================================================== */

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
                    function() {

                        window.location.href =
                            "logout.php";

                    },
                    800
                );

            }

        }


        /* =====================================================
           TOAST
        ===================================================== */

        function mostrarMensagem(mensagem) {

            const toast =
                document.getElementById(
                    "toast"
                );


            toast.textContent =
                mensagem;


            toast.classList.add(
                "show"
            );


            setTimeout(
                function() {

                    toast.classList.remove(
                        "show"
                    );

                },
                3000
            );

        }


        /* =====================================================
           INICIALIZAÇÃO
        ===================================================== */

        document.addEventListener(
            "DOMContentLoaded",
            function() {

                carregarDados();
                carregarFotoPerfil();
                carregarCodigoResponsavel();

            }
        );

    </script>


    <script src="assets/db-sync.js"></script>

</body>

</html>