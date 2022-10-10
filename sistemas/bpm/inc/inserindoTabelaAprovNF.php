<?php
session_start();
require_once('../config/query.php');

$conexao = $conn->query($aprovNF);

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
echo '<td><a href="editApNF.php?pg='.$_GET["pg"].'&id_aprovador='.$rowaprov["ID_APROVADOR"].'" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
<a href="../front/deletarApNF.php?pg='.$_GET["pg"].'&ID='.$row["ID_APROVADOR"].'" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#verticalycentered" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a>
</td> 

<div class="modal fade" id="verticalycentered" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">'.$rowaprov['NOME_EMPRESA'].'</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <span style="Color: red;">Tem certeza que deseja deletar?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger"><a href="http://'.$_SESSION['servidorOracle'].'/smartshare/bd/deletar.php?id='.$rowaprov['ID_APROVADOR'] .'" style="color: white;">DELETAR</button>
      </div>
    </div>
  </div>
</div>
</tr>
';
}