<?php require_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>My Crud</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<!-- Modal de confirmação -->
<div id="overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);align-items:center;justify-content:center;z-index:100">
  <div style="background:#fff;border-radius:14px;padding:1.5rem;width:320px">
    <p style="font-weight:600;margin-bottom:.5rem">⚠️ Confirmar exclusão</p>
    <p style="font-size:13px;color:#666;margin-bottom:1rem">Excluir <strong id="modal-nome"></strong>?</p>
    <div style="display:flex;gap:.5rem;justify-content:flex-end">
      <button onclick="fecharModal()">Cancelar</button>
      <a id="btn-confirmar" href="#" style="background:#ef4444;color:#fff;padding:.5rem 1rem;border-radius:8px;text-decoration:none">Excluir</a>
    </div>
  </div>
</div>

<!-- Toast automático -->
<?php if(isset($_GET['msg'])): ?>
<script>
  window.addEventListener('load', function() {
    <?php if($_GET['msg'] === 'salvo'): ?>
      toast('✅ Produto salvo com sucesso!', 'success');
    <?php elseif($_GET['msg'] === 'excluido'): ?>
      toast('🗑️ Produto excluído!', 'error');
    <?php endif; ?>
  });
</script>
<?php endif; ?>

<script src="../assets/js/scripts.js"></script>
</body>

<body>
  <h1>Produtos</h1>
  <a href="formulario.php" class= "btn">+ Adicionar produto</a>
  <table>
    <tr>
      <th>Nome</th>
      <th>Categoria</th>
      <th>Quantidade</th>
      <th>Preço</th>
      <th>Ações</th>
    </tr>
    <?php
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
    while ($row = $stmt->fetch()): ?>
      <tr>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['categoria'] ?></td>
        <td><?= $row['quantidade'] ?></td>
        <td>R$ <?= $row['preco'] ?></td>
        <td>
          <a href="formulario.php?id=<?= $row['id'] ?>">Editar</a>
          <button onclick="abrirModal(<?= $row['id'] ?>, '<?= $row['nome'] ?>')">Excluir</button>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>

</html>