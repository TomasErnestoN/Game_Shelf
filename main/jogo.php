<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$sql    = "SELECT * FROM jogos WHERE id = ?";
$stmt   = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$jogo   = mysqli_fetch_assoc($result);

if (!$jogo) {
    header("Location: index.php");
    exit;
}

function youtubeEmbed($url) {
    if (empty($url)) return null;
    preg_match('/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
    if (!empty($matches[1])) {
        return "https://www.youtube.com/embed/" . $matches[1] . "?rel=0&modestbranding=1";
    }
    return null;
}

$embedUrl   = youtubeEmbed($jogo['trailer']);
$nome       = htmlspecialchars($jogo['nome']);
$descricao  = htmlspecialchars($jogo['descricao']);
$preco      = number_format((float)$jogo['preço'], 2, ',', '.');
$imagem     = htmlspecialchars($jogo['imagem']);
$categoria1 = htmlspecialchars($jogo['categoria1']);
$categoria2 = htmlspecialchars($jogo['categoria2']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title><?= $nome ?> — Game Shelf</title>
</head>
<body>

<main class="jogo-wrapper">

  <p class="jogo-breadcrumb">
    <a href="index.php">INÍCIO</a> &rsaquo; <?= $nome ?>
  </p>

  <div class="jogo-layout">

    <div class="jogo-capa-col">
      <div class="jogo-capa-frame">
        <?php if ($imagem): ?>
          <img src="../main/Capas/jogos/<?= $imagem ?>" alt="<?= $nome ?>" class="jogo-capa-img">
        <?php endif; ?>
      </div>

      <div class="jogo-tags">
        <?php if ($categoria1): ?>
          <span class="jogo-tag"><?= $categoria1 ?></span>
        <?php endif; ?>
        <?php if ($categoria2): ?>
          <span class="jogo-tag"><?= $categoria2 ?></span>
        <?php endif; ?>
      </div>
    </div>

    <div class="jogo-content-col">

      <h1 class="jogo-nome"><?= $nome ?></h1>

      <p class="jogo-preco <?= ($jogo['preço'] == 0) ? 'jogo-preco--gratis' : '' ?>">
        <?= ($jogo['preço'] == 0) ? 'GRÁTIS' : 'R$ ' . $preco ?>
      </p>

      <p class="jogo-descricao-titulo">Descrição</p>
      <p class="jogo-descricao"><?= $descricao ?></p>

      <p class="jogo-trailer-titulo">Trailer</p>

      <?php if ($embedUrl): ?>
        <div class="jogo-trailer-frame">
          <iframe
            src="<?= htmlspecialchars($embedUrl) ?>"
            title="Trailer de <?= $nome ?>"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
      <?php else: ?>
        <div class="jogo-sem-trailer">SEM TRAILER DISPONÍVEL</div>
      <?php endif; ?>

      <a href="index.php" class="jogo-voltar">← VOLTAR À VITRINE</a>
    </div>

  </div>
</main>

<?php require_once "rodape.php"; ?>
</body>
</html>
