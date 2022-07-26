<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Cadastro de telas e funções</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php">Configurações</a></li>
        <li class="breadcrumb-item">Telas e Funções</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>
  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"></h5>
        <!-- Default Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link <?php if($_GET['f'] == NULL) {echo 'active';} ?>" id="telas-tab" data-bs-toggle="tab" data-bs-target="#telas" type="button" role="tab" aria-controls="telas" aria-selected="true">Telas</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link <?php if($_GET['f'] != NULL) {echo 'active';} ?>" id="funcoes-tab" data-bs-toggle="tab" data-bs-target="#funcoes" type="button" role="tab" aria-controls="funcoes" aria-selected="false">Funções</button>
          </li>
        </ul>
        <div class="tab-content pt-2" id="myTabContent">
          <?php
            require_once('../inc/telas.php');
          ?>
          <?php
            require_once('../inc/funcoes.php');
          ?>
        </div><!-- End Default Tabs -->
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>