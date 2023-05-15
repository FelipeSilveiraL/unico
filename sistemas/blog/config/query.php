<?php

require_once('../../../config/databases.php');

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$queryPostagem = "SELECT * FROM blog_post";

$queryComentario = "SELECT 
C.id_comentario,
C.id_postagem,
C.nome,
D.nome AS nome_departamento,
E.nome AS nome_empresa,
C.comentario,
C.data,
C.avisado_responsavel
FROM
blog_comentarios C
    LEFT JOIN
blog_empresa E ON (C.empresa = E.id_empresa)
    LEFT JOIN
blog_departamento D ON (C.departamento = D.id_departamento)";

?>