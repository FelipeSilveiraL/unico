<?php


if (!empty($_GET['id_post'])) {

  $idFuncao = 2;

  //buscando a postagem
  $queryPostagem .= " WHERE id_postagem = " . $_GET['id_post'];

  $resultado = $connBlog->query($queryPostagem);

  if ($postagem = $resultado->fetch_assoc()) {

    //titulo
    $titulo = $postagem['titulo'];

    //tipo da postagem
    if ($postagem['tipo_postagem'] == 0) {
      $modal = '';
      $simples = 'checked';
    } else {
      $modal = 'checked';
      $simples = '';
    }

    //data fim de visibilidade
    if ($postagem['data_drop'] == '0000-00-00') {
      $dataFIm = '<option value="2">Não</option>';
      $dataExclusao = 'none';
    } else {
      $dataFIm = '<option value="1">Sim</option>';
      $dataExclusao = 'block';
      $dataExclusaoVAlue = $postagem['data_drop'];
    }

    //arquivo da postagem
    $arquivo = "none";
    $solicitacaoArquivo = 'block';

    //alerta de comentários
    if ($postagem['alerta_comentario'] == 2) {
      $comentario = '<option value="2">Não</option>';
    } else {
      $comentario = '<option value="1">Sim</option>';
    }

    //mensagem
    $mensagem = $postagem['mensagem'];

    //botao
    $nameButao = 'Editar';

    //titulo da pagina
    $tituloPagina = "Editando Postagem";

    //menu
    $menu = '<li class="breadcrumb-item"><a href="postagens.php?pg=' . $_GET['pg'] . '">minhas postagens</a></li><li class="breadcrumb-item">' . $postagem['titulo'] . '</li>';

    //Requered Arquivo
    $requeredArquivo = '';
  }
} else {

  $idFuncao = 1;
  $dataExclusao = 'none';
  $nameButao = 'Salvar';
  $menu = '<li class="breadcrumb-item">Nova postagem</li>';
  $tituloPagina = 'Nova Postagem';
  $requeredArquivo = 'required';
}
