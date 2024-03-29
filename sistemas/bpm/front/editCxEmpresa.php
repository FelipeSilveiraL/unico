<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA CAIXA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="caixaEmpresa.php?pg=<?= $_GET['pg'] ?>">CAIXA EMPRESA</a></li>
        <li class="breadcrumb-item">NOVA REGRA CAIXA EMPRESA</li>
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
          <h5 class="card-title">Nova regra caixa empresa </h5><?php
            
            $id = $_GET['id'];


            $queryCxEmpresa = "SELECT

            CE.id_caixa_empresa,
            CE.id_empresa,
            E.nome_empresa,
            CE.nome_caixa,
            CE.NUMERO_CAIXA_SISTEMA
            
            from caixa_empresa CE
            
            LEFT JOIN empresa E ON (CE.id_empresa = E.id_empresa) WHERE CE.ID_CAIXA_EMPRESA = ".$id;
            $conexao = oci_parse($connBpmgp, $queryCxEmpresa);
            oci_execute($conexao);

            while($row = oci_fetch_array($conexao, OCI_ASSOC)){
              echo'<form method="POST" action="../inc/editCxEmpresa.php?pg='. $_GET['pg'] .'&id='.$id.'">
                <div class="row mb-3">
                  <label for="user" class="col-sm-2 col-form-label">EMPRESA:<span style="color: red;">*</span></label>
                  <div class="col-md-6">
                    <select class="form-select" id="empresa" name="empresa" required>
                    <option value="'.$row['ID_EMPRESA'].'">'.$row['NOME_EMPRESA'].'</option>
                    <option value="">--------------</option>
                      ';
                      $queryBuscaEmpresa = "SELECT * FROM EMPRESA WHERE SITUACAO = 'A' ORDER BY NOME_EMPRESA ASC";
                      $result = oci_parse($connBpmgp, $queryBuscaEmpresa);
                      oci_execute($result);

                      while ($row2 = oci_fetch_array($result, OCI_ASSOC)) {
                        echo '<option value="' . $row2['ID_EMPRESA'] . '">' . $row2['NOME_EMPRESA'] . '</option>';
                      }
                      oci_free_statement($result);
                      
                   echo '</select>
                  </div>
                </div>
                <div class="row mb-3">
                      <label for="nomeCaixa" class="col-sm-2 col-form-label">NOME CAIXA:</label>
                      <div class="col-md-6">
                        <input class="form-control" value="'.$row['NOME_CAIXA'].'" id="nomeCaixa" name="nomeCaixa" required>
                      </div>
                </div>
                <div class="row mb-3">
                      <label for="numeroCaixa" class="col-sm-2 col-form-label">NÚMERO CAIXA:</label>
                      <div class="col-md-6">
                        <input type="number" class="form-control" onkeypress="validate(event)" value="'.$row['NUMERO_CAIXA_SISTEMA'].'" id="numeroCaixa" name="numeroCaixa">
                      </div>
                </div>
                <div class="text-left">
                  <button type="button" class="btn btn-primary"><a href="caixaEmpresa.php?pg='.$_GET['pg'].'" style="color:white;">Voltar</a></button>
                  <button type="submit" class="btn btn-success">Salvar</button>
                </div>
              </form>';

            }

            oci_free_statement($conexao);
            oci_close($connBpmgp);
            ?>
            
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->
  <script>
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

</main>
<?php
require_once('footer.php'); //Javascript e configurações afins
?>

