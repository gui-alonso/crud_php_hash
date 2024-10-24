<?php
$host = 'localhost';
$user = 'root'; // Seu usuário do MySQL
$pass = '';     // Sua senha do MySQL
$dbname = 'crud_php_hash';

// Criar conexão
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
