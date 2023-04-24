<?php

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