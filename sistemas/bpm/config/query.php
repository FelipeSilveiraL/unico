<?php
require_once('../../../config/databases.php');

//query chamar acessos rápidos bpm_modulos
$queryAcessos = "SELECT * FROM bpm_modulos";

//query para chamar todos os usuário para cadastrar funções na tela de configurações
$queryUsers = "SELECT * FROM usuarios";


$queryFuncaoUser = "SELECT * FROM bpm_usuario_funcao ";

$queryFuncaoModulos = "SELECT 
SF.id AS id_funcao,
SF.nome AS funcao,
SM.nome AS tela,
(SELECT 
        nome
    FROM
        bpm_modulos
    WHERE
        id = SM.sub_modulo) AS modulo,
SF.descricao,
SF.id_modulos
FROM
bpm_funcao SF
    LEFT JOIN
bpm_modulos SM ON SF.id_modulos = SM.id";

$queryModulos = "SELECT * FROM bpm_modulos";

$queryModulosUser = array(
    '1' => "SELECT 
                        U.nome AS usuario,
                        U.id_usuario,
                        SM.nome AS nome_modulo,
                        SM.endereco,
                        SM.icone,
                        SM.id AS id_modulo,
                        SM.sub_modulo,
                        SM.pagina
                    FROM
                        bpm_usuario_modulo SUM
                    LEFT JOIN
                        usuarios U ON (SUM.id_usuario = U.id_usuario)
                    LEFT JOIN
                        bpm_modulos SM ON (SUM.id_modulo = SM.id)"
);

//cores sistema
$querySistemaCores = "SELECT id_usuario, id_sistema, color FROM usuarios_sistema_color ";

$deletar = "SELECT NOME_EMPRESA,SISTEMA,EMPRESA_NBS,CONSORCIO,EMPRESA_APOLLO,REVENDA_APOLLO,ORGANOGRAMA_SENIOR,EMPRESA_SENIOR,FILIAL_SENIOR FROM bpm_empresas ";

$queryTabela = "SELECT * FROM empresa where ID_EMPRESA NOT IN(208,382) ORDER BY ID_EMPRESA ASC";

$editarTabela = "SELECT * FROM bpm_empresas ";

$relatorioExcel = "SELECT * FROM empresa where ID_EMPRESA NOT IN(208,382) ";

$aprovadoresQuery = "SELECT
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
INNER JOIN departamento_rh d ON a.id_departamento = d.id_departamento";

$tabelaSeminovos = "SELECT * FROM bpm_seminovos";

$queryEstados = "SELECT * FROM estados";

$contasBancarias = "SELECT * FROM contas_bancarias_fornecedor";

$queryCustoVeiculo = "SELECT * FROM bpm_custo_veiculo";

$queryCidade = "SELECT * FROM cidades";

$queryUsuario = "SELECT numcpf FROM dbo.v_func";

$departamentosQuery = "SELECT * FROM bpm_rh_departamento";

$vendedoresQuery = "SELECT * FROM VENDEDORES v 
LEFT OUTER JOIN EMPRESA e ON e.id_empresa = v.empresa
LEFT OUTER JOIN DEPARTAMENTO_VENDAS dv ON dv.id = v.DEPARTAMENTO";

$gerentesQuery = "SELECT * FROM bpm_gerentes";

$depVendasQuery = "SELECT * FROM departamento_vendas";

$queryCaixaEmpresa = "SELECT * FROM caixa_empresa";

// select para as telas do bpm