<?php
session_start();
include 'pdo.php';

$input_arr = array();
foreach($_POST as $key => $input_arr) {
    $_POST[$key] = addslashes($input_arr);
}
extract($_POST, EXTR_OVERWRITE);
$senha = md5($senha);

$usuarios = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
$query = $pdo->prepare($usuarios);
$query->execute();

if ($query->rowCount() > 0) {
    $_SESSION['logado'] = true;
    $_SESSION['usuario'] = $usuario;
    echo json_encode(array('success' => true, 'msg' => 'Autenticação bem-sucedida'));
    exit;
} else {
    echo json_encode(array('success' => false, 'msg' => 'Usuário ou senha inválidos!'));
}