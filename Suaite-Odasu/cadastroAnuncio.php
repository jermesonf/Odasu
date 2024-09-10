<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncio</title>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/stInicial.css">
    <link rel="stylesheet" href="css/stCadastroAnuncio.css">

    <style>
        /* Estilos inline para simplificação, mas é melhor usar um arquivo CSS separado */
        .lista-horizontal {
            list-style-type: none;
            /* Remove os marcadores */
            padding: 0;
            /* Remove o padding padrão */
            margin: 0;
            /* Remove a margem padrão */
        }

        .lista-horizontal li {
            display: inline-block;
            /* Exibe os itens na horizontal */
            margin-right: 20px;
            /* Espaçamento entre os itens */
            padding: 10px;
            /* Espaçamento interno opcional */
        }

        .lista-horizontal li:last-child {
            margin-right: 0;
            /* Remove a margem direita do último item */
        }

        .imgProduto {
            border: solid 1px grey;
            box-shadow: 3px 3px 5px;
            border-radius: 50%;
            width: 50px;
            margin-left: 20px;
        }

        .div-infos::-webkit-scrollbar-track {
            background: rgb(255, 255, 255);
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0) 0%);
            box-shadow: none;
        }

        .div-infos::-webkit-scrollbar-thumb {
            background-color: #9C9C9C;
        }

        ::-webkit-scrollbar {
            width: 10px;

        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            background-color: #3D5B3D;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #666;
            height: 30px;
            border-radius: 10px;
        }

        
.container-Anuncio{
    width: 60%;
    margin: 100px auto 100px auto;
    height: 600px;
    border-radius: 20px;
    justify-content: center;
    padding: 10px;
    background-color: #3D5B3D;
}


        .container-Anuncio::-webkit-scrollbar {
            width: 60%;
            margin: 100px auto 100px auto;
            height: 600px;
            border-radius: 20px;
            justify-content: center;
            padding: 10px;
            background-color: #3D5B3D;
        }


        

        #btnEditarProduto{padding: 10px 20px; background-color: #3D5B3D; border: none; border-radius: 10px; color: #ffffff; width: 190px; margin: 0px auto 0px auto;}
        #btnDeletarProduto{padding: 10px 20px; background-color: #3D5B3D; border: none; border-radius: 10px; color: #ffffff; width: 190px; margin: 0px auto 0px auto;}

    </style>

</head>

<body>

    <?php
    // Inclua o arquivo da classe
    include '../bd/controlepdo.php';

    // Inicie a sessão
    session_start();

    // Crie uma instância da classe Conexao
    $conexao = new Conexao();

    // Chame a função produtosAnunciadoUsuario
    $produtos = $conexao->produtosAnunciadoUsuario();

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

    <header class="cabeca">
        <div> <a class="logo" href="inicial.php">ODASU</a></div>

        <div class="user-info">

            <div class="w3-dropdown-hover">
                <button class=" w3-button"><?= htmlspecialchars($usuario) ?></button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="logout.php" class="w3-bar-item w3-button">Sair</a>
                </div>
            </div>
        </div>


    </header>



    <!-- Botao abrir modal ANUNCIO -->
    <div style="text-align: center;">
        <button style="margin-left:auto; margin-right:auto;" onclick="document.getElementById('id01').style.display='inline'" class=" btn-Anunciar">Anunciar</button>
        <div><?= $aviso ?></div>
    </div>

    <!-- MODAL ANUNCIO -->
    <div class="container-Anuncio container-FlexColumn " style="overflow-y:scroll; margin-top: 10px;">

        <!-- Exibir produtos anunciados pelo usuário -->
        <?php if (!empty($produtos)): ?>


            <?php foreach ($produtos as $produto): ?>
                <div class="div-btns">
                    <div class="btn-white" >
                        <ul class="lista-horizontal">
                            <li><?php echo "<img class='imgProduto' src='" . $produto['img_Produto'] . "' " . " alt='produto' '>"; ?>
                            </li>
                            <li><?php echo htmlspecialchars($produto['nome_produto']); ?></li>
                            <li>Preço: R$ <?php echo htmlspecialchars($produto['preco_produto']); ?></li>
                        </ul>
                    </div>

                    <div class="btn-grey">


                        <!-- <div onclick="document.getElementById('edit').style.display='block'"  class="bt-left blue-hover">
                    <img class="pen_icon" src="img/pen.png" alt="">
                </div> -->


                        <!--<div class="btn-grey">-->
                        <div onclick="editProduct(<?= htmlspecialchars($produto['id_produto']) ?>)" class="bt-left blue-hover" style="width: 100%; border-radius:10px;">
                            <img class="pen_icon" src="img/pen.png" alt="">
                        </div>


                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <p style="text-align:center; margin-bottom:50%; color:white;">Você não tem produtos anunciados.</p>
        <?php endif; ?>


    </div>


    <!-- MODAL INFO -->
    <div>

        <div class="w3-container ">


            <div id="id01" class="w3-modal ">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom  " id="modal-infos">

                    <div class="w3-center "><br>
                        <span onclick="document.getElementById('id01').style.display='none'"
                            class="w3-button w3-xlarge w3-hover-red w3-display-topright"
                            title="Close Modal">&times;</span>

                    </div>

                    <form class="w3-container" action="../bd/envio.php" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        <div class="w3-section">

                            <!-- --------------- -->
                            <div class="form-row ">



                                <div class="div-img">

                                    <img class="img-foto" src="img/img-foto.png" alt="">
                                    <div class="form-img">
                                        <!-- <label for="txtImagemProduto">Imagem</label> -->
                                        <input type="file" id="txtImagemProduto" name="txtImagemProduto"
                                            accept="image/*">
                                        <!-- O atributo accept="image/*" especifica que o campo só aceita arquivos de imagem (como .jpg, .png, etc.). -->

                                        <label for="txtImagemProduto" class="custom-file-upload">
                                            Escolher Arquivo
                                        </label>
                                        <span id="file-name"></span>



                                    </div>

                                </div>


                                <div class="div-infos" style="overflow-y: scroll;">

                                    <div class="form-group">
                                        <label for="txtNomeProduto" class="txt-label">Nome</label>
                                        <input style="padding-left:10px;" type="text" id="txtNomeProduto" class="txt-input" name="txtNomeProduto" placeholder="Secador de cabelo + Difusor" required>
                                    </div>

                                    <div class="form-group ">
                                        <label for="txtDescricaoProduto" class="txt-label">Descrição</label>
                                        <textarea name="txtDescricaoProduto" id="txtDescricaoProduto" placeholder="Volts: 110v, Estado: Novo, Cor: Azul." style="background-color: #9C9C9C; height: 40px; width: 90%; ;color: aliceblue; border: none; border-radius: 10px; margin-left: 20px; min-height: 40px; padding:5px" class="txt-label"></textarea>

                                        <!-- <input style="padding-left:10px;" type="text" id="txtDescricaoProduto" class="txt-input"
                                            name="txtDescricaoProduto" required> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="txtValorProduto" class="txt-label">Valor</label>
                                        <input style="padding-left:10px;" type="number" id="txtValorProduto" class="txt-input blocknumnegativo"
                                            name="txtValorProduto" min="0" placeholder="R$ 0,00" required>


                                    </div>

                                    <div class="form-group" id="div-checkbox">
                                    <h3>Categorias</h3>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="1" name="txtCategoriaProduto"
                                                checked>
                                            <label>Cabelo</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="2" name="txtCategoriaProduto">
                                            <label>Equipamentos</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="3" name="txtCategoriaProduto">
                                            <label>Perfumaria</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="4" name="txtCategoriaProduto">
                                            <label>Unha</label>
                                        </div>

                                    </div>

                                    <div class="center">
                                        <button type="submit" id="btnCadastrarProduto"
                                            name="btnCadastrarProduto">Cadastrar Produto</button>
                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">
                                    <input type="hidden" id="txtIdUsuarioProduto" name="txtIdUsuarioProduto"
                                        value="<?= htmlspecialchars($id) ?>" readonly required>
                                </div>

                            </div>

                        </div>

                        <!-- --------------- -->

                </div>
                </form>


            </div>
        </div>
    </div>

    </div>


    <!-- MODAL EDITAR -->
    <div>

        <div class="w3-container ">

            <!-- ID "edit" -->
            <div id="edit" class="w3-modal " >
                <div class="w3-modal-content w3-card-4 w3-animate-zoom  " id="modal-infos" >

                    <div class="w3-center "><br>
                        <span onclick="document.getElementById('edit').style.display='none'"
                        class="w3-button w3-display-topright">&times;</span>

                    </div>

                    <form class="w3-container" action="../bd/envio.php" method="post" autocomplete="off" enctype="multipart/form-data">
                            <!-- --------------- -->
                            <div class="form-row " >
                                


                                <div class="div-img">
                                <h2 style="margin: 0px;">Editar Produto</h2>

                                    <img class="img-foto" src="img/img-foto.png" alt="" style="margin: 0px auto 0px auto;">
                                    <div class="form-img">
                                        <!-- <label for="txtImagemProduto">Imagem</label> -->
                                        <input type="file" id="editImagemProduto" name="editImagemProduto"
                                            accept="image/*">
                                        <!-- O atributo accept="image/*" especifica que o campo só aceita arquivos de imagem (como .jpg, .png, etc.). -->

                                        <label style="margin: 0px;" for="editImagemProduto" class="custom-file-upload">
                                            Escolher Arquivo
                                        </label>
                                        <span id="file-name"></span>



                                    </div>

                                </div>


                                <div class="div-infos" style="overflow-y: scroll;">

                                    <div class="form-group">
                                        <label for="editNomeProduto" class="txt-label">Nome</label>
                                        <input style="padding-left:10px;" type="text" id="editNomeProduto" class="txt-input" name="editNomeProduto" >
                                    </div>

                                    <div class="form-group ">
                                        <label for="editDescricaoProduto" class="txt-label">Descrição</label>
                                        <textarea name="editDescricaoProduto" id="editDescricaoProduto" style="background-color: #9C9C9C; height: 40px; width: 90%; ;color: aliceblue; border: none; border-radius: 10px; margin-left: 20px; min-height: 40px; padding:5px" class="txt-label"></textarea>

                                        <!-- <input style="padding-left:10px;" type="text" id="txtDescricaoProduto" class="txt-input"
                                    name="txtDescricaoProduto" required> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="editValorProduto" class="txt-label">Valor</label>
                                        <input style="padding-left:10px;" type="number" id="editValorProduto" class="txt-input blocknumnegativo"
                                            name="editValorProduto" min="0">


                                    </div>

                                    <div class="form-group" id="div-checkbox">
                                    <h3>Categorias</h3>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="1" name="editCategoriaProduto"
                                                checked>
                                            <label>Cabelo</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="2" name="editCategoriaProduto">
                                            <label>Equipamentos</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="3" name="editCategoriaProduto">
                                            <label>Perfumaria</label>
                                        </div>

                                        <div class="div-categorias">
                                            <input class="w3-radio" type="radio" value="4" name="editCategoriaProduto">
                                            <label>Unha</label>
                                        </div>

                                    </div>

                                    <div class="center">
                                        <button type="submit" id="btnEditarProduto" name="btnEditarProduto">Alterar</button>
                                        <button type="submit" id="btnDeletarProduto" name="btnDeletarProduto">Deletar</button>
                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">
                                    <input type="hidden" id="idProduto" name="idProduto" readonly required>
                                </div>

                            </div>

                        </div>

                        <!-- --------------- -->

                </div>
                </form>


            </div>
        </div>
    </div>

    </div>





    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <p>Odasu é o lugar que intermedia a venda e compra focado em equipamentos e produtos de salões de
                    beleza.</p>
                <a href="contato.php"><button class="contact-button">Fale Conosco</button></a>
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
        // Seleciona o input específico e o span para exibir o nome do arquivo
        const fileInput = document.querySelector('.form-img #txtImagemProduto');
        const fileNameDisplay = document.querySelector('.form-img #file-name');

        // Quando o usuário seleciona um arquivo, exibe o nome no span
        fileInput.addEventListener('change', function() {
            // Se um arquivo for escolhido, exibe o nome
            const fileName = this.files.length ? this.files[0].name : '';
            fileNameDisplay.textContent = fileName;
        });


        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        document.querySelector('.menu-hamburguer').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('show');
        });



        //Proibido numeros negativos
        document.getElementsByClassName('blocknumnegativo').addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });






        function editProduct(id) {
            // Abra o modal de edição
            document.getElementById('edit').style.display = 'block';

            // Preencha o campo ID no modal com o ID do produto
            document.querySelector('[name="idProduto"]').value = id;



            // Se você tiver outros campos para preencher, você pode buscar esses dados com AJAX ou
            // se já tiver as informações carregadas na página, você pode preenchê-las aqui
        }





        document.getElementById('deleteProductDiv').addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');

            // Enviar a requisição AJAX para o servidor
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_product.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Produto deletado com sucesso!');
                    window.location.href = '../Suaite-Odasu/cadastroAnuncio.php?aviso=Produto%20deletado%20com%20Sucesso';
                } else {
                    alert('Não foi possível deletar o produto.');
                    window.location.href = '../Suaite-Odasu/cadastroAnuncio.php?aviso=Não%20foi%20possível%20deletar';
                }
            };
            xhr.send('idProdutoDelete=' + encodeURIComponent(productId));
        });
    </script>

</body>

</html>