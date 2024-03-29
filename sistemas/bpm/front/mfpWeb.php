<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>MFP WEB</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">MFP WEB</li>
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
                <a href="NovoLink.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Importar Usuários" <?= $usuarioFuncao ?> ><i class="bi bi-plus-lg"></i></a>
              </div><br>
            <div class="card-body">
            <h5 class="card-title"> MFP WEB</h5>

              <!-- Table with stripped rows -->
              <table class="table table-stripeddatatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">LINK</th>
                    <th scope="col" class="capitalize">ID PERFIL</th>
                    <th scope="col" class="capitalize">PERFIL</th>
                    <th scope="col" class="capitalize">DESCRIÇÃO</th>
                    <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
               

                 $resultMFP = oci_parse($connBpmgp, $mfpConsulta);
                 oci_execute($resultMFP, OCI_COMMIT_ON_SUCCESS);

                while($row = oci_fetch_array($resultMFP, OCI_ASSOC)){

                  echo'<tr>
                  <td>'.$row["LINK"].'</td>
                  <td>'.$row["CD_PERFIL"].'</td>
                  <td>'.$row["DS_PERFIL"].'</td>
                  <td>'.$row["DESCRICAO"].'</td>
                  <td><a href="editarLink.php?pg=' . $_GET["pg"] . '&id_link='.$row['ID_LINK'].'" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                  <a href="../inc/deletarLinkUnico.php?pg='.$_GET['pg'].'&id_link='.$row["ID_LINK"].'" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>
                  </tr>';

                 }
                 
                //  oci_close($connBpmgp);
                //  oci_free_statement($resultMFP);
                 
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