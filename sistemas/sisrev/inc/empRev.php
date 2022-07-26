<?php 

require_once('../config/query.php');

if($_GET['ex'] != null){

$excluir = $_GET['ex'];

$excluindoFilial = "DELETE FROM cad_emp_rev WHERE id = ".$excluir."; ";

$sucesso = $conn->query($excluindoFilial);

if($sucesso){
    header('Location:../front/empRev.php?msn=5');
}else{
    header('Location:../front/empRev.php?msn=13');
}

}else{

$empr = $_POST['EMPR'];
$numRev = $_POST['NUMREV'];
$nomeEmp = $_POST['NOMEEMP'];
$nomeFilial = $_POST['NOMEFILIAL'];
$tipo = $_POST['TIPO'];
$rev = $_POST['REV'];
$dn = $_POST['DN'];
$ativo = $_POST['ATIVO'];
$revenda = $_POST['REVENDA'];
$vendas = $_POST['VENDAS'];
$bd = $_POST['BD'];
$bandeira = $_POST['BANDEIRA'];
$cnpj = $_POST['CNPJ'];
$teste = $_POST['id'];

switch($teste){

        case 0 :

        $filialNova = "INSERT INTO cad_emp_rev (nome_empresa,EMPR,num_rev,tipo,rev_matriz,
        rev,dn,ATIVO,nome_filial,cnpj,tem_vendas,sistema_emp_bd,bandeira)VALUES ('".$nomeEmp."',".$empr.",".$numRev.",'".$tipo."',".$numRev.",
        '".$rev."',".$dn.",'".$ativo."','".$nomeFilial."','".$cnpj."','".$vendas."','".$bd."','".$bandeira."');";

        $conexao = $conn->query($filialNova);

        if($conexao){
            header('Location: ../front/empRev.php?msn=8');
        }else{
            header('Location: ../front/empRev.php?msn=13');
        }

        break;

    case !0:
    $id = $_POST['id'];
    $editandoFiliais = "UPDATE cad_emp_rev SET nome_empresa = '".$nomeEmp."', EMPR = ".$empr.", num_rev = ".$numRev.",tipo = '".$tipo."',rev_matriz = '".$numRev."', 
    rev = ".$rev.",dn = '".$dn."', ATIVO = '".$ativo."', revenda = '".$revenda."', cnpj = '".$cnpj."', tem_vendas = '".$vendas."', sistema_emp_bd = '".$bd."' WHERE id = ".$id."; ";

    $conexao2 = $conn->query($editandoFiliais);

    if($conexao2){
        
        header('Location: ../front/empRev.php?msn=4');
    }else{
        
        header('Location: ../front/empRev.php?msn=13');
    }
    break;
}


}



?>