<?php
require_once('head.php'); //CSS e configurações HTML
require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
?>

<main id="main" class="main" style="margin-top: -19px;">

  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tabelas usuários
              <button type="button" class="btn btn-success button-rigth-card" data-bs-toggle="modal" data-bs-target="#novousuario">
                <i class="bi bi-person-plus-fill"></i>
              </button>
            </h5>
            <hr />
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Login</th>
                  <th scope="col">Depart</th>
                  <th scope="col">Empresa</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $resultUsuario = $conn->query($queryUsuarios);

                while ($usuario = $resultUsuario->fetch_assoc()) {
                  echo '                    
                      <tr>
                          <th>' . $usuario['id_usuario'] . '</th>
                          <td>' . $usuario['nome_usuario'] . '</td>
                          <td>' . $usuario['usuario'] . '</td>
                          <td>' . $usuario['departamento'] . '</td>
                          <td>' . $usuario['empresa'] . '</td>
                          <td>
                            <a href="usuariosEditar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_usuario=' . $usuario['id_usuario'] . '" title="Editar" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a>';

                  if ($usuario['deletar'] == 1) {
                    echo '
                                    <a href="../inc/ativarDesativar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_usuario=' . $usuario['id_usuario'] . '&deletar=0" title="Ativar" class="btn btn-success btn-sm">
                                      <i class="bi bi-check-square"></i>
                                    </a>';
                  } else {
                    echo '
                                    <a href="../inc/ativarDesativar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_usuario=' . $usuario['id_usuario'] . '&deletar=1" title="Desativar" class="btn btn-danger btn-sm">
                                      <i class="bi bi-trash"></i>
                                      </a>';
                  }
                  echo '
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

  <div class="modal fade" id="novousuario" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="width: 135%; margin-left: -63px;">
        <div class="modal-header">
          <h5 class="modal-title">Extra Large Modal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <section class="section">
            <div class="row">
              <div class="col-lg-12">

                <div class="card">
                  <div class="card-body">

                    <form action="../inc/usuarioNovo.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>" method="post">
                      <h5 class="card-title">Principal</h5>
                      <div class="row mb-3">
                        <label for="nomeUsuario" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="nomeUsuario" type="text" class="form-control" id="nomeUsuario" value="">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">E-mail:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="email" value="">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="cpf" class="col-md-4 col-lg-3 col-form-label">CPF:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="cpf" type="text" class="form-control" id="cpf" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" onblur="ValidarCPF(this)" value="" required="">
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" style="margin-right: 51px;">Empresa:</label>
                        <div class="col-sm-8">
                          <select class="form-select" name="empresa">
                            <option>--------</option>
                            <?php
                            $resultEmpresa = $conn->query($queryEmpresa);

                            while ($empresa = $resultEmpresa->fetch_assoc()) {
                              echo '<option value="' . $empresa['id'] . '">' . $empresa['nome'] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" style="margin-right: 51px;">Departamento:</label>
                        <div class="col-sm-8">
                          <select class="form-select" name="departamento">
                            <option>--------</option>
                            <?php
                            $resultDepartamento = $conn->query($queryDepartamento);

                            while ($departamento = $resultDepartamento->fetch_assoc()) {
                              echo '<option value="' . $departamento['id'] . '">' . $departamento['nome'] . '</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <h5 class="card-title">Login</h5>
                      <div class="row mb-3">
                        <label for="usuario" class="col-md-4 col-lg-3 col-form-label">Usuário:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="usuario" type="text" class="form-control" id="usuario" value="">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="senha" class="col-md-4 col-lg-3 col-form-label">Senha:</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="senha" type="password" class="form-control" id="senha" value="">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Trocar senha ao logar:</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="trocarSenha">
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                          </div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Administrador:</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="admin">
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                          </div>
                        </div>
                      </div>

                      <h5 class="card-title">Outras informações</h5>

                      <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Sistemas permitidos:</label>
                        <div class="col-md-8 col-lg-9">
                          <?php
                          $querySistema .= " WHERE deletar = 0";
                          $resultSistemas = $conn->query($querySistema);

                          while ($sistema = $resultSistemas->fetch_assoc()) {

                            echo '<div class="form-check">
                            <input class="form-check-input" type="checkbox" value="' . $sistema['id'] . '" id="gridCheck' . $sistema['id'] . '" name="sistemas[]">
                            <label class="form-check-label" for="gridCheck' . $sistema['id'] . '">
                            ' . $sistema['nome'] . '
                            </label>
                          </div>';
                          }
                          ?>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div><!-- End Extra Large Modal-->


</main><!-- End #main -->


<?php
require_once('footer.php'); //Javascript e configurações afins
?>