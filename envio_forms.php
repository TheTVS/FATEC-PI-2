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

    $resNom = isset($_POST['res-nom']) ? $_POST['res-nom'] : '';
    $resSob = isset($_POST['res-sob']) ? $_POST['res-sob'] : '';
    $inputDocumento = isset($_POST['input-documento']) ? $_POST['input-documento'] : '';
    $resCpf = isset($_POST['res-cpf']) ? $_POST['res-cpf'] : '';
    $resTel1 = isset($_POST['res-tel-1']) ? $_POST['res-tel-1'] : '';
    $resTel2 = isset($_POST['res-tel-2']) ? $_POST['res-tel-2'] : '';
    $resTel3 = isset($_POST['res-tel-3']) ? $_POST['res-tel-3'] : '';
    $resEml1 = isset($_POST['res-eml-1']) ? $_POST['res-eml-1'] : '';
    $resEml2 = isset($_POST['res-eml-2']) ? $_POST['res-eml-2'] : '';
    $resRes = isset($_POST['res-res']) ? $_POST['res-res'] : '';
    $endCep = isset($_POST['end-cep']) ? $_POST['end-cep'] : '';
    $endRua = isset($_POST['end-rua']) ? $_POST['end-rua'] : '';
    $endBai = isset($_POST['end-bai']) ? $_POST['end-bai'] : '';
    $endCid = isset($_POST['end-cid']) ? $_POST['end-cid'] : '';
    $endUf = isset($_POST['end-uf']) ? $_POST['end-uf'] : '';
    $endNum = isset($_POST['end-num']) ? $_POST['end-num'] : '';
    $criNom = isset($_POST['cri-nom']) ? $_POST['cri-nom'] : '';
    $criSob = isset($_POST['cri-sob']) ? $_POST['cri-sob'] : '';
    $criRg = isset($_POST['cri-rg']) ? $_POST['cri-rg'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
    $criTar = isset($_POST['cri-tar']) ? $_POST['cri-tar'] : '';
    $valPar = isset($_POST['val-par']) ? $_POST['val-par'] : '';

        // Captura os valores dos campos
    $sangue = $_POST['sangue'] ?? '';
    $rh = $_POST['rh'] ?? '';
    $tem_con = $_POST['tem-con'] ?? '';
    $con_nom = $_POST['con-nom'] ?? '';
    $con_cnt = $_POST['con-cnt'] ?? '';
    $tem_con_obs = $_POST['tem-con-obs'] ?? '';
    
    // Alergias a medicamentos
    $ale_med_aps = isset($_POST['ale-med-aps']) ? 'Sim' : 'Não';
    $ale_med_mel = isset($_POST['ale-med-mel']) ? 'Sim' : 'Não';
    $ale_med_nov = isset($_POST['ale-med-nov']) ? 'Sim' : 'Não';
    $ale_med_pla = isset($_POST['ale-med-pla']) ? 'Sim' : 'Não';
    $ale_med_dra = isset($_POST['ale-med-dra']) ? 'Sim' : 'Não';
    $ale_med_pov = isset($_POST['ale-med-pov']) ? 'Sim' : 'Não';
    $ale_med_cat = isset($_POST['ale-med-cat']) ? 'Sim' : 'Não';
    $ale_med_pen = isset($_POST['ale-med-pen']) ? 'Sim' : 'Não';

    // Outras alergias
    $tem_ale_med = $_POST['tem-ale-med'] ?? '';
    $ale_med_obs = $_POST['ale-med-obs'] ?? '';

     // Doença Crônica
    $temDoe = isset($_POST['tem-doe']) ? $_POST['tem-doe'] : '';
    $doencas = [];
    
    if (isset($_POST['doe'])) {
        $doencas = $_POST['doe'];
    }

    // Detalhes das doenças crônicas
    $doeConObs = isset($_POST['doe-con-obs']) ? $_POST['doe-con-obs'] : '';
    $doeCarObs = isset($_POST['doe-car-obs']) ? $_POST['doe-car-obs'] : '';
    $doeDesObs = isset($_POST['doe-des-obs']) ? $_POST['doe-des-obs'] : '';
    $doeDiaObs = isset($_POST['doe-dia-obs']) ? $_POST['doe-dia-obs'] : '';
    $doeHemObs = isset($_POST['doe-hem-obs']) ? $_POST['doe-hem-obs'] : '';
    $doeHipObs = isset($_POST['doe-hip-obs']) ? $_POST['doe-hip-obs'] : '';
    $doeEnxObs = isset($_POST['doe-enx-obs']) ? $_POST['doe-enx-obs'] : '';
    $doeBroObs = isset($_POST['doe-bro-obs']) ? $_POST['doe-bro-obs'] : '';
    $doeDisObs = isset($_POST['doe-dis-obs']) ? $_POST['doe-dis-obs'] : '';
    $doeOutObs = isset($_POST['doe-out-obs']) ? $_POST['doe-out-obs'] : '';

    // Histórico de Saúde
    $varicela = isset($_POST['his-sau-var']) ? $_POST['his-sau-var'] : '';
    $sonambulismo = isset($_POST['his-sau-son']) ? $_POST['his-sau-son'] : '';
    $sonambulismoObs = isset($_POST['his-sau-son-obs']) ? $_POST['his-sau-son-obs'] : '';

     // Captura os dados do formulário
    $sintomasMedicamentos = isset($_POST['reg-sin-med-obs']) ? $_POST['reg-sin-med-obs'] : '';
    
    // Para checkboxes, você pode verificar se estão definidos
    $vacinas = [];
    $vacinas['bcg'] = isset($_POST['his-vac-bcg']) ? true : false;
    $vacinas['hpb'] = isset($_POST['his-vac-hpb']) ? true : false;
    $vacinas['tet'] = isset($_POST['his-vac-tet']) ? true : false;
    $vacinas['pol'] = isset($_POST['his-vac-pol']) ? true : false;
    $vacinas['rot'] = isset($_POST['his-vac-rot']) ? true : false;
    $vacinas['sar'] = isset($_POST['his-vac-sar']) ? true : false;
    $vacinas['hpa'] = isset($_POST['his-vac-hpa']) ? true : false;
    $vacinas['var'] = isset($_POST['his-vac-var']) ? true : false;
    $vacinas['men'] = isset($_POST['his-vac-men']) ? true : false;
    $vacinas['pne'] = isset($_POST['his-vac-pne']) ? true : false;
    $vacinas['inf'] = isset($_POST['his-vac-inf']) ? true : false;
    $vacinas['feb'] = isset($_POST['his-vac-feb']) ? true : false;

    // Captura se o participante faz uso de outros medicamentos
    $outrosMedicamentos = isset($_POST['tem-his-vac-out']) ? $_POST['tem-his-vac-out'] : '';
    $detalhesOutrosMedicamentos = isset($_POST['his-vac-out']) ? $_POST['his-vac-out'] : '';

    // Captura observações
    $temObservacao = isset($_POST['tem-his-vac-obs']) ? $_POST['tem-his-vac-obs'] : '';
    $observacoes = isset($_POST['his-vac-obs']) ? $_POST['his-vac-obs'] : '';

    // Captura a concordância com as normas
    $concordoNormas = isset($_POST['nor']) ? true : false;

-->
