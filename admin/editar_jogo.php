<?php
require_once "logado.php";
require_once "../includes/conexao.php";
require_once "../main/upperbar.php";
require_once "../main/sidebar.php";

$jogos = [];
$result = mysqli_query($conexao, "SELECT id, nome, imagem FROM jogos ORDER BY id DESC");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jogos[] = $row;
    }
}

$deleted = isset($_GET['deleted']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Editar Jogos - Game Shelf</title>
</head>
<body>

<main class="shelf-wrapper">
  <p class="shelf-label">TODOS OS JOGOS — CLIQUE PARA EDITAR</p>

  <?php if ($deleted): ?>
    <p class="msg msg--sucesso" style="margin-bottom:20px;">Jogo excluído com sucesso.</p>
  <?php endif; ?>

  <?php if (empty($jogos)): ?>
    <p style="color:#888; font-family:'Orbitron',sans-serif; font-size:12px;">Nenhum jogo cadastrado ainda.</p>
  <?php else: ?>
    <div class="shelf-grid shelf-grid--6">
      <?php foreach ($jogos as $i => $jogo):
        $img  = htmlspecialchars($jogo['imagem']);
        $nome = htmlspecialchars($jogo['nome']);
        $id   = (int)$jogo['id'];
      ?>
        <a href="editar_jogo_form.php?id=<?= $id ?>"
           class="shelf-card"
           title="Editar: <?= $nome ?>"
           style="animation-delay: <?= $i * 0.04 ?>s">
          <img src="../main/Capas/jogos/<?= $img ?>" alt="<?= $nome ?>" class="shelf-card__img">
          <div class="shelf-card__footer shelf-card__footer--always">
            <span class="shelf-card__nome"><?= $nome ?></span>
            <span class="shelf-card__edit-badge">✏ editar</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<?php require_once "../main/rodape.php"; ?>
</body>
</html>
