<?php
session_start();

require_once('../config/databases.php');
require_once('../config/query.php');
require_once('administrador.php');
require_once('head.php');
require_once('header.php');
require_once('menu.php');

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Novo Usuário</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Configurações</li>
        <li class="breadcrumb-item"><a href="usuarios.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>">Usuários</a></li>
        <li class="breadcrumb-item active">Novo usuário</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php require_once('../inc/mensagens.php') ?><!-- Alertas -->

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
                <label class="col-sm-3 col-form-label">Empresa:</label>
                <div class="col-sm-9">
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
                <label class="col-sm-3 col-form-label">Departamento:</label>
                <div class="col-sm-9">
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
                            <input class="form-check-input" type="checkbox" value="'.$sistema['id'].'" id="gridCheck' . $sistema['id'] . '" name="sistemas[]">
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
</main><!-- End #main -->
<?php
require_once('footer.php');
?>