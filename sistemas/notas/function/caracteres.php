<?php

function seo_friendly_url($string)
{
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    $string = str_replace('-', ' ', $string);

    return strtoupper(trim($string, '-'));
}


function pontuacao($stingPontuacao)
{
    $stingPontuacao = str_replace('.', '', $stingPontuacao);
    $stingPontuacao = str_replace(',', '.', $stingPontuacao);

    return trim($stingPontuacao);
}

function formatarData($dataAlterar){ 

    $dia = substr($dataAlterar, 0, 2);
    $mes = substr($dataAlterar, 3, 2);
    $ano = substr($dataAlterar, 6, 4);

    return $dataAlterar = $ano."-".$mes."-".$dia;//Y-m-d
}
?>