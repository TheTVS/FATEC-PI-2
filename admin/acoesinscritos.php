<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
include('../resource/database/conexao.php');
if (isset($_POST['aca_id'])) {
    $aca_id = $_POST['aca_id'];

    // Consulta para obter o nome do acampante
    $query = "SELECT * FROM acampante WHERE aca_id = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $aca_id);
    $stmt->execute();
    $result_acampante = $stmt->get_result();

    // Processa o resultado
    if ($row = $result_acampante->fetch_assoc()) {
        echo "<tr>
                <td>{$row['aca_id']}</td>
                <td>{$row['aca_nome']}</td>
                <td>{$row['aca_sobrenome']}</td>
              </tr>";
    } else {
        echo "Nenhum resultado encontrado para o ID: " . $aca_id;
    }
}

$conexao->close();
?>