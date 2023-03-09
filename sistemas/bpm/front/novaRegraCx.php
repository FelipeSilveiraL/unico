<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../config/query.php');
require_once('../inc/apiRecebeSelbetti.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>USUÁRIOS CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>">USUÁRIOS CAIXA</a></li>
        <li class="breadcrumb-item">USUÁRIOS CAIXA</li>
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
            <br>
                <form method="POST" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/novaRegraCxUs.php?pg=<?= $_GET['pg'] ?>" >
                  <div class="row mb-3">
                    <label for="user" class="col-sm-2 col-form-label" >EMPRESA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-select" id="empresa" name="empresa" required>
                        <option value="">--------------</option>
                          <?php 
                          $result = $conn->query($relatorioExcel);

                          while($row = $result->fetch_assoc()){

                            $idEmp = $row['ID_EMPRESA'];
                             
                            $queryCxEmp = "SELECT NOME_CAIXA FROM bpm_caixa_empresa WHERE ID_EMPRESA = ".$idEmp;
                            
                            $sucesso = $conn->query($queryCxEmp);

                            if($a = $sucesso->fetch_assoc()){
                              $idCxEmp = $a['NOME_CAIXA'];
                              }else{
                              $idCxEmp = '';                                
                              }
                              
                            
                            // echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].' /  '.$idCxEmp.'</option>';
                           echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].'</option>';
                          }
                          
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="nomeCaixa" class="col-sm-2 col-form-label">NOME CAIXA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-select" name="nomeCaixa" id="nomeCaixa" required>
                       
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label">USUÁRIOS CAIXA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <select class="form-select" name="userCaixa" required>
                        <?php
                        echo '<option value=""> ------------ </option>';
                        $query_users .= " WHERE CD_USUARIO NOT IN (1,19982) ORDER BY DS_USUARIO ASC";
                       
                        $sucesso = $conn->query($query_users);
                        while($row = $sucesso->fetch_assoc()){
                          echo '<option value="'.$row['DS_LOGIN'].'">'.$row['DS_USUARIO'].' / '.$row['DS_LOGIN'].'</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                </form><br>
            </div>
          </div>

          

        </div>

        
      </div>
    </section>

  <!--################# section TERMINA AQUI #################-->

</main>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>
<script>
  $("#empresa").on("change", function(){
    var idEstado = $("#empresa").val();
    
    $.ajax({
        url: '../inc/trazNomeCaixa.php',
        type: 'POST',
        data:{id:idEstado},
        beforeSend:function(data){
            $("#nomeCaixa").html('<option value="">Carregando...</option>');
        },
        success:function(data){
            $("#nomeCaixa").html(data);
        },
        error:function(data){
            $("#nomeCaixa").html('<option value="">Erro ao carregar...</option>');
        }

    });

});
</script>