<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina
require_once('../funcoes/function.php'); //funcão criada para formatar a hora

$result = oci_parse($connBpmgp, $queryHorarioTrabalho);
oci_execute($result); //Sempre dar o "execute" na sequencia.
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Horário de trabalho</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Horário de trabalho</li>
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
          <div class="card-header">
            <a href="novoHorario.php?pg=<?= $_GET['pg'] ?>" class="btn btn-success buttonAdd" title="Adicionar novo horário"><i class="bx bxs-file-plus"></i></a>
          </div>
          <div class="card-body">
            <h5 class="card-title">Tabela de horários</h5>
            <p></p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">ID</th>
                  <th scope="col" class="capitalize">Empresa</th>
                  <th scope="col" class="capitalize">Departamento</th>
                  <th scope="col" class="capitalize">Segunda/Sexta</th>
                  <th scope="col" class="capitalize">Seg/Sex - Almoço</th>
                  <th scope="col" class="capitalize">Sábado</th>
                  <th scope="col" class="capitalize">Sábado - Almoço</th>
                  <th scope="col" class="capitalize">Situação</th>
                  <th scope="col" class="capitalize">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($horario = oci_fetch_array($result, OCI_ASSOC)) {

                  echo '<tr>
                          <th scope="row">' . $horario['ID_HORARIO'] . '</th>
                          <td>' . $horario['NOME_EMPRESA'] . '</td>
                          <td>' . $horario['NOME_DEPARTAMENTO'] . '</td>
                          <td>' . formatarHorario($horario['SEGUNDA_SEXTA']) . '</td>
                          <td>' . formatarHorario($horario['SEGUNDA_SEXTA_ALMOCO']) . '</td>
                          <td>' . formatarHorario($horario['SABADO']) . '</td>
                          <td>' . formatarHorario($horario['SABADO_ALMOCO']) . '</td>
                          <td>';

                          if($horario['SITUACAO'] == 'A'){
                            echo 'Ativo';
                            $botao = '<a href="../inc/situacao.php?pg='.$_GET['pg'].'&idHorario='.$horario['ID_HORARIO'].'&acao=1" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a>';
                          }else{
                            echo 'Desativado';
                            $botao = '<a href="../inc/situacao.php?pg='.$_GET['pg'].'&idHorario='.$horario['ID_HORARIO'].'&acao=2" title="Ativar" style="margin-top: 3px;" class="btn-success btn-sm"><i class="bi bi-check-square"></i></a>';
                          }

                  echo '</td>
                          <td>
                            <a href="novoHorario.php?pg='.$_GET['pg'].'&idHorario='.$horario['ID_HORARIO'].'" title="Editar" class="btn-primary btn-sm"><i class="bi bi-pencil"></i></a> '.$botao.'

                            
                          </td>
                        </tr>';
                }

                oci_free_statement($result);
                oci_close($connBpmgp);
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