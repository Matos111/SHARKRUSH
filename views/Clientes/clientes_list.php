<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sharkrush/views/css/styles.css">
    <title>Clientes Cadastrados</title>
</head>
<body>

<h1>Clientes Cadastrados</h1>
<table border="1">
    <tr>
        <th>Nome Completo</th>
        <th>CPF</th>
        <th>Endereço</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Senha</th>
        <th>Ações</th> <!-- Comentado: Adicionei uma coluna para ações (Atualizar e Excluir) -->
    </tr>

    <?php if (!empty($clientesList)): ?> <!-- Comentado: Verifica se há clientes na lista -->
        <?php foreach ($clientesList as $cliente): ?>
        <tr>
            <!-- Comentado: Usei htmlspecialchars para evitar XSS e exibir dados de forma segura -->
            <td><?php echo htmlspecialchars($cliente['nome_completo']); ?></td> 
            <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
            <td><?php echo htmlspecialchars($cliente['endereco']); ?></td>
            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
            <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
            <td><?php echo htmlspecialchars($cliente['senha']); ?></td>

            <td>
                <!-- Comentado: Link de atualização -->
                <a href="/sharkrush/update-clientes/<?php echo $cliente['id']; ?>">Atualizar</a>
                
                <!-- Comentado: Formulário de exclusão com confirmação de ação -->
                <form action="/sharkrush/delete-clientes" method="POST" style="display:inline;">
                    <input type="hidden" name="nome_completo" value="<?php echo htmlspecialchars($cliente['nome_completo']); ?>"> <!-- Comentado: Escapando o nome do cliente para evitar XSS -->
                    <!-- Comentado: Confirmação antes de excluir -->
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?> 
        <!-- Comentado: Caso não haja clientes na lista, exibe uma mensagem informando -->
        <tr>
            <td colspan="7">Nenhum cliente cadastrado.</td> <!-- Comentado: A coluna se estende por 7 colunas (todos os campos da tabela) -->
        </tr>
    <?php endif; ?>
</table>

<!-- Comentado: Link para voltar ao cadastro de novos clientes -->
<a href="/sharkrush/public">Cadastrar novo Cliente</a>

</body>
</html>
