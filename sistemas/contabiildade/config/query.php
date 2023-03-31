<?php

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$queryLog = "SELECT 
CLU.data,
CLU.numero_fluxo,
U.nome
FROM
contabilidade_log_usuario CLU
LEFT JOIN usuarios U ON (U.id_usuario = CLU.id_usuario) ORDER BY  CLU.id DESC";
