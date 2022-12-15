<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Rateio Fornecedor</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
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
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">

              <!--DADOS PRINCIPAIS -->
              <h5 class="card-title">Dados principais</h5>

              <div class="form-floating mb-3 col-md-6">
                <input type="text" class="form-control" name="usuarioResponsavel" value="<?= $_SESSION['nome_usuario'] ?>" readonly>
                <label for="floatingSelect" class="capitalize">Usuario responsável </label>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingName" placeholder="Tipo de Serviço" name="tipoServico" maxlength="100">
                  <label for="floatingName">Tipo de Serviço</label>
                </div>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <select class="form-select" id="floatingSelect" name="filial" required>
                  <option value="">-----------------</option>
                  <?php
                  $resultFilial = $conn->query($queryFilial);
                  while ($filial = $resultFilial->fetch_assoc()) {
                    echo '<option value="' . $filial['ID_EMPRESA'] . '">' . $filial['NOME_EMPRESA'] . '</option> ';
                  }
                  ?>
                </select>
                <label for="floatingSelect">Filial <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <select class="form-select" id="floatingSelect" name="fornecedor" required>
                  <option value="">-----------------</option>
                </select>
                <label for="floatingSelect">Fornecedor <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>
              <span class="text-danger small pt-1 fw-bold" style="font-size: 12px;"><i class="bi bi-pin-fill"></i>Caso não esteja encontrando a FILIAL ou FORNECEDOR que deseja, então abra um chamado no <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/glpi" target="_blank">GLPI</a></span>

              <!--DADOS DO PAGAMENTOL -->
              <h5 class="card-title">Dados do pagamento</h5>

              <div class="form-floating mb-3 col-md-12">
                <select class="form-select" id="tipoPagamento" name="tipoPagamento" onchange="bancos()" required>
                  <option>-----------------</option>
                  <option value="1">Boleto</option>
                  <option value="2">Depósito</option>
                </select>
                <label for="floatingSelect">Tipo pagamento <span class="text-danger small pt-1 fw-bold">*</span></label>
              </div>

              <div class="row" id="tipopagamentoBancos" style="display: none;">

                <div class="form-floating mb-3 col-md-5">
                  <select class="form-select" id="floatingSelect" name="banco">
                    <option value="">-----------------</option>
                    <?php
                    $queryBancos .= " order by banco ASC";
                    $resultBancos = $conn->query($queryBancos);
                    while ($bancos = $resultBancos->fetch_assoc()) {
                      echo '<option value="' . $bancos['id_banco'] . '">' . $bancos['banco'] . '</option> ';
                    }
                    ?>
                  </select>
                  <label for="floatingSelect">Banco <span class="text-danger small pt-1 fw-bold">*</span></label>
                </div>

                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Agência" name="agencia" maxlength="45">
                    <label for="floatingName">Agência <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Conta" name="conta"  maxlength="45">
                    <label for="floatingName">Conta <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Dígito" name="digito"  maxlength="1">
                    <label for="floatingName">Dígito <span class="text-danger small pt-1 fw-bold">*</span></label>
                  </div>
                </div>

              </div>


              <!--DADOS DA DESPESA -->
              <h5 class="card-title">Dados da Despesa</h5>

              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Nota fiscal</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="filenota">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Boleto</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="fileboleto">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Outros anexos</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="fileoutros">
                </div>
              </div>

              <h5 class="card-title">Dados do fornecedor</h5>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="floatingSelect" name="tipodespesa" required="">
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Tipo de Despesa</label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="floatingSelect" name="fornecedor" required="">
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Periodicidade</label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="floatingSelect" name="periodicidade" required="">
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Tipo do Pagamento</label>
              </div>

              <div class="col-md-6 mb-3">
                <input type="text" class="form-control" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" placeholder="Telefone" title="Caso seja nota de telefonia" name="telefone">
              </div>

              <div class="col-6">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" name="observacao" required=""></textarea>
                  <label for="floatingTextarea">Observação</label>
                </div>
              </div>

              <div class="col-md-6 mb-3">Notas Fiscais Do Departamento De Auditoria?
                <div class="col-sm-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="departamentoAuditoria" id="griAuditoria" value="1">
                    <label class="form-check-label" for="griAuditoria">
                      SIM
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="departamentoAuditoria" id="griAuditoria1" value="2" checked="">
                    <label class="form-check-label" for="griAuditoria1">
                      NÃO
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">Notas Fiscais De Obras do Grupo Servopa?
                <div class="col-sm-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="obrasGS" id="gridObrasGS" value="option1">
                    <label class="form-check-label" for="gridObrasGS">
                      SIM
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="obrasGS" id="gridObrasGS1" value="option2" checked="">
                    <label class="form-check-label" for="gridObrasGS1">
                      NÃO
                    </label>
                  </div>
                </div>
              </div>

              <!--DADOS DO RATEIO -->
              <h5 class="card-title">Rateio departamentos</h5>

              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Nenhum valor disponivel!</h4>
                <p>Nenhum valor de RATEIO está disponivel no momento, finalize o preenchimento do formulario para que possamos disponibilizar os valores.</p>
                <hr>
                <p class="mb-0">Caso você já tenha finalizado e mesmo assim não aparece nenhum RATEIO, verifique se já cadastrou o Rateio de Fornecedor caso contrario entre em contato com o administrador do sistema.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Tabela centro de custo</h5>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Centro de Custo</th>
                        <th scope="col">% Rateio</th>
                        <th scope="col">Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.1 Novos</td>
                        <td>50</td>
                        <td>R$ 1500,00</td>
                      </tr>
                      <tr>
                        <td>1.2 Seminovos</td>
                        <td>50</td>
                        <td>R$ 1500,00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- BOTÃO DO FORMULARIOS -->
              <div class="text-center py-5">
                <hr>
                <button type="reset" class="btn btn-secondary">Limpar Formulario</button>
                <button type="submit" class="btn btn-success">Enviar Nota</button>
              </div>
            </form><!-- FIM Form -->
          </div><!-- FIM card-body -->
        </div><!-- FIM card -->
      </div><!-- FIM col-lg-12 -->
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>

<script>
  function bancos() {

    var tipoPagamento = document.getElementById("tipoPagamento").value;

    if (tipoPagamento == 2) {
      document.getElementById("tipopagamentoBancos").style.display = 'contents';
    } else {
      document.getElementById("tipopagamentoBancos").style.display = 'none';
    }



  }
</script>