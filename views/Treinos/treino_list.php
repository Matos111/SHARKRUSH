<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Treinos Atribuídos</title>
    <style>
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
    <h2>Treinos Atribuídos</h2>

<table border="1" cellpadding="8">
<tr>
        <th>Cliente</th>
        <th>Exercício</th>
        <th>Grupo Muscular</th>
        <th>Séries</th>
        <th>Repetições</th>
        <th>Dia da Semana</th>
        <th>Data de Execução</th> <th>Ações</th>
    </tr>
     <?php foreach ($treinos as $treino): ?>
     <tr>
        <td><?= htmlspecialchars($treino['nome_cliente']) ?></td>
        <td><?= htmlspecialchars($treino['nome_exercicio']) ?></td>
        <td><?= htmlspecialchars($treino['grupo_muscular']) ?></td>
        <td><?= htmlspecialchars($treino['series']) ?></td>
        <td><?= htmlspecialchars($treino['repeticoes']) ?></td>
        <td><?= htmlspecialchars($treino['dia_semana']) ?></td>
            <td><?= htmlspecialchars($treino['data_criacao'] ?? 'N/A') ?></td> <td>
    <a href="/sharkrush/update-treino/<?= htmlspecialchars($treino['id']) ?>" class="btn btn-edit">Atualizar</a> 
        <form action="/sharkrush/delete-treino" method="post" style="display:inline;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($treino['id']) ?>">
        <button type="submit" class="btn btn-delete" onclick="return confirm('Deseja excluir este exercício?');">Excluir</button>
        </form>
    </td>
    </tr>
 <?php endforeach; ?>
</tr>
</table>
<a href="/sharkrush/treino-form" class="btn btn-add">Adicionar Treino</a>
</body>
</html>
