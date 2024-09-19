<?php
session_start();
include '../Repositories/HBancoDeDados_class.php';
extract($_REQUEST, EXTR_OVERWRITE);
try {
    $tabela = 'tarefa';
    $where = "id = '$id'";
    $delete = HBancoDeDados::Gerar_Delete($pdo, $tabela, $where);
    if ($delete) {
        echo json_encode(array('success' => true, 'msg' => 'Tarefa excluída com sucesso!'), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Erro ao excluir tarefa!'), JSON_UNESCAPED_UNICODE);
    }    
} catch (PDOException $e) {
    echo $e->getMessage();
}