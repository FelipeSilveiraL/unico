<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/contagemStatus.php');
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Dashboard</a></li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../inc/status.php');
  require_once('../../../inc/mensagens.php'); //Alertas
  require_once('../inc/senhaBPM.php'); //validar se possui senha cadastrada 
  ?>

  <section>
    <div class="row">
      <div class="col-lg-3 py-2">
        <a href="index.php?pg=<?= $_GET['pg'] ?>&status=1" class="list-group-item-action" title="Mostrar notas com este status">
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Lançando</h4>
            <hr>
            <p class="mb-0">Quantidade: <?= $countLancando['countLancando'] ?></p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 py-2">
        <a href="index.php?pg=<?= $_GET['pg'] ?>&status=3" class="list-group-item-action" title="Mostrar notas com este status">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Lançadas</h4>

            <hr>
            <p class="mb-0">Quantidade: <?= $countLancado['countLancado'] ?></p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 py-2">
        <a href="index.php?pg=<?= $_GET['pg'] ?>&status=2" class="list-group-item-action" title="Mostrar notas com este status">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Pendentes</h4>

            <hr>
            <p class="mb-0">Quantidade: <?= $countPendentes['countPendentes'] ?></p>
          </div>
        </a>
      </div>
      <div class="col-lg-3 py-2">
        <a href="index.php?pg=<?= $_GET['pg'] ?>&status=erro" class="list-group-item-action" title="Mostrar notas com este status">
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Erros</h4>

            <hr>
            <p class="mb-0">Quantidade: <?= $countErros['countErros'] ?></p>
          </div>
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title"><?= $nomeTabela ?></h5>


            <table class="table table-borderless datatable">
              <thead>
                <tr class="capitalize">
                  <th scope="col">empresa&emsp;</th>
                  <th scope="col">fornecedor&emsp;</th>
                  <th scope="col">valor&emsp;</th>
                  <th scope="col">emissao</th>
                  <th scope="col">vencimento&emsp;</th>
                  <th scope="col">smartShare&emsp;</th>
                  <th scope="col">status&emsp;</th>
                  <th scope="col">ação&emsp;</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $color = array('bg-primary' => 1, 'bg-warning' => 2, 'bg-success' => 3);

                while ($notas = $resultado->fetch_assoc()) {
                  $value = array_search($notas['id_status'], $color);
                  echo '<tr>                          
                            <td>' . $notas['empresa'] . '</td>
                            <td>' . $notas['fornecedor'] . '</td>
                            <td>R$ ' . $notas['valor_nota'] . '</td>
                            <td>' . date('d/m/y', strtotime($notas['emissao'])) . '</td>
                            <td>' . date('d/m/y', strtotime($notas['vencimento'])) . '</td>
                            <td><a target="_blank" href="https://gruposervopa.fluig.com/portal/p/1/pageworkflowview?app_ecm_workflowview_detailsProcessInstanceID=' . $notas['numero_fluig'] . '">' . $notas['numero_fluig'] . '</a></td>
                            <td><span class="badge ';
                  echo empty($value) ? "bg-danger" : $value;
                  echo '">' . $notas['status'] . '</span></td>
                            <td>
                              <a href="editLancarnota.php?id=' . $notas['id_lancarnotas'] . '" title="Editar" class="btn-primary btn-sm"><i class="bi bi-pencil"></i></a>

                              <a href="javascript:" title="Anexos" class="btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#smallModal' . $notas['id_lancarnotas'] . '"><i class="bi bi-file-earmark-pdf"></i></a>
                              
                              <a href="../inc/deletarLancamento.php?id=' . $notas['id_lancarnotas'] . '" title="Excluir" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                          </tr>

                          <!-- Small Modal-->
                          <div class="modal fade" id="smallModal' . $notas['id_lancarnotas'] . '" tabindex="-1">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Anexos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">                                
                                ';

                  $queryAnexos = "SELECT * FROM cad_anexos WHERE ID_LANCARNOTA = " . $notas['id_lancarnotas'];
                  $aplicaAnexos = $connNOTAS->query($queryAnexos);
                  while ($anexos = $aplicaAnexos->fetch_assoc()) {

                    $tipo = substr($anexos['url_nota'], 11, 1);

                    if ($tipo == 'n') {

                      echo '<p><code><u>Nota Fiscal:</u></code> <a href="../' . $anexos['url_nota'] . '" target="_blank">' . substr($anexos['url_nota'], 29) . '</a></p>';
                    } else {

                      echo '<p><code><u>Boleto:</u></code> <a href="../' . $anexos['url_nota'] . '" target="_blank">' . substr($anexos['url_nota'], 31) . '</a></p>';
                    }
                  }
                  echo '</div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div><!-- End Small Modal-->';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- End Recent Sales -->
    </div>

  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>