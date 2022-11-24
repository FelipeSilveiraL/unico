<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiEmpDepNF.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>EMPRESA X DEPARTAMENTO NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="NF.php?pg=<?= $_GET['pg'] ?>">NF</a></li>
        <li class="breadcrumb-item">EMPRESA X DEPARTAMENTO NF</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->
  
  </style>
  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <a href="novaRegraEmpDepNF.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra departamento" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioEmpDepNF.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>
          
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">DEPARTAMENTO</th>
                  <th scope="col" class="capitalize">GERENTE APROVA</th>
                  <th scope="col" class="capitalize">SUPERINTENDENTE APROVA</th>
                  <th scope="col" class="capitalize">SITUAÇÃO</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                  $empDep = "SELECT * FROM bpm_nf_emp_dep ORDER BY NOME_EMPRESA ASC";

                  $sucesso = $conn->query($empDep);

                  while($row = $sucesso->fetch_assoc()){
                    $situacao = $row['SITUACAO'];
                    $gerente = $row['GERENTE_APROVA'];
                    $super = $row['SUPERINTENDENTE_APROVA'];

                    $pesquisa = "SELECT * FROM bpm_nf_departamento WHERE ID_DEPARTAMENTO = ".$row['ID_DEPARTAMENTO']."";
                    $sucesso = $conn->query($pesquisa);

                    if($situacao == 'A'){
                      $situacao = 'ATIVO';
                    }else{
                      $situacao = 'DESATIVADO';
                    }

                    if($gerente == 'S'){
                      $gerente = 'SIM';
                    }else{
                      $gerente = 'NÃO';
                    }

                    if($super == 'S'){
                      $super = 'SIM';
                    }else{
                      $super = 'NÃO';
                    }

                    echo '<tr>
                    <td>'.$row['ID_EMPDEP'].'</td>
                    <td>'.$row['NOME_EMPRESA'].'</td>';
                    while($row2 = $sucesso->fetch_assoc()){
                      echo' <td>'.$row2['NOME_DEPARTAMENTO'].'" </td>';
                    }echo'
                    <td>'.$gerente.'</td>
                    <td>'.$super.'</td>
                    <td>'.$situacao.'</td>
                    <td ' . $usuarioFuncao . '><a href="editEmpDepNF.php?pg=' . $_GET["pg"] . '&id=' . $row["ID_EMPDEP"] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                            
                    <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarEmpDepNF.php?pg='.$_GET['pg'].'&id=' . $row["ID_EMPDEP"] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
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