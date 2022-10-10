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
    <h1>EDITAR REGRA EMPRESA X DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="RH.php?pg=<?= $_GET['pg'] ?>">RH</a></li>
        <li class="breadcrumb-item"><a href="rhEmpDep.php?pg=<?= $_GET['pg'] ?>">EMPRESA X DEPARTAMENTO RH</a></li>
        <li class="breadcrumb-item">EDITAR REGRA EMPRESA X DEPARTAMENTO</li>
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
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/editEmpDep.php" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
                <?php
                $empDep = "SELECT * FROM bpm_rh_emp_dep WHERE ID_EMPDEP =" . $_GET['id'] . "";

                $sucesso = $conn->query($empDep);

                while ($row = $sucesso->fetch_assoc()) {

                    $situacao = $row['SITUACAO'];
                    $gerente = $row['GERENTE_APROVA'];
                    $super = $row['SUPERINTENDENTE_APROVA'];

                    if($situacao == 'A'){
                      $situacao = 'ATIVO';
                    }else{
                      $situacao = 'DESATIVADO';
                    }

                    if($gerente == 'S'){
                      $gerente = 'SIM';
                    }else{
                      $gerente = 'NÃO';
                    }

                    if($super == 'S'){
                      $super = 'SIM';
                    }else{
                      $super = 'NÃO';
                    }
                  echo '
                  <input type="hidden" value="'.$row['ID_EMPDEP'].'" name="id_empdep">
              <div class="form-floating mt-4 col-md-6" id="empresa">
                <input type="text" value="'.$row['NOME_EMPRESA'].'"class="form-control" disabled>
                <label for="empresa">EMPRESA:</label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <input type="text" class="form-control" value="'.$row['NOME_DEPARTAMENTO'].'" disabled >
                <label for="depto">DEPARTAMENTO:</label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="gerente">
                <select class="form-select" name="gerap"  required>
                  <option value="'.$row['GERENTE_APROVA'].'">'.$gerente.'</option>
                  <option>------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="gerente">GERENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="super">
                <select class="form-select" name="supap"  required>
                  <option value="'.$row['SUPERINTENDENTE_APROVA'].'">'.$super.'</option>
                  <option>------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="super">SUPERINTENDENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao"  required>
                  <option value="'.$row['SITUACAO'].'">'.$situacao.'</option>
                  <option>------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>';
                }
                ?>
                <div class="text-left py-2">
                  <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/rhEmpDep.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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