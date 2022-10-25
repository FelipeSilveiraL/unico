<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeCustoVeiculos.php');
require_once('../inc/apiRecebeCustoEspecificos.php');
require_once('../config/query.php');

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>REGISTROS ALTERADOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
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
            <!-- Table with stripped rows -->
            <table class="table datatable">
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
                      FROM bpm_codigo_custo_veiculo ccv
                      LEFT JOIN bpm_empresas e on ccv.ID_EMPRESA = e.ID_EMPRESA WHERE ccv.ID_CODIGO_CUSTO_VEICULO = " . $log['id_codigo_custo_veiculo'];
                   
                      $resultCustoVeiculo = $conn->query($queryCustoVeiculo);

                      while ($custoVeiculo = $resultCustoVeiculo->fetch_assoc()) {

                          if ($custoVeiculo['SISTEMA'] == 'A') {

                              //######################### APOLLO #########################

                              //anterior
                              $queryApolloAn = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE EMPRESA = " . $custoVeiculo['EMPRESA_APOLLO'] . " AND DESPESA = " . $log['custo_erp_anterior'];
                            
                              $resultadoAPolloAn = $conn->query($queryApolloAn);

                              if ($empresaAPolloAN = $resultadoAPolloAn->fetch_assoc()) {
                                  $descricaoCustoAnterior = $descricaoCusto = '<td>' . $empresaAPolloAN['DES_DESPESA'] . ' [ '. $empresaAPolloAN['DESPESA'] .' ]</td>';
                              }
                              //atual
                              $queryApolloAt = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE EMPRESA = " . $custoVeiculo['EMPRESA_APOLLO'] . " AND DESPESA = " . $log['custo_erp_atual'];
                              
                              $resultadoAPolloAt = $conn->query($queryApolloAt);

                              if ($empresaAPolloAt = $resultadoAPolloAt->fetch_assoc()) {
                                  $descricaoCustoAtual = $descricaoCusto = '<td>' . $empresaAPolloAt['DES_DESPESA'] . ' [ '. $empresaAPolloAt['DESPESA'] .' ]</td>';
                              }


                          } else {

                              //######################### NBS #########################

                              $queryNBS = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM bpm_custo_especificos WHERE COD_EMPRESA = " . $custoVeiculo['EMPRESA_NBS'] . " AND CODIGO_CUSTO = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
                              
                              $resultadoNBS = $conn->query($queryNBS);

                              if ($empresaNBS = $resultadoNBS->fetch_assoc()) {
                                  $descricaoCusto = '<td>' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ ' . $empresaNBS['CODIGO_CUSTO'] . ' ]</td>';
                              }
                          }
                      }

                      echo '<tr>
                              <td>' . $log['id'] . '</td>
                              <td>' . $log['nome_usuario'] . '</td>
                              <td>' . $log['departamento'] . '</td>
                              <td>' . $log['empresa'] . '</td>
                              <td>' . $log['id_codigo_custo_veiculo'] . '</td>';
                              echo $descricaoCustoAnterior;
                              echo $descricaoCustoAtual;
                      echo' <td>' . date('d/m/Y m:i:s', strtotime($log['data_alteracao'])) . '</td>
                          </tr>';
                  }
                  ?>
              </tbody>
            </table>
            <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/custoVeiculos.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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