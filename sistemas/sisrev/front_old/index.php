<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Home</h1>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <h5 class="card-title"><span>| Departamentos</span></h5>
    <div class="row">
      <div class="col-sm-3">
        <a href="informatica.php" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Informática</h5>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3">
        <a href="administracao.php" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Administração</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3">
        <a href="pecas.php" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Peças</h4>
            </div>
          </div>
        </a>
      </div>
    </div>
    <h5 class="card-title" style="margin-top: 10px;"><span>| Paginas</span></h5>

    <div class="row">

      <div class="col-sm-3">
        <a href="configuracao.php" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Configurações</h4>
            </div>
          </div>
        </a>
      </div>

      <div class="col-sm-3">
        <a href="ajuda.php" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ajuda</h4>
            </div>
          </div>
        </a>
      </div>
      
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>