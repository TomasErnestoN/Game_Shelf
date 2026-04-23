<?php
require_once("menu_admin.php");
require_once("../includes/conexao.php");

// Pega ID do jogo (seguro)
$id = intval($_GET['id']);

// Busca dados do jogo
$sql = "SELECT * FROM jogos WHERE id = $id";
$query = mysqli_query($conexao, $sql);
$jogo = mysqli_fetch_assoc($query);

// Se enviou formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Atualiza no banco
    $sql = "UPDATE jogos 
            SET nome='$nome', descricao='$descricao', preco='$preco'
            WHERE id=$id";

    mysqli_query($conexao, $sql);

    // Volta pro painel
    header("Location: painel_admin.php");
}
?>

<h2>Editar Jogo</h2>

<form method="POST">
    <input type="text" name="nome" value="<?= $jogo['nome'] ?>"><br><br>
    <textarea name="descricao"><?= $jogo['descricao'] ?></textarea><br><br>
    <input type="number" step="0.01" name="preco" value="<?= $jogo['preco'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>

</div>
</body>
</html>