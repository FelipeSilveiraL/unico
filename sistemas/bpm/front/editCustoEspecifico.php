<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITANDO CUSTO VEÍCULO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>">CUSTO VEÍCULO</a></li>
        <li class="breadcrumb-item">EDITANDO CUSTO VEÍCULO</li>
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
          <div class="card-body">
            <h5 class="card-title">Editar custo veículo </h5>
            <form class="row g-3" action="../inc/editCVeiculos.php?pg=<?= $_GET['pg'] ?>&id_codigo=<?= $_GET['id_conta'] ?>" id="formularioVeiculos" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php
              $idConta = $_GET['id_conta'];
              $queryCustoVeiculo .= " WHERE ID_CODIGO_CUSTO_VEICULO = " . $idConta;
              $conexao = oci_parse($connBpmgp, $queryCustoVeiculo);
              oci_execute($conexao);

              while ($row = oci_fetch_array($conexao, OCI_ASSOC)) {
                $nomeEmpresa = $row['NOME_EMPRESA'];
                $idEmpresas = $row['ID_EMPRESA'];
                $tipoCusto = $row['TIPO_CUSTO'];
                $anoReferencia = $row['ANO_REFERENCIA'];
                $custoERP = $row['CODIGO_CUSTO_ERP'];

                switch ($row['TIPO_CUSTO']) {
                  case 'L':
                    $tipoCustoNome = 'Licenciamento';
                    break;
                  case 'M':
                    $tipoCustoNome = 'Multa';
                    break;
                  case 'T':
                    $tipoCustoNome = 'Triagem';
                    break;
                  case 'I';
                    $tipoCustoNome = "IPVA";
                    break;
                }
              }
              ?>
              <div class="form-floating mt-4 col-md-4" id="NOME_EMPRESA">
                <input class="form-control" value="<?= $nomeEmpresa ?>" readonly>
                <input type="text" name="id_empresa" id="idEmpresa" value="<?= $idEmpresas?>" style="display: none">

                <label for="NOME_EMPRESA">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-4">
                <select class="form-control" name="tipo_custo" readonly>
                  <option value="<?= $tipoCusto ?>"><?= $tipoCustoNome ?></option>
                </select>
                <label for="estados">TIPO DE CUSTO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="custo">
                <select class="form-select" name="erp" id="erp">
                  <option value="<?= $custoERP ?>"><?= $custoERP ?></option>
                </select>
                <label for="custo" class="col-sm-6 col-form-label">CUSTO ERP:</label>
              </div>

              <div class="text-left py-2">
                <a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div>
    </div> <!-- FIM col-lg-12 -->
  </section><!-- FIM section -->
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>
<script>
  $(document).ready(function() {
    var idErp = $("#erp").val();
    var idEmpresa = $("#idEmpresa").val();

    $.ajax({
      url: '../inc/coletandoDados.php',
      type: 'POST',
      data: {idERP: idErp, idEMPRESA: idEmpresa},
      beforeSend: function(data) {
        $("#erp").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#erp").html(data);
      },
      error: function(data) {
        $("#erp").html('<option value="">Erro ao carregar...</option>');
      }

    });

  });
</script>