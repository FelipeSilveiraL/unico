<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>CAIXA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">CAIXA EMPRESA</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">
            <a href="novaRegraCxEmpresa.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Importar Usuários" <?= $usuarioFuncao ?>><i class="bi bi-plus-lg"></i></a>
          </div><br>
          <div class="card-body">

            <h5 class="card-title"> Caixa empresa</h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">ID CAIXA EMPRESA</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">CAIXA</th>
                  <th scope="col" class="capitalize">NÚMERO CAIXA</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $cxEmpresaQuery = "SELECT

                CE.id_caixa_empresa,
                CE.id_empresa,
                E.nome_empresa,
                CE.nome_caixa,
                CE.NUMERO_CAIXA_SISTEMA
                
                from caixa_empresa CE
                
                LEFT JOIN empresa E ON (CE.id_empresa = E.id_empresa)";

                $result = oci_parse($connBpmgp, $cxEmpresaQuery);
                oci_execute($result);

                while ($row = oci_fetch_array($result, OCI_ASSOC)) {
                  $id = $row['ID_EMPRESA'];
                  $dado = $row['id'];
                  $caixaEmpresa = $row['ID_CAIXA_EMPRESA'];
                  $nomeEmpresa = $row['NOME_EMPRESA'];
                  $nomeCaixa = $row['NOME_CAIXA'];
                  $numeroCaixa = $row['NUMERO_CAIXA_SISTEMA'];


                  echo '<tr>
                <td>' . $caixaEmpresa . '</td>
                <td>' . $nomeEmpresa . '</td>
                <td>' . $row["NOME_CAIXA"] . '</td>
                <td>' . $numeroCaixa . '</td>
                <td><a href="editCxEmpresa.php?pg=' . $_GET['pg'] . '&id=' . $caixaEmpresa . '"  title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                          
                <a href="../inc/deletarCxEmpresa.php?pg=' . $_GET['pg'] . '&id_empresa=' . $id . '&nomeCaixa=' . $nomeCaixa . '&id_caixa_empresa=' . $dado . '" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>';

                  echo '</tr>';
                }
                oci_free_statement($result);



                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>