<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos Cadastrados</title>
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

<h1>Meus Treinos</h1>
<table border="1">
    <tr>
        <th>Dia da semana</th>
        <th>Grupo muscular</th>
        <th>Data de criação</th>
    </tr>
    <?php foreach ($treinos as $treino): ?>
    <tr>
        <td><?php echo $treino['dia_semana']; ?></td>
        <td><?php echo $treino['grupo_muscular']; ?></td>
        <td><?php echo $treino['data_criacao']; ?></td>
        <td>
            <a href="/SHARKRUSH/update-treino/<?php echo $treino['id']; ?>">Atualizar</a>

            <form action="/SHARKRUSH/delete-treino" method="POST" style="display:inline;">
                <input type="hidden" name="dia_semana" value="<?php echo $treino['dia_semana']; ?>">
                <button type="submit">Excluir</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="/SHARKRUSH/public">Cadastrar novo treino</a>

<script>
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

