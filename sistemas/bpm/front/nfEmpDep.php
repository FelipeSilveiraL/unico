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
          <h5 class="card-title"> Empresa x departamento nf</h5>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">DEPARTAMENTO</th>
                  <th scope="col" class="capitalize">GERENTE APROVA</th>
                  <th scope="col" class="capitalize">SUPERINTENDENTE<br>APROVA</th>
                  <th scope="col" class="capitalize">SITUAÇÃO</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                  $empDepNF = "SELECT * FROM bpm_nf_emp_dep ORDER BY ID_EMPDEP ASC";
                  
                  $sucesso = $conn->query($empDepNF);

                  while($row = $sucesso->fetch_assoc()){

                    $nomeEmp = "SELECT NOME_EMPRESA FROM bpm_empresas WHERE ID_EMPRESA = ".$row['ID_EMPRESA']."";

                    $a = $conn->query($nomeEmp);

                      while($exibeNome = $a->fetch_assoc()){
                        $nome = $exibeNome['NOME_EMPRESA'];
                      }

                      $nomeDep = "SELECT NOME_DEPARTAMENTO FROM bpm_nf_departamento WHERE ID_DEPARTAMENTO = ".$row['ID_DEPARTAMENTO']."";

                        $b = $conn->query($nomeDep);

                          while($nomeDep = $b->fetch_assoc()){
                            $dep = $nomeDep['NOME_DEPARTAMENTO'];
                          }
                          if($row['SITUACAO'] == "A"){
                            $situacao = "ATIVO";
                          }else{
                            $situacao = "DESATIVADO";
                          }
                          if($row['GERENTE_APROVA'] == "N"){
                            $gerente = "NÃO";
                          }else{
                            $gerente = "SIM";
                          }
                          if($row['SUPERINTENDENTE_APROVA'] == "N"){
                            $super = "NÃO";
                          }else{
                            $super = "SIM";
                          }
                    echo '<tr>';
                    echo '<td>'.$row['ID_EMPDEP'].'</td>';
                    echo '<td>'.$nome.'</td>';
                    echo '<td>'.$dep.'</td>';
                    echo '<td>'.$gerente.'</td>';
                    echo '<td>'.$super.'</td>';
                    echo '<td>'.$situacao.'</td>';
                    echo '<td ' . $usuarioFuncao . '><a href="editEmpDepNF.php?pg=' . $_GET["pg"] . '&id=' . $row["ID_EMPDEP"] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                            
                    <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarEmpDepNF.php?pg='.$_GET['pg'].'&id=' . $row["ID_EMPDEP"] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
                    </td>';
                    echo '</tr>';
                  }
                  $conn->close();

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