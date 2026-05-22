<?php
session_start();
require_once '../config/conexao.php';

// Se já estiver logado vai para o index
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $s = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $s->execute([$email]);
    $user = $s->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        session_regenerate_id(true);
        $_SESSION['usuario_id']   = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        header("Location: index.php");
        exit;
    }
    $erro = "Email ou senha incorretos!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login — Loja de Eletrônicos</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">🔌</div>
    <h1>Bem-vindo de volta</h1>
    <p class="auth-sub">Entre na sua conta para gerenciar os produtos</p>

    <?php if ($erro): ?>
      <div class="alert alert-error"><?= $erro ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] === 'cadastrado'): ?>
      <div class="alert alert-success">✅ Conta criada! Faça login.</div>
    <?php endif; ?>

    <form action="login.php" method="POST">
      <label>Email</label>
      <input type="email" name="email" placeholder="seu@email.com" required>
      <label>Senha</label>
      <input type="password" name="senha" placeholder="••••••••" required>
      <button type="submit">Entrar</button>
    </form>
    <p class="auth-link">Não tem conta? <a href="cadastro.php">Criar conta</a></p>
  </div>
  <script src="../assets/js/scripts.js"></script>
</body>
</html>
