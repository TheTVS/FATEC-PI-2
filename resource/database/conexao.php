<?php

$hostname = "localhost";
$user = "root";
$password = "1234";
$database = "rp_eventos";
$conexao = mysqli_connect($hostname, $user, $password, $database);

if(!$conexao) {
 echo "Falha na conexão!";
}
?>