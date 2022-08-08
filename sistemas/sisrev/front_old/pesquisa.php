<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

echo $_POST['pesquisa'] == NULL ? '<script>window.location.href = "index.php";</script>' : '';
$queryModulos = "SELECT * FROM sisrev_modulos WHERE nome like '%" . $_POST['pesquisa'] . "%' AND deletar = 0";
$resultModulos = $conn->query($queryModulos);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pesquisando por - <?= $_POST['pesquisa'] ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item">Pesquisa</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <br>
      <?php

      while ($modulo = $resultModulos->fetch_assoc()) {
        echo '<div class="col-lg-3"> 
                <a href="'.$modulo['endereco'].'" class="list-group-item list-group-item-action">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title capitalize">'.$modulo['nome'].'</h5>
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