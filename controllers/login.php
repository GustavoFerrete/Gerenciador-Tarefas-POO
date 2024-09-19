<?php
session_start();
include '../Repositories/UsuariosRepositories.php';
extract($_REQUEST, EXTR_OVERWRITE);
try {
    $user = Usuario::validaLogin($pdo, $usuario, $senha);
    if ($user) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $user['usuario'];
        echo json_encode(array('success' => true, 'msg' => 'Autenticação bem-sucedida'), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Usuário ou senha inválidos!'), JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}