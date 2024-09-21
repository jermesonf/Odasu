-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Set-2024 às 18:33
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `odasu`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CadastroUsuario` (IN `pnomeUsuario` VARCHAR(100), IN `psobrenomeUsuario` VARCHAR(100), IN `pemailUsuario` VARCHAR(100), IN `pcelUsuario` VARCHAR(20), IN `psenhaEmail` VARCHAR(255), IN `pnascimentoUsuario` DATE)   BEGIN
    -- Inserir dados na tabela tb_usuario
    INSERT INTO tb_usuario(nome_usuario, sobrenome_usuario, email_usuario, cel_usuario, senha_usuario, nascimento_usuario)
    VALUES (pnomeUsuario, psobrenomeUsuario, pemailUsuario, pcelUsuario, psenhaEmail, pnascimentoUsuario);

    -- Selecionar todos os dados da tabela tb_usuario (se desejado)
    -- Remover ou ajustar esta linha se não for necessário retornar todos os dados
    SELECT * FROM tb_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Login` (IN `pEmailUsuario` VARCHAR(100), IN `pSenhaUsuario` VARCHAR(255))   BEGIN
	DECLARE login VARCHAR(100);
    DECLARE senha VARCHAR(255);
    DECLARE nome VARCHAR(100);
    DECLARE id int(11);
    
    
    SET login = (SELECT email_usuario from tb_usuario
                 WHERE email_usuario = pEmailUsuario);
                 
    SET senha = (SELECT senha_usuario from tb_usuario
                WHERE senha_usuario = pSenhaUsuario AND email_usuario = login);
                
     SET nome = (SELECT nome_usuario  from tb_usuario
                 WHERE email_usuario = login AND senha_usuario = senha);
                 
      SET id = (SELECT id_usuario  from tb_usuario
                 WHERE email_usuario = login AND senha_usuario = senha);
                 
    IF login IS NOT NULL
    THEN 
    	IF pSenhaUsuario = senha
        THEN
             SELECT nome AS "Resposta", id AS "Resposta2";
        ELSE
        	SELECT "Senha incorreta" AS "Resposta";
        END IF;
    ELSE
    	SELECT "Usuário não encontrado" AS "Resposta";
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE `tb_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL,
  `descricao_categoria` text DEFAULT NULL,
  `data_criacao_categoria` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_categoria`, `nome_categoria`, `descricao_categoria`, `data_criacao_categoria`) VALUES
(1, 'CABELO', 'Shampoo, Condicionador, Touca etc...', '2024-09-10 14:03:43'),
(2, 'EQUIPAMENTOS', 'Secador, Prancha, Difusor, Escova, Auto-clave etc...', '2024-09-10 14:03:43'),
(3, 'PERFUMARIA', 'Protetor Solar, BodySplash, Creme corporal etc...', '2024-09-10 14:03:43'),
(4, 'UNHAS', 'Unhas postiças, esmalte, alicates etc...', '2024-09-10 14:03:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conversa`
--

CREATE TABLE `tb_conversa` (
  `id_conversa` int(11) NOT NULL,
  `id_remetente_conversa` int(11) DEFAULT NULL,
  `id_destinatario_conversa` int(11) DEFAULT NULL,
  `mensagem_conversa` text NOT NULL,
  `data_hora_conversa` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `img_Produto` blob NOT NULL,
  `descricao_produto` text DEFAULT NULL,
  `preco_produto` decimal(10,2) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_criacao_produto` datetime DEFAULT current_timestamp(),
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id_produto`, `nome_produto`, `img_Produto`, `descricao_produto`, `preco_produto`, `id_usuario`, `data_criacao_produto`, `categoria_id`) VALUES
(1, 'Alicate de unha (MUNDIAL)', 0x2e2e2f5375616974652d4f646173752f696d6167656d42442f616c69636174652d64652d756e68612e706e67, 'Marca: Mundial\r\nEstado: Novo', '30.00', 1, '2024-09-10 14:22:09', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `sobrenome_usuario` varchar(100) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `cel_usuario` varchar(20) DEFAULT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `data_criacao_usuario` datetime DEFAULT current_timestamp(),
  `nascimento_usuario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `nome_usuario`, `sobrenome_usuario`, `email_usuario`, `cel_usuario`, `senha_usuario`, `data_criacao_usuario`, `nascimento_usuario`) VALUES
(1, 'Maisa', 'Harumi', 'maisahm@gmail.com', '(11) 91234-5678', '123456', '2024-09-10 14:05:37', '1990-10-01');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nome_categoria` (`nome_categoria`);

--
-- Índices para tabela `tb_conversa`
--
ALTER TABLE `tb_conversa`
  ADD PRIMARY KEY (`id_conversa`),
  ADD KEY `id_remetente_conversa` (`id_remetente_conversa`),
  ADD KEY `id_destinatario_conversa` (`id_destinatario_conversa`);

--
-- Índices para tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `fk_categoria_produto` (`categoria_id`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_categoria`
--
ALTER TABLE `tb_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `tb_conversa`
--
ALTER TABLE `tb_conversa`
  MODIFY `id_conversa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_conversa`
--
ALTER TABLE `tb_conversa`
  ADD CONSTRAINT `tb_conversa_ibfk_1` FOREIGN KEY (`id_remetente_conversa`) REFERENCES `tb_usuario` (`id_usuario`),
  ADD CONSTRAINT `tb_conversa_ibfk_2` FOREIGN KEY (`id_destinatario_conversa`) REFERENCES `tb_usuario` (`id_usuario`);

--
-- Limitadores para a tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_categoria_produto` FOREIGN KEY (`categoria_id`) REFERENCES `tb_categoria` (`id_categoria`),
  ADD CONSTRAINT `tb_produto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
