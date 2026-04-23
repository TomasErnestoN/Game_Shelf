<?php
require_once("logado.php");
require_once("../includes/conexao.php");
require_once("../main/upperbar.php");
require_once("../main/sidebar.php");
?>
<div class="fundo">
  <div class="painel-box">
    <h2>Painel do Admin</h2>
    <p class="painel-boas-vindas">Olá, <?= htmlspecialchars($_SESSION['nome']) ?>! O que deseja fazer?</p>

    <div class="painel-opcoes">
      <a class="painel-card" href="registrar_jogo.php">
        <span class="painel-card__icone">
          <img src="../main/Capas/controller.png" alt="controller">
        </span>
        <span class="painel-card__titulo">Registrar Jogo</span>
        <span class="painel-card__desc">Adicionar um novo jogo ao catálogo</span>
      </a>

      <a class="painel-card" href="editar_jogo.php">
        <span class="painel-card__icone">
          <img src="../main/Capas/gear.png" alt="Editar">
        </span>
        <span class="painel-card__titulo">Editar Jogos</span>
        <span class="painel-card__desc">Alterar ou excluir jogos do catálogo</span>
      </a>

      <a class="painel-card" href="registrar_admin.php">
        <span class="painel-card__icone">
          <img src="../main/Capas/admin.png" alt="Admin">
        </span>
        <span class="painel-card__titulo">Registrar Admin</span>
        <span class="painel-card__desc">Criar um novo administrador</span>
      </a>

      <a class="painel-card" href="editar_admin.php">
        <span class="painel-card__icone">
          <img src="../main/Capas/admin.png" alt="Admins">
        </span>
        <span class="painel-card__titulo">Gerenciar Admins</span>
        <span class="painel-card__desc">Editar, desativar ou remover admins</span>
      </a>
    </div>
  </div>
</div>

<?php require_once "../main/rodape.php"; ?>
</body>
</html>
