<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap">
    <link rel="icon" href="./favicon.png" type="image/png">
    <script src="https://kit.fontawesome.com/416980903f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/stCadastro.css">

    

</head>
<body>

    <!-- Mensagem de erro -->
    <?php
        if (isset($_GET['erro'])) {
            $erro = $_GET['erro'];

            switch ($erro) {
                case '1':
                    $mensagem = "<p>Falha ao inserir registro. Tente novamente.</p>";
                    break;
                case 'email':
                    $mensagem = "<p>Este email já está cadastrado. Por favor, use um email diferente.</p>";
                    break;
                case 'generico':
                    $mensagem = "<p>Erro ao tentar cadastrar o usuário. Por favor, tente novamente.</p>";
                    break;
            }
        
        }
        else{
            $mensagem = '';
        }
    ?>

     
    <div class="container">
        <form id="registrationForm" action="../bd/envio.php" method="post" autocomplete="off">
            <div class="header">
                <div><i class="fa-solid fa-user" style="color: #3D5B3D;"></i></div>
                <h2>CADASTRO</h2>
            </div>

            <hr>

            <div class="form-row">
                <div class="form-group">
                    <label for="txtNomeUsuario">Nome</label>
                    <input type="text" id="txtNomeUsuario" name="txtNomeUsuario" placeholder="Lisa" required>
                </div>
                <div class="form-group">
                    <label for="txtSobrenomeUsuario">Sobrenome</label>
                    <input type="text" id="txtSobrenomeUsuario" name="txtSobrenomeUsuario" placeholder="Gherardini" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="txtCelUsuario">Celular</label>
                    <input type="text" id="txtCelUsuario" name="txtCelUsuario" placeholder="(11) 90001-1234" maxlength="15" required>
                </div>
                <div class="form-group">
                    <label for="txtNascUsuario">Data de nascimento</label>
                    <input type="date" id="txtNascUsuario" name="txtNascUsuario" required>
                </div>
            </div>
            <hr>
            <h3>Dados de Login</h3>
            <div class="form-group">
                <label for="txtEmailUsuario">E-mail</label>
                <input type="email" id="txtEmailUsuario" name="txtEmailUsuario" placeholder="exemplo@exemplo.com" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="txtSenhaUsuario">Senha</label>
                    <input type="password" id="txtSenhaUsuario" name="txtSenhaUsuario" placeholder="******" minlength="6" required>
                </div>
                <div class="form-group">
                    <label for="txtSenhaUsuarioConf">Confirmar Senha</label>
                    <input type="password" id="txtSenhaUsuarioConf" name="txtSenhaUsuarioConf" placeholder="******" minlength="6" required>
                </div>
            </div>

            <!-- MENSAGEM DE ERRO -->
            <div id="error-message"><?= $mensagem ?></div>

            <div class="center">
                <button type="submit" id="btnCadastrarUsuario" name="btnCadastrarUsuario">Cadastre-se</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('txtCelUsuario').addEventListener('input', function(event) {
            let input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove tudo que não é número
            let formattedValue = '';

            // Adiciona a máscara ao valor
            if (value.length > 2) {
                formattedValue += `(${value.substring(0, 2)}) `;
                value = value.substring(2);
            }
            if (value.length > 5) {
                formattedValue += `${value.substring(0, 5)}-`;
                value = value.substring(5);
            }
            formattedValue += value;

            input.value = formattedValue;
        });

        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var passwordInput = document.getElementById('txtSenhaUsuario');
            var confirmPasswordInput = document.getElementById('txtSenhaUsuarioConf');
            var errorMessage = document.getElementById('error-message');

            // Verifica se as senhas coincidem
            if (passwordInput.value !== confirmPasswordInput.value) {
                errorMessage.textContent = 'As senhas não coincidem.';
                event.preventDefault(); // Impede o envio do formulário
                return;
            }

            // Se tudo estiver correto, limpa a mensagem de erro
            errorMessage.textContent = '';
        });
    </script>
</body>
</html>
