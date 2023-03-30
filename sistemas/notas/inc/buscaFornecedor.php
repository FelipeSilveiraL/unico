<?php
session_start();

require_once('../../../config/config.php');
require_once('../config/query.php');
require_once('../function/periodicidade.php');
require_once('../function/caracteres.php');

$sqlForncedor = "SELECT  CAST(FPJ.CGC AS VARCHAR(14)) xcgccpf,
    fc.nome as xnome_empresa,
    'APOLLO' as xsistema,
    fc.fantasia as xfantasia
    from FAT_CLIENTE FC,
    FAT_PESSOA_JURIDICA FPJ where FC.CLIENTE = FPJ.CLIENTE and  cast(FPJ.CGC as varchar(14)) = '" . $_POST['id'] . "'
    and ((FC.INATIVO_CONSULTAS = 'N') or (FC.INATIVO_CONSULTAS is null)) AND
    FPJ.CGC NOT IN (0) ";


$result = oci_parse($connApollo, $sqlForncedor);
oci_execute($result);

while ($fornecedor = oci_fetch_array($result, OCI_ASSOC)) {
    echo $fornecedor['XNOME_EMPRESA']."-";
}

oci_free_statement($result);

oci_close($connApollo);


if ($_POST['tipo'] == 1) { //lancarnotas.php
    $queryFornecedor = "SELECT * FROM cad_rateiofornecedor WHERE ID_FILIAL = '" . $_POST['idFilial'] . "' AND cpfcnpj_fornecedor = '" . $_POST['id'] . "' AND ID_USUARIO = '" . $_SESSION['id_usuario'] . "'";
    $aplicaquery = $connNOTAS->query($queryFornecedor);
    $fornecedorLancar = $aplicaquery->fetch_assoc();

    if ($fornecedorLancar['ID_RATEIOFORNECEDOR'] != null) {

        //dados
        if ($fornecedorLancar['ID_TIPOPAGAMENTO'] == 1) {
            echo '<option value="1">Boleto</option>-';
        } else {
            echo '<option value="2">Depósito Bancário</option>-';
        } //1

        echo $fornecedorLancar['tipo_serv'] . '-'; //2
        echo '<option value="' . $fornecedorLancar['ID_PERIODICIDADE'] . '">';

        echo periodicidade($fornecedorLancar['ID_PERIODICIDADE']);

        echo '</option>-'; //3

        echo $fornecedorLancar['telefone'] . '-'; //4

        echo '<option value="' . $fornecedorLancar['auditoria'] . '">';
        echo $fornecedorLancar['auditoria'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //5

        echo '<option value="' . $fornecedorLancar['obra'] . '">';
        echo $fornecedorLancar['obra'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //6

        echo '<option value="' . $fornecedorLancar['marketing'] . '">';
        echo $fornecedorLancar['marketing'] == 0 ? "NÃO" : "SIM";
        echo '</option>-'; //7

        echo $fornecedorLancar['observacao'] . '-'; //8

        //banco
        if ($fornecedorLancar['ID_TIPOPAGAMENTO'] == 2) {
            $querybancos = "SELECT * FROM cad_rateiobanco WHERE id_rateiofornecedor = " . $fornecedorLancar['ID_RATEIOFORNECEDOR'];
            $aplicaQueryBanco = $connNOTAS->query($querybancos);
            $banco = $aplicaQueryBanco->fetch_assoc();

            echo '<option value="' . $banco['nome_banco'] . '">' . $banco['nome_banco'] . '</option>-'; //9
            echo $banco['agencia'] . '-'; //10
            echo $banco['conta'] . '-'; //11
            echo $banco['digito'] . '-'; //12

        }
    }
}
