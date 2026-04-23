<?php
require_once "logado.php";
require_once "../includes/conexao.php";
require_once "../main/upperbar.php";
require_once "../main/sidebar.php";

$id  = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$msg = null;

// ── EXCLUIR ───────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'excluir') {
    $res = mysqli_query($conexao, "SELECT imagem FROM jogos WHERE id = $id");
    if ($row = mysqli_fetch_assoc($res)) {
        $arq = "../main/Capas/jogos/" . $row['imagem'];
        if ($row['imagem'] && file_exists($arq)) unlink($arq);
    }
    mysqli_query($conexao, "DELETE FROM jogos WHERE id = $id");
    header("Location: editar_jogo.php?deleted=1");
    exit();
}

// ── SALVAR EDIÇÃO ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'editar') {
    $nome       = mysqli_real_escape_string($conexao, $_POST['nome']);
    $preco      = mysqli_real_escape_string($conexao, $_POST['preco']);
    $descricao  = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $trailer    = mysqli_real_escape_string($conexao, $_POST['trailer']);
    $categoria1 = mysqli_real_escape_string($conexao, $_POST['categoria1']);
    $categoria2 = mysqli_real_escape_string($conexao, $_POST['categoria2']);

    $imagemSQL = "";
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $arquivo    = $_FILES['imagem'];
        $extensao   = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extensao, $permitidos)) {
            $msg = ['tipo' => 'erro', 'texto' => 'Formato inválido. Use JPG, PNG ou WEBP.'];
        } elseif ($arquivo['size'] > 5 * 1024 * 1024) {
            $msg = ['tipo' => 'erro', 'texto' => 'Imagem muito grande. Máximo 5MB.'];
        } else {
            $resAnt = mysqli_query($conexao, "SELECT imagem FROM jogos WHERE id = $id");
            if ($ant = mysqli_fetch_assoc($resAnt)) {
                $caminhoAnt = "../main/Capas/jogos/" . $ant['imagem'];
                if ($ant['imagem'] && file_exists($caminhoAnt)) unlink($caminhoAnt);
            }
            $nomeArquivo = uniqid('jogo_') . '.' . $extensao;
            move_uploaded_file($arquivo['tmp_name'], "../main/Capas/jogos/" . $nomeArquivo);
            $imagemSQL = ", imagem = '" . mysqli_real_escape_string($conexao, $nomeArquivo) . "'";
        }
    }

    if (!$msg) {
        $sql = "UPDATE jogos SET
                    nome       = '$nome',
                    `preço`    = '$preco',
                    descricao  = '$descricao',
                    trailer    = '$trailer',
                    categoria1 = '$categoria1',
                    categoria2 = '$categoria2'
                    $imagemSQL
                WHERE id = $id";
        if (mysqli_query($conexao, $sql)) {
            $msg = ['tipo' => 'sucesso', 'texto' => 'Jogo atualizado com sucesso!'];
        } else {
            $msg = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar: ' . mysqli_error($conexao)];
        }
    }
}

// ── CARREGAR DADOS ────────────────────────────────────────────────────────────
$res  = mysqli_query($conexao, "SELECT * FROM jogos WHERE id = $id");
$jogo = mysqli_fetch_assoc($res);
if (!$jogo) { header("Location: editar_jogo.php"); exit(); }

$categorias = ['2D','Ação','FPS','Terror','Esporte','Corrida','Sobrevivência','Simulação','RPG','Luta','Online'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../main/CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Editar Jogo - Game Shelf</title>
</head>
<body>

<div class="fundo fundo--edit">
  <div class="edit-layout">

    <!-- COLUNA ESQUERDA: preview da capa -->
    <div class="edit-capa-col">
      <div class="edit-capa-frame">
        <?php if ($jogo['imagem']): ?>
          <img id="preview-img"
               src="../main/Capas/jogos/<?= htmlspecialchars($jogo['imagem']) ?>"
               alt="Capa atual" class="edit-capa-img">
        <?php else: ?>
          <div class="edit-capa-vazia" id="preview-img">?</div>
        <?php endif; ?>
      </div>
      <p class="edit-capa-hint">Prévia da capa</p>
    </div>

    <!-- COLUNA DIREITA: formulário -->
    <div class="edit-form-col">
      <h2 class="edit-titulo">Editar Jogo</h2>

      <?php if ($msg): ?>
        <p class="msg msg--<?= $msg['tipo'] ?>"><?= $msg['texto'] ?></p>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="editar">

        <input class="escreval" type="text" name="nome"
               value="<?= htmlspecialchars($jogo['nome']) ?>"
               placeholder="Nome do jogo" required>

        <input class="escreval" type="number" name="preco"
               value="<?= htmlspecialchars($jogo['preço']) ?>"
               placeholder="Preço (ex: 59.90)" step="0.01" min="0" required>

        <textarea class="escreval escreval--textarea" name="descricao"
                  placeholder="Descrição" required><?= htmlspecialchars($jogo['descricao']) ?></textarea>

        <label class="label-upload">
          Nova capa (deixe vazio para manter a atual)
          <input class="escreval escreval--file" type="file" name="imagem"
                 accept=".jpg,.jpeg,.png,.webp"
                 onchange="previewCapa(this)">
        </label>

        <select class="escreval" name="categoria1" required>
          <option value="" disabled>Categoria 1</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat ?>" <?= $jogo['categoria1'] === $cat ? 'selected' : '' ?>>
              <?= $cat ?>
            </option>
          <?php endforeach; ?>
        </select>

        <select class="escreval" name="categoria2">
          <option value="">Categoria 2 (opcional)</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat ?>" <?= $jogo['categoria2'] === $cat ? 'selected' : '' ?>>
              <?= $cat ?>
            </option>
          <?php endforeach; ?>
        </select>

        <input class="escreval" type="text" name="trailer"
               value="<?= htmlspecialchars($jogo['trailer'] ?? '') ?>"
               placeholder="URL do trailer (YouTube)" required>

        <button class="botao" type="submit">Salvar Alterações</button>
      </form>

      <!-- ZONA DE PERIGO -->
      <div class="edit-danger">
        <p class="edit-danger__titulo">⚠ Zona de perigo</p>
        <form method="POST"
              onsubmit="return confirm('Excluir <?= addslashes(htmlspecialchars($jogo['nome'])) ?>? Essa ação não pode ser desfeita.')">
          <input type="hidden" name="action" value="excluir">
          <button class="botao botao--excluir" type="submit">🗑 Excluir este jogo</button>
        </form>
      </div>

      <a class="link-voltar" href="editar_jogo.php">← Voltar à lista</a>
    </div>

  </div>
</div>

<script>
function previewCapa(input) {
  if (!input.files || !input.files[0]) return;
  const reader = new FileReader();
  reader.onload = function(e) {
    const el = document.getElementById('preview-img');
    if (el.tagName === 'IMG') {
      el.src = e.target.result;
    } else {
      // era div vazia, substitui por img
      const img = document.createElement('img');
      img.id = 'preview-img';
      img.src = e.target.result;
      img.className = 'edit-capa-img';
      img.alt = 'Nova capa';
      el.replaceWith(img);
    }
  };
  reader.readAsDataURL(input.files[0]);
}
</script>

<?php require_once "../main/rodape.php"; ?>
</body>
</html>
