<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    include('resource/database/conexao.php');

    $texto = '';
    //Select para mostrar qual temporada esta
    $sql = "SELECT temp_id, temp_data_inicio, temp_data_fim, temp_festa, temp_nome FROM temporada WHERE temp_id = (SELECT MAX(temp_id) FROM temporada)";

    $result = $conexao->query($sql);

    // Verifica se um resultado foi encontrado
    if ($result->num_rows > 0) {
        // Busca os dados
        $row = $result->fetch_assoc();

        // Salva os dados em variáveis
        $id = $row['temp_id'];
        $dataInicio = $row['temp_data_inicio'];
        $dataFim = $row['temp_data_fim'];
        $tempFesta = $row['temp_festa'];
        $tempNome = $row['temp_nome'];

    } else {
        $texto = "Nenhuma temporada encontrada.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $novoValor = $_POST['temp_val'];
        $novoMaxParcelas = $_POST['temp_parc'];
        $novasFestas = $_POST['temp_festas'];

        // Prepara o SQL para Update
        $sqlUpdate = "UPDATE temporada SET temp_preco = ?, temp_max_parcela = ?, temp_festa = ? WHERE temp_id = ?;";
        $stmt = $conexao->prepare($sqlUpdate);

        // Bind dos parâmetros
        $stmt->bind_param("disi", $novoValor, $novoMaxParcelas, $novasFestas, $id);

        // Executa a inserção
        if ($stmt->execute()) {
            $texto = "Temporada aleterada com sucesso!";
        } else {
            $texto = "Erro ao alterar temporada: " . $stmt->error;
        }
        $stmt->close();
    }
    // Fecha a conexão
    $conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resource/styles/temp.css">
    <title>Document</title>
</head>
<body>
    <div class="navbar"><img src="resource\img\image\logo_rp_eventos_500x500.png" alt="logo">
    <button onclick="window.location.href = 'admin.php'" class="btn">Menu</button>
    <button onclick="location.href='desloga.php'" class="desloga">Sair</button>
    </div>
    <div class="conteudo">
        <div class="tablescroll" style="overflow-y: hidden;">
        
        <table style="left: 5%;">
            <tr>
                <td colspan="2">
                    <?php echo "$texto";?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h1>Alterar Temporada Atual</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Nome da temporada: <div class="bold"><?php echo "$tempNome";?></div>
                </td>
            </tr>
            <tr>   
                <td style="width: 50%;">
                    Data de início: <div class="bold"><?php echo "$dataInicio";?></div>
                </td>
                <td style="width: 50%;">
                    Data de término: <div class="bold"><?php echo "$dataFim";?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <form method="POST" action="">
                        <label for="temp_val">Novo Valor da inscrição (Inteira)</label><br>
                        <input type="number" step="0.01" name="temp_val" id="temp_val" required><br><br>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <label for="temp_parc">Novo Numero maximo de parcelas aceitas: </label>
                        <input type="number" step="1" name="temp_parc" id="temp_parc" max="120" required>
                        <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"> 
                        <label for="temp_festas">Festas da temporada: </lable><br>
                        <textarea id="temp_festas" name="temp_festas" rows="5" cols="33" maxlength="200"><?php echo "$tempFesta";?></textarea>
                        <br><br>
                </td>
            <tr>
                <td colspan="2">
                        <input type="submit" class="btn">
                        <br><br>
                </td>
            </tr>
            </form>
        </table>
        </div>
    </div>
</body>
</html>