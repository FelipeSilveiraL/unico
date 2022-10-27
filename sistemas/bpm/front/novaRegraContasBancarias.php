<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA CONTA BANCÁRIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
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
            <form  class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?=$_SESSION['smartshare']?>/bd/novaRegraCBancarias.php?pg=<?= $_GET['pg'] ?>" method="POST">


              <div class="mb-3" style="text-align: center;" id="inlineRadio">
                <label for="exampleFormControlInput2" class="form-label">TIPO DE DOCUMENTO: </label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="documento" id="inlineRadio1" value="1" onclick="cpfDisplay()">
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
              <select class="form-select"  name="banco" required>
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

              <div class="form-floating mt-4 col-md-6"  id="cpfInput" style="display: block;">
                <input type="text" class="form-control" name="cpfValue" id="cpfMerda" onkeydown="javascript: fMasc(this, mCPF);" maxlength="14" onblur="ValidarCPF(this)" autofocus="true">
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
              <div class="form-floating mt-4 col-md-6"  id="cnpjInput" style="display: none;">
                <input type="text" class="form-control" name="cnpjValue"  onkeydown="javascript: fMasc(this, mcnpj);" maxlength="18" onblur="validarCNPJ(this)" autofocus="true" >
                <label for="cnpjInput">CNPJ:<span style="color: red;">*</span></label>
                <div style="font-size: 12px;">
                    <span style="color: green; display: none;" id="cnpjValido"><i class="bi bi-check-circle-fill"></i> CNPJ OK</span>
                    <span style="color: red; display: none;" id="cnpjInvalido"><i class="fas fa-circle-xmark"></i> Inválido</span>
                </div>
              </div>
              <br>
              <div class="form-floating mt-4 col-md-4" id="agencia">
                <input type="text"  class="form-control" name="agencia" onkeydown="javascript: fMasc(this, mnumero);" maxlength="10" required>
                <label for="agencia">AGÊNCIA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="conta">
                <input type="text" onkeydown="javascript: fMasc(this, mnumero);" maxlength="20" class="form-control" name="conta" required>
                <label for="conta">CONTA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-4" id="digito">
                <input type="text" onkeydown="javascript: fMasc(this, mnumero);" maxlength="5" class="form-control" name="digito" required>
                <label for="digito">DIGITO:<span style="color: red;">*</span></label>
              </div>
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/contasBancarias.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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
            document.getElementById("cnpjInput").required = false;
            document.getElementById("cpfInput").style.display = "block";
            document.getElementById("cpfInput").required = true;
        }

        function cnpjDisplay() {
            document.getElementById("cnpjInput").style.display = "block";
            document.getElementById("cnpjInput").required = true;
            document.getElementById("cpfInput").style.display = "none";
            document.getElementById("cpfInput").required = false;
        }
    </script>


<?php
require_once('footer.php'); //Javascript e configurações afins
?>