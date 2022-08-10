<?php
require_once('head.php'); //CSS e Departamentos HTML e session start
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Departamentos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Departamentos</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section>
    <div class="row">
      <section class="section">

        <div class="row">

          <div class="col-lg-3 py-2">
            <a href="informatica.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Informática</h5>
                </div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 py-2">
            <a href="administracao.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Administração</h5>
                </div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 py-2">
            <a href="pecas.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Peças</h5>
                </div>
              </div>
            </a>
          </div>

        </div>

      </section>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e Departamentos afins
?>