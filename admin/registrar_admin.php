<?php
require_once "logado.php";
require_once "../includes/conexao.php";

if (isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (nome, email, senha) 
            VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conexao, $sql)) {
        $msg = "Admin cadastrado com sucesso!";
    } else {
        $msg = "Erro ao cadastrar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../main/CSS/style.css">
<title>Registrar Admin</title>
</head>

<body>

<?php require_once "../main/upperbar.php"; ?>
<?php require_once "../main/sidebar.php"; ?>

<div class="fundo">
  <div class="login-box">
    <h2>Registrar Admin</h2>

    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>

    <form method="POST">
      <input class="escreval" type="text" name="nome" placeholder="Nome" required>
      <input class="escreval" type="email" name="email" placeholder="Email" required>
      <input class="escreval" type="password" name="senha" placeholder="Senha" required>

      <button class="botao" type="submit">Cadastrar</button>
    </form>
  </div>
</div>

<?php require_once "../main/rodape.php"; ?>

</body>
</html>