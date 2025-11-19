<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Atualizar Perfil</title>
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

        .update-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .update-header {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(133, 21, 21, 0.37);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            animation: slideIn 0.8s ease-out;
            text-align: center;
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

        .update-header h1 {
            color: #fff;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .update-header h1 i {
            color: #FF1F1F;
        }

        .update-header p {
            color: #999;
            font-size: 1.1rem;
        }

        .form-card {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(111, 22, 22, 0.37);
            border-radius: 24px;
            padding: 2.5rem;
            animation: slideIn 0.8s ease-out 0.2s backwards;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            color: #FF1F1F;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(255, 31, 31, 0.3);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: #ccc;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: block;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem;
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

        .form-input::placeholder {
            color: #666;
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .password-hint {
            color: #666;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            font-style: italic;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 31, 31, 0.2);
        }

        .btn {
            padding: 1.2rem 2.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            flex: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF1F1F, #cc0000);
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
            box-shadow: 0 10px 25px rgba(255, 31, 31, 0.4);
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
            transform: translateY(-2px);
        }

        .success-message {
            background: rgba(68, 255, 68, 0.1);
            border: 2px solid rgba(68, 255, 68, 0.3);
            color: #44ff44;
            padding: 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.5s ease-out;
            font-weight: 500;
        }

        .error-message {
            background: rgba(255, 68, 68, 0.1);
            border: 2px solid rgba(255, 68, 68, 0.3);
            color: #ff4444;
            padding: 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.5s ease-out;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }

            .update-container {
                padding: 1rem;
            }

            .update-header h1 {
                font-size: 1.8rem;
            }

            .input-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="main-menu">
        <div class="logo-container">
            <a href="/sharkrush/dashboard" title="Dashboard">
                <img src="../midia/Logos/logoshark.png" alt="Logo"/>
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

    <!-- Background animado -->
    <div class="animated-bg">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Container principal -->
    <div class="update-container">
        <!-- Header -->
        <div class="update-header">
            <h1>
                <i class="fas fa-user-edit"></i>
                Atualizar Cadastro
            </h1>
            <p>Mantenha suas informações sempre atualizadas</p>
        </div>

        <!-- Mensagens PHP -->
        <?php if (isset($_GET["success"])): ?>
            <div class="success-message">
                <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>
                <span>Perfil atualizado com sucesso!</span>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET["error"])): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle" style="font-size: 1.5rem;"></i>
                <span>
                    <?php 
                    if ($_GET["error"] === "email_ja_existe") {
                        echo "Este e-mail já está em uso por outro usuário.";
                    } elseif ($_GET["error"] === "falha_atualizacao") {
                        echo "Erro ao atualizar perfil. Tente novamente.";
                    } else {
                        echo "Ocorreu um erro. Tente novamente.";
                    }
                    ?>
                </span>
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <div class="form-card">
            <form action="/update-clientes" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($clientesInfo['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                <!-- Seção: Dados Pessoais -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-user-circle"></i>
                        Dados Pessoais
                    </h2>

                    <div class="form-group">
                        <label for="nome_completo" class="form-label">Nome Completo</label>
                        <input 
                            type="text" 
                            id="nome_completo" 
                            name="nome_completo" 
                            class="form-input"
                            value="<?php echo htmlspecialchars($clientesInfo['nome_completo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                            placeholder="Digite seu nome completo"
                            required
                        >
                    </div>

                    <div class="input-row">
                        <div class="form-group">
                            <label for="cpf" class="form-label">CPF</label>
                            <input 
                                type="text" 
                                id="cpf" 
                                name="cpf" 
                                class="form-input"
                                value="<?php echo htmlspecialchars($clientesInfo['cpf'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                                placeholder="000.000.000-00"
                                maxlength="14"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input 
                                type="text" 
                                id="telefone" 
                                name="telefone" 
                                class="form-input"
                                value="<?php echo htmlspecialchars($clientesInfo['telefone'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                                placeholder="(00) 00000-0000"
                                maxlength="15"
                            >
                        </div>
                    </div>
                </div>

                <!-- Seção: Endereço -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Endereço
                    </h2>

                    <div class="form-group">
                        <label for="endereco" class="form-label">Endereço Completo</label>
                        <input 
                            type="text" 
                            id="endereco" 
                            name="endereco" 
                            class="form-input"
                            value="<?php echo htmlspecialchars($clientesInfo['endereco'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                            placeholder="Rua, número, bairro, cidade - estado"
                            required
                        >
                    </div>
                </div>

                <!-- Seção: Acesso -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-envelope"></i>
                        Dados de Acesso
                    </h2>

                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input"
                            value="<?php echo htmlspecialchars($clientesInfo['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                            placeholder="seu@email.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="senha" class="form-label">Nova Senha</label>
                        <input 
                            type="password" 
                            id="senha" 
                            name="senha" 
                            class="form-input"
                            placeholder="Digite uma nova senha ou deixe vazio"
                            minlength="8"
                        >
                        <p class="password-hint">
                            <i class="fas fa-info-circle"></i>
                            Deixe em branco para manter a senha atual. Mínimo de 8 caracteres.
                        </p>
                    </div>
                </div>

                <!-- Botões de ação -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='/list-clientes'">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Atualizar Cadastro
                    </button>
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

        // Máscara para CPF
        function maskCPF(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            e.target.value = value;
        }

        // Máscara para telefone
        function maskPhone(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            }
            e.target.value = value;
        }

        // Validação de senha
        function validatePassword() {
            const senha = document.getElementById('senha').value;
            if (senha && senha.length < 8) {
                alert('A senha deve ter pelo menos 8 caracteres.');
                return false;
            }
            return true;
        }

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();

            // Aplicar máscaras
            const cpfInput = document.getElementById('cpf');
            const phoneInput = document.getElementById('telefone');

            if (cpfInput) {
                cpfInput.addEventListener('input', maskCPF);
            }

            if (phoneInput) {
                phoneInput.addEventListener('input', maskPhone);
            }

            // Validação do formulário
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                if (!validatePassword()) {
                    e.preventDefault();
                }
            });

            // Remover mensagens após 5 segundos
            setTimeout(() => {
                const messages = document.querySelectorAll('.success-message, .error-message');
                messages.forEach(msg => {
                    msg.style.animation = 'slideOut 0.5s ease-out forwards';
                    setTimeout(() => msg.remove(), 500);
                });
            }, 5000);
        });

        // Animação de saída
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>