<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "creatina_fe";

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
