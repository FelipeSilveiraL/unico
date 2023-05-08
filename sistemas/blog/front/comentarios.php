<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Comentários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Comentários</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comentários<span style="margin-right: 4px;"></span><i class="bx bx-message-rounded-detail"></i></a></h5>

      <!-- List group With badges -->
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A list item
          <span class="badge bg-primary rounded-pill">0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A second list item
          <span class="badge bg-primary rounded-pill">0</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          A third list item
          <span class="badge bg-primary rounded-pill">0</span>
        </li>
      </ul><!-- End List With badges -->

    </div>
  </div>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>