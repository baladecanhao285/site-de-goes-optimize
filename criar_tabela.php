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