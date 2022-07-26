<?php
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

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Logando em sua conta</h5>
                                        <p class="text-center small">mas antes, altere a sua senha por favor!</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="../inc/usuarioAlterar.php?id_usuario=<?= $_GET['id_usuario'] ?>">

                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                                                <input type="password" name="password" placeholder="Senha" class="form-control" id="password">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                                                <input type="password" name="passwordConfirm" placeholder="Confirmar senha" onblur="validarSenha('password','passwordConfirm')" class="form-control" id="passwordConfirm" required>
                                            </div>
                                        </div>
                                        <?php require_once('../inc/mensagens.php'); ?>
                                        <div class="col-12 py-3">
                                            <button class="btn btn-success w-100" type="submit">Salvar</button>
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

<script>
    function validarSenha(name1, name2) {
        var senha1 = document.getElementById(name1).value;
        var senha2 = document.getElementById(name2).value;

        if (senha1 != senha2) {
            alert('Senhas Diferentes');
            document.getElementById(name2).value = '';
        }
    }
</script>