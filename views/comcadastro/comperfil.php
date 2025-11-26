<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Meu Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at center, #1a0000 0%, #000000 100%);
            min-height: 100vh;
            padding-left: 70px;
            overflow-x: hidden;
        }

        /* Fundo animado */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: #FF1F1F;
            border-radius: 50%;
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .wave {
            position: absolute;
            left: 0;
            width: 100vw;
            height: 120px;
            background: linear-gradient(90deg, transparent, rgba(255, 31, 31, 0.07), transparent);
            opacity: 0.7;
            animation: wave 12s linear infinite;
        }

        .wave:nth-child(1) { top: 20%; animation-delay: 0s; }
        .wave:nth-child(2) { top: 40%; animation-delay: -4s; }
        .wave:nth-child(3) { top: 60%; animation-delay: -8s; }

        @keyframes wave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Container principal */
        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Header do perfil */
        .profile-header {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(133, 21, 21, 0.37);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            animation: slideIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 31, 31, 0.1), transparent);
            animation: rotate 10s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .profile-header-treinos {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 180px;
            padding: 0 1.5rem;
        }
        .profile-header-treinos .stat-value {
            font-size: 2.7rem;
            font-weight: bold;
            color: #FF1F1F;
            line-height: 1.1;
            text-align: center;
        }
        .profile-header-treinos .stat-label {
            color: #fff;
            font-size: 1.1rem;
            margin-top: 0.2rem;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .profile-avatar {
            position: relative;
        }

        .avatar-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255, 31, 31, 0.2), rgba(255, 31, 31, 0.05));
            border: 3px solid rgba(255, 31, 31, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            animation: pulse 2s ease-in-out infinite;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-container:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 31, 31, 0.5);
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 31, 31, 0.3); }
            50% { box-shadow: 0 0 30px rgba(255, 31, 31, 0.5); }
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-container i {
            font-size: 3rem;
            color: #FF1F1F;
        }

        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            background: linear-gradient(135deg, #FF1F1F, #cc0000);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #000;
        }

        .avatar-upload:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 31, 31, 0.6);
        }

        .avatar-upload i {
            font-size: 0.9rem;
            color: white;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: #ccc;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .profile-stats {
            display: flex;
            gap: 2rem;
            justify-content: center;
            margin-top: 0.5rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #FF1F1F;
            line-height: 1.2;
        }

        .stat-label {
            color: #999;
            font-size: 0.9rem;
            margin-top: 0.25rem;
        }

        /* Seções do perfil */
        .profile-sections-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        .profile-section-group > .profile-section + .profile-section {
            margin-top: 2rem;
        }

        .profile-section {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(111, 22, 22, 0.37);
            border-radius: 24px;
            padding: 2rem;
            animation: slideIn 0.8s ease-out;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 31, 31, 0.2);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #FF1F1F;
        }

        .edit-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 31, 31, 0.3);
            color: #FF1F1F;
            padding: 0.5rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-btn:hover {
            background: rgba(255, 31, 31, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 31, 31, 0.3);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            color: #ccc;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 31, 31, 0.3);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #FF1F1F;
            box-shadow: 0 0 20px rgba(255, 31, 31, 0.3);
            background: rgba(255, 255, 255, 0.1);
        }

        .form-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .form-input::placeholder {
            color: #666;
        }

        .input-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1f1f1fff, #1c1c1cff);
            color: white;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(63, 63, 63, 0.95);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: #ccc;
            border: 2px solid rgba(255, 31, 31, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 31, 31, 0.1);
            color: #fff;
            border-color: #FF1F1F;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .action-buttons .btn {
            flex: 1;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 12px;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(5px);
        }

        .info-label {
            color: #999;
            font-size: 0.9rem;
        }

        .info-value {
            color: #fff;
            font-weight: 500;
        }

        .success-message {
            background: rgba(68, 255, 68, 0.1);
            border: 1px solid rgba(68, 255, 68, 0.3);
            color: #44ff44;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        .success-message.show {
            display: block;
        }

        .error-message {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        .error-message.show {
            display: block;
        }

        /* NAVBAR */
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
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .main-menu li a.active::before {
            transform: scaleY(1);
        }

        .main-menu li a.active .nav-icon {
            transform: scale(1.15);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .profile-sections-columns {
                grid-template-columns: 1fr;
            }
            .profile-section-group > .profile-section + .profile-section {
                margin-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }

            .profile-container {
                padding: 1rem;
            }

            .profile-top {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                justify-content: center;
            }

            .input-group {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->

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
            <a href="<?= BASE_URL ?>/biblioteca">
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
            <a href="<?= BASE_URL ?>/perfil" class="active">
                <i class="fa fa-user nav-icon"></i>
                <span class="nav-text">Perfil</span>
            </a>
            </li>
        </ul>
    </nav>

    <!-- Background animado -->
    <div class="animated-bg">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Container principal -->
    <div class="profile-container">
        <?php if (isset($_GET["success"])): ?>
            <div class="success-message show" style="margin-bottom: 2rem;">
                <i class="fas fa-check-circle"></i>
                <?php if ($_GET["success"] === "atualizado") {
                  echo "Perfil atualizado com sucesso!";
                } elseif ($_GET["success"] === "senha_alterada") {
                  echo "Senha alterada com sucesso!";
                } ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET["error"])): ?>
            <div class="error-message show" style="margin-bottom: 2rem;">
                <i class="fas fa-exclamation-circle"></i>
                <?php if ($_GET["error"] === "email_ja_existe") {
                  echo "Este e-mail já está em uso por outro usuário.";
                } elseif ($_GET["error"] === "falha_atualizacao") {
                  echo "Erro ao atualizar perfil. Tente novamente.";
                } elseif ($_GET["error"] === "senha_incorreta") {
                  echo "Senha atual incorreta.";
                } elseif ($_GET["error"] === "senhas_nao_conferem") {
                  echo "As senhas não conferem.";
                } elseif ($_GET["error"] === "senha_curta") {
                  echo "A senha deve ter pelo menos 8 caracteres.";
                } elseif ($_GET["error"] === "campos_vazios") {
                  echo "Por favor, preencha todos os campos.";
                } ?>
            </div>
        <?php endif; ?>

        <!-- Header do perfil -->
        <div class="profile-header">
            <div class="profile-top" style="display: flex; align-items: center; justify-content: flex-start; gap: 2rem; margin-bottom: 2rem; position: relative;">
                <div class="profile-avatar">
                    <div class="avatar-container" id="avatarContainer">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="avatar-upload" onclick="document.getElementById('avatarInput').click()">
                        <i class="fas fa-camera"></i>
                    </div>
                    <input type="file" id="avatarInput" accept="image/*" style="display: none;">
                </div>
                <div class="profile-info">
                    <h1 class="profile-name" id="displayName"><?php echo htmlspecialchars($userData["nome_completo"] ?? "", ENT_QUOTES, "UTF-8"); ?></h1>
                    <p class="profile-email" id="displayEmail"><?php echo htmlspecialchars($userData["email"] ?? "", ENT_QUOTES, "UTF-8"); ?></p>
                </div>
                <div class="profile-header-treinos" style="margin-left: auto; margin-right: 1.5rem;">
                    <div class="stat-value"><?php echo htmlspecialchars($userData["total_treinos"] ?? 0); ?></div>
                    <div class="stat-label">Treinos Realizados</div>
                </div>
                <button class="btn btn-secondary" style="padding: 1.2rem 2.5rem; font-size: 1.1rem; border-radius: 12px;" onclick="window.location.href='/SHARKRUSH/logout'">
                    <i class="fas fa-sign-out-alt" style="margin-right: 0.7rem; font-size: 1.5rem;"></i> Sair
                </button>
            </div>
        </div>

        <!-- Seções do perfil -->
        <div class="profile-sections-columns">
            <div class="profile-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Informações Pessoais
                    </h2>
                    <button class="edit-btn" onclick="toggleEdit('personal')">
                        <i class="fas fa-edit"></i>
                        <span id="editPersonalText">Editar</span>
                    </button>
                </div>
                <div id="successPersonal" class="success-message">
                    <i class="fas fa-check-circle"></i> Informações atualizadas com sucesso!
                </div>
                <form id="personalForm">
                    <div class="form-group">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-input" id="fullName" value="<?php echo htmlspecialchars($userData["nome_completo"] ?? "", ENT_QUOTES, "UTF-8"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">CPF</label>
                        <input type="text" class="form-input" id="cpf" value="<?php echo htmlspecialchars($userData["cpf"] ?? "", ENT_QUOTES, "UTF-8"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Endereco</label>
                        <input type="text" class="form-input" id="endereco" value="<?php echo htmlspecialchars($userData["endereco"] ?? "", ENT_QUOTES, "UTF-8"); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Telefone</label>
                        <input type="tel" class="form-input" id="phone" value="<?php echo htmlspecialchars($userData["telefone"] ?? "", ENT_QUOTES, "UTF-8"); ?>" disabled>
                    </div>
                    <div class="action-buttons" id="personalButtons" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit('personal')">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="savePersonal()">Salvar Alterações</button>
                    </div>
                </form>
            </div>
            <div class="profile-section-group">
                <div class="profile-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-envelope"></i>
                            Dados da Conta
                        </h2>
                        <button class="edit-btn" onclick="toggleEdit('account')">
                            <i class="fas fa-edit"></i>
                            <span id="editAccountText">Editar</span>
                        </button>
                    </div>
                    <div id="successAccount" class="success-message">
                        <i class="fas fa-check-circle"></i> Dados da conta atualizados!
                    </div>
                    <form id="accountForm">
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-input" id="email" value="<?php echo htmlspecialchars($userData["email"] ?? "", ENT_QUOTES, "UTF-8"); ?>" disabled>
                        </div>
                        <div class="action-buttons" id="accountButtons" style="display: none;">
                            <button type="button" class="btn btn-secondary" onclick="cancelEdit('account')">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="saveAccount()">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
                <div class="profile-section">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-shield-alt"></i>
                            Segurança
                        </h2>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Senha</span>
                        <span class="info-value">••••••••</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Última Alteração</span>
                        <span class="info-value">15/03/2024</span>
                    </div>
                    <div class="action-buttons" style="margin-top: 1.5rem;">
                        <button type="button" class="btn btn-primary" onclick="changePassword()">
                            <i class="fas fa-key"></i> Alterar Senha
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alterar Senha -->
    <div id="passwordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 2000; justify-content: center; align-items: center;">
        <div style="background: rgba(30, 30, 30, 0.95); backdrop-filter: blur(24px); border: 1.5px solid rgba(255, 255, 255, 0.18); border-radius: 24px; padding: 2rem; max-width: 500px; width: 90%; position: relative;">
            <button onclick="closePasswordModal()" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; color: #FF1F1F; font-size: 1.5rem; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-times"></i>
            </button>

            <h2 style="color: #fff; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-key" style="color: #FF1F1F;"></i>
                Alterar Senha
            </h2>

            <div id="successPassword" class="success-message">
                <i class="fas fa-check-circle"></i> Senha alterada com sucesso!
            </div>

            <div id="errorPassword" class="error-message">
                <i class="fas fa-exclamation-circle"></i> <span id="errorPasswordText">Erro ao alterar senha.</span>
            </div>

            <form id="passwordChangeForm">
                <div class="form-group">
                    <label class="form-label">Senha Atual</label>
                    <input type="password" class="form-input" id="currentPassword" placeholder="Digite sua senha atual" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nova Senha</label>
                    <input type="password" class="form-input" id="newPassword" placeholder="Digite sua nova senha" required>
                    <div class="password-strength" style="margin-top: 0.5rem; height: 4px; background: rgba(255, 255, 255, 0.1); border-radius: 2px; overflow: hidden;">
                        <div class="password-strength-bar" id="strengthBar" style="height: 100%; width: 0%; transition: all 0.3s ease; border-radius: 2px;"></div>
                    </div>
                    <div class="password-strength-text" id="strengthText" style="font-size: 0.8rem; margin-top: 0.5rem; text-align: right;"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmar Nova Senha</label>
                    <input type="password" class="form-input" id="confirmNewPassword" placeholder="Confirme sua nova senha" required>
                </div>
                <div class="action-buttons" style="margin-top: 1.5rem;">
                    <button type="button" class="btn btn-secondary" onclick="closePasswordModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar Alteração</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Criar partículas de fundo
        function createParticles() {
            const container = document.querySelector('.animated-bg');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 8) + 's';
                container.appendChild(particle);
            }
        }

        // Armazenar valores originais
        const originalValues = {};

        // Alternar modo de edição
        function toggleEdit(section) {
            const inputs = document.querySelectorAll(`#${section}Form input, #${section}Form select`);
            const buttons = document.getElementById(`${section}Buttons`);
            // Corrigir para pegar o id correto, que está em PascalCase no HTML
            let editText = null;
            if(section === 'personal') {
                editText = document.getElementById('editPersonalText');
            } else if(section === 'account') {
                editText = document.getElementById('editAccountText');
            } else {
                editText = document.getElementById(`edit${section.charAt(0).toUpperCase() + section.slice(1)}Text`);
            }
            const isEditing = !inputs[0].disabled;

            if (isEditing) {
                cancelEdit(section);
            } else {
                // Salvar valores originais
                inputs.forEach(input => {
                    originalValues[input.id] = input.value;
                });

                inputs.forEach(input => input.disabled = false);
                buttons.style.display = 'flex';
                editText.textContent = 'Cancelar';
            }
        }

        // Cancelar edição
        function cancelEdit(section) {
            const inputs = document.querySelectorAll(`#${section}Form input, #${section}Form select`);
            const buttons = document.getElementById(`${section}Buttons`);
            let editText = null;
            if(section === 'personal') {
                editText = document.getElementById('editPersonalText');
            } else if(section === 'account') {
                editText = document.getElementById('editAccountText');
            } else {
                editText = document.getElementById(`edit${section.charAt(0).toUpperCase() + section.slice(1)}Text`);
            }

            // Restaurar valores originais
            inputs.forEach(input => {
                if (originalValues[input.id]) {
                    input.value = originalValues[input.id];
                }
                input.disabled = true;
            });

            buttons.style.display = 'none';
            editText.textContent = 'Editar';
        }

        // Mostrar mensagem de sucesso
        function showSuccess(section) {
            const successMsg = document.getElementById(`success${section.charAt(0).toUpperCase() + section.slice(1)}`);
            successMsg.classList.add('show');
            setTimeout(() => {
                successMsg.classList.remove('show');
            }, 3000);
        }

        // Salvar informações pessoais
        function savePersonal() {
            const fullName = document.getElementById('fullName').value;
            const cpf = document.getElementById('cpf').value;
            const endereco = document.getElementById('endereco').value;
            const phone = document.getElementById('phone').value;

            if (!fullName || !phone) {
                alert('Por favor, preencha pelo menos o nome e telefone.');
                return;
            }

            // Atualiza o topo do perfil (nome e email)
            document.getElementById('displayName').textContent = fullName;
            // Atualiza o email se o campo de email existir no formulário de informações pessoais
            var emailField = document.getElementById('email');
            if (emailField) {
                document.getElementById('displayEmail').textContent = emailField.value;
            }

            // Simulação frontend: desabilita campos e mostra mensagem de sucesso
            const inputs = document.querySelectorAll('#personalForm input');
            inputs.forEach(input => input.disabled = true);
            document.getElementById('personalButtons').style.display = 'none';
            document.getElementById('editPersonalText').textContent = 'Editar';
            showSuccess('personal');
        }

        // Salvar dados da conta
        function saveAccount() {
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Por favor, preencha o e-mail.');
                return;
            }

            // Validar email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, insira um e-mail válido.');
                return;
            }

            // Simulação frontend: desabilita campos e mostra mensagem de sucesso
            const inputs = document.querySelectorAll('#accountForm input');
            inputs.forEach(input => input.disabled = true);
            document.getElementById('accountButtons').style.display = 'none';
            document.getElementById('editAccountText').textContent = 'Editar';
            showSuccess('account');
        }

        // Salvar dados físicos
        function savePhysical() {
            // Simulação frontend para dados físicos (se houver)
            const inputs = document.querySelectorAll('#physicalForm input');
            inputs.forEach(input => input.disabled = true);
            document.getElementById('physicalButtons').style.display = 'none';
            document.getElementById('editPhysicalText').textContent = 'Editar';
            showSuccess('physical');
        }
        // Simular edição de segurança (senha)
        function saveSecurity() {
            // Apenas simula a alteração de senha
            document.getElementById('passwordModal').style.display = 'none';
            document.getElementById('successPassword').classList.add('show');
            setTimeout(() => {
                document.getElementById('successPassword').classList.remove('show');
            }, 2000);
        }

        // Alterar avatar
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const avatarContainer = document.getElementById('avatarContainer');
                    avatarContainer.innerHTML = `<img src="${event.target.result}" alt="Avatar">`;
                    // Aqui você faria upload para o servidor
                    console.log('Uploading avatar...');
                };
                reader.readAsDataURL(file);
            }
        });

        // Modal de senha
        function changePassword() {
            document.getElementById('passwordModal').style.display = 'flex';
            document.getElementById('currentPassword').value = '';
            document.getElementById('newPassword').value = '';
            document.getElementById('confirmNewPassword').value = '';
            document.getElementById('strengthBar').style.width = '0%';
            document.getElementById('strengthText').textContent = '';
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').style.display = 'none';
            document.getElementById('successPassword').classList.remove('show');
            document.getElementById('errorPassword').classList.remove('show');
        }

        // Validar força da senha
        document.getElementById('newPassword').addEventListener('input', function() {
            const password = this.value;
            const bar = document.getElementById('strengthBar');
            const text = document.getElementById('strengthText');

            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            const percent = (score / 5) * 100;
            bar.style.width = percent + '%';

            if (score <= 2) {
                bar.style.background = '#ff4444';
                text.style.color = '#ff4444';
                text.textContent = 'Senha fraca';
            } else if (score === 3 || score === 4) {
                bar.style.background = '#FF1F1F';
                text.style.color = '#FF1F1F';
                text.textContent = 'Senha média';
            } else {
                bar.style.background = '#44ff44';
                text.style.color = '#44ff44';
                text.textContent = 'Senha forte';
            }
        });

        // Submeter alteração de senha
        document.getElementById('passwordChangeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Simulação frontend: apenas mostra mensagem de sucesso
            saveSecurity();
        });

        // Navegação ativa
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();

            document.querySelectorAll('.main-menu li a').forEach(link => {
                link.addEventListener('click', function() {
                    document.querySelectorAll('.main-menu li a').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
