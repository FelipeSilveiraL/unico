<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
        <li class="breadcrumb-item"><a href="empresas.php?pg=<?= $_GET['pg'] ?>">EMPRESAS</a></li>
        <li class="breadcrumb-item">NOVA REGRA EMPRESA</li>
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
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle']?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraEmp.php?pg=<?= $_GET['pg']?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <input class="form-control" id="empresa" name="empresa" required>
                <label for="filial" class="capitalize">EMPRESA:<span style="color: red;">*</span></label>
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
              <div class="form-floating mt-4 col-md-6">
                <input onkeypress='mascaraMutuario(this,cpfCnpj)' onblur="validarCNPJ(this)" maxlength="18" class="form-control" id="CNPJ" name="cnpjValue" required>
                <label for="filial" class="capitalize">CNPJ:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" id="sistema" name="sistema" onchange="camposObrigatorios()" required>
                  <option value="">--------------</option>
                  <option value="A">APOLLO</option>
                  <option value="N">APOLLO NBS</option>
                  <option value="H">BANCO HARLEY</option>
                  <option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>
                </select>
                <label for="sistema">SISTEMA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresaApollo">
                <input class="form-control" name="empApollo" maxlength="2" onkeypress="onlynumber()" >
                <label for="floatingSelect">EMPRESA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="revendaApollo">
                <input class="form-control" name="revApollo" maxlength="2" onkeypress="onlynumber()" >
                <label for="revendaApollo">REVENDA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresaNbs">
                <input class="form-control" name="empnbs" id="empnbs" maxlength="2" onkeypress="onlynumber()" >
                <label for="empresaNbs">EMPRESA NBS:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="apelidoNbs">
                <input class="form-control" name="apnbs" id="apnbs" maxlength="2" onkeypress="onlynumber()" >
                <label for="apelidoNbs">APELIDO NBS:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="orgsenior">
                <input class="form-control" name="orgsenior" maxlength="2" onkeypress="onlynumber()" required>
                <label for="orgsenior">ORGANOGRAMA SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresasenior">
                <input onkeypress="onlynumber()" class="form-control" name="empresasenior" maxlength="2" required>
                <label for="empresasenior">EMPRESA SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="filialsenior">
                <input class="form-control" name="filialsenior" maxlength="2" onkeypress="onlynumber()" required>
                <label for="filialsenior">FILIAL SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="consorcio">
                <select class="form-select" name="consorcio" required>
                  <option value="">-----------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="consorcio">CONSÓRCIO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="estado">
                <select class="form-select" name="estado" required>
                  <option value="">-----------------</option>
                  <?php
                    $resultadoEstado = $conn->query($queryEstados);

                    while ($estados = $resultadoEstado->fetch_assoc()) {
                        echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>';
                    }
                  ?>
                </select>
                <label for="estado">UF:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="numero_caixa">
                <input onkeypress="onlynumber()" class="form-control" onblur="aprovador()" name="numero_caixa" maxlength="2" id=ncaixa required>
                <label for="numero_caixa">NUMERO CAIXA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="empresaApollo">
                <input class="form-control" name="empApollo" maxlength="2" onkeypress="onlynumber()" >
                <label for="floatingSelect">BANDEIRA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" style="display: <?= empty($_GET['APROVADOR_CAIXA']) ? 'none' : 'block' ?>;" id="liberarApro">
                <select class="form-select" name="aproCaixa" required>
                  <?php
                  echo '<option value=""> ------------ </option>';
                  echo $aprovador;
                  ?>
                </select>
                <label for="aproCaixa">APROVADOR CAIXA:<span style="color: red;">*</span></label>
              </div>
              <div class="text-left py-2">
                <a href="http://<?=$_SERVER['SERVER_ADDR']?>/unico/sistemas/bpm/front/empresas.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div>
    </div>  <!-- FIM col-lg-12 -->
  </section><!-- FIM section -->
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->
<script>
  function camposObrigatorios() {
    var value = document.getElementById("sistema").value;

    if (value == "A") {
      document.getElementById("empresaNbs").style.display = "none";
      document.getElementById("empresaNbs").required = false;
      document.getElementById("empnbs").value = "";
      document.getElementById("empresaApollo").style.display = "block";
      document.getElementById("empresaApollo").required = true;
      document.getElementById("revendaApollo").style.display = "block";
      document.getElementById("revendaApollo").required = true;

    } else {
      document.getElementById("empresaNbs").style.display = "block";
      document.getElementById("empresaNbs").required = true;
      document.getElementById("empresaApollo").style.display = "none";
      document.getElementById("empresaApollo").required = false;
      document.getElementById("revendaApollo").style.display = "none";
      document.getElementById("revendaApollo").required = false;
      document.getElementById("empApollo").value = "";
      document.getElementById("revApollo").value = "";
    }
  }

  
</script>

<script>
  function aprovador() {
    var tela = document.getElementById("liberarApro").style.display;

    if (tela == "none") {
      document.getElementById("liberarApro").style.display = "block";
      document.getElementById("aproCaixa").required = true;
    } else {
      document.getElementById("liberarApro").style.display = "none";
      document.getElementById("aproCaixa").required = false;
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

function validarCNPJ(el){
  if( !_cnpj(el.value) ){

    $('#verticalycentered').modal('show')

    // apaga o valor
    el.value = "";
  }
}

</script>



<?php
require_once('footer.php'); //Javascript e configurações afins
?>