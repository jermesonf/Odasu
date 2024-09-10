<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="css/stCadastro.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap">
    <link rel="icon" href="./favicon.png" type="image/png">
    <script src="https://kit.fontawesome.com/416980903f.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php
session_start(); // Inicia a sessão
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; // Obtém o nome do usuário da sessão
$id = isset($_SESSION['id']) ? $_SESSION['id'] : ''; // Obtém o ID do usuário da sessão


if (isset($_GET['aviso'])) {
    $aviso = $_GET['aviso'];

    switch ($aviso) {
        case 'Registro inserido com Sucesso':
            $aviso = "<p>Registro inserido com Sucesso</p>";
            break;
        case 'Falha ao inserir registro':
            $aviso = "<p>Falha ao inserir registro</p>";
            break;
        case 'Formato de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos':
            $aviso = "<p>Formato de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos</p>";
            break;
        case 'Erro ao enviar a imagem':
            $aviso = "<p>Erro ao enviar a imagem</p>";
            break;
        case 'Todos os campos são obrigatórios':
            $aviso = "<p>Todos os campos são obrigatórios</p>";
            break;
    }
} else {
    $aviso = '';
}
?>

    <div class="container">
        <form action="../bd/envio.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <!-- enctype="multipart/form-data" permite o upload de arquivos -->

            <div class="header">
                <div> <i class="fa-solid fa-user" style="color: #3D5B3D;"></i></div>
                <h2>CADASTRO DE PRODUTOS</h2>
            </div>

            <hr>

            <h1><?= htmlspecialchars($usuario) ?></h1>

            <div class="form-row">


                <div class="form-group">
                    <label for="txtImagemProduto">Imagem</label>
                    <input type="file" id="txtImagemProduto" name="txtImagemProduto" accept="image/*" required>
                    <!-- O atributo accept="image/*" especifica que o campo só aceita arquivos de imagem (como .jpg, .png, etc.). -->
                </div>

                <div class="form-group">
                    <label for="txtNomeProduto">Nome do Produto</label>
                    <input type="text" id="txtNomeProduto" name="txtNomeProduto" required>
                </div>

            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="txtDescricaoProduto">Descrição do Produto</label>
                    <input type="text" id="txtDescricaoProduto" name="txtDescricaoProduto" required>
                </div>

                <div class="form-group">
                    <label for="txtValorProduto">Valor do Produto</label>
                    <input type="number" id="txtValorProduto" name="txtValorProduto" placeholder="R$ 99,99" min="0" required>
                </div>

            </div>

            <hr>

            <h3>Categoria</h3>
            <div class="form-group">

                <input class="w3-radio" type="radio" value="1" name="txtCategoriaProduto" checked>
                <label>Equipamentos</label>

                <input class="w3-radio" type="radio" value="2" name="txtCategoriaProduto">
                <label>Rosto</label>

                <input class="w3-radio" type="radio" value="3" name="txtCategoriaProduto">
                <label>Cabelo</label>

            </div>


            <div><?= $aviso ?></div>

            <div class="center">
                <button type="submit" id="btnCadastrarProduto" name="btnCadastrarProduto">Cadastrar Produto</button>
            </div>

            <div class="form-group">
                <input type="hidden" id="txtIdUsuarioProduto" name="txtIdUsuarioProduto"
                    value="<?= htmlspecialchars($id) ?>" readonly required>
            </div>

        </form>

    </div>
</body>

</html>