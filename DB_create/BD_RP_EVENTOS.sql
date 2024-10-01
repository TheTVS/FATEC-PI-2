-- Criando banco de dados
CREATE DATABASE rp_eventos;

-- Usando banco de dados
USE rp_eventos;

-- Tabela usuario admin
CREATE TABLE usuario(
    userId INT NOT NULL AUTO_INCREMENT,
    userNome VARCHAR(60) NOT NULL,
    userSenha VARCHAR(40) NOT NULL,
    PRIMARY KEY(userId)
);

-- Criando tabela responsavel

-- Tabela responsável
CREATE TABLE responsavel (
    res_cpf VARCHAR(11) PRIMARY KEY,
    res_nome VARCHAR(60) NOT NULL,
    res_sobrenome VARCHAR(60) NOT NULL,
    res_rg VARCHAR(60) NOT NULL,
    res_telefone1 VARCHAR(13) NOT NULL,
    res_telefone2 VARCHAR(13),
    res_email1 VARCHAR(60) NOT NULL,
    res_email2 VARCHAR(60),
    res_tipo ENUM('mãe', 'pai', 'outro') NOT NULL,
    res_tipo_outro VARCHAR(60)
);

-- Tabela endereço
CREATE TABLE endereco (
    end_id INT PRIMARY KEY AUTO_INCREMENT,
    end_estado VARCHAR(2) NOT NULL,
    end_cidade VARCHAR(50) NOT NULL,
    end_bairro VARCHAR(50) NOT NULL,
    end_rua VARCHAR(50) NOT NULL,
    end_numero INT NOT NULL,
    end_cep VARCHAR(9) NOT NULL
);

-- Tabela temporada
CREATE TABLE temporada (
    temp_id INT PRIMARY KEY AUTO_INCREMENT,
    temp_data_inicio DATE NOT NULL,
    temp_data_fim DATE NOT NULL,
    temp_max_parcela TINYINT NOT NULL,
    temp_nome VARCHAR(50) NOT NULL,
    temp_preco DECIMAL(8,2) NOT NULL,
    temp_festa VARCHAR(255) NOT NULL
);

-- Tabela acampante
CREATE TABLE acampante (
    aca_id INT PRIMARY KEY AUTO_INCREMENT,
    aca_nome VARCHAR(60) NOT NULL,
    aca_sobrenome VARCHAR(60) NOT NULL,
    aca_idade INT NOT NULL,
    aca_data_nasc DATE NOT NULL,
    aca_peso DECIMAL(5,2),
    aca_altura DECIMAL(5,2),
    aca_sintia BOOLEAN,
    aca_responsavel_res_cpf VARCHAR(11),
    end_id INT,
    FOREIGN KEY (aca_responsavel_res_cpf) REFERENCES responsavel(res_cpf),
    FOREIGN KEY (end_id) REFERENCES endereco(end_id)
);

-- Tabela inscricao
CREATE TABLE inscricao (
    ins_id INT PRIMARY KEY AUTO_INCREMENT,
    ins_pagamento DECIMAL(10,2) NOT NULL,
    ins_data DATE NOT NULL,
    temp_id INT,
    res_cpf VARCHAR(11),
    aca_id INT,
    FOREIGN KEY (temp_id) REFERENCES temporada(temp_id),
    FOREIGN KEY (res_cpf) REFERENCES responsavel(res_cpf),
    FOREIGN KEY (aca_id) REFERENCES acampante(aca_id)
);

-- Tabela convenio
CREATE TABLE convenio (
    con_id INT PRIMARY KEY AUTO_INCREMENT,
    con_nome VARCHAR(30),
    con_numero INT,
    con_telefone VARCHAR(13),
    con_observacao VARCHAR(150)
);

-- Tabela acampante_convenio
CREATE TABLE acampante_convenio (
    aca_id INT,
    con_id INT,
    PRIMARY KEY (aca_id, con_id),
    FOREIGN KEY (aca_id) REFERENCES acampante(aca_id),
    FOREIGN KEY (con_id) REFERENCES convenio(con_id)
);

-- Tabela vacina
CREATE TABLE vacina (
    vac_id INT PRIMARY KEY AUTO_INCREMENT,
    vac_nome VARCHAR(60) NOT NULL
);

-- Tabela registro_vacina
CREATE TABLE registro_vacina (
    rv_id INT PRIMARY KEY AUTO_INCREMENT,
    aca_id INT,
    vac_id INT,
    rv_data DATE,
    FOREIGN KEY (aca_id) REFERENCES acampante(aca_id),
    FOREIGN KEY (vac_id) REFERENCES vacina(vac_id)
);

-- Tabela doenca
CREATE TABLE doenca (
    doe_id INT PRIMARY KEY AUTO_INCREMENT,
    doe_nome VARCHAR(100),
    doe_tipo VARCHAR(60),
    doe_categoria VARCHAR(50)
);

-- Tabela registro_doenca
CREATE TABLE registro_doenca (
    rd_id INT PRIMARY KEY AUTO_INCREMENT,
    aca_id INT,
    doe_id INT,
    FOREIGN KEY (aca_id) REFERENCES acampante(aca_id),
    FOREIGN KEY (doe_id) REFERENCES doenca(doe_id)
);

-- Tabela medicamento
CREATE TABLE medicamento (
    med_id INT PRIMARY KEY AUTO_INCREMENT,
    med_nome VARCHAR(60)
);

-- Tabela registro_medico
CREATE TABLE registro_medico (
    rm_id INT PRIMARY KEY AUTO_INCREMENT,
    aca_id INT,
    med_id INT,
    rm_horario TIME,
    rm_frequencia VARCHAR(50),
    FOREIGN KEY (aca_id) REFERENCES acampante(aca_id),
    FOREIGN KEY (med_id) REFERENCES medicamento(med_id)
);

-- Inserts
INSERT INTO doenca (doe_nome, doe_tipo, doe_categoria)
VALUES 
('Convulsões', 'Crônica', 'Neurológica'),
('Desmaios', 'Crônica', 'Neurológica'),
('Hemofilia', 'Crônica', 'Sanguínea'),
('Enxaqueca', 'Crônica', 'Neurológica'),
('Distúrbios neurológicos', 'Crônica', 'Neurológica'),
('Cardiopatias', 'Crônica', 'Cardíaca'),
('Diabetes', 'Crônica', 'Metabólica'),
('Hipoglicemia', 'Crônica', 'Metabólica'),
('Asma / Bronquite', 'Crônica', 'Respiratória');

ALTER TABLE acampante
CHANGE aca_peso aca_sexo VARCHAR(1),
CHANGE aca_altura aca_tamanho_camiseta VARCHAR(3),
CHANGE aca_sintia aca_tipo_sanguinio VARCHAR(3);

ALTER TABLE inscricao
ADD COLUMN ins_num_parcela TINYINT
DEFAULT 1;


ALTER TABLE vacina
MODIFY vac_nome VARCHAR(255);

INSERT INTO vacina (vac_nome) 
VALUES	('BCG (Tuberculose) - Dose única'),
		('Hepatite B - 3 doses'),
		('Tríplice ou Tetra Bacteriana (Difteria, Tétano, Coqueluche e Haemophilus Influenzae B) - 3
		doses + 2 reforços'),
		('Poliomielite (Paralisia Infantil) - 3 doses + 2 reforços'),
		('Rotavírus - 2 ou 3 doses'),
		('Tríplice Viral (Sarampo, Caxumba e Rubéola) - 1 dose + 1 reforço'),
		('Hepatite A - 2 doses'),
		('Varicela (Catapora) - 1 dose + 1 reforço'),
		('Meningocócica Conjugada C (Meningite Bacteriana) - 3 doses ou dose única'),
		('Pneumocócica Conjugada 7, 10 ou 13 Valente (Doenças Pneumocócicas) - 4 doses, 3
		doses, 2 doses ou dose única'),
		('Influenza (Gripe) - Anual'),
		('Febre Amarela');

ALTER TABLE registro_vacina DROP rv_data;