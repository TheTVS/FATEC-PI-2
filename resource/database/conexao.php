<?php

$hostname = "localhost";
$user = "root";
$password = "usbw";
$database = "rp_eventos";
$conexao = mysqli_connect($hostname, $user, $password, $database);

if(!$conexao) {
 echo "Falha na conexão!";
}
?>