<?php
require_once '../config/auth.php';
require_once '../config/conexao.php';

// Busca só os produtos do usuário logado
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE usuario_id = ? ORDER BY id DESC");
$stmt->execute([$_SESSION['usuario_id']]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Loja de Eletrônicos</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-brand">🔌 Loja de Eletrônicos</div>
    <div class="navbar-user">
      Olá, <strong><?= $_SESSION['usuario_nome'] ?></strong>
      <a href="logout.php" class="btn btn-logout">Sair</a>
    </div>
  </div>

  <div class="container">
    <div class="page-header">
      <h1>Meus Produtos</h1>
      <a href="formulario.php" class="btn">+ Adicionar produto</a>
    </div>

    <table>
      <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Marca</th>
        <th>Qtd</th>
        <th>Preço</th>
        <th>Ações</th>
      </tr>
      <?php while ($row = $stmt->fetch()): ?>
        <tr>
          <td><?= htmlspecialchars($row['nome']) ?></td>
          <td><?= htmlspecialchars($row['categoria']) ?></td>
          <td><?= htmlspecialchars($row['marca']) ?></td>
          <td><?= $row['quantidade'] ?></td>
          <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
          <td>
            <a href="formulario.php?id=<?= $row['id'] ?>" class="btn btn-edit">Editar</a>
            <button class="btn btn-delete" onclick="abrirModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nome']) ?>')">Excluir</button>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <!-- Modal de confirmação -->
  <div id="overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);align-items:center;justify-content:center;z-index:100">
    <div class="modal">
      <p class="modal-title">⚠️ Confirmar exclusão</p>
      <p class="modal-text">Excluir <strong id="modal-nome"></strong>?</p>
      <div class="modal-btns">
        <button class="btn" onclick="fecharModal()">Cancelar</button>
        <a id="btn-confirmar" href="#" class="btn btn-delete">Excluir</a>
      </div>
    </div>
  </div>

  <!-- Toast automático após salvar/excluir -->
  <?php if (isset($_GET['msg'])): ?>
  <script>
    window.addEventListener('load', function () {
      <?php if ($_GET['msg'] === 'salvo'): ?>
        toast('✅ Produto salvo com sucesso!', 'success');
      <?php elseif ($_GET['msg'] === 'excluido'): ?>
        toast('🗑️ Produto excluído!', 'error');
      <?php endif; ?>
    });
  </script>
  <?php endif; ?>

  <script src="../assets/js/scripts.js"></script>
</body>
</html>
