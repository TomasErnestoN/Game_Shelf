<?php
// Inicia sessão
session_start();

// Destroi sessão (desloga)
session_destroy();

// Volta pro login
header("Location: login.php");
exit();