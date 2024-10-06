<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include('../resource/database/conexao.php');

$sql = "SELECT a.aca_id, a.aca_nome, a.aca_sobrenome, b.res_cpf, b.res_nome, b.res_sobrenome 
        FROM acampante a 
        INNER JOIN responsavel b ON a.aca_responsavel_res_cpf = b.res_cpf";
$result = $conexao->query($sql);

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
    <button onclick="window.location.href = 'admin.php'" class="btn">Menu</button>
    <button onclick="location.href='desloga.php'" class="desloga">Sair</button>
    </div>
<?php
$i_contisnc=1;
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Inscrição</th>
                <th>Nome do Acampante</th>
                <th>Sobrenome do Acampante</th>
                <th>CPF do Responsável</th>
                <th>Nome do Responsável</th>
                <th>Sobrenome do Responsável</th>
                <th>Mais</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>$i_contisnc</td>
                <td>{$row['aca_nome']}</td>
                <td>{$row['aca_sobrenome']}</td>
                <td>{$row['res_cpf']}</td>
                <td>{$row['res_nome']}</td>
                <td>{$row['res_sobrenome']}</td>
                <td>
                     <button onclick='abrirPopup({$row['aca_id']}, \"{$row['aca_nome']}\", \"{$row['aca_sobrenome']}\")'>Mais+</button>
                </td>
              </tr>";
            $i_contisnc++;
    }
    echo "</table>";
} else {
    echo "0 resultados";
}
?>

<!-- Modal -->
<div id="myModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5);">
    <div style="background:white; margin:15% auto; padding:20px; width:500px;">
        <span id="close" style="cursor:pointer; float:right;">&times;</span>
        <h2 id="modalTitle">Formulario: </h2>
        <p id="modalContent">Carregando...</p>
    </div>
</div>

<script>
let currentAcaId = null;

function abrirPopup(acaId, acaNome, acaSobrenome) {
    currentAcaId = acaId; // Armazena o aca_id atual
    document.getElementById('modalTitle').innerText = "Formulario: " + acaNome + " " + acaSobrenome; // Atualiza o título do modal
    document.getElementById('modalContent').innerText = "Carregando..."; // Mensagem enquanto aguarda a resposta
    document.getElementById('myModal').style.display = "block";

    // Executa a ação imediatamente ao abrir o modal
    executarAcoes(acaId);
}

document.getElementById('close').onclick = function() {
    document.getElementById('myModal').style.display = "none";
}

function executarAcoes(acaId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "acoesinscritos.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o conteúdo do modal com o resultado
            document.getElementById('modalContent').innerHTML = xhr.responseText;
        }
    };
    xhr.send("aca_id=" + acaId);
}

window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = "none";
    }
}
</script>