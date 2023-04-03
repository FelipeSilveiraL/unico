<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../../../config/databases.php');
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITAR USUARIO SMARTSHARE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="usersBPM.php?pg=<?= $_GET['pg'] ?>">USUÁRIOS SMARTSHARE</a></li>
        <li class="breadcrumb-item">EDITAR USUARIO SMARTSHARE</li>
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
            <?php 
              $id = $_GET['id'];

              $queryUserApi .= " WHERE CD_USUARIO = ".$id;
              
              $execSmartUser = oci_parse($connSelbetti, $queryUserApi );
                oci_execute($execSmartUser,OCI_COMMIT_ON_SUCCESS);

                while($row = oci_fetch_array($execSmartUser, OCI_ASSOC)){

                $cd = $row['CD_USUARIO'];

                echo '
                <form method="POST" action=" ../inc/editUser.php?pg='.$_GET['pg'].'" >
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome Usuário</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="user" name="inputUsuario" value ="'.$row['DS_USUARIO'].'">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Usuário</label>
                    <div class="col-sm-4">
                      <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="'.$row['DS_EMAIL'].'">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Login Smartshare</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="inputPassword" name="inputLogin" value="'.$row['DS_LOGIN'].'">
                    </div>
                  </div>
                  <input type="hidden" value="'.$row['CD_USUARIO'].'" name="inputCd">
                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="../front/usersBPM.php?pg='.$_GET['pg'].'" style="color:white;">voltar</a></button>
                    <button type="submit" class="btn btn-success">Editar</button>
                  </div>
                </form>';


              }

              $conn->close();
            ?>
            </div><br>
          </div>

          

        </div>

        
      </div>
    </section>

  <!--################# section TERMINA AQUI #################-->

</main>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>