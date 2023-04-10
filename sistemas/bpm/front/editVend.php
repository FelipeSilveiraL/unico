<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>EDITAR VENDEDORES</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="vendedores.php?pg=<?= $_GET['pg'] ?>">Vendedores</a></li>
        <li class="breadcrumb-item">EDITAR VENDEDORES</li>
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
            <h5 class="card-title">Editar vendedores </h5>
            <form class="row g-3" action="../inc/editVendedores.php?pg=<?= $_GET['pg'] ?>&id_vendedor=<?= $_GET['id_vendedor'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->

              <?php
              $vendedoresQuery .= " WHERE ID_VENDEDOR = " . $_GET['id_vendedor'];

              $sucesso = oci_parse($connBpmgp, $vendedoresQuery);
              oci_execute($sucesso);

              while ($row3 = oci_fetch_array($sucesso, OCI_ASSOC)) {

                if ($row3['SITUACAO'] == 'A') {
                  $situacao = 'ATIVO';
                } else {
                  $situacao = 'DESATIVADO';
                }

                $empresa = $row3['NOME_EMPRESA'];
                $departamento = $row3['NOME_DEPARTAMENTO'];


                echo '<div class="form-floating mt-4 col-md-6">
                                <select class="form-select" name="empresa" id="empresa" required>
                                <option value="' . $row3['EMPRESA'] . '">' . $empresa . '</option>
                                <option value="">-----------------</option>';

                $queryTabela .= ' ORDER BY NOME_EMPRESA ASC';

                $sucesso = oci_parse($connBpmgp, $queryTabela);
                oci_execute($sucesso);

                while ($row1 = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $row1['ID_EMPRESA'] . '">' . $row1['NOME_EMPRESA'] . '</option>';
                }
                echo '</select>
                        <label for="empresa" class="capitalize">EMPRESA:<code>*</code></label>
                      </div>
        
                      <div class="form-floating mt-4 col-md-6">
                        <select class="form-select" name="departamento" id="departamento" required>
                        <option value="' . $row3['DEPARTAMENTO'] . '">' . $departamento . '</option>
                          <option value="">-----------------</option>';

                $depVendasQuery .= ' ORDER BY NOME_DEPARTAMENTO ASC';
                $sucesso = oci_parse($connBpmgp, $depVendasQuery);
                oci_execute($sucesso);

                while ($row2 = oci_fetch_array($sucesso, OCI_ASSOC)) {
                  echo '<option value="' . $row2['ID'] . '">' . $row2['NOME_DEPARTAMENTO'] . '</option>';
                }
                echo '</select>
                        <label for="filial" class="capitalize">DEPARTAMENTO:<code>*</code></label>
                    </div>
                    
                    <div class="form-floating mt-4 col-md-6">
                      <select class="form-select" name="nome" id="nome">
                      <option value="' . $row3['NOME'] . '">' . $row3['NOME'] . '</option>
                      <option value="">-----------------</option>';

                $queryUserApi .= " ORDER BY DS_USUARIO ASC";

                $sucesso = oci_parse($connSelbetti, $queryUserApi);
                oci_execute($sucesso);

                while ($row4 = oci_fetch_array($sucesso, OCI_ASSOC)) {
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
              ?>



              <div class="text-left py-2">
                <a href="vendedores.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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
        id: idUsuario, edit: true
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
        id: idUsuario, edit: true
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