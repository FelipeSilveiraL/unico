<?php
require_once('head.php'); //CSS e Departamentos HTML e session start
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Departamentos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Departamentos</li>
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
        $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = ".$_GET['pg']." AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);
        $merge = array_merge($queryModulosUser, $queryModulosUser2);
        $queryModulosM = $merge[0] . $merge[1]; 
        
        $resultadoModulosM = $conn->query($queryModulosM);

        while ($modulosM = $resultadoModulosM->fetch_assoc()) {
          echo '<div class="col-sm-3">
                  <a href="'.$modulosM['endereco'].'?pg='.$modulosM['sub_modulo'].'" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">'.$modulosM['nome_modulo'].'</h5>
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
require_once('footer.php'); //Javascript e Departamentos afins
?>