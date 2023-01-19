<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
  <div class="container" style="display: <?= $_GET['back'] == 1 ? 'none' : 'block' ?>;">
    <form id="salvarNota" method="POST" action="enviarAnexo.php?enviarArquivo=1&idAnexo=<?= $_GET['idAnexo'] ?>&idNota=<?= $_GET['idNota'] ?>" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="endereco" class="form-label">Insira a Nota</label>
        <input type="file" class="form-control" id="endereco" name="anexo">
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
  <div class="container" style="display: <?= $_GET['back'] == 1 ? 'block' : 'none' ?>;">
    <span>Nota Enviada com sucesso!</span>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</html>