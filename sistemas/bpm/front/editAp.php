<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../config/query.php');
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
            <form method="POST"  class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/editAp.php?pg=<?=$_GET['pg']?>">
            <?php

            $aprovadoresQuery .= " AND a.id_aprovador = " . $_GET['id_aprovador'] . "";
            $id = $_GET['id_aprovador'];
            $result = $conn->query($aprovadoresQuery);

            while ($row = $result->fetch_assoc()) {

              echo '
                  <div class="form-floating mt-4 col-md-6" id="empresa">
                    <input type="hidden" value="'.$id.'" name = "id_aprovador">
                    <input type="text" class="form-select" value="' . $row['NOME_EMPRESA'] . '" id="user" disabled>
                    <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
                  </div>
                <div class="form-floating mt-4 col-md-6" id="depto">
                  <input type="text" class="form-select" value="' . $row['NOME_DEPARTAMENTO'] . '" id="user" name="dep" disabled>
                  <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
                </div>';

              $query_users .= " WHERE ds_login='" . $row['APROVADOR_FILIAL'] . "' ";

              $conexao = $conn->query($query_users);

          echo '<div class="form-floating mt-4 col-md-6" id="filial" id="sistema">
                  <select class="form-select" name="filial" required>';
                    while($rowCifU = $conexao->fetch_assoc()){
                      echo '<option value="' . $row['APROVADOR_FILIAL'] . '">' . $rowCifU['DS_USUARIO'] . ' / ' . $rowCifU['DS_LOGIN'] . '</option>';
                    };
                    
                    echo '    
                    <option value="">-----------</option>';

                    $query = "SELECT * FROM bpm_usuarios_smartshare";

                    $sucesso = $conn->query($query);

                    while($rowUser = $sucesso->fetch_assoc()){
                      echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                    };
            echo '
                  </select> 
                  <label for="sistema">CIÊNCIA FILIAL:<span style="color: red;">*</span></label>
                </div>
                <div class="form-floating mt-4 col-md-6" id="area">
                  <select class="form-select" id="sistema" name="area" required>';

                  $query_users2 = "SELECT * FROM bpm_usuarios_smartshare WHERE ds_login='" . $row['APROVADOR_AREA'] . "' ";

                  $oxi = $conn->query($query_users2);

                  while($seila = $oxi->fetch_assoc()){

                    echo'
                    <option value="' . $row['APROVADOR_AREA'] . '">' . $seila['DS_USUARIO'] . ' / ' . $seila['DS_LOGIN'] . '</option>';
                  }
                  echo '    
                    <option value="">-----------</option>';

                    $query2 = "SELECT * FROM bpm_usuarios_smartshare";

                    $sucesso2 = $conn->query($query2);

                    while($rowUser2 = $sucesso2->fetch_assoc()){
                      echo '<option value="' . $rowUser2['DS_LOGIN'] . '">' . $rowUser2['DS_USUARIO'] . ' / ' . $rowUser2['DS_LOGIN'] . '</option>';
                    };

            echo '</select>
                  <label for="sistema">CIÊNCIA AREA:<span style="color: red;">*</span></label>
                  </div>
                  <div class="form-floating mt-4 col-md-6" id="marca">
                    <select class="form-select" name="marca" required>';
                    $query_users3 = "SELECT * FROM bpm_usuarios_smartshare WHERE ds_login='" . $row['APROVADOR_MARCA'] . "' ";

                    $conecção = $conn->query($query_users3);
                    while($fila = $conecção->fetch_assoc()){
                      echo'
                      <option value="' . $row['APROVADOR_MARCA'] . '">' . $fila['DS_USUARIO'] . ' / ' . $fila['DS_LOGIN'] . '</option>';
                    }
                    echo '    
                    <option value="">-----------</option>';

                    $query3 = "SELECT * FROM bpm_usuarios_smartshare";

                    $sucesso3 = $conn->query($query3);

                    while($rowUser3 = $sucesso3->fetch_assoc()){
                      echo '<option value="' . $rowUser3['DS_LOGIN'] . '">' . $rowUser3['DS_USUARIO'] . ' / ' . $rowUser3['DS_LOGIN'] . '</option>';
                    };
                    echo'
                    </select>
                    <label for="sistema">CIÊNCIA MARCA:<span style="color: red;">*</span></label>
                  </div>
                  <div class="form-floating mt-4 col-md-6" id="gerente">
                    <select class="form-select" id="sistema" name="gerente" required>';
                    $query_users4 = "SELECT * FROM bpm_usuarios_smartshare WHERE ds_login='" . $row['APROVADOR_GERENTE'] . "' ";

                    $conecção4 = $conn->query($query_users4);
                    while($fila4 = $conecção4->fetch_assoc()){
                      echo'
                      <option value="' . $row['APROVADOR_GERENTE'] . '">' . $fila4['DS_USUARIO'] . ' / ' . $fila4['DS_LOGIN'] . '</option>';
                    }
                    echo '    
                    <option value="">-----------</option>';

                    $query4 = "SELECT * FROM bpm_usuarios_smartshare";

                    $sucesso4 = $conn->query($query4);

                    while($rowUser4 = $sucesso4->fetch_assoc()){
                      echo '<option value="' . $rowUser4['DS_LOGIN'] . '">' . $rowUser4['DS_USUARIO'] . ' / ' . $rowUser4['DS_LOGIN'] . '</option>';
                    };
              echo' </select>
                  <label for="sistema" >GERENTE GERAL:<span style="color: red;">*</span></label>
                  </div>
                <div  class="form-floating mt-4 col-md-6" id="super">
                    <select class="form-select" id="super" name="super" required>';
                    $query_users5 = "SELECT * FROM bpm_usuarios_smartshare WHERE ds_login='" . $row['APROVADOR_SUPERINTENDENTE'] . "' ";

                    $conecção5 = $conn->query($query_users5);
                    while($fila = $conecção5->fetch_assoc()){
                      echo'
                      <option value="' . $row['APROVADOR_SUPERINTENDENTE'] . '">' . $fila['DS_USUARIO'] . ' / ' . $fila['DS_LOGIN'] . '</option>';
                    }
                    echo '    
                    <option value="">-----------</option>';

                    $query5 = "SELECT * FROM bpm_usuarios_smartshare";

                    $sucesso5 = $conn->query($query5);

                    while($rowUser5 = $sucesso5->fetch_assoc()){
                      echo '<option value="' . $rowUser5['DS_LOGIN'] . '">' . $rowUser5['DS_USUARIO'] . ' / ' . $rowUser5['DS_LOGIN'] . '</option>';
                    };
              echo' </select>
              <label for="sistema">SUPERINTENDENTE:<span style="color: red;">*</span></label>
              </div>
                <div class="form-floating mt-4 col-md-6" id="situacao">
                    <select class="form-select" id="situacao" name="situacao" required>';
                      if($row['SITUACAO'] == 'A'){
                        $situacao = 'ATIVO';
                      }else{
                        $situacao = "DESATIVADO";
                      }

                      echo'
                      <option value="' . $row['SITUACAO'] . '">' . $situacao . '</option>';
                      echo '    
                      <option value="">-----------</option>
                      <option value="A">ATIVO</option>
                      <option value="D">DESATIVADO</option>';
                    

              echo' </select>
                <label for="sistema">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

                <div class="text-left">
                  <button type="button" class="btn btn-primary"><a href="aprovadoresRH.php?pg= ' . $_GET['pg'] . ' " style="color:white;">Voltar</a></button>
                  <button type="submit" class="btn btn-success">Editar</button>
                </div>
              ';
            }
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