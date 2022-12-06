<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../inc/apiRecebePerfil.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Editar MFP WEB</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="mfpWeb.php?pg=<?= $_GET['pg'] ?>">MFP WEB</a></li>
        <li class="breadcrumb-item">Editar MFP WEB</li>
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
            <div class="card-body"><br>
            <form method="POST" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare']?>/bd/editLink.php?pg=<?= $_GET['pg'] ?>" >
                
            <br>
            <?php
            $id_link = $_GET['id_link'];

            $mfpConsulta = "SELECT * FROM bpm_mfp_web WHERE id_link = ".$id_link."";

            $result = $conn->query($mfpConsulta);

            while($row = $result->fetch_assoc()){

      echo'     <div class="form-floating mt-4 col-md-6" id="link">
                  <input value="'.$row['link'].'" class="form-control" name="link">
                  <label for="link" >LINK:<code>*</code></label>
                </div>
                <div class="form-floating mt-4 col-md-6">
                <select class="form-select" id="sistema" name="cdPerfil">
                  <option value="'.$row['id_perfil'].'">'.$row['id_perfil'].' - '.$erro.' </option>
                  <option value="">-----------</option>
                  '.$mostra.' 
                  </select>
                  <label for="sistema">Código perfil:<code>*</code></label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="descricao">
                  <input type="text" class="form-control" value="'.$row['descricao'].'" name="descricao" required> 
                  <label for="descricao" >DESCRIÇÃO:<code>*</code></label>
                </div>';
            }
            ?>
                <div class="text-left">
                  <button type="button" class="btn btn-primary"><a href="mfpWeb.php?pg= '.$_GET['pg'].' " style="color:white;">Voltar</a></button>
                  <button type="submit" class="btn btn-success">Editar</button>
                </div>
              </form>
              <br>
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