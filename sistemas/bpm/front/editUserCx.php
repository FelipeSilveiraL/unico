<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITANDO USUÁRIO CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item"><a href="userCaixa.php?pg=<?= $_GET['pg'] ?>">USUÁRIOS CAIXA</a></li>
        <li class="breadcrumb-item">EDITANDO USUÁRIO CAIXA</li>
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
            <?php
              $id = $_GET['idCaixaEmpresa'];
              $user = $_GET['user'];

              $consulta .= " WHERE ID_CAIXA_EMPRESA = " . $id . " AND USUARIO_CAIXA = '" . $user . "' ";
              /* $result = oci_parse($connBpmgp, $consulta);
              oci_execute($result); */

              echo $consulta;
              exit;

              while (($row = oci_fetch_assoc($result)) != false) {

                $id_empresa = $row['ID_EMPRESA'];

                //query que é só para exibir o nome do caixa referente ao dado cadastrado, por que só está dado numérico no db

                $query = "SELECT NOME_CAIXA FROM caixa_empresa WHERE ID_CAIXA_EMPRESA = '" . $row['ID_CAIXA_EMPRESA'] . "'";

                $result2 = oci_parse($connBpmgp, $query);
                oci_execute($result2, OCI_COMMIT_ON_SUCCESS);

                if (($row2 = oci_fetch_array($result2, OCI_ASSOC)) != false) {
                  $dado = $row2['NOME_CAIXA'];
                }

                //query pra procurar se foi cadastrado alguem caixa nessa empresa, se não foi ele exibe um botão para cadastrar.
                $queryNomeCaixa = "SELECT NOME_CAIXA,ID_CAIXA_EMPRESA FROM caixa_empresa WHERE ID_EMPRESA = '" . $id_empresa . "'";

                $result3 = oci_parse($connBpmgp, $queryNomeCaixa);
                oci_execute($result3, OCI_COMMIT_ON_SUCCESS);

                if (($row3 = oci_fetch_array($result3, OCI_ASSOC)) != false) {
                  $display = "none;";
                } else {
                  $display = "block;";
                  $dado = 'Não existe caixa cadastrado!';
                  $disabled = 'disabled';
                }
                //procura nome da empresa
                $queryEmpresa .= " WHERE ID_EMPRESA =" . $id_empresa;
                $result4 = oci_parse($connBpmgp, $queryEmpresa);
                oci_execute($result4, OCI_COMMIT_ON_SUCCESS);

                if (($row4 = oci_fetch_array($result4, OCI_ASSOC)) != false) {
                  $nomeEmpresa = $row4['NOME_EMPRESA'];
                }
                // ---------------------------------
                echo '
                    <form method="POST" action=" ../inc/editarCxUs.php?pg=' . $_GET['pg'] . '&user=' . $user . '&id=' . $id . '" >
                      <div class="row mb-3">
                        <label for="user" class="col-sm-2 col-form-label">Nome Empresa</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="user" name="nome_empresa" value ="' . $nomeEmpresa . '" disabled>
                          <input type="hidden" value="' . $row['USUARIO_CAIXA'] . '" name="usuario_caixa">
                          <input type="hidden" value="' . $row['ID_EMPRESA'] . '" name="id_empresa" id="empresa">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="nomeCaixa" class="col-sm-2 col-form-label" required>Nome Caixa:</label>
                        <div class="col-md-6">
                          <select class="form-select" name="nomeCaixa" id="nomeCaixa" required ' . $disabled . '>
                            <option value="' . $row['ID_CAIXA_EMPRESA'] . '" >' . $dado . '</option>
                            <option>-------</option>';

                //query que procura no bpm_caixa_empresa outros nomes cadastrados

                $queryNomeCaixa = "SELECT NOME_CAIXA,ID_CAIXA_EMPRESA FROM caixa_empresa WHERE ID_EMPRESA = '" . $id_empresa . "'";

                $result5 = oci_parse($connBpmgp, $queryNomeCaixa);
                oci_execute($result5, OCI_COMMIT_ON_SUCCESS);

                while (($nome = oci_fetch_array($result5, OCI_ASSOC)) != false) {

                  echo '<option value="' . $nome['ID_CAIXA_EMPRESA'] . '">' . $nome['NOME_CAIXA'] . '</option>';
                }

                echo '</select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="userCaixa" class="col-sm-2 col-form-label" required>Usuário Caixa:</label>
                        <div class="col-md-6">
                          <select class="form-select" name="userCaixa" id="userCaixa" required>
                            <option value="' . $row['USUARIO_CAIXA'] . '">' . $row['USUARIO_CAIXA'] . '</option>
                              <option value=""> ------------ </option>
                              ';

                $result6 = oci_parse($connSelbetti, $query_user);
                oci_execute($result6, OCI_COMMIT_ON_SUCCESS);

                while (($row6 = oci_fetch_array($result6, OCI_ASSOC)) != false) {

                  echo '<option value="' . $row6['DS_LOGIN'] . '">' . $row6['DS_USUARIO'] . ' / ' . $row6['DS_LOGIN'] . '</option>';
                }
                echo '
                          </select>
                        </div>
                      </div>
                      
                      <br>
                      <div class="text-left">
                        <button type="button" class="btn btn-primary"><a href="userCaixa.php?pg=' . $_GET['pg'] . '" style="color:white;">Voltar</a></button>
                        <button type="submit" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-primary" style="display:' . $display . 'float:right;"><a href="novaRegraCxEmpresa.php?pg=' . $_GET['pg'] . '&id=' . $id_empresa . '" style="color:white;">Cadastrar</a></button>
                      </div>
                      
                      <br>
                    </form>';
              }

              oci_close($connBpmgp);
              oci_close($connSelbetti);
            ?>
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