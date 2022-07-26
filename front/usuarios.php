<?php
session_start();
echo !empty($_GET['conf']) ? '' : '<script>window.location.href = "usuarios.php?pg=' . $_GET['pg'] . '&conf=1";</script>';
require_once('../config/databases.php');
require_once('../config/query.php');
require_once('administrador.php');
require_once('head.php');
require_once('header.php');
require_once('menu.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Lista Usuários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Configurações</li>
        <li class="breadcrumb-item active">Usuários</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->
  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->

  <iframe src="iframeUsuarios.php" style="height:1800px; width:100%;" title="Iframe Usuarios"></iframe>

</main><!-- End #main -->

<?php
require_once('footer.php');
?>