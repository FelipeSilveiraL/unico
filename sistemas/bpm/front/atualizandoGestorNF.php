<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>GESTOR NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">GESTOR NF</li>
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
              
          <h5 class="card-title">Gestor nf</h5>
              <?php 
                $idGestor = $_SESSION['login'];

                $queryCount = "SELECT COUNT(*) as quantidade FROM aprovadores_nf WHERE 
                aprovador_filial = '".$idGestor ."' OR
                aprovador_area = '".$idGestor ."' OR
                aprovador_marca = '".$idGestor ."' OR
                aprovador_superintendente = '".$idGestor ."' OR
                aprovador_gerente = '".$idGestor ."' OR
                aprovador_gestor = '".$idGestor ."'";
                $conexao = $conn->query($queryCount);

              $count = mysqli_fetch_array($conexao);

              
              $idGestorNovo = explode(' ', $_POST['gestorNovo'])[0];
              
              $queryCountNovo = "SELECT COUNT(*) as quantidade FROM bpm_nf_aprovadores WHERE 
                aprovador_filial = '".$idGestorNovo ."' OR
                aprovador_area = '".$idGestorNovo ."' OR
                aprovador_marca = '".$idGestorNovo ."' OR
                aprovador_superintendente = '".$idGestorNovo ."' OR
                aprovador_gerente = '".$idGestorNovo ."' OR
                aprovador_gestor = '".$idGestorNovo ."'";

                $conexao2 = $conn->query($queryCountNovo);

                $countNovo = mysqli_fetch_array($conexao2);

              

                echo $queryCount;

                exit;
                
              ?>

              
                 
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