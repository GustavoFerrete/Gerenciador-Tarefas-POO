<?php

session_start();
include '../controllers/pdo.php';


$buscarUsuarios = $pdo->query(
    "SELECT DISTINCT criacao_usuario FROM tarefa"
)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($buscarUsuarios, JSON_UNESCAPED_UNICODE);