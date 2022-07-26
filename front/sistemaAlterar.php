<?php
session_start();

require_once('../config/databases.php'); //Banco de dados
require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
require_once('head.php'); //CSS e configurações HTML
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina

if(!empty($_GET['id_sistema'])){
  $querySistema .= " WHERE id = " . $_GET['id_sistema'];
  $resultSistema = $conn->query($querySistema);
  
  $sistema = $resultSistema->fetch_assoc();

  $acao = '2';
}else{
  $acao = '1';
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Sistemas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item"><a href="sistema.php?pg=<?=$_GET['pg']?>&conf=<?=$_GET['conf']?>">Sistema</a></li>
        <li class="breadcrumb-item"><?= $_GET['acao'] == 1 ? "Novo" : "Editando" ?></li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php require_once('../inc/mensagens.php') ?>
  <!-- Alertas -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">

            <form action="../inc/sistemaAlterar.php?pg=<?= $_GET['pg'] ?>&conf=<?= $_GET['conf'] ?>&id_sistema=<?= $sistema['id'] ?>&acao=<?= $acao ?>" method="post">
              <h5 class="card-title">Informações</h5>
              <div class="row mb-3">
                <label for="nome" class="col-md-4 col-lg-3 col-form-label">Nome:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="nome" type="text" class="form-control" id="nome" value="<?= $sistema['nome'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="endereco" class="col-md-4 col-lg-3 col-form-label">Link:</label>
                <div class="col-md-8 col-lg-9">
                  <input name="endereco" type="endereco" class="form-control" id="endereco" value="<?= $sistema['endereco'] ?>">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-md-4 col-lg-3 col-form-label">Variaveis GET:</label>
                <div class="col-md-8 col-lg-9">
                  <?php
                  $queryVariaveis = "SHOW COLUMNS FROM usuarios";
                  $result = $conn->query($queryVariaveis);

                  while ($variavel = $result->fetch_assoc()) {
                    echo '<div class="form-check">
                            <input class="form-check-input" type="checkbox" value="' . $variavel['Field'] . '" id="gridCheck' . $variavel['Field'] . '" name="variavel[]"';
                              $queryMVariaveis = "SELECT * FROM cad_variaveis_sistemas where variavel = '".$variavel['Field']."' and id_sistema = '".$_GET['id_sistema']."'";
                              $resultado = $conn->query($queryMVariaveis);
                              $mVariaveis = $resultado->fetch_assoc();
                              if (!empty($mVariaveis['id'])) {
                                echo 'checked';
                              }
                            echo '>
                            <label class="form-check-label" for="gridCheck' . $variavel['Field'] . '">
                            ' . $variavel['Field'] . '
                            </label>
                          </div>';
                  }
                  ?>
                </div>
              </div>
              <div class="modal-footer">
                <a href="sistema.php?pg=<?=$_GET['pg']?>&conf=<?=$_GET['conf']?>" class="btn btn-secondary">Voltar</a>
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
require_once('footer.php'); //Javascript e configurações afins
?>