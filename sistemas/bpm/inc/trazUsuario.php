<?php

    require_once('../config/query.php');

    $nome = explode("  ", $_POST['id']);

    for ($i=0; trim($nome[$i]) != NULL ; $i++) { 
        $nomeUsuario .= $nome[$i]." ";
    }
    
    $queryUsuario .= " WHERE nomfun = '".$nomeUsuario."'";

    $resultadoUsuario = sqlsrv_query($connVetorh, $queryUsuario);

    if ($usuario = sqlsrv_fetch_array($resultadoUsuario, SQLSRV_FETCH_ASSOC)) {
        echo $cpf = $usuario['numcpf'];
    } else {
        //se for alterar esta frase, tem que alterar tambem ../front/novaRegraGerente.php
        echo $cpf = 'CPF não localizado no RH, favor verificar';
    }