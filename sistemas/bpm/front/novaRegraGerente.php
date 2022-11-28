<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA GERENTE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">Manutenção Smartshare</a></li>
        <li class="breadcrumb-item">NOVA REGRA GERENTE</li>
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
                <label for="filial" class="capitalize">EMPRESA:<code>*</code></label>
              </div>
              
              <div class="form-floating mt-4 col-md-6">
                <input class="form-control" id="CNPJ" name="departamento" required>
                <label for="filial" class="capitalize">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="nome" id="nome">
                  <option value="">---------------------------------------------------------</option>
                  <?php 
                  
                  $mostraUsuario = "SELECT DS_USUARIO FROM bpm_usuarios_smartshare order by DS_USUARIO ASC";

                  $sucesso = $conn->query($mostraUsuario);

                  while($row = $sucesso->fetch_assoc()){
                    echo '<option value="'.$row['DS_USUARIO'].'">'.$row['DS_USUARIO'].'</option>';
                  }
                  
                  ?>
                </select>
                <label for="nome" class="capitalize">NOME:<code>*</code></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-control" id="cpfVet" name="cpf" disabled required>
                  <option value="">-------------------</option>
                </select>
                <label for="cpf" class="capitalize">CPF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-control" id="login_smartshare" name="login_smartshare" disabled required>
                  <option value="">-------------------</option>
                </select>
                <label for="login_smartshare" class="capitalize">LOGIN SMARTSHARE:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>
            
              <div class="text-left py-2">
                <a href="http://<?=$_SERVER['SERVER_ADDR']?>/unico/sistemas/bpm/front/gerentes.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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

$("#nome").on("change", function(){
    var idUsuario = $("#nome").val();
    
    $.ajax({
        url: '../inc/trazUsuario.php',
        type: 'POST',
        data:{id:idUsuario},
        beforeSend:function(data){
            $("#cpfVet").html('<option value="">Carregando...</option>');
        },
        success:function(data){
            $("#cpfVet").html(data);
        },
        error:function(data){
            $("#cpfVet").html('<option value="">Erro ao carregar...</option>');
        }

    });

    $.ajax({
        url: '../inc/trazLogin.php',
        type: 'POST',
        data:{id:idUsuario},
        beforeSend:function(data){
            $("#login_smartshare").html('<option value="">Carregando...</option>');
        },
        success:function(data){
            $("#login_smartshare").html(data);
        },
        error:function(data){
            $("#login_smartshare").html('<option value="">Erro ao carregar...</option>');
        }

    });
});



</script>