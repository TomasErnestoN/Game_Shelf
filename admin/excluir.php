<?php
require_once("menu_admin.php");
require_once("../includes/conexao.php");

// Pega ID
$id = intval($_GET['id']);

// Deleta do banco
$sql = "DELETE FROM jogos WHERE id = $id";
mysqli_query($conexao, $sql);

// Redireciona
header("Location: painel_admin.php");