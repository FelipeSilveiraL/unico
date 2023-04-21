<?php
    require_once('../../../config/databases.php');
    //cores sistema
    $querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

    $queryHorarioTrabalho = "SELECT  

    HT.id_horario,
    E.NOME_EMPRESA,
    E.ID_EMPRESA,
    DRH.NOME_DEPARTAMENTO,
    DRH.ID_DEPARTAMENTO,
    HT.segunda_sexta,
    HT.segunda_sexta_almoco,
    HT.sabado,
    HT.sabado_almoco,
    HT.situacao
    
    FROM horario_trabalho HT
    LEFT JOIN  EMPRESA E  ON (HT.ID_EMPRESA = E.ID_EMPRESA)
    LEFT JOIN  DEPARTAMENTO_RH DRH ON (HT.ID_DEPARTAMENTO = DRH.ID_DEPARTAMENTO)";

    $queryEmpresaRh = "SELECT * FROM EMPRESA ";

    $queryDepartamentoRh = "SELECT * FROM DEPARTAMENTO_RH ";
?>
