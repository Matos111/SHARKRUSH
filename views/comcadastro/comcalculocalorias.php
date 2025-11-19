<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Calculadora de Calorias Diárias</title>
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
            margin-left: 70px;
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
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 1s ease-out;
        }

        .logo h1 {
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(45deg, #ff0000, #ffffff, #ff0000);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            text-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }

        .logo p {
            color: #cccccc;
            font-size: 1.1rem;
            margin-top: 10px;
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

        .calculator-card {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #ff0000;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            animation: fadeInUp 1s ease-out 0.3s both;
            position: relative;
            overflow: hidden;
        }

        .calculator-card::before {
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

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #ffffff;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .input-container {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 0, 0, 0.3);
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            transform: scale(1.02);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff0000;
            font-size: 1.2rem;
        }

        .calculate-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(45deg, #ff0000, #cc0000);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .calculate-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .calculate-btn:hover::before {
            left: 100%;
        }

        .calculate-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 0, 0, 0.4);
        }

        .calculate-btn:active {
            transform: translateY(0);
        }

        .result-container {
            margin-top: 30px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(255, 0, 0, 0.2);
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .result-container.show {
            opacity: 1;
            transform: translateY(0);
        }

        .imc-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 0 0 10px currentColor;
        }

        .imc-category {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .imc-description {
            font-size: 1rem;
            line-height: 1.5;
            color: #cccccc;
        }

        .error-message {
            color: #ff4444;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .imc-table {
            margin-top: 30px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 0, 0, 0.2);
        }

        .imc-table h3 {
            color: #ff0000;
            margin-bottom: 15px;
            text-align: center;
        }

        .table-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table-row:last-child {
            border-bottom: none;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .calculator-card {
                padding: 25px;
            }

            .logo h1 {
                font-size: 2.5rem;
            }
        }

        .logo img {
            width: 100px;
            height: auto;
        }
        /* Adicione estilos para selects */
        .form-group select {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1); /* igual input */
            border: 2px solid rgba(255, 0, 0, 0.3); /* igual input */
            border-radius: 10px;
            color: #fff; /* seletor branco */
            font-size: 1.1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            box-shadow: none;
            cursor: pointer;
            position: relative;
        }
        .form-group select:focus {
            border-color: #ff0000;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            transform: scale(1.02);
            color: #fff; /* mantém branco no foco */
        }
        /* Opções em preto */
        .form-group select option {
            color: #000 !important; /* opções em preto */
            background: #fff !important; /* fundo branco para contraste */
        }
        .input-container select {
            background-image: url("data:image/svg+xml;utf8,<svg fill='red' height='18' viewBox='0 0 24 24' width='18' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 18px 18px;
            /* padding-right: 40px; já incluso no input */
        }
        .input-container {
            position: relative;
        }
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff0000;
            font-size: 1.2rem;
            pointer-events: none;
        }
        /* Remove destaque especial antigo dos selects */
        #sex, #activity {
            background: rgba(255, 255, 255, 0.1);
            color: #fff; /* cor preta para o texto */
            font-weight: normal;
            letter-spacing: normal;
        }
        #sex:focus, #activity:focus {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff; /* cor preta para o texto */
        }

        /* Sidebar styles */
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
        /* Ajuste para não sobrepor conteúdo principal */
        body {
            /* ...existing code... */
            margin-left: 70px;
        }
        @media (max-width: 900px) {
            body {
                margin-left: 0;
            }
            .main-menu {
                position: absolute;
                height: auto;
                width: 100vw;
                left: 0;
                top: 0;
                z-index: 1002;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar navigation -->
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
            <a href="/sharkrush/calculadora-calorias" class="active">
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

    <div class="background-animation">
        <div class="shark-fin" style="top: 20%; animation-delay: 0s;"></div>
        <div class="shark-fin" style="top: 60%; animation-delay: 3s;"></div>
        <div class="shark-fin" style="top: 40%; animation-delay: 6s;"></div>
    </div>

    <div class="container">


        <div class="calculator-card">
            <form id="calorieForm">
                <div class="form-group">
                    <label for="sex">Sexo</label>
                    <div class="input-container">
                        <select id="sex" required>
                            <option value="">Selecione</option>
                            <option value="male">Masculino</option>
                            <option value="female">Feminino</option>
                        </select>
                        <span class="input-icon">♂️</span>
                    </div>
                    <div class="error-message" id="sexError">Por favor, selecione o sexo</div>
                </div>
                <div class="form-group">
                    <label for="age">Idade (anos)</label>
                    <div class="input-container">
                        <input type="number" id="age" min="10" max="120" placeholder="Ex: 30" required>
                        <span class="input-icon">🎂</span>
                    </div>
                    <div class="error-message" id="ageError">Por favor, insira uma idade válida</div>
                </div>
                <div class="form-group">
                    <label for="weight">Peso (kg)</label>
                    <div class="input-container">
                        <input type="number" id="weight" step="0.1" min="30" max="300" placeholder="Ex: 70.5" required>
                        <span class="input-icon">⚖️</span>
                    </div>
                    <div class="error-message" id="weightError">Por favor, insira um peso válido</div>
                </div>
                <div class="form-group">
                    <label for="height">Altura (cm)</label>
                    <div class="input-container">
                        <input type="number" id="height" step="0.1" min="120" max="250" placeholder="Ex: 175" required>
                        <span class="input-icon">📏</span>
                    </div>
                    <div class="error-message" id="heightError">Por favor, insira uma altura válida</div>
                </div>
                <div class="form-group">
                    <label for="activity">Nível de Atividade</label>
                    <div class="input-container">
                        <select id="activity" required>
                            <option value="">Selecione</option>
                            <option value="1.2">Sedentário (pouco ou nenhum exercício)</option>
                            <option value="1.375">Levemente ativo (exercício leve 1-3 dias/semana)</option>
                            <option value="1.55">Moderadamente ativo (exercício moderado 3-5 dias/semana)</option>
                            <option value="1.725">Muito ativo (exercício intenso 6-7 dias/semana)</option>
                            <option value="1.9">Extremamente ativo (exercício muito intenso, trabalho físico)</option>
                        </select>
                        <span class="input-icon">🏃</span>
                    </div>
                    <div class="error-message" id="activityError">Por favor, selecione o nível de atividade</div>
                </div>
                <button type="submit" class="calculate-btn">
                    Calcular Calorias
                </button>
            </form>

            <div class="result-container" id="resultContainer">
                <div class="imc-value" id="calorieValue"></div>
                <div class="imc-category" id="calorieCategory"></div>
                <div class="imc-description" id="calorieDescription"></div>
            </div>

            <div class="imc-table">
                <h3>O que significam as calorias diárias?</h3>
                <div class="table-row">
                    <span>Manutenção</span>
                    <span>Consuma o valor calculado</span>
                </div>
                <div class="table-row">
                    <span>Perda de peso</span>
                    <span>Reduza ~500 kcal/dia</span>
                </div>
                <div class="table-row">
                    <span>Ganho de peso</span>
                    <span>Aumente ~500 kcal/dia</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        class CalorieCalculator {
            constructor() {
                this.form = document.getElementById('calorieForm');
                this.sexInput = document.getElementById('sex');
                this.ageInput = document.getElementById('age');
                this.weightInput = document.getElementById('weight');
                this.heightInput = document.getElementById('height');
                this.activityInput = document.getElementById('activity');
                this.resultContainer = document.getElementById('resultContainer');
                this.calorieValue = document.getElementById('calorieValue');
                this.calorieCategory = document.getElementById('calorieCategory');
                this.calorieDescription = document.getElementById('calorieDescription');
                this.init();
            }

            init() {
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));
                this.sexInput.addEventListener('input', () => this.clearError('sex'));
                this.ageInput.addEventListener('input', () => this.clearError('age'));
                this.weightInput.addEventListener('input', () => this.clearError('weight'));
                this.heightInput.addEventListener('input', () => this.clearError('height'));
                this.activityInput.addEventListener('input', () => this.clearError('activity'));

                // Adiciona efeitos de hover nos inputs
                [this.sexInput, this.ageInput, this.weightInput, this.heightInput, this.activityInput].forEach(input => {
                    input.addEventListener('focus', () => this.addInputFocus(input));
                    input.addEventListener('blur', () => this.removeInputFocus(input));
                });

                // Animação inicial
                this.animateInputs();
            }

            animateInputs() {
                const inputs = document.querySelectorAll('.form-group');
                inputs.forEach((input, index) => {
                    setTimeout(() => {
                        input.style.animation = 'fadeInUp 0.6s ease-out forwards';
                        input.style.opacity = '1';
                    }, index * 200);
                });
            }

            addInputFocus(input) {
                input.parentElement.style.transform = 'scale(1.02)';
                input.parentElement.style.transition = 'all 0.3s ease';
            }

            removeInputFocus(input) {
                input.parentElement.style.transform = 'scale(1)';
            }

            handleSubmit(e) {
                e.preventDefault();
                const sex = this.sexInput.value;
                const age = parseInt(this.ageInput.value);
                const weight = parseFloat(this.weightInput.value);
                const height = parseFloat(this.heightInput.value);
                const activity = parseFloat(this.activityInput.value);

                if (this.validateInputs(sex, age, weight, height, activity)) {
                    const calories = this.calculateCalories(sex, age, weight, height, activity);
                    this.displayResult(calories);
                    this.addCalculationAnimation();
                }
            }

            validateInputs(sex, age, weight, height, activity) {
                let isValid = true;
                if (!sex) {
                    this.showError('sex', 'Por favor, selecione o sexo');
                    isValid = false;
                }
                if (!age || age < 10 || age > 120) {
                    this.showError('age', 'Por favor, insira uma idade válida (10-120 anos)');
                    isValid = false;
                }
                if (!weight || weight < 30 || weight > 300) {
                    this.showError('weight', 'Por favor, insira um peso válido (30-300 kg)');
                    isValid = false;
                }
                if (!height || height < 120 || height > 250) {
                    this.showError('height', 'Por favor, insira uma altura válida (120-250 cm)');
                    isValid = false;
                }
                if (!activity) {
                    this.showError('activity', 'Por favor, selecione o nível de atividade');
                    isValid = false;
                }
                return isValid;
            }

            showError(field, message) {
                const errorElement = document.getElementById(`${field}Error`);
                const inputElement = document.getElementById(field);
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                if (inputElement) {
                    inputElement.style.borderColor = '#ff4444';
                    inputElement.style.boxShadow = '0 0 10px rgba(255, 68, 68, 0.3)';
                }
            }

            clearError(field) {
                const errorElement = document.getElementById(`${field}Error`);
                const inputElement = document.getElementById(field);
                errorElement.style.display = 'none';
                if (inputElement) {
                    inputElement.style.borderColor = 'rgba(255, 0, 0, 0.3)';
                    inputElement.style.boxShadow = 'none';
                }
            }

            calculateCalories(sex, age, weight, height, activity) {
                // Fórmula de Harris-Benedict revisada
                let tmb;
                if (sex === 'male') {
                    tmb = 88.36 + (13.4 * weight) + (4.8 * height) - (5.7 * age);
                } else {
                    tmb = 447.6 + (9.2 * weight) + (3.1 * height) - (4.3 * age);
                }
                return tmb * activity;
            }

            displayResult(calories) {
                this.calorieValue.textContent = `${Math.round(calories)} kcal/dia`;
                this.calorieValue.style.color = "#ff0000";
                this.calorieCategory.textContent = "Calorias para manutenção do peso";
                this.calorieCategory.style.color = "#ff0000";
                this.calorieDescription.textContent = "Para perder peso, consuma cerca de 500 kcal a menos por dia. Para ganhar peso, consuma cerca de 500 kcal a mais.";
                this.resultContainer.classList.add('show');
            }

            addCalculationAnimation() {
                const button = document.querySelector('.calculate-btn');
                button.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 150);
                setTimeout(() => {
                    this.calorieValue.style.animation = 'pulse 0.6s ease-in-out';
                }, 300);
            }
        }

        // Adiciona estilo de pulsação
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
        `;
        document.head.appendChild(style);

        // Inicializa a calculadora quando a página carregar
        document.addEventListener('DOMContentLoaded', () => {
            new CalorieCalculator();
        });

        // Adiciona partículas flutuantes
        function createFloatingParticles() {
            const particleCount = 15;

            for (let i = 0; i < particleCount; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
                    particle.style.cssText = `
                        position: fixed;
                        width: 2px;
                        height: 2px;
                        background: #ff0000;
                        border-radius: 50%;
                        pointer-events: none;
                        z-index: -1;
                        opacity: 0.6;
                    `;

                    particle.style.left = Math.random() * window.innerWidth + 'px';
                    particle.style.top = window.innerHeight + 'px';

                    document.body.appendChild(particle);

                    const animation = particle.animate([
                        { transform: 'translateY(0px)', opacity: 0.6 },
                        { transform: `translateY(-${window.innerHeight + 100}px)`, opacity: 0 }
                    ], {
                        duration: 8000 + Math.random() * 4000,
                        easing: 'linear'
                    });

                    animation.onfinish = () => particle.remove();
                }, i * 800);
            }
        }

        // Inicia as partículas
        setInterval(createFloatingParticles, 12000);
        createFloatingParticles();
    </script>
</body>
</html>
