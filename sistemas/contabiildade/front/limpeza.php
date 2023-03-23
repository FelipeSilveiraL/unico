<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Fluxo SmartShare</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Fluxo SmartShare</li>
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
            <h5 class="card-title">Localizando uma solicitação dentro do SmartShare para realizar a limpeza.</h5><br>

            <!-- Horizontal Form -->
            <form method="POST" action="../inc/limpeza.php?pg=<?= $_GET['pg'] ?>">
              <div class="col-md-4" id="nomeFuncionario">
                <label for="inputName5" class="form-label">Número solicitação:</label>
                <input type="number" class="form-control" name="numeroSolicitacao">
              </div>

              <div class="text-center" style="margin-top: 25px; margin-bottom: 10px;">
                <button type="submit" class="btn btn-success" id="localizar">
                  Localizar <i class="bi bi-search"></i>
                </button>
              </div>
            </form><!-- End Horizontal Form -->

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