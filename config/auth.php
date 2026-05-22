<?php
// Verifica se o usuário está logado
// Inclua no topo de cada página protegida com: require_once '../config/auth.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
