<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercícios Cadastrados</title>
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
</head>
<body>
<h1>Eexercícios Cadastrados</h1>
<table border="1">
    <tr>
        <th>Grupo Muscular</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>

    <?php if (!empty($exerciciosList)): ?>
        <?php foreach ($exerciciosList as $exercicio): ?>
        <tr>
            <td><?php echo htmlspecialchars($exercicio['grupo_muscular']); ?></td>
            <td><?php echo htmlspecialchars($exercicio['nome_exercicio']); ?></td>
            <td><?php echo htmlspecialchars($exercicio['descricao']); ?></td>
            <td>
                <a href="/sharkrush/update-exercicio/<?php echo $exercicio['id']; ?>" class="btn btn-edit">Atualizar</a> 
                    <form action="/sharkrush/delete-exercicio" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $exercicio['id']; ?>">
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Deseja excluir este exercício?');">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Nenhum exercício cadastrado.</td>
        </tr>
    <?php endif; ?>
</table>

<a href="/sharkrush/public-exercicio" class="btn btn-add">Cadastrar novo Exercício</a>
</body>
</html>
