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
        <li class="breadcrumb-item"><a href="departamentos.php">Departamentos</a></li>
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
            <form action="../inc/empRev.php" method="POST" >
              <a href="../front/empRev.php?pg=<?= $_GET['pg'] ?>&id=4"><button class="btn btn-primary " style="float: right;margin-left: 10px;margin-bottom:10px;" type="button" title="Cadastrar filial"><i class="bi bi-person-plus"></i></button></a>
              <button type="submit" class="btn btn-primary " title="Salvar alterações" style="float: right;margin-left: 10px;margin-bottom:10px;display:<?= ($_GET['id'] == 2 or $_GET['id'] == 3 or $_GET['id'] == 4) ? '' : 'none;' ?>" type="button"><i class="ri-save-3-fill"></i></button>
              <a href="../front/empRev.php?pg=<?= $_GET['pg'] ?>&id=1"><button class="btn btn-success " title="Editar Filial" style="float: right;margin-left: 10px;margin-bottom:10px;" type="button"><i class="ri-edit-2-line"></i></button></a><br><br>

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
                      <a href="../front/empRev.php?pg='.$_GET['pg'].'&id=3&id2=' . $id . '"><span style="color: green;"><i class="ri-pencil-line"></i></span></a>
                      <a href="../front/empRev.php?pg='.$_GET['pg'].'&id=5&id2=' . $id . '" data-bs-toggle="modal" data-bs-target="#excluir' . $id . '" ><span style="color:red;"><i class="ri-delete-bin-6-line"></i></span></a></td>
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
                            <a href="../inc/empRev.php?ex='.$id.'"><button type="button" class="btn btn-danger">Excluir</button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                      </tr>

                      
                      
                      ';
                      
                }
                echo '</tbody>
                </table>'
                ;
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
                    
                    $tabelaEmpRev .= ' WHERE id='.$id2.'';

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
                          <th scope="col" class="capitalize">REVMATRIZ&ensp;</th>
                          <th scope="col" class="capitalize">CNPJ&ensp;</th>
                        </tr>
                      </thead>
                      <tbody>';
                      $conexaoSucesso = $conn->query($tabelaEmpRev);

                          while ($row = $conexaoSucesso->fetch_assoc()) {

                            echo '<tr>
                                    <input type="hidden" value="'.$row['id'].'" name="id">
                                    <td><input style="width: 30px;" value="'.$row['EMPR'].'" name="EMPR"></td>
                                    <td><input style="width: 30px;" value="'.$row['num_rev'].'" name="NUMREV"></td>
                                    <td><input style="width: 100px;" value="'.$row['nome_empresa'].'" name="NOMEEMP"></td>
                                    <td><input style="width: 60px;" value="'.$row['nome_filial'].'" name="NOMEFILIAL"></td>
                                    <td><input style="width: 30px;" value="'.$row['tipo'].'" name="TIPO"></td>
                                    <td><input style="width: 30px;" value="'.$row['rev'].'" name="REV"></td>
                                    <td><input style="width: 40px;" value="'.$row['dn'].'" name="DN"></td>
                                    <td><input style="width: 30px;" value="'.$row['ATIVO'].'" name="ATIVO"></td>
                                    <td><input style="width: 30px;" value="'.$row['tem_vendas'].'" name="VENDAS"></td>
                                    <td><input style="width: 30px;" value="'.$row['sistema_emp_bd'].'" name="BD"></td>
                                    <td><input style="width: 30px;" value="'.$row['bandeira'].'" name="BANDEIRA"></td>
                                    <td><input style="width: 30px;" value="'.$row['rev_matriz'].'" name="REVMATRIZ"></td>
                                    <td><input style="width: 120px;" value="'.$row['cnpj'].'" name="CNPJ"></td>
                                  </tr>
                                </tbody>
                                </table>
                          ';}
                      break;
                      case 4:
                        echo'<table class="table datatable">
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
                          <tbody>
                            <tr>
                                    <td><input style="width: 30px;"  name="EMPR"></td>
                                    <td><input style="width: 30px;" name="NUMREV"></td>
                                    <td><input style="width: 100px;"name="NOMEEMP"></td>
                                    <td><input style="width: 60px;" name="NOMEFILIAL"></td>
                                    <td><input style="width: 60px;"name="TIPO" ></td>
                                    <td><input style="width: 30px;" name="REV"></td>
                                    <td><input style="width: 30px;"name="DN" ></td>
                                    <td><input style="width: 20px;" name="ATIVO"></td>
                                    <td><input style="width: 30px;" name="VENDAS"></td>
                                    <td><input style="width: 30px;" name="BD"></td>
                                    <td><input style="width: 30px;" name="BANDEIRA"></td>
                                    <td><input style="width: 30px;" name="REVMATRIZ"></td>
                                    <td><input style="width: 100px;" name="CNPJ"></td>
                                    
                                  </tr>
                            </tbody>
                            </table>';
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
                                    <td>'.$row['EMPR'].'</td>
                                    <td>'.$row['num_rev'].'</td>
                                    <td>'.$row['nome_empresa'].'</td>
                                    <td>'.$row['nome_filial'].'</td>
                                    <td>'.$row['tipo'].'</td>
                                    <td>'.$row['rev'].'</td>
                                    <td>'.$row['dn'].'</td>
                                    <td>'.$row['ATIVO'].'</td>
                                    <td>'.$row['tem_vendas'].'</td>
                                    <td>'.$row['sistema_emp_bd'].'</td>
                                    <td>'.$row['bandeira'].'</td>
                                    <td>'.$row['rev_matriz'].'</td>
                                    <td>'.$row['cnpj'].'</td>
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