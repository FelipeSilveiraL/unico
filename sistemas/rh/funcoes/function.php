<?php

function formatarHorario($horario) {

    $horaInicial = substr($horario, 0, 2);
    $minutoInicial = substr($horario, 2, 2);

    $horaFinal= substr($horario, 4, 2);
    $minutoFinal = substr($horario, 6, 2);

    $horaFomatada = $horaInicial.":".$minutoInicial." ás ".$horaFinal.":".$minutoFinal;

    return $horaFomatada;
}

function removerCaracteres($caractere) {
    $elementos = str_replace(":", "", $caractere); 
    return $elementos;
}


function horaInicial($variavel){
    $hora = substr($variavel, 0, 2);
    return $hora;

}

function minutoInicial($variavel){
    $minuto = substr($variavel, 2, 2);
    return $minuto;
}

function horaFinal($variavel){
    $hora = substr($variavel, 4, 2);
    return $hora;

}

function minutoFinal($variavel){
    $minuto = substr($variavel, 6, 2);
    return $minuto;
}


?>