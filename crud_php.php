<?php
// ===============================
// conexao.php
// ===============================
$host = "localhost";
$user = "root";
$pass = "";
$db = "degoess_site";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>

<?php
// ===============================
// criar_tabela.php (rodar 1 vez)
// ===============================
require 'conexao.php';
$conn->query("CREATE TABLE IF NOT EXISTS crud_demo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    texto VARCHAR(255) NOT NULL
)");
echo "Tabela criada";
?>

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

<?php
// ===============================
// editar.php
// ===============================
require 'conexao.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM crud_demo WHERE id=$id");
$dados = $res->fetch_assoc();
if($_POST){
    $t = $_POST['texto'];
    $stmt = $conn->prepare("UPDATE crud_demo SET texto=? WHERE id=?");
    $stmt->bind_param("si", $t, $id);
    $stmt->execute();
    header("Location: consultar.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Editar</title></head>
<body>
<h2>Editar</h2>
<form method="POST">
<input type="text" name="texto" required value="<?= $dados['texto'] ?>">
<button type="submit">Atualizar</button>
</form>
<a href="consultar.php">Voltar</a>
</body>
</html>

<?php
// ===============================
// excluir.php
// ===============================
require 'conexao.php';
$id = $_GET['id'];
$conn->query("DELETE FROM crud_demo WHERE id=$id");
header("Location: consultar.php");
exit;
?>
