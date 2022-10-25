<?php
session_start();
require_once('../config/query.php');

$conexao = $conn->query($aprovadoresQuery);

while($rowaprov = $conexao->fetch_assoc()){

  switch($rowaprov['SITUACAO']){
    case 'A':
      $situacao = 'Ativo';
      break;
    default:
      $situacao = 'Desativado';
      break;
  }
echo '<tr>';
echo '<td>' . $rowaprov['ID_APROVADOR'] . '</td>';
echo '<td>' . $rowaprov['NOME_EMPRESA'] . '';echo ($situacao == 'Ativo')? '<br><span class="badge rounded-pill bg-success">Ativo</span>' : '<br><span class="badge rounded-pill bg-secondary">Desativado</span>';echo'</td>';
echo '<td>' . $rowaprov['NOME_DEPARTAMENTO'] . '</td>';
echo '<td>' . $rowaprov['APROVADOR_FILIAL'] . '</td>';
echo '<td>' . $rowaprov['APROVADOR_AREA'] . '</td>';
echo '<td>' . $rowaprov['APROVADOR_MARCA'] . '</td>';
echo '<td>' . $rowaprov['APROVADOR_GERENTE'] . '</td>';
echo '<td>' . $rowaprov['APROVADOR_SUPERINTENDENTE'] . '</td>';
// echo '<td>' . $situacao . '</td>';
echo '<td><a href="editAp.php?pg=' . $_GET["pg"] . '&id_aprovador=' . $rowaprov["ID_APROVADOR"] . '" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
<a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarApFilial.php?pg='.$_GET['pg'].'&id='.$rowaprov['ID_APROVADOR'] .'" title="Desativar" '. $usuarioFuncao .' style="margin-top: 3px;color: white;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
</td> 

</tr>
';
}