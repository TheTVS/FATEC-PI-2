<?php
include('../resource/database/conexao.php');

$texto = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //post do forms
    $cpf= $_POST['username'] ?? '';
    $senha = $_POST['password'] ?? 0;

    // Abre a conexão
    $conexao->begin_transaction();

    // Inserindo dados na tabela temporada
    $sql = "INSERT INTO `usuario_acampante` (`usu_cpf`, `usu_senha`) VALUES (? , ?);";
    $stmt = $conexao->prepare($sql);

    // Evita SQL injection
    $stmt->bind_param("ss", $cpf,$senha);
    if ($stmt->execute()) {
        $conexao->commit(); // Comita a transação
        $texto = "Nova conta criada com sucesso!";
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
    <link rel="stylesheet" href="../resource/styles/admin.css">
    <title>Login</title>
    <script>
        function formatInput(event) {
            const input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (value.length > 3) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
            }
            if (value.length > 7) {
                value = value.replace(/(\d{3}\.\d{3})(\d)/, '$1.$2');
            }
            if (value.length > 11) {
                value = value.replace(/(\d{3}\.\d{3}\.\d{3})(\d)/, '$1-$2');
            }
            input.value = value;
        }
    </script>
</head>
<body>
    <div class="navbar"><img src="../resource/img/image/logo_rp_eventos_500x500.png" alt="logo"></div>
    <table style="position: relative;width: 100%;">
        <tr>
            <td style="padding-left: 35%;">
                <br>
                <div class="conteinerlogin" style="width: 50%;">
                    <br>
                    <p class="bold">CRIAR CONTA</p>
                    <p class="golden">USUÀRIO</p>
                    <?php
                    // Exibe a mensagem, se houver
                    if (!empty($texto)) {
                        echo "$texto";
                    }
                    ?>
                    <!-- Exibir mensagem de erro, se existir -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <p class="error"><?= $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); // Limpa a mensagem após exibi-la ?>
                    <?php endif; ?>
                    <form action="" method="post">
                        <label for="username">CPF:</label>
                        <br><br>
                        <input type="text" id="input" name="username" placeholder="000.000.000-00" required oninput="formatInput(event)" maxlength="14" >
                        <br><br>
                        <label for="password">Senha:</label>
                        <br><br>
                        <input type="password" name="password" required>
                        <br><br><br>
                        <button onclick="location.href='loginUsuario.php'">Voltar</button> <input type="submit" class="botao">
                        <br><br><br>
                    </form>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>