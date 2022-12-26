<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo, login e config
require_once('menu.php'); //menu lateral da pagina
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Usuários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a></li>
        <li class="breadcrumb-item">Usuários</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>
  <section class="section" <?= $_GET['idUsuario'] == null ? 'style="display: block"' : 'style="display: none"' ?>>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lista usuários</h5>
            <h6>
              <button type="button" class="btn btn-success button-rigth-espelho" data-bs-toggle="modal" data-bs-target="#basicModal" style="display: <?= !empty($_GET['idUsuario']) ? 'inline-block' : 'none' ?>;">
                <i class="bi bi-person-plus-fill"></i>
              </button>
              <p>Nesta tela só é permitido fazer espelhamento dentre os usuários.</p>
              <p> Caso seja necessario mudar outras informações como por exemplo; usuário, senha, etc... Basta clicar neste icone <a href="../../../front/usuarios.php?pg=2&conf=1" target="_blank" class="btn btn-info btn-sm"><i class="ri-user-settings-line"></i></a></p>
            </h6>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">id</th>
                  <th scope="col" class="capitalize">usuário</th>
                  <th scope="col" class="capitalize">e-mail</th>
                  <th scope="col" class="capitalize">cpf</th>
                  <th scope="col" class="capitalize">ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $queryUsuarios .= " WHERE U.deletar = 0";

                $resultadoUsuarios = $conn->query($queryUsuarios);

                while ($usuarios = $resultadoUsuarios->fetch_assoc()) {
                  echo '<tr>
                              <th scope="row">' . $usuarios['id_usuario'] . '</th>
                              <td>' . $usuarios['nome_usuario'] . '</td>
                              <td>' . $usuarios['email'] . '</td>
                              <td>' . $usuarios['cpf'] . '</td>
                              <td>
                                <a href="espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&idUsuario=' . $usuarios['id_usuario'] . '" title="Configurações" class="btn btn-primary btn-sm"><i class="ri-user-settings-line"></i></a>
                              </td>
                            </tr>';
                } //fim while 
                ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <section <?= $_GET['idUsuario'] != null ? 'style="display: block"' : 'style="display: none"' ?>>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lista usuários</h5>
            <h6>
              <p>Nesta tela só é permitido fazer espelhamento dentre os usuários.</p>
              <p> Caso seja necessario mudar outras informações como por exemplo; usuário, senha, etc... Basta clicar neste icone <a href="../../../front/usuarios.php?pg=2&conf=1" target="_blank" class="btn btn-info btn-sm"><i class="ri-user-settings-line"></i></a></p>
            </h6>
            <!-- Table with stripped rows -->
            <form action="../inc/espelhar_usuarios.php?pg=<?= $_GET['pg'] ?>&idUsuario=<?= $_GET['idUsuario'] ?>&acao=1" method="post" id="espelharusuario">
              <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" name="idUsuarioadicionar" required>
                  <option value="">-----------------</option>
                  <?php
                  $queryUsuariosEspe = "SELECT
                    U.id_usuario, 
                    U.nome AS nome_usuario
                    FROM
                    usuarios U WHERE U.id_usuario IN (";
                  $resultadoUsuariosRateio = $connNOTAS->query("SELECT DISTINCT id_usuario FROM cad_rateiofornecedor GROUP BY id_usuario");

                  while ($usuariosRateio = $resultadoUsuariosRateio->fetch_assoc()) {
                    $queryUsuariosEspe .= $usuariosRateio['id_usuario'] . ",";
                  }
                  $queryUsuariosEspe .= "'') ORDER BY nome ASC";


                  $resultado = $conn->query($queryUsuariosEspe);
                  while ($usuariosEspelhosRateio = $resultado->fetch_assoc()) {
                    echo '<option value="' . $usuariosEspelhosRateio['id_usuario'] . '">' . $usuariosEspelhosRateio['nome_usuario'] . '</option>';
                  }
                  ?>
                </select>
                <label for="floatingSelect">Qual usuário deseja espelhar ?</label>
              </div>
              <h6><code>Nesta lista contem apenas usuários que possui algum rateio de fornecedor cadastrado.</code></h6>
              <div class="modal-footer">
                <a href="espelhar_usuarios.php" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>
          </div>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>