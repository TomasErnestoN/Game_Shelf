<?php
session_start();

// Se NÃO estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>