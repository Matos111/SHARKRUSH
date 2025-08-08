<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <title>Clientes Cadastrados</title>
    </head>
    <body>
<style>
*   {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f5f9ff;
        color: #333;
        padding: 20px;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color:rgb(0, 0, 0);
    }

/* Tabela */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto 30px auto;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e1e1e1;
    }

    th {
        background-color:rgb(0, 0, 0);
        color: #fff;
        font-weight: bold;
    }

    .btn {
        display: inline-block;
        min-width: 100px;
        padding: 10px 14px;
        font-size: 14px;
        font-weight: bold;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        cursor: pointer;
        margin: 4px 4px 4px 0; 
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-align: center;
    }

    .btn-edit {
        background-color:rgb(27, 206, 102);
    }

    .btn-edit:hover {
        background-color:rgb(27, 206, 102);
        transform: scale(1.05);
    }

    .btn-delete {
        background-color: rgb(170, 25, 0);
    }

    .btn-delete:hover {
        background-color: rgb(170, 25, 0);
        transform: scale(1.05);
    }

    .btn-add {
        background-color:rgb(0, 0, 0);
        display: block;
        width: fit-content;
        margin: 0 auto;
        text-align: center;
        padding: 12px 20px;
        font-size: 15px;
    }

    .btn-add:hover {
        background-color:rgb(0, 0, 0);
        transform: scale(1.05);
    }
</style>

<h1>CLIENTES CADASTROS</h1>
<table border="1">
    <tr>
        <th>Nome Completo</th>
        <th>CPF</th>
        <th>Endereço</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th> 
    </tr>

    <?php if (!empty($clientesList)): ?> 
        <?php foreach ($clientesList as $cliente): ?>
        <tr>
            
            <td><?php echo htmlspecialchars($cliente['nome_completo']); ?></td> 
            <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
            <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
            <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
            

            <td>
                 <a href="/sharkrush/update-clientes/<?php echo $cliente['id']; ?>" class="btn btn-edit">Atualizar</a>
                <form action="/sharkrush/delete-clientes" method="POST" style="display:inline;">
                    <input type="hidden" name="nome_completo" value="<?php echo htmlspecialchars($cliente['nome_completo']); ?>">
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?> 
        <tr>
            <td colspan="7">Nenhum cliente cadastrado.</td> 
        </tr>
    <?php endif; ?>
</table>

<a href="/sharkrush/public" class="btn btn-add">Cadastrar novo Cliente</a>
</body>
</html>
