<?php 
session_start();
require 'conexao.php';

// pegar lista
$res = $conn->query("SELECT * FROM pedidos_servico ORDER BY criado_em DESC");
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>Painel - Pedidos de Serviço</title>

    <style>
        body {
            margin: 0;
            padding: 30px;
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
            text-align: center;
        }

        .card {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.08);
        }

        .top-actions {
            text-align: right;
            margin-bottom: 20px;
        }

        .top-actions a {
            background: #0066ff;
            color: #fff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            transition: .2s;
        }

        .top-actions a:hover {
            background: #004fcc;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            font-size: 15px;
        }

        thead tr th {
            background: #e8efff;
            padding: 14px;
            font-weight: 700;
            border-bottom: 2px solid #d0d8f0;
            text-align: left;
        }

        tbody tr {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: .2s;
        }

        tbody tr:hover {
            transform: scale(1.005);
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        tbody tr td {
            padding: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr td:first-child {
            border-radius: 12px 0 0 12px;
        }

        tbody tr td:last-child {
            border-radius: 0 12px 12px 0;
        }

        /* zebra */
        tbody tr:nth-child(even) {
            background: #f9fbff;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: .2s;
        }

        .btn-edit {
            background: #008cff;
            color: #fff;
        }

        .btn-edit:hover {
            background: #006bcc;
        }

        .btn-del {
            background: #ff4d4d;
            color: #fff;
        }

        .btn-del:hover {
            background: #cc0000;
        }
    </style>
</head>

<body>

    <h2>Pedidos de Serviço</h2>

    <div class="card">

        <div class="top-actions">
            <a href="servicos.php">Página pública de envio</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Serviço</th>
                    <th>Detalhes</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php while($r = $res->fetch_assoc()): ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= htmlspecialchars($r['nome_cliente']) ?></td>
                    <td><?= htmlspecialchars($r['email_cliente']) ?></td>
                    <td><?= htmlspecialchars($r['servico_escolhido']) ?></td>
                    <td><?= nl2br(htmlspecialchars($r['detalhes'])) ?></td>
                    <td><?= $r['criado_em'] ?></td>
                    <td>
                        <a class="btn btn-edit" href="editar_servico.php?id=<?= $r['id'] ?>">Editar</a>
                        <a class="btn btn-del" href="excluir_servico.php?id=<?= $r['id'] ?>" onclick="return confirm('Excluir esse pedido?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>

        </table>

    </div>

</body>
</html>
