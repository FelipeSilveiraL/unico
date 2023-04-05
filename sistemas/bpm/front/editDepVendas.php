<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITAR DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">Vendas</a></li>
        <li class="breadcrumb-item">EDITAR DEPARTAMENTO</li>
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
          <h5 class="card-title">Editar departamento </h5>
            <form class="row g-3" action="../inc/editDepVendas.php?pg=<?= $_GET['pg'] ?>&id_dep=<?= $_GET['id_dep'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php

              $depVendasQuery .= " WHERE ID = ".$_GET['id_dep']."";
              $sucesso = oci_parse($connBpmgp, $depVendasQuery);
              oci_execute($sucesso);

              while($row = oci_fetch_array($sucesso, OCI_ASSOC))
              {
                  echo '
              <div class="form-floating mt-4 col-md-6">
                <input class="form-control" id="dep" value="'.$row['NOME_DEPARTAMENTO'].'" name="departamento" required>
                <label for="filial">DEPARTAMENTO:<code>*</code></label>
              </div>';
                  }
                  oci_free_statement($sucesso);
                  oci_close($connBpmgp);
                     ?>
              <div class="text-left py-2">
                <a href="gerentes.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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
  $("#nome").on("change", function() {
    var idUsuario = $("#nome").val();

    $.ajax({
      url: '../inc/trazUsuario.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#cpfVet").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#cpfVet").html(data);
      },
      error: function(data) {
        $("#cpfVet").html('<option value="">Erro ao carregar...</option>');
      }

    });

    $.ajax({
      url: '../inc/trazLogin.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#login_smartshare").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#login_smartshare").html(data);
      },
      error: function(data) {
        $("#login_smartshare").html('<option value="">Erro ao carregar...</option>');
      }

    });

  });
</script>