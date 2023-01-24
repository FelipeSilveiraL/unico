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
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="departamentoRH.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTO RH</a></li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/editDep.php?pg=<?= $_GET['pg'] ?>&id=<?= $_GET['id_departamento'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="depto">
                <?php

                $departamento = "SELECT * FROM bpm_rh_departamento WHERE ID_DEPARTAMENTO =" . $_GET['id_departamento'] . "";

                $sucesso = $conn->query($departamento);

                while ($row = $sucesso->fetch_assoc()) {
                  echo '<input type="text" value="'.$row['NOME_DEPARTAMENTO'].'" class="form-control" name="depto" id="depto" disabled>';
                }
                ?>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="situacao" id="situacao" required>
                  <?php
                  $departamento2 = "SELECT * FROM bpm_rh_departamento WHERE ID_DEPARTAMENTO =" . $_GET['id_departamento'] . "";

                  $sucesso2 = $conn->query($departamento2);

                  while ($row2 = $sucesso2->fetch_assoc()) {
                    switch ($row2['SITUACAO']) {
                      case 'A':
                        $situacao = 'ATIVO';
                        break;
                      case 'D':
                        $situacao = 'DESATIVADO';
                        break;
                    }
                    echo '<option value="' . $row2['SITUACAO'] . '">' . $situacao . '</option>';
                  }
                  ?>
                  <option>------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/departamentoRH.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Editar</button>
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