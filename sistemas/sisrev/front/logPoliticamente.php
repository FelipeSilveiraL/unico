<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Registro de Logs do Politicamente Exposto</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="informatica.php?pg=<?= $_GET['pg'] ?>">Informática</a></li>
        <li class="breadcrumb-item"><a href="politicamente_exposto.php?pg=<?= $_GET['pg'] ?>">Politicamente Exposto</a></li>
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
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Arquivo</th>
                  <th scope="col">Data</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //chamando todas os logs de execução da tabela
                  $selectSisrevArquivo = "SELECT 
                                          SE.id,
                                          SE.caminho,
                                          SE.nome_arquivo,
                                          SE.data,
                                          SE.id_usuario,
                                          U.nome
                                      FROM
                                          sisrev_arquivo_PE SE
                                              LEFT JOIN
                                          usuarios U ON SE.id_usuario = U.id_usuario";
                  $resultSisrevArquivo = $conn->query($selectSisrevArquivo);
                  while ($rowArquivo = $resultSisrevArquivo->fetch_assoc()) {
                    echo'
                    <tr>
                      <th>'.$rowArquivo['id'].'</th>
                      <td>'.$rowArquivo['nome'].'</td>
                      <td><a href="../'. substr($rowArquivo['caminho'], 36).'" target="_blank" rel="file CSV">'.$rowArquivo['nome_arquivo'].'</a></td>
                      <td>'.date('d/m/Y H:i:s', strtotime($rowArquivo['data'])).'</td>
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