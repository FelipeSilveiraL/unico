<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA CAIXA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="caixaEmpresa.php?pg=<?= $_GET['pg'] ?>">CAIXA EMPRESA</a></li>
        <li class="breadcrumb-item">NOVA REGRA CAIXA EMPRESA</li>
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
            <h5 class="card-title">Nova regra caixa empresa </h5>
            <form method="POST" action="../inc/novaRegraCxEmpresa.php?pg=<?= $_GET['pg'] ?>">
              <div class="row mb-3">
                <label for="user" class="col-sm-2 col-form-label">EMPRESA:<span style="color: red;">*</span></label>
                <div class="col-md-6">
                  <select class="form-select" id="empresa" name="empresa" required>
                    <?php

                    if (!empty($_GET['id'])) {
                      $display = "block";
                      $dado = "SELECT * FROM empresa WHERE ID_EMPRESA =  '" . $_GET['id'] . "'";
                      $conexao = oci_parse($connBpmgp, $dado);
                      oci_execute($conexao);

                      while ($row2 = oci_fetch_array($conexao, OCI_ASSOC)) {
                        echo '<option value="' . $row2['ID_EMPRESA'] . '">' . $row2['NOME_EMPRESA'] . '</option>';
                      }

                      oci_free_statement($conexao);
                      
                    } else {
                      $display = "none;";
                    }

                    ?>

                    <option value="">--------------</option>
                    <?php

                    $dado = "SELECT * FROM empresa WHERE SITUACAO =  'A'";

                    $result = oci_parse($connBpmgp, $dado);
                    oci_execute($result);
                    //faz pesquisa no bd 
                    while ($row = oci_fetch_array($result, OCI_ASSOC)) {
                      echo '<option value="' . $row['ID_EMPRESA'] . '">' . $row['NOME_EMPRESA'] . '</option>';
                    }
                    oci_free_statement($result);

                    ?>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nomeCaixa" class="col-sm-2 col-form-label">NOME CAIXA</label>
                <div class="col-md-6">
                  <input class="form-control" id="nomeCaixa" name="nomeCaixa" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="numeroCaixa" class="col-sm-2 col-form-label">NÚMERO CAIXA</label>
                <div class="col-md-6">
                  <input class="form-control" onkeypress='validate(event)' id="numeroCaixa" name="numeroCaixa">
                </div>
              </div>
              <div class="text-left">
                <button type="button" class="btn btn-primary"><a href="<?= (!empty($_GET['id'])) ? 'userCaixa.php?pg=' . $_GET['pg'] . '' : 'caixaEmpresa.php?pg=' . $_GET['pg'] . ''; ?>" style="color:white;">Voltar</a></button>
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
  function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
    } else {
      // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
      theEvent.returnValue = false;
      if (theEvent.preventDefault) theEvent.preventDefault();
    }
  }
</script>