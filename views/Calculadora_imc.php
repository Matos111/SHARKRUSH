<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SharkRush - Calculadora IMC</title>
    <link rel="stylesheet" href="Calculadora_imc.css" />
</head>
<body>

    <!-- Logo -->
    <div class="logo">SHARKRUSH</div>

    <!-- Login -->
    <div class="login-options">
        <a href="#">ENTRAR</a> / <a href="#" class="cadastro">CADASTRAR</a>
    </div>

    <!-- Calculadora -->
    <div class="calculator-container">
        <div class="calculator-title">CALCULADOR</div>
        <div class="imc-title">IMC</div>

        <div class="input-group">
            <label for="peso">PESO</label>
            <div class="input-with-unit">
                <input type="number" id="peso" class="input-value" placeholder="78" min="0" required />
                <span class="unit">kg</span>
            </div>
        </div>

        <div class="input-group">
            <label for="altura">ALTURA</label>
            <div class="input-with-unit">
                <input
                    type="number"
                    id="altura"
                    class="input-value"
                    placeholder="1.90"
                    min="0"
                    step="0.01"
                    required
                />
                <span class="unit">m</span>
            </div>
        </div>

        <button class="calculate-btn" onclick="calcularIMC()">CALCULAR</button>

        <!-- Resultado aparece aqui -->
        <div id="resultado-imc" style="margin-top: 2rem;"></div>
    </div>

    <script>
        function calcularIMC() {
            const peso = parseFloat(document.getElementById("peso").value);
            const altura = parseFloat(document.getElementById("altura").value);
            const resultadoDiv = document.getElementById("resultado-imc");

            if (peso > 0 && altura > 0) {
                const imc = peso / (altura * altura);
                let classificacao = "";
                let cor = "";

                if (imc < 18.5) {
                    classificacao = "Abaixo do peso";
                    cor = "#ffc107";
                } else if (imc < 24.9) {
                    classificacao = "Peso normal";
                    cor = "#00e676";
                } else if (imc < 29.9) {
                    classificacao = "Sobrepeso";
                    cor = "#ff9800";
                } else if (imc < 34.9) {
                    classificacao = "Obesidade grau I";
                    cor = "#ff5722";
                } else if (imc < 39.9) {
                    classificacao = "Obesidade grau II";
                    cor = "#f44336";
                } else {
                    classificacao = "Obesidade grau III";
                    cor = "#d32f2f";
                }

                resultadoDiv.innerHTML = `
                    <div>
                        <div class="input-value" style="font-size: 2.5rem; margin-bottom: 1rem;">${imc.toFixed(2)}</div>
                        <p style="color: #ffffff; font-weight: bold; font-size: 1.2rem; text-transform: uppercase;">
                            Classificação: <span style="color: ${cor};">${classificacao}</span>
                        </p>
                    </div>
                `;
            } else {
                resultadoDiv.innerHTML = `<p style="color: #ff2d2d; margin-top: 1rem;">Preencha peso e altura corretamente.</p>`;
            }
        }
    </script>

</body>
</html>
