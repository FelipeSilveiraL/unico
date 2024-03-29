<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Central de ajuda</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Ajuda</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row align-items-top">
      <div class="col-lg-12">

        <!-- Default Card -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Central de ajuda</h5>
            Está em fase de manutenção, porém se precisar de ajuda ligue para o TI (<a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/lista/filiais/index.php?dep=1,89" target="_blank" rel="noopener noreferrer">Lista Ramais</a>) ou abra um chamado no GLPI (Link no rodapé)
          </div>
        </div><!-- End Default Card -->
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>