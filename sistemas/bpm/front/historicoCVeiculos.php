<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>REGISTROS ALTERADOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>">CUSTO VEICULO</a></li>
        <li class="breadcrumb-item">REGISTROS ALTERADOS</li>

      </ol>
    </nav>
  </div><!-- End Navegação -->
  <?php
  require_once('../../../inc/mensagens.php'); //Alertas

  switch ($_GET['erro']) {
    case 1:
      echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <span style="font-size: 12px">Custo já existe. Por favor cadestre outro!</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
      break;
    case 2:
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <span style="font-size: 12px">CNPJ já cadastrado. Por favor informe outro</span>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

      break;
  }

  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">

          <div class="card-body">
            <h5 class="card-title"> Registro alterados</h5>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>USUÁRIO</th>
                  <th>DEPARTAMENTO</th>
                  <th>EMPRESA</th>
                  <th>ID REGISTRO</th>
                  <th>ERP ANTERIOR</th>
                  <th>ERP ATUALIZADO PARA</th>
                  <th>DATA ALTERAÇÃO</th>
                </tr>
              </thead>
              <tbody style="text-transform: uppercase;">
                <?php

                $queryLog = "SELECT 
                    LCV.id,
                    LCV.id_usuario, 
                    LCV.id_codigo_custo_veiculo,
                    LCV.custo_erp_anterior,
                    LCV.custo_erp_atual,
                    LCV.data_alteracao,
                    U.nome AS nome_usuario,
                    CD.nome AS departamento,
                    CE.nome AS empresa
                
                    FROM bpm_log_custo_veiculo LCV
                    
                    LEFT JOIN usuarios U ON (LCV.id_usuario = U.id_usuario)
                    LEFT JOIN cad_depto CD ON (U.depto = CD.id)
                    LEFT JOIN cad_empresa CE ON (U.empresa = CE.id) ORDER BY LCV.id_codigo_custo_veiculo DESC";

                $resulLog = $conn->query($queryLog);

                while ($log = $resulLog->fetch_assoc()) {

                  $queryCustoVeiculo = "SELECT 
                                      ccv.ID_CODIGO_CUSTO_VEICULO,
                                      e.SISTEMA,
                                      e.EMPRESA_NBS,
                                      e.EMPRESA_APOLLO
                      FROM codigo_custo_veiculo ccv
                      LEFT JOIN empresa e on ccv.ID_EMPRESA = e.ID_EMPRESA WHERE ccv.ID_CODIGO_CUSTO_VEICULO = " . $log['id_codigo_custo_veiculo'];

                  $resultCustoVeiculo = oci_parse($connBpmgp, $queryCustoVeiculo);
                  oci_execute($resultCustoVeiculo);

                  while ($custoVeiculo = oci_fetch_array($resultCustoVeiculo, OCI_ASSOC)) {

                    if ($custoVeiculo['SISTEMA'] == 'A') {

                      //######################### APOLLO #########################

                      //anterior
                      $queryApolloAn = "SELECT DES_DESPESA, DESPESA FROM vei_despesa WHERE EMPRESA = " . $custoVeiculo['EMPRESA_APOLLO'] . " AND DESPESA = " . $log['custo_erp_anterior'];

                      $resultadoAPolloAn = oci_parse($connApollo, $queryApolloAn);
                      oci_execute($resultadoAPolloAn);

                      while ($empresaAPolloAN = oci_fetch_array($resultadoAPolloAn, OCI_ASSOC)) {
                        $descricaoCustoAnterior = $descricaoCusto = '<td>' . $empresaAPolloAN['DES_DESPESA'] . ' [ ' . $empresaAPolloAN['DESPESA'] . ' ]</td>';
                      }
                      oci_free_statement($resultadoAPolloAn);


                      //atual
                      $queryApolloAt = "SELECT DES_DESPESA, DESPESA FROM vei_despesa WHERE EMPRESA = " . $custoVeiculo['EMPRESA_APOLLO'] . " AND DESPESA = " . $log['custo_erp_atual'];

                      $resultadoAPolloAt = oci_parse($connApollo, $queryApolloAt);
                      oci_execute($resultadoAPolloAt);

                      while ($empresaAPolloAt = oci_fetch_array($resultadoAPolloAt, OCI_ASSOC)) {
                        $descricaoCustoAtual = $descricaoCusto = '<td>' . $empresaAPolloAt['DES_DESPESA'] . ' [ ' . $empresaAPolloAt['DESPESA'] . ' ]</td>';
                      }
                      oci_free_statement($resultadoAPolloAt);
                    } else {

                      //######################### NBS #########################

                      $queryNBS = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM custos_especificos WHERE COD_EMPRESA = " . $custoVeiculo['EMPRESA_NBS'] . " AND CODIGO_CUSTO = " . $custoVeiculo['CODIGO_CUSTO_ERP'];

                      $resultadoNBS = oci_parse($connNbs, $queryNBS);
                      oci_execute($resultadoNBS);

                      while ($empresaNBS = oci_fetch_array($resultadoNBS, OCI_ASSOC)) {
                        $descricaoCusto = '<td>' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ ' . $empresaNBS['CODIGO_CUSTO'] . ' ]</td>';
                      }

                      oci_free_statement($resultadoNBS);
                    }
                  }

                  echo '<tr><td>' . $log['id'] . '</td>
                              <td>' . $log['nome_usuario'] . '</td>
                              <td>' . $log['departamento'] . '</td>
                              <td>' . $log['empresa'] . '</td>
                              <td>' . $log['id_codigo_custo_veiculo'] . '</td>';
                  echo $descricaoCustoAnterior;
                  echo $descricaoCustoAtual;
                  echo ' <td>' . date('d/m/Y m:i:s', strtotime($log['data_alteracao'])) . '</td></tr>';
                }

                oci_close($connApollo);
                oci_close($connBpmgp);
                oci_close($connNbs);
                ?>
              </tbody>
            </table>
            <div class="text-left py-2">
              <a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>