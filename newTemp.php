<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
include('resource/database/conexao.php');

$texto = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //post do forms
    $temp_name = $_POST['temp_name'] ?? '';
    $temp_val = $_POST['temp_val'] ?? 0;
    $temp_init = $_POST['temp_init'] ?? '';
    $temp_end = $_POST['temp_end'] ?? '';
    $temp_max_parcela = $_POST['temp_parc'] ?? 0;
    $temp_festas = $_POST['temp_festas'] ?? '';

    // Abre a conexão
    $conexao->begin_transaction();

    // Inserindo dados na tabela temporada
    $sql = "INSERT INTO temporada (temp_data_inicio, temp_data_fim, temp_max_parcela, temp_nome, temp_preco, temp_festa) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    // Evita SQL injection
    $stmt->bind_param("ssisds", $temp_init, $temp_end, $temp_max_parcela, $temp_name, $temp_val, $temp_festas);
    if ($stmt->execute()) {
        $conexao->commit(); // Comita a transação
        $texto = "Nova temporada cadastrada com sucesso!";
        // Redireciona para a mesma página evita problemas com f5
        header("Location: " . $_SERVER['PHP_SELF'] . "?texto=" . urlencode($texto));
        exit(); // Encerra o script após o redirecionamento
    } else {
        $conexao->rollback(); // Reverte a transação em caso de erro
        $texto = "Erro: " . $stmt->error;
    }

    $stmt->close(); // Fecha o prepared statement
    $conexao->close(); // Fecha a conexão
}

if (isset($_GET['texto'])) {
    $texto = $_GET['texto']; // Obtém a mensagem da URL
}
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
    <div class="navbar">
        <img src="resource/img/image/logo_rp_eventos_500x500.png" alt="logo">
        <button onclick="window.location.href = 'admin.php'" class="btn">Menu</button>
        <button onclick="location.href='desloga.php'" class="desloga">Sair</button>
    </div>
    <div class="tablescroll">
        <table>
            <tr>
                <td colspan="2"><?php
                // Exibe a mensagem, se houver
                if (!empty($texto)) {
                    echo "$texto";
                }
                ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <h1>Nova Temporada</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="" method="POST"> 
                        <label for="temp_name">Nome da temporada: </label><br>
                        <input type="text" name="temp_name" id="temp_name" required><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="temp_val">Valor da inscrição (Inteira)</label><br>
                    <input type="number" step="0.01" name="temp_val" id="temp_val" required><br><br>
                </td>
            </tr>
            <tr>   
                <td style="width: 50%;">
                    <label for="temp_init">Data de início: </label><br>
                    <input type="date" name="temp_init" id="temp_init" required><br><br>
                </td>
                <td style="width: 50%;">
                    <label for="temp_end">Data de término: </label><br>
                    <input type="date" name="temp_end" id="temp_end" max="254" required><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="temp_parc">Número máximo de parcelas aceitas: </label>
                    <input type="number" name="temp_parc" id="temp_parc" max="120" required>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"> 
                    <label for="temp_festas">Festas da temporada: </label><br>
                    <textarea id="temp_festas" name="temp_festas" rows="5" cols="33" maxlength="200" required></textarea>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn">
                    <br><br>
                </td>
            </tr>
            </form>
        </table>
    </div>
</body>
</html>
