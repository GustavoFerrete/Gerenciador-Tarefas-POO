<?php

$db_dsname = 'mysql:host=localhost;port=3306;dbname=gerenciador_tarefas';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO($db_dsname, $db_user, $db_pass);
    //echo "Conexão realizada com sucesso";
}catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}