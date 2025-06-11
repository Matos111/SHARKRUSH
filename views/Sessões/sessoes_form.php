<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/sharkrush/views/Sessões/style.css"></head>
<body>
<h2>Adicionar Sessão</h2>
<form action="/sharkrush/save-sessoes" method="POST">

        <label for="id_cliente">Digite seu ID:</label>
        <input type="text" id="id_cliente" name="id_cliente" required><br><br>

        <label for="id_exercicio">Exercícios:</label>
        <input type="text" id="id_exercicio" name="id_exercicio" required><br><br>

        <label for="series">Séries:</label>
        <input type="number" id="series" name="series" required><br><br>

        <label for="repeticoes">Repetições:</label>
        <input type="number" id="repeticoes" name="repeticoes" required><br><br>

        <label for="data_criacao">Selecione a data de hoje:</label>
        <input type="date" id="data_criacao" name="data_criacao" required><br><br>

        <label for="grupo_muscular">Selecione o músculo que deseja trabalhar:</label>
        <select name="grupo_muscular" required>
        <option>Peito</option>
        <option>Costas</option>
        <option>Pernas</option>
        <option>Ombros</option>
        <option>Bíceps</option>
        <option>Tríceps</option>
        <option>Abdômen</option>
        <option>Cardio</option>
        </select><br><br>

        <label for="grupo_muscular">Selecione o dia da semana que deseja treinar:</label>
        <select name="dia_semana" required>
        <option>Segunda</option>
        <option>Terça</option>
        <option>Quarta</option>
        <option>Quinta</option>
        <option>Sexta</option>
        <option>Sábado</option>
        <option>Domingo</option>
        </select><br><br>

        <input type="submit" value="Cadastrar Treino">
    </form><br><br>
    <a href="/sharkrush/list-sessoes"><h4>Ir para a página de treinos</h4></a>
</body>
</html>