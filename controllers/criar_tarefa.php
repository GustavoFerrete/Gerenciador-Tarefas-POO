<?php
session_start();
include '../Repositories/HBancoDeDados_class.php';
extract($_REQUEST, EXTR_OVERWRITE);
try {
    $tabela = 'tarefa';
    $campos_e_valores = [
        'tarefa_id' => $nome_tarefa,
        'prioridade' => $prioridade,
        'status' => $status,
        'usuario_criacao' => $_SESSION['usuario'],
        'criacao_datahora' => date('Y-m-d H:i:s'),
        'vencimento' => $data_vencimento
    ];
    $insert = HBancoDeDados::Gerar_Insert($pdo, $tabela, $campos_e_valores);
    if ($insert) {
        echo json_encode(array('success' => true, 'msg' => 'Tarefa criada com sucesso!'), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Erro ao criar tarefa!'), JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}