<?php
require_once "../includes/conexao.php";

$offset = isset($_GET['offset']) ? max(0, (int)$_GET['offset']) : 9;
$limite = isset($_GET['limite']) ? min(12, max(1, (int)$_GET['limite'])) : 6;

$sql    = "SELECT id, nome, imagem FROM jogos ORDER BY id DESC LIMIT $limite OFFSET $offset";
$result = mysqli_query($conexao, $sql);
$jogos  = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jogos[] = [
            'id'     => (int)$row['id'],
            'nome'   => $row['nome'],
            'imagem' => $row['imagem'],
        ];
    }
}

header('Content-Type: application/json');
echo json_encode(['jogos' => $jogos]);
