<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
if (!empty($_GET['empresa'])) { require_once('../inc/pdfTabelaPrecos.php');}
require_once('../inc/tabelaAtualizarPreco.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Atualizar preço peças</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="pecas.php">Peças</a></li>
        <li class="breadcrumb-item">Atualizar Preço Peças</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section" style="display: <?= $displayAtualizaOne ?>;">
    <div class="row">
      <div class="col-lg-12 col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">

          <div class="card-body">
            <h5 class="card-title">Escolha Empresa</h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#trduc" type="button" role="tab" aria-controls="triumphDucati" aria-selected="true">Triumph / Ducati</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#honda" type="button" role="tab" aria-controls="honda" aria-selected="false">Honda</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">

              <!--triumph / ducati-->
              <div class="tab-pane fade active show" id="trduc" role="tabpanel" aria-labelledby="home-tab">
                <div class="row py-2 mb-3">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">
                        <div class="filter" style="margin-top: 10px;margin-left: 96%;">
                          <a class="icon" href="logAtualizacaoPecas.php?empresa=1" title="Logs anteriores">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                          </a>
                        </div>
                        <form class="row g-3" id="formularioAtualizarPreco" action="../inc/atualizarPreco.php?pg=<?= $_GET['pg'] ?>" method="post" enctype="multipart/form-data">
                          <!--DADOS PARA O LANÇAMENTO -->
                          <h5 class="card-title">Atualizar preço peças</h5>

                          <div class="form-floating mb-3 col-md-5">
                            <select class="form-select" id="floatingSelect" name="empresa" required>
                              <option value="">-------------</option>
                              <option value="56">Ducati</option>
                              <option value="55">Triumph</option>
                            </select>
                            <label for="floatingSelect" class="capitalize">Selecione empresa</label>
                          </div>

                          <div class="form-floating mb-3 col-md-5">
                            <select class="form-select" id="floatingSelect" name="forcarPreco" required>
                              <option value="">-------------</option>
                              <option value="1">SIM</option>
                              <option value="2">NÂO</option>
                            </select>
                            <label for="floatingSelect" class="capitalize">Atualizar preço valor menor?</label>

                            <div id="ques" style="margin-left: 286px;margin-top: -42px;">
                              <a href="javascrpt:" data-bs-toggle="modal" data-bs-target="#questAtualizar">
                                <i class="bi bi-question-circle"></i>
                              </a>
                            </div>
                          </div>

                          <h5 class="card-title">Lista a atualizar!</h5>

                          <div class="row mb-3">
                            <div class="col-sm-10">
                              <input class="form-control" type="file" id="formFile" name="arquivo" required>
                              <code>Tipo de arquivo permitido[.xlsx]</code>
                            </div>
                          </div>


                          <h5 class="card-title">Outras informações</h5>

                          <div class="row mb-6">
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1" name="relatorio" value="1" onclick="rel()">
                                <label class="form-check-label" for="gridCheck1">
                                  Gerar apenas relatório.
                                  <div id="ques" style="margin-left: 180px;margin-top: -23px;">
                                    <a href="javascrpt:" data-bs-toggle="modal" data-bs-target="#questRelatorio">
                                      <i class="bi bi-question-circle"></i>
                                    </a>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>

                          <!-- BOTÃO DO FORMULARIOS -->
                          <div class="text-left  mb-3">
                            <hr>
                            <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                            <input type="button" class="btn btn-success" id="submitInput" value="Atualizar peças" onclick="sub()">
                          </div>
                        </form><!-- FIM Form -->
                      </div><!-- FIM card-body -->
                    </div><!-- FIM card -->
                  </div><!-- FIM col-lg-12 -->
                </div>
              </div>

              <!--HONDA-->
              <div class="tab-pane fade" id="honda" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row py-2 mb-3">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">

                        <div class="filter" style="margin-top: 10px;margin-left: 96%;">
                          <a class="icon" href="logAtualizacaoPecas.php?empresa=2" title="Logs anteriores">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                          </a>
                        </div>

                        <form class="row g-3" action="../inc/atualizarPreco.php?pg=<?= $_GET['pg'] ?>" method="post" enctype="multipart/form-data">
                          <!--DADOS PARA O LANÇAMENTO -->
                          <h5 class="card-title">Atualizar preço peças</h5>

                          <div class="col-sm-8">
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1">Data histórico a retornar</span>
                              <input type="date" class="form-control" name="dataHistorico" aria-describedby="basic-addon1">
                              <input type="text" name="empresa" id="empresaHonda" value="10" style="display: none;">
                            </div>
                          </div>

                          <h5 class="card-title">Outras informações</h5>

                          <div class="row mb-6">
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck2" name="relatorio" value="1">
                                <label class="form-check-label" for="gridCheck2">
                                  Gerar apenas relatório.
                                  <div id="ques" style="margin-left: 180px;margin-top: -23px;">
                                    <a href="javascrpt:" data-bs-toggle="modal" data-bs-target="#questRelatorio">
                                      <i class="bi bi-question-circle"></i>
                                    </a>
                                  </div>
                                </label>
                              </div>
                            </div>
                          </div>
                          <!-- BOTÃO DO FORMULARIOS -->
                          <div class="text-left  mb-3">
                            <hr>
                            <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                            <button type="submit" class="btn btn-success">Continuar</button>
                          </div>
                        </form><!-- FIM Form -->
                      </div><!-- FIM card-body -->
                    </div><!-- FIM card -->
                  </div><!-- FIM col-lg-12 -->
                </div>
              </div>
            </div><!-- End Default Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="section" style="display: <?= $displayAtualizaTwo ?>;">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lista de peças - <?= $nomeEmpresa ?></h5>

            <!-- Table with stripped rows -->
            <form action="" method="post" class="row g-3">
              <table class="table datatable">
                <?= $tabela ?>
              </table>


              <!-- BOTÃO DO FORMULARIOS -->
              <div class="text-left  mb-3">
                <hr>
                <a href="atualizarPreco.php?pg=2" class="btn btn-secondary">Voltar</a>
                <a href="../documentos/AP/relatorio.xlsx" class="btn btn-success" download>Exportar excel</a>
              </div>
            </form>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<div class="modal fade" id="questAtualizar" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atualizar preço valor menor? - O QUE QUER DIZER ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><i class="bi bi-pin-angle"></i> Marcou <code>"SIM"</code>, então o sistema <b>irá atualizar todos os preços</b> do APOLLO indiferente se o valor que esta no arquivo é menor do que está no APOLLO</p>
        <p><i class="bi bi-pin-angle"></i> Marcou <code>"NÂO"</code>, o sistema <b>não irá atualizar os preços</b> de peça que for menor do que está no APOLLO.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

<div class="modal fade" id="questRelatorio" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Emitir apenas relatório - O QUE QUER DIZER ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><i class="bi bi-pin-angle"></i> Irá apenas gerar uma lista contendo dados do arquivo, porém </p>
        <p><code>NÃO IRÁ ATUALIZAR NENHUM DADO NO APOLLO</code></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->
<script>
  function rel() {

    var check = document.getElementById("gridCheck1").checked;

    if (check == true) {
      document.getElementById("submitInput").value = "Gerar relatório";
    } else {
      document.getElementById("submitInput").value = "Atualizar peças";
    }

  }

  function sub() {
    document.getElementById("formularioAtualizarPreco").submit();
  }
</script>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>