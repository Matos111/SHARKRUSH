<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
            :root {
            --primary-red: #FF3B3F;
            --dark-bg: #0A0A0A;
            --light-text: #F5F5F5;
            --hover-red: #FF5256;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #FAFAFA;
        }

        header {
            background: var(--dark-bg);
            padding: 1.2rem 6%;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            width: 180px;
            height: 40px;
            background: url('sua-logo-aqui.svg') no-repeat center;
            background-size: contain;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-red);
            border-radius: 8px;
            z-index: -1;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            color: var(--dark-bg);
        }

        .nav-link:hover::before {
            transform: scaleX(1);
            transform-origin: left;
        }

        .nav-link.active {
            color: var(--primary-red);
            font-weight: 600;
        }

        .mobile-menu {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            z-index: 1001;
        }

        .hamburger {
            width: 32px;
            height: 24px;
            position: relative;
            transition: all 0.3s ease;
        }

        .hamburger span {
            position: absolute;
            height: 3px;
            width: 100%;
            background: var(--light-text);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger span:nth-child(1) { top: 0; }
        .hamburger span:nth-child(2) { top: 10px; }
        .hamburger span:nth-child(3) { top: 20px; }

        .mobile-menu.active .hamburger span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
        }

        .mobile-menu.active .hamburger span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu.active .hamburger span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        @media (max-width: 1024px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                flex-direction: column;
                background: var(--dark-bg);
                width: 280px;
                height: 100vh;
                padding: 120px 2rem 2rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -4px 0 20px rgba(0,0,0,0.2);
            }

            .nav-links.active {
                right: 0;
            }

            .nav-link {
                width: 100%;
                text-align: center;
                padding: 12px 24px;
            }

            .mobile-menu {
                display: block;
            }
        }

        .scroll-header {
            background: rgba(10, 10, 10, 0.95);
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
    <header id="header">
        <nav class="nav-container">
            <div class="logo"></div>
            
            <div class="nav-links">
                <a href="#imc" class="nav-link active">IMC</a>
                <a href="#calorias" class="nav-link">Calorias</a>
                <a href="#academias" class="nav-link">Academias</a>
                <a href="#treinos" class="nav-link">Treinos</a>
            </div>

            <button class="mobile-menu" onclick="toggleMenu()">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </nav>
    </header>
<h2>Atualizar Sessão</h2>
<form method="POST" action="index.php?action=update">
    <input type="hidden" name="id" value="<?= $sessao['id'] ?>">
    Exercício ID: <input type="text" name="id_exercicio" value="<?= $sessao['id_exercicio'] ?>"><br>
    Séries: <input type="number" name="series" value="<?= $sessao['series'] ?>"><br>
    Repetições: <input type="number" name="repeticoes" value="<?= $sessao['repeticoes'] ?>"><br>
    Grupo Muscular: <input type="text" name="grupo_muscular" value="<?= $sessao['grupo_muscular'] ?>"><br>
    Dia da Semana: 
    <select name="dia_semana">
        <option <?= $sessao['dia_semana']=='Segunda'?'selected':'' ?>>Segunda</option>
        <option <?= $sessao['dia_semana']=='Terça'?'selected':'' ?>>Terça</option>
        <option <?= $sessao['dia_semana']=='Quarta'?'selected':'' ?>>Quarta</option>
        <option <?= $sessao['dia_semana']=='Quinta'?'selected':'' ?>>Quinta</option>
        <option <?= $sessao['dia_semana']=='Sexta'?'selected':'' ?>>Sexta</option>
        <option <?= $sessao['dia_semana']=='Sábado'?'selected':'' ?>>Sábado</option>
        <option <?= $sessao['dia_semana']=='Domingo'?'selected':'' ?>>Domingo</option>
    </select><br>
    <button type="submit">Atualizar</button>
</form>
    <footer>
    <div class="left">
      <div class="left-title">Converse conosco!</div>
      <span class="link" onclick="copyToClipboard('11999999999')">
        <img src="C:\Users\3anoA\Documents\Guilherme M\PROJETO\SHARKRUSH\midia\Logos\Logo_watzapp_SHARKRUSH.png" class="logo" alt="Logo Watzapp">Whatsapp
      </span>
      <span class="link" onclick="copyToClipboard('email@exemplo.com')">
        <img src="C:\Users\3anoA\Documents\Guilherme M\PROJETO\SHARKRUSH\midia\Logos\Logo_email_SHARKRUSH.png" class="logo" alt="Logo email">Email
      </span>
    </div>

    <div class="center">
      <a href="/pagina-inicial.html">
        <img src="C:\Users\3anoA\Documents\Guilherme M\PROJETO\SHARKRUSH\midia\Logos\logoshark.png" class="logo_sharkrush" alt="Logo">
      </a>
    </div>

    <div class="right">
      <div class="right-title">Siga-nos nas redes sociais!</div>
      <a href="https://www.instagram.com/suaempresa" class="link" target="_blank">
        <img src="C:\Users\3anoA\Documents\Guilherme M\PROJETO\SHARKRUSH\midia\Logos\Logo_instagram_SHARKRUSH.png" class="logo" alt="Logo instagram">Instagram
      </a>
      <a href="https://www.facebook.com/suaempresa" class="link" target="_blank">
        <img src="C:\Users\3anoA\Documents\Guilherme M\PROJETO\SHARKRUSH\midia\Logos\Logo_facebook_SHARKRUSH.png" class="logo" alt="Logo facebook">Facebook
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
            function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            const mobileMenu = document.querySelector('.mobile-menu');
            navLinks.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        }

        // Fechar menu ao clicar fora
        document.addEventListener('click', (e) => {
            const navLinks = document.querySelector('.nav-links');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (!e.target.closest('.nav-container')) {
                navLinks.classList.remove('active');
                mobileMenu.classList.remove('active');
            }
        });

        // Efeito de scroll no header
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            header.classList.toggle('scroll-header', window.scrollY > 50);
        });

        // Scroll suave
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const section = document.querySelector(link.getAttribute('href'));
                section?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Fechar menu mobile
                if (window.innerWidth <= 1024) {
                    toggleMenu();
                }
            });
        });

        // Ativar link correspondente
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');
                
                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>