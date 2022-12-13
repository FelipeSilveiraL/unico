<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSeminovos.php');
require_once('../config/query.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>FORNECEDORES TRIAGEM</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">FORNECEDORES TRIAGEM</li>
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
            <a href="novaRegraSeminovos.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioSeminovos.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>
          
          <div class="card-body">
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">CNPJ</th>
                  <th scope="col" class="capitalize">RAZÃO SOCIAL</th>
                  <th scope="col" class="capitalize">CIDADE</th>
                  <th scope="col" class="capitalize">UF</th>
                  <th scope="col" class="capitalize">SMARTSHARE LOGIN</th>
                  <th scope="col" class="capitalize">EMAIL</th>
                  <th scope="col" class="capitalize">RESPONSAVEL</th>
                  <th scope="col" class="capitalize">ATIVO</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>

                </tr>
              </thead>
              <tbody>
                <?php

                $conexao = $conn->query($tabelaSeminovos);

                while (($fornecedoresSeminovos = $conexao->fetch_assoc()) != FAlSE) {
                  
                  if($fornecedoresSeminovos['ATIVO'] == 'S'){
                    $ativo = 'SIM';
                  }else{
                    $ativo = "NÃO";
                  }
                  echo '<tr>';
                  echo '<td>' . str_pad($fornecedoresSeminovos['CNPJ'] , 14 , '0' , STR_PAD_LEFT) . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['RAZAO_SOCIAL'] . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['CIDADE'] . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['UF'] . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['SMARTSHARE_LOGIN'] . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['EMAIL'] . '</td>';
                  echo '<td>' . $fornecedoresSeminovos['NOME_RESPONSAVEL'] . '</td>';
                  echo '<td>' . $ativo . '</td>';
                  echo '<td ' . $usuarioFuncao . '><a href="editSeminovos.php?pg=' . $_GET["pg"] . '&id_semi=' . $fornecedoresSeminovos["ID_FORNECEDOR"] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                       <a href="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/deletarFor.php?pg='.$_GET['pg'].'&id_fornecedor=' . $fornecedoresSeminovos["ID_FORNECEDOR"] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a></td>
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