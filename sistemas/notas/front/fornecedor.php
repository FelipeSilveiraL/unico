<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Fornecedores</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">Fornecedor</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <!--################# COLE section AQUI #################-->

  <section>
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Lista Fornecedores Rateados
              <a href="rateioFornecedor.php" class="btn btn-success button-rigth-espelho" style="margin-top: -3px;">
                <i class="bx bxs-plus-square"></i>
              </a>
            </h5>
            <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Fornecedores em vermelho quer dizer que o centro de custo está incompleto, clique <a href="fornecedor.php?fornecedorIncompleto=1">AQUI</a> mostrar apenas esses fornecedores</span>

            <table class="table-sm table table-hover datatable">
              <thead>
                <tr class="capitalize">
                  <th scope="col">CNPJ&emsp;</th>
                  <th scope="col">FORNECEDOR&emsp;</th>
                  <th scope="col">FILIAL&emsp;</th>
                  <th scope="col">OBSERVAÇÃO&emsp;</th>
                  <th scope="col">SISTEMA LANÇAMENTO&emsp;</th>
                  <th scope="col" class="text-right">ação&emsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $incompleto = $_GET['fornecedorIncompleto'] == null ? '' : " AND centro_custo_completo = 1";

                $queryFornecedor .= " WHERE id_usuario = " . $_SESSION['id_usuario'] . $incompleto;

                $resultadoFor = $connNOTAS->query($queryFornecedor);

                while ($fornecedor = $resultadoFor->fetch_assoc()) {

                  $buscaNomeFilial = "SELECT NOME_EMPRESA FROM EMPRESA WHERE ID_EMPRESA = " . $fornecedor['ID_FILIAL'];

                  $result = oci_parse($connBpmgp, $buscaNomeFilial);
                  oci_execute($result);

                  while ($nomeEmpresas = oci_fetch_array($result, OCI_ASSOC)) {
                    $idEmpresa = $nomeEmpresas['NOME_EMPRESA'];
                  }

                  oci_free_statement($result);


                  echo '<tr ';
                  echo $fornecedor['centro_custo_completo'] == 1 ? 'class="destacar"' : '';
                  echo '>                          
                            <td>' . $fornecedor['cpfcnpj_fornecedor'] . '</td>
                            <td>' . $fornecedor['fornecedor'] . '</td>
                            <td>' . $idEmpresa . '</td>
                            <td>' . $fornecedor['observacao'] . '</td>
                            <td>';
                  echo $fornecedor['sistema'] == 1 ? 'Fluig' : 'SmartShare';
                  echo '</td>
                            <td class="td-actions text-right">
                              <a href="rateioFornecedor.php?idRateioFornecedor=' . $fornecedor['ID_RATEIOFORNECEDOR'] . '" title="Editar" class="btn btn-primary btn-just-icon btn-sm"><i class="bi bi-pencil"></i></a>
                              <a href="../inc/deletarFornecedor.php?idRateioFornecedor=' . $fornecedor['ID_RATEIOFORNECEDOR'] . '" title="Desativar" class="btn btn-danger btn-just-icon btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                          </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- End Recent Sales -->
    </div>

  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins

oci_close($connBpmgp);
?>