<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resource/styles/admin.css">
    <title>Gerenciador de alunos</title>
</head>
<body>
        <div class="navbar"><img src="resource\img\image\logo_rp_eventos_500x500.png" alt="logo"></div>
    <table>
        <tr>
            <td style="width: 50%;padding-left: 20px;">
                <div class="conteinerlogin">
                    <br>
                    <p class="bold">LOGIN</p>
                    <p class="golden">ADMIN</p>
                    <form action="" method="post">
                        <label for="user">Usuário:</label>
                        <br><br>
                        <input type="text" name="user" id="user">
                        <br><br>
                        <label for="senha">Senha: </label>
                        <br><br>
                        <input type="password" name="senha" id="senha">
                        <br><br><br>
                        <input type="submit" class="botao">
                        <br><br><br>
                    </form>
                </div>
                </td>
                <td>
                    <img src="resource\img\image\loginlogo.png" alt="logologin" class="logo">
                </td>
        </tr>
    </table>
</body>
</html>
<?php

include('resource/database/conexao.php');

if(isset($_POST['user']) || isset($_POST['senha']))
{
    if(strlen($_POST['user']) == 0)
    {
        echo "Prencha seu email";
    }else if(strlen($_POST['senha']) == 0){
        echo "Prencha sua senha";
    }else{
        $email = $conexao->real_escape_string($_POST['user']);
        $senha = $conexao->real_escape_string($_POST['senha']);

        $sql_code ="SELECT * FROM usuario WHERE userNome = '$email' AND userSenha = '$senha'";
        $sql_query = $conexao->query($sql_code);

        $quantidade = $sql_query ? $sql_query->num_rows : 0;
        if($quantidade == 1){
            $quantidade = $sql_query->fetch_assoc();

            if(!isset($_SESSION)){
                session_start();
            }
           header("location: admin.php"); 
        }else{
            echo"erro";
        }
    }

}

?>