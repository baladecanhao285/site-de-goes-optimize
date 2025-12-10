<?php
require 'db_connect.php';
if (!isset($_GET['id'])) die("ID inválido.");
$id = intval($_GET['id']);
$sql = $conn->prepare("DELETE FROM contatos WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();
header("Location: listar_contatos.php?status=excluido");
exit;
