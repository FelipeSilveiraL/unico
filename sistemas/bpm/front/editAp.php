<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDIÇÃO REGRA APROVADORES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="aprovadoresRH.php?pg=<?= $_GET['pg'] ?>">APROVADORES RH</a></li>
        <li class="breadcrumb-item">EDIÇÃO REGRA APROVADORES</li>
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
          <div class="card-body"><br>
          <h5 class="card-title">editar aprovadores </h5>
            <form method="POST" class="row g-3" action="../inc/editAp.php?pg=<?= $_GET['pg'] ?>">
              <?php

              //salvando o conteudo original
              $usuarioOriginal = $queryUserApi;

              $aprovadoresQuery .= " AND a.id_aprovador = " . $_GET['id_aprovador'] . "";
              $id = $_GET['id_aprovador'];
              $result = oci_parse($connBpmgp, $aprovadoresQuery);
              oci_execute($result);

              while ($row = oci_fetch_array($result, OCI_ASSOC)) {

                echo '
                  <div class="form-floating mt-4 col-md-6" id="empresa">
                    <input type="hidden" value="' . $id . '" name = "id_aprovador">
                    <input type="text" class="form-select" value="' . $row['NOME_EMPRESA'] . '" id="user" disabled>
                    <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
                  </div>
                <div class="form-floating mt-4 col-md-6" id="depto">
                  <input type="text" class="form-select" value="' . $row['NOME_DEPARTAMENTO'] . '" id="user" name="dep" disabled>
                  <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
                </div>';

                $queryUserApi .= " WHERE U.ds_login='" . $row['APROVADOR_FILIAL'] . "' ";

                $conexao = oci_parse($connSelbetti, $queryUserApi);
                oci_execute($conexao);

                echo '<div class="form-floating mt-4 col-md-6" id="filial" id="sistema">
                  <select class="form-select" name="filial" required>';

                while ($rowCifU = oci_fetch_array($conexao, OCI_ASSOC)) {
                  echo '<option value="' . $row['APROVADOR_FILIAL'] . '">' . $rowCifU['DS_USUARIO'] . ' / ' . $rowCifU['DS_LOGIN'] . '</option>';
                };
                oci_free_statement($conexao);

                echo '    
                    <option value="">-----------</option>';

                $sucesso = oci_parse($connSelbetti, $usuarioOriginal);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                };
                oci_free_statement($sucesso);

                echo '
                  </select> 
                  <label for="sistema">CIÊNCIA FILIAL:<span style="color: red;">*</span></label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="area">
                  <select class="form-select" id="sistema" name="area" required>';

                $query = $usuarioOriginal;

                $query .= " WHERE U.ds_login='" . $row['APROVADOR_AREA'] . "' ";

                $sucesso = oci_parse($connSelbetti, $query);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {

                  echo '
                    <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                }

                oci_free_statement($sucesso);

                echo '    
                    <option value="">-----------</option>';

                $query = $usuarioOriginal;

                $sucesso = oci_parse($connSelbetti, $query);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                };

                oci_free_statement($sucesso);

                echo '</select>
                  <label for="sistema">CIÊNCIA AREA:<span style="color: red;">*</span></label>
                  </div>
                  <div class="form-floating mt-4 col-md-6" id="marca">
                    <select class="form-select" name="marca" required>';

                $query = $usuarioOriginal;

                $query .= " WHERE U.ds_login='" . $row['APROVADOR_MARCA'] . "' ";

                $sucesso = oci_parse($connSelbetti, $query);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '
                      <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                }

                oci_free_statement($sucesso);

                echo '    
                    <option value="">-----------</option>';

                $sucesso = oci_parse($connSelbetti, $usuarioOriginal);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                };

                oci_free_statement($sucesso);

                echo '
                    </select>
                    <label for="sistema">CIÊNCIA MARCA:<span style="color: red;">*</span></label>
                  </div>
                  <div class="form-floating mt-4 col-md-6" id="gerente">
                    <select class="form-select" id="sistema" name="gerente" required>';

                $query = $usuarioOriginal;

                $query .= " WHERE U.ds_login='" . $row['APROVADOR_GERENTE'] . "' ";

                $sucesso = oci_parse($connSelbetti, $query);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '
                      <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                }

                oci_free_statement($sucesso);

                echo '    
                    <option value="">-----------</option>';

                $sucesso = oci_parse($connSelbetti, $usuarioOriginal);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                };

                oci_free_statement($sucesso);

                echo ' </select>
                  <label for="sistema" >GERENTE GERAL:<span style="color: red;">*</span></label>
                  </div>
                <div  class="form-floating mt-4 col-md-6" id="super">
                    <select class="form-select" id="super" name="super" required>';

                $query = $usuarioOriginal;

                $query .= " WHERE U.ds_login='" . $row['APROVADOR_SUPERINTENDENTE'] . "' ";

                $sucesso = oci_parse($connSelbetti, $query);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '
                      <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                }

                oci_free_statement($sucesso);

                echo '    
                    <option value="">-----------</option>';

                $sucesso = oci_parse($connSelbetti, $usuarioOriginal);
                oci_execute($sucesso);

                while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                };

                oci_free_statement($sucesso);

                echo ' </select>
                <label for="sistema">SUPERINTENDENTE:<span style="color: red;">*</span></label>
                </div>
                  <div class="form-floating mt-4 col-md-6" id="situacao">
                      <select class="form-select" id="situacao" name="situacao" required>';
                if ($row['SITUACAO'] == 'A') {
                  $situacao = 'ATIVO';
                } else {
                  $situacao = "DESATIVADO";
                }

                echo '
                        <option value="' . $row['SITUACAO'] . '">' . $situacao . '</option>';
                echo '    
                        <option value="">-----------</option>
                        <option value="A">ATIVO</option>
                        <option value="D">DESATIVADO</option>';


                echo ' </select>
                  <label for="sistema">SITUAÇÃO:<span style="color: red;">*</span></label>
                </div>

                  <div class="text-left">
                    <button type="button" class="btn btn-primary"><a href="aprovadoresRH.php?pg= ' . $_GET['pg'] . ' " style="color:white;">Voltar</a></button>
                    <button type="submit" class="btn btn-success">Editar</button>
                  </div>
                ';
              }

              oci_free_statement($result);
              oci_close($connBpmgp);
              oci_close($connSelbetti);
              ?>
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