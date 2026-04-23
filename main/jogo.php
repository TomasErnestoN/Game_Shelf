<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

// Pega o ID da URL e valida
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

// Converte URL do YouTube para embed
function youtubeEmbed($url) {
    if (empty($url)) return null;

    // Pega o ID do vídeo de vários formatos de URL do YouTube
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

  <style>
    /* ===== PÁGINA DO JOGO ===== */

    .jogo-wrapper {
      width: 100%;
      max-width: 1100px;
      margin: 48px auto 0;
      padding: 0 32px 60px;
      box-sizing: border-box;
    }

    /* Breadcrumb */
    .jogo-breadcrumb {
      font-family: 'Orbitron', sans-serif;
      font-size: 10px;
      letter-spacing: 2px;
      color: #3c91b0;
      margin-bottom: 28px;
    }

    .jogo-breadcrumb a {
      color: #3c91b0;
      text-decoration: none;
    }

    .jogo-breadcrumb a:hover {
      text-decoration: underline;
    }

    /* Layout principal: capa | conteúdo */
    .jogo-layout {
      display: flex;
      gap: 40px;
      align-items: flex-start;
    }

    /* Coluna esquerda (capa) */
    .jogo-capa-col {
      flex-shrink: 0;
      width: 220px;
      position: sticky;
      top: 90px;
    }

    .jogo-capa-frame {
      width: 220px;
      aspect-ratio: 3 / 4;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 8px 28px rgba(0,0,0,0.28);
      background: #d0d0d0;
    }

    .jogo-capa-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* Tags de categoria */
    .jogo-tags {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 14px;
    }

    .jogo-tag {
      font-family: 'Orbitron', sans-serif;
      font-size: 9px;
      letter-spacing: 1px;
      color: #fff;
      background: linear-gradient(90deg, #2f7c99, #3c91b0);
      border-radius: 20px;
      padding: 4px 12px;
      text-transform: uppercase;
    }

    /* Coluna direita (conteúdo) */
    .jogo-content-col {
      flex: 1;
      min-width: 0;
    }

    .jogo-nome {
      font-family: 'Orbitron', sans-serif;
      font-size: 28px;
      font-weight: 700;
      margin: 0 0 8px;
      color: inherit;
      line-height: 1.2;
    }

    .jogo-preco {
      font-family: 'Orbitron', sans-serif;
      font-size: 22px;
      color: #3c91b0;
      margin: 0 0 24px;
    }

    .jogo-preco--gratis {
      color: #27ae60;
    }

    .jogo-descricao-titulo {
      font-family: 'Orbitron', sans-serif;
      font-size: 10px;
      letter-spacing: 3px;
      color: #3c91b0;
      margin: 0 0 10px;
      text-transform: uppercase;
    }

    .jogo-descricao {
      font-size: 15px;
      line-height: 1.7;
      color: inherit;
      margin: 0 0 36px;
      opacity: 0.85;
    }

    /* Player do trailer */
    .jogo-trailer-titulo {
      font-family: 'Orbitron', sans-serif;
      font-size: 10px;
      letter-spacing: 3px;
      color: #3c91b0;
      margin: 0 0 14px;
      text-transform: uppercase;
    }

    .jogo-trailer-frame {
      position: relative;
      width: 100%;
      aspect-ratio: 16 / 9;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 8px 28px rgba(0,0,0,0.22);
      background: #000;
    }

    .jogo-trailer-frame iframe {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      border: none;
    }

    /* Sem trailer */
    .jogo-sem-trailer {
      display: flex;
      align-items: center;
      justify-content: center;
      aspect-ratio: 16 / 9;
      border-radius: 10px;
      background: repeating-linear-gradient(
        -45deg,
        #e2e2e2, #e2e2e2 6px,
        #ebebeb 6px, #ebebeb 12px
      );
      border: 2px dashed #ccc;
      font-family: 'Orbitron', sans-serif;
      font-size: 12px;
      color: #aaa;
      letter-spacing: 2px;
    }

    /* Botão voltar */
    .jogo-voltar {
      display: inline-block;
      margin-top: 36px;
      font-family: 'Orbitron', sans-serif;
      font-size: 10px;
      letter-spacing: 2px;
      text-decoration: none;
      color: #3c91b0;
      border: 1.5px solid #3c91b0;
      border-radius: 20px;
      padding: 8px 20px;
      transition: background 0.2s, color 0.2s;
    }

    .jogo-voltar:hover {
      background: #3c91b0;
      color: #fff;
    }

    /* ── Dark mode ── */
    body.dark .jogo-nome       { color: #eee; }
    body.dark .jogo-descricao  { color: #ccc; }
    body.dark .jogo-capa-frame { background: #1e1e1e; }

    body.dark .jogo-sem-trailer {
      background: repeating-linear-gradient(
        -45deg,
        #1a1a1a, #1a1a1a 6px,
        #222 6px, #222 12px
      );
      border-color: #333;
      color: #555;
    }

    /* ── Responsivo ── */
    @media (max-width: 680px) {
      .jogo-layout {
        flex-direction: column;
      }

      .jogo-capa-col {
        width: 100%;
        position: static;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .jogo-capa-frame {
        width: 160px;
      }
    }
  </style>
</head>
<body>

<main class="jogo-wrapper">

  <!-- Breadcrumb -->
  <p class="jogo-breadcrumb">
    <a href="index.php">INÍCIO</a> &rsaquo; <?= $nome ?>
  </p>

  <div class="jogo-layout">

    <!-- Capa + categorias -->
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

    <!-- Conteúdo -->
    <div class="jogo-content-col">

      <h1 class="jogo-nome"><?= $nome ?></h1>

      <p class="jogo-preco <?= ($jogo['preço'] == 0) ? 'jogo-preco--gratis' : '' ?>">
        <?= ($jogo['preço'] == 0) ? 'GRÁTIS' : 'R$ ' . $preco ?>
      </p>

      <p class="jogo-descricao-titulo">Descrição</p>
      <p class="jogo-descricao"><?= $descricao ?></p>

      <!-- Trailer -->
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
