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
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
        <?php  
        $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = ".$_GET['pg']." AND deletar = 0";
        $resultadoModulosM = $conn->query($queryModulosM);

        while ($modulosM = $resultadoModulosM->fetch_assoc()) {
          echo '<div class="col-sm-3">
                  <a href="'.$modulosM['endereco'].'?pg='.$modulosM['sub_modulo'].'" class="list-group-item list-group-item-action">
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
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>