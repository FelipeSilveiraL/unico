<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Cadastro de Funções</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a></li>
        <li class="breadcrumb-item"><a href="usuarios.php?pg=<?= $_GET['pg'] ?>">Usuários</a></li>
        <li class="breadcrumb-item">Funções</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <!--################# COLE section AQUI #################-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edição de usuários</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Usuário</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //chamando usuários
                $queryUsers .= " WHERE deletar = 0 ORDER BY NOME ASC";
                $resultado = $conn->query($queryUsers);

                while ($usuarios = $resultado->fetch_assoc()) {
                  echo '
                    <tr>
                      <th scope="row">' . $usuarios['id_usuario'] . '</th>
                      <td>' . $usuarios['nome'] . '</td>
                      <td>' . $usuarios['usuario'] . '</td>
                      <td> 
                        <a href="editar_usuario.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'" title="Editar Usuário" class="btn btn-primary btn-sm">
                          <i class="bi bi-pencil"></i>
                        </a>
                      </td>
                    </tr>';
                  }
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>