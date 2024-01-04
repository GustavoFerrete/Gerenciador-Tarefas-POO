<?php

$status = [
    ['id' => 1, 'descricao' => 'EM ANDAMENTO'],
    ['id' => 2, 'descricao' => 'FINALIZADA'],
    ['id' => 3, 'descricao' => 'CANCELADA'],
    ['id' => 4, 'descricao' => 'ATRASADA'],
];

echo json_encode($status, JSON_UNESCAPED_UNICODE);