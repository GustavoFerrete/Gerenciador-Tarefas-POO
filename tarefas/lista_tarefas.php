<?php

session_start();
include '../controllers/pdo.php';


$tarefas = $pdo->query(
    "SELECT * FROM lista_tarefas"    
    )->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tarefas, JSON_UNESCAPED_UNICODE);