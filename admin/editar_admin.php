<?php
require_once "logado.php";
require_once "../includes/conexao.php";
require_once "../main/upperbar.php";
require_once "../main/sidebar.php";

$msg      = null;
$editando = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['action'] ?? '';
    $alvo = isset($_POST['alvo_id']) ? (int)$_POST['alvo_id'] : 0;
    $ehSiMesmo = ($alvo === (int)$_SESSION['id']);

    if ($acao === 'editar' && $alvo > 0) {
        $nome  = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        if ($ehSiMesmo) $ativo = 1;

        $senhaSQL = "";
        if (!empty($_POST['senha'])) {
            $hash     = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $hash     = mysqli_real_escape_string($conexao, $hash);
            $senhaSQL = ", senha = '$hash'";
        }

        $sql = "UPDATE admin SET nome = '$nome', email = '$email', ativo = $ativo $senhaSQL WHERE id = $alvo";

        if (mysqli_query($conexao, $sql)) {
            $msg = ['tipo' => 'sucesso', 'texto' => 'Admin atualizado com sucesso!'];
        } else {
            $msg = ['tipo' => 'erro', 'texto' => 'Erro ao atualizar: ' . mysqli_error($conexao)];
        }

    } elseif ($acao === 'toggle_ativo' && $alvo > 0 && !$ehSiMesmo) {
        mysqli_query($conexao, "UPDATE admin SET ativo = NOT ativo WHERE id = $alvo");
        $msg = ['tipo' => 'sucesso', 'texto' => 'Status atualizado.'];
    }
}

if (isset($_GET['editar'])) {
    $editId   = (int)$_GET['editar'];
    $res      = mysqli_query($conexao, "SELECT * FROM admin WHERE id = $editId");
    $editando = $res ? mysqli_fetch_assoc($res) : null;
}

$admins = [];
$res = mysqli_query($conexao, "SELECT id, nome, email, ativo FROM admin ORDER BY id ASC");
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $admins[] = $row;
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
  <title>Gerenciar Admins — Game Shelf</title>
</head>
<body>

<main class="ea-wrapper">
  <p class="ea-label">GERENCIAR ADMINISTRADORES</p>

  <?php if ($msg): ?>
    <p class="msg msg--<?= $msg['tipo'] ?>" style="margin-bottom:20px;"><?= $msg['texto'] ?></p>
  <?php endif; ?>

  <div class="ea-layout">

    <div class="ea-table-col">
      <table class="ea-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($admins as $adm):
            $ehSelf = ((int)$adm['id'] === (int)$_SESSION['id']);
            $ativo  = (int)$adm['ativo'];
          ?>
          <tr>
            <td><?= $adm['id'] ?></td>
            <td>
              <?= htmlspecialchars($adm['nome']) ?>
              <?php if ($ehSelf): ?>
                <span class="ea-voce">você</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($adm['email']) ?></td>
            <td>
              <span class="ea-badge <?= $ativo ? 'ea-badge--ativo' : 'ea-badge--inativo' ?>">
                <?= $ativo ? 'Ativo' : 'Inativo' ?>
              </span>
            </td>
            <td>
              <div class="ea-acoes">
                <a href="editar_admin.php?editar=<?= $adm['id'] ?>" class="ea-btn ea-btn--editar">✏ Editar</a>

                <form method="POST" style="display:inline;">
                  <input type="hidden" name="action"  value="toggle_ativo">
                  <input type="hidden" name="alvo_id" value="<?= $adm['id'] ?>">
                  <button type="submit"
                          class="ea-btn ea-btn--toggle <?= $ehSelf ? 'ea-btn--disabled' : '' ?>"
                          <?= $ehSelf ? 'disabled title="Você não pode se desativar"' : '' ?>>
                    <?= $ativo ? '⏸ Desativar' : '▶ Ativar' ?>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="ea-form-col">
      <div class="ea-form-box">

        <?php if ($editando): ?>
          <?php $editSelf = ((int)$editando['id'] === (int)$_SESSION['id']); ?>

          <h3 class="ea-form-titulo">Editando admin</h3>
          <p class="ea-form-subtitulo">#<?= $editando['id'] ?> — <?= htmlspecialchars($editando['nome']) ?></p>

          <?php if ($editSelf): ?>
            <p class="ea-aviso-self">⚠ Você está editando a si mesmo. Status ativo não pode ser alterado.</p>
          <?php endif; ?>

          <form method="POST">
            <input type="hidden" name="action"  value="editar">
            <input type="hidden" name="alvo_id" value="<?= $editando['id'] ?>">

            <input class="escreval" type="text"     name="nome"  value="<?= htmlspecialchars($editando['nome']) ?>"  placeholder="Nome"   required>
            <input class="escreval" type="email"    name="email" value="<?= htmlspecialchars($editando['email']) ?>" placeholder="E-mail" required>
            <input class="escreval" type="password" name="senha" placeholder="Nova senha (deixe vazio para manter)">

            <div class="ea-check-row">
              <input type="checkbox" name="ativo" id="ck-ativo"
                     <?= $editando['ativo'] ? 'checked' : '' ?>
                     <?= $editSelf ? 'disabled' : '' ?>>
              <label for="ck-ativo">Admin ativo</label>
            </div>
            <?php if ($editSelf): ?>
              <input type="hidden" name="ativo" value="on">
            <?php endif; ?>

            <button class="botao" type="submit" style="margin-top:8px;">Salvar</button>
          </form>

          <a class="link-voltar" href="editar_admin.php">← Fechar edição</a>

        <?php else: ?>
          <div class="ea-form-placeholder">
            <span>👤</span>
            Clique em <strong>✏ Editar</strong> em um admin para abrir o formulário aqui.
          </div>
        <?php endif; ?>

      </div>
    </div>

  </div>
</main>

<?php require_once "../main/rodape.php"; ?>
</body>
</html>
