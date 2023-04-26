<?php
require_once('../../../config/databases.php');

//query para usar na tela de Desativar / Ativar Usuários
$queryDemitidos = "SELECT DISTINCT id, nome, cpf, ativo, sistema FROM cad_usuario_api";

$droptablePE = "DROP TABLE sisrev_politicamente_exposto";

// PE - Politicamente Exposto
$createtablePE = "CREATE TABLE `sisrev_politicamente_exposto` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `CPF_PEP` VARCHAR(11) NULL,
    `Nome_PEP` VARCHAR(255) NULL,
    `apollo` VARCHAR(10) NULL,
    `nbs` VARCHAR(255) NULL,
    `nbs_ribeirao` VARCHAR(10) NULL,
    `atualizado` INT(10) NULL DEFAULT 0 COMMENT '0 = N�O; 1 = SIM, ENCONTREI; 2 = SIM, N�O ENCONTREI',
    PRIMARY KEY (`id`))";

$queryLogPE = "SELECT 
SAPE.caminho, SAPE.data, SAPE.nome_arquivo, U.nome
FROM
sisrev_arquivo_PE SAPE
LEFT JOIN usuarios U ON (SAPE.id_usuario = U.id_usuario)
ORDER BY SAPE.id DESC
LIMIT 1;";
$resultLogPE = $conn->query($queryLogPE);
$logPE = $resultLogPE->fetch_assoc();


$queryTabela = "SELECT * FROM sisrev_empresas_bpmgp where ID_EMPRESA NOT IN(302,208,261) ORDER BY id ASC;";

$editarTabela = "SELECT * FROM sisrev_empresas_bpmgp ";

$relatorioExcel = "SELECT * FROM sisrev_empresas_bpmgp where ID_EMPRESA NOT IN(302,208,261) ";

$deletar = "SELECT NOME_EMPRESA,SISTEMA,EMPRESA_NBS,CONSORCIO,EMPRESA_APOLLO,REVENDA_APOLLO,ORGANOGRAMA_SENIOR,EMPRESA_SENIOR,FILIAL_SENIOR FROM sisrev_empresas_bpmgp ";   

$queryIsNullPE = "SELECT id FROM sisrev_politicamente_exposto WHERE ";

//query chamar acessos rápidos Sisrev
$queryAcessos = "SELECT * FROM sisrev_modulos";

$consorcio = ($edit["CONSORCIO"] == 'S') ? 'SIM' : 'NÃO';

    $situacao = ($edit["SITUACAO"] == 'A') ? 'ATIVO' : 'DESATIVADO';

    $valueApollo = ($edit["EMPRESA_APOLLO"] == 0) ? '' : $edit["EMPRESA_APOLLO"];

    $valueRevApollo = ($edit["REVENDA_APOLLO"] == 0) ? '' : $edit["REVENDA_APOLLO"];

    $valueEmpNbs = ($edit["EMPRESA_NBS"] == 0) ? '' : $edit["EMPRESA_NBS"];

//query para chamar todos os usuário para cadastrar funções na tela de configurações
$queryUsers = "SELECT * FROM usuarios";


$queryFuncaoUser = "SELECT * FROM sisrev_usuario_funcao ";

$queryFuncaoModulos = "SELECT 
                            SF.id_funcao,
                            SF.nome AS funcao,
                            SM.nome AS tela,
                            (SELECT nome FROM sisrev_modulos WHERE id = SM.sub_modulo) as modulo,
                            SF.descricao,
                            SF.id_modulos
                        FROM
                            sisrev_funcao SF
                        LEFT JOIN
                            sisrev_modulos SM ON SF.id_modulos = SM.id";

$buscaCarga = "SELECT * FROM sisrev_carga_vw_info";

$tabelaEmpRev = "SELECT * FROM cad_emp_rev";

$queryModulos = "SELECT * FROM sisrev_modulos";

$queryModulosUser = array(
                    '1' => "SELECT 
                        U.nome AS usuario,
                        U.id_usuario,
                        SM.nome AS nome_modulo,
                        SM.endereco,
                        SM.icone,
                        SM.id AS id_modulo,
                        SM.sub_modulo
                    FROM
                        sisrev_usuario_modulo SUM
                    LEFT JOIN
                        usuarios U ON (SUM.id_usuario = U.id_usuario)
                    LEFT JOIN
                        sisrev_modulos SM ON (SUM.id_modulo = SM.id)");

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$vendas = "SELECT xve.*, 
                scc.ID AS id_can,
                scc.xempresa as empresa_can,
                scc.xrevenda as revenda_can,
                scc.xproposta as proposta_can,
                scc.xnronota as nronota_can,
                scc.xtransacao as transacao_can,
                scc.xdtnota as dtnota_can,
                scc.tipo_venda as tipo_venda_can,
                scc.xchassi as chassi_can,
                scc.xcodigo_veiculo as codigo_veiculo_can,
                scc.xval_venda_veiculo as val_venda_veiculo_can,
                scc.xvendedor as vendedor_can,
                scc.xempresa_vendedor as empresa_vendedor_can,
                scc.xcpf as cpf_can
            FROM 
                sisrev_comissao xve 
            LEFT JOIN 
                sisrev_comissao_canc scc ON (xve.XNRONOTA = scc.XNRONOTA) 
            WHERE xve.XVENDEDOR != '0' ORDER BY xve.ID_EMPRESA ASC";
