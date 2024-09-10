<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ODASU</title>

    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/stInicial.css">
    <link rel="stylesheet" href="css/stVenda.css">


</head>

<style>
#comprarA {
    text-decoration: none;
    margin-left: 30%;
}

.dropuser{
            margin-top:10px;
        }
</style>

<body>

    <?php
session_start(); // Inicia a sessão
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; // Obtém o nome do usuário da sessão
$id = isset($_SESSION['id']) ? $_SESSION['id'] : ''; // Obtém o ID do usuário da sessão

?>


    <header class="cabeca">

        <!-- LOGO -->
        <div class>
            <a class="logo" href="inicial.php">ODASU</a>
        </div>

        <!-- Barra de busca -->
        <div id="diviBusca">
            <img class="iconPesquisar" src="img/iconPesquisar.png" alt="" />
            <input type="text" id="txtBusca" placeholder="O que está procurando?" />
        </div>


        <!-- INFORMAÇÕES DO USUARIO -->
        <div class="user-info">

            <div class="dropuser w3-dropdown-hover">
                <button
                    class="usuarioSpan w3-button"><?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?></button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="cadastroAnuncio.php" class="w3-bar-item w3-button">Anunciar</a>
                    <a href="logout.php" class="w3-bar-item w3-button">Sair</a>
                </div>
            </div>

            <div class="cart-icon">
                <!-- # Balão de chat # 
        captura o nome do usuario e envia pela url através do PHP 
        -->
                <a href="../chat/frontend/index.php?usuario=<?php echo urlencode($usuario); ?>">
                    <img class="chat" src="img/iconChat.png" alt="">
                </a>
            </div>

        </div>

    </header>
    <nav>
        <nav>
            <div class="menu-hamburguer">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="menu">
                <li><a href="#">Equipamentos</a></li>
                <li><a href="#">Rosto</a></li>
                <li><a href="#">Maquiagem</a></li>
                <li><a href="#">Perfumaria</a></li>
                <li><a href="#">Cabelo</a></li>
                <li><a href="#">Unha</a></li>
            </ul>
        </nav>
    </nav>

    <div class="divProduto">

        <div class="divFoto">
            <div class="produto">
                <img class="lavatorio" src="img/lavatorioT.png" alt="">
            </div>

        </div>


        <div class="divDesc">
            <div class="descProduto">
                <h1 class="h1Produto">Lavatório De Cabelo Portátil Cuba Móvel Salão Beleza + Ducha</h1>
                <p class="pEstado">Estado do produto - Semi-novo</p>
                <p>Descrição/motivo da venda </p>

            </div>

            <div class="divComprarFavoritar">

                <div class="divPreco">
                    <h2 class="precoh2">R$243,37</h2>
                </div>

                <div class="divBtnCompFav">

                    <a id="comprarA" href="../chat/frontend/index.php?usuario=<?php echo urlencode($usuario); ?>">
                        <div class="btnComprar">

                            <img class="iconbtnProd" src="img/contorno-chat.png" alt="">

                            <h2 class="h2Comprar">Comprar</h2>

                        </div>
                    </a>

                </div>

            </div>
        </div>

    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <p>Odasu é o lugar que intermedia a venda e compra focado em equipamentos e produtos de salões de
                    beleza.</p>
                <button class="contact-button">Fale Conosco</button>
            </div>
            <div class="footer-bottom">
                <p>O uso deste aplicativo está sujeito aos termos e condições do Termo de Uso e Política de privacidade.
                </p>
                <p>© Odasu. Todos os direitos reservados.</p>
            </div>
            <button class="back-to-top" onclick="scrollToTop()">
                <img src="img/up.png" alt="Voltar ao Topo">
            </button>
        </div>
    </footer>


    <script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    document.querySelector('.menu-hamburguer').addEventListener('click', function() {
        document.querySelector('.menu').classList.toggle('show');
    });
    </script>


</body>


</html>