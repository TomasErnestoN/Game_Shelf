<?php
session_start();

// Apaga todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona pro login
header("Location: login.php");
exit();