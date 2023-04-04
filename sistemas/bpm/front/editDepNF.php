<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA DEPARTAMENTO</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="departamentoNF.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTO NF</a></li>
        <li class="breadcrumb-item">NOVA REGRA DEPARTAMENTO</li>
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
          <h5 class="card-title">Nova regra departamento </h5>
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="../inc/editDepNF.php?pg=<?= $_GET['pg'] ?>&id=<?= $_GET['id_departamento']?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6" id="depto">
                <?php

                $depOriginal = $departNF;

                $departNF .= " WHERE d.ID_DEPARTAMENTO = " . $_GET['id_departamento'];

                $sucesso = oci_parse($connBpmgp, $departNF);
                oci_execute($sucesso);

                while ($row = oci_fetch_array($sucesso, OCI_ASSOC)) {

                  echo '<input type="text" value="' . $row['NOME_DEPARTAMENTO'] . '" class="form-control" name="depto" id="depto" disabled>';
                }                
                oci_free_statement($sucesso);
                ?>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="situacao" id="situacao" required>
                  <?php

                  $departNF = $depOriginal;

                  $departNF .= " WHERE d.ID_DEPARTAMENTO = " . $_GET['id_departamento'];

                  $sucesso = oci_parse($connBpmgp, $departNF);
                  oci_execute($sucesso);

                  while ($row2 = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    switch ($row2['SITUACAO']) {
                      case 'A':
                        $situacao = 'ATIVO';
                        break;
                      case 'D':
                        $situacao = 'DESATIVADO';
                        break;
                    }
                    echo '<option value="' . $row2['SITUACAO'] . '">' . $situacao . '</option>';
                  }
                  oci_free_statement($sucesso);
                  oci_close($connBpmgp);

                  ?>
                  <option>------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="text-left py-2">
                <a href="departamentoNF.php?pg=<?=$_GET['pg']?>" class="btn btn-primary">Voltar</a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Editar</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div>
    </div> <!-- FIM col-lg-12 -->
  </section><!-- FIM section -->
  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>