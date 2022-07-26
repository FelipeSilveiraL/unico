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
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <form action="<?= $form ?>" method="post">
              <h5 class="card-title">Editando <?= $nome ?></h5>

              <div class="row mb-3" style="display: <?= $displayNome ?>;">
                <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="nome" type="text" class="form-control" id="nome" value="<?= $dados['nome'] ?>">
                </div>
              </div>

              <div class="row mb-3" style="display: <?= $displayCNPJ ?>;">
                <label for="cnpj" class="col-md-4 col-lg-3 col-form-label">CNPJ:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="cnpj" type="text" class="form-control" id="cnpj" value="<?= $dados['cnpj'] ?>">
                </div>
              </div>

              <div class="modal-footer">
                <a href="dropdowns.php?pg=<?=$_GET['pg']?>&conf=<?=$_GET['conf']?>&menu=<?=$_GET['menu']?>&drop=<?=$_GET['drop']?>" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-<?=$corButton?>"><?=$nomeButton?></button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>