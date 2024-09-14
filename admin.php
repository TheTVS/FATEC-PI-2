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
    <div class="navbar"><img src="resource\img\image\logo_rp_eventos_500x500.png" alt="logo"></div>
    <div class="conteudo">
        <div class="area">
            <div class="titulo">TEMPORADA <span class="material-symbols-outlined">menu</span></div>
            <button onclick="window.location.href = 'listaCamps.html'" class="btn">Consultar campistas</button><br>
            <button onclick="window.location.href = 'listaTutors.html'" class="btn">Consultar responsáveis</button>
        </div>
        <br>
        <div class="area">
            <div class="titulo">INSCRITOS <span class="material-symbols-outlined">menu</span></div>
            <button onclick="window.location.href = 'listaInscs.html'" class="btn">Consultar inscrições</button><br>
            <button onclick="window.location.href = 'newTemp.html'" class="btn">Iniciar nova temporada</button>
        </div>
        <img src="resource\img\image\loginlogo.png" alt="logologin" class="logo">
    </div>
</body>
</html>

<?php
    if(!isset($_SESSION)){
        session_start();

    }

?>