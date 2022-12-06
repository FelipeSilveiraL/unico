<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../config/query.php');
require_once('../inc/apiDepVendas.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>DEPARTAMENTO VENDAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">DEPARTAMENTO VENDAS</li>
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
                <a href="novaRegraDepVendas.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

                <a href="../inc/relatorioDepVendas.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
              </div>
            <div class="card-body">
              <br>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">#</th>
                    <th scope="col" class="capitalize">NOME</th>
                    <th scope="col" class="capitalize">AÇÃO</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 
                 $sucesso = $conn->query($depVendasQuery);

                 while($row = $sucesso->fetch_assoc()){
                  
                  echo '<tr>';
                  echo '<td>'.$row['ID_DEPARTAMENTO'].'</td>';
                  echo '<td>'.$row['NOME_DEPARTAMENTO'].'</td>';
                  echo '<td><a href="editDepVendas.php?pg=' . $_GET["pg"] . '&id_dep=' . $row["ID_DEPARTAMENTO"] . '" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                    <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarDepVendas.php?pg='.$_GET['pg'].'&id='.$row['ID_DEPARTAMENTO'] .'" title="Desativar" '. $usuarioFuncao .' style="margin-top: 3px;color: white;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
                    </td> ';
                  echo '</tr>';
                 }
                 
                 
                 ?>
                </tbody>
              </table>
              <!-- Vertical Form -->
                
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