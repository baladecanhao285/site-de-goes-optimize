<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "degoess_site";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_errno) {
    die("Falha na conexão com o MySQL: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>