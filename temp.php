<?php
    include('resource/database/conexao.php');

    $texto = '';
    //Select para mostrar qual temporada esta
    $sql = "SELECT * FROM temporada WHERE temp_id = (SELECT MAX(temp_id) FROM temporada)";

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
        $valorInscrição = $row['temp_preco'];
        $maxParcelas = $row['temp_max_parcela'];
        $festaTemp = $row['temp_festa'];

    } else {
        $texto = "Nenhuma temporada encontrada.";
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
    </div>
    <div class="conteudo">
        <div class="tablescroll" style="max-height: 700px;min-height: 700px;">
        
        <table style="left: 20%;">
            <tr>
                <td colspan="2">
                    <?php echo "$texto";?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h1>Temporada Atual</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Nome da temporada: <div class="bold"><?php echo "$tempNome";?></div><br>
                </td>
            </tr>
            <tr>   
                <td style="width: 50%;">
                    Data de início: <div class="bold"><?php echo "$dataInicio";?></div><br>
                </td>
                <td style="width: 50%;">
                    Data de término: <div class="bold"><?php echo "$dataFim";?></div><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        Valor da inscrição (Inteira): R$<div class="bold"><?php echo "$valorInscrição";?></div><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        Numero maximo de parcelas aceitas: <div class="bold"><?php echo "$maxParcelas";?></div><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"> 
                        Festas da temporada: <div class="bold"><?php echo "$festaTemp";?></div>
                </td>
            </tr>
        </table>
        </div>
    </div>
</body>
</html>