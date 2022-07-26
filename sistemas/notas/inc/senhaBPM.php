<?php
//cadastrando senha
if($_GET['bpm'] == 1){
    $insertBPM = "INSERT INTO cad_senhaBPM (ID_USUARIO, senha_fluig, usuario_fluig) 
                    VALUES ('".$_SESSION['id_usuario']."', '".$_POST['senhaBPM']."', '".$_POST['usuarioBPM']."')";
    $result = $connNOTAS->query($insertBPM);    
}

$querySenhaBPM = "SELECT * FROM cad_senhaBPM WHERE ID_USUARIO = " . $_SESSION['id_usuario'];
$result = $connNOTAS->query($querySenhaBPM);

if (!$senhaFluig = $result->fetch_assoc()) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Preciso que você me informe um usuário para lançarmos as notas no <code>' . $_SESSION['nome_bpm'] . '</code>: <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#senhaFluig">Cadastrar Usuário</button>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="modal fade" id="senhaFluig" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrando usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> 
                   
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3" action="../front/index.php?bpm=1" method="post">
                                <h5 class="card-title capitalize">Credenciais do ' . $_SESSION['nome_bpm'] . ' </h5>
                                <div class="form-floating mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Tipo de serviço" name="usuarioBPM" required>
                                    <label for="floatingSelect">Usuário</label>
                                </div>
                                <div class="form-floating mb-3 col-md-6">
                                    <input type="password" class="form-control" placeholder="Tipo de serviço" name="senhaBPM" required>
                                    <label for="floatingSelect">Senha</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Basic Modal-->';

    require_once('../front/footer.php');
    exit;
}