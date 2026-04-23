<?php
require_once "upperbar.php";
require_once "sidebar.php";
require_once "../includes/conexao.php";

// Primeiros 9 jogos
$sql    = "SELECT id, nome, imagem FROM jogos ORDER BY id DESC LIMIT 9";
$result = mysqli_query($conexao, $sql);
$jogos  = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jogos[] = $row;
    }
}

// Total de jogos para saber se tem "mais"
$total = (int)mysqli_fetch_row(mysqli_query($conexao, "SELECT COUNT(*) FROM jogos"))[0];
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

  <div class="shelf-grid" id="shelf-grid">
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

  <?php if ($total > 9): ?>
  <div id="mais-wrapper" style="text-align:center; margin-top:32px;">
    <button id="btn-mais" class="btn-mostrar-mais" onclick="carregarMais()">
      MOSTRAR MAIS
    </button>
  </div>
  <?php endif; ?>

</main>

<style>
  .btn-mostrar-mais {
    font-family: 'Orbitron', sans-serif;
    font-size: 11px;
    letter-spacing: 3px;
    color: #3c91b0;
    background: transparent;
    border: 2px solid #3c91b0;
    border-radius: 30px;
    padding: 12px 36px;
    cursor: pointer;
    transition: background 0.22s, color 0.22s, transform 0.18s;
  }
  .btn-mostrar-mais:hover { background: #3c91b0; color: #fff; transform: scale(1.04); }
  .btn-mostrar-mais:disabled { opacity: 0.4; cursor: default; transform: none; }
  .btn-mostrar-mais.carregando::after {
    content: '';
    display: inline-block;
    width: 12px; height: 12px;
    margin-left: 10px;
    border: 2px solid currentColor;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    vertical-align: middle;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
  body.dark .btn-mostrar-mais { border-color: #3c91b0; color: #3c91b0; }
  body.dark .btn-mostrar-mais:hover { background: #3c91b0; color: #fff; }
</style>

<script>
  let offset = 9;
  const total = <?= $total ?>;

  async function carregarMais() {
    const btn  = document.getElementById('btn-mais');
    const grid = document.getElementById('shelf-grid');
    btn.disabled = true;
    btn.classList.add('carregando');
    try {
      const res  = await fetch('carregar_mais.php?offset=' + offset + '&limite=6');
      const data = await res.json();
      grid.querySelectorAll('.shelf-card--vazio').forEach(el => el.remove());
      data.jogos.forEach((jogo, i) => {
        const a = document.createElement('a');
        a.href      = 'jogo.php?id=' + jogo.id;
        a.className = 'shelf-card';
        a.title     = jogo.nome;
        a.style.animationDelay = (i * 0.07) + 's';
        a.innerHTML =
          '<img src="../main/Capas/jogos/' + jogo.imagem + '" alt="' + jogo.nome + '" class="shelf-card__img">' +
          '<div class="shelf-card__footer"><span class="shelf-card__nome">' + jogo.nome + '</span></div>';
        grid.appendChild(a);
      });
      offset += data.jogos.length;
    } catch(e) { console.error(e); }
    btn.classList.remove('carregando');
    if (offset >= total) {
      document.getElementById('mais-wrapper').style.display = 'none';
    } else {
      btn.disabled = false;
    }
  }
</script>

<?php require_once "rodape.php"; ?>
</body>
</html>
