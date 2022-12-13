<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../config/query.php');
require_once('../inc/apiRecebeAprovNF.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
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
              <br>
              <?php
                 
                  echo '
                  <form class="row g-3" action="../inc/localizaGestorNF.php?pg='.$_GET['pg'].'" method="POST" style="display:'; echo  empty($_GET['dado'])? 'block;' : 'none;'; echo' ">
                      <div class="mt-4 col-md-6" style="margin-left: 25%;" id="depto">
                      <label for="depto">Localizar gestor:</label>
                        <input type="text" class="form-control" name="nomeGestor" style="text-transform: uppercase;" placeholder="LOGIN/CPF" required>  
                      </div>
                      '; 
                      $alert = $_GET['erro'];
                      if($alert == 1){
                        echo '<p style="color: red;text-align:center;">Usuário não localizado!</p>';
                      }
                      echo '
                    <div class="text-left">
                      <a href="http://'.$_SERVER['SERVER_ADDR'].'/unico/sistemas/bpm/front/departamentos.php?pg='.$_GET['pg'].'"> <button type="button" class="btn btn-primary">Voltar</button></a>
                      <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                  </form>';

                 $_SESSION['usuario'] = $_GET['usuario'];
                 $_SESSION['login'] = $_GET['login'];
                 
                  echo ' 
                    <form class="row g-3" action="atualizandoGestorNF.php?pg='.$_GET['pg'].'" method="POST" style="display:'; echo  empty($_GET['dado'])? 'none;' : 'block;'; echo' ">
                        <div class="form-floating mt-4 col-md-6" style="margin-left: 25%;" id="depto">
                          <input type="text" class="form-control" value="  '.$_GET['login'].' / '.$_GET['usuario'].' " name="gestorVelho" disabled>  
                          <label for="depto">Gestor atual localizado::</label>
                        </div>
                        <div class="form-floating mt-4 col-md-6" style="margin-left: 25%;" >
                          <select class="form-select" name="gestorNovo" required >
                            <option value=""> ------------ </option>';

                            $query_users .= ' WHERE id NOT IN (1)';
                            $exec = $conn->query($query_users);

                            while($row = $exec->fetch_assoc()){
                              echo '<option value="'.$row['DS_LOGIN'].' / '.$row['DS_USUARIO'].'">'.$row['DS_USUARIO'].' / '.$row['DS_LOGIN'].'</option>
                               ';
                            }

                            echo'
                          </select>
                          <label for="aproCaixa">Alterar para novo gestor:<span style="color: red;">*</span></label>
                        </div>
                      <div class="text-center">
                        <a href="http://'.$_SERVER['SERVER_ADDR'].'/unico/sistemas/bpm/front/departamentos.php?pg='.$_GET['pg'].'"> <button type="button" class="btn btn-danger">Voltar</button></a>
                        <button type="submit" class="btn btn-primary">Alterar</button>
                      </div>
                    </form><br>';

                    
              ?>
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