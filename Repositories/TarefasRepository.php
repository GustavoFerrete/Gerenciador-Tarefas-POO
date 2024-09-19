<?php
require '../controllers/pdo.php';
class Tarefas
{
    private $page;
    private $rows;
    private $offset;
    private $sort;
    private $order;

    /**
     * Construtor da classe
     *
     * @param int $page Pagina atual
     * @param int $rows Quantidade de registros por pagina
     * @param string $sort Nome do campo para ordenacao
     * @param string $order Tipo de ordenacao (asc ou desc)
     */
    public function __construct($page = 1, $rows = 20, $sort = 'id', $order = 'asc') {
        $this->page = intval($page);
        $this->rows = intval($rows);
        $this->offset = ($this->page - 1) * $this->rows;
        $this->sort = strval($sort);
        $this->order = strval($order);
    }

    /**
     * Retorna a quantidade total de tarefas no banco de dados de acordo com os filtros, se houver
     *
     * @param PDO $pdo Instancia do PDO
     *
     * @return int Quantidade total de tarefas
     */
    public function getTotalTarefas($pdo, $prioridade = null, $status = null, $criacao_usuario = null) {
        $filtros = $this->construirFiltros($prioridade, $status, $criacao_usuario);
        $query = "SELECT COUNT(id) as qtde FROM tarefa ta $filtros";
        return $pdo->query($query)->fetch(PDO::FETCH_ASSOC)['qtde'];
    }

    private function construirFiltros($prioridade = null, $status = null, $criacao_usuario = null) {
    /**
     * Constroi a clausula WHERE para a query de tarefas com base nos filtros passados
     *
     * @param string $prioridade Prioridade da tarefa
     * @param string $status Status da tarefa
     * @param string $criacao_usuario Usuario que criou a tarefa
     *
     * @return string A clausula WHERE completa
     */
        $filtros = " WHERE ta.id > 0";

        if (!empty($prioridade)) {
            $filtros .= " AND ta.prioridade IN($prioridade)";
        }
        if (!empty($status)) {
            $filtros .= " AND ta.status IN($status)";
        }
        if (!empty($criacao_usuario)) {
            $filtros .= " AND ta.criacao_usuario IN($criacao_usuario)";
        }
        return $filtros;
    }

    /**
     * Lista as tarefas de acordo com os filtros, se houver
     *
     * @param PDO $pdo Instancia do PDO
     * @param string $prioridade Prioridade da tarefa
     * @param string $status Status da tarefa
     * @param string $criacao_usuario Usuario que criou a tarefa
     *
     * @return array Tarefas encontradas
     */
    public function getTarefas($pdo, $prioridade = null, $status = null, $criacao_usuario = null) {
        $filtros = $this->construirFiltros($prioridade, $status, $criacao_usuario);
        $query = "SELECT 
                ta.id,
                ta.tarefa_id,
                ta.prioridade,
                ta.status,
                ta.usuario_criacao,
                ta.criacao_datahora,
                ta.vencimento,
                lt.nome_tarefa,
                lt.categoria 
            FROM tarefa ta
            LEFT JOIN lista_tarefas lt ON lt.id = ta.tarefa_id
            $filtros
            ORDER BY {$this->sort} {$this->order}
            LIMIT {$this->offset}, {$this->rows}
        ";
        return $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna a lista de tarefas do banco de dados
     *
     * @param PDO $pdo Instancia do PDO
     *
     * @return array Lista de tarefas
     */
    public static function getListaTarefas($pdo) {
        $query = "SELECT * FROM lista_tarefas";
        return $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna a lista de prioridades
     *
     * @return array Lista de prioridades
     */
    public static function listaPrioridades() {
        $lista = [
            ['id' => 1, 'descricao' => 'BAIXA'],
            ['id' => 2, 'descricao' => 'MÉDIA'],
            ['id' => 3, 'descricao' => 'MÁXIMA']
        ];
        return $lista;
    }

    /**
     * Retorna a lista de status de tarefas
     *
     * @return array Lista de status de tarefas
     */
    public static function listaStatusTarefa() {
        $status = [
            ['id' => 1, 'descricao' => 'EM ANDAMENTO'],
            ['id' => 2, 'descricao' => 'FINALIZADA'],
            ['id' => 3, 'descricao' => 'CANCELADA'],
            ['id' => 4, 'descricao' => 'ATRASADA'],
        ];
        return $status;
    }
}