<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Lançamento Manual</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item">Lançamento manual</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->
  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>
  <!-- Alertas -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3" action="" method="post" enctype="multipart/form-data">
              <!--DADOS PARA O LANÇAMENTO -->
              <h5 class="card-title">Dados lançamento</h5>
              <div class="form-floating mb-3 col-md-12">
                <select class="form-select" id="floatingSelect" name="usuarioBPM">
                  <option value="1">Felipe Lara</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect" class="capitalize">usuario para lançamento <?= $_SESSION['nome_bpm'] ?></label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <select class="form-select" id="floatingSelect" name="fornecedor" required>
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Fornecedor</label>
              </div>

              <div class="form-floating mb-3 col-md-6">
                <select class="form-select" id="floatingSelect" name="filial" required>
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Filial</label>
              </div>

              <div class="col-12">
                <input type="text" class="form-control" placeholder="Tipo de serviço" name="tipoServico" required>
              </div>

              <!--DADOS DA NOTA FISCAL -->
              <h5 class="card-title">Dados da nota fiscal</h5>
              <div class="col-md-9 mb-3">
                <input type="text" class="form-control" placeholder="Número" name="numeroNota" required>
              </div>
              <div class="col-3 mb-3">
                <input type="text" class="form-control" placeholder="Série" name="serie" required>
              </div>

              <div class="col-md-4 mb-3">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Emissão</span>
                    <input type="date" class="form-control" name="emissao" required>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Vencimento</span>
                    <input type="date" class="form-control" name="vencimento" required>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">R$</span>
                    <input type="text" class="custom4 form-control" name="valor" maxlength="12" onKeyUp="mascaraMoeda(this, event)" placeholder="000000.00" required>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-sm-10">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="carimbar">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Carimbar pelo Robô!</label>
                  </div>
                </div>
              </div>

              <h5 class="card-title">Anexar documentos</h5>

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
                <select class="form-select" id="floatingSelect" name="tipodespesa" required>
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Tipo de Despesa</label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="floatingSelect" name="fornecedor" required>
                  <option value="">-----------------</option>
                  <option value="2">Lucimara</option>
                  <option value="3">Suellem</option>
                </select>
                <label for="floatingSelect">Periodicidade</label>
              </div>

              <div class="form-floating mb-3 col-md-4">
                <select class="form-select" id="floatingSelect" name="periodicidade" required>
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
                  <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" name="observacao" required></textarea>
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
  </section><!-- FIM section -->
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>