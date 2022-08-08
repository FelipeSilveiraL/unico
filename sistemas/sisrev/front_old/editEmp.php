<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Editar Regra Empresa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="informatica.php">Informática</a></li>
        <li class="breadcrumb-item"><a href="empresas.php">Empresa</a></li>
        <li class="breadcrumb-item">Editar Regra Empresa</li>
      </ol>
    </nav>
  </div>
  <?php
  require_once('../../../inc/mensagens.php');

  require '../inc/editemp.php';

  require_once('footer.php'); //Javascript e configurações afins
  ?>