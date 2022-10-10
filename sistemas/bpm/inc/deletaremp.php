<?php 

require_once('../config/query.php');

$ID_EMPRESA = ''.$_GET["ID"].'';
$deletar .= 'WHERE ID_EMPRESA= '.$_GET["ID"].' ';

$resultado = $conn->query($deletar);


    while($row = $resultado->fetch_assoc()){

        
        $consorcio = ($row["CONSORCIO"] == 'S') ? 'SIM' : 'NÃO';

        $situacao = ($row["SITUACAO"] == 'A') ? 'ATIVO' : 'DESATIVADO';

        
        switch ($row["SISTEMA"]) {
        case "A":
            $sistemaMysql = "APOLLO";
            break;
        case "N":
            $sistemaMysql = "BANCO NBS";
            break;
        case "H":
            $sistemaMysql = "BANCO HARLEY";
            break;
        case " ":
            $sistemaMysql = "EMPRESA QUE NÃO USA SISTEMA ERP";
            break;
        case "0":
            $sistemaMysql = "EMPRESA QUE NÃO USA SISTEMA ERP";
            break;
    }
    $mostra .='<tr>
            <td>'.$row["NOME_EMPRESA"].'</td>
                <td>'.$sistemaMysql.'</td>
                <td>'.$row["EMPRESA_NBS"].'</td>
                <td>'.$consorcio.'</td>
                <td>'.$row["EMPRESA_APOLLO"].'</td>
                <td>'.$row["REVENDA_APOLLO"].'</td>
                <td>'.$row["ORGANOGRAMA_SENIOR"].'</td>
                <td>'.$row["EMPRESA_SENIOR"].'</td>
                <td>'.$row["FILIAL_SENIOR"].'</td>
                </tr>
                ';
    }




?>