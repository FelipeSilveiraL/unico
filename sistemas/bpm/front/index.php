<?php
session_start();
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

    <!--MODULOS-->
    <?php
    $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 1 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

    $merge = array_merge($queryModulosUser, $queryModulosUser2);
    $queryModulosM = $merge[0] . $merge[1];
    
    $a = $conn->query($queryModulosM);

    if ($liberado = $a->fetch_assoc()) {
      echo '<h5 class="card-title"><span>| Módulos</span></h5>';
    }
    ?>

    <div class="row">
      <?php
      $resultadoModulosM = $conn->query($queryModulosM);

      while ($modulosM = $resultadoModulosM->fetch_assoc()) {
        echo '<div class="col-sm-3">
                  <a href="' . $modulosM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">' . $modulosM['nome_modulo'] . '</h5>
                      </div>
                    </div>
                  </a>
                </div>';
      }
      ?>
    </div>

    <!--TELAS-->
    <?php
    unset($queryModulosUser2);
    $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 2 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

    $merge = array_merge($queryModulosUser, $queryModulosUser2);
    $queryModulosM = $merge[0] . $merge[1];

    $resultadoModulosM = $conn->query($queryModulosM);

    if ($liberado = $resultadoModulosM->fetch_assoc()) {
      echo '<h5 class="card-title" style="margin-top: 10px;"><span>| Telas</span></h5>';
    }
    ?>
    <div class="row">
      <?php
      $resultadoModulosM = $conn->query($queryModulosM);

      while ($modulosM = $resultadoModulosM->fetch_assoc()) {
        echo '<div class="col-sm-3">
                    <a href="' . $modulosM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '" class="list-group-item list-group-item-action">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">' . $modulosM['nome_modulo'] . '</h5>
                        </div>
                      </div>
                    </a>
                  </div>';
      }
      ?>
    </div>

    <!--OUTROS-->
    <?php
    unset($queryModulosUser2);
    $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 3 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

    $merge = array_merge($queryModulosUser, $queryModulosUser2);
    $queryModulosM = $merge[0] . $merge[1];

    $a = $conn->query($queryModulosM);

    if ($liberado = $a->fetch_assoc()) {
      echo '<h5 class="card-title"><span>| Outros</span></h5>';
    }
    ?>

    <div class="row">
      <?php
      $resultadoModulosM = $conn->query($queryModulosM);

      while ($modulosM = $resultadoModulosM->fetch_assoc()) {
        echo '<div class="col-sm-3">
                  <a href="' . $modulosM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">' . $modulosM['nome_modulo'] . '</h5>
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