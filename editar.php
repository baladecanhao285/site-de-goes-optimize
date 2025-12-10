<?php
require 'db_connect.php';
if (!isset($_GET['id'])) die("ID inválido.");
$id = intval($_GET['id']);
$sql = $conn->prepare("SELECT * FROM contatos WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();
$contato = $result->fetch_assoc();
if (!$contato) die("Contato não encontrado.");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
    $update = $conn->prepare("UPDATE contatos SET nome=?, email=?, mensagem=? WHERE id=?");
    $update->bind_param("sssi", $nome, $email, $mensagem, $id);
    $update->execute();
    header("Location: listar_contatos.php?status=editado");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
</head>
<body>
<h1>Editar Contato</h1>
<form method="post">
    Nome:<br>
    <input type="text" name="nome" value="<?= htmlspecialchars($contato['nome']) ?>" required><br><br>
    Email:<br>
    <input type="email" name="email" value="<?= htmlspecialchars($contato['email']) ?>" required><br><br>
    Mensagem:<br>
    <textarea name="mensagem" rows="6" required><?= htmlspecialchars($contato['mensagem']) ?></textarea><br><br>
    <button type="submit">Salvar</button>
</form>
</body>
</html>
