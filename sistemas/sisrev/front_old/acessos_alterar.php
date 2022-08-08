<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Informações das telas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="configuracao.php?pg=<?= $_GET['pg'] ?>">Configurações</a>
        </li>
        <li class="breadcrumb-item">
          <a href="telas_funcoes.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>">Telas</a>
        </li>
        <li class="breadcrumb-item">Adicionar nova tela</li>
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

            <?php
              if ($_GET['id'] != NULL) {
                $queryAcessos .= ' WHERE id = '.$_GET['id'].'';
                $execAcessos = $conn->query($queryAcessos);
                while ($row = $execAcessos->fetch_assoc()) {                     
                  $valueNome = $row['nome'];
                  $valueEndereço = $row['endereco'];
                }
              } else {
                $valueNome = '';
                $valueEndereço = '';
              }
            ?>

            <form action="../inc/acessos_alterar.php?pg=<?=$_GET['pg']?>&tela=<?=$_GET['tela']?>&acao=<?=$_GET['acao']?>&id=<?=$_GET['id']?>" method="post">
              <h5 class="card-title">Informações</h5>
              <div class="row mb-3">
                <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="nome" type="text" class="form-control" id="nome" value="<?= $valueNome ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Endereço:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="endereco" type="endereco" class="form-control" id="endereco" value="<?= $valueEndereço ?>">
                </div>
              </div>
              <div class="modal-footer">
                <a href="telas_funcoes.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>

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