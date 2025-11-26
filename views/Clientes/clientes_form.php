<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Cadastro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            padding: 2rem 0;
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

        .register-container {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            -webkit-backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37), 0 0 0 2px rgba(255,31,31,0.12);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 550px;
            animation: slideIn 0.8s ease-out;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .register-container::before {
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

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
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
            margin-bottom: 0.3rem;
        }

        .tagline {
            color: #888;
            font-size: 0.9rem;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            gap: 1.3rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
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

        .error-message {
            color: #ff4444;
            font-size: 0.75rem;
            margin-top: 0.4rem;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            position: absolute;
        }

        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }

        .form-input.error {
            border-color: #ff4444;
            box-shadow: 0 0 10px rgba(255, 68, 68, 0.3);
        }

        .form-input.success {
            border-color: #44ff44;
            box-shadow: 0 0 10px rgba(68, 255, 68, 0.3);
        }

        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-strength.show {
            opacity: 1;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #ff4444;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #ffaa00;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #44ff44;
        }

        .password-strength-text {
            font-size: 0.75rem;
            margin-top: 0.3rem;
            color: #888;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.7rem;
            color: #ccc;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .terms-checkbox input[type="checkbox"] {
            accent-color: #FF1F1F;
            margin-top: 0.2rem;
            cursor: pointer;
        }

        .terms-checkbox label {
            cursor: pointer;
            line-height: 1.4;
        }

        .terms-checkbox a {
            color: #FF1F1F;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .terms-checkbox a:hover {
            text-shadow: 0 0 10px rgba(255, 31, 31, 0.8);
        }

        .register-btn {
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
            margin-top: 0.5rem;
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 31, 31, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn:disabled {
            background: #666;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .register-btn.loading {
            background: #666;
            cursor: not-allowed;
        }

        .register-btn.loading::after {
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

        .login-link {
            text-align: center;
            color: #ccc;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #FF1F1F;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            text-shadow: 0 0 10px rgba(255, 31, 31, 0.8);
        }

        @media (max-width: 768px) {
            .register-container {
                margin: 1rem;
                padding: 2rem;
                max-width: none;
            }

            .logo {
                font-size: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
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
            .register-container {
                padding: 1.5rem;
            }

            .logo {
                font-size: 1.8rem;
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="animated-bg">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <div class="register-container">
        <div class="logo-section">
            <div class="logo">SHARKRUSH</div>
            <div class="subtitle">Junte-se a nós!</div>
            <div class="tagline">Comece sua jornada fitness hoje</div>
        </div>

        <form class="register-form" id="registerForm" method="POST" action="<?= BASE_URL ?>/save-clientes">
            <div class="form-group full-width">
                <input type="text" class="form-input" id="nome_completo" name="nome_completo" placeholder="Nome completo" required>
                <div class="input-icon">👤</div>
                <div class="error-message" id="nome_completoError"></div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-input" id="cpf" name="cpf" placeholder="CPF" required maxlength="14">
                    <div class="input-icon">📄</div>
                    <div class="error-message" id="cpfError"></div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-input" id="telefone" name="telefone" placeholder="Telefone" maxlength="15">
                    <div class="input-icon">📱</div>
                    <div class="error-message" id="telefoneError"></div>
                </div>
            </div>

            <div class="form-group full-width">
                <input type="text" class="form-input" id="endereco" name="endereco" placeholder="Endereço completo" required>
                <div class="input-icon">📍</div>
                <div class="error-message" id="enderecoError"></div>
            </div>

            <div class="form-group full-width">
                <input type="email" class="form-input" id="email" name="email" placeholder="E-mail" required>
                <div class="input-icon">📧</div>
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group full-width">
                <input type="password" class="form-input" id="senha" name="senha" placeholder="Senha (mínimo 6 caracteres)" required>
                <div class="input-icon">🔒</div>
                <div class="error-message" id="senhaError"></div>
                <div class="password-strength" id="passwordStrength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="password-strength-text" id="passwordStrengthText"></div>
            </div>

            <div class="form-group full-width">
                <input type="password" class="form-input" id="confirmar_senha" placeholder="Confirme sua senha" required>
                <div class="input-icon">🔐</div>
                <div class="error-message" id="confirmar_senhaError"></div>
            </div>

            <div class="terms-checkbox">
                <input type="checkbox" id="terms" required>
                <label for="terms">
                    Concordo com os <a href="../" onclick="event.preventDefault()">Termos de Uso</a> e <a href="#" onclick="event.preventDefault()">Política de Privacidade</a>
                </label>
            </div>

            <button type="submit" class="register-btn" id="registerBtn">
                <span>CRIAR CONTA</span>
            </button>
        </form>

        <div class="divider">
            <span>ou</span>
        </div>

        <div class="login-link">
            Já tem uma conta? <a href="<?= BASE_URL ?>/login">Faça login</a>
        </div>
    </div>

    <script>
        function createParticles() {
            const animatedBg = document.querySelector('.animated-bg');
            const particleCount = 40;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 3 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
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

        function formatCPF(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})/, '$1-$2')
                .replace(/(-\d{2})\d+?$/, '$1');
        }

        function formatPhone(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{2})(\d)/, '($1) $2')
                .replace(/(\d{5})(\d)/, '$1-$2')
                .replace(/(-\d{4})\d+?$/, '$1');
        }

        function validateCPF(cpf) {
            cpf = cpf.replace(/\D/g, '');
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
            
            let sum = 0;
            for (let i = 0; i < 9; i++) {
                sum += parseInt(cpf.charAt(i)) * (10 - i);
            }
            let digit = 11 - (sum % 11);
            if (digit >= 10) digit = 0;
            if (digit !== parseInt(cpf.charAt(9))) return false;
            
            sum = 0;
            for (let i = 0; i < 10; i++) {
                sum += parseInt(cpf.charAt(i)) * (11 - i);
            }
            digit = 11 - (sum % 11);
            if (digit >= 10) digit = 0;
            if (digit !== parseInt(cpf.charAt(10))) return false;
            
            return true;
        }

        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 10) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            return strength;
        }

        function updatePasswordStrength(password) {
            const strength = checkPasswordStrength(password);
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');
            const strengthContainer = document.getElementById('passwordStrength');
            
            strengthContainer.classList.add('show');
            
            if (strength <= 2) {
                strengthBar.className = 'password-strength-bar weak';
                strengthText.textContent = 'Senha fraca';
                strengthText.style.color = '#ff4444';
            } else if (strength <= 3) {
                strengthBar.className = 'password-strength-bar medium';
                strengthText.textContent = 'Senha média';
                strengthText.style.color = '#ffaa00';
            } else {
                strengthBar.className = 'password-strength-bar strong';
                strengthText.textContent = 'Senha forte';
                strengthText.style.color = '#44ff44';
            }
        }

        function showError(inputId, message) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');
            
            input.classList.add('error');
            input.classList.remove('success');
            errorElement.textContent = message;
            errorElement.classList.add('show');
            
            input.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => { input.style.animation = ''; }, 500);
        }

        function showSuccess(inputId) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');
            
            input.classList.add('success');
            input.classList.remove('error');
            errorElement.classList.remove('show');
        }

        function clearValidation(inputId) {
            const input = document.getElementById(inputId);
            const errorElement = document.getElementById(inputId + 'Error');
            
            input.classList.remove('error', 'success');
            errorElement.classList.remove('show');
        }

        document.getElementById('cpf').addEventListener('input', function(e) {
            this.value = formatCPF(this.value);
            clearValidation('cpf');
        });
        document.getElementById('cpf').addEventListener('blur', function(e) {
            const cpf = this.value.replace(/\D/g, '');
            if (cpf === '') {
                clearValidation('cpf');
            } else if (cpf.length === 11) {
                if (validateCPF(cpf)) {
                    showSuccess('cpf');
                } else {
                    showError('cpf', 'CPF inválido');
                }
            } else {
                showError('cpf', 'CPF incompleto');
            }
        });

        document.getElementById('telefone').addEventListener('input', function(e) {
            this.value = formatPhone(this.value);
            clearValidation('telefone');
        });
        document.getElementById('telefone').addEventListener('blur', function(e) {
            const phone = this.value.replace(/\D/g, '');
            if (phone === '') {
                clearValidation('telefone');
            } else if (phone.length >= 10) {
                showSuccess('telefone');
            } else {
                showError('telefone', 'Telefone incompleto');
            }
        });

        document.getElementById('email').addEventListener('input', function() {
            clearValidation('email');
        });
        document.getElementById('email').addEventListener('blur', function() {
            const email = this.value.trim();
            if (email === '') {
                clearValidation('email');
            } else if (validateEmail(email)) {
                showSuccess('email');
            } else {
                showError('email', 'E-mail inválido');
            }
        });

        document.getElementById('nome_completo').addEventListener('input', function() {
            clearValidation('nome_completo');
        });
        document.getElementById('nome_completo').addEventListener('blur', function() {
            const nome = this.value.trim();
            if (nome === '') {
                clearValidation('nome_completo');
            } else if (nome.split(' ').length >= 2 && nome.length >= 5) {
                showSuccess('nome_completo');
            } else {
                showError('nome_completo', 'Digite o nome completo');
            }
        });

        document.getElementById('endereco').addEventListener('input', function() {
            clearValidation('endereco');
        });
        document.getElementById('endereco').addEventListener('blur', function() {
            const endereco = this.value.trim();
            if (endereco === '') {
                clearValidation('endereco');
            } else if (endereco.length >= 10) {
                showSuccess('endereco');
            } else {
                showError('endereco', 'Digite o endereço completo');
            }
        });

        document.getElementById('senha').addEventListener('input', function() {
            const senha = this.value;
            if (senha === '') {
                clearValidation('senha');
                document.getElementById('passwordStrength').classList.remove('show');
            } else {
                updatePasswordStrength(senha);
                clearValidation('senha');
            }
            // Não mostrar erro de confirmação enquanto digita
            // Apenas limpar o erro se estiver digitando
            const confirmarSenha = document.getElementById('confirmar_senha').value;
            if (confirmarSenha) {
                clearValidation('confirmar_senha');
            }
        });
        document.getElementById('senha').addEventListener('blur', function() {
            const senha = this.value;
            if (senha === '') {
                clearValidation('senha');
            } else if (senha.length >= 6) {
                showSuccess('senha');
            } else {
                showError('senha', 'Mínimo de 6 caracteres');
            }
        });

        document.getElementById('confirmar_senha').addEventListener('input', function() {
            clearValidation('confirmar_senha');
        });
        document.getElementById('confirmar_senha').addEventListener('blur', function() {
            const senha = document.getElementById('senha').value;
            const confirmarSenha = this.value;
            if (confirmarSenha === '') {
                clearValidation('confirmar_senha');
            } else if (senha === confirmarSenha) {
                showSuccess('confirmar_senha');
            } else {
                showError('confirmar_senha', 'As senhas não coincidem');
            }
        });

        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;

            const nome = document.getElementById('nome_completo').value.trim();
            if (!nome || nome.split(' ').length < 2 || nome.length < 5) {
                e.preventDefault();
                showError('nome_completo', 'Digite o nome completo');
                isValid = false;
            }

            const cpf = document.getElementById('cpf').value.replace(/\D/g, '');
            if (!cpf || !validateCPF(cpf)) {
                e.preventDefault();
                showError('cpf', 'CPF inválido');
                isValid = false;
            }

            const endereco = document.getElementById('endereco').value.trim();
            if (!endereco || endereco.length < 10) {
                e.preventDefault();
                showError('endereco', 'Digite o endereço completo');
                isValid = false;
            }

            const email = document.getElementById('email').value.trim();
            if (!email || !validateEmail(email)) {
                e.preventDefault();
                showError('email', 'E-mail inválido');
                isValid = false;
            }

            const senha = document.getElementById('senha').value;
            if (!senha || senha.length < 6) {
                e.preventDefault();
                showError('senha', 'Senha deve ter no mínimo 6 caracteres');
                isValid = false;
            }

            const confirmarSenha = document.getElementById('confirmar_senha').value;
            if (senha !== confirmarSenha) {
                e.preventDefault();
                showError('confirmar_senha', 'As senhas não coincidem');
                isValid = false;
            }

            const terms = document.getElementById('terms').checked;
            if (!terms) {
                e.preventDefault();
                alert('Você precisa concordar com os Termos de Uso');
                isValid = false;
            }

            if (isValid) {
                const registerBtn = document.getElementById('registerBtn');
                registerBtn.classList.add('loading');
                registerBtn.innerHTML = '';

                // Redireciona para a página de login após 1 segundo
                setTimeout(function() {
                    window.location.href = "<?= BASE_URL ?>/login";
                }, 1000);
            }
        });

        document.querySelector('.register-container').addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const deltaX = (x - centerX) / centerX;
            const deltaY = (y - centerY) / centerY;
            
            this.style.transform = `perspective(1000px) rotateY(${deltaX * 5}deg) rotateX(${-deltaY * 5}deg)`;
        });

        document.querySelector('.register-container').addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg)';
        });

        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });

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