<?php
if ($_GET['pg'] == 4 || $_GET['pg'] == 5 || $_GET['pg'] == 1) {
    $ativar = 'collapsed';
} else {
    $ativar = '';
}
?>

<aside id="sidebar" class="sidebar" style="background-image: linear-gradient(to bottom, #fff 73%, <?= $color ?> 100%);">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!--HOME-->
        <li class="nav-item">
            <a class="nav-link <?= $_GET['pg'] == 0 ? "" : "collapsed" ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        <!--MODULOS-->
        <hr>
        <li class="nav-heading">Módulos</li>
        <?php
            $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 1 and deletar = 0";
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);

                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>

        <!--TELAS-->
        <hr>
        <li class="nav-heading">Telas</li>
        <?php
            $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 2 and deletar = 0";
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);

                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>

        <!--OUTROS-->
        <hr>
        <li class="nav-heading">Outros</li>
        <?php
            $queryModulosM = "SELECT * FROM sisrev_modulos where sub_modulo = 0 AND localizacao = 3 and deletar = 0";
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);

                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM sisrev_modulos where sub_modulo = ' . $modulosM['id'] . ' and deletar = 0';
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>
    </ul>
</aside><!-- End Sidebar-->