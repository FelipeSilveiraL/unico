<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

//APIS
require_once('../../bpm/inc/apiRecebeTabela.php');//EMPRESAS
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Fornecedores</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">Fornecedor</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <!--################# COLE section AQUI #################-->

  <section>
    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Lista Fornecedores Rateados
              <a href="rateioFornecedor.php" class="btn btn-success button-rigth-espelho" style="margin-top: -3px;">
                <i class="bx bxs-plus-square"></i>
              </a>
            </h5>

            <table class="table table-borderless datatable">
              <thead>
                <tr class="capitalize">
                  <th scope="col">CNPJ&emsp;</th>
                  <th scope="col">FORNECEDOR&emsp;</th>
                  <th scope="col">FILIAL&emsp;</th>
                  <th scope="col">SISTEMA&emsp;</th>
                  <th scope="col">AÇÃO&emsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $queryFornecedor .= " WHERE id_usuario = " . $_SESSION['id_usuario'];
                $resultadoFor = $connNOTAS->query($queryFornecedor);
                while ($fornecedor = $resultadoFor->fetch_assoc()) {
                  
                  $buscaNomeFilial = "SELECT NOME_EMPRESA FROM bpm_empresas WHERE ID_EMPRESA = ".$fornecedor['ID_FILIAL'];

                  $plica = $conn->query($buscaNomeFilial);
                  $nomeEmpresa = $plica->fetch_assoc();

                  echo '<tr>                          
                            <td>' . $fornecedor['cpfcnpj_fornecedor'] . '</td>
                            <td>' . $fornecedor['fornecedor'] . '</td>
                            <td>' . $nomeEmpresa['NOME_EMPRESA'] . '</td>
                            <td>'; echo $fornecedor['sistema'] == 1 ? 'FLUIG' : 'SMARTSHARE'; echo '</td>
                            <td>
                              <a href="rateioFornecedor.php?idRateioFornecedor='.$fornecedor['ID_RATEIOFORNECEDOR'].'" title="Editar" class="btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                              <a href="../inc/deletarFornecedor.php?idRateioFornecedor='.$fornecedor['ID_RATEIOFORNECEDOR'].'" title="Desativar" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                          </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- End Recent Sales -->
    </div>

  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>