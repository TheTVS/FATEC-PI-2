<?php

include('resource/database/conexao.php');

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}
//abre conexao
$conexao->begin_transaction();

try {
    //pega os valores da temporada
    $sql = "SELECT temp_id,temp_data_inicio,temp_preco FROM temporada WHERE temp_id = (SELECT MAX(temp_id) FROM temporada)";

    $result = $conexao->query($sql);

    // Verifica se um resultado foi encontrado
    if ($result->num_rows > 0) {
        // Busca os dados
        $row = $result->fetch_assoc();

        // Salva os dados em variáveis
        $tempId = $row['temp_id'];//usado
        $dataInicio = $row['temp_data_inicio'];//usado
        $valorInscrição = $row['temp_preco'];//usado

    } else {
        $texto = "Nenhuma temporada encontrada.";
    }

    // Inserindo dados na tabela responsavel feito
    $sql = "INSERT INTO responsavel (res_cpf, res_nome, res_sobrenome, res_rg, res_telefone1, res_telefone2, res_email1, res_email2, res_tipo, res_tipo_outro) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssssss", isset($_POST['res-cpf']) ? $_POST['res-cpf'] : '', isset($_POST['res-nom']) ? $_POST['res-nom'] : '', isset($_POST['res-sob']) ? $_POST['res-sob'] : '', isset($_POST['input-documento']) ? $_POST['input-documento'] : '', isset($_POST['res-tel-1']) ? $_POST['res-tel-1'] : '', isset($_POST['res-tel-2']) ? $_POST['res-tel-2'] : '', isset($_POST['res-eml-1']) ? $_POST['res-eml-1'] : '', isset($_POST['res-eml-2']) ? $_POST['res-eml-2'] : '', isset($_POST['res-res']) ? $_POST['res-res'] : '', isset($_POST['outro']) ? $_POST['outro'] : '');
    if ($stmt->execute()) {
        echo "Novo registro responsavel criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela responsavel: " . $stmt->error);
    }

    // Inserindo dados na tabela endereco feito
    $sql = "INSERT INTO endereco (end_estado, end_cidade, end_bairro, end_rua, end_numero, end_cep) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssis", isset($_POST['end-uf']) ? $_POST['end-uf'] : '', isset($_POST['end-cid']) ? $_POST['end-cid'] : '', isset($_POST['end-bai']) ? $_POST['end-bai'] : '', isset($_POST['end-rua']) ? $_POST['end-rua'] : '', isset($_POST['end-num']) ? $_POST['end-num'] : 0, isset($_POST['end-cep']) ? $_POST['end-cep'] : '');
    if ($stmt->execute()) {
        // Obtendo o ID auto incrementado endereco
        $endereco_id = $conexao->insert_id;
        echo "Novo registro criado com ID: " . $endereco_id;
    } else {
        throw new Exception("Erro ao inserir na tabela endereco: " . $stmt->error);
    }

    //sangue acampante
    $sangue = $_POST['sangue'] ?? '';
    $rh = $_POST['rh'] ?? '';
    $sangeRh = $sangue . $rh; 
    // Inserindo dados na tabela acampante feito
    $sql = "INSERT INTO acampante (aca_nome, aca_sobrenome, aca_idade, aca_data_nasc, aca_sexo, aca_tamanho_camiseta, aca_tipo_sanguinio, aca_responsavel_res_cpf, end_id) VALUES (?, ?, (DATEDIFF(?, ?), ?, ?, ?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssddssi", isset($_POST['cri-nom']) ? $_POST['cri-nom'] : '', isset($_POST['cri-sob']) ? $_POST['cri-sob'] : '', $dataInicio, isset($_POST['birthday']) ? $_POST['birthday'] : '', isset($_POST['birthday']) ? $_POST['birthday'] : '', isset($_POST['sexo']) ? $_POST['sexo'] : '', isset($_POST['cri-tar']) ? $_POST['cri-tar'] : '';, $sangeRh, isset($_POST['res-cpf']) ? $_POST['res-cpf'] : '', $endereco_id);
    if ($stmt->execute()) {
        // Obtendo o ID auto incrementado acampante
        $acampante_id = $conexao->insert_id;
        echo "Novo registro acampante criado com ID: " . $acampante_id;
    } else {
        throw new Exception("Erro ao inserir na tabela acampante: " . $stmt->error);
    }

    // Inserindo dados na tabela inscricao feita
    $sql = "INSERT INTO inscricao (ins_pagamento, ins_data, temp_id, res_cpf, aca_id,ins_num_parcela) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("dsisii", $valorInscrição, date('d/m/Y'), $tempId, isset($_POST['res-cpf']) ? $_POST['res-cpf'] : '', $acampante_id, isset($_POST['val-par']) ? $_POST['val-par'] : '');
    if ($stmt->execute()) {
        echo "Novo registro inscricao criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela inscricao: " . $stmt->error);
    }

    // Inserindo dados na tabela convenio feito
    $sql = "INSERT INTO convenio (con_nome, con_numero, con_telefone, con_observacao) VALUES (?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $_POST['con-nom'] ?? '', isset($_POST['con-num']) ? $_POST['con-num'] : '', $_POST['con-cnt'] ?? '', $_POST['tem-con-obs'] ?? '');
    if ($stmt->execute()) {
        // Obtendo o ID auto incrementado convenio
        $convenio_id = $conexao->insert_id;
        echo "Novo registro convenio criado com ID: " . $convenio_id;
    } else {
        throw new Exception("Erro ao inserir na tabela convenio: " . $stmt->error);
    }

    // Inserindo dados na tabela acampante_convenio feito
    $sql = "INSERT INTO acampante_convenio (aca_id, con_id) VALUES (?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $acampante_id, $convenio_id);
    if ($stmt->execute()) {
        echo "Novo registro acampante_convenio criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela acampante_convenio: " . $stmt->error);
    }

    //texto pra krl na vacina agr vamo ver se consigo fazer isso de forma eficiente , salvei todos os valores que nao sao 0 em um vetor dai fiz um for pra cada
    $vacinas = []; // Inicializa o array para armazenar os dados
    $vacinas[0] = isset($_POST['his-vac-bcg']) ? 1 : null;
    $vacinas[1] = isset($_POST['his-vac-hpb']) ? 2 : null;
    $vacinas[2] = isset($_POST['his-vac-tet']) ? 3 : null;
    $vacinas[3] = isset($_POST['his-vac-pol']) ? 4 : null;
    $vacinas[4] = isset($_POST['his-vac-rot']) ? 5 : null;
    $vacinas[5] = isset($_POST['his-vac-sar']) ? 6 : null;
    $vacinas[6] = isset($_POST['his-vac-hpa']) ? 7 : null;
    $vacinas[7] = isset($_POST['his-vac-var']) ? 8 : null;
    $vacinas[8] = isset($_POST['his-vac-men']) ? 9 : null;
    $vacinas[9] = isset($_POST['his-vac-pne']) ? 10 : null;
    $vacinas[10] = isset($_POST['his-vac-inf']) ? 11 : null;
    $vacinas[11] = isset($_POST['his-vac-feb']) ? 12 : null;
    
    $vacinas_filtradas = array_filter($vacinas); // Filtra vacinas não definidas
    $vacinas_filtradas = array_values($vacinas_filtradas); // Reindexa o array
    
    foreach ($vacinas_filtradas as $vacina_id) {
        // Inserindo dados na tabela registro_vacina feito
        $sql = "INSERT INTO registro_vacina (aca_id, vac_id) VALUES (?, ?);"; // rv_data removido
        $stmt = $conexao->prepare($sql);
        
        // Verifica se a preparação da consulta foi bem-sucedida
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta: " . $conexao->error);
        }
    
        $stmt->bind_param("ii", $acampante_id, $vacina_id);
        
        if ($stmt->execute()) {
            echo "Novo registro na tabela registro_vacina criado.";
        } else {
            throw new Exception("Erro ao inserir na tabela registro_vacina: " . $stmt->error);
        }
    }

    //pegando os valores das doencas
    // Check each checkbox
    if (isset($_POST["doe"])) {
        // Convulsões
        if (isset($_POST["doe-con"])) {
        $doencas[] = "Convulsões";
        $doeConObs = $_POST["doe-con-obs"];
        }

        // Cardiopatias
        if (isset($_POST["doe-car"])) {
        $doencas[] = "Cardiopatias";
        $doeCarObs = $_POST["doe-car-obs"];
        }

        // Desmaios
        if (isset($_POST["doe-des"])) {
        $doencas[] = "Desmaios";
        $doeDesObs = $_POST["doe-des-obs"];
        }

        // Diabetes
        if (isset($_POST["doe-dia"])) {
        $doencas[] = "Diabetes";
        $doeDiaObs = $_POST["doe-dia-obs"];
        }

        // Hemorragias
        if (isset($_POST["doe-hem"])) {
        $doencas[] = "Hemorragias";
        $doeHemObs = $_POST["doe-hem-obs"];
        }

        // Hipoglicemia
        if (isset($_POST["doe-hip"])) {
        $doencas[] = "Hipoglicemia";
        $doeHipObs = $_POST["doe-hip-obs"];
        }

        // Enxaqueca
        if (isset($_POST["doe-enx"])) {
        $doencas[] = "Enxaqueca";
        $doeEnxObs = $_POST["doe-enx-obs"];
        }

        // Asma/Bronquite
        if (isset($_POST["doe-bro"])) {
        $doencas[] = "Asma/Bronquite";
        $doeBroObs = $_POST["doe-bro-obs"];
        }

        // Distúrbios neurológicos
        if (isset($_POST["doe-dis"])) {
        $doencas[] = "Distúrbios neurológicos";
        $doeDisObs = $_POST["doe-dis-obs"];
        }
    }

    // Inserindo dados na tabela registro_doenca pegar os valores de doencas certas
    $sql = "INSERT INTO registro_doenca (aca_id, doe_id) VALUES (?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ii", $acampante_id, $doe_id);
    if ($stmt->execute()) {
        echo "Novo registro registro_doenca criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela registro_doenca: " . $stmt->error);
    }

    // Inserindo dados na tabela registro_medico
    $sql = "INSERT INTO registro_medico (aca_id, med_id, rm_horario, rm_frequencia) VALUES (?, ?, ?, ?);";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("iiss", $acampante_id, $med_id, $rm_horario, $rm_frequencia);
    if ($stmt->execute()) {
        echo "Novo registro registro_medico criado.";
    } else {
        throw new Exception("Erro ao inserir na tabela registro_medico: " . $stmt->error);
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

<!--nao funciona passar para a proxima pagina conversar com m

    responsavel--
    $resNom = ;
    $resSob = ;
    $inputDocumento = ;
    $resCpf = ;
    $resTel1 = ;
    $resTel2 = ;
    $resTel3 = ;
    $resEml1 = ;
    $resEml2 = ;
    $resRes = ;
    --

    endereco-- feito
    $endCep = ;
    $endRua = ;
    $endBai = ;
    $endCid = ;
    $endUf = ;
    $endNum = ;--

    acampante--
    $criNom = ;
    $criSob = ;
    $sexo = ;
    $birthday = ;
    $criTar =;
    $sangue = ;
    $rh =;
    $resultado = $sangue . $rh; 
    --

    pagamento-- feito
    $valPar = --


    convenio--feito
    $con_nom =;
    $con_cnt = ;
    con_numero 


    // Para checkboxes, você pode verificar se estão definidos feito so tem que ver o bagulho do rv_date
    $vacinas = [];
    // Captura observações pode retirar essas porra de observacao da vacia ou no caso  colocar no banco  de dados 
    $temObservacao = isset($_POST['tem-his-vac-obs']) ? $_POST['tem-his-vac-obs'] : '';
    $observacoes = isset($_POST['his-vac-obs']) ? $_POST['his-vac-obs'] : '';
    

    // Alergias a medicamentos tem que ver a tabela de alegias no banco q ta faltando
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

// Check if the form has been submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store the selected diseases
    $selectedDiseases = array();

    // Check each checkbox
    if (isset($_POST["doe"])) {
      // Convulsões
      if (isset($_POST["doe-con"])) {
        $selectedDiseases[] = "Convulsões";
        $doeConObs = $_POST["doe-con-obs"];
      }

      // Cardiopatias
      if (isset($_POST["doe-car"])) {
        $selectedDiseases[] = "Cardiopatias";
        $doeCarObs = $_POST["doe-car-obs"];
      }

      // Desmaios
      if (isset($_POST["doe-des"])) {
        $selectedDiseases[] = "Desmaios";
        $doeDesObs = $_POST["doe-des-obs"];
      }

      // Diabetes
      if (isset($_POST["doe-dia"])) {
        $selectedDiseases[] = "Diabetes";
        $doeDiaObs = $_POST["doe-dia-obs"];
      }

      // Hemorragias
      if (isset($_POST["doe-hem"])) {
        $selectedDiseases[] = "Hemorragias";
        $doeHemObs = $_POST["doe-hem-obs"];
      }

      // Hipoglicemia
      if (isset($_POST["doe-hip"])) {
        $selectedDiseases[] = "Hipoglicemia";
        $doeHipObs = $_POST["doe-hip-obs"];
      }

      // Enxaqueca
      if (isset($_POST["doe-enx"])) {
        $selectedDiseases[] = "Enxaqueca";
        $doeEnxObs = $_POST["doe-enx-obs"];
      }

      // Asma/Bronquite
      if (isset($_POST["doe-bro"])) {
        $selectedDiseases[] = "Asma/Bronquite";
        $doeBroObs = $_POST["doe-bro-obs"];
      }

      // Distúrbios neurológicos
      if (isset($_POST["doe-dis"])) {
        $selectedDiseases[] = "Distúrbios neurológicos";
        $doeDisObs = $_POST["doe-dis-obs"];
      }

      // Outros
      if (isset($_POST["doe-out"])) {
        $selectedDiseases[] = "Outros";
        $doeOutObs = $_POST["doe-out-obs"];
      }
    }

    // Print the selected diseases
    echo "Selected diseases: ";
    foreach ($selectedDiseases as $disease) {
      echo "$disease, ";
    }
    echo "<br>";

    // Print the observations for each disease
    echo "Observations: <br>";
    echo "Convulsões: $doeConObs <br>";
    echo "Cardiopatias: $doeCarObs <br>";
    echo "Desmaios: $doeDesObs <br>";
    echo "Diabetes: $doeDiaObs <br>";
    echo "Hemorragias: $doeHemObs <br>";
    echo "Hipoglicemia: $doeHipObs <br>";
    echo "Enxaqueca: $doeEnxObs <br>";
    echo "Asma/Bronquite: $doeBroObs <br>";
    echo "Distúrbios neurológicos: $doeDisObs <br>";
    echo "Outros: $doeOutObs <br>";
  }

-->
