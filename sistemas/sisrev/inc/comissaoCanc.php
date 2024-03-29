<?php
session_start();

require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');


$nomeUsuario = $_SESSION['nome_usuario'];

$dateCom = $_GET['dateCom'];

$dateFim = $_GET['dateFim'];

$dropDev = "DROP TABLE sisrev_comissao_canc";

$con = oci_parse($connBpmgp, $dropDev);
oci_execute($con, OCI_COMMIT_ON_SUCCESS);

$createTableDev = "CREATE TABLE sisrev_comissao_canc (
  
    id NUMBER GENERATED BY DEFAULT AS IDENTITY,
    XEMPRESA number(3) NULL,
    XREVENDA number(3) NULL,
    XPROPOSTA number(15) NULL,
    XNRONOTA number(15) NULL,
    XTRANSACAO VARCHAR(10) NULL,
    XDTNOTA VARCHAR(10) NULL,
    TIPO_VENDA VARCHAR(12) NULL,
    XCHASSI VARCHAR(80) NULL,
    XCODIGO_VEICULO VARCHAR(15) NULL,
    XVAL_VENDA_VEICULO VARCHAR(13) NULL,
    XVENDEDOR VARCHAR(30) NULL,
    XEMPRESA_VENDEDOR number(10) NULL,
    ID_EMPRESA number(10) NULL,
    XCPF VARCHAR(15) NULL,
    PRIMARY KEY (id))";

$deuBoaCriar = oci_parse($connBpmgp, $createTableDev);
oci_execute($deuBoaCriar, OCI_COMMIT_ON_SUCCESS);


$sqlNotasCanc = "SELECT 
    FNV.EMPRESA as xempresa, 
    FNV.REVENDA as xrevenda, 
    FNV.NUMERO_NOTA_FISCAL as xnronota, 
    FNV.SERIE_NOTA_FISCAL as xserienf, 
    FNV.CONTADOR as xcontador_nf,  
    FMC.DTA_ENTRADA_SAIDA as xdtnota, 
    FNV.TIPO_TRANSACAO as xtransacao,  
    FMC.STATUS as xstatus_nf, 
    FC.NOME as xnome_cliente, 
    FTT.SUBTIPO_TRANSACAO as xsubtipo_transacao, 
    FTT.DES_TIPO_TRANSACAO as xdes_tipo_transacao, 
    FTT.UTILIZA_PECAS as xutiliza_pecas, 
    FTT.UTILIZA_OFICINA as xutiliza_oficina, 
    FTT.UTILIZA_VEICULOS as xutiliza_veiculos, 
    FTT.UTILIZA_VEICULOS_NOVOS as xutiliza_veiculos_novos, 
    FMC.CONTATO as xcontato, 
    FNV.VENDEDOR as xvendedor, 
    FMC.FATOPERACAO_ORIGINAL as xfatoperacao_original 
    FROM FAT_NOTAS_VENDEDOR FNV,FAT_MOVIMENTO_CAPA FMC ,  
    FAT_TIPO_TRANSACAO FTT, FAT_CLIENTE FC 
    WHERE  
    FNV.EMPRESA = FMC.EMPRESA and 
    FNV.REVENDA = FMC.REVENDA and 
    FNV.NUMERO_NOTA_FISCAL = FMC.NUMERO_NOTA_FISCAL and 
    FNV.SERIE_NOTA_FISCAL = FMC.SERIE_NOTA_FISCAL and 
    FNV.CONTADOR = FMC.CONTADOR and 
    FNV.TIPO_TRANSACAO = FMC.TIPO_TRANSACAO and 
    FMC.CLIENTE = FC.CLIENTE and 
    FMC.TIPO_TRANSACAO = FTT.TIPO_TRANSACAO and 
    FMC.STATUS IN ('C') and  
    FTT.UTILIZA_VEICULOS = 'S' and 
    FMC.DTA_CANCELAMENTO_NOTA between TO_DATE('$dateCom','dd/mm/yy') and 
    TO_DATE('$dateFim','dd/mm/yy') and 
    FMC.TIPO_TRANSACAO IN ('U21','U07','M07','M21','M41','M57','M61') 
    ORDER BY 
    FNV.EMPRESA,FNV.REVENDA,FNV.NUMERO_NOTA_FISCAL,FNV.SERIE_NOTA_FISCAL,+
    FNV.CONTADOR,FNV.VENDEDOR";

$resultado = oci_parse($connApollo, $sqlNotasCanc);

oci_execute($resultado, OCI_COMMIT_ON_SUCCESS);

while (($row = oci_fetch_array($resultado, OCI_ASSOC + OCI_RETURN_NULLS)) != FAlSE) {

    if ($row['XUTILIZA_VEICULOS_NOVOS'] != 'S') {

        //procurando cpf do Vendedor
        $searchVendedor = "SELECT * FROM FAT_VENDEDOR WHERE VENDEDOR = " . $row['XVENDEDOR'] . "";

        $achei = oci_parse($connApollo, $searchVendedor);
        oci_execute($achei, OCI_COMMIT_ON_SUCCESS);

        if (($vendedorApollo = oci_fetch_array($achei, OCI_ASSOC)) != FAlSE) {
            $cpfVendedor = $vendedorApollo['CPF'];

            $queryVendedor = "SELECT * FROM VENDEDORES WHERE CPF = " . $cpfVendedor;

            $bpmCon = oci_parse($connBpmgp, $queryVendedor);
            oci_execute($bpmCon, OCI_COMMIT_ON_SUCCESS);

            if (($vendedorBPM = oci_fetch_array($bpmCon, OCI_ASSOC)) != FAlSE) {

                $empresaVendedor = $vendedorBPM['EMPRESA'];

                $nome = $vendedorBPM['NOME'];
                $nome = explode(' ', $nome);
                $nome = $nome[0] . ' ' . $nome[1] . ' ' . $nome[2];
            } else {
                $nome = 0;
                $empresaVendedor = 0;
            }
        } else {
            $nome = 0;
            $empresaVendedor = 0;
        }

        if ($row['XSUBTIPO_TRANSACAO'] == 'D') {

            $sqlItensVeiculoCancDevCanc = "select FMVD.VEICULO as xcodigo_veiculo, 
            FMVD.NUMERO_NOTA_FISCAL    as xnota_origem_devolucao, 
            (FMVD.VAL_TOTAL - FMVD.VAL_DESCONTO + FMVD.VAL_ICMS_RETIDO) as xval_venda_veiculo,    
            VVD.CHASSI as xchassi,   
            VVD.MODELO as xmodelo,   
            VMD.DES_MODELO as xdes_modelo,   
            VPD.PROPOSTA as xproposta,  
            VVD.ORIGEM_VEICULO as xorigem_veiculo, 
            VPD.NEGOCIACAO_FINAL as xnegociacao_final   
           from FAT_MOVIMENTO_CAPA FMCD, FAT_MOVIMENTO_VEICULO FMVD ,VEI_VEICULO VVD ,VEI_MODELO VMD,     
           VEI_PROPOSTA VPD where 
           FMCD.EMPRESA =  '" . $row['XEMPRESA'] . "' and 
            FMCD.REVENDA =   '" . $row['XREVENDA'] . "' and 
            FMCD.FATOPERACAO =   '" . $row['XFATOPERACAO_ORIGINAL'] . "' and 
            FMCD.EMPRESA =  FMVD.EMPRESA  and 
            FMCD.REVENDA = FMVD.REVENDA and 
            FMCD.NUMERO_NOTA_FISCAL = FMVD.NUMERO_NOTA_FISCAL AND  
            FMCD.SERIE_NOTA_FISCAL = FMVD.SERIE_NOTA_FISCAL AND  
            FMCD.CONTADOR = FMVD.CONTADOR AND 
            FMCD.TIPO_TRANSACAO = FMVD.TIPO_TRANSACAO AND 
            FMVD.EMPRESA = VVD.EMPRESA and   
            FMVD.VEICULO = VVD.VEICULO and   
            VVD.EMPRESA = VMD.EMPRESA and   
            VVD.MODELO = VMD.MODELO and   
            FMVD.EMPRESA = VPD.EMPRESA and   
            FMVD.REVENDA = VPD.REVENDA and 
            VPD.CONTATO = FMCD.CONTATO";

            $conecta = oci_parse($connApollo, $sqlItensVeiculoCancDevCanc);

            oci_execute($conecta, OCI_COMMIT_ON_SUCCESS);


            while (($achou = oci_fetch_array($conecta, OCI_ASSOC + OCI_RETURN_NULLS)) != FAlSE) {

                $idEmpresaQuery = "SELECT ID_EMPRESA FROM EMPRESA WHERE EMPRESA_APOLLO = " . $row['XEMPRESA'] . " AND REVENDA_APOLLO = " . $row['XREVENDA'] . " AND SISTEMA NOT IN('N','C','H')";

                $result = oci_parse($connBpmgp, $idEmpresaQuery);
                oci_execute($result, OCI_COMMIT_ON_SUCCESS);

                if ($idEmpresaRow = oci_fetch_array($result, OCI_ASSOC)) {
                    $idEmpresa = $idEmpresaRow['ID_EMPRESA'];
                }


                !isset($achou['XCHASSI']) ? $xChassi = '' : $xChassi = $achou['XCHASSI'];
                !isset($achou['XMODELO']) ? $xModelo = '' : $xModelo = $achou['XMODELO'];
                !isset($achou['XPROPOSTA']) ? $xProposta = '0' : $xProposta = $achou['XPROPOSTA'];
                !isset($achou['XCODIGO_VEICULO']) ? $xCodVeiculo = '' : $xCodVeiculo = $achou['XCODIGO_VEICULO'];
                !isset($achou['XVAL_VENDA_VEICULO']) ? $xValVendaVeiculo = '0' : $xValVendaVeiculo = $achou['XVAL_VENDA_VEICULO'];

                $querySmart = "INSERT INTO sisrev_comissao_canc
                    (XEMPRESA,XREVENDA,XNRONOTA,XDTNOTA,XTRANSACAO,
                    XVENDEDOR,XEMPRESA_VENDEDOR,TIPO_VENDA,XCODIGO_VEICULO,XVAL_VENDA_VEICULO,XCPF,
                    XCHASSI,XPROPOSTA,ID_EMPRESA
                    )
                
                    VALUES (
                    " . $row['XEMPRESA'] . ",
                    " . $row['XREVENDA'] . ",
                    " . $row['XNRONOTA'] . ",
                    '" . $row['XDTNOTA'] . "',
                    '" . $row['XTRANSACAO'] . "',
                    '" . $nome . "',
                    " . $empresaVendedor . ",
                    'CANCELADA',
                    '" . $xCodVeiculo . "',
                    '-" . $xValVendaVeiculo . "',
                    '" . $cpfVendedor . "',
                    '" . $xChassi . "',
                    " . $xProposta . ",
                    " . $idEmpresa . "
                    
                    )";

                $sucesso = oci_parse($connBpmgp, $querySmart);
                oci_execute($sucesso, OCI_COMMIT_ON_SUCCESS);
            }
        } else {


            $sqlItensVeiculoCanc =  "select FMV.VEICULO as xcodigo_veiculo,
                      (FMV.VAL_TOTAL - FMV.VAL_DESCONTO + FMV.VAL_ICMS_RETIDO) as xval_venda_veiculo,
                      VV.CHASSI as xchassi,
                      VV.MODELO as xmodelo,
                      VM.DES_MODELO as xdes_modelo,
                      VP.PROPOSTA as xproposta,
                      VV.ORIGEM_VEICULO as xorigem_veiculo,
                      VP.NEGOCIACAO_FINAL as xnegociacao_final
                    from FAT_MOVIMENTO_VEICULO FMV ,VEI_VEICULO VV ,VEI_MODELO VM,
                    VEI_PROPOSTA VP where
                      FMV.EMPRESA = '" . $row['XEMPRESA'] . "'   and
                      FMV.REVENDA =  '" . $row['XREVENDA'] . "' and
                      FMV.TIPO_TRANSACAO =   '" . $row['XTRANSACAO'] . "' and
                      FMV.NUMERO_NOTA_FISCAL =  '" . $row['XNRONOTA'] . "'   and
                      FMV.SERIE_NOTA_FISCAL =   '" . $row['XSERIENF'] . "' and
                      FMV.CONTADOR =  " . $row['XCONTADOR_NF'] . "  and
                      FMV.EMPRESA = VV.EMPRESA and
                      FMV.VEICULO = VV.VEICULO and
                      VV.MODELO = VM.MODELO and
                      VV.EMPRESA = VM.EMPRESA and
                      FMV.EMPRESA = VP.EMPRESA and
                      FMV.REVENDA = VP.REVENDA and
                      VP.CONTATO = '" . $row['XCONTATO'] . "'";

            $veiculoCancCon = oci_parse($connApollo, $sqlItensVeiculoCanc);

            oci_execute($veiculoCancCon, OCI_COMMIT_ON_SUCCESS);

            while (($tipoNaoD = oci_fetch_array($veiculoCancCon, OCI_ASSOC + OCI_RETURN_NULLS)) != FAlSE) {
                $idEmpresaQuery = "SELECT ID_EMPRESA FROM EMPRESA WHERE EMPRESA_APOLLO = " . $row['XEMPRESA'] . " AND REVENDA_APOLLO = " . $row['XREVENDA'] . " AND SISTEMA NOT IN('N','C','H')";

                $result2 = oci_parse($connBpmgp, $idEmpresaQuery);
                oci_execute($result2, OCI_COMMIT_ON_SUCCESS);

                if ($idEmpresaRow = oci_fetch_array($result2, OCI_ASSOC)) {
                    $idEmpresa = $idEmpresaRow['ID_EMPRESA'];
                }

                !isset($tipoNaoD['XCHASSI']) ? $xChassi = '' : $xChassi = $tipoNaoD['XCHASSI'];
                !isset($tipoNaoD['XMODELO']) ? $xModelo = '' : $xModelo = $tipoNaoD['XMODELO'];
                !isset($tipoNaoD['XPROPOSTA']) ? $xProposta = '0' : $xProposta = $tipoNaoD['XPROPOSTA'];
                !isset($tipoNaoD['XCODIGO_VEICULO']) ? $xCodVeiculo = '' : $xCodVeiculo = $tipoNaoD['XCODIGO_VEICULO'];
                !isset($tipoNaoD['XVAL_VENDA_VEICULO']) ? $xValVendaVeiculo = '0' : $xValVendaVeiculo = $tipoNaoD['XVAL_VENDA_VEICULO'];

                $querySmart2 = "INSERT INTO sisrev_comissao_canc
                (XEMPRESA,XREVENDA,XNRONOTA,XDTNOTA,XTRANSACAO,
                XVENDEDOR,XEMPRESA_VENDEDOR,TIPO_VENDA,XCODIGO_VEICULO,XVAL_VENDA_VEICULO,XCPF,
                XCHASSI,XPROPOSTA,ID_EMPRESA
                )
                        VALUES (
                    " . $row['XEMPRESA'] . ",
                    " . $row['XREVENDA'] . ",
                    " . $row['XNRONOTA'] . ",
                    '" . $row['XDTNOTA'] . "',
                    '" . $row['XTRANSACAO'] . "',
                    '" . $nome . "',
                    " . $empresaVendedor . ",
                    'CANCELADA',
                    '" . $xCodVeiculo . "',
                    '-" . $xValVendaVeiculo . "',
                    '" . $cpfVendedor . "',
                    '" . $xChassi . "',
                    " . $xProposta . ",
                    " . $idEmpresa . "
                        )";
                $deuBoa = oci_parse($connBpmgp, $querySmart2);
                oci_execute($deuBoa, OCI_COMMIT_ON_SUCCESS);
            }
        }
    }
}


header("Location: ./relatorioSisrev.php?pg=" . $_GET['pg'] . "&dateCom=" . $dateCom . "&dateFim=" . $dateFim . "&nome=".$nomeUsuario."");



oci_free_statement($conexao);
oci_free_statement($resultado);
oci_free_statement($execCreate);
oci_free_statement($sucesso);
oci_close($connApollo);
oci_close($connBpmgp);
