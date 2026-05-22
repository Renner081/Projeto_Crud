<?php
require_once '../config/auth.php';
require_once '../config/conexao.php';

$id = (int)$_GET['id'];

if ($id > 0) {
    // Garante que só exclui produtos do próprio usuário
    $s = $pdo->prepare("DELETE FROM produtos WHERE id=? AND usuario_id=?");
    $s->execute([$id, $_SESSION['usuario_id']]);
}

header("Location: index.php?msg=excluido");
exit;
