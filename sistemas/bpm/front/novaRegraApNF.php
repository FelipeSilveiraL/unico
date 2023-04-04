<?php
session_start();
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../../../config/sqlSmart.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>NOVA REGRA APROVADORES NF</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="aprovadoresNF.php?pg=<?= $_GET['pg'] ?>">APROVADORES NF</a></li>
        <li class="breadcrumb-item">NOVA REGRA APROVADORES</li>
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
            <h5 class="card-title">Nova regra aprovadores nf </h5>
            <form id="novaRegraEmpresa" name="novaRegraEmpresa" class="row g-3" action="../inc/novaRegraApNF.php?pg=<?= $_GET['pg'] ?>" method="POST">
              <!--DADOS PARA O LANÇAMENTO -->
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" name="empresa" id="empresa" required>
                  <?php

                  $queryEmpresa .= ' WHERE ID_EMPRESA NOT IN(208,382) ORDER BY ID_EMPRESA ASC ';

                  echo '<option value="">-----------------</option>';

                  $sucesso = oci_parse($connBpmgp, $queryEmpresa);
                  oci_execute($sucesso);

                  while ($row2 = oci_fetch_array($sucesso)) {
                    echo '<option value="' . $row2['ID_EMPRESA'] . '">' . $row2['NOME_EMPRESA'] . '</option>';
                  }
                  oci_free_statement($sucesso);
                  ?>
                </select>
                <label for="empresa">EMPRESA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="depto">
                <select class="form-select" name="depto" id="departamento" required>
                  <option value="">-----------------</option>
                  <!--Será preenchido automaticamente após selecionar uma filial-->
                </select>
                <label for="depto">DEPARTAMENTO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="filial">
                <select class="form-select" name="filial" required>
                  <option value="">-----------------</option>
                  <?php

                  $usuarioOriginal = $queryUserApi;

                  $query = $usuarioOriginal;

                  $query .= "WHERE U.cd_usuario not in (1) ORDER BY U.ds_usuario ASC  ";

                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);
                  ?>
                </select>
                <label for="filial">CIÊNCIA FILIAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select" name="situacao" required>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="area">
                <select class="form-select" name="area" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="area">CIÊNCIA AREA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-5">
                <input type="text" class="form-control col-md-2" id="limitA" name="limitA" onkeyup="formatarMoeda4()">
                <label for="filial">LIMITE APROVAÇÃO:<span style="color: red;">*</span></label>
              </div>
              <div class="col-md-1" style="font-size:25px;" title="Ilimitado!">
                <a href="javascript:" onclick="SemLimitA()" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Ilimitado!" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Ilimitado!">
                  <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                </a>
                <script>
                  function SemLimitA() {
                    var check = document.getElementById("limitA").disabled
                    if (check == true) {
                      document.getElementById("limitA").disabled = false;
                    } else {
                      document.getElementById("limitA").disabled = true;
                      document.getElementById("limitA").value = 0;
                    }
                  }

                  function formatarMoeda4() {
                    var elemento = document.getElementById('limitA');
                    var valor = elemento.value;


                    valor = valor + '';
                    valor = parseInt(valor.replace(/[\D]+/g, ''));
                    valor = valor + '';
                    valor = valor.replace(/([0-9]{2})$/g, ",$1");

                    if (valor.length > 6) {
                      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                    }

                    elemento.value = valor;
                    if (valor == 'NaN') elemento.value = '';

                  }
                </script>
              </div>

              <div class="form-floating mt-4 col-md-6" id="marca">
                <select class="form-select" name="marca" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="marca">CIÊNCIA MARCA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-5">
                <input type="text" class="form-control col-md-2" id="limitM" name="limitM" onkeyup="formatarMoeda3()">
                <label for="filial">LIMITE APROVAÇÃO:<span style="color: red;">*</span></label>
              </div>
              <div class="col-md-1" style="font-size:25px;" title="Ilimitado!">
                <a href="javascript:" title="Ilimitado!" onclick="SemLimitM()" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Ilimitado!">
                  <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                </a>
                <script>
                  function SemLimitM() {
                    var check = document.getElementById("limitM").disabled
                    if (check == true) {
                      document.getElementById("limitM").disabled = false;
                    } else {
                      document.getElementById("limitM").disabled = true;
                      document.getElementById("limitM").value = 0;
                    }
                  }

                  function formatarMoeda3() {
                    var elemento = document.getElementById('limitM');
                    var valor = elemento.value;


                    valor = valor + '';
                    valor = parseInt(valor.replace(/[\D]+/g, ''));
                    valor = valor + '';
                    valor = valor.replace(/([0-9]{2})$/g, ",$1");

                    if (valor.length > 6) {
                      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                    }

                    elemento.value = valor;
                    if (valor == 'NaN') elemento.value = '';

                  }
                </script>
              </div>


              <div class="form-floating mt-4 col-md-6" id="gerente">
                <select class="form-select" name="gerente" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  ?>
                </select>
                <label for="gerente">GERENTE GERAL:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-5">
                <input type="text" class="form-control col-md-2" id="limitG" name="limitG" onkeyup="formatarMoeda2()">
                <label for="filial">LIMITE APROVAÇÃO:<span style="color: red;">*</span></label>
              </div>
              <div class="col-md-1" style="font-size:25px;" title="Ilimitado!">
                <a href="javascript:" title="Ilimitado!" onclick="SemLimitG()" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Ilimitado!">
                  <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                </a>
                <script>
                  function SemLimitG() {
                    var check = document.getElementById("limitG").disabled
                    if (check == true) {
                      document.getElementById("limitG").disabled = false;
                    } else {
                      document.getElementById("limitG").disabled = true;
                      document.getElementById("limitG").value = 0;
                    }
                  }

                  function formatarMoeda2() {
                    var elemento = document.getElementById('limitG');
                    var valor = elemento.value;


                    valor = valor + '';
                    valor = parseInt(valor.replace(/[\D]+/g, ''));
                    valor = valor + '';
                    valor = valor.replace(/([0-9]{2})$/g, ",$1");

                    if (valor.length > 6) {
                      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                    }

                    elemento.value = valor;
                    if (valor == 'NaN') elemento.value = '';

                  }
                </script>
              </div>


              <div class="form-floating mt-4 col-md-6" id="super">
                <select class="form-select" name="super" required>
                  <option value="">-----------------</option>
                  <?php
                  $sucesso = oci_parse($connSelbetti, $query);
                  oci_execute($sucesso);

                  while ($rowUser = oci_fetch_array($sucesso, OCI_ASSOC)) {
                    echo '<option value="' . $rowUser['DS_LOGIN'] . '">' . $rowUser['DS_USUARIO'] . ' / ' . $rowUser['DS_LOGIN'] . '</option>';
                  };

                  oci_free_statement($sucesso);

                  oci_close($connBpmgp);
                  oci_close($connSelbetti);

                  ?>
                </select>
                <label for="super">SUPERINTENDENTE:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-5">
                <input type="text" class="form-control col-md-2" id="limiteSuper" name="limitS" onkeyup="formatarMoeda()">
                <label for="filial">LIMITE APROVAÇÃO:<span style="color: red;">*</span></label>
              </div>
              <div class="col-md-1" style="font-size:25px;" title="Ilimitado!">
                <a href="javascript:" title="Ilimitado!" onclick="SemLimitSuper()" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Ilimitado!">
                  <i class="bx bx-dollar" style="margin-left: 23px;margin-top: 24px;"></i>
                </a>
                <script>
                  function SemLimitSuper() {
                    var check = document.getElementById("limiteSuper").disabled
                    if (check == true) {
                      document.getElementById("limiteSuper").disabled = false;
                    } else {
                      document.getElementById("limiteSuper").disabled = true;
                      document.getElementById("limiteSuper").value = 0;
                    }
                  }

                  function formatarMoeda() {
                    var elemento = document.getElementById('limiteSuper');
                    var valor = elemento.value;


                    valor = valor + '';
                    valor = parseInt(valor.replace(/[\D]+/g, ''));
                    valor = valor + '';
                    valor = valor.replace(/([0-9]{2})$/g, ",$1");

                    if (valor.length > 6) {
                      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                    }

                    elemento.value = valor;
                    if (valor == 'NaN') elemento.value = '';

                  }
                </script>
              </div>

              <div class="text-left py-2">
                <a href="aprovadoresNF.php?pg=<?= $_GET['pg'] ?>" class="btn btn-primary">Voltar</a>
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
  $("#empresa").on("change", function() {

    var idUsuario = $("#empresa").val();

    $.ajax({

      url: '../inc/trazDepNF.php',
      type: 'POST',
      data: {
        id: idUsuario
      },
      beforeSend: function(data) {
        $("#departamento").html('<option value="">Carregando...</option>');
      },
      success: function(data) {
        $("#departamento").html(data);
      },
      error: function(data) {
        $("#departamento").html('<option value="">Erro ao carregar...</option>');
      }

    });
  });
</script>