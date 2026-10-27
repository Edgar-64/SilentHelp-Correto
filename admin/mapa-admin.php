<?php require_once __DIR__ . '/../auth.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SilentHelp Admin - Mapa de Ocorrências</title>

    <!-- =====================================================
         LEAFLET
    ====================================================== -->
    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.css">

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

            --roxo: #a855f7;
            --roxo-2: #b76cff;
            --roxo-claro: #d0a0ff;
            --roxo-escuro: #702db5;

            --fundo: #07060a;
            --fundo-2: #0d0a12;

            --card: #121018;
            --card-2: #191520;

            --borda: rgba(255, 255, 255, .08);

            --branco: #ffffff;

            --cinza: #aaa5b4;
            --cinza-2: #817b8c;

            --verde: #55df91;
            --vermelho: #ff5d73;
            --amarelo: #f4c95d;

            --sombra:
                0 20px 60px rgba(0, 0, 0, .35);
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            min-height: 100vh;

            background:

                radial-gradient(circle at 30% -10%,
                    rgba(168, 85, 247, .18),
                    transparent 35%),

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
           LAYOUT
        ===================================================== */

        .layout {

            display: flex;

            min-height: 100vh;
        }


        /* =====================================================
           MENU LATERAL
        ===================================================== */

        .sidebar {

            position: fixed;

            left: 0;
            top: 0;

            width: 250px;

            height: 100vh;

            padding: 25px 16px;

            background:
                rgba(12, 10, 16, .96);

            border-right:
                1px solid var(--borda);

            display: flex;

            flex-direction: column;

            z-index: 1000;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                5px 10px 28px;

            cursor: default;
        }


        .logo-heart {

            width: 42px;
            height: 42px;

            color: var(--roxo-2);

            filter:
                drop-shadow(0 0 13px rgba(168, 85, 247, .4));
        }


        .logo-text {

            font-size: 25px;

            font-weight: 750;

            letter-spacing: -1px;
        }


        .logo-text .silent {

            color:
                var(--roxo-2);
        }


        .logo-text .help {

            color:
                white;
        }


        /* =====================================================
           ADMIN LABEL
        ===================================================== */

        .admin-label {

            padding:
                0 12px 10px;

            color:
                var(--cinza-2);

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        /* =====================================================
           NAV
        ===================================================== */

        .nav {

            display: flex;

            flex-direction: column;

            gap: 6px;
        }


        .nav-button {

            width: 100%;

            min-height: 48px;

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                0 14px;

            border: none;

            border-radius: 13px;

            background: transparent;

            color:
                var(--cinza);

            font-size: 13px;

            font-weight: 600;

            text-align: left;

            cursor: pointer;

            transition:
                .2s;
        }


        .nav-button svg {

            width: 20px;
            height: 20px;

            flex-shrink: 0;
        }


        .nav-button:hover {

            background:
                rgba(168, 85, 247, .08);

            color:
                var(--roxo-claro);
        }


        .nav-button.active {

            background:
                linear-gradient(100deg,
                    rgba(168, 85, 247, .18),
                    rgba(168, 85, 247, .06));

            color:
                var(--roxo-claro);

            border:
                1px solid rgba(168, 85, 247, .18);
        }


        /* =====================================================
           RODAPÉ DO MENU
        ===================================================== */

        .sidebar-bottom {

            margin-top: auto;

            padding-top: 15px;

            border-top:
                1px solid var(--borda);
        }


        .admin-user {

            display: flex;

            align-items: center;

            gap: 10px;

            padding:
                10px;
        }


        .avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(168, 85, 247, .15);

            color:
                var(--roxo-claro);

            font-size: 13px;

            font-weight: 700;
        }


        .admin-user strong {

            display: block;

            font-size: 12px;

            margin-bottom: 3px;
        }


        .admin-user span {

            color:
                var(--cinza-2);

            font-size: 10px;
        }


        /* =====================================================
           CONTEÚDO
        ===================================================== */

        .main {

            width: calc(100% - 250px);

            margin-left: 250px;

            padding:
                30px 35px 50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .top-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 28px;
        }


        .page-title h1 {

            font-size: 30px;

            font-weight: 650;

            letter-spacing: -.7px;

            margin-bottom: 6px;
        }


        .page-title h1 span {

            color:
                var(--roxo-claro);
        }


        .page-title p {

            color:
                var(--cinza);

            font-size: 13px;
        }


        .header-button {

            width: 43px;
            height: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid var(--borda);

            border-radius: 13px;

            background:
                rgba(255, 255, 255, .03);

            color:
                var(--roxo-claro);

            cursor: pointer;
        }


        .header-button svg {

            width: 20px;
            height: 20px;
        }


        /* =====================================================
           FILTROS
        ===================================================== */

        .filters-card {

            display: flex;

            align-items: flex-end;

            gap: 15px;

            padding: 18px;

            margin-bottom: 18px;

            border:
                1px solid var(--borda);

            border-radius: 18px;

            background:
                rgba(18, 16, 24, .85);

            box-shadow:
                var(--sombra);
        }


        .filter-group {

            flex: 1;

            min-width: 150px;
        }


        .filter-group label {

            display: block;

            margin-bottom: 7px;

            color:
                var(--cinza);

            font-size: 11px;

            font-weight: 600;
        }


        .filter-group select {

            width: 100%;

            height: 42px;

            padding:
                0 12px;

            border:
                1px solid var(--borda);

            border-radius: 11px;

            outline: none;

            background:
                #0d0b11;

            color:
                white;

            font-family: inherit;

            cursor: pointer;
        }


        .filter-group select:focus {

            border-color:
                rgba(168, 85, 247, .5);
        }


        .filter-button {

            height: 42px;

            padding:
                0 18px;

            border: none;

            border-radius: 11px;

            background:
                linear-gradient(100deg,
                    var(--roxo-escuro),
                    var(--roxo));

            color: white;

            font-size: 12px;

            font-weight: 650;

            cursor: pointer;

            transition: .2s;
        }


        .filter-button:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px rgba(168, 85, 247, .25);
        }


        /* =====================================================
           LEGENDA
        ===================================================== */

        .legend {

            display: flex;

            align-items: center;

            gap: 18px;

            padding:
                0 4px 14px;

            color:
                var(--cinza);

            font-size: 11px;
        }


        .legend-item {

            display: flex;

            align-items: center;

            gap: 7px;
        }


        .legend-dot {

            width: 10px;
            height: 10px;

            border-radius: 50%;
        }


        .legend-dot.emergency {

            background:
                var(--vermelho);

            box-shadow:
                0 0 8px rgba(255, 93, 115, .5);
        }


        .legend-dot.test {

            background:
                var(--verde);
        }


        .legend-dot.cancelled {

            background:
                var(--cinza-2);
        }


        .legend-dot.active {

            background:
                var(--amarelo);

            box-shadow:
                0 0 8px rgba(244, 201, 93, .5);
        }


        /* =====================================================
           MAPA
        ===================================================== */

        .map-card {

            position: relative;

            width: 100%;

            height: 580px;

            overflow: hidden;

            border:
                1px solid rgba(168, 85, 247, .20);

            border-radius: 22px;

            background:
                #15131a;

            box-shadow:
                0 20px 60px rgba(0, 0, 0, .35);
        }


        #map {

            width: 100%;

            height: 100%;
        }


        /* =====================================================
           CONTADOR DO MAPA
        ===================================================== */

        .map-stats {

            position: absolute;

            top: 15px;
            left: 15px;

            display: flex;

            gap: 8px;

            z-index: 500;

            pointer-events: none;
        }


        .map-stat {

            padding:
                9px 12px;

            border:
                1px solid rgba(255, 255, 255, .10);

            border-radius: 11px;

            background:
                rgba(12, 10, 16, .90);

            backdrop-filter:
                blur(12px);

            font-size: 11px;

            color:
                var(--cinza);
        }


        .map-stat strong {

            color: white;

            margin-right: 4px;
        }


        .map-stat.active strong {

            color:
                var(--amarelo);
        }


        /* =====================================================
           OCORRÊNCIAS
        ===================================================== */

        .occurrences {

            margin-top: 25px;
        }


        .section-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 14px;
        }


        .section-header h2 {

            font-size: 19px;

            font-weight: 600;
        }


        .section-header span {

            color:
                var(--cinza);

            font-size: 11px;
        }


        .occurrence-list {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }


        .occurrence {

            display: flex;

            align-items: center;

            gap: 13px;

            padding: 15px;

            border:
                1px solid var(--borda);

            border-radius: 16px;

            background:
                rgba(18, 16, 24, .85);

            transition: .2s;
        }


        .occurrence:hover {

            transform:
                translateY(-2px);

            border-color:
                rgba(168, 85, 247, .3);
        }


        .occurrence-icon {

            width: 43px;
            height: 43px;

            min-width: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                rgba(255, 93, 115, .09);

            color:
                var(--vermelho);
        }


        .occurrence-icon.test {

            color:
                var(--verde);

            background:
                rgba(85, 223, 145, .08);
        }


        .occurrence-icon.cancelled {

            color:
                var(--cinza);

            background:
                rgba(255, 255, 255, .05);
        }


        .occurrence-icon svg {

            width: 21px;
            height: 21px;
        }


        .occurrence-info {

            flex: 1;

            min-width: 0;
        }


        .occurrence-info h3 {

            font-size: 13px;

            margin-bottom: 4px;
        }


        .occurrence-info p {

            color:
                var(--cinza);

            font-size: 10px;
        }


        .status {

            padding:
                5px 8px;

            border-radius: 7px;

            font-size: 9px;

            font-weight: 700;
        }


        .status.active {

            color:
                var(--amarelo);

            background:
                rgba(244, 201, 93, .08);
        }


        .status.resolved {

            color:
                var(--verde);

            background:
                rgba(85, 223, 145, .08);
        }


        .status.cancelled {

            color:
                var(--cinza);

            background:
                rgba(255, 255, 255, .05);
        }


        /* =====================================================
           LEAFLET
        ===================================================== */

        .leaflet-container {

            background:
                #17151c;
        }


        .leaflet-control-zoom a {

            background:
                #17151c !important;

            color:
                white !important;

            border-color:
                rgba(255, 255, 255, .1) !important;
        }


        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {

            background:
                #17131d;

            color:
                white;
        }


        .leaflet-popup-content {

            margin: 14px;

            min-width: 180px;
        }


        .popup-title {

            font-size: 14px;

            font-weight: 700;

            margin-bottom: 6px;
        }


        .popup-line {

            color:
                #aaa5b4;

            font-size: 11px;

            margin-top: 4px;
        }


        /* =====================================================
           RESPONSIVO
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar {

                width: 215px;
            }


            .main {

                width: calc(100% - 215px);

                margin-left: 215px;

                padding:
                    25px 20px;
            }


            .occurrence-list {

                grid-template-columns: 1fr;
            }
        }


        @media (max-width: 700px) {

            .sidebar {

                position: fixed;

                width: 100%;

                height: 70px;

                bottom: 0;
                top: auto;

                left: 0;

                padding:
                    5px 10px;

                border-right: none;

                border-top:
                    1px solid var(--borda);

                flex-direction: row;

                align-items: center;

                justify-content: center;
            }


            .logo,
            .brand,
            .admin-label,
            .sidebar-bottom {

                display: none;
            }


            .nav {

                width: 100%;

                flex-direction: row;

                justify-content: space-around;

                gap: 2px;
            }


            .nav-button {

                width: auto;

                min-height: 58px;

                flex: 1;

                justify-content: center;

                flex-direction: column;

                gap: 3px;

                padding: 4px;

                font-size: 9px;

                text-align: center;
            }


            .nav-button svg {

                width: 21px;
                height: 21px;
            }


            .main {

                width: 100%;

                margin-left: 0;

                padding:
                    20px 15px 90px;
            }


            .top-header {

                margin-bottom: 20px;
            }


            .page-title h1 {

                font-size: 24px;
            }


            .page-title p {

                font-size: 11px;
            }


            .filters-card {

                flex-direction: column;

                align-items: stretch;
            }


            .filter-group {

                width: 100%;
            }


            .filter-button {

                width: 100%;
            }


            .legend {

                flex-wrap: wrap;

                gap: 10px;
            }


            .map-card {

                height: 470px;
            }


            .map-stats {

                flex-wrap: wrap;

                max-width: 90%;
            }


            .map-stat {

                font-size: 9px;

                padding:
                    7px 9px;
            }
        }


        @media (max-width: 420px) {

            .map-card {

                height: 420px;
            }


            .section-header h2 {

                font-size: 17px;
            }


            .occurrence {

                padding: 12px;
            }
        }
    </style>
    <style id="admin-sidebar-structure">
        /* Estrutura comum da sidebar administrativa */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            min-height: 100vh;
            padding: 25px 17px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            background: rgba(12, 10, 16, .96);
            border-right: 1px solid var(--borda, rgba(255, 255, 255, .08));
            z-index: 1000;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 30px;
            color: white;
            cursor: default;
        }

        .sidebar .brand-heart {
            width: 39px;
            height: 39px;
            color: var(--roxo-2, #b76cff);
            filter: drop-shadow(0 0 13px rgba(168, 85, 247, .35));
        }

        .sidebar .brand-name {
            font-size: 25px;
            font-weight: 750;
            letter-spacing: -1px;
        }

        .sidebar .brand-name .silent {
            color: var(--roxo-2, #b76cff);
        }

        .sidebar .brand-name .help {
            color: white;
        }

        .sidebar .admin-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 13px 11px;
            margin-bottom: 24px;
            border: 1px solid var(--borda, rgba(255, 255, 255, .08));
            border-radius: 15px;
            background: rgba(255, 255, 255, .025);
        }

        .sidebar .admin-avatar {
            width: 39px;
            height: 39px;
            min-width: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--roxo, #a855f7), var(--roxo-escuro, #702db5));
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .sidebar .admin-info {
            min-width: 0;
        }

        .sidebar .admin-info strong {
            display: block;
            margin-bottom: 3px;
            font-size: 13px;
        }

        .sidebar .admin-info span {
            color: var(--cinza-2, #817b8c);
            font-size: 10px;
        }

        .sidebar .nav-label {
            color: var(--cinza-2, #817b8c);
            padding: 0 12px 9px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 100%;
        }

        .sidebar .sidebar-link {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            border: 1px solid transparent;
            border-radius: 13px;
            background: transparent;
            color: var(--cinza, #aaa5b4);
            text-decoration: none;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.2;
            text-align: left;
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .sidebar .sidebar-link svg {
            width: 19px;
            height: 19px;
            flex: 0 0 19px;
        }

        .sidebar .sidebar-link:hover {
            color: white;
            background: rgba(168, 85, 247, .08);
            transform: translateX(2px);
        }

        .sidebar .sidebar-link.active {
            color: var(--roxo-claro, #d0a0ff);
            background: linear-gradient(100deg, rgba(168, 85, 247, .16), rgba(168, 85, 247, .06));
            border-color: rgba(168, 85, 247, .18);
        }

        .sidebar .sidebar-link .link-badge {
            margin-left: auto;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            background: rgba(255, 93, 115, .12);
            color: #ff8798;
            font-size: 9px;
            font-weight: 750;
        }

        .sidebar .sidebar-bottom {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--borda, rgba(255, 255, 255, .08));
        }

        .sidebar .sidebar-bottom .sidebar-link {
            margin: 0;
        }


        /* Barra de rolagem personalizada da área admin */
        html {
            scrollbar-width: thin;
            scrollbar-color: #9b5de5 #0c0a10;
        }

        .sidebar,
        body {
            scrollbar-width: thin;
            scrollbar-color: #9b5de5 transparent;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0c0a10;
            border-left: 1px solid rgba(255, 255, 255, .05);
        }

        ::-webkit-scrollbar-thumb {
            min-height: 42px;
            background: linear-gradient(180deg, #c084fc 0%, #8b4dcc 55%, #5f2f91 100%);
            border: 2px solid #0c0a10;
            border-radius: 999px;
            box-shadow: 0 0 9px rgba(168, 85, 247, .35);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #d8a7ff 0%, #a855f7 55%, #7030b5 100%);
            box-shadow: 0 0 13px rgba(168, 85, 247, .55);
        }

        ::-webkit-scrollbar-corner {
            background: #0c0a10;
        }
    </style>
<style id="silenthelp-responsive-admin">
/* Botão de menu aparece apenas em telas compactas */
.sh-menu-toggle { display: none; }
/* Ajustes responsivos globais do painel SilentHelp */
:root { --sh-sidebar-width: 260px; }
@media (max-width: 1000px) {
  body { overflow-x: hidden; }
  #sidebar.sidebar {
    position: fixed !important; top: 0 !important; bottom: 0 !important; left: 0 !important; right: auto !important;
    width: min(285px, 86vw) !important; height: 100dvh !important; max-height: 100dvh !important;
    display: flex !important; flex-direction: column !important; align-items: stretch !important;
    padding: 22px 14px !important; overflow-y: auto !important; overflow-x: hidden !important;
    transform: translateX(-110%) !important; transition: transform .25s ease !important;
    z-index: 1201 !important; border-right: 1px solid rgba(255,255,255,.12) !important; border-top: 0 !important;
    box-shadow: 16px 0 40px rgba(0,0,0,.35) !important;
  }
  #sidebar.sidebar.open { transform: translateX(0) !important; }
  #sidebar .brand, #sidebar .admin-profile, #sidebar .nav-label, #sidebar .sidebar-bottom { display: initial; }
  #sidebar .sidebar-nav { display: flex !important; flex-direction: column !important; width: 100% !important; gap: 5px !important; overflow: visible !important; }
  #sidebar .sidebar-link { display: flex !important; flex-direction: row !important; align-items: center !important; justify-content: flex-start !important; gap: 12px !important; padding: 12px 13px !important; font-size: 13px !important; text-align: left !important; white-space: normal !important; }
  #sidebar .sidebar-link svg { flex: 0 0 20px !important; width: 20px !important; height: 20px !important; }
  #sidebar .link-badge { position: static !important; margin-left: auto !important; }
  .sh-sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.62); backdrop-filter: blur(2px); z-index: 1200; opacity: 0; visibility: hidden; transition: opacity .2s ease, visibility .2s ease; }
  .sh-sidebar-overlay.show { opacity: 1; visibility: visible; }
  .sh-menu-toggle { display: inline-flex; align-items: center; justify-content: center; width: 42px; height: 42px; flex: 0 0 42px; border: 1px solid rgba(255,255,255,.14); border-radius: 12px; background: #17121d; color: #fff; cursor: pointer; font-size: 22px; line-height: 1; box-shadow: 0 4px 16px rgba(0,0,0,.18); }
  .sh-menu-toggle:focus-visible { outline: 2px solid #b76cff; outline-offset: 3px; }
  body.sh-sidebar-active { overflow: hidden !important; }
  .main, .main-content, .content, .content-wrapper, .content-container { width: 100% !important; max-width: 100% !important; margin-left: 0 !important; }
  .main, .main-content, .content { min-width: 0 !important; }
  .layout { display: block !important; width: 100% !important; }
  .content, .main, .main-content, .content-wrapper, .content-container { box-sizing: border-box; }
  .content-header, .page-header, .header-content { min-width: 0; flex-wrap: wrap; gap: 12px; }
  .filters { display: flex !important; flex-wrap: wrap !important; gap: 8px !important; overflow: visible !important; padding: 14px !important; }
  .filter { flex: 0 1 auto; min-height: 38px; white-space: nowrap; }
  .table-container, .table-wrapper, .data-table-wrapper, .table-responsive { max-width: 100%; overflow-x: auto !important; -webkit-overflow-scrolling: touch; }
  table { max-width: 100%; }
  input, select, textarea { max-width: 100%; }
}
@media (max-width: 600px) {
  .sh-menu-toggle { width: 40px; height: 40px; flex-basis: 40px; }
  .content, .main, .main-content, .content-wrapper, .content-container { padding-left: 14px !important; padding-right: 14px !important; }
  .filters { display: grid !important; grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .filter { width: 100%; padding: 10px 8px !important; text-align: center; font-size: 12px !important; }
  .summary-grid, .stats-grid, .cards-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
  .modal, .modal-content, .dialog { max-width: calc(100vw - 24px) !important; }
}
@media (max-width: 380px) {
  .filters { grid-template-columns: minmax(0, 1fr); }
  .summary-grid, .stats-grid, .cards-grid { grid-template-columns: minmax(0, 1fr) !important; }
}

</style>
<link rel="stylesheet" href="assets/admin-modals.css?v=20261027b">
</head>


<body>


    <div class="layout">


        <!-- =====================================================
         SIDEBAR
    ====================================================== -->

        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <?php include '../components/logo.php'; ?>
            </div>

            <div class="admin-profile">
                <div class="admin-avatar">AD</div>
                <div class="admin-info">
                    <strong>Administrador</strong>
                    <span>Painel administrativo</span>
                </div>
            </div>

            <div class="nav-label">Principal</div>
            <nav class="sidebar-nav">
                <a href="admin.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                    <span>Dashboard</span>

                </a>

                <a href="usuarios.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <span>Usuárias</span>

                </a>

                <a href="alertas.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    <span>Alertas</span>
                    <span class="link-badge" id="sidebarAlertCount" hidden>0</span>
                </a>

                <a href="mapa-admin.php" class="sidebar-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />
                        <circle cx="12" cy="10" r="2.5" />
                    </svg>
                    <span>Mapa de ocorrências</span>

                </a>

                <a href="contatos-admin.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="9" cy="7" r="4" />
                        <path d="M2 21v-2a4 4 0 0 1 4-4h6a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    </svg>
                    <span>Contatos</span>

                </a>

                <a href="relatorios.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 3v18h18" />
                        <path d="m7 16 4-5 3 3 5-7" />
                    </svg>
                    <span>Relatórios</span>

                </a>

                <a href="config-admin.php" class="sidebar-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-2v-.48a1.7 1.7 0 0 0-1.03-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 8.4 15a1.7 1.7 0 0 0-1.56-1.03H6v-2h.48A1.7 1.7 0 0 0 8.04 11a1.7 1.7 0 0 0-.34-1.88l-.06-.06 1.42-1.42.06.06A1.7 1.7 0 0 0 11 8.04 1.7 1.7 0 0 0 12.03 6.48V6h2v.48A1.7 1.7 0 0 0 15.06 8a1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 18.04 11c.24.63.84 1.03 1.56 1.03H20v2h-.48A1.7 1.7 0 0 0 19.4 15Z" />
                    </svg>
                    <span>Configurações</span>

                </a>
            </nav>

            <div class="sidebar-bottom">
                <?php include '../components/logout.php'; ?>
            </div>
        </aside>



        <!-- =====================================================
         CONTEÚDO
    ====================================================== -->

        <main class="main">


            <!-- =================================================
             HEADER
        ================================================== -->

            <header class="top-header">

                <div class="page-title">

                    <h1>
                        Mapa de <span>ocorrências</span>
                    </h1>

                    <p>
                        Acompanhe a localização dos alertas registrados.
                    </p>

                </div>


                <button class="header-button" onclick="showNotification()" aria-label="Notificações">

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round">

                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" />

                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />

                    </svg>

                </button>

            </header>



            <!-- =================================================
             FILTROS
        ================================================== -->

            <section class="filters-card">


                <div class="filter-group">

                    <label for="periodo">
                        Período
                    </label>

                    <select id="periodo">

                        <option value="todos">
                            Todos os períodos
                        </option>

                        <option value="hoje">
                            Hoje
                        </option>

                        <option value="7dias">
                            Últimos 7 dias
                        </option>

                        <option value="30dias">
                            Últimos 30 dias
                        </option>

                        <option value="ano">
                            Este ano
                        </option>

                    </select>

                </div>


                <div class="filter-group">

                    <label for="tipo">
                        Tipo de alerta
                    </label>

                    <select id="tipo">

                        <option value="todos">
                            Todos os tipos
                        </option>

                        <option value="emergency">
                            Emergência
                        </option>

                        <option value="test">
                            Teste
                        </option>

                        <option value="cancelled">
                            Cancelado
                        </option>

                    </select>

                </div>


                <div class="filter-group">

                    <label for="status">
                        Status
                    </label>

                    <select id="status">

                        <option value="todos">
                            Todos
                        </option>

                        <option value="active">
                            Ativos
                        </option>

                        <option value="resolved">
                            Resolvidos
                        </option>

                        <option value="cancelled">
                            Cancelados
                        </option>

                    </select>

                </div>


                <button class="filter-button" onclick="applyFilters()">

                    Aplicar filtros

                </button>

            </section>



            <!-- =================================================
             LEGENDA
        ================================================== -->

            <div class="legend">

                <div class="legend-item">

                    <span class="legend-dot emergency"></span>

                    Emergência

                </div>


                <div class="legend-item">

                    <span class="legend-dot active"></span>

                    Alerta ativo

                </div>


                <div class="legend-item">

                    <span class="legend-dot test"></span>

                    Teste

                </div>


                <div class="legend-item">

                    <span class="legend-dot cancelled"></span>

                    Cancelado

                </div>

            </div>



            <!-- =================================================
             MAPA
        ================================================== -->

            <section class="map-card">


                <div class="map-stats">

                    <div class="map-stat">

                        <strong id="mapTotal">—</strong>

                        ocorrências

                    </div>


                    <div class="map-stat active">

                        <strong id="mapActive">—</strong>

                        ativas

                    </div>

                </div>


                <div id="map"></div>

            </section>
            <p style="margin-top:10px;color:var(--cinza);font-size:11px;line-height:1.5;">
                O mapa exibe somente alertas com latitude e longitude registradas no banco. Alertas sem coordenadas continuam na lista, mas não podem ser posicionados no mapa.
            </p>



            <!-- =================================================
             OCORRÊNCIAS RECENTES
        ================================================== -->

            <section class="occurrences">


                <div class="section-header">

                    <h2>
                        Ocorrências recentes
                    </h2>

                    <span id="occurrenceCount">Carregando...</span>

                </div>


                <div class="occurrence-list" id="occurrenceList"><div style="padding:24px;text-align:center;color:var(--cinza)">Carregando ocorrências do banco de dados...</div></div>

            </section>

        </main>

    </div>



    <!-- =====================================================
     LEAFLET
====================================================== -->


    <script src="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.js"></script>
<script>

/* Adaptador de compatibilidade: mantém as funções Leaflet existentes,
   mas renderiza o mapa com MapLibre GL. */
(function () {
  const mapInstances = new WeakMap();
  let circleCounter = 0;

  function makeMap(container, options = {}) {
    const native = new maplibregl.Map({
      container,
      style: "https://tiles.openfreemap.org/styles/liberty",
      center: [-45.5554, -23.0264],
      zoom: 13,
      pitch: 0,
      attributionControl: options.attributionControl !== false
    });

    native.addControl(new maplibregl.NavigationControl({ showCompass: false }), "bottom-right");
    native.addControl(new maplibregl.NavigationControl({ showCompass: false }), "bottom-right");
    const tracked = new Set();
    const circles = new Set();
    const wrapper = {
      _native: native,
      setView(coords, zoom) {
        native.flyTo({ center: [coords[1], coords[0]], zoom: zoom || native.getZoom(), essential: true });
        return wrapper;
      },
      removeLayer(item) {
        if (item && typeof item._remove === "function") {
          item._remove();
          tracked.delete(item);
          circles.delete(item);
        }
        return wrapper;
      },
      hasLayer(item) {
        return !!item && item._visible === true;
      },
      invalidateSize() {
        native.resize();
        return wrapper;
      },
      flyTo(options) {
        const opts = { ...options };
        if (Array.isArray(opts.center)) opts.center = [opts.center[1], opts.center[0]];
        native.flyTo(opts);
        return wrapper;
      },
      on(event, callback) {
        native.on(event, callback);
        return wrapper;
      }
    };
    mapInstances.set(wrapper, native);
    return wrapper;
  }

  function makeMarker(coords, options = {}) {
    let element = options.icon && options.icon.options ? options.icon.options.html : null;
    const el = document.createElement("div");
    if (element !== null) {
      el.className = options.icon.options.className || "";
      el.innerHTML = element;
      if (options.icon.options.iconSize) {
        const size = options.icon.options.iconSize;
        el.style.width = size[0] + "px";
        el.style.height = size[1] + "px";
      }
    } else {
      el.className = "sh-map-marker";
    }
    const marker = {
      _visible: false,
      _nativeMarker: null,
      _popup: null,
      _map: null,
      _coords: coords,
      addTo(map) {
        this._map = map;
        const native = map._native;
        this._nativeMarker = new maplibregl.Marker({ element: el, anchor: "bottom" })
          .setLngLat([this._coords[1], this._coords[0]])
          .addTo(native);
        this._visible = true;
        return this;
      },
      bindPopup(html) {
        this._popup = new maplibregl.Popup({ offset: 24, maxWidth: "280px" }).setHTML(html);
        if (this._nativeMarker) this._nativeMarker.setPopup(this._popup);
        return this;
      },
      remove() {
        this._remove();
        return this;
      },
      _remove() {
        if (this._nativeMarker) this._nativeMarker.remove();
        this._nativeMarker = null;
        this._visible = false;
      }
    };
    return marker;
  }

  function makeCircle(coords, options = {}) {
    const id = "sh-accuracy-" + (++circleCounter);
    const radius = Math.max(10, Number(options.radius) || 100);
    const lat = coords[0], lng = coords[1];
    const points = [];
    for (let i = 0; i <= 64; i++) {
      const angle = (i / 64) * Math.PI * 2;
      const dLat = (radius / 111320) * Math.cos(angle);
      const dLng = (radius / (111320 * Math.cos(lat * Math.PI / 180))) * Math.sin(angle);
      points.push([lng + dLng, lat + dLat]);
    }
    const feature = { type: "Feature", properties: {}, geometry: { type: "Polygon", coordinates: [points] } };
    const circle = {
      _visible: false,
      addTo(map) {
        this._map = map;
        const add = () => {
          if (!map._native.getSource(id)) {
            map._native.addSource(id, { type: "geojson", data: feature });
            map._native.addLayer({
              id: id + "-fill", type: "fill", source: id,
              paint: { "fill-color": options.fillColor || options.color || "#a65cff", "fill-opacity": options.fillOpacity ?? 0.08 }
            });
            map._native.addLayer({
              id: id + "-line", type: "line", source: id,
              paint: { "line-color": options.color || "#a65cff", "line-width": options.weight || 1 }
            });
          }
          circle._visible = true;
        };
        if (map._native.isStyleLoaded()) add(); else map._native.once("load", add);
        return circle;
      },
      remove() { this._remove(); return this; },
      _remove() {
        const native = this._map && this._map._native;
        if (native && native.isStyleLoaded()) {
          [id + "-line", id + "-fill"].forEach(layer => { if (native.getLayer(layer)) native.removeLayer(layer); });
          if (native.getSource(id)) native.removeSource(id);
        }
        this._visible = false;
      }
    };
    return circle;
  }

  window.L = {
    map: makeMap,
    tileLayer: function () { return { addTo: function () { return this; } }; },
    divIcon: function (options) { return { options }; },
    marker: makeMarker,
    circle: makeCircle
  };
})();

</script>

<script>

        /* =====================================================
           MAPA
        ===================================================== */

        const map =
            L.map("map").setView(
                [-23.0227, -45.5550],
                13
            );

        window.map = map;


        L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            {
                attribution:
                    '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);



        /* =====================================================
           ÍCONES
        ===================================================== */

        function createIcon(color) {

            return L.divIcon({

                className: "",

                html: `
                <div style="
                    width: 18px;
                    height: 18px;
                    border-radius: 50%;
                    background: ${color};
                    border: 3px solid white;
                    box-shadow: 0 0 14px ${color};
                "></div>
            `,

                iconSize: [18, 18],

                iconAnchor: [9, 9],

                popupAnchor: [0, -10]

            });

        }


        const emergencyIcon =
            createIcon("#ff5d73");


        const activeIcon =
            createIcon("#f4c95d");


        const testIcon =
            createIcon("#55df91");


        const cancelledIcon =
            createIcon("#817b8c");



        /* =====================================================
           OCORRÊNCIAS
        ===================================================== */

        const occurrences = [];


        let markers = [];



        /* =====================================================
           ADICIONAR MARCADORES
        ===================================================== */

        function renderMarkers() {

            markers.forEach(marker => {

                map.removeLayer(marker);

            });

            markers = [];


            occurrences.forEach(item => {

                let icon;


                if (
                    item.type === "emergency" &&
                    item.status === "active"
                ) {

                    icon = activeIcon;

                }

                else if (
                    item.type === "emergency"
                ) {

                    icon = emergencyIcon;

                }

                else if (
                    item.type === "test"
                ) {

                    icon = testIcon;

                }

                else {

                    icon = cancelledIcon;

                }


                const marker =
                    L.marker(
                        [item.lat, item.lng],
                        { icon }
                    ).addTo(map);


                marker.bindPopup(`

                <div class="popup-title">
                    ${item.title}
                </div>

                <div class="popup-line">
                    Usuária: ${item.user}
                </div>

                <div class="popup-line">
                    Data: ${item.date}
                </div>

                <div class="popup-line">
                    Status: ${getStatusName(item.status)}
                </div>

            `);


                marker.data = item;

                markers.push(marker);

            });

        }


        renderMarkers();



        /* =====================================================
           STATUS
        ===================================================== */

        function getStatusName(status) {

            if (status === "active") {
                return "Ativo";
            }

            if (status === "resolved") {
                return "Resolvido";
            }

            if (status === "cancelled") {
                return "Cancelado";
            }

            return status;
        }



        /* =====================================================
           FILTROS
        ===================================================== */

        function applyFilters() {

            const type =
                document.getElementById("tipo").value;

            const status =
                document.getElementById("status").value;


            markers.forEach(marker => {

                const item =
                    marker.data;


                const typeMatch =
                    type === "todos" ||
                    item.type === type;


                const statusMatch =
                    status === "todos" ||
                    item.status === status;


                if (
                    typeMatch &&
                    statusMatch
                ) {

                    if (!map.hasLayer(marker)) {

                        marker.addTo(map);

                    }

                }

                else {

                    if (map.hasLayer(marker)) {

                        map.removeLayer(marker);

                    }

                }

            });


            updateMapCounters();


            updateOccurrenceList(
                type,
                status
            );


            showNotification(
                "Filtros aplicados com sucesso."
            );

        }



        /* =====================================================
           CONTADORES
        ===================================================== */

        function updateMapCounters() {

            const visible =
                markers.filter(
                    marker =>
                        map.hasLayer(marker)
                );


            const active =
                visible.filter(
                    marker =>
                        marker.data.status === "active"
                );


            document.getElementById(
                "mapTotal"
            ).textContent =
                visible.length;


            document.getElementById(
                "mapActive"
            ).textContent =
                active.length;

        }



        /* =====================================================
           LISTA
        ===================================================== */

        function updateOccurrenceList(
            type,
            status
        ) {

            const cards =
                document.querySelectorAll(
                    ".occurrence"
                );


            let visible = 0;


            cards.forEach(card => {

                const cardType =
                    card.dataset.type;

                const cardStatus =
                    card.dataset.status;


                const typeMatch =
                    type === "todos" ||
                    cardType === type;


                const statusMatch =
                    status === "todos" ||
                    cardStatus === status;


                if (
                    typeMatch &&
                    statusMatch
                ) {

                    card.style.display =
                        "flex";

                    visible++;

                }

                else {

                    card.style.display =
                        "none";

                }

            });


            document.getElementById(
                "occurrenceCount"
            ).textContent =
                visible +
                (
                    visible === 1
                        ? " ocorrência"
                        : " ocorrências"
                );

        }



        /* =====================================================
           NOTIFICAÇÃO
        ===================================================== */

        function showNotification(
            message = "Você não possui novas notificações."
        ) {

            alert(message);

        }



        /* =====================================================
           NAVEGAÇÃO
        ===================================================== */

        function goTo(page) {

            window.location.href =
                page;

        }

    </script>

    <script src="assets/admin-db.js"></script>
<script id="silenthelp-responsive-admin-js">
(function () {
  function setupSilentHelpSidebar() {
    var sidebar = document.getElementById('sidebar');
    if (!sidebar || document.body.dataset.shSidebarReady === '1') return;
    document.body.dataset.shSidebarReady = '1';

    var overlay = document.getElementById('sidebarOverlay');
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.id = 'sidebarOverlay';
      overlay.className = 'sh-sidebar-overlay';
      overlay.setAttribute('aria-hidden', 'true');
      document.body.appendChild(overlay);
    } else {
      overlay.classList.add('sh-sidebar-overlay');
    }

    var toggle = document.querySelector('.mobile-menu, .menu-toggle, [data-sidebar-toggle]');
    if (!toggle) {
      toggle = document.createElement('button');
      toggle.type = 'button';
      toggle.className = 'sh-menu-toggle';
      toggle.setAttribute('aria-label', 'Abrir menu lateral');
      toggle.setAttribute('aria-controls', 'sidebar');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.innerHTML = '&#9776;';
      var main = document.querySelector('.main-content, .content, .main, main') || document.body;
      var header = main.querySelector('.content-header, .page-header, header, .header-content');
      if (header) header.insertBefore(toggle, header.firstChild);
      else document.body.insertBefore(toggle, document.body.firstChild);
    }

    function openSidebar() {
      sidebar.classList.add('open');
      overlay.classList.add('show');
      document.body.classList.add('sh-sidebar-active');
      toggle.setAttribute('aria-expanded', 'true');
      toggle.setAttribute('aria-label', 'Fechar menu lateral');
      overlay.setAttribute('aria-hidden', 'false');
    }
    function closeSidebar() {
      sidebar.classList.remove('open');
      overlay.classList.remove('show');
      document.body.classList.remove('sh-sidebar-active');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.setAttribute('aria-label', 'Abrir menu lateral');
      overlay.setAttribute('aria-hidden', 'true');
    }
    function toggleSidebar() {
      if (sidebar.classList.contains('open')) closeSidebar(); else openSidebar();
    }

    // Existing buttons may call their own toggleSidebar function; this listener
    // makes the behavior consistent across every admin page.
    toggle.addEventListener('click', function (event) {
      event.preventDefault();
      toggleSidebar();
    });
    overlay.addEventListener('click', closeSidebar);
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeSidebar();
    });
    sidebar.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (window.matchMedia('(max-width: 1000px)').matches) closeSidebar();
      });
    });
    window.addEventListener('resize', function () {
      if (!window.matchMedia('(max-width: 1000px)').matches) closeSidebar();
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', setupSilentHelpSidebar);
  else setupSilentHelpSidebar();
})();

</script>
</body>

</html>