<?php
require 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fale Conosco — Administração</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
        .btn { padding: 6px 10px; text-decoration: none; border-radius: 4px; }
        .edit { background: #ffb300; color: #000; }
        .delete { background: #ff3b3b; color: #fff; }
    </style>
</head>
<body>

<h1>Painel — Contatos do Fale Conosco</h1>

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'editado') {
        echo "<p style='color:green;'>Contato editado com sucesso!</p>";
    }
    if ($_GET['status'] === 'excluido') {
        echo "<p style='color:red;'>Contato excluído com sucesso!</p>";
    }
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Serviço</th>
        <th>Orçamento</th>
        <th>Mensagem</th>
        <th>Ações</th>
    </tr>

<?php
$sql = "SELECT c.id, c.nome, c.email, c.mensagem,
        s.nome AS servico_nome,
        o.faixa AS orcamento_faixa
        FROM contatos c
        LEFT JOIN servicos s ON c.servico_id = s.id
        LEFT JOIN orcamentos o ON c.orcamento_id = o.id
        ORDER BY c.id DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['nome']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['servico_nome']) ?></td>
    <td><?= htmlspecialchars($row['orcamento_faixa']) ?></td>
    <td><?= nl2br(htmlspecialchars($row['mensagem'])) ?></td>
    <td>
        <a class="btn edit" href="editar.php?id=<?= $row['id'] ?>">Editar</a>
        <a class="btn delete" href="excluir.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Tem certeza que deseja excluir este contato?');">Excluir</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
