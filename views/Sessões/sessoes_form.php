<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Treino</title>
</head>
<body>

<h1>Atualizar Treino</h1>
<form action="/SHARKRUSH/update-treino" method="POST">
    <input type="hidden" name="id" value="<?php echo $treinoInfo['id']; ?>">

    <label for="dia_semana">Dia da semana:</label>
    <input type="text" id="dia_semana" name="dia_semana" value="<?php echo $treinoInfo['dia_semana']; ?>" required><br><br>

    <label for="grupo_muscular">Grupo Muscular:</label>
    <input type="text" id="grupo_muscular" name="grupo_muscular" value="<?php echo $treinoInfo['grupo_muscular']; ?>" required><br><br>

    <input type="submit" value="Atualizar Treino">
</form>

<a href="/SHARKRUSH/list-treinos">Voltar para a lista</a>

</body>
</html>
