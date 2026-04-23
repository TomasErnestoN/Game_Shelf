<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="../main/CSS/style.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

<div id="sidebar" class="sidebar">

    <li><a href="../main/index.php">Início</a></li>
    <li><a href="#">Categorias</a></li>
    <li><a href="https://github.com/TomasErnestoN/Game_Shelf.git" target="_blank">Nosso Github</a></li>

    <?php if (isset($_SESSION['nome'])): ?>
        <!-- OPÇÕES DE ADMIN -->
        <li><a href="../admin/painel_admin.php">Dashboard</a></li>
        <li><a href="../admin/registrar_jogo.php">Registrar jogos</a></li>
        <li><a href="../admin/editar_jogo.php">Editar Jogos</a></li>
        <li><a href="../admin/registrar_admin.php">Registrar Admin</a></li>
        <li><a href="../admin/editar_admin.php">Gerenciar Admins</a></li>
    <?php endif; ?>

    <button class="modo-dark" onclick="toggleTheme()">
        <img src="../main/Capas/dark.png" alt="Dark Mode">
    </button>

</div>
