<?php

// inicia sessão (necessário para login funcionar)
session_start();

// conecta com banco
include("conexao.php");

// pega dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// busca usuário pelo email
$sql = "SELECT * FROM admin WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

// transforma resultado em array
$usuario = mysqli_fetch_assoc($result);

// verifica se encontrou usuário
if ($usuario) {

    // verifica senha criptografada
    if (password_verify($senha, $usuario['senha'])) {

        // cria sessão (usuário logado)
        $_SESSION['admin'] = $usuario['nome'];

        // redireciona para painel
        header("Location: ../painel.php");
        exit;

    } else {
        echo "Senha incorreta";
    }

} else {
    echo "Usuário não encontrado";
}