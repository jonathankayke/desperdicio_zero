<?php
// conexao.php

$host = 'localhost';
$dbname = 'desperdicio_zero';
$username = 'desperdicio_zero';
$password = 'desperdicio_zero';

try {
    // Conexão usando PDO (Mais seguro contra SQL Injection)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>