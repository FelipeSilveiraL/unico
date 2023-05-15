<?php
require_once('../inc/paginacao.php'); //pg

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
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <hr>
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 2 ?: "collapsed" ?> " href="postagens.php?pg=2">
                <i class="bi bi-calendar3"></i>
                <span>Minhas postagens</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 3 ?: "collapsed" ?> " href="comentarios.php?pg=3">
                <i class="bi bi-chat-dots"></i>
                <span>Comentários</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 4 ?: "collapsed" ?> " href="novaPostagem.php?pg=4">
                <i class="bi bi-envelope-open"></i>
                <span>Nova postagem</span>
            </a>
        </li>

        <hr>
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 5 ?: "collapsed" ?> " href="ajuda.php?pg=5">
                <i class="bi bi-question-circle"></i>
                <span>Ajuda</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="../../../index.php">
                <i class="bi bi-arrow-bar-left"></i>
                <span>Voltar</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->