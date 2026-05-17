<?php
require_once '../config/conexao.php';
$id   = $_POST['id'] ?? null;
$nome = trim($_POST['nome']);
$cat  = trim($_POST['categoria']);
$qty  = (int)$_POST['quantidade'];
$preco= (float)$_POST['preco'];
if($id) {
  $s = $pdo->prepare("UPDATE produtos SET nome=?,categoria=?,quantidade=?,preco=? WHERE id=?");
  $s->execute([$nome,$cat,$qty,$preco,$id]);
} else {
  $s = $pdo->prepare("INSERT INTO produtos (nome,categoria,quantidade,preco) VALUES(?,?,?,?)");
  $s->execute([$nome,$cat,$qty,$preco]);
}
header("Location: index.php?msg=salvo");
exit;