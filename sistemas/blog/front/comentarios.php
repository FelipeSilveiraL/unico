<?php
require_once('head.php'); //CSS e configurações HTML e session start
require_once('header.php'); //logo e login e banco de dados
require_once('menu.php'); //menu lateral da pagina

$queryPostagem  .= ' WHERE alerta_comentario = 1 and id_post_user = ' . $_SESSION['id_usuario']; // 1 = recebe alerta; 2 = não recebe o alerta
$result = $connBlog->query($queryPostagem);

$queryInicial = $queryComentario;
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Comentários</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?pg=1">Home</a></li>
        <li class="breadcrumb-item">Comentários</li>
      </ol>
    </nav>
  </div><!-- End Navegação -->

  <?php
  require_once('../../../inc/mensagens.php'); //Alertas
  ?>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comentários<span style="margin-right: 4px;"></span><i class="bx bx-message-rounded-detail"></i></a></h5>

      <?php
      while (($postagem = $result->fetch_assoc())) {

        echo ' <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $postagem['id_postagem'] . '" aria-expanded="true" aria-controls="collapse' . $postagem['id_postagem'] . '">
              Titulo da postagem: &nbsp;<b> ' . $postagem['titulo'] . '</b>
            </button>            
          </h2>

          <div id="collapse' . $postagem['id_postagem'] . '" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';

        $queryComentario .= ' WHERE id_postagem = ' . $postagem['id_postagem'];

        $resultado = $connBlog->query($queryComentario);

        while ($comentario = $resultado->fetch_assoc()) {

          $lido = $comentario['avisado_responsavel'] == 1 ? 'btn-success' : 'btn-dark';

          echo '<div class="accordion-body">
            <ul class="list-group">

              <li class="list-group-item list-group-item-primary">
                <strong>Nome:</strong> <em>' . $comentario['nome'] . '</em>
                <span style="margin-left: 10px;"></span>
                <strong>Empresa:</strong> <em>' . $comentario['nome_empresa'] . '</em>
                <span style="margin-left: 10px;"></span>
                <strong>Departamento:</strong> <em>' . $comentario['nome_departamento'] . '</em>
                <span style="margin-left: 10px;"></span>
                <strong>Data:</strong> <em>' . date('d/m/Y', strtotime($comentario['data'])) . '</em>
              </li>

              <li class="list-group-item disabled">
                <span style="margin-right: 4px;"></span>
                <i class="bx bx-message-rounded-detail"></i>&nbsp; ' . $comentario['comentario'] . '
              </li>
              <li class="list-group-item text-end">
                <span>
                  <a href="javascript:" title="Não lido" id="botaoLer' . $comentario['id_comentario'] . '" class="' . $lido . ' btn-sm">
                      <i class="bi bi-check-square"></i>
                    </a>
                </span>
                &nbsp;
                <span>
                <a href="../inc/postagem.php?funcao=5&pg=' . $_GET['pg'] . '&id_comentario=' . $comentario['id_comentario'] . '" title="excluir comentário" class="btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                    </a>
                </span>                
              </li>

            </ul>

          </div>

          <script>

            $("#botaoLer' . $comentario['id_comentario'] . '").on("click", function(){
              var Idcomentario = ' . $comentario['id_comentario'] . ';
            
              $.ajax({
                url: "../inc/postagem.php?funcao=6",
                type: "POST",
                data: {id: Idcomentario},
                
                success: function(data){

                  var elemento = document.getElementById("botaoLer' . $comentario['id_comentario'] . '");
            
                  // Remove a classe atual, se necessário
                  elemento.classList.remove("btn-dark");
            
                  // Adiciona a nova classe desejada
                  elemento.classList.add("btn-success");
                }

              });

            })
          </script>';
        }
        echo '
          </div>
        </div>
      </div>';

        $queryComentario = $queryInicial;
      }
      ?>

    </div>
  </div>

</main><!-- End #main -->

<?php
require_once('footer.php'); //Javascript e configurações afins
?>