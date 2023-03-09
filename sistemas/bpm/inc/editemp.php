
  <?php
  session_start();
  require_once("../config/query.php");
  require_once('../../../config/databases.php');
  require_once('../../../config/config.php');
  require_once('../inc/apiRecebeSelbetti.php');

  $info = $_GET['ID'];

  $editarTabela .= " WHERE ID_EMPRESA = $info";
  $resultado = $conn->query($editarTabela);

  while ($edit = $resultado->fetch_assoc()) {

    $consorcio = ($edit["CONSORCIO"] == 'S') ? 'SIM' : 'NÃO';

    $situacao = ($edit["SITUACAO"] == 'A') ? 'ATIVO' : 'DESATIVADO';

    $valueApollo = ($edit["EMPRESA_APOLLO"] == 0) ? '' : $edit["EMPRESA_APOLLO"];

    $valueRevApollo = ($edit["REVENDA_APOLLO"] == 0) ? '' : $edit["REVENDA_APOLLO"];

    $valueEmpNbs = ($edit["EMPRESA_NBS"] == 0) ? '' : $edit["EMPRESA_NBS"];

    $revisao = ($edit["REVISAO_NF_ADM"] == 'S') ? 'SIM' : 'NÃO';

    $triagem = ($edit["INTEGRAR_TRIAGEM"] == 'S') ? 'SIM' : 'NÃO';
    echo '
    <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <form class="row g-3" action="http://'.$_SESSION['servidorOracle'].'/'.$_SESSION['smartshare'].'/bd/editemp.php?id_empresa=' . $info . '&pg='.$_GET['pg'].'" method="POST">
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" id="floatingSelect" name="usuarioBPM" disabled>
                  <option value="1" >' . $edit["NOME_EMPRESA"] . '</option>
                </select>
                <label for="floatingSelect" class="capitalize" >EMPRESA:</label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="cnpj">
                <input class="form-control" onblur="validarCNPJ(this)" name="cnpjValue" maxlength="14" value="'.$edit['CNPJ'].'">
                <label for="cnpj" class="capitalize">CNPJ:</label>
              </div>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">CNPJ inválido, por favor verifique!</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" onchange="camposObrigatorios()" id="sistema" name="sistema"  required>';
                  if (!empty($edit["SISTEMA"])) {
                    switch ($edit["SISTEMA"]) {
                      case 'A':
                        echo '<option value="A">APOLLO</option>';
                        $naoMostraNbs = "display:none;";
                        break;
                      case 'N':
                        echo '<option value="N">BANCO NBS</option>';
                        $naoMostraApollo = "display:none;";
                        break;
                      case 'H':
                        echo '<option value="H">BANCO HARLEY</option>';
                        break;
                      case 'C':
                        echo '<option value="C">CONSÓRCIO</option>';
                        break;
                      case '0':
                        echo '<option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>';
                        break;
                    }
                    echo '<option value="">------------------</option>';
                  } else {
                    echo '<option value="">------------------</option>';
                  }
                  echo '
                  <option value="A">APOLLO</option>
                  <option value="N">BANCO NBS</option>
                  <option value="H">BANCO HARLEY</option>  
                  <option value="C">CONSÓRCIO</option>
                  <option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>     
                </select>
                <label for="sistema">SISTEMA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresaApollo" style="'.$naoMostraApollo.'">
                <input onkeypress="return onlyNumberKey(event)" value="' . $valueApollo . '" class="form-control" id="empApollo" name="empApollo" maxlength="2"';if($edit['SISTEMA'] == 'A'){echo 'required>';}else{echo '>';};echo'
                <label for="empresaApollo">EMPRESA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="revendaApollo" style="'.$naoMostraApollo.'">
                <input onkeypress="return onlyNumberKey(event)" value="' . $valueRevApollo . '" class="form-control" id="revApollo" name="revApollo" maxlength="2"';if($edit['SISTEMA'] == 'A'){echo 'required>';}else{echo '>';};echo'
                <label for="revendaApollo">REVENDA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="apelidoNbs" style="'.$naoMostraNbs.'">
                <input  value="' . $edit["APELIDO_NBS"] . '" class="form-control"  name="apelidoNbs" maxlength="2"';if($edit['SISTEMA'] == 'N'){echo 'required>';}else{echo '>';};echo'
                <label for="apelidoNbs">APELIDO NBS:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="empresaNbs" style="'.$naoMostraNbs.'">
                <input onkeypress="return onlyNumberKey(event)" value="' . $edit["EMPRESA_NBS"] . '"  class="form-control"  name="empnbs" id="empnbs" maxlength="2"';if($edit['SISTEMA'] == 'N'){echo 'required>';}else{echo '>';};echo'
                <label for="empresaNbs">Empresa NBS:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="limite_nota_diversa">
                <input onkeypress="return onlyNumberKey(event)" value="' . $edit["LIMITE_NOTA_DIVERSA"] . '" class="form-control"  name="limite_nota_diversa" maxlength="12" required>
                <label for="limite_nota_diversa">LIMITE NOTA DIVERSA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="bandeira">
                <input value="' . $edit["BANDEIRA"] . '"  class="form-control"  name="bandeira" id="bandeira" maxlength="100" required>
                <label for="bandeira">BANDEIRA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresasenior">
                <input onkeypress="return onlyNumberKey(event)" value="' . $edit["EMPRESA_SENIOR"] . '" class="form-control"  name="empresasenior" maxlength="2" required>
                <label for="empresasenior">EMPRESA SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="orgsenior">
              <input onkeypress="return onlyNumberKey(event)" value="' . $edit["ORGANOGRAMA_SENIOR"] . '" class="form-control"  name="orgsenior" maxlength="2" required>
              <label for="orgsenior">ORGANOGRAMA SENIOR:<span style="color: red;">*</span></label>
            </div>

              <div class="form-floating mt-4 col-md-6" id="filialsenior">
                <input onkeypress="return onlyNumberKey(event)" value="' . $edit["FILIAL_SENIOR"] . '" class="form-control"  name="filialsenior" maxlength="2" required>
                <label for="filialsenior">FILIAL SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="consorcio">
                <select class="form-select"  name="consorcio" required>
                  <option value="' . $edit['CONSORCIO'] . '">' . $consorcio . '</option>
                  <option value="">-----------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="consorcio">CONSÓRCIO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="triagem">
                <select class="form-select"  name="triagem" required>
                  <option value="' . $edit['INTEGRAR_TRIAGEM'] . '">' . $triagem . '</option>
                  <option value="">-----------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="triagem">INTEGRAR TRIAGEM:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="situacao">
                <select class="form-select"  name="situacao" required>
                  <option value="' . $edit["SITUACAO"] . '">' . $situacao . '</option>
                  <option value="">-----------------</option>
                  <option value="A">ATIVO</option>
                  <option value="D">DESATIVADO</option>
                </select>
                <label for="situacao">SITUAÇÃO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="estado">
                <select class="form-select"  name="estado" required>
                <option value="' . $edit['UF_GESTAO'] . '">' . $edit['UF_GESTAO'] . '</option>
                <option value="">------------</option>';

                $resultadoEstado = $conn->query($queryEstados);

                while ($estados = $resultadoEstado->fetch_assoc()) {
                    echo '<option value="' . $estados['sigla'] . '">' . $estados['sigla'] . ' - ' . $estados['nome'] . '</option>';
                }
                
            echo' </select>
                <label for="estado">UF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="numero_caixa">
                <input value="' . $edit['NUMERO_CAIXA'] . '" class="form-control"  name="numero_caixa" maxlength="2" onblur="aprovador()" onkeypress="onlynumber()" required>
                <label for="numero_caixa">NUMERO CAIXA:<span style="color: red;">*</span></label>
              </div>
              
              <div class="form-floating mt-4 col-md-6" id="revisaoNF">
                <select class="form-select"  name="revisaoNF">
                  <option value="' . $edit["REVISAO_NF_ADM"] . '">' . $revisao . '</option>
                  <option value="">-----------------</option>
                  <option value="S">SIM</option>
                  <option value="N">NÃO</option>
                </select>
                <label for="revisaoNF">REVISÃO NF ADM:<span style="color: red;">*</span></label>
              </div>
              <div class="text-left py-2">
                <a href="../front/empresas.php?pg=' . $_GET["pg"] . '" class="btn btn-primary">Voltar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
              </div>
              </form>
          </div>
        </div><!-- FIM card -->
      </div><!-- FIM col-lg-12 -->
    </div>
  </section>
</main>
              
            ';
  }

  ?>




