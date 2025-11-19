<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribuir Exercícios</title>
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

a.ver-treinos-btn {
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

a.ver-clientes-btn:hover {
    background-color: rgb(170, 25, 0);
    transform: scale(1.02);
}
</style>
</head>
<body>
    <h2>Atribuir Exercício a Cliente</h2>
<form action="<?= BASE_URL ?>/save-treino" method="post">
    <label>Cliente:</label>
    <select name="id_cliente" required>
        <?php foreach ($clientesList as $cliente): ?>
            <option value="<?= $cliente['id'] ?>"><?= $cliente['nome_completo'] ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Exercício:</label>
    <select name="id_exercicio" required>
        <?php foreach ($exerciciosList as $ex): ?>
            <option value="<?= $ex['id'] ?>"><?= $ex['nome_exercicio'] ?> (<?= $ex['grupo_muscular'] ?>)</option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Séries:</label>
    <input type="number" name="series" min="1" required><br><br>

    <label>Repetições:</label>
    <input type="number" name="repeticoes" min="1" required><br><br>

    <label>Dia da Semana:</label>
    <select name="dia_semana" required>
        <option value="Segunda">Segunda</option>
        <option value="Terça">Terça</option>
        <option value="Quarta">Quarta</option>
        <option value="Quinta">Quinta</option>
        <option value="Sexta">Sexta</option>
        <option value="Sábado">Sábado</option>
        <option value="Domingo">Domingo</option>
    </select><br><br>

    <button type="submit">Salvar Treino</button>
</form>
<a href="<?= BASE_URL ?>/list-treino" class="ver-treinos-btn">Ver todos os Treinos</a> 
</body>
</html>