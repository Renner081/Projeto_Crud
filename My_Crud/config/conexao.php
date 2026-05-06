<?php
$host   = "localhost";
$banco  = "My_Crud";
$user   = "root";
$senha  = ""; // no XAMPP a senha é vazia

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8",
        $user,
        $senha
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
