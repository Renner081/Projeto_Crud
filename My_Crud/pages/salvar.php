<?php
require_once '../config/auth.php';
require_once '../config/conexao.php';

$id       = $_POST['id'] ?? null;
$nome     = trim($_POST['nome']);
$cat      = trim($_POST['categoria']);
$marca    = trim($_POST['marca']);
$qty      = (int)$_POST['quantidade'];
$preco    = (float)$_POST['preco'];
$descricao = trim($_POST['descricao']);

if ($id) {
    // UPDATE — garante que só edita produtos do próprio usuário
    $s = $pdo->prepare(
        "UPDATE produtos SET nome=?, categoria=?, marca=?, quantidade=?, preco=?, descricao=?
         WHERE id=? AND usuario_id=?"
    );
    $s->execute([$nome, $cat, $marca, $qty, $preco, $descricao, $id, $_SESSION['usuario_id']]);
} else {
    // INSERT — salva com o usuario_id do usuário logado
    $s = $pdo->prepare(
        "INSERT INTO produtos (nome, categoria, marca, quantidade, preco, descricao, usuario_id)
         VALUES (?,?,?,?,?,?,?)"
    );
    $s->execute([$nome, $cat, $marca, $qty, $preco, $descricao, $_SESSION['usuario_id']]);
}

header("Location: index.php?msg=salvo");
exit;
