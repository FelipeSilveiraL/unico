<?php

//ajuste de Methodo de envio de formulário para a pesquisa e montagem da tabela.
if ($_POST['cpf'] == NULL) {
    $ajuste = str_replace("-","", $_GET['cpf']);
} else {
    $ajuste = str_replace("-","", $_POST['cpf']);
}

//Query de busca de usuários para montagem da tabela.

/* 
Essa tabela esta sendo administrada no seguinte caminho
/var/www/html/acoesAutomaticas/front/importarUsuariosApi.php 
*/
$queryDemitidos .= " WHERE cpf = ".str_replace(".", "", $ajuste)."";
$resultado = $conn->query($queryDemitidos);

while ($rowResultado = $resultado->fetch_assoc()) {

    if ($rowResultado['ativo'] == 'S') {
        $ativo = "SIM";
        $color = "green";
    } else {
        $ativo = "NÃO";
        $color = "red";
    }

    $dados .= 
    '
        <tr>
            <td>' .$rowResultado['id']. '</td>
            <td>' .$rowResultado['nome']. '</td>
            <td>' .$rowResultado['cpf']. '</td>
            <td style="color: '.$color.';">' .$ativo. '</td>
            <td>' .$rowResultado['sistema']. '</td>                      
            <td>';
                if ($ativo == 'NÃO') {
                $dados .='
                <a href="desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$rowResultado['cpf'].'&sistema='.$rowResultado['sistema'].'&nome='.$rowResultado['nome'].'&acao=1&api=true" title="Ativar" class="btn btn-success btn-sm" '.$usuarioFuncao.'>
                    <i class="bi bi-check-square"></i>
                </a>';
                } else {
                $dados .='  
                <a href="desativar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&saida=1&cpf='.$rowResultado['cpf'].'&sistema='.$rowResultado['sistema'].'&nome='.$rowResultado['nome'].'&acao=2&api=true" title="Desativar" class="btn btn-danger btn-sm" '.$usuarioFuncao.'>
                    <i class="bi bi-trash"></i>
                </a>';
                }
            $dados .= '</td>
        </tr>';
}

?>