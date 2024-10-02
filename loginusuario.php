<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/styles/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Gerenciador de alunos</title>
</head>
<body>
    <div class="navbar">
        <img src="resource/img/image/logo_rp_eventos_500x500.png" alt="logo">
        <ul id="navbar-menu">
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/">Home</a></li>
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/home/#quemsomos">Quem Somos</a></li>
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/home/#nossosservicos">Nossos Serviços</a></li>
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/acampamento/">Acampamento</a></li>
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/home/#galeria">Galeria</a></li>
            <li class="navbar-menu-contents"><a href="https://rpeventos.rec.br/home/#contato">Contato</a></li>
        </ul>
        <div class = "navbar-favicons" >
            <a href="https://api.whatsapp.com/send?phone=5511999338146" class="navbar-whatsappicon"><i class="fa fa-whatsapp" style="font-size:24px; color:white;" ></i></a>
            <a href="https://www.instagram.com/rpeventos/" class="navbar-instagramicon"><i class = "fa fa-instagram"  style="font-size:24px; color:white;"></i></a>
        </div>
    </div>
    <table>
        <tr>
            <td style="width: 50%;padding-left: 20px;">
                <div class="conteinerlogin">
                    <br>
                    <p class="bold">LOGIN</p>
                    <p class="blue">USUÁRIO</p>

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
                        <br>
                        <a href="recuperar-senha.html" class="passwordforgot">Esqueci a senha</a>
                        <br><br><br>
                        <input type="submit" class="botao">
                        <td>
                            <img src="resource/img/image/art_user_screen.png" alt="logologin" class="logo">
                        </td>
                        <br><br><br>
                    </form>
                </div>
            </td>
           
        </tr>
    </table>
</body>
</html>