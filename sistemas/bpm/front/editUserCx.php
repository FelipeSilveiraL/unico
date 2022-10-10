<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/config.php');
require_once('../inc/apiRecebeSelbetti.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITANDO USUÁRIO CAIXA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="bpmServopa.php?pg=<?= $_GET['pg'] ?>">BPMSERVOPA</a></li>
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
              $id = $_GET['id'];

              $consulta = "SELECT NOME_EMPRESA, USUARIO_CAIXA, ID_EMPRESA FROM caixa_nf WHERE id = ".$id."";

              $resultado = $conn->query($consulta);

              while($row = $resultado->fetch_assoc()){

                $id_empresa = $row['ID_EMPRESA'];

                echo '
                <form method="POST" action=" http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/editarCxUs.php" >
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nome Empresa</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="user" name="nome_empresa" value ="'.$row['NOME_EMPRESA'].'" disabled>
                      <input type="hidden" value="'.$row['USUARIO_CAIXA'].'" name="usuario_caixa">
                      <input type="hidden" value="'.$row['ID_EMPRESA'].'" name="id_empresa">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="sistema" class="col-sm-2 col-form-label" required>Usuário Caixa:</label>
                    <div class="col-md-6">
                      <select class="form-select" name="userCaixa" required>
                        <option value="'.$row['ID_EMPRESA'].'">'.$row['USUARIO_CAIXA'].'</option>
                          <option value=""> ------------ </option>
                          '.$aprovador.';
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="text-left">
                    <button type="button" class="btn btn-danger"><a href="userCaixa.php?pg='.$_GET['pg'].'" style="color:white;">Voltar</a></button>
                    <button type="submit" class="btn btn-success">Editar</button>
                  </div>
                </form>';


              }

              $conn->close();
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