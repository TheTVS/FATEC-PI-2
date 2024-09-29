<?php
session_start();
require 'resource/database/conexao.php';   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($conexao) {
            $stmt = $conexao->prepare("SELECT * FROM usuario WHERE userNome = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Verifique se a senha corresponde
            if ($user && $user['userSenha'] === $password) {
                $_SESSION['user_id'] = $user['userId'];
                header('Location: admin.php');
                exit();
            } else {
                $_SESSION['error'] = 'Usuário ou senha incorretos';
                header('Location: login.php');
                exit();
            }
        } else {
            echo 'Erro na conexão com o banco de dados.';
        }
    } else {
        echo 'Usuário ou senha não definidos.';
    }
} else {
    echo 'Método de requisição inválido.';
}
?>