<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA DEPARTAMENTO VENDAS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">Manutenção Smartshare</a></li>
        <li class="breadcrumb-item">NOVA REGRA DEPARTAMENTO VENDAS</li>
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
          <h5 class="card-title">Nova regra departamento vendas </h5>
          
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle']?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraDepVendas.php?pg=<?= $_GET['pg']?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <input class="form-control" id="CNPJ" name="departamento" required>
                <label for="filial" class="capitalize">DEPARTAMENTO:<code>*</code></label>
              </div>
              
              <div class="text-left py-2">
                <a href="http://<?=$_SERVER['SERVER_ADDR']?>/unico/sistemas/bpm/front/depVendas.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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