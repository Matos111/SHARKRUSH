<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    background: linear-gradient(135deg, #000000 0%, #1a0000 50%, #000000 100%);
    color: #fff;
    padding: 20px;
    margin-left: 70px;
    min-height: 100vh;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #fff;
    font-size: 2.5rem;
    font-weight: bold;
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
    color: #333;
}

th {
    background-color: #ff0000;
    color: #fff;
    font-weight: bold;
}

tr:hover {
    background-color: rgba(255, 0, 0, 0.1);
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

/* NAVBAR CSS INICIO */
.main-menu {
    background: linear-gradient(180deg, #232323 0%, #1a1a1a 100%);
    position: fixed;
    top: 0;
    bottom: 0;
    height: 100%;
    left: 0;
    width: 70px;
    overflow: hidden;
    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
    z-index: 1002;
}
.main-menu:hover {
    width: 280px;
    box-shadow: 2px 0 25px rgba(255, 0, 0, 0.15);
}
.main-menu ul {
    margin: 7px 0;
    padding: 0;
    list-style: none;
}
.main-menu li {
    position: relative;
    display: block;
    width: 250px;
}
.main-menu li a {
    position: relative;
    width: 100%;
    display: table;
    color: #c5c5c5;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-top: 1px solid rgba(78, 78, 78, 0.2);
    padding: 10px 0;
    height: 55px;
    overflow: hidden;
}
.main-menu .nav-icon {
    position: relative;
    display: table-cell;
    width: 70px;
    height: 55px;
    text-align: center;
    vertical-align: middle;
    font-size: 26px;
    padding: 12px 0;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.main-menu .nav-text {
    position: relative;
    display: table-cell;
    vertical-align: middle;
    width: 190px;
    font-size: 16px;
    padding-left: 15px;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.main-menu:hover .nav-text {
    opacity: 1;
    transform: translateX(0);
}
.main-menu li:hover > a {
    color: #ffffff;
    background: linear-gradient(45deg, #323232 0%, #2b2b2b 100%);
    transform: translateX(8px);
    box-shadow: -5px 0 15px rgba(0, 0, 0, 0.2);
}
.main-menu li:hover .nav-icon {
    transform: scale(1.15);
    text-shadow: 0 0 10px rgba(175, 175, 175, 0.5);
}
.main-menu li a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 3px;
    height: 100%;
    background: #ff0000;
    transform: scaleY(0);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.main-menu li:hover a::before {
    transform: scaleY(1);
}
.logo-container {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2px;
}
.logo-container img {
    max-width: 100%;
    max-height: 120px;
}
.main-menu li a.active {
    background: linear-gradient(45deg, #373737 0%, #292929 100%);
    color: #ffffff;
    position: relative;
    box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.2);
}
.main-menu li a.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 3px;
    height: 100%;
    background: #ff0303;
    transform: scaleY(1);
}
.main-menu li a.active .nav-icon {
    transform: scale(1.15);
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}
.main-menu li a.nav-logout {
    background: #8B0000;
    color: #fff;
}
.main-menu li a.nav-logout:hover {
    background: #A00000;
}
/* NAVBAR CSS FIM */
</style>

<!-- ===== NAVBAR HTML INICIO ===== -->
<nav class="main-menu">
    <div class="logo-container">
        <a href="/SHARKRUSH/dashboard" title="Dashboard">
            <img src="../midia/Logos/logoshark.png" alt="Logo"/>
        </a>
    </div>
    <ul>
        <li>
            <a href="/SHARKRUSH/list-clientes" class="active">
                <i class="fa fa-users nav-icon"></i>
                <span class="nav-text">Clientes</span>
            </a>
        </li>
        <li>
            <a href="/SHARKRUSH/logout" class="nav-logout">
                <i class="fa fa-sign-out-alt nav-icon"></i>
                <span class="nav-text">Sair</span>
            </a>
        </li>
    </ul>
</nav>
<!-- ===== NAVBAR HTML FIM ===== -->

<h1>CLIENTES CADASTRADOS</h1>
<table border="1">
    <tr>
        <th>Nome Completo</th>
        <th>CPF</th>
        <th>Endereco</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Acoes</th>
    </tr>

    <?php if (!empty($clientesList)): ?>
        <?php foreach ($clientesList as $cliente): ?>
        <tr>
            <td><?php echo htmlspecialchars($cliente["nome_completo"]); ?></td>
            <td><?php echo htmlspecialchars($cliente["cpf"]); ?></td>
            <td><?php echo htmlspecialchars($cliente["endereco"]); ?></td>
            <td><?php echo htmlspecialchars($cliente["email"]); ?></td>
            <td><?php echo htmlspecialchars($cliente["telefone"]); ?></td>
            <td>
                <a href="/update-clientes/<?php echo $cliente[
                  "id"
                ]; ?>" class="btn btn-edit">Atualizar</a>
                <form action="/delete-clientes" method="POST" style="display:inline;">
                    <input type="hidden" name="nome_completo" value="<?php echo htmlspecialchars(
                      $cliente["nome_completo"],
                    ); ?>">
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

<a href="/cadastro" class="btn btn-add">Cadastrar novo Cliente</a>
</body>
</html>
