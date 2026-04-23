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

    <form class="search-form" action="../main/busca.php" method="GET">
      <div class="search-wrapper">
        <input
          type="text"
          name="q"
          class="search-input"
          placeholder="Buscar jogo..."
          autocomplete="off"
          value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>"
        >
        <button type="submit" class="search-btn" aria-label="Buscar">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
        </button>
      </div>
    </form>

    <a href="#rodape" class="sobre-nos">Sobre nós</a>
      





<?php if (isset($_SESSION['nome'])): ?>

  <div class="admin-area">

    <a href="../admin/painel_admin.php" class="admin-login">
      <img src="../main/Capas/admin.png" alt="Admin">
      <span><?php echo $_SESSION['nome']; ?></span>
    </a>

    <a href="../admin/logout.php" class="logout">
      Sair
    </a>

  </div>

<?php else: ?>

  <a href="../admin/login.php" class="admin-login">
    <img src="../main/Capas/admin.png" alt="Admin">
    <span>É admin?</span>
  </a>

<?php endif; ?>





























    
  </div>

</header>
