<?php

include('resource/database/conexao.php');

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

//abre conexao
$conexao->begin_transaction();

try {

    // Inserindo dados na tabela responsavel
    $sql = "INSERT INTO responsavel (res_cpf, res_nome, res_sobrenome, res_rg, res_telefone1, res_telefone2, res_email1, res_email2, res_tipo, res_tipo_outro) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro responsavel criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela responsavel: " . $conexao->error);
    }

    // Inserindo dados na tabela endereco
    $sql = "INSERT INTO endereco (end_estado, end_cidade, end_bairro, end_rua, end_numero, end_cep) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        // Obtendo o ID auto incrementado endereco
        $endereco_id = $conexao->insert_id;
        echo "Novo registro criado com ID: " . $endereco_id;
    } else {
        throw new Exception("Erro ao inserir na tabela endereço: " . $conexao->error);
    }

    // Inserindo dados na tabela acampante
    $sql = "INSERT INTO acampante (aca_nome, aca_sobrenome, aca_idade, aca_data_nasc, aca_peso, aca_altura, aca_sintia, aca_responsavel_res_cpf, end_id) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        // Obtendo o ID auto incrementado acampante
        $acampante_id = $conexao->insert_id;
        echo "Novo registro acampante criado com ID: " . $acampante_id;
    } else {
        throw new Exception("Erro ao inserir na tabela acampante: " . $conexao->error);
    }

    // Inserindo dados na tabela inscricao
    $sql = "INSERT INTO inscricao (ins_pagamento, ins_data, temp_id, res_cpf, aca_id) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro inscricao criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela inscricao: " . $conexao->error);
    }

    // Inserindo dados na tabela convenio
    $sql = "INSERT INTO convenio (con_nome, con_numero, con_telefone, con_observacao) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        // Obtendo o ID auto incrementado convenio
        $convenio_id = $conexao->insert_id;
        echo "Novo registro convenio criado com ID: " . $aconvenio_id;
    } else {
        throw new Exception("Erro ao inserir na tabela convenio: " . $conexao->error);
    }

    // Inserindo dados na tabela acampante_convenio
    $sql = "INSERT INTO acampante_convenio (aca_id, con_id) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro acampante_convenio criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela acampante_convenio: " . $conexao->error);
    }

    // Inserindo dados na tabela registro_vacina
    $sql = "INSERT INTO registro_vacina (aca_id, vac_id, rv_data) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro registro_vacina criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela registro_vacina: " . $conexao->error);
    }

    // Inserindo dados na tabela registro_doenca
    $sql = "INSERT INTO registro_doenca (aca_id, doe_id) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro registro_doenca criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela registro_doenca: " . $conexao->error);
    }

    // Inserindo dados na tabela registro_medico
    $sql = "INSERT INTO registro_medico (aca_id, med_id, rm_horario, rm_frequencia) VALUES ();";
    if ($conexao->query($sql) === TRUE) {
        echo "Novo registro registro_medico criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela registro_doenca: " . $conexao->error);
    }

    // Confirma a transação
    $conexao->commit();
} catch (Exception $e) {
    // Se algo falhar, faz rollback
    $conexao->rollback();
    echo "Erro: " . $e->getMessage();
}

//fecha conexão
$conexao->close();
?>

<!--

-- Inserindo dados na tabela temporada
INSERT INTO temporada (temp_data_inicio, temp_data_fim, temp_masc_reserva, temp_nome) 
VALUES 
('2024-01-10', '2024-01-20', 'Sim', 'Verão 2024'),
('2024-07-15', '2024-07-30', 'Não', 'Férias de Julho 2024');

-- Inserindo dados na tabela vacina
INSERT INTO vacina (vac_nome) 
VALUES 
('Vacina contra Gripe'),
('Vacina COVID-19');

-- Inserindo dados na tabela doenca
INSERT INTO doenca (doe_nome, doe_tipo, doe_categoria) 
VALUES 
('Asma', 'Respiratória', 'Crônica'),
('Diabetes', 'Metabólica', 'Crônica');

-- Inserindo dados na tabela medicamento
INSERT INTO medicamento (med_nome) 
VALUES 
('Broncodilatador'),
('Insulina');

-->
