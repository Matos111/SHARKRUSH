<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
</head>
<body>

<h1>Atualizar Cadastro</h1>
<form action="/sharkrush/update-clientes" method="POST">

    <input type="hidden" name="id" value="<?php echo $clientesInfo['id']; ?>">
    
    <label for="nome_completo">Digite o nome completo:</label>
    <input type="text" id="nome_completo" name="nome_completo" value="<?php echo $clientesInfo['nome_completo']; ?>" required><br><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo $clientesInfo['cpf']; ?>" required><br><br>

    <label for="endereco">Digite o endereço completo:</label>
    <input type="text" id="endereco" name="endereco" value="<?php echo $clientesInfo['endereco']; ?>" required><br><br>

    <label for="email">Digite o e-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo $clientesInfo['email']; ?>" required><br><br>

    <label for="telefone">Digite o telefone:</label>
    <input type="text" id="telefone" name="telefone" value="<?php echo $clientesInfo['telefone']; ?>"><br><br>

    <label for="senha">Digite a senha:</label>
    <input type="password" id="senha" name="senha" value="<?php echo $clientesInfo['senha']; ?>"><br><br>

        
    <input type="submit" value="Atualizar cliente">


<a href="/sharkrush/list-clientes">Voltar para a lista</a>

</body>
</html>