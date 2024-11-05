<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Básico</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <div class="formulario-wrapper">
        <div class="container-header" id="header">
            <div class="header-linha">
                <div class="header-grupo" style="flex-basis: 10in;">
                    <div class="logo-wrapper">
                        <img src="imgs/RP_Acamps.svg" alt="Logo">
                    </div>
                </div>
                <div class="header-grupo" style="flex-basis: 50in;">
                    <div class="container-header-slogan">A semana mais incrível do ano!</div>
                </div>
                <div class="header-grupo" style="flex-basis: 10in;">

                </div>
            </div>
        </div>
        <div class="containerbranco">


<?php

include('resource/database/conexao.php');

    //Select para mostrar qual temporada esta
    $sql = "SELECT * FROM temporada WHERE temp_id = (SELECT MAX(temp_id) FROM temporada)";

    $result = $conexao->query($sql);

    // Verifica se um resultado foi encontrado
    if ($result->num_rows > 0) {
    // Busca os dados
    $row = $result->fetch_assoc();

    // Salva os dados em variáveis
    $id_temp = $row['temp_id'];
    $dataInicio = $row['temp_data_inicio'];
    $dataFim = $row['temp_data_fim'];
    $tempNome = $row['temp_nome'];
    $valorInscrição = $row['temp_preco'];
    $maxParcelas = $row['temp_max_parcela'];
    $festaTemp = $row['temp_festa'];

} else {
    $texto = "Nenhuma temporada encontrada.";
}

//data do dia
    $data_atual = date('Y-m-d');

//responsavel
    $res_nome = !empty($_POST['res-nom']) ? $_POST['res-nom'] : '';
    $res_sobrenome = !empty($_POST['res-sob']) ? $_POST['res-sob'] : '';
    $res_cpf = !empty($_POST['res-cpf']) ? $_POST['res-cpf'] : '';
    $res_rg = !empty($_POST['res-rg']) ? $_POST['res-rg'] : '';
    $res_telefone1 = !empty($_POST['res-tel-1']) ? $_POST['res-tel-1'] : '';
    $res_telefone2 = !empty($_POST['res-tel-2']) ? $_POST['res-tel-2'] : '';
    $res_telefone3 = !empty($_POST['res-tel-3']) ? $_POST['res-tel-3'] : '';
    $res_email1 = !empty($_POST['res-eml-1']) ? $_POST['res-eml-1'] : '';
    $res_email2 = !empty($_POST['res-eml-2']) ? $_POST['res-eml-2'] : '';
    $res_tipo = !empty($_POST['res-res']) ? $_POST['res-res'] : '';
    $res_tipo_outro = !empty($_POST['res-out']) ? $_POST['res-out'] : '';

    echo "<h1>Confira os dados:</h1><br>";

    echo "Dados do Responsável:<br>";
    echo "Nome: $res_nome<br>";
    echo "Sobrenome: $res_sobrenome<br>";
    echo "CPF: $res_cpf<br>";
    echo "RG: $res_rg<br>";
    echo "Telefone 1: $res_telefone1<br>";
    echo "Telefone 2: $res_telefone2<br>";
    echo "Telefone 3: $res_telefone3<br>";
    echo "Email 1: $res_email1<br>";
    echo "Email 2: $res_email2<br>";
    echo "Tipo: $res_tipo<br>";
    echo "Tipo Outro: $res_tipo_outro<br>";

//endereco
    $end_estado = $_POST['end-uf'];
    $end_cidade = $_POST['end-cid'];
    $end_bairro = $_POST['end-bai'];
    $end_rua = $_POST['end-rua'];
    $end_numero = $_POST['end-num'];
    $end_cep = $_POST['end-cep'];

    echo "<br>Dados do Endereço:<br>";
    echo "Estado: $end_estado<br>";
    echo "Cidade: $end_cidade<br>";
    echo "Bairro: $end_bairro<br>";
    echo "Rua: $end_rua<br>";
    echo "Número: $end_numero<br>";
    echo "CEP: $end_cep<br>";

// acampante
    $aca_nome = $_POST['cri-nom'];
    $aca_sobrenome = $_POST['cri-sob'];
    $aca_data_nasc = $_POST['birthday'];

    // Cria objetos DateTime
    $dataNasc = new DateTime($aca_data_nasc);
    $dataInicio = new DateTime($dataInicio);

    // Calcula a diferença em anos
    $diferenca = $dataNasc->diff($dataInicio);
    $anos = $diferenca->y;

    $aca_sexo = $_POST['sexo'];
    $aca_tamanho_camiseta = $_POST['cri-tar'];
    $aca_tipo_sanguinio = $_POST['sangue'];
    $aca_rh = $_POST['rh'];
    $tipo_sanguinio_rh = $aca_tipo_sanguinio . $aca_rh;

    echo "<br>Dados do Acampante:<br>";
    echo "Nome: $aca_nome<br>";
    echo "Sobrenome: $aca_sobrenome<br>";
    echo "Data de Nascimento: $aca_data_nasc<br>";
    echo "Sexo: $aca_sexo<br>";
    echo "Tamanho da Camiseta: $aca_tamanho_camiseta<br>";
    echo "Tipo Sanguíneo: $aca_tipo_sanguinio<br>";
    echo "RH: $aca_rh<br>";

//Pagamento
    $ins_num_parcela = $_POST['val-par'];

    echo "<br>Dados de Pagamento:<br>";
    echo "Preço: $valorInscrição<br>";
    echo "Quantidade de Parcelas: $ins_num_parcela<br>";
    echo "Data da solicitação: $data_atual<br>";

//convenio
    $tem_con = $_POST['tem-con'];
    $con_nome = $_POST['con-nom'];
    $con_numero = $_POST['con-num'];
    $con_telefone = $_POST['con-cnt'];
    $con_observacao = $_POST['tem-con-obs'] ?? '';

    echo "<br>Dados de Conveino:<br>";
    echo "Nome: $con_nome<br>";
    echo "Codigo: $con_numero<br>";
    echo "Telefone: $con_telefone<br>";
    echo "Observação: $con_observacao <br><br>";

// Vacinas
    $his_vac_bcg = $_POST['his-vac-bcg'];
    $his_vac_hpb = $_POST['his-vac-hpb'];
    $his_vac_tet = $_POST['his-vac-tet'];
    $his_vac_pol = $_POST['his-vac-pol'];
    $his_vac_rot = $_POST['his-vac-rot'];
    $his_vac_sar = $_POST['his-vac-sar'];
    $his_vac_hpa = $_POST['his-vac-hpa'];
    $his_vac_var = $_POST['his-vac-var'];
    $his_vac_men = $_POST['his-vac-men'];
    $his_vac_pne = $_POST['his-vac-pne'];
    $his_vac_inf = $_POST['his-vac-inf'];
    $his_vac_feb = $_POST['his-vac-feb'];

//doencas
    $doe_convulsoes = $_POST['doe-con'];
    $doe_cardiopatias = $_POST['doe-car'];
    $doe_desmaios = $_POST['doe-des'];
    $doe_diabetes = $_POST['doe-dia'];
    $doe_hemorragias = $_POST['doe-hem'];
    $doe_hipoglicemia = $_POST['doe-hip'];
    $doe_enxaqueca = $_POST['doe-enx'];
    $doe_asma_bronquite = $_POST['doe-bro'];
    $doe_distúrbios_neurológicos = $_POST['doe-dis'];

//alergias
    $ale_med_aps = $_POST['ale-med-aps'];
    $ale_med_mel = $_POST['ale-med-mel'];
    $ale_med_nov = $_POST['ale-med-nov'];
    $ale_med_pla = $_POST['ale-med-pla'];
    $ale_med_dra = $_POST['ale-med-dra'];
    $ale_med_pov = $_POST['ale-med-pov'];
    $ale_med_cat = $_POST['ale-med-cat'];
    $ale_med_pen = $_POST['ale-med-pen'];
    
    $ale_po = $_POST['ale_po'];
    $ale_ali = $_POST['ale_ali'];
    $ale_pdi = $_POST['ale-pdi'];

    $tem_ale_med = $_POST['tem-ale-med'];
    $ale_med_obs = $_POST['ale-med-obs'];

    $ale_out = $_POST['ale-out'];
    $ale_out_obs = $_POST['ale-out-obs'];

//medicamentos
    $reg_sin_med_obs = $_POST['reg-sin-med-obs'];


// Query de inserção responsavel funcioando problema no rg mas q se foda dps tiro da tabela
$sql = "INSERT INTO `responsavel` (`res_cpf`, `res_nome`, `res_sobrenome`, `res_rg`, `res_telefone1`, `res_telefone2`, `res_email1`, `res_email2`, `res_tipo`, `res_tipo_outro`) VALUES ('$res_cpf', '$res_nome', '$res_sobrenome', '$res_rg', '$res_telefone1', '$res_telefone2', '$res_email1', '$res_email2', '$res_tipo', '$res_tipo_outro');";

// Execução
if ($conexao->query($sql) === TRUE) {
    $id_responsavel = $conexao->insert_id;
} else {
    echo "Erro: ";
}

// Query de inserção endereco funcionando
$sql = "INSERT INTO `endereco` (`end_estado`, `end_cidade`, `end_bairro`, `end_rua`, `end_numero`, `end_cep`) VALUES ('$end_estado', '$end_cidade', '$end_bairro', '$end_rua', '$end_numero', '$end_cep');";

// Execução
if ($conexao->query($sql) === TRUE) {
    $id_endereco = $conexao->insert_id;
} else {
    echo "Erro: ";
}

// Query de inserção acampante
$sql = "INSERT INTO `acampante` (`aca_nome`, `aca_sobrenome`, `aca_idade`, `aca_data_nasc`, `aca_sexo`, `aca_tamanho_camiseta`, `aca_tipo_sanguinio`, `res_id`, `end_id`) VALUES ('$aca_nome', '$aca_sobrenome', '$anos', '$aca_data_nasc', '$aca_sexo', '$aca_tamanho_camiseta', '$tipo_sanguinio_rh', '$id_responsavel', '$id_endereco');";

// Execução
if ($conexao->query($sql) === TRUE) {
    $id_acampante = $conexao->insert_id;
} else {
    echo "Erro: ";
}

// Query de inserção incricao
$sql = "INSERT INTO `inscricao` (`ins_pagamento`, `ins_data`, `temp_id`, `res_id`, `aca_id`, `ins_num_parcela`) VALUES ('$valorInscrição', '$data_atual', '$id_temp' , '$id_responsavel' , '$id_acampante', '$ins_num_parcela');";

// Execução
if ($conexao->query($sql) === TRUE) {
} else {
    echo "Erro: ";
}

//checa se a pessoa tem convenio
if ($tem_con == "sim") {
    // Query de inserção convenio
    $sql = "INSERT INTO `convenio` (`con_nome`, `con_numero`, `con_telefone`, `con_observacao`) VALUES ('$con_nome','$con_numero','$con_telefone','$con_observacao');";

    // Execução
    if ($conexao->query($sql) === TRUE) {
        $id_convenio = $conexao->insert_id;
    } else {
        echo "Erro: ";
    }


    // Query de inserção acampante_convenio
    $sql = "INSERT INTO `acampante_convenio` (`aca_id`, `con_id`) VALUES ('$id_acampante', '$id_convenio');";

    // Execução
    if ($conexao->query($sql) === TRUE) {
    } else {
        echo "Erro: ";
    }
}

    //checa se as vacinas foi ou nao ativa (por que isso ta assim em vez de um for 1- e mais facil de testar assim 2- tava dando problema em outras partes para corrigir, 3- se vc quiser colocar em um for coloca, eu n to sendo pago para isso)
    if ($his_vac_bcg == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '1');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_hpb == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '2');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_tet == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '3');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_pol == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '4');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_rot == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '5');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_sar == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '6');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_hpa == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '7');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_var == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '8');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_men == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '9');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_pne == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '10');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_inf == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '11');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($his_vac_feb == "on") { 
        // Query de inserção acampante_vacina
        $sql = "INSERT INTO `registro_vacina` (`aca_id`, `vac_id`) VALUES ('$id_acampante', '12');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if($i_quantvacina>0){
        echo "$i_quantvacina Vacinas: Registro inserido com sucesso!<br>";
    }

    //doencas
    // Verifica se algum checkbox foi selecionado
    if (isset($_POST['tem-doe'])=="sim") {
        if ($doe_convulsoes == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '1');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_cardiopatias == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '6');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_desmaios == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '2');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_diabetes == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '7');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_hemorragias == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '3');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_hipoglicemia == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '8');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_enxaqueca == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '4');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_asma_bronquite == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '9');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
        if ($doe_distúrbios_neurológicos == "on") {
            $sql = "INSERT INTO `registro_doenca` (`aca_id`, `doe_id`) VALUES ('$id_acampante', '5');";

            // Execução
            if ($conexao->query($sql) === TRUE) {
            } else {
                echo "Erro: ";
            }
        }
        
    }

    //alergia
    if ($ale_med_aps == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','1');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_mel == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','2');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_nov == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','3');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_pla == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','4');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_dra == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','5');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_pov == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','6');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_cat == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','7');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_med_pen == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','8');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_po == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','9');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_ali == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','10');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    
    if ($ale_pdi == "on") { 
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('','$id_acampante','11');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($tem_ale_med == "sim"){
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('$ale_med_obs','$id_acampante','12');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }
    if ($ale_out == "on"){
        $sql = "INSERT INTO `registro_alergia` (`ra_obs`, `aca_id`, `ale_id`) VALUES ('$ale_out_obs','$id_acampante','12');";

        // Execução
        if ($conexao->query($sql) === TRUE) {
        } else {
            echo "Erro: ";
        }
    }

    //registro medico
    $sql = "INSERT INTO `registro_medico` (`aca_id`, `med`) VALUES ('$id_acampante','$reg_sin_med_obs');";

    // Execução
    if ($conexao->query($sql) === TRUE) {
        echo "<h4> Registro inserido com sucesso!</h4><br>"; 
    } else {
        echo "Erro: ";
    }

$conexao->close();
?>
</div>

</body>
</html>