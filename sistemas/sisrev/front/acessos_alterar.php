<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Informações dos módulos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a>
        </li>
        <li class="breadcrumb-item">
          <a href="telas_funcoes.php?pg=<?= $_GET['pg'] ?>">Módulos</a>
        </li>
        <li class="breadcrumb-item">Adicionar novo módulo</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <?php
            if ($_GET['id'] != NULL) {

              $queryAcessos .= ' WHERE id = ' . $_GET['id'] . '';
              $execAcessos = $conn->query($queryAcessos);

              while ($row = $execAcessos->fetch_assoc()) {
                $valueNome = $row['nome'];
                $valueEndereço = $row['endereco'];
                $icone = $row['icone'];
              }
            }

            ?>

            <form action="../inc/acessos_alterar.php?pg=<?= $_GET['pg'] ?>&acao=<?= $_GET['acao'] ?>&id=<?= $_GET['id'] ?>" method="post">
              <h5 class="card-title">Informações</h5>
              <div class="row mb-3">
                <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="nome" type="text" class="form-control" id="nome" value="<?= $valueNome ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Endereço:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="endereco" type="text" class="form-control" id="endereco" value="<?= $valueEndereço ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="endereco" class="col-md-4 col-lg-3 col-form-label">O que ele é?</label>
                <div class="col-sm-8">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="submodulo" id="gridRadios2" value="2" onclick="myFunctionTwo()">
                    <label class="form-check-label" for="gridRadios2">
                      Módulo
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="submodulo" id="gridRadios1" value="1" onclick="myFunction()">
                    <label class="form-check-label" for="gridRadios1">
                      Sub-módulo
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="submodulo" id="gridRadios1" value="3" onclick="myFunctionOne()" checked>
                    <label class="form-check-label" for="gridRadios1">
                      Página
                    </label>
                  </div>
                </div>
              </div>
              <div id="submenu" style="display: none">
                <div class="row mb-3">
                  <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Ícone:</label>
                  <div class="col-md-8 col-lg-5">
                    <input name="icone" type="text" class="form-control" id="icone" value="" placeholder="Exemplo: <i class='bi bi-eye-fill'></i>">
                    <div id="ques" style="margin-left: 377px;margin-top: -31px;">
                      <a href="../../../template/icons-bootstrap.html" target="_blank" title="Ver Modelos">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Localização:</label>
                  <div class="form-floating mb-3 col-md-5">
                    <select class="form-select" id="floatingSelect" name="localizacao">
                      <option value="">-------------</option>
                      <option value="1">Módulos</option>
                      <option value="2">Telas</option>
                      <option value="3">Outros</option>
                    </select>
                    <label for="floatingSelect" class="capitalize">Selecione localização no menu</label>
                  </div>
                </div>
              </div>

              <div id="noSubmenu" style="display: none">
                <div class="row mb-3">
                  <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Módulo:</label>
                  <div class="form-floating mb-3 col-md-5">
                    <select class="form-select" id="floatingSelect" name="modulo">
                      <option value="">-------------</option>
                      <?php
                      $queryAcessosM .= 'SELECT * FROM sisrev_modulos WHERE sub_modulo = 0 AND deletar = 0';
                      $execAcessosM = $conn->query($queryAcessosM);
                      while ($rowModulosM = $execAcessosM->fetch_assoc()) {
                        echo '<option value="' . $rowModulosM['id'] . '">' . $rowModulosM['nome'] . '</option>';
                      }
                      ?>
                    </select>
                    <label for="floatingSelect" class="capitalize">Selecione o módulo a vincular</label>
                  </div>
                </div>
              </div>


              <div class="modal-footer">
                <a href="telas_funcoes.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<script>
  function myFunction() {
    var display = document.getElementById("noSubmenu").style.display;
    if (display == 'none') {
      document.getElementById("noSubmenu").style.display = 'block';
      document.getElementById("submenu").style.display = 'none';
    }
  }
  function myFunctionTwo() {
    var display = document.getElementById("submenu").style.display;
    if (display == 'none') {
      document.getElementById("submenu").style.display = 'block';
      document.getElementById("noSubmenu").style.display = 'none';
    }
  }
  function myFunctionOne() {  
    document.getElementById("submenu").style.display = 'none';
    document.getElementById("noSubmenu").style.display = 'none';
  }
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>