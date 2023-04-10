<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
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

                $resultado = oci_parse($connBpmgp, $gerentesQuery);
                oci_execute($resultado);

                while ($row = oci_fetch_array($resultado, OCI_ASSOC)) {

                  if ($row['SITUACAO'] == 'A') {
                    $situacao = 'ATIVO';
                  } else {
                    $situacao = 'DESATIVADO';
                  }
                  echo '<tr>';
                  echo '<td>' . $row['ID_GERENTE'] . '</td>';
                  echo '<td>' . $row['NOME_EMPRESA'] . '</td>';
                  echo '<td>' . $row['NOME_DEPARTAMENTO'] . '</td>';
                  echo '<td>' . $row['NOME'] . '</td>';
                  echo '<td>' . $row['LOGIN_SMARTSHARE'] . '</td>';
                  echo '<td>' . $row['CODIGO_LOGIN_SMARTSHARE'] . '</td>';
                  echo '<td>' . $situacao . '</td>';
                  echo '<td><a href="editGerente.php?pg=' . $_GET["pg"] . '&id_gerente=' . $row["ID_GERENTE"] . '" title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                    <a href="../inc/deletarGerente.php?pg=' . $_GET['pg'] . '&id=' . $row['ID_GERENTE'] . '" title="Desativar" ' . $usuarioFuncao . ' style="margin-top: 3px;color: white;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a>
                    </td> 
                    </tr>';
                }
                oci_free_statement($resultado);
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