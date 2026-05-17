<?php
require_once '../config/conexao.php';
$produto = ['id' => '', 'nome' => '', 'categoria' => '', 'quantidade' => '', 'preco' => ''];
if (isset($_GET['id'])) {
  $s = $pdo->prepare("SELECT * FROM produtos WHERE id=?");
  $s->execute([$_GET['id']]);
  $produto = $s->fetch();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Formulário</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <h1><?= $produto['id'] ? 'Editar' : 'Novo' ?> Produto</h1>
  <form action="salvar.php" method="POST">
    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= $produto['nome'] ?>" required>
    <label>Categoria:</label>
    <input type="text" name="categoria" value="<?= $produto['categoria'] ?>">
    <label>Quantidade:</label>
    <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" min="0">
    <label>Preço:</label>
    <input type="number" name="preco" value="<?= $produto['preco'] ?>" step="0.01">
    <button type="submit">Salvar</button>
    <a href="index.php" class= "btn">Cancelar</a>
  </form>
  <script src="../assets/js/scripts.js"></script>
</body>

</html>