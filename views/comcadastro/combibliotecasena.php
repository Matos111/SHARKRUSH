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

        /* Novas Estilos para os Exercícios */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Estilos para o Carrossel de Exercícios */
        .exercises-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .exercises-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        /* Modal de Exercício */
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

        /* Novas Estilos para os Exercícios */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Estilos para o Carrossel de Exercícios */
        .exercises-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .exercises-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        /* Modal de Exercício */
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

        /* Novas Estilos para os Exercícios */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Estilos para o Carrossel de Exercícios */
        .exercises-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .exercises-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        /* Modal de Exercício */
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

        /* Novas Estilos para os Exercícios */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Estilos para o Carrossel de Exercícios */
        .exercises-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .exercises-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        /* Modal de Exercício */
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
            color: #ff000;
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

        /* Novas Estilos para os Exercícios */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Estilos para o Carrossel de Exercícios */
        .exercises-carousel {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            padding: 0 15px;
        }

        .exercises-container {
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
        }

        .carousel-nav:hover {
            background: rgba(255, 0, 0, 0.8);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        /* Modal de Exercício */
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

        /* Novas Estilos para os Exercícios - Grupo Peito e Ombros */
        .exercise-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .exercise-image {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .exercise-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .exercise-card:hover .exercise-image img {
            transform: scale(1.1);
        }

        .exercise-info {
            text-align: center;
            margin-top: 10px;
        }

        .exercise-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 0.9rem;
            color: #d1d1d1;
            margin-bottom: 10px;
        }

        .exercise-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8rem;
            color: #b1b1b1;
        }

        .difficulty {
            padding: 4px 8px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .difficulty.beginner {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
        }

        .difficulty.intermediate {
            background: rgba(255, 165, 0, 0.2);
            color: #ffa500;
        }

        .difficulty.advanced {
            background: rgba(255, 0, 0, 0.2);
            color: #ff0000;
        }

        /* Estilos para os GIFs dos Exercícios */
        .exercise-gif {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .exercise-card:hover .exercise-gif {
            opacity: 1;
        }

        /* Peito e Ombros */
        <section class="muscle-group">
            <div class="exercise-card">
                <div class="exercise-image">
                    <img src="views/midia/img-gif_biblioteca/supino-reto-img.png" alt="Supino Reto">
                    <div class="exercise-gif">
                        <img src="views/midia/img-gif_biblioteca/supino-reto-gif.gif" alt="Supino Reto GIF">
                    </div>
                </div>
                <div class="exercise-info">
                    <h3 class="exercise-name">Supino Reto</h3>
                    <p class="exercise-details">Exercício para peitoral.</p>
                </div>
            </div>
            <div class="exercise-card">
                <div class="exercise-image">
                    <img src="views/midia/img-gif_biblioteca/supino-inclinado-img.png" alt="Supino Inclinado">
                    <div class="exercise-gif">
                        <img src="views/midia/img-gif_biblioteca/supino-inclinado-gif.gif" alt="Supino Inclinado GIF">
                    </div>
                </div>
                <div class="exercise-info">
                    <h3 class="exercise-name">Supino Inclinado</h3>
                    <p class="exercise-details">Exercício para peitoral superior.</p>
                </div>
            </div>
            <div class="exercise-card">
                <div class="exercise-image">
                    <img src="views/midia/img-gif_biblioteca/crucifixo-img.png" alt="Crucifixo">
                    <div class="exercise-gif">
                        <img src="views/midia/img-gif_biblioteca/crucifixo-gif.gif" alt="Crucifixo GIF">
                    </div>
                </div>
                <div class="exercise-info">
                    <h3 class="exercise-name">Crucifixo</h3>
                    <p class="exercise-details">Exercício para peitoral.</p>
                </div>
            </div>
        </section>
    </style>
</head>
<body>
    <nav class="main-menu">
        <div class="logo-container">
            <a href="/sharkrush/dashboard" title="Dashboard">
                <img src="../midia/Logos/logoshark.png"alt="Logo"/>
            </a>
        </div>
        <ul>
            <li>
            <a href="/sharkrush/perfil" class="nav-login">
                <i class="fa fa-user nav-icon"></i>
                <span class="nav-text">Perfil</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/biblioteca" class="active">
                <i class="fa fa-book nav-icon"></i>
                <span class="nav-text">Biblioteca</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/meus-treinos">
                <i class="fa fa-dumbbell nav-icon"></i>
                <span class="nav-text">Meus Treinos</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/calculadora-imc">
                <i class="fa fa-calculator nav-icon"></i>
                <span class="nav-text">Calculadora IMC</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/calculadora-calorias">
                <i class="fa fa-fire nav-icon"></i>
                <span class="nav-text">Calculadora Calorias</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/sobre">
                <i class="fa fa-info-circle nav-icon"></i>
                <span class="nav-text">Sobre</span>
            </a>
            </li>
        </ul>
    </nav>
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
                            <img src="views/midia/img-gif_biblioteca/supino-reto-img.png" alt="Supino Reto">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/supino-reto-gif.gif" alt="Supino Reto GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Supino Reto</h3>
                            <p class="exercise-details">Exercício para peitoral.</p>
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
                <i class="fas fa-dumbbell"></i>
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
                            <img src="views/midia/img-gif_biblioteca/agachamento-img.png" alt="Agachamento">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/agachamento-gif.gif" alt="Agachamento GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Agachamento</h3>
                            <p class="exercise-details">Exercício para quadríceps e glúteos.</p>
                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Levantamento Terra', 'Composto para posterior', 'intermediate', '3 séries', 'https://example.com/levantamento-terra.gif')">
                        <div class="exercise-image">
                            <img src="views/midia/img-gif_biblioteca/levantamento-terra-img.png" alt="Levantamento Terra">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/levantamento-terra-gif.gif" alt="Levantamento Terra GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Levantamento Terra</h3>
                            <p class="exercise-details">Posterior de coxa e glúteos</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>

                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Afundo', 'Unilateral para equilíbrio', 'beginner', '3x12 cada', 'https://example.com/afundo.gif')">
                        <div class="exercise-image">
                            <img src="views/midia/img-gif_biblioteca/afundo-img.png" alt="Afundo">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/afundo-gif.gif" alt="Afundo GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Afundo</h3>
                            <p class="exercise-details">Equilíbrio e força nas pernas</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">3x12 cada</span>
                            </div>

                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Stiff', 'Isolamento posterior', 'intermediate', '3 séries', 'https://example.com/stiff.gif')">
                        <div class="exercise-image">
                            <img src="views/midia/img-gif_biblioteca/stiff-img.png" alt="Stiff">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/stiff-gif.gif" alt="Stiff GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Stiff</h3>
                            <p class="exercise-details">Isquiotibiais e glúteos em foco</p>
                            <div class="exercise-meta">
                                <span class="difficulty intermediate">Intermediário</span>
                                <span class="exercise-duration">3 séries</span>
                            </div>

                        </div>
                    </div>

                    <div class="exercise-card" onclick="openExerciseModal('Panturrilha em Pé', 'Isolamento para panturrilhas', 'beginner', '4x15-20', 'https://example.com/panturrilha.gif')">
                        <div class="exercise-image">
                            <img src="views/midia/img-gif_biblioteca/panturrilha-img.png" alt="Panturrilha em Pé">
                            <div class="exercise-gif">
                                <img src="views/midia/img-gif_biblioteca/panturrilha-gif.gif" alt="Panturrilha em Pé GIF">
                            </div>
                        </div>
                        <div class="exercise-info">
                            <h3 class="exercise-name">Panturrilha em Pé</h3>
                            <p class="exercise-details">Panturrilhas mais fortes</p>
                            <div class="exercise-meta">
                                <span class="difficulty beginner">Iniciante</span>
                                <span class="exercise-duration">4x15-20</span>
                            </div>

                        </div>
                    </div>
                </div>
                <button class="carousel-nav next" onclick="slideCarousel('legs', 1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
    </div>

    <!-- Modal de Exercício -->
    <div class="exercise-modal" id="exercise-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-exercise-name">Nome do Exercício</h2>
                <button class="close-modal" onclick="closeExerciseModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="GIF do Exercício" class="modal-gif" id="modal-exercise-gif">
                <p class="modal-description" id="modal-exercise-description"></p>
                <div class="modal-instructions" id="modal-exercise-instructions">
                    <h4>Instruções</h4>
                    <ul>
                        <li>Instrução 1</li>
                        <li>Instrução 2</li>
                        <li>Instrução 3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para abrir o modal do exercício
        function openExerciseModal(name, description, level, series, gifUrl) {
            document.getElementById('modal-exercise-name').innerText = name;
            document.getElementById('modal-exercise-description').innerText = description;
            document.getElementById('modal-exercise-gif').src = gifUrl;

            const instructions = {
                'Supino Reto': ['Deite-se em um banco reto.', 'Segure a barra com as mãos um pouco mais largas que a largura dos ombros.', 'Desça a barra controladamente