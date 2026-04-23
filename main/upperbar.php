<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="../main/CSS/style.css">
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

<header class="topo">

  <div class="esquerda" onclick="toggleSidebar()">
    <img src="../main/Capas/whiteBars.png" alt="Bars" class="white-bars">
  </div>

  <div class="centro">
    <a href="../main/index.php">
      <img src="../main/Capas/Logo.png" alt="Logo" class="logo-img">
    </a>
  </div>

  <div class="direita">
    <a href="#rodape" class="sobre-nos">Sobre nós</a>

    <?php if (isset($_SESSION['nome'])): ?>
      <div class="admin-area">
        <a href="../admin/painel_admin.php" class="admin-login">
          <img src="../main/Capas/admin.png" alt="Admin">
          <span><?php echo $_SESSION['nome']; ?></span>
        </a>
        <a href="../admin/logout.php" class="logout">Sair</a>
      </div>
    <?php else: ?>
      <a href="../admin/login.php" class="admin-login">
        <img src="../main/Capas/admin.png" alt="Admin">
        <span>É admin?</span>
      </a>
    <?php endif; ?>
  </div>

</header>
