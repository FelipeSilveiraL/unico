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
    <h1>NOVA REGRA SEMINOVOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item"><a href="seminovos.php?pg=<?= $_GET['pg'] ?>">SEMINOVOS</a></li>
        <li class="breadcrumb-item">NOVA REGRA SEMINOVOS</li>
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
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraSeminovos.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="cnpj">
                <input type="text" class="form-control" name="cnpj" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()'>
                <label for="cnpj">CNPJ:<span style="color: red;">*</span></label>
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

                    echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>
                      ';
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
              <div class="form-floating mt-4 col-md-6" id="nome_responsavel">
                <input type="text" class="form-control" name="nome_responsavel" required>
                <label for="nome_responsavel">NOME_RESPONSAVEL:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="ativo">
                <select class="form-select" name="ativo" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="ativo">ATIVO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="utilizaSmartshare">
                <select class="form-select" id="utiliza" name="utilizaSmartshare" onchange="mostraDiv()" required>
                  <option value="">------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="utilizaSmartshare">SMARTSHARE:<span style="color: red;">*</span></label>
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
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>
<script>

$("#estados").on("change", function(){
    var idEstado = $("#estados").val();
    
    $.ajax({
        url: '../inc/trazCidades.php',
        type: 'POST',
        data:{id:idEstado},
        beforeSend:function(data){
            $("#cidade").html('<option value="">Carregando...</option>');
        },
        success:function(data){
            $("#cidade").html(data);
        },
        error:function(data){
            $("#cidade").html('<option value="">Erro ao carregar...</option>');
        }

    });

});

</script>

a orderm dos fatores altera o resultado kakakaka faz sentido kkkkk