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

</body>
</html>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("active");
}
</script>