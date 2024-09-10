<?php

class Conexao 
{
    //Constantes de definem os parâmetros do Banco de Dados
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DB_NAME = "odasu";
    var $pdo = null;

    //o construtor é executado ao intanciar a classe
    //CONEXAO BANCO
    public function __construct()
    {
        $this->Conectar();
    }
    public function Conectar()
    {
        try {
            //Instância da classe PDO - Construtor realiza a conexão.
            $this->pdo = new PDO(
                'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME,
                self::USER,
                self::PASSWORD
                
            );
            //Parar o processo de conexão caso haja erro - lançar uma exceção.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // . para concatenar
            // -> para buscar os atributos dentro da variavel
            echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
        }
    }

// ##########################################################################################################

    //CADASTRO DE USUARIOS
    public function CadastrarUsuario()
    {
       
        //ISSET verifica se o atributo foi configurado.
        if (isset($_POST["txtNomeUsuario"])) {

            //Declaração de variáveis
            $nomeUsuario = $_POST["txtNomeUsuario"];
            $sobrenomeUsuario = $_POST["txtSobrenomeUsuario"];
            $nascimentoUsuario = $_POST["txtNascUsuario"];
            $emailUsuario = $_POST["txtEmailUsuario"];
            $foneCelularUsuario = $_POST["txtCelUsuario"];
            $senhaUsuario = $_POST["txtSenhaUsuario"];
            
            //Chamada da procedure
            $query = "CALL SP_CadastroUsuario (:nomeUsuario, :sobrenomeUsuario, :emailUsuario, :celUsuario, :senhaUsuario, :nascimentoUsuario)";
        
            try{
                //Atribui o Insert ao PDO
                $insert = $this->pdo->prepare($query);
                
                //Define os parâmetros que serão substituídos
                $insert->bindParam(':nomeUsuario', $nomeUsuario);
                $insert->bindParam(':sobrenomeUsuario', $sobrenomeUsuario);
                $insert->bindParam(':emailUsuario', $emailUsuario);
                $insert->bindParam(':celUsuario', $foneCelularUsuario);
                $insert->bindParam(':senhaUsuario', $senhaUsuario);
                $insert->bindParam(':nascimentoUsuario', $nascimentoUsuario);

                //Verifica se house inserção de registros no Banco de Dados
                if ($insert->execute()) {
                    header('Location: ../Suaite-Odasu/entrar.php');
                    exit();
                } else {
                    // Redirecionar de volta com mensagem de erro
                    header('Location: ../Suaite-Odasu/cadastro.php?erro=1');
                    exit();
                }

            }catch (PDOException $e) {
                // Captura e exibe a exceção
                if ($e->getCode() == 23000) {
                    // Código 23000 é geralmente usado para violação de restrição de integridade
                    //enviado o mensagem para o url
                    header('Location: ../Suaite-Odasu/cadastro.php?erro=email');
                    exit();
                } else {
                    // Para outros tipos de erros
                    header('Location: ../Suaite-Odasu/cadastro.php?erro=generico');
                    exit();
                }
            }
        }
        
        
    }

// ##########################################################################################################

//FUNÇÃO OBTENDO ID - TESTAR
// public function CadastrarProduto()
// {
//     if (isset($_POST["txtNomeProduto"]) && isset($_POST["txtCategoriaProduto"])) {
//         $nomeProduto = $_POST["txtNomeProduto"];
//         $descricaoProduto = $_POST["txtDescricaoProduto"];
//         $valorProduto = $_POST["txtValorProduto"];
//         $categoriaProduto = $_POST["txtCategoriaProduto"];
//         $idUsuarioProduto = $_POST["txtIdUsuarioProduto"];

//         if (isset($_FILES["txtImagemProduto"]) && $_FILES["txtImagemProduto"]["error"] == 0) {
//             $imagemProduto = $_FILES["txtImagemProduto"];
//             $nomeImagem = $imagemProduto["name"];
//             $tipoImagem = $imagemProduto["type"];
//             $tamanhoImagem = $imagemProduto["size"];
//             $caminhoTemporario = $imagemProduto["tmp_name"];

//             $extensoesPermitidas = ["jpg", "jpeg", "png", "gif"];
//             $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);

//             if (in_array($extensao, $extensoesPermitidas)) {
//                 $caminhoDestino = "../Suaite-Odasu/imagemBD/" . $nomeImagem;
//                 move_uploaded_file($caminhoTemporario, $caminhoDestino);

//                 $query = "INSERT INTO tb_Produto(nome_produto, img_Produto, descricao_produto, preco_produto, id_usuario, categoria_id)
//                           VALUES (:nomeProduto, :imgProduto, :descricaoProduto, :valorProduto, :IdUsuarioProduto, :categoriaProduto)";

//                 $insert = $this->pdo->prepare($query);

//                 $insert->bindParam(':nomeProduto', $nomeProduto);
//                 $insert->bindParam(':imgProduto', $caminhoDestino);
//                 $insert->bindParam(':descricaoProduto', $descricaoProduto);
//                 $insert->bindParam(':valorProduto', $valorProduto);
//                 $insert->bindParam(':categoriaProduto', $categoriaProduto);
//                 $insert->bindParam(':IdUsuarioProduto', $idUsuarioProduto);

//                 if ($insert->execute()) {
//                     // Captura o ID do produto inserido
//                     $idProduto = $this->pdo->lastInsertId();
                    
//                     // Faça algo com $idProduto aqui, se necessário
                    
//                     $aviso = "Registro inserido com Sucesso. ID do produto: " . $idProduto;
//                     header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
//                     exit();
//                 } else {
//                     $aviso =  "Falha ao inserir registro";
//                     header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
//                     exit();
//                 }
//             } else {
//                 $aviso = "Formato de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos";
//                 header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
//                 exit();
//             }
//         } else {
//             $aviso =  "Erro ao enviar a imagem";
//             header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
//             exit();
//         }
//     } else {
//         $aviso =  "Todos os campos são obrigatórios";
//         header('Location: ../Suaite-Odasu/cadastroAnuncio.php?mensagem=' . urlencode($aviso));
//         exit();
//     }
// }





    //CADASTRO DE PRODUTOS
    public function CadastrarProduto()
    {
        if (isset($_POST["txtNomeProduto"]) && isset($_POST["txtCategoriaProduto"])) {
            $nomeProduto = $_POST["txtNomeProduto"];
            $descricaoProduto = $_POST["txtDescricaoProduto"];
            $valorProduto = $_POST["txtValorProduto"];
            $categoriaProduto = $_POST["txtCategoriaProduto"];
            $idUsuarioProduto = $_POST["txtIdUsuarioProduto"];
    
            if (isset($_FILES["txtImagemProduto"]) && $_FILES["txtImagemProduto"]["error"] == 0) {
                $imagemProduto = $_FILES["txtImagemProduto"];
                $nomeImagem = $imagemProduto["name"];
                $tipoImagem = $imagemProduto["type"];
                $tamanhoImagem = $imagemProduto["size"];
                $caminhoTemporario = $imagemProduto["tmp_name"];
    
                $extensoesPermitidas = ["jpg", "jpeg", "png", "gif"];
                $extensao = pathinfo($nomeImagem, PATHINFO_EXTENSION);
    
                if (in_array($extensao, $extensoesPermitidas)) {
                    $caminhoDestino = "../Suaite-Odasu/imagemBD/" . $nomeImagem;
                    move_uploaded_file($caminhoTemporario, $caminhoDestino);
    
                    $query = "INSERT INTO tb_Produto(nome_produto, img_Produto, descricao_produto, preco_produto, id_usuario, categoria_id)
                              VALUES (:nomeProduto, :imgProduto, :descricaoProduto, :valorProduto, :IdUsuarioProduto, :categoriaProduto)";
    
                    $insert = $this->pdo->prepare($query);
    
                    $insert->bindParam(':nomeProduto', $nomeProduto);
                    $insert->bindParam(':imgProduto', $caminhoDestino);
                    $insert->bindParam(':descricaoProduto', $descricaoProduto);
                    $insert->bindParam(':valorProduto', $valorProduto);
                    $insert->bindParam(':categoriaProduto', $categoriaProduto);
                    $insert->bindParam(':IdUsuarioProduto', $idUsuarioProduto);
    
                    if ($insert->execute()) {

                         // Captura o ID do produto inserido
                         $idProduto = $this->pdo->lastInsertId();
                    
                        $aviso =  "Registro inserido com Sucesso";
                        header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso) . '&' . urlencode($idProduto) );
                        exit();
                    } else {
                        $aviso =  "Falha ao inserir registro";
                        header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                        exit();
                    }
                } else {
                    $aviso = "Formato de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos";
                    header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                    exit();
                }
            } else {
                $aviso =  "Erro ao enviar a imagem";
                header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                exit();
            }
        } else {
            $aviso =  "Todos os campos são obrigatórios";
            header('Location: ../Suaite-Odasu/cadastroAnuncio.php?mensagem=' . urlencode($aviso));
            exit();
        }
    }

// ##########################################################################################################    

    //LISTAR OS PRODUTOS DO BANCO DE DADOS
    public function mostrarProduto()
    {
        $query = "SELECT * FROM tb_produto";
    
        $select = $this->pdo->prepare($query);
        $select->execute();
    
        return $select->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os produtos em um array associativo
    }

// ##########################################################################################################

    public function produtosAnunciadoUsuario()
    {
        $idusuario = $_SESSION['id']; // Recupera o ID do usuário da sessão
    
        $query = "SELECT * FROM tb_produto WHERE id_usuario = :idusuario";
        $select = $this->pdo->prepare($query);

        $select->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
        
        $select->execute();
        $resultados = $select->fetchAll(PDO::FETCH_ASSOC);
    
        return $resultados;
    }

// ##########################################################################################################

    public function EditarProduto()
    {
        if (isset($_POST["idProduto"]) && isset($_POST["editNomeProduto"])) {
            $nomeProduto = $_POST["editNomeProduto"];
            $descricaoProduto = $_POST["editDescricaoProduto"];
            $valorProduto = $_POST["editValorProduto"];
            $categoriaProduto = $_POST["editCategoriaProduto"];
            $idProduto = $_POST["idProduto"];

            // Prepare the base query
            $query = "UPDATE tb_Produto SET nome_produto = :nomeProduto, descricao_produto = :descricaoProduto, preco_produto = :valorProduto, categoria_id = :categoriaProduto";

            // Add image update conditionally
            if (isset($_FILES["editImagemProduto"]) && $_FILES["editImagemProduto"]["error"] == 0) {
                $imagemProduto = $_FILES["editImagemProduto"];
                $nomeImagem = $imagemProduto["name"];
                $tipoImagem = $imagemProduto["type"];
                $tamanhoImagem = $imagemProduto["size"];
                $caminhoTemporario = $imagemProduto["tmp_name"];

                $extensoesPermitidas = ["jpg", "jpeg", "png", "gif"];
                $extensao = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));

                if (in_array($extensao, $extensoesPermitidas)) {
                    $caminhoDestino = "../Suaite-Odasu/imagemBD/" . basename($nomeImagem);
                    if (move_uploaded_file($caminhoTemporario, $caminhoDestino)) {
                        $query .= ", img_Produto = :imgProduto";
                    } else {
                        $aviso = "Erro ao mover o arquivo para o diretório de destino.";
                        header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                        exit();
                    }
                } else {
                    $aviso = "Formato de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos";
                    header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                    exit();
                }
            }

            $query .= " WHERE id_produto = :idProduto";

            $insert = $this->pdo->prepare($query);

            $insert->bindParam(':nomeProduto', $nomeProduto);
            $insert->bindParam(':descricaoProduto', $descricaoProduto);
            $insert->bindParam(':valorProduto', $valorProduto);
            $insert->bindParam(':categoriaProduto', $categoriaProduto);
            $insert->bindParam(':idProduto', $idProduto);

            // Bind the image parameter if an image was uploaded
            if (isset($caminhoDestino)) {
                $insert->bindParam(':imgProduto', $caminhoDestino);
            }

            if ($insert->execute()) {
                $aviso = "Registro Alterado com Sucesso";
                header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                exit();
            } else {
                $aviso = "Falha ao alterar registro";
                header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($aviso));
                exit();
            }
        } else {
            $aviso = "Todos os campos são obrigatórios";
            header('Location: ../Suaite-Odasu/cadastroAnuncio.php?mensagem=' . urlencode($aviso));
            exit();
        }
    }


// ##########################################################################################################

    public function deletarProduto()
    {
        if (isset($_POST["idProduto"]) && is_numeric($_POST["idProduto"])) {


            $idProdutoDelete = $_POST["idProduto"];

            $query = "DELETE FROM tb_produto WHERE id_produto = :idProduto";

            $delete = $this->pdo->prepare($query);

            $delete->bindParam(':idProduto', $idProdutoDelete);

            if ($delete->execute()) {
                $avisoDelete = "Produto deletado com Sucesso";
                header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($avisoDelete));
                exit();
            }
            else
            {
                $avisoDelete = "Não foi possivel deletar";
                header('Location: ../Suaite-Odasu/cadastroAnuncio.php?aviso=' . urlencode($avisoDelete));
                exit();
            }

        } else {
            echo 'ID do produto inválido';
        }

    }   

// ##########################################################################################################


    //LOGIN USUARIO
    public function LoginUsuario()
    {
        
        //Esta variavel mensagem é para mostrar os erros de credenciais executadas pelo usuario.
        $mensagem = '';

        $loginEmailUsuario = $_POST["txtLoginEmailUsuario"];
        $loginSenhaUsuario = $_POST["txtLoginSenhaUsuario"];
        
        $query = "CALL SP_Login(:txtLoginEmailUsuario, :txtLoginSenhaUsuario)";

        $select = $this->pdo->prepare($query);
        $select->bindParam(':txtLoginEmailUsuario', $loginEmailUsuario);
        $select->bindParam(':txtLoginSenhaUsuario', $loginSenhaUsuario);
        
        $select->execute();
        $resultado = $select->fetchAll(PDO::FETCH_ASSOC);

        if ($resultado[0]['Resposta'] == "Senha incorreta") 
        {
            $mensagem = "Credenciais inválidas. Por favor, verifique o e-mail e a senha.";
            header('Location: ../Suaite-Odasu/entrar.php?mensagem=' . urlencode($mensagem));
            exit();
        } 
        else if ($resultado[0]['Resposta'] == "Usuário não encontrado") 
        {
            $mensagem = "Usuário não encontrado. Por favor, tente novamente.";
            header('Location: ../Suaite-Odasu/entrar.php?mensagem=' . urlencode($mensagem));
            exit();
        } 
        else 
        {
            session_start(); // Inicia a sessão
            $_SESSION['usuario'] = $resultado[0]['Resposta']; // Armazena o nome do usuário na sessão
            $_SESSION['id'] = $resultado[0]['Resposta2']; // Armazena o id do usuário na sessão
            header('Location: ../Suaite-Odasu/inicial.php'); // Redireciona para a página inicial
            exit();
        }
    }

// ##########################################################################################################

    //LOGIN ADMIN (descontinuado)
    public function LoginAdmin()
    {
        //ISSET verifica se o atributo foi configurado.
        if (isset($_POST["txtLoginEmailAdmin"])) {

            //Declaração das variáveis
            $loginEmailAdmin = $_POST["txtLoginEmailAdmin"];
            $loginSenhaUAdmin = $_POST["txtLoginSenhaAdmin"];

            $query = "SELECT email_Usuario, senha_Usuario FROM tb_Usuario
            WHERE email_Usuario = :txtLoginEmailAdmin AND senha_Usuario = :txtLoginSenhaAdmin";
            
            //Atribui o select ao PDO
            $select = $this->pdo->prepare($query);
            
            //Define os parâmetros que serão substituídos
            $select->bindParam(':txtLoginEmailAdmin', $loginEmailAdmin);
            $select->bindParam(':txtLoginSenhaAdmin', $loginSenhaUAdmin);

            if ($select->execute()) {
                if($loginEmailAdmin == "admin@admin.com" and $loginSenhaUAdmin == "admin")
                {
                    echo "<p><marquee>Bem vindo admin</marquee></p>";
                    return;
                }
                else
                {
                    echo "<p><marquee>Senha ou email invalido</marquee></p>";
                }
            }
            else
            {
                echo "<p><marquee>Falha no banco</marquee></p>";
            }

        }
    }

// ##########################################################################################################

    // Método para enviar uma mensagem no chat
    public function EnviarMensagem($remetenteId, $destinatarioId, $mensagem)
    {
         $query = "INSERT INTO tb_conversa (id_remetente_conversa, id_destinatario_conversa, mensagem_conversa, data_hora_conversa) 
                   VALUES (:remetenteId, :destinatarioId, :mensagem, NOW())";
         
         $stmt = $this->pdo->prepare($query);
         $stmt->bindParam(':remetenteId', $remetenteId);
         $stmt->bindParam(':destinatarioId', $destinatarioId);
         $stmt->bindParam(':mensagem', $mensagem);
         
         return $stmt->execute();
    }

// ##########################################################################################################

     // Método para recuperar mensagens do chat
     public function RecuperarMensagens($remetenteId, $destinatarioId)
     {
         $query = "SELECT id_remetente_conversa, mensagem_conversa, data_hora_conversa 
                   FROM tb_conversa 
                   WHERE (id_remetente_conversa = :remetenteId AND id_destinatario_conversa = :destinatarioId) 
                      OR (id_remetente_conversa = :destinatarioId AND id_destinatario_conversa = :remetenteId) 
                   ORDER BY data_hora_conversa ASC";
         
         $stmt = $this->pdo->prepare($query);
         $stmt->bindParam(':remetenteId', $remetenteId);
         $stmt->bindParam(':destinatarioId', $destinatarioId);
         $stmt->execute();
         
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

// ##########################################################################################################

    //ESQUECEU A SENHA
    public function esqueceuSenha()
    {  
        $usuarioEmailMostrar = $_POST["txtUsuarioEmailMostrar"];
       
        $query = "SELECT senha_usuario 
        FROM tb_usuario 
        WHERE email_usuario = :txtUsuarioEmailMostrar";

        $select = $this->pdo->prepare($query);

        $select->bindParam(':txtUsuarioEmailMostrar', $usuarioEmailMostrar);

        if($select->execute()){
            $result = $select->fetch(PDO::FETCH_ASSOC);

             if ($result) {
                // MOSTRA A SENHA DO USUÁRIO
                $senha = urlencode($result['senha_usuario']); // Codifica a senha para a URL
                header("Location: ../Suaite-Odasu/senhaEsquecida.php?mensagem=senha_enviada&senha={$senha}");
                exit();

             } else {
                header('Location: ../Suaite-Odasu/senhaEsquecida.php?mensagem=usuariousuario_inexistente');
                exit();
             }

         } else {
            echo "deu bucha!";
         }

          
    }



 }//FIM PHP