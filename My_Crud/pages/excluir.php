<?php
require_once '../config/conexao.php';
$id = (int)$_GET['id'];
if ($id > 0) {
  $s = $pdo->prepare("DELETE FROM produtos WHERE id=?");
  $s->execute([$id]);
}
header("Location: index.php?msg=excluido");
exit;
