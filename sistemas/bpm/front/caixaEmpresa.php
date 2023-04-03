<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../inc/apiRecebeCaixaEmpresa.php'); //recebe os dados da api e insere no banco de dados
require_once('../config/query.php');
/* Essa opção descomentar após criar em telas_funcoes.php*/
//echo $_GET['pg'] == '5' ?'': ' <script>window.location.href = "index.php";</script>';
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>CAIXA EMPRESA</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=<?= $_GET['pg'] ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="departamentos.php?pg=<?= $_GET['pg'] ?>">DEPARTAMENTOS</a></li>
        <li class="breadcrumb-item">CAIXA EMPRESA</li>
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
          <div class="card-header">
            <a href="novaRegraCxEmpresa.php?pg=<?= $_GET['pg'] ?>" type="button" class="btn btn-success buttonAdd" title="Importar Usuários" <?= $usuarioFuncao ?>><i class="bi bi-plus-lg"></i></a>
          </div><br>
          <div class="card-body">
            
          <h5 class="card-title"> Caixa empresa</h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">ID CAIXA EMPRESA</th>
                  <th scope="col" class="capitalize">EMPRESA</th>
                  <th scope="col" class="capitalize">CAIXA</th>
                  <th scope="col" class="capitalize">NÚMERO CAIXA</th>
                  <th scope="col" class="capitalize" <?= $usuarioFuncao ?>>AÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $cxEmpresaQuery = "SELECT * FROM bpm_caixa_empresa ORDER BY ID_CAIXA_EMPRESA ASC";

                $resultado = $conn->query($cxEmpresaQuery);

                while ($row = $resultado->fetch_assoc()) {
                  $id = $row['ID_EMPRESA'];
                  $dado = $row['id'];
                  $caixaEmpresa = $row['ID_CAIXA_EMPRESA'];
                  $nomeCaixa = $row['NOME_CAIXA'];
                  $numeroCaixa = $row['NUMERO_CAIXA_SISTEMA'];

                    $nomeEmpresa = "SELECT NOME_EMPRESA FROM bpm_empresas WHERE ID_EMPRESA = " . $row['ID_EMPRESA'];
                    $a = $conn->query($nomeEmpresa);
                    if ($empresa = $a->fetch_assoc()) {
                      $nomeEmpresa = $empresa['NOME_EMPRESA'];
                    }
                  echo '<tr>
                  <td>' . $caixaEmpresa . '</td>
                  <td>' . $nomeEmpresa . '</td>
                  <td>' . $row["NOME_CAIXA"] . '</td>
                  <td>' . $numeroCaixa . '</td>
                  <td><a href="editCxEmpresa.php?pg='.$_GET['pg'].'&id='.$caixaEmpresa.'"  title="Editar" class="btn-primary btn-sm" ' . $usuarioFuncao . '><i class="bi bi-pencil"></i></a>
                            
                  <a href="http://' . $_SESSION['servidorOracle'] . '/' . $_SESSION['smartshare'] . '/bd/deletarCxEmpresa.php?pg=' . $_GET['pg'] . '&id_empresa=' . $id . '&nomeCaixa='.$nomeCaixa.'&id_caixa_empresa='.$dado.'" title="Desativar" class="btn-danger btn-sm" ' . $usuarioFuncao . '><i class="bi bi-trash"></i></a></td>';
                  
                  echo '</tr>';

          
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