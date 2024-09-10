# ODASU

## Descrição

ODASU é um sistema de e-commerce que permite aos usuários realizar diversas ações, como criar e gerenciar contas, anunciar e editar produtos, além de se comunicar com outros usuários. Este sistema oferece uma plataforma completa para compra e venda de produtos, bem como para interação entre os usuários.

## Funcionalidades

- **Criar uma conta:** Usuários podem se registrar no sistema.
- **Logar na conta criada:** Usuários podem fazer login em suas contas existentes.
- **Anunciar produtos:** Usuários podem adicionar novos produtos ao sistema.
- **Editar produtos:** Usuários podem modificar detalhes dos produtos anunciados.
- **Deletar produtos:** Usuários podem remover produtos que não desejam mais anunciar.
- **Realizar logout:** Usuários podem sair de suas contas.
- **Conversar com outros usuários:** Usuários podem trocar mensagens diretamente com outros usuários da plataforma.

## Tecnologias Utilizadas

- **HTML**: Estruturação das páginas web.
- **CSS**: Estilização das páginas.
- **PHP**: Lógica do servidor e manipulação do banco de dados.
- **JavaScript**: Interatividade e funcionalidades dinâmicas.
- **NodeJs**: Para o gerenciamento de pacotes e execução de scripts.

## Estrutura do Banco de Dados

O sistema utiliza um banco de dados relacional com as seguintes tabelas:

- **tb_usuario**: Armazena informações dos usuários.
- **tb_produto**: Armazena informações dos produtos.
- **tb_categoria**: Armazena categorias dos produtos.
- **tb_conversa**: Armazena as conversas entre os usuários.

### Diagrama do Banco de Dados

![image](https://github.com/user-attachments/assets/333be152-b1a1-4d23-ad3e-1f414e5267a4)


### Descrição das Tabelas

- **tb_usuario**
  - `id_usuario` (PK): Identificador único do usuário.
  - `nome_usuario`: Nome do usuário.
  - `sobrenome_usuario`: Sobrenome do usuário.
  - `email_usuario`: Email do usuário.
  - `cel_usuario`: Número de celular do usuário.
  - `senha_usuario`: Senha do usuário.
  - `data_criacao_usuario`: Data de criação da conta.
  - `nascimento_usuario`: Data de nascimento do usuário.

- **tb_produto**
  - `id_produto` (PK): Identificador único do produto.
  - `id_usuario` (FK): Identificador do usuário que anunciou o produto.
  - `categoria_id` (FK): Identificador da categoria do produto.
  - `nome_produto`: Nome do produto.
  - `img_produto`: Imagem do produto.
  - `descricao_produto`: Descrição do produto.
  - `preco_produto`: Preço do produto.
  - `data_criacao_produto`: Data de criação do anúncio do produto.

- **tb_categoria**
  - `id_categoria` (PK): Identificador único da categoria.
  - `nome_categoria`: Nome da categoria.
  - `descricao_categoria`: Descrição da categoria.
  - `data_criacao_categoria`: Data de criação da categoria.

- **tb_conversa**
  - `id_conversa` (PK): Identificador único da conversa.
  - `id_remetente_conversa` (FK): Identificador do usuário que enviou a mensagem.
  - `id_destinatario_conversa` (FK): Identificador do usuário que recebeu a mensagem.
  - `mensagem_conversa`: Conteúdo da mensagem.
  - `data_hora_conversa`: Data e hora em que a mensagem foi enviada.

## Instalação

1. Downloads

    * Baixe e instale o [Visual Studio Code](https://code.visualstudio.com/Download)

    * Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html)
    
    * Baixe e instale o [Node.Js](https://nodejs.org/pt)

    * Baixe ou clone o repositório

2. Preparando o ambiente 

    * Copie o repositório/Pasta "ODASU" 
    * Cole o repositório/Pasta em "C:\xampp\htdocs"

3. Configurações no XAMPP

    * Abra o Xampp e inicie os serviços Apache e MySql
    * Clique em admin no serviço do MySql
    * Crie um banco de dados com o nome de "odasu"
    * Importe no banco "odasu" o arquivo Sql que está no repositório/Pasta.

4. Configurações no Visual Studio Code
    * Abra o VSCode e abra o repositório/Pasta em "C:\xampp\htdocs"
    * Inicie um novo terminal e digite o seguinte código:

    ```bash
    npm start
    ```
5. Enfim o projeto

    * Certifique-se que todos os passos estão foram feitos corretamente
    * Abra o navegador e na barra de url digite:
    
    ```bash
    localhost/ODASU
    ```
    > OBS: Caso não funcione com a seguinte URL verifique se a porta do serviço esta correta exemplo: localhost:8080/ODASU
