<?php
session_start();

$querySenhaBPM = "SELECT * FROM cad_senhaBPM WHERE id_usuario = " . $_SESSION['id_usuario'];
$result = $connNOTAS->query($querySenhaBPM);

if (!$senhaFluig = $result->fetch_assoc()) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                Preciso que você me informe um usuário para lançarmos as notas no <code>SMARTSHARE</code>: <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalPerfil">Cadastrar Usuário</button>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

    require_once('../front/footer.php');
    exit;
}