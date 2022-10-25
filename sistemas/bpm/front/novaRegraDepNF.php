<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../../../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="NF.php?pg=<?= $_GET['pg'] ?>">NF</a></li>
        <li class="breadcrumb-item"><a href="departamentoNF.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTO NF</a></li>
        <li class="breadcrumb-item">NOVA REGRA DEPARTAMENTO</li>
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
            <form id="novaRegraDepartamento" name="novaRegraDepartamento" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraDepNF.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="nomedpto">
                <input type="text" class="form-control" name="nomedpto" id="nomedpto" required>
                <label for="nomedpto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="situacao" id="situacao" required>
                  <option>------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/departamentoNF.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div>
    </div> <!-- FIM col-lg-12 -->
  </section><!-- FIM section -->
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<!-- 
<script>
  function empresaSelect() {
    document.novaRegraEmpresa.action = "novaRegraAp.php"
    document.novaRegraEmpresa.method = "GET"
    document.novaRegraEmpresa.submit();
  }
</script> -->


<?php
require_once('footer.php'); //Javascript e configurações afins
?>