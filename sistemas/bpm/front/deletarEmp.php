<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/deletaremp.php');
require_once('../../../config/config.php');

?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>DELETAR REGRA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
        <li class="breadcrumb-item"><a href="empresas.php?pg=<?= $_GET['pg'] ?>">EMPRESAS</a></li>
        <li class="breadcrumb-item">Deletar Nova Regra</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Informações</h5>

      <!-- Table with stripped rows -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="capitalize">EMPRESA</th>
            <th scope="col" class="capitalize">SISTEMA</th>
            <th scope="col" class="capitalize">EMP NBS</th>
            <th scope="col" class="capitalize">CONSÓRCIO</th>
            <th scope="col" class="capitalize">EMPRESA APOLLO</th>
            <th scope="col" class="capitalize">REVENDA APOLLO</th>
            <th scope="col" class="capitalize">ORGANOGRAMA SENIOR</th>
            <th scope="col" class="capitalize">EMPRESA SENIOR</th>
            <th scope="col" class="capitalize">FILIAL SENIOR</th>
          </tr>
        </thead>
        <tbody>
          <?= $mostra; ?>
        </tbody>
      </table>
      <!-- End Table with stripped rows -->
      <div class="text-center py-2">
        <a href="empresas.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
        <input type="hidden" name="deletar" value="1">
        <button type="submit" data-bs-toggle="modal" data-bs-target="#verticalycentered" class="btn btn-danger">Deletar</button>
      </div>
    </div>
  </div>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<!-- Vertically centered Modal -->

<div class="modal fade" id="verticalycentered" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span style="color: red">
          <h4>ATENÇÃO <i class="bi bi-exclamation-circle-fill"></i></h4>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja mesmo deletar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/deletarEmp.php?pg=<?= $_GET['pg'] ?>&id=<?= $ID_EMPRESA ?>" class="btn btn-danger">Deletar</a>
      </div>
    </div>
  </div>
</div><!-- End Vertically centered Modal-->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>