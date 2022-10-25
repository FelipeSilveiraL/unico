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
    <h1>NOVO CUSTO VEÍCULO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">MANUTENÇÃO SMARTSHARE</a></li>
        <li class="breadcrumb-item"><a href="custoVeiculos.php?pg=<?= $_GET['pg'] ?>">CUSTO VEÍCULO</a></li>
        <li class="breadcrumb-item">NOVO CUSTO VEÍCULO</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
    switch ($_GET['erro']) {
        case 1:
            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span style="font-size: 12px">Custo já existe. Por favor cadestre outro!</span>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
            break;
        case 2:
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <span style="font-size: 12px">CNPJ já cadastrado. Por favor informe outro</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
           
            break;
    }
    
  ?>

  <!--################# COLE section AQUI #################-->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body"><br>
            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?=$_SESSION['smartshare']?>/bd/novaRegraCVeiculos.php?pg=<?= $_GET['pg'] ?>"  id="formularioVeiculos" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <div class="form-floating mt-4 col-md-6" id="NOME_EMPRESA">
                <select class="form-select" name="empresa" id="empresa" readonly>
                  <option value="">-----------</option>
                  <?php 
                   
                    $resultado = $conn->query($relatorioExcel);

                    while($row = $resultado->fetch_assoc()){
                      echo '<option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].'</option>';
                    }
                   
                  ?>
                </select>
               <label for="NOME_EMPRESA">NOME EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="estados">
                <select class="form-control" name="tipo_custo" id="tipoCustoIPVA"  onchange="parcelarMostrar()" required>
                    <option value="">---------------------</option>
                    <option value="L">LICENCIAMENTO</option>
                    <option value="M">MULTA</option>
                    <option value="T">TRIAGEM</option>
                    <option value="I">IPVA</option>
                </select>
                <label for="estados">TIPO DE CUSTO:<span style="color: red;">*</span></label>
              </div>
              
              <div class="form-floating mt-4 col-md-6" id="parcelaIPVA" style="display: none;">
                <select class="form-control" name="parcela" id="parcelaValor" required>
                  <option value="">---------------------</option>
                  <option value="U">ÚNICA</option>
                  <option value="1">PARCELA 1</option>
                  <option value="2">PARCELA 2</option>
                  <option value="3">PARCELA 3</option>
                  <option value="4">PARCELA 4</option>
                  <option value="5">PARCELA 5</option>
                  
                </select>
                <label for="parcelaIPVA" class="form-label">PARCELA: </label>
            </div>

              <div class="form-floating mt-4 col-md-6" id="referencia">
              <input type="text" class="form-control" id="exampleFormControlInput1" name="ano" onkeydown="javascript: fMasc(this, numero);" maxlength="4"  required>
                  <label for="referencia" class="col-sm-6 col-form-label">ANO REFERENCIA:</label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="custo">
                  <select class="form-control" name="erp" id="erp">
                      <option value="">---------------------</option>
                      <?php 
                      
                      $queryApollo = "SELECT DES_DESPESA, DESPESA FROM bpm_vei_despesa ORDER BY DES_DESPESA ASC";
                          
                      $resultadoAPollo = $conn->query($queryApollo);

                      while($empresaAPollo = $resultadoAPollo->fetch_assoc() ) {
                          echo '<option value="'. $empresaAPollo['DESPESA'] .'">' . $empresaAPollo['DES_DESPESA'] . ' [ '. $empresaAPollo['DESPESA'] .' ]</option>';
                      }
                      
                      ?>
                  </select>
                <label for="custo" class="col-sm-6 col-form-label">CUSTO ERP:</label>
              </div>
              
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/custoVeiculos.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
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
        function parcelarMostrar() {
            
            var value = document.getElementById("tipoCustoIPVA").value;

            if (value === 'I') {

                document.getElementById("parcelaIPVA").style.display = "block";
                document.getElementById("parcelaValor").required;

            } else {

                document.getElementById("parcelaIPVA").style.display = "none";                
                document.getElementById("parcelaValor").required = false;
            }

        }
    </script>

    <script>
        $("#empresa").on("change", function() {
            var idEmpresa = $("#empresa").val();

            $.ajax({
              url: 'http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/coletandoDados.php',
                type: 'POST',
                data: {
                    id: idEmpresa
                },
                beforeSend: function(data) {
                    $("#erp").html('<option value="">Carregando...</option>');
                },
                success: function(data) {
                    $("#erp").html(data);
                },
                error: function(data) {
                    $("#erp").html('<option value="">Erro ao carregar...</option>');
                }

            });

        });
    </script>

<?php
require_once('footer.php'); //Javascript e configurações afins
?>