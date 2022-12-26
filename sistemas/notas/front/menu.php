<?php
require_once('../inc/paginacao.php'); //pg 
require_once('../inc/administrador.php'); //regra de perfis
$querySistemaCores .=  ' WHERE id_usuario = ' . $_SESSION['id_usuario'] . ' AND id_sistema = ' . $_SESSION['id_sistema'];
$resultado = $conn->query($querySistemaCores);
if (!$coressistema = $resultado->fetch_assoc()) {
    $color = "#fff";
} else {
    $color = $coressistema['color'];
}
?>


<aside id="sidebar" class="sidebar" style="background-image: linear-gradient(to bottom, #fff 73%, <?= $color ?> 100%);">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 1 ?: "collapsed" ?>" href="index.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <hr>
        <li class="nav-heading">Notas</li>
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 2 ?: "collapsed" ?>" href="lancamento.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-file-arrow-up"></i>
                <span>Lançamento Manual</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">

            <a class="nav-link <?= $_GET['pg'] == 3 ?: "collapsed" ?>" data-bs-target="#cadastro-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-text"></i><span>Cadastros</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cadastro-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="fornecedor.php" <?= $_GET['tela'] == 3 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Rateio Fornecedor</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="#" <?= $_GET['tela'] == 4 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Fornecedores catalogados(Robô)</span>
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 1 ?: "collapsed" ?>" href="index.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-clipboard-data"></i>
                <span>Relatório</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <hr>
        <li class="nav-heading">Paginas</li>
        <li class="nav-item" style="display: <?= $_SESSION['administrador'] == 1 ? 'block' : 'none' ?>">
            <a class="nav-link <?= $_GET['pg'] == 4 ?: "collapsed" ?>" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Configurações</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="config-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="espelhar_usuarios.php?pg=<?= $_GET['pg'] ?>&tela=2" <?= $_GET['tela'] == 2 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Usuários</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link  <?= $_GET['pg'] == 5 ?: "collapsed" ?>" href="ajuda.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda?</span>
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" href="../../../index.php">
                <i class="bi bi-arrow-bar-left"></i>
                <span>Voltar</span>
            </a>
        </li>
    </ul>
</aside><!-- End Sidebar-->