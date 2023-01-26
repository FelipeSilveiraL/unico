<?php
session_start();

require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

//API
require_once('../../bpm/inc/apiRecebeTabela.php'); //Empresas
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Lançamento Manual</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">Lançamento Manual</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <!--################# COLE section AQUI #################-->
  <p></p>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3" action="../inc/lancamento.php" method="post" enctype="multipart/form-data">

              <!--DADOS PRINCIPAIS -->
              <h5 class="card-title">Dados Principais</h5>

              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control" value="<?= $_SESSION['nome_usuario'] ?>" readonly>
                <input type="text" name="usuarioResponsavel" value="<?= $_SESSION['id_usuario'] ?>" style="display: none;">
                <label for="floatingSelect" class="capitalize">Usuario responsável </label>
              </div>

              <div id="divFilial" class="form-floating mb-3 col-md-6">
                <select class="form-select" id="selectFilial" name="filial" required>
                  <option value="">-----------------</option>
                  <?php
                  $resultFilialLista = $conn->query($queryFilial);
                  while ($filialLista = $resultFilialLista->fetch_assoc()) {
                    echo '<option value="' . $filialLista['ID_EMPRESA'] . '">' . $filialLista['NOME_EMPRESA'] . '</option> ';
                  }
                  ?>
                </select>
                <label for="selectFilial">Filial <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Caso não esteja encontrando a FILIAL, abra um chamado no <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi/front/ticket.form.php" target="_blank">GLPI</a> ao departamento <b>Smartshare</b></span>

              <h5 class="card-title">Dados Fornecedor</h5>

              <div id="divFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="cnpjVet" maxlength="15" placeholder="CNPJ / CPF Fornecedor" name="cpfCnpjFor" required>
                  <label for="cpfCnpjFor">CNPJ / CPF Fornecedor <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <div id="divNomeFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="NomeFornecedor" placeholder="Fornecedor" name="NomeFornecedor" maxlength="100" readonly>
                  <label for="NomeFornecedor">Nome fornecedor <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Caso não esteja encontrando o FORNECEDOR, abra um chamado no <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi/front/ticket.form.php" target="_blank">GLPI</a> ao departamento <b>Smartshare</b></span>

              <!--DADOS DO PAGAMENTOL -->
              <h5 class="card-title">Dados Pagamento</h5>

              <div class="form-floating mb-3 col-md-12">
                <select readonly="readonly" class="form-select" id="tipoPagamento" name="tipoPagamento" onchange="bancos()">                 
                </select>
                <label for="floatingSelect">Tipo pagamento <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="row" id="tipopagamentoBancos" style="display: none">

                <div class="form-floating mb-3 col-md-5">
                  <select class="form-select" id="nomeBanco" name="banco" readonly="readonly">                    
                  </select>
                  <label for="floatingSelect">Banco <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>

                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numAgencia" placeholder="Agência" name="agencia" maxlength="45" readonly>
                    <label for="floatingName">Agência <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numConta" placeholder="Conta" name="conta" maxlength="45" readonly>
                    <label for="floatingName">Conta <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numDigito" placeholder="Dígito" name="digito" maxlength="1" readonly>
                    <label for="floatingName">Dígito <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>

              </div>

              <h5 class="card-title">Dados Nota Fiscal</h5>

              <div class="form-floating col-md-6">
                <select class="form-select" id="tipoDespesaSelect" name="tipodespesa" readonly="readonly">                 
                </select>
                <label for="tipoDespesaSelect">Tipo de Despesa <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div id="divNomeFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" title="Caso seja nota de telefonia" name="telefone" readonly>
                  <label for="telefone">Telefone</label>
                </div>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="departamentoAuditoria" name="departamentoAuditoria" readonly="readonly">
                </select>
                <label for="departamentoAuditoria">Depart. de Auditoria? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="notasGrupoObra" name="notasGrupo" readonly="readonly">
                </select>
                <label for="notasGrupoObra">Obras do G. Servopa? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="notasMarketing" name="notasMarketing" readonly="readonly">
                </select>
                <label for="notasMarketing">Depart. de Marketing? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="mb-3 form-floating col-md-4">
                <input type="text" class="form-control" name="numeroNota" required>
                <label for="numeroNota">Número Nota <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating col-md-4">
                <input type="text" class="form-control" name="serie" required>
                <label for="serie">Série <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>
              <div class="form-floating col-md-4">
                <input type="text" class="form-control dinheiro" id="valorNota" name="valor" maxlength="12" required>
                <label for="valor">Valor <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating col-md-6">
                <input type="date" class="form-control" name="emissao" required>
                <label for="emissao">Emissão <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating col-md-6">
                <input type="date" class="form-control" name="vencimento" required>
                <label for="vencimento">Vencimento <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="col-md-12 mb-3">
                <div class="col-sm-10">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="carimbar">
                    <label class="form-check-label" for="carimbar">Carimbar pelo Robô!</label>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Address" id="observacao" style="height: 100px;" name="observacao" readonly></textarea>
                  <label for="observacao">Observação <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <h5 class="card-title">Anexar documentos</h5>

              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Nota fiscal</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="filenota" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Boleto</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="fileboleto">
                </div>
              </div>

              <div class="card" id="rateioFornecedor">
                <h5 class="card-title">Tabela centro de custo</h5>
                <div class="card-body">
                  <table class="table table-bordered" id="tableCusto">
                  </table>
                </div>
              </div>

              <!-- BOTÃO DO FORMULARIOS -->
              <div class="text-center py-5">
                <hr>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success" id="enviarNota">Salvar</button>
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

<script>$('#valorNota').mask('#.##0,00', {reverse: true});</script>

<script>
  function tipoVencimento() {
    var tipoVencimento = document.getElementById("vencimento").value;

    if (tipoVencimento == 2) { //somatorio

      document.getElementById("dias").style.display = 'none';
      document.getElementById("diasCorridos").style.display = 'block';
      document.getElementById("inputDiascorridos").required = true;
      document.getElementById("diasInput").required = false;

    } else if (tipoVencimento == 3) { //fixo

      document.getElementById("dias").style.display = 'block';
      document.getElementById("diasInput").required = true;
      document.getElementById("diasCorridos").style.display = 'none';
      document.getElementById("inputDiascorridos").required = false;

    } else { //nota fiscal

      document.getElementById("dias").style.display = 'none';
      document.getElementById("diasCorridos").style.display = 'none';
    }

  }


  function diasMaximos() {
    var dias = document.getElementById("diasInput").value;

    if (dias > 31) {
      const date = new Date();
      const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      const lastDayDate = lastDay.toLocaleDateString()
      document.getElementById("diasInput").value = lastDayDate.substr(0, 2);
    }

  }

  function bancos() {
    var tipoPagamento = document.getElementById("tipoPagamento").value;

    if (tipoPagamento == 2) {
      document.getElementById("tipopagamentoBancos").style.display = 'contents';
      document.getElementById("nomeBanco").required = true;
      document.getElementById("numAgencia").required = true;
      document.getElementById("numConta").required = true;
      document.getElementById("numDigito").required = true;
    } else {
      document.getElementById("tipopagamentoBancos").style.display = 'none';
      document.getElementById("nomeBanco").required = false;
      document.getElementById("numAgencia").required = false;
      document.getElementById("numConta").required = false;
      document.getElementById("numDigito").required = false;
    }
  }
</script>


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


  $("#valorNota").on("blur", function() {
    var cpfCNPJ = $("#cnpjVet").val();
    var nomefilial = $("#selectFilial").val();
    var valorNota = $("#valorNota").val();

    $.ajax({
      url: '../inc/valor.php',
      type: 'POST',
      data: {
        idFilial: nomefilial,
        id: cpfCNPJ,
        valor: valorNota
      },

      success: function(data) {

        $("#tableCusto").empty();
        $("#tableCusto").empty(data);
        $("#tableCusto").append(data);        
      }
    })
  });


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

          var tipoPagamento = dados[1];
          $("#tipoPagamento").html(tipoPagamento);


          if (tipoPagamento == '<option value="2">Depósito Bancário</option>') {
            $('#tipopagamentoBancos').css('display', 'contents');
          }

          $("#tipoServicoInput").val(dados[2]);
          $("#tipoDespesaSelect").html(dados[3]);
          $("#telefone").val(dados[4]);
          $("#departamentoAuditoria").html(dados[5]);
          $("#notasGrupoObra").html(dados[6]);
          $("#notasMarketing").html(dados[7]);
          $("#observacao").html(dados[8]);
          $("#nomeBanco").html(dados[9]);
          $("#numAgencia").val(dados[10]);
          $("#numConta").val(dados[11]);
          $("#numDigito").val(dados[12]);


          $("#enviarNota").attr("disabled", false);

        }
      },

      error: function(data) {
        $("#NomeFornecedor").val('Erro ao carregar...');
      }

    });
  });
</script>