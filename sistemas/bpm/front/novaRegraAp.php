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
    <h1>NOVA REGRA APROVADORES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="RH.php?pg=<?= $_GET['pg'] ?>">RH</a></li>
        <li class="breadcrumb-item"><a href="aprovadoresRH.php?pg=<?= $_GET['pg'] ?>">APROVADORES RH</a></li>
        <li class="breadcrumb-item">NOVA REGRA APROVADORES</li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraAp.php" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="empresa" id="empresa" required>
                  <?php
                    $empNew = 'SELECT * FROM bpm_empresas WHERE ID_EMPRESA NOT IN(302,208,261,101) ORDER BY NOME_EMPRESA ASC ';

                    echo '<option value="">-----------------</option>';

                    $sucesso2 = $conn->query($empNew);

                    while ($row2 = $sucesso2->fetch_assoc()) {
                      echo '<option value="' . $row2['ID_EMPRESA'] . '">' . $row2['NOME_EMPRESA'] . '</option>';
                    }
                  
                  ?>
                </select>
                <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <select class="form-select" name="depto" required>
                  <option value="">-----------------</option>
                  <?php
                  $dep = "SELECT * FROM bpm_rh_departamento";

                  $sucessoDep = $conn->query($dep);

                  while ($rowDep = $sucessoDep->fetch_assoc()) {

                    echo '<option value="' . $rowDep['ID_DEPARTAMENTO'] . '"> ' . $rowDep['NOME_DEPARTAMENTO'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="filial">
                <select class="form-select" name="filial" required>
                  <option value="">-----------------</option>
                  <?php
                  
                  $selectEmp2 = "SELECT * FROM bpm_usuarios_smartshare WHERE id NOT IN (1)";

                  $sucesso = $conn->query($selectEmp2);

                  while ($row2 = $sucesso->fetch_assoc()) {

                    echo '<option value="' . $row2['DS_LOGIN'] . '"> ' . $row2['DS_USUARIO'] . ' / ' . $row2['DS_LOGIN'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="filial">CIÊNCIA FILIAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="area">
                <select class="form-select" name="area" required>
                  <option value="">-----------------</option>
                  <?php
                  $selectEmp = "SELECT * FROM bpm_usuarios_smartshare WHERE id NOT IN (1)";

                  $sucesso1 = $conn->query($selectEmp);

                  while ($row1 = $sucesso1->fetch_assoc()) {

                    echo '<option value="' . $row1['DS_LOGIN'] . '"> ' . $row1['DS_USUARIO'] . ' / ' . $row1['DS_LOGIN'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="area">CIÊNCIA AREA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="marca">
                <select class="form-select" name="marca" required>
                  <option value="">-----------------</option>
                  <?php
                  $selectEmp = "SELECT * FROM bpm_usuarios_smartshare WHERE id NOT IN (1)";

                  $sucesso = $conn->query($selectEmp);

                  while ($row = $sucesso->fetch_assoc()) {

                    echo '<option value="' . $row['DS_LOGIN'] . '"> ' . $row['DS_USUARIO'] . ' / ' . $row['DS_LOGIN'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="marca">CIÊNCIA MARCA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="gerente">
                <select class="form-select" name="gerente" required>
                  <option value="">-----------------</option>
                  <?php
                  $selectEmp = "SELECT * FROM bpm_usuarios_smartshare WHERE id NOT IN (1)";

                  $sucesso = $conn->query($selectEmp);

                  while ($row = $sucesso->fetch_assoc()) {

                    echo '<option value="' . $row['DS_LOGIN'] . '"> ' . $row['DS_USUARIO'] . ' / ' . $row['DS_LOGIN'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="gerente">GERENTE GERAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="super">
                <select class="form-select" name="super" required>
                  <option value="">-----------------</option>
                  <?php
                  $selectEmp = "SELECT * FROM bpm_usuarios_smartshare WHERE id NOT IN (1)";

                  $sucesso = $conn->query($selectEmp);

                  while ($row = $sucesso->fetch_assoc()) {

                    echo '<option value="' . $row['DS_LOGIN'] . '"> ' . $row['DS_USUARIO'] . ' / ' . $row['DS_LOGIN'] . ' </option>';
                  }

                  ?>
                </select>
                <label for="super">SUPERINTENDENTE:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/aprovadoresRH.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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