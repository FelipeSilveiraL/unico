<?php 
session_start();
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

$idEmpresa = ''.$_GET["ID"].'';
$emp .= ' WHERE ID_EMPRESA= '.$idEmpresa;

$resultEmp = oci_parse($connBpmgp, $emp);
oci_execute($resultEmp);
    
while ($row = oci_fetch_array($resultEmp,OCI_ASSOC)) {

        
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