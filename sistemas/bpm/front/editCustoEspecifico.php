<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITANDO CUSTO VEÍCULO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item"><a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>">CUSTO VEÍCULO</a></li>
        <li class="breadcrumb-item">EDITANDO CUSTO VEÍCULO</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body"><br>
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?=$_SESSION['smartshare']?>/bd/editCVeiculos.php?pg=<?= $_GET['pg'] ?>&id_codigo=<?= $_GET['id_conta'] ?>"  id="formularioVeiculos" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php
              $idConta = $_GET['id_conta'];
              $queryCustoVeiculo .= " WHERE ID_CODIGO_CUSTO_VEICULO = ".$idConta." ";
              
              $conexao = $conn->query($queryCustoVeiculo);
              
            while($row = $conexao->fetch_assoc()){

              $idEmpresa = $row['ID_EMPRESA'];
              $nomeEmpresa = $row['NOME_EMPRESA'];
              $tipoCusto = $row['TIPO_CUSTO'];
              $anoReferencia = $row['ANO_REFERENCIA'];
              $custoERP = $row['CODIGO_CUSTO_ERP'];
          
              switch ($row['TIPO_CUSTO']) {
                  case 'L':
                      $tipoCustoNome = 'Licenciamento';
                      break;
                  case 'M':
                      $tipoCustoNome = 'Multa';
                      break;
                  case 'T':
                      $tipoCustoNome = 'Triagem';
                      break;
                  case 'I';
                      $tipoCustoNome = "IPVA";
                      break;
              }
          
        echo' 
              <div class="form-floating mt-4 col-md-6" id="NOME_EMPRESA">
                <select class="form-select" name="empresa" id="empresa" readonly>
                  <option value="'.$idEmpresa.'"> '.$nomeEmpresa.' </option>
                </select>
               <label for="NOME_EMPRESA">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="estados">
                <select class="form-control" name="tipo_custo" readonly>
                      <option value="'.$tipoCusto.'">'.$tipoCustoNome.'</option>
                </select>
                <label for="estados">TIPO DE CUSTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="referencia">
                  <input type="text" class="form-control" id="exampleFormControlInput1" name="ano" onkeydown="javascript: fMasc(this, numero);" maxlength="4" value="'.$anoReferencia.'" readonly>
                  <label for="referencia" class="col-sm-6 col-form-label">ANO REFERENCIA:</label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="custo">
                <select class="form-control" name="erp" id="erp">';
                     
                  $queryEdit = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa WHERE DESPESA = ".$custoERP."";
                          
                  $resultadoEdit = $conn->query($queryEdit);

                  if($empresaEdit = $resultadoEdit->fetch_assoc() ) {
                      echo '<option value="'. $empresaEdit['DESPESA'] .'">' . $empresaEdit['DES_DESPESA'] . ' [ '. $empresaEdit['DESPESA'] .' ]</option>';
                  }

                  echo '<option>---------</option>';    

                  $queryApollo = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa ORDER BY DES_DESPESA ASC";
                          
                  $resultadoAPollo = $conn->query($queryApollo);

                  while($empresaAPollo = $resultadoAPollo->fetch_assoc() ) {
                      echo '<option value="'. $empresaAPollo['DESPESA'] .'">' . $empresaAPollo['DES_DESPESA'] . ' [ '. $empresaAPollo['DESPESA'] .' ]</option>';
                  }
                }

                ?>
                </select>
                <label for="custo" class="col-sm-6 col-form-label">CUSTO ERP:</label>
              </div>
              
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/custoVeiculos.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div>
    </div> <!-- FIM col-lg-12 -->
  </section><!-- FIM section -->
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>