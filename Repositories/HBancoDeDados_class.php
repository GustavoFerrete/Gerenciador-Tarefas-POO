<?php
require '../controllers/pdo.php';
class HBancoDeDados
{
    /**
     * Função para criar INSERT no banco de dados
     * @param PDO $pdo
     * @param tabela_do_banco_de_dados Nome da tabela do banco de dados
     * @param campos_e_valores Array associativo com os campos e seus respectivos valores
     * @return string Instrução INSERT formatada
     */
    public static function Gerar_Insert($pdo, $tabela_do_banco_de_dados, $campos_e_valores)
    {
        $campos = array_keys($campos_e_valores);
        $placeholders = array_map(fn($campo) => ":$campo", $campos);

        $sql = "INSERT INTO {$tabela_do_banco_de_dados} (" . implode(',', $campos) . ") VALUES (" . implode(',', $placeholders) . ")";

        $stmt = $pdo->prepare($sql);

        // Executa a query com os valores associados aos placeholders
        return $stmt->execute($campos_e_valores);
    }

    /**
     * Função para criar UPDATE no banco de dados
     *
     * @param PDO $pdo
     * @param string $tabela_do_banco_de_dados Nome da tabela do banco de dados
     * @param array $campos_e_valores Array associativo com os campos e seus respectivos valores
     * @param string $where Condição WHERE da query UPDATE
     *
     * @return bool True se a query for executada com sucesso, false caso contr rio
     */
    public static function Gerar_Update($pdo, $tabela_do_banco_de_dados, $campos_e_valores, $where)
    {
        $campos = array_keys($campos_e_valores);
        $placeholders = array_map(fn($campo) => "$campo = :$campo", $campos);
        $sql = "UPDATE {$tabela_do_banco_de_dados} SET " . implode(',', $placeholders) . " WHERE {$where}";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($campos_e_valores);
    }

    /**
     * Função para criar DELETE no banco de dados
     *
     * @param PDO $pdo
     * @param string $tabela_do_banco_de_dados Nome da tabela do banco de dados
     * @param string $where Condição WHERE da query DELETE
     *
     * @return bool True se a query for executada com sucesso, false caso contr rio
     */
    public static function Gerar_Delete($pdo, $tabela_do_banco_de_dados, $where)
    {
        $sql = "DELETE FROM {$tabela_do_banco_de_dados} WHERE {$where}";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
}