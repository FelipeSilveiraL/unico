<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA VENDEDORES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">Vendas</a></li>
        <li class="breadcrumb-item">NOVA REGRA VENDEDORES</li>
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
     
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraVendedores.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="empresa" id="empresa" required>
                  <option value="">Selecione a empresa</option>
                    <?php 
                      $sucesso = $conn->query($queryTabela);

                          while($row1 = $sucesso->fetch_assoc()){
                            echo '<option value="'.$row1['ID_EMPRESA'].'">'.$row1['NOME_EMPRESA'].'</option>';
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
                  <option value="">Selecione o nome</option>
                  <?php

                  $mostraUsuario = "SELECT DS_USUARIO FROM bpm_usuarios_smartshare order by DS_USUARIO ASC";

                  $sucesso3 = $conn->query($mostraUsuario);

                  while ($row3 = $sucesso3->fetch_assoc()) {
                    echo '<option value="' . $row3['DS_USUARIO'] . '">' . $row3['DS_USUARIO'] . '</option>';
                  }

                  ?>
                </select>
                <label for="nome" class="capitalize">NOME:<code>*</code></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="cpfValue">
                <select class="form-select" name="cpfValue" id="cpfVet" required>
                  <option value="">-------------------</option>
                </select>
                <label for="cpf" class="capitalize">CPF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="cpfShow" style="display:none;">
                <input class="form-control" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" onblur="ValidarCPF(this)" name="cpfValue" required >
                <label for="cpf" class="capitalize">CPF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-control" id="login_smartshare" name="login_smartshare" required>
                  <option value="">-------------------</option>
                </select>
                <label for="login_smartshare" class="capitalize">LOGIN SMARTSHARE:<code>*</code></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<code>*</code></label>
              </div>

              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/vendedores.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="button" class="btn btn-secondary" onclick="mostrarBotao()">Cadastrar CPF</button>
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
  function mostrarBotao() {
    var tela = document.getElementById("cpfValue").style.display;

    if (tela == "block") {
      document.getElementById("cpfShow").style.display = "block";
      document.getElementById("cpfShow").required = true;
      document.getElementById("cpfValue").style.display = "none";
      document.getElementById("cpfVet").required = false;
      document.getElementById("cpfVet").value = "";
    } else {
      document.getElementById("cpfValue").style.display = "block";
      document.getElementById("cpfValue").required = true;
      document.getElementById("cpfShow").style.display = "none";
      document.getElementById("cpfShow").required = false;
      
    }
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