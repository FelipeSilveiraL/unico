<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Configurações</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Configurações</li>
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
            <a href="telas_funcoes.php?pg=<?=$_GET['pg']?>&tela=<?=$_GET['tela']?>" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Telas e funções</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 py-2">
            <a href="usuarios.php?pg=<?=$_GET['pg']?>&tela=<?=$_GET['tela']?>" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Usuários</h5>
                </div>
              </div>
            </a>
          </div>
      </section>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>