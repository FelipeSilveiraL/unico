<?php
session_start();

if ($_GET['api'] == true) {

header('Location: http://'.$_SESSION['servidorOracle'].'/unico_api/sisrev/inc/desativar_usuario.php?sistema='.$_GET['sistema'].'&cpf='.$_GET['cpf'].'&acao='.$_GET['acao'].'&pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&nome='.$_GET['nome'].'');

}
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../config/query.php'); //Dados do banco MYSQL
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Usuários Sistemas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">Departamentos</a></li>
        <li class="breadcrumb-item"><a href="informatica.php?pg=<?= $_GET['pg'] ?>">Informática</a></li>
        <li class="breadcrumb-item">Usuários Sistemas</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Busca usuários</h5>
            <!-- General Form Elements -->
            <div class="header d-flex align-items-center header-scrolled">
              <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="desativar_usuario.php?pg=<?= $_GET['pg'] ?>&saida=1">
                  <input type="text" name="cpf" placeholder="Insira cpf" title="Enter search keyword" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" required>
                  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
              </div>
            </div>
            <!-- End General Form Elements -->
          </div>
        </div>
      </div>

      <div class="col-lg-12" style="display: <?= empty($_GET['saida']) ? 'none' : 'block'; ?>">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listagem de sistemas do usuário</h5>
            <!-- Small tables -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">#</th>
                  <th scope="col" class="capitalize">Nome</th>
                  <th scope="col" class="capitalize">CPF</th>
                  <th scope="col" class="capitalize">ATIVO</th>
                  <th scope="col" class="capitalize">Sistema</th>
                  <th scope="col" class="capitalize">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($_GET['saida'] != NULL) {
                  require_once('../inc/tabelaDesativar.php');
                  if (!empty($dados)) {
                    echo $dados;
                  } else {
                    echo "<td colspan='6'>NENHUM DADO LOCALIZADO</td>";
                  }
                }
                ?>
              </tbody>
            </table>
            <!-- End small tables -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>