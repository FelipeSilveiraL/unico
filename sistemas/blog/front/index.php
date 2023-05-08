<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Home</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
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

          <div class="col-lg-3 py-2">
            <a href="postagens.php?pg=2" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Minhas postagens</h5>

                </div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 py-2">
            <a href="comentarios.php?pg=3" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Comentários</h5>

                </div>
              </div>
            </a>
          </div>

          <div class="col-lg-3 py-2">
            <a href="novaPostagem.php?pg=4" class="list-group-item list-group-item-action">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Nova postagem</h5>

                </div>
              </div>
            </a>
          </div>

        </div>

      </section>

    </div>

  </section>


</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>