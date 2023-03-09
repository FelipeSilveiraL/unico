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
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
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
                <a href="../inc/relatorioUsuarioCaixa.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
              </div><br>
            <div class="card-body">

              <!-- Table with stripped rows -->
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">#</th>
                    <th scope="col" class="capitalize">EMPRESA</th>
                    <th scope="col" class="capitalize">NOME CAIXA</th>
                    <th scope="col" class="capitalize">USUÁRIO</th>
                    <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 $caixaNF = "SELECT 
                 CNF.ID, CNF.NOME_EMPRESA, CNF.ID_EMPRESA, CNF.USUARIO_CAIXA, CNF.ID_CAIXA_EMPRESA, CE.nome_caixa
                  FROM
                      unico.bpm_caixa_nf CNF
                  LEFT JOIN bpm_caixa_empresa CE ON (CNF.id_caixa_empresa = CE.id_caixa_empresa) ORDER BY CNF.ID ASC ";
                  
                  //   WHERE CNF.ID_EMPRESA NOT IN 
                  // (1,19802,18782,20002,22389,27209,25909,25549,25670) 
                  //   ORDER BY CNF.ID_EMPRESA ASC";

                 $resultado = $conn->query($caixaNF);
                 
                 while($row = $resultado->fetch_assoc()){
                  $idCaixaEmpresa = $row['ID_CAIXA_EMPRESA'];
                  echo'<tr>
                  <td>'.$row['ID'].'</td>
                  <td>'.$row["NOME_EMPRESA"].'</td>
                  <td>'.$row['nome_caixa'].'</td>
                  <td>'.$row["USUARIO_CAIXA"].'</td>
                  <td><a href="editUserCx.php?pg=' . $_GET["pg"] . '&id='.$row['ID'].'" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                  <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarCxUs.php?pg='.$_GET['pg'].'&id_empresa=' . $row["ID_EMPRESA"] . '&usuario_caixa='.$row["USUARIO_CAIXA"].'&id_caixa_empresa='.$idCaixaEmpresa.'" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>
                  </tr>';
                 }
                 
                 
                 $conn->close();
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
