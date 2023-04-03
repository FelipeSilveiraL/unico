<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../config/query.php');
require_once('../inc/apiRecebeGerente.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>GERENTES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">GERENTES</li>
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
            <a href="novaRegraGerente.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioGerentes.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>
            <div class="card-body">
            <h5 class="card-title"> Gerentes</h5>
              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col" class="capitalize">#</th>
                    <th scope="col" class="capitalize">EMPRESA</th>
                    <th scope="col" class="capitalize">DEPARTAMENTO</th>
                    <th scope="col" class="capitalize">NOME</th>
                    <th scope="col" class="capitalize">LOGIN SMARTSHARE</th>
                    <th scope="col" class="capitalize">CODIGO LOGIN</th>
                    <th scope="col" class="capitalize">SITUAÇÃO</th>
                    <th scope="col" class="capitalize">Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  
                  $resultado = $conn->query($gerentesQuery);

                  while($row = $resultado->fetch_assoc()){
                    
                    $queryEmpresa = "SELECT NOME_EMPRESA FROM bpm_empresas WHERE ID_EMPRESA = ".$row['EMPRESA']."";

                    $sucesso = $conn->query($queryEmpresa);
                    
                    while($row1 = $sucesso->fetch_assoc()){
                      $empresa = $row1['NOME_EMPRESA'];
                    }

                    $queryDep = "SELECT NOME_DEPARTAMENTO FROM bpm_departamento_vendas WHERE ID_DEPARTAMENTO = ".$row['DEPARTAMENTO']."";
                    
                    $success = $conn->query($queryDep);
                    
                    while($row2 = $success->fetch_assoc()){
                      $departamento = $row2['NOME_DEPARTAMENTO'];
                    }

                    if($row['SITUACAO'] == 'A'){
                      $situacao = 'ATIVO';
                    }else{
                      $situacao = 'DESATIVADO';
                    }
                    echo '<tr>';
                    echo '<td>'.$row['ID_GERENTE'].'</td>';
                    echo '<td>'.$empresa.'</td>';
                    echo '<td>'.$departamento.'</td>';
                    echo '<td>'.$row['NOME'].'</td>';
                    echo '<td>'.$row['LOGIN_SMARTSHARE'].'</td>';
                    echo '<td>'.$row['CODIGO_LOGIN_SMARTSHARE'].'</td>';
                    echo '<td>'.$situacao.'</td>';
                    echo '<td><a href="editGerente.php?pg=' . $_GET["pg"] . '&id_gerente=' . $row["ID_GERENTE"] . '" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                    <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarGerente.php?pg='.$_GET['pg'].'&id='.$row['ID_GERENTE'] .'" title="Desativar" '. $usuarioFuncao .' style="margin-top: 3px;color: white;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
                    </td> 
                    </tr>';

                  }
                  
                  ?>
                </tbody>
              </table>
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