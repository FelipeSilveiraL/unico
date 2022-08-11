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
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a></li>
        <li class="breadcrumb-item"><a href="usuarios.php?pg=<?= $_GET['pg'] ?>">Usuários</a></li>
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
                <button class="nav-link active" id="modulos-tab" data-bs-toggle="tab" data-bs-target="#modulos" type="button" role="tab" aria-controls="modulos" aria-selected="true">Módulos</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="submodulos-tab" data-bs-toggle="tab" data-bs-target="#submodulos" type="button" role="tab" aria-controls="submodulos" aria-selected="true">Sub-módulos</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="funcoes-tab" data-bs-toggle="tab" data-bs-target="#funcoes" type="button" role="tab" aria-controls="funcoes" aria-selected="false">Funções</button>
              </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">

              <!--MODULOS-->
              <div class="tab-pane fade show active" id="modulos" role="tabpanel" aria-labelledby="modulos-tab">
                <form action="../inc/usuariosPermissoes.php?pg=<?= $_GET['pg'] ?>&id_usuarios=<?= $_GET['id_usuarios'] ?>&acao=1" method="post">
                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="capitalize">#</th>
                        <th scope="col" class="capitalize">Módulo</th>
                        <th scope="col" class="capitalize">endereço</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        //chamando modulos
                        $queryModulos .= " WHERE sub_modulo = 0 AND localizacao not in (0) AND deletar = 0";
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
              
              <!--SUB-MODULOS-->
              <div class="tab-pane fade show" id="submodulos" role="tabpanel" aria-labelledby="submodulos-tab">
                <form action="../inc/usuariosPermissoes.php?pg=<?= $_GET['pg'] ?>&id_usuarios=<?= $_GET['id_usuarios'] ?>&acao=3" method="post">

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="capitalize">#</th>
                        <th scope="col" class="capitalize">Sub-módulo</th>
                        <th scope="col" class="capitalize">Módulo</th>
                        <th scope="col" class="capitalize">endereço</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                          //chamando modulos
                          $queryModulosS = "SELECT * FROM sisrev_modulos WHERE sub_modulo not in (0) AND deletar = 0";
                          $resultadoModulosS = $conn->query($queryModulosS);

                          while ($modulosS = $resultadoModulosS->fetch_assoc()) {

                            //verificando se o usuáros ja possui o modulo
                            $queryModulosUserS = "SELECT * FROM sisrev_usuario_modulo SM WHERE SM.id_usuario = " . $_GET['id_usuarios'] . " AND SM.id_modulo = " . $modulosS['id'];
                            $resultModulosUserS = $conn->query($queryModulosUserS);

                            if ($modulosUserS = $resultModulosUserS->fetch_assoc()) {
                              $checked = 'checked';
                            } else {
                              $checked = '';
                            }
                            echo '<tr>
                                    <th scope="row"><input type="checkbox" value="' . $modulosS['id'] . '" name="modulo[]" id="modulo" ' . $checked . '></th>
                                    <td>' . $modulosS['nome'] . '</td>';
                                    $d = "SELECT nome FROM sisrev_modulos WHERE id = ".$modulosS['sub_modulo'];
                                    $e = $conn->query($d);
                                    $nomeModulo = $e->fetch_assoc();
                                    echo '<td>'.$nomeModulo['nome'].'</td>';
                              echo '<td>' . $modulosS['endereco'] . '</td>
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
              <!--FUNÇÕES-->
              <div class="tab-pane fade show" id="funcoes" role="tabpanel" aria-labelledby="funcoes-tab">
                <form action="../inc/usuariosPermissoes.php?pg=<?= $_GET['pg'] ?>&id_usuarios=<?= $_GET['id_usuarios'] ?>&acao=2" method="post">

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="capitalize">#</th>
                        <th scope="col" class="capitalize">Função</th>
                        <th scope="col" class="capitalize">Tela</th>
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