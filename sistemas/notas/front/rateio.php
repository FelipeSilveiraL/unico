<?php

if ($sistema == 1) { //fluig

  $buscaRateio = 'SELECT 
                    CR.ID_RATEIOCENTROCUSTO AS ID,
                    CC.descDpto AS centrocusto,
                    CR.percentual
                  FROM
                    cad_rateiocentrocusto CR
                  LEFT JOIN
                    cad_centrocusto CC ON (CR.ID_CENTROCUSTO = CC.ID_CENTROCUSTO)
                  WHERE
                    CR.ID_RATEIOFORNECEDOR = '.$_GET['idRateioFornecedor'];
} else {

  $buscaRateio = 'SELECT 
                    CR.ID_RATEIOCENTROCUSTO AS ID,
                    UBND.NOME_DEPARTAMENTO AS centrocusto,
                    CR.percentual
                  FROM
                    cad_rateiocentrocusto CR
                  LEFT JOIN
                    unico.bpm_nf_departamento UBND ON (CR.ID_CENTROCUSTO_BPM = UBND.ID_DEPARTAMENTO)
                  WHERE
                    CR.ID_RATEIOFORNECEDOR = '.$_GET['idRateioFornecedor'];
}

//contagem de porcento
$queryPorcentual = "SELECT SUM(PERCENTUAL) AS porcentual FROM cad_rateiocentrocusto WHERE ID_RATEIOFORNECEDOR = " . $_GET['idRateioFornecedor'] . " GROUP BY ID_RATEIOFORNECEDOR";
$aplicarPorcentual = $connNOTAS->query($queryPorcentual);
$porcentual = $aplicarPorcentual->fetch_assoc();

if ($porcentual['porcentual'] < '100') {
  $addPorcentual = 'style="display: block"';
  $required = 'required';
  //incompleto
  $updateIncompleto = "UPDATE cad_rateiofornecedor SET centro_custo_completo = '1' WHERE `ID_RATEIOFORNECEDOR`= ".$_GET['idRateioFornecedor'];
  $aplicaIncompleto = $connNOTAS->query($updateIncompleto);

} else {
  $addPorcentual = 'style="display: none"';
  $required = '';
  //completo
  $updateCompleto = "UPDATE cad_rateiofornecedor SET centro_custo_completo = '2' WHERE `ID_RATEIOFORNECEDOR`= ".$_GET['idRateioFornecedor'];
  $aplicaCompleto = $connNOTAS->query($updateCompleto);
}

?>

<!--DADOS DO RATEIO -->
<h5 class="card-title">Rateio Departamentos</h5>

<div class="form-floating col-md-6" <?= $addPorcentual ?>>
  <select class="form-select" id="floatingSelect" name="centroCusto" <?= $required ?> >
    <option value="">-----------------</option>
    <?php
    if ($sistema == 1) { //FLUIG
      $queryFilial = "SELECT 
                          CCC.ID_CENTROCUSTO AS ID_DEPARTAMENTO,
                          CCC.descDpto AS NOME_DEPARTAMENTO 
                      FROM
                          dbnotas_hom.cad_centrocusto CCC
                      WHERE
                          CCC.ID_FILIAL = (SELECT 
                                  CF.ID_FILIAL
                              FROM
                                  dbnotas_hom.cad_filial CF
                              WHERE
                                  CF.cnpj = (SELECT 
                                          UBE.CNPJ
                                      FROM
                                          unico.bpm_empresas UBE
                                      WHERE
                                          UBE.ID_EMPRESA = '" . $filial . "'))";
    } else {
      $queryFilial = "SELECT 
                          D.ID_DEPARTAMENTO,
                          D.NOME_DEPARTAMENTO
                      FROM
                          unico.bpm_nf_emp_dep ED
                      LEFT JOIN
                        unico.bpm_nf_departamento D ON (ED.ID_DEPARTAMENTO = D.ID_DEPARTAMENTO)
                      WHERE
                          ED.ID_EMPRESA = '" . $filial . "' AND ED.SITUACAO = 'A' AND ED.LANCA_NOTAS = 'S'";
    }

    $resutadoCentro = $connNOTAS->query($queryFilial);
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
          echo '<tr>
                    <td>' . $rateio['centrocusto'] . '</td>
                    <td>' . $rateio['percentual'] . '</td>
                    <td>
                      <a href="../inc/deletarCentroCusto.php?idCentroCusto=' . $rateio['ID'] . '&idRateioFornecedor='.$_GET['idRateioFornecedor'].'" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>';
        }
        ?>
      </tbody>
    </table>
    <span class="text-danger small pt-1 fw-bold">Total: <?= $porcentual['porcentual'] ?> %</span>
  </div>
</div>