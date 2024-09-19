<?php
session_start();
include '../Repositories/UsuariosRepositories.php';
try {
    // Instanciando diretamente a função para trazer a lista de usuarios, devido ser uma função estatica
    $lista_usuarios = Usuario::getListaUsuariosCriacao($pdo);
    echo json_encode($lista_usuarios, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo $e->getMessage();
}