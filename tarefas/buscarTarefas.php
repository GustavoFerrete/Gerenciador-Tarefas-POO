<?php
session_start();

include "../controllers/pdo.php";

extract($_REQUEST, EXTR_OVERWRITE);

$page = isset($page) ? intval($page) : 1;
$rows = isset($rows) ? intval($rows) : 20;
$offset = ($page-1)*$rows;
$sort = isset($sort) ? strval($sort) : 'id';
$order = isset($order) ? strval($order) : 'asc';

$total = $pdo->query(
        "SELECT COUNT(id) as qtde FROM tarefa"
)->fetch(PDO::FETCH_ASSOC);

$filtroSituacao = "";
if(isset($prioridade) && $prioridade != ''){
    $filtroSituacao = "AND prioridade IN($prioridade)";
}

$filtroStatus = "";
if(isset($status) && $status != ''){
    $filtroStatus = "AND status IN($status)";
}

$filtroUsuario = "";
if(isset($criacao_usuario) && $criacao_usuario != ''){
    $filtroUsuario = "AND criacao_usuario IN($criacao_usuario)";
}

$tarefas = $pdo->query(
    "SELECT * 
    FROM 
        tarefa 
    WHERE id > 0 
        $filtroSituacao
        $filtroStatus
        $filtroUsuario
    ORDER BY
        $sort $order
    LIMIT
        $offset, $rows
    ")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('total' => $total['qtde'], 'rows' => $tarefas, 'status'));