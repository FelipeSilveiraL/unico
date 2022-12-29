<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Relatórios</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">relatórios</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3" action="../inc/relatorio.php" method="post">

              <h5 class="card-title">Dados Fornecedor</h5>

              <div id="divFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="cnpjVet" maxlength="15" placeholder="CNPJ / CPF Fornecedor" name="cpfCnpjFor">
                  <label for="cpfCnpjFor">CNPJ / CPF Fornecedor</label>
                </div>
              </div>

              <div id="divNomeFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="NomeFornecedor" placeholder="Fornecedor" name="NomeFornecedor" maxlength="100" readonly>
                  <label for="NomeFornecedor">Nome fornecedor</label>
                </div>
              </div>

              <h5 class="card-title">Dados Nota Fiscal</h5>

              <div class="mb-3 form-floating col-md-6">
                <input type="text" class="form-control" name="numeroNota">
                <label for="numeroNota">Número Nota</label>
              </div>
              
              <div class="mb-3 form-floating col-md-6">
                <input type="text" class="form-control" name="numeroNota">
                <label for="numeroNota">Número Smartshare</label>
              </div>

              <h5 class="card-title">Dados Lançamento</h5>

              <div class="form-floating col-md-6">
                <input type="date" class="form-control" name="lancamentoInicio">
                <label for="emissao">Data lançamento - Inicio</label>
              </div>
              <div class="form-floating col-md-6">
                <input type="date" class="form-control" name="lancamentoFim">
                <label for="emissao">Data lançamento - Fim</label>
              </div>

              <!--DADOS PRINCIPAIS -->
              <h5 class="card-title">Dados Principais</h5>

              <div id="divFilial" class="form-floating mb-3 col-md-12">
                <select class="form-select" id="selectFilial" name="filial">
                  <option value="">-----------------</option>
                  <?php
                  $resultFilialLista = $conn->query($queryFilial);
                  while ($filialLista = $resultFilialLista->fetch_assoc()) {
                    echo '<option value="' . $filialLista['NOME_EMPRESA'] . '">' . $filialLista['NOME_EMPRESA'] . '</option> ';
                  }
                  ?>
                </select>
                <label for="selectFilial">Filial</label>
              </div>

              <!-- BOTÃO DO FORMULARIOS -->
              <div class="text-center py-5">
                <hr>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success" id="enviarNota">Buscar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div><!-- FIM col-lg-12 -->
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>

<!--CNPJ FORNCENDOR-->
<script>
  $(function() {
    $(".money").maskMoney({
      prefix: 'R$ ',
      allowNegative: true,
      thousands: '.',
      decimal: ',',
      affixesStay: false
    });
  })

  $("#cnpjVet").on("blur", function() {
    var cpfCNPJ = $("#cnpjVet").val();
    var nomefilial = $("#selectFilial").val();

    $.ajax({

      url: '../inc/buscaFornecedor.php',
      type: 'POST',
      data: {
        tipo: '1',
        idFilial: nomefilial,
        id: cpfCNPJ
      },

      beforeSend: function(data) {
        $("#NomeFornecedor").val('Aguarde...');
      },

      success: function(data) {
        if (!data) {

          $("#NomeFornecedor").val('Não Localizado...');
          $("#enviarNota").attr("disabled", true);

        } else {

          var dados = data.split('-');

          $("#NomeFornecedor").val(dados[0]);

        }
      },

      error: function(data) {
        $("#NomeFornecedor").val('Erro ao carregar...');
      }

    });
  });
</script>