<?php

session_start();

// destrói todas sessões
session_destroy();

// volta pro login
header("Location: admin.php");