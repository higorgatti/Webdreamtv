<?php
// Desabilitar TODO cache do PHP/Apache
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DreamTV TESTE SEM BARRA AZUL</title>
  <!-- Cache Bust: Force reload on changes -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!-- VERSÃO: Favoritos v2.1 - CACHE BUSTED 2025-10-26 11:10:50 -->
  <script>
    // Limpar cache ao carregar
  </script>
  <!-- React UMD -->
  <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
  <!-- Tailwind CSS instalado via NPM (ver tailwind.config.js) -->
  <!-- Para produção, compile com: npx tailwindcss -i ./src/input.css -o ./dist/output.css -->
  <!-- Mantendo CDN apenas para desenvolvimento rápido -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Players de vídeo disponíveis -->
  <!-- HLS.js para m3u8 no Chrome/Firefox/Edge -->
  <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>

  <!-- Clappr Player (Recommended) -->
  <script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>

  <!-- Video.js Player -->
  <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
  <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/videojs-contrib-hls@latest/dist/videojs-contrib-hls.min.js"></script>

  <!-- JW Player -->
  <script src="https://cdn.jwplayer.com/libraries/KB5zFt7A.js"></script>

  <!-- Flow Player -->
  <link rel="stylesheet" href="https://cdn.flowplayer.com/releases/native/3/stable/style/flowplayer.css">
  <script src="https://cdn.flowplayer.com/releases/native/3/stable/flowplayer.min.js"></script>
  <style>
    /* Previne scroll - comportamento Netflix (100% fixo na tela) */
    html{margin:0;padding:0;height:100vh;width:100vw;overflow:hidden}
    body{margin:0;padding:0;height:100vh;width:100vw;overflow:hidden;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,system-ui,sans-serif}
    .star-bg{background:#000;position:relative;overflow:hidden}
    .star-bg::before{content:'';position:absolute;inset:0;pointer-events:none;z-index:0;background-image:radial-gradient(2px 2px at 20px 30px,#fff,transparent),radial-gradient(2px 2px at 60px 70px,#fff,transparent),radial-gradient(1px 1px at 50px 50px,#fff,transparent),radial-gradient(1px 1px at 130px 80px,#fff,transparent),radial-gradient(2px 2px at 90px 10px,#fff,transparent);background-repeat:repeat;background-size:200px 200px;opacity:.3;animation:twinkle 3s infinite}
    @keyframes twinkle{0%,100%{opacity:.3}50%{opacity:.5}}
    .gradient-text{background:linear-gradient(90deg,#a855f7,#ec4899,#3b82f6);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
    .frost{background:rgba(30,30,30,.72);backdrop-filter:blur(6px);border:1px solid rgba(255,255,255,.08)}
    .card{transition:transform .2s ease,background .2s ease}
    .card:hover{transform:translateY(-2px)}
    .no-tap-highlight{-webkit-tap-highlight-color:transparent}
    .text-shadow{text-shadow:0 0 18px rgba(168,85,247,.35)}
    .hint{font-size:11px}
    .scrollbar-hide::-webkit-scrollbar{display:none}
    .scrollbar-hide{-ms-overflow-style:none;scrollbar-width:none}
    .line-clamp-3{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
    @keyframes spin{to{transform:rotate(360deg)}}
    .animate-spin{animation:spin 1s linear infinite}
    @keyframes fade-in{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
    .animate-fade-in{animation:fade-in 0.3s ease-out}
    @keyframes slideInRight{from{transform:translateX(100%)}to{transform:translateX(0)}}
    .netflix-card-hover{transition:all 0.3s cubic-bezier(0.5, 0, 0.1, 1)}
    .netflix-card-hover:hover{transform:scale(1.15) translateY(-8px);z-index:999}
    *::-webkit-scrollbar{width:8px;height:8px}
    *::-webkit-scrollbar-track{background:transparent}
    *::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.2);border-radius:4px}
    *::-webkit-scrollbar-thumb:hover{background:rgba(255,255,255,0.3)}

    /* Previne qualquer elemento de estourar a viewport horizontalmente */
    * {
      box-sizing: border-box;
    }

    /* Container principal sempre limitado à viewport */
    #root, .star-bg {
      max-width: 100vw;
      overflow-x: hidden;
    }

    /* Header agora está visível - CSS removido */

    /* ===== LAYOUT COM SIDEBAR FIXA ===== */
    :root {
      --sidebar-w: 80px;
    }

    .app-container {
      display: flex;
      width: 100vw;
      height: 100vh;
      overflow: hidden;
    }

    /* Sidebar fixa à esquerda */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: #000;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px 0;
      gap: 8px;
      z-index: 1000;
      border-right: 1px solid rgba(168, 85, 247, 0.1);
    }

    /* Botões da sidebar */
    .sidebar-btn {
      position: relative;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255, 255, 255, 0.6);
      background: transparent;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .sidebar-btn:hover {
      color: #fff;
      background: rgba(168, 85, 247, 0.1);
      transform: scale(1.1);
    }

    .sidebar-btn.active {
      color: #fff;
      background: rgba(168, 85, 247, 0.2);
    }

    .sidebar-btn.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 30px;
      background: #a855f7;
      border-radius: 0 3px 3px 0;
    }

    /* Tooltips da sidebar */
    .sidebar-btn::after {
      content: attr(data-tooltip);
      position: absolute;
      left: calc(100% + 12px);
      background: rgba(0, 0, 0, 0.9);
      color: #fff;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.2s ease;
      z-index: 10000;
    }

    .sidebar-btn:hover::after {
      opacity: 1;
    }

    /* Content area com margin */
    .main-content {
      margin-left: var(--sidebar-w);
      width: calc(100vw - var(--sidebar-w));
      height: 100vh;
      overflow-y: hidden;
      overflow-x: hidden;
    }

    /* Badge "L" para legendado */
    .lang-badge {
      position: absolute;
      top: 8px;
      right: 8px;
      background: rgba(0, 0, 0, 0.7);
      color: #a855f7;
      font-size: 11px;
      font-weight: 600;
      padding: 2px 6px;
      border-radius: 4px;
      border: 1px solid rgba(168, 85, 247, 0.5);
      z-index: 10;
      letter-spacing: 0.5px;
    }

    /* ===== MODO PREVIEW (janela do meio) ===== */

    /* Container principal - ocupa tela toda */
    #playerContainer{
      position:fixed !important;
      top:0 !important;
      left:0 !important;
      width:100vw !important;
      height:100vh !important;
      margin:0 !important;
      padding:0 !important;
      overflow:hidden !important;
      background:#000 !important;
      display:block !important;
      user-select:none !important;
      -webkit-user-select:none !important;
    }

    /* Viewport wrapper - GRID para centralização robusta sem conflitos */
    .player-viewport{
      position:relative !important;
      width:100% !important;
      height:100% !important;
      background:#000 !important;
      overflow:hidden !important;
      padding:0 !important;
      margin:0 !important;
    }

    /* Overlay do EPG - sobre o player */
    #playerContainer > .absolute{
      position:absolute !important;
      z-index:10 !important;
    }
    .absolute{position:absolute !important}
    .relative{position:relative !important}
    .fixed{position:fixed !important}
    .inset-0{top:0 !important;right:0 !important;bottom:0 !important;left:0 !important}
    .pointer-events-none{pointer-events:none !important}
    .pointer-events-auto{pointer-events:auto !important}
    .flex{display:flex !important}
    .flex-col{flex-direction:column !important}
    .items-start{align-items:flex-start !important}
    .items-center{align-items:center !important}
    .items-end{align-items:flex-end !important}
    .justify-start{justify-content:flex-start !important}
    .justify-center{justify-content:center !important}
    .justify-between{justify-content:space-between !important}
    .gap-2{gap:0.5rem !important}
    .gap-3{gap:0.75rem !important}
    .gap-4{gap:1rem !important}
    .gap-8{gap:2rem !important}
    .space-y-3>*+*{margin-top:0.75rem !important}


    /* ===== MODO FULLSCREEN (tela cheia - cobre 100%) ===== */

    /* Container em fullscreen */
    :fullscreen #playerContainer,
    :-webkit-full-screen #playerContainer,
    :-moz-full-screen #playerContainer,
    :-ms-fullscreen #playerContainer {
      width:100vw !important;
      height:100vh !important;
      background:#000 !important;
    }

    /* Viewport em fullscreen - mantém grid para centralizar */
    :fullscreen .player-viewport,
    :-webkit-full-screen .player-viewport,
    :-moz-full-screen .player-viewport,
    :-ms-fullscreen .player-viewport,
    #playerContainer:fullscreen .player-viewport,
    #playerContainer:-webkit-full-screen .player-viewport,
    #playerContainer:-moz-full-screen .player-viewport,
    #playerContainer:-ms-fullscreen .player-viewport {
      width:100vw !important;
      height:100vh !important;
      display:grid !important;
      place-items:center !important;
    }

    /* Overlay em FULLSCREEN - garantir que apareça sobre o vídeo */
    :fullscreen > .absolute,
    :-webkit-full-screen > .absolute,
    :-moz-full-screen > .absolute,
    :-ms-fullscreen > .absolute,
    #playerContainer:fullscreen > .absolute,
    #playerContainer:-webkit-full-screen > .absolute,
    #playerContainer:-moz-full-screen > .absolute,
    #playerContainer:-ms-fullscreen > .absolute {
      z-index:9999 !important;
      display:flex !important;
    }

    /* ===== SIDEBAR NAVIGATION ===== */
    .sidebar {
      width: 80px;
      min-width: 80px;
      background: #000;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 20px 0;
      border-right: 1px solid rgba(255, 255, 255, 0.1);
      height: 100vh;
      z-index: 100;
      flex-shrink: 0;
    }

    .sidebar-logo {
      color: #a855f7;
      font-size: 28px;
      font-weight: bold;
    }

    .sidebar-menu {
      display: flex;
      flex-direction: column;
      gap: 25px;
      align-items: center;
    }

    .sidebar-menu button, .sidebar-footer button {
      background: none;
      border: none;
      cursor: pointer;
      color: #888;
      transition: all 0.3s;
      position: relative;
      padding: 8px;
    }

    .sidebar-menu button.active::before {
      content: '';
      position: absolute;
      left: -15px;
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 20px;
      background-color: #a855f7;
      border-radius: 2px;
    }

    .sidebar-menu button:hover, .sidebar-footer button:hover {
      color: #fff;
      transform: scale(1.1);
    }

    .sidebar-footer {
      display: flex;
      flex-direction: column;
      gap: 25px;
      align-items: center;
    }

    /* Main content com sidebar */
    .main-with-sidebar {
      flex: 1;
      height: 100vh;
      overflow-y: hidden;
      overflow-x: hidden;
      position: relative;
    }

    /* Ajustes para telas com sidebar - garantir que conteúdo não sobreponha */
    .main-with-sidebar .star-bg {
      min-height: 100vh;
      width: 100% !important;
      max-width: 100% !important;
    }

    /* Forçar todos os containers dentro do main a respeitar a largura */
    .main-with-sidebar > * {
      max-width: 100% !important;
      box-sizing: border-box;
      overflow-x: hidden;
    }

    /* Container principal do app com sidebar */
    .app-container {
      display: flex;
      width: 100vw;
      height: 100vh;
      overflow: hidden;
      background: #000;
    }

    /* Fundo escuro */
    body.with-sidebar {
      background: #000;
      overflow: hidden;
    }

    /* ===== SMART TV MODE - 10-FOOT INTERFACE ===== */

    /* Estilos gerais para TV */
    body.tv-mode {
      font-size: 18px; /* Fontes maiores */
      cursor: none; /* Esconder cursor do mouse */
    }

    body.tv-mode * {
      cursor: none !important;
    }

    /* Remover hover states em modo TV (não há mouse) */
    body.tv-mode .card:hover,
    body.tv-mode .sidebar-btn:hover,
    body.tv-mode button:hover {
      transform: none !important;
    }

    /* Focus visível para navegação por controle remoto */
    body.tv-mode *:focus {
      outline: 4px solid #a855f7 !important;
      outline-offset: 4px;
      box-shadow: 0 0 20px rgba(168, 85, 247, 0.6) !important;
    }

    /* Indicador de foco customizado para botões */
    body.tv-mode button:focus,
    body.tv-mode [role="button"]:focus {
      background: rgba(168, 85, 247, 0.3) !important;
      border: 3px solid #a855f7 !important;
      transform: scale(1.08) !important;
      transition: all 0.15s ease !important;
    }

    /* Fontes maiores para legibilidade a 3 metros */
    body.tv-mode .text-sm { font-size: 16px !important; }
    body.tv-mode .text-base { font-size: 20px !important; }
    body.tv-mode .text-lg { font-size: 24px !important; }
    body.tv-mode .text-xl { font-size: 28px !important; }
    body.tv-mode .text-2xl { font-size: 32px !important; }
    body.tv-mode .text-3xl { font-size: 40px !important; }
    body.tv-mode .text-4xl { font-size: 48px !important; }

    /* Espaçamento maior entre elementos clicáveis */
    body.tv-mode button,
    body.tv-mode [role="button"] {
      min-height: 60px !important;
      min-width: 60px !important;
      padding: 16px 24px !important;
      margin: 8px !important;
    }

    /* Cards maiores e mais espaçados */
    body.tv-mode .netflix-card-hover {
      margin: 12px !important;
    }

    /* Sidebar maior para TV */
    body.tv-mode .sidebar {
      width: 100px !important;
    }

    body.tv-mode .sidebar-btn {
      width: 70px !important;
      height: 70px !important;
    }

    /* Contraste alto para texto */
    body.tv-mode {
      color: #ffffff !important;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
    }

    /* Remover tooltip hover da sidebar (usar apenas foco) */
    body.tv-mode .sidebar-btn::after {
      opacity: 0 !important;
    }

    body.tv-mode .sidebar-btn:focus::after {
      opacity: 1 !important;
      font-size: 18px !important;
    }

    /* Indicador de navegação numérica (para digitação de canal) */
    .tv-channel-input {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, 0.95);
      border: 4px solid #a855f7;
      border-radius: 20px;
      padding: 40px 60px;
      font-size: 72px;
      font-weight: bold;
      color: #fff;
      text-align: center;
      z-index: 10000;
      box-shadow: 0 10px 50px rgba(168, 85, 247, 0.5);
      animation: fade-in 0.2s ease-out;
      min-width: 300px;
    }

    /* Indicador de botão pressionado */
    @keyframes button-press {
      0% { transform: scale(1); }
      50% { transform: scale(0.95); }
      100% { transform: scale(1); }
    }

    body.tv-mode button:active,
    body.tv-mode [role="button"]:active {
      animation: button-press 0.2s ease !important;
    }

    /* Ajustes de scroll suave para navegação por foco */
    body.tv-mode {
      scroll-behavior: smooth;
    }

    /* Player em TV - controles maiores */
    body.tv-mode video {
      width: 100% !important;
      height: 100% !important;
    }

    /* ===== PÁGINA DE DETALHES DE SÉRIE ===== */
    .serie-detail-page {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .serie-detail-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      background-position: center;
      z-index: 0;
    }

    .serie-detail-backdrop::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to right,
        rgba(0, 0, 0, 0.95) 0%,
        rgba(0, 0, 0, 0.85) 40%,
        rgba(0, 0, 0, 0.6) 70%,
        rgba(0, 0, 0, 0.4) 100%
      );
    }

    .serie-detail-content {
      position: relative;
      z-index: 1;
      padding: 100px 60px 60px 60px;
      max-width: 1400px;
    }

    .serie-detail-header h1 {
      font-size: 64px;
      font-weight: 700;
      color: #ffffff;
      margin: 0 0 16px 0;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
    }

    .serie-detail-metadata {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .serie-detail-metadata span {
      font-size: 18px;
      color: #cccccc;
    }

    .serie-detail-rating-badge {
      background: #E85D04;
      color: #ffffff;
      padding: 4px 12px;
      border-radius: 4px;
      font-weight: 700;
      font-size: 16px;
    }

    .serie-detail-synopsis {
      font-size: 16px;
      line-height: 1.6;
      color: #e0e0e0;
      margin-bottom: 32px;
      max-width: 700px;
    }

    .serie-detail-actions {
      display: flex;
      gap: 16px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .serie-detail-btn {
      padding: 14px 32px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .serie-detail-btn:hover {
      transform: scale(1.05);
      filter: brightness(1.1);
    }

    .serie-detail-btn:active {
      transform: scale(0.98);
    }

    .serie-detail-btn-watch {
      background: #E85D04;
      color: #ffffff;
      font-size: 18px;
      padding: 16px 40px;
    }

    .serie-detail-btn-trailer {
      background: #0077B6;
      color: #ffffff;
    }

    .serie-detail-btn-favorite {
      background: #2D6A4F;
      color: #ffffff;
    }

    .serie-detail-btn-episodes {
      background: #B5179E;
      color: #ffffff;
      width: 100%;
      max-width: 300px;
      justify-content: center;
    }

    .serie-detail-cast-section {
      margin-top: 48px;
    }

    .serie-detail-cast-section h2 {
      font-size: 32px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 24px;
    }

    .serie-detail-cast-carousel {
      display: flex;
      gap: 16px;
      overflow-x: auto;
      overflow-y: hidden;
      padding-bottom: 16px;
      scrollbar-width: thin;
    }

    .serie-detail-cast-card {
      min-width: 140px;
      max-width: 140px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .serie-detail-cast-card:hover {
      transform: scale(1.05);
      filter: brightness(1.2);
    }

    .serie-detail-cast-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.1);
    }

    .serie-detail-cast-card p {
      margin-top: 8px;
      font-size: 14px;
      color: #ffffff;
      text-align: center;
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .serie-detail-content {
        padding: 80px 24px 40px 24px;
      }

      .serie-detail-header h1 {
        font-size: 36px;
      }

      .serie-detail-actions {
        flex-direction: column;
      }

      .serie-detail-btn {
        width: 100%;
        justify-content: center;
      }

      .serie-detail-btn-episodes {
        max-width: 100%;
      }
    }

    /* ===== RESPONSIVIDADE COMPLETA ===== */

    /* Tablets pequenos e celulares grandes (landscape) */
    @media (max-width: 1024px) {
      :root {
        --sidebar-w: 70px;
      }

      .sidebar-btn {
        width: 45px;
        height: 45px;
        font-size: 20px;
      }

      header {
        padding: 0 20px !important;
      }

      header input[type="text"] {
        width: 150px !important;
      }
    }

    /* Tablets e celulares grandes */
    @media (max-width: 768px) {
      :root {
        --sidebar-w: 60px;
      }

      .sidebar {
        padding: 15px 0;
        gap: 6px;
      }

      .sidebar-btn {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }

      /* Esconder tooltips em telas pequenas */
      .sidebar-btn::after {
        display: none;
      }

      /* Header responsivo */
      header {
        height: 50px !important;
        padding: 0 15px !important;
      }

      header nav {
        gap: 15px !important;
      }

      header a {
        font-size: 12px !important;
      }

      header input[type="text"] {
        width: 120px !important;
        font-size: 12px !important;
      }

      /* Ajustar cards de filmes */
      .main-content {
        width: calc(100vw - var(--sidebar-w)) !important;
      }

      /* Menu de perfil */
      header > div:last-child > div:last-child {
        width: 240px !important;
        right: -10px !important;
      }
    }

    /* Celulares médios */
    @media (max-width: 640px) {
      :root {
        --sidebar-w: 0px; /* Esconder sidebar em mobile */
      }

      .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }

      .sidebar.mobile-open {
        transform: translateX(0);
      }

      /* Botão hamburger para abrir sidebar */
      .mobile-menu-btn {
        display: block !important;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1001;
        width: 40px;
        height: 40px;
        background: rgba(0, 0, 0, 0.8);
        border: 1px solid rgba(168, 85, 247, 0.3);
        border-radius: 8px;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
      }

      .main-content {
        margin-left: 0 !important;
        width: 100vw !important;
      }

      /* Header mobile */
      header {
        padding: 0 10px !important;
        padding-left: 55px !important; /* Espaço para o botão hamburger */
      }

      header nav {
        display: none !important; /* Esconder navegação em mobile */
      }

      header input[type="text"] {
        width: 100px !important;
        font-size: 11px !important;
        padding: 6px 10px !important;
      }

      /* Avatar menor */
      header > div:last-child img,
      header > div:last-child > div:first-child {
        width: 32px !important;
        height: 32px !important;
      }

      /* Esconder busca em telas muito pequenas */
      @media (max-width: 480px) {
        header input[type="text"] {
          display: none !important;
        }
      }
    }

    /* Celulares pequenos */
    @media (max-width: 480px) {
      /* Header ainda menor */
      header {
        height: 45px !important;
      }

      header a {
        font-size: 11px !important;
      }

      /* Menu de perfil ocupa mais espaço */
      header > div:last-child > div:last-child {
        width: calc(100vw - 30px) !important;
        right: -5px !important;
      }

      /* Ajustar modais */
      .tv-channel-input {
        min-width: 200px !important;
        padding: 20px !important;
      }

      .tv-channel-input > div:first-child {
        font-size: 32px !important;
      }
    }

    /* Telas muito grandes (> 1920px) */
    @media (min-width: 1920px) {
      :root {
        --sidebar-w: 90px;
      }

      .sidebar-btn {
        width: 55px;
        height: 55px;
        font-size: 26px;
      }

      header {
        height: 70px !important;
      }

      header a {
        font-size: 16px !important;
      }

      header input[type="text"] {
        width: 250px !important;
        font-size: 15px !important;
      }
    }

    /* Modo paisagem em celulares */
    @media (max-height: 500px) and (orientation: landscape) {
      .sidebar {
        padding: 10px 0;
        gap: 4px;
      }

      .sidebar-btn {
        width: 35px;
        height: 35px;
        font-size: 16px;
      }

      header {
        height: 40px !important;
      }
    }
  </style>

  <!-- ===== CACHE SYSTEM - IndexedDB Manager ===== -->
  <script src="jquery/db-manager.js"></script>
  <script src="jquery/sync-manager.js"></script>
</head>
<body class="no-tap-highlight">
  <div id="app"></div>

  <!-- ===== LIBS CUSTOMIZADAS ===== -->
  <script>
  // ===== lib/queue.js - Sistema de fila com dedupe =====
  (function() {
    const CONC = 6, MAX = 35, WIN = 10000;
    let running = 0, tokens = MAX;
    const queue = [], inflight = new Map();

    setInterval(() => { tokens = MAX; }, WIN);

    window.schedule = function(key, task) {
      if (inflight.has(key)) {
        return inflight.get(key);
      }

      const promise = new Promise((resolve, reject) => {
        queue.push(async () => {
          try {
            while (tokens <= 0 || running >= CONC) await new Promise(r => setTimeout(r, 200));
            tokens--; running++;
            const result = await task();
            resolve(result);
          } catch (error) {
            reject(error);
          } finally {
            running--; inflight.delete(key); pump();
          }
        });
      });

      inflight.set(key, promise);
      pump();
      return promise;
    };

    function pump() {
      if (running < CONC && queue.length > 0) queue.shift()();
    }

    window.__queueStats = () => ({ running, queued: queue.length, inflight: inflight.size, tokens });
  })();

  // ===== lib/normalizeTitle.js - Normalização de títulos =====
  window.prepareForTMDB = function(title) {
    if (!title) return { searchTitle: '', year: null, displayTitle: '', isLegendado: false, langType: 'dublado' };

    const originalTitle = title.trim();
    const isLegendado = /\(L\)\s*$/i.test(originalTitle);
    const searchTitle = originalTitle.replace(/\s*\(L\)\s*$/i, '').trim();
    const year = (searchTitle.match(/\b(19\d{2}|20\d{2})\b/) || [])[1];

    let cleanTitle = searchTitle
      .replace(/\s*\([LDld]\)\s*$/gi, '')
      .replace(/\s*\((HD|FHD|4K|CAM|WEB-DL|BluRay|BRRip|DVDRip|HDTV|WEBRip)\)\s*/gi, ' ')
      .replace(/\b(UHD|FHD|4K|1080p|720p|480p|2160p|HDR|TESTE4K|TESTE|10bit|8bit)\b/gi, '')
      .replace(/\s*\([^\)]*(?:RIP|WEB|BLU|DVD|CAM|HDTV)[^\)]*\)\s*/gi, ' ')
      .replace(/\s*-?\s*\d{4}\s*$/g, '')
      .replace(/[–—:]/g, ' ')
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/\s{2,}/g, ' ')
      .replace(/^[-\s]+|[-\s]+$/g, '')
      .trim();

    return {
      searchTitle: cleanTitle,
      year: year ? parseInt(year) : null,
      displayTitle: originalTitle,
      isLegendado,
      langType: isLegendado ? 'legendado' : 'dublado'
    };
  };

  // ===== lib/mergeMedia.js - Merge servidor/TMDB =====
  window.mergeMedia = function(server, tmdb) {
    if (!server) return null;

    const TMDB_IMG = 'https://image.tmdb.org/t/p';

    // ===== PRIORIDADE: Poster SERVIDOR, Backdrop TMDB =====
    const serverPoster = server.stream_icon || server.cover;
    const poster = serverPoster || (tmdb?.poster_path ? `${TMDB_IMG}/w500${tmdb.poster_path}` : null);

    // Backdrop: TMDB primeiro (melhor qualidade - original), depois servidor
    const backdrop = (tmdb?.backdrop_path ? `${TMDB_IMG}/original${tmdb.backdrop_path}` : null) ||
                     (server.backdrop_path?.includes('http') ? server.backdrop_path : null) ||
                     (server.backdrop?.includes('http') ? server.backdrop : null);

    const serverPlot = server.plot || server.description || '';
    const plot = (serverPlot.length >= 120) ? serverPlot : (tmdb?.overview || serverPlot);
    const year = server.releaseDate || server.year ||
                 (tmdb?.release_date ? Number(tmdb.release_date.slice(0, 4)) : null) ||
                 (tmdb?.first_air_date ? Number(tmdb.first_air_date.slice(0, 4)) : null);
    const rating = tmdb?.vote_average || server.rating || null;
    const trailer = tmdb?.videos?.results?.find(v => v.type === 'Trailer' && v.site === 'YouTube');

    return {
      ...server,
      tmdbId: tmdb?.id || server.tmdbId,
      poster, backdrop, plot, year, rating,
      trailerKey: trailer?.key
    };
  };

  window.cacheStreamToTmdb = function(streamId, tmdbId) {
    if (!streamId || !tmdbId) return;
    try {
      const cache = JSON.parse(localStorage.getItem('streamTmdbCache') || '{}');
      cache[streamId] = { tmdbId, timestamp: Date.now() };
      const thirtyDays = 30 * 24 * 60 * 60 * 1000;
      Object.keys(cache).forEach(key => {
        if (Date.now() - cache[key].timestamp > thirtyDays) delete cache[key];
      });
      localStorage.setItem('streamTmdbCache', JSON.stringify(cache));
    } catch (e) { }
  };

  window.getCachedTmdbId = function(streamId) {
    if (!streamId) return null;
    try {
      const cache = JSON.parse(localStorage.getItem('streamTmdbCache') || '{}');
      return cache[streamId]?.tmdbId || null;
    } catch (e) { return null; }
  };
  </script>

  <script>
  'use strict'
  // Version: 2025-01-25-17:30 - All console logs removed
  const e = React.createElement
  const { useState, useEffect, useMemo, useRef } = React

  // ===== FORÇA LIMPEZA DE CACHE - Service Worker + Hard Reload =====
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(registrations => {
      if(registrations.length > 0) {
        registrations.forEach(registration => {
          registration.unregister()
        })
      }
    })
  }

  // ===== LIMPAR CACHE TMDB ANTIGO (com títulos " - 2025") =====
  try {
    const oldCache = localStorage.getItem('tmdb_cache')
    if(oldCache) {
      const parsed = JSON.parse(oldCache)
      const keys = Object.keys(parsed)
      const hasOldFormat = keys.some(key => key.includes(' - 20'))
      if(hasOldFormat) {
        localStorage.removeItem('tmdb_cache')
      }
    }
  } catch(e) {
  }

  // ===== Helpers =====
  function useLocalStorage(key, initial){
    const [val,setVal] = useState(()=>{
      try{ const v = localStorage.getItem(key); return v? JSON.parse(v): initial }catch{ return initial }
    })
    useEffect(()=>{ try{ localStorage.setItem(key, JSON.stringify(val)) }catch{} }, [key,val])
    return [val,setVal]
  }

  // ===== SMART TV DETECTION & REMOTE CONTROL SUPPORT =====

  // Detectar se está rodando em Smart TV
  const TVDetector = {
    isTV: false,
    platform: null,

    detect() {
      const ua = navigator.userAgent

      // Detectar plataformas de TV APENAS por User Agent (mais confiável)
      if (/webOS|Web0S/i.test(ua)) {
        this.isTV = true
        this.platform = 'LG webOS'
      } else if (/Tizen/i.test(ua)) {
        this.isTV = true
        this.platform = 'Samsung Tizen'
      } else if (/AndroidTV|SmartTV|SMART-TV|GoogleTV/i.test(ua)) {
        this.isTV = true
        this.platform = 'Android TV'
      } else if (/BRAVIA|SonyDTV/i.test(ua)) {
        this.isTV = true
        this.platform = 'Sony Bravia'
      } else if (/HbbTV/i.test(ua)) {
        this.isTV = true
        this.platform = 'HbbTV'
      } else if (/NetCast/i.test(ua)) {
        this.isTV = true
        this.platform = 'LG NetCast'
      } else if (/CrKey|Chromecast/i.test(ua)) {
        this.isTV = true
        this.platform = 'Chromecast'
      }

      // NÃO detectar por resolução - computadores também têm 1080p/4K
      // NÃO detectar por gamepad - gamers usam no PC

      if (this.isTV) {
        const w = window.screen.width
        const h = window.screen.height
        document.body.classList.add('tv-mode')
      } else {
      }

      return this.isTV
    },

    isMobile() {
      return /Android|iPhone|iPad|iPod|Mobile/i.test(navigator.userAgent)
    }
  }

  // Mapa de teclas do controle remoto
  const RemoteKeyMap = {
    // Setas
    ARROW_UP: [38, 'ArrowUp'],
    ARROW_DOWN: [40, 'ArrowDown'],
    ARROW_LEFT: [37, 'ArrowLeft'],
    ARROW_RIGHT: [39, 'ArrowRight'],

    // Ações
    OK: [13, 'Enter'],
    BACK: [8, 27, 461, 10009, 'Backspace', 'Escape'], // 461=webOS back, 10009=Tizen back

    // Números
    NUM_0: [48, 96, '0'],
    NUM_1: [49, 97, '1'],
    NUM_2: [50, 98, '2'],
    NUM_3: [51, 99, '3'],
    NUM_4: [52, 100, '4'],
    NUM_5: [53, 101, '5'],
    NUM_6: [54, 102, '6'],
    NUM_7: [55, 103, '7'],
    NUM_8: [56, 104, '8'],
    NUM_9: [57, 105, '9'],

    // Botões coloridos (Smart TVs)
    RED: [403, 'Red', 'ColorF0Red'],
    GREEN: [404, 'Green', 'ColorF1Green'],
    YELLOW: [405, 'Yellow', 'ColorF2Yellow'],
    BLUE: [406, 'Blue', 'ColorF3Blue'],

    // Controle de mídia
    PLAY: [415, 'MediaPlayPause', 'Play'],
    PAUSE: [19, 'MediaPause', 'Pause'],
    STOP: [413, 'MediaStop', 'Stop'],
    REWIND: [412, 'MediaRewind', 'Rewind'],
    FORWARD: [417, 'MediaFastForward', 'FastForward'],

    // Outros
    INFO: [457, 'Info'],
    MENU: [18, 'Menu'],
    GUIDE: [458, 'Guide'],

    // Verifica se tecla/código corresponde a um comando
    matches(keyMap, event) {
      return keyMap.includes(event.keyCode) || keyMap.includes(event.key) || keyMap.includes(event.code)
    }
  }

  // Sistema de navegação por foco (para controle remoto)
  const FocusNavigator = {
    currentIndex: 0,
    items: [],
    containerSelector: null,

    init(selector) {
      this.containerSelector = selector
      this.updateItems()
    },

    updateItems() {
      if (!this.containerSelector) return
      const container = document.querySelector(this.containerSelector)
      if (!container) return

      // Coletar todos os elementos focáveis
      this.items = Array.from(container.querySelectorAll(
        'button:not([disabled]), [role="button"]:not([disabled]), a[href], [tabindex]:not([tabindex="-1"])'
      ))

      // Se há um item focado, atualizar o índice
      const focused = document.activeElement
      const index = this.items.indexOf(focused)
      if (index !== -1) {
        this.currentIndex = index
      }
    },

    focus(index) {
      if (index < 0 || index >= this.items.length) return
      this.currentIndex = index
      const item = this.items[index]
      if (item) {
        item.focus()
        // Scroll suave para o elemento
        item.scrollIntoView({ behavior: 'smooth', block: 'center' })
      }
    },

    next() {
      this.updateItems()
      if (this.currentIndex < this.items.length - 1) {
        this.focus(this.currentIndex + 1)
      }
    },

    prev() {
      this.updateItems()
      if (this.currentIndex > 0) {
        this.focus(this.currentIndex - 1)
      }
    },

    select() {
      const item = this.items[this.currentIndex]
      if (item) {
        item.click()
      }
    }
  }

  // Executar detecção de TV
  const isSmartTV = TVDetector.detect()

  // Armazenar globalmente para acesso pelos componentes
  window.__isSmartTV = isSmartTV
  window.__tvPlatform = TVDetector.platform

  // ===== Netflix Category Mapping =====
  function mapApiCategoryToNetflix(categoryName){
    const name = (categoryName || '').toLowerCase()
    if(/aç[aã]o|action/i.test(name)) return 'action'
    if(/com[eé]dia|comedy/i.test(name)) return 'comedy'
    if(/drama/i.test(name)) return 'drama'
    if(/terror|horror/i.test(name)) return 'horror'
    if(/fic[çc][aã]o|sci-?fi|fantasy|fantasia/i.test(name)) return 'scifi'
    if(/romance/i.test(name)) return 'romance'
    if(/document[aá]rio|documentary/i.test(name)) return 'documentary'
    if(/crian[çc]a|fam[ií]lia|kids|family/i.test(name)) return 'kids'
    if(/anime/i.test(name)) return 'anime'
    if(/cl[aá]ssico|classic/i.test(name)) return 'classics'
    return null
  }

  function getNetflixCategoryDisplayName(categoryKey){
    const names = {
      'trending': 'Tendências agora',
      'popular': 'Populares',
      'top10': 'Top 10 no Brasil',
      'recent': 'Lançados recentemente',
      'continue': 'Continuar assistindo',
      'recommended': 'Porque você assistiu',
      'action': 'Ação',
      'comedy': 'Comédia',
      'drama': 'Drama',
      'horror': 'Terror',
      'scifi': 'Ficção científica e fantasia',
      'romance': 'Romance',
      'documentary': 'Documentários',
      'kids': 'Crianças e família',
      'anime': 'Animes',
      'classics': 'Clássicos'
    }
    return names[categoryKey] || categoryKey
  }

  function sanitizeServer(url){ if(!url) return '';
    const u = url.trim().replace(/\/$/,'')
    if(!/^https?:\/\//i.test(u)) return 'http://' + u
    return u
  }

  function buildURL(base, pathSegs){
    const b = sanitizeServer(base)
    return [b, ...pathSegs.map(s=>String(s).replace(/^\/+|\/+$/g,''))].join('/')
  }

  function maskUrlCredentials(url){
    try{
      const u = new URL(url)
      const qs = u.search.replace(/(username=)([^&]+)/i, '$1***').replace(/(password=)([^&]+)/i, '$1***')
      const path = u.pathname.replace(/\/(live|movie|series)\/([^/]+)\/([^/]+)\//i, '/$1/***/***/')
      return `${u.origin}${path}${qs}`
    }catch{ return url.replace(/(username=)([^&]+)/i, '$1***').replace(/(password=)([^&]+)/i, '$1***') }
  }

  function formatEPGTime(v){
    if(v==null) return '--:--'

    // Se já está no formato HH:mm, retornar direto
    if(typeof v==='string' && /^\d{1,2}:\d{2}$/.test(v)) return v

    // Se é string de data completa (YYYY-MM-DD HH:mm:ss)
    if(typeof v==='string' && /^\d{4}-\d{2}-\d{2}/.test(v)){
      const d = new Date(v)
      if(!isNaN(d.getTime())){
        const hh = String(d.getHours()).padStart(2,'0')
        const mm = String(d.getMinutes()).padStart(2,'0')
        return `${hh}:${mm}`
      }
    }

    // Se é timestamp numérico
    const n = Number(v)
    if(!isNaN(n)){
      // Timestamp em segundos ou milissegundos
      const ms = n > 1e12 ? n : (n > 1e10 ? n : n*1000)
      const d = new Date(ms)

      // FORÇAR timezone UTC-3 (São Paulo/Brasília)
      const utc = d.getTime() + (d.getTimezoneOffset() * 60000) // Converter para UTC
      const brTime = new Date(utc + (-3 * 3600000)) // UTC-3

      const hh = String(brTime.getHours()).padStart(2,'0')
      const mm = String(brTime.getMinutes()).padStart(2,'0')

      return `${hh}:${mm}`
    }

    return '--:--'
  }

  function decodeHtml(text){
    if(!text) return text
    const textarea = document.createElement('textarea')
    textarea.innerHTML = text
    return textarea.value
  }

  function decodeBase64(text){
    if(!text) return text
    try{
      // Tentar decodificar base64
      const decoded = atob(text)
      // Verificar se é texto válido (não binário)
      if(/^[\x20-\x7E\u00A0-\uFFFF\s]*$/.test(decoded)){
        return decoded
      }
      return text
    }catch{
      // Se falhar, retornar o texto original
      return text
    }
  }

  function fixEncoding(text){
    if(!text || typeof text !== 'string') return text

    // Se o texto parece normal (caracteres ASCII comuns), não mexe
    if(/^[a-zA-Z0-9\s\-\.,!?]+$/.test(text)) return text

    try{
      // Corrigir encoding UTF-8 interpretado como Latin-1
      // Converte "TensÃ£o" → "Tensão"
      const fixed = decodeURIComponent(escape(text))

      // Verificar se ficou melhor ou pior
      // Se gerou caracteres de controle ou lixo, retorna original
      if(/[\x00-\x08\x0B\x0C\x0E-\x1F]/.test(fixed)){
        return text
      }

      return fixed
    }catch{
      return text
    }
  }

  function decodeEpgText(text){
    if(!text) return text
    const original = text

    // NÃO processar textos curtos/simples (como "SP2", "HD", etc)
    // Isso evita quebrar texto que já está correto
    if(text.length <= 10 && /^[A-Za-z0-9\s\-]+$/.test(text)){
      return text
    }

    // 1. Decodificar base64 (se aplicável)
    let decoded = decodeBase64(text)
    // 2. Decodificar HTML entities
    decoded = decodeHtml(decoded)
    // 3. Corrigir encoding UTF-8 (por último) - APENAS se tiver caracteres problemáticos
    // NÃO aplicar em texto simples ASCII para evitar quebrar "SP2" → "Hy"
    if(/[ÃÀ-ÿ]/.test(decoded)){
      decoded = fixEncoding(decoded)
    }

    return decoded
  }

  // Normalizadores para respostas de painéis que não retornam Arrays puros
  function toArray(x){
    if(Array.isArray(x)) return x
    if(x && typeof x==='object'){
      return Object.values(x)
    }
    return []
  }
  function getCatId(cat){
    return cat?.category_id ?? cat?.parent_id ?? cat?.id ?? cat?.CategoryID ?? cat?.categoryid ?? null
  }

  // ===== Quality Variants System =====
  function extractBaseName(channelName){
    if(!channelName) return ''
    // Remove sufixos de qualidade: FHD, FHD², HD, HD², SD, SD²
    const cleanName = channelName
      .replace(/\s*\(?(FHD²|FHD|HD²|HD|SD²|SD)\)?$/i, '')
      .replace(/\s*\[(FHD²|FHD|HD²|HD|SD²|SD)\]$/i, '')
      .trim()
    return cleanName || channelName
  }

  function detectQuality(channelName){
    if(!channelName) return null
    const match = channelName.match(/(FHD²|FHD|HD²|HD|SD²|SD)$/i)
    if(match) return match[1].toUpperCase()
    // Se não tem sufixo, considera Original
    return null
  }

  function groupChannelsByBaseName(channels){
    const groups = {}
    for(const ch of channels){
      const baseName = extractBaseName(ch.name || '')
      if(!baseName) continue

      if(!groups[baseName]){
        groups[baseName] = {
          baseName,
          baseChannel: ch,
          variants: []
        }
      }

      const quality = detectQuality(ch.name || '')
      groups[baseName].variants.push({
        ...ch,
        quality: quality || 'Original',
        baseName
      })
    }

    return Object.values(groups)
  }

  function getUniqueChannels(channels){
    // Retorna apenas um canal por base name (para o menu esquerdo)
    const groups = groupChannelsByBaseName(channels)
    return groups.map(g => {
      // 🔧 CORRIGIDO: Se QUALQUER variante tiver tv_archive=1, o canal tem playback
      const variantWithArchive = g.variants.find(v => v.tv_archive === 1 || v.tv_archive === "1")
      const hasTvArchive = !!variantWithArchive

      return {
        ...g.baseChannel,
        baseName: g.baseName,
        hasVariants: g.variants.length > 1,
        variantCount: g.variants.length,
        // Usar tv_archive da variante que tem playback (se existir)
        tv_archive: hasTvArchive ? 1 : (g.baseChannel.tv_archive || 0),
        tv_archive_duration: hasTvArchive ? variantWithArchive.tv_archive_duration : g.baseChannel.tv_archive_duration
      }
    })
  }

  function getVariantsForChannel(channels, baseName){
    const groups = groupChannelsByBaseName(channels)
    const group = groups.find(g => g.baseName === baseName)
    return group ? group.variants : []
  }

  // ===== Pool de Requisições & Retry =====
  let inFlightRequests = 0
  const MAX_CONCURRENT_REQUESTS = 6

  async function withRequestPool(task) {
    while (inFlightRequests >= MAX_CONCURRENT_REQUESTS) {
      await new Promise(resolve => setTimeout(resolve, 50))
    }
    inFlightRequests++
    try {
      return await task()
    } finally {
      inFlightRequests--
    }
  }

  async function withRetry(fn, maxRetries = 2, delay = 500) {
    for (let i = 0; i <= maxRetries; i++) {
      try {
        return await fn()
      } catch (error) {
        // Não fazer retry em erros de validação ou abort
        if (i === maxRetries || error.name === 'AbortError' || error.message.includes('Expected JSON')) {
          throw error
        }
        // Backoff exponencial: 500ms, 1000ms, 2000ms
        const backoffDelay = delay * Math.pow(2, i)
        await new Promise(resolve => setTimeout(resolve, backoffDelay))
      }
    }
  }

  // ===== Xtream Codes API Client =====
  // Cliente completo para API Xtream Codes com controle de concorrência,
  // retry automático, timeout e cancelamento de requisições.
  //
  // IMPORTANTE: Este módulo NÃO altera layout/UI - apenas camada de dados.

  const XCClient = (() => {
    // AbortControllers ativos por tipo de operação
    const activeRequests = {
      vod: null,
      live: null,
      series: null,
      epg: null
    }

    // Cancelar requisição anterior do mesmo tipo
    function cancelPrevious(type) {
      if (activeRequests[type]) {
        activeRequests[type].abort()
        activeRequests[type] = null
      }
    }

    // Wrapper para fetch com timeout e abort
    async function fetchWithAbort(url, type, timeout = 10000) {
      cancelPrevious(type)

      const controller = new AbortController()
      activeRequests[type] = controller

      const timeoutId = setTimeout(() => controller.abort(), timeout)

      try {
        const res = await fetch(url, {
          signal: controller.signal,
          headers: { 'Accept': 'application/json' }
        })

        clearTimeout(timeoutId)

        const contentType = (res.headers.get('content-type') || '').toLowerCase()
        const text = await res.text()

        if (!res.ok) {
          throw new Error(`[HTTP ${res.status}] ${text.slice(0, 200)}`)
        }

        // Validar JSON
        if (!contentType.includes('application/json') && !contentType.includes('text/plain')) {
          throw new Error(`Expected JSON, got: ${contentType}`)
        }

        if (text.trim().startsWith('<!DOCTYPE') || text.trim().startsWith('<html')) {
          throw new Error('Received HTML instead of JSON')
        }

        return JSON.parse(text)
      } catch (error) {
        clearTimeout(timeoutId)
        if (error.name === 'AbortError') {
        }
        throw error
      } finally {
        if (activeRequests[type] === controller) {
          activeRequests[type] = null
        }
      }
    }

    // API Endpoints
    return {
      // ===== LIVES =====
      async getLiveCategories() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_live_categories'
        })
        return fetchWithAbort(url, 'live')
      },

      async getLiveStreams() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_live_streams'
        })
        return fetchWithAbort(url, 'live')
      },

      async getLiveStreamsByCategory(categoryId) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_live_streams',
          category_id: String(categoryId)
        })
        return fetchWithAbort(url, 'live')
      },

      // ===== VOD =====
      async getVodCategories() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_vod_categories'
        })
        return fetchWithAbort(url, 'vod')
      },

      async getVodStreams() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_vod_streams'
        })
        return fetchWithAbort(url, 'vod')
      },

      // IMPORTANTE: API Xtream Codes NÃO suporta category_id para VOD
      // Esta função existe para compatibilidade, mas faz filtro client-side
      async getVodStreamsByCategory(categoryId) {
        const allVods = await this.getVodStreams()

        if (!Array.isArray(allVods)) {
          return []
        }

        return allVods.filter(item =>
          item && String(item.category_id) === String(categoryId)
        )
      },

      async getVodInfo(vodId) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_vod_info',
          vod_id: String(vodId)
        })
        return fetchWithAbort(url, 'vod')
      },

      // ===== SERIES =====
      async getSeriesCategories() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_series_categories'
        })
        return fetchWithAbort(url, 'series')
      },

      async getSeries() {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_series'
        })
        return fetchWithAbort(url, 'series')
      },

      async getSeriesByCategory(categoryId) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_series',
          category_id: String(categoryId)
        })
        return fetchWithAbort(url, 'series')
      },

      async getSeriesInfo(seriesId) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_series_info',
          series_id: String(seriesId)
        })
        return fetchWithAbort(url, 'series')
      },

      // ===== EPG =====
      async getShortEpg(streamId, limit = 4) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_short_epg',
          stream_id: String(streamId),
          limit: String(limit)
        })
        return fetchWithAbort(url, 'epg')
      },

      async getSimpleDateTable(streamId) {
        const url = '/api/player_api.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || '',
          action: 'get_simple_data_table',
          stream_id: String(streamId)
        })
        return fetchWithAbort(url, 'epg')
      },

      async getXmltvFull() {
        const url = '/api/xmltv.php?' + new URLSearchParams({
          username: window.__xcConfig?.username || '',
          password: window.__xcConfig?.password || ''
        })
        return fetchWithAbort(url, 'epg', 30000) // 30s timeout para EPG completo
      },

      // Cancelar todas as requisições em andamento
      cancelAll() {
        Object.values(activeRequests).forEach(controller => {
          if (controller) controller.abort()
        })
        activeRequests.vod = null
        activeRequests.live = null
        activeRequests.series = null
        activeRequests.epg = null
      }
    }
  })()

  // ===== LAZY IMAGE COMPONENT (OPTIMIZED) =====
  const LazyImage = React.memo(({ src, alt, style, className, placeholder }) => {
    const [imageSrc, setImageSrc] = useState(placeholder || 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 450"%3E%3Crect fill="%23222" width="300" height="450"/%3E%3C/svg%3E')
    const [isLoaded, setIsLoaded] = useState(false)
    const imgRef = useRef(null)

    useEffect(() => {
      if (!src) return

      // Intersection Observer para lazy loading
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              // Imagem entrou na viewport, carregar!
              const img = new Image()
              img.src = src
              img.onload = () => {
                setImageSrc(src)
                setIsLoaded(true)
              }
              img.onerror = () => {
                // Fallback se imagem falhar
                setImageSrc(placeholder || imageSrc)
              }
              observer.unobserve(entry.target)
            }
          })
        },
        {
          rootMargin: '50px', // Começa a carregar 50px antes de entrar na tela
          threshold: 0.01
        }
      )

      if (imgRef.current) {
        observer.observe(imgRef.current)
      }

      return () => {
        if (imgRef.current) {
          observer.unobserve(imgRef.current)
        }
      }
    }, [src])

    return e('img', {
      ref: imgRef,
      src: imageSrc,
      alt: alt || '',
      className: className || '',
      style: {
        ...style,
        transition: 'opacity 0.3s ease-in-out',
        opacity: isLoaded ? 1 : 0.7
      }
    })
  }, (prevProps, nextProps) => {
    // Só re-render se src mudar
    return prevProps.src === nextProps.src &&
           prevProps.className === nextProps.className
  })

  // ===== BARRA DE CATEGORIAS DE FILMES E SÉRIES =====
  function CategoryBar({ vodCats, seriesCats, view, setView, selectedCat, setSelectedCat }) {
    // IMPORTANTE: Todos os Hooks devem ser chamados ANTES de qualquer return condicional
    const [showDropdown, setShowDropdown] = useState(false)

    // Calcular flags de view
    const isMoviesView = view === 'netflix-movies' || view === 'vod-categories'
    const isSeriesView = view === 'netflix-series' || view === 'series-categories'
    const isAdultView = view === 'adult-content' || view === 'adult-categories'

    // Usar categorias apropriadas
    let categories = isSeriesView ? (seriesCats || []) : (vodCats || [])

    // Filtrar categorias baseado na view
    if (isAdultView) {
      // Na view adulta: mostrar APENAS categorias 18+
      categories = categories.filter(cat => {
        const catName = cat.category_name || cat.name || ''
        return catName.trim().startsWith('18+')
      })
    } else if (isMoviesView) {
      // Na view de filmes: REMOVER categorias 18+, Animes e Show
      categories = categories.filter(cat => {
        const catName = (cat.category_name || cat.name || '').toLowerCase().trim()
        // Remover: 18+, animes (crunchyroll, anime), show
        return !catName.startsWith('18+') &&
               !catName.includes('crunchyroll') &&
               !catName.includes('anime') &&
               !catName.includes('show')
      })
    }

    // Categorias prioritárias no topo (ordem específica)
    const priorityNames = [
      'lançamentos',
      'lancamentos',
      'lançamentos legendados',
      'lancamentos legendados',
      'cinema',
      'indicados ao oscar',
      'oscar'
    ]

    // Separar categorias prioritárias e outras
    const priorityCats = []
    const otherCats = []

    categories.forEach(cat => {
      const catName = cat.category_name || cat.name || ''
      const normalizedName = catName.toLowerCase().trim()

      // Verificar se é uma categoria prioritária
      // Lógica especial: "lançamentos" não deve pegar "lançamentos legendados"
      let priorityIndex = -1

      // Verificar match exato primeiro
      priorityIndex = priorityNames.findIndex(pName => normalizedName === pName)

      // Se não achou match exato, tentar substring (mas com cuidado)
      if (priorityIndex === -1) {
        // Para "lançamentos legendados" e "lancamentos legendados"
        if (normalizedName.includes('legendado')) {
          priorityIndex = priorityNames.findIndex(pName => pName.includes('legendado'))
        }
        // Para "lançamentos" simples (sem "legendado")
        else if (normalizedName.includes('lançamento') || normalizedName.includes('lancamento')) {
          priorityIndex = priorityNames.findIndex(pName =>
            (pName === 'lançamentos' || pName === 'lancamentos')
          )
        }
        // Para "cinema"
        else if (normalizedName.includes('cinema')) {
          priorityIndex = priorityNames.findIndex(pName => pName === 'cinema')
        }
        // Para "indicados ao oscar" ou "oscar"
        else if (normalizedName.includes('oscar')) {
          priorityIndex = priorityNames.findIndex(pName => pName.includes('oscar'))
        }
      }

      if (priorityIndex !== -1) {
        priorityCats.push({ cat, priority: priorityIndex })
      } else {
        otherCats.push(cat)
      }
    })

    // Ordenar categorias prioritárias pela ordem definida
    priorityCats.sort((a, b) => a.priority - b.priority)
    const sortedPriorityCats = priorityCats.map(item => item.cat)

    // Combinar: prioritárias primeiro, depois as outras
    const orderedCats = [...sortedPriorityCats, ...otherCats]

    // Inicializar categoria selecionada IMEDIATAMENTE quando categorias estiverem disponíveis
    useEffect(() => {
      if (orderedCats.length > 0) {
        // Definir imediatamente sem aguardar próximo render
        setSelectedCat(orderedCats[0])
      }
    }, [categories.length, isMoviesView, isSeriesView, isAdultView])

    // AGORA SIM, fazer returns condicionais APÓS todos os hooks
    if (!isMoviesView && !isSeriesView && !isAdultView) return null
    if (categories.length === 0) return null

    // Se não tem categoria selecionada mas há categorias disponíveis, usar a primeira temporariamente
    const displayCat = selectedCat || (orderedCats.length > 0 ? orderedCats[0] : null)
    const selectedCatName = displayCat ? (displayCat.category_name || displayCat.name || 'Categoria') : 'Carregando...'

    return e('div', {
      style: {
        position: 'fixed',
        top: '70px',
        right: '40px',
        zIndex: 999
      }
    },
      // Botão "Categorias" com dropdown
      e('div', {
        style: {
          position: 'relative'
        }
      },
        e('button', {
          onClick: () => setShowDropdown(!showDropdown),
          style: {
            padding: '8px 20px',
            background: 'rgba(229, 9, 20, 0.9)',
            color: '#fff',
            border: 'none',
            borderRadius: '4px',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: '600',
            display: 'flex',
            alignItems: 'center',
            gap: '8px',
            transition: 'all 0.3s'
          },
          onMouseEnter: (e) => {
            e.currentTarget.style.background = 'rgba(229, 9, 20, 1)'
          },
          onMouseLeave: (e) => {
            e.currentTarget.style.background = 'rgba(229, 9, 20, 0.9)'
          }
        },
          'Categorias: ',
          e('span', { style: { fontWeight: 'normal' } }, selectedCatName),
          e('span', { style: { marginLeft: '4px' } }, showDropdown ? '▲' : '▼')
        ),

        // Dropdown com todas as categorias
        showDropdown && e('div', {
          style: {
            position: 'absolute',
            top: '100%',
            right: 0,
            marginTop: '8px',
            background: '#1a1a1a',
            borderRadius: '8px',
            boxShadow: '0 8px 24px rgba(0, 0, 0, 0.5)',
            minWidth: '250px',
            maxHeight: '400px',
            overflowY: 'auto',
            zIndex: 1000,
            border: '1px solid rgba(255, 255, 255, 0.1)'
          }
        },
          // Categorias ordenadas (sem opção "Todas")
          ...orderedCats.map(cat => {
            const catId = getCatId(cat)
            const catName = cat.category_name || cat.name || 'Sem nome'
            const isSelected = selectedCat && getCatId(selectedCat) === catId

            return e('div', {
              key: catId,
              onClick: () => {
                setSelectedCat(cat)
                setShowDropdown(false)
              },
              style: {
                padding: '12px 20px',
                color: isSelected ? '#e50914' : '#e0e0e0',
                fontSize: '14px',
                cursor: 'pointer',
                borderBottom: '1px solid rgba(255, 255, 255, 0.05)',
                transition: 'background 0.2s',
                fontWeight: isSelected ? '600' : 'normal'
              },
              onMouseEnter: (e) => {
                e.currentTarget.style.background = 'rgba(255, 255, 255, 0.1)'
              },
              onMouseLeave: (e) => {
                e.currentTarget.style.background = 'transparent'
              }
            }, catName)
          })
        )
      )
    )
  }

  // ===== COMPONENTE: PIN DE CONTROLE PARENTAL =====
  function ParentalPinScreen({ onSuccess, onCancel }) {
    const [parentalPin, setParentalPin] = useLocalStorage('parental_pin', '0000')
    const [inputPin, setInputPin] = useState([])
    const [error, setError] = useState(false)

    const handleNumberClick = (num) => {
      if (inputPin.length < 4) {
        const newPin = [...inputPin, num]
        setInputPin(newPin)

        // Auto-verificar quando completar 4 dígitos
        if (newPin.length === 4) {
          const pinString = newPin.join('')
          if (pinString === parentalPin) {
            onSuccess()
          } else {
            setError(true)
            setTimeout(() => {
              setInputPin([])
              setError(false)
            }, 1000)
          }
        }
      }
    }

    const handleDelete = () => {
      setInputPin(inputPin.slice(0, -1))
      setError(false)
    }

    return e('div', {
      className: 'star-bg',
      style: {
        position: 'fixed',
        top: 0,
        left: 0,
        right: 0,
        bottom: 0,
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        zIndex: 9999,
        background: 'rgba(0, 0, 0, 0.95)'
      }
    },
      // Header
      e('h1', {
        style: {
          fontSize: '32px',
          fontWeight: '700',
          color: '#fff',
          marginBottom: '20px',
          letterSpacing: '2px'
        }
      }, '18+ ADULTOS'),

      // Texto instrução
      e('p', {
        style: {
          fontSize: '18px',
          color: '#b3b3b3',
          marginBottom: '60px'
        }
      }, 'Digite o código pin'),

      // PIN boxes
      e('div', {
        style: {
          display: 'flex',
          gap: '20px',
          marginBottom: '60px'
        }
      },
        [0, 1, 2, 3].map(i =>
          e('div', {
            key: i,
            style: {
              width: '80px',
              height: '80px',
              borderRadius: '12px',
              border: error ? '3px solid #dc2626' : (inputPin[i] !== undefined ? '3px solid #22c55e' : '3px solid rgba(255, 255, 255, 0.3)'),
              background: inputPin[i] !== undefined ? 'rgba(34, 197, 94, 0.1)' : 'rgba(0, 0, 0, 0.5)',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              transition: 'all 0.3s',
              fontSize: '32px',
              color: '#fff',
              fontWeight: '700'
            }
          }, inputPin[i] !== undefined ? '●' : '')
        )
      ),

      // Teclado numérico
      e('div', {
        style: {
          display: 'flex',
          gap: '15px',
          marginBottom: '40px'
        }
      },
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9].map(num =>
          e('button', {
            key: num,
            onClick: () => handleNumberClick(num.toString()),
            style: {
              width: '70px',
              height: '70px',
              borderRadius: '8px',
              background: 'rgba(255, 255, 255, 0.1)',
              border: '2px solid rgba(255, 255, 255, 0.2)',
              color: '#fff',
              fontSize: '24px',
              fontWeight: '700',
              cursor: 'pointer',
              transition: 'all 0.2s'
            },
            onMouseEnter: (e) => {
              e.currentTarget.style.background = 'rgba(255, 255, 255, 0.2)'
              e.currentTarget.style.transform = 'scale(1.05)'
            },
            onMouseLeave: (e) => {
              e.currentTarget.style.background = 'rgba(255, 255, 255, 0.1)'
              e.currentTarget.style.transform = 'scale(1)'
            }
          }, num)
        ).concat(
          e('button', {
            key: 'delete',
            onClick: handleDelete,
            style: {
              width: '70px',
              height: '70px',
              borderRadius: '8px',
              background: 'rgba(220, 38, 38, 0.2)',
              border: '2px solid rgba(220, 38, 38, 0.5)',
              color: '#fff',
              fontSize: '24px',
              fontWeight: '700',
              cursor: 'pointer',
              transition: 'all 0.2s',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center'
            },
            onMouseEnter: (e) => {
              e.currentTarget.style.background = 'rgba(220, 38, 38, 0.3)'
              e.currentTarget.style.transform = 'scale(1.05)'
            },
            onMouseLeave: (e) => {
              e.currentTarget.style.background = 'rgba(220, 38, 38, 0.2)'
              e.currentTarget.style.transform = 'scale(1)'
            }
          }, '⌫')
        )
      ),

      // Código padrão
      e('p', {
        style: {
          fontSize: '14px',
          color: '#666',
          marginBottom: '20px'
        }
      }, 'Código pin padrão: 0000'),

      // Botão voltar
      onCancel && e('button', {
        onClick: onCancel,
        style: {
          padding: '12px 30px',
          background: 'transparent',
          border: '2px solid rgba(255, 255, 255, 0.3)',
          borderRadius: '6px',
          color: '#fff',
          fontSize: '14px',
          cursor: 'pointer',
          transition: 'all 0.2s'
        },
        onMouseEnter: (e) => {
          e.currentTarget.style.background = 'rgba(255, 255, 255, 0.1)'
        },
        onMouseLeave: (e) => {
          e.currentTarget.style.background = 'transparent'
        }
      }, 'Voltar')
    )
  }

  // ===== COMPONENTE: SETTINGS (CONFIGURAÇÕES) =====
  function Settings({ account, setView }) {
    const [useTMDB, setUseTMDB] = useLocalStorage('use_tmdb', true)
    const [selectedPlayer, setSelectedPlayer] = useLocalStorage('selected_player', 'Clappr Player (Recommended)')
    const [selectedSystem, setSelectedSystem] = useLocalStorage('selected_system', 'TS')
    const [parentalPin, setParentalPin] = useLocalStorage('parental_pin', '0000')
    const [showPlayerOptions, setShowPlayerOptions] = useState(false)
    const [showSystemOptions, setShowSystemOptions] = useState(false)
    const [showPinChange, setShowPinChange] = useState(false)
    const [newPin, setNewPin] = useState('')

    // Players disponíveis
    const players = [
      'Clappr Player (Recommended)',
      'Video.js Player',
      'JW Player',
      'Flow Player',
      'HLS.js (Sistema)'
    ]
    const systems = ['M3U8', 'TS']

    // Função para formatar timestamp Unix para data/hora
    const formatDateTime = (timestamp) => {
      if (!timestamp) return 'N/A'
      const date = new Date(timestamp * 1000)
      const day = String(date.getDate()).padStart(2, '0')
      const month = String(date.getMonth() + 1).padStart(2, '0')
      const year = date.getFullYear()
      const hours = String(date.getHours()).padStart(2, '0')
      const minutes = String(date.getMinutes()).padStart(2, '0')
      const seconds = String(date.getSeconds()).padStart(2, '0')
      return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`
    }

    // Calcular dias restantes
    const calculateDaysRemaining = (expTimestamp) => {
      if (!expTimestamp) return 'N/A'
      const now = Date.now()
      const expDate = expTimestamp * 1000
      const diff = expDate - now
      const days = Math.floor(diff / (1000 * 60 * 60 * 24))
      return days > 0 ? `${days} days` : 'Expirado'
    }

    return e('div', {
      className: 'star-bg',
      style: {
        minHeight: '100vh',
        padding: '80px 40px 40px 40px',
        color: '#fff'
      }
    },
      e('div', {
        style: {
          maxWidth: '1400px',
          margin: '0 auto'
        }
      },
        // Título
        e('h1', {
          style: {
            fontSize: '36px',
            fontWeight: '600',
            marginBottom: '40px',
            color: '#fff'
          }
        }, 'Configurações'),

        e('div', {
          style: {
            display: 'grid',
            gridTemplateColumns: '1fr 1fr',
            gap: '40px'
          }
        },
          // Coluna esquerda - Botões
          e('div', {
            style: {
              display: 'flex',
              flexDirection: 'column',
              gap: '12px'
            }
          },
            // Botão: Dados da conta
            e('button', {
              style: {
                padding: '18px 24px',
                background: 'rgba(60, 60, 60, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(80, 80, 80, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              }
            }, 'Dados da conta'),

            // Botão: Informações do aplicativo
            e('button', {
              style: {
                padding: '18px 24px',
                background: 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Informações do aplicativo'),

            // Botão: Alterar Código Pin
            e('button', {
              onClick: () => {
                setShowPinChange(!showPinChange)
                setShowPlayerOptions(false)
                setShowSystemOptions(false)
                setNewPin('')
              },
              style: {
                padding: '18px 24px',
                background: showPinChange ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = showPinChange ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Alterar Código Pin'),

            // Botão: Alterar Player
            e('button', {
              onClick: () => {
                setShowPlayerOptions(!showPlayerOptions)
                setShowSystemOptions(false)
              },
              style: {
                padding: '18px 24px',
                background: showPlayerOptions ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = showPlayerOptions ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Alterar Player'),

            // Botão: Alterar Sistema
            e('button', {
              onClick: () => {
                setShowSystemOptions(!showSystemOptions)
                setShowPlayerOptions(false)
              },
              style: {
                padding: '18px 24px',
                background: showSystemOptions ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = showSystemOptions ? 'rgba(60, 60, 60, 0.8)' : 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Alterar Sistema'),

            // Botão: Recarregar o Sistema
            e('button', {
              onClick: () => window.location.reload(),
              style: {
                padding: '18px 24px',
                background: 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Recarregar o Sistema'),

            // Botão: Limpar Armazenamento
            e('button', {
              onClick: () => {
                if (confirm('Deseja limpar todo o armazenamento local? Isso vai fazer logout.')) {
                  localStorage.clear()
                  window.location.reload()
                }
              },
              style: {
                padding: '18px 24px',
                background: 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                textAlign: 'left',
                cursor: 'pointer',
                transition: 'all 0.2s'
              },
              onMouseEnter: (ev) => {
                ev.target.style.background = 'rgba(60, 60, 60, 0.8)'
              },
              onMouseLeave: (ev) => {
                ev.target.style.background = 'rgba(40, 40, 40, 0.8)'
              }
            }, 'Limpar Armazenamento'),

            // Toggle: Usar API TMDB
            e('div', {
              style: {
                padding: '18px 24px',
                background: 'rgba(40, 40, 40, 0.8)',
                border: 'none',
                borderRadius: '8px',
                color: '#fff',
                fontSize: '16px',
                display: 'flex',
                justifyContent: 'space-between',
                alignItems: 'center'
              }
            },
              e('span', null, 'Usar API TMDB'),
              e('label', {
                style: {
                  position: 'relative',
                  display: 'inline-block',
                  width: '50px',
                  height: '24px',
                  cursor: 'pointer'
                }
              },
                e('input', {
                  type: 'checkbox',
                  checked: useTMDB,
                  onChange: (ev) => setUseTMDB(ev.target.checked),
                  style: { display: 'none' }
                }),
                e('span', {
                  style: {
                    position: 'absolute',
                    cursor: 'pointer',
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    backgroundColor: useTMDB ? '#4CAF50' : '#ccc',
                    borderRadius: '24px',
                    transition: '0.4s'
                  }
                },
                  e('span', {
                    style: {
                      position: 'absolute',
                      content: '""',
                      height: '18px',
                      width: '18px',
                      left: useTMDB ? '28px' : '3px',
                      bottom: '3px',
                      backgroundColor: 'white',
                      borderRadius: '50%',
                      transition: '0.4s'
                    }
                  })
                )
              )
            )
          ),

          // Coluna direita - Opções de Player/Sistema ou Informações da conta
          e('div', {
            style: {
              background: 'rgba(40, 40, 40, 0.6)',
              borderRadius: '12px',
              padding: '30px',
              display: 'flex',
              flexDirection: 'column',
              gap: '12px'
            }
          },
            // Mostrar opções de Player se estiver ativo
            showPlayerOptions ? players.map(player =>
              e('button', {
                key: player,
                onClick: () => {
                  setSelectedPlayer(player)
                  setShowPlayerOptions(false)
                },
                style: {
                  padding: '18px 24px',
                  background: 'rgba(50, 50, 50, 0.8)',
                  border: selectedPlayer === player ? '2px solid #fff' : 'none',
                  borderRadius: '12px',
                  color: '#fff',
                  fontSize: '16px',
                  cursor: 'pointer',
                  transition: 'all 0.2s',
                  display: 'flex',
                  justifyContent: 'space-between',
                  alignItems: 'center'
                },
                onMouseEnter: (ev) => {
                  if (selectedPlayer !== player) {
                    ev.target.style.background = 'rgba(70, 70, 70, 0.8)'
                  }
                },
                onMouseLeave: (ev) => {
                  ev.target.style.background = 'rgba(50, 50, 50, 0.8)'
                }
              },
                e('span', null, player),
                selectedPlayer === player && e('span', { style: { fontSize: '20px' } }, '✓')
              )
            )
            // Mostrar opções de Sistema se estiver ativo
            : showSystemOptions ? systems.map(system =>
              e('button', {
                key: system,
                onClick: () => {
                  setSelectedSystem(system)
                  setShowSystemOptions(false)
                },
                style: {
                  padding: '18px 24px',
                  background: 'rgba(50, 50, 50, 0.8)',
                  border: selectedSystem === system ? '2px solid #fff' : 'none',
                  borderRadius: '12px',
                  color: '#fff',
                  fontSize: '16px',
                  cursor: 'pointer',
                  transition: 'all 0.2s',
                  display: 'flex',
                  justifyContent: 'space-between',
                  alignItems: 'center'
                },
                onMouseEnter: (ev) => {
                  if (selectedSystem !== system) {
                    ev.target.style.background = 'rgba(70, 70, 70, 0.8)'
                  }
                },
                onMouseLeave: (ev) => {
                  ev.target.style.background = 'rgba(50, 50, 50, 0.8)'
                }
              },
                e('span', null, system),
                selectedSystem === system && e('span', { style: { fontSize: '20px' } }, '✓')
              )
            )
            // Mostrar painel de alteração de PIN se estiver ativo
            : showPinChange ? [
              e('div', {
                style: {
                  padding: '20px',
                  background: 'rgba(50, 50, 50, 0.8)',
                  borderRadius: '12px',
                  marginBottom: '15px'
                }
              },
                e('h3', {
                  style: {
                    color: '#fff',
                    fontSize: '18px',
                    marginBottom: '15px',
                    fontWeight: '600'
                  }
                }, 'Alterar Código PIN'),
                e('p', {
                  style: {
                    color: '#b3b3b3',
                    fontSize: '14px',
                    marginBottom: '20px'
                  }
                }, 'Digite um novo código PIN de 4 dígitos'),
                e('input', {
                  type: 'password',
                  maxLength: 4,
                  value: newPin,
                  onChange: (ev) => {
                    const value = ev.target.value.replace(/\D/g, '')
                    setNewPin(value)
                  },
                  placeholder: 'Novo PIN (4 dígitos)',
                  style: {
                    width: '100%',
                    padding: '15px',
                    background: 'rgba(0, 0, 0, 0.5)',
                    border: '2px solid rgba(255, 255, 255, 0.2)',
                    borderRadius: '8px',
                    color: '#fff',
                    fontSize: '16px',
                    marginBottom: '15px',
                    outline: 'none'
                  }
                }),
                e('div', {
                  style: {
                    display: 'flex',
                    gap: '10px'
                  }
                },
                  e('button', {
                    onClick: () => {
                      if (newPin.length === 4) {
                        setParentalPin(newPin)
                        alert('PIN alterado com sucesso!')
                        setShowPinChange(false)
                        setNewPin('')
                      } else {
                        alert('O PIN deve ter exatamente 4 dígitos!')
                      }
                    },
                    style: {
                      flex: 1,
                      padding: '12px',
                      background: '#22c55e',
                      border: 'none',
                      borderRadius: '8px',
                      color: '#fff',
                      fontSize: '14px',
                      fontWeight: '600',
                      cursor: 'pointer',
                      transition: 'all 0.2s'
                    },
                    onMouseEnter: (ev) => {
                      ev.target.style.background = '#16a34a'
                    },
                    onMouseLeave: (ev) => {
                      ev.target.style.background = '#22c55e'
                    }
                  }, 'Salvar'),
                  e('button', {
                    onClick: () => {
                      setShowPinChange(false)
                      setNewPin('')
                    },
                    style: {
                      flex: 1,
                      padding: '12px',
                      background: 'rgba(255, 255, 255, 0.1)',
                      border: '2px solid rgba(255, 255, 255, 0.3)',
                      borderRadius: '8px',
                      color: '#fff',
                      fontSize: '14px',
                      fontWeight: '600',
                      cursor: 'pointer',
                      transition: 'all 0.2s'
                    },
                    onMouseEnter: (ev) => {
                      ev.target.style.background = 'rgba(255, 255, 255, 0.2)'
                    },
                    onMouseLeave: (ev) => {
                      ev.target.style.background = 'rgba(255, 255, 255, 0.1)'
                    }
                  }, 'Cancelar')
                )
              ),
              e('div', {
                style: {
                  padding: '15px',
                  background: 'rgba(59, 130, 246, 0.1)',
                  border: '1px solid rgba(59, 130, 246, 0.3)',
                  borderRadius: '8px',
                  color: '#93c5fd',
                  fontSize: '13px',
                  lineHeight: '1.5'
                }
              }, '⚠️ Importante: Este PIN é usado para controle parental na categoria 18+. Guarde-o em local seguro.')
            ]
            // Caso contrário, mostrar informações da conta
            : [
            // Status
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between',
                paddingBottom: '15px',
                borderBottom: '1px solid rgba(255,255,255,0.1)'
              }
            },
              e('span', { style: { color: '#aaa', fontSize: '16px' } }, 'Status'),
              e('span', { style: { color: '#4CAF50', fontSize: '16px', fontWeight: '600' } }, 'Active')
            ),

            // Nome de usuário
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between',
                paddingBottom: '15px',
                borderBottom: '1px solid rgba(255,255,255,0.1)'
              }
            },
              e('span', { style: { color: '#aaa', fontSize: '16px' } }, 'Nome de usuário'),
              e('span', { style: { color: '#fff', fontSize: '16px', fontWeight: '600' } }, account?.username || 'N/A')
            ),

            // Data de registro
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between',
                paddingBottom: '15px',
                borderBottom: '1px solid rgba(255,255,255,0.1)'
              }
            },
              e('span', { style: { color: '#aaa', fontSize: '16px' } }, 'Data de registro'),
              e('span', { style: { color: '#fff', fontSize: '16px' } }, formatDateTime(account?.created_at))
            ),

            // Data de expiração
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between',
                paddingBottom: '15px',
                borderBottom: '1px solid rgba(255,255,255,0.1)'
              }
            },
              e('span', { style: { color: '#aaa', fontSize: '16px' } }, 'Data de expiração'),
              e('span', { style: { color: '#fff', fontSize: '16px' } }, formatDateTime(account?.exp_date))
            ),

            // Dias restantes
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between'
              }
            },
              e('span', { style: { color: '#aaa', fontSize: '16px' } }, 'Dias restantes'),
              e('span', { style: { color: '#fff', fontSize: '16px', fontWeight: '600' } }, calculateDaysRemaining(account?.exp_date))
            )
          ]
          )
        ),

        // Footer com versão
        e('div', {
          style: {
            position: 'fixed',
            bottom: '20px',
            left: '40px',
            color: '#aaa',
            fontSize: '14px',
            display: 'flex',
            gap: '20px'
          }
        },
          e('span', null, 'IPTV'),
          e('span', null, 'Versão: 1.6.0')
        )
      )
    )
  }

  // ===== HEADER GLOBAL NETFLIX-STYLE =====
  function Header({ view, setView, globalSearchQuery, setGlobalSearchQuery, onLogout, account, setShowParentalPin, setPendingAdultView }) {
    const [showProfileMenu, setShowProfileMenu] = useState(false)
    const [showAvatarSelector, setShowAvatarSelector] = useState(false)
    const [selectedAvatar, setSelectedAvatar] = useLocalStorage('user_avatar', null)

    // Lista de avatares de personagens - usar imagens locais
    const avatars = [
      // Animes
      { id: 'naruto', name: 'Naruto', url: 'avatars/naruto.png', emoji: '🍥', gradient: 'linear-gradient(135deg, #f39c12, #e67e22)' },
      { id: 'luffy', name: 'Luffy', url: 'avatars/luffy.png', emoji: '👒', gradient: 'linear-gradient(135deg, #e74c3c, #c0392b)' },
      { id: 'goku', name: 'Goku', url: 'avatars/goku.png', emoji: '🐉', gradient: 'linear-gradient(135deg, #f39c12, #d35400)' },
      { id: 'deku', name: 'Deku', url: 'avatars/deku.png', emoji: '💚', gradient: 'linear-gradient(135deg, #2ecc71, #27ae60)' },
      { id: 'tanjiro', name: 'Tanjiro', url: 'avatars/tanjiro.png', emoji: '🗡️', gradient: 'linear-gradient(135deg, #16a085, #1abc9c)' },
      { id: 'eren', name: 'Eren', url: 'avatars/eren.png', emoji: '⚔️', gradient: 'linear-gradient(135deg, #8e44ad, #9b59b6)' },
      { id: 'saitama', name: 'Saitama', url: 'avatars/saitama.png', emoji: '👊', gradient: 'linear-gradient(135deg, #f1c40f, #f39c12)' },
      { id: 'itachi', name: 'Itachi', url: 'avatars/itachi.png', emoji: '🔴', gradient: 'linear-gradient(135deg, #c0392b, #e74c3c)' },
      { id: 'levi', name: 'Levi', url: 'avatars/levi.png', emoji: '⚡', gradient: 'linear-gradient(135deg, #34495e, #2c3e50)' },
      { id: 'vegeta', name: 'Vegeta', url: 'avatars/vegeta.png', emoji: '👑', gradient: 'linear-gradient(135deg, #2980b9, #3498db)' },
      // Heróis
      { id: 'ironman', name: 'Iron Man', url: 'avatars/ironman.png', emoji: '🤖', gradient: 'linear-gradient(135deg, #e74c3c, #f39c12)' },
      { id: 'batman', name: 'Batman', url: 'avatars/batman.png', emoji: '🦇', gradient: 'linear-gradient(135deg, #2c3e50, #34495e)' },
      { id: 'joker', name: 'Joker', url: 'avatars/joker.png', emoji: '🃏', gradient: 'linear-gradient(135deg, #9b59b6, #8e44ad)' },
      { id: 'spiderman', name: 'Spider-Man', url: 'avatars/spiderman.png', emoji: '🕷️', gradient: 'linear-gradient(135deg, #e74c3c, #c0392b)' },
      { id: 'thanos', name: 'Thanos', url: 'avatars/thanos.png', emoji: '💎', gradient: 'linear-gradient(135deg, #9b59b6, #8e44ad)' },
      { id: 'deadpool', name: 'Deadpool', url: 'avatars/deadpool.png', emoji: '⚔️', gradient: 'linear-gradient(135deg, #c0392b, #e74c3c)' }
    ]

    // Função para formatar data de vencimento
    const formatExpDate = (timestamp) => {
      if (!timestamp) return 'Sem data'
      const date = new Date(timestamp * 1000)
      return date.toLocaleDateString('pt-BR')
    }

    // Função para selecionar avatar
    const handleAvatarSelect = (avatar) => {
      setSelectedAvatar(avatar)
      setShowAvatarSelector(false)
      setShowProfileMenu(false)
    }

    // Determinar qual menu está ativo
    const getActiveMenu = () => {
      if (view === 'home') return 'home'
      if (view === 'live-categories' || view === 'channels') return 'channels'
      if (view === 'adult-content' || view === 'adult-categories') return 'adult'
      if (view === 'netflix-movies' || view === 'vod-categories') return 'movies'
      if (view === 'netflix-series' || view === 'series-categories') return 'series'
      if (view === 'netflix-novelas' || view === 'novelas-categories') return 'novelas'
      if (view === 'netflix-animes' || view === 'animes-categories') return 'animes'
      if (view === 'netflix-desenhos' || view === 'desenhos-categories') return 'desenhos'
      if (view === 'netflix-show' || view === 'show-categories') return 'show'
      if (view === 'collections') return 'collections'
      return 'home'
    }

    const activeMenu = getActiveMenu()

    return e('header', {
      style: {
        position: 'fixed',
        top: 0,
        left: 0,
        right: 0,
        height: '60px',
        background: '#141414',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        padding: '0 40px',
        zIndex: 1000,
        borderBottom: '1px solid rgba(255, 255, 255, 0.1)'
      }
    },
      // Logo DREAMTV
      e('div', {
        onClick: () => setView('home'),
        style: {
          fontSize: '24px',
          fontWeight: 'bold',
          cursor: 'pointer',
          letterSpacing: '2px',
          display: 'flex'
        }
      },
        e('span', { style: { color: '#e50914' } }, 'DREAM'),
        e('span', { style: { color: '#fff' } }, 'TV')
      ),

      // Menu de navegação
      e('nav', {
        style: {
          display: 'flex',
          gap: '30px',
          alignItems: 'center'
        }
      },
        e('a', {
          onClick: () => setView('home'),
          style: {
            color: activeMenu === 'home' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'home' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Início'),

        e('a', {
          onClick: () => setView('live-categories'),
          style: {
            color: activeMenu === 'channels' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'channels' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'TV Ao Vivo'),

        e('a', {
          onClick: () => setView('netflix-movies'),
          style: {
            color: activeMenu === 'movies' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'movies' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Filmes'),

        e('a', {
          onClick: () => setView('netflix-series'),
          style: {
            color: activeMenu === 'series' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'series' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Séries'),

        e('a', {
          onClick: () => setView('netflix-novelas'),
          style: {
            color: activeMenu === 'novelas' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'novelas' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Novelas'),

        e('a', {
          onClick: () => setView('netflix-animes'),
          style: {
            color: activeMenu === 'animes' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'animes' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Animes'),

        e('a', {
          onClick: () => setView('netflix-desenhos'),
          style: {
            color: activeMenu === 'desenhos' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'desenhos' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Desenhos'),

        e('a', {
          onClick: () => setView('netflix-show'),
          style: {
            color: activeMenu === 'show' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'show' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Show'),

        e('a', {
          onClick: () => {
            setView('collections')
            if (window.updateNetflixMoviesState) {
              window.updateNetflixMoviesState({ showCollectionsView: true })
            }
          },
          style: {
            color: activeMenu === 'collections' ? '#fff' : '#b3b3b3',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: activeMenu === 'collections' ? '600' : '400',
            transition: 'color 0.2s',
            textDecoration: 'none'
          }
        }, 'Coletâneas'),

        e('a', {
          onClick: () => {
            setPendingAdultView(true)
            setShowParentalPin(true)
          },
          style: {
            cursor: 'pointer',
            textDecoration: 'none',
            display: 'inline-flex',
            alignItems: 'center',
            transition: 'transform 0.2s'
          },
          onMouseEnter: (e) => {
            e.currentTarget.style.transform = 'scale(1.05)'
          },
          onMouseLeave: (e) => {
            e.currentTarget.style.transform = 'scale(1)'
          }
        },
          e('span', {
            style: {
              background: activeMenu === 'adult' ? '#dc2626' : '#7f1d1d',
              color: '#fff',
              padding: '4px 8px',
              borderRadius: '4px',
              fontSize: '12px',
              fontWeight: '700',
              border: activeMenu === 'adult' ? '2px solid #fff' : '2px solid #dc2626',
              letterSpacing: '0.5px'
            }
          }, '18+')
        )
      ),

      // Área direita - Campo de busca e configurações
      e('div', {
        style: {
          display: 'flex',
          alignItems: 'center',
          gap: '15px'
        }
      },
        // Campo de busca
        e('input', {
          type: 'text',
          placeholder: 'Buscar...',
          value: globalSearchQuery || '',
          onChange: (e) => setGlobalSearchQuery(e.target.value),
          style: {
            background: 'transparent',
            border: '1px solid rgba(255, 255, 255, 0.3)',
            borderRadius: '4px',
            padding: '8px 16px',
            color: '#fff',
            fontSize: '14px',
            outline: 'none',
            width: '200px',
            transition: 'border-color 0.2s'
          },
          onFocus: (e) => {
            e.target.style.borderColor = 'rgba(255, 255, 255, 0.6)'
          },
          onBlur: (e) => {
            e.target.style.borderColor = 'rgba(255, 255, 255, 0.3)'
          }
        }),

        // Avatar/Profile com menu dropdown
        e('div', {
          style: {
            position: 'relative'
          }
        },
          // Avatar clicável
          e('div', {
            onClick: () => setShowProfileMenu(!showProfileMenu),
            style: {
              width: '40px',
              height: '40px',
              borderRadius: '50%',
              background: selectedAvatar ? `url(${selectedAvatar.url}) center/cover, ${selectedAvatar.gradient}` : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
              cursor: 'pointer',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              fontSize: '18px',
              fontWeight: 'bold',
              color: '#fff',
              transition: 'transform 0.2s',
              border: '2px solid rgba(255, 255, 255, 0.3)',
              overflow: 'hidden'
            },
            onMouseEnter: (e) => {
              e.currentTarget.style.transform = 'scale(1.05)'
            },
            onMouseLeave: (e) => {
              e.currentTarget.style.transform = 'scale(1)'
            }
          }, !selectedAvatar && (account?.username || 'H').charAt(0).toUpperCase()),

          // Menu dropdown
          showProfileMenu && e('div', {
            style: {
              position: 'absolute',
              top: '60px',
              right: '0',
              width: '280px',
              background: '#1a1a1a',
              borderRadius: '8px',
              boxShadow: '0 8px 24px rgba(0, 0, 0, 0.5)',
              overflow: 'hidden',
              zIndex: 2000
            }
          },
            // Header do menu com perfil
            e('div', {
              style: {
                padding: '20px',
                borderBottom: '1px solid rgba(255, 255, 255, 0.1)',
                display: 'flex',
                alignItems: 'center',
                gap: '12px'
              }
            },
              // Avatar no menu
              e('div', {
                style: {
                  width: '48px',
                  height: '48px',
                  borderRadius: '50%',
                  background: selectedAvatar ? `url(${selectedAvatar.url}) center/cover, ${selectedAvatar.gradient}` : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  fontSize: '20px',
                  fontWeight: 'bold',
                  color: '#fff',
                  overflow: 'hidden'
                }
              }, !selectedAvatar && (account?.username || 'H').charAt(0).toUpperCase()),
              // Info do usuário
              e('div', {
                style: {
                  flex: 1
                }
              },
                e('div', {
                  style: {
                    color: '#fff',
                    fontSize: '16px',
                    fontWeight: '600',
                    marginBottom: '4px'
                  }
                }, account?.username || 'Usuário'),
                e('div', {
                  style: {
                    color: '#f47521',
                    fontSize: '12px',
                    fontWeight: '600',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '4px'
                  }
                },
                  e('span', { style: { fontSize: '14px' } }, '📅'),
                  'Vence: ' + formatExpDate(account?.exp_date)
                )
              ),
              // Ícone de editar
              e('div', {
                onClick: () => {
                  setShowProfileMenu(false)
                  setShowAvatarSelector(true)
                },
                style: {
                  color: '#b3b3b3',
                  fontSize: '18px',
                  cursor: 'pointer',
                  transition: 'color 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.color = '#fff'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.color = '#b3b3b3'
                }
              }, '✏️')
            ),

            // Opções do menu
            e('div', {
              style: {
                padding: '8px 0'
              }
            },
              // Trocar de Perfil
              e('div', {
                onClick: () => {
                  alert('Funcionalidade em breve!')
                  setShowProfileMenu(false)
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '🔄'),
                'Trocar de Perfil'
              ),

              // Configurações
              e('div', {
                onClick: () => {
                  setView('settings')
                  setShowProfileMenu(false)
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '⚙️'),
                'Configurações'
              ),

              // Separador
              e('div', {
                style: {
                  height: '1px',
                  background: 'rgba(255, 255, 255, 0.1)',
                  margin: '8px 0'
                }
              }),

              // Fila
              e('div', {
                onClick: () => {
                  alert('Funcionalidade em breve!')
                  setShowProfileMenu(false)
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '🔖'),
                'Fila'
              ),

              // Histórico
              e('div', {
                onClick: () => {
                  alert('Funcionalidade em breve!')
                  setShowProfileMenu(false)
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '🕐'),
                'Histórico'
              ),

              // Separador
              e('div', {
                style: {
                  height: '1px',
                  background: 'rgba(255, 255, 255, 0.1)',
                  margin: '8px 0'
                }
              }),

              // Notificações
              e('div', {
                onClick: () => {
                  alert('Funcionalidade em breve!')
                  setShowProfileMenu(false)
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '🔔'),
                'Notificações'
              ),

              // Separador
              e('div', {
                style: {
                  height: '1px',
                  background: 'rgba(255, 255, 255, 0.1)',
                  margin: '8px 0'
                }
              }),

              // Sair
              e('div', {
                onClick: () => {
                  if (confirm('Deseja realmente sair?')) {
                    setShowProfileMenu(false)
                    onLogout()
                  }
                },
                style: {
                  padding: '14px 20px',
                  color: '#e0e0e0',
                  fontSize: '14px',
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '12px',
                  transition: 'background 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = 'rgba(255, 255, 255, 0.05)'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = 'transparent'
                }
              },
                e('span', { style: { fontSize: '18px' } }, '🚪'),
                'Sair'
              )
            )
          )
        ),

        // Modal de seleção de avatares
        showAvatarSelector && e('div', {
          onClick: () => setShowAvatarSelector(false),
          style: {
            position: 'fixed',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: 'rgba(0, 0, 0, 0.85)',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            zIndex: 3000,
            padding: '20px'
          }
        },
          e('div', {
            onClick: (e) => e.stopPropagation(),
            style: {
              background: '#1a1a1a',
              borderRadius: '12px',
              padding: '30px',
              maxWidth: '800px',
              width: '100%',
              maxHeight: '80vh',
              overflowY: 'auto'
            }
          },
            // Título
            e('div', {
              style: {
                display: 'flex',
                justifyContent: 'space-between',
                alignItems: 'center',
                marginBottom: '30px'
              }
            },
              e('h2', {
                style: {
                  color: '#fff',
                  fontSize: '24px',
                  fontWeight: 'bold',
                  margin: 0
                }
              }, 'Escolha seu Avatar'),
              e('button', {
                onClick: () => setShowAvatarSelector(false),
                style: {
                  background: 'transparent',
                  border: 'none',
                  color: '#b3b3b3',
                  fontSize: '28px',
                  cursor: 'pointer',
                  padding: '0',
                  lineHeight: '1'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.color = '#fff'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.color = '#b3b3b3'
                }
              }, '×')
            ),

            // Grid de avatares
            e('div', {
              style: {
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fill, minmax(120px, 1fr))',
                gap: '20px'
              }
            },
              ...avatars.map(avatar =>
                e('div', {
                  key: avatar.id,
                  onClick: () => handleAvatarSelect(avatar),
                  style: {
                    cursor: 'pointer',
                    textAlign: 'center',
                    transition: 'transform 0.2s'
                  },
                  onMouseEnter: (e) => {
                    e.currentTarget.style.transform = 'scale(1.05)'
                  },
                  onMouseLeave: (e) => {
                    e.currentTarget.style.transform = 'scale(1)'
                  }
                },
                  e('div', {
                    style: {
                      width: '120px',
                      height: '120px',
                      borderRadius: '50%',
                      background: `url(${avatar.url}) center/cover, ${avatar.gradient}`,
                      border: selectedAvatar?.id === avatar.id ? '3px solid #e50914' : '3px solid rgba(255, 255, 255, 0.2)',
                      marginBottom: '10px',
                      overflow: 'hidden'
                    }
                  })
                )
              )
            )
          )
        )
      )
    )
  }

  // ===== SIDEBAR COMPONENT (DEPRECATED - Mantido para compatibilidade) =====
  function Sidebar({ view, setView }) {
    const [activeMenu, setActiveMenu] = useState('home')
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false)

    // Atualizar ícone ativo baseado na view atual
    useEffect(() => {
      if (view === 'home') setActiveMenu('home')
      else if (view === 'channels' || view === 'live-categories') setActiveMenu('channels')
      else if (view === 'netflix-movies' || view === 'vod-categories') setActiveMenu('movies')
      else if (view === 'series-categories' || view === 'netflix-series') setActiveMenu('series')
      else if (view === 'novelas-categories' || view === 'netflix-novelas') setActiveMenu('novelas')
      else if (view === 'animes-categories' || view === 'netflix-animes') setActiveMenu('animes')
      else if (view === 'desenhos-categories' || view === 'netflix-desenhos') setActiveMenu('desenhos')
      else if (view === 'show-categories' || view === 'netflix-show') setActiveMenu('show')
      else if (view === 'collections') setActiveMenu('collections')
      else if (view === 'config') setActiveMenu('config')
    }, [view])

    // Usando emoji para ícones (sem dependência de bibliotecas externas)

    const menuItems = [
      { id: 'home', icon: '🏠', title: 'Home', action: () => setView('home') },
      { id: 'channels', icon: '📺', title: 'TV Ao Vivo', action: () => setView('live-categories') },
      { id: 'movies', icon: '🎬', title: 'Filmes', action: () => {
        // Desativar modo coleções ao voltar para filmes
        if (window.updateNetflixMoviesState) {
          // Pegar o primeiro filme da categoria atual
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null, // Limpar backdrop de coleções
            viewingCollectionMovies: false, // Sair do modo de visualização de coleção
            currentCategoryIndex: 0, // Voltar para primeira categoria
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId // Setar primeiro filme
          })
        }
        setView('netflix-movies')
      }},
      { id: 'series', icon: '🎭', title: 'Séries', action: () => {
        // Desativar modo coleções
        if (window.updateNetflixMoviesState) {
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.series_id || firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null,
            viewingCollectionMovies: false,
            currentCategoryIndex: 0,
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId
          })
        }
        setView('netflix-series')
      }},
      { id: 'novelas', icon: '📖', title: 'Novelas', action: () => {
        // Desativar modo coleções
        if (window.updateNetflixMoviesState) {
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.series_id || firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null,
            viewingCollectionMovies: false,
            currentCategoryIndex: 0,
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId
          })
        }
        setView('netflix-novelas')
      }},
      { id: 'animes', icon: '🌟', title: 'Animes', action: () => {
        // Desativar modo coleções
        if (window.updateNetflixMoviesState) {
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null,
            viewingCollectionMovies: false,
            currentCategoryIndex: 0,
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId
          })
        }
        setView('netflix-animes')
      }},
      { id: 'desenhos', icon: '🎨', title: 'Desenhos', action: () => {
        // Desativar modo coleções
        if (window.updateNetflixMoviesState) {
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null,
            viewingCollectionMovies: false,
            currentCategoryIndex: 0,
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId
          })
        }
        setView('netflix-desenhos')
      }},
      { id: 'collections', icon: '📚', title: 'Coletâneas', action: () => {
        // ===== NÃO RESETAR: Precisamos dos filmes já carregados para construir coleções =====
        // Apenas ativar o modo de coleções (o useEffect vai carregar automaticamente)
        setView('collections')
        if (window.updateNetflixMoviesState) {
          window.updateNetflixMoviesState({ showCollectionsView: true })
        }
      }},
      { id: 'show', icon: '🎤', title: 'Show', action: () => {
        // Desativar modo coleções
        if (window.updateNetflixMoviesState) {
          const firstSection = window.__netflixMoviesState?.sectionsMovies?.[0]
          const firstMovie = firstSection?.movies?.[0]
          const firstMovieId = firstMovie?.stream_id || firstMovie?.id

          window.updateNetflixMoviesState({
            showCollectionsView: false,
            heroBackdrop: null,
            viewingCollectionMovies: false,
            currentCategoryIndex: 0,
            featuredMovieId: firstMovieId || window.__netflixMoviesState?.featuredMovieId
          })
        }
        setView('netflix-show')
      }}
    ]

    return e('aside', {
      className: `sidebar ${mobileMenuOpen ? 'mobile-open' : ''}`,
      onClick: (e) => {
        // Fechar menu quando clicar em um item (apenas em mobile)
        if (window.innerWidth <= 640) {
          setMobileMenuOpen(false)
        }
      }
    },
      ...menuItems.map(item =>
        e('button', {
          key: item.id,
          className: `sidebar-btn ${activeMenu === item.id ? 'active' : ''}`,
          'data-tooltip': item.title,
          onClick: item.action
        }, e('span', { style: { fontSize: '24px' } }, item.icon))
      ),

      // Configurações no final
      e('button', {
        className: `sidebar-btn ${activeMenu === 'config' ? 'active' : ''}`,
        'data-tooltip': 'Configurações',
        onClick: () => setView('config'),
        style: { marginTop: 'auto' }
      }, e('span', { style: { fontSize: '24px' } }, '⚙️'))
    )
  }

  // ===== BOTÃO HAMBURGER PARA MOBILE =====
  function MobileMenuButton({ onClick }) {
    return e('button', {
      className: 'mobile-menu-btn',
      onClick: onClick,
      style: { display: 'none' } // Será exibido apenas em mobile via CSS
    }, '☰')
  }

  // ===== HOOK CUSTOMIZADO PARA CONTROLE REMOTO =====
  function useRemoteControl(handlers = {}) {
    const [channelInput, setChannelInput] = useState('')
    const channelInputTimerRef = useRef(null)

    useEffect(() => {
      const handleKeyDown = (event) => {
        // ===== IGNORAR EVENTOS DE INPUTS/TEXTAREAS =====
        // Permite que backspace e outras teclas funcionem normalmente em campos de texto
        const target = event.target
        const isInput = target.tagName === 'INPUT' || target.tagName === 'TEXTAREA' || target.isContentEditable
        if (isInput) {
          // Não interceptar eventos de teclado quando estiver em inputs
          return
        }

        // SETAS - Navegação
        if (RemoteKeyMap.matches(RemoteKeyMap.ARROW_UP, event)) {
          event.preventDefault()
          handlers.onUp?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.ARROW_DOWN, event)) {
          event.preventDefault()
          handlers.onDown?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.ARROW_LEFT, event)) {
          event.preventDefault()
          handlers.onLeft?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.ARROW_RIGHT, event)) {
          event.preventDefault()
          handlers.onRight?.()
          return
        }

        // OK/ENTER - Selecionar
        if (RemoteKeyMap.matches(RemoteKeyMap.OK, event)) {
          event.preventDefault()
          handlers.onSelect?.()
          return
        }

        // BACK - Voltar
        if (RemoteKeyMap.matches(RemoteKeyMap.BACK, event)) {
          event.preventDefault()
          handlers.onBack?.()
          return
        }

        // NÚMEROS 0-9 - Navegação direta por canal
        for (let num = 0; num <= 9; num++) {
          if (RemoteKeyMap.matches(RemoteKeyMap[`NUM_${num}`], event)) {
            event.preventDefault()

            // Acumular números digitados
            const newInput = channelInput + num
            setChannelInput(newInput)

            // Limpar timer anterior
            if (channelInputTimerRef.current) {
              clearTimeout(channelInputTimerRef.current)
            }

            // Aguardar 1.5s para confirmar o canal
            channelInputTimerRef.current = setTimeout(() => {
              handlers.onChannelNumber?.(newInput)
              setChannelInput('')
            }, 1500)

            return
          }
        }

        // BOTÕES COLORIDOS
        if (RemoteKeyMap.matches(RemoteKeyMap.RED, event)) {
          event.preventDefault()
          handlers.onRed?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.GREEN, event)) {
          event.preventDefault()
          handlers.onGreen?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.YELLOW, event)) {
          event.preventDefault()
          handlers.onYellow?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.BLUE, event)) {
          event.preventDefault()
          handlers.onBlue?.()
          return
        }

        // CONTROLE DE MÍDIA
        if (RemoteKeyMap.matches(RemoteKeyMap.PLAY, event)) {
          event.preventDefault()
          handlers.onPlayPause?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.STOP, event)) {
          event.preventDefault()
          handlers.onStop?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.REWIND, event)) {
          event.preventDefault()
          handlers.onRewind?.()
          return
        }

        if (RemoteKeyMap.matches(RemoteKeyMap.FORWARD, event)) {
          event.preventDefault()
          handlers.onForward?.()
          return
        }
      }

      // Registrar listener
      document.addEventListener('keydown', handleKeyDown)

      // Cleanup
      return () => {
        document.removeEventListener('keydown', handleKeyDown)
        if (channelInputTimerRef.current) {
          clearTimeout(channelInputTimerRef.current)
        }
      }
    }, [channelInput, handlers])

    return { channelInput }
  }

  function App(){
    const [view,setViewRaw] = useState('config')
    const [showParentalPin, setShowParentalPin] = useState(false)
    const [pendingAdultView, setPendingAdultView] = useState(false)

    // Wrapper para logar todas as mudanças de view
    const setView = (newView) => {
      console.trace('[setView] Stack trace:')
      setViewRaw(newView)
    }
    const [account,setAccount] = useState(null)
    const [loading,setLoading] = useState(false)
    const [error,setError] = useState('')
    const [debug,setDebug] = useState(null)
    const [globalSearchQuery,setGlobalSearchQuery] = useState('')

    const [cfg,setCfg] = useLocalStorage('xtream_config', { server:'', username:'', password:'' })
    const [tmdbKey,setTmdbKey] = useLocalStorage('tmdb_api_key', '7e61dfdf698b31e14082e80a0ca9f9fa')
    const [tmdbCache,setTmdbCache] = useLocalStorage('tmdb_cache', {})

    // ===== SISTEMA DE CACHE EM MEMÓRIA PARA TMDB (PERFORMANCE) =====
    // Cache em RAM para evitar parsing JSON do localStorage a cada leitura
    const tmdbMemCache = useRef({
      search: {},     // Cache de buscas por nome
      details: {},    // Cache de detalhes por ID
      images: new Set() // Set de URLs de imagens já carregadas
    })

    // ===== RATE LIMITER INTELIGENTE PARA TMDB =====
    // TMDB tem limite de ~40 requisições por 10 segundos
    const tmdbRateLimiter = useRef({
      queue: [],           // Fila de requisições pendentes
      processing: false,   // Flag de processamento
      requestTimes: [],    // Timestamps das últimas requisições
      maxRequests: 35,     // Máximo de requisições (seguro: 35/10s)
      timeWindow: 10000    // Janela de tempo (10 segundos)
    })

    // ===== BATCHING DE REQUISIÇÕES TMDB =====
    // Agrupa múltiplas requisições em lotes para evitar rate limit
    const tmdbBatcher = useRef({
      pending: new Map(),  // Map de promises pendentes (evita duplicatas)
      timeout: null,       // Timeout para processar batch
      batchDelay: 100      // Delay para agrupar requisições (100ms)
    })

    // Sincronizar configuração com XCClient
    useEffect(() => {
      window.__xcConfig = {
        username: cfg.username || '',
        password: cfg.password || ''
      }
    }, [cfg.username, cfg.password])

    // ===== INTEGRAÇÃO DE CONTROLE REMOTO PARA SMART TV =====
    const { channelInput } = useRemoteControl({
      onUp: () => {
        // Navegar para cima nas listas
        const focused = document.activeElement
        if (!focused || focused === document.body) {
          // Focar primeiro elemento navegável
          const firstFocusable = document.querySelector('button, [role="button"], a[href]')
          firstFocusable?.focus()
        }
      },
      onDown: () => {
        // Navegar para baixo nas listas
        const focused = document.activeElement
        if (!focused || focused === document.body) {
          const firstFocusable = document.querySelector('button, [role="button"], a[href]')
          firstFocusable?.focus()
        }
      },
      onLeft: () => {
        // Navegar para esquerda (pode ser EPG ou sidebar)
        // Deixar navegação nativa do browser
      },
      onRight: () => {
        // Navegar para direita (pode ser EPG ou detalhes)
        // Deixar navegação nativa do browser
      },
      onSelect: () => {
        // Simular clique no elemento focado
        const focused = document.activeElement
        if (focused && focused !== document.body) {
          focused.click()
        }
      },
      onBack: () => {
        // Voltar para view anterior
        if (view === 'player') {
          setView('home')
        } else if (view === 'netflix-movies' || view === 'live-categories') {
          setView('home')
        } else if (view !== 'home' && view !== 'config') {
          setView('home')
        }
      },
      onChannelNumber: (number) => {
        // Ir direto para o canal digitado
        // TODO: Implementar lógica de seleção direta de canal
      },
      onRed: () => {
        // Botão vermelho: Favoritos
        // TODO: Implementar tela de favoritos
      },
      onGreen: () => {
        // Botão verde: Guia EPG completo
        setView('live-categories')
      },
      onYellow: () => {
        // Botão amarelo: Configurações
        setView('config')
      },
      onBlue: () => {
        // Botão azul: Busca
        // TODO: Implementar tela de busca global
      },
      onPlayPause: () => {
        // Controlar reprodução do vídeo
        const video = document.querySelector('video')
        if (video) {
          if (video.paused) {
            video.play()
          } else {
            video.pause()
          }
        }
      },
      onStop: () => {
        // Parar reprodução e voltar
        if (view === 'player') {
          setView('home')
        }
      },
      onRewind: () => {
        // Retroceder 10 segundos
        const video = document.querySelector('video')
        if (video) {
          video.currentTime = Math.max(0, video.currentTime - 10)
        }
      },
      onForward: () => {
        // Avançar 10 segundos
        const video = document.querySelector('video')
        if (video) {
          video.currentTime = Math.min(video.duration, video.currentTime + 10)
        }
      }
    })

    const [liveCats,setLiveCats] = useState([])
    const [vodCats,setVodCats] = useState([])
    const [seriesCats,setSeriesCats] = useState([])

    // TV ao vivo
    const [selectedLiveCat,setSelectedLiveCat] = useState(null)
    const [liveStreams,setLiveStreams] = useState([])
    const [selectedChannel,setSelectedChannel] = useState(null)
    const [epg,setEpg] = useState([])
    const [selectedDay,setSelectedDay] = useState(0) // 0 = hoje, 1 = amanhã, etc.
    const [selectedEpgId,setSelectedEpgId] = useState(null) // ID do programa EPG selecionado
    const [liveLeftMode,setLiveLeftMode] = useState('categories')
    const autoOpenLiveRef = useRef(false)
    // NEW: contagem por categoria (para badge da esquerda)
    const [liveCounts,setLiveCounts] = useState({})
    const [liveAllCount,setLiveAllCount] = useState(0)

    // Quality variants system
    const [channelVariants,setChannelVariants] = useLocalStorage('channel_quality_prefs', {})
    const [toast,setToast] = useState(null)

    // Genérico
    const [selectedCat,setSelectedCat] = useState(null)
    const [items,setItems] = useState([])
    const [query,setQuery] = useState('')

    // Inicializar selectedCat com primeira categoria prioritária quando vodCats ou seriesCats carregar
    useEffect(() => {
      const isMoviesView = view === 'netflix-movies'
      const isSeriesView = view === 'netflix-series'
      const isAdultView = view === 'adult-content'
      let categories = isSeriesView ? seriesCats : vodCats

      // Filtrar categorias baseado na view
      if (isAdultView) {
        // Na view adulta: mostrar APENAS categorias 18+
        categories = categories.filter(cat => {
          const catName = cat.category_name || cat.name || ''
          return catName.trim().startsWith('18+')
        })
      } else if (isMoviesView) {
        // Na view de filmes: REMOVER categorias 18+, Animes e Show
        categories = categories.filter(cat => {
          const catName = (cat.category_name || cat.name || '').toLowerCase().trim()
          // Remover: 18+, animes (crunchyroll, anime), show
          return !catName.startsWith('18+') &&
                 !catName.includes('crunchyroll') &&
                 !catName.includes('anime') &&
                 !catName.includes('show')
        })
      }

      // Sempre selecionar primeira categoria quando entrar na view (mesmo que já tenha selectedCat de antes)
      if (categories.length > 0 && (isMoviesView || isSeriesView || isAdultView)) {
        // Aplicar mesma lógica de prioridade do CategoryBar
        const priorityNames = [
          'lançamentos',
          'lancamentos',
          'lançamentos legendados',
          'lancamentos legendados',
          'cinema',
          'indicados ao oscar',
          'oscar'
        ]

        const priorityCats = []
        const otherCats = []

        categories.forEach(cat => {
          const catName = cat.category_name || cat.name || ''
          const normalizedName = catName.toLowerCase().trim()
          let priorityIndex = -1

          priorityIndex = priorityNames.findIndex(pName => normalizedName === pName)

          if (priorityIndex === -1) {
            if (normalizedName.includes('legendado')) {
              priorityIndex = priorityNames.findIndex(pName => pName.includes('legendado'))
            }
            else if (normalizedName.includes('lançamento') || normalizedName.includes('lancamento')) {
              priorityIndex = priorityNames.findIndex(pName =>
                (pName === 'lançamentos' || pName === 'lancamentos')
              )
            }
            else if (normalizedName.includes('cinema')) {
              priorityIndex = priorityNames.findIndex(pName => pName === 'cinema')
            }
            else if (normalizedName.includes('oscar')) {
              priorityIndex = priorityNames.findIndex(pName => pName.includes('oscar'))
            }
          }

          if (priorityIndex !== -1) {
            priorityCats.push({ cat, priority: priorityIndex })
          } else {
            otherCats.push(cat)
          }
        })

        priorityCats.sort((a, b) => a.priority - b.priority)
        const sortedPriorityCats = priorityCats.map(item => item.cat)
        const orderedCats = [...sortedPriorityCats, ...otherCats]

        if (orderedCats.length > 0) {
          setSelectedCat(orderedCats[0])
        }
      }
    }, [vodCats.length, seriesCats.length, view])

    const [current,setCurrent] = useState(null)
    const [selectedContent, setSelectedContent] = useState(null) // Para página de detalhes

    // Trailer modal (global)
    const [trailerUrl, setTrailerUrl] = useState(null)
    const [showTrailerModal, setShowTrailerModal] = useState(false)

    // ==== API core ====
    async function parseJsonFromResponse(res){
      const ct = (res.headers.get('content-type')||'').toLowerCase()
      if(ct.includes('application/json')) return res.json()
      const text = await res.text()
      try{ return JSON.parse(text) }catch{ throw new Error('Resposta não-JSON da API') }
    }

    async function fetchJsonAuto(url){
      setDebug({ url })
      const res = await fetch(url, { headers:{ 'Accept':'application/json' } })

      const contentType = (res.headers.get('content-type') || '').toLowerCase()
      const text = await res.text()

      if(!res.ok) {
        throw new Error(`[HTTP ${res.status}] ${text.slice(0, 200)}`)
      }

      // Validar que é JSON e não HTML
      if(!contentType.includes('application/json') && !contentType.includes('text/plain')) {
        throw new Error(`Expected JSON, got: ${contentType || 'unknown'} | body: ${text.slice(0, 200)}`)
      }

      // Verificar se não é HTML (fallback do SPA)
      if(text.trim().startsWith('<!DOCTYPE') || text.trim().startsWith('<html')) {
        throw new Error('Received HTML instead of JSON - check proxy configuration')
      }

      try {
        return JSON.parse(text)
      } catch(e) {
        throw new Error('Invalid JSON response: ' + text.slice(0, 200))
      }
    }

    // Cache para requisições da API (evitar loops)
    const apiCache = {}
    const CACHE_DURATION = 5 * 60 * 1000 // 5 minutos

    async function apiCall(action, params){
      if(!cfg.server || !cfg.username || !cfg.password){ throw new Error('Configuração incompleta') }

      // Criar chave de cache baseada na action e params
      const cacheKey = `${action}_${JSON.stringify(params || {})}`
      const now = Date.now()

      // Verificar se existe no cache e ainda é válido
      if(apiCache[cacheKey] && (now - apiCache[cacheKey].timestamp) < CACHE_DURATION){
        return apiCache[cacheKey].data
      }

      // Usar api.php local (proxy) ao invés de chamar servidor remoto diretamente
      const usp = new URLSearchParams({ username:cfg.username, password:cfg.password, action, ...(params||{}) })
      const url = 'api.php?' + usp.toString()

      // Usar pool de requisições + retry
      return await withRequestPool(async () => {
        return await withRetry(async () => {
          try {
            const data = await fetchJsonAuto(url)

            // Salvar no cache
            apiCache[cacheKey] = { data, timestamp: now }

            return data
          } catch(error) {
            // get_vod_info com 502/500 não é crítico (pode buscar direto no TMDB)
            if(action === 'get_vod_info' && (error.message.includes('502') || error.message.includes('500'))) {
            } else {
            }
            throw error
          }
        })
      })
    }

    // Compat: alguns painéis exigem 'series' ao invés de 'series_id' em get_series_info
    async function apiCallSeriesInfo(seriesId){
      let data = null
      try{ data = await apiCall('get_series_info', { series_id: seriesId }) }catch{}
      const hasEpisodes = data && (data.episodes || (data.info && data.info.name))
      if(!hasEpisodes){
        try{ const alt = await apiCall('get_series_info', { series: seriesId }); if(alt) data = alt }catch{}
      }
      if(!data) throw new Error('Falha ao obter informações da série')
      return data
    }

    // TMDB API - OTIMIZADO COM CACHE EM MEMÓRIA + RATE LIMITING
    async function searchTMDB(title, type = 'movie'){
      let apiKey = localStorage.getItem('tmdb_api_key')
      if(!apiKey || apiKey === '""' || apiKey === '') {
        apiKey = '7e61dfdf698b31e14082e80a0ca9f9fa'
      }
      // Remove aspas se tiver
      apiKey = apiKey.replace(/"/g, '')
      const cacheKey = `${type}_${title}`

      // ===== NOVO: Verificar cache em memória primeiro =====
      const cached = getMemCache('search', cacheKey)
      if (cached) return cached

      // ===== NOVO: Usar batching para evitar requisições duplicadas =====
      return batchedTMDBRequest(`search_${cacheKey}`, async () => {
        try{
          // ===== SANITIZER AGRESSIVO: Remove sufixos comuns de títulos VOD =====
          let cleanTitle = title
            .replace(/\s*\([LDlD]\)/gi, '')    // Remove (L) (D) de legendado/dublado
            .replace(/\s*\((HD|FHD|4K|CAM|WEB-DL|BluRay|BRRip|DVDRip)\)/gi, '') // Qualidade entre parênteses
            .replace(/\b(UHD|FHD|4K|1080p|720p|HDR|TESTE4K|TESTE|2160p)\b/gi, '') // Qualidade sem parênteses
            .replace(/\(.*?\)/g, '')           // Remove (qualquer coisa restante)
            .replace(/\s*-\s*\d{4}$/g, '')     // Remove " - 2025" do final
            .replace(/\s*\d{4}\s*$/g, '')      // Remove "2025" do final
            .replace(/\s*-\s*$/, '')           // Remove " - " do final
            .replace(/[–—:]/g, ' ')            // Travessões e dois-pontos viram espaço
            .normalize('NFD')                  // Normaliza acentos
            .replace(/[\u0300-\u036f]/g, '')   // Remove diacríticos (acentos)
            .replace(/\s{2,}/g, ' ')           // Normaliza espaços múltiplos (2+)
            .trim()

          // Se ficou vazio após limpeza, não buscar
          if(!cleanTitle || cleanTitle.length < 2) {
            return null
          }

          const url = `https://api.themoviedb.org/3/search/${type}?api_key=${apiKey}&query=${encodeURIComponent(cleanTitle)}&language=pt-BR`

          // ===== NOVO: Usar fila com dedupe =====
          const data = await schedule(`search:${type}:${cleanTitle}`, async () => {
            const res = await fetch(url)
            return await res.json()
          })

          const result = data.results && data.results[0] ? {
            title: data.results[0].title || data.results[0].name,
            overview: data.results[0].overview,
            poster: data.results[0].poster_path ? `https://image.tmdb.org/t/p/w500${data.results[0].poster_path}` : null,
            backdrop: data.results[0].backdrop_path ? `https://image.tmdb.org/t/p/original${data.results[0].backdrop_path}` : null,
            rating: data.results[0].vote_average,
            year: (data.results[0].release_date || data.results[0].first_air_date || '').substring(0, 4),
            tmdb_id: data.results[0].id
          } : null

          // ===== NOVO: Salvar em cache de memória + localStorage =====
          setMemCache('search', cacheKey, result)
          return result
        }catch(err){
          return null
        }
      })
    }

    // ===== FUNÇÕES DE PERFORMANCE TMDB =====

    // Rate Limiter com Concorrência: Garante que não ultrapassamos 35 req/10s E máximo 6 simultâneas
    async function rateLimitedFetch(url, requestType = 'unknown') {
      const limiter = tmdbRateLimiter.current

      // Inicializar contador de requisições simultâneas
      if (!limiter.running) limiter.running = 0
      if (!limiter.queue) limiter.queue = []
      const MAX_CONCURRENT = 6

      // Se já estamos no máximo de concorrência, enfileirar
      if (limiter.running >= MAX_CONCURRENT) {
        return new Promise((resolve, reject) => {
          limiter.queue.push(() => rateLimitedFetch(url, requestType).then(resolve).catch(reject))
        })
      }

      const now = Date.now()

      // Limpar timestamps antigos (fora da janela de 10s)
      limiter.requestTimes = limiter.requestTimes.filter(time => now - time < limiter.timeWindow)

      // Se atingiu o limite de rate, aguardar
      if (limiter.requestTimes.length >= limiter.maxRequests) {
        const oldestRequest = limiter.requestTimes[0]
        const waitTime = limiter.timeWindow - (now - oldestRequest) + 100 // +100ms margem
        await new Promise(resolve => setTimeout(resolve, waitTime))
        return rateLimitedFetch(url, requestType) // Tentar novamente
      }

      // Incrementar contador de requisições simultâneas
      limiter.running++

      // Registrar requisição no rate limit
      limiter.requestTimes.push(Date.now())

      try {
        // Executar fetch
        return await fetch(url)
      } finally {
        // Decrementar contador
        limiter.running--

        // Processar próximo item da fila
        if (limiter.queue.length > 0 && limiter.running < MAX_CONCURRENT) {
          const next = limiter.queue.shift()
          setTimeout(() => next(), 0) // Processar na próxima tick
        }
      }
    }

    // Batching: Agrupa requisições duplicadas (evita buscar mesmo filme 2x)
    function batchedTMDBRequest(key, fetchFunction) {
      const batcher = tmdbBatcher.current

      // Se já existe uma promise pendente para esta key, retornar ela
      if (batcher.pending.has(key)) {
        return batcher.pending.get(key)
      }

      // Criar nova promise
      const promise = fetchFunction().finally(() => {
        // Remover da fila após completar
        batcher.pending.delete(key)
      })

      batcher.pending.set(key, promise)

      return promise
    }

    // Cache em memória: Verifica cache RAM antes de localStorage
    function getMemCache(type, key) {
      const cache = tmdbMemCache.current

      if (type === 'search' && cache.search[key]) {
        return cache.search[key]
      }

      if (type === 'details' && cache.details[key]) {
        return cache.details[key]
      }

      // Tentar localStorage como fallback
      const cacheKey = type === 'search' ? key : `details_${key}`
      if (tmdbCache[cacheKey]) {
        // Copiar para memória para próximas leituras
        if (type === 'search') {
          cache.search[key] = tmdbCache[cacheKey]
        } else {
          cache.details[key] = tmdbCache[cacheKey]
        }
        return tmdbCache[cacheKey]
      }

      return null
    }

    // Salvar em ambos os caches (memória + localStorage)
    function setMemCache(type, key, value) {
      const cache = tmdbMemCache.current

      if (type === 'search') {
        cache.search[key] = value
        setTmdbCache(prev => ({ ...prev, [key]: value }))
      } else {
        cache.details[key] = value
        const cacheKey = `details_${key}`
        setTmdbCache(prev => ({ ...prev, [cacheKey]: value }))
      }
    }

    // ===== LAZY LOADING INTELIGENTE DE IMAGENS =====
    // Pré-carrega imagens de forma controlada para evitar overhead
    const imagePreloader = useRef({
      loaded: new Set(),    // URLs já carregadas
      loading: new Set(),   // URLs sendo carregadas no momento
      queue: [],           // Fila de URLs para carregar
      processing: false,   // Flag de processamento
      maxConcurrent: 6     // Máximo de imagens simultâneas
    })

    // Pré-carrega uma imagem (retorna promise)
    function preloadImage(url) {
      const preloader = imagePreloader.current

      if (!url || preloader.loaded.has(url)) {
        return Promise.resolve() // Já carregada
      }

      if (preloader.loading.has(url)) {
        // Já está sendo carregada, aguardar
        return new Promise((resolve) => {
          const checkInterval = setInterval(() => {
            if (preloader.loaded.has(url) || !preloader.loading.has(url)) {
              clearInterval(checkInterval)
              resolve()
            }
          }, 100)
        })
      }

      // Marcar como carregando
      preloader.loading.add(url)

      return new Promise((resolve, reject) => {
        const img = new Image()

        img.onload = () => {
          preloader.loading.delete(url)
          preloader.loaded.add(url)
          resolve()
        }

        img.onerror = () => {
          preloader.loading.delete(url)
          reject()
        }

        img.src = url
      })
    }

    // Pré-carrega múltiplas imagens em lotes controlados
    async function preloadImagesInBatches(urls) {
      const preloader = imagePreloader.current
      const validUrls = urls.filter(url => url && !preloader.loaded.has(url))

      if (validUrls.length === 0) {
        return
      }

      // Dividir em lotes
      for (let i = 0; i < validUrls.length; i += preloader.maxConcurrent) {
        const batch = validUrls.slice(i, i + preloader.maxConcurrent)

        // Carregar lote em paralelo
        await Promise.allSettled(batch.map(url => preloadImage(url)))

        // Pequeno delay entre lotes para não sobrecarregar
        if (i + preloader.maxConcurrent < validUrls.length) {
          await new Promise(resolve => setTimeout(resolve, 200))
        }
      }
    }

    // Buscar detalhes completos do TMDB (gêneros, duração, etc.) em pt-BR - OTIMIZADO
    async function getTMDBDetails(tmdb_id, type = 'movie'){
      let apiKey = localStorage.getItem('tmdb_api_key')
      if(!apiKey || apiKey === '""' || apiKey === '') {
        apiKey = '7e61dfdf698b31e14082e80a0ca9f9fa'
      }
      // Remove aspas se tiver
      apiKey = apiKey.replace(/"/g, '')

      if(!tmdb_id) {
        return null
      }

      const cacheKey = `${type}_${tmdb_id}`

      // ===== NOVO: Verificar cache em memória primeiro =====
      const cached = getMemCache('details', cacheKey)
      if (cached && cached.belongs_to_collection !== undefined) {
        return cached
      }

      // ===== NOVO: Usar batching para evitar requisições duplicadas =====
      return batchedTMDBRequest(`details_${cacheKey}`, async () => {
        try{
          // ===== BUSCAR DETALHES + CRÉDITOS (elenco e diretor) =====
          const url = `https://api.themoviedb.org/3/${type}/${tmdb_id}?api_key=${apiKey}&language=pt-BR&append_to_response=credits`

          // ===== NOVO: Usar rate limiter =====
          const res = await rateLimitedFetch(url, `details:${tmdb_id}`)
          const data = await res.json()

          // ===== EXTRAIR ELENCO PRINCIPAL (top 5) =====
          const cast = data.credits?.cast?.slice(0, 5).map(actor => actor.name).join(', ') || null

          // ===== EXTRAIR DIRETOR =====
          const director = data.credits?.crew?.find(person => person.job === 'Director')?.name || null

          const result = {
            title: data.title || data.name,
            overview: data.overview || data.description,
            poster: data.poster_path ? `https://image.tmdb.org/t/p/w500${data.poster_path}` : null,
            backdrop: data.backdrop_path ? `https://image.tmdb.org/t/p/original${data.backdrop_path}` : null,
            rating: data.vote_average,
            vote_count: data.vote_count || 0, // ===== NOVO: Quantidade de votos =====
            year: (data.release_date || data.first_air_date || '').substring(0, 4),
            runtime: data.runtime || data.episode_run_time?.[0] || null,
            genres: data.genres ? data.genres.map(g => g.name).join(', ') : '',
            cast: cast, // ===== NOVO: Elenco =====
            director: director, // ===== NOVO: Diretor =====
            original_language: data.original_language?.toUpperCase() || null, // ===== NOVO: Idioma =====
            status: data.status || null, // ===== NOVO: Status (Released, etc) =====
            tmdb_id: data.id,
            belongs_to_collection: data.belongs_to_collection || null // Informação da coleção
          }

          // ===== OTIMIZAÇÃO: Fallback para EN-US se PT-BR não tiver overview =====
          if(!result.overview){
            try {
              const urlEn = `https://api.themoviedb.org/3/${type}/${tmdb_id}?api_key=${apiKey}&language=en-US`
              const resEn = await rateLimitedFetch(urlEn, `details-en:${tmdb_id}`)
              const dataEn = await resEn.json()
              result.overview = dataEn.overview || 'Sem descrição disponível.'
            } catch(errEn) {
              result.overview = 'Sem descrição disponível.'
            }
          }

          // ===== NOVO: Salvar em cache de memória + localStorage =====
          setMemCache('details', cacheKey, result)
          return result
        }catch(err){
          return null
        }
      })
    }

    // Buscar trailer do YouTube no TMDB
    async function getTMDBTrailer(tmdb_id, type = 'movie'){
      let apiKey = localStorage.getItem('tmdb_api_key')
      if(!apiKey || apiKey === '""' || apiKey === '') {
        apiKey = '7e61dfdf698b31e14082e80a0ca9f9fa'
      }
      apiKey = apiKey.replace(/"/g, '')

      if(!tmdb_id) return null

      const cacheKey = `trailer_${type}_${tmdb_id}`

      // ===== NOVO: Verificar cache em memória primeiro =====
      const cached = getMemCache('details', cacheKey)
      if(cached) {
        return cached
      }

      // ===== NOVO: Usar batching para evitar duplicatas =====
      return batchedTMDBRequest(`trailer_${cacheKey}`, async () => {
        try{
          const url = `https://api.themoviedb.org/3/${type}/${tmdb_id}/videos?api_key=${apiKey}&language=pt-BR`
          // ===== NOVO: Rate limiting =====
          const res = await rateLimitedFetch(url, `trailer:${tmdb_id}`)
          const data = await res.json()

          // Buscar trailer oficial do YouTube
          const trailer = data.results?.find(v =>
            v.site === 'YouTube' &&
            (v.type === 'Trailer' || v.type === 'Teaser')
          )

          // Fallback para en-US se não encontrar em pt-BR
          if(!trailer) {
            const urlEn = `https://api.themoviedb.org/3/${type}/${tmdb_id}/videos?api_key=${apiKey}&language=en-US`
            // ===== NOVO: Rate limiting =====
            const resEn = await rateLimitedFetch(urlEn, `trailer-en:${tmdb_id}`)
            const dataEn = await resEn.json()
            const trailerEn = dataEn.results?.find(v =>
              v.site === 'YouTube' &&
              (v.type === 'Trailer' || v.type === 'Teaser')
            )
            if(trailerEn) {
              const result = `https://www.youtube.com/embed/${trailerEn.key}`
              // ===== NOVO: Salvar em ambos os caches =====
              setMemCache('details', cacheKey, result)
              return result
            }
          }

          if(trailer) {
            const result = `https://www.youtube.com/embed/${trailer.key}`
            // ===== NOVO: Salvar em ambos os caches =====
            setMemCache('details', cacheKey, result)
            return result
          }

          return null
        }catch(err){
          return null
        }
      })
    }

    // ===== COLEÇÕES TMDB =====
    // Identificar e agrupar coleções a partir dos filmes locais
    async function findCollectionsInMovies(movies) {
      const collectionsMap = new Map()

      for(const movie of movies) {
        // Se o filme já foi enriquecido e tem collection_id
        if(movie.tmdb_collection && movie.tmdb_collection.id) {
          const collectionId = movie.tmdb_collection.id

          if(!collectionsMap.has(collectionId)) {
            collectionsMap.set(collectionId, {
              id: collectionId,
              name: movie.tmdb_collection.name,
              poster: movie.tmdb_collection.poster_path ?
                `https://image.tmdb.org/t/p/w500${movie.tmdb_collection.poster_path}` : null,
              backdrop: movie.tmdb_collection.backdrop_path ?
                `https://image.tmdb.org/t/p/original${movie.tmdb_collection.backdrop_path}` : null,
              movies: []
            })
          }

          collectionsMap.get(collectionId).movies.push(movie)
        }
      }

      const result = Array.from(collectionsMap.values())
      return result
    }

    // Buscar informações completas de uma coleção
    async function getTMDBCollection(collection_id) {
      let apiKey = localStorage.getItem('tmdb_api_key')
      if(!apiKey || apiKey === '""' || apiKey === '') {
        apiKey = '7e61dfdf698b31e14082e80a0ca9f9fa'
      }
      apiKey = apiKey.replace(/"/g, '')

      if(!collection_id) {
        return null
      }

      const cacheKey = `collection_${collection_id}`
      if(tmdbCache[cacheKey]) {
        return tmdbCache[cacheKey]
      }

      try {
        const url = `https://api.themoviedb.org/3/collection/${collection_id}?api_key=${apiKey}&language=pt-BR`
        const res = await fetch(url)
        const data = await res.json()

        const result = {
          id: data.id,
          name: data.name,
          overview: data.overview,
          poster: data.poster_path ? `https://image.tmdb.org/t/p/w500${data.poster_path}` : null,
          backdrop: data.backdrop_path ? `https://image.tmdb.org/t/p/original${data.backdrop_path}` : null,
          parts: data.parts || [] // Array de filmes da coleção
        }

        // Fallback para en-US se pt-BR não tiver overview
        if(!result.overview) {
          const urlEn = `https://api.themoviedb.org/3/collection/${collection_id}?api_key=${apiKey}&language=en-US`
          const resEn = await fetch(urlEn)
          const dataEn = await resEn.json()
          result.overview = dataEn.overview || ''
          if(!result.name) result.name = dataEn.name || ''
        }

        setTmdbCache(prev => ({ ...prev, [cacheKey]: result }))
        return result
      } catch(err) {
        return null
      }
    }

    // ===== ENRIQUECIMENTO AUTOMÁTICO DE FILMES =====
    // Busca TMDB ID do servidor primeiro, depois fallback para busca por nome
    async function enrichMovieWithTMDB(movie, contentType = 'movie') {
      let apiKey = localStorage.getItem('tmdb_api_key')
      if(!apiKey || apiKey === '""' || apiKey === '') {
        apiKey = '7e61dfdf698b31e14082e80a0ca9f9fa'
      }
      // Remove aspas se tiver
      apiKey = apiKey.replace(/"/g, '')

      // Detectar tipo de conteúdo (série ou filme) automaticamente
      const tmdbType = contentType === 'series' || movie.series_id ? 'tv' : 'movie'

      // ===== GUARD: Verificar cache de enriquecimento PRIMEIRO =====
      // ===== CORREÇÃO: Incluir nome do filme na chave quando stream_id for undefined =====
      const streamId = movie.stream_id || movie.id
      const movieName = movie.name || movie.title || ''
      const cacheKey = streamId && streamId !== 'undefined' ? streamId : `name_${movieName}`

      if (!window.__enrichmentCache) {
        window.__enrichmentCache = new Map()
      }

      if (window.__enrichmentCache.has(cacheKey)) {
        const cached = window.__enrichmentCache.get(cacheKey)
        return cached
      }

      // ===== NOVO: Usar prepareForTMDB para normalização =====
      const originalName = movie.name || movie.title
      const titleInfo = prepareForTMDB(originalName)

      // Adicionar propriedade para identificar legendado
      const movieWithLangType = {
        ...movie,
        langType: titleInfo.langType,
        isLegendado: titleInfo.isLegendado,
        displayName: titleInfo.displayTitle,      // Nome para exibir (com "(L)")
        searchName: titleInfo.searchTitle          // Nome para buscar no TMDB (limpo)
      }

      // Se já tem dados TMDB completos, retorna e cacheia
      if(movie.tmdb_overview && movie.tmdb_poster && movie.tmdb_backdrop) {
        const enriched = { ...movieWithLangType, ...movie }
        window.__enrichmentCache.set(cacheKey, enriched)
        return enriched
      }

      // ===== OTIMIZAÇÃO: Verificar cache por nome PRIMEIRO (mais rápido) =====
      const cleanName = titleInfo.searchTitle.toLowerCase().replace(/[^\w\s]/g, '').trim()
      const cachedSearch = getMemCache('search', cleanName)

      if (cachedSearch) {
        const enriched = {
          ...movieWithLangType,
          tmdb_id: cachedSearch.tmdb_id,
          tmdb_poster: cachedSearch.poster,
          tmdb_backdrop: cachedSearch.backdrop,
          tmdb_overview: cachedSearch.overview,
          tmdb_rating: cachedSearch.rating,
          tmdb_vote_count: cachedSearch.vote_count,
          tmdb_year: cachedSearch.year,
          tmdb_runtime: cachedSearch.runtime,
          tmdb_genres: cachedSearch.genres,
          tmdb_cast: cachedSearch.cast,
          tmdb_director: cachedSearch.director,
          tmdb_language: cachedSearch.original_language,
          tmdb_status: cachedSearch.status,
          tmdb_collection: cachedSearch.belongs_to_collection
        }
        window.__enrichmentCache.set(cacheKey, enriched)
        return enriched
      }

      try {
        let tmdbId = movie.tmdb_id // Pode vir do cache ou do servidor

        // ===== DESABILITADO: get_vod_info muito lento e não retorna JSON =====
        // Ir direto para busca TMDB por nome (mais rápido e confiável)

        // Estratégia 1: Se tem TMDB ID (do servidor ou cache), busca detalhes completos
        if(tmdbId) {
          const details = await getTMDBDetails(tmdbId, tmdbType)

          if(details) {
            const enriched = {
              ...movieWithLangType,
              tmdb_id: tmdbId,
              tmdb_poster: details.poster,
              tmdb_backdrop: details.backdrop,
              tmdb_overview: details.overview,
              tmdb_rating: details.rating,
              tmdb_vote_count: details.vote_count,
              tmdb_year: details.year,
              tmdb_runtime: details.runtime,
              tmdb_genres: details.genres,
              tmdb_cast: details.cast,
              tmdb_director: details.director,
              tmdb_language: details.original_language,
              tmdb_status: details.status,
              tmdb_collection: details.belongs_to_collection
            }
            window.__enrichmentCache.set(cacheKey, enriched)
            return enriched
          }
        }

        // Estratégia 2 (principal): Busca por nome (sem "(L)" para legendado)
        const searchResult = await searchTMDB(titleInfo.searchTitle, tmdbType)

        if(searchResult) {
          // Buscar detalhes completos usando o ID encontrado
          const fullDetails = await getTMDBDetails(searchResult.tmdb_id, tmdbType)

          if(fullDetails) {
            const enriched = {
              ...movieWithLangType,
              tmdb_id: searchResult.tmdb_id,
              tmdb_poster: fullDetails.poster,
              tmdb_backdrop: fullDetails.backdrop,
              tmdb_overview: fullDetails.overview,
              tmdb_rating: fullDetails.rating,
              tmdb_vote_count: fullDetails.vote_count,
              tmdb_year: fullDetails.year,
              tmdb_runtime: fullDetails.runtime,
              tmdb_genres: fullDetails.genres,
              tmdb_cast: fullDetails.cast,
              tmdb_director: fullDetails.director,
              tmdb_language: fullDetails.original_language,
              tmdb_status: fullDetails.status,
              tmdb_collection: fullDetails.belongs_to_collection
            }
            window.__enrichmentCache.set(cacheKey, enriched)
            return enriched
          }

          // Fallback: se detalhes falharem, usar dados básicos da busca
          const enriched = {
            ...movieWithLangType,
            tmdb_id: searchResult.tmdb_id,
            tmdb_poster: searchResult.poster,
            tmdb_backdrop: searchResult.backdrop,
            tmdb_overview: searchResult.overview,
            tmdb_rating: searchResult.rating,
            tmdb_year: searchResult.year
          }
          window.__enrichmentCache.set(cacheKey, enriched)
          return enriched
        }

        // Silenciar - não poluir console (filme não encontrado no TMDB é normal)
        window.__enrichmentCache.set(cacheKey, movieWithLangType)
        return movieWithLangType

      } catch(err) {
        console.debug(`[ENRICH] Erro ao enriquecer "${titleInfo.searchTitle}":`, err.message)
        window.__enrichmentCache.set(cacheKey, movieWithLangType)
        return movieWithLangType
      }
    }

    async function fetchAccountInfo(){
      if(!cfg.server || !cfg.username || !cfg.password){ throw new Error('Configuração incompleta') }
      const qs = new URLSearchParams({ username:cfg.username, password:cfg.password })
      const url1 = buildURL(cfg.server, ['player_api.php']) + '?' + qs.toString() + '&action=get_account_info'
      const url2 = buildURL(cfg.server, ['player_api.php']) + '?' + qs.toString()
      try{ return await fetchJsonAuto(url1) }catch(e1){ return await fetchJsonAuto(url2) }
    }

    function explainLoginError(msg){
      if(/cors|network|falha de rede/i.test(msg)) return 'O painel bloqueou requisições do navegador (CORS) OU o DNS/porta está errado/fora do ar.'
      if(/401|403/.test(msg)) return 'Usuário/senha incorretos ou bloqueados.'
      if(/404/.test(msg)) return 'Endpoint /player_api.php não encontrado nesse DNS/porta.'
      if(/Resposta não-JSON|Resposta inválida/i.test(msg)) return 'Formato de resposta inesperado para a API.'
      return 'Não foi possível autenticar com essas credenciais/URL.'
    }

    // Carregamento pontual por seção
    async function loadCatsByType(type){
      try{
        if(type==='live'){
          const raw = await apiCall('get_live_categories')
          setLiveCats(toArray(raw))
        }else if(type==='vod'){
          const raw = await apiCall('get_vod_categories')
          setVodCats(toArray(raw))
        }else{
          const raw = await apiCall('get_series_categories')
          setSeriesCats(toArray(raw))
        }
      }catch(err){ setError(err.message) }
    }

    // Contar canais por categoria (apenas para Live)
    async function loadLiveCounts(){
      try{
        const all = toArray(await apiCall('get_live_streams'))
        const map = {}
        for(const s of all){
          const cid = s.category_id ?? s.categoryId ?? s.category ?? s.stream_category_id
          if(cid!=null) map[cid] = (map[cid]||0) + 1
        }
        setLiveCounts(map)
        setLiveAllCount(all.length)
      }catch{ /* silencioso: se falhar, mostramos 0 ou cat.total */ }
    }

    // Só busca quando a view entrar E se ainda não tiver sido pré-carregado
    useEffect(()=>{
      // Com o preload, as categorias já estarão carregadas na maioria dos casos
      // Só carrega se realmente estiver vazio (fallback)
      if(view==='live-categories' && liveCats.length===0) {
        autoOpenLiveRef.current = false
        loadCatsByType('live')
      }
      if(view==='movie-categories' && vodCats.length===0) {
        loadCatsByType('vod')
      }
      if(view==='netflix-series' && seriesCats.length===0) {
        loadCatsByType('series')
      }
      if(view==='series-categories' && seriesCats.length===0) {
        loadCatsByType('series')
      }
      if(view==='novelas-categories' && seriesCats.length===0) loadCatsByType('series')
      if(view==='animes-categories' && seriesCats.length===0) loadCatsByType('series')
      if(view==='desenhos-categories' && seriesCats.length===0) loadCatsByType('series')
      if(view==='show-categories' && vodCats.length===0) loadCatsByType('vod')
      if(view==='adult-content' && vodCats.length===0) {
        loadCatsByType('vod')
      }
      if(view==='collections' && vodCats.length===0) {
        loadCatsByType('vod')
      }
    }, [view])

    // Ao carregar as categorias do Live, abrimos a 1ª e, se necessário, buscamos contagens
    useEffect(()=>{
      if(view==='live-categories' && liveCats.length>0){
        if(!selectedLiveCat && !autoOpenLiveRef.current){
          autoOpenLiveRef.current = true
          ;(async()=>{ try{ await openLiveCategory(liveCats[0], false) }catch(e){} })()
        }
        if(Object.keys(liveCounts).length===0){ loadLiveCounts() }
      }
    }, [view, liveCats, selectedLiveCat])

    // reset da flag ao sair da view
    useEffect(()=>{ if(view!=='live-categories') autoOpenLiveRef.current = false }, [view])

    useEffect(()=>{ // autoload se já tiver config
      if(cfg.server && cfg.username && cfg.password){
        setError('')
        fetchAccountInfo().then(info=> {
          setAccount(info.user_info||info)
          setView('home')

          // Pré-carregar categorias em background após auto-login
          preloadAllCategories()
          // DESABILITADO: pré-carregamento de conteúdo (causava loop infinito)
          // preloadTopVodContent()
        }).catch(err=> setError(explainLoginError(err.message||String(err))))
      }
    },[])

    // Pré-carregar TODAS as categorias em paralelo com cache localStorage
    async function preloadAllCategories(){
      const CACHE_KEY = 'categories_cache_v1'
      const CACHE_DURATION = 60 * 60 * 1000 // 1 hora em ms

      try{
        // Tentar carregar do cache primeiro
        const cached = localStorage.getItem(CACHE_KEY)
        if(cached){
          const { data, timestamp } = JSON.parse(cached)
          const age = Date.now() - timestamp

          if(age < CACHE_DURATION){
            setLiveCats(toArray(data.live))
            setVodCats(toArray(data.vod))
            setSeriesCats(toArray(data.series))

            // Atualizar em background
            updateCacheInBackground()
            return
          }
        }

        // Cache expirado ou não existe - buscar da API
        await fetchAndCacheCategories()

      }catch(err){
        // Se cache falhar, tentar buscar da API mesmo assim
        await fetchAndCacheCategories()
      }
    }

    // Buscar da API e salvar no cache
    async function fetchAndCacheCategories(){
      const [liveData, vodData, seriesData] = await Promise.all([
        apiCall('get_live_categories').catch(()=>[]),
        apiCall('get_vod_categories').catch(()=>[]),
        apiCall('get_series_categories').catch(()=>[])
      ])

      const live = toArray(liveData)
      const vod = toArray(vodData)
      const series = toArray(seriesData)

      setLiveCats(live)
      setVodCats(vod)
      setSeriesCats(series)

      // Salvar no cache
      const CACHE_KEY = 'categories_cache_v1'
      try{
        localStorage.setItem(CACHE_KEY, JSON.stringify({
          data: { live, vod, series },
          timestamp: Date.now()
        }))
      }catch(e){
      }
    }

    // Atualizar cache em background sem bloquear UI
    async function updateCacheInBackground(){
      try{
        const [liveData, vodData, seriesData] = await Promise.all([
          apiCall('get_live_categories').catch(()=>[]),
          apiCall('get_vod_categories').catch(()=>[]),
          apiCall('get_series_categories').catch(()=>[])
        ])

        const live = toArray(liveData)
        const vod = toArray(vodData)
        const series = toArray(seriesData)

        setLiveCats(live)
        setVodCats(vod)
        setSeriesCats(series)

        const CACHE_KEY = 'categories_cache_v1'
        localStorage.setItem(CACHE_KEY, JSON.stringify({
          data: { live, vod, series },
          timestamp: Date.now()
        }))
      }catch(err){
      }
    }

    // Pré-carregar conteúdo das 3 primeiras categorias de VOD em background
    async function preloadTopVodContent(){
      try{
        // Pegar as 3 primeiras categorias de VOD
        const topCategories = vodCats.slice(0, 3)

        if(topCategories.length === 0){
          return
        }

        // Carregar filmes de cada categoria em paralelo
        const contentPromises = topCategories.map(async (cat) => {
          try{
            const catId = getCatId(cat)
            const data = await apiCall('get_vod_streams', { category_id: catId })
            const movies = toArray(data)
            return { categoryId: catId, movies }
          }catch(err){
            return null
          }
        })

        const results = await Promise.all(contentPromises)

        // Guardar no cache
        const CONTENT_CACHE_KEY = 'vod_content_cache_v1'
        const validResults = results.filter(r => r !== null)

        if(validResults.length > 0){
          localStorage.setItem(CONTENT_CACHE_KEY, JSON.stringify({
            data: validResults,
            timestamp: Date.now()
          }))
        }

      }catch(err){
      }
    }

    async function onConnect(){
      if(!cfg.server || !cfg.username || !cfg.password){ setError('Preencha Servidor/Usuário/Senha.'); return }
      setCfg(v=>({ ...v, server:sanitizeServer(v.server) }))
      setAccount(null); setError('')
      setLoading(true)
      try{
        const info = await fetchAccountInfo()
        setAccount(info.user_info||info)
        setView('home')

        // Pré-carregar categorias em background após login
        preloadAllCategories()
        // DESABILITADO: pré-carregamento de conteúdo (causava loop infinito)
        // preloadTopVodContent()
      }catch(err){
        setError(explainLoginError(err.message||String(err)))
      }finally{
        setLoading(false)
      }
    }

    function onLogout(){ setAccount(null); setLiveCats([]); setVodCats([]); setSeriesCats([]); setItems([]); setCurrent(null); setSelectedCat(null); setSelectedLiveCat(null); setLiveStreams([]); setEpg([]); setLiveCounts({}); setLiveAllCount(0); setView('config') }

    async function openCategory(cat, type){
      setSelectedCat({ ...cat, type }); setItems([]); setQuery(''); setView('channels'); setLoading(true)
      try{
        if(type==='live'){
          const data = await apiCall('get_live_streams', { category_id: getCatId(cat) })
          setItems(toArray(data))
        }else if(type==='vod'){
          const data = await apiCall('get_vod_streams', { category_id: getCatId(cat) })
          setItems(toArray(data))
        }else{ // series -> lista de séries
          const data = await apiCall('get_series', { category_id: getCatId(cat) })
          setItems(toArray(data))
        }
      }catch(err){ setError(err.message) }
      finally{ setLoading(false) }
    }

    // ===== PLAYBACK / CATCH-UP API (MOCK - SUBSTITUIR POR SUA API REAL) =====

    // Retorna os dias que têm gravações disponíveis para um canal
    function getRecordedDays(channelId){
      // TODO: Chamar sua API real
      // Exemplo: GET /api/recordings/days?channel_id=123
      // Por enquanto, retorna últimos 4 dias como mock (3 dias atrás até hoje)
      const days = []
      for(let offset = -3; offset <= 0; offset++){ // -3, -2, -1, 0
        const d = new Date()
        d.setDate(d.getDate() + offset) // + offset porque offset é negativo
        d.setHours(0,0,0,0)
        days.push(d)
      }
      return days
    }

    // Constrói URL de playback para um programa gravado
    function getPlaybackUrl(channelId, startUtc, endUtc){
      if(!channelId || !startUtc) {
        return null
      }

      // Converter timestamps Unix para segundos se necessário
      const start = typeof startUtc === 'number' ? startUtc : parseInt(startUtc)
      const end = endUtc ? (typeof endUtc === 'number' ? endUtc : parseInt(endUtc)) : start + 3600
      const durationInSeconds = end - start
      const durationInMinutes = Math.ceil(durationInSeconds / 60)

      // Converter Unix timestamp para formato YYYY-MM-DD:HH-MM
      // Exemplo: 2025-10-19:02-00
      const startDate = new Date(start * 1000)
      const year = startDate.getFullYear()
      const month = String(startDate.getMonth() + 1).padStart(2, '0')
      const day = String(startDate.getDate()).padStart(2, '0')
      const hours = String(startDate.getHours()).padStart(2, '0')
      const minutes = String(startDate.getMinutes()).padStart(2, '0')
      const dateTimeFormat = `${year}-${month}-${day}:${hours}-${minutes}`

      // URL de timeshift do Xtream Codes
      // Formato real: /timeshift/{username}/{password}/{duration_minutes}/{datetime}/{stream_id}.m3u8
      // Exemplo: http://51.161.13.89/timeshift/testetv22/Heloisa1202eqdeq/75/2025-10-19:02-00/6640.m3u8
      const url = `${cfg.server}/timeshift/${cfg.username}/${cfg.password}/${durationInMinutes}/${dateTimeFormat}/${channelId}.m3u8`

      return url
    }

    // Verifica se um programa está gravado/disponível
    function isProgramRecorded(program, channel, selectedDayOffset){
      // Verificar se o canal tem tv_archive habilitado
      const hasTvArchive = channel && (channel.tv_archive === 1 || channel.tv_archive === "1")

      if(!hasTvArchive){
        return false // Canal não tem playback
      }

      // Apenas programas passados ou atuais podem ser reproduzidos
      // Programas futuros não têm gravação ainda
      if(selectedDayOffset >= -7 && selectedDayOffset <= 0){
        return true // Canal tem playback e programa está disponível (últimos 7 dias)
      }

      return false // Muito antigo ou futuro
    }

    // ===== TV AO VIVO =====
    async function openLiveCategory(cat, switchLeft = true){
      try{
        setLoading(true)
        setSelectedLiveCat(cat)
        const catId = getCatId(cat)
        if(!catId){ setLiveStreams([]); setSelectedChannel(null); setEpg([]); return }
        const data = await apiCall('get_live_streams', { category_id: catId })
        const fullList = toArray(data)

        // Agrupar e pegar apenas canais únicos para exibir no menu
        // ✅ getUniqueChannels agora detecta tv_archive=1 de QUALQUER variante
        const uniqueList = getUniqueChannels(fullList)

        // Usar tv_archive da API Xtream Codes (1 = tem playback, 0 ou null = não tem)
        const uniqueListWithPlayback = uniqueList.map(ch => ({
          ...ch,
          hasPlayback: ch.tv_archive === 1 || ch.tv_archive === "1"
        }))

        setLiveStreams(uniqueListWithPlayback)

        if(uniqueListWithPlayback.length>0){
          const firstChannel = uniqueListWithPlayback[0] // Usar lista COM hasPlayback
          const baseName = firstChannel.baseName


          // Buscar última qualidade preferida para este canal
          const preferredQuality = channelVariants[baseName]
          const variants = getVariantsForChannel(fullList, baseName)

          // Tentar encontrar a qualidade preferida, senão usar o primeiro
          let channelToPlay = variants.find(v => v.quality === preferredQuality) || variants[0] || firstChannel


          // Preservar hasPlayback E tv_archive do firstChannel
          const channelWithArchive = {
            ...channelToPlay,
            baseName,
            allVariants: variants,
            hasPlayback: firstChannel.hasPlayback,
            tv_archive: firstChannel.tv_archive, // Preservar tv_archive original
            playback_url: null, // Sempre iniciar no vivo
            playback_mode: false,
            // ✅ Manter referência ao item da lista
            listItemId: firstChannel.stream_id || firstChannel.id
          }

          setSelectedChannel(channelWithArchive)
          await loadEpg(channelToPlay.stream_id || channelToPlay.id, 0) // 0 = hoje ao abrir categoria
        }else{
          setSelectedChannel(null); setEpg([])
        }
        if(switchLeft) setLiveLeftMode('channels')
      }catch(err){ setError(err.message); setLiveStreams([]) }
      finally{ setLoading(false) }
    }

    async function loadEpg(streamId, dateOffset = 0){
      try{
        // Calcular a data alvo baseada no offset
        const targetDate = new Date()
        targetDate.setDate(targetDate.getDate() + dateOffset)
        targetDate.setHours(0, 0, 0, 0)

        // Buscar EPG usando get_simple_data_table que suporta busca por data
        // Formato da data: YYYY-MM-DD
        const dateStr = targetDate.toISOString().split('T')[0]

        let data
        if(dateOffset === 0){
          // Hoje: usar get_short_epg (mais rápido)
          data = await apiCall('get_short_epg', { stream_id: streamId, limit: 100 })
        } else {
          // Outros dias: usar get_simple_data_table com data específica
          data = await apiCall('get_simple_data_table', {
            stream_id: streamId,
            type: 'live'
          })
        }

        const list = Array.isArray(data) ? data : (data && Array.isArray(data.epg_listings) ? data.epg_listings : [])

        if(!list || list.length === 0){
          setEpg([])
          return
        }

        const norm = toArray(list).map((it,idx)=>{
          // Pegar o título de vários campos possíveis
          const rawTitle = it.title || it.name || it.has_archive || ''
          const rawDesc = it.description || it.desc || ''

          // Decodificar base64 + HTML entities
          const decodedTitle = decodeEpgText(rawTitle)
          const decodedDesc = decodeEpgText(rawDesc)

          // Tentar pegar horários de vários campos possíveis
          const startTime = it.start || it.start_time || it.start_timestamp
          const endTime = it.end || it.end_time || it.stop_timestamp || it.end_timestamp || it.stop

          return {
            id: it.id || it.event_id || idx,
            title: decodedTitle || 'Sem programação disponível',
            start: formatEPGTime(startTime),
            end: formatEPGTime(endTime),
            description: decodedDesc,
            // Preservar timestamps originais para playback
            start_timestamp: it.start_timestamp || startTime,
            stop_timestamp: it.stop_timestamp || it.end_timestamp || endTime
          }
        })

        // FILTRAR apenas programas do dia selecionado
        const filtered = norm.filter(prog => {
          if(!prog.start_timestamp) return true // Se não tem timestamp, incluir

          const progDate = new Date(prog.start_timestamp * 1000)
          progDate.setHours(0, 0, 0, 0)

          const isSameDay = progDate.getTime() === targetDate.getTime()

          return dateOffset === 0 || isSameDay // Se é hoje, pega tudo. Senão, filtra por dia
        })

        // Ordenar EPG por horário (do mais antigo ao mais recente)
        filtered.sort((a, b) => {
          const timeA = a.start_timestamp || 0
          const timeB = b.start_timestamp || 0
          return timeA - timeB
        })

        setEpg(filtered)
      }catch(err){
        setEpg([])
      }
    }

    async function playStream(item){
      try{
        let url = ''
        let isHls = false
        const id = item.stream_id || item.series_id || item.id

        if(selectedCat?.type==='live'){
          url = buildURL(cfg.server, ['live', cfg.username, cfg.password, id + '.m3u8'])
          isHls = true
        }else if(selectedCat?.type==='vod'){
          const ext = (item.container_extension || 'mp4').replace(/\.+/,'')
          url = buildURL(cfg.server, ['movie', cfg.username, cfg.password, id + '.' + ext])
          isHls = /m3u8/i.test(ext)
        }else{ // séries: precisamos buscar episódios primeiro
          const sInfo = await apiCallSeriesInfo(id)
          const seasons = (sInfo.episodes && typeof sInfo.episodes === 'object') ? sInfo.episodes : {}
          const firstSeason = Object.keys(seasons).sort((a,b)=>Number(a)-Number(b))[0]
          const eps = seasons[firstSeason] || []
          const ep = eps[0]
          if(!ep) throw new Error('Sem episódios disponíveis para esta série')
          const epId = ep.id || ep.episode_id || ep.stream_id || id
          const ext = (ep.container_extension || 'mp4').replace(/\.+/,'')
          url = buildURL(cfg.server, ['series', cfg.username, cfg.password, epId + '.' + ext])
          isHls = /m3u8/i.test(ext)
        }
        setCurrent({ name: item.name || item.title || 'Reprodução', url, isHls })
        setView('player')
      }catch(err){ setError(err.message) }
    }

    const filtered = useMemo(()=>{
      const q = query.trim().toLowerCase()
      if(!q) return items
      return items.filter(it=> (it.name||it.title||'').toLowerCase().includes(q))
    }, [items, query])

    // ===== UI =====
    // TopBar removido - layout fullscreen sem barra superior
    function TopBar(){
      return null // Retorna null para ocultar completamente a barra superior
    }

// ===== NOVA HOME MODERNA ESTILO NETFLIX =====
// Esta é a nova versão da função Home() para substituir a atual no index.php

function Home(){
  const [topMovies, setTopMovies] = useState([])
  const [topSeries, setTopSeries] = useState([])
  const [loading, setLoading] = useState(true)

  // Buscar Top 10 Filmes e Séries do TMDB
  useEffect(() => {
    const fetchTopContent = async () => {
      try {
        const tmdbKey = '7e61dfdf698b31e14082e80a0ca9f9fa'

        // Buscar filmes populares
        const moviesRes = await fetch(`https://api.themoviedb.org/3/movie/popular?api_key=${tmdbKey}&language=pt-BR&page=1`)
        const moviesData = await moviesRes.json()
        setTopMovies(moviesData.results.slice(0, 10))

        // Buscar séries populares
        const seriesRes = await fetch(`https://api.themoviedb.org/3/tv/popular?api_key=${tmdbKey}&language=pt-BR&page=1`)
        const seriesData = await seriesRes.json()
        setTopSeries(seriesData.results.slice(0, 10))

        setLoading(false)
      } catch(err) {
        setLoading(false)
      }
    }

    fetchTopContent()
  }, [])

  if(loading) {
    return e('div', {
      style: {
        minHeight: '100vh',
        background: '#141414',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        color: '#fff'
      }
    }, 'Carregando...')
  }

  return e('div', {
    style: {
      minHeight: '100vh',
      background: '#141414',
      width: '100%',
      paddingTop: '40px',
      paddingBottom: '40px'
    }
  },
    // Top 10 Filmes
    e('div', {
      style: {
        marginBottom: '60px',
        paddingLeft: '40px'
      }
    },
      e('h2', {
        style: {
          color: '#fff',
          fontSize: '28px',
          fontWeight: 'bold',
          marginBottom: '25px'
        }
      }, 'Top 10 filmes hoje'),

      // Container do carrossel com botões
      e('div', {
        style: {
          position: 'relative',
          paddingRight: '40px'
        }
      },
        // Carrossel de filmes
        e('div', {
          id: 'movies-carousel',
          style: {
            display: 'flex',
            gap: '4px',
            overflowX: 'scroll',
            scrollBehavior: 'smooth',
            paddingBottom: '10px',
            scrollbarWidth: 'none',
            msOverflowStyle: 'none'
          }
        },
          ...topMovies.map((movie, index) =>
            e('div', {
              key: movie.id,
              style: {
                display: 'flex',
                alignItems: 'flex-end',
                flexShrink: 0,
                cursor: 'pointer',
                position: 'relative'
              }
            },
              // Número grande à esquerda
              e('div', {
                style: {
                  fontSize: '280px',
                  fontWeight: '900',
                  color: '#000',
                  WebkitTextStroke: '3px #464646',
                  lineHeight: '0.75',
                  marginRight: '-45px',
                  zIndex: 1,
                  fontFamily: 'Arial, sans-serif'
                }
              }, (index + 1).toString()),

              // Container do poster
              e('div', {
                style: {
                  position: 'relative',
                  zIndex: 2
                }
              },
                // Poster do filme
                e('img', {
                  src: movie.poster_path
                    ? `https://image.tmdb.org/t/p/w500${movie.poster_path}`
                    : 'https://via.placeholder.com/200x300/333/fff?text=Sem+Imagem',
                  alt: movie.title,
                  style: {
                    width: '200px',
                    height: '300px',
                    objectFit: 'cover',
                    borderRadius: '4px',
                    transition: 'transform 0.2s'
                  },
                  onMouseEnter: (e) => e.target.style.transform = 'scale(1.05)',
                  onMouseLeave: (e) => e.target.style.transform = 'scale(1)'
                }),

                // Badge "Novidade" (nos primeiros 3)
                index < 3 && e('div', {
                  style: {
                    position: 'absolute',
                    top: '8px',
                    left: '0',
                    right: '0',
                    margin: '0 auto',
                    background: '#e50914',
                    color: '#fff',
                    padding: '3px 8px',
                    borderRadius: '3px',
                    fontSize: '11px',
                    fontWeight: 'bold',
                    textAlign: 'center',
                    width: 'fit-content'
                  }
                }, 'Novidade')
              )
            )
          )
        ),

        // Botão anterior
        e('button', {
          onClick: () => {
            const carousel = document.getElementById('movies-carousel')
            carousel.scrollLeft -= 400
          },
          style: {
            position: 'absolute',
            left: '0',
            top: '50%',
            transform: 'translateY(-50%)',
            background: 'rgba(0, 0, 0, 0.7)',
            border: 'none',
            color: '#fff',
            fontSize: '30px',
            width: '50px',
            height: '100px',
            cursor: 'pointer',
            zIndex: 10,
            borderRadius: '0 4px 4px 0',
            opacity: 0.8,
            transition: 'opacity 0.2s'
          },
          onMouseEnter: (e) => e.target.style.opacity = '1',
          onMouseLeave: (e) => e.target.style.opacity = '0.8'
        }, '‹'),

        // Botão próximo
        e('button', {
          onClick: () => {
            const carousel = document.getElementById('movies-carousel')
            carousel.scrollLeft += 400
          },
          style: {
            position: 'absolute',
            right: '40px',
            top: '50%',
            transform: 'translateY(-50%)',
            background: 'rgba(0, 0, 0, 0.7)',
            border: 'none',
            color: '#fff',
            fontSize: '30px',
            width: '50px',
            height: '100px',
            cursor: 'pointer',
            zIndex: 10,
            borderRadius: '4px 0 0 4px',
            opacity: 0.8,
            transition: 'opacity 0.2s'
          },
          onMouseEnter: (e) => e.target.style.opacity = '1',
          onMouseLeave: (e) => e.target.style.opacity = '0.8'
        }, '›')
      )
    ),

    // Top 10 Séries
    e('div', {
      style: {
        paddingLeft: '40px'
      }
    },
      e('h2', {
        style: {
          color: '#fff',
          fontSize: '28px',
          fontWeight: 'bold',
          marginBottom: '25px'
        }
      }, 'Top 10 séries hoje'),

      // Container do carrossel com botões
      e('div', {
        style: {
          position: 'relative',
          paddingRight: '40px'
        }
      },
        // Carrossel de séries
        e('div', {
          id: 'series-carousel',
          style: {
            display: 'flex',
            gap: '4px',
            overflowX: 'scroll',
            scrollBehavior: 'smooth',
            paddingBottom: '10px',
            scrollbarWidth: 'none',
            msOverflowStyle: 'none'
          }
        },
          ...topSeries.map((serie, index) =>
            e('div', {
              key: serie.id,
              style: {
                display: 'flex',
                alignItems: 'flex-end',
                flexShrink: 0,
                cursor: 'pointer',
                position: 'relative'
              }
            },
              // Número grande à esquerda
              e('div', {
                style: {
                  fontSize: '280px',
                  fontWeight: '900',
                  color: '#000',
                  WebkitTextStroke: '3px #464646',
                  lineHeight: '0.75',
                  marginRight: '-45px',
                  zIndex: 1,
                  fontFamily: 'Arial, sans-serif'
                }
              }, (index + 1).toString()),

              // Container do poster
              e('div', {
                style: {
                  position: 'relative',
                  zIndex: 2
                }
              },
                // Poster da série
                e('img', {
                  src: serie.poster_path
                    ? `https://image.tmdb.org/t/p/w500${serie.poster_path}`
                    : 'https://via.placeholder.com/200x300/333/fff?text=Sem+Imagem',
                  alt: serie.name,
                  style: {
                    width: '200px',
                    height: '300px',
                    objectFit: 'cover',
                    borderRadius: '4px',
                    transition: 'transform 0.2s'
                  },
                  onMouseEnter: (e) => e.target.style.transform = 'scale(1.05)',
                  onMouseLeave: (e) => e.target.style.transform = 'scale(1)'
                }),

                // Badge "Novidade" (nos primeiros 3)
                index < 3 && e('div', {
                  style: {
                    position: 'absolute',
                    top: '8px',
                    left: '0',
                    right: '0',
                    margin: '0 auto',
                    background: '#e50914',
                    color: '#fff',
                    padding: '3px 8px',
                    borderRadius: '3px',
                    fontSize: '11px',
                    fontWeight: 'bold',
                    textAlign: 'center',
                    width: 'fit-content'
                  }
                }, 'Novidade')
              )
            )
          )
        ),

        // Botão anterior
        e('button', {
          onClick: () => {
            const carousel = document.getElementById('series-carousel')
            carousel.scrollLeft -= 400
          },
          style: {
            position: 'absolute',
            left: '0',
            top: '50%',
            transform: 'translateY(-50%)',
            background: 'rgba(0, 0, 0, 0.7)',
            border: 'none',
            color: '#fff',
            fontSize: '30px',
            width: '50px',
            height: '100px',
            cursor: 'pointer',
            zIndex: 10,
            borderRadius: '0 4px 4px 0',
            opacity: 0.8,
            transition: 'opacity 0.2s'
          },
          onMouseEnter: (e) => e.target.style.opacity = '1',
          onMouseLeave: (e) => e.target.style.opacity = '0.8'
        }, '‹'),

        // Botão próximo
        e('button', {
          onClick: () => {
            const carousel = document.getElementById('series-carousel')
            carousel.scrollLeft += 400
          },
          style: {
            position: 'absolute',
            right: '40px',
            top: '50%',
            transform: 'translateY(-50%)',
            background: 'rgba(0, 0, 0, 0.7)',
            border: 'none',
            color: '#fff',
            fontSize: '30px',
            width: '50px',
            height: '100px',
            cursor: 'pointer',
            zIndex: 10,
            borderRadius: '4px 0 0 4px',
            opacity: 0.8,
            transition: 'opacity 0.2s'
          },
          onMouseEnter: (e) => e.target.style.opacity = '1',
          onMouseLeave: (e) => e.target.style.opacity = '0.8'
        }, '›')
      )
    )
  )
}


    function Categories(){
      const isLive = view==='live-categories'
      const [focusedCatIdx, setFocusedCatIdx] = useState(0)
      const [focusedChannelIdx, setFocusedChannelIdx] = useState(0)
      const [isFavorite, setIsFavorite] = useState(false)

      // Verificar se canal selecionado está nos favoritos
      useEffect(() => {
        if (!selectedChannel?.stream_id && !selectedChannel?.id) {
          setIsFavorite(false)
          return
        }
        const channelId = selectedChannel.stream_id || selectedChannel.id
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
        const isFav = !!favorites[channelId]
        setIsFavorite(isFav)
      }, [selectedChannel?.stream_id, selectedChannel?.id])

      // Toggle favorito
      const toggleFavorite = () => {
        if (!selectedChannel?.stream_id && !selectedChannel?.id) return

        const channelId = selectedChannel.stream_id || selectedChannel.id
        const newState = !isFavorite
        setIsFavorite(newState)

        // Salvar/remover do localStorage
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')

        if (newState) {
          // Adicionar aos favoritos
          favorites[channelId] = {
            stream_id: channelId,
            num: selectedChannel.num,
            name: selectedChannel.name,
            stream_icon: selectedChannel.stream_icon,
            stream_url: selectedChannel.stream_url || selectedChannel.url,
            category_id: selectedChannel.category_id,
            addedAt: Date.now()
          }
        } else {
          // Remover dos favoritos
          delete favorites[channelId]
        }

        localStorage.setItem('dreamtv_favorites', JSON.stringify(favorites))

        // Notificar sistema para atualizar lista se estiver na categoria favoritos
        window.dispatchEvent(new CustomEvent('favorites-updated'))
      }

      // Helper: Decodificar Base64 se necessário (títulos EPG podem vir codificados)
      const decodeMaybeBase64 = (str) => {
        if(!str || typeof str !== 'string') return 'Sem título'

        // Se já parece texto normal (tem espaços, acentos, letras), retorna direto
        if(/[\s\u00C0-\u00FF]/.test(str) || !/[A-Za-z0-9+/=]/.test(str)){
          return str
        }

        // ESTRATÉGIA 1: Tentar decodificar Base64 simples
        try {
          const decoded = atob(str)
          // Verificar se é texto válido UTF-8
          if(decoded && /^[\x20-\x7E\u00C0-\u00FF]+$/.test(decoded)){
            return decoded
          }

          // ESTRATÉGIA 2: Tentar converter bytes para UTF-8 corretamente
          try {
            const utf8Decoded = decodeURIComponent(escape(decoded))
            if(utf8Decoded && utf8Decoded.length > 0 && !/[\x00-\x1F]/.test(utf8Decoded)){
              return utf8Decoded
            }
          } catch(e2) {
            // Falhou UTF-8, tenta próxima estratégia
          }

          // ESTRATÉGIA 3: Dupla decodificação Base64
          try {
            const doubleDecoded = atob(decoded)
            if(doubleDecoded && /^[\x20-\x7E\u00C0-\u00FF]+$/.test(doubleDecoded)){
              return doubleDecoded
            }
          } catch(e3) {
            // Falhou dupla decodificação
          }

          // Se passou por atob() mas não validou, retorna original
          return str

        } catch(e) {
          // Não é Base64 válido, retorna original
          return str
        }
      }

      // Helper: Detectar se um programa EPG está "NO AR AGORA"
      const isProgramCurrent = (prog) => {
        if(!prog || !prog.start || !prog.end) return false
        try {
          const now = new Date()
          const currentMinutes = now.getHours() * 60 + now.getMinutes()

          // Parse start time (formato: "HH:mm")
          const startParts = prog.start.split(':')
          const startMinutes = parseInt(startParts[0]) * 60 + parseInt(startParts[1])

          // Parse end time (formato: "HH:mm")
          const endParts = prog.end.split(':')
          const endMinutes = parseInt(endParts[0]) * 60 + parseInt(endParts[1])

          // Programa atual está entre start e end
          return currentMinutes >= startMinutes && currentMinutes < endMinutes
        } catch(e) {
          return false
        }
      }

      // Atalhos de teclado para navegação em categorias e canais
      useEffect(()=>{
        if(!isLive) return

        const handleKeyDown = (e)=>{
          // Navegação nas CATEGORIAS
          if(liveLeftMode==='categories' && liveCats.length>0){
            if(e.key==='ArrowDown'){
              e.preventDefault()
              setFocusedCatIdx(prev=> Math.min(prev + 1, liveCats.length - 1))
            }else if(e.key==='ArrowUp'){
              e.preventDefault()
              setFocusedCatIdx(prev=> Math.max(prev - 1, 0))
            }else if(e.key==='ArrowRight' || e.key==='Enter'){
              e.preventDefault()
              const cat = liveCats[focusedCatIdx]
              if(cat){
                setFocusedChannelIdx(0) // ✅ Reset foco ao abrir categoria
                openLiveCategory(cat, true)
              }
            }else if(e.key==='ArrowLeft' || e.key==='Escape'){
              e.preventDefault()
              setView('home')
            }
          }
          // Navegação nos CANAIS
          else if(liveLeftMode==='channels' && liveStreams.length>0){
            if(e.key==='ArrowDown'){
              e.preventDefault()
              setFocusedChannelIdx(prev=> Math.min(prev + 1, liveStreams.length - 1))
            }else if(e.key==='ArrowUp'){
              e.preventDefault()
              setFocusedChannelIdx(prev=> Math.max(prev - 1, 0))
            }else if(e.key==='Enter'){
              e.preventDefault()
              const channel = liveStreams[focusedChannelIdx]
              if(channel){
                // Carregar variantes para este canal
                const loadChannelWithVariants = async ()=>{
                  try{
                    const catId = getCatId(selectedLiveCat)
                    const data = await apiCall('get_live_streams', { category_id: catId })
                    const fullList = toArray(data)
                    const baseName = channel.baseName
                    const variants = getVariantsForChannel(fullList, baseName)

                    // Buscar qualidade preferida
                    const preferredQuality = channelVariants[baseName]
                    let channelToPlay = variants.find(v => v.quality === preferredQuality) || variants[0] || channel

                    // Preservar hasPlayback e tv_archive do canal original
                    // ✅ LIMPAR playback_url ao trocar de canal (volta ao vivo)
                    setSelectedChannel({
                      ...channelToPlay,
                      baseName,
                      allVariants: variants,
                      hasPlayback: channel.hasPlayback,
                      tv_archive: channel.tv_archive,
                      playback_url: null, // Limpa playback ao trocar canal
                      playback_mode: false,
                      // ✅ Manter referência ao item da lista
                      listItemId: channel.stream_id || channel.id
                    })
                    await loadEpg(channelToPlay.stream_id || channelToPlay.id, selectedDay)

                    // ⚠️ FULLSCREEN AUTOMÁTICO DESABILITADO - usuário controla via botão F
                    // setTimeout(()=>{
                    //   const container = document.getElementById('playerContainer')
                    //   if(container && !document.fullscreenElement){
                    //     container.requestFullscreen().catch(()=>{})
                    //   }
                    // }, 500)
                  }catch(err){
                    setSelectedChannel({
                      ...channel,
                      listItemId: channel.stream_id || channel.id
                    })
                    loadEpg(channel.stream_id||channel.id, selectedDay)
                  }
                }
                loadChannelWithVariants()
              }
            }else if(e.key==='ArrowLeft'){
              e.preventDefault()
              if(focusedChannelIdx === 0){
                // Se estiver no primeiro canal, volta para categorias
                setLiveLeftMode('categories')
                setFocusedChannelIdx(0)
              }
            }else if(e.key==='Escape'){
              e.preventDefault()
              // ESC sempre volta para categorias
              setLiveLeftMode('categories')
              setFocusedChannelIdx(0)
            }
          }
        }

        window.addEventListener('keydown', handleKeyDown)
        return ()=> window.removeEventListener('keydown', handleKeyDown)
      }, [isLive, liveLeftMode, liveCats, liveStreams, focusedCatIdx, focusedChannelIdx])

      // Scroll automático para item focado (APENAS dentro do container, sem afetar a página)
      useEffect(()=>{
        if(liveLeftMode==='categories' && liveCats.length>0){
          const cat = liveCats[focusedCatIdx]
          if(cat){
            const el = document.getElementById('cat-' + getCatId(cat))
            if(el && el.parentElement){
              const container = el.parentElement

              // Calcular posições relativas ao container
              const elOffsetTop = el.offsetTop
              const elOffsetBottom = elOffsetTop + el.offsetHeight
              const containerScrollTop = container.scrollTop
              const containerHeight = container.clientHeight

              // Rolar apenas se necessário
              if(elOffsetBottom > containerScrollTop + containerHeight){
                // Elemento está abaixo da área visível
                container.scrollTo({ top: elOffsetBottom - containerHeight, behavior:'smooth' })
              }else if(elOffsetTop < containerScrollTop){
                // Elemento está acima da área visível
                container.scrollTo({ top: elOffsetTop, behavior:'smooth' })
              }
            }
          }
        }else if(liveLeftMode==='channels' && liveStreams.length>0){
          const ch = liveStreams[focusedChannelIdx]
          if(ch){
            const el = document.getElementById('channel-' + (ch.stream_id||ch.id))
            if(el && el.parentElement){
              const container = el.parentElement

              // Calcular posições relativas ao container
              const elOffsetTop = el.offsetTop
              const elOffsetBottom = elOffsetTop + el.offsetHeight
              const containerScrollTop = container.scrollTop
              const containerHeight = container.clientHeight

              // Rolar apenas se necessário
              if(elOffsetBottom > containerScrollTop + containerHeight){
                // Elemento está abaixo da área visível
                container.scrollTo({ top: elOffsetBottom - containerHeight, behavior:'smooth' })
              }else if(elOffsetTop < containerScrollTop){
                // Elemento está acima da área visível
                container.scrollTo({ top: elOffsetTop, behavior:'smooth' })
              }
            }
          }
        }
      }, [focusedCatIdx, focusedChannelIdx, liveLeftMode])

      // Reset índices ao trocar modo
      useEffect(()=>{
        if(liveLeftMode==='categories') setFocusedCatIdx(0)
        else setFocusedChannelIdx(0)
      }, [liveLeftMode])

      if(isLive){
        const totalAll = liveAllCount || (liveCats||[]).reduce((acc,c)=> acc + (Number(c.total)||0), 0)
        return e('div', { className:'star-bg h-screen p-4 md:p-6 relative overflow-hidden flex flex-col' },
          e(TopBar),
          e('div', { className:'grid grid-cols-12 gap-4 flex-1 overflow-hidden' },
            // Esquerda: categorias ou canais
            e('div', { className:'col-span-12 md:col-span-3 flex flex-col h-full overflow-hidden' },
              e('button', {
                className:'w-full frost rounded-lg px-4 py-3 flex items-center justify-between cursor-pointer transition-all hover:border-purple-400/40 mb-3 sticky top-0 z-10',
                onClick:()=> setLiveLeftMode('categories')
              },
                e('div', {
                  className:'flex items-center gap-3 text-white font-semibold',
                  style: { pointerEvents: 'none' }
                },
                  e('span', { className:'text-xl' }, '▦'),
                  liveLeftMode==='categories' ? 'Todos' : (selectedLiveCat?.category_name || 'Categoria')
                ),
                e('span', {
                  className:'text-gray-300 font-bold',
                  style: { pointerEvents: 'none' }
                }, String(liveLeftMode==='categories' ? totalAll : (liveStreams?.length||0)))
              ),
              error && e('div', { className:'text-red-300 text-xs mb-3' }, 'Live: ', error),
              liveLeftMode==='categories' ?
                e('div', {
                  className:'overflow-y-auto flex-1 space-y-3 pr-2 pb-20',
                  onWheel: (e) => {
                    // Permitir scroll vertical natural com mouse wheel
                    // Não fazer preventDefault para que o scroll funcione normalmente
                  }
                },
                  // Categoria Favoritos (sempre primeiro)
                  (() => {
                    const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
                    const favCount = Object.keys(favorites).length
                    const isFavSelected = selectedLiveCat?.category_id === 'favoritos'

                    return e('button', {
                      key:'favoritos',
                      id: 'cat-favoritos',
                      onClick:()=> {
                        setFocusedCatIdx(-1)
                        setFocusedChannelIdx(0)
                        // Criar uma categoria virtual "Favoritos"
                        const favoriteChannels = Object.values(favorites)
                        setSelectedLiveCat({ category_id: 'favoritos', category_name: '⭐ Favoritos', total: favCount })
                        setLiveStreams(favoriteChannels)
                        setLiveLeftMode('channels')
                        if(favoriteChannels.length > 0) {
                          setSelectedChannel(favoriteChannels[0])
                          loadEpg(favoriteChannels[0].stream_id || favoriteChannels[0].id, selectedDay)
                        }
                      },
                      className:'w-full rounded-lg px-4 py-3 text-left frost hover:border-purple-400/40 transition-all cursor-pointer ' + (isFavSelected ? 'border-2 border-white/80 bg-white/10 text-white' : 'text-white/90')
                    },
                      e('div', {
                        className:'flex items-center justify-between',
                        style: { pointerEvents: 'none' }
                      },
                        e('div', { className:'flex items-center gap-2' },
                          e('span', { className:'text-lg' }, '⭐'),
                          e('span', { className:'truncate font-semibold' }, 'Favoritos')
                        ),
                        e('span', { className:'opacity-80 ml-3' }, String(favCount))
                      )
                    )
                  })(),
                  toArray(liveCats).map((cat, idx)=> {
                    const catId = getCatId(cat)
                    const count = (liveCounts && liveCounts[String(catId)]) ?? cat.total ?? 0
                    const isFocused = idx === focusedCatIdx
                    const isSelected = selectedLiveCat && getCatId(selectedLiveCat)===catId
                    return e('button', {
                      key:catId||cat.category_name,
                      id: 'cat-' + catId,
                      onClick:()=>{ setFocusedCatIdx(idx); setFocusedChannelIdx(0); openLiveCategory(cat, true) },
                      className:'w-full rounded-lg px-4 py-3 text-left frost hover:border-purple-400/40 transition-all cursor-pointer ' + (isSelected || isFocused ? ' border-2 border-white/80 bg-white/10 text-white' : ' text-white/90')
                    },
                      e('div', {
                        className:'flex items-center justify-between',
                        style: { pointerEvents: 'none' } // Permite clicks em toda a área do button
                      },
                        e('span', { className:'truncate font-semibold' }, cat.category_name||'Sem nome'),
                        e('span', { className:'opacity-80 ml-3' }, String(count))
                      )
                    )
                  }),
                  e('div', { className:'text-center text-xs text-gray-400 mt-3 py-2' }, '↑↓ Navegar | → Enter Abrir | ← ESC Voltar')
                )
              :
                e('div', {
                  className:'overflow-y-auto flex-1 space-y-3 pr-2 pb-20',
                  onWheel: (e) => {
                    // Permitir scroll vertical natural com mouse wheel
                    // Não fazer preventDefault para que o scroll funcione normalmente
                  }
                },
                  toArray(liveStreams).map((item, idx)=> {
                      const key = item.stream_id || item.id || item.name
                      const isFocused = idx === focusedChannelIdx

                    // ✅ Comparar por listItemId para destaque correto
                    const itemId = item.stream_id || item.id
                    const isSel = selectedChannel && selectedChannel.listItemId && itemId && (selectedChannel.listItemId === itemId)

                    const handleChannelClick = async ()=>{
                      // ✅ Atualizar foco do teclado para o canal clicado
                      setFocusedChannelIdx(idx)

                      // Carregar variantes
                      try{
                        const catId = getCatId(selectedLiveCat)
                        const data = await apiCall('get_live_streams', { category_id: catId })
                        const fullList = toArray(data)
                        const baseName = item.baseName
                        const variants = getVariantsForChannel(fullList, baseName)
                        const preferredQuality = channelVariants[baseName]
                        let channelToPlay = variants.find(v => v.quality === preferredQuality) || variants[0] || item

                        // Preservar hasPlayback E tv_archive do item original
                        const channelWithArchive = {
                          ...channelToPlay,
                          baseName,
                          allVariants: variants,
                          hasPlayback: item.hasPlayback,
                          tv_archive: item.tv_archive,
                          // ✅ Manter referência ao item clicado na lista (para destacar correto)
                          listItemId: item.stream_id || item.id
                        }

                        setSelectedChannel(channelWithArchive)
                        await loadEpg(channelToPlay.stream_id || channelToPlay.id, selectedDay)
                      }catch(err){
                        // Em caso de erro, usar o item diretamente
                        setSelectedChannel({
                          ...item,
                          listItemId: item.stream_id || item.id
                        })
                        loadEpg(item.stream_id||item.id, selectedDay)
                      }
                    }

                    const handleChannelDoubleClick = ()=>{
                      // Abrir em tela cheia
                      setTimeout(()=>{
                        const container = document.getElementById('playerContainer')
                        if(container && !document.fullscreenElement){
                          container.requestFullscreen().catch(()=>{})
                        }
                      }, 300)
                    }

                    return e('button', {
                      key,
                      id: 'channel-' + (item.stream_id||item.id),
                      onClick: handleChannelClick,
                      onDoubleClick: handleChannelDoubleClick,
                      // ✅ CORRIGIDO: Apenas isSel para destaque de seleção
                      className:'w-full rounded-lg px-3 py-3 text-left frost hover:border-purple-400/40 transition-all ' + (isSel || isFocused ? ' border-2 border-white/80 bg-white/10 text-white' : ' text-white/90')
                    },
                      e('div', { className:'flex items-center gap-3' },
                        // ID removido - mostrar apenas logo e nome
                        item.stream_icon ? e('img', { src:item.stream_icon, className:'w-8 h-8 object-contain rounded', alt:'' }) : e('div', { className:'w-8 h-8 rounded bg-zinc-600 grid place-items-center text-xs' }, 'TV'),
                        e('div', { className:'flex-1 truncate font-semibold' }, item.baseName || item.name || 'Sem título'),
                        // Badge FAV dourada se canal está nos favoritos
                        (() => {
                          const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
                          const channelId = item.stream_id || item.id
                          return favorites[channelId] && e('div', {
                            className: 'px-2 py-[2px] rounded text-[11px] font-bold',
                            style: { backgroundColor: '#FFD700', color: '#000000' }
                          }, '★')
                        })(),
                        // Badge REC vermelho se canal tem playback
                        item.hasPlayback && e('div', {
                          className: 'px-2 py-[2px] rounded text-[11px] font-bold',
                          style: { backgroundColor: '#DC2626', color: '#FFFFFF' }
                        }, 'REC')
                      )
                    )
                  }),
                  e('div', { className:'text-center text-xs text-gray-400 mt-3 py-2' }, '↑↓ Navegar | Enter Tela Cheia | 2× Clique Tela Cheia | ← ESC Voltar')
                )
            ),
            // Centro: player + info + EPG
            e('div', { className:'col-span-12 md:col-span-6 space-y-3' },
              e('div', { className:'relative rounded-lg overflow-hidden bg-black aspect-video frost' },
                e(LiveVideo, { channel:selectedChannel, epg:epg, onDbl:()=>toggleFullscreen('#liveVideo'), type: 'live', isFavorite: isFavorite, toggleFavorite: toggleFavorite })
              ),
              e('div', { className:'space-y-2 max-h-[500px] overflow-y-auto scrollbar-hide pr-2 pb-4' },
                (epg && epg.length>0 ? epg : Array.from({length:4}).map((_,i)=>({ id:'empty'+i, title:'Programa não encontrado', start:'--:--', end:'--:--' }))).map((pg,i)=>{
                  // Determinar se é passado, atual ou futuro usando TIMESTAMPS (mais preciso)
                  const now = new Date()
                  const startTime = pg.start_timestamp ? new Date(pg.start_timestamp * 1000) : null
                  const endTime = pg.stop_timestamp ? new Date(pg.stop_timestamp * 1000) : null

                  let isCurrent = false
                  let isPast = false
                  let isFuture = false

                  if (startTime && endTime) {
                    // Verificar se programa está AO VIVO AGORA
                    if (now >= startTime && now < endTime) {
                      isCurrent = true
                    } else if (now >= endTime) {
                      isPast = true
                    } else if (now < startTime) {
                      isFuture = true
                    }
                  } else {
                    // Fallback: usar função antiga baseada em HH:mm
                    isCurrent = isProgramCurrent(pg)
                    if (!isCurrent) {
                      isPast = false
                      isFuture = true
                    }
                  }

                  const isRecorded = isProgramRecorded(pg, selectedChannel, selectedDay)

                  // Formatar horários usando formatEPGTime
                  const startFormatted = formatEPGTime(pg.start_timestamp || pg.start)
                  const endFormatted = formatEPGTime(pg.stop_timestamp || pg.end)

                  // Decodificar título (Base64 se necessário)
                  const programTitle = decodeMaybeBase64(pg.title) || 'Programa não encontrado'

                  // 3 ESTADOS VISUAIS:
                  // 1. ATUAL (ao vivo agora) → texto VERDE + bolinha verde preenchida
                  // 2. PASSADO → texto cinza claro + bolinha branca vazia
                  // 3. FUTURO → texto cinza escuro + bolinha branca vazia
                  // 4. EM PLAYBACK → texto roxo + bolinha roxa preenchida

                  let textColor, dotStyle, isClickable, cursorClass, borderColor

                  // Verificar se este programa está sendo reproduzido em playback
                  const isPlayingPlayback = selectedChannel?.playback_mode && selectedChannel?.playback_program === pg.title

                  if(isPlayingPlayback){
                    // EM PLAYBACK - ASSISTINDO GRAVAÇÃO (ROXO BRILHANTE)
                    textColor = 'text-purple-400'
                    dotStyle = 'bg-purple-400' // Bolinha roxa preenchida e brilhante
                    borderColor = 'border-purple-400/40'
                    isClickable = true
                    cursorClass = 'cursor-pointer hover:bg-purple-400/10'
                  } else if(isCurrent){
                    // ATUAL - AO VIVO AGORA (VERDE BRILHANTE)
                    textColor = 'text-green-400'
                    dotStyle = 'bg-green-400' // Bolinha verde preenchida e brilhante
                    borderColor = 'border-green-400/40'
                    isClickable = isRecorded
                    cursorClass = isRecorded ? 'cursor-pointer hover:bg-green-400/10' : 'cursor-default'
                  } else if(isPast){
                    // PASSADO
                    textColor = 'text-slate-400'
                    dotStyle = 'border-2 border-slate-400' // Bolinha vazia
                    borderColor = 'border-slate-700'
                    isClickable = isRecorded
                    cursorClass = isRecorded ? 'cursor-pointer hover:bg-white/5' : 'cursor-default'
                  } else {
                    // FUTURO
                    textColor = 'text-slate-500'
                    dotStyle = 'border-2 border-slate-500' // Bolinha vazia
                    borderColor = 'border-slate-700'
                    isClickable = false
                    cursorClass = 'cursor-default'
                  }

                  const handleClick = ()=>{
                    // Se clicar no programa ATUAL (verde), volta ao vivo
                    if(isCurrent && selectedChannel?.playback_mode){
                      setSelectedChannel({
                        ...selectedChannel,
                        playback_url: null,
                        playback_mode: false,
                        playback_program: null
                      })
                      return
                    }

                    if(!isClickable) {
                      return
                    }

                    // Abrir playback do programa gravado
                    const channelId = selectedChannel?.stream_id || selectedChannel?.id
                    const startUtc = pg.start_timestamp || pg.start
                    const endUtc = pg.stop_timestamp || pg.end
                    const url = getPlaybackUrl(channelId, startUtc, endUtc)

                    if(url){
                      // ✅ Tocar playback no MESMO player do live (não muda de view)
                      setSelectedChannel({
                        ...selectedChannel,
                        playback_url: url, // Define URL de playback
                        playback_mode: true,
                        playback_program: pg.title
                      })
                    }
                  }

                  return e('div', {
                    key:pg.id||i,
                    onClick: handleClick,
                    className:`px-3 py-3 flex items-center gap-3 transition-colors ${cursorClass} rounded-lg frost border ${borderColor}`
                  },
                    // Bolinha indicadora (sempre visível)
                    e('span', {
                      className:`w-2.5 h-2.5 rounded-full flex-shrink-0 ${dotStyle}`
                    }),
                    // Horário à esquerda
                    e('span', { className:`text-sm font-medium whitespace-nowrap ${textColor}` },
                      `${startFormatted} - ${endFormatted}`
                    ),
                    // Nome do programa alinhado à DIREITA
                    e('span', {
                      className:`text-sm ${isCurrent ? 'font-semibold' : 'font-normal'} ${textColor} ml-auto text-right`,
                      style: { maxWidth: '60%' }
                    },
                      programTitle
                    )
                  )
                })
              )
            ),
            // Direita: trilho de dias (pixel-perfect)
            e('div', { className:'col-span-12 md:col-span-3 space-y-3 overflow-y-auto pb-4' },
              // Trilho de dias
              (()=>{
                const channelId = selectedChannel?.stream_id || selectedChannel?.id
                const hasPlayback = selectedChannel?.hasPlayback || false

                // Mostrar 7 dias: 3 antes + HOJE + 3 depois (para playback e EPG)
                // Exemplo: dia 11 hoje → mostra dias 08, 09, 10, [11], 12, 13, 14
                const dayOffsets = [-3, -2, -1, 0, 1, 2, 3]

                const diasInfo = dayOffsets.map(off => `${dayNum(off)} ${dayWeek(off)}`).join(', ')
                return dayOffsets.map((offset)=> {
                  const isSelected = selectedDay === offset

                  // Verificar se o dia tem gravações disponíveis
                  const recordedDays = channelId ? getRecordedDays(channelId) : []
                  const targetDate = new Date()
                  targetDate.setDate(targetDate.getDate() + offset) // + offset porque dayNum() usa soma
                  targetDate.setHours(0,0,0,0)

                  const isAvailable = hasPlayback ? recordedDays.some(d => {
                    const rd = new Date(d)
                    rd.setHours(0,0,0,0)
                    return rd.getTime() === targetDate.getTime()
                  }) : true // Sem playback = sempre disponível (EPG futuro)

                  const handleDayClick = ()=>{
                    if(hasPlayback && !isAvailable) return // Playback: só clica se disponível

                    setSelectedDay(offset)
                    setSelectedEpgId(null) // Limpar seleção EPG ao trocar dia

                    // Recarregar EPG do canal para o dia selecionado
                    if(channelId){
                      loadEpg(channelId, offset) // Passa o offset do dia selecionado
                    }
                  }

                  return e('div', {
                    key:offset,
                    onClick: handleDayClick,
                    className:`rounded-xl px-6 py-6 text-center transition-all ${
                      hasPlayback && !isAvailable ? 'opacity-40 pointer-events-none cursor-not-allowed' :
                      isSelected ? 'bg-violet-600/90 ring-2 ring-white/20 cursor-pointer' : // ROXO pixel-perfect
                      'frost cursor-pointer hover:bg-white/5'
                    }`,
                    style: isSelected ? { transform: 'scale(1.02)' } : {},
                    title: hasPlayback && !isAvailable ? 'Sem gravações disponíveis' : ''
                  },
                    e('div', { className:`text-3xl font-bold ${isSelected ? 'text-white' : 'text-white/90'}` }, dayNum(offset)),
                    e('div', { className:`text-sm ${isSelected ? 'opacity-100 font-semibold' : 'opacity-80'} text-white` }, dayWeek(offset))
                  )
                })
              })()
            )
          )
        )
      }

      // Filmes/Séries genéricos
      let cats = view==='movie-categories'? vodCats : seriesCats
      let title = view==='movie-categories'? 'Filmes — Categorias' : 'Séries — Categorias'
      let type = view==='movie-categories'? 'vod' : 'series'

      // Filtrar categorias de Filmes - remover shows, internacional, nacional
      if(view==='movie-categories'){
        cats = vodCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return !name.includes('show') && !name.includes('internacional') && !name.includes('nacional')
        })
      }

      // Filtrar categorias de Séries - remover novelas, crunchyroll, desenho
      if(view==='series-categories'){
        cats = seriesCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return !name.includes('novela') && !name.includes('crunchyroll') && !name.includes('desenho')
        })
      }

      // Filtrar apenas novelas se estiver na view de novelas
      if(view==='novelas-categories'){
        cats = seriesCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return name.includes('novela')
        })
        title = 'Novelas — Categorias'
        type = 'series'
      }

      // Filtrar apenas animes (crunchyroll) se estiver na view de animes
      if(view==='animes-categories'){
        cats = seriesCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return name.includes('crunchyroll')
        })
        title = 'Animes — Categorias'
        type = 'series'
      }

      // Filtrar apenas desenhos se estiver na view de desenhos
      if(view==='desenhos-categories'){
        cats = seriesCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return name.includes('desenho')
        })
        title = 'Desenhos — Categorias'
        type = 'series'
      }

      // Filtrar apenas shows (internacional/nacional) se estiver na view de shows
      if(view==='show-categories'){
        cats = vodCats.filter(cat => {
          const name = (cat.category_name || '').toLowerCase()
          return name.includes('show') || name.includes('internacional') || name.includes('nacional')
        })
        title = 'Show — Categorias'
        type = 'vod'
      }

      const [focusedIdx, setFocusedIdx] = useState(0)

      // Navegação por teclado em Filmes/Séries/Novelas/Animes/Desenhos/Show
      useEffect(()=>{
        const isMovieOrSeries = (view==='movie-categories' || view==='series-categories' || view==='novelas-categories' || view==='animes-categories' || view==='desenhos-categories' || view==='show-categories')
        if(!isMovieOrSeries || !cats || cats.length===0) return

        const handleKeyDown = (e)=>{
          if(e.key==='ArrowDown'){
            e.preventDefault()
            setFocusedIdx(prev=> Math.min(prev + 1, cats.length - 1))
          }else if(e.key==='ArrowUp'){
            e.preventDefault()
            setFocusedIdx(prev=> Math.max(prev - 1, 0))
          }else if(e.key==='ArrowRight' || e.key==='Enter'){
            e.preventDefault()
            const cat = cats[focusedIdx]
            if(cat) openCategory(cat, type)
          }else if(e.key==='ArrowLeft' || e.key==='Escape'){
            e.preventDefault()
            setView('home')
          }
        }

        window.addEventListener('keydown', handleKeyDown)
        return ()=> window.removeEventListener('keydown', handleKeyDown)
      }, [view, cats, focusedIdx, type])

      // Scroll automático
      useEffect(()=>{
        if((view==='movie-categories' || view==='series-categories' || view==='novelas-categories' || view==='animes-categories' || view==='desenhos-categories' || view==='show-categories') && cats && cats.length>0){
          const cat = cats[focusedIdx]
          if(cat){
            const el = document.getElementById('vod-cat-' + getCatId(cat))
            if(el) el.scrollIntoView({ behavior:'smooth', block:'nearest' })
          }
        }
      }, [focusedIdx, view, cats])

      return e('div', { className:'star-bg h-screen p-6 overflow-hidden' },
        e(TopBar),
        e('div', { className:'flex items-center gap-3 mb-4' },
          e('button', { onClick:()=>setView('home'), className:'text-white text-xl hover:text-purple-400' }, '←'),
          e('h2', { className:'text-white text-2xl font-bold' }, title)
        ),
        cats && cats.length>0 ? e('div', { className:'grid grid-cols-1 gap-3 max-w-2xl' },
          toArray(cats).map((cat, idx)=> {
            const isFocused = idx === focusedIdx
            return e('button', {
              key:getCatId(cat)||cat.category_name,
              id: 'vod-cat-' + getCatId(cat),
              onClick:()=>{ setFocusedIdx(idx); openCategory(cat, type) },
              className:'frost rounded-lg p-4 flex items-center justify-between text-left text-white hover:border-purple-400/50 transition-all ' + (isFocused ? ' ring-2 ring-purple-400 bg-purple-500/20' : '')
            },
              e('div', { className:'flex items-center gap-4' },
                e('div', { className:'w-12 h-12 bg-zinc-700 rounded-lg grid place-items-center' }, e('span', { className:'text-2xl' }, '📁')),
                e('span', { className:'text-lg font-medium truncate' }, cat.category_name || 'Sem nome')
              ),
              e('span', { className:'text-gray-300 text-lg font-bold' }, String(cat.total || 0))
            )
          }),
          e('div', { className:'text-center text-xs text-gray-400 mt-3 py-2' }, '↑↓ Navegar | → Enter Abrir | ← ESC Voltar')
        ) : e('div', { className:'text-center text-gray-400 mt-12 flex flex-col items-center gap-4' },
          'Sem categorias',
          error ? e('div', { className:'text-red-300 text-sm' }, 'Erro: ', error, debug? e('div', {className:'hint text-gray-400 mt-1'}, 'URL: ', maskUrlCredentials(debug.url||'')) : null) : null
        )
      )
    }

    function LiveVideo({ channel, epg, onDbl, type = 'live', isFavorite, toggleFavorite }){
      const vref = useRef(null)
      const hlsRef = useRef(null)
      const [showOverlay, setShowOverlay] = useState(true)
      const [currentTime, setCurrentTime] = useState('')
      const [selectedQuality, setSelectedQuality] = useState(null)
      const currentQualityRef = useRef(null) // Ref para não causar re-render ao trocar qualidade
      const [isFullscreen, setIsFullscreen] = useState(false)
      const [videoResolution, setVideoResolution] = useState('1920×1080')
      const hideTimeoutRef = useRef(null)
      const [availableQualities, setAvailableQualities] = useState([])
      const [loadError, setLoadError] = useState(null) // Estado para erro de carregamento
      const retryCountRef = useRef(0) // Contador de tentativas

      // Mapeamento de qualidade para resolução
      const getResolutionFromQuality = (quality) => {
        const qualityUpper = (quality || '').toUpperCase()
        if(qualityUpper.includes('FHD')) return '1920×1080'
        if(qualityUpper.includes('HD')) return '1280×720'
        if(qualityUpper.includes('SD')) return '854×480'
        return '1920×1080' // Default
      }

      // ========== FUNÇÕES HELPER ==========

      // Formatar título da pílula evitando redundância (ex: "GLOBO SP HD HD" -> "GLOBO SP HD")
      const formatPillTitle = (name, activeQuality) => {
        if(!name) return 'CANAL'
        const nameUpper = name.toUpperCase()
        // Se o nome já termina com o sufixo de qualidade, não repetir
        if(activeQuality && nameUpper.endsWith(activeQuality.toUpperCase())){
          return nameUpper
        }
        return activeQuality ? `${nameUpper} ${activeQuality.toUpperCase()}` : nameUpper
      }

      // Decodificar Base64 se necessário (títulos EPG podem vir codificados)
      const decodeMaybeBase64 = (str) => {
        if(!str || typeof str !== 'string') return 'Sem título'

        // Se já parece texto normal (tem espaços, acentos, letras), retorna direto
        if(/[\s\u00C0-\u00FF]/.test(str) || !/[A-Za-z0-9+/=]/.test(str)){
          return str
        }

        // Tentar decodificar Base64
        try {
          const decoded = atob(str)

          // Verificar se é texto válido ASCII/UTF-8 simples
          if(decoded && /^[\x20-\x7E]+$/.test(decoded)){
            // Texto ASCII puro (como "SP2") - retorna direto
            return decoded
          }

          // Se tem caracteres UTF-8 especiais, tentar converter
          if(decoded && /[\u00C0-\u00FF]/.test(decoded)){
            try {
              const utf8Decoded = decodeURIComponent(escape(decoded))
              if(utf8Decoded && utf8Decoded.length > 0 && !/[\x00-\x1F]/.test(utf8Decoded)){
                return utf8Decoded
              }
            } catch(e2) {
              // Falhou conversão UTF-8, retorna decoded simples
              return decoded
            }
          }

          // Se decodificou mas não é texto válido, retorna original
          return str

        } catch(e) {
          // Não é Base64 válido, retorna original
          return str
        }
      }

      // ========== FIM FUNÇÕES HELPER ==========

      // Definir qualidade inicial com base no canal
      useEffect(()=>{
        if(channel && channel.quality){
          setSelectedQuality(channel.quality)
          setVideoResolution(getResolutionFromQuality(channel.quality))
        }
      }, [channel?.stream_id, channel?.id])

      // Detectar variantes disponíveis
      useEffect(()=>{
        if(!channel || !channel.allVariants) return
        const qualities = channel.allVariants.map(v => v.quality).filter(Boolean)
        setAvailableQualities(qualities.length > 0 ? qualities : ['Original'])
      }, [channel?.allVariants])

      useEffect(()=>{
        const v = vref.current
        if(!v) {
          return
        }

        // Flag para evitar race conditions
        let cancelled = false
        let loadTimeout = null

        // Cleanup anterior
        if(hlsRef.current){
          try{ hlsRef.current.destroy() }catch{}
          hlsRef.current = null
        }

        if(!channel){
          v.removeAttribute('src'); v.load()
          setLoadError(null)
          retryCountRef.current = 0
          return
        }


        // Limpar erro anterior ao trocar de canal
        setLoadError(null)

        // Debounce: aguardar 200ms antes de iniciar o vídeo
        // Isso evita múltiplas inicializações quando o estado muda rapidamente
        loadTimeout = setTimeout(()=>{
          if(cancelled) return

          // Usar playback_url se disponível (modo playback de programa gravado)
          const url = channel.playback_url || buildURL(cfg.server, ['live', cfg.username, cfg.password, (channel.stream_id||channel.id)+'.m3u8'])

          const canNative = v.canPlayType('application/vnd.apple.mpegURL')

          if(window.Hls && window.Hls.isSupported() && !canNative){
            // ⚡ Configuração otimizada para início RÁPIDO
            const h = new Hls({
              maxBufferLength: 10,        // Reduzido: 30s → 10s (inicia 3x mais rápido!)
              maxMaxBufferLength: 20,      // Buffer máximo: 20s
              startPosition: -1,           // Começar do início
              autoStartLoad: true,         // Carregar imediatamente
              enableWorker: true,          // Usar Web Worker (performance)
              lowLatencyMode: false        // Desabilitar baixa latência (mais rápido para VOD)
            })
            hlsRef.current = h
            h.loadSource(url)
            h.attachMedia(v)
            h.on(window.Hls.Events.MANIFEST_PARSED, ()=>{
              if(cancelled) return
              setLoadError(null)
              retryCountRef.current = 0
            })
            h.on(window.Hls.Events.ERROR, (event, data)=>{
              if(data.fatal && !cancelled){
                // Tentar retry automático (máximo 2 tentativas)
                if(retryCountRef.current < 2){
                  retryCountRef.current++
                  setTimeout(()=>{
                    if(!cancelled && hlsRef.current){
                      hlsRef.current.destroy()
                      const newHls = new Hls({
                        maxBufferLength: 10,
                        maxMaxBufferLength: 20,
                        startPosition: -1,
                        autoStartLoad: true,
                        enableWorker: true,
                        lowLatencyMode: false
                      })
                      hlsRef.current = newHls
                      newHls.loadSource(url)
                      newHls.attachMedia(v)
                      newHls.on(window.Hls.Events.MANIFEST_PARSED, ()=>{
                        if(!cancelled){
                          setLoadError(null)
                          v.play().catch(()=>{})
                        }
                      })
                      newHls.on(window.Hls.Events.ERROR, (e, d)=>{
                        if(d.fatal && !cancelled){
                          setLoadError('Stream indisponível. Tente outro canal.')
                        }
                      })
                    }
                  }, 1000)
                }else{
                  // Após 2 tentativas, mostrar erro
                  setLoadError('Stream indisponível. Tente outro canal.')
                }
              }
            })
          }else{
            v.src = url
            v.onerror = ()=>{
              if(!cancelled) setLoadError('Stream indisponível. Tente outro canal.')
            }
          }

          if(!cancelled){
            v.play().then(()=>{
              if(!cancelled){
                setLoadError(null)
              }
            }).catch((err)=>{
              if(!cancelled){
                // Não mostrar erro se for "interrupted" (normal durante navegação rápida)
                if(!err.message.includes('interrupted')){
                  setLoadError('Erro ao iniciar reprodução')
                }
              }
            })
          }
        }, 200) // Aguardar 200ms antes de iniciar

        return ()=>{
          cancelled = true
          if(loadTimeout) clearTimeout(loadTimeout)
          if(hlsRef.current){
            try{ hlsRef.current.destroy() }catch{}
            hlsRef.current = null
          }
        }
      }, [channel?.stream_id, channel?.id, channel?.playback_url])

      const handleQualityFallback = ()=>{
        if(!channel || !channel.allVariants) return
        const currentIdx = channel.allVariants.findIndex(v => v.quality === selectedQuality)
        if(currentIdx === -1) return

        // Tentar próxima qualidade
        const nextVariant = channel.allVariants[currentIdx + 1] || channel.allVariants[0]
        if(nextVariant && nextVariant.quality !== selectedQuality){
          showToast(`Falha na qualidade ${selectedQuality}. Mudando para ${nextVariant.quality}...`)
          switchQuality(nextVariant.quality)
        }
      }

      const switchQuality = (quality)=>{
        if(!channel || !channel.allVariants) return

        const variant = channel.allVariants.find(v => v.quality === quality)
        if(!variant) return

        // Salvar preferência DIRETO no localStorage (sem state para não causar re-render do pai)
        if(channel.baseName){
          try{
            const current = JSON.parse(localStorage.getItem('channel_quality_prefs') || '{}')
            current[channel.baseName] = quality
            localStorage.setItem('channel_quality_prefs', JSON.stringify(current))
          }catch{}
        }

        // Trocar a URL diretamente no HLS sem recriar o player (mantém fullscreen)
        const v = vref.current
        if(!v) return

        const url = buildURL(cfg.server, ['live', cfg.username, cfg.password, (variant.stream_id||variant.id)+'.m3u8'])

        // Atualizar resolução baseada na qualidade selecionada
        setVideoResolution(getResolutionFromQuality(quality))

        if(hlsRef.current){
          // Se já tem HLS rodando, apenas trocar a source
          hlsRef.current.loadSource(url)
        }else{
          // Se for nativo, trocar o src
          v.src = url
          v.play().catch(()=>{})
        }

        // Atualizar qualidade na ref (não causa re-render, mantém fullscreen)
        currentQualityRef.current = quality

        // Forçar re-render apenas dos botões (sem reconstruir o player container)
        setTimeout(()=> setSelectedQuality(quality), 100)
      }

      const showToast = (message)=>{
        setToast(message)
        setTimeout(()=> setToast(null), 3000)
      }

      // Atualizar horário atual
      useEffect(()=>{
        const updateTime = ()=>{
          const now = new Date()
          setCurrentTime(`${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}`)
        }
        updateTime()
        const interval = setInterval(updateTime, 1000)
        return ()=> clearInterval(interval)
      }, [])

      // Auto-hide overlay
      const resetHideTimer = ()=>{
        setShowOverlay(true)
        if(hideTimeoutRef.current) clearTimeout(hideTimeoutRef.current)
        hideTimeoutRef.current = setTimeout(()=> setShowOverlay(false), 5000)
      }

      useEffect(()=>{
        resetHideTimer()
        return ()=> {
          if(hideTimeoutRef.current) clearTimeout(hideTimeoutRef.current)
        }
      }, [])

      // Detectar fullscreen
      useEffect(()=>{
        const handleFullscreen = ()=>{
          const isFS = !!(
            document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement
          )
          setIsFullscreen(isFS)
        }

        document.addEventListener('fullscreenchange', handleFullscreen)
        document.addEventListener('webkitfullscreenchange', handleFullscreen)
        document.addEventListener('mozfullscreenchange', handleFullscreen)
        document.addEventListener('MSFullscreenChange', handleFullscreen)

        return ()=> {
          document.removeEventListener('fullscreenchange', handleFullscreen)
          document.removeEventListener('webkitfullscreenchange', handleFullscreen)
          document.removeEventListener('mozfullscreenchange', handleFullscreen)
          document.removeEventListener('MSFullscreenChange', handleFullscreen)
        }
      }, [])
      

      // Navegação por teclado: atalhos do HUD
      useEffect(()=>{
        if(!channel) return

        const handleKey = (e)=>{
          if(e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return

          // Enter/OK: toggle HUD ou fullscreen se não estiver em fullscreen
          if(e.key === 'Enter'){
            e.preventDefault()
            e.stopPropagation()
            if(isFullscreen){
              setShowOverlay(prev => !prev)
            } else {
              toggleFullscreen()
            }
          }

          // F: fullscreen
          if(e.key === 'f' || e.key === 'F'){
            e.preventDefault()
            e.stopPropagation()
            toggleFullscreen()
          }

          // Q: focar qualidade (mostrar overlay)
          if(e.key === 'q' || e.key === 'Q'){
            e.preventDefault()
            e.stopPropagation()
            if(isFullscreen){
              setShowOverlay(true)
            }
          }

          // ESC/Back: fechar HUD ou sair do fullscreen
          if(e.key === 'Escape'){
            e.preventDefault()
            e.stopPropagation()
            if(showOverlay && isFullscreen){
              setShowOverlay(false)
            } else {
              const isFS = !!(
                document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement
              )
              if(isFS){
                toggleFullscreen()
              }
            }
          }

          // ← / →: navegação entre canais (placeholder)
          if(e.key === 'ArrowLeft'){
            e.preventDefault()
          }
          if(e.key === 'ArrowRight'){
            e.preventDefault()
          }
        }

        const container = document.getElementById('playerContainer')
        if(container){
          container.addEventListener('keydown', handleKey)
          return ()=> container.removeEventListener('keydown', handleKey)
        }
      }, [channel, isFullscreen, showOverlay])

      // Auto-hide do overlay após 4s de inatividade (APENAS EM LIVE, NÃO EM VOD)
      useEffect(()=>{
        if(!isFullscreen || !showOverlay || type === 'vod') return

        // Limpar timeout anterior
        if(hideTimeoutRef.current){
          clearTimeout(hideTimeoutRef.current)
        }

        // Configurar novo timeout para esconder após 4s
        hideTimeoutRef.current = setTimeout(()=>{
          setShowOverlay(false)
        }, 4000)

        // Função para reexibir overlay ao mover mouse/tecla
        const handleActivity = ()=>{
          setShowOverlay(true)
          if(hideTimeoutRef.current){
            clearTimeout(hideTimeoutRef.current)
          }
          hideTimeoutRef.current = setTimeout(()=>{
            setShowOverlay(false)
          }, 4000)
        }

        document.addEventListener('mousemove', handleActivity)
        document.addEventListener('keydown', handleActivity)

        return ()=>{
          if(hideTimeoutRef.current){
            clearTimeout(hideTimeoutRef.current)
          }
          document.removeEventListener('mousemove', handleActivity)
          document.removeEventListener('keydown', handleActivity)
        }
      }, [isFullscreen, showOverlay, type])

      const toggleFullscreen = ()=>{
        const viewport = document.querySelector('.player-viewport')
        if(!viewport) return

        const isCurrentlyFullscreen = !!(
          document.fullscreenElement ||
          document.webkitFullscreenElement ||
          document.mozFullScreenElement ||
          document.msFullscreenElement
        )

        if(isCurrentlyFullscreen){
          // Sair do fullscreen
          if(document.exitFullscreen){
            document.exitFullscreen().catch(()=>{})
          }else if(document.webkitExitFullscreen){
            document.webkitExitFullscreen()
          }else if(document.mozCancelFullScreen){
            document.mozCancelFullScreen()
          }else if(document.msExitFullscreen){
            document.msExitFullscreen()
          }
        }else{
          // Entrar em fullscreen no viewport
          if(viewport.requestFullscreen){
            viewport.requestFullscreen().catch(()=>{})
          }else if(viewport.webkitRequestFullscreen){
            viewport.webkitRequestFullscreen()
          }else if(viewport.mozRequestFullScreen){
            viewport.mozRequestFullScreen()
          }else if(viewport.msRequestFullscreen){
            viewport.msRequestFullscreen()
          }
        }
      }

      // Calcular progresso do programa
      const getCurrentProgram = ()=>{
        if(!epg || epg.length === 0){
          return null
        }

        const now = new Date()
        const currentHour = now.getHours()
        const currentMin = now.getMinutes()
        const currentTimeNum = currentHour * 60 + currentMin

        // Procurar programa atual
        for(let i = 0; i < epg.length; i++){
          const prog = epg[i]
          const startParts = (prog.start || '00:00').split(':')
          const endParts = (prog.end || '23:59').split(':')

          const startH = parseInt(startParts[0]) || 0
          const startM = parseInt(startParts[1]) || 0
          const endH = parseInt(endParts[0]) || 23
          const endM = parseInt(endParts[1]) || 59

          const startNum = startH * 60 + startM
          const endNum = endH * 60 + endM

          if(currentTimeNum >= startNum && currentTimeNum < endNum){
            const progress = ((currentTimeNum - startNum) / (endNum - startNum)) * 100
            return { ...prog, progress }
          }
        }

        return epg[0] ? { ...epg[0], progress: 0 } : null
      }

      const currentProg = getCurrentProgram()

      // Próximo programa: encontrar o que vem depois do atual
      let nextProg = null
      if(currentProg && epg && epg.length > 0){
        const currentIdx = epg.findIndex(p => p.id === currentProg.id)
        if(currentIdx !== -1 && currentIdx + 1 < epg.length){
          nextProg = epg[currentIdx + 1]
        }
      }

      return e('div', {
        key: 'player-container-stable',
        id: 'playerContainer',
        tabIndex: 0,
        style: {
          position: isFullscreen ? 'fixed' : 'relative',
          top: isFullscreen ? 0 : 'auto',
          left: isFullscreen ? 0 : 'auto',
          width: isFullscreen ? '100vw' : '100%',
          height: isFullscreen ? '100vh' : '100%',
          margin: 0,
          padding: 0,
          overflow: 'hidden',
          backgroundColor: '#000',
          outline: 'none',
          zIndex: isFullscreen ? 99999 : 'auto'
        },
        onMouseMove: resetHideTimer,
        onClick: (e)=> {
          resetHideTimer()
          e.currentTarget.focus()
        },
        onDoubleClick: (e)=> {
          e.preventDefault()
          e.stopPropagation()
          toggleFullscreen()
        }
      },
        // Viewport wrapper - centraliza o vídeo perfeitamente
        e('div', {
          className: 'player-viewport',
          tabIndex: -1,
          style: { position: 'absolute', inset: 0 },
          onDoubleClick: (e)=> {
            e.preventDefault()
            e.stopPropagation()
            toggleFullscreen()
          }
        },
          // Mensagem de erro (se houver)
          loadError && e('div', {
            style: {
              position: 'absolute',
              top: '50%',
              left: '50%',
              transform: 'translate(-50%, -50%)',
              background: 'rgba(220, 38, 38, 0.95)',
              color: '#FFFFFF',
              padding: '20px 40px',
              borderRadius: '12px',
              fontSize: '18px',
              fontWeight: '600',
              textAlign: 'center',
              zIndex: 10000,
              filter: 'drop-shadow(0 8px 16px rgba(0,0,0,0.5))',
              maxWidth: '80%',
              lineHeight: '1.5'
            }
          },
            e('div', { style: { fontSize: '32px', marginBottom: '10px' } }, '⚠️'),
            loadError,
            e('div', {
              style: {
                fontSize: '14px',
                marginTop: '10px',
                opacity: 0.9
              }
            }, 'Selecione outro canal para continuar')
          ),
          e('video', {
            id:'liveVideo',
            autoPlay:true,
            ref:vref,
            controls:false,
            playsInline:true,
            muted:false,
            onDoubleClick: toggleFullscreen,
            style: isFullscreen ? {
              width: '100%',
              height: '100%',
              objectFit: 'contain',
              objectPosition: 'center',
              position: 'absolute',
              top: 0,
              left: 0,
              transform: 'none',
              margin: 0,
              padding: 0,
              backgroundColor: '#000'
            } : {
              width: '927px',
              height: '521px',
              objectFit: 'fill',
              objectPosition: 'center',
              position: 'absolute',
              top: 0,
              left: 0,
              margin: 0,
              padding: 0,
              backgroundColor: '#000'
            }
          }),

          // OVERLAY PIXEL PERFECT - LAYOUT IDÊNTICO AO ALVO (apenas em LIVE, não em VOD)
          showOverlay && isFullscreen && type === 'live' && e('div', {
            'data-testid': 'player-hud',
            style: {
              position: 'absolute',
              inset: 0,
              background: 'linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.6) 40%, transparent 100%)',
              display: 'flex',
              flexDirection: 'column',
              justifyContent: 'flex-end',
              alignItems: 'center',
              padding: `max(20px, env(safe-area-inset-bottom)) max(20px, env(safe-area-inset-left)) max(20px, env(safe-area-inset-right))`,
              zIndex: 999999,
              pointerEvents: 'auto',
              fontFamily: 'system-ui, -apple-system, sans-serif',
              gap: 'clamp(12px,1.5vw,20px)'
            }
          },
            // (A) PÍLULA CENTRAL - acima do cartão
            e('div', {
              style: {
                background: 'rgba(11, 16, 32, 0.80)',
                borderRadius: '9999px',
                padding: 'clamp(8px,1.2vw,12px) clamp(18px,2vw,28px)',
                color: '#FFFFFF',
                fontSize: 'clamp(16px,2.4vw,28px)',
                fontWeight: '600',
                letterSpacing: '0.5px',
                filter: 'drop-shadow(0 4px 6px rgba(0,0,0,0.3))',
                whiteSpace: 'nowrap',
                textTransform: 'uppercase'
              }
            }, formatPillTitle(channel?.name, selectedQuality)),

            // (B) CARTÃO PRINCIPAL
            e('div', {
              style: {
                background: 'rgba(11, 16, 32, 0.92)',
                borderRadius: '20px',
                padding: 'clamp(12px,1.6vw,18px) clamp(16px,2vw,28px)',
                filter: 'drop-shadow(0 8px 16px rgba(0,0,0,0.4))',
                display: 'grid',
                gridTemplateColumns: 'auto auto 1fr 1fr auto',
                alignItems: 'center',
                gap: 'clamp(10px,1.4vw,18px)',
                width: '100%',
                maxWidth: '1400px'
              }
            },
              // Col 1: Nº do canal
              e('div', {
                style: {
                  fontSize: 'clamp(22px,2vw,28px)',
                  fontWeight: '600',
                  color: '#FFFFFF'
                }
              }, String(channel?.num || '---')),

              // Col 2: Logo do canal
              channel?.stream_icon && e('img', {
                src: channel.stream_icon,
                style: {
                  width: 'clamp(34px,3vw,44px)',
                  height: 'clamp(34px,3vw,44px)',
                  borderRadius: '50%',
                  backgroundColor: 'rgba(11,16,32,0.8)',
                  padding: '4px',
                  objectFit: 'contain'
                }
              }),

              // Col 3: Programa atual (centro-esquerda)
              e('div', {
                style: {
                  display: 'flex',
                  flexDirection: 'column',
                  gap: 'clamp(6px,0.8vw,10px)',
                  minWidth: 0
                }
              },
                // Linha 1: Horário + AO VIVO / PLAYBACK
                e('div', {
                  style: {
                    display: 'flex',
                    alignItems: 'center',
                    gap: 'clamp(8px,1vw,12px)'
                  }
                },
                  e('div', {
                    style: {
                      fontSize: 'clamp(12px,1.2vw,14px)',
                      color: '#C7D2FE'
                    }
                  }, currentProg && currentProg.start && currentProg.end ? `${currentProg.start} – ${currentProg.end}` : ''),
                  e('div', {
                    style: {
                      background: channel?.playback_mode ? '#F59E0B' : '#E11D48',
                      color: '#FFFFFF',
                      borderRadius: '6px',
                      padding: '2px 8px',
                      fontSize: 'clamp(10px,1.1vw,12px)',
                      fontWeight: '600'
                    }
                  }, channel?.playback_mode ? '🎬 PLAYBACK' : 'AO VIVO')
                ),
                // Linha 2: Título do programa (usa playback_program se estiver em modo playback)
                e('div', {
                  style: {
                    fontSize: 'clamp(18px,2.2vw,26px)',
                    fontWeight: '600',
                    color: '#FFFFFF',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                    whiteSpace: 'nowrap'
                  }
                }, channel?.playback_mode ? (channel?.playback_program || 'Playback') : decodeMaybeBase64(currentProg?.title)),
                // Barra de progresso
                e('div', {
                  style: {
                    width: '100%',
                    height: '6px',
                    backgroundColor: 'rgba(255,255,255,0.2)',
                    borderRadius: '9999px',
                    overflow: 'hidden'
                  }
                },
                  e('div', {
                    style: {
                      width: `${currentProg?.progress || 0}%`,
                      height: '100%',
                      backgroundColor: '#EF4444',
                      borderRadius: '9999px',
                      transition: 'width 1s linear'
                    }
                  })
                )
              ),

              // Col 4: Próximo programa (centro-direita)
              nextProg && e('div', {
                style: {
                  display: 'flex',
                  flexDirection: 'column',
                  gap: 'clamp(6px,0.8vw,10px)',
                  minWidth: 0
                }
              },
                // Badge NEXT
                e('div', {
                  style: {
                    display: 'flex',
                    alignItems: 'center',
                    gap: 'clamp(6px,0.8vw,10px)'
                  }
                },
                  e('div', {
                    style: {
                      background: '#CBD5E1',
                      color: '#0B1020',
                      borderRadius: '6px',
                      padding: '2px 8px',
                      fontSize: 'clamp(10px,1.1vw,12px)',
                      fontWeight: '600'
                    }
                  }, 'NEXT')
                ),
                // Título do próximo + horário
                e('div', {
                  style: {
                    fontSize: 'clamp(14px,1.6vw,18px)',
                    fontWeight: '600',
                    color: '#FFFFFF',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                    whiteSpace: 'nowrap'
                  }
                }, `${decodeMaybeBase64(nextProg.title)} ${nextProg.start || ''} – ${nextProg.end || ''}`)
              ),

              // Col 5: Hora + Resolução
              e('div', {
                style: {
                  textAlign: 'right'
                }
              },
                e('div', {
                  style: {
                    fontSize: 'clamp(14px,1.6vw,18px)',
                    fontWeight: '600',
                    color: '#FFFFFF',
                    marginBottom: 'clamp(2px,0.4vw,4px)'
                  }
                }, currentTime),
                e('div', {
                  style: {
                    fontSize: 'clamp(12px,1.4vw,14px)',
                    color: 'rgba(255,255,255,0.8)'
                  }
                }, videoResolution)
              )
            ),

            // (C) FAIXA INFERIOR (CHIPS)
            e('div', {
              style: {
                background: 'rgba(11, 16, 32, 0.85)',
                borderRadius: '9999px',
                padding: 'clamp(8px,1.2vw,12px) clamp(12px,1.6vw,18px)',
                filter: 'drop-shadow(0 4px 12px rgba(0,0,0,0.4))',
                display: 'flex',
                alignItems: 'center',
                gap: 'clamp(8px,1vw,12px)',
                justifyContent: 'center',
                flexWrap: 'wrap'
              }
            },
              // Navegação (← →)
              e('button', {
                onClick: () => {},
                style: {
                  background: 'rgba(255,255,255,0.15)',
                  color: '#FFFFFF',
                  border: '1px solid rgba(255,255,255,0.2)',
                  padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(14px,1.4vw,16px)',
                  fontWeight: '500',
                  cursor: 'pointer',
                  outline: 'none',
                  transition: 'all 0.2s'
                }
              }, '←'),

              e('button', {
                onClick: () => {},
                style: {
                  background: 'rgba(255,255,255,0.15)',
                  color: '#FFFFFF',
                  border: '1px solid rgba(255,255,255,0.2)',
                  padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(14px,1.4vw,16px)',
                  fontWeight: '500',
                  cursor: 'pointer',
                  outline: 'none',
                  transition: 'all 0.2s'
                }
              }, '→'),

              // Favorito (⭐/☆)
              e('button', {
                onClick: toggleFavorite,
                style: {
                  background: isFavorite ? '#FFD700' : 'rgba(255,255,255,0.15)',
                  color: isFavorite ? '#000' : '#FFFFFF',
                  border: isFavorite ? '1px solid #FFD700' : '1px solid rgba(255,255,255,0.2)',
                  padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(14px,1.4vw,16px)',
                  fontWeight: '500',
                  cursor: 'pointer',
                  outline: 'none',
                  transition: 'all 0.2s'
                }
              }, isFavorite ? '★' : '☆'),

              // EPG/Info (📋)
              e('button', {
                onClick: () => {},
                style: {
                  background: 'rgba(255,255,255,0.15)',
                  color: '#FFFFFF',
                  border: '1px solid rgba(255,255,255,0.2)',
                  padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(14px,1.4vw,16px)',
                  fontWeight: '500',
                  cursor: 'pointer',
                  outline: 'none',
                  transition: 'all 0.2s'
                }
              }, '📋'),

              // Chips de qualidade (FHD, FHD², HD, HD², SD, SD²)
              availableQualities.length > 0 && availableQualities.map(quality =>
                e('button', {
                  key: quality,
                  onClick: () => switchQuality(quality),
                  style: {
                    background: selectedQuality === quality ? '#22C55E' : 'rgba(255,255,255,0.15)',
                    color: selectedQuality === quality ? '#0B1020' : '#FFFFFF',
                    border: selectedQuality === quality ? '2px solid #34D399' : '1px solid rgba(255,255,255,0.2)',
                    padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                    borderRadius: '9999px',
                    fontSize: 'clamp(12px,1.2vw,14px)',
                    fontWeight: selectedQuality === quality ? '600' : '500',
                    cursor: 'pointer',
                    outline: 'none',
                    transition: 'all 0.2s'
                  }
                }, quality)
              ),

              // Botão Original (AUTO)
              e('button', {
                onClick: () => {
                  if(hlsRef.current) {
                    hlsRef.current.currentLevel = -1
                    setSelectedQuality(null)
                  }
                },
                style: {
                  background: !selectedQuality ? '#22C55E' : 'rgba(255,255,255,0.15)',
                  color: !selectedQuality ? '#0B1020' : '#FFFFFF',
                  border: !selectedQuality ? '2px solid #34D399' : '1px solid rgba(255,255,255,0.2)',
                  padding: 'clamp(6px,0.8vw,8px) clamp(10px,1.2vw,14px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(12px,1.2vw,14px)',
                  fontWeight: !selectedQuality ? '600' : '500',
                  cursor: 'pointer',
                  outline: 'none'
                }
              }, 'Original'),

              // Botão Full Screen (VERDE DESTACADO)
              e('button', {
                onClick: toggleFullscreen,
                style: {
                  background: '#16A34A',
                  color: '#FFFFFF',
                  border: '2px solid #34D399',
                  padding: 'clamp(8px,1.2vw,10px) clamp(14px,1.8vw,20px)',
                  borderRadius: '9999px',
                  fontSize: 'clamp(12px,1.2vw,14px)',
                  fontWeight: '600',
                  cursor: 'pointer',
                  outline: 'none',
                  boxShadow: '0 0 12px rgba(52, 211, 153, 0.3)'
                }
              }, isFullscreen ? 'Sair da Tela Cheia' : 'Full Screen')
            )
          )
        ),

        // OVERLAY DESABILITADO (será refeito)
        false && e('div', {
          style: {
            position: 'absolute',
            bottom: 0,
            left: 0,
            right: 0,
            background: 'linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.7) 60%, transparent 100%)',
            padding: '60px 30px 30px',
            zIndex: 99999,
            pointerEvents: 'none'
          }
        },
          e('div', {
            style: {
              maxWidth: '1400px',
              margin: '0 auto',
              pointerEvents: 'auto'
            }
          },
            // Nome do canal (topo)
            e('div', {
              style: {
                textAlign: 'center',
                marginBottom: '20px'
              }
            },
              e('div', {
                style: {
                  display: 'inline-block',
                  backgroundColor: 'rgba(30, 40, 60, 0.9)',
                  padding: '8px 24px',
                  borderRadius: '20px',
                  fontSize: '16px',
                  fontWeight: '700',
                  color: '#fff',
                  letterSpacing: '1px'
                }
              }, (channel?.name || 'CANAL').toUpperCase())
            ),

            // Container principal
            e('div', {
              style: {
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'space-between',
                backgroundColor: 'rgba(15, 20, 30, 0.92)',
                borderRadius: '16px',
                padding: '24px 32px',
                boxShadow: '0 8px 32px rgba(0,0,0,0.6)'
              }
            },
              // ESQUERDA: Número + Logo + Programa Atual
              e('div', {
                style: {
                  display: 'flex',
                  alignItems: 'center',
                  gap: '20px',
                  flex: 1
                }
              },
                // Número do canal
                e('div', {
                  style: {
                    fontSize: '32px',
                    fontWeight: '700',
                    color: '#fff',
                    minWidth: '60px',
                    textAlign: 'center'
                  }
                }, String(channel?.num || channel?.stream_id || '—')),

                // Logo do canal
                channel?.stream_icon && e('img', {
                  src: channel.stream_icon,
                  style: {
                    width: '56px',
                    height: '56px',
                    borderRadius: '50%',
                    backgroundColor: '#fff',
                    padding: '4px',
                    objectFit: 'contain'
                  }
                }),

                // Programa atual
                e('div', {
                  style: {
                    flex: 1,
                    minWidth: 0
                  }
                },
                  // Título + AO VIVO
                  e('div', {
                    style: {
                      display: 'flex',
                      alignItems: 'center',
                      gap: '12px',
                      marginBottom: '6px'
                    }
                  },
                    e('div', {
                      style: {
                        fontSize: '20px',
                        fontWeight: '700',
                        color: '#fff',
                        whiteSpace: 'nowrap',
                        overflow: 'hidden',
                        textOverflow: 'ellipsis'
                      }
                    }, currentProg?.title || 'Programa Atual'),
                    e('div', {
                      style: {
                        backgroundColor: '#E50914',
                        color: '#fff',
                        fontSize: '11px',
                        fontWeight: '800',
                        padding: '4px 10px',
                        borderRadius: '4px',
                        letterSpacing: '0.5px'
                      }
                    }, 'AO VIVO')
                  ),

                  // Horários
                  currentProg && e('div', {
                    style: {
                      fontSize: '14px',
                      color: '#aaa',
                      marginBottom: '8px'
                    }
                  }, `${currentProg.start || '00:00'} – ${currentProg.end || '00:00'}`),

                  // Barra de progresso
                  currentProg && e('div', {
                    style: {
                      width: '100%',
                      height: '5px',
                      backgroundColor: 'rgba(255,255,255,0.2)',
                      borderRadius: '3px',
                      overflow: 'hidden'
                    }
                  },
                    e('div', {
                      style: {
                        width: `${currentProg.progress || 0}%`,
                        height: '100%',
                        backgroundColor: '#E50914',
                        transition: 'width 1s linear'
                      }
                    })
                  )
                )
              ),

              // CENTRO: Próximo programa
              nextProg && e('div', {
                style: {
                  marginLeft: '32px',
                  marginRight: '32px',
                  minWidth: '200px'
                }
              },
                e('div', {
                  style: {
                    backgroundColor: 'rgba(60, 70, 90, 0.8)',
                    padding: '4px 12px',
                    borderRadius: '6px',
                    fontSize: '11px',
                    fontWeight: '700',
                    color: '#fff',
                    marginBottom: '6px',
                    display: 'inline-block'
                  }
                }, 'PRÓXIMO'),
                e('div', {
                  style: {
                    fontSize: '14px',
                    color: '#aaa',
                    marginBottom: '4px'
                  }
                }, `${nextProg.start || '00:00'} – ${nextProg.end || '00:00'}`),
                e('div', {
                  style: {
                    fontSize: '15px',
                    fontWeight: '600',
                    color: '#fff',
                    whiteSpace: 'nowrap',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                    maxWidth: '250px'
                  }
                }, nextProg.title)
              ),

              // DIREITA: Hora + Resolução
              e('div', {
                style: {
                  textAlign: 'right',
                  minWidth: '100px'
                }
              },
                e('div', {
                  style: {
                    fontSize: '28px',
                    fontWeight: '700',
                    color: '#fff',
                    marginBottom: '4px'
                  }
                }, currentTime),
                e('div', {
                  style: {
                    fontSize: '13px',
                    fontWeight: '600',
                    color: '#aaa'
                  }
                }, videoResolution)
              )
            ),

            // BOTÕES DE QUALIDADE
            availableQualities.length > 0 && e('div', {
              style: {
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                gap: '12px',
                marginTop: '20px'
              }
            },
              e('div', {
                style: {
                  fontSize: '13px',
                  fontWeight: '600',
                  color: '#aaa',
                  marginRight: '8px'
                }
              }, 'QUALIDADE:'),

              availableQualities.map(quality =>
                e('button', {
                  key: quality,
                  onClick: () => switchQuality(quality),
                  style: {
                    backgroundColor: selectedQuality === quality ? '#E50914' : 'rgba(60, 70, 90, 0.8)',
                    color: '#fff',
                    border: 'none',
                    padding: '8px 20px',
                    borderRadius: '6px',
                    fontSize: '13px',
                    fontWeight: '700',
                    cursor: 'pointer',
                    transition: 'all 0.2s',
                    outline: 'none',
                    letterSpacing: '0.5px'
                  },
                  onMouseEnter: (e) => {
                    if(selectedQuality !== quality) {
                      e.target.style.backgroundColor = 'rgba(80, 90, 110, 0.9)'
                    }
                  },
                  onMouseLeave: (e) => {
                    if(selectedQuality !== quality) {
                      e.target.style.backgroundColor = 'rgba(60, 70, 90, 0.8)'
                    }
                  }
                }, quality)
              )
            )
          )
        )
      )
    }

    function toggleFullscreen(sel){
      const el = document.querySelector(sel)
      if(!el) return
      if(document.fullscreenElement){ document.exitFullscreen().catch(()=>{}) }
      else{ el.requestFullscreen && el.requestFullscreen().catch(()=>{}) }
    }

    function dayNum(offset){ const d = new Date(); d.setDate(d.getDate()+offset); return String(d.getDate()).padStart(2,'0') }
    function dayWeek(offset){ const d = new Date(); d.setDate(d.getDate()+offset); return ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'][d.getDay()] }

// Estado GLOBAL para NetflixMovies (persiste entre remontagens)
if(typeof window.__netflixMoviesState === 'undefined') {
  window.__netflixMoviesState = {
    initialized: false,
    currentViewKey: null, // ===== NOVO: Rastreia qual view está carregada =====
    sectionsMovies: [],
    featuredMovieId: null,
    totalCategories: 0, // Total de categorias disponíveis
    currentCategoryIndex: 0, // Categoria visível atual
    loading: false,
    errorMsg: '',
    marginContent: {}, // ===== NOVO: Estado de scroll horizontal persistente =====
    collections: [],
    showCollectionsView: false,
    selectedCollectionMovies: [],
    viewingCollectionMovies: false,
    heroBackdrop: null,
    loadingCollections: false // ===== ADICIONAR AO ESTADO GLOBAL =====
  }
}

// Listeners para notificar componentes de mudanças no estado global
if(typeof window.__netflixMoviesListeners === 'undefined') {
  window.__netflixMoviesListeners = new Set()
}

// Cache GLOBAL de filmes enriquecidos (evita re-buscar dados TMDB)
if(typeof window.__enrichedMoviesCache === 'undefined') {
  window.__enrichedMoviesCache = {}
}

// Estado GLOBAL para trailer em hover (evita re-render dos cards)
window.__hoveredTrailer = {
  trailerUrl: null,
  movieData: null,
  updateCallback: null
}

// Função GLOBAL para atualizar estado e notificar todos os componentes
window.updateNetflixMoviesState = (updates) => {
  Object.assign(window.__netflixMoviesState, updates)
  // Notificar todos os componentes montados
  window.__netflixMoviesListeners.forEach(listener => listener())
}

// Função para resetar estado quando sair da view de filmes
window.resetNetflixMovies = () => {
  window.__netflixMoviesState = {
    initialized: false,
    currentViewKey: window.__netflixMoviesState.currentViewKey, // ===== NÃO RESETAR: Manter para cancelar timeouts antigos =====
    sectionsMovies: [],
    featuredMovieId: null,
    currentCategoryIndex: 0,
    loading: false,
    errorMsg: '',
    collections: [], // Adicionar collections ao estado global
    showCollectionsView: false,
    selectedCollectionMovies: [],
    viewingCollectionMovies: false,
    heroBackdrop: null, // Backdrop para mostrar no topo (coleção ou filme)
    marginContent: {} // ===== NOVO: Resetar estado de scroll =====
  }
  // ===== LIMPAR CATEGORIAS FILTRADAS =====
  window.__allAvailableCategories = []
  window.__allCategoriesRaw = []
  window.__netflixMoviesListeners.forEach(listener => listener())
}

// Componente NetflixMovies com proteção anti-loop
    function NetflixMovies({ contentType = 'vod', categoryFilter = null, selectedCategory = null }){
      const isSeriesMode = contentType === 'series'
      const modeLabel = isSeriesMode ? 'SÉRIES' : 'FILMES'
      const filterLabel = categoryFilter ? ` (${categoryFilter})` : ''

      // Usar estado global + forceUpdate para re-renderizar
      const [, forceUpdate] = useState(0)
      const globalState = window.__netflixMoviesState

      // ===== SOLUÇÃO FINAL: useRef + callback para notificar componentes específicos =====
      const marginContentRef = useRef(globalState.marginContent || {})
      const marginListenersRef = useRef({}) // Callbacks por sectionId

      const setMarginContent = (updater) => {
        const newValue = typeof updater === 'function' ? updater(marginContentRef.current) : updater
        marginContentRef.current = newValue
        // Salvar no global para persistir
        window.__netflixMoviesState.marginContent = newValue

        // ===== ATUALIZAR DOM DIRETAMENTE (sem re-render do componente pai) =====
        Object.keys(newValue).forEach(sectionId => {
          const container = document.querySelector(`[data-section-id="${sectionId}"]`)
          if (container) {
            container.style.transform = `translateX(${newValue[sectionId]}px)`
          }

          // ===== NOTIFICAR apenas o SectionMovies específico =====
          if (marginListenersRef.current[sectionId]) {
            marginListenersRef.current[sectionId](newValue[sectionId])
          }
        })
      }

      // Função para SectionMovies se registrar
      const registerMarginListener = (sectionId, callback) => {
        marginListenersRef.current[sectionId] = callback
        return () => {
          delete marginListenersRef.current[sectionId]
        }
      }

      const [focusedMovieIdx, setFocusedMovieIdx] = useState(0)
      const loadingCategoriesRef = useRef(new Set()) // Múltiplas categorias carregando simultaneamente

      // Estados para coleções (usar estado global para persistir)
      const collections = globalState.collections || []
      const setCollections = (value) => {
        window.updateNetflixMoviesState({ collections: value })
      }

      // Estados de visualização de coleções (também usar estado global)
      const showCollectionsView = globalState.showCollectionsView || false
      const setShowCollectionsView = (value) => {
        window.updateNetflixMoviesState({ showCollectionsView: value })
      }

      const selectedCollectionMovies = globalState.selectedCollectionMovies || []
      const setSelectedCollectionMovies = (value) => {
        window.updateNetflixMoviesState({ selectedCollectionMovies: value })
      }

      const viewingCollectionMovies = globalState.viewingCollectionMovies || false
      const setViewingCollectionMovies = (value) => {
        window.updateNetflixMoviesState({ viewingCollectionMovies: value })
      }

      // ===== USAR ESTADO GLOBAL para loadingCollections =====
      const loadingCollections = globalState.loadingCollections || false
      const setLoadingCollections = (value) => {
        window.updateNetflixMoviesState({ loadingCollections: value })
      }

      // Função para carregar índice de coleções pré-construído (INSTANTÂNEO)
      const loadCollectionsFromJSON = async (setCollections) => {
        // Evitar múltiplas chamadas usando flag GLOBAL
        if (window.__collectionsLoadAttempted) {
          return
        }
        window.__collectionsLoadAttempted = true
        setLoadingCollections(true)

        try {
          // URL do arquivo JSON (ajuste conforme necessário)
          const jsonUrl = './collections.json' // Coloque o arquivo na raiz do projeto

          const response = await fetch(jsonUrl)


          if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`)
          }

          // Verificar se a resposta é realmente JSON
          const contentType = response.headers.get('content-type')
          if (!contentType || !contentType.includes('application/json')) {
            throw new Error(`Tipo de conteúdo inválido: ${contentType}. Esperado JSON, mas recebeu HTML ou outro formato.`)
          }

          const data = await response.json()

          // Transformar para o formato esperado pelo componente
          const collections = data.collections.map(col => ({
            id: col.id,
            name: col.name,
            poster: col.poster_path ? `https://image.tmdb.org/t/p/w500${col.poster_path}` : null,
            backdrop: col.backdrop_path ? `https://image.tmdb.org/t/p/original${col.backdrop_path}` : null,
            overview: '', // Será enriquecido a seguir
            movies: col.movies.map(m => ({
              stream_id: m.stream_id,
              name: m.name,
              category: m.category
            }))
          }))

          // Enriquecer primeiras 30 coleções com overview do TMDB (em background)
          const collectionsToEnrich = collections.slice(0, 30) // Limitar para performance

          Promise.all(
            collectionsToEnrich.map(async (col, idx) => {
              try {
                const tmdbData = await getTMDBCollection(col.id)
                if (tmdbData && tmdbData.overview) {
                  col.overview = tmdbData.overview
                }
              } catch (err) {
              }
            })
          ).then(() => {
            setCollections([...collections]) // Atualizar estado com overviews
          })

          setCollections(collections)

        } catch (err) {
          // Silenciar erro 404 ou conteúdo inválido - arquivo collections.json é opcional
          setCollections([])
        } finally {
          setLoadingCollections(false)
        }
      }

      // Função para construir coleções dinamicamente a partir dos filmes carregados
      const loadCollections = async () => {
        console.log('[loadCollections] INICIANDO...')
        setLoadingCollections(true)

        try {
          // Coletar todos os filmes de todas as seções carregadas
          const allMovies = []
          for(const section of globalState.sectionsMovies) {
            if(section && section.movies && section.movies.length > 0) {
              allMovies.push(...section.movies)
            }
          }

          console.log('[loadCollections] Total de filmes:', allMovies.length)

          // Usar a função global findCollectionsInMovies
          const foundCollections = await findCollectionsInMovies(allMovies)

          console.log('[loadCollections] Coleções encontradas:', foundCollections.length)

          setCollections(foundCollections)
        } catch(err) {
          console.error('[loadCollections] ERRO:', err)
          setCollections([])
        } finally {
          setLoadingCollections(false)
          console.log('[loadCollections] FINALIZADO')
        }
      }

      // Expor função globalmente para ser chamada do menu
      useEffect(() => {
        window.loadNetflixCollections = loadCollections
        return () => {
          delete window.loadNetflixCollections
        }
      }, [])

      // ===== NOVO: Setar featuredMovieId automaticamente quando sectionsMovies carrega =====
      useEffect(() => {
        // Verifica se estamos em uma view de conteúdo (não em coleções ou live)
        const isContentView = view && view.startsWith('netflix-')

        // Só setar se estamos em view de conteúdo e temos filmes carregados
        if (isContentView && globalState.sectionsMovies.length > 0) {
          const firstSection = globalState.sectionsMovies[0]
          if (firstSection?.movies?.length > 0) {
            const firstMovie = firstSection.movies[0]
            const firstMovieId = firstMovie?.series_id || firstMovie?.stream_id || firstMovie?.id

            // Sempre atualizar para garantir que mostra o primeiro filme ao trocar de categoria
            if (firstMovieId) {
              window.updateNetflixMoviesState({
                featuredMovieId: firstMovieId,
                heroBackdrop: null // Garantir que não há backdrop de coleção
              })
            }
          }
        }
      }, [view, globalState.sectionsMovies.length])

      // ===== NOVO: Carregar coleções automaticamente quando filmes forem carregados =====
      // Construir coleções em background assim que tiver filmes suficientes
      useEffect(() => {
        const totalMovies = globalState.sectionsMovies.reduce((sum, section) => {
          return sum + (section?.movies?.length || 0)
        }, 0)

        // Se tem filmes carregados E ainda não tem coleções E não está carregando
        if (totalMovies >= 50 && collections.length === 0 && !loadingCollections) {
          loadCollections()
        }
      }, [globalState.sectionsMovies.length]) // Disparar quando novas seções forem adicionadas

      // ===== NOVO: Forçar carregamento de coleções quando entrar na view collections =====
      useEffect(() => {
        console.log('[useEffect collections] view:', view, 'collections.length:', collections.length, 'loadingCollections:', loadingCollections, 'sections:', globalState.sectionsMovies.length)

        if (view === 'collections' && collections.length === 0 && !loadingCollections) {
          const totalMovies = globalState.sectionsMovies.reduce((sum, section) => {
            return sum + (section?.movies?.length || 0)
          }, 0)

          console.log('[useEffect collections] Total de filmes:', totalMovies)

          // Se tem pelo menos alguns filmes, tenta carregar coleções
          if (totalMovies > 0) {
            console.log('[useEffect collections] Chamando loadCollections()...')
            loadCollections()
          } else {
            // ===== NOVO: Se não tem filmes, carregar automaticamente da netflix-movies =====
            console.log('[useEffect collections] Sem filmes - redirecionando para netflix-movies temporariamente')

            // Salvar que queremos voltar para collections
            window.__pendingCollectionsView = true

            // Ir para netflix-movies para carregar filmes
            setView('netflix-movies')
          }
        }

        // ===== NOVO: Após carregar filmes, voltar para collections =====
        if (window.__pendingCollectionsView && view === 'netflix-movies' && globalState.sectionsMovies.length > 0) {
          const totalMovies = globalState.sectionsMovies.reduce((sum, section) => {
            return sum + (section?.movies?.length || 0)
          }, 0)

          if (totalMovies > 0) {
            console.log('[useEffect collections] Filmes carregados! Voltando para collections...')
            window.__pendingCollectionsView = false
            setView('collections')
          }
        }
      }, [view, collections.length, globalState.sectionsMovies.length])

      // ===== NOVO: Setar heroBackdrop da primeira coleção quando abrir Coletâneas =====
      useEffect(() => {
        if (showCollectionsView && collections.length > 0 && !viewingCollectionMovies) {
          const firstCollection = collections[0]
          if (firstCollection && window.updateNetflixMoviesState) {
            window.updateNetflixMoviesState({
              heroBackdrop: {
                name: firstCollection.name,
                overview: firstCollection.overview || `Coleção com ${firstCollection.movies?.length || 0} filmes`,
                backdrop: firstCollection.backdrop,
                poster: firstCollection.poster,
                backdrop_path: null
              }
            })
          }
        }
      }, [showCollectionsView, collections.length, viewingCollectionMovies])

      // IMPORTANTE: Usar estado global para persistir categoria entre re-renders
      const currentCategoryIndex = globalState.currentCategoryIndex || 0
      const setCurrentCategoryIndex = (value) => {
        const newValue = typeof value === 'function' ? value(currentCategoryIndex) : value
        window.updateNetflixMoviesState({
          currentCategoryIndex: newValue
        })
      }

      // ===== NOVO: Ref para rastrear a última categoria e evitar resets desnecessários =====
      const lastCategoryIndexRef = useRef(currentCategoryIndex)

      // Registrar listener para re-renderizar quando estado global mudar
      useEffect(() => {
        const listener = (skipRender) => {
          // Se skipRender === true, não forçar re-render (usado para marginContent)
          if (skipRender) return

          // 
          forceUpdate(v => v + 1)
        }
        window.__netflixMoviesListeners.add(listener)
        // 
        return () => {
          window.__netflixMoviesListeners.delete(listener)
          // 
        }
      }, [])

      // ✅ Proteção GLOBAL contra remontagem e loop infinito
      // ===== IMPORTANTE: Criar chave única baseada em contentType + categoryFilter + selectedCategory =====
      const selectedCatId = selectedCategory ? getCatId(selectedCategory) : null
      const viewKey = `${contentType}-${categoryFilter || 'all'}-${selectedCatId || 'all'}`

      useEffect(() => {
        // ===== CORREÇÃO CRÍTICA: Atualizar currentViewKey IMEDIATAMENTE antes de qualquer async =====
        const previousViewKey = globalState.currentViewKey


        // Verificar se JÁ inicializou ESSA VIEW ESPECÍFICA (antes de mudar currentViewKey)
        if(globalState.initialized && previousViewKey === viewKey) {
          return
        }

        // Agora sim, atualizar currentViewKey para a nova view
        globalState.currentViewKey = viewKey

        globalState.initialized = true
        const ac = new AbortController()

        const initMovies = async () => {
          if(ac.signal.aborted) return

          window.updateNetflixMoviesState({ loading: true, errorMsg: '', sectionsMovies: [] })

          try {
            // 1. Carregar categorias VOD ou SERIES dependendo do modo
            const categoryType = isSeriesMode ? 'SÉRIES' : 'VOD'
            const apiAction = isSeriesMode ? 'get_series_categories' : 'get_vod_categories'

            // ===== IMPORTANTE: SEMPRE carregar categorias para garantir filtro correto =====
            let categories = []

            // Sempre buscar da API para garantir que não há cache incorreto
            const raw = await apiCall(apiAction)
            const catsArray = toArray(raw)

            if(!Array.isArray(catsArray) || catsArray.length === 0) {
              throw new Error(`Nenhuma categoria ${categoryType} disponível`)
            }

            categories = catsArray

            // 2. Filtrar categorias se houver filtro específico
            let selectedCategories = categories

            // Se tem uma categoria específica selecionada pelo usuário, usar apenas ela
            if (selectedCategory) {
              const catId = getCatId(selectedCategory)
              selectedCategories = categories.filter(cat => getCatId(cat) === catId)

              if (selectedCategories.length === 0) {
                window.updateNetflixMoviesState({
                  loading: false,
                  errorMsg: `Categoria não encontrada`
                })
                return
              }
            }
            // Aplicar filtro por nome de categoria se especificado
            else if (categoryFilter) {
              const filterLower = categoryFilter.toLowerCase()

              selectedCategories = categories.filter(cat => {
                const catName = (cat.category_name || '').toLowerCase()
                return catName.includes(filterLower)
              })

              if (selectedCategories.length === 0) {
                // ===== CORREÇÃO: NÃO usar todas, mostrar erro =====
                window.updateNetflixMoviesState({
                  loading: false,
                  errorMsg: `Nenhuma categoria encontrada para "${categoryFilter}"`
                })
                return
              }
            }
            // Se não tem filtro nem categoria selecionada, NÃO carregar nada
            // O componente vai aguardar selectedCategory ser definido
            else if (!selectedCategory && !categoryFilter) {
              window.updateNetflixMoviesState({
                loading: false,
                errorMsg: ''
              })
              return
            }

            // ===== CORREÇÃO: Guardar categorias com chave única por view =====
            const categoriesKey = `categories_${viewKey}`
            window[categoriesKey] = selectedCategories
            window[`${categoriesKey}_raw`] = categories

            // Manter compatibilidade (mas serão sobrescritas)
            window.__allAvailableCategories = selectedCategories
            window.__allCategoriesRaw = categories

            // 3. Carregar APENAS a PRIMEIRA categoria (lazy loading)
            const allSections = []

            // Carregar apenas a primeira categoria
            const firstCat = selectedCategories[0]
            const firstCategoryIndex = categories.indexOf(firstCat)

            try {
              // Carregar filmes da primeira categoria
              const section = await loadCategoryMovies(firstCategoryIndex, categories)

              if(section && section.movies && Array.isArray(section.movies) && section.movies.length > 0) {
                allSections.push(section)
              }
            } catch(err) {
            }

            if(allSections.length === 0) {
              throw new Error('Nenhuma categoria com filmes disponível')
            }

            // Atualizar estado com todas as seções
            // ===== FIX: Séries usam series_id, filmes usam stream_id =====
            const firstMovie = allSections[0]?.movies?.[0]
            const firstMovieId = firstMovie?.series_id || firstMovie?.stream_id

            window.updateNetflixMoviesState({
              sectionsMovies: allSections,
              featuredMovieId: firstMovieId,
              totalCategories: selectedCategories.length
            })

            // 4. Carregar índice de coleções pré-construído (instantâneo)
            await loadCollectionsFromJSON(setCollections)

            // ===== OTIMIZADO: Pré-carregar apenas próximas 3 categorias (lazy loading on-demand) =====
            const PRELOAD_LIMIT = 3 // Reduzido de TODAS para apenas 3
            const totalCats = selectedCategories.length
            const categoriesToPreload = Math.min(PRELOAD_LIMIT, totalCats - 1)

            // ===== CORREÇÃO: Armazenar timeout IDs para cancelar no cleanup =====
            const preloadTimeouts = []
            for (let i = 1; i <= categoriesToPreload; i++) {
              const timeoutId = setTimeout(() => {
                // Verificar se ainda estamos na mesma view antes de carregar
                if (globalState.currentViewKey === viewKey && !globalState.sectionsMovies[i]) {
                  loadCategory(i, null, viewKey) // ← PASSAR viewKey!
                } else {
                }
              }, i * 1000) // Escalonar: 1s, 2s, 3s (mais espaçado)
              preloadTimeouts.push(timeoutId)
            }

            // Salvar timeouts no AbortController para cancelar no cleanup
            ac.signal.addEventListener('abort', () => {
              preloadTimeouts.forEach(id => clearTimeout(id))
            })
          } catch(err) {
            window.updateNetflixMoviesState({ errorMsg: err.message || 'Erro ao carregar categorias. Verifique a API/proxy.' })
          } finally {
            window.updateNetflixMoviesState({ loading: false })
          }
        }

        initMovies()

        return () => {
          ac.abort()
        }
      }, [viewKey]) // ===== CORRIGIDO: Dependência viewKey para reinicializar quando mudar =====

      // Resetar scroll horizontal quando mudar de categoria (APENAS quando categoria muda)
      useEffect(() => {
        // ===== NOVO: Só resetar se a categoria REALMENTE mudou =====
        if (currentCategoryIndex === lastCategoryIndexRef.current) {
          return
        }

        lastCategoryIndexRef.current = currentCategoryIndex

        const currentSection = globalState.sectionsMovies[currentCategoryIndex]
        if (currentSection) {
          setMarginContent(prev => ({
            ...prev,
            [currentSection.id]: 0
          }))
        }
      }, [currentCategoryIndex]) // ===== CORRIGIDO: Removido globalState.sectionsMovies das dependências =====

      // Navegação por teclado
      useEffect(() => {
        // Verificar se está em qualquer view do NetflixMovies (filmes, séries, novelas, etc)
        const isNetflixView = ['netflix-movies', 'netflix-series', 'netflix-novelas', 'netflix-animes', 'netflix-desenhos', 'netflix-show'].includes(view)
        if(!isNetflixView || globalState.sectionsMovies.length === 0) return

        const handleKeyDown = (e) => {
          const currentSection = globalState.sectionsMovies[currentCategoryIndex]
          if(!currentSection) return

          if(e.key === 'ArrowRight'){
            e.preventDefault()
            if(currentSection.movies && currentSection.movies.length > 0) {
              setFocusedMovieIdx(prev => Math.min(prev + 1, currentSection.movies.length - 1))
            }
          } else if(e.key === 'ArrowLeft'){
            e.preventDefault()
            if(focusedMovieIdx === 0){
              // Se está no primeiro filme, volta para home
              setView('home')
            } else {
              setFocusedMovieIdx(prev => Math.max(prev - 1, 0))
            }
          } else if(e.key === 'ArrowDown'){
            e.preventDefault()
            // Mudar para próxima categoria
            const totalAvailable = globalState.totalCategories || window.__allAvailableCategories?.length || 0
            if (currentCategoryIndex < totalAvailable - 1) {
              const nextIndex = currentCategoryIndex + 1

              // Atualizar filme em destaque ANTES de mudar categoria (para evitar piscar)
              const nextSection = globalState.sectionsMovies[nextIndex]
              if (nextSection && nextSection.movies && nextSection.movies.length > 0) {
                const firstMovie = nextSection.movies[0]
                const newFeaturedId = firstMovie.stream_id || firstMovie.id
                window.updateNetflixMoviesState({
                  featuredMovieId: newFeaturedId
                })
              }

              // Resetar scroll para 0 com o sectionId correto
              if (nextSection) {
                setMarginContent({ [nextSection.id]: 0 })
              }

              // Mudar categoria
              setCurrentCategoryIndex(nextIndex)
              setFocusedMovieIdx(0)

              // Se a categoria ainda não foi carregada, carregar em background
              if (!nextSection) {
                loadCategory(nextIndex)
              }
            }
          } else if(e.key === 'ArrowUp'){
            e.preventDefault()
            // Mudar para categoria anterior
            if (currentCategoryIndex > 0) {
              const prevIndex = currentCategoryIndex - 1

              // Atualizar filme em destaque ANTES de mudar categoria (para evitar piscar)
              const prevSection = globalState.sectionsMovies[prevIndex]
              if (prevSection && prevSection.movies && prevSection.movies.length > 0) {
                const firstMovie = prevSection.movies[0]
                const newFeaturedId = firstMovie.stream_id || firstMovie.id
                window.updateNetflixMoviesState({
                  featuredMovieId: newFeaturedId
                })
              }

              // Resetar scroll para 0 com o sectionId correto
              if (prevSection) {
                setMarginContent({ [prevSection.id]: 0 })
              }

              // Mudar categoria
              setCurrentCategoryIndex(prevIndex)
              setFocusedMovieIdx(0)

              // Se a categoria ainda não foi carregada, carregar em background
              if (!prevSection) {
                loadCategory(prevIndex)
              }
            }
          } else if(e.key === 'Enter'){
            e.preventDefault()
            if(currentSection.movies && currentSection.movies.length > focusedMovieIdx) {
              const movie = currentSection.movies[focusedMovieIdx]
              if(movie && movie.stream_id){
                setView('player')
                setCurrent({
                  name: movie.name || movie.title,
                  url: buildURL(cfg.server, ['movie', cfg.username, cfg.password, `${movie.stream_id}.${movie.container_extension || 'mp4'}`])
                })
              }
            }
          } else if(e.key === 'Escape'){
            e.preventDefault()
            window.resetNetflixMovies()  // Resetar flag ao sair
            setView('home')
          }
        }

        window.addEventListener('keydown', handleKeyDown)
        return () => window.removeEventListener('keydown', handleKeyDown)
      }, [view, globalState.sectionsMovies, currentCategoryIndex, focusedMovieIdx])

      // Auto-scroll para o item focado
      useEffect(() => {
        const isNetflixView = ['netflix-movies', 'netflix-series', 'netflix-novelas', 'netflix-animes', 'netflix-desenhos', 'netflix-show'].includes(view)
        if(isNetflixView && globalState.sectionsMovies.length > 0){
          const currentSection = globalState.sectionsMovies[currentCategoryIndex]
          if(currentSection && currentSection.movies && currentSection.movies.length > focusedMovieIdx){
            const movie = currentSection.movies[focusedMovieIdx]
            if(movie){
              const el = document.getElementById(`movie-${currentCategoryIndex}-${focusedMovieIdx}`)
              if(el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' })
            }
          }
        }
      }, [currentCategoryIndex, focusedMovieIdx, view, globalState.sectionsMovies])

      // Carregar filmes de uma categoria (retorna objeto seção)
      // Carrega TODOS os filmes da categoria de uma vez
      const loadCategoryMovies = async (categoryIndex, categoriesArray) => {
        const cats = categoriesArray
        const cat = cats[categoryIndex]

        if(!cat || !cat.category_name) {
          return null
        }

        try {
          // Buscar APENAS os filmes/séries desta categoria (performance otimizada)
          const contentLabel = isSeriesMode ? 'séries' : 'filmes'
          const apiAction = isSeriesMode ? 'get_series' : 'get_vod_streams'

          const data = await apiCall(apiAction, { category_id: getCatId(cat) })
          const allMoviesInCategory = toArray(data)


          if(allMoviesInCategory.length === 0) {
            return null
          }

          // Guardar TODOS os filmes mas renderizar inicialmente apenas 10 (performance)
          const INITIAL_LOAD = 10


          // ===== ENRIQUECIMENTO TMDB: Primeiro filme IMEDIATO, resto em background =====

          const PRIORITY_COUNT = 10

          // Enriquecer APENAS o primeiro filme (featured) IMEDIATAMENTE para backdrop instantâneo
          const contentTypeParam = isSeriesMode ? 'series' : 'movie'
          const firstEnriched = await enrichMovieWithTMDB(allMoviesInCategory[0], contentTypeParam)

          // Enriquecer filmes 2-10 em background (não bloquear)
          if (allMoviesInCategory.length > 1) {
            Promise.all(
              allMoviesInCategory.slice(1, PRIORITY_COUNT).map(movie => enrichMovieWithTMDB(movie, contentTypeParam))
            ).then(enrichedMovies => {
            }).catch(err => {
            })
          }

          // Retornar com primeiro filme enriquecido + resto sem enriquecer
          const finalMovies = [firstEnriched, ...allMoviesInCategory.slice(1)]


          // Retornar TODOS os filmes da categoria
          // A renderização será feita sob demanda (scroll infinito)
          return {
            id: categoryIndex,
            name: cat.category_name,
            movies: finalMovies,
            totalMovies: finalMovies.length,
            visibleCount: INITIAL_LOAD  // Quantos renderizar inicialmente
          }
        } catch(err) {
          return null
        }
      }

      // Carregar uma categoria específica (usa loadCategoryMovies e atualiza estado)
      const loadCategory = async (categoryIndex, categoriesArray = null, forceViewKey = null) => {
        // ===== CORREÇÃO: Usar categorias específicas do viewKey PASSADO ou atual =====
        const useViewKey = forceViewKey || viewKey
        const categoriesKey = `categories_${useViewKey}`
        const cats = categoriesArray || window[`${categoriesKey}_raw`] || window.__allCategoriesRaw || vodCats
        const availableCategories = window[categoriesKey] || window.__allAvailableCategories || []

        // ===== VERIFICAÇÃO CRÍTICA: Abortar se não é mais a view correta =====
        if (useViewKey !== globalState.currentViewKey) {
          return
        }

        if(categoryIndex < 0 || categoryIndex >= availableCategories.length) {
          return
        }

        // Verificar se já está carregada
        if(globalState.sectionsMovies[categoryIndex]) {
          return
        }

        // ===== CORRIGIDO: Permitir múltiplos carregamentos simultâneos =====
        // Verificar se esta categoria específica já está sendo carregada
        if(loadingCategoriesRef.current.has(categoryIndex)) {
          return
        }

        const cat = availableCategories[categoryIndex]
        if(!cat) {
          return
        }

        // Adicionar ao Set de categorias em carregamento
        loadingCategoriesRef.current.add(categoryIndex)

        try {
          const catInRawArray = cats.indexOf(cat)
          const section = await loadCategoryMovies(catInRawArray, cats)

          // ===== FIX: Validar section ANTES de adicionar (verificar se tem movies) =====
          if(section && section.movies && Array.isArray(section.movies) && section.movies.length > 0) {
            // Adicionar a nova seção na posição correta (não substituir)
            const newSections = [...globalState.sectionsMovies]
            newSections[categoryIndex] = section

            // ===== CORRIGIDO: NÃO mudar featuredMovieId em pré-carregamento =====
            // Só atualizar sectionsMovies, preservar featuredMovieId atual
            window.updateNetflixMoviesState({
              sectionsMovies: newSections
            })
          } else {
          }
        } catch(err){
        } finally {
          // Remover do Set de categorias em carregamento
          loadingCategoriesRef.current.delete(categoryIndex)
        }
      }

      const loadMoviesRef = useRef(false)

      const loadMovies = async () => {
        // Proteção: se já carregou, não carrega de novo
        if(loadMoviesRef.current) {
          return
        }

        loadMoviesRef.current = true
        window.updateNetflixMoviesState({ loading: true })

        if(vodCats.length === 0){
          window.updateNetflixMoviesState({ loading: false })
          loadMoviesRef.current = false
          return
        }

        // Carregar apenas a primeira categoria
        await loadCategory(0)

        window.updateNetflixMoviesState({ loading: false })
      }

      // Scroll handler - PART 1: Netflix-style scroll (6 cards visible)
      const handleScrollMovies = (sectionId, direction) => {
        // 

        setMarginContent(state => {
          const currentMargin = state[sectionId] || 0
          const cardWidth = 280 // Largura de cada card (260px + 20px gap)
          const padding = 80 // 40px cada lado
          const viewportWidth = window.innerWidth - padding

          // Calcula quantos cards cabem na tela (6 cards)
          const cardsVisible = Math.floor(viewportWidth / cardWidth)

          // Previne scroll excessivo
          const section = globalState.sectionsMovies.find(s => s.id === sectionId)
          const totalMovies = section?.movies.length || 0
          const totalWidth = totalMovies * cardWidth
          const maxScroll = Math.min(0, -(totalWidth - viewportWidth))

          // Se não há necessidade de scroll (tudo cabe na tela), não faz nada
          if (totalWidth <= viewportWidth) {
            return state
          }

          // Scroll dinâmico baseado em cards visíveis (scroll de 1 página por vez)
          const scrollAmount = cardsVisible * cardWidth
          let newValue = currentMargin + (direction === 'left' ? -scrollAmount : scrollAmount)

          // Limita o scroll SEM loop circular (scroll normal)
          let finalValue = newValue
          if (direction === 'left') {
            // Scrollando para direita (mostrando mais filmes)
            finalValue = Math.max(newValue, maxScroll)
          } else {
            // Scrollando para esquerda (voltando)
            finalValue = Math.min(newValue, 0)
          }

          // 

          // ===== NOVO: Log do estado completo que será retornado =====
          const newState = {
            ...state,
            [sectionId]: finalValue
          }
          // 

          // ===== DESABILITADO: Não atualizar featured movie durante scroll horizontal =====
          // Isso causava re-renders (piscadas) a cada clique na seta
          // O featured movie só muda ao trocar de categoria (teclas ↑↓)
          // if (section && section.movies.length > 0) {
          //   const centerPosition = Math.abs(finalValue) + (viewportWidth / 2)
          //   const centerMovieIndex = Math.floor(centerPosition / cardWidth)
          //   if (centerMovieIndex >= 0 && centerMovieIndex < section.movies.length) {
          //     const newFeaturedMovie = section.movies[centerMovieIndex]
          //     const newFeaturedId = newFeaturedMovie.stream_id || newFeaturedMovie.id
          //     if (newFeaturedId !== globalState.featuredMovieId) {
          //       window.updateNetflixMoviesState({ featuredMovieId: newFeaturedId })
          //     }
          //   }
          // }

          // ===== CORRIGIDO: Retornar o estado que já criamos =====
          return newState
        })
      }

      // COMPONENTE: Loading (SEM LETRA N)
      const Loading = () => {
        return e('div', {
          style: {
            display: 'flex',
            width: '100%',
            height: '100vh',
            background: '#111'
          }
        },
          e('div', {
            style: {
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              margin: 'auto',
              width: '60px',
              height: '60px',
              position: 'relative'
            }
          },
            // Spinner simples (sem letra)
            e('div', {
              style: {
                width: '60px',
                height: '60px',
                border: '4px solid rgba(168, 85, 247, 0.3)',
                borderTop: '4px solid #a855f7',
                borderRadius: '50%',
                animation: 'spin 1s linear infinite'
              }
            })
          )
        )
      }

      // COMPONENTE: FeaturedMovie
      const FeaturedMovie = React.memo(({ featuredMovieId }) => {
        const [movie, setMovie] = useState(null)
        const [previousMovie, setPreviousMovie] = useState(null)
        const [showPrevious, setShowPrevious] = useState(false)
        // State para controlar se a imagem falhou ao carregar
        const [imageError, setImageError] = useState(false)
        const transitionTimeoutRef = useRef(null)
        const lastProcessedIdRef = useRef(null) // ===== NOVO: Evitar reprocessamento =====


        // Helper: Format runtime (minutes to "1h 33min")
        const formatRuntime = (minutes) => {
          if(!minutes) return null
          const h = Math.floor(minutes / 60)
          const m = minutes % 60
          return h > 0 ? `${h}h ${m}min` : `${m}min`
        }

        useEffect(() => {
          if(!featuredMovieId) return

          // ===== OTIMIZAÇÃO: Evitar loop de re-render =====
          if(lastProcessedIdRef.current === featuredMovieId) {
            return
          }
          lastProcessedIdRef.current = featuredMovieId

          // Buscar filme nas seções
          let foundMovie = null
          for(let section of globalState.sectionsMovies){
            // ===== FIX: Verificar se section existe E tem movies array =====
            if(section && section.movies && Array.isArray(section.movies) && section.movies.length > 0) {
              foundMovie = section.movies.find(m => (m.series_id || m.stream_id) === featuredMovieId)
              if(foundMovie) break
            }
          }

          if(foundMovie){
            // ===== FIX: Usar series_id para séries, stream_id para filmes =====
            const movieId = foundMovie.series_id || foundMovie.stream_id

            // Verificar se já está no cache GLOBAL
            if(window.__enrichedMoviesCache[movieId]) {
              const cachedMovie = window.__enrichedMoviesCache[movieId]

              // ===== GUARD: Se é o mesmo filme, NÃO atualizar (evita re-render) =====
              if(movie && movie.id === movieId) {
                return
              }

              // ===== FIX: Preload da imagem antes de mostrar =====
              const preloadImage = (url) => {
                return new Promise((resolve) => {
                  if (!url) {
                    resolve();
                    return;
                  }
                  const img = new Image();
                  img.onload = () => {
                    resolve();
                  };
                  img.onerror = () => {
                    resolve(); // Continua mesmo se falhar
                  };
                  img.src = url;
                });
              };

              // Preload imagem de forma async
              (async () => {
                await preloadImage(cachedMovie.imageUrl);

              // Guardar filme anterior para crossfade
              if(movie) {
                setPreviousMovie(movie)
                setShowPrevious(true)

                // Limpar timeouts anteriores
                if(transitionTimeoutRef.current) clearTimeout(transitionTimeoutRef.current)

                // Setar novo filme
                setMovie(cachedMovie)

                // Após React renderizar, iniciar fade
                setTimeout(() => {
                  setShowPrevious(false)
                }, 50)

                // Limpar previousMovie após transição completar
                transitionTimeoutRef.current = setTimeout(() => {
                  setPreviousMovie(null)
                }, 850) // 50ms + 800ms transition
              } else {
                // Primeiro filme, sem transição
                setMovie(cachedMovie)
              }
              })(); // Fechar async IIFE
              return
            }

            // Enriquecer este filme específico com TMDB se ainda não tiver dados
            const enrichAndSetMovie = async () => {
              let enrichedMovie = foundMovie

              // Se não tem dados TMDB completos, buscar agora
              if(!foundMovie.tmdb_overview || !foundMovie.tmdb_genres) {
                const detectedType = foundMovie.series_id ? 'series' : 'movie'
                enrichedMovie = await enrichMovieWithTMDB(foundMovie, detectedType)
              }

              // Helper: validar se URL de imagem é válida
              const isValidImageUrl = (url) => {
                if (!url || typeof url !== 'string') return false
                // Verificar se começa com http/https
                if (!url.startsWith('http://') && !url.startsWith('https://')) return false
                // Verificar se tem extensão de imagem ou é do TMDB
                return url.includes('image.tmdb.org') || /\.(jpg|jpeg|png|webp|gif)$/i.test(url)
              }

              // Helper: verificar se é backdrop (horizontal) ou poster (vertical)
              const isBackdropUrl = (url) => {
                if (!url) return false
                // Backdrops do TMDB sempre tem /w1280/ ou /original/ e não tem 'poster' no path
                return url.includes('/w1280/') || url.includes('/original/') ||
                       (url.includes('image.tmdb.org') && !url.includes('/w500/'))
              }

              // Prioridade: backdrops TMDB → stream_icon (se válido) → poster TMDB
              const getValidBackdrop = () => {
                // 1. Tentar backdrops do TMDB (melhor qualidade)
                const tmdbBackdrops = [
                  enrichedMovie.tmdb_backdrop,
                  enrichedMovie.backdrop_path
                ]

                for (const url of tmdbBackdrops) {
                  if (isValidImageUrl(url) && isBackdropUrl(url)) {
                    return url
                  }
                }

                // 2. Tentar stream_icon do servidor (geralmente funciona)
                if (enrichedMovie.stream_icon && isValidImageUrl(enrichedMovie.stream_icon)) {
                  // Evitar apenas se for claramente um poster pequeno
                  if (!enrichedMovie.stream_icon.includes('/w500/')) {
                    return enrichedMovie.stream_icon
                  }
                }

                // 3. Tentar cover do servidor
                if (enrichedMovie.cover && isValidImageUrl(enrichedMovie.cover)) {
                  if (!enrichedMovie.cover.includes('/w500/')) {
                    return enrichedMovie.cover
                  }
                }

                // 4. Como último recurso, usar poster do TMDB
                if (enrichedMovie.tmdb_poster && isValidImageUrl(enrichedMovie.tmdb_poster)) {
                  return enrichedMovie.tmdb_poster
                }

                // 5. Se nada funcionar, retornar null (vai usar gradiente)
                return null
              }

              const backdropUrl = getValidBackdrop()

              const movieData = {
                id: enrichedMovie.series_id || enrichedMovie.stream_id,
                name: enrichedMovie.name || enrichedMovie.title,
                imageUrl: backdropUrl,
                rating: enrichedMovie.tmdb_rating ? (enrichedMovie.tmdb_rating * 10).toFixed(0) : '85',
                releaseDate: enrichedMovie.tmdb_year || enrichedMovie.year || '2024',
                runtime: enrichedMovie.tmdb_runtime || enrichedMovie.duration || '',
                overview: enrichedMovie.tmdb_overview || enrichedMovie.plot || enrichedMovie.description || 'Sem descrição disponível',
                genres: enrichedMovie.tmdb_genres || enrichedMovie.genre || 'Filme'
              }

              // Armazenar no cache GLOBAL
              window.__enrichedMoviesCache[movieId] = movieData

              // Guardar filme anterior para crossfade
              if(movie) {
                setPreviousMovie(movie)
                setShowPrevious(true)

                // Limpar timeouts anteriores
                if(transitionTimeoutRef.current) clearTimeout(transitionTimeoutRef.current)

                // Setar novo filme
                setMovie(movieData)

                // Após React renderizar, iniciar fade
                setTimeout(() => {
                  setShowPrevious(false)
                }, 50)

                // Limpar previousMovie após transição completar
                transitionTimeoutRef.current = setTimeout(() => {
                  setPreviousMovie(null)
                }, 850)
              } else {
                // Primeiro filme, sem transição
                setMovie(movieData)
              }
            }

            enrichAndSetMovie()
          }
        }, [featuredMovieId])

        // Preload image e detectar erro
        useEffect(() => {
          if (!movie?.imageUrl) {
            setImageError(false)
            return
          }

          setImageError(false)
          const img = new Image()
          img.onload = () => setImageError(false)
          img.onerror = () => {
            setImageError(true)
          }
          img.src = movie.imageUrl
        }, [movie?.imageUrl])

        // IMPORTANTE: Sempre mostrar algo, nunca retornar null
        const displayMovie = movie || previousMovie
        if(!displayMovie || !displayMovie.id) return null

        const gradientBg = '#000'
        const shouldUseGradient = !movie?.imageUrl || imageError || movie.imageUrl === 'null' || movie.imageUrl === 'undefined'

        return e('div', {
          style: {
            position: 'absolute',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            width: '100%',
            overflow: 'hidden'
          }
        },
          // Previous background (fades out)
          previousMovie && e('div', {
            style: {
              position: 'absolute',
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              backgroundImage: previousMovie.imageUrl && previousMovie.imageUrl !== 'null' && previousMovie.imageUrl !== 'undefined'
                ? `url(${previousMovie.imageUrl})`
                : gradientBg,
              backgroundSize: 'cover',
              backgroundPosition: '50% 0%',
              opacity: showPrevious ? 1 : 0,
              transition: 'opacity 0.8s ease-in-out',
              zIndex: 1
            }
          }),
          // Current background (fades in)
          movie && e('div', {
            style: {
              position: 'absolute',
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              // ===== FIX: Background sólido escuro para evitar piscar branco =====
              backgroundColor: '#0a0a0a',
              backgroundImage: shouldUseGradient ? gradientBg : `url(${movie.imageUrl})`,
              backgroundSize: 'cover',
              backgroundPosition: '50% 0%',
              imageRendering: 'crisp-edges',
              WebkitBackfaceVisibility: 'hidden',
              backfaceVisibility: 'hidden',
              transform: 'translateZ(0)',
              opacity: showPrevious ? 0 : 1,
              transition: 'opacity 0.8s ease-in-out',
              zIndex: 2
            }
          }),
          // Container for gradient and content
          e('div', {
            style: {
              position: 'absolute',
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              zIndex: 3
            }
          },
            // Gradient overlay
            e('div', {
              style: {
                width: '100%',
                height: '100%',
                background: 'linear-gradient(to top, #111 25%, transparent 60%)'
              }
            },
              // Content com transição suave
              e('div', {
                style: {
                  display: 'flex',
                  flexDirection: 'column',
                  alignItems: 'flex-start',
                  justifyContent: 'flex-start', // Alinha no topo
                  padding: '60px 40px 0 40px', // Padding mínimo no topo
                  width: '100%',
                  height: '100%',
                  background: 'linear-gradient(to right, rgba(0,0,0,0.6) 40%, transparent 60%)'
                }
              },
                // Title
                e('h1', {
                  style: {
                    fontSize: '42px',
                    marginBottom: '12px',
                    marginTop: '0',
                    color: '#fff',
                    fontWeight: 'bold',
                    textShadow: '2px 2px 8px rgba(0,0,0,0.8)',
                    maxWidth: '650px',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                    whiteSpace: 'nowrap'
                  }
                }, displayMovie.name || displayMovie.title),

                // MovieInfo (rating, year, runtime) - usa dados do TMDB quando disponível
                e('div', {
                  style: {
                    display: 'flex',
                    flexDirection: 'row',
                    alignItems: 'center',
                    marginBottom: '10px',
                    gap: '12px'
                  }
                },
                  // Rating TMDB
                  (displayMovie.tmdb_rating || displayMovie.rating) && e('span', {
                    style: {
                      fontSize: '17px',
                      color: '#46d369',
                      fontWeight: 700
                    }
                  }, displayMovie.tmdb_rating ? `⭐ ${(displayMovie.tmdb_rating * 10).toFixed(0)}%` : `${displayMovie.rating}% relevante`),

                  // Ano
                  (displayMovie.tmdb_year || displayMovie.releaseDate) && e('span', {
                    style: {
                      fontSize: '17px',
                      color: '#fff'
                    }
                  }, displayMovie.tmdb_year || displayMovie.releaseDate),

                  // Runtime
                  (displayMovie.tmdb_runtime || displayMovie.runtime) && e('span', {
                    style: {
                      fontSize: '17px',
                      color: '#fff'
                    }
                  }, typeof (displayMovie.tmdb_runtime || displayMovie.runtime) === 'number'
                    ? formatRuntime(displayMovie.tmdb_runtime || displayMovie.runtime)
                    : (displayMovie.tmdb_runtime || displayMovie.runtime))
                ),

                // Overview (descrição do TMDB é priorizada)
                e('p', {
                  style: {
                    width: '650px',
                    fontSize: '17px',
                    lineHeight: '1.5',
                    textShadow: '2px 2px 4px rgba(0,0,0,0.8)',
                    marginBottom: '10px',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis',
                    display: '-webkit-box',
                    WebkitLineClamp: '3',
                    WebkitBoxOrient: 'vertical',
                    color: '#fff'
                  }
                }, displayMovie.tmdb_overview || displayMovie.overview),

                // Genres (prioriza TMDB)
                (displayMovie.tmdb_genres || displayMovie.genres) && e('span', {
                  style: {
                    fontSize: '15px',
                    color: '#ccc',
                    marginBottom: '12px',
                    fontWeight: '500'
                  }
                }, '🎭 ', displayMovie.tmdb_genres || displayMovie.genres),

                // Buttons
                e('div', {
                  style: {
                    display: 'flex',
                    alignItems: 'center',
                    gap: '10px'
                  }
                },
                  // Play button
                  e('a', {
                    href: '#',
                    onClick: (ev) => {
                      ev.preventDefault()
                      const foundMovie = globalState.sectionsMovies.flatMap(s => s.movies).find(m => m.stream_id === globalState.featuredMovieId)
                      if(foundMovie){
                        setView('player')
                        setCurrent({
                          name: foundMovie.name || foundMovie.title,
                          url: buildURL(cfg.server, ['movie', cfg.username, cfg.password, `${foundMovie.stream_id}.${foundMovie.container_extension || 'mp4'}`])
                        })
                      }
                    },
                    style: {
                      display: 'flex',
                      alignItems: 'center',
                      padding: '9px 24px',
                      borderRadius: '5px',
                      cursor: 'pointer',
                      textDecoration: 'none',
                      fontSize: '20px',
                      background: '#fff',
                      color: '#000',
                      border: 'none',
                      fontWeight: '600'
                    }
                  }, '▶ Assistir'),

                  // Trailer button
                  e('a', {
                    href: '#',
                    onClick: (ev) => {
                      ev.preventDefault()
                      alert('Funcionalidade em breve!')
                    },
                    style: {
                      display: 'flex',
                      alignItems: 'center',
                      padding: '9px 24px',
                      borderRadius: '5px',
                      cursor: 'pointer',
                      textDecoration: 'none',
                      fontSize: '20px',
                      background: 'rgba(109,109,110,0.7)',
                      color: '#fff',
                      fontWeight: '600'
                    }
                  }, '🎬 Trailer')
                )
              )
            )
          )
        )
      }, (prevProps, nextProps) => {
        // Custom comparison: só re-render se featuredMovieId mudar
        return prevProps.featuredMovieId === nextProps.featuredMovieId
      })

      // COMPONENTE: CollectionCard (Card de coleção para carrossel horizontal)
      const CollectionCard = React.memo(({ collection, onClick, sectionId, idx }) => {
        const [isHovered, setIsHovered] = useState(false)
        const isHoveredRef = useRef(false)
        const [fullCollection, setFullCollection] = useState(collection.overview ? collection : null)
        const [isLoading, setIsLoading] = useState(false)
        const hasEnrichedRef = useRef(false)

        // Sincronizar com a prop collection quando ela muda (já vem enriquecida)
        useEffect(() => {
          if (collection.overview && !fullCollection?.overview) {
            setFullCollection(collection)
            hasEnrichedRef.current = true
          }
        }, [collection.id])

        // Buscar detalhes completos da coleção ao passar o mouse (só se não tiver overview)
        useEffect(() => {
          if (isHovered && !hasEnrichedRef.current && !fullCollection?.overview && !isLoading) {
            hasEnrichedRef.current = true
            setIsLoading(true)
            getTMDBCollection(collection.id).then(data => {
              if(data) {
                setFullCollection(data)
              }
              setIsLoading(false)
            }).catch(() => {
              setIsLoading(false)
              hasEnrichedRef.current = false // Reset para tentar novamente
            })
          }
        }, [isHovered, collection.id])

        // Atualizar backdrop do hero ao passar o mouse
        const updateHeroBackdropFromCollection = (coll) => {
          if (!coll || !window.updateNetflixMoviesState) return

          window.updateNetflixMoviesState({
            heroBackdrop: {
              name: coll.name,
              overview: coll.overview || `Coleção com ${collection.movies?.length || 0} filmes`,
              backdrop: coll.backdrop,
              poster: coll.poster,
              backdrop_path: null // Já temos a URL completa em backdrop
            }
          })
        }

        const displayCollection = fullCollection || collection
        const movieCount = collection.movies?.length || 0

        return e('div', {
          style: {
            flexShrink: 0,
            width: '260px',
            height: '390px',
            marginRight: '20px',
            position: 'relative',
            borderRadius: '8px',
            overflow: 'visible',
            cursor: 'pointer',
            transform: isHovered ? 'scale(1.15)' : 'scale(1)',
            transformOrigin: 'center center',
            transition: 'all 0.3s ease-out',
            boxShadow: isHovered ? '0 12px 32px rgba(0,0,0,0.9)' : '0 2px 8px rgba(0,0,0,0.3)',
            zIndex: isHovered ? 999999 : 'auto'
          },
          onMouseEnter: () => {
            isHoveredRef.current = true
            setIsHovered(true)
            updateHeroBackdropFromCollection(displayCollection)
          },
          onMouseLeave: () => {
            isHoveredRef.current = false
            setIsHovered(false)
          },
          onClick: () => onClick(displayCollection, collection.movies)
        },
          // Poster/Backdrop
          e('img', {
            src: displayCollection.poster || displayCollection.backdrop || '',
            alt: displayCollection.name,
            loading: 'lazy',
            style: {
              width: '100%',
              height: '100%',
              objectFit: 'cover',
              filter: isHovered ? 'brightness(0.4)' : 'brightness(1)',
              transition: 'filter 0.3s ease',
              pointerEvents: 'none',
              borderRadius: '8px'
            }
          }),

          // Overlay com informações (aparece no hover)
          isHovered && e('div', {
            style: {
              position: 'absolute',
              top: '0',
              left: '0',
              width: '100%',
              height: '100%',
              background: 'rgba(0, 0, 0, 0.85)',
              backdropFilter: 'blur(6px)',
              WebkitBackdropFilter: 'blur(6px)',
              opacity: 1,
              transition: 'all 0.3s ease',
              padding: '14px 12px',
              display: 'flex',
              flexDirection: 'column',
              justifyContent: 'flex-start',
              gap: '8px',
              pointerEvents: 'none',
              zIndex: 2,
              borderRadius: '8px'
            }
          },
            // Título no topo
            e('div', {
              style: {
                fontSize: '15px',
                fontWeight: 'bold',
                color: '#fff',
                lineHeight: '1.2',
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                display: '-webkit-box',
                WebkitLineClamp: '2',
                WebkitBoxOrient: 'vertical',
                marginBottom: '4px'
              }
            }, displayCollection.name),

            // Contador de filmes
            e('div', {
              style: {
                fontSize: '12px',
                color: '#4ade80',
                fontWeight: '600',
                marginBottom: '6px'
              }
            }, `📚 ${movieCount} ${movieCount === 1 ? 'filme' : 'filmes'}`),

            // Overview da coleção (se disponível)
            displayCollection.overview && e('p', {
              style: {
                fontSize: '11px',
                color: '#ccc',
                lineHeight: '1.4',
                overflow: 'hidden',
                textOverflow: 'ellipsis',
                display: '-webkit-box',
                WebkitLineClamp: '4',
                WebkitBoxOrient: 'vertical',
                marginBottom: 'auto',
                flex: '1'
              }
            }, displayCollection.overview),

            // Botão visual (fixo no bottom)
            e('div', {
              style: {
                background: '#fff',
                color: '#000',
                padding: '8px 14px',
                borderRadius: '4px',
                fontSize: '13px',
                fontWeight: 'bold',
                textAlign: 'center',
                pointerEvents: 'auto',
                marginTop: '8px'
              }
            }, '▶ Ver Coleção')
          )
        )
      }, (prevProps, nextProps) => {
        // Custom comparison: só re-render se collection.id mudar
        return prevProps.collection.id === nextProps.collection.id &&
               prevProps.sectionId === nextProps.sectionId &&
               prevProps.idx === nextProps.idx
      })

      // COMPONENTE: Movie (Card individual) - PART 2: Enhanced hover with TMDB data
      const Movie = React.memo(({ movie, sectionId, idx }) => {
        const [isHovered, setIsHovered] = useState(false)
        const isHoveredRef = useRef(false) // Mantém estado durante re-renders
        const [enrichedMovie, setEnrichedMovie] = useState(movie)
        // Estados para trailer DENTRO do card (estilo Netflix)
        const [showTrailerInCard, setShowTrailerInCard] = useState(false)
        const [cardTrailerUrl, setCardTrailerUrl] = useState(null)
        const [isMuted, setIsMuted] = useState(false)
        const trailerContainerRef = useRef(null)
        const cardRef = useRef(null)
        const isEnrichingRef = useRef(false) // Evitar múltiplas chamadas de enriquecimento
        // isFocused removido - apenas hover do mouse ativa o efeito

        // Sincronizar enrichedMovie com prop movie quando ela muda (já vem enriquecida do initMovies)
        useEffect(() => {
          if (movie.tmdb_rating && !enrichedMovie.tmdb_rating) {
            setEnrichedMovie(movie)
          }
        }, [movie.stream_id])

        // ===== AUTO-ENRIQUECIMENTO: Se o filme não tem dados TMDB, buscar automaticamente =====
        useEffect(() => {
          // Verificar se já está enriquecendo OU se já tem dados TMDB
          if (isEnrichingRef.current || enrichedMovie.tmdb_poster || enrichedMovie.tmdb_overview) {
            return
          }

          if (!movie.tmdb_poster && !movie.tmdb_overview && movie.stream_id) {
            isEnrichingRef.current = true
            const detectedType = movie.series_id ? 'series' : 'movie'
            enrichMovieWithTMDB(movie, detectedType).then(enriched => {
              setEnrichedMovie(enriched)
              isEnrichingRef.current = false
            }).catch(err => {
              isEnrichingRef.current = false
            })
          }
        }, [movie.stream_id])

        // Buscar e mostrar trailer DENTRO DO CARD (estilo Netflix)
        // ===== OTIMIZAÇÃO: Usar ref para evitar recriações desnecessárias do timer =====
        const tmdbIdRef = useRef(enrichedMovie.tmdb_id)
        useEffect(() => {
          tmdbIdRef.current = enrichedMovie.tmdb_id
        }, [enrichedMovie.tmdb_id])

        useEffect(() => {
          let timeoutId = null

          if (isHoveredRef.current && tmdbIdRef.current) {
            // Delay de 1500ms (1.5s) como Netflix
            timeoutId = setTimeout(async () => {
              if (isHoveredRef.current) {
                const trailerUrl = await getTMDBTrailer(tmdbIdRef.current, 'movie')
                if (trailerUrl && isHoveredRef.current) {
                  setCardTrailerUrl(trailerUrl)
                  setShowTrailerInCard(true)
                }
              }
            }, 1500)
          } else if (!isHoveredRef.current) {
            // Limpar trailer quando sair do hover
            setShowTrailerInCard(false)
            setCardTrailerUrl(null)
            setIsMuted(false)
          }

          return () => {
            if (timeoutId) {
              clearTimeout(timeoutId)
              // 
            }
          }
        }, [isHovered])

        // Helper: Format runtime (minutes to "1h 33min")
        const formatRuntime = (minutes) => {
          if(!minutes) return null
          const h = Math.floor(minutes / 60)
          const m = minutes % 60
          return h > 0 ? `${h}h ${m}min` : `${m}min`
        }

        return e('div', {
          ref: cardRef,
          id: `movie-${sectionId}-${idx}`,
          style: {
            flexShrink: 0,
            width: '260px',
            height: '390px',
            marginRight: '20px',
            position: 'relative',
            zIndex: isHovered ? 999999 : 'auto',
            cursor: 'pointer',
            borderRadius: '8px',
            overflow: 'visible',
            transform: isHovered ? 'scale(1.15)' : 'scale(1)',
            transformOrigin: 'center center',
            boxShadow: isHovered ? '0 12px 32px rgba(0,0,0,0.9)' : '0 2px 8px rgba(0,0,0,0.3)',
            transition: 'transform 0.3s ease-out, box-shadow 0.3s ease-out, z-index 0s',
            willChange: 'transform' // Otimização para GPU
          },
          onClick: async (e) => {
            e.stopPropagation()

            // ===== NAVEGAR PARA PÁGINA DE DETALHES =====

            // Preparar dados enriquecidos para página de detalhes
            const contentData = {
              ...enrichedMovie,
              ...movie,
              series_id: isSeriesMode ? (movie.series_id || movie.stream_id || movie.id) : null,
              stream_id: movie.stream_id || movie.id
            }


            // Se for série, buscar info adicional da API (episódios, temporadas)
            if (isSeriesMode) {
              try {
                const seriesId = movie.series_id || movie.stream_id || movie.id
                const seriesInfo = await apiCall('get_series_info', { series_id: seriesId })

                // Contar episódios e temporadas
                const seasons = seriesInfo.episodes || {}
                const seasonsCount = Object.keys(seasons).length
                let episodesCount = 0
                Object.values(seasons).forEach(seasonEps => {
                  if (Array.isArray(seasonEps)) episodesCount += seasonEps.length
                })

                contentData.episodes_count = episodesCount
                contentData.seasons_count = seasonsCount
                contentData.seriesInfo = seriesInfo // Guardar para uso posterior
              } catch(err) {
              }
            }

            // Navegar para página de detalhes
            setSelectedContent(contentData)
            setView('serie-details')
          },
          onMouseEnter: () => {
            // Ao passar o mouse, atualiza backdrop (APENAS SE MUDOU)
            const movieId = movie.series_id || movie.stream_id || movie.id

            // ✅ OTIMIZAÇÃO: Só atualiza se for um filme DIFERENTE
            if (window.__netflixMoviesState?.featuredMovieId !== movieId) {
              if (window.updateNetflixMoviesState) {
                window.updateNetflixMoviesState({
                  featuredMovieId: movieId,
                  heroBackdrop: null // Limpar backdrop de coleções ao passar mouse em filme
                })
              }
            }

            isHoveredRef.current = true
            setIsHovered(true)
          },
          onMouseLeave: () => {
            isHoveredRef.current = false
            setIsHovered(false)
          }
        },
          // Poster ou placeholder (sempre visível, mas escurecido no hover)
          (enrichedMovie.stream_icon || enrichedMovie.cover || enrichedMovie.tmdb_poster)
            ? e('img', {
                src: enrichedMovie.stream_icon || enrichedMovie.cover || enrichedMovie.tmdb_poster,
                alt: `Capa do filme ${enrichedMovie.name || enrichedMovie.title}`,
                loading: 'lazy',
                style: {
                  width: '100%',
                  height: '100%',
                  objectFit: 'cover',
                  display: 'block',
                  filter: isHovered ? 'brightness(0.4)' : 'brightness(1)',
                  transition: 'filter 0.3s ease',
                  pointerEvents: 'none',
                  borderRadius: '8px'
                }
              })
            : e('div', {
                style: {
                  width: '100%',
                  height: '100%',
                  background: '#000',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  flexDirection: 'column',
                  gap: '10px',
                  borderRadius: '8px',
                  filter: isHovered ? 'brightness(0.4)' : 'brightness(1)',
                  transition: 'filter 0.3s ease'
                }
              },
                e('div', {
                  style: {
                    width: '60px',
                    height: '60px',
                    border: '4px solid rgba(244, 117, 33, 0.3)',
                    borderTop: '4px solid #f47521',
                    borderRadius: '50%',
                    animation: 'spin 1s linear infinite'
                  }
                }),
                e('div', {
                  style: {
                    color: '#888',
                    fontSize: '12px',
                    textAlign: 'center',
                    padding: '0 20px'
                  }
                }, 'Carregando...')
              ),

          // Badge "L" para legendado
          enrichedMovie.isLegendado && e('span', {
            className: 'lang-badge'
          }, 'L'),

          // Trailer NO TOPO do card (estilo Netflix)
          showTrailerInCard && cardTrailerUrl && e('div', {
            ref: trailerContainerRef,
            onClick: (ev) => {
              ev.stopPropagation()
              // Abrir em tela cheia
              const elem = trailerContainerRef.current
              if (elem) {
                if (elem.requestFullscreen) {
                  elem.requestFullscreen()
                } else if (elem.webkitRequestFullscreen) {
                  elem.webkitRequestFullscreen()
                } else if (elem.mozRequestFullScreen) {
                  elem.mozRequestFullScreen()
                } else if (elem.msRequestFullscreen) {
                  elem.msRequestFullscreen()
                }
              }
            },
            style: {
              position: 'absolute',
              top: 0,
              left: 0,
              width: '100%',
              height: '60%',
              overflow: 'hidden',
              zIndex: 1,
              cursor: 'pointer',
              backgroundColor: '#000'
            }
          },
            e('iframe', {
              src: cardTrailerUrl + `?autoplay=1&mute=${isMuted ? 1 : 0}&controls=1&rel=0&modestbranding=1&loop=1&playlist=` + cardTrailerUrl.split('/embed/')[1],
              allow: 'autoplay; encrypted-media; fullscreen',
              allowFullScreen: true,
              style: {
                width: '100%',
                height: '100%',
                border: 'none'
              }
            })
          ),

        ) // End card container
      }, (prevProps, nextProps) => {
        // Custom comparison: só re-render se movie.stream_id mudar
        return prevProps.movie.stream_id === nextProps.movie.stream_id &&
               prevProps.sectionId === nextProps.sectionId &&
               prevProps.idx === nextProps.idx
      })

      // COMPONENTE: CollectionsGrid (Grade de coleções)
      // COMPONENTE: SectionMovies
      const SectionMovies = ({ name, movies, sectionId, categoryIndex, totalCategories, onNextCategory, onPrevCategory, isCollectionsMode }) => {
        console.log('[SectionMovies] name:', name, 'movies:', movies?.length, 'isCollectionsMode:', isCollectionsMode)

        // Proteção contra movies undefined
        if (!movies || !Array.isArray(movies)) {
          console.log('[SectionMovies] RETORNANDO NULL - movies inválido')
          return null
        }

        // ===== STATE LOCAL apenas para currentMargin (para atualizar botões) =====
        const [currentMargin, setCurrentMargin] = useState(marginContentRef.current[sectionId] || 0)
        const marginRef = useRef(currentMargin)
        const [visibleCount, setVisibleCount] = useState(Math.min(50, movies.length)) // Carregar 50 filmes inicialmente ou todos se tiver menos
        const [hovering, setHovering] = useState(false)
        const [hoveringLeft, setHoveringLeft] = useState(false)
        const [hoveringRight, setHoveringRight] = useState(false)
        const verticalScrollTimeoutRef = useRef(null)

        // ===== Registrar listener para receber atualizações de margin =====
        useEffect(() => {
          const unregister = registerMarginListener(sectionId, (newMargin) => {
            setCurrentMargin(newMargin)
          })
          return unregister
        }, [sectionId])

        // ===== NOVO: Rastrear mudanças de margin =====
        useEffect(() => {
          if (currentMargin !== marginRef.current) {
            marginRef.current = currentMargin
          }
        }, [currentMargin, sectionId])

        // Filmes visíveis (renderizar apenas estes)
        const visibleMovies = (movies || []).slice(0, visibleCount)
        const MAX_WIDTH_CONTENT = visibleMovies.length * 280

        // Calcula se os botões devem aparecer
        const viewportWidth = window.innerWidth - 80
        const cardWidth = 280 // 260px card + 20px margin
        const totalWidth = visibleMovies.length * cardWidth
        const maxScroll = Math.min(0, -(totalWidth - viewportWidth))

        const showLeftButton = currentMargin < 0 // Tem conteúdo scrollado para esquerda
        const showRightButton = true // SEMPRE MOSTRAR (como solicitado pelo usuário)

        // Carregar mais filmes quando chegar perto do fim (com debounce)
        useEffect(() => {
          // maxScroll é negativo (ex: -2000), então transformamos em positivo
          const maxScrollDistance = Math.abs(maxScroll)
          const LOAD_MORE_THRESHOLD = maxScrollDistance * 0.7 // Carregar quando estiver a 70% do fim (menos agressivo)

          // currentMargin também é negativo quando scrollado, então pegamos valor absoluto
          const currentScrollDistance = Math.abs(currentMargin)

          // Se rolou além do threshold e ainda tem mais filmes
          if (currentScrollDistance >= LOAD_MORE_THRESHOLD && visibleCount < movies.length) {
            // ===== DEBOUNCE: Aguardar 300ms antes de carregar mais =====
            const timeoutId = setTimeout(() => {
              const newCount = Math.min(visibleCount + 20, movies.length) // Carregar 20 de uma vez (menos chamadas)
              // 
              setVisibleCount(newCount)
            }, 300)

            return () => clearTimeout(timeoutId)
          }
        }, [currentMargin, maxScroll, visibleCount, movies.length])

        // ===== DESABILITADO: Atualizar filme em destaque durante scroll (causava piscadas) =====
        // useEffect(() => {
        //   const timeoutId = setTimeout(() => {
        //     if (movies.length === 0 || currentMargin === 0) return
        //     const viewportWidth = window.innerWidth - 80
        //     const cardWidth = 280
        //     const centerPosition = Math.abs(currentMargin) + (viewportWidth / 2)
        //     const centerMovieIndex = Math.floor(centerPosition / cardWidth)
        //     if (centerMovieIndex >= 0 && centerMovieIndex < movies.length) {
        //       const newFeaturedMovie = movies[centerMovieIndex]
        //       const newFeaturedId = newFeaturedMovie.stream_id || newFeaturedMovie.id
        //       if (newFeaturedId !== globalState.featuredMovieId) {
        //         window.updateNetflixMoviesState({ featuredMovieId: newFeaturedId })
        //       }
        //     }
        //   }, 300)
        //   return () => clearTimeout(timeoutId)
        // }, [currentMargin, movies])

        // Adicionar suporte para scroll com mouse wheel (horizontal ou vertical com Shift)
        const handleWheel = (e) => {
          // Detecta scroll horizontal direto OU scroll vertical com shift pressionado
          const isHorizontalScroll = Math.abs(e.deltaX) > Math.abs(e.deltaY) || e.shiftKey

          if (isHorizontalScroll) {
            e.preventDefault()
            // Se Shift está pressionado, usa deltaY como horizontal
            const scrollAmount = e.shiftKey ? e.deltaY : e.deltaX

            setMarginContent(state => {
              const currentValue = state[sectionId] || 0
              const cardWidth = 280
              const padding = 80
              const viewportWidth = window.innerWidth - padding
              const totalWidth = visibleMovies.length * cardWidth
              const maxScroll = Math.min(0, -(totalWidth - viewportWidth))

              // Se não há necessidade de scroll (tudo cabe), retorna sem mudar
              if (totalWidth <= viewportWidth) return state

              // Aplica o scroll
              let newValue = currentValue - scrollAmount

              // Limita aos bounds
              newValue = Math.max(maxScroll, Math.min(0, newValue))

              return {
                ...state,
                [sectionId]: newValue
              }
            })
          } else {
            // Scroll vertical - mudar de categoria (com debounce para evitar múltiplas mudanças)
            if (verticalScrollTimeoutRef.current) {
              return // Ignora scroll adicional durante o debounce
            }

            const isScrollingDown = e.deltaY > 0
            const isScrollingUp = e.deltaY < 0

            if (isScrollingDown && onNextCategory) {
              e.preventDefault()
              onNextCategory()

              // Debounce de 800ms para evitar mudanças rápidas demais
              verticalScrollTimeoutRef.current = setTimeout(() => {
                verticalScrollTimeoutRef.current = null
              }, 800)
            } else if (isScrollingUp && onPrevCategory) {
              e.preventDefault()
              onPrevCategory()

              // Debounce de 800ms
              verticalScrollTimeoutRef.current = setTimeout(() => {
                verticalScrollTimeoutRef.current = null
              }, 800)
            }
          }
        }

        return e('div', {
          style: {
            display: 'block',
            padding: '5px 40px 20px 40px',
            position: 'relative',
            height: '500px',
            width: '100%',
            maxWidth: '100vw',
            overflow: 'hidden',
            willChange: 'contents'
          },
          onMouseEnter: () => setHovering(true),
          onMouseLeave: () => setHovering(false),
          onWheel: handleWheel
        },
          // Left button - Scroll para esquerda no carrossel
          e('button', {
            id: 'btnScrollLeft',
            type: 'button',
            onClick: () => {
              // Rolar carrossel para a esquerda
              const cardWidth = 240 + 12 // largura do card + gap
              const scrollAmount = cardWidth * 6 // Rolar 6 cards por vez
              const newMargin = Math.min(currentMargin + scrollAmount, 0)

              setMarginContent(prev => ({
                ...prev,
                [sectionId]: newMargin
              }))
            },
            onMouseEnter: () => setHoveringLeft(true),
            onMouseLeave: () => setHoveringLeft(false),
            style: {
              position: 'absolute',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              flexDirection: 'column',
              gap: '4px',
              height: 'calc(100% - 5px)',
              top: '5px',
              zIndex: 6,
              background: hoveringLeft ? 'rgba(20,20,20,0.95)' : 'rgba(20,20,20,0.75)',
              border: 0,
              left: 0,
              width: '80px',
              opacity: currentMargin < 0 ? '0.9' : '0', // Só visível se pode rolar
              pointerEvents: currentMargin < 0 ? 'auto' : 'none',
              transition: 'opacity 0.3s ease, background 0.2s ease',
              cursor: 'pointer',
              paddingTop: '8px',
              paddingBottom: '8px'
            }
          },
            e('span', {
              style: {
                fontSize: '36px',
                color: '#fff',
                transform: hoveringLeft ? 'scale(1.2)' : 'scale(1)',
                transition: 'transform 0.2s ease'
              }
            }, '◀')
          ),

          // Movies container
          e('div', {
            'data-section-id': sectionId, // ===== NOVO: ID para manipulação direta =====
            style: {
              display: 'flex',
              flexDirection: 'row',
              alignItems: 'flex-start',
              transform: `translateX(${currentMargin}px)`,
              transition: 'transform 0.6s cubic-bezier(0.5, 0, 0.1, 1)',
              width: `${MAX_WIDTH_CONTENT}px`,
              willChange: 'transform',
              height: '420px', // Fixed height prevents pushing categories below
              position: 'relative',
              zIndex: 2
            }
          },
            visibleMovies.map((item, idx) =>
              isCollectionsMode
                ? e(CollectionCard, {
                    key: `collection-${item.id}-${idx}`,
                    collection: item,
                    sectionId,
                    idx,
                    onClick: async (collection, movies) => {

                      // 1. ABRIR INSTANTANEAMENTE com dados que já temos
                      const quickMovies = movies.map(movie => ({
                        stream_id: movie.stream_id,
                        name: movie.name,
                        stream_icon: null,
                        container_extension: 'mp4',
                        loading: true // Flag para mostrar skeleton
                      }))

                      setSelectedCollectionMovies(quickMovies)
                      setViewingCollectionMovies(true)
                      setShowCollectionsView(false)

                      // 2. DEPOIS carregar dados completos em background (sem bloquear UI)

                      const fetchPromises = movies.map(async (movie, index) => {
                        // Tentar encontrar nos filmes já carregados
                        for (const section of globalState.sectionsMovies) {
                          if(section.movies && section.movies.length > 0) {
                            const found = section.movies.find(m => m.stream_id === movie.stream_id)
                            if (found) {
                              return { index, movie: found }
                            }
                          }
                        }

                        // ===== DESABILITADO: get_vod_info muito lento =====
                        // Retornar apenas dados básicos, enriquecimento TMDB acontece depois
                        // try {
                        //   const info = await apiCall('get_vod_info', { vod_id: movie.stream_id })
                        //   ...
                        // } catch (err) {
                        //   
                        // }

                        // Fallback
                        return {
                          index,
                          movie: {
                            stream_id: movie.stream_id,
                            name: movie.name,
                            stream_icon: null,
                            container_extension: 'mp4'
                          }
                        }
                      })

                      // Atualizar filmes conforme vão chegando
                      const results = await Promise.all(fetchPromises)
                      let fullMovies = results.map(r => r.movie)

                      // ORDENAR por ano de lançamento (do mais antigo para o mais recente)
                      fullMovies = fullMovies.sort((a, b) => {
                        const yearA = a.releasedate || a.tmdb_year || '0'
                        const yearB = b.releasedate || b.tmdb_year || '0'

                        // Extrair apenas o ano (pode vir como "2024" ou "2024-01-15")
                        const getYear = (dateStr) => {
                          if (!dateStr) return 0
                          const yearMatch = String(dateStr).match(/(\d{4})/)
                          return yearMatch ? parseInt(yearMatch[1]) : 0
                        }

                        return getYear(yearA) - getYear(yearB) // Ordem crescente (mais antigo primeiro)
                      })

                      setSelectedCollectionMovies(fullMovies)
                    }
                  })
                : e(Movie, {
                    key: `movie-${sectionId}-${item.stream_id || item.id || `idx-${idx}`}`,
                    movie: item,
                    sectionId,
                    idx
                  })
            )
          ),

          // Right button (avançar) - SEMPRE VISÍVEL
          showRightButton ? e('button', {
            id: 'btnScrollRight',
            type: 'button',
            onClick: (e) => {
              e.stopPropagation() // Evita que o clique propague e cause blur nos cards

              // Versão local do handleScrollMovies que usa movies diretamente
              setMarginContent(prevState => {
                const currentMargin = prevState[sectionId] || 0
                const cardWidth = 280
                const padding = 80
                const viewportWidth = window.innerWidth - padding
                const cardsVisible = Math.floor(viewportWidth / cardWidth)

                const totalMovies = movies.length
                const totalWidth = totalMovies * cardWidth
                const maxScroll = Math.min(0, -(totalWidth - viewportWidth))

                if (totalWidth <= viewportWidth) {
                  return prevState
                }

                const scrollAmount = cardsVisible * cardWidth
                let newValue = currentMargin - scrollAmount // left = avançar para direita
                let finalValue = newValue < maxScroll ? 0 : Math.max(newValue, maxScroll)

                return { ...prevState, [sectionId]: finalValue }
              })
            },
            onMouseEnter: () => setHoveringRight(true),
            onMouseLeave: () => setHoveringRight(false),
            style: {
              position: 'absolute',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              flexDirection: 'column',
              gap: '4px',
              height: 'calc(100% - 5px)',
              top: '5px',
              zIndex: 6,
              background: hoveringRight ? 'rgba(20,20,20,0.95)' : 'rgba(20,20,20,0.75)',
              border: 0,
              right: 0,
              width: '80px',
              opacity: '0.9',
              transition: 'opacity 0.3s ease, background 0.2s ease',
              cursor: 'pointer',
              paddingTop: '8px',
              paddingBottom: '8px',
              pointerEvents: 'auto'
            }
          }, e('span', {
            style: {
              fontSize: '36px',
              color: '#fff',
              transform: hoveringRight ? 'scale(1.2)' : 'scale(1)',
              transition: 'transform 0.2s ease'
            }
          }, '›')) : null
        )
      }

      // RENDER PRINCIPAL
      // 

      // Mostrar loading enquanto carrega
      if(globalState.loading && globalState.sectionsMovies.length === 0){
        return e(Loading)
      }

      // Mostrar erro se falhou
      if(globalState.errorMsg && globalState.sectionsMovies.length === 0){
        return e('div', {
          style: {
            background: '#111',
            minHeight: '100vh',
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'center',
            color: 'white',
            padding: '40px'
          }
        },
          e('h2', {
            style: {
              color: '#e50914',
              fontSize: '24px',
              marginBottom: '16px'
            }
          }, 'Erro ao Carregar'),
          e('p', {
            style: {
              fontSize: '16px',
              color: '#999',
              textAlign: 'center',
              maxWidth: '500px'
            }
          }, globalState.errorMsg),
          e('button', {
            onClick: () => {
              window.resetNetflixMovies()
              setView('home')
            },
            style: {
              marginTop: '24px',
              padding: '12px 24px',
              background: '#e50914',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer',
              fontSize: '16px'
            }
          }, 'Voltar para Home')
        )
      }

      // Se não tem filmes carregados e não está loading nem com erro, mostra tela vazia
      // EXCETO se estamos em modo collections E já temos coleções carregadas
      if(globalState.sectionsMovies.length === 0 && !(view === 'collections' && collections.length > 0)){
        console.log('[NetflixMovies] Retornando tela vazia - sections:', globalState.sectionsMovies.length, 'view:', view, 'collections:', collections.length)
        return e('div', {
          style: {
            background: '#111',
            minHeight: '100vh'
          }
        },
          e(TopBar)
        )
      }

      return e('div', {
        style: {
          height: '100vh',
          width: '100%',
          overflow: 'hidden',
          display: 'flex',
          flexDirection: 'column'
        }
      },
        // NavBar (TopBar do projeto) - Fixo no topo
        e(TopBar),

        // Container principal com FeaturedMovie de fundo e carrosséis sobrepostos
        e('div', {
          style: {
            flex: 1,
            position: 'relative',
            overflow: 'hidden',
            width: '100%'
          }
        },
          // Featured Movie (fundo completo) ou Hero Backdrop (coleções)
          (() => {
            return globalState.heroBackdrop ? e('div', {
              style: {
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                // ===== FIX: Background sólido antes da imagem carregar =====
                backgroundColor: '#0a0a0a',
                backgroundImage: globalState.heroBackdrop.backdrop
                  ? `url(${globalState.heroBackdrop.backdrop})`
                  : globalState.heroBackdrop.poster
                  ? `url(${globalState.heroBackdrop.poster})`
                  : globalState.heroBackdrop.backdrop_path
                  ? `url(https://image.tmdb.org/t/p/original${globalState.heroBackdrop.backdrop_path})`
                  : '#000',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                zIndex: 1,
                // ===== FIX: Transição suave para evitar piscar =====
                opacity: 1,
                transition: 'opacity 0.5s ease-in-out, background-image 0.5s ease-in-out',
                animation: 'fadeIn 0.5s ease-in-out'
              }
            },
            // Gradient overlay
            e('div', {
              style: {
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                background: 'linear-gradient(to top, #111 25%, transparent 60%)',
                zIndex: 2
              }
            }),

            // Informações do filme
            e('div', {
              style: {
                position: 'absolute',
                top: '160px',
                left: '40px',
                zIndex: 3,
                maxWidth: '650px'
              }
            },
              e('h1', {
                style: {
                  color: '#fff',
                  fontSize: '42px',
                  fontWeight: 'bold',
                  marginBottom: '12px',
                  textShadow: '2px 2px 8px rgba(0,0,0,0.8)'
                }
              }, globalState.heroBackdrop.name),

              globalState.heroBackdrop.overview ? e('p', {
                style: {
                  color: '#fff',
                  fontSize: '17px',
                  lineHeight: '1.5',
                  textShadow: '2px 2px 4px rgba(0,0,0,0.8)',
                  marginBottom: '10px',
                  overflow: 'hidden',
                  textOverflow: 'ellipsis',
                  display: '-webkit-box',
                  WebkitLineClamp: '3',
                  WebkitBoxOrient: 'vertical'
                }
              }, globalState.heroBackdrop.overview) : null
            )
          ) : e(FeaturedMovie, { featuredMovieId: globalState.featuredMovieId })
          })(),

          // Sections - Alterna entre 3 MODOS: Categorias / Lista de Coleções / Filmes de Coleção
          // Posicionado absolutamente na parte inferior
          e('div', {
            style: {
              position: 'absolute',
              bottom: '-30px',
              left: 0,
              right: 0,
              zIndex: 10,
              paddingBottom: '0px'
            }
          },
          // MODO 3: Visualizando filmes de uma coleção
          viewingCollectionMovies && selectedCollectionMovies.length > 0 ? e(SectionMovies, {
            key: 'collection-movies',
            name: '🎬 Filmes da Coleção',
            movies: selectedCollectionMovies,
            sectionId: 'collection-movies',
            categoryIndex: undefined, // Sem navegação de categorias
            totalCategories: 0,
            onNextCategory: () => {},
            onPrevCategory: () => {}
          }) :
          // MODO 2: Lista de coleções (carrossel horizontal) - APENAS se view for 'collections'
          view === 'collections' && loadingCollections ? e('div', {
            style: {
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              padding: '60px 40px',
              color: '#fff',
              fontSize: '18px'
            }
          },
            e('div', {
              style: {
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                gap: '16px'
              }
            },
              e('div', {
                style: {
                  width: '40px',
                  height: '40px',
                  border: '4px solid rgba(244, 117, 33, 0.3)',
                  borderTop: '4px solid #f47521',
                  borderRadius: '50%',
                  animation: 'spin 1s linear infinite'
                }
              }),
              e('span', null, 'Buscando coleções...')
            )
          ) :
          view === 'collections' && collections.length > 0 ? (console.log('[RENDER] Renderizando SectionMovies com', collections.length, 'coleções'), e(SectionMovies, {
            key: 'collections-list',
            name: `🎬 Coleções (${collections.length})`,
            movies: collections, // Passando coleções como "movies" para reusar SectionMovies
            sectionId: 'collections',
            categoryIndex: undefined, // Sem navegação de categorias
            totalCategories: 0,
            onNextCategory: () => {},
            onPrevCategory: () => {},
            isCollectionsMode: true // Flag para SectionMovies saber que está renderizando coleções
          })) :
          view === 'collections' && collections.length === 0 && !loadingCollections ? e('div', {
            style: {
              display: 'flex',
              flexDirection: 'column',
              alignItems: 'center',
              justifyContent: 'center',
              padding: '60px 40px',
              gap: '20px',
              minHeight: '400px'
            }
          },
            e('div', {
              style: {
                fontSize: '48px'
              }
            }, '🎬'),
            e('div', {
              style: {
                color: '#fff',
                fontSize: '20px',
                fontWeight: '600'
              }
            }, 'Preparando coleções...'),
            e('div', {
              style: {
                color: '#999',
                fontSize: '14px',
                textAlign: 'center',
                maxWidth: '400px'
              }
            }, 'Carregando filmes para montar as coleções. Aguarde alguns instantes.')
          ) :
          // MODO 1: Renderiza a categoria atual OU loading se ainda não carregou
          globalState.sectionsMovies[currentCategoryIndex] && globalState.sectionsMovies[currentCategoryIndex].movies ? e(SectionMovies, {
            key: globalState.sectionsMovies[currentCategoryIndex].id,
            name: globalState.sectionsMovies[currentCategoryIndex].name,
            movies: globalState.sectionsMovies[currentCategoryIndex].movies,
            sectionId: globalState.sectionsMovies[currentCategoryIndex].id,
            categoryIndex: currentCategoryIndex,
            totalCategories: globalState.totalCategories || globalState.sectionsMovies.length,
            onNextCategory: () => {
              const totalAvailable = globalState.totalCategories || window.__allAvailableCategories?.length || 0
              if (currentCategoryIndex < totalAvailable - 1) {
                const nextIndex = currentCategoryIndex + 1

                // Atualizar filme em destaque ANTES de mudar categoria (para evitar piscar)
                const nextSection = globalState.sectionsMovies[nextIndex]
                if (nextSection && nextSection.movies && nextSection.movies.length > 0) {
                  const firstMovie = nextSection.movies[0]
                  const newFeaturedId = firstMovie.stream_id || firstMovie.id
                  window.updateNetflixMoviesState({
                    featuredMovieId: newFeaturedId
                  })
                }

                // Resetar scroll para 0 com o sectionId correto
                if (nextSection) {
                  setMarginContent({ [nextSection.id]: 0 })
                }

                // Mudar imediatamente para a próxima categoria
                setCurrentCategoryIndex(nextIndex)
                setFocusedMovieIdx(0)

                // Se a categoria ainda não foi carregada, carregar IMEDIATAMENTE
                if (!nextSection) {
                  loadCategory(nextIndex)
                }
              }
            },
            onPrevCategory: () => {
              if (currentCategoryIndex > 0) {
                const prevIndex = currentCategoryIndex - 1

                // Atualizar filme em destaque ANTES de mudar categoria (para evitar piscar)
                const prevSection = globalState.sectionsMovies[prevIndex]
                if (prevSection && prevSection.movies && prevSection.movies.length > 0) {
                  const firstMovie = prevSection.movies[0]
                  const newFeaturedId = firstMovie.stream_id || firstMovie.id
                  window.updateNetflixMoviesState({
                    featuredMovieId: newFeaturedId
                  })
                }

                // Resetar scroll para 0 com o sectionId correto
                if (prevSection) {
                  setMarginContent({ [prevSection.id]: 0 })
                }

                // Mudar imediatamente para a categoria anterior
                setCurrentCategoryIndex(prevIndex)
                setFocusedMovieIdx(0)

                // Se a categoria ainda não foi carregada, carregar IMEDIATAMENTE
                if (!prevSection) {
                  loadCategory(prevIndex)
                }
              }
            }
          }) : e('div', {
            style: {
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              padding: '60px 40px',
              color: '#fff',
              fontSize: '18px'
            }
          },
            e('div', {
              style: {
                display: 'flex',
                flexDirection: 'column',
                alignItems: 'center',
                gap: '16px'
              }
            },
              e('div', {
                style: {
                  width: '40px',
                  height: '40px',
                  border: '4px solid rgba(244, 117, 33, 0.3)',
                  borderTop: '4px solid #f47521',
                  borderRadius: '50%',
                  animation: 'spin 1s linear infinite'
                }
              }),
              e('span', null, `Carregando categoria ${currentCategoryIndex + 1}...`)
            )
          )
        ) // End sections div
        ) // End FeaturedMovie container
      ) // End main container
    }

    // ===== FAVORITES VIEW =====
    function FavoritesView() {
      const [favoriteChannels, setFavoriteChannels] = useState([])
      const [focusedItemIdx, setFocusedItemIdx] = useState(0)

      // Decodificar Base64 se necessário
      const decodeMaybeBase64 = (str) => {
        if(!str || typeof str !== 'string') return 'Sem título'
        // Se já parece texto normal, retorna direto
        if(/[\s\u00C0-\u00FF]/.test(str) || !/[A-Za-z0-9+/=]/.test(str)){
          return str
        }
        try {
          const decoded = atob(str)
          if(decoded && /^[\x20-\x7E\u00C0-\u00FF]+$/.test(decoded)){
            return decoded
          }
          try {
            const utf8Decoded = decodeURIComponent(escape(decoded))
            if(utf8Decoded && utf8Decoded.length > 0 && !/[\x00-\x1F]/.test(utf8Decoded)){
              return utf8Decoded
            }
          } catch(e2) {}
          return decoded
        } catch(e) {
          return str
        }
      }

      // Carregar favoritos do localStorage
      const loadFavorites = () => {
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
        const channels = Object.values(favorites).sort((a, b) => (b.addedAt || 0) - (a.addedAt || 0))
        setFavoriteChannels(channels)
      }

      useEffect(() => {
        loadFavorites()

        // Escutar atualizações de favoritos
        const handleFavoritesUpdate = () => loadFavorites()
        window.addEventListener('favorites-updated', handleFavoritesUpdate)
        return () => window.removeEventListener('favorites-updated', handleFavoritesUpdate)
      }, [])

      // Navegação por teclado
      useEffect(() => {
        if (view !== 'favorites' || favoriteChannels.length === 0) return

        const handleKeyDown = (e) => {
          if (e.key === 'ArrowRight') {
            e.preventDefault()
            setFocusedItemIdx(prev => Math.min(prev + 1, favoriteChannels.length - 1))
          } else if (e.key === 'ArrowLeft') {
            e.preventDefault()
            setFocusedItemIdx(prev => Math.max(prev - 1, 0))
          } else if (e.key === 'ArrowDown') {
            e.preventDefault()
            setFocusedItemIdx(prev => Math.min(prev + 6, favoriteChannels.length - 1))
          } else if (e.key === 'ArrowUp') {
            e.preventDefault()
            setFocusedItemIdx(prev => Math.max(prev - 6, 0))
          } else if (e.key === 'Enter') {
            e.preventDefault()
            const channel = favoriteChannels[focusedItemIdx]
            if (channel) {
              playLiveChannel(channel)
            }
          } else if (e.key === 'Escape') {
            e.preventDefault()
            setView('home')
          }
        }

        window.addEventListener('keydown', handleKeyDown)
        return () => window.removeEventListener('keydown', handleKeyDown)
      }, [view, favoriteChannels, focusedItemIdx])

      // Auto-scroll para item focado
      useEffect(() => {
        const el = document.getElementById('fav-' + focusedItemIdx)
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'nearest' })
      }, [focusedItemIdx])

      if (favoriteChannels.length === 0) {
        return e('div', { className: 'star-bg min-h-screen flex flex-col items-center justify-center p-6' },
          e('div', { className: 'text-center' },
            e('div', { className: 'text-6xl mb-4' }, '⭐'),
            e('h2', { className: 'text-2xl font-bold text-white mb-2' }, 'Nenhum Favorito'),
            e('p', { className: 'text-gray-400 mb-6' }, 'Adicione canais aos favoritos clicando na estrela durante a reprodução'),
            e('button', {
              onClick: () => setView('live-categories'),
              className: 'px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors'
            }, 'Explorar Canais')
          )
        )
      }

      return e('div', { className: 'star-bg min-h-screen p-6 overflow-y-auto' },
        e('div', { className: 'max-w-7xl mx-auto' },
          // Header
          e('div', { className: 'mb-8' },
            e('h1', { className: 'text-3xl font-bold text-white mb-2' }, '⭐ Meus Favoritos'),
            e('p', { className: 'text-gray-400' }, `${favoriteChannels.length} ${favoriteChannels.length === 1 ? 'canal' : 'canais'}`)
          ),

          // Grid de canais
          e('div', { className: 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4' },
            ...favoriteChannels.map((channel, idx) => {
              const isFocused = idx === focusedItemIdx
              return e('div', {
                key: channel.stream_id,
                id: 'fav-' + idx,
                onClick: () => {
                  setFocusedItemIdx(idx)
                  playLiveChannel(channel)
                },
                className: `frost rounded-lg p-4 cursor-pointer transition-all ${
                  isFocused ? 'border-2 border-purple-500 bg-purple-500/20 scale-105' : 'border border-white/10 hover:border-purple-400/40'
                }`
              },
                // Logo do canal
                channel.stream_icon && e('div', { className: 'aspect-video rounded-lg overflow-hidden mb-3 bg-black/30' },
                  e('img', {
                    src: channel.stream_icon,
                    alt: channel.name,
                    className: 'w-full h-full object-contain',
                    onError: (ev) => { ev.target.style.display = 'none' }
                  })
                ),
                // Nome do canal
                e('div', { className: 'text-center' },
                  channel.num && e('div', { className: 'text-purple-400 font-bold text-sm mb-1' }, channel.num),
                  e('div', { className: 'text-white text-sm font-medium truncate' }, decodeMaybeBase64(channel.name))
                )
              )
            })
          )
        )
      )
    }

    function Channels(){
      const [focusedItemIdx, setFocusedItemIdx] = useState(0)
      const gridCols = 6 // lg:grid-cols-6

      useEffect(()=>{
        if(view!=='channels' || !filtered || filtered.length===0) return

        const handleKeyDown = (e)=>{
          if(e.key==='ArrowRight'){
            e.preventDefault()
            setFocusedItemIdx(prev=> Math.min(prev + 1, filtered.length - 1))
          }else if(e.key==='ArrowLeft' || e.key==='Escape'){
            e.preventDefault()
            if(focusedItemIdx === 0 || e.key==='Escape'){
              // Se estiver no primeiro item OU pressionar ESC, voltar para categorias
              setView(selectedCat.type==='live'?'live-categories': selectedCat.type==='vod'?'movie-categories':'series-categories')
            }else{
              setFocusedItemIdx(prev=> Math.max(prev - 1, 0))
            }
          }else if(e.key==='ArrowDown'){
            e.preventDefault()
            setFocusedItemIdx(prev=> Math.min(prev + gridCols, filtered.length - 1))
          }else if(e.key==='ArrowUp'){
            e.preventDefault()
            setFocusedItemIdx(prev=> Math.max(prev - gridCols, 0))
          }else if(e.key==='Enter'){
            e.preventDefault()
            const item = filtered[focusedItemIdx]
            if(item) playStream(item)
          }
        }

        window.addEventListener('keydown', handleKeyDown)
        return ()=> window.removeEventListener('keydown', handleKeyDown)
      }, [view, filtered, focusedItemIdx, selectedCat])

      useEffect(()=>{
        if(view==='channels' && filtered && filtered.length>0){
          const item = filtered[focusedItemIdx]
          if(item){
            const el = document.getElementById('item-' + (item.stream_id||item.series_id||item.id))
            if(el) el.scrollIntoView({ behavior:'smooth', block:'center', inline:'nearest' })
          }
        }
      }, [focusedItemIdx, view, filtered])

      return e('div', { className:'star-bg h-screen p-6 overflow-hidden flex flex-col' },
        e(TopBar),
        e('div', { className:'flex flex-wrap items-center gap-3 mb-4' },
          e('button', { onClick:()=> setView(selectedCat.type==='live'?'live-categories': selectedCat.type==='vod'?'movie-categories':'series-categories'), className:'text-white text-xl hover:text-purple-400' }, '←'),
          e('h2', { className:'text-white text-2xl font-bold' }, selectedCat?.category_name || 'Categoria'),
          e('div', { className:'grow' }),
          e('input', { value:query, onChange:(ev)=>setQuery(ev.target.value), placeholder:'Pesquisar...', className:'w-full md:w-72 frost rounded-lg px-4 py-2 text-white placeholder:text-gray-400' })
        ),
        error && e('div', { className:'text-red-300 mb-3' }, 'Erro: ', error),
        e('div', { className:'grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 overflow-y-auto flex-1' },
          filtered && filtered.length>0 ?
            [
              ...filtered.map((item, idx)=> {
                const isFocused = idx === focusedItemIdx
                return e('button', {
                  key:item.stream_id || item.series_id || item.id || item.title,
                  id: 'item-' + (item.stream_id||item.series_id||item.id),
                  onClick:()=>{ setFocusedItemIdx(idx); playStream(item) },
                  className:'rounded-lg frost p-3 text-left card transition-all ' + (isFocused ? 'ring-2 ring-purple-400 bg-purple-500/20 scale-105' : '')
                },
                  item.stream_icon ? e('img', { src:item.stream_icon, alt:item.name, loading:'lazy', className:'w-full h-32 object-cover rounded mb-3' })
                                    : e('div', { className:'w-full h-32 bg-gradient-to-br from-purple-500 to-blue-500 rounded mb-3 grid place-items-center text-3xl' }, '▶️'),
                  e('div', { className:'text-white text-sm font-medium truncate' }, item.name || item.title || 'Sem título')
                )
              }),
              e('div', { key:'hint', className:'col-span-full text-center text-xs text-gray-400 mt-3 py-2' }, '↑ ↓ ← → Navegar | Enter Reproduzir | ESC Voltar')
            ]
          : e('div', { className:'text-center text-gray-400 col-span-full mt-12' }, 'Nenhum conteúdo nesta categoria')
        )
      )
    }

    // ============================================================
    // PLAYER HUD - Controles sobre o vídeo
    // ============================================================
    function PlayerHUD({ visible, videoRef, hlsObj, channelInfo, onHide }) {
      const [currentTime, setCurrentTime] = useState(new Date())
      const [resolution, setResolution] = useState('-- x --')
      const [levels, setLevels] = useState([])
      const [currentLevel, setCurrentLevel] = useState(-1)
      const [isAuto, setIsAuto] = useState(true)
      const [isFavorite, setIsFavorite] = useState(false)
      const hideTimerRef = useRef(null)

      // Verificar se canal está nos favoritos ao carregar
      useEffect(() => {
        if (!channelInfo?.stream_id) return
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
        setIsFavorite(!!favorites[channelInfo.stream_id])
      }, [channelInfo?.stream_id])

      // Atualizar hora atual a cada segundo
      useEffect(() => {
        const interval = setInterval(() => setCurrentTime(new Date()), 1000)
        return () => clearInterval(interval)
      }, [])

      // Detectar níveis de qualidade do HLS
      useEffect(() => {
        if (!hlsObj) return
        const onManifestParsed = () => {
          const levelsData = hlsObj.levels.map((level, index) => ({
            index,
            height: level.height,
            width: level.width,
            bitrate: level.bitrate
          }))
          setLevels(levelsData)
          setCurrentLevel(hlsObj.currentLevel)
        }

        const onLevelSwitch = (event, data) => {
          setCurrentLevel(data.level)
          setIsAuto(hlsObj.currentLevel === -1)
        }

        hlsObj.on(Hls.Events.MANIFEST_PARSED, onManifestParsed)
        hlsObj.on(Hls.Events.LEVEL_SWITCHED, onLevelSwitch)

        return () => {
          hlsObj.off(Hls.Events.MANIFEST_PARSED, onManifestParsed)
          hlsObj.off(Hls.Events.LEVEL_SWITCHED, onLevelSwitch)
        }
      }, [hlsObj])

      // Atualizar resolução atual do vídeo
      useEffect(() => {
        const video = videoRef?.current
        if (!video) return

        const updateResolution = () => {
          if (video.videoWidth && video.videoHeight) {
            setResolution(`${video.videoWidth} x ${video.videoHeight}`)
          }
        }

        video.addEventListener('loadedmetadata', updateResolution)
        video.addEventListener('resize', updateResolution)

        return () => {
          video.removeEventListener('loadedmetadata', updateResolution)
          video.removeEventListener('resize', updateResolution)
        }
      }, [videoRef])

      // Auto-hide após 4 segundos
      useEffect(() => {
        if (visible) {
          if (hideTimerRef.current) clearTimeout(hideTimerRef.current)
          hideTimerRef.current = setTimeout(() => {
            if (onHide) onHide()
          }, 4000)
        }
        return () => {
          if (hideTimerRef.current) clearTimeout(hideTimerRef.current)
        }
      }, [visible, onHide])

      // Mapear altura para categoria
      const getQualityLabel = (height) => {
        if (height >= 1080) return 'FHD'
        if (height >= 720) return 'HD'
        return 'SD'
      }

      // Agrupar níveis por qualidade
      const groupedLevels = useMemo(() => {
        const groups = { FHD: [], HD: [], SD: [] }
        levels.forEach(level => {
          const label = getQualityLabel(level.height)
          groups[label].push(level)
        })
        return groups
      }, [levels])

      // Trocar qualidade
      const switchQuality = (quality, variant = 0) => {
        if (!hlsObj) return
        const group = groupedLevels[quality]
        if (!group || group.length === 0) return
        const level = group[variant] || group[0]
        if (level) {
          hlsObj.currentLevel = level.index
          setCurrentLevel(level.index)
          setIsAuto(false)

          // Salvar preferência
          if (channelInfo?.stream_id) {
            localStorage.setItem(`quality:channel:${channelInfo.stream_id}`, JSON.stringify({ quality, variant }))
          }
        }
      }

      // Ativar modo AUTO
      const switchToAuto = () => {
        if (!hlsObj) return
        hlsObj.currentLevel = -1
        setIsAuto(true)
        setCurrentLevel(-1)
      }

      // Toggle favorito
      const toggleFavorite = () => {
        if (!channelInfo?.stream_id) return

        const newState = !isFavorite
        setIsFavorite(newState)

        // Salvar/remover do localStorage
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')

        if (newState) {
          // Adicionar aos favoritos
          favorites[channelInfo.stream_id] = {
            stream_id: channelInfo.stream_id,
            num: channelInfo.num,
            name: channelInfo.name,
            stream_icon: channelInfo.stream_icon,
            stream_url: channelInfo.stream_url,
            category_id: channelInfo.category_id,
            addedAt: Date.now()
          }
        } else {
          // Remover dos favoritos
          delete favorites[channelInfo.stream_id]
        }

        localStorage.setItem('dreamtv_favorites', JSON.stringify(favorites))

        // Notificar sistema para atualizar lista se estiver na categoria favoritos
        window.dispatchEvent(new CustomEvent('favorites-updated'))
      }

      // Fullscreen
      const toggleFullscreen = async () => {
        const video = videoRef?.current
        if (!video) return

        try {
          if (!document.fullscreenElement) {
            if (video.requestFullscreen) await video.requestFullscreen()
            else if (video.webkitRequestFullscreen) await video.webkitRequestFullscreen()
            else if (video.mozRequestFullScreen) await video.mozRequestFullScreen()
          } else {
            if (document.exitFullscreen) await document.exitFullscreen()
            else if (document.webkitExitFullscreen) await document.webkitExitFullscreen()
            else if (document.mozCancelFullScreen) await document.mozCancelFullScreen()
          }
        } catch (err) {
        }
      }

      // PlayerHUD desabilitado - overlay não deve aparecer em VOD
      return null

      if (!visible) return null

      const now = channelInfo?.epg?.now || { title: channelInfo?.name || 'Sem informação', start: '--:--', end: '--:--', isLive: false }
      const next = channelInfo?.epg?.next || null
      const currentHour = currentTime.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' })

      return e('div', {
        className: 'fixed inset-0 z-50 pointer-events-none flex flex-col items-center justify-end pb-20',
        'data-testid': 'player-hud'
      },
        // Faixa principal
        e('div', { className: 'pointer-events-auto bg-black/80 backdrop-blur-md rounded-2xl p-6 w-full max-w-6xl mx-4 mb-4 shadow-2xl' },
          e('div', { className: 'flex items-center gap-6' },
            // Canal
            e('div', { className: 'flex items-center gap-3' },
              e('div', { className: 'text-4xl font-bold text-purple-400' }, channelInfo?.num || '--'),
              channelInfo?.stream_icon && e('img', { src: channelInfo.stream_icon, className: 'w-16 h-16 rounded-lg object-cover' })
            ),

            // Programa atual
            e('div', { className: 'flex-1' },
              e('div', { className: 'flex items-center gap-2 mb-1' },
                e('h3', { className: 'text-xl font-semibold text-white' }, now.title),
                now.isLive && e('span', { className: 'bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full' }, 'AO VIVO')
              ),
              e('div', { className: 'flex items-center gap-3 mb-2' },
                e('span', { className: 'text-sm text-gray-300' }, `${now.start} – ${now.end}`),
                // Barra de progresso (exemplo fixo - você pode calcular o progresso real)
                e('div', { className: 'flex-1 h-1 bg-gray-700 rounded-full overflow-hidden' },
                  e('div', { className: 'h-full bg-red-600', style: { width: '45%' } })
                )
              )
            ),

            // Próximo programa
            next && e('div', { className: 'w-64' },
              e('div', { className: 'text-xs text-gray-400 mb-1' }, 'NEXT'),
              e('h4', { className: 'text-sm font-medium text-white truncate' }, next.title),
              e('span', { className: 'text-xs text-gray-400' }, `${next.start} – ${next.end}`)
            ),

            // Hora e resolução
            e('div', { className: 'text-right' },
              e('div', { className: 'text-3xl font-bold text-white' }, currentHour),
              e('div', { className: 'text-xs text-gray-400' }, resolution)
            )
          )
        ),

        // Faixa de controles (chips)
        e('div', { className: 'pointer-events-auto flex items-center gap-2 bg-black/60 backdrop-blur-md rounded-full px-4 py-2 shadow-xl' },
          // Favoritar
          e('button', {
            onClick: toggleFavorite,
            className: `px-4 py-2 rounded-full transition-all ${isFavorite ? 'bg-yellow-500 text-black' : 'bg-white/10 text-white hover:bg-white/20'}`
          }, isFavorite ? '★' : '☆'),

          // Separador
          e('div', { className: 'w-px h-6 bg-white/20' }),

          // Qualidades FHD
          groupedLevels.FHD.length > 0 && [
            e('button', {
              key: 'fhd1',
              onClick: () => switchQuality('FHD', 0),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height >= 1080 && groupedLevels.FHD[0]?.index === currentLevel
                  ? 'bg-purple-500 text-white ring-2 ring-purple-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'FHD'),
            groupedLevels.FHD.length > 1 && e('button', {
              key: 'fhd2',
              onClick: () => switchQuality('FHD', 1),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height >= 1080 && groupedLevels.FHD[1]?.index === currentLevel
                  ? 'bg-purple-500 text-white ring-2 ring-purple-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'FHD²')
          ],

          // Qualidades HD
          groupedLevels.HD.length > 0 && [
            e('button', {
              key: 'hd1',
              onClick: () => switchQuality('HD', 0),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height >= 720 && levels[currentLevel]?.height < 1080 && groupedLevels.HD[0]?.index === currentLevel
                  ? 'bg-blue-500 text-white ring-2 ring-blue-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'HD'),
            groupedLevels.HD.length > 1 && e('button', {
              key: 'hd2',
              onClick: () => switchQuality('HD', 1),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height >= 720 && levels[currentLevel]?.height < 1080 && groupedLevels.HD[1]?.index === currentLevel
                  ? 'bg-blue-500 text-white ring-2 ring-blue-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'HD²')
          ],

          // Qualidades SD
          groupedLevels.SD.length > 0 && [
            e('button', {
              key: 'sd1',
              onClick: () => switchQuality('SD', 0),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height < 720 && groupedLevels.SD[0]?.index === currentLevel
                  ? 'bg-green-500 text-white ring-2 ring-green-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'SD'),
            groupedLevels.SD.length > 1 && e('button', {
              key: 'sd2',
              onClick: () => switchQuality('SD', 1),
              className: `px-3 py-1 rounded-full text-sm font-semibold transition-all ${
                !isAuto && levels[currentLevel]?.height < 720 && groupedLevels.SD[1]?.index === currentLevel
                  ? 'bg-green-500 text-white ring-2 ring-green-400'
                  : 'bg-white/10 text-white hover:bg-white/20'
              }`
            }, 'SD²')
          ],

          // Separador
          e('div', { className: 'w-px h-6 bg-white/20' }),

          // Original (AUTO)
          e('button', {
            onClick: switchToAuto,
            className: `px-4 py-2 rounded-full text-sm font-semibold transition-all ${
              isAuto
                ? 'bg-yellow-500 text-black ring-2 ring-yellow-400'
                : 'bg-white/10 text-white hover:bg-white/20'
            }`
          }, 'Original'),

          // Fullscreen
          e('button', {
            onClick: toggleFullscreen,
            className: 'px-6 py-2 rounded-full text-sm font-semibold bg-green-500 text-white ring-2 ring-green-400 hover:bg-green-600 transition-all'
          }, 'Full Screen')
        )
      )
    }

    // ===== COMPONENTE: LISTAGEM DE EPISÓDIOS =====
    function EpisodesList({ seriesData }) {
      const [selectedSeason, setSelectedSeason] = useState(1)
      const [seasonsData, setSeasonsData] = useState([])
      const [loading, setLoading] = useState(true)
      const [error, setError] = useState(null)

      // Buscar informações completas da série (temporadas + episódios)
      useEffect(() => {
        const fetchSeriesInfo = async () => {
          if (!seriesData || !seriesData.series_id) {
            setError('ID da série não disponível')
            setLoading(false)
            return
          }

          try {
            setLoading(true)

            const data = await apiCall('get_series_info', { series_id: seriesData.series_id })

            if (data && data.seasons) {
              // Converter object de temporadas em array e ordenar
              const seasonsArray = Object.entries(data.seasons || {})
                .map(([seasonNum, episodes]) => ({
                  seasonNumber: parseInt(seasonNum),
                  episodes: Array.isArray(episodes) ? episodes : []
                }))
                .sort((a, b) => a.seasonNumber - b.seasonNumber)

              setSeasonsData(seasonsArray)

              // Selecionar primeira temporada por padrão
              if (seasonsArray.length > 0) {
                setSelectedSeason(seasonsArray[0].seasonNumber)
              }
            }
            setLoading(false)
          } catch (err) {
            setError('Erro ao carregar episódios')
            setLoading(false)
          }
        }

        fetchSeriesInfo()
      }, [seriesData])

      // Helpers
      const formatEpisodeTitle = (episode) => {
        const type = seriesData.type || 'serie'
        const season = episode.season || selectedSeason
        const epNum = episode.episode_num || episode.id

        if (type === 'novela') return `Cap. ${epNum}`
        if (type === 'anime') return `EP ${epNum.toString().padStart(2, '0')}`
        return `T${season.toString().padStart(2, '0')}:E${epNum.toString().padStart(2, '0')}`
      }

      const formatDuration = (seconds) => {
        if (!seconds) return 'N/A'
        const minutes = Math.floor(seconds / 60)
        if (minutes < 60) return `${minutes}min`
        const h = Math.floor(minutes / 60)
        const m = minutes % 60
        return `${h}h ${m}min`
      }

      const formatDate = (dateString) => {
        if (!dateString) return 'N/A'
        return new Date(dateString).toLocaleDateString('pt-BR')
      }

      const handleEpisodeClick = (episode) => {

        // Construir URL do episódio
        const ext = episode.container_extension || 'mp4'
        const url = buildURL(cfg.server, [
          'series',
          cfg.username,
          cfg.password,
          episode.id + '.' + ext
        ])

        setCurrent({
          name: `${seriesData.title || seriesData.name} - ${formatEpisodeTitle(episode)} - ${episode.title || ''}`,
          url,
          isHls: ext === 'm3u8'
        })
        setView('player')
      }

      // Temporada selecionada
      const currentSeasonData = seasonsData.find(s => s.seasonNumber === selectedSeason)
      const episodes = currentSeasonData?.episodes || []

      // Loading state
      if (loading) {
        return e('div', {
          style: {
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            height: '100vh',
            background: '#000',
            color: '#fff',
            fontSize: '24px'
          }
        }, 'Carregando episódios...')
      }

      // Error state
      if (error) {
        return e('div', {
          style: {
            display: 'flex',
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'center',
            height: '100vh',
            background: '#000',
            color: '#fff',
            gap: '20px'
          }
        },
          e('div', { style: { fontSize: '24px' } }, error),
          e('button', {
            onClick: () => setView('netflix-movies'),
            style: {
              padding: '12px 24px',
              background: '#e50914',
              border: 'none',
              borderRadius: '4px',
              color: '#fff',
              fontSize: '16px',
              cursor: 'pointer'
            }
          }, '← Voltar')
        )
      }

      return e('div', {
        style: {
          background: '#000',
          minHeight: '100vh',
          color: '#fff',
          padding: '40px',
          fontFamily: 'system-ui, -apple-system, sans-serif'
        }
      },
        // Header
        e('div', {
          style: {
            marginBottom: '40px'
          }
        },
          // Botão voltar
          e('button', {
            onClick: () => setView('serie-details'),
            style: {
              background: 'rgba(255,255,255,0.1)',
              border: 'none',
              color: '#fff',
              padding: '10px 20px',
              borderRadius: '4px',
              cursor: 'pointer',
              fontSize: '16px',
              marginBottom: '20px',
              display: 'flex',
              alignItems: 'center',
              gap: '8px'
            }
          }, '← Voltar'),

          // Título
          e('h1', {
            style: {
              fontSize: '48px',
              fontWeight: 'bold',
              marginBottom: '16px'
            }
          }, seriesData.title || seriesData.name),

          // Metadados
          e('div', {
            style: {
              display: 'flex',
              alignItems: 'center',
              gap: '16px',
              fontSize: '16px',
              color: '#b3b3b3',
              marginBottom: '12px'
            }
          },
            seriesData.tmdb_rating && e('span', {
              style: { color: '#fbbf24', fontWeight: 'bold' }
            }, `⭐ ${(seriesData.tmdb_rating * 10).toFixed(1)}%`),
            seriesData.tmdb_year && e('span', null, seriesData.tmdb_year),
            seriesData.ageRating && e('span', {
              style: {
                background: '#dc2626',
                padding: '2px 8px',
                borderRadius: '4px',
                fontSize: '14px',
                fontWeight: 'bold'
              }
            }, seriesData.ageRating || '16+')
          ),

          // Total episódios e temporadas
          e('div', {
            style: {
              fontSize: '18px',
              color: '#fff',
              marginBottom: '8px'
            }
          }, `${seasonsData.reduce((acc, s) => acc + s.episodes.length, 0)} Episódios (${seasonsData.length} ${seasonsData.length === 1 ? 'Temporada' : 'Temporadas'})`),

          // Tipo
          e('div', {
            style: {
              fontSize: '14px',
              color: '#b3b3b3'
            }
          }, `Tipo: ${seriesData.type === 'novela' ? 'Novela' : seriesData.type === 'anime' ? 'Anime' : seriesData.type === 'desenho' ? 'Desenho' : seriesData.type === 'show' ? 'Show' : 'Série'}`)
        ),

        // Layout 2 colunas
        e('div', {
          style: {
            display: 'grid',
            gridTemplateColumns: '1fr 1fr',
            gap: '32px',
            height: 'calc(100vh - 400px)'
          }
        },
          // COLUNA ESQUERDA: Temporadas
          e('div', {
            style: {
              overflowY: 'hidden',
              paddingRight: '16px'
            }
          },
            e('h2', {
              style: {
                fontSize: '24px',
                fontWeight: 'bold',
                marginBottom: '20px'
              }
            }, 'Temporadas'),

            ...seasonsData.map(season =>
              e('div', {
                key: season.seasonNumber,
                onClick: () => setSelectedSeason(season.seasonNumber),
                style: {
                  display: 'flex',
                  gap: '16px',
                  padding: '16px',
                  background: '#141414',
                  borderRadius: '8px',
                  marginBottom: '16px',
                  cursor: 'pointer',
                  border: `2px solid ${selectedSeason === season.seasonNumber ? '#e50914' : '#333'}`,
                  transition: 'all 0.2s'
                },
                onMouseEnter: (e) => {
                  if (selectedSeason !== season.seasonNumber) {
                    e.currentTarget.style.background = '#1f1f1f'
                  }
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = '#141414'
                }
              },
                // Poster placeholder
                e('div', {
                  style: {
                    width: '120px',
                    height: '160px',
                    background: '#333',
                    borderRadius: '8px',
                    flexShrink: 0,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '48px',
                    color: '#666'
                  }
                }, season.seasonNumber),

                // Info
                e('div', {
                  style: {
                    flex: 1,
                    display: 'flex',
                    flexDirection: 'column',
                    gap: '8px'
                  }
                },
                  e('h3', {
                    style: {
                      fontSize: '20px',
                      fontWeight: 'bold'
                    }
                  }, `Temporada ${season.seasonNumber}`),

                  e('div', {
                    style: {
                      fontSize: '14px',
                      color: '#b3b3b3'
                    }
                  }, `${season.episodes.length} ${season.episodes.length === 1 ? 'Episódio' : 'Episódios'}`),

                  e('div', {
                    style: {
                      fontSize: '14px',
                      color: '#999',
                      lineHeight: '1.5',
                      overflow: 'hidden',
                      textOverflow: 'ellipsis',
                      display: '-webkit-box',
                      WebkitLineClamp: 3,
                      WebkitBoxOrient: 'vertical'
                    }
                  }, season.synopsis || `Temporada ${season.seasonNumber} com ${season.episodes.length} episódios.`)
                )
              )
            )
          ),

          // COLUNA DIREITA: Episódios
          e('div', {
            style: {
              overflowY: 'hidden',
              paddingRight: '16px'
            }
          },
            e('h2', {
              style: {
                fontSize: '24px',
                fontWeight: 'bold',
                marginBottom: '20px'
              }
            }, `Episódios - Temporada ${selectedSeason}`),

            episodes.length === 0 ? e('div', {
              style: {
                textAlign: 'center',
                color: '#666',
                fontSize: '18px',
                marginTop: '40px'
              }
            }, 'Nenhum episódio disponível') :

            episodes.map((episode, idx) =>
              e('div', {
                key: episode.id || idx,
                onClick: () => handleEpisodeClick(episode),
                style: {
                  display: 'flex',
                  gap: '16px',
                  padding: '16px',
                  background: '#141414',
                  borderRadius: '8px',
                  marginBottom: '16px',
                  cursor: 'pointer',
                  border: '2px solid #333',
                  transition: 'all 0.2s'
                },
                onMouseEnter: (e) => {
                  e.currentTarget.style.background = '#1f1f1f'
                  e.currentTarget.style.borderColor = '#666'
                },
                onMouseLeave: (e) => {
                  e.currentTarget.style.background = '#141414'
                  e.currentTarget.style.borderColor = '#333'
                }
              },
                // Thumbnail
                e('div', {
                  style: {
                    width: '240px',
                    height: '135px',
                    background: episode.info?.movie_image ? `url(${episode.info.movie_image}) center/cover` : '#333',
                    borderRadius: '8px',
                    flexShrink: 0,
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    fontSize: '48px',
                    color: '#666',
                    position: 'relative'
                  }
                },
                  // Play overlay
                  e('div', {
                    style: {
                      position: 'absolute',
                      top: '50%',
                      left: '50%',
                      transform: 'translate(-50%, -50%)',
                      background: 'rgba(0,0,0,0.7)',
                      borderRadius: '50%',
                      width: '50px',
                      height: '50px',
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      fontSize: '24px'
                    }
                  }, '▶')
                ),

                // Info
                e('div', {
                  style: {
                    flex: 1,
                    display: 'flex',
                    flexDirection: 'column',
                    gap: '8px'
                  }
                },
                  e('h3', {
                    style: {
                      fontSize: '18px',
                      fontWeight: 'bold'
                    }
                  }, `${formatEpisodeTitle(episode)} - ${episode.title || `Episódio ${episode.episode_num}`}`),

                  e('div', {
                    style: {
                      display: 'flex',
                      alignItems: 'center',
                      gap: '12px',
                      fontSize: '12px',
                      color: '#b3b3b3'
                    }
                  },
                    e('span', null, formatDate(episode.info?.releasedate || episode.added)),
                    e('span', null, '•'),
                    e('span', null, formatDuration(episode.info?.duration_secs || episode.info?.duration)),
                    episode.info?.rating && e('span', { style: { color: '#fbbf24' } }, `⭐ ${episode.info.rating}`)
                  ),

                  e('div', {
                    style: {
                      fontSize: '14px',
                      color: '#999',
                      lineHeight: '1.5',
                      overflow: 'hidden',
                      textOverflow: 'ellipsis',
                      display: '-webkit-box',
                      WebkitLineClamp: 2,
                      WebkitBoxOrient: 'vertical'
                    }
                  }, episode.info?.plot || `Episódio ${episode.episode_num} da temporada ${selectedSeason}.`)
                )
              )
            )
          )
        )
      )
    }

    // ===== COMPONENTE: PÁGINA DE DETALHES DE SÉRIE/FILME =====
    function SerieDetails({ contentData }) {
      const [isFavorite, setIsFavorite] = useState(false)
      const [showEpisodes, setShowEpisodes] = useState(false)

      if (!contentData) {
        return e('div', { className: 'serie-detail-page' },
          e('div', { className: 'serie-detail-content' },
            e('p', { style: { color: '#fff', fontSize: '24px' } }, 'Carregando detalhes...')
          )
        )
      }

      const {
        title,
        name,
        year,
        tmdb_year,
        episodes_count,
        seasons_count,
        rating,
        tmdb_rating,
        tmdb_vote_count,
        genre,
        tmdb_genres,
        synopsis,
        plot,
        tmdb_plot,
        tmdb_overview,
        backdrop,
        tmdb_backdrop,
        poster,
        tmdb_poster,
        stream_icon,
        cover,
        trailer_url,
        cast,
        tmdb_cast,
        tmdb_director,
        tmdb_runtime,
        series_id,
        stream_id
      } = contentData

      // Dados processados - PRIORIZAR TMDB
      const displayTitle = title || name || 'Sem título'
      const displayYear = tmdb_year || year || '—'
      const displaySynopsis = tmdb_overview || tmdb_plot || synopsis || plot || 'Sinopse não disponível.'
      const displayBackdrop = tmdb_backdrop || backdrop || cover || stream_icon || 'https://via.placeholder.com/1920x1080/1a1a1a/ffffff?text=Sem+Imagem'
      const displayGenres = tmdb_genres || (genre ? genre.split(',').map(g => g.trim()).join(', ') : 'Drama')
      const displayRating = tmdb_rating ? `⭐ ${(tmdb_rating * 10).toFixed(0)}%` : (rating || '—')
      const displayDirector = tmdb_director || null
      const displayRuntime = tmdb_runtime ? `${tmdb_runtime} min` : null

      // ===== CORREÇÃO: Garantir que cast seja sempre um array =====
      let displayCast = tmdb_cast || cast || []

      // Se cast é string (vem do TMDB como "Nome1, Nome2, Nome3"), converter para array de objetos
      if (typeof displayCast === 'string') {
        displayCast = displayCast.split(',').map(name => ({
          name: name.trim(),
          profile_path: null
        }))
      } else if (!Array.isArray(displayCast)) {
        displayCast = []
      }

      const displayEpisodes = episodes_count || '—'
      const displaySeasons = seasons_count || '—'

      // Handlers
      const handleWatch = () => {
        // TODO: Navegar para player ou mostrar episódios
        if (series_id) {
          // É série: mostrar episódios
          setShowEpisodes(true)
        } else {
          // É filme: iniciar reprodução
          const id = stream_id || series_id
          const ext = 'mp4'
          const url = buildURL(cfg.server, ['movie', cfg.username, cfg.password, id + '.' + ext])
          setCurrent({ name: displayTitle, url, isHls: false })
          setView('player')
        }
      }

      const handleTrailer = () => {
        if (trailer_url) {
          window.open(trailer_url, '_blank')
        } else {
          alert('Trailer não disponível')
        }
      }

      const handleFavorite = () => {
        setIsFavorite(!isFavorite)
        // TODO: Salvar em localStorage ou API
      }

      const handleEpisodes = () => {
        // Navegar para a view de episódios
        setView('episodes')
      }

      const handleCastClick = (actor) => {
        // TODO: Modal com biografia do ator
      }

      return e('div', { className: 'serie-detail-page' },
        // Backdrop
        e('div', {
          className: 'serie-detail-backdrop',
          style: { backgroundImage: `url(${displayBackdrop})` }
        }),

        // Botão Voltar
        e('button', {
          onClick: () => setView('netflix-movies'),
          style: {
            position: 'fixed',
            top: '20px',
            left: '20px',
            zIndex: 1000,
            background: 'rgba(0, 0, 0, 0.7)',
            border: 'none',
            color: '#fff',
            fontSize: '24px',
            width: '50px',
            height: '50px',
            borderRadius: '50%',
            cursor: 'pointer',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            transition: 'all 0.2s ease',
            backdropFilter: 'blur(10px)'
          },
          onMouseEnter: (e) => {
            e.target.style.background = 'rgba(244, 117, 33, 0.9)'
            e.target.style.transform = 'scale(1.1)'
          },
          onMouseLeave: (e) => {
            e.target.style.background = 'rgba(0, 0, 0, 0.7)'
            e.target.style.transform = 'scale(1)'
          }
        }, '←'),

        // Content
        e('div', { className: 'serie-detail-content' },
          // Header
          e('div', { className: 'serie-detail-header' },
            e('h1', null, displayTitle),

            // Metadados
            e('div', { className: 'serie-detail-metadata' },
              e('span', { className: 'serie-detail-rating-badge' }, displayRating),
              e('span', null, displayYear),
              series_id && e('span', null, `${displayEpisodes} Episódios (${displaySeasons} ${displaySeasons === 1 ? 'Temporada' : 'Temporadas'})`),
              displayRuntime && e('span', null, displayRuntime),
              e('span', null, displayGenres),
              displayDirector && e('span', null, `Dir: ${displayDirector}`)
            )
          ),

          // Sinopse
          e('p', { className: 'serie-detail-synopsis' }, displaySynopsis),

          // Botões de ação
          e('div', { className: 'serie-detail-actions' },
            e('button', {
              className: 'serie-detail-btn serie-detail-btn-watch',
              onClick: handleWatch
            },
              '▶ Assistir'
            ),

            trailer_url && e('button', {
              className: 'serie-detail-btn serie-detail-btn-trailer',
              onClick: handleTrailer
            },
              'Trailer'
            ),

            e('button', {
              className: 'serie-detail-btn serie-detail-btn-favorite',
              onClick: handleFavorite
            },
              isFavorite ? '💔 Remover dos Favoritos' : '❤️ Adicionar aos Favoritos'
            )
          ),

          // Botão Episódios (apenas para séries)
          series_id && e('button', {
            className: 'serie-detail-btn serie-detail-btn-episodes',
            onClick: handleEpisodes
          },
            '≡ Episódios e mais'
          ),

          // Seção Elenco
          displayCast.length > 0 && e('div', { className: 'serie-detail-cast-section' },
            e('h2', null, 'Elenco'),

            e('div', { className: 'serie-detail-cast-carousel' },
              displayCast.map((actor, idx) =>
                e('div', {
                  key: `cast-${idx}`,
                  className: 'serie-detail-cast-card',
                  onClick: () => handleCastClick(actor)
                },
                  e('img', {
                    src: actor.photo || actor.profile_path
                      ? `https://image.tmdb.org/t/p/w185${actor.profile_path || actor.photo}`
                      : 'https://via.placeholder.com/140x200/333/fff?text=Sem+Foto',
                    alt: actor.name,
                    loading: 'lazy'
                  }),
                  e('p', null, actor.name)
                )
              )
            )
          )
        )
      )
    }

    function Player(){
      const videoRef = useRef(null)
      const playerInstanceRef = useRef(null)
      const [hlsObj,setHlsObj] = useState(null)
      const containerRef = useRef(null)
      const [showHUD, setShowHUD] = useState(true) // HUD visível por padrão
      const [channelEPG, setChannelEPG] = useState(null)
      const [isFavorite, setIsFavorite] = useState(false)
      const [selectedPlayer] = useLocalStorage('selected_player', 'Clappr Player (Recommended)')

      // Cleanup ao desmontar
      useEffect(()=>{
        return ()=>{
          if(hlsObj){ try{ hlsObj.destroy() }catch{} }
          if(playerInstanceRef.current){
            try{
              if(typeof playerInstanceRef.current.destroy === 'function') playerInstanceRef.current.destroy()
              if(typeof playerInstanceRef.current.dispose === 'function') playerInstanceRef.current.dispose()
            }catch{}
          }
        }
      },[hlsObj])

      // Verificar se canal atual está nos favoritos
      useEffect(() => {
        if (!current?.stream_id) return
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')
        setIsFavorite(!!favorites[current.stream_id])
      }, [current?.stream_id])

      // Toggle favorito
      const toggleFavorite = () => {
        if (!current?.stream_id) return

        const newState = !isFavorite
        setIsFavorite(newState)

        // Salvar/remover do localStorage
        const favorites = JSON.parse(localStorage.getItem('dreamtv_favorites') || '{}')

        if (newState) {
          // Adicionar aos favoritos
          favorites[current.stream_id] = {
            stream_id: current.stream_id,
            num: current.num,
            name: current.name,
            stream_icon: current.stream_icon,
            stream_url: current.url,
            category_id: current.category_id,
            addedAt: Date.now()
          }
        } else {
          // Remover dos favoritos
          delete favorites[current.stream_id]
        }

        localStorage.setItem('dreamtv_favorites', JSON.stringify(favorites))

        // Notificar sistema para atualizar lista se estiver na categoria favoritos
        window.dispatchEvent(new CustomEvent('favorites-updated'))
      }

      // ⚠️ FULLSCREEN AUTOMÁTICO DESABILITADO
      // Agora o usuário controla quando quer fullscreen (botão F ou duplo clique)
      /*
      useEffect(() => {
        const enterFullscreen = async () => {
          const video = videoRef.current
          if (!video) return

          try {
            if (video.requestFullscreen) {
              await video.requestFullscreen()
            } else if (video.webkitRequestFullscreen) {
              await video.webkitRequestFullscreen()
            } else if (video.mozRequestFullScreen) {
              await video.mozRequestFullScreen()
            } else if (video.msRequestFullscreen) {
              await video.msRequestFullscreen()
            } else if (video.webkitEnterFullscreen) {
              // iOS Safari
              video.webkitEnterFullscreen()
            }
          } catch (err) {
          }
        }

        // Delay para garantir que o vídeo está carregado
        setTimeout(enterFullscreen, 300)
      }, [current])
      */

      // Handler ESC - volta para netflix-movies
      useEffect(() => {
        const handleEscape = (e) => {
          if (e.key === 'Escape') {
            e.preventDefault()

            // Sair do fullscreen se estiver ativo
            if (document.fullscreenElement || document.webkitFullscreenElement ||
                document.mozFullScreenElement || document.msFullscreenElement) {
              if (document.exitFullscreen) {
                document.exitFullscreen()
              } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen()
              } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen()
              } else if (document.msExitFullscreen) {
                document.msExitFullscreen()
              }
            }

            // Voltar para netflix-movies
            setView('netflix-movies')
          }
        }

        window.addEventListener('keydown', handleEscape)
        return () => window.removeEventListener('keydown', handleEscape)
      }, [])

      useEffect(()=>{
        const v = videoRef.current
        if(!v || !current) return

        // Cleanup player anterior
        if(playerInstanceRef.current){
          try{
            if(typeof playerInstanceRef.current.destroy === 'function') playerInstanceRef.current.destroy()
            if(typeof playerInstanceRef.current.dispose === 'function') playerInstanceRef.current.dispose()
          }catch{}
          playerInstanceRef.current = null
        }

        // Inicializar player baseado na seleção
        if(selectedPlayer === 'Clappr Player (Recommended)' && window.Clappr){
          const player = new Clappr.Player({
            source: current.url,
            parentId: `#${v.parentElement.id || 'player-container'}`,
            width: '100%',
            height: '100%',
            autoPlay: true,
            playback: {
              hlsjsConfig: {
                maxBufferLength: 10,
                maxMaxBufferLength: 20
              }
            }
          })
          playerInstanceRef.current = player
          v.style.display = 'none'
        }
        else if(selectedPlayer === 'Video.js Player' && window.videojs){
          v.className = 'video-js vjs-default-skin'
          const player = videojs(v, {
            autoplay: true,
            controls: false,
            fluid: true,
            html5: {
              hls: {
                overrideNative: true
              }
            }
          })
          player.src({ src: current.url, type: 'application/x-mpegURL' })
          playerInstanceRef.current = player
        }
        else if(selectedPlayer === 'JW Player' && window.jwplayer){
          const player = jwplayer(v.parentElement)
          player.setup({
            file: current.url,
            width: '100%',
            height: '100%',
            autostart: true,
            controls: false
          })
          playerInstanceRef.current = player
          v.style.display = 'none'
        }
        else if(selectedPlayer === 'Flow Player' && window.flowplayer){
          const player = flowplayer(v.parentElement, {
            src: current.url,
            autoplay: true,
            controls: false
          })
          playerInstanceRef.current = player
          v.style.display = 'none'
        }
        else {
          // HLS.js (Sistema) - fallback padrão
          v.style.display = 'block'
          const isM3U8 = /\.m3u8($|\?)/i.test(current.url)
          const canNative = v.canPlayType('application/vnd.apple.mpegURL')
          if(isM3U8 && !canNative && window.Hls && window.Hls.isSupported()){
            const hls = new Hls({
              maxBufferLength: 10,
              maxMaxBufferLength: 20,
              autoStartLoad: true,
              enableWorker: true
            })
            hls.loadSource(current.url)
            hls.attachMedia(v)
            setHlsObj(hls)
          }else{ v.src = current.url }
          v.play().catch(()=>{})
        }
      },[current, selectedPlayer])

      // Handlers para mostrar HUD
      useEffect(() => {
        const handleInteraction = () => setShowHUD(true)
        const handleKeyDown = (e) => {
          // OK/Enter - toggle HUD
          if (e.key === 'Enter' || e.key === 'OK') {
            e.preventDefault()
            setShowHUD(prev => !prev)
          }
          // F - Fullscreen (o próprio HUD tem o botão)
          if (e.key === 'f' || e.key === 'F') {
            setShowHUD(true)
          }
          // Setas - mostrar HUD
          if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
            setShowHUD(true)
          }
        }

        window.addEventListener('mousemove', handleInteraction)
        window.addEventListener('keydown', handleKeyDown)

        return () => {
          window.removeEventListener('mousemove', handleInteraction)
          window.removeEventListener('keydown', handleKeyDown)
        }
      }, [])

      return e('div', { ref: containerRef, className:'bg-black min-h-screen flex flex-col' },
        e(TopBar),
        e('div', { className:'bg-zinc-900/60 px-4 py-3 flex items-center justify-between' },
          e('button', { onClick:()=>setView('channels'), className:'text-white hover:text-purple-400 flex items-center gap-2' }, '← Voltar'),
          e('h2', { className:'text-white font-semibold truncate max-w-[60vw]' }, current?.name || 'Reprodução'),
          e('div', { className:'w-10' })
        ),
        e('div', { id: 'player-container', className:'flex-1 grid place-items-center p-4 relative' },
          e('video', { ref:videoRef, controls:false, playsInline:true, className:'w-full max-w-6xl rounded-lg bg-black' }),
          // PlayerHUD sobreposto
          e(PlayerHUD, {
            visible: showHUD,
            videoRef: videoRef,
            hlsObj: hlsObj,
            channelInfo: {
              num: current?.num || '---',
              name: current?.name || 'Canal',
              stream_icon: current?.stream_icon,
              stream_id: current?.stream_id,
              epg: channelEPG
            },
            onHide: () => setShowHUD(false)
          })
        )
      )
    }

    function Config(){
      // ===== DNS FIXO: http://infcsfortal.pro =====
      // Garante que o servidor está sempre configurado corretamente
      const [serverSet, setServerSet] = useState(false)
      React.useEffect(() => {
        if (!serverSet && cfg.server !== 'http://infcsfortal.pro') {
          setCfg(v => ({...v, server: 'http://infcsfortal.pro'}))
          setServerSet(true)
        }
      }, [serverSet])

      // Estados locais para os inputs - TOTALMENTE independentes de cfg
      const [localUsername, setLocalUsername] = useState('')
      const [localPassword, setLocalPassword] = useState('')

      // Inicializar valores apenas UMA VEZ
      const initialized = useRef(false)
      React.useEffect(() => {
        if (!initialized.current && (cfg.username || cfg.password)) {
          setLocalUsername(cfg.username || '')
          setLocalPassword(cfg.password || '')
          initialized.current = true
        }
      }, [])

      // Função de conexão
      const handleConnect = () => {
        // Atualizar cfg com os valores locais
        setCfg(v => ({...v, username: localUsername, password: localPassword}))
        // Conectar após breve delay para garantir que cfg foi atualizado
        setTimeout(() => onConnect(), 50)
      }

      return e('div', { className:'star-bg min-h-screen grid place-items-center p-4' },
        e('div', { className:'frost rounded-2xl p-6 w-full max-w-md' },
          e('div', {
            style: {
              fontSize: '48px',
              fontWeight: 'bold',
              letterSpacing: '3px',
              display: 'flex',
              justifyContent: 'center',
              marginBottom: '30px'
            }
          },
            e('span', { style: { color: '#e50914' } }, 'DREAM'),
            e('span', { style: { color: '#fff' } }, 'TV')
          ),
          e('div', { className:'space-y-3' },
            // ===== CAMPO DNS REMOVIDO (fixo: http://infcsfortal.pro) =====
            e('div', null, e('label', { className:'text-white text-sm mb-2 block' }, 'Usuário'),
              e('input', {
                type:'text',
                value:localUsername,
                onChange:(ev)=>setLocalUsername(ev.target.value),
                onKeyDown:(ev)=>{ if(ev.key==='Enter') handleConnect() },
                className:'w-full frost text-white px-4 py-3 rounded-lg focus:outline-none',
                placeholder:'Digite o usuário'
              })
            ),
            e('div', null, e('label', { className:'text-white text-sm mb-2 block' }, 'Senha'),
              e('input', {
                type:'password',
                value:localPassword,
                onChange:(ev)=>setLocalPassword(ev.target.value),
                onKeyDown:(ev)=>{ if(ev.key==='Enter') handleConnect() },
                className:'w-full frost text-white px-4 py-3 rounded-lg focus:outline-none',
                placeholder:'Digite a senha'
              })
            ),
            // ===== CAMPO TMDB API KEY REMOVIDO (agora usa chave fixa interna) =====
            e('button', { onClick:handleConnect, disabled:loading, className:'w-full bg-gradient-to-r from-purple-500 to-blue-500 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed mt-4' }, loading ? 'Conectando...' : 'Conectar'),
            error && e('div', { className:'text-red-300 text-xs mt-2' },
              e('div', null, error),
              debug? e('div', {className:'hint text-gray-400 mt-1'}, 'URL: ', maskUrlCredentials(debug.url||'')) : null
            )
          ),
          account && e('div', { className:'text-green-300 text-sm mt-3' }, 'Conectado como ', account.username)
        )
      )
    }

    function TrailerModal(){
      if(!showTrailerModal || !trailerUrl) return null

      return e('div', {
        onClick: () => {
          setShowTrailerModal(false)
          setTrailerUrl(null)
        },
        style: {
          position: 'fixed',
          top: 0,
          left: 0,
          right: 0,
          bottom: 0,
          backgroundColor: 'rgba(0, 0, 0, 0.95)',
          zIndex: 999999,
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          padding: '20px'
        }
      },
        // Botão fechar (X)
        e('button', {
          onClick: (ev) => {
            ev.stopPropagation()
            setShowTrailerModal(false)
            setTrailerUrl(null)
          },
          style: {
            position: 'absolute',
            top: '20px',
            right: '20px',
            background: 'rgba(255, 255, 255, 0.2)',
            border: 'none',
            borderRadius: '50%',
            width: '50px',
            height: '50px',
            color: '#fff',
            fontSize: '24px',
            cursor: 'pointer',
            zIndex: 1000000,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            transition: 'all 0.2s'
          },
          onMouseEnter: (ev) => {
            ev.target.style.background = 'rgba(255, 255, 255, 0.3)'
            ev.target.style.transform = 'scale(1.1)'
          },
          onMouseLeave: (ev) => {
            ev.target.style.background = 'rgba(255, 255, 255, 0.2)'
            ev.target.style.transform = 'scale(1)'
          }
        }, '✕'),

        // Video container
        e('div', {
          onClick: (ev) => ev.stopPropagation(),
          style: {
            width: '100%',
            maxWidth: '1200px',
            aspectRatio: '16/9',
            backgroundColor: '#000'
          }
        },
          e('iframe', {
            src: trailerUrl + '?autoplay=1&rel=0&modestbranding=1',
            allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
            allowFullScreen: true,
            style: {
              width: '100%',
              height: '100%',
              border: 'none'
            }
          })
        )
      )
    }

    function Toast(){
      if(!toast) return null
      return e('div', {
        className: 'fixed top-6 right-6 z-50 px-6 py-3 rounded-lg text-white font-semibold shadow-2xl animate-fade-in',
        style: { backgroundColor: 'rgba(0, 230, 118, 0.95)' }
      }, toast)
    }

    // ===== Botão de Fullscreen =====
    function FullscreenButton(){
      const [isFullscreen, setIsFullscreen] = useState(false)

      // Detectar mudanças de fullscreen (F11, ESC, etc)
      useEffect(() => {
        const handleFullscreenChange = () => {
          setIsFullscreen(!!document.fullscreenElement)
        }

        document.addEventListener('fullscreenchange', handleFullscreenChange)
        document.addEventListener('webkitfullscreenchange', handleFullscreenChange)
        document.addEventListener('mozfullscreenchange', handleFullscreenChange)
        document.addEventListener('MSFullscreenChange', handleFullscreenChange)

        return () => {
          document.removeEventListener('fullscreenchange', handleFullscreenChange)
          document.removeEventListener('webkitfullscreenchange', handleFullscreenChange)
          document.removeEventListener('mozfullscreenchange', handleFullscreenChange)
          document.removeEventListener('MSFullscreenChange', handleFullscreenChange)
        }
      }, [])

      // Usando emoji para ícones (sem dependência de bibliotecas externas)

      const toggleFullscreen = async () => {
        try {
          if (!document.fullscreenElement) {
            // Entrar em fullscreen
            const elem = document.documentElement
            if (elem.requestFullscreen) {
              await elem.requestFullscreen()
            } else if (elem.webkitRequestFullscreen) {
              await elem.webkitRequestFullscreen()
            } else if (elem.mozRequestFullScreen) {
              await elem.mozRequestFullScreen()
            } else if (elem.msRequestFullscreen) {
              await elem.msRequestFullscreen()
            }
          } else {
            // Sair de fullscreen
            if (document.exitFullscreen) {
              await document.exitFullscreen()
            } else if (document.webkitExitFullscreen) {
              await document.webkitExitFullscreen()
            } else if (document.mozCancelFullScreen) {
              await document.mozCancelFullScreen()
            } else if (document.msExitFullscreen) {
              await document.msExitFullscreen()
            }
          }
        } catch (err) {
        }
      }

      // Não mostrar na tela de config (login)
      if(view === 'config') return null

      return e('button', {
        onClick: toggleFullscreen,
        className: 'fixed top-6 right-6 z-50 w-12 h-12 rounded-full flex items-center justify-center transition-all hover:scale-110 hover:bg-purple-500/30 group',
        style: {
          backgroundColor: 'rgba(30, 30, 30, 0.8)',
          backdropFilter: 'blur(8px)',
          border: '1px solid rgba(168, 85, 247, 0.3)'
        },
        title: isFullscreen ? 'Sair da tela cheia (ESC)' : 'Tela cheia (F11)'
      },
        // Ícone usando emoji
        e('span', {
          className: 'text-white transition-colors group-hover:text-purple-400',
          style: { fontSize: '20px' }
        }, isFullscreen ? '🗗' : '⛶')
      )
    }

    // ===== Router =====
    let content
    if(view==='config') content = e(Config)
    else if(view==='settings') content = e(Settings, { account, setView })
    else if(view==='home') content = e(Home)
    else if(view==='netflix-movies'){
      // Só renderizar quando selectedCat estiver definido
      if (selectedCat) {
        content = e(NetflixMovies, { key: `vod-${getCatId(selectedCat)}`, contentType: 'vod', selectedCategory: selectedCat })
      } else {
        content = e('div', { style: { display: 'flex', alignItems: 'center', justifyContent: 'center', minHeight: '100vh', color: '#fff' } }, 'Carregando categorias...')
      }
    }
    else if(view==='netflix-series'){
      if (selectedCat) {
        content = e(NetflixMovies, { key: `series-${getCatId(selectedCat)}`, contentType: 'series', selectedCategory: selectedCat })
      } else {
        content = e('div', { style: { display: 'flex', alignItems: 'center', justifyContent: 'center', minHeight: '100vh', color: '#fff' } }, 'Carregando categorias...')
      }
    }
    else if(view==='netflix-novelas'){
      content = e(NetflixMovies, { key: 'series-novela', contentType: 'series', categoryFilter: 'novela' })
    }
    else if(view==='netflix-animes'){
      content = e(NetflixMovies, { key: 'series-crunchyroll', contentType: 'series', categoryFilter: 'crunchyroll' })
    }
    else if(view==='netflix-desenhos'){
      content = e(NetflixMovies, { key: 'series-desenho', contentType: 'series', categoryFilter: 'desenho' })
    }
    else if(view==='netflix-show'){
      content = e(NetflixMovies, { key: 'series-show', contentType: 'series', categoryFilter: 'show' })
    }
    else if(view==='collections'){
      content = e(NetflixMovies, { key: 'vod-collections', contentType: 'vod' })
    }
    else if(view==='adult-content'){
      if (selectedCat) {
        content = e(NetflixMovies, { key: `adult-${getCatId(selectedCat)}`, contentType: 'vod', selectedCategory: selectedCat })
      } else {
        content = e('div', { style: { display: 'flex', alignItems: 'center', justifyContent: 'center', minHeight: '100vh', color: '#fff' } }, 'Carregando categorias...')
      }
    }
    else if(view.endsWith('-categories')) content = e(Categories)
    else if(view==='channels' && selectedCat) content = e(Channels)
    else if(view==='serie-details' && selectedContent) content = e(SerieDetails, { contentData: selectedContent })
    else if(view==='episodes' && selectedContent) content = e(EpisodesList, { seriesData: selectedContent })
    else if(view==='player' && current) content = e(Player)
    else content = e('div', { className:'star-bg min-h-screen grid place-items-center text-white' }, 'Carregando...')

    // Não mostrar header apenas na config (login), settings e no player
    const showHeader = view !== 'config' && view !== 'player' && view !== 'settings'
    const showCategoryBar = showHeader && (view === 'netflix-movies' || view === 'vod-categories')

    return e('div', { className: 'app-container' },
      // Header global Netflix-style (substitui sidebar)
      showHeader && e(Header, { view, setView, globalSearchQuery, setGlobalSearchQuery, onLogout, account, setShowParentalPin, setPendingAdultView }),

      // Barra de categorias de filmes e séries
      showHeader && e(CategoryBar, { vodCats, seriesCats, view, setView, selectedCat, setSelectedCat }),

      e('div', {
        className: 'main-content',
        style: {
          marginLeft: 0,
          width: '100vw',
          paddingTop: showHeader ? '60px' : '0'
        }
      },
        content,
        e(TrailerModal),
        e(Toast),
        // Indicador de navegação numérica (canal digitado)
        channelInput && e('div', { className: 'tv-channel-input' },
          e('div', { style: { fontSize: '24px', color: '#a855f7', marginBottom: '10px' } }, 'Canal'),
          channelInput
        ),
        // Tela de PIN de controle parental
        showParentalPin && e(ParentalPinScreen, {
          onSuccess: () => {
            setShowParentalPin(false)
            if (pendingAdultView) {
              setView('adult-content')
              setPendingAdultView(false)
            }
          },
          onCancel: () => {
            setShowParentalPin(false)
            setPendingAdultView(false)
          }
        })
      )
    )
  }

  const root = ReactDOM.createRoot(document.getElementById('app'))
  root.render(e(App))

  // Header agora está visível - código de remoção removido

  // ===== Pequenos testes =====
  ;(function runTests(){
    const tests = []
    function assert(name, cond){ tests.push([name, !!cond]) }
    try{
      assert('sanitizeServer adiciona http', sanitizeServer('example.com')==='http://example.com')
      assert('sanitizeServer remove barra final', sanitizeServer('http://a.com/')==='http://a.com')
      assert('sanitizeServer mantém https', sanitizeServer('https://a.com').startsWith('https://'))
      assert('buildURL concatena segmentos', buildURL('http://a.com', ['x','y'])==='http://a.com/x/y')
      assert('buildURL remove barras extras', buildURL('http://a.com/', ['/x/','/y/'])==='http://a.com/x/y')
      assert('formatEPGTime string HH:MM', formatEPGTime('08:30')==='08:30')
      const nowSec = Math.floor(Date.now()/1000)
      assert('formatEPGTime timestamp s/ms', /\d{2}:\d{2}/.test(formatEPGTime(nowSec)) && /\d{2}:\d{2}/.test(formatEPGTime(nowSec*1000)))
      assert('maskUrlCredentials oculta user/pass (qs)', /\*\*\*/.test(maskUrlCredentials('http://x/player_api.php?username=u&password=p')))
      // Normalizadores
      assert('toArray aceita array', Array.isArray(toArray([{a:1}])))
      assert('toArray aceita objeto-indexado', Array.isArray(toArray({0:{a:1},1:{a:2}})))
      assert('getCatId cobre vários campos', getCatId({category_id:123})===123 && getCatId({id:9})===9)
      // Quality variants
      assert('extractBaseName remove qualidade', extractBaseName('Globo HD')==='Globo')
      assert('extractBaseName remove qualidade FHD²', extractBaseName('SBT FHD²')==='SBT')
      assert('detectQuality identifica HD', detectQuality('Globo HD')==='HD')
      assert('detectQuality retorna null sem sufixo', detectQuality('Globo')===null)
      // Extras
      assert('toArray(null) => []', Array.isArray(toArray(null)) && toArray(null).length===0)
      assert('getCatId CategoryID/categoryid', getCatId({CategoryID:7})===7 && getCatId({categoryid:8})===8)
      assert('maskUrlCredentials mascara path credenciais', !(/\/live\/[\w-]+\/[\w-]+\//.test(maskUrlCredentials('http://x/live/u/p/999.m3u8'))))
      assert('formatEPGTime inválido => "--:--"', formatEPGTime('abc')==='--:--' && formatEPGTime(null)==='--:--')
      assert('getCatId null => null', getCatId(null)===null)
      // Novo: contagem de categorias
      const tmp={}; ['1','2','1'].forEach(id=> tmp[id]=(tmp[id]||0)+1)
      assert('agrupamento simples funciona', tmp['1']===2 && tmp['2']===1)
    }catch(err){ }
    const passed = tests.filter(t=>t[1]).length
    if(tests.length){ console.info(`// ===== Pequenos testes (DevTests) ===== ${passed}/${tests.length} passed`, tests) }
  })()
  </script>
</body>
</html>

