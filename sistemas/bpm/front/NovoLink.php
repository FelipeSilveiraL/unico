<?php
session_start();
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
    <h1>NOVO MFP WEB</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="mfpWeb.php?pg=<?= $_GET['pg'] ?>">MFP WEB</a></li>
        <li class="breadcrumb-item">NOVO MFP WEB</li>
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
                <form method="POST" action=" ../inc/novoLink.php?pg=<?= $_GET['pg'] ?>" >
                  <div class="row mb-3">
                    <label for="user" class="col-sm-2 col-form-label" >Link:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" placeholder="http://" id="user" name="link" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label">Código perfil:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-control" id="sistema" name="cdPerfil" required>
                        <option value="">--------------</option>
                        <?php
                        
                        $queryPerfil .= " WHERE st_ativo = 1";
                        $resultadoPerfil = oci_parse($connSelbetti, $queryPerfil);
                        oci_execute($resultadoPerfil);

                        while($row = oci_fetch_array($resultadoPerfil, OCI_ASSOC)){
                          $erro = $row['DS_PERFIL'];

                          switch($erro){
                            case 'Area Padr?o':
                              $erro = 'Area Padrão';
                            break;
                            case 'Centro Padr?o':
                              $erro = 'Centro Padrão';
                            break;
                          }
                          echo '<option value="'.$row['CD_PERFIL'].'">'.$row['CD_PERFIL'].' - '.$erro.' 
                          </option>';
                        }

                        ?>
                      </select> 
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="descricao" class="col-sm-2 col-form-label" >Descrição:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="descricao" name="descricao" required> 
                    </div>
                  </div>
                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="mfpWeb.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
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