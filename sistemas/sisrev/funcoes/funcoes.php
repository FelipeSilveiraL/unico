<?php

function caracteres($string)
{

    $caracter = str_replace('"', "'", $string);
    $caracter = str_replace(' ', "", $string);
    $caracter = str_replace('\n', "", $string);


    return $caracter;
}
