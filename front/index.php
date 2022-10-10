<?php
session_start();

require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
require_once('head.php'); //CSS e configurações HTML
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina

$queryUserSistema .= " WHERE CSU.id_usuario = " . $_SESSION['id_usuario'] . " AND CS.deletar = 0";
$resultado = $conn->query($queryUserSistema);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Meus sistemas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->
  <section>
    <div class="row">
      <section class="section" <?= $display ?>>

        <div class="row">
          <?php

          while ($sistemas = $resultado->fetch_assoc()) {
            echo '
                <div class="col-lg-3 py-2">
                  <a href="'.$sistemas['endereco_sistema'].'id_sistema='.$sistemas['id_sistema'].'&id_usuario='. $_SESSION['id_usuario'] .'';

                    

                    echo '" target="_blank" class="list-group-item list-group-item-action">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">' . $sistemas['nome_sistema'] . '</h5>
                        
                      </div>
                    </div>
                  </a>
              </div>';
          }
          ?>

        </div>
      </section>

    </div>
  </section>
</main><!-- End #main -->
<?php
require_once('footer.php'); //Javascript e configurações afins
?>