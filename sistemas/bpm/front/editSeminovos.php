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
    <h1>EDITANDO FORNECEDOR</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item"><a href="seminovos.php?pg=<?= $_GET['pg'] ?>">SEMINOVOS</a></li>
        <li class="breadcrumb-item">EDITANDO FORNECEDOR</li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?=$_SESSION['smartshare']?>/bd/editarSeminovos.php?pg=<?= $_GET['pg'] ?>&id_fornecedor=<?=$_GET['id_semi']?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              
                <?php

                $tabelaSeminovos .= " WHERE ID_FORNECEDOR = ".$_GET['id_semi']."";

                $id = $_GET['id_semi'];

                $sucesso = $conn->query($tabelaSeminovos);

                while ($row = $sucesso->fetch_assoc()) {

                  $email = $row['EMAIL'];
                  $cidade = $row['CIDADE'];
                  $uf = $row['UF'];
                  $nomeResponsavel =  $row['NOME_RESPONSAVEL'];
                  $ativo =  $row['ATIVO'];
                  $smartshare_login =  $row['SMARTSHARE_LOGIN'];
                  $smartshare = $row['SMARTSHARE'];
                  $cnpj = $row['CNPJ'];
                  $razaoSocial = $row['RAZAO_SOCIAL'];

                  if($ativo == 'S'){
                    $ativo = 'SIM';
                    
                  }else{
                    $ativo = "NÃO";
                  }
                  if($smartshare == 'S'){
                    $smartshare = 'SIM';
                    
                  }else{
                    $smartshare = "NÃO";
                    
                  }
                  
        echo '<div class="form-floating mt-4 col-md-6" id="cnpj"> 
                  <input type="text" value="'.$row['CNPJ'].'" class="form-control" disabled>
                  <input type="hidden" value="'.$row['CNPJ'].'" class="form-control" name="cnpj">
                  <label for="cnpj">CNPJ:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="razao_social">
               <input type="text" value="' . $row['RAZAO_SOCIAL'] . '" class="form-control" name="razao_social" required>
               <label for="razao_social">RAZÃO SOCIAL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-3" id="cidade">
              <select class="form-control" name="cidade" id="cidade" required>
                <option value="">---------------------</option>
                <option value="'.$cidade.'" selected>'.$cidade.'</option>
              </select>                
              <label for="cidade">CIDADE:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-3" id="estados">
              <select class="form-select"  name="estados" required>
              <option value="'.$uf.'" selected>'.$uf.'</option>
              <option value="">------------</option>';

              $resultadoEstado = $conn->query($queryEstados);

              while ($estados = $resultadoEstado->fetch_assoc()) {
                  echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>';
              }
              echo '
              </select>
                <label for="estados">UF:<span style="color: red;">*</span></label>
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
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select"  name="utilizaSmartshare" id="utilizaSmartshare" onchange="aparece()" required>
                  <option value="' . $row['SMARTSHARE'] . '">'.$smartshare.'</option>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="utilizaSmartshare2">SMARTSHARE:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="SMARTSHARE_LOGIN" style="';echo ($smartshare == 'SIM') ? 'display: block;">': 'display: none;">';
               echo '<input type="text" value="'.$smartshare_login.'" class="form-control" name="login" id="smartshareLogin" required >
                <label for="SMARTSHARE_LOGIN">INFORME UM LOGIN:<span style="color: red;">*</span></label>
                <span style="font-size: small;color: red;">NOME e os 3 primeiro números do CPF (Ex.: Joao.094)</span>
              </div>
              
              ';
              
            }
            ?>
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

<script>
  function aparece() {
    var value = document.getElementById("utilizaSmartshare").value;

    if (value == "N") {
      document.getElementById("SMARTSHARE_LOGIN").style.display = "none";
      document.getElementById("smartshareLogin").required = false;
      document.getElementById("smartshareLogin").value = "";
      
    } else {
      document.getElementById("SMARTSHARE_LOGIN").style.display = "block";
      document.getElementById("smartshareLogin").required = true;
    }
  }
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>