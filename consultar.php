<?php
// ===============================
// consultar.php
// ===============================
require 'conexao.php';
$res = $conn->query("SELECT * FROM crud_demo");
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Consultar</title></head>
<body>
<h2>Consultar Dados</h2>
<a href="inserir.php">Inserir novo</a>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Texto</th><th>Ações</th></tr>
<?php while($r = $res->fetch_assoc()): ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= $r['texto'] ?></td>
<td>
<a href="editar.php?id=<?= $r['id'] ?>">Editar</a>
|
<a href="excluir.php?id=<?= $r['id'] ?>">Excluir</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>