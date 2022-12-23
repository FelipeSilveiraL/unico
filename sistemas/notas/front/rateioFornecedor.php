<?php
session_start();

require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

//API
require_once('../../bpm/inc/apiRecebeTabela.php'); //Empresas
require_once('../api/centroCusto.php');

//DADOS FORNECEDOR
if (!empty($_GET['idRateioFornecedor'])) {
  require_once('../inc/fornecedor.php');
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Rateio Fornecedor</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="fornecedor.php">Fornecedor</a></li>
        <li class="breadcrumb-item">Rateio Fornecedor</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <!--################# COLE section AQUI #################-->
  <p></p>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3" action="../inc/rateioFornecedor.php?idRateioFornecedor=<?= $idRateio ?>" method="post">

              <!--DADOS PRINCIPAIS -->
              <h5 class="card-title">Dados Principais</h5>

              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control" name="usuarioResponsavel" value="<?= $_SESSION['nome_usuario'] ?>" readonly>
                <label for="floatingSelect" class="capitalize">Usuario responsável </label>
              </div>

              <div id="divFilial" class="form-floating mb-3 col-md-6">
                <select class="form-select" id="selectFilial" name="filial" required>
                  <?php if (!empty($idRateio)) {
                    echo '<option value="' . $filial . '">' . $filial . '</option>';
                  } ?>
                  <option value="">-----------------</option>
                  <?php
                  $resultFilialLista = $conn->query($queryFilial);
                  while ($filialLista = $resultFilialLista->fetch_assoc()) {
                    echo '<option value="' . $filialLista['NOME_EMPRESA'] . '">' . $filialLista['NOME_EMPRESA'] . '</option> ';
                  }
                  ?>
                </select>
                <label for="selectFilial">Filial <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Caso não esteja encontrando a FILIAL, abra um chamado no <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi/front/ticket.form.php" target="_blank">GLPI</a> ao departamento <b>Smartshare</b></span>

              <!--DADOS DO PAGAMENTOL -->
              <h5 class="card-title">Dados Pagamento</h5>

              <div class="form-floating mb-3 col-md-12">
                <select class="form-select" id="tipoPagamento" name="tipoPagamento" onchange="bancos()" required>
                  <?php if (!empty($idRateio)) {
                    switch ($tipopagamento) {
                      case '1':
                        echo '<option value="1">Boleto</option>';
                        break;

                      case '2':
                        echo '<option value="2">Depósito Bancário</option>';
                        break;
                    }
                  } ?>
                  <option>-----------------</option>
                  <option value="1">Boleto</option>
                  <option value="2">Depósito Bancário</option>
                </select>
                <label for="floatingSelect">Tipo pagamento <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="row" id="tipopagamentoBancos" style="display: <?php if (!empty($idRateio)) {
                                                                          if ($tipopagamento == 2) {
                                                                            echo 'contents';
                                                                          } else {
                                                                            echo 'none';
                                                                          }
                                                                        } else {
                                                                          echo 'none';
                                                                        } ?>;">

                <div class="form-floating mb-3 col-md-5">
                  <select class="form-select" id="nomeBanco" name="banco">
                    <?php if (!empty($idRateio)) {
                      if ($tipopagamento == 2) {
                        echo '<option value="' . $nomeBanco . '">' . $nomeBanco . '</option>';
                      }
                    } ?>
                    <option value="">-----------------</option>
                    <?php
                    $queryBancos .= " order by banco ASC";
                    $resultBancos = $conn->query($queryBancos);
                    while ($bancos = $resultBancos->fetch_assoc()) {
                      echo '<option value="' . $bancos['banco'] . '">' . $bancos['banco'] . '</option> ';
                    }
                    ?>
                  </select>
                  <label for="floatingSelect">Banco <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>

                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numAgencia" placeholder="Agência" name="agencia" maxlength="45" <?php if (!empty($idRateio)) {
                                                                                                                                  if ($tipopagamento == 2) {
                                                                                                                                    echo 'value="' . $agencia . '"';
                                                                                                                                  }
                                                                                                                                } ?>>
                    <label for="floatingName">Agência <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numConta" placeholder="Conta" name="conta" maxlength="45" <?php if (!empty($idRateio)) {
                                                                                                                            if ($tipopagamento == 2) {
                                                                                                                              echo 'value="' . $conta . '"';
                                                                                                                            }
                                                                                                                          } ?>>
                    <label for="floatingName">Conta <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="numDigito" placeholder="Dígito" name="digito" maxlength="1" <?php if (!empty($idRateio)) {
                                                                                                                              if ($tipopagamento == 2) {
                                                                                                                                echo 'value="' . $digito . '"';
                                                                                                                              }
                                                                                                                            } ?>>
                    <label for="floatingName">Dígito <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>

              </div>

              <h5 class="card-title">Dados Fornecedor</h5>

              <div id="divFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="cnpjVet" maxlength="15" placeholder="CNPJ / CPF Fornecedor" name="cpfCnpjFor" <?php if (!empty($idRateio)) {
                                                                                                                                              echo 'value="' . $cpfcnpjFornecedor . '"';
                                                                                                                                            } ?> required>
                  <label for="cpfCnpjFor">CNPJ / CPF Fornecedor <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <div id="divNomeFornecedor" class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="NomeFornecedor" placeholder="Fornecedor" name="NomeFornecedor" maxlength="100" <?php if (!empty($idRateio)) {
                                                                                                                                                echo 'value="' . $fornecedorNome . '"';
                                                                                                                                              } ?> readonly>
                  <label for="NomeFornecedor">Nome fornecedor <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Caso não esteja encontrando o FORNECEDOR, abra um chamado no <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi/front/ticket.form.php" target="_blank">GLPI</a> ao departamento <b>Smartshare</b></span>

              <h5 class="card-title">Dados Nota Fiscal</h5>

              <div class="mb-3 col-md-4">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingName" placeholder="Tipo de Serviço" name="tipoServico" maxlength="100" <?php if (!empty($idRateio)) {
                                                                                                                                                echo 'value="' . $tipoServ . '"';
                                                                                                                                              } ?>>
                  <label for="floatingName">Tipo de Serviço</label>
                </div>
              </div>

              <div class="form-floating col-md-4">
                <select class="form-select" id="floatingSelect" name="tipodespesa" required="">
                  <?php if (!empty($idRateio)) {
                    echo '<option value="' . $tipodespesa . '">' . $tipodespesa . '</option>';
                  } ?>
                  <option value="">-----------------</option>
                  <option value="AVULSA">Avulsa</option>
                  <option value="AVULSA FUNILARIA">Avulsa Funilaria</option>
                  <option value="MENSAL">Mensal</option>
                  <option value="TRIAGEM">Triagem</option>
                  <option value="BIMESTRAL">Bimestral</option>
                  <option value="SEMESTRAL">Semestral</option>
                  <option value="ANUAL">Anual</option>
                </select>
                <label for="floatingSelect">Tipo de Despesa <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div id="divNomeFornecedor" class="col-md-4">
                <div class="form-floating">
                  <input type="text" class="form-control" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" title="Caso seja nota de telefonia" name="telefone" <?php if (!empty($idRateio)) {
                                                                                                                                                                              echo 'value="' . $telefone . '"';
                                                                                                                                                                            } ?>>
                  <label for="NomeFornecedor">Telefone</label>
                </div>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="departamentoAuditoria" name="departamentoAuditoria" required="">
                  <?php if (!empty($idRateio)) {
                    echo '<option value="' . $auditoria . '">' . $auditoria . '</option>';
                  } ?>
                  <option value="-1">-----------------</option>
                  <option value="SIM">SIM</option>
                  <option value="NAO" selected>NÃO</option>
                </select>
                <label for="departamentoAuditoria">Nota do Departamento de Auditoria? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="notasGrupo" name="notasGrupo" required="">
                  <?php if (!empty($idRateio)) {
                    echo '<option value="' . $obra . '">' . $obra . '</option>';
                  } ?>
                  <option value="-1">-----------------</option>
                  <option value="SIM">SIM</option>
                  <option value="NAO" selected>NÃO</option>
                </select>
                <label for="notasGrupo">Nota de Obras do Grupo Servopa? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="notasMarketing" name="notasMarketing" required="">
                  <?php if (!empty($idRateio)) {
                    echo '<option value="' . $marketing . '">' . $marketing . '</option>';
                  } ?>
                  <option value="-1">-----------------</option>
                  <option value="SIM">SIM</option>
                  <option value="NAO" selected>NÃO</option>
                </select>
                <label for="notasMarketing">Nota do Depart. de Marketing? <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating col-md-4">
                <select class="form-select" id="vencimento" name="vencimento" onchange="tipoVencimento()" required="">
                  <?php if (!empty($idRateio)) {
                    switch ($vencimentoTipo) {
                      case '1':
                        echo '<option value="1">Nota Fiscal</option>';
                        break;
                      case '2':
                        echo '<option value="2">Somatório</option>';
                        break;
                      case '3':
                        echo '<option value="3">Fixo</option>';
                        break;
                    }
                  } ?>
                  <option value="">-----------------</option>
                  <option value="1">Nota Fiscal</option>
                  <option value="2">Somatório</option>
                  <option value="3">Fixo</option>
                </select>
                <label for="vencimento">Vencimento <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="col-md-4" id="diasCorridos" style="display: <?php if (!empty($idRateio)) {
                                                                          if ($vencimentoTipo == 2) {
                                                                            echo 'block';
                                                                          } else {
                                                                            echo 'none';
                                                                          }
                                                                        } else {
                                                                          echo 'none';
                                                                        } ?>;">
                <div class="form-floating">
                  <input type="text" class="form-control" maxlength="3" name="diasCorridos" id="inputDiascorridos" <?php if (!empty($idRateio)) {
                                                                                                                                                echo 'value="' . $vencimento . '"';
                                                                                                                                              } ?>>
                  <label for="diasCorridos">Dias Corridos <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <div class="col-md-4" id="dias" style="display: <?php if (!empty($idRateio)) {
                                                                          if ($vencimentoTipo == 3) {
                                                                            echo 'block';
                                                                          } else {
                                                                            echo 'none';
                                                                          }
                                                                        } else {
                                                                          echo 'none';
                                                                        } ?>;">
                <div class="form-floating">
                  <input type="text" class="form-control" id="diasInput" maxlength="2" name="dias" onblur="diasMaximos()" <?php if (!empty($idRateio)) {
                                                                                                                                                echo 'value="' . $vencimento . '"';
                                                                                                                                              } ?>>
                  <label for="dias">Dia <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>

              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Duvidas sobre o campo VENCIMENTO <a href="javascript:" data-bs-toggle="modal" data-bs-target="#largeModal"> clique aqui </i></a></span>

              <div class="col-12">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Address" id="observacao" style="height: 100px;" name="observacao" required=""><?php if (!empty($idRateio)) {
                                                                                                                                                echo  $observacao;
                                                                                                                                              } ?></textarea>
                  <label for="observacao">Observação <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>
              </div>
              <?php

              if (!empty($_GET['idRateioFornecedor'])) {
                require_once('rateio.php');
              }
              ?>

              <!-- BOTÃO DO FORMULARIOS -->
              <div class="text-center py-5">
                <hr>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success" id="enviarNota"><?= !empty($_GET['idRateioFornecedor']) ? 'Salvar' : 'Seguir para Rateio' ?> </button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div><!-- FIM col-lg-12 -->
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->


<div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Vencimento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <h5><u>Nota Fiscal:</u></h5>
        <p><code> Lançamento Manual:</code> <span style="font-size: 15px;">Você irá informar o vencimento que esta vindo da nota fiscal</span></p>
        <p><code> Lançamento Robô:</code> <span style="font-size: 15px;">Robo irá pegar o valor de vencimento que esta vindo da nota fiscal </span></p>


        <h5><u>Somatório:</u></h5>
        <p><code> Ambos:</code> <span style="font-size: 15px;">Será coletado a informação que esta no campo "DIAS CORRIDOS" e somar com a data de Emissão da nota fiscal.</span></p>
        <p><span style="font-size: 15px;"><code>Exemplo: </code>você informou 10 dias corridos e hoje é dia 10/12/2022 então o vencimento será dia 20/12/2022</span></p>

        <h5><u>Fixo:</u></h5>
        <p><code> Ambos:</code> <span style="font-size: 15px;">Será coletado a informação que esta no campo "DIA" e esse será o dia do vencimento da nota fiscal, agora o mes e o ano é de acordo com o mes e o ano que esta sendo lançado.</span></p>
        <p><span style="font-size: 15px;"><code>Exemplo:</code> se vc informou dia fixo 10 e estamos em dezembro de 2022 então a data de vencimento será 10/12/2022</span></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->


<?php
require_once('footer.php'); //Javascript e configurações afins
?>


<script>
  function tipoVencimento() {
    var tipoVencimento = document.getElementById("vencimento").value;

    if (tipoVencimento == 2) { //somatorio

      document.getElementById("dias").style.display = 'none';
      document.getElementById("diasCorridos").style.display = 'block';
      document.getElementById("inputDiascorridos").required = true;
      document.getElementById("diasInput").required = false;

    } else if (tipoVencimento == 3) { //fixo

      document.getElementById("dias").style.display = 'block';
      document.getElementById("diasInput").required = true;
      document.getElementById("diasCorridos").style.display = 'none';
      document.getElementById("inputDiascorridos").required = false;

    } else { //nota fiscal

      document.getElementById("dias").style.display = 'none';
      document.getElementById("diasCorridos").style.display = 'none';
    }

  }


  function diasMaximos() {
    var dias = document.getElementById("diasInput").value;

    if (dias > 31) {
      const date = new Date();
      const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      const lastDayDate = lastDay.toLocaleDateString()
      document.getElementById("diasInput").value = lastDayDate.substr(0, 2);
    }

  }

  function bancos() {
    var tipoPagamento = document.getElementById("tipoPagamento").value;

    if (tipoPagamento == 2) {
      document.getElementById("tipopagamentoBancos").style.display = 'contents';
      document.getElementById("nomeBanco").required = true;
      document.getElementById("numAgencia").required = true;
      document.getElementById("numConta").required = true;
      document.getElementById("numDigito").required = true;
    } else {
      document.getElementById("tipopagamentoBancos").style.display = 'none';
      document.getElementById("nomeBanco").required = false;
      document.getElementById("numAgencia").required = false;
      document.getElementById("numConta").required = false;
      document.getElementById("numDigito").required = false;
    }
  }
</script>

<script>
  $("#cnpjVet").on("blur", function() {
    var cpfCNPJ = $("#cnpjVet").val();

    $.ajax({

      url: '../inc/buscaFornecedor.php',
      type: 'POST',
      data: {
        id: cpfCNPJ
      },

      beforeSend: function(data) {
        $("#NomeFornecedor").val('Aguarde...');
      },

      success: function(data) {

        if (!data) {
          $("#NomeFornecedor").val('Não Localizado...');
          $("#enviarNota").attr("disabled", true);
        } else {
          $("#NomeFornecedor").val(data);
          $("#enviarNota").attr("disabled", false);
        }
      },

      error: function(data) {
        $("#NomeFornecedor").val('Erro ao carregar...');
      }

    });
  });
</script>