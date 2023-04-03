<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA APROVADORES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="../inc/novaRegraAp.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="empresa" id="empresa" required>
                  <?php
                  $queryEmpresa .= ' WHERE ID_EMPRESA NOT IN(302,208,261,101) ORDER BY NOME_EMPRESA ASC ';

                  echo '<option value="">-----------------</option>';

                  $sucesso = oci_parse($connBpmgp, $queryEmpresa);
                  oci_execute($sucesso);

                  while ($row2 = oci_fetch_array($sucesso)) {
                    echo '<option value="' . $row2['ID_EMPRESA'] . '">' . $row2['NOME_EMPRESA'] . '</option>';
                  }
                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <select class="form-select" name="depto" required>
                  <option value="">-----------------</option>
                  <?php

                  $sucessoDep = oci_parse($connBpmgp, $departrh);
                  oci_execute($sucessoDep);

                  while ($rowDep = oci_fetch_array($sucessoDep, OCI_ASSOC)) {

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
                  $usuarioOriginal = $queryUserApi;

                  $query = $usuarioOriginal;

                  $query .= "WHERE U.cd_usuario not in (1) ORDER BY U.ds_usuario ASC  ";
                  
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="filial">CIÊNCIA FILIAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="area">
                <select class="form-select" name="area" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="area">CIÊNCIA AREA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="marca">
                <select class="form-select" name="marca" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="marca">CIÊNCIA MARCA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="gerente">
                <select class="form-select" name="gerente" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="gerente">GERENTE GERAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="super">
                <select class="form-select" name="super" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  oci_close($connBpmgp);
                  oci_close($connSelbetti);
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
                <a href="aprovadoresRH.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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