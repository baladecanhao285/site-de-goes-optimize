<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Pedido</title>

    <!-- CHAMADA DO SEU CSS GLOBAL -->
    <link rel="stylesheet" href="style.css">

    <!-- CSS LOCAL PARA ESSA PÁGINA (opcional) -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 15px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        button {
            background: #2b8cff;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<h2>Editar Pedido</h2>

<form action="editare.php?id=<?= $id ?>" method="POST">
    <label>Nome do Cliente:
        <input type="text" name="nome" value="<?= htmlspecialchars($pedido['nome']) ?>">
    </label>

    <label>Serviço:
        <select name="servico">
            <?php
            $servicos = ["Criação de Site", "Design", "Consultoria", "Impressão", "Outros"];
            foreach ($servicos as $s) {
                $sel = $pedido['servico'] === $s ? "selected" : "";
                echo "<option value='$s' $sel>$s</option>";
            }
            ?>
        </select>
    </label>

    <label>Detalhes:
        <textarea name="detalhes"><?= htmlspecialchars($pedido['detalhes']) ?></textarea>
    </label>

    <button type="submit">Atualizar</button>
</form>

<p><a href="admin_servicos.php">Voltar</a></p>

</body>
</html>
