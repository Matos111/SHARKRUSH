<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Gerenciador de Treinos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 0, 0, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 0, 0, 0.05) 0%, transparent 50%);
            z-index: -1;
            animation: bgPulse 8s ease-in-out infinite;
        }

        @keyframes bgPulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            animation: fadeInDown 0.8s ease;
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

        .header h1 {
            font-size: 56px;
            font-weight: 900;
            background: linear-gradient(45deg, #ff0000, #ff6666);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 10px;
            text-shadow: 0 0 30px rgba(255, 0, 0, 0.3);
            animation: titleGlow 2s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from { filter: drop-shadow(0 0 10px rgba(255, 0, 0, 0.3)); }
            to { filter: drop-shadow(0 0 25px rgba(255, 0, 0, 0.6)); }
        }

        .header p {
            font-size: 18px;
            color: #999;
            letter-spacing: 2px;
        }

        .add-workout-btn {
            background: linear-gradient(45deg, #272727, #272727);
            color: white;
            border-color: #ff0000;
            border-radius: 3px;
            padding: 18px 40px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin: 30px auto;
            display: block;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            overflow: hidden;
        }

        .add-workout-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .add-workout-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .add-workout-btn:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(255, 0, 0, 0.5);
        }

        .add-workout-btn i {
            margin-right: 10px;
        }

        .workouts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .workout-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 0, 0, 0.2);
            border-radius: 25px;
            padding: 30px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
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

        .workout-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;

            border-radius: 25px;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
            animation: borderRotate 3s linear infinite;
        }

        @keyframes borderRotate {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }

        .workout-card:hover::before {
            opacity: 0.3;
        }

        .workout-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(255, 0, 0, 0.6);
            box-shadow: 0 20px 60px rgba(255, 0, 0, 0.4);
        }

        .workout-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .workout-name {
            font-size: 32px;
            font-weight: 900;
            color: #ff0000;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .workout-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-pending {
            background: rgba(47, 47, 47, 0.2);
            color: #bfbfbf;
            border: 1px solid #2b2b2b;
        }

        .status-in-progress {
            background: rgba(65, 65, 65, 0.2);
            color: #d6d6d6;
            border: 1px solid #343434;
            animation: pulse 2s ease-in-out infinite;
        }

        .status-completed {
            background: rgba(0, 255, 0, 0.2);
            color: #00ff00;
            border: 1px solid #00ff00;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        .workout-description {
            color: #aaa;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.6;
        }

        .exercises-list {
            margin-bottom: 20px;
        }

        .exercise-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .exercise-item:hover {
            background: rgba(255, 0, 0, 0.1);
            border-left-color: #ff0000;
            transform: translateX(5px);
        }

        .exercise-item.completed {
            opacity: 1;
            text-decoration: line-through;
            background: rgba(255, 255, 255, 0.05);
            border-left-color: #ff0000;
        }

        .exercise-info {
            flex: 1;
        }

        .exercise-name {
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
        }

        .exercise-details {
            font-size: 12px;
            color: #888;
        }

        /* custom-styled checkbox: force black background and gray border, replace native appearance */
        .exercise-checkbox {
            width: 24px;
            height: 24px;
            cursor: pointer;
            transform: scale(1.2);
            background: #000;               /* black background */
            border: 2px solid #888;         /* gray border */
            border-radius: 6px;
            -webkit-appearance: none;
            appearance: none;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            box-sizing: border-box;
        }

        /* checkmark drawn with a rotated border in a pseudo-element (moved up + thicker) */
        .exercise-checkbox::after {
            content: '';
            position: absolute;
            /* move the check slightly upward for better visual alignment */
            left: 60%;
            top: 24%;
            width: 14px;
            height: 26px;
            border-right: 4px solid transparent; /* thicker stroke */
            border-bottom: 4px solid transparent;
            transform: translate(-50%, -60%) rotate(40deg) scale(0);
            transition: transform 120ms ease, border-color 120ms ease;
            pointer-events: none;
        }

        .exercise-checkbox:checked::after {
            border-right-color: #ff0000; /* red check */
            border-bottom-color: #ff0000;
            transform: translate(-50%, -60%) rotate(40deg) scale(1);
        }

        .exercise-checkbox:focus {
            outline: 2px solid rgba(255,255,255,0.08);
            outline-offset: 2px;
        }

        .progress-section {
            margin: 25px 0;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #aaa;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff0000, #ff6666);
            border-radius: 10px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap; /* allow wrapping on small screens */
        }

        /* spacing specifically for the top row of buttons above the exercises */
        .action-buttons.top-row {
            margin-bottom: 32px; /* increased gap between buttons and exercises */
        }

        /* make buttons share the row; keep delete full-width below */
        .action-buttons .btn {
            flex: 1 1 auto;
            min-width: 0; /* allow shrinking
                         to keep buttons on one line */
        }

        .action-buttons .btn-start {
            flex: 1 1 100%; /* occupy full row so other buttons stay in the row above */
            margin-top: 6px;
        }

        .btn {
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn:hover::before {
            width: 200px;
            height: 200px;
        }

        .btn-start {
            /* match .btn-delete styling to make Start look like Excluir */
            background: rgba(255, 0, 0, 0.1);
            color: #ff6666;
            border: 1px solid rgba(255, 0, 0, 0.3);
        }

        .btn-start:hover {
            background: rgba(255, 0, 0, 0.2);
            border-color: #ff0000;
        }

        .btn-view {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-view:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .btn-delete {
            /* match .btn-view styling so Excluir looks like Ver/Reiniciar */
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-delete:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal.active {
            display: flex;
        }

        /* Confirmation modal specific styles */
        .confirm-modal .modal-content {
            max-width: 420px;
            text-align: center;
            padding: 28px 24px;
            border-radius: 16px;
        }

        .confirm-modal h2 {
            color: #ff4d4d;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .confirm-modal p {
            color: #ccc;
            margin-bottom: 18px;
            line-height: 1.4;
        }

        .confirm-buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 8px;
        }

        .confirm-btn {
            background: linear-gradient(45deg, #ff0000, #cc0000);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 900;
        }

        .cancel-btn {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.12);
            padding: 10px 16px;
            border-radius: 10px;
        }

        .modal-content {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 40px;
            border-radius: 25px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border: 2px solid rgba(255, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content::-webkit-scrollbar {
            width: 8px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #ff0000;
            border-radius: 10px;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 0, 0, 0.2);
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: #ff0000;
            transform: rotate(90deg);
        }

        .modal h2 {
            font-size: 32px;
            color: #ff0000;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #aaa;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group select option {
            background: #1a1a1a;
            color: white;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #ff0000;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.2);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .exercise-form {
            background: rgba(255, 0, 0, 0.05);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        .exercise-inputs {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }

        .exercise-inputs select.exercise-name {
            background: #111111;
            color: #fff;
            border: 2px solid #ff0000;
            border-radius: 6px;
            padding: 10px;
            font-size: 16px;
            font-family: inherit;
            appearance: none;
            outline: none;
            transition: border-color 0.3s;
        }
        .exercise-inputs select.exercise-name:focus {
            border-color: #fff;
        }
        .exercise-inputs select.exercise-name option {
            background: #232323;
            color: #fff;
        }

        .add-exercise-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 2px dashed rgba(255, 255, 255, 0.3);
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }

        .add-exercise-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ff0000;
        }

        .gif-viewer {
            margin-top: 30px;
            text-align: center;
        }

        .gif-container {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 20px;
            margin-top: 15px;
            border: 2px solid rgba(255, 0, 0, 0.3);
        }

        .gif-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            animation: fadeIn 0.8s ease;
        }

        .empty-state i {
            font-size: 80px;
            color: rgba(255, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 28px;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #555;
            font-size: 16px;
        }

        /* NAVBAR CSS */
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


        /* ===== NAVBAR CSS INÍCIO ===== */
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
        /* ===== NAVBAR CSS FIM ===== */

        @media (max-width: 768px) {
            .header h1 {
                font-size: 36px;
            }

            .workouts-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 25px;
            }

            .exercise-inputs {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .btn-start {
                grid-column: span 1;
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(45deg, #ff0000, #cc0000);
            color: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.5);
            z-index: 2000;
            animation: slideInRight 0.5s ease, slideOutRight 0.5s ease 2.5s;
            display: none;
        }

        .notification.show {
            display: block;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
     <!-- ===== NAVBAR HTML INÍCIO ===== -->
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
            <a href="/sharkrush/biblioteca">
                <i class="fa fa-book nav-icon"></i>
                <span class="nav-text">Biblioteca</span>
            </a>
            </li>
            <li>
            <a href="/sharkrush/meus-treinos" class="active">
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
    <!-- ===== NAVBAR HTML FIM ===== -->
    <div class="container">


        <button class="add-workout-btn" onclick="openAddWorkoutModal()">
            <i class="fas fa-plus"></i>
            Adicionar Novo Treino
        </button>

        <div class="workouts-grid" id="workoutsGrid"></div>

        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="fas fa-dumbbell"></i>
            <h3>Nenhum treino cadastrado</h3>
            <p>Clique no botão acima para criar seu primeiro treino!</p>
        </div>
    </div>

    <div class="modal" id="addWorkoutModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeAddWorkoutModal()">×</button>
            <h2>Novo Treino</h2>
            <form id="workoutForm">
                <div class="form-group">
                    <label>Nome do Treino</label>
                    <input type="text" id="workoutName" placeholder="Ex: Treino A - Peito e Triceps" required>
                </div>
                <div class="form-group">
                    <label>Descricao</label>
                    <textarea id="workoutDescription" placeholder="Descreva o foco deste treino..."></textarea>
                </div>
                <div class="form-group">
                    <label>Dia da Semana</label>
                    <select id="workoutDiaSemana" required style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.05); border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 12px; color: white; font-size: 16px;">
                        <option value="">Selecione o dia</option>
                        <option value="Segunda">Segunda-feira</option>
                        <option value="Terça">Terca-feira</option>
                        <option value="Quarta">Quarta-feira</option>
                        <option value="Quinta">Quinta-feira</option>
                        <option value="Sexta">Sexta-feira</option>
                        <option value="Sábado">Sabado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Exercicios</label>
                    <div id="exercisesContainer"></div>
                    <button type="button" class="add-exercise-btn" onclick="addExerciseField()">
                        <i class="fas fa-plus"></i> Adicionar Exercicio
                    </button>
                </div>
                <button type="submit" class="btn btn-start">Criar Treino</button>
            </form>
        </div>
    </div>

    <div class="modal" id="viewWorkoutModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeViewWorkoutModal()">×</button>
            <div id="workoutDetailsContent"></div>
        </div>
    </div>

    <!-- Edit workout modal -->
    <div class="modal" id="editWorkoutModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closeEditWorkoutModal()">×</button>
            <h2>Editar Treino</h2>
            <form id="editWorkoutForm">
                <input type="hidden" id="editWorkoutId">
                <div class="form-group">
                    <label>Nome do Treino</label>
                    <input type="text" id="editWorkoutName" placeholder="Ex: Treino A - Peito e Triceps" required>
                </div>
                <div class="form-group">
                    <label>Descricao</label>
                    <textarea id="editWorkoutDescription" placeholder="Descreva o foco deste treino..."></textarea>
                </div>
                <div class="form-group">
                    <label>Dia da Semana</label>
                    <select id="editWorkoutDiaSemana" required style="width: 100%; padding: 15px; background: rgba(255, 255, 255, 0.05); border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 12px; color: white; font-size: 16px;">
                        <option value="">Selecione o dia</option>
                        <option value="Segunda">Segunda-feira</option>
                        <option value="Terça">Terca-feira</option>
                        <option value="Quarta">Quarta-feira</option>
                        <option value="Quinta">Quinta-feira</option>
                        <option value="Sexta">Sexta-feira</option>
                        <option value="Sábado">Sabado</option>
                        <option value="Domingo">Domingo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Exercicios</label>
                    <div id="editExercisesContainer"></div>
                    <button type="button" class="add-exercise-btn" onclick="addEditExerciseField()">
                        <i class="fas fa-plus"></i> Adicionar Exercicio
                    </button>
                </div>
                <button type="submit" class="btn btn-start">Salvar Alteracoes</button>
            </form>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    <div class="modal confirm-modal" id="deleteConfirmModal">
        <div class="modal-content">
            <button class="close-btn" onclick="hideDeleteConfirm()">×</button>
            <h2>Excluir Treino</h2>
            <p id="deleteConfirmMessage">Tem certeza que deseja excluir este treino? Esta ação não pode ser desfeita.</p>
            <div class="confirm-buttons">
                <button class="btn cancel-btn" onclick="hideDeleteConfirm()">Cancelar</button>
                <button class="btn confirm-btn" onclick="confirmDelete()">Excluir</button>
            </div>
        </div>
    </div>

    <div class="notification" id="notification"></div>

    <script>
        let workouts = [];
        let currentWorkoutId = null;
        const API_BASE = '/sharkrush/api/meus-treinos';

        // Exercícios com GIFs de exemplo
        // Carrega treinos da API
        async function loadWorkouts() {
            try {
                const response = await fetch(`${API_BASE}/listar`);
                const result = await response.json();

                if (result.success) {
                    workouts = result.treinos;
                    renderWorkouts();
                } else {
                    console.error('Erro ao carregar treinos:', result.message);
                }
            } catch (error) {
                console.error('Erro ao carregar treinos:', error);
            }
        }

        const exerciseGifs = {
            'supino': 'https://i.pinimg.com/originals/16/70/c8/1670c89b555af7d1e75161a19bb622c1.gif',
            'flexao': 'https://i.pinimg.com/originals/49/7d/f9/497df922c8f51417c0e00f2a1b29ab5b.gif',
            'agachamento': 'https://thumbs.gfycat.com/BlondPleasingChameleon-size_restricted.gif',
            'rosca': 'https://thumbs.gfycat.com/AltruisticImpressiveElephantbeetle-max-1mb.gif',
            'puxada': 'https://thumbs.gfycat.com/WeightyPointedBluetonguelizard-size_restricted.gif',
            'default': 'https://i.pinimg.com/originals/82/3c/66/823c664ee7195f5e0efbe8ca90e2b2e0.gif'
        };

        function getExerciseGif(exerciseName) {
            const name = exerciseName.toLowerCase();
            for (let key in exerciseGifs) {
                if (name.includes(key)) {
                    return exerciseGifs[key];
                }
            }
            return exerciseGifs.default;
        }

        function openAddWorkoutModal() {
            document.getElementById('addWorkoutModal').classList.add('active');
            addExerciseField();
        }

        function closeAddWorkoutModal() {
            document.getElementById('addWorkoutModal').classList.remove('active');
            document.getElementById('workoutForm').reset();
            document.getElementById('exercisesContainer').innerHTML = '';
        }

        async function editWorkout(workoutId) {
            const workout = workouts.find(w => w.id === workoutId);
            if (!workout) return;

            try {
                const response = await fetch(`${API_BASE}/detalhes?id=${workoutId}`);
                const result = await response.json();

                if (!result.success) {
                    showNotification('Erro ao carregar detalhes do treino');
                    return;
                }

                const exercises = result.exercises || [];

                document.getElementById('editWorkoutId').value = workout.id;
                document.getElementById('editWorkoutName').value = workout.name;
                document.getElementById('editWorkoutDescription').value = workout.description || '';
                document.getElementById('editWorkoutDiaSemana').value = workout.dia_semana || '';

                const container = document.getElementById('editExercisesContainer');
                container.innerHTML = '';

                exercises.forEach(exercise => {
                    addEditExerciseField(exercise);
                });

                document.getElementById('editWorkoutModal').classList.add('active');
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao carregar treino para edicao');
            }
        }

        function closeEditWorkoutModal() {
            document.getElementById('editWorkoutModal').classList.remove('active');
            document.getElementById('editWorkoutForm').reset();
        }

        document.getElementById('editWorkoutForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const grupoTreino = document.getElementById('editWorkoutId').value;
            const nome = document.getElementById('editWorkoutName').value;
            const descricao = document.getElementById('editWorkoutDescription').value;
            const diaSemana = document.getElementById('editWorkoutDiaSemana').value;

            if (!diaSemana) {
                showNotification('Selecione o dia da semana!');
                return;
            }

            const exerciseForms = document.querySelectorAll('#editExercisesContainer .exercise-form');
            const exercises = [];

            exerciseForms.forEach(form => {
                const id = form.querySelector('.exercise-id')?.value;
                const exerciseNameElem = form.querySelector('.exercise-name');
                const exerciseName = exerciseNameElem.options[exerciseNameElem.selectedIndex].value;
                const sets = form.querySelector('.exercise-sets').value;
                const reps = form.querySelector('.exercise-reps').value;

                if (exerciseName && sets && reps) {
                    exercises.push({
                        id: id || null,
                        name: exerciseName,
                        sets: parseInt(sets),
                        reps: parseInt(reps)
                    });
                }
            });

            if (exercises.length === 0) {
                showNotification('Adicione pelo menos um exercicio ao treino!');
                return;
            }

            try {
                const response = await fetch(`${API_BASE}/atualizar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        grupo_treino: grupoTreino,
                        nome_treino: nome,
                        descricao_treino: descricao,
                        dia_semana: diaSemana,
                        exercises: exercises
                    })
                });

                const result = await response.json();

                if (result.success) {
                    await loadWorkouts();
                    closeEditWorkoutModal();
                    showNotification('Treino atualizado com sucesso!');
                } else {
                    showNotification('Erro ao atualizar treino: ' + result.message);
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao atualizar treino. Tente novamente.');
            }
        });

        function addEditExerciseField(exercise = null) {
            const container = document.getElementById('editExercisesContainer');
            const exerciseDiv = document.createElement('div');
            exerciseDiv.className = 'exercise-form';
                exerciseDiv.innerHTML = `
                    <div class="exercise-inputs">
                        ${exercise ? `<input type="hidden" class="exercise-id" value="${exercise.id}">` : ''}
                        <select class="exercise-name" required>
                            <option value="">Selecione o exercicio</option>
                            <option value="Supino Reto" ${exercise && exercise.name === 'Supino Reto' ? 'selected' : ''}>Supino Reto</option>
                            <option value="Supino Inclinado" ${exercise && exercise.name === 'Supino Inclinado' ? 'selected' : ''}>Supino Inclinado</option>
                            <option value="Crucifixo" ${exercise && exercise.name === 'Crucifixo' ? 'selected' : ''}>Crucifixo</option>
                            <option value="Tríceps Testa" ${exercise && exercise.name === 'Tríceps Testa' ? 'selected' : ''}>Tríceps Testa</option>
                            <option value="Tríceps Corda" ${exercise && exercise.name === 'Tríceps Corda' ? 'selected' : ''}>Tríceps Corda</option>
                            <option value="Puxada Frontal" ${exercise && exercise.name === 'Puxada Frontal' ? 'selected' : ''}>Puxada Frontal</option>
                            <option value="Remada Curvada" ${exercise && exercise.name === 'Remada Curvada' ? 'selected' : ''}>Remada Curvada</option>
                            <option value="Remada Unilateral" ${exercise && exercise.name === 'Remada Unilateral' ? 'selected' : ''}>Remada Unilateral</option>
                            <option value="Rosca Direta" ${exercise && exercise.name === 'Rosca Direta' ? 'selected' : ''}>Rosca Direta</option>
                            <option value="Agachamento Livre" ${exercise && exercise.name === 'Agachamento Livre' ? 'selected' : ''}>Agachamento Livre</option>
                            <option value="Leg Press" ${exercise && exercise.name === 'Leg Press' ? 'selected' : ''}>Leg Press</option>
                            <option value="Cadeira Extensora" ${exercise && exercise.name === 'Cadeira Extensora' ? 'selected' : ''}>Cadeira Extensora</option>
                            <option value="Cadeira Flexora" ${exercise && exercise.name === 'Cadeira Flexora' ? 'selected' : ''}>Cadeira Flexora</option>
                            <option value="Panturrilha" ${exercise && exercise.name === 'Panturrilha' ? 'selected' : ''}>Panturrilha</option>
                            <option value="Flexão" ${exercise && exercise.name === 'Flexão' ? 'selected' : ''}>Flexão</option>
                            <option value="Outro" ${exercise && exercise.name === 'Outro' ? 'selected' : ''}>Outro</option>
                        </select>
                        <input type="number" placeholder="Series" class="exercise-sets" required min="1" step="1" value="${exercise ? exercise.sets : ''}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="number" placeholder="Reps" class="exercise-reps" required min="1" step="1" value="${exercise ? exercise.reps : ''}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <button type="button" class="btn btn-delete" style="padding: 10px; margin-left: 5px;" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
            container.appendChild(exerciseDiv);
        }

        function addExerciseField() {
            const container = document.getElementById('exercisesContainer');
            const exerciseDiv = document.createElement('div');
            exerciseDiv.className = 'exercise-form';
                exerciseDiv.innerHTML = `
                    <div class="exercise-inputs">
                        <select class="exercise-name" required>
                            <option value="">Selecione o exercício</option>
                            <option value="Supino Reto">Supino Reto</option>
                            <option value="Supino Inclinado">Supino Inclinado</option>
                            <option value="Crucifixo">Crucifixo</option>
                            <option value="Tríceps Testa">Tríceps Testa</option>
                            <option value="Tríceps Corda">Tríceps Corda</option>
                            <option value="Puxada Frontal">Puxada Frontal</option>
                            <option value="Remada Curvada">Remada Curvada</option>
                            <option value="Remada Unilateral">Remada Unilateral</option>
                            <option value="Rosca Direta">Rosca Direta</option>
                            <option value="Agachamento Livre">Agachamento Livre</option>
                            <option value="Leg Press">Leg Press</option>
                            <option value="Cadeira Extensora">Cadeira Extensora</option>
                            <option value="Cadeira Flexora">Cadeira Flexora</option>
                            <option value="Panturrilha">Panturrilha</option>
                            <option value="Flexão">Flexão</option>
                            <option value="Outro">Outro</option>
                        </select>
                        <input type="number" placeholder="Séries" class="exercise-sets" required min="1" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        <input type="number" placeholder="Reps" class="exercise-reps" required min="1" step="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                `;
            container.appendChild(exerciseDiv);
        }

        document.getElementById('workoutForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const name = document.getElementById('workoutName').value;
            const description = document.getElementById('workoutDescription').value;
            const diaSemana = document.getElementById('workoutDiaSemana').value;

            if (!diaSemana) {
                showNotification('Selecione o dia da semana!');
                return;
            }

            const exerciseForms = document.querySelectorAll('.exercise-form');
            const exercises = [];

            exerciseForms.forEach(form => {
                const exerciseNameElem = form.querySelector('.exercise-name');
                const exerciseName = exerciseNameElem.tagName === 'SELECT' ? exerciseNameElem.options[exerciseNameElem.selectedIndex].value : exerciseNameElem.value;
                const sets = form.querySelector('.exercise-sets').value;
                const reps = form.querySelector('.exercise-reps').value;
                if (exerciseName && sets && reps) {
                    exercises.push({
                        name: exerciseName,
                        sets: parseInt(sets),
                        reps: parseInt(reps)
                    });
                }
            });

            if (exercises.length === 0) {
                showNotification('Adicione pelo menos um exercicio ao treino!');
                return;
            }

            try {
                const response = await fetch(`${API_BASE}/criar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        description: description,
                        dia_semana: diaSemana,
                        exercises: exercises
                    })
                });

                const result = await response.json();

                if (result.success) {
                    await loadWorkouts();
                    closeAddWorkoutModal();
                    showNotification('Treino criado com sucesso!');
                } else {
                    showNotification('Erro ao criar treino: ' + result.message);
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao criar treino. Tente novamente.');
            }
        });

        function renderWorkouts() {
            const grid = document.getElementById('workoutsGrid');
            const emptyState = document.getElementById('emptyState');

            if (workouts.length === 0) {
                grid.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            grid.innerHTML = workouts.map((workout, index) => {
                const progress = workout.progress || 0;

                let statusClass = 'status-pending';
                let statusText = 'Pendente';

                if (workout.status === 'completed' || progress === 100) {
                    statusClass = 'status-completed';
                    statusText = 'Concluido';
                } else if (workout.status === 'in-progress' || progress > 0) {
                    statusClass = 'status-in-progress';
                    statusText = 'Em Progresso';
                }

                return `
                    <div class="workout-card" style="animation-delay: ${index * 0.1}s">
                        <div class="workout-header">
                            <div class="workout-name">${workout.name}</div>
                            <div class="workout-status ${statusClass}">${statusText}</div>
                        </div>
                        <div class="workout-description">${workout.description || 'Sem descricao'}</div>

                        <div class="action-buttons top-row">
                            <button class="btn btn-start" onclick="startWorkout('${workout.id}')">
                                <i class="fas fa-play"></i> ${statusText === 'Concluido' ? 'Refazer' : 'Iniciar'}
                            </button>
                            <button class="btn btn-view" onclick="editWorkout('${workout.id}')">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-view" onclick="resetWorkout('${workout.id}')">
                                <i class="fas fa-undo"></i>
                            </button>
                            <button class="btn btn-view" onclick="viewWorkout('${workout.id}')">
                                <i class="fas fa-eye"></i> Ver
                            </button>

                            <button class="btn btn-delete" onclick="deleteWorkout('${workout.id}')">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </div>

                        <div class="progress-section">
                            <div class="progress-label">
                                <span>Progresso</span>
                                <span>${progress}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: ${progress}%"></div>
                            </div>
                        </div>

                        <div style="margin-top: 15px; padding: 10px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; text-align: center; color: #aaa; font-size: 14px;">
                            <i class="fas fa-calendar-alt" style="color: #ff0000; margin-right: 8px;"></i>
                            Dia da semana: <strong style="color: #fff;">${workout.dia_semana || 'Nao definido'}</strong>
                        </div>
                    </div>
                `;
            }).join('');
        }

        async function toggleExercise(workoutId, exerciseId) {
            try {
                const response = await fetch(`${API_BASE}/toggle-exercicio`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_exercicio: exerciseId
                    })
                });

                const result = await response.json();

                if (result.success) {
                    await loadWorkouts();
                    showNotification('Status atualizado!');
                } else {
                    showNotification('Erro ao atualizar exercicio');
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao atualizar exercicio');
            }
        }

        // Cronômetro global
        let cronometroInterval = null;
        let cronometroSegundos = 0;
        let cronometroAtivoId = null;

        async function startWorkout(workoutId) {
            const workout = workouts.find(w => w.id === workoutId);
            if (!workout) return;

            currentWorkoutId = workoutId;
            cronometroAtivoId = workoutId;
            cronometroSegundos = 0;

            if (cronometroInterval) clearInterval(cronometroInterval);

            cronometroInterval = setInterval(() => {
                cronometroSegundos++;
                atualizarCronometroModal();
            }, 1000);

            await viewWorkout(workoutId);
            showNotification('Treino iniciado! Vamos la!');
        }

        function atualizarCronometroModal() {
            const el = document.getElementById('cronometro-modal');
            if (el) {
                const h = String(Math.floor(cronometroSegundos / 3600)).padStart(2, '0');
                const m = String(Math.floor((cronometroSegundos % 3600) / 60)).padStart(2, '0');
                const s = String(cronometroSegundos % 60).padStart(2, '0');
                el.textContent = `${h}:${m}:${s}`;
            }
        }

        async function viewWorkout(workoutId) {
            const workout = workouts.find(w => w.id === workoutId);
            if (!workout) return;

            try {
                const response = await fetch(`${API_BASE}/detalhes?id=${workoutId}`);
                const result = await response.json();

                if (!result.success) {
                    showNotification('Erro ao carregar detalhes do treino');
                    return;
                }

                const exercises = result.exercises || [];
                const content = document.getElementById('workoutDetailsContent');
                let cronometroHtml = '';

                if (cronometroAtivoId === workoutId) {
                    cronometroHtml = `
                        <div style="margin: 20px 0; text-align: center;">
                            <span style="font-size:2rem; color:#ff0000; font-weight:bold;">Tempo do treino:</span><br>
                            <span id="cronometro-modal" style="font-size:2.2rem; margin-top:10px; display:inline-block;">00:00:00</span>
                        </div>
                    `;
                }

                content.innerHTML = `
                    <h2>${workout.name}</h2>
                    <div style="color: #aaa; margin-bottom: 30px;">${workout.description || 'Sem descricao'}</div>
                    ${cronometroHtml}
                    <div class="progress-section">
                        <div class="progress-label">
                            <span>Progresso Geral</span>
                            <span>${workout.progress}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${workout.progress}%"></div>
                        </div>
                    </div>

                    <h3 style="color: #ff0000; margin: 30px 0 20px 0; text-transform: uppercase;">Exercicios</h3>
                    <div class="exercises-list">
                        ${exercises.map((exercise, index) => `
                            <div class="exercise-item ${exercise.completed ? 'completed' : ''}" style="flex-direction: column; align-items: stretch;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <div class="exercise-info">
                                        <div class="exercise-name" style="font-size: 18px;">${index + 1}. ${exercise.name}</div>
                                        <div class="exercise-details" style="font-size: 14px; margin-top: 5px;">
                                            <i class="fas fa-dumbbell" style="color: #ff0000;"></i> ${exercise.sets} series × ${exercise.reps} repeticoes
                                        </div>
                                    </div>
                                    <input type="checkbox"
                                           class="exercise-checkbox"
                                           ${exercise.completed ? 'checked' : ''}
                                           onchange="toggleExercise('${workoutId}', ${exercise.id}); setTimeout(() => viewWorkout('${workoutId}'), 500)">
                                </div>

                                <div class="gif-viewer">
                                    <button class="btn btn-view" style="width: 100%;" onclick="showExerciseGif('${exercise.name}', '${workoutId}')">
                                        <i class="fas fa-play-circle"></i> Ver Demonstracao
                                    </button>
                                    <div id="gif-${exercise.name.replace(/\s/g, '-')}" class="gif-container" style="display: none;">
                                        <img src="${getExerciseGif(exercise.name)}" alt="${exercise.name}">
                                        <p style="color: #aaa; margin-top: 10px; font-size: 12px;">Demonstracao: ${exercise.name}</p>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>

                    <div style="margin-top: 30px; padding: 20px; background: rgba(255, 0, 0, 0.05); border-radius: 15px; border: 1px solid rgba(255, 0, 0, 0.2);">
                        <h4 style="color: #ff0000; margin-bottom: 15px; text-transform: uppercase;">
                            <i class="fas fa-info-circle"></i> Dicas para o Treino
                        </h4>
                        <ul style="color: #aaa; line-height: 2; list-style: none; padding: 0;">
                            <li><i class="fas fa-check" style="color: #ff0000; margin-right: 10px;"></i> Mantenha boa postura durante os exercicios</li>
                            <li><i class="fas fa-check" style="color: #ff0000; margin-right: 10px;"></i> Controle a respiracao: expire na forca</li>
                            <li><i class="fas fa-check" style="color: #ff0000; margin-right: 10px;"></i> Descanse 60-90 segundos entre as series</li>
                            <li><i class="fas fa-check" style="color: #ff0000; margin-right: 10px;"></i> Hidrate-se durante o treino</li>
                        </ul>
                    </div>

                    ${workout.status === 'completed' || workout.progress === 100 ? `
                        <div style="margin-top: 30px; text-align: center; padding: 30px; background: linear-gradient(45deg, rgba(0, 255, 0, 0.1), rgba(0, 200, 0, 0.1)); border-radius: 15px; border: 2px solid #00ff00;">
                            <i class="fas fa-trophy" style="font-size: 48px; color: #00ff00; margin-bottom: 15px;"></i>
                            <h3 style="color: #00ff00; margin-bottom: 10px;">TREINO CONCLUIDO!</h3>
                            <p style="color: #aaa;">Excelente trabalho! Continue assim!</p>
                        </div>
                    ` : ''}

                    <button class="btn btn-start" style="width: 100%; margin-top: 20px;" onclick="closeViewWorkoutModal()">
                        <i class="fas fa-check"></i> Fechar
                    </button>
                `;

                document.getElementById('viewWorkoutModal').classList.add('active');
                atualizarCronometroModal();
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao carregar detalhes do treino');
            }
        }

        function showExerciseGif(exerciseName, workoutId) {
            const gifId = 'gif-' + exerciseName.replace(/\s/g, '-');
            const gifContainer = document.getElementById(gifId);

            if (gifContainer) {
                if (gifContainer.style.display === 'none') {
                    gifContainer.style.display = 'block';
                    gifContainer.style.animation = 'fadeIn 0.5s ease';
                } else {
                    gifContainer.style.display = 'none';
                }
            }
        }

        function closeViewWorkoutModal() {
            document.getElementById('viewWorkoutModal').classList.remove('active');
            if (cronometroInterval) {
                clearInterval(cronometroInterval);
                cronometroInterval = null;
                cronometroAtivoId = null;
            }
        }

        async function deleteWorkout(workoutId) {
            currentWorkoutId = workoutId;
            document.getElementById('deleteConfirmModal').classList.add('active');
        }

        function hideDeleteConfirm() {
            document.getElementById('deleteConfirmModal').classList.remove('active');
            currentWorkoutId = null;
        }

        async function confirmDelete() {
            if (!currentWorkoutId) return;

            try {
                const response = await fetch(`${API_BASE}/deletar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        grupo_treino: currentWorkoutId
                    })
                });

                const result = await response.json();

                if (result.success) {
                    await loadWorkouts();
                    hideDeleteConfirm();
                    showNotification('Treino excluido com sucesso!');
                } else {
                    showNotification('Erro ao excluir treino');
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao excluir treino');
            }
        }

        async function resetWorkout(workoutId) {
            if (!confirm('Deseja reiniciar este treino? Todos os exercicios serao marcados como nao concluidos.')) {
                return;
            }

            try {
                const response = await fetch(`${API_BASE}/resetar`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        grupo_treino: workoutId
                    })
                });

                const result = await response.json();

                if (result.success) {
                    if (cronometroAtivoId === workoutId) {
                        if (cronometroInterval) {
                            clearInterval(cronometroInterval);
                            cronometroInterval = null;
                        }
                        cronometroAtivoId = null;
                        cronometroSegundos = 0;
                    }

                    await loadWorkouts();
                    showNotification('Treino reiniciado com sucesso!');
                } else {
                    showNotification('Erro ao reiniciar treino');
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao reiniciar treino');
            }
        }

        function showNotification(message) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Carregar treinos ao inicializar a pagina
        window.addEventListener('load', () => {
            loadWorkouts();
        });

        // Fechar modais ao clicar fora
        window.addEventListener('click', (e) => {
            const addModal = document.getElementById('addWorkoutModal');
            const viewModal = document.getElementById('viewWorkoutModal');
            const editModal = document.getElementById('editWorkoutModal');

            if (e.target === addModal) {
                closeAddWorkoutModal();
            }
            if (e.target === viewModal) {
                closeViewWorkoutModal();
            }
            if (e.target === editModal) {
                closeEditWorkoutModal();
            }
        });

        // Atalhos de teclado
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeAddWorkoutModal();
                closeViewWorkoutModal();
                closeEditWorkoutModal();
            }
        });

        // Efeito de partículas ao concluir exercício
        function createParticleEffect(x, y) {
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.style.cssText = `
                    position: fixed;
                    width: 6px;
                    height: 6px;
                    background: #ff0000;
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    left: ${x}px;
                    top: ${y}px;
                `;

                document.body.appendChild(particle);

                const angle = (Math.PI * 2 * i) / 20;
                const velocity = 2 + Math.random() * 2;
                const dx = Math.cos(angle) * velocity;
                const dy = Math.sin(angle) * velocity;

                let posX = x;
                let posY = y;
                let opacity = 1;

                const animate = () => {
                    posX += dx;
                    posY += dy;
                    opacity -= 0.02;

                    particle.style.left = posX + 'px';
                    particle.style.top = posY + 'px';
                    particle.style.opacity = opacity;

                    if (opacity > 0) {
                        requestAnimationFrame(animate);
                    } else {
                        particle.remove();
                    }
                };

                animate();
            }
        }

        // Adicionar efeito de partículas ao marcar exercício
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('exercise-checkbox') && e.target.checked) {
                const rect = e.target.getBoundingClientRect();
                createParticleEffect(rect.left + rect.width / 2, rect.top + rect.height / 2);
            }
        });

         // Navbar interativa
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.main-menu li a').forEach(link => {
                link.addEventListener('click', function () {
                    document.querySelectorAll('.main-menu li a').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
