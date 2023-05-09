<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Minhas postagens</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Minhas postagens</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">
            <a href="novaPostagem.php?pg=4<?= $_GET['pg'] ?>" class="btn btn-success buttonAdd" title="Nova postagem"><i class="bx bxs-file-plus"></i></a>
          </div>
          <div class="card-body">
            <h5 class="card-title">Minhas postagens<span style="margin-right: 5px;"></span><i class="bi bi-journal-bookmark"></i></h5>

            <p></p>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">Título</th>
                  <th scope="col" class="capitalize">Imagem/Video</th>
                  <th scope="col" class="capitalize">Mensagem</th>
                  <th scope="col" class="capitalize">Data postagem</th>
                  <th scope="col" class="capitalize">Data exclusão</th>
                  <th scope="col" class="capitalize">Ação</th>
                </tr>
              </thead>
              <tbody>
                <!-- Adicionar o body -->
              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>



</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>