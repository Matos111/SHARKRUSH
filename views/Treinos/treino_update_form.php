<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Treino</title>
      <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: #f5f9ff;
    color: #333;
    padding: 20px;
}

h1, h2 {
    text-align: center;
    margin-bottom: 20px;
    color: rgb(0, 0, 0);
}

form {
    max-width: 500px;
    background: #ffffff;
    margin: 0 auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

select,
input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

select:focus,
input[type="text"]:focus {
    border-color: rgb(170, 25, 0);
    outline: none;
}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: rgb(0, 0, 0);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

input[type="submit"]:hover {
    background-color: rgb(170, 25, 0);
    transform: scale(1.02);
}

a.atualizar-btn {
    display: block;
    max-width: 500px;
    margin: 20px auto 0 auto;
    text-align: center;
    padding: 12px;
    background-color: rgb(0, 0, 0);
    color: white;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background 0.3s ease, transform 0.2s ease;
}

a.atualizar-btn:hover {
    background-color: rgb(170, 25, 0);
    transform: scale(1.02);
}

    </style>
</head>
<body>
    <h2>Editar Treino</h2>
<form action="/sharkrush/update-treino" method="post">
    <input type="hidden" name="id" value="<?= $treinoInfo['id'] ?>">

    <label>Cliente:</label>
    <select name="id_cliente" required>
        <?php foreach ($clientesList as $cliente): ?>
            <option value="<?= $cliente['id'] ?>" <?= $cliente['id'] == $treinoInfo['id_cliente'] ? 'selected' : '' ?>>
                <?= $cliente['nome_completo'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Exercício:</label>
    <select name="id_exercicio" required>
        <?php foreach ($exerciciosList as $ex): ?>
            <option value="<?= $ex['id'] ?>" <?= $ex['id'] == $treinoInfo['id_exercicio'] ? 'selected' : '' ?>>
                <?= $ex['nome_exercicio'] ?> (<?= $ex['grupo_muscular'] ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Séries:</label>
    <input type="number" name="series" value="<?= $treinoInfo['series'] ?>" required><br><br>

    <label>Repetições:</label>
    <input type="number" name="repeticoes" value="<?= $treinoInfo['repeticoes'] ?>" required><br><br>

    <label>Dia da Semana:</label>
    <select name="dia_semana" required>
        <?php 
        $dias = ['Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'];
        foreach ($dias as $dia): ?>
            <option value="<?= $dia ?>" <?= $dia == $treinoInfo['dia_semana'] ? 'selected' : '' ?>><?= $dia ?></option>
        <?php endforeach; ?>
    </select><br><br>


<button class="atualizar-btn">Atualizar</button> 
</form>
</body>
</html>
