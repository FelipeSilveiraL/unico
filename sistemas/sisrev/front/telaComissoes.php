<?php

require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../../../config/session.php');

$msg = $_GET['msg'];



?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>COMISSAO ENTRE SEMINOVOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">departamentos</a></li>
        <li class="breadcrumb-item"><a href="pecas.php?pg=<?= $_GET['pg'] ?>">peças</a></li>
        <li class="breadcrumb-item">COMISSAO ENTRE SEMINOVOS</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="ri-error-warning-line"></i> Atenção! Verifique com atenção! Alguns vendedores podem não estar cadastrados no BPMGP, clique no icone para verificar os vendedores não cadastrados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> <br>
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body" style="margin-bottom:15px;">
            <br>
            <!-- Browser Default Validation -->
            <form class="row g-3 " action="../inc/buscaComissao.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <div class="col-md-4 text-center">
                <h5 class="card-title" style="margin-top: -20px;float:left;">Selecione a data:</h5>
                <label for="validationDefault01">Período</label>
                <input type="date" class="form-control" id="validationDefault01" name="dateCom" required>
              </div>
              <div class="col-md-4 text-center" style="margin-top: 30px;">
                <label for="validationDefault02">A</label>
                <input type="date" class="form-control" id="validationDefault02" name="dateFim" required>
              </div>
              <br>
              <div class="col-lg-3" style="margin-top:53px;">
                <button class="btn btn-primary" type="submit" onclick="teste()">Enviar</button>
                
              </div>

            <!-- End Browser Default Validation -->
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
        <div class="card-body" >
            <a href="../inc/relatorioVendedoresBPM.php" class="btn btn-info btn-sm" style="margin-top: 5px;margin-left: 401px;">
              <i class="bx bxs-report"></i>
            </a>
            <h5 class="card-title" style="margin-top: -30px;">Arquivo gerado com sucesso!</h5>
            <!-- List group with active and disabled items -->
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><code>Data:</code> <?= $today = date("d/m/y H:i:s");  ?></li>
              <li class="list-group-item"><code>Arquivo:</code> <a href="../documentos/COM/Relatório_revenda_usados.pdf" rel="file PDF">Relatório Revenda usados.pdf</a></li>
              <li class="list-group-item"><code>Arquivo:</code> <a href="../documentos/COM/Relatório_comissao_revenda.pdf" rel="file PDF">Relatório Comissao Revenda.pdf</a></li>
            </ul><!-- End Clean list group -->

          </div>
        </div>
      </div>
    </form>
    <div class="col-lg-12" style="display: none" id="carregamento">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Aguarde, estamos gerando o relatório</h5>

          <!-- Progress Bars with Striped Backgrounds-->
          <div class="progress mt-3">
            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated process-pe" id="barracarregamento" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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

<script>
  function atualizar() {
    document.location.reload(true);
  }

  function teste() {
    var value = document.getElementById("arquivo").value;

    if ((value != '')) {
      document.getElementById("carregamento").style.display = "block";
    }

  }
</script>