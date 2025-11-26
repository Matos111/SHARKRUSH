<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Exercícios - FitTracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
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

        .fitness-icon {
            position: absolute;
            color: #aeaeae;
            animation: float 6s ease-in-out infinite;
            font-size: 24px;
        }

        .fitness-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .fitness-icon:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .fitness-icon:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .fitness-icon:nth-child(4) {
            top: 30%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
                opacity: 0.6;
            }
        }

        .header {
            text-align: center;
            padding: 40px 20px 20px;
            animation: fadeInDown 1s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            background: #ff0000ff;
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            text-shadow: 0 0 20px rgba(138, 138, 138, 0.3);
            margin-bottom: 10px;
        }

        .header p {
            color: #adadad;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
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

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .muscle-group {
            margin-bottom: 50px;
            animation: fadeInUp 0.8s ease-out both;
        }

        .muscle-group:nth-child(1) { animation-delay: 0.1s; }
        .muscle-group:nth-child(2) { animation-delay: 0.2s; }
        .muscle-group:nth-child(3) { animation-delay: 0.3s; }
        .muscle-group:nth-child(4) { animation-delay: 0.4s; }
        .muscle-group:nth-child(5) { animation-delay: 0.5s; }

        .muscle-title {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 10px;
            border-left: 4px solid #ff0000; /* trocado para vermelho */
        }

        .muscle-title i {
            font-size: 2.2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        .exercises-carousel {
            position: relative;
            overflow: visible;
            margin-bottom: 30px;
            padding: 0 30px;
        }

        .exercises-container {
            display: flex;
            gap: 20px;
            transition: transform 0.3s ease;
            padding: 10px 0;
        }

        .exercise-card {
            min-width: 280px;
            height: 380px;
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #2a2a2a;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .exercise-card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.3);
            border-color: #ff3333;
        }

        .exercise-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #ff0000, #cc0000);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .exercise-image::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                rgba(255, 255, 255, 0.1) 0px,
                rgba(255, 255, 255, 0.1) 2px,
                transparent 2px,
                transparent 10px
            );
            opacity: 0.3;
            z-index: 1;
        }

        .exercise-placeholder {
            font-size: 4rem;
            color: white;
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            z-index: 2;
            position: relative;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            color: #ff0000;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .play-button:hover {
            background: white;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .exercise-info {
            padding: 20px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .exercise-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .exercise-details {
            color: #cccccc;
            font-size: 0.9rem;
            line-height: 1.4;
            flex-grow: 1;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .difficulty {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
            border: 1px solid #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
            border: 1px solid #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
            border: 1px solid #ff0000;
        }

        .exercise-duration {
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .carousel-nav:hover {
            background: #a30505;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav.prev {
            left: 0;
        }

        .carousel-nav.next {
            right: 0;
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.8;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
        }

        .exercise-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.95);
            border: 2px solid #ff0000;
            border-radius: 20px;
            max-width: 600px;
            width: 90%;
            max-height: 90%;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #ff0000;
            font-weight: bold;
        }

        .close-modal {
            background: none;
            border: none;
            color: #ff0000;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: rgba(255, 0, 0, 0.2);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-gif {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal-description {
            color: #cccccc;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal-instructions {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 10px;
            padding: 15px;
        }

        .modal-instructions h4 {
            color: #ff0000;
            margin-bottom: 10px;
        }

        .modal-instructions ul {
            list-style: none;
            padding: 0;
        }

        .modal-instructions li {
            color: #cccccc;
            margin-bottom: 8px;
            position: relative;
            padding-left: 20px;
        }

        .modal-instructions li::before {
            content: '▸';
            color: #ff0000;
            font-weight: bold;
            position: absolute;
            left: 0;
        }

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

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }

            .muscle-title {
                font-size: 1.6rem;
            }

            .exercise-card {
                min-width: 250px;
                height: 350px;
            }

            .exercises-container {
                gap: 15px;
            }

            .carousel-nav {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .modal-content {
                width: 95%;
                margin: 20px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 15px;
            }

            .exercise-card {
                min-width: 220px;
                height: 320px;
            }

            .exercise-image {
                height: 160px;
            }

            .exercise-info {
                padding: 15px;
                height: 160px;
            }

            .exercise-name {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="main-menu">
        <div class="logo-container">
            <a href="<?= BASE_URL ?>/dashboard" title="Dashboard">
                <img src="/SHARKRUSH/VIEWS/MIDIA/Logos/logoshark.png"alt="Logo"/>
            </a>
        </div>
        <ul>
            <li>
            <a href="<?= BASE_URL ?>/homepage" >
                <i class="fa fa-home nav-icon"></i>
                <span class="nav-text">Home</span>
            </a>
            </li>
        
            <li>
            <a href="<?= BASE_URL ?>/biblioteca" class="active">
                <i class="fa fa-book nav-icon"></i>
                <span class="nav-text">Biblioteca</span>
            </a>
            </li>
            <li>
            <a href="<?= BASE_URL ?>/meus-treinos">
                <i class="fa fa-dumbbell nav-icon"></i>
                <span class="nav-text">Meus Treinos</span>
            </a>
            </li>
            <li>
            <a href="<?= BASE_URL ?>/calculadora-imc">
                <i class="fa fa-calculator nav-icon"></i>
                <span class="nav-text">Calculadora IMC</span>
            </a>
            </li>
            <li>
            <a href="<?= BASE_URL ?>/calculadora-calorias">
                <i class="fa fa-fire nav-icon"></i>
                <span class="nav-text">Calculadora Calorias</span>
            </a>
            </li>
            <li>
            <a href="<?= BASE_URL ?>/sobre">
                <i class="fa fa-info-circle nav-icon"></i>
                <span class="nav-text">Sobre</span>
            </a>
            </li>

            <li>
            <a href="<?= BASE_URL ?>/perfil" class="nav-login">
                <i class="fa fa-user nav-icon"></i>
                <span class="nav-text">Perfil</span>
            </a>
            </li>
        </ul>
    </nav>

    <div class="background-animation">
        <i class="fas fa-dumbbell fitness-icon"></i>
        <i class="fas fa-running fitness-icon"></i>
        <i class="fas fa-heartbeat fitness-icon"></i>
        <i class="fas fa-bicycle fitness-icon"></i>
    </div>

    <header class="header">
        <h1><i class="fas fa-book-open"></i> Biblioteca de Exercícios</h1>
        <p>Descubra centenas de exercícios organizados por grupo muscular com demonstrações em GIF</p>
    </header>

    <div class="container" id="exercises-container">
        <!-- Os exercícios serão inseridos aqui pelo JavaScript -->
    </div>

    <div class="exercise-modal" id="exerciseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Nome do Exercício</h3>
                <button class="close-modal" onclick="closeExerciseModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img class="modal-gif" id="modalGif" src="" alt="Demonstração do exercício">
                <p class="modal-description" id="modalDescription">Descrição do exercício...</p>
                <div class="modal-instructions">
                    <h4><i class="fas fa-list"></i> Como executar:</h4>
                    <ul id="modalInstructions"></ul>
                </div>
            </div>
        </div>
    </div>

    <a href="<?= BASE_URL ?>/gerador-treino" style="position:fixed;top:30px;right:30px;z-index:1200;background:#232323;color:#fff;border:none;border-radius:50%;width:54px;height:54px;box-shadow:0 2px 12px #0007;display:flex;align-items:center;justify-content:center;font-size:1.6rem;cursor:pointer;transition:background 0.2s;text-decoration:none;">
        <i class="fas fa-cogs"></i>
    </a>

    <script>
        // Base path para as imagens
        const BASE_IMG_PATH = '/SHARKRUSH/VIEWS/MIDIA/img-gif_biblioteca/';

        // Banco de dados de exercícios COMPLETO
        const exercisesDatabase = {
            chest: {
                title: 'Peito e Ombros',
                icon: 'fa-dumbbell',
                exercises: [
                    {
                        name: 'Supino Reto',
                        details: 'Força e volume no peitoral',
                        description: 'Exercício fundamental para desenvolvimento do peitoral maior',
                        difficulty: 'beginner',
                        duration: '3-4 séries',
                        image: 'supino-reto-img.png',
                        gif: 'supino-reto-gif.gif',
                        instructions: [
                            'Deite no banco com os pés apoiados no chão',
                            'Segure a barra com pegada um pouco mais larga que os ombros',
                            'Desça a barra controladamente até tocar o peito',
                            'Empurre a barra para cima mantendo os cotovelos alinhados'
                        ]
                    },
                    {
                        name: 'Desenvolvimento Ombros',
                        details: 'Deltoides fortes e definidos',
                        description: 'Exercício completo para deltoides',
                        difficulty: 'intermediate',
                        duration: '3 séries',
                        image: 'desenvolvimento-ombros.jpg',
                        gif: 'desenvolvimento-ombros.gif',
                        instructions: [
                            'Sente-se com as costas retas e apoiadas',
                            'Segure os halteres na altura dos ombros',
                            'Empurre os halteres para cima sem travar os cotovelos',
                            'Desça controladamente até a posição inicial'
                        ]
                    },
                    {
                        name: 'Flexão de Braço',
                        details: 'Peito, tríceps e core',
                        description: 'Exercício funcional para peito e core',
                        difficulty: 'beginner',
                        duration: '2-3 séries',
                        image: 'flexão-img.png',
                        gif: 'flexão-gif.gif',
                        instructions: [
                            'Posicione-se em prancha com mãos na largura dos ombros',
                            'Mantenha o corpo alinhado da cabeça aos pés',
                            'Desça o peito até quase tocar o chão',
                            'Empurre para cima mantendo o core ativado'
                        ]
                    },
                    {
                        name: 'Crucifixo com Halteres',
                        details: 'Alongamento e definição do peitoral',
                        description: 'Trabalha a porção medial e externa do peitoral',
                        difficulty: 'beginner',
                        duration: '3 séries',
                        image: 'crucifixo-img.png',
                        gif: 'crucifixo-gif.gif',
                        instructions: [
                            'Deite no banco segurando halteres com braços semi-flexionados',
                            'Desça os halteres abrindo os braços lateralmente',
                            'Mantenha leve flexão nos cotovelos',
                            'Suba trazendo os braços de volta ao centro'
                        ]
                    },
                    {
                        name: 'Elevação Lateral',
                        details: 'Foco no deltoide lateral',
                        description: 'Isolamento dos ombros para largura',
                        difficulty: 'beginner',
                        duration: '3x12-15',
                        image: 'elevacao-lateral.jpg',
                        gif: 'elevacao-lateral.gif',
                        instructions: [
                            'Fique em pé segurando halteres ao lado do corpo',
                            'Levante os braços até a altura dos ombros',
                            'Mantenha leve inclinação do tronco',
                            'Desça controladamente mantendo tensão'
                        ]
                    }
                ]
            },

            arms: {
                title: 'Braços',
                icon: 'fa-dumbbell',
                exercises: [
                    {
                        name: 'Rosca Direta',
                        details: 'Bíceps mais fortes e definidos',
                        description: 'Exercício básico para bíceps',
                        difficulty: 'beginner',
                        duration: '3 séries',
                        image: 'rosca-direta.jpg',
                        gif: 'rosca-direta.gif',
                        instructions: [
                            'Fique em pé com a barra na pegada supinada',
                            'Mantenha os cotovelos fixos ao lado do corpo',
                            'Flexione os braços levando a barra ao peito',
                            'Desça controladamente estendendo completamente'
                        ]
                    },
                    {
                        name: 'Tríceps Testa',
                        details: 'Tríceps definidos e fortes',
                        description: 'Isolamento para tríceps',
                        difficulty: 'intermediate',
                        duration: '3-4 séries',
                        image: 'triceps-testa.png',
                        gif: 'triceps-testa.gif',
                        instructions: [
                            'Deite no banco segurando a barra ou halteres',
                            'Estenda os braços perpendiculares ao corpo',
                            'Flexione apenas os cotovelos descendo o peso em direção à testa',
                            'Estenda os braços retornando à posição inicial'
                        ]
                    },
                    {
                        name: 'Tríceps Corda',
                        details: 'Isolamento de tríceps',
                        description: 'Foco na cabeça lateral do tríceps',
                        difficulty: 'beginner',
                        duration: '3x12-15',
                        image: 'triceps-corda.png',
                        gif: 'triceps-corda.gif',
                        instructions: [
                            'Fique em pé no cabo segurando a corda',
                            'Mantenha os cotovelos próximos ao corpo',
                            'Empurre a corda para baixo separando as pontas',
                            'Retorne controlando o movimento'
                        ]
                    },
                    {
                        name: 'Rosca Martelo',
                        details: 'Bíceps e antebraços',
                        description: 'Trabalha braquiorradial e braquial',
                        difficulty: 'beginner',
                        duration: '3 séries',
                        image: 'rosca-martelo.png',
                        gif: 'rosca-martelo.gif',
                        instructions: [
                            'Segure os halteres com pegada neutra',
                            'Flexione os cotovelos mantendo-os fixos',
                            'Suba até a contração máxima',
                            'Desça devagar estendendo completamente'
                        ]
                    },
                    {
                        name: 'Rosca Scott',
                        details: 'Isolamento máximo de bíceps',
                        description: 'Execução guiada com mais estabilidade',
                        difficulty: 'intermediate',
                        duration: '3 séries',
                        image: 'rosca-scott.jpg',
                        gif: 'rosca-scott.gif',
                        instructions: [
                            'Sente-se no banco Scott',
                            'Apoie os braços totalmente na almofada',
                            'Flexione os cotovelos levantando a barra',
                            'Desça controlando toda a amplitude'
                        ]
                    }
                ]
            },

            abs: {
                title: 'Abdômen',
                icon: 'fa-fire',
                exercises: [
                    {
                        name: 'Prancha',
                        details: 'Core forte e estável',
                        description: 'Exercício isométrico para core',
                        difficulty: 'beginner',
                        duration: '3x30-60s',
                        image: 'prancha.jpg',
                        gif: 'prancha.gif',
                        instructions: [
                            'Posicione-se em posição de flexão apoiado nos antebraços',
                            'Mantenha o corpo alinhado da cabeça aos pés',
                            'Contraia o abdômen e glúteos',
                            'Respire normalmente mantendo a posição'
                        ]
                    },
                    {
                        name: 'Abdominal Supra',
                        details: 'Foco no reto abdominal',
                        description: 'Clássico para reto abdominal',
                        difficulty: 'beginner',
                        duration: '3x15-20',
                        image: 'abdominal-supra.jpg',
                        gif: 'abdominal-supra.gif',
                        instructions: [
                            'Deite com joelhos flexionados e pés apoiados',
                            'Coloque as mãos atrás da cabeça ou cruzadas no peito',
                            'Contraia o abdômen elevando apenas o tronco',
                            'Desça controladamente sem relaxar completamente'
                        ]
                    },
                    {
                        name: 'Elevação de Pernas',
                        details: 'Foco em abdômen inferior',
                        description: 'Movimento que ativa o reto abdominal inferior',
                        difficulty: 'intermediate',
                        duration: '3x12-15',
                        image: 'elevacao-pernas.jpg',
                        gif: 'elevacao-pernas.gif',
                        instructions: [
                            'Deite-se com as pernas estendidas',
                            'Eleve as pernas mantendo-as unidas',
                            'Suba até formar um ângulo de 90 graus',
                            'Desça devagar sem tocar os pés no chão'
                        ]
                    },
                    {
                        name: 'Bicicleta Abdominal',
                        details: 'Oblíquos fortes e definidos',
                        description: 'Trabalha abdômen completo e rotação do core',
                        difficulty: 'beginner',
                        duration: '3x20 alternado',
                        image: 'bicicleta.jpg',
                        gif: 'bicicleta.gif',
                        instructions: [
                            'Deite-se com os joelhos flexionados',
                            'Gire o tronco aproximando cotovelo e joelho oposto',
                            'Alternar os lados continuamente',
                            'Mantenha o abdômen contraído'
                        ]
                    },
                    {
                        name: 'Prancha Lateral',
                        details: 'Foco nos oblíquos',
                        description: 'Isometria para estabilidade lateral',
                        difficulty: 'beginner',
                        duration: '3x20-30s cada lado',
                        image: 'prancha-lateral.jpg',
                        gif: 'prancha-lateral.gif',
                        instructions: [
                            'Apoie-se em um antebraço lateralmente',
                            'Eleve o quadril alinhando o corpo',
                            'Mantenha abdômen contraído',
                            'Segure a posição respirando normalmente'
                        ]
                    }
                ]
            },

            legs: {
                title: 'Pernas',
                icon: 'fa-running',
                exercises: [
                    {
                        name: 'Agachamento',
                        details: 'Pernas e glúteos em foco',
                        description: 'Rei dos exercícios para pernas',
                        difficulty: 'beginner',
                        duration: '3-4 séries',
                        image: 'Agachamento.png',
                        gif: 'Agachamento.gif',
                        instructions: [
                            'Fique em pé com pés na largura dos ombros',
                            'Desça flexionando quadris e joelhos simultaneamente',
                            'Desça até as coxas ficarem paralelas ao chão',
                            'Suba empurrando pelos calcanhares'
                        ]
                    },
                    {
                        name: 'Levantamento Terra',
                        details: 'Posterior de coxa e glúteos',
                        description: 'Composto para posterior',
                        difficulty: 'intermediate',
                        duration: '3 séries',
                        image: 'Levantamento-terra.png',
                        gif: 'Levantamento-terra.gif',
                        instructions: [
                            'Posicione a barra próxima às canelas',
                            'Agarre a barra com pegada mista ou dupla',
                            'Levante empurrando o chão com os pés',
                            'Mantenha as costas retas durante todo movimento'
                        ]
                    },
                    {
                        name: 'Afundo',
                        details: 'Equilíbrio e força nas pernas',
                        description: 'Unilateral para equilíbrio',
                        difficulty: 'beginner',
                        duration: '3x12 cada',
                        image: 'Afundo.png',
                        gif: 'Afundo.gif',
                        instructions: [
                            'Dê um passo largo para frente',
                            'Desça flexionando ambos os joelhos em 90 graus',
                            'O joelho da frente deve ficar sobre o tornozelo',
                            'Retorne à posição inicial empurrando com a perna da frente'
                        ]
                    },
                    {
                        name: 'Cadeira Extensora',
                        details: 'Isolamento de quadríceps',
                        description: 'Trabalha quadríceps com foco em definição',
                        difficulty: 'beginner',
                        duration: '3x12-15',
                        image: 'Cadeira-extensora.png',
                        gif: 'Cadeira-extensora.gif',
                        instructions: [
                            'Ajuste o banco para apoiar a parte inferior da canela',
                            'Estenda os joelhos levantando o peso',
                            'Contraia o quadríceps no topo',
                            'Desça controladamente'
                        ]
                    },
                    {
                        name: 'Mesa Flexora',
                        details: 'Isolamento de posterior de coxa',
                        description: 'Foco na contração dos posteriores',
                        difficulty: 'beginner',
                        duration: '3x12-15',
                        image: 'Mesa-flexora.jpg',
                        gif: 'Mesa-flexora.gif',
                        instructions: [
                            'Deite de bruços na máquina',
                            'Flexione os joelhos puxando o peso',
                            'Mantenha o quadril apoiado',
                            'Desça devagar mantendo controle'
                        ]
                    }
                ]
            }
        };

        // Controle de carrossel
        const carouselPositions = {};

        // Função para criar card de exercício
        function createExerciseCard(exercise) {
            const imagePath = BASE_IMG_PATH + exercise.image;
            const gifPath = BASE_IMG_PATH + exercise.gif;
            
            return `
                <div class="exercise-card" onclick='openExerciseModal(${JSON.stringify(exercise)})'>
                    <div class="exercise-image">
                        <img src="${imagePath}" alt="${exercise.name}" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <i class="fas fa-dumbbell exercise-placeholder" style="display:none;"></i>
                        <button class="play-button" onclick="event.stopPropagation(); openExerciseModal(${JSON.stringify(exercise).replace(/"/g, '&quot;')})">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                    <div class="exercise-info">
                        <h3 class="exercise-name">${exercise.name}</h3>
                        <p class="exercise-details">${exercise.details}</p>
                        <div class="exercise-meta">
                            <span class="difficulty ${exercise.difficulty}">
                                ${exercise.difficulty === 'beginner' ? 'Iniciante' : 
                                  exercise.difficulty === 'intermediate' ? 'Intermediário' : 'Avançado'}
                            </span>
                            <span class="exercise-duration">${exercise.duration}</span>
                        </div>
                    </div>
                </div>
            `;
        }

        // Função para criar grupo muscular
        function createMuscleGroup(groupKey, groupData) {
            const cardsHTML = groupData.exercises.map(ex => createExerciseCard(ex)).join('');
            
            return `
                <section class="muscle-group">
                    <h2 class="muscle-title">
                        <i class="fas ${groupData.icon}"></i>
                        ${groupData.title}
                    </h2>
                    <div class="exercises-carousel">
                        <button class="carousel-nav prev" onclick="slideCarousel('${groupKey}', -1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="exercises-container" id="${groupKey}-container">
                            ${cardsHTML}
                        </div>
                        <button class="carousel-nav next" onclick="slideCarousel('${groupKey}', 1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </section>
            `;
        }

        // Renderizar todos os exercícios
        function renderExercises() {
            const container = document.getElementById('exercises-container');
            let html = '';
            
            for (const [key, value] of Object.entries(exercisesDatabase)) {
                html += createMuscleGroup(key, value);
                carouselPositions[key] = 0;
            }
            
            container.innerHTML = html;
        }

        // Controle de carrossel
        function slideCarousel(group, direction) {
            const container = document.getElementById(group + '-container');
            const cardWidth = 300;
            const maxScroll = Math.max(0, (container.children.length - 1) * cardWidth);

            carouselPositions[group] = carouselPositions[group] || 0;
            carouselPositions[group] += direction * cardWidth;

            if (carouselPositions[group] < 0) {
                carouselPositions[group] = 0;
            } else if (carouselPositions[group] > maxScroll) {
                carouselPositions[group] = maxScroll;
            }

            container.style.transform = `translateX(-${carouselPositions[group]}px)`;
        }

        // Abrir modal de exercício
        function openExerciseModal(exercise) {
            const modal = document.getElementById('exerciseModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalGif = document.getElementById('modalGif');
            const modalInstructions = document.getElementById('modalInstructions');

            modalTitle.textContent = exercise.name;
            modalDescription.textContent = exercise.description;
            modalGif.src = BASE_IMG_PATH + exercise.gif;
            modalGif.alt = exercise.name;

            modalInstructions.innerHTML = exercise.instructions
                .map(instruction => `<li>${instruction}</li>`)
                .join('');

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        // Fechar modal
        function closeExerciseModal() {
            const modal = document.getElementById('exerciseModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Fechar modal ao clicar fora
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('exerciseModal');
            if (event.target === modal) {
                closeExerciseModal();
            }
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeExerciseModal();
            }
        });

        // Controle responsivo do carrossel
        function updateCarouselResponsive() {
            const isMobile = window.innerWidth <= 768;
            const cardWidth = isMobile ? 235 : 300;

            Object.keys(carouselPositions).forEach(group => {
                const container = document.getElementById(group + '-container');
                if (container) {
                    const maxScroll = Math.max(0, (container.children.length - 1) * cardWidth);
                    if (carouselPositions[group] > maxScroll) {
                        carouselPositions[group] = maxScroll;
                    }
                    container.style.transform = `translateX(-${carouselPositions[group]}px)`;
                }
            });
        }

        window.addEventListener('resize', updateCarouselResponsive);

        // Animação de background
        let ticking = false;
        function updateBackground() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.background-animation');
            if (parallax) {
                const speed = scrolled * 0.1;
                parallax.style.transform = `translateY(${speed}px)`;
            }
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateBackground);
                ticking = true;
            }
        });

        // Inicializar ao carregar a página
        document.addEventListener('DOMContentLoaded', function() {
            renderExercises();
            updateCarouselResponsive();
        });
    </script>
</body>
</html>