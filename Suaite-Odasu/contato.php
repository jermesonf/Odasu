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

    <link rel="stylesheet" href="css/stContato.css">

    <style>
        .dropuser {
            margin-top: 10px;
        }

     
        .categorie a:hover {
            color: #608660;
            /* text-decoration: underline; */
            font-size: 18px;
        }

        .categories a:hover {
            color: #608660;
            /* text-decoration: underline; */
            font-size: 18px;
        }
    </style>
</head>

<body>

    <?php
    session_start(); // Inicia a sessão
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; // Obtém o nome do usuário da sessão
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : ''; // Obtém o ID do usuário da sessão

    ?>

    <header class="cabeca">
        <div> <a class="logo" href="inicial.php">ODASU</a></div>


        <div class="user-info">

            <div class="dropuser w3-dropdown-hover">
                <button class="usuarioSpan w3-button"><?php echo htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8'); ?></button>
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

    <div class="squad">
        <div class="central">
            <h1>Nosso Time</h1>
        </div>
    </div>

    <section class="categories">

        <div class="card">
            <img class="tim" src="img/7.jpg" alt="Avatar">

            <div>
                <div class="container">
                    <h4><b>Jermeson </b></h4>
                    <p>Full-Stack</p>
                </div>
            </div>

            <div id="jer">
                <img class="linked" src="img/li.png" alt=""> <a href="https://www.linkedin.com/in/jermeson"
                    target="_blank"> Jermeson</a>
            </div>
        </div>

        <div class="card">
            <img class="tim" src="img/maria.jpg" alt="Avatar">

            <div class="container">
                <h4><b>Maria</b></h4>
                <p>Front-end | Designer</p>
            </div>

            <div id="maria">
                <img class="linked" src="img/li.png" alt=""> <a href="https://www.linkedin.com/in/maria-leandro"
                    target="_blank"> Maria </a>
            </div>

        </div>

        <div class="card">
            <img class="tim" src="img/henrique.png" alt="Avatar">
            <div class="container">
                <h4><b>Henrique</b></h4>
                <p>Front-end | Designer</p>
            </div>

            <div id="hen">
                <img class="linked" src="img/li.png" alt=""> <a href="https://www.linkedin.com/in/henrique-carvalho-839a872a4"
                    target="_blank"> Henrique </a>
            </div>

        </div>

    </section>

    <section class="categorie">
        <div class="card">
            <img class="tim" src="img/maisa.jpg" alt="Avatar">

            <div class="container">
                <h4><b>Maisa</b></h4>
                <p>Full stack</p>
            </div>
            <div class="maisa">
                <img class="linked" src="img/li.png" alt=""> <a href="https://www.linkedin.com/in/maisahmy"
                    target="_blank"> Maisa </a>
            </div>
        </div>

        <div class="card">
            <img class="tim" src="img/gustavo.png" alt="Avatar">
            <div class="container">
                <h4><b>Gustavo</b></h4>
                <p>Back-end</p>
            </div>
            <div id="gustavo">
                <img class="linked" src="img/li.png" alt=""> <a href="https://www.linkedin.com/in/gustavo-henrique-ab0495249"
                    target="_blank"> Gustavo </a>
            </div>
        </div>
    </section>

</body>

</html>