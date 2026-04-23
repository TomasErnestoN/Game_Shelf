<footer id="rodape" class="rodape">
  <div class="rodape-container">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani&display=swap" rel="stylesheet">
    <div class="rodape-esquerda">
      <h3>©2026 Game Shelf</h3>
      <p>Feito por Tomas, Kaio Richard e Alex</p>

      <a href="https://github.com/TomasErnestoN/Game_Shelf.git" target="_blank">
        <img src="../main/Capas/github.png" alt="gitHub" class="github-img">
      </a>
    </div>

    <div class="rodape-direita">
      <h3>Sobre nós</h3>
      <p>
        Este site, desenvolvido por três estudantes de curso técnico, foi feito para vizualização de jogos, incluindo seu preço, sua categoria, sua descrição e seu trailer.
      </p>
    </div>

  </div>
</footer>

<script>
function toggleTheme() {
  document.body.classList.toggle("dark");
  localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
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
