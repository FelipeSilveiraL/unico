<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeAprovNF.php');
require_once('../inc/apiRecebeDepNF.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>APROVADORES NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">APROVADORES NF</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->
  <style>
    .status-circle-off {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: grey;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
.status-circle-on {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background-color: greenyellow;
  border: 2px solid white;
  bottom: 0;
  right: 0;
  position: absolute;
}
  </style>
  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <a href="novaRegraApNF.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioAprovadoresNF.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>
          
          <div class="card-body">
            
          <h5 class="card-title">Aprovadores nf</h5>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">DEPART</th>
                  <th scope="col" class="capitalize">FILIAL</th>
                  <th scope="col" class="capitalize">AREA</th>
                  <th scope="col" class="capitalize">MARCA</th>
                  <th scope="col" class="capitalize">GERENTE GERAL</th>
                  <th scope="col" class="capitalize">SUPER INTEN.</th>
                  <th scope="col" width="200" <?= $usuarioFuncao ?> class="text-right">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require_once('../inc/inserindoTabelaAprovNF.php');
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>