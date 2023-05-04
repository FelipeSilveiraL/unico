<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/regras_pe.php');
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Politicamente Exposto</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="informatica.php?pg=<?= $_GET['pg'] ?>">Informática</a></li>
        <li class="breadcrumb-item">Politicamente exposto</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>
  <section class="section">
    <div class="row">
      <div class="col-lg-6" style="display: <?= $displayOne ?>">
        <div <?= $usuarioFuncao ?>>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Carregar arquivo</h5>
              <!-- General Form Elements -->
              <div class="header d-flex align-items-center header-scrolled">
                <div class="search-bar">
                  <form class="search-form d-flex align-items-center" method="post" action="../inc/politicamente_exposto.php?pg=<?= $_GET['pg'] ?>" enctype="multipart/form-data">
                    <input type="file" name="arquivo" placeholder="Insira Documento" id="arquivo" required>
                    <button type="submit" title="Enviar" class="btn btn-success" onclick="teste()"><i class="bi bi-send"></i></button>
                  </form>
                </div>
              </div>
              <h6><code>Tipo de arquivo permitido[.csv]</code></h6>
              <!-- End General Form Elements -->
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6" style="display: <?= $displayOne ?>">
        <div class="card">
          <div class="card-body">
            <a href="logPoliticamente.php?pg=<?= $_GET['pg'] ?>" title="Logs Anteriores" class="btn btn-info btn-sm" style="margin-top: 5px;margin-left: 401px;">
              <i class="bx bxs-report"></i>
            </a>
            <h5 class="card-title" style="margin-top: -30px;">Log de execução - Ultima vez</h5>


            <!-- List group with active and disabled items -->
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><code>Autor:</code> <?= $logPE['nome'] ?> <code style="margin-left: 64px;">Data:</code> <?= empty($logPE['data']) ? ' ' : date('d/m/Y H:i:s', strtotime($logPE['data'])) ?></li>
              <li class="list-group-item"><code>Arquivo:</code> <a href="../<?= substr($logPE['caminho'], 36) ?>" target="_blank" rel="file CSV"><?= $logPE['nome_arquivo'] ?></a></li>
            </ul><!-- End Clean list group -->

          </div>
        </div>
      </div>

      <div class="col-lg-12" style="display: <?= $displayTwo ?>">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Leitura efetuada com sucesso</h5>
            <p>Foram encontrados <span class="badge bg-warning"><?= $_SESSION['count'] ?> </span> registros</p>
            <p>Para continuar, basta clicar em <code>Efetuar Carga</code> que irá iniciar a atualização nos seguintes sistemas:</p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">APOLLO</li>
              <li class="list-group-item">NBS</li>
              <li class="list-group-item">NBS RIBEIRÃO</li>
            </ul>
          </div>
          <div class="modal-footer">
            <a href="javascript:" class="btn btn-secondary" onclick="atualizar()">Voltar</a>
            <a href="../inc/politicamente_exposto2.php?pg=<?= $_GET['pg'] ?>&part=1" class="btn btn-primary">Efetuar Carga</a>
          </div>
        </div>
      </div>

      <div class="col-lg-12" style="display: <?= $displayThree ?>">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Resultado da ultima importação</h5>
            <!-- Table with hoverable rows -->
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">id</th>
                  <th scope="col" class="capitalize">sistema</th>
                  <th scope="col" class="capitalize">importados</th>
                  <th scope="col" class="capitalize">encontrado</th>
                  <th scope="col" class="capitalize">não encontrado</th>
                  <th scope="col" class="capitalize">não alterados</th>
                </tr>
              </thead>
              <tbody>
                <?= $tabelaRel ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-12" style="display: none" id="carregamento">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Aguarde, estamos lendo o arquivo</h5>

            <!-- Progress Bars with Striped Backgrounds-->
            <div class="progress mt-3">
              <div class="progress-bar progress-bar-striped bg-success progress-bar-animated process-pe" id="barracarregamento" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>

      </div>
  </section>

</main><!-- End #main -->

<script>
  function atualizar() {
    document.location.reload(true);
  }

  function teste() {
    var value = document.getElementById("arquivo").value;

    if ((value != '')) {
      document.getElementById("carregamento").style.display = "block";
    }

  }
</script>



<?php
unset($_SESSION['count']);
require_once('footer.php'); //Javascript e configurações afins
?>