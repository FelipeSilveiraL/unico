<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina


//PERMISSÔES
foreach ($validacao['idFuncao'] as $key => $value) {

  switch ($value['funcao']) {
    case '5':
      $aE = 'SELECT id FROM bpm_usuario_funcao where id_usuario = '.$_SESSION['id_usuario'].' AND id_funcao = '.$value['funcao'].'';
      $resultadoaE = $conn->query($aE);
      if (!$fun = $resultadoaE->fetch_assoc()) {
        $usuarioFuncaoE = 'style= "display: none"';
      }
      break;

    case '6':
      $aE = 'SELECT id FROM bpm_usuario_funcao where id_usuario = '.$_SESSION['id_usuario'].' AND id_funcao = '.$value['funcao'].'';
      $resultadoaE = $conn->query($aE);
      if (!$fun = $resultadoaE->fetch_assoc()) {
        $usuarioFuncaoP = 'style= "display: none"';
      }
      break;
  }

}
?>



<main id="main" class="main">

  <div class="pagetitle">
    <h1>Usuários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a></li>
        <li class="breadcrumb-item">Usuários</li>
      </ol>
    </nav>
  </div>
  <!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lista usuários</h5>
            <h6 <?= $usuarioFuncaoE ?>>
              <p> Nesta tela só é possivel tratar permissões dos usuários para o Sistema BPM.</p>
              <p>Caso seja necessario mudar outras informações como por exemplo; usuário, senha, etc... Basta clicar neste icone
                <a href="../../../front/usuarios.php?pg=<?= $_GET['pg'] ?>" class="btn btn-success button-rigth-espelho" title="Editar usuários" target="_blank">
                  <i class="bx bxs-user-detail"></i>
                </a>
              </p>
            </h6>
            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
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

                //while dos usuários 
                while ($usuarios = $resultado->fetch_assoc()) {
                  echo '
                    <tr>
                      <th scope="row">' . $usuarios['id_usuario'] . '</th>
                      <td>' . $usuarios['nome'] . '</td>
                      <td>' . $usuarios['usuario'] . '</td>
                      <td>
                        <a href="usuariosPermissoes.php?id_usuarios=' . $usuarios['id_usuario'] . '&pg=' . $_GET['pg'] . '" title="Permissões" class="btn btn-warning btn-sm"" ' . $usuarioFuncaoP . '>
                          <i class="bx bxs-lock-open"></i>
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