<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Cadastramento Filiais Apollo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="informatica.php?pg=<?= $_GET['pg'] ?>">Informática</a></li>
        <li class="breadcrumb-item">Cadastramento Filiais Apollo</li>
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
            <form action="../inc/empRev.php" method="POST">
              <a href="../front/empRev.php?pg=<?= $_GET['pg'] ?>&id=4" <?= $usuarioFuncao ?>><button class="btn btn-primary " style="margin-left: 10px;margin-bottom:10px;" type="button" title="Cadastrar filial"><i class="bi bi-person-plus"></i></button></a>
              <button type="submit" class="btn btn-primary " title="Salvar alterações" style="margin-left: 10px;margin-bottom:10px;display:<?= ($_GET['id'] == 2 or $_GET['id'] == 3 or $_GET['id'] == 4) ? '' : 'none;' ?>" type="button"><i class="ri-save-3-fill"></i></button>
              <a href="../front/empRev.php?pg=<?= $_GET['pg'] ?>&id=1"><button class="btn btn-success " title="Editar Filial" style="margin-left: 10px;margin-bottom:10px;" type="button"><i class="ri-edit-2-line"></i></button></a><br><br>

              <?php
              switch ($_GET['id']) {
                case 1:
                  echo ' <table class="table datatable" >
                          <thead>
                            <tr>
                              <th scope="col" class="capitalize">EMPR&ensp;</th>
                              <th scope="col" class="capitalize">NUM REV&ensp;</th>
                              <th scope="col" class="capitalize">NOME REV&ensp;</th>
                              <th scope="col" class="capitalize">NOME FILIAL&ensp;</th>
                              <th scope="col" class="capitalize">TIPO&ensp;</th>
                              <th scope="col" class="capitalize">REV&ensp;</th>
                              <th scope="col" class="capitalize">DN&ensp;</th>
                              <th scope="col" class="capitalize">ATIVO&ensp;</th>
                              <th scope="col" class="capitalize">VENDAS&ensp;</th>
                              <th scope="col" class="capitalize">BD&ensp;</th>
                              <th scope="col" class="capitalize">BANDEIRA&ensp;</th>
                              <th scope="col" class="capitalize">CNPJ&ensp;</th>
                              <th scope="col" class="capitalize" style="display:';
                  echo ($_GET['id'] == 1) ? '">' : 'none">';

                  echo 'AÇÃO&ensp;</th>
                            </tr>
                          </thead>
                          <tbody>';

                  $conexaoSucesso = $conn->query($tabelaEmpRev);

                  while ($row = $conexaoSucesso->fetch_assoc()) {
                    echo
                    '<tr>
                              <td>' . $row['EMPR'] . '</td>
                              <td>' . $row['num_rev'] . '</td>
                              <td>' . $row['nome_empresa'] . '</td>
                              <td>' . $row['nome_filial'] . '</td>
                              <td>' . $row['tipo'] . '</td>
                              <td>' . $row['rev'] . '</td>
                              <td>' . $row['dn'] . '</td>
                              <td>' . $row['ATIVO'] . '</td>
                              <td>' . $row['tem_vendas'] . '</td>
                              <td>' . $row['sistema_emp_bd'] . '</td>
                              <td>' . $row['bandeira'] . '</td>
                              <td>' . $row['cnpj'] . '</td>
                              <td style="display:';

                    echo ($_GET['id'] == 1) ? '">' : 'none"';
                    $id = $row['id'];
                    echo '
                    <a href="../front/empRev.php?pg=' . $_GET['pg'] . '&id=3&id2=' . $id . '" ' . $usuarioFuncao . '><button type="button" class="btn btn-success btn-sm"><i class="ri-pencil-line"></i></button></a>
                    <a href="../front/empRev.php?pg=' . $_GET['pg'] . '&id=5&id2=' . $id . '" data-bs-toggle="modal" data-bs-target="#excluir' . $id . '" ' . $usuarioFuncao . '><span style="color:red;"><button type="button" class="btn btn-danger btn-sm"><i class="ri-delete-bin-6-line"></i></span></button></a>
                      </td>
                      <div class="modal fade" id="excluir' . $id . '" tabindex="-1">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"><span style="color: red;">ATENÇÃO <i class="ri-error-warning-line"></i></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                           Tem certeza que deseja excluir?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <a href="../inc/empRev.php?ex=' . $id . '"><button type="button" class="btn btn-danger">Excluir</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                      </tr>                      
                      ';
                  }
                  echo '</tbody>
                </table>';
                  break;
                case 2:
                  echo '<table class="table datatable">
                      <thead>
                          <tr>
                            <th scope="col" class="capitalize">EMPR&ensp;</th>
                            <th scope="col" class="capitalize">Num Rev&ensp;</th>
                            <th scope="col" class="capitalize">Nome Emp&ensp;</th>
                            <th scope="col" class="capitalize">NOME FILIAL&ensp;</th>
                            <th scope="col" class="capitalize">Tipo&ensp;</th>
                            <th scope="col" class="capitalize">Rev&ensp;</th>
                            <th scope="col" class="capitalize">DN&ensp;</th>
                            <th scope="col" class="capitalize">ATIVO&ensp;</th>
                            <th scope="col" class="capitalize">VENDAS&ensp;</th>
                            <th scope="col" class="capitalize">BD&ensp;</th>
                            <th scope="col" class="capitalize">BANDEIRA&ensp;</th>
                            <th scope="col" class="capitalize">CNPJ&ensp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <input type="hidden" name="id" value="0">
                            <td><input type="text" style="width:40px;" name="EMPR"></td>
                            <td><input type="text" style="width:30px;" name="NUMREV"></td>
                            <td><input type="text" style="width:100px;" name="NOMEEMP"></td>
                            <td><input type="text" style="width:60px;" name="NOMEFILIAL"></td>
                            <td><input type="text" style="width:30px;" name="TIPO"></td>
                            <td><input type="text" style="width:30px;" name="REV"></td>
                            <td><input type="text" style="width:40px;" name="DN"></td>
                            <td><input type="text" style="width:20px;" name="ATIVO"></td>
                            <td><input type="text" style="width:20px;" name="VENDAS"></td>
                            <td><input type="text" style="width:20px;" name="BD"></td>
                            <td><input type="text" style="width:30px;" name="BANDEIRA"></td>
                            <td><input type="text" style="width:120px;" name="CNPJ"></td>
                          </tr>
                        </tbody>
                      </table>';
                  break;
                  //editando dado
                case 3:

                  $id2 = $_GET['id2'];

                  $tabelaEmpRev .= ' WHERE id=' . $id2 . '';
                  $conexaoSucesso = $conn->query($tabelaEmpRev);

                  while ($row = $conexaoSucesso->fetch_assoc()) {

                    echo '
                          <div class="row">
                          <input type="hidden" value="' . $row['id'] . '" name="id">  
                          <div class="form-floating mt-6 col-md-12" id="NOMEEMP">
                          <input type="text" value="' . $row['nome_empresa'] . '" class="form-control" id="NOMEEMP" name="NOMEEMP">
                            <label for="NOMEEMP">NOME EMPRESA:<span style="color: red;">*</span></label>
                          </div>          
                          <div class="form-floating mt-4 col-md-6" id="EMPR">
                          <input type="text" value="' . $row['EMPR'] . '" class="form-control" id="EMPR" name="EMPR">
                            <label for="EMPR" class="capitalize">EMPRESA:</label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="NUM">
                          <input type="text" value="' . $row['num_rev'] . '" class="form-control" id="NUM" name="NUMREV">
                          <label for="NUM">NUM REV:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="NOMEFILIAL">
                          <input type="text" value="' . $row['nome_filial'] . '" class="form-control" id="NOMEFILIAL" name="NOMEFILIAL">
                            <label for="NOMEFILIAL">NOME FILIAL:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="TIPO">
                          <input type="text" value="' . $row['tipo'] . '" class="form-control" id="TIPO" name="TIPO">
                            <label for="TIPO">TIPO:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="REV">
                          <input type="text" value="' . $row['rev'] . '" class="form-control" id="REV" name="REV">
                            <label for="REV">REV:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="DN">
                          <input type="text" value="' . $row['dn'] . '" class="form-control" id="DN" name="DN">
                            <label for="DN">DN:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="ATIVO">
                          <input type="text" value="' . $row['ATIVO'] . '" class="form-control" id="ATIVO" name="ATIVO">
                            <label for="ATIVO">ATIVO:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="VENDAS">
                          <input type="text" value="' . $row['tem_vendas'] . '" class="form-control" id="VENDAS" name="VENDAS">
                            <label for="VENDAS">VENDAS:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="BD">
                          <input type="text" value="' . $row['sistema_emp_bd'] . '" class="form-control" id="BD" name="BD">
                            <label for="BD">BD:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="BANDEIRA">
                          <input type="text" value="' . $row['bandeira'] . '" class="form-control" id="BANDEIRA" name="BANDEIRA">
                            <label for="BANDEIRA">BANDEIRA:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="REVMATRIZ">
                          <input type="text" value="' . $row['rev_matriz'] . '" class="form-control" id="REVMATRIZ" name="REVMATRIZ">
                            <label for="REVMATRIZ">REVMATRIZ:<span style="color: red;">*</span></label>
                          </div>
                          <div class="form-floating mt-4 col-md-6" id="CNPJ">
                          <input type="text" value="' . $row['cnpj'] . '" class="form-control" id="CNPJ" name="CNPJ">
                            <label for="CNPJ">CNPJ:<span style="color: red;">*</span></label>
                          </div>
                        </div><br>
                          ';
                  }
                  break;
                case 4:
                  echo' 
                  <div class="row">
                    <div class="form-floating mt-6 col-md-12" id="NOMEEMP">
                    <input type="text" class="form-control" id="NOMEEMP" name="NOMEEMP">
                      <label for="NOMEEMP">NOME EMPRESA:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="EMPR">
                    <input type="text" class="form-control" id="EMPR" name="EMPR">
                      <label for="EMPR" class="capitalize">EMPRESA:</label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="NUM">
                    <input type="text" class="form-control" id="NUM" name="NUMREV">
                    <label for="NUM">NUM REV:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="NOMEFILIAL">
                    <input type="text" class="form-control" id="NOMEFILIAL" name="NOMEFILIAL">
                      <label for="NOMEFILIAL">NOME FILIAL:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="TIPO">
                    <input type="text" class="form-control" id="TIPO" name="TIPO">
                      <label for="TIPO">TIPO:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="REV">
                    <input type="text" class="form-control" id="REV" name="REV">
                      <label for="REV">REV:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="DN">
                    <input type="text" class="form-control" id="DN" name="DN">
                      <label for="DN">DN:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="ATIVO">
                    <input type="text" class="form-control" id="ATIVO" name="ATIVO">
                      <label for="ATIVO">ATIVO:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="VENDAS">
                    <input type="text" class="form-control" id="VENDAS" name="VENDAS">
                      <label for="VENDAS">VENDAS:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="BD">
                    <input type="text" class="form-control" id="BD" name="BD">
                      <label for="BD">BD:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="BANDEIRA">
                    <input type="text" class="form-control" id="BANDEIRA" name="BANDEIRA">
                      <label for="BANDEIRA">BANDEIRA:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="REVMATRIZ">
                    <input type="text" class="form-control" id="REVMATRIZ" name="REVMATRIZ">
                      <label for="REVMATRIZ">REVMATRIZ:<span style="color: red;">*</span></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6" id="CNPJ">
                    <input type="text" class="form-control" id="CNPJ" name="CNPJ">
                      <label for="CNPJ">CNPJ:<span style="color: red;">*</span></label>
                    </div>
                  </div><br>';
                  break;
                default:
                  echo ' <table class="table datatable">
                        <thead>
                            <tr>
                              <th scope="col" class="capitalize">EMPR&ensp;</th>
                              <th scope="col" class="capitalize">Num Rev&ensp;</th>
                              <th scope="col" class="capitalize">Nome Emp&ensp;</th>
                              <th scope="col" class="capitalize">NOME FILIAL&ensp;</th>
                              <th scope="col" class="capitalize">Tipo&ensp;</th>
                              <th scope="col" class="capitalize">Rev&ensp;</th>
                              <th scope="col" class="capitalize">DN&ensp;</th>
                              <th scope="col" class="capitalize">ATIVO&ensp;</th>
                              <th scope="col" class="capitalize">VENDAS&ensp;</th>
                              <th scope="col" class="capitalize">BD&ensp;</th>
                              <th scope="col" class="capitalize">BANDEIRA&ensp;</th>
                              <th scope="col" class="capitalize">REVMATRIZ&ensp;</th>
                              <th scope="col" class="capitalize">CNPJ&ensp;</th>
                            </tr>
                          </thead>
                          <tbody>';
                  $conexaoSucesso = $conn->query($tabelaEmpRev);

                  while ($row = $conexaoSucesso->fetch_assoc()) {

                    echo '<tr>
                                    <td>' . $row['EMPR'] . '</td>
                                    <td>' . $row['num_rev'] . '</td>
                                    <td>' . $row['nome_empresa'] . '</td>
                                    <td>' . $row['nome_filial'] . '</td>
                                    <td>' . $row['tipo'] . '</td>
                                    <td>' . $row['rev'] . '</td>
                                    <td>' . $row['dn'] . '</td>
                                    <td>' . $row['ATIVO'] . '</td>
                                    <td>' . $row['tem_vendas'] . '</td>
                                    <td>' . $row['sistema_emp_bd'] . '</td>
                                    <td>' . $row['bandeira'] . '</td>
                                    <td>' . $row['rev_matriz'] . '</td>
                                    <td>' . $row['cnpj'] . '</td>
                                  </tr>
                          ';
                  }
                  echo '
                                  </tbody>
                                </table>';
                  break;
              }
              ?>

            </form>
          </div>
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