<?php
session_start();

require_once('head.php');
?>

<body class="toggle-sidebar">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="d-flex justify-content-center py-4">
                    <a href="../index.php?pg=1" class="logo d-flex align-items-center w-auto">
                      <img src="assets/img/logo.png" alt="">
                      <span class="d-none d-lg-block"><img src="../img/logo.png" id="logo"></span>
                    </a>
                  </div><!-- End Logo -->

                  <form class="row g-3 needs-validation" method="POST" action="../inc/login.php?pg=1">

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                        <input type="text" name="username" placeholder="E-mail" class="form-control" id="yourUsername" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" placeholder="Senha" class="form-control" id="password" required>
                      </div>
                    </div>
                    <?php require_once('../inc/mensagens.php'); ?>
                    <div class="col-12 py-3">
                      <button class="btn btn-primary w-100" type="submit">Entrar</button>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small mb-0">Nova conta ou esqueceu a senha</p>
                      <p class="small mb-0">Ligue para o <a href="http://<?= $_SERVER['SERVER_ADDR'] ?>/lista/filiais/index.php?dep=1,89" target="_blank">Departamento TI</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->
  <?php require_once('footer.php') ?>
</body>