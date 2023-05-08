<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nova postagem</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Nova postagem</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-9">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nova postagem<span style="margin-right: 4px;"></span><i class="bi bi-file-earmark-plus"></i></a></h5>

            <form>

              <div class="row mb-3">
                <div class="col-sm-8">
                  <label class="col-sm-6 col-form-label text-start">Título:</label>
                  <input class="form-control" type="text" title="Máximo 40 caracteres" maxlength="40" class="form-control" required>
                </div>
              </div>


              <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Tipo da postagem:</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                    <label class="form-check-label" for="gridRadios1">
                      Simples
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                    <label class="form-check-label" for="gridRadios2">
                      Modal
                    </label>
                  </div>
                </div>
              </fieldset>

              <div class="row">
                <div class="col">
                  <div class="row mb-2">
                    <label class="col-sm-5 col-form-label text-start">Data fim de visibilidade?</label>
                    <div class="col-sm-4">
                      <select class="form-select text-start" aria-label="Default select example" required style="margin-top: 12px;" required>
                        <option value="">------------</option>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="row mb-2">
                    <label class="col-sm-5 col-form-label text-start">Alerta de comentários?</label>
                    <div class="col-sm-4">
                      <select class="form-select text-start" aria-label="Default select example" required style="margin-top: 12px;" required>
                        <option value="">------------</option>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-7">
                    <label class="col-sm-6 col-form-label text-start">Imagem/Video:</label>
                    <input class="form-control" type="file" id="formFile" required>
                  </div>
                </div>

                <label for="inputText" style="margin-bottom: 5px;">Mensagem:</label>
                <div class="card">
                  <div class="quill-editor-default" required></div>
                </div>

                <div class="row mb-3 mt-4">
                  <div class="col-sm-13 text-center">
                    <button type="submit" class="btn btn-success">Salvar</button>
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