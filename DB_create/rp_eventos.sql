-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07-Nov-2024 às 20:33
-- Versão do servidor: 8.0.35
-- versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rp_eventos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acampante`
--

CREATE TABLE `acampante` (
  `aca_id` int NOT NULL,
  `aca_nome` varchar(60) NOT NULL,
  `aca_sobrenome` varchar(60) NOT NULL,
  `aca_idade` int NOT NULL,
  `aca_data_nasc` date NOT NULL,
  `aca_sexo` varchar(1) DEFAULT NULL,
  `aca_tamanho_camiseta` varchar(3) DEFAULT NULL,
  `aca_tipo_sanguinio` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `end_id` int DEFAULT NULL,
  `res_id` int DEFAULT NULL,
  `aca_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `acampante_convenio`
--

CREATE TABLE `acampante_convenio` (
  `aca_id` int NOT NULL,
  `con_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `alergia`
--

CREATE TABLE `alergia` (
  `ale_id` int NOT NULL,
  `ale_nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `alergia`
--

INSERT INTO `alergia` (`ale_id`, `ale_nome`) VALUES
(1, 'Aspirina'),
(2, 'Melhoral'),
(3, 'Novalgina (dipirona)'),
(4, 'Plasil (metoclopramida)'),
(5, 'Dramin'),
(6, 'Povidine (iodo)'),
(7, 'Catafian (diclofenaco)'),
(8, 'Penicilina'),
(9, 'Pó'),
(10, 'Alimentos'),
(11, 'Picadas de Insetos'),
(12, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `convenio`
--

CREATE TABLE `convenio` (
  `con_id` int NOT NULL,
  `con_nome` varchar(30) DEFAULT NULL,
  `con_numero` varchar(20) DEFAULT NULL,
  `con_telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `con_observacao` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `doenca`
--

CREATE TABLE `doenca` (
  `doe_id` int NOT NULL,
  `doe_nome` varchar(100) DEFAULT NULL,
  `doe_tipo` varchar(60) DEFAULT NULL,
  `doe_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `doenca`
--

INSERT INTO `doenca` (`doe_id`, `doe_nome`, `doe_tipo`, `doe_categoria`) VALUES
(1, 'Convulsões', 'Crônica', 'Neurológica'),
(2, 'Desmaios', 'Crônica', 'Neurológica'),
(3, 'Hemofilia', 'Crônica', 'Sanguínea'),
(4, 'Enxaqueca', 'Crônica', 'Neurológica'),
(5, 'Distúrbios neurológicos', 'Crônica', 'Neurológica'),
(6, 'Cardiopatias', 'Crônica', 'Cardíaca'),
(7, 'Diabetes', 'Crônica', 'Metabólica'),
(8, 'Hipoglicemia', 'Crônica', 'Metabólica'),
(9, 'Asma / Bronquite', 'Crônica', 'Respiratória');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int NOT NULL,
  `end_estado` varchar(2) NOT NULL,
  `end_cidade` varchar(50) NOT NULL,
  `end_bairro` varchar(50) NOT NULL,
  `end_rua` varchar(50) NOT NULL,
  `end_numero` int NOT NULL,
  `end_cep` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `ins_id` int NOT NULL,
  `ins_pagamento` decimal(10,2) NOT NULL,
  `ins_data` date NOT NULL,
  `temp_id` int DEFAULT NULL,
  `aca_id` int DEFAULT NULL,
  `ins_num_parcela` tinyint DEFAULT '1',
  `res_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_alergia`
--

CREATE TABLE `registro_alergia` (
  `ra_id` int NOT NULL,
  `ra_obs` varchar(200) DEFAULT NULL,
  `aca_id` int DEFAULT NULL,
  `ale_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_doenca`
--

CREATE TABLE `registro_doenca` (
  `rd_id` int NOT NULL,
  `aca_id` int DEFAULT NULL,
  `doe_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_medico`
--

CREATE TABLE `registro_medico` (
  `rm_id` int NOT NULL,
  `aca_id` int DEFAULT NULL,
  `med` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `registro_vacina`
--

CREATE TABLE `registro_vacina` (
  `rv_id` int NOT NULL,
  `aca_id` int DEFAULT NULL,
  `vac_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `res_id` int NOT NULL,
  `res_cpf` varchar(20) NOT NULL,
  `res_nome` varchar(60) NOT NULL,
  `res_sobrenome` varchar(60) NOT NULL,
  `res_rg` varchar(60) NOT NULL,
  `res_telefone1` varchar(20) NOT NULL,
  `res_telefone2` varchar(20) DEFAULT NULL,
  `res_email1` varchar(60) NOT NULL,
  `res_email2` varchar(60) DEFAULT NULL,
  `res_tipo` enum('mãe','pai','outro') NOT NULL,
  `res_tipo_outro` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE `temporada` (
  `temp_id` int NOT NULL,
  `temp_data_inicio` date NOT NULL,
  `temp_data_fim` date NOT NULL,
  `temp_max_parcela` tinyint NOT NULL,
  `temp_nome` varchar(50) NOT NULL,
  `temp_preco` decimal(8,2) NOT NULL,
  `temp_festa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `userId` int NOT NULL,
  `userNome` varchar(60) NOT NULL,
  `userSenha` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`userId`, `userNome`, `userSenha`) VALUES
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_acampante`
--

CREATE TABLE `usuario_acampante` (
  `usu_cpf` varchar(20) NOT NULL,
  `usu_senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura da tabela `vacina`
--

CREATE TABLE `vacina` (
  `vac_id` int NOT NULL,
  `vac_nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `vacina`
--

INSERT INTO `vacina` (`vac_id`, `vac_nome`) VALUES
(1, 'BCG (Tuberculose) - Dose única'),
(2, 'Hepatite B - 3 doses'),
(3, 'Tríplice ou Tetra Bacteriana (Difteria, Tétano, Coqueluche e Haemophilus Influenzae B) - 3\r\n		doses + 2 reforços'),
(4, 'Poliomielite (Paralisia Infantil) - 3 doses + 2 reforços'),
(5, 'Rotavírus - 2 ou 3 doses'),
(6, 'Tríplice Viral (Sarampo, Caxumba e Rubéola) - 1 dose + 1 reforço'),
(7, 'Hepatite A - 2 doses'),
(8, 'Varicela (Catapora) - 1 dose + 1 reforço'),
(9, 'Meningocócica Conjugada C (Meningite Bacteriana) - 3 doses ou dose única'),
(10, 'Pneumocócica Conjugada 7, 10 ou 13 Valente (Doenças Pneumocócicas) - 4 doses, 3\r\n		doses, 2 doses ou dose única'),
(11, 'Influenza (Gripe) - Anual'),
(12, 'Febre Amarela');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acampante`
--
ALTER TABLE `acampante`
  ADD PRIMARY KEY (`aca_id`),
  ADD KEY `end_id` (`end_id`),
  ADD KEY `fk_responsavel` (`res_id`);

--
-- Índices para tabela `acampante_convenio`
--
ALTER TABLE `acampante_convenio`
  ADD PRIMARY KEY (`aca_id`,`con_id`),
  ADD KEY `con_id` (`con_id`);

--
-- Índices para tabela `alergia`
--
ALTER TABLE `alergia`
  ADD PRIMARY KEY (`ale_id`);

--
-- Índices para tabela `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`con_id`);

--
-- Índices para tabela `doenca`
--
ALTER TABLE `doenca`
  ADD PRIMARY KEY (`doe_id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`);

--
-- Índices para tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`ins_id`),
  ADD KEY `temp_id` (`temp_id`),
  ADD KEY `aca_id` (`aca_id`),
  ADD KEY `fk_responsavel_inscricao` (`res_id`);

--
-- Índices para tabela `registro_alergia`
--
ALTER TABLE `registro_alergia`
  ADD PRIMARY KEY (`ra_id`),
  ADD KEY `aca_id` (`aca_id`),
  ADD KEY `ale_id` (`ale_id`);

--
-- Índices para tabela `registro_doenca`
--
ALTER TABLE `registro_doenca`
  ADD PRIMARY KEY (`rd_id`),
  ADD KEY `aca_id` (`aca_id`),
  ADD KEY `doe_id` (`doe_id`);

--
-- Índices para tabela `registro_medico`
--
ALTER TABLE `registro_medico`
  ADD PRIMARY KEY (`rm_id`),
  ADD KEY `aca_id` (`aca_id`);

--
-- Índices para tabela `registro_vacina`
--
ALTER TABLE `registro_vacina`
  ADD PRIMARY KEY (`rv_id`),
  ADD KEY `aca_id` (`aca_id`),
  ADD KEY `vac_id` (`vac_id`);

--
-- Índices para tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`res_id`);

--
-- Índices para tabela `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`temp_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`userId`);

--
-- Índices para tabela `usuario_acampante`
--
ALTER TABLE `usuario_acampante`
  ADD PRIMARY KEY (`usu_cpf`);

--
-- Índices para tabela `vacina`
--
ALTER TABLE `vacina`
  ADD PRIMARY KEY (`vac_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acampante`
--
ALTER TABLE `acampante`
  MODIFY `aca_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alergia`
--
ALTER TABLE `alergia`
  MODIFY `ale_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `convenio`
--
ALTER TABLE `convenio`
  MODIFY `con_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `doenca`
--
ALTER TABLE `doenca`
  MODIFY `doe_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inscricao`
--
ALTER TABLE `inscricao`
  MODIFY `ins_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_alergia`
--
ALTER TABLE `registro_alergia`
  MODIFY `ra_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_doenca`
--
ALTER TABLE `registro_doenca`
  MODIFY `rd_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_medico`
--
ALTER TABLE `registro_medico`
  MODIFY `rm_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `registro_vacina`
--
ALTER TABLE `registro_vacina`
  MODIFY `rv_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `res_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `temporada`
--
ALTER TABLE `temporada`
  MODIFY `temp_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vacina`
--
ALTER TABLE `vacina`
  MODIFY `vac_id` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acampante`
--
ALTER TABLE `acampante`
  ADD CONSTRAINT `acampante_ibfk_2` FOREIGN KEY (`end_id`) REFERENCES `endereco` (`end_id`),
  ADD CONSTRAINT `fk_responsavel` FOREIGN KEY (`res_id`) REFERENCES `responsavel` (`res_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `acampante_convenio`
--
ALTER TABLE `acampante_convenio`
  ADD CONSTRAINT `acampante_convenio_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`),
  ADD CONSTRAINT `acampante_convenio_ibfk_2` FOREIGN KEY (`con_id`) REFERENCES `convenio` (`con_id`);

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `fk_responsavel_inscricao` FOREIGN KEY (`res_id`) REFERENCES `responsavel` (`res_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`temp_id`) REFERENCES `temporada` (`temp_id`),
  ADD CONSTRAINT `inscricao_ibfk_3` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`);

--
-- Limitadores para a tabela `registro_alergia`
--
ALTER TABLE `registro_alergia`
  ADD CONSTRAINT `registro_alergia_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`),
  ADD CONSTRAINT `registro_alergia_ibfk_2` FOREIGN KEY (`ale_id`) REFERENCES `alergia` (`ale_id`);

--
-- Limitadores para a tabela `registro_doenca`
--
ALTER TABLE `registro_doenca`
  ADD CONSTRAINT `registro_doenca_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`),
  ADD CONSTRAINT `registro_doenca_ibfk_2` FOREIGN KEY (`doe_id`) REFERENCES `doenca` (`doe_id`);

--
-- Limitadores para a tabela `registro_medico`
--
ALTER TABLE `registro_medico`
  ADD CONSTRAINT `registro_medico_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`);

--
-- Limitadores para a tabela `registro_vacina`
--
ALTER TABLE `registro_vacina`
  ADD CONSTRAINT `registro_vacina_ibfk_1` FOREIGN KEY (`aca_id`) REFERENCES `acampante` (`aca_id`),
  ADD CONSTRAINT `registro_vacina_ibfk_2` FOREIGN KEY (`vac_id`) REFERENCES `vacina` (`vac_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
