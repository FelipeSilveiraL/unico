<?php

$buscaRateio = 'SELECT 
                    CR.ID_RATEIOCENTROCUSTO AS ID,
                    CR.ID_CENTROCUSTO_BPM,
                    CR.percentual
                  FROM
                    cad_rateiocentrocusto CR
                  WHERE
                    CR.ID_RATEIOFORNECEDOR = ' . $_GET['idRateioFornecedor'];

//contagem de porcento
$queryPorcentual = "SELECT SUM(PERCENTUAL) AS porcentual FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $_GET['idRateioFornecedor'] . " GROUP BY ID_RATEIOFORNECEDOR";
$aplicarPorcentual = $connNOTAS->query($queryPorcentual);
$porcentual = $aplicarPorcentual->fetch_assoc();

if ($porcentual['porcentual'] < '100') {
  $addPorcentual = 'style="display: block"';
  $required = 'required';
  //incompleto
  $updateIncompleto = "UPDATE cad_rateiofornecedor SET centro_custo_completo = '1' WHERE `ID_RATEIOFORNECEDOR`= " . $_GET['idRateioFornecedor'];
  $aplicaIncompleto = $connNOTAS->query($updateIncompleto);
} else {
  $addPorcentual = 'style="display: none"';
  $required = '';
  //completo
  $updateCompleto = "UPDATE cad_rateiofornecedor SET centro_custo_completo = '2' WHERE `ID_RATEIOFORNECEDOR`= " . $_GET['idRateioFornecedor'];
  $aplicaCompleto = $connNOTAS->query($updateCompleto);
}

?>

<!--DADOS DO RATEIO -->
<h5 class="card-title">Rateio Departamentos</h5>

<div class="form-floating col-md-6" <?= $addPorcentual ?>>
  <select class="form-select" id="floatingSelect" name="centroCusto" <?= $required ?>>
    <option value="">-----------------</option>
    <?php

    $queryFilial = "SELECT 
                          D.ID_DEPARTAMENTO,
                          D.NOME_DEPARTAMENTO
                      FROM
                      empresa_departamento_nf ED
                      LEFT JOIN
                      departamento_nf D ON (ED.ID_DEPARTAMENTO = D.ID_DEPARTAMENTO)
                      WHERE
                          ED.ID_EMPRESA = '" . $filial . "' AND ED.SITUACAO = 'A' AND ED.LANCA_NOTAS = 'S'  order by nome_departamento ASC";

    $resultadoCentro = oci_parse($connBpmgp, $queryFilial);
    oci_execute($resultadoCentro);

    while ($centroCusto = oci_fetch_array($resultadoCentro, OCI_ASSOC)) {
      echo '<option value="' . $centroCusto['ID_DEPARTAMENTO'] . '">' . $centroCusto['NOME_DEPARTAMENTO'] . '</option>';
    }


    oci_free_statement($resultadoCentro);
    oci_close($connBpmgp);
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



<div class="card" id="rateioFornecedor">
  <h5 class="card-title">Tabela centro de custo</h5>
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
        $aplicaBuscaRateio = $connNOTAS->query($buscaRateio);

        while ($rateio = $aplicaBuscaRateio->fetch_assoc()) {

          $queryBuscaDepartamento = "SELECT * FROM departamento_nf WHERE ID_DEPARTAMENTO = ".$rateio['ID_CENTROCUSTO_BPM'];

          $result = oci_parse($connBpmgp, $queryBuscaDepartamento);
          oci_execute($result);

          while($filialRateio = oci_fetch_array($result, OCI_ASSOC)){
            $departamento = $filialRateio['NOME_DEPARTAMENTO'];
          }


          echo '<tr>
                    <td>' . $departamento . '</td>
                    <td>' . $rateio['percentual'] . '</td>
                    <td>
                      <a href="../inc/deletarCentroCusto.php?idCentroCusto=' . $rateio['ID'] . '&idRateioFornecedor=' . $_GET['idRateioFornecedor'] . '" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>';
        }
        ?>
      </tbody>
    </table>
    <span class="text-danger small pt-1 fw-bold">Total: <?= $porcentual['porcentual'] ?> %</span>
  </div>
</div>