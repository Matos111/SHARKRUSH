<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Login</title>
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
            background: radial-gradient(ellipse at center, #1a0000 0%, #000000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Fundo animado com partículas */
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

        /* Ondas de fundo */
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
        .login-container {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            -webkit-backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37), 0 0 0 2px rgba(255,31,31,0.12);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            animation: slideIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-container::before {
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

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Logo e título */
        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: #FF1F1F;
            text-shadow: 0 0 20px rgba(255, 31, 31, 0.5);
            margin-bottom: 0.5rem;
            animation: pulse 2s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            from { text-shadow: 0 0 20px rgba(255, 31, 31, 0.5); }
            to { text-shadow: 0 0 30px rgba(255, 31, 31, 0.8); }
        }

        .subtitle {
            color: #ccc;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .tagline {
            color: #888;
            font-size: 0.9rem;
        }

        /* Formulário */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
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
            color: #888;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #FF1F1F;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: #fff;
            transform: translateY(-50%) scale(1.1);
        }

        /* Opções extras */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .remember-me:hover {
            color: #FF1F1F;
        }

        .remember-me input[type="checkbox"] {
            accent-color: #FF1F1F;
        }

        .forgot-password {
            color: #FF1F1F;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            text-shadow: 0 0 10px rgba(255, 31, 31, 0.8);
        }

        /* Botão de login */
        .login-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #FF1F1F, #cc0000);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 31, 31, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* Divisor */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 31, 31, 0.5), transparent);
        }

        .divider span {
            color: #888;
            font-size: 0.9rem;
        }

        /* Registro */
        .register-link {
            text-align: center;
            color: #ccc;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #FF1F1F;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            text-shadow: 0 0 10px rgba(255, 31, 31, 0.8);
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .login-container {
                margin: 1rem;
                padding: 2rem;
                max-width: none;
            }

            .logo {
                font-size: 2rem;
            }

            .form-input {
                padding: 0.8rem 0.8rem 0.8rem 2.5rem;
            }

            .input-icon {
                left: 0.8rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .logo {
                font-size: 1.8rem;
            }

            .form-options {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        /* Estados de validação */
        .form-input.error {
            border-color: #ff4444;
            box-shadow: 0 0 10px rgba(255, 68, 68, 0.3);
        }

        .form-input.success {
            border-color: #44ff44;
            box-shadow: 0 0 10px rgba(68, 255, 68, 0.3);
        }

        .error-message {
            color: #ff4444;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading state */
        .login-btn.loading {
            background: #666;
            cursor: not-allowed;
        }

        .login-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="animated-bg">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <div class="login-container">
        <div class="logo-section">
            <div class="logo">SHARKRUSH</div>
            <div class="subtitle">Bem-vindo de volta!</div>
            <div class="tagline">Seus treinos te esperam</div>
        </div>

        <?php
        // Exibir mensagens de erro
        $erro = "";
        if (isset($_GET["error"])) {
          switch ($_GET["error"]) {
            case "email_invalido":
              $erro = "Por favor, insira um e-mail válido.";
              break;
            case "senha_vazia":
              $erro = "Por favor, insira sua senha.";
              break;
            case "credenciais_invalidas":
              $erro = "E-mail ou senha incorretos.";
              break;
            case "acesso_negado":
              $erro = "Você precisa fazer login para acessar esta página.";
              break;
          }
        }

        // Exibir mensagem de sucesso
        $sucesso = "";
        if (isset($_GET["success"])) {
          if ($_GET["success"] == "cadastro") {
            $sucesso = "Cadastro realizado com sucesso! Faça login para continuar.";
          } elseif ($_GET["success"] == "senha_alterada") {
            $sucesso = "Senha alterada com sucesso! Faça login com sua nova senha.";
          }
        }
        ?>

        <?php if ($erro): ?>
        <div style="background: rgba(255, 68, 68, 0.2); border: 1px solid rgba(255, 68, 68, 0.5); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem; color: #ff4444; text-align: center;">
            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($erro); ?>
        </div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
        <div style="background: rgba(68, 255, 68, 0.2); border: 1px solid rgba(68, 255, 68, 0.5); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem; color: #44ff44; text-align: center;">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($sucesso); ?>
        </div>
        <?php endif; ?>

        <form class="login-form" id="loginForm" method="POST" action="<?= BASE_URL ?>/authenticate">
            <div class="form-group">
                <input type="email" class="form-input" id="email" name="email" placeholder="Digite seu e-mail" required>
                <div class="input-icon">📧</div>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" id="password" name="senha" placeholder="Digite sua senha" required>
                <div class="input-icon">🔒</div>
                <div class="error-message" id="passwordError"></div>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" id="rememberMe">
                    Lembrar de mim
                </label>
                <a href="../semcadastro/semrecuperarsenha.php" class="forgot-password">Esqueceu a senha?</a>
            </div>

            <button type="submit" class="login-btn" id="loginBtn">
                <span>ENTRAR</span>
            </button>
        </form>

        <div class="divider">
            <span>ou</span>
        </div>

        <div class="register-link">
            Não tem uma conta? <a href="<?= BASE_URL ?>/cadastro">Cadastre-se aqui</a>
        </div>
    </div>

    <script>
        // Criar partículas animadas
        function createParticles() {
            const animatedBg = document.querySelector('.animated-bg');
            const particleCount = 40; // aumente para mais partículas
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 3 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                // Evitar partículas sobre o centro do formulário
                let left = Math.random() * 100;
                let top = Math.random() * 100;
                if (left > 35 && left < 65 && top > 35 && top < 65) {
                    left = left < 50 ? 30 : 70;
                    top = top < 50 ? 30 : 70;
                }
                particle.style.left = `${left}%`;
                particle.style.top = `${top}%`;
                particle.style.animationDelay = `${Math.random() * 8}s`;
                particle.style.animationDuration = `${8 + Math.random() * 4}s`;
                animatedBg.appendChild(particle);
            }
        }

        // Validação de email
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Validação de senha
        function validatePassword(password) {
            return password.length >= 6;
        }

        // Mostrar erro
        function showError(inputId, message) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');

            input.classList.add('error');
            input.classList.remove('success');
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }

        // Mostrar sucesso
        function showSuccess(inputId) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');

            input.classList.add('success');
            input.classList.remove('error');
            errorElement.classList.remove('show');
        }

        // Limpar validação
        function clearValidation(inputId) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');

            input.classList.remove('error', 'success');
            errorElement.classList.remove('show');
        }

        // Event listeners para validação em tempo real
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value.trim();

            if (email === '') {
                clearValidation('email');
            } else if (validateEmail(email)) {
                showSuccess('email');
            } else {
                showError('email', 'Por favor, insira um e-mail válido');
            }
        });

        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;

            if (password === '') {
                clearValidation('password');
            } else if (validatePassword(password)) {
                showSuccess('password');
            } else {
                showError('password', 'A senha deve ter pelo menos 6 caracteres');
            }
        });

        // Efeito de focus nos inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // Submissão do formulário
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const loginBtn = document.getElementById('loginBtn');

            let isValid = true;

            // Validar email
            if (!email) {
                e.preventDefault();
                showError('email', 'E-mail é obrigatório');
                isValid = false;
            } else if (!validateEmail(email)) {
                e.preventDefault();
                showError('email', 'Por favor, insira um e-mail válido');
                isValid = false;
            } else {
                showSuccess('email');
            }

            // Validar senha
            if (!password) {
                e.preventDefault();
                showError('password', 'Senha é obrigatória');
                isValid = false;
            } else if (!validatePassword(password)) {
                e.preventDefault();
                showError('password', 'A senha deve ter pelo menos 6 caracteres');
                isValid = false;
            } else {
                showSuccess('password');
            }

            // Se válido, mostra loading e permite envio do formulário ao backend
            if (isValid) {
                loginBtn.classList.add('loading');
                loginBtn.innerHTML = '';
                // Formulário será enviado normalmente ao /authenticate
            }
        });

        // Efeito de hover no container
        document.querySelector('.login-container').addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const deltaX = (x - centerX) / centerX;
            const deltaY = (y - centerY) / centerY;

            this.style.transform = `perspective(1000px) rotateY(${deltaX * 5}deg) rotateX(${-deltaY * 5}deg)`;
        });

        document.querySelector('.login-container').addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg)';
        });

        // Animação de digitação no placeholder
        function typeWriterEffect() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach((input, index) => {
                const originalPlaceholder = input.placeholder;
                input.placeholder = '';

                setTimeout(() => {
                    let i = 0;
                    const typeInterval = setInterval(() => {
                        input.placeholder += originalPlaceholder.charAt(i);
                        i++;
                        if (i > originalPlaceholder.length) {
                            clearInterval(typeInterval);
                        }
                    }, 100);
                }, index * 500);
            });
        }

        // Efeito de shake no erro
        function shakeElement(element) {
            element.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => {
                element.style.animation = '';
            }, 500);
        }

        // Adicionar animação de shake ao CSS dinamicamente
        const shakeKeyframes = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;

        const style = document.createElement('style');
        style.textContent = shakeKeyframes;
        document.head.appendChild(style);

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();

            // Delay para o efeito de digitação
            setTimeout(typeWriterEffect, 1000);
        });

        // Adicionar efeito de partículas no clique
        document.addEventListener('click', function(e) {
            const colors = ['#FF1F1F', '#ffffff', '#cccccc'];
            const particleCount = 6;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.left = e.clientX + 'px';
                particle.style.top = e.clientY + 'px';
                particle.style.width = '4px';
                particle.style.height = '4px';
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '9999';

                const angle = (Math.PI * 2 * i) / particleCount;
                const velocity = 100;
                const vx = Math.cos(angle) * velocity;
                const vy = Math.sin(angle) * velocity;

                document.body.appendChild(particle);

                let posX = e.clientX;
                let posY = e.clientY;
                let opacity = 1;

                const animate = () => {
                    posX += vx * 0.02;
                    posY += vy * 0.02;
                    opacity -= 0.05;

                    particle.style.left = posX + 'px';
                    particle.style.top = posY + 'px';
                    particle.style.opacity = opacity;

                    if (opacity > 0) {
                        requestAnimationFrame(animate);
                    } else {
                        particle.remove();
                    }
                };

                requestAnimationFrame(animate);
            }
        });


    </script>
</body>
</html>
