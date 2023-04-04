<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITANDO CONTA BANCÁRIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="contasBancarias.php?pg=<?= $_GET['pg'] ?>">CONTAS BANCARIAS</a></li>
        <li class="breadcrumb-item">EDITANDO CONTA BANCÁRIA</li>
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
            <h5 class="card-title">Editar contas bancárias </h5>
            <form class="row g-3" action="../inc/editCBancarias.php?pg=<?= $_GET['pg'] ?>&id_conta=<?= $_GET['id_conta'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php
              $idConta = $_GET['id_conta'];
              $contasBancarias .= " WHERE ID_CONTA = " . $idConta . " ";

              $conexao = oci_parse($connBpmgp, $contasBancarias);
              oci_execute($conexao);

              while ($row = oci_fetch_array($conexao, OCI_ASSOC)) {

                $contagem = strlen($row['CNPJ_CPF']);

                if ($contagem == 11) {
                  $displayCPF = "block";
                  $displayCNPJ = "none";
                  $ativeCPF = 'checked';
                } else {
                  $displayCPF = "none";
                  $displayCNPJ = "block";
                  $ativeCNPJ = 'checked';
                }

                echo ' <div class="mb-3" style="text-align: center;">
                  <label for="exampleFormControlInput2" class="form-label">TIPO DE DOCUMENTO: </label><br>
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="documento" id="inlineRadio1" value="1" onclick="cpfDisplay()" ' . $ativeCPF . '>
                      <label class="form-check-label" for="inlineRadio1">CPF</label>
                  </div>
                  <div class="form-check form-check-inline">
                      <input  class="form-check-input" type="radio" name="documento" id="inlineRadio2" value="2" onclick="cnpjDisplay()" ' . $ativeCNPJ . '>
                      <label class="form-check-label" for="inlineRadio2">CNPJ</label>
                  </div>
              </div>
              <div class="form-floating mt-4 col-md-12" id="NOME_EMPRESA">
               <input type="text" value="' . $row['NOME_EMPRESA'] . '" class="form-control" name="nomeEmpresa" required>
               <label for="NOME_EMPRESA">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div><br>
              <div class="form-floating mt-4 col-md-6" id="estados">
              <select class="form-select"  name="banco" required>
                <option value="' . $row['BANCO'] . '">' . $row['BANCO'] . '</option>
                <option value="">--------</option>';
                $resultadoUsuario = $conn->query("SELECT * FROM bancos order by banco ASC");

                while ($bancos = $resultadoUsuario->fetch_assoc()) {
                  echo '<option value="' . $bancos['banco'] . '">' . $bancos['banco'] . '</option>';
                }
                echo '</select>
                <label for="estados">BANCO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6"  id="cpfInput" style="display: ' . $displayCPF . ';">
                <input type="text" class="form-control"  id="exampleFormControlInput2" name="cpfValue" id="cpfMerda" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" onblur="ValidarCPF(this)" value="' . $row['CNPJ_CPF'] . '" autofocus="true">
                <label for="email">CPF:<span style="color: red;">*</span></label>
                  <div style="font-size: 12px;">
                    <span style="color: green; display: none;" id="cpfValido">
                      <i class="bi bi-check-circle-fill"></i> CPF OK
                    </span>
                    <span style="color: red; display: none;" id="cpfInvalido">
                        <i class="fas fa-circle-xmark"></i> Inválido
                    </span>
                  </div>
              </div>
              <div class="form-floating mt-4 col-md-6"  id="cnpjInput" style="display: ' . $displayCNPJ . ';">
                <input type="text" onkeypress="mascaraMutuario(this,cpfCnpj)" class="form-control" name="cnpjValue"  onkeydown="javascript: fMasc(this, mcnpj);" maxlength="18" onblur="validarCNPJ(this)" value=" ' . $row['CNPJ_CPF'] . '" autofocus="true" required >
                <label for="email">CNPJ:<span style="color: red;">*</span></label>
                <div style="font-size: 12px;">
                    <span style="color: green; display: none;" id="cnpjValido"><i class="bi bi-check-circle-fill"></i> CNPJ OK</span>
                    <span style="color: red; display: none;" id="cnpjInvalido"><i class="fas fa-circle-xmark"></i> Inválido</span>
                </div>
              </div>
              <div class="form-floating mt-4 col-md-4" id="agencia">
              <input type="number" " maxlength="10" class="form-control" id="inputEmail3" name="agencia" id="agencia" value="' . $row['AGENCIA'] . '" >
              <label for="agencia">AGÊNCIA:</label>
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
              </div>
              <div class="form-floating mt-4 col-md-4" id="conta">
                <input type="number" " maxlength="20" class="form-control" id="inputEmail4" name="conta" id="conta" value="' . $row['CONTA'] . '" >
                <label for="conta">CONTA:</label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="digito">
                <input type="number" value="' . $row['DIGITO'] . '" class="form-control" " maxlength="5" name="digito">
                <label for="digito">DIGITO:</label>
              </div>';
              }

              oci_free_statement($conexao);
              oci_close($connBpmgp);
              ?>
              <div class="text-left py-2">
                <a href="contasBancarias.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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

<script>
  function cpfDisplay() {
    document.getElementById("cnpjInput").style.display = "none";
    document.getElementById("cpfInput").style.display = "block";
  }

  function cnpjDisplay() {
    document.getElementById("cnpjInput").style.display = "block";
    document.getElementById("cpfInput").style.display = "none";
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
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>