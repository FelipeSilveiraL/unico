<?php
require_once('../config/query.php');

$queryDepNF = 'SELECT ID_DEPARTAMENTO FROM bpm_nf_emp_dep WHERE ID_EMPRESA = "'.$_POST['id'].'"';

$resultadoDepNF = $conn->query($queryDepNF);

while ($depNF = $resultadoDepNF->fetch_assoc()) {

    $queryNomeDep = "SELECT * FROM bpm_nf_departamento WHERE ID_DEPARTAMENTO  = ".$depNF['ID_DEPARTAMENTO']." AND  ID_DEPARTAMENTO NOT IN(144) ORDER BY ID_DEPARTAMENTO ASC";

    $sucesso = $conn->query($queryNomeDep);

    while($nome = $sucesso->fetch_assoc()){

        echo '<option value="' . $nome['ID_DEPARTAMENTO'] . '">' . $nome['NOME_DEPARTAMENTO'].'</option>';

    }

}

$conn->close();