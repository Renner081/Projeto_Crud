<?php require_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>My Crud</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

</body>

<body>
  <h1>Produtos</h1>
  <button><a href="formulario.php">+ Adicionar produto</a></button>
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
          <a href="excluir.php?id=<?= $row['id'] ?>"
            onclick="abrirModal(<?= $row['id'] ?>, '<?= $row['nome'] ?>')">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>

</html>