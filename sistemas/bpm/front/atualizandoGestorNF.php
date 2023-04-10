<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>GESTOR NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">GESTOR NF</li>
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

            <h5 class="card-title">Gestor nf</h5>
            <?php
            $idGestor = $_SESSION['login'];

            $queryCount = "SELECT COUNT(*) as quantidade FROM aprovadores_nf";

            $original = $queryCount;

            $queryCount .= " WHERE 
                aprovador_filial = '" . $idGestor . "' OR
                aprovador_area = '" . $idGestor . "' OR
                aprovador_marca = '" . $idGestor . "' OR
                aprovador_superintendente = '" . $idGestor . "' OR
                aprovador_gerente = '" . $idGestor . "' OR
                aprovador_gestor = '" . $idGestor . "'";
            $conexao = oci_parse($connBpmgp, $queryCount);
            oci_execute($conexao);

            while ($count = oci_fetch_array($conexao, OCI_ASSOC)) {
              $usuarioOld = $count['QUANTIDADE'];
            }
            oci_free_statement($conexao);

            $idGestorNovo = explode(' ', $_POST['gestorNovo'])[0];
            $queryCount = $original;

            $queryCount .= " WHERE 
                  aprovador_filial = '" . $idGestorNovo . "' OR
                  aprovador_area = '" . $idGestorNovo . "' OR
                  aprovador_marca = '" . $idGestorNovo . "' OR
                  aprovador_superintendente = '" . $idGestorNovo . "' OR
                  aprovador_gerente = '" . $idGestorNovo . "' OR
                  aprovador_gestor = '" . $idGestorNovo . "'";

            $conexao = oci_parse($connBpmgp, $queryCount);
            oci_execute($conexao);

            while ($count = oci_fetch_array($conexao, OCI_ASSOC)) {
              $usuarioNew = $count['QUANTIDADE'];
            }
            oci_free_statement($conexao);

            oci_close($connBpmgp);

            ?>

            <form class="row g-3" action="../inc/atualizandoGestorNF.php?pg=<?= $_GET['pg'] ?>" method="POST">

              <input type="hidden" name="gestorVelho" id="gestorVelho" value="<?= $_SESSION['login'] ?>">
              <input type="hidden" name="gestorNovo" id="gestorNovo" value="<?= $idGestorNovo ?>">

              <div class="form-floating mt-4 col-md-6" style="margin-left: 25%;" id="depto">
                <span style="color: red;margin-left:30%;font-size: 30px;">
                  <i class="bi bi-exclamation-diamond-fill"></i> ATENÇÃO! <i class="bi bi-exclamation-diamond-fill"></i>
                </span>

                <br>Você esta preste a atualizar <b>TODAS</b> as <b>REGRAS</b> do <b>ANTIGO</b> gestor:<br>
                <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"> <?= $_SESSION['login'] ?> / <?= $_SESSION['usuario'] ?><br>
                  <span style="font-size: small;color: red;">(<?= $usuarioOld ?>) ocorrências</span>
                </p>
                <br>Para o <b>NOVO</b> gestor:
                <p style="text-align: center; background-color: #efe9ef; border-radius: 10px; padding: 5px;"><?= $_POST['gestorNovo'] ?><br> <span style="font-size: small;color: red;"> (<?= $usuarioNew ?>) ocorrências</span></p>
                após a confirmação não terá mais como reverter!
              </div>

              <div class="text-center">
                <a href="gestorRH.php?pg=<?= $_GET['pg'] ?>" class="btn btn-danger">NÃO ATUALIZAR, me tire daqui!</a>
                <button type="submit" class="btn btn-primary">CONFIRMAR, entendo os riscos!</button>
              </div>

            </form>
            <br>
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