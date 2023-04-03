<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../config/query.php');
require_once('../../../config/config.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>GESTOR RH</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">GESTOR RH</li>
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
              
          <h5 class="card-title">Gestor rh</h5>
              <br>
              <?php 
              $idGestor = $_SESSION['login'];

              $queryCount = "SELECT COUNT(*) as quantidade FROM bpm_rh_aprovadores WHERE 
              aprovador_filial = '".$idGestor ."' OR
              aprovador_area = '".$idGestor ."' OR
              aprovador_marca = '".$idGestor ."' OR
              aprovador_superintendente = '".$idGestor ."' OR
              aprovador_gerente = '".$idGestor ."' OR
              aprovador_gestor = '".$idGestor ."'";
              
              $conexao = $conn->query($queryCount);

             $count = mysqli_fetch_array($conexao);

             
             $idGestorNovo = explode(' ', $_POST['gestorNovo'])[0];
             
             $queryCountNovo = "SELECT COUNT(*) as quantidade FROM bpm_rh_aprovadores WHERE 
                aprovador_filial = '".$idGestorNovo ."' OR
                aprovador_area = '".$idGestorNovo ."' OR
                aprovador_marca = '".$idGestorNovo ."' OR
                aprovador_superintendente = '".$idGestorNovo ."' OR
                aprovador_gerente = '".$idGestorNovo ."' OR
                aprovador_gestor = '".$idGestorNovo ."'";

                $conexao2 = $conn->query($queryCountNovo);

                $countNovo = mysqli_fetch_array($conexao2);

              
              ?>
                  <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/atualizandoGestor.php?pg=<?= $_GET['pg'] ?>" method="POST" >
                      <input type="hidden" name="gestorVelho" id="gestorVelho" value="<?= $_SESSION['login'] ?>">
                      <input type="hidden"  name="gestorNovo" id="gestorNovo" value="<?= $idGestorNovo ?>">
                      <div class="form-floating mt-4 col-md-6" style="margin-left: 25%;" id="depto">
                      <span style="color: red;margin-left:30%;font-size: 30px;"><i class="bi bi-exclamation-diamond-fill"></i> ATENÇÃO! <i class="bi bi-exclamation-diamond-fill"></i></span>
                        <br>Você esta preste a atualizar <b>TODAS</b> as <b>REGRAS</b> do <b>ANTIGO</b> gestor:<br>
                        <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"> <?= $_SESSION['login'] ?> / <?= $_SESSION['usuario'] ?><br> <span style="font-size: small;color: red;">(<?= $count[0] ?>) ocorrências</span>  </p>
                        <br>Para o <b>NOVO</b> gestor:
                        <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"><?= $_POST['gestorNovo'] ?><br> <span style="font-size: small;color: red;"> (<?= $countNovo[0] ?>) ocorrências</span></p>
                        após a confirmação não terá mais como reverter!
                      </div>
                    <div class="text-center">
                      <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/gestorRH.php?pg=<?=$_GET['pg']?>"> <button type="button" class="btn btn-danger">NÃO ATUALIZAR, me tire daqui!</button></a>
                      <button type="submit" class="btn btn-primary">CONFIRMAR, entendo os riscos!</button>
                    </div>
                  </form>
              <br>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>