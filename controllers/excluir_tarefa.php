<?php
session_start();

include 'pdo.php';

$input_arr = array();
foreach ($_GET as $key => $input_arr) {
    $_GET[$key] = addslashes($input_arr);
}
extract($_GET, EXTR_OVERWRITE);

//print_r($_GET);

$deletar = "DELETE FROM tarefa WHERE id = '$id'";
$query = $pdo->prepare($deletar);
$query->execute();


echo json_encode(array('success' => true));