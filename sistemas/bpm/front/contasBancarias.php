<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>CONTAS BANCARIAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">CONTAS BANCARIAS</li>

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
            <a href="novaRegraContasBancarias.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Nova regra aprovadores" <?= $usuarioFuncao ?>><i class="bx bxs-file-plus"></i></a>

            <a href="../inc/relatorioContasBancarias.php" type="button" class="btn btn-success" style="float: right;" title="Exportar excel"><i class="ri-file-excel-2-fill"></i></A>
          </div>

          <div class="card-body">
            <h5 class="card-title">Contas bancárias </h5>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">CNPJ / CPF</th>
                  <th scope="col" class="capitalize">NOME EMPRESA</th>
                  <th scope="col" class="capitalize">BANCO</th>
                  <th scope="col" class="capitalize">AGÊNCIA</th>
                  <th scope="col" class="capitalize">CONTA</th>
                  <th scope="col" class="capitalize">DIGITO</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $conexao = oci_parse($connBpmgp, $contasBancarias);
                oci_execute($conexao);

                while ($contaBancariasFornecedor = oci_fetch_array($conexao, OCI_ASSOC)) {

                  echo '<tr>';
                  echo '<td>' . $contaBancariasFornecedor['CNPJ_CPF'] . '</td>';
                  echo '<td>' . $contaBancariasFornecedor['NOME_EMPRESA'] . '</td>';
                  echo '<td>' . $contaBancariasFornecedor['BANCO'] . '</td>';
                  echo '<td>' . $contaBancariasFornecedor['AGENCIA'] . '</td>';
                  echo '<td>' . $contaBancariasFornecedor['CONTA'] . '</td>';
                  echo '<td>' . $contaBancariasFornecedor['DIGITO'] . '</td>';
                  echo '<td ' . $usuarioFuncao . '><a href="editContasBancarias.php?pg=' . $_GET["pg"] . '&id_conta=' . $contaBancariasFornecedor["ID_CONTA"] . '" title="Editar" class="btn-primary btn-sm" ><i class="bi bi-pencil"></i></a>
                  <a href="../inc/deletarCont.php?pg=' . $_GET['pg'] . '&id_conta=' . $contaBancariasFornecedor["ID_CONTA"] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm" ><i class="bi bi-trash"></i></a></td>
                 </tr>';
                }
                oci_free_statement($conexao);
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