<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>MANUTENÇÃO SMARTSHARE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item">MANUTENÇÃO SMARTSHARE</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-sm-3">
        <a href="seminovos.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">SEMINOVOS</h5>
            </div>
          </div>
        </a>
      </div>
      
      <div class="col-sm-3">
        <a href="contasBancarias.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">CONTAS BANCÁRIAS</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3">
          <a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">CUSTO VEICULOS</h5>
              </div>
            </div>
          </a>
        </div>
    </div>

    <hr style="margin-top: 20px; opacity: 0;" > <!-- Repetir a cada 4 div  -->
    
  </section>
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>