<?php
session_start();

require_once('../config/databases.php'); //Banco de dados
require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
require_once('head.php'); //CSS e configurações HTML
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina

//Informações
require_once('../api/api.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>API</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item"><a href="api.php?pg=<?=$_GET['pg']?>&conf=<?=$_GET['conf']?>">api</a></li>
        <?= $menu ?>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->

  <section class="section" style="display: <?= empty($_GET['menu']) ? 'block' : 'none' ?>;">
  
    <div class="row">
      <div class="col-lg-6">
        <a href="api.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&menu=1" class="list-group-item list-group-item-action">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Selbetti</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

  </section>

  <section class="section" style="display: <?= empty($_GET['menu']) ? 'none' : 'block' ?>;">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">API <?=$nome?></h5>
            <p><div class="fw-bold">Documentação:</div> <?= $documentacao ?></p>
            <p><div class="fw-bold">URL chamadas:</div> <?= $urlAPI ?></p>

            <h5 class="card-title">Outras informações</h5>
            <!-- List group with active and disabled items -->
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><div class="fw-bold">status API: </div><?=$status?></li>
              <li class="list-group-item"><div class="fw-bold">dsCliente:</div> <?=$dsCliente?></li>
              <li class="list-group-item"><div class="fw-bold">dsChaveAutenticacao:</div> <?=$dsChaveAutenticacao?></li>
              <li class="list-group-item"><div class="fw-bold">dsUsuario:</div> integra.usuario</li>
              <li class="list-group-item"><div class="fw-bold">dsSenha:</div> <?=$dsUsuario?></li>
              <li class="list-group-item"><div class="fw-bold">token:</div> <?=$tokenUsuarioSelbetti?></li>
            </ul><!-- End Clean list group -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php
  require_once('footer.php'); //Javascript e configurações afins
?>