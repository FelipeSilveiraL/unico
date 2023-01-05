<?php
$buscaRateio = "SELECT * FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $_GET['idRateioFornecedor'];
$aplicaBuscaRateio = $connNOTAS->query($buscaRateio);

//contagem de porcento
$queryPorcentual = "SELECT SUM(PERCENTUAL) AS porcentual FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $_GET['idRateioFornecedor'] . " GROUP BY ID_RATEIOFORNECEDOR";
$aplicarPorcentual = $connNOTAS->query($queryPorcentual);
$porcentual = $aplicarPorcentual->fetch_assoc();

if ($porcentual['porcentual'] < '100') {
  $addPorcentual = 'style="display: block"';
} else {
  $addPorcentual = 'style="display: none"';
}

?>

<!--DADOS DO RATEIO -->
<h5 class="card-title">Rateio Departamentos</h5>

<div class="form-floating col-md-6" <?= $addPorcentual ?>>
  <select class="form-select" id="floatingSelect" name="centroCusto">
    <option value="">-----------------</option>
    <?php
    $queryCentroCusto = "SELECT * FROM notas_centro_custo WHERE ID_EMPRESA = '" . $filial . "' ORDER BY NOME_DEPARTAMENTO ASC";
    $resutadoCentro = $conn->query($queryCentroCusto);

    while ($centroCusto = $resutadoCentro->fetch_assoc()) {
      echo '<option value="' . $centroCusto['ID_DEPARTAMENTO'] . '">' . $centroCusto['NOME_DEPARTAMENTO'] . '</option>';
    }
    ?>
  </select>
  <label for="floatingSelect">Centro de custo</label>
</div>

<div id="divFornecedor" class="col-md-5" <?= $addPorcentual ?>>
  <div class="form-floating">
    <input type="text" class="form-control" maxlength="4" name="porcentual">
    <label for="cpfCnpjFor">Porcentual %</label>
  </div>
</div>

<div id="divFornecedor" class="top_margin col-md-1" <?= $addPorcentual ?>>
  <div class="form-floating">
    <button type="submit" class="btn btn-success">
      <div class="icon">
        <i class="bx bxs-plus-square"></i>
      </div>
    </button>
  </div>
</div>



<div class="card" id="rateioFornecedor"><h5 class="card-title">Tabela centro de custo</h5>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Centro de Custo</th>
          <th scope="col">% Rateio</th>
          <th scope="col">Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($rateio = $aplicaBuscaRateio->fetch_assoc()) {
          echo '<tr>
                    <td>' . $rateio['ID_CENTROCUSTO'] . '</td>
                    <td>' . $rateio['PERCENTUAL'] . '</td>
                    <td>
                      <a href="../inc/deletarCentroCusto.php?idCentroCusto=' . $rateio['ID'] . '&idRateioFornecedor='.$_GET['idRateioFornecedor'].'" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>';
        }
        ?>
      </tbody>
    </table>
    <span class="text-danger small pt-1 fw-bold">Total: <?=$porcentual['porcentual']?> %</span>
  </div>
</div>