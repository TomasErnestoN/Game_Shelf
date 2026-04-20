<?php
require_once("menu_admin.php");
require_once("../includes/conexao.php");

// Verifica se enviou formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Captura dados
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Insere no banco
    $sql = "INSERT INTO jogos (nome, descricao, preco)
            VALUES ('$nome', '$descricao', '$preco')";

    mysqli_query($conexao, $sql);

    // Volta pro painel
    header("Location: painel_admin.php");
}
?>

<h2>Cadastrar Jogo</h2>

<form method="POST">
    <!-- Nome -->
    <input type="text" name="nome" placeholder="Nome"><br><br>

    <!-- Descrição -->
    <textarea name="descricao" placeholder="Descrição"></textarea><br><br>

    <!-- Preço -->
    <input type="number" step="0.01" name="preco" placeholder="Preço"><br><br>

    <button type="submit">Salvar</button>
</form>

</div>
</body>
</html>