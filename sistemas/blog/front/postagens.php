<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

$queryPostagem .= '  WHERE id_post_user = ' . $_SESSION['id_usuario'] . ' order by id_postagem DESC';
$result = $connBlog->query($queryPostagem);

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Minhas postagens</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Minhas postagens</li>
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
            <a href="novaPostagem.php?pg=<?= 4 ?>" class="btn btn-success buttonAdd" title="Nova postagem"><i class="bx bxs-file-plus"></i></a>
          </div>
          <div class="card-body">
            <h5 class="card-title">Minhas postagens<span style="margin-right: 5px;"></span><i class="bi bi-journal-bookmark"></i></h5>
            <p></p>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col" class="capitalize">Título</th>
                  <th scope="col" class="capitalize">Imagem/Video</th>
                  <th scope="col" class="capitalize">Mensagem</th>
                  <th scope="col" class="capitalize">Data postagem</th>
                  <th scope="col" class="capitalize">Data exclusão</th>
                  <th scope="col" class="capitalize">Ação</th>
                </tr>
              </thead>

              <tbody>

                <?php
                while ($postagem = $result->fetch_assoc()) {
                  echo '<tr>
                  <td>' . $postagem['titulo'] . '</td>
                  <td><a href="' . $postagem['file_img'] . '" class="btn btn-outline-primary" target="_blank">Arquivo</a></td>
                  <td><a href="javascript:" data-bs-toggle="modal" data-bs-target="#ModalMensagem' . $postagem['id_postagem'] . '" class="btn btn-outline-primary">Mensagem</a></td>
                  <td>' . date('d/m/Y', strtotime($postagem['data'])) . '</td>
                  <td>' . ($postagem['data_drop'] == '0000-00-00' ? '------' : date('d/m/Y', strtotime($postagem['data_drop'])))
                    . '</td>
                  <td>
                    <a href="../../../../blog/postagem.php?id_post=' . $postagem['id_postagem'] . '"  title="Ver no blog" style="margin-top: 3px;" class="btn-primary btn-sm" target="_blank" ><i class="bi bi-eye"></i></a>';

                  if ($postagem['deletar'] == 0) { //0 = é ativo
                    echo '<a href="../inc/postagem.php?funcao=3&pg=' . $_GET['pg'] . '&id_post=' . $postagem['id_postagem'] . '" title="Desativar" style="margin-top: 3px;" class="btn-danger btn-sm"><i class="bi bi-slash-circle"></i></a>';
                  } else {
                    echo '<a href="../inc/postagem.php?funcao=4&pg=' . $_GET['pg'] . '&id_post=' . $postagem['id_postagem'] . '" title="Ativar" style="margin-top: 3px;" class="btn-success btn-sm"><i class="bi bi-check-lg"></i></a>';
                  }

                  echo '<a href="novaPostagem.php?pg=' . $_GET['pg'] . '&id_post=' . $postagem['id_postagem'] . '" title="Editar" style="margin-top: 3px;" class="btn-primary btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="../inc/postagem.php?funcao=5&pg=' . $_GET['pg'] . '&id_post=' . $postagem['id_postagem'] . '" title="Excluir" style="margin-top: 3px;" class="btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>

                <div class="modal fade" id="ModalMensagem' . $postagem['id_postagem'] . '" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">' . $postagem['titulo'] . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        ' . caracteres($postagem['mensagem']) . '       
                        </div>
                    </div>
                </div>
            </div>';  /* End Basic Modal */
                }

                ?>

              </tbody>

            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>