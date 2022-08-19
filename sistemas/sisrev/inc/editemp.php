
  <?php
  session_start();
  require_once("../config/query.php");
  require_once('../../../config/databases.php');
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

    echo '
    <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <form class="row g-3" action="http://'.$_SESSION['servidorOracle'].'/smartshare/bd/editemp.php?id_empresa=' . $info . '&pg='.$_GET['pg'].'" method="POST">
              <div class="form-floating mt-4 col-md-12">
                <select class="form-select" id="floatingSelect" name="usuarioBPM" disabled>
                  <option value="1">' . $edit["NOME_EMPRESA"] . '</option>
                </select>
                <label for="floatingSelect" class="capitalize">EMPRESA:</label>
              </div>

              <div class="form-floating mt-4 col-md-6">
                <select class="form-select" onchange="camposObrigatorios()" id="sistema" name="sistema"  required>';
    if (!empty($edit["SISTEMA"])) {
      switch ($edit["SISTEMA"]) {
        case 'A':
          echo '<option value="A">APOLLO</option>';
          break;
        case 'N':
          echo '<option value="N">BANCO NBS</option>';
          break;
        case 'H':
          echo '<option value="H">BANCO HARLEY</option>';
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
                  <option value="0">EMPRESA QUE NÃO USA SISTEMA ERP</option>     
                </select>
                <label for="sistema">SISTEMA:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresaApollo">
                <input onkeypress="onlynumber()" value="' . $valueApollo . '" class="form-control"  name="empApollo" maxlength="2" required>
                <label for="empresaApollo">EMPRESA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="revendaApollo">
                <input onkeypress="onlynumber()" value="' . $valueRevApollo . '" class="form-control"  name="revApollo" maxlength="2" required>
                <label for="revendaApollo">REVENDA APOLLO:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="orgsenior">
                <input value="' . $edit["ORGANOGRAMA_SENIOR"] . '" class="form-control"  name="orgsenior" maxlength="2" required>
                <label for="orgsenior">ORGANOGRAMA SENIOR:<span style="color: red;">*</span></label>
              </div>
              
              <div class="form-floating mt-4 col-md-6" id="empresaNbs">
                <input onkeypress="onlynumber()" value="' . $edit["EMPRESA_NBS"] . '"  class="form-control"  name="empnbs" id="empnbs" maxlength="2" required>
                <label for="empresaNbs">Empresa NBS:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="empresasenior">
                <input onkeypress="onlynumber()" value="' . $edit["EMPRESA_SENIOR"] . '" class="form-control"  name="empresasenior" maxlength="2" required>
                <label for="empresasenior">EMPRESA SENIOR:<span style="color: red;">*</span></label>
              </div>

              <div class="form-floating mt-4 col-md-6" id="filialsenior">
                <input onkeypress="onlynumber()" value="' . $edit["FILIAL_SENIOR"] . '" class="form-control"  name="filialsenior" maxlength="2" required>
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
                <option value="">------------</option>
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG">MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                    <option value="EX">EX</option>
                </select>
                <label for="estado">UF:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" id="numero_caixa">
                <input value="' . $edit['NUMERO_CAIXA'] . '" class="form-control"  name="numero_caixa" maxlength="2" onblur="aprovador()" onkeypress="onlynumber()" required>
                <label for="numero_caixa">NUMERO CAIXA:<span style="color: red;">*</span></label>
              </div>
              <div class="form-floating mt-4 col-md-6" style="display: ';
    echo empty($edit['NUMERO_CAIXA']) ? 'none' : 'block';
    echo ';" id="liberarApro">
                <select  class="form-select" id="aproCaixa" name="aproCaixa" id="aproCaixa" required>';
    if (empty($edit['APROVADOR_CAIXA'])) {
      echo '<option value="">------------------</option>';
    } else {
      echo '<option value="' . $edit['APROVADOR_CAIXA'] . '" selected>' . $edit['APROVADOR_CAIXA'] . '</option>
                              <option value="">-----------------</option>';
    }
    echo $aprovador;
    echo '</select>
                  <label for="aproCaixa">APROVADOR CAIXA:<span style="color: red;">*</span></label>
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
              <script>
  function aprovador() {
    var tela = document.getElementById("liberarApro").style.display;

    if (tela == "none") {
      document.getElementById("liberarApro").style.display = "block";
      document.getElementById("aproCaixa").required = true;
    } else {
      document.getElementById("liberarApro").style.display = "none";
      document.getElementById("aproCaixa").required = false;
    }
  }
</script>

<script>
  function camposObrigatorios() {
    var value = document.getElementById("sistema").value

    if (value == "A") {
      document.getElementById("empresaNbs").style.display = "none";
      document.getElementById("empnbs").value = "";
      document.getElementById("empresaApollo").style.display = "block";
      document.getElementById("revendaApollo").style.display = "block";

    } else {
      document.getElementById("empresaNbs").style.display = "block";
      document.getElementById("empresaApollo").style.display = "none";
      document.getElementById("revendaApollo").style.display = "none";
      document.getElementById("empApollo").value = "";
      document.getElementById("revApollo").value = "";
    }
  }
</script>
            ';
  }

  ?>




