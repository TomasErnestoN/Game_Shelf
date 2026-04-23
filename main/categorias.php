<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

$categorias = ['2D','Ação','FPS','Terror','Esporte','Corrida','Sobrevivência','Simulação','RPG','Luta','Online'];

$categoriaSelecionada = isset($_GET['cat']) ? trim($_GET['cat']) : '';

// Valida se a categoria existe
if ($categoriaSelecionada && !in_array($categoriaSelecionada, $categorias)) {
    $categoriaSelecionada = '';
}

$jogos = [];
if ($categoriaSelecionada) {
    $cat = mysqli_real_escape_string($conexao, $categoriaSelecionada);
    $result = mysqli_query($conexao, "SELECT id, nome, imagem FROM jogos WHERE categoria1 = '$cat' OR categoria2 = '$cat' ORDER BY id DESC");
} else {
    $result = mysqli_query($conexao, "SELECT id, nome, imagem FROM jogos ORDER BY id DESC");
}

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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Categorias — Game Shelf</title>

  <style>
    /* ===== FILTROS DE CATEGORIA ===== */

    .cat-filtros {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 32px;
    }

    .cat-btn {
      font-family: 'Orbitron', sans-serif;
      font-size: 9px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      text-decoration: none;
      padding: 7px 18px;
      border-radius: 20px;
      border: 1.5px solid #3c91b0;
      color: #3c91b0;
      background: transparent;
      transition: background 0.2s, color 0.2s, transform 0.18s;
    }

    .cat-btn:hover {
      background: #3c91b0;
      color: #fff;
      transform: scale(1.05);
    }

    .cat-btn--ativo {
      background: linear-gradient(90deg, #2f7c99, #3c91b0);
      color: #fff;
      border-color: transparent;
    }

    .cat-btn--ativo:hover {
      transform: scale(1.05);
    }

    .cat-vazio {
      font-family: 'Orbitron', sans-serif;
      font-size: 12px;
      letter-spacing: 2px;
      color: #aaa;
      margin-top: 40px;
    }

    body.dark .cat-btn {
      border-color: #3c91b0;
      color: #3c91b0;
    }

    body.dark .cat-btn:hover,
    body.dark .cat-btn--ativo {
      background: linear-gradient(90deg, #2f7c99, #3c91b0);
      color: #fff;
    }
  </style>
</head>
<body>

<main class="shelf-wrapper">

  <p class="shelf-label">CATEGORIAS</p>

  <!-- Filtros -->
  <div class="cat-filtros">
    <a href="categorias.php"
       class="cat-btn <?= $categoriaSelecionada === '' ? 'cat-btn--ativo' : '' ?>">
      Todos
    </a>
    <?php foreach ($categorias as $cat): ?>
      <a href="categorias.php?cat=<?= urlencode($cat) ?>"
         class="cat-btn <?= $categoriaSelecionada === $cat ? 'cat-btn--ativo' : '' ?>">
        <?= htmlspecialchars($cat) ?>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Grid de jogos -->
  <?php if (empty($jogos)): ?>
    <p class="cat-vazio">Nenhum jogo encontrado nessa categoria.</p>
  <?php else: ?>
    <div class="shelf-grid">
      <?php foreach ($jogos as $i => $jogo):
        $img  = htmlspecialchars($jogo['imagem']);
        $nome = htmlspecialchars($jogo['nome']);
        $id   = (int)$jogo['id'];
      ?>
        <a href="jogo.php?id=<?= $id ?>"
           class="shelf-card"
           title="<?= $nome ?>"
           style="animation-delay: <?= $i * 0.06 ?>s">
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
