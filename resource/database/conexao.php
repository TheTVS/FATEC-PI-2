<?php

$hostname = "localhost";
$user = "root";
$password = "fatec";
$database = "rp_eventos";
$conexao = mysqli_connect($hostname, $user, $password, $database);

if(!$conexao) {
 echo "Falha na conexão!";
}
?>