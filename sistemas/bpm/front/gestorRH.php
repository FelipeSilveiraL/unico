<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');

$_SESSION['usuario'] = $_GET['usuario'];
$_SESSION['login'] = $_GET['login'];
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>GESTOR RH</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">GESTOR RH</li>
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
            <h5 class="card-title"> Gestor rh</h5>
            <div style="display:<?= empty($_GET['dado']) ? 'block;' : 'none;'; ?>">
              <form class="row g-3" action="../inc/localizaGestor.php?pg=<?= $_GET['pg'] ?>" method="POST">
                <div class="mt-4 col-md-6" style="margin-left: 25%;" id="depto">
                  <label for="depto">Localizar gestor:</label>
                  <input type="text" class="form-control" name="nomeGestor" style="text-transform: uppercase;" placeholder="LOGIN/CPF" required>
                </div>

                <?php
                if ($_GET['erro'] == 1) {
                  echo '<p style="color: red;text-align:center;">Usuário não localizado!</p>';
                }
                ?>

                <div class="text-center">
                  <a href="departamentos.php?pg=' . $_GET['pg'] . '" class="btn btn-primary">Voltar</a>
                  <button type="submit" class="btn btn-success">Buscar</button>
                </div>
              </form>
            </div>

            <div style="display:<?= empty($_GET['dado']) ? 'none;' : 'block;' ?>">
              <form class="row g-3" action="atualizandoGestor.php?pg=<?= $_GET['pg'] ?>" method="POST">
                <div class="form-floating mt-4 col-md-6" id="depto" style="margin-left: 25%">
                  <input type="text" class="form-control" value="<?= $_GET['login'].' / '.$_GET['usuario']; ?>" name="gestorVelho" disabled>
                  <label for="depto">Gestor atual localizado:</label>
                </div>
                <div class="form-floating mt-4 col-md-6" style="margin-left: 25%">
                  <select class="form-select" name="gestorNovo" required>
                    <option value=""> ------------ </option>
                    <?php
                      $query_user .= ' ORDER BY DS_USUARIO ASC';
                      
                      $exec = oci_parse($connSelbetti, $query_user);
                      oci_execute($exec);

                      while ($row = oci_fetch_array($exec, OCI_ASSOC)) {
                        echo '<option value="' . $row['DS_LOGIN'] . ' / ' . $row['DS_USUARIO'] . '">' . $row['DS_USUARIO'] . ' / ' . $row['DS_LOGIN'] . '</option>';
                      }

                      oci_free_statement($exec);
                      oci_close($connSelbetti);

                    ?>
                  </select>
                  <label for="aproCaixa">Alterar para novo gestor:<span style="color: red;">*</span></label>
                </div>
                <div class="text-center">
                  <a href="departamentos.php?pg=<?= $_GET['pg'] ?>" class="btn btn-danger">Voltar</a>
                  <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
              </form>
            </div>
            <!-- Vertical Form -->

          </div>
        </div>
      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>