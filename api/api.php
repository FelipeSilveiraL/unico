<?php
switch ($_GET['menu']) {
    case '1':        
        require_once('tokenSelbettiAPI.php');

        $menu = '<li class="breadcrumb-item active">Selbetti</li>';
        $nome = 'Selbetti';
        $documentacao = '<a href="https://www.selbetti.com.br/smartshare/SmartShareAPI/Swagger/ui/index" target="_blank" rel="noopener noreferrer">www.selbetti.com.br</a>';
        $urlAPI = 'https://appsmart.gruposervopa.com.br/smartshare/SmartShareAPI/NOME_DA_API';
        break;
}
?>