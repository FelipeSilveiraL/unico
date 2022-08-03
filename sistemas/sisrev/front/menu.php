<?php
require_once('../inc/paginacao.php'); //pg 
require_once('../inc/administrador.php'); //regra de perfis

$querySistemaCores .=  ' WHERE id_usuario = ' . $_SESSION['id_usuario'] . ' AND id_sistema = ' . $_SESSION['id_sistema'];
$resultado = $conn->query($querySistemaCores);
if (!$coressistema = $resultado->fetch_assoc()) { $color = "#fff"; } else { $color = $coressistema['color']; }

if ($_GET['pg'] == 4 || $_GET['pg'] == 5 || $_GET['pg'] == 1){ $ativar = 'collapsed';}else{$ativar = '';}
?>

<aside id="sidebar" class="sidebar" style="background-image: linear-gradient(to bottom, #fff 73%, <?= $color ?> 100%);">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 1 ? "" : "collapsed" ?>" href="index.php?pg=<?= $_GET['pg'] ?>">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <hr>
        <li class="nav-heading">Módulos</li>
        <li class="nav-item">
            <a class="nav-link <?= $ativar ?>" data-bs-target="#dep-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-diagram-3"></i><span>Departamentos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dep-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="informatica.php" <?= $_GET['pg'] == 2 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Informática</span>
                    </a>
                    <a href="administracao.php"  <?= $_GET['pg'] == 3 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Administração</span>
                    </a>
                    <a href="pecas.php"  <?= $_GET['pg'] == 6 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Peças</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-heading">Paginas</li>
        <li class="nav-item" style="display: <?= $_SESSION['administrador'] == 1 ? 'block' : 'none' ?>">
            <a class="nav-link <?= $_GET['pg'] == 4 ?: "collapsed" ?>" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Configurações</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="config-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="telas_funcoes.php?pg=<?= $_GET['pg'] ?>&tela=1" <?= $_GET['tela'] == 1 ? "class='active'" : "" ?>>
                        <i class="bi bi-circle"></i><span>Cadastro modulos e funções</span>
                    </a>
                    <a href="usuarios.php?pg=<?= $_GET['pg'] ?>&tela=3" <?= $_GET['tela'] == 3 ? "class='active'" : "" ?>>
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