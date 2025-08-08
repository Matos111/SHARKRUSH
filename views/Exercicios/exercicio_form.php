<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Exercício</title>
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

a.ver-clientes-btn {
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
    <h1>CADASTRO DE EXERCÍCIO</h1>
    <h2>Preencha os dados abaixo:</h2>

  <form action="/sharkrush/save-exercicio" method="POST">
        <label for="grupo_muscular">Grupo Muscular:</label>
        <select id="grupo_muscular" name="grupo_muscular" required>
            <option value="">Selecione</option>
            <option value="Peito">Peito</option>
            <option value="Costas">Costas</option>
            <option value="Pernas">Pernas</option>
            <option value="Ombros">Ombros</option>
            <option value="Bíceps">Bíceps</option>
            <option value="Tríceps">Tríceps</option>
            <option value="Abdômen">Abdômen</option>
            <option value="Cardio">Cardio</option>
        </select>

        <label for="nome_exercicio">Nome do Exercício:</label>
        <input type="text" id="nome_exercicio" name="nome_exercicio" required>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao">

        <input type="submit" value="Cadastrar Exercício">
    </form>

<a href="/sharkrush/list-exercicio" class="ver-clientes-btn">Ver todos os Exercícios</a> 

</body>
</html>