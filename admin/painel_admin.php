<?php
// Importa menu (já protege sessão automaticamente)
require_once("menu_admin.php");

// Conexão com banco
require_once("../includes/conexao.php");
?>

<h2>Lista de Jogos</h2>

<?php
// Busca todos os jogos
$sql = "SELECT * FROM jogos";
$query = mysqli_query($conexao, $sql);

// Loop para mostrar cada jogo
while ($jogo = mysqli_fetch_assoc($query)) {

    echo "<div style='background:#fff;color:#000;padding:10px;margin:10px;border-radius:5px'>";

    // Nome do jogo
    echo "<b>{$jogo['nome']}</b><br>";

    // Preço
    echo "R$ {$jogo['preco']}<br><br>";

    // Botões de ação
    echo "<a href='editar_jogo.php?id={$jogo['id']}'>Editar</a> | ";
    echo "<a href='excluir_jogo.php?id={$jogo['id']}'>Excluir</a>";

    echo "</div>";
}
?>

<!-- Fecha layout -->
</div>
</body>
</html>