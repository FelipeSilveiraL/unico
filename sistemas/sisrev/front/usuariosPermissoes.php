<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

//chamando usuário               
$queryUsers .= " WHERE id_usuario = " . $_GET['id_usuarios'];
$resultado = $conn->query($queryUsers);
$usuarios = $resultado->fetch_assoc();

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Perfis de Usuários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a></li>
        <li class="breadcrumb-item"><a href="usuarios.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>">Usuários</a></li>
        <li class="breadcrumb-item"><?= $usuarios['nome'] ?></li>
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
            <h5 class="card-title">Permissões de usuário</h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="telas-tab" data-bs-toggle="tab" data-bs-target="#telas" type="button" role="tab" aria-controls="telas" aria-selected="true">Modulos</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="funcoes-tab" data-bs-toggle="tab" data-bs-target="#funcoes" type="button" role="tab" aria-controls="funcoes" aria-selected="false">Funções</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
              <div class="tab-pane fade show active" id="telas" role="tabpanel" aria-labelledby="telas-tab">
                <form action="../inc/usuariosPermissoes.php?id_usuarios=<?= $_GET['id_usuarios'] ?>&pg=<?= $_GET['pg'] ?>&acao=1" method="post">

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="capitalize">#</th>
                        <th scope="col" class="capitalize">Modulo</th>
                        <th scope="col" class="capitalize">endereço</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //chamando modulos
                      $queryModulos .= " WHERE deletar = 0";
                      $resultadoModulos = $conn->query($queryModulos);

                      while ($modulos = $resultadoModulos->fetch_assoc()) {

                        //verificando se o usuáros ja possui o modulo
                        $queryModulosUser = "SELECT * FROM sisrev_usuario_modulo SM WHERE SM.id_usuario = " . $_GET['id_usuarios'] . " AND SM.id_modulo = " . $modulos['id'];
                        $resultModulosUser = $conn->query($queryModulosUser);

                        if ($modulosUser = $resultModulosUser->fetch_assoc()) {
                          $checked = 'checked';
                        } else {
                          $checked = '';
                        }

                        echo '<tr>
                                <th scope="row"><input type="checkbox" value="' . $modulos['id'] . '" name="modulo[]" id="modulo" ' . $checked . '></th>
                                <td>' . $modulos['nome'] . '</td>
                                <td>' . $modulos['endereco'] . '</td>
                              </tr>';
                      }

                      ?>

                    </tbody>
                  </table>
                  <div class="text-left  mb-3">
                    <hr>
                    <button type="reset" class="btn btn-secondary">Limpar Tabela</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                  <!-- End Table with stripped rows -->
                </form>
              </div>
              <div class="tab-pane fade" id="funcoes" role="tabpanel" aria-labelledby="funcoes-tab">
                <form action="../inc/usuariosPermissoes.php?id_usuarios=<?= $_GET['id_usuarios'] ?>&pg=<?= $_GET['pg'] ?>&acao=2" method="post">

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="capitalize">#</th>
                        <th scope="col" class="capitalize">Função</th>
                        <th scope="col" class="capitalize">Modulo</th>
                        <th scope="col" class="capitalize">Descição</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      //chamando modulos
                      $resultadoModulosFuncao = $conn->query($queryFuncaoModulos);

                      while ($modulosFuncao = $resultadoModulosFuncao->fetch_assoc()) {

                        //verificando se o usuáros ja possui o modulo
                        $queryModulosUser = "SELECT * FROM sisrev_usuario_funcao SF WHERE SF.id_usuario = " . $_GET['id_usuarios'] . " AND SF.id_funcao = " . $modulosFuncao['id_funcao'];
                        $resultModulosUser = $conn->query($queryModulosUser);

                        if ($modulosUser = $resultModulosUser->fetch_assoc()) {
                          $checked = 'checked';
                        } else {
                          $checked = '';
                        }

                        echo '<tr>
                                <th scope="row"><input type="checkbox" value="' . $modulosFuncao['id_funcao'] . '" name="funcao[]" id="funcao" ' . $checked . '></th>
                                <td>' . $modulosFuncao['nome'] . '</td>
                                <td>' . $modulosFuncao['modulo'] . '</td>
                                <td>' . $modulosFuncao['descricao'] . '</td>
                              </tr>';
                      }

                      ?>

                    </tbody>
                  </table>
                  <div class="text-left  mb-3">
                    <hr>
                    <button type="reset" class="btn btn-secondary">Limpar Tabela</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
                  <!-- End Table with stripped rows -->
                </form>
              </div>
            </div><!-- End Default Tabs -->

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