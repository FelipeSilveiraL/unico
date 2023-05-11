<?php


function caracteres($string){

    $caracter = str_replace("'", '"', $string);
    $caracter = str_replace("table", 'div', $caracter);
    $caracter = str_replace("thead", 'div', $caracter);
    $caracter = str_replace("tbody", 'div', $caracter);
    $caracter = str_replace("td", 'div', $caracter);
    $caracter = str_replace("tr", 'div', $caracter);

    return $caracter;
} 