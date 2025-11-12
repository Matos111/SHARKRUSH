<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Políticas de Privacidade e Termos de Uso</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Poppins', 'Arial', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .shark-fin {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-bottom: 40px solid #ff0000;
            animation: swim 8s linear infinite;
        }

        @keyframes swim {
            0% { transform: translateX(-100px) rotate(0deg); }
            50% { transform: translateX(calc(100vw + 100px)) rotate(15deg); }
            100% { transform: translateX(-100px) rotate(0deg); }
        }

        .container {
            max-width: 1200px;
            width: 100%;
            padding: 20px;
            margin-left: 90px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            animation: fadeInDown 1s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #b8b8b8;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            font-weight: 400;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tabs-container {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            justify-content: center;
            animation: fadeInUp 1s ease-out both;
        }

        .tab-button {
            padding: 18px 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 0, 0, 0.3);
            border-radius: 10px;
            color: #cccccc;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tab-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 0, 0.1), transparent);
            transition: left 0.5s;
        }

        .tab-button:hover::before {
            left: 100%;
        }

        .tab-button:hover {
            border-color: #ff0000;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 0, 0, 0.3);
        }

        .tab-button.active {
            background: linear-gradient(45deg, #ff0000, #cc0000);
            border-color: #ff0000;
            color: #ffffff;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.4);
        }

        .content-section {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #ff0000;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            animation: fadeInUp 1s ease-out both;
            position: relative;
            overflow: hidden;
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .content-section::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff0000, transparent, #ff0000);
            border-radius: 20px;
            z-index: -1;
            animation: borderGlow 2s linear infinite;
        }

        @keyframes borderGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            color: #ff0000;
            font-size: 1.8rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            letter-spacing: -0.3px;
        }

        .section-title i {
            font-size: 1.8rem;
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
        }

        .section-content {
            font-size: 1.1rem;
            color: #cccccc;
        }

        .section-content h3 {
            color: #ff0000;
            font-size: 1.3rem;
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .section-content p {
            margin-bottom: 20px;
            text-align: justify;
        }

        .section-content ul {
            margin: 15px 0 20px 30px;
            list-style: none;
        }

        .section-content ul li {
            margin-bottom: 12px;
            position: relative;
            padding-left: 25px;
        }

        .section-content ul li::before {
            content: '▸';
            color: #ff0000;
            position: absolute;
            left: 0;
            font-size: 1.2rem;
        }

        .highlight-box {
            background: rgba(255, 0, 0, 0.1);
            border-left: 4px solid #ff0000;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .highlight-box strong {
            color: #ff0000;
            display: block;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .last-update {
            text-align: center;
            color: #adadad;
            font-size: 0.95rem;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 0, 0, 0.2);
        }

        /* NAVBAR CSS INÍCIO */
        .main-menu {
            background: linear-gradient(180deg, #232323 0%, #1a1a1a 100%);
            position: fixed;
            top: 0;
            bottom: 0;
            height: 100%;
            left: 0;
            width: 70px;
            overflow: hidden;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 1002;
        }
        .main-menu:hover {
            width: 280px;
            box-shadow: 2px 0 25px rgba(255, 0, 0, 0.15);
        }
        .main-menu ul {
            margin: 7px 0;
            padding: 0;
            list-style: none;
        }
        .main-menu li {
            position: relative;
            display: block;
            width: 250px;
        }
        .main-menu li a {
            position: relative;
            width: 100%;
            display: table;
            color: #c5c5c5;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Strait', sans-serif;
            border-top: 1px solid rgba(78, 78, 78, 0.2);
            padding: 10px 0;
            height: 55px;
            overflow: hidden;
        }
        .main-menu .nav-icon {
            position: relative;
            display: table-cell;
            width: 70px;
            height: 55px;
            text-align: center;
            vertical-align: middle;
            font-size: 26px;
            padding: 12px 0;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main-menu .nav-text {
            position: relative;
            display: table-cell;
            vertical-align: middle;
            width: 190px;
            font-family: 'Titillium Web', sans-serif;
            font-size: 16px;
            padding-left: 15px;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main-menu:hover .nav-text {
            opacity: 1;
            transform: translateX(0);
        }
        .main-menu li:hover > a {
            color: #ffffff;
            background: linear-gradient(45deg, #323232 0%, #2b2b2b 100%);
            transform: translateX(8px);
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
        }
        .main-menu li:hover .nav-icon {
            transform: scale(1.15);
            text-shadow: 0 0 10px rgba(175, 175, 175, 0.5);
        }
        .main-menu li a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: #ff0000;
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main-menu li:hover a::before {
            transform: scaleY(1);
        }
        .logo-container {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
        }
        .logo-container img {
            max-width: 100%;
            max-height: 120px;
        }
        .main-menu li a.active {
            background: linear-gradient(45deg, #373737 0%, #292929 100%);
            color: #ffffff;
            position: relative;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .main-menu li a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: #ff0303;
            transform: scaleY(1);
        }
        .main-menu li a.active .nav-icon {
            transform: scale(1.15);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        .main-menu li a.nav-login {
            background: #2f2f2f;
            color: #d6d6d6;
        }
        .main-menu li a.nav-login .nav-icon {
            color: #d6d6d6;
        }
        .main-menu li a.nav-login:hover {
            background: #3b3b3b;
            color: #ffffff;
        }
        /* NAVBAR CSS FIM */

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }
            
            .header p {
                font-size: 1.1rem;
            }
            
            .content-section {
                padding: 25px;
                margin-bottom: 30px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .tabs-container {
                flex-direction: column;
                gap: 15px;
            }

            .tab-button {
                width: 100%;
            }
            
            .container {
                margin-left: 0 !important;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Animação de fundo -->
    <div class="background-animation">
        <div class="shark-fin" style="top: 10%; animation-delay: 0s;"></div>
        <div class="shark-fin" style="top: 30%; animation-delay: 2s;"></div>
        <div class="shark-fin" style="top: 50%; animation-delay: 4s;"></div>
        <div class="shark-fin" style="top: 70%; animation-delay: 6s;"></div>
    </div>

    <!-- ===== NAVBAR HTML INÍCIO ===== -->
    <nav class="main-menu">
        <div class="logo-container">
            <img src="../views/midia/Logos/logoshark.png" alt="Logo" />
        </div>
        <ul>
            <li>
                <a href="../views/homesena.html">
                    <i class="fa fa-home nav-icon"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a href="../views/sobresena.html">
                    <i class="fa fa-info-circle nav-icon"></i>
                    <span class="nav-text">Sobre</span>
                </a>
            </li>
            <li>
                <a href="../views/gerador.html">
                    <i class="fa fa-cogs nav-icon"></i>
                    <span class="nav-text">Gerador</span>
                </a>
            </li>
            <li>
                <a href="../views/bibliotecasena.html">
                    <i class="fa fa-book nav-icon"></i>
                    <span class="nav-text">Biblioteca</span>
                </a>
            </li>
            <li>
                <a href="../views/meustreinossena.html">
                    <i class="fa fa-dumbbell nav-icon"></i>
                    <span class="nav-text">Meus Treinos</span>
                </a>
            </li>
            <li>
                <a href="../views/calculoimc.html">
                    <i class="fa fa-calculator nav-icon"></i>
                    <span class="nav-text">Calculadora IMC</span>
                </a>
            </li>
            <li>
                <a href="../views/calculocalorias.html">
                    <i class="fa fa-fire nav-icon"></i>
                    <span class="nav-text">Calculadora Kalorias</span>
                </a>
            </li>
            <li>
                <a href="../views/semlogin.html" class="nav-login">
                    <i class="fa fa-user nav-icon"></i>
                    <span class="nav-text">Entrar</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- ===== NAVBAR HTML FIM ===== -->

    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Políticas e Termos de Uso</h1>
            <p>Conheça nossas políticas de privacidade e termos de uso para garantir sua segurança e transparência.</p>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <button class="tab-button active" onclick="switchTab('privacy')">
                <i class="fas fa-shield-alt"></i> Política de Privacidade
            </button>
            <button class="tab-button" onclick="switchTab('terms')">
                <i class="fas fa-file-contract"></i> Termos de Uso
            </button>
        </div>

        <!-- Política de Privacidade -->
        <div class="content-section active" id="privacy-section">
            <h2 class="section-title">
                <i class="fas fa-shield-alt"></i>
                Política de Privacidade
            </h2>
            <div class="section-content">
                <div class="highlight-box">
                    <strong>Compromisso com sua Privacidade</strong>
                    Sua privacidade é nossa prioridade. Esta política descreve como coletamos, usamos e protegemos suas informações pessoais.
                </div>

                <h3>1. Informações que Coletamos</h3>
                <p>Coletamos diferentes tipos de informações para fornecer e melhorar nossos serviços:</p>
                <ul>
                    <li><strong>Informações de Cadastro:</strong> Nome, e-mail, telefone e dados de perfil</li>
                    <li><strong>Dados de Treino:</strong> Histórico de exercícios, metas, progressos e medidas corporais</li>
                    <li><strong>Informações de Uso:</strong> Páginas visitadas, tempo de sessão e interações na plataforma</li>
                    <li><strong>Dados Técnicos:</strong> Endereço IP, tipo de navegador, dispositivo e sistema operacional</li>
                </ul>

                <h3>2. Como Usamos suas Informações</h3>
                <p>Utilizamos suas informações para:</p>
                <ul>
                    <li>Fornecer, operar e manter nossos serviços</li>
                    <li>Personalizar sua experiência e gerar planos de treino adequados</li>
                    <li>Melhorar, aprimorar e expandir nossos recursos</li>
                    <li>Comunicar atualizações, novidades e ofertas relevantes</li>
                    <li>Processar suas solicitações e fornecer suporte ao cliente</li>
                    <li>Detectar, prevenir e resolver problemas técnicos</li>
                </ul>

                <h3>3. Compartilhamento de Dados</h3>
                <p>Não vendemos suas informações pessoais. Compartilhamos dados apenas:</p>
                <ul>
                    <li>Com seu consentimento explícito</li>
                    <li>Com prestadores de serviços necessários à operação da plataforma</li>
                    <li>Para cumprir obrigações legais e regulatórias</li>
                    <li>Para proteger nossos direitos, propriedade ou segurança</li>
                </ul>

                <h3>4. Segurança dos Dados</h3>
                <p>Implementamos medidas de segurança robustas para proteger suas informações:</p>
                <ul>
                    <li>Criptografia de dados sensíveis em trânsito e em repouso</li>
                    <li>Controles de acesso rigorosos e autenticação multifator</li>
                    <li>Monitoramento contínuo de ameaças e vulnerabilidades</li>
                    <li>Backups regulares e planos de recuperação de desastres</li>
                </ul>

                <div class="highlight-box">
                    <strong>Seus Direitos</strong>
                    Você tem direito a acessar, corrigir, excluir ou exportar suas informações pessoais a qualquer momento. Entre em contato conosco para exercer esses direitos.
                </div>

                <h3>5. Cookies e Tecnologias Semelhantes</h3>
                <p>Utilizamos cookies para melhorar sua experiência. Você pode gerenciar preferências de cookies nas configurações do seu navegador.</p>

                <h3>6. Retenção de Dados</h3>
                <p>Mantemos suas informações pelo tempo necessário para fornecer nossos serviços e cumprir obrigações legais. Você pode solicitar a exclusão de seus dados a qualquer momento.</p>

                <h3>7. Alterações nesta Política</h3>
                <p>Podemos atualizar esta política periodicamente. Notificaremos sobre mudanças significativas por e-mail ou através da plataforma.</p>

                <div class="last-update">
                     <i class="fas fa-calendar-alt"></i> Última atualização: Novembro de 2025 - Direitos Reservados SHARKNADO 
                </div>
            </div>
        </div>

        <!-- Termos de Uso -->
        <div class="content-section" id="terms-section">
            <h2 class="section-title">
                <i class="fas fa-file-contract"></i>
                Termos de Uso
            </h2>
            <div class="section-content">
                <div class="highlight-box">
                    <strong>Bem-vindo à nossa plataforma</strong>
                    Ao utilizar nossos serviços, você concorda com estes termos. Leia atentamente antes de continuar.
                </div>

                <h3>1. Aceitação dos Termos</h3>
                <p>Ao acessar e usar nossa plataforma, você aceita estar vinculado a estes Termos de Uso e todas as leis e regulamentos aplicáveis. Se você não concordar com algum destes termos, está proibido de usar ou acessar este site.</p>

                <h3>2. Licença de Uso</h3>
                <p>Concedemos uma licença limitada, não exclusiva e intransferível para:</p>
                <ul>
                    <li>Acessar e usar a plataforma para fins pessoais e não comerciais</li>
                    <li>Visualizar e imprimir conteúdo para uso pessoal</li>
                    <li>Criar e gerenciar seu perfil e dados de treino</li>
                </ul>

                <h3>3. Registro e Conta</h3>
                <p>Para utilizar determinados recursos, você deve:</p>
                <ul>
                    <li>Fornecer informações precisas e atualizadas</li>
                    <li>Manter a confidencialidade de suas credenciais</li>
                    <li>Notificar-nos imediatamente sobre qualquer uso não autorizado</li>
                    <li>Ser responsável por todas as atividades em sua conta</li>
                </ul>

                <h3>4. Uso Aceitável</h3>
                <p>Você concorda em não:</p>
                <ul>
                    <li>Usar a plataforma para fins ilegais ou não autorizados</li>
                    <li>Tentar obter acesso não autorizado a sistemas ou dados</li>
                    <li>Interferir ou interromper o funcionamento da plataforma</li>
                    <li>Copiar, modificar ou distribuir conteúdo sem autorização</li>
                    <li>Transmitir vírus, malware ou código malicioso</li>
                    <li>Assediar, ameaçar ou difamar outros usuários</li>
                </ul>

                <div class="highlight-box">
                    <strong>Aviso Médico Importante</strong>
                    Nossos serviços não substituem orientação médica profissional. Consulte um médico antes de iniciar qualquer programa de exercícios, especialmente se tiver condições de saúde preexistentes.
                </div>

                <h3>5. Propriedade Intelectual</h3>
                <p>Todo o conteúdo da plataforma, incluindo textos, gráficos, logos, imagens, vídeos e software, é propriedade nossa ou de nossos licenciadores e está protegido por leis de direitos autorais e propriedade intelectual.</p>

                <h3>6. Isenção de Responsabilidade</h3>
                <p>A plataforma é fornecida "como está" sem garantias de qualquer tipo. Não garantimos:</p>
                <ul>
                    <li>Que o serviço será ininterrupto ou livre de erros</li>
                    <li>Resultados específicos de treino ou condicionamento físico</li>
                    <li>Precisão completa de cálculos e recomendações</li>
                    <li>Compatibilidade com todos os dispositivos e navegadores</li>
                </ul>

                <h3>7. Limitação de Responsabilidade</h3>
                <p>Não seremos responsáveis por quaisquer danos diretos, indiretos, incidentais, consequenciais ou punitivos decorrentes do uso ou impossibilidade de uso da plataforma.</p>

                <h3>8. Modificações do Serviço</h3>
                <p>Reservamos o direito de:</p>
                <ul>
                    <li>Modificar ou descontinuar recursos a qualquer momento</li>
                    <li>Alterar preços e planos de assinatura com aviso prévio</li>
                    <li>Suspender ou encerrar contas que violem estes termos</li>
                    <li>Atualizar estes Termos de Uso periodicamente</li>
                </ul>

                <h3>9. Rescisão</h3>
                <p>Podemos encerrar ou suspender seu acesso imediatamente, sem aviso prévio, por qualquer motivo, incluindo violação destes Termos de Uso.</p>

                <h3>10. Lei Aplicável</h3>
                <p>Estes termos são regidos pelas leis brasileiras. Quaisquer disputas serão resolvidas nos tribunais competentes do Brasil.</p>

                <h3>11. Contato</h3>
                <p>Para dúvidas sobre estes Termos de Uso, entre em contato conosco através dos canais oficiais de suporte.</p>

                <div class="last-update">
                     <i class="fas fa-calendar-alt"></i> Última atualização: Novembro de 2025 - Direitos Reservados SHARKNADO 
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Remover classe active de todos os botões e seções
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            // Adicionar classe active ao botão e seção selecionados
            if (tab === 'privacy') {
                document.querySelectorAll('.tab-button')[0].classList.add('active');
                document.getElementById('privacy-section').classList.add('active');
            } else {
                document.querySelectorAll('.tab-button')[1].classList.add('active');
                document.getElementById('terms-section').classList.add('active');
            }

            // Scroll suave para o topo do conteúdo
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Animação de entrada dos elementos
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observar seções para animação
        document.querySelectorAll('.content-section').forEach(section => {
            observer.observe(section);
        });

        // ===== NAVBAR JS INÍCIO =====
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.main-menu li a').forEach(link => {
                link.addEventListener('click', function () {
                    document.querySelectorAll('.main-menu li a').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
        // ===== NAVBAR JS FIM =====
    </script>
</body>
</html>