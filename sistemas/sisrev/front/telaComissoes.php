<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');

/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>COMISSAO ENTRE SEMINOVOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">departamentos</a></li>
        <li class="breadcrumb-item">COMISSAO ENTRE SEMINOVOS</li>
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
            <div class="card-body">
              <br>
              <!-- Browser Default Validation -->
              <form class="row g-3 " action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare']?>/bd/buscaComissao.php?pg=<?= $_GET['pg'] ?>" method="POST">
                <div class="col-md-3 text-center" >
                  <label for="validationDefault01">Período</label>
                  <input type="date" class="form-control" id="validationDefault01" name="dateCom" required>
                </div>
                <div class="col-md-3 text-center" >
                  <label for="validationDefault02">A</label>
                  <input type="date" class="form-control" id="validationDefault02" name="dateFim"  required>
                </div><code>*Relatório emitido com sucesso!*</code>
                <br>
                <div class="col-lg-12 "  >
                  <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
                
              </form><br>
              <!-- End Browser Default Validation -->

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

