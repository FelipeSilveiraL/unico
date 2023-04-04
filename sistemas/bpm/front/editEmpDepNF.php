<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITAR REGRA EMPRESA X DEPARTAMENTO NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="nfEmpDep.php?pg=<?= $_GET['pg'] ?>">EMPRESA X DEPARTAMENTO NF</a></li>
        <li class="breadcrumb-item">EDITAR REGRA EMPRESA X DEPARTAMENTO NF</li>
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
            <h5 class="card-title">Editar regra empresa x departamento nf </h5>
            <form class="row g-3" action="../inc/editEmpDepNF.php?pg=<?= $_GET['pg'] ?>&id_empdep=<?= $_GET['id'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <?php
              $empdepNF .= " WHERE e.ID_EMPDEP =" . $_GET['id'];
              $sucesso = oci_parse($connBpmgp, $empdepNF);
              oci_execute($sucesso);

              while ($row = oci_fetch_array($sucesso, OCI_ASSOC)) {

                $situacao = $row['SITUACAO'];
                $gerente = $row['GERENTE_APROVA'];
                $super = $row['SUPERINTENDENTE_APROVA'];
                $lanca = $row['LANCA_MULTAS'];
                $gestor = $row['GESTOR_AREA_APROVA_MULTAS'];
                $lancarNotas = $row['LANCA_NOTAS'];


                $situacao = $situacao == 'A' ? 'ATIVO' : 'DESATIVADO';
                $gerente = $gerente == 'S' ? 'SIM' : 'NÃO';
                $super = $super == 'S' ? 'SIM' : 'NÃO';
                $lanca = $lanca == 'S' ? 'SIM' : 'NÃO';
                $gestor = $gestor == 'S' ? 'SIM' : 'NÃO';
                $lancarNotas = $lancarNotas == 'S' ? 'SIM' : 'NÃO';

                echo '<div class="form-floating mt-4 col-md-6" id="empresa">
                          <input type="text" value="' . $row['NOME_EMPRESA'] . '" class="form-control" disabled>
                          <label for="empresa">EMPRESA:</label>
                        </div>

                        <div class="form-floating mt-4 col-md-6" id="depto">
                          <input type="text" class="form-control" value="' . $row['NOME_DEPARTAMENTO'] . '" disabled >
                          <label for="depto">DEPARTAMENTO:</label>
                        </div>

                        <div class="form-floating mt-4 col-md-6" id="gerente">
                          <select class="form-select" name="gerap"  required>
                            <option value="' . $row['GERENTE_APROVA'] . '">' . $gerente . '</option>
                            <option>------------</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                          </select>
                          <label for="gerente">GERENTE APROVA:<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating mt-4 col-md-6" id="super">
                          <select class="form-select" name="supap"  required>
                            <option value="' . $row['SUPERINTENDENTE_APROVA'] . '">' . $super . '</option>
                            <option>------------</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                          </select>
                          <label for="super">SUPERINTENDENTE APROVA:<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating mt-4 col-md-6" id="situacao">
                          <select class="form-select" name="situacao"  >
                            <option value="' . $row['SITUACAO'] . '">' . $situacao . '</option>
                            <option>------------</option>
                            <option value="A">ATIVO</option>
                            <option value="D">DESATIVADO</option>
                          </select>
                          <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating mt-4 col-md-6" id="lancarMulta">
                          <select class="form-select" name="lancarMulta" >
                            <option value="' . $row['LANCA_MULTAS'] . '">' . $lanca . '</option>
                            <option value="">------------</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                          </select>
                          <label for="lancarMulta">LANÇAR MULTAS:<span style="color: red;">*</span></label>
                        </div>
                      <div class="form-floating mt-4 col-md-6" id="gestorAprovaM">
                        <select class="form-select" name="gestorAprovaM" >
                          <option value="' . $row['GESTOR_AREA_APROVA_MULTAS'] . '">' . $gestor . '</option>
                          <option value="">------------</option>
                          <option value="S">SIM</option>
                          <option value="N">NÃO</option>
                        </select>
                        <label for="gestorAprovaM">GESTOR ÁREA APROVA MULTAS:<span style="color: red;">*</span></label>
                      </div>
                      <div class="form-floating mt-4 col-md-6" id="lancarNotaM">
                        <select class="form-select" name="lancarNotaM" >
                          <option value="' . $row['LANCA_NOTAS'] . '">' . $lancarNotas . '</option>
                          <option value="">------------</option>
                          <option value="S">SIM</option>
                          <option value="N">NÃO</option>
                        </select>
                        <label for="lancarNotaM">LANÇAR:<span style="color: red;">*</span></label>
                      </div>';
              }
              oci_free_statement($sucesso);
              oci_close($connBpmgp);
              ?>
              <div class="text-left py-2">
                <a href="nfEmpDep.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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