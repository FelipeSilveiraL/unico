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
    <h1>CUSTO VEICULOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item">CUSTO VEICULOS</li>

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
          <div class="card-header">
            <a href="novaRegraCusto.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>
            <a href="historicoCVeiculos.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-warning" style="float: right;margin-left:10px;" title="Histórico registros alterados" <?= $usuarioFuncao ?> ><i class="bx bx-edit"></i></a>
            <a href="../inc/relatorioCustoEspecifico.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel" <?= $usuarioFuncao ?> ><i class="ri-file-excel-2-fill" ></i></a>
          </div>
          
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">TIPO DE CUSTO</th>
                  <th scope="col" class="capitalize">ANO REFERÊNCIA</th>
                  <th scope="col" class="capitalize">CUSTO ERP</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÂO</th>
                </tr>
              </thead>
              <tbody>
                <?php

                    $resultCustoVeiculo = $conn->query($queryCustoVeiculo);

                    while (($custoVeiculo= $resultCustoVeiculo->fetch_assoc())) {

                      if ($custoVeiculo['SISTEMA'] == 'A') {

                          //######################### APOLLO #########################

                          $queryApollo = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE empresa = " . $custoVeiculo['EMPRESA_APOLLO'] . " AND despesa = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
                        
                          $resultadoAPollo = $conn->query($queryApollo);

                          if ($empresaAPollo = $resultadoAPollo->fetch_assoc() ) {
                              $descricaoCusto = '<td>' . $empresaAPollo['DES_DESPESA'] . ' [ '. $empresaAPollo['DESPESA'] .' ]</td>';
                          }
                         
                      } else {

                          //######################### NBS #########################

                          $queryNBS = "SELECT DESCRICAO_CUSTO, CODIGO_CUSTO FROM bpm_custo_especificos WHERE COD_EMPRESA = " . $custoVeiculo['EMPRESA_NBS'] . " AND codigo_custo = " . $custoVeiculo['CODIGO_CUSTO_ERP'];
                          
                          $resultadoNBS = $conn->query($queryNBS);

                          if (($empresaNBS = $resultadoNBS->fetch_assoc() )) {
                              $descricaoCusto = '<td>' . $empresaNBS['DESCRICAO_CUSTO'] . ' [ '. $empresaNBS['CODIGO_CUSTO'] .' ]</td>';
                          }
                      }

                      switch ($custoVeiculo['TIPO_CUSTO']) {
                          case 'L':
                              $tipoCusto = 'Licenciamento';
                              break;
                          case 'M':
                              $tipoCusto = 'Multa';
                              break;
                          case 'T':
                              $tipoCusto = 'Triagem';
                              break;
                          case 'I';
                              $tipoCusto = "IPVA";
                              break;
                      }

                      echo '<tr>';
                      echo '<td>' . $custoVeiculo['ID_CODIGO_CUSTO_VEICULO'] . '</td>';
                      echo '<td>' . $custoVeiculo['NOME_EMPRESA'] . '</td>';
                      echo '<td>' . $tipoCusto . '</td>';
                      echo '<td>' . $custoVeiculo['ANO_REFERENCIA'] . '</td>';
                      echo $descricaoCusto;
                      echo '<td ' . $usuarioFuncao . '><a href="editCustoEspecifico.php?pg=' . $_GET["pg"] . '&id_conta=' . $custoVeiculo['ID_CODIGO_CUSTO_VEICULO'] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                      <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarCVeiculos.php?pg='.$_GET['pg'].'&id_codigo=' . $custoVeiculo['ID_CODIGO_CUSTO_VEICULO'] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a></td>
                     </tr>';
                    }

                ?>
              </tbody>
            </table>
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