<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Atualizar Treino</h1>
<form action="/sharkrush/update-sessoes" method="POST">

    <input type="hidden" name="id" value="<?php echo $sessoesInfo['id']; ?>">
    
    <label for="id_exercicio">Exercícios:</label>
    <input type="text" id="id_exercicio" name="id_exercicio" value="<?php echo $sessoesInfo['id_exercicio']; ?>" required><br><br>

    <label for="series">Número de Séries:</label>
    <input type="number" id="series" name="series" value="<?php echo $sessoesInfo['series']; ?>" required><br><br>

    <label for="repeticoes">Número de Repetições:</label>
    <input type="number" id="repeticoes" name="repeticoes" value="<?php echo $sessoesInfo['repeticoes']; ?>" required><br><br>

    <label for="grupo_muscular">Selecione o músculo que deseja trabalhar:</label>
    <select id="grupo_muscular" name="grupo_muscular" value="<?php echo $sessoesInfo['grupo_muscular']; ?>" required>
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
        <select id="dia_semana" name="dia_semana" value="<?php echo $sessoesInfo['dia_semana']; ?>" required>
        <option>Segunda</option>
        <option>Terça</option>
        <option>Quarta</option>
        <option>Quinta</option>
        <option>Sexta</option>
        <option>Sábado</option>
        <option>Domingo</option>
        </select><br><br>

    <input type="submit" value="Atualizar treino">


<a href="/sharkrush/list-sessoes">Voltar para o treino</a>
</body>
</html>