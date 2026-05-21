<?php require_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php require_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Crud - Produtos</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

  <main class="container">
    
    <h1>Produtos</h1>
    <a href="formulario.php" class="btn btn-primary">+ Adicionar produto</a>

    <div class="table-responsive">
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmt = $pdo->query("SELECT * FROM produtos ORDER BY id DESC");
          while ($row = $stmt->fetch()): ?>
            <tr>
              <td><?= htmlspecialchars($row['nome']) ?></td>
              <td><?= htmlspecialchars($row['categoria']) ?></td>
              <td><?= $row['quantidade'] ?></td>
              <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
              <td class="acoes">
                <a href="formulario.php?id=<?= $row['id'] ?>" class="link-editar">Editar</a>
                <button type="button" class="btn-deletar" onclick="abrirModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nome'], ENT_QUOTES) ?>')">Excluir</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </main>

  <div id="overlay" class="modal-overlay">
    <div class="modal-card">
      <p class="modal-title">⚠️ Confirmar exclusão</p>
      <p class="modal-text">Excluir <strong id="modal-nome"></strong>?</p>
      <div class="modal-buttons">
        <button type="button" class="btn-cancelar" onclick="fecharModal()">Cancelar</button>
        <a id="btn-confirmar" href="#" class="btn-confirmar-exclusao">Excluir</a>
      </div>
    </div>
  </div>

  <script src="../assets/js/scripts.js"></script>

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

</body>
</html>