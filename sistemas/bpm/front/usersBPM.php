<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/inserindoUsers.php'); //excluindo a tabela, criando a tabela e populando a mesma
require_once('../config/query.php');
require_once('../../../config/config.php');

/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS SMARTSHARE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
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

                <a href="../bd/relatorioUserExcel.php" type="button" class="btn btn-success buttonAdd" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
              </div><br>
            <div class="card-body">
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">Id Regra</th>
                    <th scope="col" class="capitalize">USUÁRIO</th>
                    <th scope="col" class="capitalize">LOGIN</th>
                    <th scope="col" class="capitalize">E-MAIL</th>
                    <th scope="col" class="capitalize">SITUAÇÃO</th>
                    <th scope="col" class="capitalize">AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                  $query_users .= ' ORDER BY cd_usuario ASC';
                  $exec = $conn->query($query_users);

                  while($row = $exec->fetch_assoc()){

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
                    <td>'.$row["DS_LOGIN"].'</td>
                    <td>'.$row["DS_EMAIL"].'</td>
                    <td>'.$ativo.'</td>
                    <td><a href="usersEdit.php?pg='.$_GET['pg'].'&id='.$row['id'].'" class="btn-primary btn-sm"><span style="color: white;"><i class="bi bi-pencil"></i></span></a></td>
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