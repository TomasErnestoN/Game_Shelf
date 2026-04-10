<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>

    <h1>Login</h1>

    <!-- 
        FORMULÁRIO DE LOGIN
        action → para onde os dados vão
        method POST → envia dados de forma segura (não aparece na URL)
    -->
    <form action="php/login.php" method="POST">

        <!-- INPUT DE EMAIL -->
        <!-- name="email" → será usado no PHP como $_POST['email'] -->
        <input type="email" name="email" placeholder="Digite seu email" required>

        <!-- INPUT DE SENHA -->
        <!-- type="password" → esconde o que o usuário digita -->
        <!-- name="senha" → será usado no PHP como $_POST['senha'] -->
        <input type="password" name="senha" placeholder="Digite sua senha" required>

        <!-- BOTÃO -->
        <!-- type="submit" → envia o formulário -->
        <button type="submit">Entrar</button>

    </form>

    <!-- LINK PARA CADASTRO -->
    <p>Não tem conta? <a href="cadastro.php">Cadastrar</a></p>

</body>
</html>