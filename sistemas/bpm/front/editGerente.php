<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeSelbetti.php');
require_once('../../../config/config.php');
require_once('../config/query.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITAR GERENTE</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="manutencaoSmart.php?pg=<?= $_GET['pg'] ?>">Manutenção Smartshare</a></li>
        <li class="breadcrumb-item">EDITAR GERENTE</li>
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

            <form class="row g-3" action="http://<?= $_SESSION['servidorOracle'] ?>/<?= $_SESSION['smartshare'] ?>/bd/editGerentes.php?pg=<?= $_GET['pg'] ?>&id_gerente=<?= $_GET['id_gerente'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php
              $gerentesQuery .= " WHERE ID_GERENTE = " . $_GET['id_gerente'] . "";

              $sucesso = $conn->query($gerentesQuery);

              while ($row3 = $sucesso->fetch_assoc()) {

                if ($row3['SITUACAO'] == 'A') {
                  $situacao = 'ATIVO';
                } else {
                  $situacao = 'DESATIVADO';
                }
                $resultado = $conn->query($gerentesQuery);

                while ($row = $resultado->fetch_assoc()) {

                  $queryEmpresa = "SELECT NOME_EMPRESA FROM bpm_empresas WHERE ID_EMPRESA = " . $row['EMPRESA'] . "";

                  $sucesso = $conn->query($queryEmpresa);

                  while ($row1 = $sucesso->fetch_assoc()) {
                    $empresa = $row1['NOME_EMPRESA'];
                  }

                  $queryDep = "SELECT * FROM bpm_departamento_vendas WHERE ID_DEPARTAMENTO = ".$row['DEPARTAMENTO']."";

                  $success = $conn->query($queryDep);

                  while ($row2 = $success->fetch_assoc()) {
                    $departamento = $row2['NOME_DEPARTAMENTO'];
                  }
                  echo '<div class="form-floating mt-4 col-md-6">
                                <select class="form-select" name="empresa" id="empresa" required>
                                <option value="' . $row3['EMPRESA'] . '">' . $empresa . '</option>
                                <option value="">Selecione a empresa</option>';
                  $sucesso = $conn->query($queryTabela);

                  while ($row1 = $sucesso->fetch_assoc()) {
                    echo '<option value="' . $row1['ID_EMPRESA'] . '">' . $row1['NOME_EMPRESA'] . '</option>';
                  }
                  echo '</select>
                        <label for="empresa" class="capitalize">EMPRESA:<code>*</code></label>
                      </div>
        
                      <div class="form-floating mt-4 col-md-6">
                        <select class="form-select" name="departamento" id="departamento" required>
                          <option value="' . $row3['ID_DEPARTAMENTO'] . '">' . $departamento . '</option>
                          <option value="">Selecione o departamento</option>';
                            $sucesso2 = $conn->query($depVendasQuery);

                            while ($row2 = $sucesso2->fetch_assoc()) {
                              echo '<option value="' . $row2['ID_DEPARTAMENTO'] . '">' . $row2['NOME_DEPARTAMENTO'] . '</option>';
                            }
                  echo '</select>
                        <label for="filial" class="capitalize">DEPARTAMENTO:<code>*</code></label>
                      </div>
                    
                    <div class="form-floating mt-4 col-md-6">
                      <select class="form-select" name="nome" id="nome">
                      <option value="' . $row3['NOME'] . '">' . $row3['NOME'] . '</option>
                      <option value="">Selecione o nome</option>';

                  $mostraUsuario = "SELECT DS_USUARIO,id FROM bpm_usuarios_smartshare order by DS_USUARIO ASC";

                  $sucesso4 = $conn->query($mostraUsuario);

                  while ($row4 = $sucesso4->fetch_assoc()) {
                    echo '<option value="' . $row4['DS_USUARIO'] . '">' . $row4['DS_USUARIO'] . '</option>';
                  }
                  echo '</select>
                      <label for="nome" class="capitalize">NOME:<code>*</code></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6">
                      <select class="form-control" id="cpfVet" name="cpfValue">
                        <option value="' . $row3['CPF'] . '">' . $row3['CPF'] . '</option>
                      </select>
                      <label for="cpfVet" class="capitalize">CPF:<code>*</code></label>
                    </div>
                    <div class="form-floating mt-4 col-md-6">
                      <select class="form-control" id="login_smartshare" name="login_smartshare">
                        <option value="' . $row3['LOGIN_SMARTSHARE'] . '' . $row3['CODIGO_LOGIN_SMARTSHARE'] . '">' . $row3['LOGIN_SMARTSHARE'] . '</option>
                      </select>
                      <label for="login_smartshare" class="capitalize">LOGIN SMARTSHARE:<code>*</code></label>
                    </div>
      
                    <div class="form-floating mt-4 col-md-6" id="situacao">
                      <select class="form-select" name="situacao" required>
                        <option value="' . $row3['SITUACAO'] . '">' . $situacao . '</option>
                        <option value="">-----------------</option>
                        <option value="A">ATIVO</option>
                        <option value="D">DESATIVADO</option>
                      </select>
                      <label for="situacao">SITUAÇÃO:<code>*</code></label>
                    </div>';
                }
              }
              ?>
              <div class="text-left py-2">
                <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/unico/sistemas/bpm/front/gerentes.php?pg=<?= $_GET['pg'] ?>"><button type="button" class="btn btn-primary">Voltar</button></a>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Salvar</button>
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
<script>
  $("#nome").on("change", function() {
    var idUsuario = $("#nome").val();

    $.ajax({
      url: '../inc/trazUsuario.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#cpfVet").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#cpfVet").html(data);
      },
      error: function(data) {
        $("#cpfVet").html('<option value="">Erro ao carregar...</option>');
      }

    });

    $.ajax({
      url: '../inc/trazLogin.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#login_smartshare").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#login_smartshare").html(data);
      },
      error: function(data) {
        $("#login_smartshare").html('<option value="">Erro ao carregar...</option>');
      }

    });

  });
</script>