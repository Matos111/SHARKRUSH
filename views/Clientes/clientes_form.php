<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>

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

    <a href="/sharkrush/list-clientes"><h4>Ver todos os Clientes</h4></a>
</body>
</html>
