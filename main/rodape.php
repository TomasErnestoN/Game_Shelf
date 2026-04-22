 <link rel="stylesheet" href="../main/CSS/style.css">
 <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

<footer id="rodape" class="rodape">
  <div class="rodape-container">

    <div class="rodape-esquerda">
      <h3>©2026 Game Shelf</h3><p>Feito por Tomas, Kaio Richard e Alex</p>
      <a href="https://github.com/TomasErnestoN/Game_Shelf.git" target="_blank">
      <img src="../main/Capas/github.png" alt="gitHub" class="github-img">
      </a>
    </div>

    <div class="rodape-direita">
      <h3>Sobre nós</h3>
      <p>
        Este site foi desenvolvido para organizar e visualizar jogos de forma simples e prática.
        Nosso objetivo é criar uma experiência agradável para os usuários.
      </p>
    </div>

  </div>
</footer>





<script>
function toggleTheme() {
  document.body.classList.toggle("dark");

  if (document.body.classList.contains("dark")) {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }
}

window.onload = function() {
  if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
  }
};


function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("active");
}

</script>