<?php

require_once __DIR__ . "/auth.php";

$usuario = exigirLogin();

$nomeUsuario = $usuario["nome"];

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#08070c">

    <meta name="description" content="SilentHelp - Sistema de segurança e proteção">

    <title>SilentHelp - Início</title>


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

                radial-gradient(circle at 50% -15%,
                    rgba(168, 85, 247, .20),
                    transparent 35%),

                radial-gradient(circle at 100% 25%,
                    rgba(112, 45, 181, .12),
                    transparent 30%),

                radial-gradient(circle at 0% 70%,
                    rgba(168, 85, 247, .06),
                    transparent 30%),

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
                radial-gradient(rgba(255, 255, 255, .035) 1px,
                    transparent 1px);

            background-size: 28px 28px;

            mask-image:
                linear-gradient(to bottom,
                    black,
                    transparent 70%);

            opacity: .25;

            z-index: -1;
        }


        button,
        input,
        textarea {
            font-family: inherit;
        }


        button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }


        /* =====================================================
           APP
        ===================================================== */

        .app {

            width: 100%;

            max-width: 1080px;

            margin: auto;

            padding:
                28px 25px 150px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 34px;
        }


        .logo {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .logo-heart {

            width: 51px;
            height: 51px;

            color: var(--roxo-2);

            filter:
                drop-shadow(0 0 16px rgba(168, 85, 247, .35));
        }


        .logo-text {

            font-size: 34px;

            font-weight: 750;

            letter-spacing: -1.5px;
        }


        .logo-text .silent {
            color: var(--roxo-2);
        }


        .logo-text .help {
            color: white;
        }


        /* =====================================================
           NOTIFICAÇÃO
        ===================================================== */

        .notification {

            position: relative;

            width: 50px;
            height: 50px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid var(--borda);

            border-radius: 16px;

            background:
                rgba(255, 255, 255, .035);

            color: var(--roxo-claro);

            cursor: pointer;

            backdrop-filter:
                blur(15px);

            transition:
                transform .2s,
                background .2s,
                border-color .2s;
        }


        .notification:hover {

            transform: translateY(-3px);

            background:
                rgba(168, 85, 247, .10);

            border-color:
                var(--borda-roxa);
        }


        .notification svg {

            width: 24px;
            height: 24px;
        }


        .notification-badge {

            position: absolute;

            top: -5px;
            right: -5px;

            min-width: 21px;
            height: 21px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                var(--vermelho);

            color: white;

            font-size: 10px;

            font-weight: 800;

            border:
                2px solid var(--fundo);

            box-shadow:
                0 0 12px rgba(255, 93, 115, .3);
        }


        /* =====================================================
           SAUDAÇÃO
        ===================================================== */

        .greeting {
            margin-bottom: 17px;
        }


        .greeting h1 {

            font-size: 40px;

            font-weight: 500;

            letter-spacing: -1.2px;

            margin-bottom: 7px;
        }


        .greeting h1 span {

            color: var(--roxo-claro);

            font-weight: 700;
        }


        .greeting p {

            color: var(--cinza);

            font-size: 17px;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 9px;

            padding:
                10px 16px;

            margin-bottom: 24px;

            border:
                1px solid rgba(85, 223, 145, .18);

            border-radius: 30px;

            background:
                linear-gradient(135deg,
                    rgba(85, 223, 145, .09),
                    rgba(85, 223, 145, .035));

            color: var(--verde);

            font-size: 14px;

            font-weight: 600;
        }


        .status-dot {

            width: 8px;
            height: 8px;

            border-radius: 50%;

            background: var(--verde);

            box-shadow:
                0 0 12px rgba(85, 223, 145, .7);
        }


        /* =====================================================
           SOS CARD
        ===================================================== */

        .sos-card {

            position: relative;

            display: flex;

            align-items: center;

            gap: 45px;

            min-height: 315px;

            padding: 35px;

            margin-bottom: 30px;

            overflow: hidden;

            border:
                1px solid rgba(168, 85, 247, .32);

            border-radius: 30px;

            background:

                radial-gradient(circle at 15% 50%,
                    rgba(168, 85, 247, .18),
                    transparent 32%),

                radial-gradient(circle at 90% 0%,
                    rgba(208, 160, 255, .07),
                    transparent 25%),

                linear-gradient(145deg,
                    rgba(29, 22, 38, .95),
                    rgba(10, 9, 14, .96));

            box-shadow:

                0 25px 80px rgba(0, 0, 0, .40),

                inset 0 1px 0 rgba(255, 255, 255, .05);
        }


        .sos-card::before {

            content: "";

            position: absolute;

            width: 320px;
            height: 320px;

            left: -180px;
            top: -70px;

            border-radius: 50%;

            border:
                1px solid rgba(168, 85, 247, .12);

            box-shadow:
                0 0 80px rgba(168, 85, 247, .08);

            pointer-events: none;
        }


        .sos-card::after {

            content: "";

            position: absolute;

            width: 240px;
            height: 240px;

            right: -120px;
            bottom: -150px;

            border-radius: 50%;

            background:
                rgba(168, 85, 247, .08);

            filter: blur(20px);

            pointer-events: none;
        }


        /* =====================================================
           SOS CÍRCULO
        ===================================================== */

        .sos-circle-area {

            width: 220px;
            height: 220px;

            min-width: 220px;

            display: flex;

            align-items: center;
            justify-content: center;

            position: relative;
        }


        .sos-ring {

            position: absolute;

            border-radius: 50%;

            border:
                1px solid rgba(183, 108, 255, .18);
        }


        .ring-1 {

            width: 220px;
            height: 220px;
        }


        .ring-2 {

            width: 180px;
            height: 180px;

            border-color:
                rgba(183, 108, 255, .23);
        }


        .ring-3 {

            width: 145px;
            height: 145px;

            border-color:
                rgba(183, 108, 255, .28);
        }


        .sos-button {

            position: relative;

            z-index: 2;

            width: 122px;
            height: 122px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                3px solid rgba(255, 255, 255, .18);

            border-radius: 50%;

            background:

                radial-gradient(circle at 35% 25%,
                    #d18bff,
                    #a855f7 48%,
                    #7432b5 100%);

            color: white;

            font-size: 29px;

            font-weight: 850;

            letter-spacing: 1px;

            cursor: pointer;

            box-shadow:

                0 0 0 10px rgba(168, 85, 247, .06),

                0 0 45px rgba(168, 85, 247, .45),

                inset 0 2px 5px rgba(255, 255, 255, .25);

            transition:
                transform .2s,
                box-shadow .2s;
        }


        .sos-button:hover {

            transform: scale(1.05);

            box-shadow:

                0 0 0 12px rgba(168, 85, 247, .08),

                0 0 60px rgba(168, 85, 247, .58),

                inset 0 2px 5px rgba(255, 255, 255, .25);
        }


        .sos-button:active {
            transform: scale(.96);
        }


        /* =====================================================
           CONTEÚDO SOS
        ===================================================== */

        .sos-content {

            position: relative;

            z-index: 2;

            flex: 1;
        }


        .sos-content h2 {

            font-size: 32px;

            font-weight: 650;

            letter-spacing: -.7px;

            margin-bottom: 9px;
        }


        .sos-content p {

            max-width: 490px;

            color: var(--cinza);

            font-size: 17px;

            line-height: 1.7;

            margin-bottom: 23px;
        }


        .emergency-button {

            width: 100%;

            max-width: 490px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            padding: 17px 20px;

            border:
                1px solid rgba(255, 255, 255, .10);

            border-radius: 15px;

            background:
                linear-gradient(100deg,
                    #8f43d1,
                    #a855f7,
                    #b96dff);

            color: white;

            font-size: 15px;

            font-weight: 750;

            letter-spacing: .3px;

            cursor: pointer;

            box-shadow:
                0 10px 30px rgba(168, 85, 247, .18);

            transition:
                transform .2s,
                filter .2s,
                box-shadow .2s;
        }


        .emergency-button:hover {

            transform: translateY(-2px);

            filter: brightness(1.08);

            box-shadow:
                0 14px 35px rgba(168, 85, 247, .28);
        }


        /* =====================================================
           TÍTULOS
        ===================================================== */

        .section-title {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 15px;
        }


        .section-title h2 {

            font-size: 22px;

            font-weight: 600;

            letter-spacing: -.3px;
        }


        /* =====================================================
           PAINEL DE SEGURANÇA
        ===================================================== */

        .security-panel {
            margin-bottom: 30px;
        }


        .panel-status {

            display: flex;

            align-items: center;

            gap: 7px;

            color: var(--verde);

            font-size: 12px;

            font-weight: 600;
        }


        .panel-status-dot {

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--verde);

            box-shadow:
                0 0 10px rgba(85, 223, 145, .7);
        }


        .security-box {

            padding: 22px;

            border:
                1px solid var(--borda);

            border-radius: 25px;

            background:

                linear-gradient(145deg,
                    rgba(20, 18, 26, .88),
                    rgba(10, 10, 14, .92));

            box-shadow:
                var(--sombra);

            backdrop-filter:
                blur(18px);
        }


        .security-message {

            display: flex;

            align-items: center;

            gap: 14px;

            margin-bottom: 19px;
        }


        .shield-icon {

            width: 54px;
            height: 54px;

            min-width: 54px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(168, 85, 247, .18);

            border-radius: 16px;

            background:
                linear-gradient(145deg,
                    rgba(168, 85, 247, .16),
                    rgba(168, 85, 247, .06));

            color: var(--roxo-claro);
        }


        .shield-icon svg {

            width: 28px;
            height: 28px;
        }


        .security-message h3 {

            font-size: 19px;

            font-weight: 600;

            margin-bottom: 3px;
        }


        .security-message p {

            color: var(--cinza);

            font-size: 14px;
        }


        /* =====================================================
           INFORMAÇÕES
        ===================================================== */

        .security-info-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 11px;

            margin-bottom: 18px;
        }


        .info-card {

            min-height: 115px;

            padding: 15px;

            border:
                1px solid rgba(255, 255, 255, .065);

            border-radius: 18px;

            background:
                rgba(9, 9, 13, .65);

            transition:
                transform .2s,
                border-color .2s,
                background .2s;
        }


        .info-card:hover {

            transform: translateY(-3px);

            border-color:
                rgba(168, 85, 247, .28);

            background:
                rgba(168, 85, 247, .045);
        }


        .info-card-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 8px;

            margin-bottom: 13px;
        }


        .info-icon {

            width: 36px;
            height: 36px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(168, 85, 247, .10);

            color: var(--roxo-claro);
        }


        .info-icon svg {

            width: 19px;
            height: 19px;
        }


        .info-value {

            color: var(--verde);

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .4px;
        }


        .battery-value {
            color: var(--roxo-claro);
        }


        .info-card h4 {

            font-size: 16px;

            font-weight: 600;

            margin-bottom: 4px;
        }


        .info-card p {

            color: var(--cinza);

            font-size: 13px;
        }


        /* =====================================================
           VERIFICAÇÃO
        ===================================================== */

        .check-time {

            display: flex;

            align-items: center;

            gap: 6px;

            color: var(--cinza);

            font-size: 13px;

            margin-bottom: 14px;
        }


        .check-time strong {

            color: white;

            font-weight: 500;
        }


        .test-button {

            width: 100%;

            padding: 15px;

            border:
                1px solid rgba(168, 85, 247, .30);

            border-radius: 14px;

            background:
                rgba(168, 85, 247, .07);

            color: var(--roxo-claro);

            font-size: 14px;

            font-weight: 650;

            cursor: pointer;

            transition:
                background .2s,
                border-color .2s,
                transform .2s;
        }


        .test-button:hover {

            transform: translateY(-1px);

            background:
                rgba(168, 85, 247, .13);

            border-color:
                rgba(168, 85, 247, .55);
        }


        /* =====================================================
           RECURSOS
        ===================================================== */

        .security-shortcuts {
            margin-bottom: 30px;
        }


        .shortcut-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 13px;
        }


        .shortcut-card {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 14px;

            padding: 18px;

            border:
                1px solid var(--borda);

            border-radius: 21px;

            background:
                linear-gradient(145deg,
                    rgba(20, 18, 26, .88),
                    rgba(11, 10, 15, .92));

            color: white;

            text-align: left;

            cursor: pointer;

            box-shadow:
                0 12px 35px rgba(0, 0, 0, .18);

            transition:
                transform .2s,
                border-color .2s,
                background .2s;
        }


        .shortcut-card:hover {

            transform: translateY(-3px);

            border-color:
                rgba(168, 85, 247, .40);

            background:
                linear-gradient(145deg,
                    rgba(29, 22, 38, .95),
                    rgba(12, 10, 17, .95));
        }


        .shortcut-icon {

            width: 52px;
            height: 52px;

            min-width: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(168, 85, 247, .14);

            border-radius: 15px;

            background:
                rgba(168, 85, 247, .10);

            color: var(--roxo-claro);
        }


        .shortcut-icon svg {

            width: 25px;
            height: 25px;
        }


        .shortcut-card div:nth-child(2) {
            flex: 1;
        }


        .shortcut-card h3 {

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 4px;
        }


        .shortcut-card p {

            color: var(--cinza);

            font-size: 13px;

            line-height: 1.5;
        }


        .shortcut-card>span {

            color: var(--cinza-2);

            font-size: 30px;

            transition:
                transform .2s,
                color .2s;
        }


        .shortcut-card:hover>span {

            color: var(--roxo-claro);

            transform: translateX(3px);
        }


        /* =====================================================
           MEU DIÁRIO
        ===================================================== */

        .diary-card {

            position: relative;

            display: flex;

            align-items: center;

            gap: 18px;

            padding: 22px;

            margin-bottom: 20px;

            overflow: hidden;

            border:
                1px solid rgba(168, 85, 247, .30);

            border-radius: 25px;

            background:

                radial-gradient(circle at 0% 50%,
                    rgba(168, 85, 247, .15),
                    transparent 35%),

                linear-gradient(145deg,
                    rgba(25, 20, 32, .95),
                    rgba(10, 9, 14, .97));

            box-shadow:
                0 15px 45px rgba(0, 0, 0, .25),

                inset 0 1px 0 rgba(255, 255, 255, .04);
        }


        .diary-card::after {

            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            right: -90px;
            top: -90px;

            border-radius: 50%;

            background:
                rgba(168, 85, 247, .08);

            filter: blur(20px);

            pointer-events: none;
        }


        .diary-icon {

            width: 62px;
            height: 62px;

            min-width: 62px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(168, 85, 247, .25);

            border-radius: 18px;

            background:
                linear-gradient(145deg,
                    rgba(168, 85, 247, .18),
                    rgba(168, 85, 247, .07));

            font-size: 29px;

            position: relative;

            z-index: 2;
        }


        .diary-content {

            flex: 1;

            position: relative;

            z-index: 2;
        }


        .diary-content h3 {

            font-size: 20px;

            font-weight: 650;

            margin-bottom: 5px;
        }


        .diary-content p {

            color: var(--cinza);

            font-size: 14px;

            line-height: 1.5;
        }


        .diary-button {

            flex-shrink: 0;

            position: relative;

            z-index: 2;

            padding:
                13px 20px;

            border:
                1px solid rgba(168, 85, 247, .35);

            border-radius: 14px;

            background:
                linear-gradient(100deg,
                    #8f43d1,
                    #a855f7);

            color: white;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 25px rgba(168, 85, 247, .18);

            transition:
                transform .2s,
                filter .2s,
                box-shadow .2s;
        }


        .diary-button:hover {

            transform: translateY(-2px);

            filter: brightness(1.08);

            box-shadow:
                0 12px 30px rgba(168, 85, 247, .30);
        }


        .diary-button:active {
            transform: scale(.97);
        }


        /* =====================================================
           PROTEÇÃO
        ===================================================== */

        .protected-card {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 18px;

            margin-bottom: 20px;

            border:
                1px solid rgba(85, 223, 145, .16);

            border-radius: 21px;

            background:

                linear-gradient(145deg,
                    rgba(85, 223, 145, .065),
                    rgba(11, 13, 15, .88));

            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, .03);
        }


        .protected-icon {

            width: 53px;
            height: 53px;

            min-width: 53px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background:
                rgba(85, 223, 145, .08);

            color: var(--verde);
        }


        .protected-icon svg {

            width: 27px;
            height: 27px;
        }


        .protected-text {
            flex: 1;
        }


        .protected-text h3 {

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 3px;
        }


        .protected-text p {

            color: var(--cinza);

            font-size: 13px;
        }


        .arrow {

            color: var(--cinza-2);

            font-size: 30px;
        }


        /* =====================================================
           MENU INFERIOR
        ===================================================== */

        .bottom-nav {

            position: fixed;

            left: 50%;

            bottom: 15px;

            transform:
                translateX(-50%);

            width:
                min(calc(100% - 30px),
                    850px);

            height: 82px;

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 0;

            padding: 5px;

            align-items: stretch;

            border:
                1px solid rgba(255, 255, 255, .08);

            border-radius: 25px;

            background:
                rgba(17, 15, 22, .88);

            box-shadow:

                0 20px 60px rgba(0, 0, 0, .55),

                inset 0 1px 0 rgba(255, 255, 255, .05);

            backdrop-filter:
                blur(22px);

            -webkit-backdrop-filter:
                blur(22px);

            z-index: 1000;
        }


        .nav-button {

            position: relative;

            width: 100%;
            height: 100%;

            min-width: 0;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 5px;

            padding: 0;

            border: none;

            border-radius: 18px;

            background: transparent;

            color: #777181;

            cursor: pointer;

            font-size: 12px;

            line-height: 1.2;

            transition:
                color .2s,
                background .2s,
                transform .2s;
        }


        .nav-button svg {

            width: 25px;
            height: 25px;

            flex-shrink: 0;

            transition:
                transform .2s;
        }


        .nav-button.active {

            color: var(--roxo-claro);

            background:
                linear-gradient(145deg,
                    rgba(168, 85, 247, .16),
                    rgba(168, 85, 247, .05));
        }


        .nav-button.active::before {

            content: "";

            position: absolute;

            top: 5px;

            width: 24px;
            height: 2px;

            border-radius: 5px;

            background:
                var(--roxo-2);

            box-shadow:
                0 0 10px rgba(168, 85, 247, .65);
        }


        .nav-button:hover {

            color: var(--roxo-claro);

            background:
                rgba(168, 85, 247, .07);
        }


        .nav-button:hover svg {

            transform:
                translateY(-2px);
        }



        /* =====================================================
           CHAT FLUTUANTE COM RESPONSÁVEL
        ===================================================== */

        .chat-float-button {
            position: fixed;
            right: 28px;
            bottom: 112px;
            width: 62px;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 50%;
            background: linear-gradient(145deg, #b96dff, #8f43d1);
            color: white;
            cursor: pointer;
            z-index: 1800;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, .45),
                0 0 30px rgba(168, 85, 247, .28);
            transition: transform .2s, filter .2s, box-shadow .2s;
        }

        .chat-float-button:hover {
            transform: translateY(-3px) scale(1.04);
            filter: brightness(1.08);
            box-shadow:
                0 18px 45px rgba(0, 0, 0, .50),
                0 0 38px rgba(168, 85, 247, .40);
        }

        .chat-float-button:active {
            transform: scale(.96);
        }

        .chat-float-button svg {
            width: 29px;
            height: 29px;
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
            color: white;
            border: 2px solid var(--fundo);
            font-size: 10px;
            font-weight: 800;
        }

        .responsible-chat {
            position: fixed;
            right: 28px;
            bottom: 184px;
            width: min(380px, calc(100vw - 30px));
            height: min(560px, calc(100vh - 210px));
            min-height: 420px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(168, 85, 247, .34);
            border-radius: 25px;
            background:
                linear-gradient(145deg,
                    rgba(29, 22, 38, .98),
                    rgba(10, 9, 14, .98));
            box-shadow:
                0 30px 90px rgba(0, 0, 0, .62),
                0 0 35px rgba(168, 85, 247, .12);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            z-index: 1700;
            opacity: 0;
            visibility: hidden;
            transform: translateY(18px) scale(.96);
            transform-origin: bottom right;
            pointer-events: none;
            transition: opacity .22s, transform .22s, visibility .22s;
        }

        .responsible-chat.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 17px 17px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            background: rgba(168, 85, 247, .055);
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
            background: linear-gradient(145deg, rgba(168, 85, 247, .22), rgba(168, 85, 247, .08));
            color: var(--roxo-claro);
        }

        .chat-avatar svg {
            width: 24px;
            height: 24px;
        }

        .chat-header-info {
            flex: 1;
            min-width: 0;
        }

        .chat-header-info strong {
            display: block;
            font-size: 15px;
            margin-bottom: 3px;
        }

        .chat-online {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--verde);
            font-size: 11px;
        }

        .chat-online-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--verde);
            box-shadow: 0 0 9px rgba(85, 223, 145, .65);
        }

        .chat-close {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 11px;
            background: rgba(255, 255, 255, .035);
            color: var(--cinza);
            cursor: pointer;
            font-size: 21px;
            line-height: 1;
        }

        .chat-close:hover {
            color: white;
            background: rgba(168, 85, 247, .10);
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
        }

        .chat-messages::-webkit-scrollbar {
            width: 5px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: rgba(168, 85, 247, .35);
            border-radius: 10px;
        }

        .chat-message {
            max-width: 82%;
            padding: 10px 12px;
            border-radius: 15px;
            font-size: 13px;
            line-height: 1.45;
            word-wrap: break-word;
        }

        .chat-message.responsavel {
            align-self: flex-start;
            border: 1px solid rgba(255, 255, 255, .065);
            border-top-left-radius: 5px;
            background: rgba(255, 255, 255, .055);
            color: #eee;
        }

        .chat-message.usuario {
            align-self: flex-end;
            border: 1px solid rgba(168, 85, 247, .25);
            border-top-right-radius: 5px;
            background: linear-gradient(145deg, rgba(168, 85, 247, .25), rgba(112, 45, 181, .22));
            color: white;
        }

        .chat-time {
            display: block;
            margin-top: 4px;
            color: var(--cinza-2);
            font-size: 9px;
            text-align: right;
        }

        .chat-quick-actions {
            display: flex;
            gap: 7px;
            padding: 0 14px 10px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .chat-quick-actions::-webkit-scrollbar {
            display: none;
        }

        .chat-quick-actions button {
            flex-shrink: 0;
            padding: 8px 10px;
            border: 1px solid rgba(168, 85, 247, .24);
            border-radius: 12px;
            background: rgba(168, 85, 247, .07);
            color: var(--roxo-claro);
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
        }

        .chat-quick-actions button:hover {
            background: rgba(168, 85, 247, .14);
        }

        .chat-input-area {
            display: flex;
            gap: 8px;
            padding: 11px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            background: rgba(7, 6, 10, .55);
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
            color: white;
            font-size: 13px;
        }

        .chat-input::placeholder {
            color: #777181;
        }

        .chat-input:focus {
            border-color: rgba(168, 85, 247, .55);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, .07);
        }

        .chat-send {
            width: 43px;
            height: 43px;
            min-width: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 13px;
            background: linear-gradient(145deg, #b96dff, #8f43d1);
            color: white;
            cursor: pointer;
        }

        .chat-send:hover {
            filter: brightness(1.08);
        }

        .chat-send svg {
            width: 19px;
            height: 19px;
        }

        .chat-typing {
            align-self: flex-start;
            display: none;
            align-items: center;
            gap: 4px;
            padding: 9px 12px;
            border-radius: 15px;
            border-top-left-radius: 5px;
            background: rgba(255, 255, 255, .055);
        }

        .chat-typing.show {
            display: flex;
        }

        .chat-typing span {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--cinza);
            animation: chatTyping 1s infinite ease-in-out;
        }

        .chat-typing span:nth-child(2) {
            animation-delay: .15s;
        }

        .chat-typing span:nth-child(3) {
            animation-delay: .3s;
        }

        @keyframes chatTyping {

            0%,
            60%,
            100% {
                opacity: .35;
                transform: translateY(0);
            }

            30% {
                opacity: 1;
                transform: translateY(-3px);
            }
        }


        /* =====================================================
           TOAST
        ===================================================== */

        .toast {

            position: fixed;

            left: 50%;

            bottom: 118px;

            transform:
                translate(-50%, 25px);

            opacity: 0;

            pointer-events: none;

            z-index: 5000;

            width: max-content;

            max-width: 90%;

            padding:
                14px 21px;

            border:
                1px solid rgba(168, 85, 247, .45);

            border-radius: 15px;

            background:
                rgba(24, 21, 30, .94);

            color: white;

            font-size: 14px;

            text-align: center;

            box-shadow:
                0 15px 45px rgba(0, 0, 0, .45);

            backdrop-filter:
                blur(15px);

            transition:
                opacity .3s,
                transform .3s;
        }


        .toast.show {

            opacity: 1;

            transform:
                translate(-50%, 0);
        }


        /* =====================================================
           MODAIS
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

            z-index: 3000;

            overflow-y: auto;
        }


        .modal.show {
            display: flex;
        }


        .modal-content {

            width: 100%;

            max-width: 430px;

            padding: 29px;

            border:
                1px solid rgba(168, 85, 247, .38);

            border-radius: 25px;

            background:

                linear-gradient(145deg,
                    rgba(29, 22, 38, .98),
                    rgba(10, 9, 14, .98));

            text-align: center;

            box-shadow:
                0 30px 90px rgba(0, 0, 0, .65);
        }


        .modal-icon {

            width: 60px;
            height: 60px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin:
                0 auto 16px;

            border-radius: 17px;

            background:
                rgba(168, 85, 247, .12);

            font-size: 28px;
        }


        .modal-content h2 {

            font-size: 23px;

            margin-bottom: 9px;
        }


        .modal-content p {

            color: var(--cinza);

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 21px;
        }


        .modal-buttons {

            display: flex;

            gap: 10px;
        }


        .modal-buttons button {

            flex: 1;

            padding: 13px;

            border-radius: 13px;

            font-size: 14px;

            font-weight: 650;

            cursor: pointer;
        }


        .cancel-button {

            border:
                1px solid var(--borda);

            background:
                rgba(255, 255, 255, .035);

            color: white;
        }


        .confirm-button {

            border: none;

            background:
                linear-gradient(100deg,
                    #8f43d1,
                    #a855f7);

            color: white;
        }


        .confirm-button:hover {
            filter: brightness(1.1);
        }


        /* =====================================================
           FORMULÁRIO DO DIÁRIO
        ===================================================== */

        .diary-modal {
            text-align: left;
        }


        .diary-modal .modal-icon {
            margin-left: 0;
            margin-right: auto;
        }


        .diary-form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }


        .diary-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }


        .diary-field label {

            color: #eee;

            font-size: 13px;

            font-weight: 600;
        }


        .diary-field input,
        .diary-field textarea {

            width: 100%;

            border:
                1px solid rgba(255, 255, 255, .09);

            border-radius: 13px;

            outline: none;

            background:
                rgba(7, 7, 11, .72);

            color: white;

            padding:
                12px 13px;

            font-size: 14px;

            transition:
                border-color .2s,
                background .2s,
                box-shadow .2s;
        }


        .diary-field input:focus,
        .diary-field textarea:focus {

            border-color:
                rgba(168, 85, 247, .60);

            background:
                rgba(168, 85, 247, .045);

            box-shadow:
                0 0 0 3px rgba(168, 85, 247, .08);
        }


        .diary-field textarea {

            min-height: 95px;

            resize: vertical;
        }


        .diary-field textarea#diaryRelato {
            min-height: 120px;
        }


        .diary-actions {

            display: flex;

            gap: 10px;

            margin-top: 5px;
        }


        .diary-actions button {

            flex: 1;

            padding: 13px;

            border-radius: 13px;

            font-size: 14px;

            font-weight: 650;

            cursor: pointer;
        }


        .diary-cancel {

            border:
                1px solid var(--borda);

            background:
                rgba(255, 255, 255, .035);

            color: white;
        }


        .diary-save {

            border: none;

            background:
                linear-gradient(100deg,
                    #8f43d1,
                    #a855f7);

            color: white;
        }


        .diary-save:hover {

            filter:
                brightness(1.08);
        }


        /* =====================================================
           NOTIFICAÇÕES
        ===================================================== */

        .notification-modal {
            text-align: left;
        }


        .notification-item {

            display: flex;

            gap: 12px;

            padding: 13px;

            margin-bottom: 9px;

            border:
                1px solid rgba(255, 255, 255, .06);

            border-radius: 14px;

            background:
                rgba(7, 7, 11, .65);
        }


        .notification-item-icon {

            width: 38px;
            height: 38px;

            min-width: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                rgba(168, 85, 247, .11);

            color: var(--roxo-claro);
        }


        .notification-item strong {

            display: block;

            font-size: 14px;

            margin-bottom: 3px;
        }


        .notification-item span {

            color: var(--cinza);

            font-size: 12px;
        }


        /* =====================================================
           CONFIRMAÇÃO DO CHAMADO ENVIADO
        ===================================================== */

        .success-modal {
            text-align: center;
        }


        .success-icon {

            width: 78px;
            height: 78px;

            display: flex;

            align-items: center;
            justify-content: center;

            margin:
                0 auto 18px;

            border-radius: 50%;

            background:
                rgba(85, 223, 145, .10);

            border:
                1px solid rgba(85, 223, 145, .35);

            color: var(--verde);

            box-shadow:
                0 0 35px rgba(85, 223, 145, .16);
        }


        .success-icon svg {

            width: 40px;
            height: 40px;
        }


        .success-modal h2 {

            font-size: 24px;

            margin-bottom: 10px;
        }


        .success-modal>p {

            color: var(--cinza);

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 20px;
        }


        .alert-details {

            padding: 15px;

            margin-bottom: 20px;

            border:
                1px solid rgba(85, 223, 145, .16);

            border-radius: 16px;

            background:
                rgba(85, 223, 145, .045);

            text-align: left;
        }


        .alert-detail {

            display: flex;

            justify-content: space-between;

            gap: 15px;

            padding: 7px 0;

            font-size: 13px;
        }


        .alert-detail span:first-child {

            color: var(--cinza);
        }


        .alert-detail span:last-child {

            color: white;

            font-weight: 600;

            text-align: right;
        }


        .alert-confirm-button {

            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 13px;

            background:
                linear-gradient(100deg,
                    #43bd78,
                    #55df91);

            color: #07100b;

            font-size: 14px;

            font-weight: 750;

            cursor: pointer;

            transition:
                transform .2s,
                filter .2s;
        }


        .alert-confirm-button:hover {

            transform: translateY(-2px);

            filter: brightness(1.08);
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 850px) {

            .security-info-grid {

                grid-template-columns:
                    repeat(2, 1fr);
            }


            .sos-card {
                gap: 28px;
            }
        }


        @media (max-width: 700px) {

            .app {

                padding:
                    19px 15px 130px;
            }


            .header {
                margin-bottom: 28px;
            }


            .logo-heart {

                width: 43px;
                height: 43px;
            }


            .logo-text {
                font-size: 30px;
            }


            .notification {

                width: 45px;
                height: 45px;
            }


            .greeting h1 {
                font-size: 31px;
            }


            .greeting p {
                font-size: 15px;
            }


            .status {
                font-size: 13px;
            }


            .sos-card {

                flex-direction: column;

                text-align: center;

                padding:
                    28px 18px;

                gap: 20px;

                min-height: auto;
            }


            .sos-circle-area {

                width: 180px;
                height: 180px;

                min-width: 180px;
            }


            .ring-1 {

                width: 180px;
                height: 180px;
            }


            .ring-2 {

                width: 150px;
                height: 150px;
            }


            .ring-3 {

                width: 125px;
                height: 125px;
            }


            .sos-button {

                width: 100px;
                height: 100px;

                font-size: 25px;
            }


            .sos-content h2 {
                font-size: 27px;
            }


            .sos-content p {

                font-size: 15px;

                margin-left: auto;
                margin-right: auto;
            }


            .emergency-button {

                max-width: 100%;

                font-size: 14px;
            }


            .section-title h2 {
                font-size: 20px;
            }


            .security-message h3 {
                font-size: 18px;
            }


            .security-message p {
                font-size: 13px;
            }


            .shortcut-grid {
                grid-template-columns: 1fr;
            }


            .shortcut-card h3 {
                font-size: 16px;
            }


            .shortcut-card p {
                font-size: 12px;
            }


            .diary-card {

                align-items: flex-start;

                padding: 20px;

                gap: 15px;
            }


            .diary-icon {

                width: 52px;
                height: 52px;

                min-width: 52px;

                border-radius: 15px;

                font-size: 24px;
            }


            .diary-content h3 {

                font-size: 17px;
            }


            .diary-content p {

                font-size: 12px;
            }


            .diary-button {

                padding:
                    11px 14px;

                font-size: 12px;
            }


            .protected-text h3 {
                font-size: 16px;
            }


            .protected-text p {
                font-size: 12px;
            }


            .bottom-nav {

                width: calc(100% - 24px);

                height: 76px;

                bottom: 9px;

                padding: 5px;

                border-radius: 21px;
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



        @media (max-width: 700px) {
            .chat-float-button {
                right: 18px;
                bottom: 98px;
                width: 58px;
                height: 58px;
            }

            .responsible-chat {
                right: 12px;
                bottom: 86px;
                width: calc(100vw - 24px);
                height: min(570px, calc(100vh - 105px));
                min-height: 400px;
                border-radius: 22px;
            }

            .chat-float-button.chat-open {
                opacity: 0;
                pointer-events: none;
                transform: scale(.85);
            }
        }


        @media (max-width: 480px) {

            .logo-text {
                font-size: 27px;
            }


            .greeting h1 {
                font-size: 28px;
            }


            .greeting p {
                font-size: 14px;
            }


            .sos-content h2 {
                font-size: 25px;
            }


            .sos-content p {
                font-size: 14px;
            }


            .security-info-grid {

                grid-template-columns:
                    repeat(2, 1fr);

                gap: 8px;
            }


            .info-card {

                min-height: 105px;

                padding: 12px;
            }


            .info-card h4 {
                font-size: 13px;
            }


            .info-card p {
                font-size: 11px;
            }


            .info-icon {

                width: 32px;
                height: 32px;
            }


            .info-icon svg {

                width: 17px;
                height: 17px;
            }


            .diary-card {

                display: grid;

                grid-template-columns:
                    52px 1fr;

                gap: 13px;

                padding: 18px;
            }


            .diary-button {

                grid-column:
                    1 / -1;

                width: 100%;

                padding: 13px;
            }


            .diary-content h3 {
                font-size: 17px;
            }


            .diary-content p {
                font-size: 12px;
            }


            .protected-text h3 {
                font-size: 15px;
            }


            .protected-text p {
                font-size: 11px;
            }


            .modal-content {
                padding: 23px 18px;
            }


            .modal-content h2 {
                font-size: 20px;
            }


            .modal-buttons {
                flex-direction: column;
            }


            .diary-actions {
                flex-direction: column;
            }


            .nav-button {
                font-size: 9px;
            }


            .success-modal h2 {
                font-size: 20px;
            }


            .success-icon {

                width: 68px;
                height: 68px;
            }


            .success-icon svg {

                width: 34px;
                height: 34px;
            }


            .alert-detail {

                font-size: 12px;
            }
        }


        @media (max-width: 360px) {

            .logo-text {
                font-size: 24px;
            }


            .notification {

                width: 42px;
                height: 42px;
            }


            .greeting h1 {
                font-size: 24px;
            }


            .section-title h2 {
                font-size: 17px;
            }


            .shortcut-card {
                padding: 14px;
            }


            .shortcut-icon {

                width: 44px;
                height: 44px;

                min-width: 44px;
            }


            .shortcut-card h3 {
                font-size: 13px;
            }


            .shortcut-card p {
                font-size: 10px;
            }
        }
    </style>

</head>


<body>


    <!-- =====================================================
         CONTEÚDO PRINCIPAL
    ====================================================== -->

    <main class="app">


        <!-- =================================================
             HEADER
        ================================================== -->

        <header class="header">

            <?php include 'components/logo.php'; ?>


            <button type="button" class="notification" onclick="abrirNotificacoes()" aria-label="Abrir notificações">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">

                    <path d="
                            M18 8
                            a6 6 0 0 0-12 0
                            c0 7-3 7-3 9
                            h18
                            c0-2-3-2-3-9
                        " />

                    <path d="M10 21h4" />

                </svg>


                <span class="notification-badge" id="notificationBadge">
                    2
                </span>

            </button>

        </header>


        <!-- =================================================
             SAUDAÇÃO
        ================================================== -->

        <section class="greeting">

            <h1>
                Olá, <span><?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8') ?>!</span> 👋
            </h1>

            <p>
                Estamos aqui para te proteger.
            </p>

        </section>


        <!-- =================================================
             STATUS
        ================================================== -->

        <div class="status" id="systemStatus" aria-live="polite">

            <span class="status-dot"></span>

            <span id="statusText">
                Sistema ativo e funcionando
            </span>

        </div>


        <!-- =================================================
             SOS
        ================================================== -->

        <section class="sos-card">

            <div class="sos-circle-area">

                <div class="sos-ring ring-1"></div>

                <div class="sos-ring ring-2"></div>

                <div class="sos-ring ring-3"></div>


                <button type="button" class="sos-button" onclick="abrirSOS()" aria-label="Abrir alerta de emergência">
                    SOS
                </button>

            </div>


            <div class="sos-content">

                <h2>
                    Precisa de ajuda?
                </h2>

                <p>
                    Em uma situação de emergência,
                    envie um alerta para seus contatos
                    de confiança.
                </p>


                <button type="button" class="emergency-button" onclick="abrirSOS()">

                    <span>🚨</span>

                    BOTÃO DE EMERGÊNCIA

                </button>

            </div>

        </section>


        <!-- =================================================
             PAINEL DE SEGURANÇA
        ================================================== -->

        <section class="security-panel">

            <div class="section-title">

                <h2>
                    Painel de Segurança
                </h2>

                <div class="panel-status">

                    <span class="panel-status-dot"></span>

                    Tudo funcionando

                </div>

            </div>


            <div class="security-box">


                <div class="security-message">

                    <div class="shield-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">

                            <path d="
                                    M12 3
                                    l8 3
                                    v5
                                    c0 5-3.5 8.5-8 10
                                    -4.5-1.5-8-5-8-10
                                    V6l8-3z
                                " />

                            <path d="M8 12l2.5 2.5L16 9" />

                        </svg>

                    </div>


                    <div>

                        <h3>
                            Proteção ativa
                        </h3>

                        <p>
                            Seu SilentHelp está pronto para uso.
                        </p>

                    </div>

                </div>


                <div class="security-info-grid">


                    <!-- DISPOSITIVO -->

                    <div class="info-card">

                        <div class="info-card-top">

                            <div class="info-icon">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                    <rect x="6" y="2" width="12" height="20" rx="2" />

                                    <path d="M10 18h4" />

                                </svg>

                            </div>


                            <span class="info-value" id="deviceStatus">
                                ATIVO
                            </span>

                        </div>


                        <h4>
                            Dispositivo
                        </h4>

                        <p>
                            Conectado
                        </p>

                    </div>


                    <!-- CONEXÃO -->

                    <div class="info-card">

                        <div class="info-card-top">

                            <div class="info-icon">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path d="M5 12.5a10 10 0 0 1 14 0" />

                                    <path d="M8 15.5a6 6 0 0 1 8 0" />

                                    <path d="M11 18.5a2 2 0 0 1 2 0" />

                                </svg>

                            </div>


                            <span class="info-value">
                                ESTÁVEL
                            </span>

                        </div>


                        <h4>
                            Conexão
                        </h4>

                        <p>
                            Sinal excelente
                        </p>

                    </div>


                    <!-- BATERIA -->

                    <div class="info-card">

                        <div class="info-card-top">

                            <div class="info-icon">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                    <rect x="3" y="7" width="17" height="10" rx="2" />

                                    <path d="M21 10v4" />

                                    <path d="M6 10h8" />

                                </svg>

                            </div>


                            <span class="info-value battery-value" id="batteryValue">
                                87%
                            </span>

                        </div>


                        <h4>
                            Bateria
                        </h4>

                        <p>
                            Nível adequado
                        </p>

                    </div>


                    <!-- LOCALIZAÇÃO -->

                    <div class="info-card">

                        <div class="info-card-top">

                            <div class="info-icon">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path d="
                                            M20 10
                                            c0 5-8 11-8 11
                                            S4 15 4 10
                                            a8 8 0 1 1 16 0z
                                        " />

                                    <circle cx="12" cy="10" r="2.5" />

                                </svg>

                            </div>


                            <span class="info-value">
                                ATIVO
                            </span>

                        </div>


                        <h4>
                            Localização
                        </h4>

                        <p>
                            GPS funcionando
                        </p>

                    </div>

                </div>


                <div class="check-time">

                    ✓

                    Última verificação:

                    <strong id="lastCheck">
                        agora
                    </strong>

                </div>


                <button type="button" class="test-button" id="testButton" onclick="testarDispositivo()">

                    ⚡ &nbsp; TESTAR DISPOSITIVO

                </button>

            </div>

        </section>


        <!-- =================================================
             RECURSOS
        ================================================== -->

        <section class="security-shortcuts">

            <div class="section-title">

                <h2>
                    Recursos de segurança
                </h2>

            </div>


            <div class="shortcut-grid">


                <!-- HISTÓRICO -->

                <button type="button" class="shortcut-card" onclick="abrirPagina('historico.php')"
                    aria-label="Abrir histórico de alertas">

                    <div class="shortcut-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">

                            <path d="
                                    M3 12
                                    a9 9 0 1 0 3-6.7
                                " />

                            <path d="M3 4v5h5" />

                            <path d="M12 7v5l3 2" />

                        </svg>

                    </div>


                    <div>

                        <h3>
                            Histórico de alertas
                        </h3>

                        <p>
                            Veja os últimos eventos de segurança
                        </p>

                    </div>


                    <span>
                        ›
                    </span>

                </button>


                <!-- CONTATOS -->

                <button type="button" class="shortcut-card" onclick="abrirPagina('contatos-emergencia.php')"
                    aria-label="Abrir contatos de confiança">

                    <div class="shortcut-icon">

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                            aria-hidden="true">

                            <circle cx="9" cy="8" r="3" />

                            <path d="
                                    M3 20
                                    c0-4 2.5-6 6-6
                                    s6 2 6 6
                                " />

                            <path d="
                                    M16 11
                                    c2.8 0 5 1.8 5 5
                                " />

                            <path d="
                                    M16 5
                                    a3 3 0 0 1 0 6
                                " />

                        </svg>

                    </div>


                    <div>

                        <h3>
                            Contatos de confiança
                        </h3>

                        <p>
                            Gerencie quem recebe seus alertas
                        </p>

                    </div>


                    <span>
                        ›
                    </span>

                </button>

            </div>

        </section>


        <!-- =================================================
             MEU DIÁRIO
        ================================================== -->

        <section class="diary-card" id="diaryCard">

            <div class="diary-icon" aria-hidden="true">
                💜
            </div>

            <div class="diary-content">

                <h3>
                    Meu Diário
                </h3>

                <p>
                    Registre acontecimentos importantes
                    de forma privada.
                </p>

            </div>

            <button type="button" class="diary-button" onclick="ir()">
                + Novo registro
            </button>

        </section>


        <!-- =================================================
             PROTEÇÃO
        ================================================== -->

        <section class="protected-card">

            <div class="protected-icon">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                    <path d="
                            M12 3
                            l8 3
                            v5
                            c0 5-3.5 8.5-8 10
                            -4.5-1.5-8-5-8-10
                            V6l8-3z
                        " />

                    <path d="M8 12l2.5 2.5L16 9" />

                </svg>

            </div>


            <div class="protected-text">

                <h3>
                    Você está protegida
                </h3>

                <p>
                    O SilentHelp está pronto para te ajudar.
                </p>

            </div>


            <span class="arrow">
                ›
            </span>

        </section>


    </main>



    <!-- =====================================================
         CHAT FLUTUANTE COM RESPONSÁVEL
    ====================================================== -->

    <button type="button" class="chat-float-button" id="chatFloatButton" onclick="alternarChatResponsavel()"
        aria-label="Abrir conversa com responsável" aria-controls="responsibleChat" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path
                d="M20 11.5a7.5 7.5 0 0 1-8 7.5 8.5 8.5 0 0 1-3.6-.8L4 20l1.2-3.7A7.4 7.4 0 0 1 4 11.5 7.5 7.5 0 0 1 12 4a7.5 7.5 0 0 1 8 7.5z" />
            <path d="M8.5 12h.01M12 12h.01M15.5 12h.01" />
        </svg>

        <span class="chat-unread" id="chatUnread">
            1
        </span>
    </button>


    <section class="responsible-chat" id="responsibleChat" aria-label="Conversa com responsável" aria-hidden="true">
        <header class="chat-header">

            <div class="chat-avatar" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="8" r="3.5" />
                    <path d="M5 20c0-4 3-6 7-6s7 2 7 6" />
                </svg>
            </div>

            <div class="chat-header-info">
                <strong>Meu responsável</strong>

                <span class="chat-online">
                    <span class="chat-online-dot"></span>
                    Disponível para conversar
                </span>
            </div>

            <button type="button" class="chat-close" onclick="fecharChatResponsavel()" aria-label="Fechar conversa">
                ×
            </button>

        </header>


        <div class="chat-messages" id="chatMessages" aria-live="polite">
        </div>


        <div class="chat-quick-actions">
            <button type="button" onclick="enviarMensagemRapida('Estou bem 💜')">
                Estou bem
            </button>

            <button type="button" onclick="enviarMensagemRapida('Preciso conversar')">
                Preciso conversar
            </button>

            <button type="button" onclick="enviarMensagemRapida('Pode falar comigo?')">
                Pode falar comigo?
            </button>
        </div>


        <form class="chat-input-area" id="chatForm" onsubmit="enviarMensagemChat(event)">
            <input type="text" class="chat-input" id="chatInput" placeholder="Digite uma mensagem..." autocomplete="off"
                maxlength="500" aria-label="Mensagem para o responsável">

            <button type="submit" class="chat-send" aria-label="Enviar mensagem">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M22 2L11 13" />
                    <path d="M22 2l-7 20-4-9-9-4z" />
                </svg>
            </button>
        </form>

    </section>


    <!-- =====================================================
         MENU INFERIOR
    ====================================================== -->

    <nav class="bottom-nav" aria-label="Menu principal">


        <!-- INÍCIO -->

        <button type="button" class="nav-button active" onclick="abrirPagina('inicio.php')" aria-label="Ir para início">

            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">

                <path d="
                        M3 11.5
                        L12 4
                        l9 7.5
                        v8.5
                        a1 1 0 0 1-1 1
                        h-5v-6h-6v6H4
                        a1 1 0 0 1-1-1z
                    " />

            </svg>

            <span>
                Início
            </span>

        </button>


        <!-- MAPA -->

        <button type="button" class="nav-button" onclick="abrirPagina('mapa.php')" aria-label="Ir para mapa">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">

                <path d="
                        M9 18
                        l-6 3V6
                        l6-3
                        6 3
                        6-3
                        v15
                        l-6 3
                        -6-3z
                    " />

                <path d="M9 3v15" />

                <path d="M15 6v15" />

            </svg>

            <span>
                Mapa
            </span>

        </button>


        <!-- CONFIGURAÇÕES -->

        <button type="button" class="nav-button" onclick="abrirPagina('config.php')" aria-label="Ir para configurações">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">

                <circle cx="12" cy="12" r="3" />

                <path d="
                        M19.4 15
                        a1.7 1.7 0 0 0 .3 1.9
                        l.1.1-2 2-.1-.1
                        a1.7 1.7 0 0 0-1.9-.3
                        1.7 1.7 0 0 0-1 1.6V21
                        h-3v-.8
                        a1.7 1.7 0 0 0-1-1.6
                        1.7 1.7 0 0 0-1.9.3
                        l-.1.1-2-2
                        .1-.1
                        a1.7 1.7 0 0 0 .3-1.9
                        1.7 1.7 0 0 0-.3-1.9
                        1.7 1.7 0 0 0-1.6-1
                        h-.8v-3h.8
                        a1.7 1.7 0 0 0 1.6-1
                        1.7 1.7 0 0 0-.3-1.9
                        L6 7.9l2-2
                        .1.1
                        a1.7 1.7 0 0 0 1.9.3
                        1.7 1.7 0 0 0 1-1.6V4h3v.8
                        a1.7 1.7 0 0 0 1 1.6
                        1.7 1.7 0 0 0 1.9-.3
                        l.1-.1 2 2-.1.1
                        a1.7 1.7 0 0 0-.3 1.9
                        1.7 1.7 0 0 0 .3 1.9
                        1.7 1.7 0 0 0 1.6 1
                        h.8v3h-.8
                        a1.7 1.7 0 0 0-1.6 1z
                    " />

            </svg>

            <span>
                Config.
            </span>

        </button>


        <!-- PERFIL -->

        <button type="button" class="nav-button" onclick="abrirPagina('perfil.php')" aria-label="Ir para perfil">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">

                <circle cx="12" cy="8" r="4" />

                <path d="
                        M4 21
                        c0-4 3.5-7 8-7
                        s8 3 8 7
                    " />

            </svg>

            <span>
                Perfil
            </span>

        </button>

    </nav>


    <!-- =====================================================
         MODAL SOS
    ====================================================== -->

    <div id="sosModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="sosTitle">

        <div class="modal-content">

            <div class="modal-icon">
                🚨
            </div>


            <h2 id="sosTitle">
                Enviar alerta de emergência?
            </h2>


            <p>
                Seus contatos de confiança serão
                avisados e sua localização poderá
                ser compartilhada.
            </p>


            <div class="modal-buttons">

                <button type="button" class="cancel-button" onclick="fecharSOS()">
                    Cancelar
                </button>


                <button type="button" class="confirm-button" id="confirmSOSButton" onclick="confirmarSOS()">
                    Enviar alerta
                </button>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MODAL NOTIFICAÇÕES
    ====================================================== -->

    <div id="notificationModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="notificationTitle">

        <div class="modal-content notification-modal">

            <div class="modal-icon">
                🔔
            </div>


            <h2 id="notificationTitle">
                Notificações
            </h2>


            <p>
                Confira as últimas informações
                do seu sistema de segurança.
            </p>


            <div class="notification-item">

                <div class="notification-item-icon">
                    ✓
                </div>


                <div>

                    <strong>
                        Sistema funcionando
                    </strong>

                    <span>
                        Seu dispositivo está conectado.
                    </span>

                </div>

            </div>


            <div class="notification-item">

                <div class="notification-item-icon">
                    📍
                </div>


                <div>

                    <strong>
                        Localização ativa
                    </strong>

                    <span>
                        O GPS está pronto para emergências.
                    </span>

                </div>

            </div>


            <button type="button" class="cancel-button" style="
                    width:100%;
                    padding:13px;
                    margin-top:8px;
                    border-radius:13px;
                    cursor:pointer;
                    font-weight:600;
                    font-size:14px;
                " onclick="fecharNotificacoes()">

                Fechar

            </button>

        </div>

    </div>


    <!-- =====================================================
         MODAL MEU DIÁRIO
    ====================================================== -->

    <div id="diaryModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="diaryTitle">

        <div class="modal-content diary-modal">

            <div class="modal-icon">
                💜
            </div>


            <h2 id="diaryTitle">
                Novo registro
            </h2>


            <p>
                Registre um acontecimento importante
                de forma privada.
            </p>


            <form class="diary-form" id="diaryForm" onsubmit="salvarRegistroDiario(event)">

                <div class="diary-field">

                    <label for="diaryDateTime">
                        Data e horário
                    </label>

                    <input type="datetime-local" id="diaryDateTime" required>

                </div>


                <div class="diary-field">

                    <label for="diaryPessoa">
                        Pessoa envolvida
                    </label>

                    <input type="text" id="diaryPessoa" placeholder="Ex.: Nome da pessoa">

                </div>


                <div class="diary-field">

                    <label for="diaryLocal">
                        Local
                    </label>

                    <input type="text" id="diaryLocal" placeholder="Ex.: Casa, escola, trabalho...">

                </div>


                <div class="diary-field">

                    <label for="diaryRelato">
                        Relato
                    </label>

                    <textarea id="diaryRelato" placeholder="Escreva o que aconteceu..." required></textarea>

                </div>


                <div class="diary-field">

                    <label for="diaryObservacoes">
                        Observações
                    </label>

                    <textarea id="diaryObservacoes"
                        placeholder="Adicione alguma observação, se necessário..."></textarea>

                </div>


                <div class="diary-actions">

                    <button type="button" class="diary-cancel" onclick="fecharDiario()">
                        Cancelar
                    </button>


                    <button type="submit" class="diary-save" id="diarySaveButton">
                        💜 Salvar registro
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- =====================================================
         MODAL CHAMADO ENVIADO
    ====================================================== -->

    <div id="successModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="successTitle">

        <div class="modal-content success-modal">

            <div class="success-icon">

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">

                    <path d="M5 12.5l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />

                </svg>

            </div>


            <h2 id="successTitle">
                Chamado enviado com sucesso!
            </h2>


            <p>
                Seu alerta de emergência foi registrado
                e os contatos de confiança foram avisados.
            </p>


            <div class="alert-details">

                <div class="alert-detail">

                    <span>
                        Status
                    </span>

                    <span>
                        ✓ Enviado
                    </span>

                </div>


                <div class="alert-detail">

                    <span>
                        Chamado
                    </span>

                    <span id="alertNumber">
                        SH-000000
                    </span>

                </div>


                <div class="alert-detail">

                    <span>
                        Horário
                    </span>

                    <span id="alertTime">
                        --:--
                    </span>

                </div>


                <div class="alert-detail">

                    <span>
                        Localização
                    </span>

                    <span>
                        Compartilhada
                    </span>

                </div>

            </div>


            <button type="button" class="alert-confirm-button" onclick="fecharConfirmacaoAlerta()">
                Entendi
            </button>

        </div>

    </div>


    <!-- =====================================================
         TOAST
    ====================================================== -->

    <div id="toast" class="toast" role="status" aria-live="polite"></div>


    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        function ir() {
            window.location.href = 'diario.php';
        }

        const nomeUsuario = <?= json_encode($nomeUsuario, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;



        /* =====================================================
           CHAT COM RESPONSÁVEL
        ===================================================== */

        const CHAT_STORAGE_KEY = "silentHelpChatResponsavel";

        function obterMensagensChat() {
            try {
                return JSON.parse(
                    localStorage.getItem(CHAT_STORAGE_KEY)
                ) || [];
            } catch (erro) {
                return [];
            }
        }


        function salvarMensagensChat(mensagens) {
            localStorage.setItem(
                CHAT_STORAGE_KEY,
                JSON.stringify(mensagens.slice(-80))
            );
        }


        function horarioChat() {
            return new Date().toLocaleTimeString(
                "pt-BR",
                {
                    hour: "2-digit",
                    minute: "2-digit"
                }
            );
        }


        function escaparHTML(texto) {
            return String(texto)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }


        function renderizarChat() {
            const area =
                document.getElementById("chatMessages");

            if (!area) {
                return;
            }

            const mensagens =
                obterMensagensChat();

            area.innerHTML = "";

            mensagens.forEach(function (mensagem) {
                const bolha =
                    document.createElement("div");

                bolha.className =
                    "chat-message " +
                    (
                        mensagem.remetente === "usuario"
                            ? "usuario"
                            : "responsavel"
                    );

                bolha.innerHTML =
                    escaparHTML(mensagem.texto) +
                    '<span class="chat-time">' +
                    escaparHTML(mensagem.hora || "") +
                    "</span>";

                area.appendChild(bolha);
            });

            area.scrollTop =
                area.scrollHeight;
        }


        function iniciarChatResponsavel() {
            let mensagens =
                obterMensagensChat();

            if (mensagens.length === 0) {
                mensagens = [
                    {
                        remetente: "responsavel",
                        texto: "Oi, " + nomeUsuario + "! 💜 Estou aqui. Como você está?",
                        hora: horarioChat()
                    }
                ];

                salvarMensagensChat(mensagens);
            }

            renderizarChat();
        }


        function alternarChatResponsavel() {
            const chat =
                document.getElementById("responsibleChat");

            const botao =
                document.getElementById("chatFloatButton");

            const unread =
                document.getElementById("chatUnread");

            if (!chat) {
                return;
            }

            const aberto =
                chat.classList.toggle("show");

            chat.setAttribute(
                "aria-hidden",
                String(!aberto)
            );

            if (botao) {
                botao.setAttribute(
                    "aria-expanded",
                    String(aberto)
                );

                botao.classList.toggle(
                    "chat-open",
                    aberto
                );
            }

            if (unread && aberto) {
                unread.style.display = "none";
            }

            if (aberto) {
                renderizarChat();

                setTimeout(function () {
                    const input =
                        document.getElementById(
                            "chatInput"
                        );

                    if (input) {
                        input.focus();
                    }
                }, 180);
            }
        }


        function fecharChatResponsavel() {
            const chat =
                document.getElementById("responsibleChat");

            const botao =
                document.getElementById("chatFloatButton");

            if (chat) {
                chat.classList.remove("show");
                chat.setAttribute(
                    "aria-hidden",
                    "true"
                );
            }

            if (botao) {
                botao.setAttribute(
                    "aria-expanded",
                    "false"
                );

                botao.classList.remove(
                    "chat-open"
                );
            }
        }


        function adicionarMensagemChat(
            remetente,
            texto
        ) {
            const mensagens =
                obterMensagensChat();

            mensagens.push({
                remetente: remetente,
                texto: texto,
                hora: horarioChat()
            });

            salvarMensagensChat(mensagens);
            renderizarChat();
        }


        function enviarMensagemRapida(texto) {
            const chat =
                document.getElementById(
                    "responsibleChat"
                );

            if (
                chat &&
                !chat.classList.contains("show")
            ) {
                alternarChatResponsavel();
            }

            adicionarMensagemChat(
                "usuario",
                texto
            );

            responderResponsavel(texto);
        }


        function enviarMensagemChat(event) {
            event.preventDefault();

            const input =
                document.getElementById(
                    "chatInput"
                );

            if (!input) {
                return;
            }

            const texto =
                input.value.trim();

            if (!texto) {
                return;
            }

            adicionarMensagemChat(
                "usuario",
                texto
            );

            input.value = "";

            responderResponsavel(texto);
        }


        function responderResponsavel(texto) {
            const area =
                document.getElementById(
                    "chatMessages"
                );

            if (!area) {
                return;
            }

            const digitando =
                document.createElement("div");

            digitando.className =
                "chat-typing show";

            digitando.id =
                "chatTyping";

            digitando.innerHTML =
                "<span></span><span></span><span></span>";

            area.appendChild(digitando);
            area.scrollTop = area.scrollHeight;

            const mensagem =
                texto.toLowerCase();

            let resposta =
                "Estou aqui com você. Pode me contar com calma o que está acontecendo.";

            if (
                mensagem.includes("oi") ||
                mensagem.includes("olá") ||
                mensagem.includes("ola")
            ) {
                resposta =
                    "Oi! 💜 Que bom falar com você. Como você está se sentindo?";
            } else if (
                mensagem.includes("bem") ||
                mensagem.includes("tudo bem")
            ) {
                resposta =
                    "Fico feliz em saber. 💜 Se precisar conversar, estou por aqui.";
            } else if (
                mensagem.includes("medo") ||
                mensagem.includes("assustada") ||
                mensagem.includes("assustad")
            ) {
                resposta =
                    "Entendi. Você não precisa lidar com isso sozinha. Se estiver em perigo imediato, use o botão SOS do SilentHelp.";
            } else if (
                mensagem.includes("ajuda") ||
                mensagem.includes("socorro") ||
                mensagem.includes("emergência") ||
                mensagem.includes("emergencia")
            ) {
                resposta =
                    "Estou com você. Se for uma emergência, use o botão SOS para enviar um alerta aos contatos de confiança.";
            } else if (
                mensagem.includes("obrigad")
            ) {
                resposta =
                    "Por nada! 💜 Sempre que precisar conversar, pode me chamar.";
            }

            setTimeout(function () {
                const indicador =
                    document.getElementById(
                        "chatTyping"
                    );

                if (indicador) {
                    indicador.remove();
                }

                adicionarMensagemChat(
                    "responsavel",
                    resposta
                );
            }, 850);
        }


        function limparChatResponsavel() {
            localStorage.removeItem(
                CHAT_STORAGE_KEY
            );

            iniciarChatResponsavel();
        }


        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        function abrirPagina(pagina) {

            if (!pagina) {
                return;
            }

            window.location.href = pagina;
        }


        /* =====================================================
           MENSAGEM TOAST
        ===================================================== */

        function mostrarMensagem(mensagem) {

            const toast =
                document.getElementById(
                    "toast"
                );


            if (!toast) {
                return;
            }


            toast.textContent =
                mensagem;


            toast.classList.add(
                "show"
            );


            clearTimeout(
                window.toastTimeout
            );


            window.toastTimeout =
                setTimeout(function () {

                    toast.classList.remove(
                        "show"
                    );

                }, 3500);
        }


        /* =====================================================
           NOTIFICAÇÕES
        ===================================================== */

        function abrirNotificacoes() {

            const modal =
                document.getElementById(
                    "notificationModal"
                );

            if (!modal) {
                return;
            }

            modal.classList.add("show");


            const badge =
                document.getElementById(
                    "notificationBadge"
                );

            if (badge) {

                badge.style.display =
                    "none";
            }

            atualizarScrollModal();
        }


        function fecharNotificacoes() {

            const modal =
                document.getElementById(
                    "notificationModal"
                );

            if (modal) {

                modal.classList.remove(
                    "show"
                );
            }

            atualizarScrollModal();
        }


        /* =====================================================
           SOS
        ===================================================== */

        function abrirSOS() {

            const modal =
                document.getElementById(
                    "sosModal"
                );

            if (!modal) {
                return;
            }

            modal.classList.add("show");

            atualizarScrollModal();
        }


        function fecharSOS() {

            const modal =
                document.getElementById(
                    "sosModal"
                );

            if (modal) {

                modal.classList.remove(
                    "show"
                );
            }

            atualizarScrollModal();
        }


        /* =====================================================
           CONFIRMAR SOS
        ===================================================== */

        async function confirmarSOS() {

            const botao =
                document.getElementById("confirmSOSButton");

            if (!botao) {
                return;
            }

            botao.disabled = true;
            botao.innerHTML = "⏳ &nbsp; PREPARANDO ALERTA...";

            let latitude = null;
            let longitude = null;
            let precisao = null;
            let localizacao = "Não disponível";

            /* Tenta obter a localização real do celular. */
            if (navigator.geolocation) {
                try {
                    const posicao = await new Promise((resolve, reject) => {
                        navigator.geolocation.getCurrentPosition(
                            resolve,
                            reject,
                            {
                                enableHighAccuracy: true,
                                timeout: 10000,
                                maximumAge: 0
                            }
                        );
                    });

                    latitude = posicao.coords.latitude;
                    longitude = posicao.coords.longitude;
                    precisao = Math.round(posicao.coords.accuracy);
                    localizacao = "Obtida pelo GPS";
                } catch (erro) {
                    localizacao = "GPS não autorizado ou indisponível";
                }
            }

            const agora = new Date();

            const hora = agora.toLocaleTimeString("pt-BR", {
                hour: "2-digit",
                minute: "2-digit"
            });

            const data = agora.toLocaleDateString("pt-BR");

            const numeroChamado =
                "SH-" + String(Date.now()).slice(-6);

            const alerta = {
                id: numeroChamado,
                tipo: "Alerta de emergência",
                mensagem: "Alerta de emergência acionado pelo usuário.",
                status: "Acionado",
                data: data,
                hora: hora,
                localizacao: localizacao,
                latitude: latitude,
                longitude: longitude,
                precisao: precisao,
                online: navigator.onLine,
                timestamp: Date.now()
            };

            localStorage.setItem(
                "ultimoAlertaSilentHelp",
                JSON.stringify(alerta)
            );

            let historico = [];

            try {
                historico = JSON.parse(
                    localStorage.getItem("historicoAlertasSilentHelp")
                ) || [];
            } catch (erro) {
                historico = [];
            }

            historico.unshift(alerta);
            historico = historico.slice(0, 50);

            localStorage.setItem(
                "historicoAlertasSilentHelp",
                JSON.stringify(historico)
            );

            atualizarStatusEmergencia();

            /* Vibração real, quando suportada pelo aparelho. */
            if (navigator.vibrate) {
                navigator.vibrate([250, 120, 250]);
            }

            fecharSOS();

            botao.disabled = false;
            botao.innerHTML = "Enviar alerta";

            /*
             * Se o navegador oferecer compartilhamento, abre o painel
             * nativo do celular para que o usuário possa enviar o alerta
             * para um contato/app de confiança.
             */
            if (navigator.share) {
                try {
                    let textoCompartilhamento =
                        "🚨 ALERTA SILENTHELP\n" +
                        "Chamado: " + numeroChamado + "\n" +
                        "Horário: " + hora + "\n" +
                        "Localização: " + localizacao;

                    if (latitude !== null && longitude !== null) {
                        textoCompartilhamento +=
                            "\nMapa: https://www.google.com/maps?q=" +
                            latitude + "," + longitude;
                    }

                    await navigator.share({
                        title: "Alerta SilentHelp",
                        text: textoCompartilhamento
                    });
                } catch (erro) {
                    /* O usuário pode fechar o compartilhamento sem erro. */
                }
            }

            mostrarConfirmacaoAlerta(numeroChamado, hora);
        }


        /* =====================================================
           STATUS DE EMERGÊNCIA
        ===================================================== */

        function atualizarStatusEmergencia() {

            const status =
                document.getElementById(
                    "systemStatus"
                );


            if (!status) {
                return;
            }


            status.style.color =
                "#ffb0bb";


            status.style.borderColor =
                "rgba(255,93,115,.3)";


            status.style.background =
                "rgba(255,93,115,.08)";


            const dot =
                status.querySelector(
                    ".status-dot"
                );


            if (dot) {

                dot.style.background =
                    "#ff5d73";

                dot.style.boxShadow =
                    "0 0 9px rgba(255,93,115,.65)";
            }


            const texto =
                document.getElementById(
                    "statusText"
                );


            if (texto) {

                texto.textContent =
                    "Chamado enviado aos contatos";
            }
        }


        /* =====================================================
           CONFIRMAÇÃO DO CHAMADO
        ===================================================== */

        function mostrarConfirmacaoAlerta(
            numeroChamado,
            hora
        ) {

            const modal =
                document.getElementById(
                    "successModal"
                );


            const numero =
                document.getElementById(
                    "alertNumber"
                );


            const horario =
                document.getElementById(
                    "alertTime"
                );


            if (!modal) {
                return;
            }


            if (numero) {

                numero.textContent =
                    numeroChamado;
            }


            if (horario) {

                horario.textContent =
                    hora;
            }


            modal.classList.add(
                "show"
            );


            atualizarScrollModal();
        }


        /* =====================================================
           FECHAR CONFIRMAÇÃO
        ===================================================== */

        function fecharConfirmacaoAlerta() {

            const modal =
                document.getElementById(
                    "successModal"
                );


            if (modal) {

                modal.classList.remove(
                    "show"
                );
            }


            atualizarScrollModal();
        }


        /* =====================================================
           TESTAR DISPOSITIVO
        ===================================================== */

        async function testarDispositivo() {

            const botao =
                document.getElementById("testButton");

            if (!botao) {
                return;
            }

            const textoOriginal = botao.innerHTML;

            botao.disabled = true;
            botao.innerHTML = "⏳ &nbsp; TESTANDO...";

            const resultados = [];

            /* 1. Conexão real */
            const online = navigator.onLine;
            resultados.push(online ? "Conexão OK" : "Sem conexão");

            /* 2. Bateria real, quando o navegador disponibiliza a API */
            let nivelBateria = null;
            try {
                if (navigator.getBattery) {
                    const bateria = await navigator.getBattery();
                    nivelBateria = Math.round(bateria.level * 100);

                    const batteryValue =
                        document.getElementById("batteryValue");

                    if (batteryValue) {
                        batteryValue.textContent = nivelBateria + "%";
                    }
                }
            } catch (erro) {
                /* Alguns navegadores bloqueiam a Battery API. */
            }

            /* 3. Geolocalização real */
            let gpsOk = false;

            if (navigator.geolocation) {
                try {
                    await new Promise((resolve, reject) => {
                        navigator.geolocation.getCurrentPosition(
                            resolve,
                            reject,
                            {
                                enableHighAccuracy: true,
                                timeout: 8000,
                                maximumAge: 0
                            }
                        );
                    });

                    gpsOk = true;
                } catch (erro) {
                    gpsOk = false;
                }
            }

            resultados.push(gpsOk ? "GPS OK" : "GPS indisponível");

            /* 4. Vibração */
            const vibracaoOk = typeof navigator.vibrate === "function";

            if (vibracaoOk) {
                navigator.vibrate(120);
                resultados.push("Vibração OK");
            } else {
                resultados.push("Vibração não suportada");
            }

            const tudoCerto = online && gpsOk;

            const deviceStatus =
                document.getElementById("deviceStatus");

            if (deviceStatus) {
                deviceStatus.textContent = tudoCerto ? "ATIVO" : "ATENÇÃO";
                deviceStatus.style.color = tudoCerto
                    ? "#55df91"
                    : "#ffb0bb";
            }

            const lastCheck =
                document.getElementById("lastCheck");

            if (lastCheck) {
                lastCheck.textContent = "agora";
            }

            const textoResultado = resultados.join(" • ");

            botao.innerHTML = tudoCerto
                ? "✓ &nbsp; DISPOSITIVO OK"
                : "⚠ &nbsp; VERIFICAR DISPOSITIVO";

            botao.style.color = tudoCerto ? "#55df91" : "#ffb0bb";
            botao.style.borderColor = tudoCerto
                ? "rgba(85,223,145,.5)"
                : "rgba(255,93,115,.5)";
            botao.style.background = tudoCerto
                ? "rgba(85,223,145,.08)"
                : "rgba(255,93,115,.08)";

            mostrarMensagem(
                (tudoCerto ? "✓ Check-up concluído: " : "⚠ Check-up: ") +
                textoResultado
            );

            setTimeout(function () {
                botao.innerHTML = textoOriginal;
                botao.disabled = false;
                botao.style.color = "";
                botao.style.borderColor = "";
                botao.style.background = "";
            }, 4000);
        }


        /* =====================================================
           MEU DIÁRIO
        ===================================================== */

        function abrirDiario() {

            const modal =
                document.getElementById(
                    "diaryModal"
                );


            if (!modal) {
                return;
            }


            preencherDataAtual();


            modal.classList.add(
                "show"
            );


            atualizarScrollModal();


            setTimeout(function () {

                const relato =
                    document.getElementById(
                        "diaryRelato"
                    );


                if (relato) {
                    relato.focus();
                }

            }, 100);
        }


        function fecharDiario() {

            const modal =
                document.getElementById(
                    "diaryModal"
                );


            if (modal) {

                modal.classList.remove(
                    "show"
                );
            }


            atualizarScrollModal();
        }


        /* =====================================================
           PREENCHER DATA E HORÁRIO
        ===================================================== */

        function preencherDataAtual() {

            const campo =
                document.getElementById(
                    "diaryDateTime"
                );


            if (!campo) {
                return;
            }


            if (campo.value) {
                return;
            }


            const agora =
                new Date();


            const ano =
                agora.getFullYear();


            const mes =
                String(
                    agora.getMonth() + 1
                ).padStart(
                    2,
                    "0"
                );


            const dia =
                String(
                    agora.getDate()
                ).padStart(
                    2,
                    "0"
                );


            const hora =
                String(
                    agora.getHours()
                ).padStart(
                    2,
                    "0"
                );


            const minuto =
                String(
                    agora.getMinutes()
                ).padStart(
                    2,
                    "0"
                );


            campo.value =
                `${ano}-${mes}-${dia}T${hora}:${minuto}`;
        }


        /* =====================================================
           SALVAR REGISTRO DO DIÁRIO
        ===================================================== */

        function salvarRegistroDiario(event) {

            event.preventDefault();


            const campoData =
                document.getElementById(
                    "diaryDateTime"
                );


            const campoPessoa =
                document.getElementById(
                    "diaryPessoa"
                );


            const campoLocal =
                document.getElementById(
                    "diaryLocal"
                );


            const campoRelato =
                document.getElementById(
                    "diaryRelato"
                );


            const campoObservacoes =
                document.getElementById(
                    "diaryObservacoes"
                );


            const botao =
                document.getElementById(
                    "diarySaveButton"
                );


            if (
                !campoData ||
                !campoPessoa ||
                !campoLocal ||
                !campoRelato ||
                !campoObservacoes
            ) {

                return;
            }


            if (
                !campoData.value ||
                !campoRelato.value.trim()
            ) {

                mostrarMensagem(
                    "Preencha a data e o relato."
                );

                return;
            }


            const dataSelecionada =
                new Date(
                    campoData.value
                );


            const registro = {

                id:
                    Date.now(),

                tipo:
                    "Registro do diário",

                dataHora:
                    campoData.value,

                data:
                    dataSelecionada.toLocaleDateString(
                        "pt-BR"
                    ),

                hora:
                    dataSelecionada.toLocaleTimeString(
                        "pt-BR",
                        {
                            hour: "2-digit",
                            minute: "2-digit"
                        }
                    ),

                pessoa:
                    campoPessoa.value.trim(),

                local:
                    campoLocal.value.trim(),

                relato:
                    campoRelato.value.trim(),

                observacoes:
                    campoObservacoes.value.trim(),

                timestamp:
                    Date.now()
            };


            let diario = [];


            try {

                diario =
                    JSON.parse(
                        localStorage.getItem(
                            "diarioSilentHelp"
                        )
                    ) || [];

            } catch (erro) {

                diario = [];
            }


            diario.unshift(
                registro
            );


            diario =
                diario.slice(
                    0,
                    50
                );


            localStorage.setItem(
                "diarioSilentHelp",
                JSON.stringify(
                    diario
                )
            );


            if (botao) {

                botao.disabled =
                    true;

                botao.innerHTML =
                    "✓ Registro salvo";
            }


            mostrarMensagem(
                "💜 Registro salvo no seu diário."
            );


            setTimeout(function () {

                fecharDiario();


                const form =
                    document.getElementById(
                        "diaryForm"
                    );


                if (form) {
                    form.reset();
                }


                if (botao) {

                    botao.disabled =
                        false;

                    botao.innerHTML =
                        "💜 Salvar registro";
                }

            }, 900);
        }


        /* =====================================================
           LER DIÁRIO
        ===================================================== */

        function obterRegistrosDiario() {

            try {

                return JSON.parse(
                    localStorage.getItem(
                        "diarioSilentHelp"
                    )
                ) || [];

            } catch (erro) {

                return [];
            }
        }


        /* =====================================================
           FECHAR MODAIS CLICANDO FORA
        ===================================================== */

        const sosModal =
            document.getElementById(
                "sosModal"
            );


        if (sosModal) {

            sosModal.addEventListener(
                "click",
                function (event) {

                    if (
                        event.target === this
                    ) {

                        fecharSOS();
                    }

                }
            );
        }


        const notificationModal =
            document.getElementById(
                "notificationModal"
            );


        if (notificationModal) {

            notificationModal.addEventListener(
                "click",
                function (event) {

                    if (
                        event.target === this
                    ) {

                        fecharNotificacoes();
                    }

                }
            );
        }


        const diaryModal =
            document.getElementById(
                "diaryModal"
            );


        if (diaryModal) {

            diaryModal.addEventListener(
                "click",
                function (event) {

                    if (
                        event.target === this
                    ) {

                        fecharDiario();
                    }

                }
            );
        }


        const successModal =
            document.getElementById(
                "successModal"
            );


        if (successModal) {

            successModal.addEventListener(
                "click",
                function (event) {

                    if (
                        event.target === this
                    ) {

                        fecharConfirmacaoAlerta();
                        fecharChatResponsavel();
                    }

                }
            );
        }


        /* =====================================================
           TECLA ESC
        ===================================================== */

        document.addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Escape"
                ) {

                    fecharSOS();

                    fecharNotificacoes();

                    fecharDiario();

                    fecharConfirmacaoAlerta();
                }

            }
        );


        /* =====================================================
           SCROLL QUANDO MODAL ABERTO
        ===================================================== */

        function atualizarScrollModal() {

            const sos =
                document.getElementById(
                    "sosModal"
                );


            const notificacoes =
                document.getElementById(
                    "notificationModal"
                );


            const diario =
                document.getElementById(
                    "diaryModal"
                );


            const sucesso =
                document.getElementById(
                    "successModal"
                );


            const aberto =
                (
                    sos &&
                    sos.classList.contains(
                        "show"
                    )
                ) ||

                (
                    notificacoes &&
                    notificacoes.classList.contains(
                        "show"
                    )
                ) ||

                (
                    diario &&
                    diario.classList.contains(
                        "show"
                    )
                ) ||

                (
                    sucesso &&
                    sucesso.classList.contains(
                        "show"
                    )
                );


            document.body.style.overflow =
                aberto
                    ? "hidden"
                    : "";
        }


        /* =====================================================
           INICIALIZAÇÃO
        ===================================================== */

        window.addEventListener(
            "load",
            function () {

                iniciarChatResponsavel();

                const status =
                    document.getElementById(
                        "systemStatus"
                    );


                if (status) {

                    status.setAttribute(
                        "aria-live",
                        "polite"
                    );
                }


                const lastCheck =
                    document.getElementById(
                        "lastCheck"
                    );


                if (lastCheck) {

                    lastCheck.textContent =
                        "agora";
                }


                /*
                 * Verifica se existem registros
                 * do diário.
                 */

                const registros =
                    obterRegistrosDiario();


                console.log(
                    "Registros do Meu Diário:",
                    registros
                );


                /*
                 * Verifica se existe um alerta
                 * salvo anteriormente.
                 */

                try {

                    const ultimoAlerta =
                        JSON.parse(
                            localStorage.getItem(
                                "ultimoAlertaSilentHelp"
                            )
                        );


                    if (
                        ultimoAlerta &&
                        ultimoAlerta.status === "Enviado"
                    ) {

                        console.log(
                            "Último chamado:",
                            ultimoAlerta
                        );
                    }

                } catch (erro) {

                    console.log(
                        "Nenhum chamado anterior encontrado."
                    );
                }

            }
        );

    </script>

    <script src="assets/db-sync.js"></script>
</body>

</html>