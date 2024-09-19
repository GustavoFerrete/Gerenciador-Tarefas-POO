<?php
session_start();
include '../Repositories/HBancoDeDados_class.php';
extract($_REQUEST, EXTR_OVERWRITE);
try {
    $tabela = 'tarefa';
    $campos_e_valores = [
        'nome_completo' => $nome,
        'usuario' => $usuario,
        'senha' => md5($senha)
    ];
    $novo_usuario = HBancoDeDados::Gerar_Insert($pdo, $tabela, $campos_e_valores);
    if ($novo_usuario) {
        echo json_encode(array('success' => true, 'msg' => 'Usuário criado com sucesso!'), JSON_UNESCAPED_UNICODE);
        header('Location: ../views/login.php');
        $_SESSION['cadastro'] = 0;
    } else {
        echo json_encode(array('success' => false, 'msg' => 'Erro ao criar usuaário!'), JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
/*
    session_start();

    include 'pdo.php';

    $input_arr = array();
    foreach ($_POST as $key => $input_arr) {
        $_POST[$key] = addslashes($input_arr);
    }
    extract($_POST, EXTR_OVERWRITE);

    $senha_md5 = md5($senha);

    if ($_SESSION['cadastro'] == 1) {
        $insert = "INSERT INTO usuarios (nome_completo, usuario, senha) VALUES ('$nome', '$usuario', '$senha_md5')";
        $query = $pdo->prepare($insert);
        $query->execute();

        header('Location: ../views/login.php');
        $_SESSION['cadastro'] = 0;
    }
*/