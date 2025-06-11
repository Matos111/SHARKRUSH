<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Meus treinos</h1>
<table border="1">
    <tr>
        <th>Principais Musculos</th>
        <th>Dia da Semana</th>
        <th>Número de Séries</th>
        <th>Número de Repetições</th>
        <th>Data de Criação</th>
    </tr>

    <?php if (!empty($sessoesList)): ?>
        <?php foreach ($sessoesList as $sessao): ?>
        <tr>
            <td><?php echo htmlspecialchars($sessao['grupo_muscular']); ?></td> 
            <td><?php echo htmlspecialchars($sessao['dia_semana']); ?></td>
            <td><?php echo htmlspecialchars($sessao['series']); ?></td>
            <td><?php echo htmlspecialchars($sessao['repeticoes']); ?></td>
            <td><?php echo htmlspecialchars($sessao['data_criacao']); ?></td>

            <td>
                <a href="/sharkrush/update-sessoes/<?= $sessao['id'] ?>">Atualizar</a>
                
                <form action="/sharkrush/delete-sessoes" method="POST" style="display:inline;">
                    <input type="hidden" name="dia_semana" value="<?php echo htmlspecialchars($sessao['dia_semana']); ?>">
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?> 
        <tr>
            <td colspan="7">Nenhum treino criado.</td>
        </tr>
    <?php endif; ?>
</table>

<a href="/sharkrush/sessoes">Criar novo treino</a>
</body>
</html>