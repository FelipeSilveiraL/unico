<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA GERENTE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="gerentes.php?pg=<?= $_GET['pg'] ?>">Gerentes</a></li>
        <li class="breadcrumb-item">NOVA REGRA GERENTE</li>
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

            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraGerentes.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="empresa" id="empresa" required>
                  <option value="">Selecione a empresa</option>
                  <?php
                  $sucesso = $conn->query($queryTabela);
                  while ($row1 = $sucesso->fetch_assoc()) {
                    echo '<option value="' . $row1['ID_EMPRESA'] . '">' . $row1['NOME_EMPRESA'] . '</option>';
                  }
                  ?>
                </select>
                <label for="empresa" class="capitalize">EMPRESA:<code>*</code></label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="departamento" id="departamento" required>
                  <option value="">Selecione o departamento</option>
                  <?php

                  $sucesso2 = $conn->query($depVendasQuery);
                  while ($row2 = $sucesso2->fetch_assoc()) {
                    echo '<option value="' . $row2['ID_DEPARTAMENTO'] . '">' . $row2['NOME_DEPARTAMENTO'] . '</option>';
                  }
                  ?>
                </select>
                <label for="filial" class="capitalize">DEPARTAMENTO:<code>*</code></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="nome" id="nome">
                  <option value="">---------------------------------------------------------</option>
                  <?php

                  $mostraUsuario = "SELECT DS_USUARIO FROM bpm_usuarios_smartshare order by DS_USUARIO ASC";

                  $sucesso = $conn->query($mostraUsuario);

                  while ($row = $sucesso->fetch_assoc()) {
                    echo '<option value="' . $row['DS_USUARIO'] . '">' . $row['DS_USUARIO'] . '</option>';
                  }

                  ?>
                </select>
                <label for="nome" class="capitalize">NOME:<code>*</code></label>
              </div>

              <div class="form-floating mt-4 col-md-6">

                <input name="cpfVet" type="text" class="form-control" id="cpfVet" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" onblur="ValidarCPF(this)" value="" disabled>
                <label for="cpfVet" class="capitalize">CPF:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <input name="login_smartshare" type="text" class="form-control" id="login_smartshare" disabled>
                <label for="login_smartshare" class="capitalize">LOGIN SMARTSHARE:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/gerentes.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>

                <button type="button" onclick="liberar()" id='addCPFSelbetti' style="margin-left: 426px; display: none;" class="btn btn-warning">Liberar campo CPF</button>
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
  function liberar() {
    document.getElementById("cpfVet").disabled = false;
    document.getElementById("cpfVet").value = ' ';
    document.getElementById("cpfVet").focus();
  }

  $("#nome").on("change", function() {
    var idUsuario = $("#nome").val();

    $.ajax({

      url: '../inc/trazUsuario.php',
      type: 'POST',
      data: {
        id: idUsuario
      },

      beforeSend: function(data) {
        $("#cpfVet").val('Carregando...');
      },

      success: function(data) {

        $("#cpfVet").val(data);

        if (data === "CPF não localizado no RH, favor verificar") {
          $("#addCPFSelbetti").show();
        } else {
          $("#addCPFSelbetti").hide();
        }
      },

      error: function(data) {
        $("#cpfVet").val('Erro ao carregar...');
      }

    });



    $.ajax({
      url: '../inc/trazLogin.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#login_smartshare").val('Carregando...');
      },
      success: function(data) {
        $("#login_smartshare").val(data);
      },
      error: function(data) {
        $("#login_smartshare").val('Erro ao carregar...');
      }

    });
  });
</script>