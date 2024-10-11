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
                        <td colspan='2'><div class='bold'>Nome: </div>{$row['aca_nome']} {$row['aca_sobrenome']}</td>
                        <td><div class='bold'>Idade: </div>{$row['aca_idade']}</td>
                    </tr>
                    <tr>
                        <td><br><div class='bold'>Genero: </div>{$row['aca_sexo']}</td>
                        <td><br><div class='bold'>Tamanho da camiseta: </div>{$row['aca_tamanho_camiseta']}</td>
                        <td><br><div class='bold'>Tipo sanguinio: </div>{$row['aca_tipo_sanguinio']}</td>
                    </tr>
                    </table>
                </td>";
    }else {
        echo "Nenhum resultado de acampante encontrado para o ID: " . $aca_id;
    }
    // Tabela do Responsavel
    if($row = $result_responsavel->fetch_assoc()){
        echo"
            <td>
                        <table class ='formulariomodal'>
                    <tr>
                        <th colspan='3'>
                            Responsavel: 
                        </th>
                    </tr>
                    <tr>
                        <td colspan='2'><div class='bold'>Nome: </div>{$row['res_nome']} {$row['res_sobrenome']}</td>
                        <td><div class='bold'>CPF: </div>{$row['res_cpf']}</td>
                    </tr>
                    <tr>
                        <td colspan='2'><br><div class='bold'>RG: </div>{$row['res_rg']}</td>";

        //checa se foi escolhido outro tipo de responsavel
            if($row['res_tipo']=='outro'){
                echo"
                        <td><br><div class='bold'>Tipo Responsavel: </div>{$row['res_tipo_outro']}</td>";
            }
            else{
                echo"
                        <td><br><div class='bold'>Tipo Responsavel: </div>{$row['res_tipo']}</td>";
            }

            //telefone 1
                echo"</tr>
                    <tr>
                        <td colspan='2'><br><div class='bold'>Telefone 1: </div>{$row['res_telefone1']}</td>";
            //ve se tem telefone 2
            if($row['res_telefone2']!=''){
                echo"
                        <td><br><div class='bold'>Telefone 2: </div>{$row['res_telefone2']}</td>";
            }

            //email 1
                echo"
                    </tr>
                    <tr>
                        <td colspan='2'><br><div class='bold'>Email 1: </div>{$row['res_email1']}</td>";

            //ve se tem email 2
            if($row['res_email2']!=''){
                echo"
                        <td><br><div class='bold'>Email 2: </div>{$row['res_email2']}</td>";
            }
                echo"
                    </tr>
                    </table>
                </td>
            </tr>    
        </table>
            ";
    } else {
        echo "Nenhum resultado de responsavel encontrado para o ID: " . $aca_id;
    }
}

$conexao->close();
?>