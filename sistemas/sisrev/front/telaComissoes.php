<?php
$msg = $_GET['msg'];

require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>COMISSAO ENTRE SEMINOVOS</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">departamentos</a></li>
        <li class="breadcrumb-item"><a href="pecas.php?pg=<?= $_GET['pg'] ?>">peças</a></li>
        <li class="breadcrumb-item">COMISSAO ENTRE SEMINOVOS</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:<?= ($msg == 1) ? 'block' : 'none' ?>">
    <i class="ri-error-warning-line"></i>Verifique com atenção! Alguns vendedores podem não estar cadastrados em sua unidade, solicite no glpi o cadastramento do vendedor em sua unidade, clique no icone para verificar os vendedores não cadastrados.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:<?= ($msg == 2) ? 'block' : 'none' ?>">
    <i class="ri-error-warning-line"></i>Sinto muito, mas o relatório tem um limite de 3 meses atrás.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body" style="margin-bottom:20px;">

            <!-- Browser Default Validation -->
            <form class="row g-3 " action="../inc/buscaComissao.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <div class="col-md-4 text-center">
                <h5 class="card-title" style="margin-top: -3px;float:left;">Selecione a data:</h5>
                <label for="validationDefault01">Período</label>
                <input type="date" class="form-control" id="validationDefault01" name="dateCom" required>
              </div>
              <div class="col-md-4 text-center" style="margin-top: 45px;">
                <label for="validationDefault02">A</label>
                <input type="date" class="form-control" id="validationDefault02" name="dateFim" required>
              </div>
              <br>
              <div class="col-lg-3" style="margin-top:66px;">
                <button class="btn btn-primary" type="submit" id="enviar" onclick="teste()">Enviar</button>

              </div>

              <!-- End Browser Default Validation -->
          </div>
        </div>
      </div>
      <div class="col-lg-6" style="display:<?= ($msg == 1) ? 'block' : 'none' ?>">
        <div class="card">
          <div class="card-body">
            <a href="../inc/relatorioVendedoresBPM.php" title="Relatório de vendedores não cadastrados" class="btn btn-info btn-sm" style="margin-top: 5px;margin-left: 401px;">
              <i class="bx bxs-report"></i>
            </a>
            <h5 class="card-title" style="margin-top: -30px;">Arquivo gerado com sucesso!</h5>
            <!-- List group with active and disabled items -->
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><code>Nome:</code><?= $_SESSION['nome_usuario'] ?>&emsp;<code>Data:</code> <?= $today = date("d/m/y H:i:s");  ?></li>
              <li class="list-group-item"><code>Arquivo:</code> <a href="../documentos/COM/Relatorio_detalhado.pdf" rel="file PDF">Relatório Detalhado.pdf</a></li>
              <li class="list-group-item"><code>Arquivo:</code> <a href="../documentos/COM/Relatorio_comissoes_revendas.pdf" rel="file PDF">Relatório Comissões Revenda.pdf</a></li>
            </ul><!-- End Clean list group -->

          </div>
        </div>
      </div>
      </form>
      <div class="card" id="progressBar" style="display:none;margin-top:30px;">
        <div class="card-body">
          <h5 class="card-title">Aguarde, estamos gerando seu relatório</h5>
          <div class="progress" >
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>

<script>
  // Obtenha o botão e a barra de progresso pelos IDs
var botaoEnviar = document.getElementById("enviar");
var divProgresso = document.getElementById("progressBar");

// Adicione um ouvinte de eventos ao botão Enviar
botaoEnviar.addEventListener("click", function() {
  // Oculte o botão Enviar
  botaoEnviar.style.display = "none";
  // Mostre a barra de progresso
  divProgresso.style.display = "block";
  
  // Simule o progresso de uma tarefa qualquer
  var currentValue = 0;
  var intervalId = setInterval(function() {
    currentValue += 10;
    progressBar.value = currentValue;
    // Quando o valor atual atingir o máximo, pare o intervalo
    if (currentValue === progressBar.max) {
      clearInterval(intervalId);
      // Exiba uma mensagem de conclusão ou redirecione o usuário, por exemplo
      alert("Tarefa concluída!");
    }
  }, 1000);
});

</script>