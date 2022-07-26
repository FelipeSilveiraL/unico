<?php
session_start();

require_once('../config/databases.php'); //Banco de dados
require_once('../config/query.php'); //Todas as pesquisas de banco
require_once('administrador.php'); //regra de perfis
require_once('head.php'); //CSS e configurações HTML
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Sistemas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Sistema</li>
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
            <h5 class="card-title">Tabelas usuários
              <a href="sistemaAlterar.php?pg=<?=$_GET['pg']?>&conf=<?=$_GET['conf']?>&acao=1" class="btn btn-success button-rigth-card" title="Novo Sistema"><i class="bi bi-plus"></i></a>
            </h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Endereço</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //chamando sistemas
                $querySistema .= " WHERE deletar = 0";

                $resultado = $conn->query($querySistema);

                while ($sistemas = $resultado->fetch_assoc()) {
                  echo '<tr>
                          <th scope="row">' . $sistemas['id'] . '</th>
                          <td>' . $sistemas['nome'] . '</td>
                          <td>' . $sistemas['endereco'] . '</td>
                          <td>
                          <a href="#" title="Ver variáveis" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal' . $sistemas['id'] . '">
                              <i class="bi bi-eye"></i>
                            </a> 
                            <a href="sistemaAlterar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_sistema=' . $sistemas['id'] . '&acao=2" title="Editar" class="btn btn-primary btn-sm">
                              <i class="bi bi-pencil"></i>
                            </a> 
                            <a href="../inc/sistemaAlterar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_sistema=' . $sistemas['id'] . '&acao=3" title="Excluir" class="btn btn-danger btn-sm">
                              <i class="bi bi-trash"></i>
                            </a>
                          </td>
                        </tr>

                        <div class="modal fade" id="basicModal' . $sistemas['id'] . '" tabindex="-1">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Variáveis via GET</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="card-body">
                                  <!-- List group With Icons -->
                                  <ul class="list-group">';
                  $queryVariaveisSistema = "SELECT * FROM cad_variaveis_sistemas WHERE id_sistema = " . $sistemas['id'];
                  $resultadoVariaveis = $conn->query($queryVariaveisSistema);

                  while ($variaveis = $resultadoVariaveis->fetch_assoc()) {
                    echo '<li class="list-group-item uppercase"><i class="bi bi-bookmark-check me-1 text-success"></i>' . $variaveis['variavel'] . "</li>";
                  }

                  echo '      </ul><!-- End List group With Icons -->
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <a href="sistemaAlterar.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&id_sistema=' . $sistemas['id'] . '&acao=2" class="btn btn-primary">Editar</a>
                              </div>
                            </div>
                          </div>
                        </div>';
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
</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>