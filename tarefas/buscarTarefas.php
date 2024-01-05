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

$filtro_id = "";
if(isset($id) && $id != ''){
    $filtro_id = "AND ta.id = $id";
}

$tarefas = $pdo->query(
    "SELECT 
        ta.id,
        ta.tarefa_id,
        ta.prioridade,
        ta.status,
        ta.usuario_criacao,
        ta.criacao_datahora,
        ta.vencimento,
        lt.nome_tarefa,
        lt.categoria 
    FROM tarefa ta
    LEFT JOIN lista_tarefas lt ON lt.id = ta.tarefa_id
    WHERE ta.id > 0 
        $filtroSituacao
        $filtroStatus
        $filtroUsuario
        $filtro_id
    ORDER BY
        $sort $order
    LIMIT
        $offset, $rows
    ")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(array('success' => true, 'total' => $total['qtde'], 'rows' => $tarefas), JSON_UNESCAPED_UNICODE);