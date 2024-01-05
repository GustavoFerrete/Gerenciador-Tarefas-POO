<?php
session_start();

include 'pdo.php';

$input_arr = array();
foreach ($_GET as $key => $input_arr) {
    $_GET[$key] = addslashes($input_arr);
}

extract($_GET, EXTR_OVERWRITE);

$data_formatada = date('Y-m-d H:i:s', strtotime($data_vencimento));

$insert = "
    INSERT INTO tarefa (
        tarefa_id,
        prioridade,
        status,
        usuario_criacao,
        criacao_datahora,
        vencimento
    ) 
    VALUES (
        '$nome_tarefa',
        '$prioridade',
        '$status',
        '$_SESSION[usuario]',
        NOW(),
        '$data_formatada'
    )";

$query = $pdo->prepare($insert);
$query->execute();

$response = array(
    'success' => true,
    'msg_t' => 'Tarefa criada com sucesso!'
);
echo json_encode($response);

