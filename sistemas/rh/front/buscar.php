<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

if (empty($_SESSION['tipoPesquisa'])) {
  header('Location: buscar.php?pg=' . $_GET['pg'] . '');
} else {
  switch ($_SESSION['tipoPesquisa']) {
    case '1':
      $nome = 'checked';
      break;

    case '2':
      $cpf = 'checked';
      break;
  }
}


?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Buscar CPF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <?= !empty($_GET['table']) ? '<li class="breadcrumb-item"><a href="buscar.php?pg=' . $_GET['pg'] . '">Buscar CPF</a></li><li class="breadcrumb-item">Resultado</li>' : '<li class="breadcrumb-item">Buscar CPF</li>'; ?>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">

    <div class="row">

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Localizando funcionário na base de dados RH</h5><br>

            <!-- Horizontal Form -->
            <form method="POST" action="../inc/buscar.php?pg=<?= $_GET['pg'] ?>">

              <fieldset class="row mb-10 pt-2">
                <legend class="col-form-label col-sm-5 pt-2">Buscar por:</legend>
                <div class="col-sm-5">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="busca" id="gridRadios1" value="1" onclick="escolheNome()" <?= $nome ?>>
                    <label class="form-check-label" for="gridRadios1">
                      Nome
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="busca" id="gridRadios2" value="2" onclick="escolheCpf()" <?= $cpf ?>>
                    <label class="form-check-label" for="gridRadios2">
                      CPF
                    </label>
                  </div>
                </div>
              </fieldset>
              <hr><br>
              <div class="col-md-8" id="nomeFuncionario" style="display: none;">
                <label for="inputName5" class="form-label">Nome Completo:</label>
                <input type="text" class="form-control" id="inputNome" name="nomeCompleto" style="text-transform: uppercase;">
              </div>
              <div class="col-md-5" id="cpfFuncionario" style="display: none;">
                <label for="inputName5" class="form-label">CPF:</label>
                <input name="cpf" type="text" class="form-control" id="inputCpf" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" onblur="ValidarCPF(this)">
              </div>

              <div class="text-center" style="margin-top: 25px; margin-bottom: 10px;">
                <button type="submit" class="btn btn-success" id="localizar" disabled>Localizar <i class="bi bi-search"></i></button>
              </div>
            </form><!-- End Horizontal Form -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Dados do colaborador</h5>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">Nome Completo</th>
                  <th scope="col" class="capitalize">CPF sem formatação</th>
                  <th scope="col" class="capitalize">CPF com formatação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (!empty($_GET['table'])) {

                  $queryBuscaColaboradoes = "SELECT * FROM rh_busca_colaborador";
                  $resultBusca = $conn->query($queryBuscaColaboradoes);

                  while ($colaborador = $resultBusca->fetch_assoc()) {

                    $caracteres = array(".", "-");
                    $cpfSemFormatacao = str_replace($caracteres, "", $colaborador['cpf']);

                    echo '<tr>
                          <td>' . $colaborador['nome'] . '</td>
                          <td>' . $cpfSemFormatacao . '</td>
                          <td>' . $colaborador['cpf'] . '</td>
                        </tr>';
                  }
                }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<script>
  function escolheNome() {

    var verificando = document.getElementById("gridRadios1").checked;
    var verificandoCPF = document.getElementById("gridRadios2").checked;

    if (verificando == false) {

      document.getElementById("nomeFuncionario").style.display = 'none';      
      document.getElementById("inputNome").required = false;
      document.getElementById("localizar").disabled = false;

      if(verificandoCPF == false){
        document.getElementById("cpfFuncionario").style.display = 'none';
        document.getElementById("inputCpf").required = false;
      }else{
        document.getElementById("cpfFuncionario").style.display = 'block';
        document.getElementById("inputCpf").required = true;
      }

      
      
    } else {
      document.getElementById("nomeFuncionario").style.display = 'block';
      document.getElementById("cpfFuncionario").style.display = 'none';
      document.getElementById("inputCpf").required = false;
      document.getElementById("inputNome").required = true;

      document.getElementById("localizar").disabled = false
    }


  }

  function escolheCpf() {
    document.getElementById("nomeFuncionario").style.display = 'none';
    document.getElementById("cpfFuncionario").style.display = 'block';
    document.getElementById("inputCpf").required = true;
    document.getElementById("inputNome").required = false;
    document.getElementById("localizar").disabled = false
  }
</script>

<?php
require_once('footer.php'); //Javascript e configurações afins

unset($_SESSION['tipoPesquisa']);
?>