<?php
/* 
    ARQUIVO RESPONSAVEL POR GERAR TOKEN PARA SER USADO A API DA SELBETTI
*/

//API - VARIAVEIS
$url = 'https://appsmart.gruposervopa.com.br/smartshare/SmartShareAPI/api/v3/Usuario/ValidarLogin';
$dsCliente = 'mobile';
$dsChaveAutenticacao = 'NnLHcy3ilNdOs1+JJJysCJbhOX9cWOVkn1jj5MzdViA=';
$dsUsuario = 'integra.usuario';
$dsSenha = 'passwshare';

//API - INICIANDO
$curl = curl_init();

//API - CONFIGURAÇÔES
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "dsUsuario": "'.$dsUsuario.'",
  "dsSenha": "'.$dsSenha.'"
}',
  CURLOPT_HTTPHEADER => array(
    'dsCliente: '.$dsCliente.'',
    'dsChaveAutenticacao: '.$dsChaveAutenticacao.'',
    'Content-Type: application/json'
  ),
));

//API - EXECUTANDO
$str = json_decode($response = curl_exec($curl));

//API - FINALIZANDO
curl_close($curl);

//API - CAPTURANDO TOKEN
$tokenUsuarioSelbetti = $str->tokenUsuario;

//API - STATUS
$status = ($tokenUsuarioSelbetti != NULL) ? '<a href="#" title="ONLINE"><i class="fas fa-check-circle" style="color: green">Ativo</i></a>' : '<a href="#" title="OFFLINE"><i class="fas fa-ban" style="color: red">Desativado</i></a>';