<?php
session_start();
include('../Repositories/TarefasRepository.php');
try {
    // Instanciando diretamente a função para trazer a lista de prioridades, devido ser uma função estatica
    $lista_prioridades = Tarefas::listaPrioridades();
    echo json_encode($lista_prioridades, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo $e->getMessage();
}