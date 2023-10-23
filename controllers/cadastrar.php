<?php
session_start();

include 'pdo.php';

$input_arr = array();
foreach ($_POST as $key => $input_arr) {
    $_POST[$key] = addslashes($input_arr);
}
extract($_POST, EXTR_OVERWRITE);

$senha_md5 = md5($senha);

if ($_SESSION['cadastro'] == 1) {
    $insert = "INSERT INTO usuarios (nome_completo, usuario, senha) VALUES ('$nome', '$usuario', '$senha_md5')";
    $query = $pdo->prepare($insert);
    $query->execute();

    header('Location: ../views/cadastrar.php');
    $_SESSION['cadastro'] = 0;
}
