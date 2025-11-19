<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/css/styles.css">
    <title>Atualizar Exercício</title>
    <style>
        * {
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
            color: rgb(0, 0, 0);
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
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus {
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
            background-color: rgb(170, 25, 0);
            transform: scale(1.02);
        }

        .btn-voltar {
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
            margin: 20px auto 0 auto;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
            background-color: rgb(0, 0, 0);
            display: block;
            max-width: 500px;
        }

        .btn-voltar:hover {
            background: rgb(170, 25, 0);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<h1>Atualizar Exercício</h1>

<form action="<?= BASE_URL ?>/update-exercicio" method="POST">
    <input type="hidden" name="id" value="<?php echo $exercicioInfo['id']; ?>">

    <label for="grupo_muscular">Grupo Muscular:</label>
    <select id="grupo_muscular" name="grupo_muscular" required>
        <option value="">Selecione</option>
        <?php
        $grupos = ['Peito', 'Costas', 'Pernas', 'Ombros', 'Bíceps', 'Tríceps', 'Abdômen', 'Cardio'];
        foreach ($grupos as $grupo) {
            $selected = ($exercicioInfo['grupo_muscular'] == $grupo) ? 'selected' : '';
            echo "<option value=\"$grupo\" $selected>$grupo</option>";
        }
        ?>
    </select>

    <label for="nome_exercicio">Nome do Exercício:</label>
    <input type="text" id="nome_exercicio" name="nome_exercicio" value="<?php echo $exercicioInfo['nome_exercicio']; ?>" required>

    <label for="descricao">Descrição:</label>
    <input type="text" id="descricao" name="descricao" value="<?php echo $exercicioInfo['descricao']; ?>">

    <input type="submit" value="Atualizar Exercício">
</form>

<a href="<?= BASE_URL ?>/list-exercicio" class="btn-voltar">Voltar para a Lista</a>

</body>
</html>
