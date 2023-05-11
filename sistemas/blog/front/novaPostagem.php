<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/dadosPostagens.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nova postagem</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <?= $menu ?>
        
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
            <h5 class="card-title"><?= $tituloPagina ?><span style="margin-right: 4px;"></span><i class="bi bi-file-earmark-plus"></i></a></h5>

            <form action="../inc/postagem.php?funcao=<?= $idFuncao ?>&pg=<?= $_GET['pg'] ?>&id_postagem=<?= $_GET['id_post'] ?>" method="POST" enctype="multipart/form-data"> <!-- Formulário -->

              <div class="row mb-2 mt-2">
                <div class="col-sm-15">
                  <label class="col-sm-6 col-form-label text-start">Título:</label>
                  <input class="form-control" value="<?= $titulo ?> " name="titulo" type="text" title="Máximo 40 caracteres" maxlength="40" class="form-control" required>
                </div>
              </div>

              <fieldset class="row mb-2 mt-4">
                <legend class="col-form-label col-sm-2 pt-0">Tipo da postagem:</legend>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" <?= $simples ?>>
                    <label class="form-check-label" for="gridRadios1">
                      Simples
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2" <?= $modal ?>>
                    <label class="form-check-label" for="gridRadios2">
                      Modal
                    </label>
                  </div>
                </div>
              </fieldset>

              <div class="row">
                <div class="col">
                  <div class="row mb-2 mt-2">
                    <label class="col-sm-5 col-form-label text-start">Data fim de visibilidade?</label>
                    <div class="col-sm-4">
                      <select class="form-select text-start" name="dataFimVisibilidade" aria-label="Default select example" required style="margin-top: 12px;" id="selectData" onchange="exclusao()">
                        <?= $dataFIm ?>
                        <option value="">--------</option>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col">
                  <div class="row mb-2 mt-2">
                    <label class="col-sm-5 col-form-label text-start">Alerta de comentários?</label>
                    <div class="col-sm-4">
                      <select class="form-select text-start" name="alertaDeComentarios" aria-label="Default select example" required style="margin-top: 12px;">
                        <?= $comentario ?>
                        <option value="">--------</option>
                        <option value="1">Sim</option>
                        <option value="2">Não</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-sm-15" id="dataExclusao" style="display: <?= $dataExclusao ?> ;">
                  <label class="col-sm-6 col-form-label text-start">Data da exclusão:</label>
                  <div class="input-group col-sm-15 mb-2 mt-2">
                    <input class="form-control" name="dateDrop" type="date" value="<?= $dataExclusaoVAlue ?>">
                  </div>
                </div>

                <div class="col-sm-15">
                  <label class="col-sm-6 col-form-label text-start">Imagem/Video:</label>
                  <div class="input-group col-sm-15 mb-2 mt-2">
                    <input class="form-control" name="imagemVideo" type="file" id="formFile" <?= $requeredArquivo ?>>
                    <button class="btn btn-success" title="Adicionar mais arquivos" type="button" onclick="addFileInput()">+</button>
                  </div>
                </div>

                <div class="card mt-2">

                  <label class="col-sm-6 col-form-label text-start">Mensagem:</label>

                  <!-- TinyMCE Editor -->
                  <textarea name="mensagemTexto" class="tinymce-editor"><?=$mensagem?>

                    </textarea><!-- End TinyMCE Editor -->

                </div>

                <div class="row mb-3 mt-4">
                  <div class="col-sm-13 text-center">
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                    <button type="submit" class="btn btn-success"><?= $nameButao ?></button>
                  </div>
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