<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

$q      = isset($_GET['q']) ? trim($_GET['q']) : '';
$jogos  = [];

if ($q !== '') {
    $termo  = '%' . mysqli_real_escape_string($conexao, $q) . '%';
    $sql    = "SELECT id, nome, imagem FROM jogos WHERE nome LIKE '$termo' ORDER BY nome ASC";
    $result = mysqli_query($conexao, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jogos[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Busca — Game Shelf</title>
</head>
<body>

<main class="search-results-wrapper">

  <?php if ($q === ''): ?>

    <p class="search-nenhum">Digite algo para buscar um jogo.</p>

  <?php elseif (empty($jogos)): ?>

    <p class="search-results-title">RESULTADOS PARA "<?= htmlspecialchars(strtoupper($q)) ?>"</p>
    <p class="search-nenhum">Nenhum jogo encontrado.</p>

  <?php else: ?>

    <p class="search-results-title">
      RESULTADOS PARA "<?= htmlspecialchars(strtoupper($q)) ?>" — <?= count($jogos) ?> encontrado<?= count($jogos) !== 1 ? 's' : '' ?>
    </p>

    <div class="shelf-grid">
      <?php foreach ($jogos as $i => $jogo):
        $img  = htmlspecialchars($jogo['imagem']);
        $nome = htmlspecialchars($jogo['nome']);
        $id   = (int) $jogo['id'];
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
    </div>

  <?php endif; ?>

</main>

<?php require_once "rodape.php"; ?>
</body>
</html>
