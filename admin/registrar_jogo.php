<?php
require_once "logado.php";
require_once "../includes/conexao.php";
require_once "../main/upperbar.php";
require_once "../main/sidebar.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome      = mysqli_real_escape_string($conexao, $_POST['nome']);
    $preco     = mysqli_real_escape_string($conexao, $_POST['preco']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $trailer   = mysqli_real_escape_string($conexao, $_POST['trailer']);
    $categoria1 = mysqli_real_escape_string($conexao, $_POST['categoria1']);
    $categoria2 = mysqli_real_escape_string($conexao, $_POST['categoria2']);

    $pastaDestino = "../main/Capas/jogos/";
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }

    $arquivo    = $_FILES['imagem'];
    $extensao   = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        $msg = array("tipo" => "erro", "texto" => "Erro ao receber o arquivo.");
    } elseif (!in_array($extensao, $permitidos)) {
        $msg = array("tipo" => "erro", "texto" => "Formato inválido. Use JPG, PNG ou WEBP.");
    } elseif ($arquivo['size'] > 5 * 1024 * 1024) {
        $msg = array("tipo" => "erro", "texto" => "Imagem muito grande. Máximo 5MB.");
    } else {
        $nomeArquivo  = uniqid('jogo_') . '.' . $extensao;
        $caminhoFinal = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoFinal)) {
            $imagemBanco = $nomeArquivo;
            $sql = "INSERT INTO jogos (nome, `preço`, descricao, imagem, trailer, categoria1, categoria2)
                    VALUES ('$nome', '$preco', '$descricao', '$imagemBanco', '$trailer', '$categoria1', '$categoria2')";

            if (mysqli_query($conexao, $sql)) {
                $msg = array("tipo" => "sucesso", "texto" => "Jogo cadastrado com sucesso!");
            } else {
                $msg = array("tipo" => "erro", "texto" => "Erro ao cadastrar: " . mysqli_error($conexao));
            }
        } else {
            $msg = array("tipo" => "erro", "texto" => "Falha ao salvar a imagem.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../main/CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <title>Registrar Jogo - Game Shelf</title>
</head>
<body>

<div class="fundo">
  <div class="login-box login-box--largo">
    <h2>Registrar Jogo</h2>

    <?php if (!empty($msg)): ?>
      <p class="msg msg--<?= $msg['tipo'] ?>"><?= $msg['texto'] ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <input class="escreval" type="text" name="nome" placeholder="Nome do jogo" required>
      <input class="escreval" type="number" name="preco" placeholder="Preço (ex: 59.90)" step="0.01" min="0" required>
      <textarea class="escreval escreval--textarea" name="descricao" placeholder="Descrição do jogo" required></textarea>

      <label class="label-upload">
        Imagem da capa
        <input class="escreval escreval--file" type="file" name="imagem" accept=".jpg,.jpeg,.png,.webp" required>
      </label>

      <select class="escreval" name="categoria1" required>
        <option value="" disabled selected>Categoria 1</option>
        <option value="2D">2D</option>
        <option value="Ação">Ação</option>
        <option value="FPS">FPS</option>
        <option value="Terror">Terror</option>
        <option value="Esporte">Esporte</option>
        <option value="Corrida">Corrida</option>
        <option value="Sobrevivência">Sobrevivência</option>
        <option value="Simulação">Simulação</option>
        <option value="RPG">RPG</option>
        <option value="Luta">Luta</option>
        <option value="Online">Online</option>
      </select>

      <select class="escreval" name="categoria2">
        <option value="" selected>Categoria 2 (opcional)</option>
        <option value="2D">2D</option>
        <option value="Ação">Ação</option>
        <option value="FPS">FPS</option>
        <option value="Terror">Terror</option>
        <option value="Esporte">Esporte</option>
        <option value="Corrida">Corrida</option>
        <option value="Sobrevivência">Sobrevivência</option>
        <option value="Simulação">Simulação</option>
        <option value="RPG">RPG</option>
        <option value="Luta">Luta</option>
        <option value="Online">Online</option>
      </select>

      <input class="escreval" type="text" name="trailer" placeholder="URL do trailer (YouTube)" required>

      <button class="botao" type="submit">Cadastrar Jogo</button>
    </form>

    <a class="link-voltar" href="painel_admin.php">← Voltar ao painel</a>
  </div>
</div>

<?php require_once "../main/rodape.php"; ?>

</body>
</html>
