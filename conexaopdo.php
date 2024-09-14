<?php
    try{
        $banco = new PDO('mysql:host=localhost;dbname=rp_eventos;charset=utf8mb4', 'root', '');
        $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
    }
?>