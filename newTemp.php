<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/styles/temp.css">
    <title>Document</title>
</head>
<body>
    <div class="navbar"><img src="resource\img\image\logo_rp_eventos_500x500.png" alt="logo">
    <a href="admin.php">voltar</a>
    </div>
    <div class="conteudo">
            <form id="form"> 
                <label for="temp_name">Nome da temporada: </label>
                <input type="text" name="" id="temp_name">
                <br>
                <label for="temp_init">Data de início: </label>
                <input type="date" name="" id="temp_init">
                <br>
                <label for="temp_end">Data de término: </label>
                <input type="date" name="" id="temp_end">
                <br>
                <label for="temp_val">Valor da inscrição (Inteira)</label>
                <input type="number" step="0.01" name="" id="temp_val">
                <br>
                <label for="temp_parc">Numero maximo de parcelas aceitas: </label>
                <input type="number" name="" id="temp_parc">
                <br>
                <label for="temp_festas">Festas da temporada </lable><br>
                <textarea id="temp_festas" name="story" rows="5" cols="33" maxlength="200"></textarea>
                <br>
                <input type="submit" class="btn">
            </form>
    </div>
</body>
</html>