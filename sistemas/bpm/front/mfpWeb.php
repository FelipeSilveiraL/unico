<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/recebeMFP.php');//recebe os dados da api e insere no banco de dados

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

              <!-- Table with stripped rows -->
              <table class="table datatable">
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
                 $mfp = "SELECT * FROM bpm_mfp_web";

                 $resultado = $conn->query($mfp);
                 
                 while($row = $resultado->fetch_assoc()){

                    $erro = $row["perfil"];

                    switch($erro){
                      case 'Area Padr?o':
                        $erro = 'Area Padrão';
                      break;
                      case 'Centro Padr?o':
                        $erro = 'Centro Padrão';
                      break;
                    }
                  echo'<tr>
                  <td>'.$row["link"].'</td>
                  <td>'.$row["id_perfil"].'</td>
                  <td>'.$erro.'</td>
                  <td>'.$row["descricao"].'</td>
                  <td><a href="editarLink.php?pg=' . $_GET["pg"] . '&id_link='.$row['id_link'].'" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                  <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarLinkUnico.php?pg='.$_GET['pg'].'&id_link=' . $row["id_link"] . '" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>
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