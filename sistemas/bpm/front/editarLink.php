<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../../../config/sqlSmart.php');
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
            <h5 class="card-title">MFP WEB </h5>
            <form method="POST" class="row g-3" action="../inc/editLink.php?pg=<?= $_GET['pg'] ?>" >
                
            <br>
            <?php
            $id_link = $_GET['id_link'];

            $mfpConsulta .= " WHERE ID_LINK = ".$id_link;

            $resultMFP = oci_parse($connBpmgp, $mfpConsulta);
            oci_execute($resultMFP, OCI_COMMIT_ON_SUCCESS);

            while($row = oci_fetch_array($resultMFP, OCI_ASSOC)){

                    $erro = $row['DS_PERFIL'];

                    switch($erro){
                      case 'Area Padr?o':
                        $erro = 'Area Padrão';
                      break;
                      case 'Centro Padr?o':
                        $erro = 'Centro Padrão';
                      break;
                    }

           echo'<div class="form-floating mt-4 col-md-6" id="link">
                  <input value="'.$row['LINK'].'" class="form-control" name="link">
                  <label for="link" >LINK:<code>*</code></label>
                </div>
                <div class="form-floating mt-4 col-md-6">
                <select class="form-select" id="sistema" name="cdPerfil">
                  <option value="'.$row['CD_PERFIL'].'">'.$row['CD_PERFIL'].' - '.$erro.' </option>
                  <option value="">-----------</option>
                  ';
                  $queryPerfil .= " WHERE st_ativo = 1";
                  $resultadoPerfil = oci_parse($connSelbetti, $queryPerfil);
                  oci_execute($resultadoPerfil);

                  while($row2 = oci_fetch_array($resultadoPerfil, OCI_ASSOC)){
                    
                    echo '<option value="'.$row2['CD_PERFIL'].'">'.$row2['CD_PERFIL'].' - '.$erro.' 
                    </option>';
                  }
                  echo' 
                  </select>
                  <label for="sistema">Código perfil:<code>*</code></label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="descricao">
                  <input type="text" class="form-control" value="'.$row['DESCRICAO'].'" name="descricao" required> 
                  <label for="descricao" >DESCRIÇÃO:<code>*</code></label>
                </div>';
            }
            ?>
                <div class="text-left">
                  <button type="button" class="btn btn-primary"><a href="mfpWeb.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
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