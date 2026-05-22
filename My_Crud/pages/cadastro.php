<?php
session_start();
require_once '../config/conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Criptografa a senha — NUNCA salva senha pura no banco!
    $hash = password_hash($senha, PASSWORD_BCRYPT);

    try {
        $s = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?,?,?)");
        $s->execute([$nome, $email, $hash]);
        header("Location: login.php?msg=cadastrado");
        exit;
    } catch (Exception $e) {
        $erro = "Este email já está cadastrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro — Loja de Eletrônicos</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">🔌</div>
    <h1>Criar conta</h1>
    <p class="auth-sub">Cadastre-se para gerenciar seus produtos</p>

    <?php if ($erro): ?>
      <div class="alert alert-error"><?= $erro ?></div>
    <?php endif; ?>

    <form action="cadastro.php" method="POST">
      <label>Nome</label>
      <input type="text" name="nome" placeholder="Seu nome" required>
      <label>Email</label>
      <input type="email" name="email" placeholder="seu@email.com" required>
      <label>Senha</label>
      <input type="password" name="senha" placeholder="Mínimo 6 caracteres" required minlength="6">
      <button type="submit">Criar conta</button>
    </form>
    <p class="auth-link">Já tem conta? <a href="login.php">Entrar</a></p>
  </div>
  <script src="../assets/js/scripts.js"></script>
</body>
</html>
