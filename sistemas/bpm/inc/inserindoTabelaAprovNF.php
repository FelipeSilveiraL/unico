<?php
require_once('../config/query.php');

$conexao = oci_parse($connBpmgp, $aprovNF);
oci_execute($conexao);

while ($rowaprov = oci_fetch_array($conexao, OCI_ASSOC)) {

  switch ($rowaprov['SITUACAO']) {
    case 'A':
      $situacao = 'Ativo';
      break;
    default:
      $situacao = 'Desativado';
      break;
  }

  echo '<tr>';
  echo '<td>' . $rowaprov['ID_APROVADOR'] . '</td>';
  echo '<td>' . $rowaprov['NOME_EMPRESA'];
  echo ($situacao == 'Ativo') ? '<br><span class="badge rounded-pill bg-success">Ativo</span>' : '<br><span class="badge rounded-pill bg-secondary">Desativado</span>';
  echo '</td>';
  echo '<td>' . $rowaprov['NOME_DEPARTAMENTO'] . '</td>';
  echo '<td>' . $rowaprov['APROVADOR_FILIAL'] . '</td>';
  echo '<td>' . $rowaprov['APROVADOR_AREA'] . '</td>';
  echo '<td>' . $rowaprov['APROVADOR_MARCA'] . '</td>';
  echo '<td>' . $rowaprov['APROVADOR_GERENTE'] . '</td>';
  echo '<td>' . $rowaprov['APROVADOR_SUPERINTENDENTE'] . '</td>';
  // echo '<td>' . $situacao . '</td>';
  echo '<td ' . $usuarioFuncao . '><a href="editApNF.php?pg=' . $_GET["pg"] . '&id_aprovador=' . $rowaprov["ID_APROVADOR"] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                            
<a href= "../inc/deletar.php?pg=' . $_GET['pg'] . '&id=' . $rowaprov['ID_APROVADOR'] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a>
</td> 
</tr>
';
}
oci_free_statement($conexao);
oci_close($connBpmgp);
