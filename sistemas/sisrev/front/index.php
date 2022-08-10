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

    <h5 class="card-title"><span>| Módulos</span></h5>
    <div class="row">
      <?php  
        $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 1 and deletar = 0";
        $resultadoModulosM = $conn->query($queryModulosM);

        while ($modulosM = $resultadoModulosM->fetch_assoc()) {
          echo '<div class="col-sm-3">
                  <a href="'.$modulosM['endereco'].'" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">'.$modulosM['nome'].'</h5>
                      </div>
                    </div>
                  </a>
                </div>';
        }
        ?>
    </div>

    <h5 class="card-title" style="margin-top: 10px;"><span>| Telas</span></h5>
    <div class="row">
      <?php 
        $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 2 and deletar = 0";
        $resultadoModulosM = $conn->query($queryModulosM);

        while ($modulosM = $resultadoModulosM->fetch_assoc()) {
          echo '<div class="col-sm-3">
                  <a href="'.$modulosM['endereco'].'" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">'.$modulosM['nome'].'</h5>
                      </div>
                    </div>
                  </a>
                </div>';
        }
      ?>      
    </div>

    <h5 class="card-title" style="margin-top: 10px;"><span>| Outros</span></h5>
    <div class="row">
      <?php 
        $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 3 and deletar = 0";
        $resultadoModulosM = $conn->query($queryModulosM);

        while ($modulosM = $resultadoModulosM->fetch_assoc()) {
          echo '<div class="col-sm-3">
                  <a href="'.$modulosM['endereco'].'" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">'.$modulosM['nome'].'</h5>
                      </div>
                    </div>
                  </a>
                </div>';
        }
      ?>      
    </div>

  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>