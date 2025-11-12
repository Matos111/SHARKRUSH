<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Inter font for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Exercícios - FitTracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root { --red: #ff0000; --bg: #0b0b0b; --muted: #777; --font: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
        html,body{font-family:var(--font);}
        /* overlay modal that blocks access */
        .access-overlay{
            position:fixed;inset:0;display:flex;align-items:center;justify-content:center;z-index:9999;
            background:rgba(0, 0, 0, 0.48);backdrop-filter:blur(6px);
        }
        .access-modal{width:min(560px,92%);background:linear-gradient(180deg,#1a1a1a 0%, #141414 100%);border-radius:16px;padding:28px;border:1px solid rgba(255,0,0,0.12);box-shadow:0 30px 80px rgba(0,0,0,0.7);text-align:center}
        .access-modal h2{margin:0 0 8px;color:var(--red);text-transform:uppercase;letter-spacing:1.5px;font-weight:800;font-size:18px}
        .access-modal p{color:#d6d6d6;margin-bottom:22px;font-size:15px}
        .access-actions{display:flex;gap:14px;justify-content:center;align-items:center}
        .btn{padding:12px 20px;border-radius:12px;border:none;cursor:pointer;font-weight:700;display:inline-flex;align-items:center;gap:10px;transition:all 180ms ease;font-family:var(--font);letter-spacing:0.2px}
        .btn i{font-size:16px}
        .btn-login{background:linear-gradient(180deg,var(--red),#cc0000);color:#fff;box-shadow:0 10px 30px rgba(255,0,0,0.2), inset 0 -3px 8px rgba(0,0,0,0.18)}
        .btn-login:hover{transform:translateY(-3px);box-shadow:0 18px 46px rgba(255,0,0,0.28)}
        .btn-login:active{transform:translateY(-1px);filter:brightness(0.98)}
        .btn-login:focus{outline:3px solid rgba(255,0,0,0.12);outline-offset:3px}
        .btn-back{background:linear-gradient(180deg,rgba(255,255,255,0.03),rgba(255,255,255,0.01));color:#fff;border:1px solid rgba(255,255,255,0.06);box-shadow:0 8px 20px rgba(0,0,0,0.45)}
        .btn-back:hover{transform:translateY(-2px);background:rgba(255,255,255,0.06)}
        .btn-back:focus{outline:3px solid rgba(255,255,255,0.06);outline-offset:3px}
        /* make sure underlying content is not interactable visually */
        .dimmed{filter:brightness(0.45) saturate(0.8) blur(1px);pointer-events:none;user-select:none}
        @media (max-width:560px){ .access-modal{padding:18px} .btn{flex:1} .access-actions{flex-direction:column;gap:10px} }
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

        /* Header */
        .header {
            text-align: center;
            padding: 40px 20px 20px;
            animation: fadeInDown 1s ease-out;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(45deg, #ffffff, #e1e1e1, #ffffff);
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

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Seção de grupo muscular */
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
            color: #fff; /* Alterado de #ff0000 para branco */
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            padding-left: 10px;
            border-left: 4px solid #868686;
        }

        .muscle-title i {
            font-size: 2.2rem;
            animation: pulse 2s ease-in-out infinite;
        }

        /* Carrossel de exercícios */
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

        /* Cards de exercícios */
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
        }

        .exercise-gif {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }

        .exercise-gif.playing {
            display: block;
        }

        .exercise-placeholder {
            font-size: 4rem;
            color: white;
            text-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            z-index: 1;
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
            z-index: 2;
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

        /* Botões de navegação do carrossel */
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

        /* Modal para exercício */
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

        /* Responsividade */
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

        .add-to-workout-btn {
            margin: 8px auto 0 auto;
            width: 85%;
            padding: 6px 0;
            background: #232323;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 0.93rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 30px;
        }
        .add-to-workout-btn:hover:not(:disabled) {
            background: #ff3333;
            color: #fff;
            transform: scale(1.03);
            box-shadow: 0 4px 16px rgba(255,0,0,0.18);
        }
        .add-to-workout-btn:disabled,
        .add-to-workout-btn.added {
            background: #1e7e34 !important;
            color: #fff !important;
            cursor: default;
        }
        .add-to-workout-btn.added {
            background: #1e7e34 !important;
            color: #fff !important;
        }
        .sidebar-workout-actions {
            margin: 32px 0 0 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }
        .sidebar-workout-counter {
            background: linear-gradient(90deg, #ff0000 80%, #cc0000 100%);
            color: #fff;
            border-radius: 18px;
            padding: 18px 32px 18px 28px;
            font-size: 1.18rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 13px;
            box-shadow: 0 6px 24px rgba(255,0,0,0.13);
            letter-spacing: 0.5px;
            margin-bottom: 0;
            border: none;
            min-width: 230px;
            justify-content: center;
        }
        .sidebar-workout-counter .counter-icon {
            font-size: 1.6rem;
            margin-right: 2px;
        }
        .sidebar-workout-counter .count-number {
            background: #e53935;
            color: #fff;
            border-radius: 9px;
            padding: 2px 13px 2px 13px;
            font-size: 1.08em;
            font-weight: 700;
            margin: 0 7px;
            display: inline-block;
            min-width: 22px;
            text-align: center;
            box-shadow: 0 2px 8px #0002;
        }
        .sidebar-save-btn {
            width: 100%;
            padding: 17px 0 17px 0;
            background: #232323;
            color: #fff;
            font-size: 1.08rem;
            font-weight: 700;
            border: none;
            border-radius: 13px;
            cursor: pointer;
            letter-spacing: 1px;
            box-shadow: 0 2px 12px #0004;
            transition: background 0.18s, color 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 0;
        }
        .sidebar-save-btn:hover {
            background: #444;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Access modal (shown to guests) -->
    <div id="accessOverlay" class="access-overlay" style="display:none">
        <div class="access-modal">
            <h2>Logue para ter acesso!</h2>
            <p>Somente usuários cadastrados podem acessar a Biblioteca. <br> Faça login para continuar ou volte para a página inicial.</p>
            <div class="access-actions">
                <button class="btn btn-login" id="btnLogin"><i class="fa fa-sign-in-alt"></i> Login</button>
                <button class="btn btn-back" id="btnBack"><i class="fa fa-arrow-left"></i> Voltar</button>
            </div>
        </div>
    </div>
    <div class="page" id="pageContent">
    <nav class="main-menu">
        <div class="logo-container">
            <a href="../semcadastro/Clientes/clientes_form.php" title="Cadastro">
                <img src="../midia/Logos/logoshark.png"alt="Logo"/>
            </a>
        </div>
        <ul>
            <li>
            <a href="../semcadastro/semhomesena.php" class="active">
                <i class="fa fa-home nav-icon"></i>
                <span class="nav-text">Home</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/semsobresena.php">
                <i class="fa fa-info-circle nav-icon"></i>
                <span class="nav-text">Sobre</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/semgerador.php">
                <i class="fa fa-cogs nav-icon"></i>
                <span class="nav-text">Gerador</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/sembibliotecasena.php">
                <i class="fa fa-book nav-icon"></i>
                <span class="nav-text">Biblioteca</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/semmeustreinossena.php">
                <i class="fa fa-dumbbell nav-icon"></i>
                <span class="nav-text">Meus Treinos</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/semcalculoimc.php">
                <i class="fa fa-calculator nav-icon"></i>
                <span class="nav-text">Calculadora IMC</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/semcalculocalorias.php">
                <i class="fa fa-fire nav-icon"></i>
                <span class="nav-text">Calculadora Calorias</span>
            </a>
            </li>
            <li>
            <a href="../semcadastro/login.php" class="nav-login">
                <i class="fa fa-user nav-icon"></i>
                <span class="nav-text">Entrar</span>
            </a>
            </li>
        </ul>
    </nav>
    </div>
    <!-- Animação de fundo -->
    <div class="background-animation">
        <i class="fas fa-dumbbell fitness-icon"></i>
        <i class="fas fa-running fitness-icon"></i>
        <i class="fas fa-heartbeat fitness-icon"></i>
        <i class="fas fa-bicycle fitness-icon"></i>
    </div>

    <!-- Header -->
    <header class="header">
        <h1><i class="fas fa-book-open"></i> Biblioteca de Exercícios</h1>
        <p>Descubra centenas de exercícios organizados por grupo muscular com demonstrações em GIF</p>
    </header>

    <!-- Container principal -->
    <div class="container">
        <!-- Peito e Ombros -->
        <section class="muscle-group">
            <h2 class="muscle-title">
                <i class="fas fa-dumbbell"></i>
                Peito e Ombros
            </h2>
            <div class="exercises-carousel">
                <button class="carousel-nav prev" onclick="slideCarousel('chest', -1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="exercises-container" id="chest-container">
                    <div class="exercise-card" onclick="openExerciseModal('Supino Reto', 'Exercício fundamental para desenvolvimento do peitoral maior', 'beginner', '3-4 séries', 'https://example.com/supino-reto.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-hand-fist exercise-placeholder"></i>
                            <button class="play-button" type="button" onclick="event.stopPropagation(); openExerciseModal('Supino Reto', 'Exercício fundamental para desenvolvimento do peitoral maior', 'beginner', '3-4 séries', 'https://example.com/supino-reto.gif')"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Supino Reto</h3>
                            <p class="exercise-details">Força e volume no peitoral</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3-4 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="addToWorkout(this, event)">
                                <i class="fas fa-plus"></i> Adicionar
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Desenvolvimento Ombros', 'Exercício completo para deltoides', 'intermediate', '3 séries', 'https://example.com/desenvolvimento-ombros.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-hand-fist exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Desenvolvimento </h3>
                            <p class="exercise-details">Deltoides fortes e definidos</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Flexão de Braço', 'Exercício funcional para peito e core', 'beginner', '2-3 séries', 'https://example.com/flexao.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-hand-fist exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Flexão de Braço</h3>
                            <p class="exercise-details">Peito, tríceps e core</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">2-3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Elevação Lateral', 'Isolamento para deltoides medial', 'intermediate', '3-4 séries', 'https://example.com/elevacao-lateral.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-hand-fist exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Elevação Lateral</h3>
                            <p class="exercise-details">Ombros mais largos e definidos</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3-4 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Crucifixo Inclinado', 'Isolamento para peitoral superior', 'advanced', '3 séries', 'https://example.com/crucifixo.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-hand-fist exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Crucifixo Inclinado</h3>
                            <p class="exercise-details">Peitoral superior em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty advanced">Avançado</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next" onclick="slideCarousel('chest', 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <!-- Braços -->
        <section class="muscle-group">
            <h2 class="muscle-title">
                <i class="fas fa-arms"></i>
                Braços
            </h2>
            <div class="exercises-carousel">
                <button class="carousel-nav prev" onclick="slideCarousel('arms', -1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="exercises-container" id="arms-container">
                    <div class="exercise-card" onclick="openExerciseModal('Rosca Direta', 'Exercício básico para bíceps', 'beginner', '3 séries', 'https://example.com/rosca-direta.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-dumbbell exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Rosca Direta</h3>
                            <p class="exercise-details">Bíceps mais fortes e definidos</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Tríceps Testa', 'Isolamento para tríceps', 'intermediate', '3-4 séries', 'https://example.com/triceps-testa.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-dumbbell exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Tríceps Testa</h3>
                            <p class="exercise-details">Tríceps definidos e fortes</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3-4 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Rosca Martelo', 'Trabalha bíceps e antebraços', 'beginner', '3 séries', 'https://example.com/rosca-martelo.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-dumbbell exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Rosca Martelo</h3>
                            <p class="exercise-details">Bíceps e antebraços em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> ADICIONAR
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Mergulho Paralelas', 'Composto para tríceps', 'advanced', '3 séries', 'https://example.com/mergulho.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-dumbbell exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Mergulho Paralelas</h3>
                            <p class="exercise-details">Tríceps, peito e ombros</p>
                            <div class="exercise-meta">
                                <span class="difficulty advanced">Avançado</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> ADICIONAR
                            </button>
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next" onclick="slideCarousel('arms', 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <!-- Abdômen -->
        <section class="muscle-group">
            <h2 class="muscle-title">
                <i class="fas fa-fire"></i>
                Abdômen
            </h2>
            <div class="exercises-carousel">
                <button class="carousel-nav prev" onclick="slideCarousel('abs', -1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="exercises-container" id="abs-container">
                    <div class="exercise-card" onclick="openExerciseModal('Prancha', 'Exercício isométrico para core', 'beginner', '3x30-60s', 'https://example.com/prancha.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-stop exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Prancha</h3>
                            <p class="exercise-details">Core forte e estável</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3x30-60s</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Abdominal Supra', 'Clássico para reto abdominal', 'beginner', '3x15-20', 'https://example.com/abdominal.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-stop exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Abdominal Supra</h3>
                            <p class="exercise-details">Foco no reto abdominal</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3x15-20</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Elevação de Pernas', 'Trabalha abdômen inferior', 'intermediate', '3x12-15', 'https://example.com/elevacao-pernas.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-stop exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Elevação de Pernas</h3>
                            <p class="exercise-details">Abdômen inferior em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3x12-15</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Russian Twist', 'Rotação para oblíquos', 'intermediate', '3x20', 'https://example.com/russian-twist.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-stop exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Russian Twist</h3>
                            <p class="exercise-details">Oblíquos e core em ação</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3x20</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Mountain Climber', 'Cardio + core', 'advanced', '3x30s', 'https://example.com/mountain-climber.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-stop exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Mountain Climber</h3>
                            <p class="exercise-details">Cardio intenso e core</p>
                            <div class="exercise-meta">
                                <span class="difficulty advanced">Avançado</span>
                                <span class="exercise-duration">3x30s</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> AdicionaR
                            </button>
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next" onclick="slideCarousel('abs', 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>

        <!-- Pernas -->
        <section class="muscle-group">
            <h2 class="muscle-title">
                <i class="fas fa-running"></i>
                Pernas
            </h2>
            <div class="exercises-carousel">
                <button class="carousel-nav prev" onclick="slideCarousel('legs', -1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="exercises-container" id="legs-container">
                    <div class="exercise-card" onclick="openExerciseModal('Agachamento', 'Rei dos exercícios para pernas', 'beginner', '3-4 séries',)">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Agachamento</h3>
                            <p class="exercise-details">Pernas e glúteos em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3-4 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Levantamento Terra', 'Composto para posterior', 'intermediate', '3 séries', 'https://example.com/levantamento-terra.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Levantamento Terra</h3>
                            <p class="exercise-details">Posterior de coxa e glúteos</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Afundo', 'Unilateral para equilíbrio', 'beginner', '3x12 cada', 'https://example.com/afundo.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Afundo</h3>
                            <p class="exercise-details">Equilíbrio e força nas pernas</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3x12 cada</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Stiff', 'Isolamento posterior', 'intermediate', '3 séries', 'https://example.com/stiff.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Stiff</h3>
                            <p class="exercise-details">Isquiotibiais e glúteos em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Panturrilha em Pé', 'Isolamento para panturrilhas', 'beginner', '4x15-20', 'https://example.com/panturrilha.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Panturrilha em Pé</h3>
                            <p class="exercise-details">Panturrilhas definidas e fortes</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">4x15-20</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Pistol Squat', 'Agachamento unilateral', 'advanced', '3x5 cada', 'https://example.com/pistol-squat.gif')">
                        <div class="exercise-image">
                            <i class="fas fa-running exercise-placeholder"></i>
                            <button class="play-button"><i class="fas fa-play"></i></button>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Pistol Squat</h3>
                            <p class="exercise-details">Agachamento unilateral avançado</p>
                            <div class="exercise-meta">
                                <span class="difficulty advanced">Avançado</span>
                                <span class="exercise-duration">3x5 cada</span>
                            </div>
                            <button class="add-to-workout-btn" type="button"
                                onclick="event.stopPropagation(); addToWorkout(this)">
                                <i class="fas fa-plus"></i> Adicionar 
                            </button>
                        </div>
                    </div>
                </div>
                <button class="carousel-nav next" onclick="slideCarousel('legs', 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </div>

    <!-- Modal de exercício -->
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
                    <ul id="modalInstructions">
                        <li>Posicione-se corretamente</li>
                        <li>Execute o movimento controlado</li>
                        <li>Respire adequadamente</li>
                        <li>Mantenha a postura</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão para abrir menu lateral de exercícios selecionados -->
    <button id="open-selected-sidebar-btn" style="position:fixed;top:30px;right:30px;z-index:1200;background:#232323;color:#fff;border:none;border-radius:50%;width:54px;height:54px;box-shadow:0 2px 12px #0007;display:flex;align-items:center;justify-content:center;font-size:1.6rem;cursor:pointer;transition:background 0.2s;">
        <i class="fas fa-dumbbell"></i>
    </button>

    <!-- Menu lateral de exercícios selecionados -->
    <aside id="selected-sidebar" style="position:fixed;top:0;right:-420px;width:400px;max-width:95vw;height:100vh;background:linear-gradient(135deg,#181818 80%,#232323 100%);box-shadow:-4px 0 24px #000a;z-index:1201;transition:right 0.35s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:22px 22px 10px 22px;border-bottom:1px solid #222;">
            <span style="font-size:1.25rem;color:#ff0000;font-weight:600;letter-spacing:1px;">
                <i class="fas fa-dumbbell"></i> Exercícios Selecionados
            </span>
            <button onclick="closeSelectedSidebar()" style="background:none;border:none;color:#ff0000;font-size:1.5rem;cursor:pointer;padding:6px 10px;border-radius:50%;transition:background 0.2s;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="sidebar-selected-list" style="flex:1;overflow-y:auto;padding:18px 22px 0 22px;">
            <!-- Lista de exercícios será preenchida via JS -->
        </div>
        <div class="sidebar-workout-actions">
            <div class="sidebar-workout-counter">
                <i class="fas fa-dumbbell counter-icon"></i>
                Treino: <span class="count-number" id="sidebar-workout-count">0</span> exercícios
            </div>
            <button id="save-sidebar-workout-btn" class="sidebar-save-btn">
                <i class="fas fa-save"></i> SALVAR TREINO
            </button>
        </div>
    </aside>

    <script>
        // Simple gating using the same 'shark_logged_in' key used em outras páginas.
        function isLoggedIn(){ return localStorage.getItem('shark_logged_in') === '1'; }

        function showAccessModal(){
            const overlay = document.getElementById('accessOverlay');
            overlay.style.display = 'flex';
            // visually dim the page content and prevent interaction
            document.getElementById('pageContent').classList.add('dimmed');
            document.documentElement.style.overflow = 'hidden';
        }

        function hideAccessModal(){
            const overlay = document.getElementById('accessOverlay');
            overlay.style.display = 'none';
            document.getElementById('pageContent').classList.remove('dimmed');
            document.documentElement.style.overflow = '';
        }

        document.getElementById('btnLogin').addEventListener('click', function(){
            // navigate to the login page
            window.location.href = 'semlogin.php';
        });

        document.getElementById('btnBack').addEventListener('click', function(){
            // go back to home (semhomesena.php in semcadastro)
            window.location.href = 'semhomesena.php';
        });

        // On load, if user not logged in show modal and block access
        document.addEventListener('DOMContentLoaded', function(){
            if (!isLoggedIn()){
                showAccessModal();
            }
        });
        // Controle de carrossel
        const carouselPositions = {
            chest: 0,
            arms: 0,
            abs: 0,
            legs: 0
        };

        function slideCarousel(group, direction) {
            const container = document.getElementById(group + '-container');
            const cardWidth = 300; // largura do card + gap
            const maxScroll = (container.children.length - 1) * cardWidth;
            
            carouselPositions[group] += direction * cardWidth;
            
            // Limites do carrossel
            if (carouselPositions[group] < 0) {
                carouselPositions[group] = 0;
            } else if (carouselPositions[group] > maxScroll) {
                carouselPositions[group] = maxScroll;
            }
            
            container.style.transform = `translateX(-${carouselPositions[group]}px)`;
        }

        // Modal de exercício
        function openExerciseModal(name, description, difficulty, duration, gifUrl) {
            const modal = document.getElementById('exerciseModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const modalGif = document.getElementById('modalGif');
            
            modalTitle.textContent = name;
            modalDescription.textContent = description;
            
            // Simular GIF - em produção, você usaria o gifUrl real
            modalGif.src = 'data:image/svg+xml,' + encodeURIComponent(`
                <svg width="500" height="300" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100%" height="100%" fill="#ff0000"/>
                    <text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="white" font-size="20">
                        GIF: ${name}
                    </text>
                    <text x="50%" y="60%" text-anchor="middle" dy=".3em" fill="white" font-size="14">
                        ${difficulty.toUpperCase()} - ${duration}
                    </text>
                </svg>
            `);
            
            // Instruções específicas por exercício
            const instructions = getExerciseInstructions(name);
            const instructionsList = document.getElementById('modalInstructions');
            instructionsList.innerHTML = instructions.map(instruction => 
                `<li>${instruction}</li>`
            ).join('');
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeExerciseModal() {
            const modal = document.getElementById('exerciseModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function getExerciseInstructions(exerciseName) {
            const instructions = {
                'Supino Reto': [
                    'Deite no banco com os pés apoiados no chão',
                    'Segure a barra com pegada um pouco mais larga que os ombros',
                    'Desça a barra controladamente até tocar o peito',
                    'Empurre a barra para cima mantendo os cotovelos alinhados'
                ],
                'Desenvolvimento Ombros': [
                    'Sente-se com as costas retas e apoiadas',
                    'Segure os halteres na altura dos ombros',
                    'Empurre os halteres para cima sem travar os cotovelos',
                    'Desça controladamente até a posição inicial'
                ],
                'Flexão de Braço': [
                    'Posicione-se em prancha com mãos na largura dos ombros',
                    'Mantenha o corpo alinhado da cabeça aos pés',
                    'Desça o peito até quase tocar o chão',
                    'Empurre para cima mantendo o core ativado'
                ],
                'Elevação Lateral': [
                    'Fique em pé com halteres nas mãos',
                    'Mantenha os braços levemente flexionados',
                    'Eleve os halteres lateralmente até a altura dos ombros',
                    'Desça controladamente resistindo ao peso'
                ],
                'Crucifixo Inclinado': [
                    'Deite no banco inclinado (30-45 graus)',
                    'Segure os halteres com braços levemente flexionados',
                    'Abra os braços em arco até sentir alongamento no peito',
                    'Retorne à posição inicial contraindo o peitoral'
                ],
                'Rosca Direta': [
                    'Fique em pé com a barra na pegada supinada',
                    'Mantenha os cotovelos fixos ao lado do corpo',
                    'Flexione os braços levando a barra ao peito',
                    'Desça controladamente estendendo completamente'
                ],
                'Tríceps Testa': [
                    'Deite no banco segurando a barra ou halteres',
                    'Estenda os braços perpendiculares ao corpo',
                    'Flexione apenas os cotovelos descendo o peso em direção à testa',
                    'Estenda os braços retornando à posição inicial'
                ],
                'Rosca Martelo': [
                    'Segure os halteres com pegada neutra (palmas frente a frente)',
                    'Mantenha os cotovelos colados ao corpo',
                    'Flexione um braço de cada vez ou alternado',
                    'Controle o movimento na descida'
                ],
                'Mergulho Paralelas': [
                    'Apoie-se nas barras paralelas com braços estendidos',
                    'Incline levemente o tronco para frente',
                    'Desça flexionando os cotovelos até 90 graus',
                    'Empurre para cima até a posição inicial'
                ],
                'Prancha': [
                    'Posicione-se em posição de flexão apoiado nos antebraços',
                    'Mantenha o corpo alinhado da cabeça aos pés',
                    'Contraia o abdômen e glúteos',
                    'Respire normalmente mantendo a posição'
                ],
                'Abdominal Supra': [
                    'Deite com joelhos flexionados e pés apoiados',
                    'Coloque as mãos atrás da cabeça ou cruzadas no peito',
                    'Contraia o abdômen elevando apenas o tronco',
                    'Desça controladamente sem relaxar completamente'
                ],
                'Elevação de Pernas': [
                    'Deite com as mãos apoiadas no chão ao lado do corpo',
                    'Mantenha as pernas estendidas ou levemente flexionadas',
                    'Eleve as pernas até formar 90 graus com o tronco',
                    'Desça controladamente sem tocar o chão'
                ],
                'Russian Twist': [
                    'Sente com pernas flexionadas e pés elevados',
                    'Incline o tronco para trás mantendo as costas retas',
                    'Gire o tronco de um lado para o outro',
                    'Mantenha o core contraído durante todo movimento'
                ],
                'Mountain Climber': [
                    'Inicie em posição de prancha',
                    'Traga um joelho em direção ao peito',
                    'Alterne rapidamente as pernas como se estivesse correndo',
                    'Mantenha o core ativado e quadris alinhados'
                ],
                'Agachamento': [
                    'Fique em pé com pés na largura dos ombros',
                    'Desça flexionando quadris e joelhos simultaneamente',
                    'Desça até as coxas ficarem paralelas ao chão',
                    'Suba empurrando pelos calcanhares'
                ],
                'Levantamento Terra': [
                    'Posicione a barra próxima às canelas',
                    'Agarre a barra com pegada mista ou dupla',
                    'Levante empurrando o chão com os pés',
                    'Mantenha as costas retas durante todo movimento'
                ],
                'Afundo': [
                    'Dê um passo largo para frente',
                    'Desça flexionando ambos os joelhos em 90 graus',
                    'O joelho da frente deve ficar sobre o tornozelo',
                    'Retorne à posição inicial empurrando com a perna da frente'
                ],
                'Stiff': [
                    'Segure a barra com pegada pronada',
                    'Mantenha as pernas levemente flexionadas',
                    'Desça a barra deslizando pelas pernas',
                    'Retorne contraindo glúteos e isquiotibiais'
                ],
                'Panturrilha em Pé': [
                    'Posicione a parte anterior dos pés na plataforma',
                    'Deixe os calcanhares livres para mover',
                    'Suba na ponta dos pés contraindo as panturrilhas',
                    'Desça controladamente alongando os músculos'
                ],
                'Pistol Squat': [
                    'Fique em pé numa perna só',
                    'Estenda a outra perna para frente',
                    'Desça agachando até o glúteo quase tocar o calcanhar',
                    'Suba usando apenas a força da perna de apoio'
                ]
            };
            
            return instructions[exerciseName] || [
                'Mantenha a postura correta',
                'Execute o movimento controlado',
                'Respire adequadamente',
                'Foque na contração muscular'
            ];
        }

        // Fechar modal clicando fora
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

        // Animação de entrada
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

        // Observar grupos musculares
        document.querySelectorAll('.muscle-group').forEach(group => {
            observer.observe(group);
        });

        // Efeito de hover nos cards
        document.querySelectorAll('.exercise-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Controle responsivo do carrossel
        function updateCarouselResponsive() {
            const isMobile = window.innerWidth <= 768;
            const cardWidth = isMobile ? 235 : 300;
            
            // Atualizar todas as posições do carrossel
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

        // Aplicar controle responsivo
        window.addEventListener('resize', updateCarouselResponsive);
        updateCarouselResponsive();

        // Smooth scroll para background
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

        function getExerciseData(card) {
            const name = card.querySelector('.exercise-name')?.textContent || '';
            const details = card.querySelector('.exercise-details')?.textContent || '';
            const meta = card.querySelector('.exercise-meta');
            const difficulty = meta?.querySelector('.difficulty')?.classList[1] || '';
            const difficultyText = meta?.querySelector('.difficulty')?.textContent || '';
            const duration = meta?.querySelector('.exercise-duration')?.textContent || '';
            const iconClass = card.querySelector('.exercise-placeholder')?.classList[1] || '';
            let gifUrl = '';
            let description = '';
            const onclickAttr = card.getAttribute('onclick');
            if (onclickAttr) {
                const match = onclickAttr.match(/['"]([^'"]+)['"],\s*['"]([^'"]+)['"],\s*['"]([^'"]+)['"],\s*['"]([^'"]+)['"],\s*['"]([^'"]+)['"]/);
                if (match) {
                    description = match[2];
                    gifUrl = match[5];
                }
            }
            return { name, details, difficulty, difficultyText, duration, iconClass, gifUrl, description };
        }
        function addToWorkout(btn, event) {
            if (event) event.stopPropagation();
            const card = btn.closest('.exercise-card');
            const data = getExerciseData(card);

            // Já está selecionado?
            if (selectedExercises.some(e => e.name === data.name)) {
                btn.innerHTML = '<i class="fas fa-check"></i> Adicionado';
                btn.classList.add('added');
                btn.disabled = true;
                return;
            }
            selectedExercises.push(data);
            btn.innerHTML = '<i class="fas fa-check"></i> Adicionado';
            btn.classList.add('added');
            btn.disabled = true;
            updateSelectedExercisesSection();
        }

        // --- NOVO: Controle de exercícios selecionados ---
        // Lista dos selecionados
        let selectedExercises = [];

        // Atualiza a sessão de exercícios selecionados
        function updateSelectedExercisesSection() {
            const listDiv = document.getElementById('selected-exercises-list');
            const emptyDiv = document.getElementById('selected-exercises-empty');
            if (!listDiv) return;

            // Remove todos os filhos
            listDiv.innerHTML = '';

            if (selectedExercises.length === 0) {
                if (emptyDiv) emptyDiv.style.display = '';
                return;
            }
            if (emptyDiv) emptyDiv.style.display = 'none';

            selectedExercises.forEach((ex, idx) => {
                const item = document.createElement('div');
                item.style.cssText = "display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.03);border-radius:7px;padding:10px 14px;margin-bottom:8px;border:1px solid #222;";
                item.innerHTML = `
                    <div>
                        <span style="color:#fff;font-weight:600;">${ex.name}</span>
                        <span style="color:#ff0000;font-size:0.95em;margin-left:8px;">${ex.difficultyText || ''}</span>
                        <span style="color:#aaa;font-size:0.93em;margin-left:8px;">${ex.duration || ''}</span>
                    </div>
                    <button onclick="removeSelectedExercise(${idx})" style="background:none;border:none;color:#ff0000;font-size:1.2em;cursor:pointer;padding:4px 8px;border-radius:50%;transition:background 0.2s;">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                listDiv.appendChild(item);
            });
        }

        // Remove exercício selecionado
        function removeSelectedExercise(idx) {
            if (idx >= 0 && idx < selectedExercises.length) {
                selectedExercises.splice(idx, 1);
                updateSelectedExercisesSection();
                // Atualiza botões dos cards
                document.querySelectorAll('.exercise-card').forEach(card => {
                    const name = card.querySelector('.exercise-name')?.textContent || '';
                    if (!selectedExercises.some(e => e.name === name)) {
                        const btn = card.querySelector('.add-to-workout-btn');
                        if (btn) {
                            btn.innerHTML = '<i class="fas fa-plus"></i> Adicionar';
                            btn.classList.remove('added');
                            btn.disabled = false;
                        }
                    }
                });
            }
        }

        // Inicializa a sessão ao carregar
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectedExercisesSection();
        });

        // --- NOVO: Lateral de exercícios selecionados ---
        function openSelectedSidebar() {
            document.getElementById('selected-sidebar').style.right = '0';
            renderSidebarSelectedList();
        }
        function closeSelectedSidebar() {
            document.getElementById('selected-sidebar').style.right = '-420px';
        }

        // Renderiza a lista de exercícios selecionados no menu lateral
        function renderSidebarSelectedList() {
            const listDiv = document.getElementById('sidebar-selected-list');
            const countSpan = document.getElementById('sidebar-workout-count');
            if (countSpan) countSpan.textContent = selectedExercises.length;
            listDiv.innerHTML = '';
            if (selectedExercises.length === 0) {
                listDiv.innerHTML = `<div style="color:#aaa;text-align:center;margin-top:30px;">Nenhum exercício selecionado.</div>`;
                return;
            }
            selectedExercises.forEach((ex, idx) => {
                const item = document.createElement('div');
                item.style.cssText = "display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.03);border-radius:7px;padding:10px 14px;margin-bottom:10px;border:1px solid #222;";
                item.innerHTML = `
                    <div>
                        <span style="color:#fff;font-weight:600;">${ex.name}</span>
                        <span style="color:#ff0000;font-size:0.95em;margin-left:8px;">${ex.difficultyText || ''}</span>
                        <span style="color:#aaa;font-size:0.93em;margin-left:8px;">${ex.duration || ''}</span>
                    </div>
                    <button onclick="removeSelectedExercise(${idx});renderSidebarSelectedList();" style="background:none;border:none;color:#ff0000;font-size:1.2em;cursor:pointer;padding:4px 8px;border-radius:50%;transition:background 0.2s;">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                listDiv.appendChild(item);
            });
        }

        // Salvar treino selecionado do menu lateral
        function saveSidebarWorkout() {
            if (selectedExercises.length === 0) {
                alert('Nenhum exercício selecionado para salvar.');
                return;
            }
            const workoutName = prompt('Digite um nome para o treino:', 'Meu Treino');
            if (!workoutName) return;
            const workoutData = {
                name: workoutName,
                date: new Date().toLocaleDateString(),
                exercises: selectedExercises.map(ex => ({
                    name: ex.name,
                    difficulty: ex.difficultyText,
                    duration: ex.duration
                }))
            };
            let savedWorkouts = JSON.parse(localStorage.getItem('workouts') || '[]');
            savedWorkouts.push(workoutData);
            localStorage.setItem('workouts', JSON.stringify(savedWorkouts));
            alert(`Treino "${workoutName}" salvo com sucesso!`);
            // Limpa os selecionados
            selectedExercises = [];
            updateSelectedExercisesSection();
            renderSidebarSelectedList();
            // Atualiza botões dos cards
            document.querySelectorAll('.exercise-card').forEach(card => {
                const name = card.querySelector('.exercise-name')?.textContent || '';
                if (!selectedExercises.some(e => e.name === name)) {
                    const btn = card.querySelector('.add-to-workout-btn');
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-plus"></i> Adicionar';
                        btn.classList.remove('added');
                        btn.disabled = false;
                    }
                }
            });
        }

        // Eventos para abrir/fechar menu lateral e salvar treino
        document.getElementById('open-selected-sidebar-btn').onclick = openSelectedSidebar;
        document.getElementById('save-sidebar-workout-btn').onclick = saveSidebarWorkout;

        // Fecha menu lateral ao clicar fora dele
        document.addEventListener('mousedown', function(e) {
            const sidebar = document.getElementById('selected-sidebar');
            const btn = document.getElementById('open-selected-sidebar-btn');
            if (!sidebar.contains(e.target) && e.target !== btn) {
                closeSelectedSidebar();
            }
        });
    </script>
</body>
</html>