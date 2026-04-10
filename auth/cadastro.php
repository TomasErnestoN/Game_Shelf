<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Admin</title>
</head>
<body>

    <h1>Cadastro</h1>

    <form action="php/registrar.php" method="POST">

        <!-- nome do admin -->
        <input type="text" name="nome" placeholder="Seu nome" required>

        <!-- email -->
        <input type="email" name="email" placeholder="Seu email" required>

        <!-- senha -->
        <!-- type password esconde o texto -->
        <input type="password" name="senha" placeholder="Sua senha" required>

        <!-- botão envia o formulário -->
        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>