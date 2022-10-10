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
    <h1>EDITANDO CONTA BANCÁRIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item"><a href="seminovos.php?pg=<?= $_GET['pg'] ?>">SEMINOVOS</a></li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?=$_SESSION['smartshare']?>/bd/editarSeminovos.php?id_fornecedor=<?=$_GET['id_semi']?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <label >TIPO DO DOCUMENTO:<span style="color: red;">*</span></label><br>
              <div class="form-floating mt-4 col-md-6" id="cnpj"> 
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">CPF&ensp;
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked="">CNPJ
              </div>

              <div class="form-floating mt-4 col-md-6" id="razao_social">
               <input type="text" class="form-control" name="razao_social" required>
               <label for="razao_social">CPF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-3" id="cidade">
              <input type="text" class="form-control" name="razao_social" required> 
              <label for="cidade">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-3" id="estados">
              <select class="form-select"  name="estados" required>
              <?php
                    $resultadoUsuario = $conn->query("SELECT * FROM bancos order by banco ASC");

                    while ($bancos = $resultadoUsuario->fetch_assoc()) {
                        echo '<option value="' . $bancos['banco'] . '">' . $bancos['banco'] . '</option>';
                    }

                    ?>

              </select>
                <label for="estados">BANCO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6"  id="email">
                <input type="email" value="' . $row['EMAIL'] . '" class="form-control" name="email" required>
                <label for="email">EMAIL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="nome_responsavel">
                <input type="text" value="' . $row['NOME_RESPONSAVEL'] . '" class="form-control" name="nome_responsavel" required>
                <label for="nome_responsavel">NOME_RESPONSAVEL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="ativo">
                <select class="form-select"  name="ativo" required>
                  <option value="' . $row['ATIVO'] . '">'.$ativo.'</option>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="ativo">ATIVO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="utilizaSmartshare">
              <select class="form-select"  name="utilizaSmartshare" required>
              <option value="' . $row['SMARTSHARE'] . '">'.$smartshare.'</option>
              <option value="">------------</option>
              <option value="S">SIM</option>
              <option value="N">NÃO</option>
            </select>
                <label for="utilizaSmartshare">SMARTSHARE:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="SMARTSHARE_LOGIN">
                <input type="text" value="' . $row['SMARTSHARE_LOGIN'] . '" class="form-control" name="login" required >
                <label for="SMARTSHARE_LOGIN">INFORME UM LOGIN:<span style="color: red;">*</span></label>
                <span style="font-size: small;color: red;">NOME e os 3 primeiro números do CPF (Ex.: Joao.094)</span>
              </div>
            
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/seminovos.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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

<!-- 
<script>
  function empresaSelect() {
    document.novaRegraEmpresa.action = "novaRegraAp.php"
    document.novaRegraEmpresa.method = "GET"
    document.novaRegraEmpresa.submit();
  }
</script> -->


<?php
require_once('footer.php'); //Javascript e configurações afins
?>