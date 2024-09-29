<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/styles/admin.css">
    <title>Gerenciador de alunos</title>
</head>
<body>
    <div class="navbar"><img src="resource/img/image/logo_rp_eventos_500x500.png" alt="logo"></div>
    <table>
        <tr>
            <td style="width: 50%;padding-left: 20px;">
                <div class="conteinerlogin">
                    <br>
                    <p class="bold">LOGIN</p>
                    <p class="golden">ADMIN</p>

                    <!-- Exibir mensagem de erro, se existir -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <p class="error"><?= $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); // Limpa a mensagem após exibi-la ?>
                    <?php endif; ?>

                    <form action="autoriza.php" method="post">
                        <label for="username">Usuario:</label>
                        <br><br>
                        <input type="text" name="username" required>
                        <br><br>
                        <label for="password">Senha:</label>
                        <br><br>
                        <input type="password" name="password" required>
                        <br><br><br>
                        <input type="submit" class="botao">
                        <br><br><br>
                    </form>
                </div>
            </td>
            <td>
                <img src="resource/img/image/loginlogo.png" alt="logologin" class="logo">
            </td>
        </tr>
    </table>
</body>
</html>