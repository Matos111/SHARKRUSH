<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
<style>
*   {
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
        color:rgb(0, 0, 0);
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
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
        background-color:rgb(170, 25, 0);
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
        background-color:rgb(170, 25, 0);
        transform: scale(1.02);
    }

</style>
</head>
<body>
    <h1>CADASTRO DO USUÁRIO</h1>

    <h2>Preencha os dados abaixo:</h2>
    <form action="/sharkrush/save-clientes" method="POST">
   
        <label for="nome_completo">Digite o nome completo:</label>
        <input type="text" id="nome_completo" name="nome_completo" required><br><br>

        <label for="cpf">Digite o CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="endereco">Digite o endereço completo:</label>
        <input type="text" id="endereco" name="endereco" required><br><br>

        <label for="email">Digite o e-mail:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="telefone">Digite o telefone:</label>
        <input type="text" id="telefone" name="telefone"><br><br>

        <label for="senha">Digite a senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        
        <input type="submit" value="Cadastrar Cliente">
    </form>

    <a href="/sharkrush/list-clientes" class="ver-clientes-btn">Ver todos os Clientes</a>

</body>
</html>
