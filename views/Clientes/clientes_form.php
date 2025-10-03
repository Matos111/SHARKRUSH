<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Sistema</title>

    <style>
        :root {
            --primary-color: #FE4100;
            --primary-hover: #FE4100;
            --error-color: #FE4100;
            --success-color: #06d6a0;
            --light-bg: #000000;
            --text-color: #2b2d42;
            --text-light: #8d99ae;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            z-index: 0;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-size: cover;
            opacity: 0.5;
            z-index: -1;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background: rgb(236, 236, 236);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2rem;
            color: #ff2d2d;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #000;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(182, 182, 182, 0.15);
        }

        .form-group .error {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 4px;
            display: none;
        }

        .form-group.error-state input {
            border-color: var(--error-color);
        }

        .form-group.error-state .error {
            display: block;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 38px;
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-light);
        }

        .btn {
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #FE4100, #c93030);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-position: right center;
            transform: scale(1.03);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .alert-error {
            background-color: rgba(239, 71, 111, 0.1);
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
        }

        .alert-success {
            background-color: rgba(6, 214, 160, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Cadastro de Cliente</h1>
        </div>

        <div id="alert" class="alert alert-error">
            <span id="alert-message"></span>
        </div>

        <form id="login-form" action="/sharkrush/save-clientes" method="POST">

            <div class="form-group" id="name-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" name="nome_completo" required>
                <span class="error" id="name-error">Por favor, insira seu nome</span>
            </div>

            <div class="form-group" id="cpf-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required>
                <span class="error" id="cpf-error">CPF inválido</span>
            </div>

            <div class="form-group" id="address-group">
                <label for="address">Endereço</label>
                <input type="text" id="address" name="endereco" required>
                <span class="error" id="address-error">Endereço obrigatório</span>
            </div>

            <div class="form-group" id="email-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="error" id="email-error">Por favor, insira um email válido</span>
            </div>

            <div class="form-group" id="phone-group">
                <label for="phone">Telefone</label>
                <input type="tel" id="phone" name="telefone" required>
                <span class="error" id="phone-error">Número inválido</span>
            </div>

            <div class="form-group" id="password-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="senha" required>
                <button type="button" class="password-toggle" id="password-toggle">🔒</button>
                <span class="error" id="password-error">A senha deve ter pelo menos 6 caracteres</span>
            </div>

            <div class="form-group" id="confirm-password-group">
                <label for="confirm-password">Confirmar Senha</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
                <button type="button" class="password-toggle" id="confirm-password-toggle">🔒</button>
                <span class="error" id="confirm-password-error">As senhas não coincidem</span>
            </div>

            <button type="submit" id="cadastrar-button" class="btn">
                Cadastrar
                <span class="spinner"></span>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const passwordToggle = document.getElementById('password-toggle');
            const confirmPasswordToggle = document.getElementById('confirm-password-toggle');
            const loginButton = document.getElementById('cadastrar-button');
            const spinner = document.querySelector('.spinner');
            const alert = document.getElementById('alert');
            const alertMessage = document.getElementById('alert-message');

            function togglePasswordVisibility(input, button) {
                if (input.type === 'password') {
                    input.type = 'text';
                    button.textContent = '🔓';
                } else {
                    input.type = 'password';
                    button.textContent = '🔒';
                }
            }

            passwordToggle.addEventListener('click', function() {
                togglePasswordVisibility(passwordInput, passwordToggle);
            });

            confirmPasswordToggle.addEventListener('click', function() {
                togglePasswordVisibility(confirmPasswordInput, confirmPasswordToggle);
            });

            function validateEmail() {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) {
                    return false;
                }
                return true;
            }

            function validatePassword() {
                return passwordInput.value.length >= 6;
            }

            function validateConfirmPassword() {
                return passwordInput.value === confirmPasswordInput.value;
            }

            function showAlert(message, type = 'error') {
                alert.className = 'alert';
                alert.classList.add(`alert-${type}`);
                alertMessage.textContent = message;
                alert.style.display = 'block';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            }

            loginForm.addEventListener('submit', function(e) {
                if (!validateEmail()) {
                    e.preventDefault();
                    showAlert("Email inválido");
                    return;
                }

                if (!validatePassword()) {
                    e.preventDefault();
                    showAlert("Senha deve ter pelo menos 6 caracteres");
                    return;
                }

                if (!validateConfirmPassword()) {
                    e.preventDefault();
                    showAlert("Senhas não coincidem");
                    return;
                }

                loginButton.disabled = true;
                spinner.style.display = 'inline-block';
                loginButton.textContent = 'Cadastrando...';
            });
        });
    </script>
</body>
</html>
