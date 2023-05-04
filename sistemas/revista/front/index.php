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

  <section class="section">
    <div class="row">
      <div class="col-lg-12"> 

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nova revista acelera</h5>

            <!-- Multi Columns Form -->
            <form method="POST" action="../inc/index.php?pg=<?= $_GET['pg'] ?>" enctype="multipart/form-data" class="row g-3">
              <div class="col-md-3">
                <label for="inputName5" class="form-label">Edição</label>
                <input type="number" class="form-control" name="edicao" id="inputName5" max="100" min="1" title="Número da revista" required>
              </div>
              <div class="col-md-9">
                <label for="inputEmail5" class="form-label">Carregar arquivo .pdf</label>
                <input type="file" name="arquivo" class="form-control" id="inputEmail5" title="Arquivos .pdf" required>
              </div>
              <div class="text-center">
              <button type="reset" class="btn btn-secondary">Limpar</button>
              <button type="submit" class="btn btn-success">Salvar</button>
                
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>

        </form><!-- End General Form Elements -->

      </div>
    </div>

    </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>