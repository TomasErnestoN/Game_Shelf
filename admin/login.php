<?php
session_start();
require_once("../main/upperbar.php");
require_once("../main/sidebar.php");
require_once("../includes/conexao.php");

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM admin WHERE email = '$email'";
    $query = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($query) > 0) {
        $usuario = mysqli_fetch_assoc($query);

        // Verifica senha (caso use password_hash futuramente)
        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel_admin.php");
            exit();

        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href="../main/CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <title>Login - Game Shelf</title>
</head>
<body>
<div class="fundo">
<div class="login-box">
    <h2>Login</h2>

    <form action="login.php" method="POST">
        <input class="escreval" type="email" name="email" placeholder="Digite seu email" required>
        <input class="escreval" type="password" name="senha" placeholder="Digite sua senha" required>
        
        <button class="botao" type="submit">Entrar</button>
    </form>
</div>
</div>

<?php
require_once "../main/rodape.php";
?>

</body>
</html>