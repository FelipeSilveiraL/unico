<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Relatório arquivos da fábrica</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="administracao.php?pg=<?= $_GET['pg'] ?>">Administração</a></li>
        <li class="breadcrumb-item"><a href="processos.php?pg=<?= $_GET['pg'] ?>">Processos fábrica VW</a></li>
        <li class="breadcrumb-item">Relatórios</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">

        <!-- Multi Columns Form -->
        <form class="row g-3" action="../inc/processosFabricaRelatorios.php" method="POST">

          <div class="col-8">
            <h5 class="card-title">Data de movimentação</h5>
          </div>
          <div class="col-4">
            <h5 class="card-title">Data do arquivo</h5>
          </div>

          <div class="col-md-4">
            <label for="inputEmail5" class="form-label">Inicial: </label>
            <input type="date" class="form-control dataMovimentacao" id="dataMovimentacaoInicial" name="dataMovimentacaoInicial">
          </div>
          <div class="col-md-4">
            <label for="inputPassword5" class="form-label">Final: </label>
            <input type="date" class="form-control dataMovimentacao" id="dataMovimentacaoFinal" name="dataMovimentacaoFinal">
          </div>

          <div class="col-md-4">
            <label for="inputAddress5" class="form-label">Data: </label>
            <input type="date" class="form-control dataArquivo" id="dataArquivo" name="dataArquivo">
          </div>

          <!-- <div class="col-12">
            <label for="inputState" class="form-label">Filial: </label>
            <select id="inputState" class="form-select" name="filial">
              <option value="">-------------</option>
            </select>
          </div> -->

          <div class="col-12">
            <label for="inputCity" class="form-label">Tipo relátorio: </label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="fa3" name="fa3">
              <label class="form-check-label" for="fa3">
                FA3 - NF E NF DEBITO EM ABERTO
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="fa4" name="fa4">
              <label class="form-check-label" for="fa4">
                FA4 - EXTARTO CONTA CORRENTE DIARIO
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="flh" name="flh">
              <label class="form-check-label" for="flh">
                FLH - EXTRATO CONTA CORRENTE
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="fnt" name="fnt">
              <label class="form-check-label" for="fnt">
                FNT - NOTA CRED/DEB
              </label>
            </div>
          </div>

          <div class="text-center">
            <button type="reset" class="btn btn-secondary">Limpar</button>
            <button type="submit" class="btn btn-primary">Gerar relátorio</button>
          </div>
        </form><!-- End Multi Columns Form -->

      </div>
    </div>
  </div>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>

<script>
  $(".dataMovimentacao").on("click", function() {
    $(".dataMovimentacao").prop("readonly", false);
    $('#dataArquivo').prop('readonly', true);

  });

  $("#dataArquivo").on("click", function() {
    $('.dataMovimentacao').prop('readonly',true);
    $('#dataArquivo').prop('readonly', false);

  });
</script>