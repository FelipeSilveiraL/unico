<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA EMPRESA X DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="rhEmpDep.php?pg=<?= $_GET['pg'] ?>">EMPRESA X DEPARTAMENTO RH</a></li>
        <li class="breadcrumb-item">NOVA REGRA EMPRESA X DEPARTAMENTO</li>
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
            <h5 class="card-title">Nova regra empresa x departamento </h5>
            <form class="row g-3" action="../inc/novaRegraEmpDep.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="empresa">
                <select type="text" name="empresa" class="form-select" required>
                  <option value="">------------</option>
                  <?php
                  $sucesso = oci_parse($connBpmgp, $relatorioExcel);
                  oci_execute($sucesso);

                  while ($row = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $row['ID_EMPRESA'] . '">' . $row['NOME_EMPRESA'] . '</option>';
                  }
                  oci_free_statement($sucesso);
                  ?>
                </select>
                <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <select type="text" name="depto" class="form-select" required>
                  <option value="">------------</option>
                  <?php
                  $sucesso = oci_parse($connBpmgp, $departrh);
                  oci_execute($sucesso);

                  while ($row = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $row['ID_DEPARTAMENTO'] . '">' . $row['NOME_DEPARTAMENTO'] . '</option>';
                  }
                  ?>
                </select>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-4" id="gerente">
                <select class="form-select" name="gerap" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="gerente">GERENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="super">
                <select class="form-select" name="supap" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="super">SUPERINTENDENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>


              <div class="text-left py-2">
                <a href="../front/rhEmpDep.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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

<?php
require_once('footer.php'); //Javascript e configurações afins
?>