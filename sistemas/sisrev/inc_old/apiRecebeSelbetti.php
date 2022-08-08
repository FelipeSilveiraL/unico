<?php

$url = "http://10.100.1.215/smartshare/inc/selbettiApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

//var_dump($resultado); 

foreach ($resultado->Users as $userSelbetti) {

$aprovador .= '<option value="'.$userSelbetti->LOGIN.'">'.$userSelbetti->USERS.' / '.$userSelbetti->LOGIN.' </option>';


}