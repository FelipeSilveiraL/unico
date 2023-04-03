<?php
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');

$emp .= " ORDER BY ID_EMPRESA ASC";

$conSucesso = oci_parse($connBpmgp,$emp);
oci_execute($conSucesso,OCI_COMMIT_ON_SUCCESS);

while ($row = oci_fetch_array($conSucesso,OCI_ASSOC)) {


  $consorcio = ($row["CONSORCIO"] == 'S') ? 'SIM' : 'NÃO';

  $situacao = ($row["SITUACAO"] == 'A') ? 'ATIVO' : 'DESATIVADO';


  switch ($row["SISTEMA"]) {
    case "A":
      $sistemaMysql = "APOLLO";
      break;
    case "N":
      $sistemaMysql = "BANCO NBS";
      break;
    case "H":
      $sistemaMysql = "BANCO HARLEY";
      break;
    case " ":
      $sistemaMysql = "EMPRESA QUE NÃO USA SISTEMA ERP";
      break;
    case "C":
      $sistemaMysql = "CONSÓRCIO";
      break;
    case "0":
      $sistemaMysql = "EMPRESA QUE NÃO USA SISTEMA ERP";
      break;
  }

  echo '<tr>
                  <td>' . $row["ID_EMPRESA"] . '</td>
                  <td>' . $row["NOME_EMPRESA"] . '</td>
                  <td>' . $row["UF_GESTAO"] . '</td>
                  <td>' . $sistemaMysql . '</td>
                  <td>' . $consorcio . '</td>
                  <td>' . $situacao . '</td>
                  <td><a href="editEmp.php?pg=' . $_GET["pg"] . '&tela=3&ID=' . $row["ID_EMPRESA"] . '" title="Editar"  class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                            <a href="../front/deletarEmp.php?pg=' . $_GET["pg"] . '&ID=' . $row["ID_EMPRESA"] . '" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#idempresa' . $row["ID_EMPRESA"] . '" title="Exibir mais informações" class="btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                        </td>
              </tr>';

  echo '
                      <div class="modal fade" id="idempresa' . $row["ID_EMPRESA"] . '" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">' . $row["NOME_EMPRESA"] . '</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="div-table">
                              <div class="div-table-row">
                                  <div class="div-table-col font-1"><b>EMPRESA BNS</b><hr>&emsp;&emsp;&emsp;' . $row["EMPRESA_NBS"] . '</div>
                                  <div class="div-table-col font-1"><b>EMPRESA APOLLO</b><hr>&emsp;&emsp;&emsp;&emsp;' . $row["EMPRESA_APOLLO"] . '</div>
                                  <div class="div-table-col font-1"><b>REVENDA APOLLO</b><hr>&emsp;&emsp;&emsp;&ensp;&ensp;' . $row["REVENDA_APOLLO"] . '</div>
                                  <div class="div-table-col font-1"><b>ORGANOGRAMA SENIOR</b><hr>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;' . $row["ORGANOGRAMA_SENIOR"] . '</div>
                                  <div class="div-table-col font-1"><b>EMPRESA SENIOR</b><hr>&emsp;&emsp;&emsp;&emsp;' . $row["EMPRESA_SENIOR"] . '</div>
                                  <div class="div-table-col font-1"><b>FILIAL SENIOR</b><hr>&emsp;&emsp;&ensp;&ensp;' . $row["FILIAL_SENIOR"] . '</div>
                                  <div class="div-table-col font-1"><b>APROVADOR CAIXA</b><hr>&emsp;&emsp;' . $row["APROVADOR_CAIXA"] . '</div>
                              </div>
                              
                            </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                          </div>
                        </div>
                      </div>';
}
