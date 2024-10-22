<?php
session_start();
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
    <table>
        <tr>
            <td style="width: 50%;padding-left: 20px;">
                <div class="conteinerlogin">
                    <br>
                    <p class="bold">LOGIN</p>
                    <p class="golden">Usuário</p>

                    <!-- Exibir mensagem de erro, se existir -->
                    <?php if (isset($_SESSION['error'])): ?>
                        <p class="error"><?= $_SESSION['error']; ?></p>
                        <?php unset($_SESSION['error']); // Limpa a mensagem após exibi-la ?>
                    <?php endif; ?>

                    <form action="autorizaUsuario.php" method="post">
                        <label for="username">CPF:</label>
                        <br><br>
                        <input type="text" id="input" name="username" placeholder="000.000.000-00" required oninput="formatInput(event)" maxlength="14" >
                        <br><br>
                        <label for="password">Senha:</label>
                        <br><br>
                        <input type="password" name="password" required>
                        <br><br><br>
                        <button onclick="location.href='novaConta.php'">Criar Conta</button> <input type="submit" class="botao">
                        <br><br><br>
                    </form>
                </div>
            </td>
            <td>
                <img src="../resource/img/image/loginlogo.png" alt="logologin" class="logo">
            </td>
        </tr>
    </table>
</body>
</html>