<?php
  require_once('head.php'); //CSS e configurações HTML e session start
  require_once('header.php'); //logo e login e banco de dados
  require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Informática</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item">Informática</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-sm-3"> 
        <a href="desativar_usuario.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Usuários Sistemas</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3"> 
        <a href="empresas.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Empresas</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3"> 
        <a href="politicamente_exposto.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Politicamente exposto</h4>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-3"> 
        <a href="empRev.php?pg=<?= $_GET['pg'] ?>" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Cadastro Filiais</h4>
            </div>
          </div>
        </a>
      </div>
      
      <hr style="margin-top: 20px; opacity: 0;" > <!-- Repetir a cada 4 div  -->
     
    </div>    
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>