<?php
session_start();
include('../Repositories/TarefasRepository.php');
extract($_REQUEST, EXTR_OVERWRITE);
try {
    // Instanciando a classe Tarefas com parâmetros padrão ou valores recebidos
    $page = isset($page) ? intval($page) : 1;
    $rows = isset($rows) ? intval($rows) : 20;
    $sort = isset($sort) ? strval($sort) : 'id';
    $order = isset($order) ? strval($order) : 'desc';

    $tarefas = new Tarefas($page, $rows, $sort, $order);
    $total = $tarefas->getTotalTarefas($pdo, $prioridade ?? null, $status ?? null, $criacao_usuario ?? null);
    $resultados = $tarefas->getTarefas($pdo, $prioridade ?? null, $status ?? null, $criacao_usuario ?? null);

    echo json_encode(['success' => true, 'total' => $total, 'rows' => $resultados], JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}