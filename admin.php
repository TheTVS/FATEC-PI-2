<?php
    
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/styles/menu.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Gerenciador de alunos</title>
</head>
<body>
    <div class="navbar"><img src="resource\img\image\logo_rp_eventos_500x500.png" alt="logo">
    <button onclick="location.href='desloga.php'" class="desloga">Sair</button>
    </div>
    <table>
        <tr>
            <td style="width: 50%;">
                <div class="area">
                    <div class="titulo">TEMPORADA <span class="material-symbols-outlined">menu</span></div>
                    <button onclick="window.location.href = 'temp.php'" class="btn">Temporada atual</button>
                    <button onclick="window.location.href = 'newTemp.php'" class="btn">Iniciar nova temporada</button>
                    <button onclick="window.location.href = 'altTemp.php'" class="btn">Alterar Temporada Atual</button>
                </div>
                <br>
                <div class="area">
                    <div class="titulo">INSCRITOS <span class="material-symbols-outlined">menu</span></div>
                    <button onclick="window.location.href = 'listaInscs.html'" class="btn">Consultar inscrições</button><br>
                    <button onclick="window.location.href = 'listaCamps.html'" class="btn">Consultar campistas</button><br>
                    <button onclick="window.location.href = 'listaTutors.html'" class="btn">Consultar responsáveis</button>
                </div>
            </td>
            <td>
                <img src="resource\img\image\loginlogo.png" alt="logologin" class="logo">
            </td>
        </tr>
    </table>
</body>
</html>
