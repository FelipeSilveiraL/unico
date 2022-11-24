<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../inc/apiRecebeSelbetti.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
        <li class="breadcrumb-item"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>">USUÁRIOS CAIXA</a></li>
        <li class="breadcrumb-item">USUÁRIOS CAIXA</li>
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
            <br>
                <form method="POST" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraCxUs.php?pg=<?= $_GET['pg'] ?>" >
                  <div class="row mb-3">
                    <label for="user" class="col-sm-2 col-form-label" >EMPRESA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-select" id="empresa" name="empresa" required>
                        <option value="">--------------</option>
                          <?php 
                          $result = $conn->query($relatorioExcel);

                          while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].'</option>';
                          }
                          
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label">USUÁRIOS CAIXA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-select" name="userCaixa" required>
                        <?php
                        echo '<option value=""> ------------ </option>';
                        echo $aprovador;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                </form><br>
            </div>
          </div>

          

        </div>

        
      </div>
    </section>

  <!--################# section TERMINA AQUI #################-->

</main>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>