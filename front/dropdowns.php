<?php
session_start();
require_once('../config/databases.php'); //Banco de dados
require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
require_once('head.php'); //CSS e configurações HTML
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/drop.php'); //$_GET['drop'] OU $_GET['menu']
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Menu suspenso</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Configurações</li>
        <?= $breadcrumbsMenu ?>
        <?= $breadcrumbs ?>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->
  <section class="section" <?= $display ?>>

    <div class="row">
      <div class="col-lg-6">
        <a href="dropdowns.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&menu=1&drop=1" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Empresa</h5>
            </div>
          </div>
        </a>
      </div>

      <div class="col-lg-6">
        <a href="dropdowns.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&menu=1&drop=2" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Departamento</h5>
            </div>
          </div>
        </a>
      </div>

    </div>
  </section>
  <section class="section" <?= $displayDrop ?>>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              <?= $nome ?>
              <a href="dropdownsAcao.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&menu=<?= $_GET['menu'] ?>&drop=<?= $_GET['drop'] ?>&acao=3" class="btn btn-success" style="margin-left: <?=$marginLeftBotao?>"><i class="bi bi-plus"></i></a>
            </h5>
           <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <?php
                    foreach ($colunas as $nome => $value) {
                      echo '<th scope="col">' . $value . '</th>';
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?= $linha ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php
  require_once('footer.php'); //Javascript e configurações afins
?>