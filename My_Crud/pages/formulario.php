<?php
require_once '../config/auth.php';
require_once '../config/conexao.php';

$produto = ['id' => '', 'nome' => '', 'categoria' => '', 'marca' => '', 'quantidade' => '', 'preco' => '', 'descricao' => ''];

if (isset($_GET['id'])) {
    $s = $pdo->prepare("SELECT * FROM produtos WHERE id=? AND usuario_id=?");
    $s->execute([$_GET['id'], $_SESSION['usuario_id']]);
    $produto = $s->fetch();
    if (!$produto) {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $produto['id'] ? 'Editar' : 'Novo' ?> Produto — Loja de Eletrônicos</title>
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
      <h1><?= $produto['id'] ? 'Editar' : 'Novo' ?> Produto</h1>
      <a href="index.php" class="btn">← Voltar</a>
    </div>

    <div class="form-card">
      <form action="salvar.php" method="POST">
        <input type="hidden" name="id" value="<?= $produto['id'] ?>">

        <label>Nome do produto</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" placeholder="Ex: Notebook Dell Inspiron" required>

        <label>Categoria</label>
        <select name="categoria">
          <option value="">Selecione...</option>
          <?php
          $cats = ['Notebooks', 'Smartphones', 'Tablets', 'TVs', 'Monitores', 'Periféricos', 'Componentes', 'Áudio', 'Câmeras', 'Outros'];
          foreach ($cats as $cat):
          ?>
            <option value="<?= $cat ?>" <?= $produto['categoria'] === $cat ? 'selected' : '' ?>><?= $cat ?></option>
          <?php endforeach; ?>
        </select>

        <label>Marca</label>
        <input type="text" name="marca" value="<?= htmlspecialchars($produto['marca']) ?>" placeholder="Ex: Dell, Samsung, Apple">

        <label>Quantidade</label>
        <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" min="0" placeholder="0">

        <label>Preço (R$)</label>
        <input type="number" name="preco" value="<?= $produto['preco'] ?>" step="0.01" min="0" placeholder="0,00">

        <label>Descrição</label>
        <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" placeholder="Descrição breve do produto">

        <div class="form-actions">
          <button type="submit">💾 Salvar produto</button>
          <a href="index.php" class="btn btn-logout">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <script src="../assets/js/scripts.js"></script>
</body>
</html>
