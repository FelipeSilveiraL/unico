<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item">NF</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-sm-3">
        <a href="aprovadoresNF.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">APROVADORES NF</h5>
            </div>
          </div>
        </a>
      </div>
      
      <div class="col-sm-3">
        <a href="departamentoNF.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">DEPARTAMENTO NF</h5>
            </div>
          </div>
        </a>
      </div>
    
      <div class="col-sm-3">
          <a href="nfEmpDep.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">EMPRESA DEPARTAMENTO NF</h5>
              </div>
            </div>
          </a>
      </div>
    
      <div class="col-sm-3">
          <a href="gestorNF.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">SUBSTITUIR GESTOR NF</h5>
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