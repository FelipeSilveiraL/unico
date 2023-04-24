<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../funcoes/function.php');

if (!empty($_GET['idHorario'])) {

  $queryHorarioTrabalho .= " WHERE HT.id_horario = " . $_GET['idHorario'];

  $result = oci_parse($connBpmgp, $queryHorarioTrabalho);
  oci_execute($result);

  while ($horario = oci_fetch_array($result, OCI_ASSOC)) {

    $nomeEmpresa = $horario['NOME_EMPRESA'];
    $idEmpresa = $horario['ID_EMPRESA'];
    $nomeDepartamento = $horario['NOME_DEPARTAMENTO'];
    $idDepartamento = $horario['ID_DEPARTAMENTO'];

    //semanal
    $horaInicialS = horaInicial($horario['SEGUNDA_SEXTA']);
    $minutInicialS = minutoInicial($horario['SEGUNDA_SEXTA']);
    $horaFinalS = horaFinal($horario['SEGUNDA_SEXTA']);
    $minutoFinalS = minutoFinal($horario['SEGUNDA_SEXTA']);

    //semanal almoço
    $horaInicialSA = horaInicial($horario['SEGUNDA_SEXTA_ALMOCO']);
    $minutInicialSA = minutoInicial($horario['SEGUNDA_SEXTA_ALMOCO']);
    $horaFinalSA = horaFinal($horario['SEGUNDA_SEXTA_ALMOCO']);
    $minutoFinalSA = minutoFinal($horario['SEGUNDA_SEXTA_ALMOCO']);


    //Sabado
    $horaInicialSAB = horaInicial($horario['SABADO']);
    $minutInicialSAB = minutoInicial($horario['SABADO']);
    $horaFinalSAB = horaFinal($horario['SABADO']);
    $minutoFinalSAB = minutoFinal($horario['SABADO']);

    //Sabado almoço
    $horaInicialSABA = horaInicial($horario['SABADO_ALMOCO']);
    $minutInicialSABA = minutoInicial($horario['SABADO_ALMOCO']);
    $horaFinalSABA = horaFinal($horario['SABADO_ALMOCO']);
    $minutoFinalSABA = minutoFinal($horario['SABADO_ALMOCO']);
  }
}





?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Horário Trabalho</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item"><a href="horario.php?pg=<?= $_GET['pg'] ?>">horário de trabalho</a></li>
        <li class="breadcrumb-item">Horário</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Horário</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="../inc/novoHorario.php?pg=<?= $_GET['pg'] ?>&idHorario=<?= $_GET['idHorario'] ?>" method="POST" onsubmit="return validarForm()">

              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <select class="form-select" name="empresa" id="id_empresa" aria-label="State" required>
                    <?php

                    echo !empty($nomeEmpresa) ?   '<option value="' . $idEmpresa . '" >' . $nomeEmpresa . '</option><option value="" >------------------</option>' : '<option value="" >------------------</option>';

                    $queryEmpresaRh .= "ORDER BY nome_empresa ASC";

                    $result = oci_parse($connBpmgp, $queryEmpresaRh);
                    oci_execute($result);

                    while ($empresa = oci_fetch_array($result, OCI_ASSOC)) {
                      echo '<option value="' . $empresa['ID_EMPRESA'] . '">' . $empresa['NOME_EMPRESA'] . '</option>';
                    }
                    oci_free_statement($result);
                    ?>
                  </select>
                  <label for="floatingSelect">Empresa</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <select class="form-select" id="id_departamento" name="departamento" aria-label="State" required>
                  </select>
                  <label for="floatingSelect">Departamento</label>
                </div>
              </div>

              <h5 class="card-title">Segunda á Sexta</h5>
              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" class="form-control" value="<?= $horaInicialS . ':' . $minutInicialS ?>" name="HoraInicioSemanal" id="HoraInicioSemanal" placeholder="xx:xx" required>
                  <label for="floatingSelect">Entrada</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" class="form-control" value="<?= $horaFinalS . ':' . $minutoFinalS ?>" name="HoraFinalSemanal" id="HoraFinalSemanal" aria-label="State" required>
                  <label for="floatingSelect">Saída</label>
                </div>
              </div>

              <div class="col-md-3" style="margin-top: -29px;">
                <h5 class="card-title" style="margin-bottom: 20px;">Almoço</h5>
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaInicialSA . ':' . $minutInicialSA ?>" class="form-control" name="HoraInicioAlmocoSemanal" onblur="almocoSemanal()" id="almocoInicialSemanal" placeholder="xx:xx">
                  <label for="floatingSelect">Entrada</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaFinalSA . ':' . $minutoFinalSA ?>" class="form-control" name="HoraFinalAlmocoSemanal" id="almocoFinalSemanal" onblur="almocoSemanal()">
                  <label for="floatingSelect">Saída</label>
                </div>
              </div>
              <h5 class="card-title">Sábado</h5>
              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaInicialSAB . ':' . $minutInicialSAB ?>" class="form-control" name="HoraInicioSabado" id="sabadoHorarioInicial" onblur="sabadoHorario()" placeholder="xx:xx">
                  <label for="floatingSelect">Entrada</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaFinalSAB . ':' . $minutoFinalSAB ?>" class="form-control" name="HoraFinalSabado" id="sabadoHorarioFinal" onblur="sabadoHorario()" placeholder="xx:xx">
                  <label for="floatingSelect">Saída</label>
                </div>
              </div>
              <div class="col-md-3" style="margin-top: -29px;">
                <h5 class="card-title" style="margin-bottom: 20px;">Almoço</h5>
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaInicialSABA . ':' . $minutInicialSABA ?>" class="form-control" name="HoraInicioAlmocoSabado" id="sabadoAlmocoInicial" onblur="sabadoHorario()" placeholder="xx:xx">
                  <label for="floatingSelect">Entrada</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating mb-3">
                  <input type="time" value="<?= $horaFinalSABA . ':' . $minutoFinalSABA ?>" class="form-control" name="HoraFinalAlmocoSabado" id="sabadoAlmocoFinal" onblur="sabadoAlmoco()" placeholder="xx:xx">
                  <label for="floatingSelect">Saída</label>
                </div>
              </div>

              <div class="text-center">
                <button type="reset" class="btn btn-secondary">Limpar</button>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
            </form><!-- End floating Labels Form -->

          </div>
        </div>

      </div>
    </div>
  </section>



</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>

<script>
  $('#id_empresa').on("change", function() {

    var idEmpresa = $('#id_empresa').val();

    $.ajax({
      url: '../inc/buscarDepartamento.php',
      type: 'POST',
      data: {
        id: idEmpresa
      },

      beforeSend: function(data) {
        $('#id_departamento').html('<option value="">Carregando....</option>');
      },

      success: function(data) {
        $('#id_departamento').html(data);
      },

      error: function(data) {
        $('#id_departamento').html('<option value="">Erro....</option>');
      }

    });

  })
</script>