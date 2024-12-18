<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
include('../resource/database/conexao.php');
include_once('selectIdAca.php');

    // Tabela do acampante
    if ($row = $result_acampante->fetch_assoc()) {
        echo "
        <table class='organizaFormularioModal'>
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th colspan='3'>
                                Acampante: 
                            </th>
                        </tr>
                        <tr>
                            <td rowspan='2' colspan='2'>
                                <div class='bold'>Foto:<br>"; 
                                if($row['aca_foto']==NULL){
                                    if($row['aca_sexo']=='F'){echo"<img class='perfil' src='../imgs/icon_girl.jpeg' alt='Foto M'>";}
                                    else{
                                        echo"<img class='perfil' src='../imgs/icon_boy.jpeg' alt='Foto M'>";
                                    }
                                }
                                else{
                                    echo"<img class='perfil' src='../{$row['aca_foto']}' alt='{$row['aca_nome']} {$row['aca_sobrenome']}'>";
                                }
                            echo"
                            </td>
                            <td>
                                <div class='bold'>Nome: </div>{$row['aca_nome']} {$row['aca_sobrenome']}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>Idade: </div>{$row['aca_idade']}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>Genero: </div>{$row['aca_sexo']}
                            </td>
                            <td>
                                <div class='bold'>Tamanho da camiseta: </div>{$row['aca_tamanho_camiseta']}
                            </td>
                            <td>
                                <div class='bold'>Tipo sanguinio: </div>{$row['aca_tipo_sanguinio']}
                            </td>
                        </tr>
                    </table>
                </td>";
    }else {
        echo "Nenhum resultado de acampante encontrado para o ID: " . $aca_id;
    }
    // Tabela do Responsavel
    if($row = $result_responsavel->fetch_assoc()){
        echo"
                <td rowspan='2'>
                    <table class ='formulariomodal'>
                        <tr>
                            <th colspan='3'>
                                Responsavel: 
                            </th>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <div class='bold'>Nome: </div>{$row['res_nome']} {$row['res_sobrenome']}
                            </td>
                            <td>
                                <div class='bold'>CPF: </div>{$row['res_cpf']}
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <div class='bold'>RG: </div>{$row['res_rg']}
                            </td>";

        //checa se foi escolhido outro tipo de responsavel
            if($row['res_tipo']=='outro'){
                echo"
                            <td>
                                <div class='bold'>Tipo Responsavel: </div>{$row['res_tipo_outro']}
                            </td>";
            }
            else{
                echo"
                            <td>
                                <div class='bold'>Tipo Responsavel: </div>{$row['res_tipo']}
                            </td>";
            }

            //telefone 1
                echo"   </tr>
                        <tr>
                            <td colspan='2'>
                                <div class='bold'>Telefone 1: </div>{$row['res_telefone1']}
                            </td>";
            //ve se tem telefone 2
            if($row['res_telefone2']!=''){
                echo"
                            <td>
                                <div class='bold'>Telefone 2: </div>{$row['res_telefone2']}
                            </td>";
            }

            //email 1
                echo"
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <div class='bold'>Email 1: </div>{$row['res_email1']}
                            </td>";

            //ve se tem email 2
            if($row['res_email2']!=''){
                echo"
                            <td>
                                <div class='bold'>Email 2: </div>{$row['res_email2']}
                            </td>";
            }
            }else {
                echo "Nenhum resultado de responsavel encontrado para o ID: " . $aca_id;
            }

    // Tabela convenio
    // se tem convenio
    if($row = $result_convenio->fetch_assoc()){
            echo"
                        </tr>
                    </table> 
                </td>
            </tr>
              
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th colspan='3'>
                                Convenio: 
                            </th>
                        </tr>
                        <tr>
                            <td colspan='2'>
                                <div class='bold'>Nome: </div>{$row['con_nome']}
                            </td>
                            <td>
                                <div class='bold'>Numero: </div>{$row['con_numero']}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>Telefone: </div>{$row['con_telefone']}
                            </td>
                            <td>
                                <div class='bold'>Observação: </div>{$row['con_observacao']}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>";}
    else{
            echo "
                        </tr>
                    </table>
                </td>
            </tr>
                
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Convenio: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Esse Acampante não possui convenio
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>";
        }

    $cont_td=0;
    //Tabelas alergias
    if ($result_alergia->num_rows > 0) {
            echo "
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th colspan='2'>
                                Alergias: 
                            </th>
                        </tr>
                        <tr>";
        while ($row = $result_alergia->fetch_assoc()) {
            if($row['ale_nome']=='Outro'){
                echo "
                            <td>
                                Outro: {$row['ra_obs']}
                            </td>";
            $cont_td++;
            }
            else{
                echo "
                            <td>
                                {$row['ale_nome']}
                            </td>";
            $cont_td++;
            }
            if($cont_td==2){
                echo"
                        </tr>
                        <tr>
            ";
            $cont_td=0;
            }
        }
            // Se o contador não estiver zerado no final, feche a linha
            if ($cont_td > 0) {
            echo "
                        </tr>";
            }
            echo"   
                    </table>
                </td>";
    }else{
            echo "
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Alergias: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Esse Acampante não possui Alergias
                            </td>
                        </tr>
                    </table>
                </td>";
        }

    //Tabelas doencas
    if ($result_doenca->num_rows > 0) {
            echo "
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th colspan='3'>
                                Doenças: 
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Nome: 
                            </th>
                            <th>
                                Tipo: 
                            </th>
                            <th>
                                Categoria: 
                            </th>
                        </tr>";
        while ($row = $result_doenca->fetch_assoc()) {
            echo "
                        <tr>
                            <td>
                                {$row['doe_nome']}
                            </td>
                            <td>
                                {$row['doe_tipo']}
                            </td>
                            <td>
                                {$row['doe_categoria']}
                            </td>
                        </tr>";
            }
            echo"
                    </table>
                </td>
            ";
    }else{
            echo "
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Doenças: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Esse Acampante não possui Doenças
                            </td>
                        </tr>
                    </table>
                </td>";
            }

    //Tabela de vacinas
    if ($result_vacinas->num_rows > 0) {
        echo "
            </tr>
            <tr>
                <td>
                    <table class='formulariomodal'>
                        <tr>
                            <th>Vacinas:</th>
                        </tr>
                    ";
        while ($row = $result_vacinas->fetch_assoc()) {
            echo "  
                        <tr>
                            <td>
                                {$row['vac_nome']}
                            </td>
                        </tr>";
        }
        echo "
                    </table>
                </td>";
    }
    else{
        echo "
            </tr>
            <tr>
                <td>
                    <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Vacinas: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Esse Acampante não possui Vacinas
                            </td>
                        </tr>
                    </table>
                </td> 
            </tr>
        ";
    }

            echo "
                <td>";

    //Tabela Medicamentos+
    if($row = $result_medicamentos->fetch_assoc()){
        echo"
                <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Medicamentos: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                {$row['med']}
                            </td>
                        </tr>
                    </table>";
    }
    else{
        echo"
                <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Medicamentos: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Esse Acampante não possui Medicamentos
                            </td>
                        </tr>
                </table>";
    }
    echo"   
            </td>
        </tr>
        <tr>
            <td>";
    
    //Tabela endereco
    if($row = $result_endereco->fetch_assoc()){
         echo"
                <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Endereço: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>CEP: </div>{$row['end_cep']}
                            </td>
                            <td>
                                <div class='bold'>Estado: </div>{$row['end_estado']}
                            </td>
                            <td>
                                <div class='bold'>Cidade: </div>{$row['end_cidade']}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>Bairro: </div>{$row['end_bairro']}
                            </td>
                            <td>
                                <div class='bold'>Rua: </div>{$row['end_rua']}
                            </td>
                            <td>
                                <div class='bold'>Número: </div>{$row['end_numero']}
                            </td>
                        </tr>
                </table>";
    }
    else {
        echo "Nenhum resultado de endereco encontrado para o ID: " . $aca_id;
    }

    echo"
            </td>
            <td>";

    //tabela inscricao
    if($row = $result_inscricao->fetch_assoc()){
        $ins_data = $row['ins_data']; // Data no formato AAAA-MM-DD
        $date = DateTime::createFromFormat('Y-m-d', $ins_data); // Cria um objeto DateTime
        $formatted_date = $date->format('d/m/Y'); // Formata para DD-MM-AAAA
         echo"
                <table class ='formulariomodal'>
                        <tr>
                            <th>
                                Inscrição: 
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <div class='bold'>Data de Inscricao: </div>$formatted_date
                            </td>
                            <td>
                                <div class='bold'>Preço inscrito: </div>R$:{$row['ins_pagamento']}
                            </td>
                            <td>
                                <div class='bold'>Quantidade de Prcelas: </div>{$row['ins_num_parcela']}
                            </td>
                        </tr>
                </table>";
    }
    else {
        echo "Nenhum resultado de inscricao encontrado para o ID: " . $aca_id;
    }
    echo"
            </td>
        </tr>
    </table>
        ";



$conexao->close();
?>