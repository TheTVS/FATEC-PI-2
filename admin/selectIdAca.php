<?php
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

    // Consulta para obter as vacinas
    $query = "SELECT v.vac_nome FROM registro_vacina rv JOIN vacina v on (rv.vac_id = v.vac_id) WHERE rv.aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_vacinas = $stmt->get_result();

    // Consulta para obter as medicamentos
    $query = "SELECT med FROM `registro_medico` WHERE aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_medicamentos = $stmt->get_result();

    // Consulta para obter o endereco
    $query = "SELECT e.* FROM endereco e JOIN acampante a on (e.end_id = a.end_id) WHERE a.aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_endereco = $stmt->get_result();

    // Consulta para obter a inscricao
    $query = "SELECT * FROM inscricao WHERE aca_id = ?;";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_inscricao = $stmt->get_result();
}
?>