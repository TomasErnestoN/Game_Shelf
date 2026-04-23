<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div id="sidebar" class="sidebar">
  <ul>
    <li><a href="../main/index.php">Início</a></li>
    <li><a href="../main/categorias.php">Categorias</a></li>
    <li><a href="https://github.com/TomasErnestoN/Game_Shelf.git" target="_blank">Nosso Github</a></li>

    <?php if (isset($_SESSION['nome'])): ?>
      <li><a href="../admin/painel_admin.php">Dashboard</a></li>
      <li><a href="../admin/registrar_jogo.php">Registrar jogos</a></li>
      <li><a href="../admin/editar_jogo.php">Editar Jogos</a></li>
      <li><a href="../admin/registrar_admin.php">Registrar Admin</a></li>
      <li><a href="../admin/editar_admin.php">Gerenciar Admins</a></li>
    <?php endif; ?>
  </ul>

  <button class="modo-dark" onclick="toggleTheme()">
    <img src="../main/Capas/dark.png" alt="Dark Mode">
  </button>
</div>
