<?php
session_start();
include('../Repositories/TarefasRepository.php');
extract($_REQUEST, EXTR_OVERWRITE);
try {
    // Instanciando diretamente a função para trazer a lista de tarefas, devido ser uma função estatica
    $lista_tarefas = Tarefas::getListaTarefas($pdo);
    echo json_encode($lista_tarefas, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo $e->getMessage();
}