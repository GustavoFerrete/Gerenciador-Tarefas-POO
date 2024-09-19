<?php
require '../controllers/pdo.php';
class Usuario
{
    public $user = null;
    public $password = null;
    public $senha_md5 = null;

    /**
     * Valida o login do usuario no banco de dados.
     *
     * @param PDO $pdo
     * @param string $user
     * @param string $password
     *
     * @return array|null
     */
    public static function validaLogin($pdo, $user, $password)
    {
        try {
            $query = "SELECT id, usuario, senha FROM usuarios WHERE usuario = :usuario AND senha = :senha";
            $senha_md5 = md5($password);
            $stmt = $pdo->prepare($query);
            $stmt->execute([':usuario' => $user, ':senha' => $senha_md5]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Retorna a lista de usuarios que criaram tarefas.
     *
     * @param PDO $pdo
     *
     * @return array Lista de usuarios
     */
    public static function getListaUsuariosCriacao($pdo) {
        $query = "SELECT DISTINCT usuario_criacao FROM tarefa";
        return $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}