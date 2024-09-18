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
    <a href="admin.php">voltar</a>
    </div>
    <div class="conteudo">
        <div class="tablescroll">
        
        <table>
            <tr>
                <td colspan="2">
                    <h1>Nova Temporada</h1>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Nome da temporada:
                </td>
            </tr>
            <tr>   
                <td style="width: 50%;">
                    Data de início:
                </td>
                <td style="width: 50%;">
                    Data de término:
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <label for="temp_val">Novo Valor da inscrição (Inteira)</label><br>
                        <input type="number" step="0.01" name="" id="temp_val"><br><br>  
                </td>
            </tr>
            <tr>
                <td colspan="2">
                        <label for="temp_parc">Novo Numero maximo de parcelas aceitas: </label>
                        <input type="number" name="" id="temp_parc">
                        <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="2"> 
                        <label for="temp_festas">Festas da temporada: </lable><br>
                        <textarea id="temp_festas" name="story" rows="5" cols="33" maxlength="200"></textarea>
                        <br><br>
                </td>
            <tr>
                <td colspan="2">
                        <input type="submit" class="btn">
                        <br><br>
                </td>
            </tr>
            </form>
        </table>
        </div>
    </div>
</body>
</html>