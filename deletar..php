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