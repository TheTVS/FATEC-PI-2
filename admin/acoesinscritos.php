<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
include('../resource/database/conexao.php');
if (isset($_POST['aca_id'])) {
    $aca_id = $_POST['aca_id'];

    // Consulta para obter o acampante
    $query = "SELECT * FROM acampante WHERE aca_id = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_acampante = $stmt->get_result();

    // Consulta para obter o responsavel
    $query = "SELECT r.* FROM responsavel r JOIN acampante a on ((SELECT aca_responsavel_res_cpf from acampante WHERE aca_id = ?) = r.res_cpf) GROUP BY r.res_cpf;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_responsavel = $stmt->get_result();

    // Consulta para obter o convenio
    $query = "SELECT c.* FROM convenio c JOIN acampante_convenio ac on (c.con_id = ac.con_id and ac.aca_id=?);";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_convenio = $stmt->get_result();

    // Consulta para obter as alergias
    $query = "SELECT a.ale_nome,ra.ra_obs FROM registro_alergia ra JOIN alergia a on (ra.ale_id = a.ale_id) WHERE ra.aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_alergia = $stmt->get_result();

    // Consulta para obter as doencas
    $query = "SELECT d.doe_nome,d.doe_tipo,d.doe_categoria FROM registro_doenca rd JOIN doenca d on (rd.doe_id = d.doe_id) WHERE rd.aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_doenca = $stmt->get_result();

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
                            <td colspan='2'>
                                <div class='bold'>Nome: </div>{$row['aca_nome']} {$row['aca_sobrenome']}
                            </td>
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
            echo"   
                        </tr>
                    </table>
                </td>
        ";
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

    echo"
        </table>
        ";

    }

$conexao->close();
?>