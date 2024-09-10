<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="css/stSenha.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap">

</head>
<body>

    <?php
        // Verifica se há uma mensagem na URL
        if (isset($_GET['mensagem'])) {
            $mensagem = $_GET['mensagem'];
            $senha = isset($_GET['senha']) ? urldecode($_GET['senha']) : '';

            switch ($mensagem) {
                case 'senha_enviada':
                    $mensagem = "<p>Sua senha é: {$senha}</p>";
                    break;
                default:
                    $mensagem = "<p>Usuário não encontrado.</p>";
                    break;
            }
        } else {
            $mensagem = '';
        }
    ?>

    

    <div class="reset-container">
        <h1>Esqueceu sua senha?</h1>
        <div>
            <p>Informe seu email de cadastro, o mesmo utilizado para acesso, que lhe enviaremos as instruções para a troca da senha por email.</p>
        </div>
        <form action="../bd/envio.php" method="post" autocomplete="off">
            <input type="email" name="txtUsuarioEmailMostrar" id="txtUsuarioEmailMostrar" placeholder="E-mail" required>

            <!-- MENSAGEM DE ERRO -->
            <div><?= $mensagem ?></div>

            <div class="center">
                <button type="submit" name="btnEnviarFormEsqueceuSenha" id="btnEnviarFormEsqueceuSenha">Enviar</button>
            </div>
            
        </form>
    </div>
</body>
</html>
