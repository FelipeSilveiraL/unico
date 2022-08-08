<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
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

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Escolha Empresa</h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="triumphDucati" aria-selected="true">Triumph / Ducati</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="honda" aria-selected="false">Honda</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
              <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row py-2 mb-3">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                          <!--DADOS PARA O LANÇAMENTO -->
                          <h5 class="card-title">Atualizar preço peças</h5>
                          <div class="form-floating mb-3 col-md-5">
                            <select class="form-select" id="floatingSelect" name="usuarioBPM">
                              <option value="">-------------</option>
                              <option value="1">Ducati</option>
                              <option value="2">Triumph</option>
                            </select>
                            <label for="floatingSelect" class="capitalize">Selecione empresa</label>
                          </div>

                          <div class="form-floating mb-3 col-md-5">
                            <select class="form-select" id="floatingSelect" name="usuarioBPM">
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
                              <input class="form-control" type="file" id="formFile" name="filenota">
                              <div id="ques" style="margin-left: 554px;margin-top: -33px;margin-bottom: 11px;">
                                <a href="javascrpt:" data-bs-toggle="modal" data-bs-target="#questArquivo">
                                  <i class="bi bi-question-circle"></i>
                                </a>
                              </div>
                              <code>Tipo de arquivo permitido[.csv]</code>
                            </div>
                          </div>

                          <h5 class="card-title">Como devemos continuar!</h5>

                          <fieldset class="row mb-3">
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                  Atualizar e Gerar Relatório
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                  Apenas Gerar Relatório
                                </label>
                              </div>
                            </div>
                          </fieldset>

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
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row py-2 mb-3">
                  <div class="col-lg-10">
                    <div class="card">
                      <div class="card-body">

                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                          <!--DADOS PARA O LANÇAMENTO -->
                          <h5 class="card-title">Atualizar preço peças</h5>

                          <div class="col-sm-8">
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1">Data histórico a retornar</span>
                              <input type="date" class="form-control" aria-label="dateHistorico" aria-describedby="basic-addon1">
                            </div>
                          </div>

                          <h5 class="card-title">Como devemos continuar!</h5>

                          <fieldset class="row mb-3">
                            <div class="col-sm-10">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option1" checked>
                                <label class="form-check-label" for="gridRadios3">
                                  Atualizar e Gerar Relatório
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option2">
                                <label class="form-check-label" for="gridRadios4">
                                  Apenas Gerar Relatório
                                </label>
                              </div>
                            </div>
                          </fieldset>
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

</main><!-- End #main -->

<div class="modal fade" id="questAtualizar" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Atualizar preço peças - O QUE QUER DIZER ?</h5>
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

<div class="modal fade" id="questArquivo" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informações sobre o arquivo!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><i class="bi bi-pin-angle"></i> O formato do arquivo deverá ser <code>" CVS "</code> com separador por <code>" ; "</code>.</p>
        <p><i class="bi bi-pin-angle"></i> Layout:</p>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Codigo item</li>
          <li class="list-group-item">Descrição</li>
          <li class="list-group-item">preço item</li>
        </ul><!-- End Clean list group -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div><!-- End Large Modal-->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>