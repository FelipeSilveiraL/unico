<?php
require_once('../inc/paginacao.php');

if(empty($_GET['id_sistema'])){
    $where =  ' WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_sistema IS NULL';
}else{
    $where =  ' WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_sistema = '.$_GET['id_sistema'];
}

$querySistemaCores .=  $where;
$resultado = $conn->query($querySistemaCores);
$coressistema = $resultado->fetch_assoc();

?>

<aside id="sidebar" class="sidebar" style="background-image: linear-gradient(to bottom, #fff 73%, <?= $coressistema['color']?> 100%);">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Sistemas</li>

        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 1 ?: "collapsed" ?>" href="../index.php?pg=1">
                <i class="bi bi-grid"></i>
                <span>Meus Sistemas</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <hr>

        <li class="nav-heading">Paginas</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:" data-bs-toggle="modal" data-bs-target="#ModalPerfil">
                <i class="bi bi-person"></i>
                <span>Meu perfil</span>
            </a>
        </li>

        <li class="nav-item" style="display: <?= $_SESSION['administrador'] == 1 ? "block" : "none" ?>;">

            <a class="nav-link  <?= $_GET['pg'] == 2 ?: "collapsed" ?>" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Configurações</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="usuarios.php?pg=<?= $_GET['pg'] ?>&conf=1" <?= $_GET['conf'] == 1 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Lista Usuários</span>
                    </a>
                </li>
                <li>
                    <a href="dropdowns.php?pg=<?= $_GET['pg'] ?>&conf=2" <?= $_GET['conf'] == 2 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Menu suspenso</span>
                    </a>
                </li>
                <li>
                    <a href="sistema.php?pg=<?= $_GET['pg'] ?>&conf=3" <?= $_GET['conf'] == 3 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Sistemas</span>
                    </a>
                </li>
                <li>
                    <a href="api.php?pg=<?= $_GET['pg'] ?>&conf=4" <?= $_GET['conf'] == 4 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>API</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link  <?= $_GET['pg'] == 3 ?: "collapsed" ?>" href="ajuda.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>
        </li>
    </ul>
</aside><!-- End Sidebar-->