-- Criando banco de dados
CREATE DATABASE rp_eventos;

-- Usando banco de dados
USE rp_eventos;

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
    temp_masc_reserva VARCHAR(30),
    temp_nome VARCHAR(50) NOT NULL
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