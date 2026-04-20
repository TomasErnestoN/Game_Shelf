<?php
// Verifica se a sessão já foi iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteção: se não estiver logado, volta pro login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel Admin</title>

<style>
/* Estilo básico do sistema */
body {
    margin: 0;
    font-family: Arial;
    background: #252535;
    color: white;
}

/* Barra do menu */
.menu {
    background: #247BA0;
    padding: 15px;
    display: flex;
    justify-content: space-between;
}

/* Links do menu */
.menu a {
    color: white;
    text-decoration: none;
    margin-right: 15px;
    font-weight: bold;
}

/* Container do conteúdo */
.container {
    padding: 20px;
}
</style>
</head>

<body>

<!-- MENU SUPERIOR -->
<div class="menu">
    <div>
        <!-- Vai pro painel -->
        <a href="painel_admin.php">Dashboard</a>

        <!-- Vai pro cadastro -->
        <a href="cadastro.php">Cadastrar Jogo</a>
    </div>

    <div>
        <!-- Mostra nome do admin logado -->
        <?php echo $_SESSION['nome']; ?> |

        <!-- Logout -->
        <a href="logout.php">Sair</a>
    </div>
</div>

<!-- Abre container (vai fechar nos outros arquivos) -->
<div class="container">