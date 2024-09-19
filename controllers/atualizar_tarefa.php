<?php
session_start();
include '../Repositories/HBancoDeDados_class.php';
extract($_REQUEST, EXTR_OVERWRITE);
try {
    $tabela = 'tarefa';
    $campos_e_valores = [
        'tarefa_id' => $tarefa_id,
        'prioridade' => $prioridade,
        'status' => $status,
        'vencimento' => date('Y-m-d H:i:s', strtotime($data_vencimento)),
        'usuario_atualizacao' => $_SESSION['usuario'],
        'data_atualizacao' => date('Y-m-d H:i:s')
    ];
    $where = "id = '$id'";
    $update = HBancoDeDados::Gerar_Update($pdo, $tabela, $campos_e_valores, $where);
    if ($update) {
        echo json_encode(array('success' => true, 'msg' => 'Tarefa atualizada com sucesso!'), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Erro ao atualizar tarefa!'), JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}