<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

$sql    = "SELECT id, nome, imagem FROM jogos ORDER BY id DESC LIMIT 9";
$result = mysqli_query($conexao, $sql);
$jogos  = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jogos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Game Shelf</title>
</head>
<body>

<main class="shelf-wrapper">
  <p class="shelf-label">LANÇAMENTOS RECENTES</p>

  <div class="shelf-grid">
    <?php foreach ($jogos as $i => $jogo):
      $img  = htmlspecialchars($jogo['imagem']);
      $nome = htmlspecialchars($jogo['nome']);
      $id   = (int)$jogo['id'];
    ?>
      <a href="jogo.php?id=<?= $id ?>"
         class="shelf-card"
         title="<?= $nome ?>"
         style="animation-delay: <?= $i * 0.07 ?>s">
        <img src="../main/Capas/jogos/<?= $img ?>" alt="<?= $nome ?>" class="shelf-card__img">
        <div class="shelf-card__footer">
          <span class="shelf-card__nome"><?= $nome ?></span>
        </div>
      </a>
    <?php endforeach; ?>

    <?php for ($i = count($jogos); $i < 9; $i++): ?>
      <div class="shelf-card shelf-card--vazio"
           style="animation-delay: <?= $i * 0.07 ?>s">
        <span class="shelf-card__vazio-icon">?</span>
      </div>
    <?php endfor; ?>
  </div>
</main>

<?php require_once "rodape.php"; ?>
</body>
</html>
