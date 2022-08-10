<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Nova Regra Empresa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="informatica.php?pg=<?= $_GET['pg'] ?>">Informática</a></li>
        <li class="breadcrumb-item"><a href="empresas.php?pg=<?= $_GET['pg'] ?>">Empresa</a></li>
        <li class="breadcrumb-item">Nova Regra Empresa</li>
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
            <form class="row g-3" action="http://10.100.1.215/smartshare/bd/novaRegraEmp.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-12">
                <input class="form-control" id="empresa" name="empresa" required>
                <label for="filial" class="capitalize">EMPRESA:<span style="color: red;">*</span></label>
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
                  <option value="">------------</option>
                  <option value="AC">AC</option>
                  <option value="AL">AL</option>
                  <option value="AP">AP</option>
                  <option value="AM">AM</option>
                  <option value="BA">BA</option>
                  <option value="CE">CE</option>
                  <option value="DF">DF</option>
                  <option value="ES">ES</option>
                  <option value="GO">GO</option>
                  <option value="MA">MA</option>
                  <option value="MT">MT</option>
                  <option value="MS">MS</option>
                  <option value="MG">MG</option>
                  <option value="PA">PA</option>
                  <option value="PB">PB</option>
                  <option value="PR">PR</option>
                  <option value="PE">PE</option>
                  <option value="PI">PI</option>
                  <option value="RJ">RJ</option>
                  <option value="RN">RN</option>
                  <option value="RS">RS</option>
                  <option value="RO">RO</option>
                  <option value="RR">RR</option>
                  <option value="SC">SC</option>
                  <option value="SP">SP</option>
                  <option value="SE">SE</option>
                  <option value="TO">TO</option>
                  <option value="EX">EX</option>
                </select>
                <label for="estado">UF:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="numero_caixa">
                <input onkeypress="onlynumber()" class="form-control" onblur="aprovador()" name="numero_caixa" maxlength="2" id=ncaixa required>
                <label for="numero_caixa">NUMERO CAIXA:<span style="color: red;">*</span></label>
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
                <a href="http://<?=$_SERVER['SERVER_ADDR']?>/unico/sistemas/sisrev/front/empresas.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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
</script>


<?php
require_once('footer.php'); //Javascript e configurações afins
?>