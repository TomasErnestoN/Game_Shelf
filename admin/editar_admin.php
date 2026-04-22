<?php
require_once "logado.php";
require_once "../includes/conexao.php";
require_once "../main/upperbar.php";
require_once "../main/sidebar.php";

$msg      = null;
$editando = null; // admin sendo editado agora

// ── SALVAR EDIÇÃO ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['action'] ?? '';
    $alvo = isset($_POST['alvo_id']) ? (int)$_POST['alvo_id'] : 0;

    // Impede que o admin se auto-desative ou se exclua
    $ehSiMesmo = ($alvo === (int)$_SESSION['id']);

    if ($acao === 'editar' && $alvo > 0) {
        $nome  = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        // Se o admin está tentando se desativar, ignora e mantém ativo
        if ($ehSiMesmo) $ativo = 1;

        $senhaSQL = "";
        if (!empty($_POST['senha'])) {
            $hash     = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $hash     = mysqli_real_escape_string($conexao, $hash);
            $senhaSQL = ", senha = '$hash'";
        }

        $sql = "UPDATE admin
                SET nome = '$nome', email = '$email', ativo = $ativo $senhaSQL
                WHERE id = $alvo";

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

// Qual admin está sendo editado no formulário lateral?
if (isset($_GET['editar'])) {
    $editId  = (int)$_GET['editar'];
    $res     = mysqli_query($conexao, "SELECT * FROM admin WHERE id = $editId");
    $editando = $res ? mysqli_fetch_assoc($res) : null;
}

// ── BUSCAR TODOS OS ADMINS ────────────────────────────────────────────────────
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

  <style>
    /* ===== PÁGINA EDITAR ADMIN ===== */

    .ea-wrapper {
      width: 100%;
      max-width: 1100px;
      margin: 48px auto 0;
      padding: 0 32px 60px;
      box-sizing: border-box;
    }

    .ea-label {
      font-family: 'Orbitron', sans-serif;
      font-size: 11px;
      letter-spacing: 3px;
      color: #3c91b0;
      margin: 0 0 28px 4px;
    }

    /* Layout: tabela | formulário */
    .ea-layout {
      display: flex;
      gap: 36px;
      align-items: flex-start;
    }

    /* ── TABELA DE ADMINS ── */
    .ea-table-col {
      flex: 1;
      min-width: 0;
    }

    .ea-table {
      width: 100%;
      border-collapse: collapse;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    .ea-table th {
      font-family: 'Orbitron', sans-serif;
      font-size: 9px;
      letter-spacing: 2px;
      color: #3c91b0;
      text-align: left;
      padding: 10px 14px;
      border-bottom: 2px solid #3c91b0;
      text-transform: uppercase;
    }

    .ea-table td {
      padding: 12px 14px;
      border-bottom: 1px solid #e0e0e0;
      vertical-align: middle;
      color: inherit;
    }

    .ea-table tr:last-child td {
      border-bottom: none;
    }

    .ea-table tr:hover td {
      background: rgba(60, 145, 176, 0.06);
    }

    /* Badge ativo / inativo */
    .ea-badge {
      font-family: 'Orbitron', sans-serif;
      font-size: 8px;
      letter-spacing: 1px;
      border-radius: 20px;
      padding: 3px 10px;
      text-transform: uppercase;
      font-weight: bold;
    }

    .ea-badge--ativo   { background: #d4edda; color: #155724; }
    .ea-badge--inativo { background: #f8d7da; color: #721c24; }

    /* Tag "você" */
    .ea-voce {
      font-family: 'Orbitron', sans-serif;
      font-size: 8px;
      letter-spacing: 1px;
      background: rgba(60,145,176,0.15);
      color: #3c91b0;
      border-radius: 20px;
      padding: 2px 8px;
      margin-left: 6px;
    }

    /* Ações da tabela */
    .ea-acoes {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .ea-btn {
      font-family: 'Orbitron', sans-serif;
      font-size: 8px;
      letter-spacing: 1px;
      border: none;
      border-radius: 20px;
      padding: 5px 12px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      text-transform: uppercase;
      transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .ea-btn:hover { transform: scale(1.06); box-shadow: 0 3px 10px rgba(0,0,0,0.15); }

    .ea-btn--editar   { background: linear-gradient(90deg,#2f7c99,#3c91b0); color: #fff; }
    .ea-btn--toggle   { background: #f0f0f0; color: #555; }
    .ea-btn--disabled { opacity: 0.35; pointer-events: none; }

    /* ── FORMULÁRIO DE EDIÇÃO ── */
    .ea-form-col {
      flex-shrink: 0;
      width: 300px;
      position: sticky;
      top: 90px;
    }

    .ea-form-box {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.12);
      padding: 28px 24px;
    }

    .ea-form-titulo {
      font-family: 'Orbitron', sans-serif;
      font-size: 13px;
      margin: 0 0 6px;
      color: #2f7c99;
    }

    .ea-form-subtitulo {
      font-size: 12px;
      color: #999;
      margin: 0 0 20px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      font-size: 9px;
    }

    .ea-form-placeholder {
      text-align: center;
      font-family: 'Orbitron', sans-serif;
      font-size: 10px;
      letter-spacing: 2px;
      color: #bbb;
      padding: 40px 0;
    }

    .ea-form-placeholder span {
      display: block;
      font-size: 36px;
      margin-bottom: 12px;
    }

    /* Checkbox ativo */
    .ea-check-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 12px 0;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    .ea-check-row input[type="checkbox"] {
      width: 18px;
      height: 18px;
      accent-color: #3c91b0;
      cursor: pointer;
    }

    .ea-aviso-self {
      font-size: 11px;
      color: #e67e22;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      margin: 8px 0 0;
    }

    .ea-danger {
      margin-top: 20px;
      padding: 14px;
      border: 1.5px solid #f5c6cb;
      border-radius: 8px;
      background: #fff8f8;
    }

    .ea-danger__titulo {
      font-family: 'Orbitron', sans-serif;
      font-size: 9px;
      font-weight: bold;
      color: #c0392b;
      margin: 0 0 10px;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* Dark mode */
    body.dark .ea-table td      { border-color: #2a2a2a; }
    body.dark .ea-table th      { border-color: #3c91b0; }
    body.dark .ea-table tr:hover td { background: rgba(60,145,176,0.08); }
    body.dark .ea-form-box      { background: #1a1a1a; box-shadow: 0 4px 20px rgba(0,0,0,0.4); }
    body.dark .ea-btn--toggle   { background: #2a2a2a; color: #aaa; }
    body.dark .ea-danger        { background: #1e1010; border-color: #5c2020; }
    body.dark .ea-badge--ativo  { background: #1a3d25; color: #4caf72; }
    body.dark .ea-badge--inativo{ background: #3d1a1a; color: #e07070; }

    /* Responsivo */
    @media (max-width: 780px) {
      .ea-layout { flex-direction: column; }
      .ea-form-col { width: 100%; position: static; }
    }
  </style>
</head>
<body>

<main class="ea-wrapper">
  <p class="ea-label">GERENCIAR ADMINISTRADORES</p>

  <?php if ($msg): ?>
    <p class="msg msg--<?= $msg['tipo'] ?>" style="margin-bottom:20px;"><?= $msg['texto'] ?></p>
  <?php endif; ?>

  <div class="ea-layout">

    <!-- ── TABELA ── -->
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
                <!-- Botão editar -->
                <a href="editar_admin.php?editar=<?= $adm['id'] ?>"
                   class="ea-btn ea-btn--editar">✏ Editar</a>

                <!-- Toggle ativo/inativo -->
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="action"   value="toggle_ativo">
                  <input type="hidden" name="alvo_id"  value="<?= $adm['id'] ?>">
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

    <!-- ── FORMULÁRIO LATERAL ── -->
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

            <input class="escreval" type="text" name="nome"
                   value="<?= htmlspecialchars($editando['nome']) ?>"
                   placeholder="Nome" required>

            <input class="escreval" type="email" name="email"
                   value="<?= htmlspecialchars($editando['email']) ?>"
                   placeholder="E-mail" required>

            <input class="escreval" type="password" name="senha"
                   placeholder="Nova senha (deixe vazio para manter)">

            <div class="ea-check-row">
              <input type="checkbox" name="ativo" id="ck-ativo"
                     <?= $editando['ativo'] ? 'checked' : '' ?>
                     <?= $editSelf ? 'disabled' : '' ?>>
              <label for="ck-ativo">Admin ativo</label>
            </div>
            <?php if ($editSelf): ?>
              <!-- garante ativo=1 mesmo com checkbox disabled -->
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
    <!-- fim formulário -->

  </div>
</main>

<?php require_once "../main/rodape.php"; ?>
</body>
</html>
