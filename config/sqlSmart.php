<?php
// select para as telas do bpm

$queryPerfil = "SELECT CD_PERFIL, DS_PERFIL FROM PERFIL";

$mfpConsulta = "SELECT * FROM MFP_WEB";

$query_caixa = "SELECT CNF.ID_EMPRESA,E.NOME_EMPRESA, CNF.USUARIO_CAIXA, CNF.ID_CAIXA_EMPRESA, CE.NOME_CAIXA
FROM
    caixas_nf CNF
LEFT JOIN caixa_empresa CE ON (CNF.id_caixa_empresa = CE.id_caixa_empresa)
LEFT JOIN empresa E ON (CNF.ID_EMPRESA = E.ID_EMPRESA) ORDER BY E.ID_EMPRESA ASC
";

$consulta = "SELECT * FROM caixas_nf";

$queryEmpresa = "SELECT * FROM EMPRESA";

$query_user = 'SELECT
        ds_usuario,
        ds_login,
        cd_usuario
    FROM
        usuario
    WHERE
            st_ativo = 1
    AND cd_usuario NOT IN ( 1, 23, 24, 22, 16681,
                                18110, 18111, 18112, 18113, 18484,
                                18485, 18486, 18529, 18340, 16680,
                                18782 )
    ORDER BY  ds_usuario ASC';

/* Select para a tela Aprovadores RH */
$aprov = 'SELECT
        a.aprovador_filial,
        a.aprovador_area,
        a.aprovador_marca,
        a.aprovador_superintendente,
        a.id_empresa,
        a.id_departamento,
        a.aprovador_gerente,
        e.nome_empresa,
        d.nome_departamento,
        a.situacao, 
        a.*
    FROM
        aprovadores_rh a
    INNER JOIN empresa e ON a.id_empresa = e.id_empresa
    INNER JOIN departamento_rh d ON a.id_departamento = d.id_departamento';


/* Select para a tela Aprovadores NF */
$aprovNF = 'SELECT
a.aprovador_filial,
a.aprovador_area,
a.aprovador_marca,
a.aprovador_superintendente,
a.id_empresa,
a.id_departamento,
a.aprovador_gerente,
e.nome_empresa,
d.nome_departamento,
a.situacao, 
a.*
FROM
aprovadores_nf a
INNER JOIN empresa e ON a.id_empresa = e.id_empresa
INNER JOIN departamento_nf d ON a.id_departamento = d.id_departamento';


/* Select para a tela de Departmento RH */
$departrh = 'SELECT
        d.nome_departamento,
        d.situacao,
        d.id_departamento
    FROM
        departamento_rh d';

/* Select para a tela de Departmento RH */
$departNF = 'SELECT
        d.nome_departamento,
        d.situacao,
        d.id_departamento
    FROM
        departamento_nf d';


/* Select para a tela de Empresa */
/* É necessário trocar os resultados dos campos sistema, situação, consórcio */
$emp = 'SELECT
        *
        FROM
            empresa';


$empNew = 'SELECT
            *
        FROM
            empresa
        ORDER BY
            nome_empresa ASC';


/* Select para a tela de Empresa_Departamento */
$empdep = 'SELECT
        e.id_empdep,
        r.nome_empresa,
        e.id_departamento,
        e.situacao,
        e.gerente_aprova,
        e.superintendente_aprova,
        d.nome_departamento
    FROM
        empresa_departamento e
        INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento
        INNER JOIN empresa r ON r.id_empresa = e.id_empresa';

/* Select para a tela de Empresa_Departamento */
$empdepNF = 'SELECT
e.id_empdep,
e.lanca_multas,
r.nome_empresa,
e.id_departamento,
e.situacao,
e.gerente_aprova,
e.superintendente_aprova,
d.nome_departamento,
e.GESTOR_AREA_APROVA_MULTAS,
e.REVISAO_ADM,
e.LOGIN_ADM
FROM
empresa_departamento_nf e
INNER JOIN departamento_nf d ON d.id_departamento = e.id_departamento
INNER JOIN empresa r ON r.id_empresa = e.id_empresa';



$empdepedit = 'SELECT  
        DISTINCT
        d.nome_departamento,
        d.id_departamento
    FROM
        empresa_departamento e
        INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento
        INNER JOIN empresa r ON r.id_empresa = e.id_empresa
        AND d.id_departamento != (41) ORDER BY d.nome_departamento ASC';


$empdepNew = 'SELECT 
        * 
    FROM 
        empresa_departamento e 
    INNER JOIN departamento_rh d ON d.id_departamento = e.id_departamento';

$empdepNewNF = 'SELECT 
* 
FROM 
empresa_departamento e 
INNER JOIN departamento_nf d ON d.id_departamento = e.id_departamento';


/* Select para a tela de Gestor Direto */
$gesdir = 'SELECT
        g.id_empresa,
        g.id_departamento,
        g.login_smartshare,
        g.cpf_gestor,
        g.id_gestor_direto,
        d.nome_departamento,
        e.nome_empresa,
        g.situacao
    FROM
        gestor_direto g
    INNER JOIN departamento_rh d ON d.id_departamento = g.id_departamento
    INNER JOIN empresa e ON e.id_empresa = g.id_empresa';


$query_user = 'SELECT
        ds_usuario,
        ds_login,
        cd_usuario
    FROM
        usuario
    WHERE
            st_ativo = 1
    AND cd_usuario NOT IN ( 1, 23, 24, 22, 16681,
                                18110, 18111, 18112, 18113, 18484,
                                18485, 18486, 18529, 18340, 16680,
                                18782 )
    ORDER BY  ds_usuario ASC';

$aprovsuper = 'SELECT
        aprovador_superintendente,
        id_aprovador
    FROM
        aprovadores_rh
    WHERE
        id_aprovador IN (99, 196)';


$queryAprovFilial = 'SELECT
        a.id_aprovador,
        a.id_empresa,
        a.aprovador_gestor,
        a.situacao,
        e.nome_empresa
    FROM
        aprovadores_rh a
    INNER JOIN empresa e ON e.id_empresa = a.id_empresa';



$queryUserApi = "SELECT
U.ds_usuario,
U.ds_login,
U.cd_usuario,
U.ds_email,
U.st_ativo,
P.DS_PAPEL
FROM
usuario U
LEFT JOIN 
papel P ON (U.CD_PAPEL_PRINCIPAL = P.CD_PAPEL ) ";

$queryfornecedoresSeminovos = "SELECT FS.* FROM fornecedores_seminovos FS";

$queryContaBancariasFornecedor = "SELECT CBF.* FROM contas_bancarias_fornecedor CBF";

$queryCustoVeiculo = "SELECT 
                ccv.id_codigo_custo_veiculo, 
                ccv.id_empresa,
                e.nome_empresa,
                e.sistema,
                e.empresa_nbs,
                e.empresa_apollo, 
                ccv.tipo_custo, 
                ccv.ano_referencia, 
                ccv.codigo_custo_erp
FROM codigo_custo_veiculo ccv
LEFT JOIN empresa e on ccv.id_empresa = e.id_empresa";

$queryEstados = "SELECT * FROM estados";

$queryCidade = "SELECT * FROM cidades";

$caixaUsuarios = "SELECT 
CF.ID_EMPRESA,
EM.NOME_EMPRESA,
EM.NUMERO_CAIXA,
CF.USUARIO_CAIXA
FROM CAIXAS_NF CF, EMPRESA EM
WHERE
CF.ID_EMPRESA = EM.ID_EMPRESA";

$aprovadores = "SELECT * FROM APROVADORES_RH";

/* Select para a tela de tela_comissões */

$sqlEmpresa = "SELECT * FROM EMPRESA";

$searchVendedor = "SELECT * FROM FAT_VENDEDOR";

$buscaApollo = "SELECT 
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
FMC.STATUS NOT IN ('A') and  
FTT.UTILIZA_VEICULOS = 'S' and 
FMC.DTA_ENTRADA_SAIDA";

$sqlItensVeiculoDev = "select FMVD.VEICULO as xcodigo_veiculo, 
FMVD.NUMERO_NOTA_FISCAL    as xnota_origem_devolucao, 
(FMVD.VAL_TOTAL - FMVD.VAL_DESCONTO + FMVD.VAL_ICMS_RETIDO) as xval_venda_veiculo,    
VVD.CHASSI as xchassi,   
VVD.MODELO as xmodelo,   
VMD.DES_MODELO as xdes_modelo,   
VPD.PROPOSTA as xproposta,  
VVD.ORIGEM_VEICULO as xorigem_veiculo, 
VPD.NEGOCIACAO_FINAL as xnegociacao_final   
from FAT_MOVIMENTO_CAPA FMCD, FAT_MOVIMENTO_VEICULO FMVD ,VEI_VEICULO VVD ,VEI_MODELO VMD,     
VEI_PROPOSTA VPD";

$sqlItensVeiculo =  "select FMV.VEICULO as xcodigo_veiculo,
(FMV.VAL_TOTAL - FMV.VAL_DESCONTO + FMV.VAL_ICMS_RETIDO) as xval_venda_veiculo,
VV.CHASSI as xchassi,
VV.MODELO as xmodelo,
VM.DES_MODELO as xdes_modelo,
VP.PROPOSTA as xproposta,
VV.ORIGEM_VEICULO as xorigem_veiculo,
VP.NEGOCIACAO_FINAL as xnegociacao_final
from FAT_MOVIMENTO_VEICULO FMV ,VEI_VEICULO VV ,VEI_MODELO VM,
VEI_PROPOSTA VP";

$queryVendedor = "SELECT * FROM VENDEDORES";

//querys do EtiquetaLaser.php


$queryApollo = "SELECT NOME, CPF, ATIVO FROM GER_USUARIO";

$queryApolloVendedor = "SELECT NOME, CPF, ATIVO FROM FAT_VENDEDOR";

$queryNbs = "SELECT NOME, CPF, DEMITIDO FROM EMPRESAS_USUARIOS";

$itemApollo = "SELECT LOCACAO_ZONA, LOCACAO_RUA, LOCACAO_ESTANTE, LOCACAO_PRATELEIRA,
        ITEM_ESTOQUE,
        EMPRESA,
        REVENDA,
        LOCACAO_NUMERO FROM PEC_ITEM_REVENDA";

$itemEstoque = "SELECT EMPRESA, 
        ITEM_ESTOQUE, 
        ITEM_ESTOQUE_PUB, 
        CODIGO_INVERTIDO, 
        DES_ITEM_ESTOQUE, 
        GRUPO , 
        ITEM_EDICAO
        FROM PEC_ITEM_ESTOQUE";

