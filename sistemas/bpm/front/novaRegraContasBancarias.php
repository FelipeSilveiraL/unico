<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA CONTA BANCÁRIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="contasBancarias.php?pg=<?= $_GET['pg'] ?>">CONTAS BANCARIAS</a></li>
        <li class="breadcrumb-item">NOVA REGRA CONTA BANCÁRIA</li>
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
          <div class="card-body"><br>
            <h5 class="card-title">Nova regra contas bancárias </h5>
            <form class="row g-3" action="../inc/novaRegraCBancarias.php?pg=<?= $_GET['pg'] ?>" method="POST">


              <div class="mb-3" style="text-align: center;" id="inlineRadio">
                <label for="exampleFormControlInput2" class="form-label">TIPO DE DOCUMENTO: </label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="documento" id="inlineRadio1" value="1" onclick="cpfDisplay()" checked>
                  <label class="form-check-label" for="inlineRadio1">CPF</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="documento" id="inlineRadio2" value="2" onclick="cnpjDisplay()">
                  <label class="form-check-label" for="inlineRadio2">CNPJ</label>
                </div>
              </div>
              <div class="form-floating mt-4 col-md-12" id="nome_empresa">
                <input type="text" class="form-control" name="nomeEmpresa" required>
                <label for="nome_empresa">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="banco">
                <select class="form-select" name="banco" required>
                  <?php
                  $resultadoUsuario = $conn->query("SELECT * FROM bancos order by banco ASC");

                  while ($bancos = $resultadoUsuario->fetch_assoc()) {
                    echo '<option value="' . $bancos['banco'] . '">' . $bancos['banco'] . '</option>';
                  }
                  ?>
                </select>
                <label for="banco">BANCO:<span style="color: red;">*</span></label>
              </div>

              <input type="text" name="valido" id="validoCasete" value="" style="display: none;">

              <div class="form-floating mt-4 col-md-6" id="cpfInput" style="display: block;">
                <input type="text" class="form-control" name="cpfValue" id="cpfMerda" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" onblur="ValidarCPF(this)" required>
                <label for="cpfInput">CPF:<span style="color: red;">*</span></label>
                <div style="font-size: 12px;">
                  <span style="color: green; display: none;" id="cpfValido">
                    <i class="bi bi-check-circle-fill"></i> CPF OK
                  </span>
                  <span style="color: red; display: none;" id="cpfInvalido">
                    <i class="fas fa-circle-xmark"></i> Inválido
                  </span>
                </div>
              </div>
              <div class="form-floating mt-4 col-md-6" id="cnpjInput" style="display: none;">
                <input onkeypress='mascaraMutuario(this,cpfCnpj)' onblur="validarCNPJ(this)" maxlength="18" type="text" class="form-control" name="cnpjValue" onkeydown="javascript: fMasc(this, mcnpj);" maxlength="18" onblur="validarCNPJ(this)" id="cnpjMerda">
                <label for="cnpjInput">CNPJ:<span style="color: red;">*</span></label>
                <div style="font-size: 12px;">
                  <span style="color: green; display: none;" id="cnpjValido"><i class="bi bi-check-circle-fill"></i> CNPJ OK</span>
                  <span style="color: red; display: none;" id="cnpjInvalido"><i class="fas fa-circle-xmark"></i> Inválido</span>
                </div>
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
              <br>
              <div class="form-floating mt-4 col-md-4" id="agencia">
                <input type="text" class="form-control" name="agencia" onkeydown="javascript: fMasc(this, mnumero);" maxlength="10">
                <label for="agencia">AGÊNCIA:</label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="conta">
                <input type="text" onkeydown="javascript: fMasc(this, mnumero);" maxlength="20" class="form-control" name="conta">
                <label for="conta">CONTA:</label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="digito">
                <input type="text" onkeydown="javascript: fMasc(this, mnumero);" maxlength="5" class="form-control" name="digito">
                <label for="digito">DIGITO:</label>
              </div>
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/contasBancarias.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" id="salvarContasBancarias" class="btn btn-success">Salvar</button>
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
  function outraFuncao(variavelRecebida) {
    // Acesso à variável passada como argumento
    if (variavelRecebida == 'blockerButton') {
      document.getElementById('salvarContasBancarias').disabled = true;
    } else {
      document.getElementById('salvarContasBancarias').disabled = false;
    }
  }

  function cpfDisplay() {
    document.getElementById("cnpjInput").style.display = "none";
    document.getElementById("cnpjMerda").required = false;

    document.getElementById("cpfInput").style.display = "block";
    document.getElementById("cpfMerda").required = true;
  }

  function cnpjDisplay() {
    document.getElementById("cnpjInput").style.display = "block";
    document.getElementById("cnpjMerda").required = true;

    document.getElementById("cpfInput").style.display = "none";
    document.getElementById("cpfMerda").required = false;
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

      $('#verticalycentered').modal('show');
      document.getElementById('salvarContasBancarias').disabled = true;

      // apaga o valor
      el.value = "";
    } else {

      document.getElementById('salvarContasBancarias').disabled = false;
      
    }


  }
</script>