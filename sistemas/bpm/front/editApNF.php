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
        <li class="breadcrumb-item"><a href="aprovadoresNF.php?pg=<?= $_GET['pg'] ?>">APROVADORES NF</a></li>
        <li class="breadcrumb-item">EDIÇÃO REGRA APROVADORES</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php require_once '../../../inc/mensagens.php';
  //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Editar aprovadores nf </h5>
            <br>
            <?php
            //salvando o conteudo original
            $usuarioOriginal = $queryUserApi;

            $aprovNF .= " AND a.id_aprovador = " . $_GET['id_aprovador'] . "";
            $id = $_GET['id_aprovador'];
            $result = oci_parse($connBpmgp, $aprovNF);
            oci_execute($result);

            while ($row = oci_fetch_array($result, OCI_ASSOC)) {

              echo '<form method="POST" class="row g-3" action="../inc/editApNF.php?pg=' . $_GET['pg'] . '&id_aprovador=' . $id . '" >
                <div class="form-floating mt-4 col-md-6" id="user">
                  <input type="hidden" value="' .
                $id .
                '" name = "id_aprovador">
                  <input type="text" class="form-select" value="' .
                $row['NOME_EMPRESA'] .
                '" disabled>
                  <label for="user">EMPRESA:</label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="dep">
                  <input type="text" class="form-control" value="' .
                $row['NOME_DEPARTAMENTO'] .
                '" name="dep" disabled>
                  <label for="dep">DEPARTAMENTO:</label>
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
                    <label for="sistema">CIÊNCIA FILIAL:</label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="situacao">
                    <select class="form-select"  style="width: 440px;margin-left: 4px;" name="situacao" required>';
              if ($row['SITUACAO'] == 'A') {
                $situacao = 'ATIVO';
              } else {
                $situacao = 'DESATIVADO';
              }

              echo '
                      <option value="' .
                $row['SITUACAO'] .
                '">' .
                $situacao .
                '</option>';
              echo '    
                      <option value="">-----------</option>
                      <option value="A">ATIVO</option>
                      <option value="D">DESATIVADO</option>';

              echo ' </select>
                  <label for="situacao">SITUAÇÃO:</label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="sistema">
                  <select class="form-select" name="area" required>';

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

              $sucesso = oci_parse($connSelbetti, $usuarioOriginal);
              oci_execute($sucesso);

              while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {

                echo '
                            <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
              }

              oci_free_statement($sucesso);

              echo '</select>
                  <label for="sistema">CIÊNCIA AREA:</label>
                </div>
                  <div class="form-floating mt-4 col-md-5">
                      <input class="form-control" id="limitA" value="' . $row['LIMITE_AREA'] . ',00" name="limitA">
                  <label for="limitA">LIMITE APROVAÇÃO:</label>
                  </div> 
                  <div class="form-floating col-md-1" style="font-size:25px;" title="Ilimitado!">
                    <a href="javascript:" title="Ilimitado!" onclick="SemLimitS()">
                      <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                   </a>                      
                      <script>
                        function SemLimitS(){
                            var check = document.getElementById("limitA").disabled
                            if(check == true){
                                document.getElementById("limitA").disabled = false;
                            }else{
                                document.getElementById("limitA").disabled = true;
                                document.getElementById("limitA").value = 0;
                            }                            
                        }
                    </script>
                  </div>
                <div class="form-floating mt-4 col-md-6">
                    <select class="form-select" id="marca" name="marca" required>';

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

                echo '
                                  <option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
              }

              oci_free_statement($sucesso);
              echo '
                    </select>
                    <label for="marca">CIÊNCIA MARCA:</label>
                  </div>
                  <div class="form-floating mt-4 col-md-5">
                    <input class="form-control" id="limitM" value="';
              if (empty($row['LIMITE_MARCA'])) {
                echo '0';
              } else {
                echo $row['LIMITE_MARCA'];
              }
              echo ',00" name="limitM">
                      <label for="limitM">LIMITE APROVAÇÃO:</label>
                  </div> 
                  <div class="form-floating col-md-1" style="font-size:25px;" title="Ilimitado!">
                    <a href="javascript:" title="Ilimitado!" onclick="SemLimitM()">
                      <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                    </a>                      
                      <script>
                        function SemLimitM(){
                            var check = document.getElementById("limitM").disabled
                            if(check == true){
                                document.getElementById("limitM").disabled = false;
                            }else{
                                document.getElementById("limitM").disabled = true;
                                document.getElementById("limitM").value = 0;
                            }

                            
                        }
                    </script>
                </div>

                <div class="form-floating mt-4 col-md-6" id="gerente">
                    <select class="form-select" name="gerente" required>';
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
                  <label for="gerente">GERENTE GERAL:</label>
                  </div>
                  <div class="form-floating mt-4 col-md-5">
                      <input class="form-control" id="limiteG"  value="';
              if (empty($row['LIMITE_GERAL'])) {
                echo '0';
              } else {
                echo $row['LIMITE_GERAL'];
              }

              echo ',00" name="limitG" >
                  <label for="limitG">LIMITE APROVAÇÃO:</label>
                  </div> 
                  <div class="form-floating col-md-1" style="font-size:25px;" title="Ilimitado!">
                    <a href="javascript:" title="Ilimitado!" onclick="SemLimitG()">
                      <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                    </a>                      
                      <script>
                        function SemLimitG(){
                            var check = document.getElementById("limiteG").disabled
                            if(check == true){
                                document.getElementById("limiteG").disabled = false;
                            }else{
                                document.getElementById("limiteG").disabled = true;
                                document.getElementById("limiteG").value = 0;
                            }

                            
                        }
                    </script>
                </div>
                <div class="form-floating mt-4 col-md-6" id="super">
                    <select class="form-select"  name="super" required>';
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
                  <label for="super">SUPERINTENDENTE:</label>
                  </div>
                  <div class="form-floating mt-4 col-md-5" >
                    <input class="form-control" id="limiteSuper" value="' . $row['LIMITE_SUPERITENDENTE'] . ',00" name="limitS">
                  <label for="limiteSuper">LIMITE APROVAÇÃO:</label>
                  </div> 
                  <div class="form-floating col-md-1" style="font-size:25px;" title="Ilimitado!">
                    <a href="javascript:" title="Ilimitado!" onclick="SemLimitSuper()">
                      <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                    </a>                      
                      <script>
                        function SemLimitSuper(){
                            var check = document.getElementById("limiteSuper").disabled
                            if(check == true){
                                document.getElementById("limiteSuper").disabled = false;
                            }else{
                                document.getElementById("limiteSuper").disabled = true;
                                document.getElementById("limiteSuper").value = 0;
                            }

                            
                        }
                    </script>
                </div>
                <div class="text-left">
                  <button type="button" class="btn btn-primary"><a href="aprovadoresNF.php?pg= ' .
                $_GET['pg'] .
                ' " style="color:white;">Voltar</a></button>
                  <button type="submit" class="btn btn-success">Editar</button>
                </div>
              </form>';
            }


            oci_free_statement($result);
            oci_close($connBpmgp);
            oci_close($connSelbetti);

            ?>
            <br>
          </div>
        </div>
      </div>


    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main>
<?php require_once 'footer.php'; //Javascript e configurações afins
?>