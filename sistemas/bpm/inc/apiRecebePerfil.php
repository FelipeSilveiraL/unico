<?php
session_start();

$url = "http://".$_SESSION['servidorOracle']."/".$_SESSION['smartshare']."/inc/selbettiPerfilApi.php";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$resultado = json_decode(curl_exec($ch));

//var_dump($resultado); 

foreach ($resultado->perfil as $perfilWeb) {

    $erro = $perfilWeb->DS_PERFIL;

    switch($erro){
      case 'Area Padr?o':
        $erro = 'Area Padrão';
      break;
      case 'Centro Padr?o':
        $erro = 'Centro Padrão';
      break;
    }
$mostra .= '<option value="'.$perfilWeb->CD_PERFIL.'">'.$perfilWeb->CD_PERFIL.' - '.$erro.' 
</option>';


}