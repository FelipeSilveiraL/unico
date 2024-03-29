<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA FORNECEDOR TRIAGEM</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="seminovos.php?pg=<?= $_GET['pg'] ?>">Fornecedor Triagem</a></li>
        <li class="breadcrumb-item">NOVA REGRA FORNECEDOR TRIAGEM</li>
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
            <h5 class="card-title">Nova regra fornecendor triagem </h5>
            <form id="novaRegraEmpresa" class="row g-3" action="../inc/novaRegraSeminovos.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="cnpj">
                <input type="text" maxlength="18" onblur="validarCNPJ(this)" class="form-control" name="cnpj" onkeypress='mascaraMutuario(this,cpfCnpj)'>
                <label for="cnpj">CNPJ:<span style="color: red;">*</span></label>
              </div>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">CNPJ inválido, por favor verifique!</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-floating mt-4 col-md-6" id="razao_social">
                <input type="text" class="form-control" name="razao_social" required>
                <label for="razao_social">RAZÃO SOCIAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-3">
                <select class="form-select" name="estados" id="estados" required>
                  <option value="">-- Escolha um estado --</option>
                  <?php
                  $resultadoEstado = $conn->query($queryEstados);

                  while ($estados = $resultadoEstado->fetch_assoc()) {
                    $id = $estados['id'];
                    echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>';
                  }
                  ?>

                </select>
                <label for="estados">UF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-3">
                <select class="form-select" name="cidade" id="cidade" required>
                  <option value="">------------</option>

                </select>
                <label for="cidade">CIDADE:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="email">
                <input type="email" class="form-control" name="email" required>
                <label for="email">EMAIL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="nome_responsavel">
                <input type="text" class="form-control" name="nome_responsavel" required>
                <label for="nome_responsavel">NOME_RESPONSAVEL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="ativo">
                <select class="form-select" name="ativo" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="ativo">ATIVO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="utilizaSmartshare">
                <select class="form-select" id="utiliza" name="utilizaSmartshare" onchange="mostraDiv()" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                  <option value="P">PAPEL</option>
                </select>
                <label for="utilizaSmartshare">SMARTSHARE:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="SMARTSHARE_LOGIN" style="display: none;">
                <input type="text" class="form-control" name="login" id="login" required>
                <label for="SMARTSHARE_LOGIN">INFORME UM LOGIN:<span style="color: red;">*</span></label>
                <span style="font-size: small;color: red;">NOME e os 3 primeiro números do CPF (Ex.: Joao.094)</span>
              </div>
              <div class="text-left py-2">
                <a href="../inc/front/seminovos.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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

<script type="text/javascript">
  function mostraDiv() {
    var valueRevisao = document.getElementById("utiliza").value;

    switch (valueRevisao) {
      case 'S':
        document.getElementById("SMARTSHARE_LOGIN").style.display = "block";
        break;
      case 'N':
        document.getElementById("SMARTSHARE_LOGIN").style.display = "none";
        document.getElementById('login').value = '';
        document.getElementById("login").required = false;
        break;
      case 'P':
        document.getElementById("SMARTSHARE_LOGIN").style.display = "none";
        document.getElementById('login').value = '';
        document.getElementById("login").required = false;
        break;

    }
  }


  function mascaraMutuario(o, f) {
    v_obj = o
    v_fun = f
    setTimeout('execmascara()', 1)
  }

  function execmascara() {
    v_obj.value = v_fun(v_obj.value)
  }

  function cpfCnpj(v) {

    //Remove tudo o que não é dígito
    v = v.replace(/\D/g, "")

    if (v.length <= 12) { //CPF

      //Coloca um ponto entre o terceiro e o quarto dígitos
      v = v.replace(/(\d{2})(\d)/, "$1.$2")

      //Coloca um ponto entre o terceiro e o quarto dígitos
      //de novo (para o segundo bloco de números)
      v = v.replace(/(\d{3})(\d)/, "$1.$2")

      //Coloca um hífen entre o terceiro e o quarto dígitos
      v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

    } else { //CNPJ

      //Coloca ponto entre o segundo e o terceiro dígitos
      v = v.replace(/^(\d{2})(\d)/, "$1.$2")

      //Coloca ponto entre o quinto e o sexto dígitos
      v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

      //Coloca uma barra entre o oitavo e o nono dígitos
      v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

      //Coloca um hífen depois do bloco de quatro dígitos
      v = v.replace(/(\d{4})(\d)/, "$1-$2")

    }

    return v
  }

  function _cnpj(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
      return false;


    if (cnpj == "00000000000000" ||
      cnpj == "11111111111111" ||
      cnpj == "22222222222222" ||
      cnpj == "33333333333333" ||
      cnpj == "44444444444444" ||
      cnpj == "55555555555555" ||
      cnpj == "66666666666666" ||
      cnpj == "77777777777777" ||
      cnpj == "88888888888888" ||
      cnpj == "99999999999999")
      return false;


    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
        pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
        pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
      return false;

    return true;

  }

  function validarCNPJ(el) {
    if (!_cnpj(el.value)) {

      $('#verticalycentered').modal('show')

      // apaga o valor
      el.value = "";
    }
  }

  $("#estados").on("change", function() {
    var idEstado = $("#estados").val();

    $.ajax({
      url: '../inc/trazCidades.php',
      type: 'POST',
      data: {
        id: idEstado
      },
      beforeSend: function(data) {
        $("#cidade").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#cidade").html(data);
      },
      error: function(data) {
        $("#cidade").html('<option value="">Erro ao carregar...</option>');
      }

    });

  });
</script>