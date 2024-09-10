<?php
//Importar o arquivo com a classe de conexão
include "controlepdo.php";

//Instância da classe de conexão
$conexao = new Conexao();


//isset - verificar qual botão do formulário foi configurado
if (isset($_POST["btnCadastrarUsuario"])) {    
    $conexao->CadastrarUsuario();
} 
else if (isset($_POST["btnCadastrarProduto"]))
{
    $conexao->CadastrarProduto();
}
else if (isset($_POST["btnMostrarProduto"]))
{
    $conexao->mostrarProduto();
}
else if (isset($_POST["btnEditarProduto"]))
{
    $conexao->EditarProduto();
}
else if (isset($_POST["btnDeletarProduto"]))
{
    $conexao->deletarProduto();
}
else if (isset($_POST["btnEnviarFormAdmin"]))
{
    $conexao->LoginAdmin();
}
else if (isset($_POST["btnEnviarFormUsuario"]))
{
    $conexao->LoginUsuario();
}
else if (isset($_POST["btnEnviarFormEsqueceuSenha"]))
{
    $conexao->esqueceuSenha();
}
else if (isset($_POST["btnenviarformmostrar"]))
{
    $conexao->esqueceuSenha();
}
else {
    echo "ERRO - Nenhuma ação executada.";
}

//FIM PHP
?>
<!-- INICIO HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    body {
        background-color: whitesmoke;
    }
    </style>

</head>

<body class="container">

    <!-- Botão com bootstrap5 -->
    <div>
        <center><a href="../Suaite-Odasu/inicialPrincipal.php"><button class="btn btn-danger mt-2">Voltar</button></a></center>
    </div>

</body>

</html>