<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php');
require_once('../../../config/config.php');
require_once('../../../config/sqlSmart.php');

/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS SMARTSHARE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">USUÁRIOS SMARTSHARE</li>
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
          <div class="card-header">
                <a href="http://<?= $_SESSION['unico'] ?>/acoesAutomaticas/front/importarUsuarioVetorSelbetti.php" type="button" class="btn btn-success buttonAdd" title="Importar Usuários" <?= $usuarioFuncao ?> ><i class="bx bx-export"></i></a>

                <a href="../inc/relatorioUserExcel.php" type="button" class="btn btn-success buttonAdd" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
              </div><br>
            <div class="card-body">
            <h5 class="card-title">Usuários smartshare </h5>
              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">#</th>
                    <th scope="col" class="capitalize">USUÁRIO</th>
                    <th scope="col" class="capitalize">PAPEL</th>
                    <th scope="col" class="capitalize">LOGIN</th>
                    <th scope="col" class="capitalize">E-MAIL</th>
                    <th scope="col" class="capitalize">SITUAÇÃO</th>
                    <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                  $queryUserApi  .= ' ORDER BY cd_usuario ASC';

                  $execSmartUser = oci_parse($connSelbetti, $queryUserApi );
                  oci_execute($execSmartUser,OCI_COMMIT_ON_SUCCESS);

                  while($row = oci_fetch_array($execSmartUser, OCI_ASSOC)){

                    $ativo = $row['ST_ATIVO'];

                    switch($ativo){
                      case '1':
                        $ativo = 'Ativo';
                      break;
                      case '0':
                        $ativo = 'Desativado';
                      break;
                    }

                    echo'<tr>
                    <td>'.$row["CD_USUARIO"].'</td>
                    <td>'.$row["DS_USUARIO"].'</td>
                    <td>'.$row["DS_PAPEL"].'</td>
                    <td>'.$row["DS_LOGIN"].'</td>
                    <td>'.$row["DS_EMAIL"].'</td>
                    <td>'.$ativo.'</td>
                    <td><a href="usersEdit.php?pg='.$_GET['pg'].'&id='.$row['CD_USUARIO'].'" class="btn-primary btn-sm" '.$usuarioFuncao.'><span style="color: white;"><i class="bi bi-pencil"></i></span></a></td>
                    </tr>';

                   
                  }
                  oci_close($connSelbetti);
                 ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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