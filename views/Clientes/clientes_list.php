<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SharkRush - Clientes Cadastrados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(ellipse at center, #1a0000 0%, #000000 100%);
            min-height: 100vh;
            padding-left: 70px;
            overflow-x: hidden;
        }

        /* Background Animado */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: #FF1F1F;
            border-radius: 50%;
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .wave {
            position: absolute;
            left: 0;
            width: 100vw;
            height: 120px;
            background: linear-gradient(90deg, transparent, rgba(255, 31, 31, 0.07), transparent);
            opacity: 0.7;
            animation: wave 12s linear infinite;
        }

        .wave:nth-child(1) { top: 20%; animation-delay: 0s; }
        .wave:nth-child(2) { top: 40%; animation-delay: -4s; }
        .wave:nth-child(3) { top: 60%; animation-delay: -8s; }

        @keyframes wave {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* NAVBAR */
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

        .main-menu li a.active {
            background: linear-gradient(45deg, #373737 0%, #292929 100%);
            color: #ffffff;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .main-menu li a.active::before {
            transform: scaleY(1);
        }

        .main-menu li a.active .nav-icon {
            transform: scale(1.15);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .main-menu li a.nav-logout {
            background: #202020ff;
            color: #fff;
        }

        .main-menu li a.nav-logout:hover {
            background: #a0000062;
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

        /* Container Principal */
        .list-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        /* Header */
        .list-header {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(133, 21, 21, 0.37);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            animation: slideIn 0.8s ease-out;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .list-header h1 {
            color: #fff;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0;
        }

        .list-header h1 i {
            color: #FF1F1F;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
        }

        /* Botões */
        .btn {
            padding: 0.9rem 1.8rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-add {
            background: linear-gradient(135deg, #FF1F1F, #cc0000);
            color: white;
        }

        .btn-add::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-add:hover::before {
            left: 100%;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 31, 31, 0.4);
        }

        /* Card da Tabela */
        .table-card {
            background: rgba(30, 30, 30, 0.25);
            backdrop-filter: blur(24px) saturate(180%) brightness(1.1);
            border: 1.5px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(111, 22, 22, 0.37);
            border-radius: 24px;
            padding: 2rem;
            animation: slideIn 0.8s ease-out 0.2s backwards;
            overflow-x: auto;
        }

        /* Tabela */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }

        th {
            background: rgba(255, 31, 31, 0.15);
            color: #FF1F1F;
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: bold;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        th:first-child {
            border-radius: 12px 0 0 12px;
        }

        th:last-child {
            border-radius: 0 12px 12px 0;
        }

        td {
            background: rgba(255, 255, 255, 0.03);
            color: #ddd;
            padding: 1.2rem 1rem;
            border: none;
            transition: all 0.3s ease;
        }

        tr:hover td {
            background: rgba(255, 31, 31, 0.08);
            transform: scale(1.01);
        }

        tbody tr td:first-child {
            border-radius: 12px 0 0 12px;
        }

        tbody tr td:last-child {
            border-radius: 0 12px 12px 0;
        }

        /* Botões de Ação */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit {
            background: linear-gradient(135deg, #1bce66, #159c4e);
            color: white;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(27, 206, 102, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #aa1900, #8B0000);
            color: white;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(170, 25, 0, 0.4);
        }

        /* Mensagem vazia */
        .empty-message {
            text-align: center;
            padding: 3rem;
            color: #999;
            font-size: 1.1rem;
        }

        .empty-message i {
            font-size: 4rem;
            color: #FF1F1F;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Search Bar */
        .search-bar {
            position: relative;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.9rem 1.2rem 0.9rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 31, 31, 0.3);
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .search-input:focus {
            border-color: #FF1F1F;
            box-shadow: 0 0 20px rgba(255, 31, 31, 0.3);
            background: rgba(255, 255, 255, 0.1);
        }

        .search-input::placeholder {
            color: #666;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #FF1F1F;
            font-size: 1.2rem;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }

            .list-container {
                padding: 1rem;
            }

            .list-header {
                flex-direction: column;
                text-align: center;
            }

            .list-header h1 {
                font-size: 1.8rem;
                justify-content: center;
            }

            .header-actions {
                flex-direction: column;
                width: 100%;
            }

            .search-bar {
                max-width: 100%;
            }

            .table-card {
                padding: 1rem;
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="main-menu">
        <div class="logo-container">
            <a href="<?= BASE_URL ?>/dashboard" title="Dashboard">
                <img src="<?= BASE_URL ?>/VIEWS/MIDIA/Logos/logoshark.png" alt="Logo"/>
            </a>
        </div>
        <ul>
            <li>
                <a href="<?= BASE_URL ?>/list-clientes" class="active">
                    <i class="fa fa-users nav-icon"></i>
                    <span class="nav-text">Clientes</span>
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>/logout" class="nav-logout">
                    <i class="fa fa-sign-out-alt nav-icon"></i>
                    <span class="nav-text">Sair</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Background animado -->
    <div class="animated-bg">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Container principal -->
    <div class="list-container">
        <!-- Header -->
        <div class="list-header">
            <h1>
                <i class="fas fa-users"></i>
                Clientes Cadastrados
            </h1>
            <div class="header-actions">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        class="search-input" 
                        id="searchInput"
                        placeholder="Buscar cliente..."
                    >
                </div>
                <a href="<?= BASE_URL ?>/cadastro" class="btn btn-add">
                    <i class="fas fa-user-plus"></i>
                    Novo Cliente
                </a>
            </div>
        </div>

        <!-- Tabela -->
        <div class="table-card">
            <table id="clientesTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Nome Completo</th>
                        <th><i class="fas fa-id-card"></i> CPF</th>
                        <th><i class="fas fa-map-marker-alt"></i> Endereço</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-phone"></i> Telefone</th>
                        <th><i class="fas fa-cogs"></i> Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientesList)): ?>
                        <?php foreach ($clientesList as $cliente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente["nome_completo"]); ?></td>
                            <td><?php echo htmlspecialchars($cliente["cpf"]); ?></td>
                            <td><?php echo htmlspecialchars($cliente["endereco"]); ?></td>
                            <td><?php echo htmlspecialchars($cliente["email"]); ?></td>
                            <td><?php echo htmlspecialchars($cliente["telefone"]); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= BASE_URL ?>/update-clientes/<?php echo $cliente["id"]; ?>" class="btn btn-edit">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="<?= BASE_URL ?>/delete-clientes" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
                                        <input type="hidden" name="nome_completo" value="<?php echo htmlspecialchars($cliente["nome_completo"]); ?>">
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-message">
                                    <i class="fas fa-users-slash"></i>
                                    <p>Nenhum cliente cadastrado ainda.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Criar partículas de fundo
        function createParticles() {
            const container = document.querySelector('.animated-bg');
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 8) + 's';
                container.appendChild(particle);
            }
        }

        // Função de busca na tabela
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('clientesTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                for (let row of rows) {
                    const cells = row.getElementsByTagName('td');
                    let found = false;

                    for (let cell of cells) {
                        if (cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                            break;
                        }
                    }

                    row.style.display = found ? '' : 'none';
                }
            });
        }

        // Animação de entrada das linhas
        function animateTableRows() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });
        }

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            setupSearch();
            animateTableRows();
        });
    </script>
</body>
</html>