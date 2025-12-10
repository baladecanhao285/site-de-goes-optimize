<?php
// ===============================
// inserir.php
// ===============================
require 'conexao.php';
$msg = '';
if($_POST){
$t = $_POST['texto'];
$stmt = $conn->prepare("INSERT INTO crud_demo(texto) VALUES(?)");
$stmt->bind_param("s", $t);
$stmt->execute();
header("Location: consultar.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Inserir</title></head>
<body>
<h2>Inserir</h2>
<form method="POST">
<input type="text" name="texto" required>
<button type="submit">Salvar</button>
</form>
<a href="consultar.php">Voltar</a>
</body>
</html>