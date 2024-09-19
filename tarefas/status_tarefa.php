<?php
session_start();
include('../Repositories/TarefasRepository.php');
try {
    // Instanciando diretamente a função para trazer a lista dos status das tarefas, devido ser uma função estatica
    $lista_status = Tarefas::listaStatusTarefa();
    echo json_encode($lista_status, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo $e->getMessage();
}