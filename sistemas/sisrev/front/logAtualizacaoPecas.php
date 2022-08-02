<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Registro de Logs do Atualização de Peças</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="pecas.php?pg=<?= $_GET['pg'] ?>">Peças</a></li>
        <li class="breadcrumb-item"><a href="atualizarPreco.php?pg=<?= $_GET['pg'] ?>">Atualizar peças</a></li>
        <li class="breadcrumb-item">Registros</li>
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
            <h5 class="card-title">Logs Anteriores</h5>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Usuário</th>
                  <th scope="col">Empresa</th>                  
                  <th scope="col">Ação</th>
                  <th scope="col">Usado para atualização</th>
                  <th scope="col">Atualizado preço valor menor?</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody>
                <?php
                //chamando todas os logs de execução da tabela
                $selectSisrevArquivo = "SELECT 
                                          SE.id,
                                          SE.id_empresa,
                                          SE.caminho,
                                          SE.nome_arquivo,
                                          SE.data,
                                          SE.id_usuario,
                                          SE.relatorio,
                                          SE.forcado,
                                          U.nome
                                      FROM
                                        sisrev_arquivo_ap SE
                                              LEFT JOIN
                                          usuarios U ON SE.id_usuario = U.id_usuario ORDER BY SE.id DESC";
                $resultSisrevArquivo = $conn->query($selectSisrevArquivo);
                while ($rowArquivo = $resultSisrevArquivo->fetch_assoc()) {
                  echo '
                    <tr>
                      <td>' . $rowArquivo['nome'] . '</td>
                      <td>';
                          switch ($rowArquivo['id_empresa']) {
                            case '56':
                              echo 'Ducati';
                              break;
                            case '55':
                              echo 'Triumph';
                              break;
                            case '10':
                              echo 'Honda';
                              break;
                          }
                  echo '</td>
                      <td>'; echo ($rowArquivo['relatorio'] == 1) ? 'Apenas Gerou Relatório' : 'Executou a Atualização'; echo '</td>

                      <td>'; echo ($rowArquivo['id_empresa'] == 10 ) ?  $rowArquivo['nome_arquivo'] : '<a href="../' . substr($rowArquivo['caminho'], 36) . '" target="_blank" rel="file CSV">' . $rowArquivo['nome_arquivo'] . '</a>'; echo '</td>
                      <td>'; if($rowArquivo['forcado'] == 2){ echo 'NÂO';}elseif($rowArquivo['forcado'] == 1 ){ echo 'SIM';}else{echo 'Não existe informação';} echo '</td>
                      <td>' . date('d/m/Y H:i:s', strtotime($rowArquivo['data'])) . '</td>
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

  <!--################# section TERMINA AQUI #################-->

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>