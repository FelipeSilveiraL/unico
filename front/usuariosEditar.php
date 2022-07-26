<?php
session_start();
require_once('../config/databases.php');
require_once('../config/query.php');
require_once('administrador.php');
require_once('head.php');

$queryUsuarios .= "WHERE U.id_usuario = " . $_GET['id_usuario'];
$resultUsuario = $conn->query($queryUsuarios);

$usuario = $resultUsuario->fetch_assoc();
?>

<main id="main" class="main" style="margin-top: -19px;">

  <?php require_once('../inc/mensagens.php') ?><!-- Alertas -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <form action="../inc/usuarioEditar.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&id_usuario=<?= $usuario['id_usuario'] ?>" method="post">
              <h5 class="card-title">Principal</h5>
              <div class="row mb-3">
                <label for="nomeUsuario" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="nomeUsuario" type="text" class="form-control" id="nomeUsuario" value="<?= $usuario['nome_usuario'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="email" class="col-md-4 col-lg-3 col-form-label">E-mail:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="email" type="email" class="form-control" id="email" value="<?= $usuario['email'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="cpf" class="col-md-4 col-lg-3 col-form-label">CPF:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="cpf" type="text" class="form-control" id="cpf" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" onblur="ValidarCPF(this)" value="<?= $usuario['cpf'] ?>" required="">
                </div>
              </div>


              <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="margin-right: 72px;">Empresa:</label>
                <div class="col-sm-8">
                  <select class="form-select" name="empresa">
                    <option value="<?= $usuario['id_empresa'] ?>" selected=""><?= $usuario['empresa'] ?></option>
                    <option>--------</option>
                    <?php
                    $resultEmpresa = $conn->query($queryEmpresa);

                    while ($empresa = $resultEmpresa->fetch_assoc()) {
                      echo '<option value="' . $empresa['id_empresa'] . '">' . $empresa['empresa'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>


              <div class="row mb-3">
                <label class="col-sm-3 col-form-label" style="margin-right: 72px;">Departamento:</label>
                <div class="col-sm-8">
                  <select class="form-select" name="departamento">
                    <option value="<?= $usuario['id_depto'] ?>" selected=""><?= $usuario['departamento'] ?></option>
                    <option>--------</option>
                    <?php
                    $resultDepartamento = $conn->query($queryDepartamento);

                    while ($departamento = $resultDepartamento->fetch_assoc()) {
                      echo '<option value="' . $departamento['id_depto'] . '">' . $departamento['nome'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <h5 class="card-title">Login</h5>
              <div class="row mb-3">
                <label for="usuario" class="col-md-4 col-lg-3 col-form-label">Usuário:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="usuario" type="text" class="form-control" id="usuario" value="<?= $usuario['usuario'] ?>">
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
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" <?= $usuario['admin'] == 0 ? "" : "checked" ?> name="admin">
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
                            <input class="form-check-input" type="checkbox" value="'.$sistema['id'].'" id="gridCheck' . $sistema['id'] . '" name="sistemas[]"';
                    
                      $queryMeusSistemas = "SELECT id FROM cad_sis_user 
                                            WHERE id_usuario = ".$usuario['id_usuario']." AND id_sistema = ".$sistema['id'];
                      $resultado = $conn->query($queryMeusSistemas);
                      $meusSistemas = $resultado->fetch_assoc();
                      if(!empty($meusSistemas['id'])){
                        echo 'checked';
                      }
                      echo '>
                        <label class="form-check-label" for="gridCheck' . $sistema['id'] . '">
                        ' . $sistema['nome'] . '
                        </label>
                      </div>';
                  }
                  ?>
                </div>
              </div>
              <div class="modal-footer">
                <a href="iframeUsuarios.php" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->
<?php
require_once('footer.php');
?>