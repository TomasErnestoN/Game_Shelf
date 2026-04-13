<?php

include("conexao.php");

// pega dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];

// criptografa a senha antes de salvar
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// comando SQL para inserir
$sql = "INSERT INTO admin (nome, email, senha)
        VALUES ('$nome', '$email', '$senha')";

// executa no banco
mysqli_query($conn, $sql);

// volta para tela de login
header("Location: ../admin.php");