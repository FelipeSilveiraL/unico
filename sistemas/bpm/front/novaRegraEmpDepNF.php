<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA EMPRESA X DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="NF.php?pg=<?= $_GET['pg'] ?>">NF</a></li>
        <li class="breadcrumb-item"><a href="nfEmpDep.php?pg=<?= $_GET['pg'] ?>">EMPRESA X DEPARTAMENTO NF</a></li>
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
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraEmpDepNF.php" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="empresa">
                <select type="text" name="empresa" class="form-select" required>
                  <option value="">------------</option>
                  <?php 
                  
                    $sucesso = $conn->query($relatorioExcel);

                    while($row = $sucesso->fetch_assoc()){
                      echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].'</option>';
                    }
                  ?>
                </select>
                <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <select type="text" name="depto" class="form-select" required>
                  <option value="">------------</option>
                  <?php 
                  
                    $departamento = "SELECT * FROM bpm_rh_departamento";
                    $sucesso = $conn->query($departamento);

                    while($row = $sucesso->fetch_assoc()){
                      echo '<option value="'.$row['ID_DEPARTAMENTO'].'">'.$row['NOME_DEPARTAMENTO'].'</option>';
                    }
                  ?>
                </select>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="gerente">
                <select class="form-select" name="gerap" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="gerente">GERENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="super">
                <select class="form-select" name="supap" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="super">SUPERINTENDENTE APROVA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">------------</option>
                  <option value="S">ATIVO</option>
                  <option value="N">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="lancarMulta">
                <select class="form-select" name="lancarMulta" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="lancarMulta">LANÇAR MULTAS:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="gestorAprovaM">
                <select class="form-select" name="gestorAprovaM" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="gestorAprovaM">GESTOR ÁREA APROVA MULTAS:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="revisao_adm" id="revisao_adm" onchange="administrador()" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="revisao_adm">REVISÃO ADMINISTRADOR:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="loginAdministrador" style="display: none;">
                <select class="form-select" name="login_adm" type="text" id="login_adm" required>
                    <option value=" ">---------------------</option>
                    <?php 

                        $query_users .= " WHERE id NOT IN (1)";

                        $sucesso = $conn->query($query_users);

                        while ($row2 = $sucesso->fetch_assoc()) {

                        echo '<option value="' . $row2['DS_LOGIN'] . '"> ' . $row2['DS_USUARIO'] . ' / ' . $row2['DS_LOGIN'] . ' </option>';
                        }

                    ?>
                </select>
                <label for="loginAdministrador">LOGIN ADMINISTRADOR:<span style="color: red;">*</span></label>
              </div>


              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/nfEmpDep.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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

<script>
        function administrador(){
            var valueRevisao = document.getElementById("revisao_adm").value;            
            switch(valueRevisao){
              case 'S':
                document.getElementById("loginAdministrador").style.display = "block";
                break;
              case 'N':
                document.getElementById("loginAdministrador").style.display = "none";
                document.getElementById('login_adm').value = '';
                document.getElementById("login_adm").required = false;
                break;
            
            }
        }
    </script>


<?php
require_once('footer.php'); //Javascript e configurações afins
?>