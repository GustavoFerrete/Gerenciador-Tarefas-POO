<?php

$lista = [
    ['id' => 1, 'descricao' => 'BAIXA'],
    ['id' => 2, 'descricao' => 'MÉDIA'],
    ['id' => 3, 'descricao' => 'MÁXIMA']
];

echo json_encode($lista, JSON_UNESCAPED_UNICODE);