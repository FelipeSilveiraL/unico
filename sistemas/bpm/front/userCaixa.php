<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeCaixa.php');//recebe os dados da api e insere no banco de dados
require_once('../config/query.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
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
              <div class="card-header">
                <a href="novaRegraCx.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Importar Usuários" <?= $usuarioFuncao ?> ><i class="bi bi-plus-lg"></i></a>
                <a href="../bd/relatorioExcel.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
              </div><br>
            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">EMPRESA</th>
                    <th scope="col" class="capitalize">CAIXA</th>
                    <th scope="col" class="capitalize">USUÁRIO</th>
                    <th scope="col" class="capitalize">AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 $mfp = "SELECT * FROM bpm_caixa_nf";

                 $resultado = $conn->query($mfp);
                 
                 while($row = $resultado->fetch_assoc()){

                  echo'<tr>
                  <td>'.$row["NOME_EMPRESA"].'</td>
                  <td>'.$row["NUMERO_CAIXA"].'</td>
                  <td>'.$row["USUARIO_CAIXA"].'</td>
                  <td><a href="editUserCx.php?pg=' . $_GET["pg"] . '&id='.$row['id'].'" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                  <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarCxUs.php?id_empresa=' . $row["ID_EMPRESA"] . '&usuario_caixa='.$row["USUARIO_CAIXA"].'" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>
                  </tr>';
                 }
                 
                 
                 
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