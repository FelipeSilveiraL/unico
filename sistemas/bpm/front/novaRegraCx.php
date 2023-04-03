<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>">USUÁRIOS CAIXA</a></li>
        <li class="breadcrumb-item">USUÁRIOS CAIXA</li>
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
            <br>
            <form method="POST" action="../inc/novaRegraCxUs.php?pg=<?= $_GET['pg'] ?>">
              <div class="row mb-3">
                <label for="user" class="col-sm-2 col-form-label">EMPRESA:<span style="color: red;">*</span></label>
                <div class="col-md-6">
                  <select class="form-select" id="empresa" name="empresa" required>
                    <option value="">--------------</option>
                    <?php
                    $queryEmpresa .= " ORDER BY ID_EMPRESA ASC";
                    $result = oci_parse($connBpmgp, $queryEmpresa);
                    oci_execute($result, OCI_COMMIT_ON_SUCCESS);

                    while (($row = oci_fetch_array($result, OCI_ASSOC)) != false) {

                      $idEmp = $row['ID_EMPRESA'];

                      //   $queryCxEmp = "SELECT NOME_CAIXA FROM caixa_empresa WHERE ID_EMPRESA = ".$idEmp;

                      //   $result2 = oci_parse($connBpmgp, $queryCxEmp);
                      //   oci_execute($result2,OCI_COMMIT_ON_SUCCESS);

                      // if (($a = oci_fetch_assoc($result2, OCI_ASSOC)) != false) {
                      //     $idCxEmp = $a['NOME_CAIXA'];
                      //   }else{
                      //   $idCxEmp = '';                                
                      //   }


                      // echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].' /  '.$idCxEmp.'</option>';
                      echo '<option value="' . $row['ID_EMPRESA'] . '">' . $row['NOME_EMPRESA'] . '</option>';
                    }

                    ?>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nomeCaixa" class="col-sm-2 col-form-label">NOME CAIXA:<span style="color: red;">*</span></label>
                <div class="col-md-6">
                  <select class="form-select" name="nomeCaixa" id="nomeCaixa" required>

                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="sistema" class="col-sm-2 col-form-label">USUÁRIOS CAIXA:<span style="color: red;">*</span></label>
                <div class="col-md-6">
                  <select class="form-select" name="userCaixa" required>
                    <?php
                    echo '<option value=""> ------------ </option>';


                    $userConexao = oci_parse($connSelbetti, $query_user);
                    oci_execute($userConexao, OCI_COMMIT_ON_SUCCESS);

                    while (($selbettiQuery = oci_fetch_array($userConexao, OCI_ASSOC)) != false) {
                      echo '<option value="' . $selbettiQuery['DS_LOGIN'] . '">' . $selbettiQuery['DS_USUARIO'] . ' / ' . $selbettiQuery['DS_LOGIN'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="text-left">
                <button type="button" class="btn btn-primary"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><br>
          </div>
        </div>



      </div>


    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>
<script>
  $("#empresa").on("change", function() {
    var idEstado = $("#empresa").val();

    $.ajax({
      url: '../inc/trazNomeCaixa.php',
      type: 'POST',
      data: {
        id: idEstado
      },
      beforeSend: function(data) {
        $("#nomeCaixa").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#nomeCaixa").html(data);
      },
      error: function(data) {
        $("#nomeCaixa").html('<option value="">Erro ao carregar...</option>');
      }

    });

  });
</script>