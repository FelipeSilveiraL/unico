<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>DEPARTAMENTO RH</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">DEPARTAMENTO RH</li>
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
            <a href="novaRegraDep.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra departamento" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioDepartamentoRH.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>
          
          <div class="card-body">
          <h5 class="card-title">Departamento rg </h5>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">NOME DEPARTAMENTO</th>
                  <th scope="col" class="capitalize">SITUAÇÃO</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?> >AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php

                  $sucesso = oci_parse($connBpmgp, $departrh);
                  oci_execute($sucesso);

                  while($row = oci_fetch_array($sucesso, OCI_ASSOC)){
                    
                    $situacao = $row['SITUACAO'];

                    if($situacao == 'A'){
                      $situacao = 'Ativo';
                    }else{
                      $situacao = 'Desativado';
                    }

                    echo '<tr>
                    <td>'.$row['ID_DEPARTAMENTO'].'</td>
                    <td>'.$row['NOME_DEPARTAMENTO'].'</td>
                    <td>'.$situacao.'</td>
                    <td ' . $usuarioFuncao . '>
                    <a href="editDep.php?pg=' . $_GET["pg"] . '&id_departamento=' . $row["ID_DEPARTAMENTO"] . '" title="Editar" class="btn-primary btn-sm" > <i class="bi bi-pencil"></i></a>
                    <a href="../inc/deletarDep.php?pg=' . $_GET["pg"] . '&id=' . $row["ID_DEPARTAMENTO"] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm"> <i class="bi bi-trash"></i></a>
                    </td> 
                 
                    </tr>';
                    
                  }

                  oci_free_statement($sucesso);
                  oci_close($connBpmgp);

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