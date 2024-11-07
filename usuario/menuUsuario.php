<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $usu_cpf = $_SESSION['user_id'];
} else {
    header('Location: loginUsuario.php');
    exit();
}

include('../resource/database/conexao.php');

//sql pesquisas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $temp=$_POST['temporada'];
    $sql = "SELECT a.aca_id, a.aca_nome, a.aca_sobrenome, b.res_cpf, b.res_nome, b.res_sobrenome FROM acampante a JOIN responsavel b ON a.res_id = b.res_id JOIN inscricao i ON i.aca_id = a.aca_id WHERE b.res_cpf = '$usu_cpf' AND i.temp_id = $temp GROUP BY a.aca_id ORDER BY a.aca_id ASC;";
}
else{
    $sql = "SELECT a.aca_id, a.aca_nome, a.aca_sobrenome, b.res_cpf, b.res_nome, b.res_sobrenome FROM acampante a JOIN responsavel b ON a.res_id = b.res_id JOIN inscricao i ON i.aca_id = a.aca_id WHERE b.res_cpf = '$usu_cpf' AND i.temp_id = (SELECT MAX(temp_id) FROM temporada) GROUP BY a.aca_id ORDER BY a.aca_id ASC;";
}

$result_inscritos = $conexao->query($sql);

$sql = "SELECT temp_id, temp_nome FROM temporada WHERE temp_id IN (SELECT i.temp_id FROM inscricao i JOIN responsavel r ON i.res_id = r.res_id WHERE r.res_cpf = '$usu_cpf') ORDER BY temp_id DESC;";
$result_temporada = $conexao->query($sql);

$i_containsc=1;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../resource/styles/temp.css">
    <title>Document</title>
</head>
<body>
    <div class="navbar"><img src="../resource\img\image\logo_rp_eventos_500x500.png" alt="logo">
    <button onclick="location.href='deslogaUsuario.php'" class="desloga">Sair</button>
    </div>
    <br>
    <button onclick="location.href='../index.php'" class="novainsc">Nova inscricao de acampante</button>
    <br><br>
    <!-- filtro -->
        <div class="filtro">
        <form action="" method="POST">Temporada: <select name="temporada" class='temporada'><?php
        if ($result_temporada->num_rows > 0) {
        while ($row = $result_temporada->fetch_assoc()) {
            echo "<option value='" . $row['temp_id'] . "'>" . $row['temp_nome'] . "</option>";
        }
        } else {
            echo "<option value=''>Nenhuma temporada encontrada</option>";
        } ?></select> <input class="enviatemp" type="submit" value="Pesquisar"></form>
        </div>

<?php
//tabela
if ($result_inscritos->num_rows > 0) {
    echo "<table class='inscricao'>
            <tr>
                <th>Nome do Acampante</th>
                <th>Sobrenome do Acampante</th>
                <th>CPF do Responsável</th>
                <th>Nome do Responsável</th>
                <th>Sobrenome do Responsável</th>
                <th colspan='2'>Mais</th>
            </tr>";
    while($row = $result_inscritos->fetch_assoc()) {
        echo "<tr>
                <td>{$row['aca_nome']}</td>
                <td>{$row['aca_sobrenome']}</td>
                <td>{$row['res_cpf']}</td>
                <td>{$row['res_nome']}</td>
                <td>{$row['res_sobrenome']}</td>
                <td>
                     <button class='mais' onclick='abrirPopup({$row['aca_id']}, \"{$row['aca_nome']}\", \"{$row['aca_sobrenome']}\")'>Mais+</button>
                </td>
                <td>
                    <form action='../index.php' method='post'> 
                        <input type='hidden' name='aca_id' value='".$row['aca_id']."'>
                        <button type='submit' class='mais'>Reutilizar</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
?>
<!-- Modal -->
<div id="myModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
    <div class='modal'>
        <span id="close" style="cursor:pointer; float:right;">&times;</span>
        <h2 id="modalTitle">Formulario: </h2>
        <p id="modalContent">Carregando...</p>
    </div>
</div>
<script src="../admin/inscritosjs.js"></script>
</body>
</html>