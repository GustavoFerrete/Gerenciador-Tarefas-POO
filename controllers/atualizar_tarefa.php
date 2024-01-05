<?php
session_start();

include 'pdo.php';

$input_arr = array();
foreach ($_GET as $key => $input_arr) {
    $_GET[$key] = addslashes($input_arr);
}

extract($_GET, EXTR_OVERWRITE);

$data_formatada = date('Y-m-d H:i:s', strtotime($data_vencimento));

$update = "
    UPDATE 
        tarefa
    SET 
        tarefa_id = '$tarefa_id',
        prioridade = '$prioridade',
        status = '$status',
        vencimento = '$data_formatada',
        usuario_atualizacao = '$_SESSION[usuario]',
        data_atualizacao = NOW()
    WHERE
        id = '$id'
    ";

$query = $pdo->prepare($update);
$query->execute();

$response = array(
    'success' => true,
    'msg_atualizacao' => 'Tarefa atualizada com sucesso!'
);

echo json_encode($response);