<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sobre-nós-SHARKRUSH</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #121212;
      color: #9E9E9E;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 70px;
      height: 100%;
      background-color: #000;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 100px;
      gap: 25px;
      z-index: 100;
      border-right: 2px solid #FE4100;
    }
    .icon {
      width: 50px;
      height: 40px;
      transition: transform 0.3s;
      cursor: pointer;
    }
    .icon:hover {
      transform: scale(1.2);
    }
    header {
      background-color: #000;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 40px 20px 120px; 
      border-bottom: 2px solid #FE4100;
    }
    .logo-container {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    .logo-text {
      font-weight: bold;
      font-size: 24px;
    }
    .logo-text span {
      color: #FE4100;
    }
    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
    }
    .profile-icon {
      width: 30px;
      height: 30px;
    }
    .sobre-nos {
      display: grid;
      grid-template-columns: 1fr 1fr;
      padding: 40px 40px 40px 120px;
      gap: 40px;
      background-color: #121212;
      align-items: center;
    }
    .titulo {
      font-weight: 900;
      color: #FE4100;
      font-size: xx-large;
    }
    .imagem {
      width: 100%;
      border: 5px solid #FE4100;
    }
    footer {
      background-color: #000000;
      color: #9E9E9E;
      padding: 40px 20px 20px 120px;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      align-items: start;
      text-align: center;
    }
    .left, .right {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .left-title, .right-title {
      font-weight: bold;
      margin-bottom: 10px;
      color: #FE4100;
    }
    .center {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .center img {
      height: 60px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    .center img:hover {
      transform: scale(1.1);
    }
    .link {
      color: #FF0000;
      text-decoration: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      justify-content: center;
    }
    .link:hover {
      color: #FE4100;
    }
    .logo {
      width: 35px;
      height: 20px;
    }
    .logo_sharkrush {
      height: 70px;
      width: 70px;
      justify-self: center;
    }
    .copy-notification {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #FE4100;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      opacity: 0;
      transition: opacity 0.4s;
      z-index: 1000;
    }
    .copy-notification.show {
      opacity: 1;
    }
    .collaborators {
      background-color: #000000;
      color: #9E9E9E;
      text-align: center;
      padding: 20px;
      font-size: 14px;
    }
    .collaborators-title {
      color: #FE4100;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .collaborator-names {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <a href="/home.html"><img src="IMAGEM-BARRA_LATERAL-1-SHARKRUSH.png" alt="Home" class="icon" /></a>
    <a href="/equipamentos.html"><img src="IMAGEM-BARRA_LATERAL-2-SHARKRUSH.png" alt="Equipamentos" class="icon" /></a>
    <a href="/treinos.html"><img src="IMAGEM-BARRA_LATERAL-3-SHARKRUSH.png" alt="Treinos" class="icon" /></a>
    <a href="/pagamentos.html"><img src="IMAGEM-BARRA_LATERAL-4-SHARKRUSH.png" alt="Pagamentos" class="icon" /></a>
    <a href="/pesagem.html"><img src="IMAGEM-BARRA_LATERAL-5-SHARKRUSH.png" alt="Pesagem" class="icon" /></a>
    <a href="/corrida.html"><img src="IMAGEM-BARRA_LATERAL-6-SHARKRUSH.png" alt="Corrida" class="icon" /></a>
    <a href="/localizacao.html"><img src="IMAGEM-BARRA_LATERAL-7-SHARKRUSH.png" alt="Localização" class="icon" /></a>
  </div>
  <header>
    <div class="logo-container">
      <div class="logo-text"><span>SHARK</span>RUSH</div>
      <img src="logoshark.png" alt="Logo" class="logo_sharkrush" />
    </div>
    <div class="profile">
      <span>MEU PERFIL</span>
      <img src="icone_perfil.png" alt="Perfil" class="profile-icon" />
    </div>
  </header>
  <section class="sobre-nos">
    <div class="esquerda">
      <h2 class="titulo">SOBRE NÓS</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ipsum vitae lacus lobortis lacinia. Donec tristique arcu massa, at pharetra tortor feugiat non.</p>
      <img class="imagem" src="IMAGEM-SOBRE-2-SHARKRUSH.png" alt="Imagem pessoa treinando">
    </div>
    <div class="direita">
      <img class="imagem" src="IMAGEM-SOBRE-1-SHARKRUSH.png" alt="Imagem pessoa treinando">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at ipsum vitae lacus lobortis lacinia. Donec tristique arcu massa, at pharetra tortor feugiat non.</p>
    </div>
  </section>
  <footer>
    <div class="left">
      <div class="left-title">Converse conosco!</div>
      <span class="link" onclick="copyToClipboard('11999999999')">
        <img src="Logo_watzapp_SHARKRUSH.png" class="logo" alt="Logo Watzapp">Whatsapp
      </span>
      <span class="link" onclick="copyToClipboard('email@exemplo.com')">
        <img src="Logo_email_SHARKRUSH.png" class="logo" alt="Logo email">Email
      </span>
    </div>

    <div class="center">
      <a href="/pagina-inicial.html">
        <img src="logoshark.png" class="logo_sharkrush" alt="Logo">
      </a>
    </div>

    <div class="right">
      <div class="right-title">Siga-nos nas redes sociais!</div>
      <a href="https://www.instagram.com/suaempresa" class="link" target="_blank">
        <img src="Logo_instagram_SHARKRUSH.png" class="logo" alt="Logo instagram">Instagram
      </a>
      <a href="https://www.facebook.com/suaempresa" class="link" target="_blank">
        <img src="Logo_facebook_SHARKRUSH.png" class="logo" alt="Logo facebook">Facebook
      </a>
    </div>
  </footer>
  <div class="collaborators">
    <div class="collaborators-title">Colaboradores</div>
    <div class="collaborator-names">
      <span>Augusto Sena</span>
      <span>Gabriella Teixeira</span>
      <span>Guilherme Monte</span>
      <span>Miguel Fortunato</span>
    </div>
  </div>
  <div id="copyAlert" class="copy-notification">Copiado para a área de transferência</div>
  <script>
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        const alertBox = document.getElementById("copyAlert");
        alertBox.classList.add("show");
        setTimeout(() => {
          alertBox.classList.remove("show");
        }, 2000);
      });
    }
  </script>
</body>
</html>