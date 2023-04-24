<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php');
require_once('../config/query.php'); //menu lateral da pagina
require_once('../../../config/config.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Etiqueta Laser</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="pecas.php?pg=<?= $_GET['pg'] ?>">Peças</a></li>
        <li class="breadcrumb-item">Etiqueta Laser</li>
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
            <!--input's para pesquisa no banco de dados -->
            <form class="row g-3" method="POST" action="<?= $PHP_SELF ?>">
              <div class="col-2">
                <label for="revEmp" class="form-label">Revenda</label>
                <input type="text" class="form-control" id="revEmp" name="rev">
              </div>
              <div class="col-2">
                <label for="revEmp" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="revEmp" name="emp">
              </div>
              <div class="col-2">
                <label for="numeroNota" class="form-label">Nº Nota</label>
                <input type="text" class="form-control" id="numeroNota" name="numeroNota">
              </div>
              <div class="col-2">
                <label for="numeroCaixa" class="form-label">Caixa</label>
                <input type="text" class="form-control" id="numeroCaixa" name="numeroCaixa">
              </div>
              <div class="col-2">
                <label for="produto" class="form-label">Produto</label>
                <input type="text" class="form-control" id="produto" name="produto">
              </div>
              <div class="col-2">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data">
              </div>
              <div class="text-left py-3">
                <button type="submit" value="1" name="der" class="btn btn-primary">Pesquisar</button>
              </div>
            </form>
            <form class="row g-3" action="../inc/print.php" method="POST">
            <div>
            <button type="submit" title="Selecione os itens para impressão de etiqueta" style="display:<?= ($_POST['der'] == 1) ? '' : 'none' ?>;float:right;" class="btn btn-primary"><i class="bx bx-printer"></i></button>
            </div>
            <section class="section">
              <div class="row">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col" class="capitalize">#</th>
                      <th scope="col" class="capitalize">DATA NF</th>
                      <th scope="col" class="capitalize">EMPRESA</th>
                      <th scope="col" class="capitalize">REVENDA</th>
                      <th scope="col" class="capitalize">Nº NF</th>
                      <th scope="col" class="capitalize">PRODUTO</th>
                      <th scope="col" class="capitalize">CAIXA</th>
                      <th scope="col" class="capitalize">QTDE</th>
                      <th scope="col" class="capitalize">TOT ITEM</th>
                      <th scope="col" class="capitalize">VAL IPI</th>
                      <th scope="col" class="capitalize">FORNEC</th>
                      <!-- <th scope="col" class="capitalize">QTD</th>  -->
                    </tr>
                  </thead>

                  <?php
                  //salvando informações nas variaveis 
                  $numeroCaixa = $_POST['numeroCaixa'];
                  $numeroNota  = $_POST['numeroNota'];
                  $data        = $_POST['data'];
                  $rev         = $_POST['rev'];
                  $emp         = $_POST['emp'];
                  $produto     = $_POST['produto'];

                  switch ($_POST['der'] == 1) {
                    case $data:
                      $buscaCarga .= " WHERE data_nota = '" . $data . "' ";
                      break;
                    case $numeroNota:
                      $buscaCarga .= " WHERE numero_nota = '" . $numeroNota . "' ";
                      break;
                    case $numeroCaixa:
                      $buscaCarga .= " WHERE caixa = '" . $numeroCaixa . "' ";
                      break;
                    case $revEmp:
                      $buscaCarga .= " WHERE rev_emp = '" . $revEmp . "' ";
                      break;
                    case $rev:
                      $buscaCarga .= " WHERE revenda = '" . $rev . "' ";
                      break;
                    case $emp:
                      $buscaCarga .= " WHERE empresa = '" . $emp . "' ";
                      break;
                    case $produto:
                      $buscaCarga .= " WHERE produto = '" . $produto . "' ";
                      break;
                  }
                  $conSucesso = $conn->query($buscaCarga);
                  while ($row = $conSucesso->fetch_assoc()) {
                    $produto = $row['produto'];
                    $produto = substr_replace($produto, '&nbsp;', 3, 0);
                    // $produto = substr_replace($produto, '&nbsp;', -2, 0);
                    $dataTab = $row['data_nota'];
                    $dataTab = implode('/', array_reverse(explode('-', $dataTab)));
                    $valorIpi = $row['val_ipi'];
                    if ($valorIpi === ' ,') {
                      $valorIpi = substr_replace($valorIpi, '0', -3, 0);
                    } else {
                      $valorIpi = $row['val_ipi'];
                    }
                    $qtde = $row['qtde'];
                    $totalItem = $row['tot_item'];
                    echo '<tr>
                              <th> <input class="form-check-input" type="checkbox" name="etiqueta[]" value="' . $row['produto'] . ''.$row['empresa'].''.$row['numero_nota'].'' . $row['caixa'] . ''.$row['qtde'].'" id="etiqueta"></input><input type="hidden" name = "revenda" value="'.$row['revenda'].'"</input></th>
                              <th>' . $dataTab . '</th>
                              <th>' . $row['empresa'] . '</th>
                              <th>' . $row['revenda'] . '</th>
                              <th>' . $row['numero_nota'] . '</th>
                              <th>' . $produto . '</th>
                              <th><span style="color: red;">' . $row['caixa'] . '</span></th>
                              <th>' . $qtde . '</th>
                              <th>' . $totalItem . '</th>
                              <th>' . $valorIpi . '</th>
                              <th>' . $row['fornecedor'] . '</th>
                              <th>
                              <input type="hidden" name="copia" value="'.$row['qtde'].'" id="copia" style="width:50px;">
                              </th>
                              
                              </tr>';
                  }
                  ?>
                </table>
                <!-- End Table with stripped rows -->
              </div>
            </section>
            </form>
          </div>
        </div>

        <!--  -->

      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->
<!-- <script>
function myFunction() {
  window.open("../inc/print.php");
}
</script> -->
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>