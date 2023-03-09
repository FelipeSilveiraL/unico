<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../inc/apiRecebeAuditoria.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>MANUTENÇÃO AUDITORIA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item">MANUTENÇÃO AUDITORIA</li>
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
<?php 

$verificaDados = "SELECT * FROM bpm_auditoria";

$conexao = $conn->query($verificaDados);

if($row = $conexao->fetch_assoc()){
  $limiteDespesa = $row['LIMITE_NOTA_DESPESA'];
  $limiteFechamento = $row['LIMITE_FECHAMENTO_CAIXA'];
  $limiteNF = $row['LIMITE_NOTA_FISCAL'];
}
?>
          <div class="card">
            <div class="card-body">
            <br>
                <form method="POST" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/manutencaoAuditoria.php?pg=<?= $_GET['pg'] ?>" >
                  <div class="row mb-3">
                    <label for="user" class="col-sm-2 col-form-label" >LIMITE NOTA DESPESA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                      <input type="number" class="form-control" value="<?= $limiteDespesa ?>" id="limiteNotaDespesa" name="limiteNotaDespesa">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label">LIMITE FECHAMENTO CAIXA:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                    <input type="number"  class="form-control" id="limiteFechamentoCaixa" value="<?= $limiteFechamento ?>" name="limiteFechamentoCaixa">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label">LIMITE NOTA FISCAL:<span style="color: red;">*</span></label>
                    <div class="col-md-6">
                    <input type="number"  class="form-control" value="<?= $limiteNF ?>" id="limiteNotaFiscal" name="limiteNotaFiscal">
                    </div>
                  </div>
                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>" style="color:white;">Voltar</a></button>
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