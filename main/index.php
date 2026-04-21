<?php
require_once "upperbar.php";
require_once "sidebar.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="CSS/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
  <title>Games. Shelf</title>
</head>
<body>
  <div class="fundo">
  <div class="container">
    <div class="card"></div>
    <div class="card"></div>
    <div class="card"></div>

    <div class="card"></div>
    <div class="card"></div>
    <div class="card"></div>

    <div class="card"></div>
    <div class="card"></div>
    <div class="card"></div>
  </div>
</div>







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
</script>


<?php
require_once "rodape.php";
?>





</body>
</html>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("active");
}
</script>