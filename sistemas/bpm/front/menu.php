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

        <?php
            $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 1 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

            $merge = array_merge($queryModulosUser, $queryModulosUser2);
            $queryModulosM = $merge[0] . $merge[1];
        
            $a = $conn->query($queryModulosM);
        
            if ($liberado = $a->fetch_assoc()) {
            echo '<hr><li class="nav-heading">Departamentos</li>';
            }
            
        ?>
        
        <?php
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM bpm_modulos where sub_modulo = ' . $modulosM['id_modulo'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);
                
                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id_modulo'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id_modulo'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM bpm_modulos SM LEFT JOIN bpm_usuario_modulo SUM ON (SUM.id_modulo = SM.id) where SM.sub_modulo = ' . $modulosM['id_modulo'] . ' and SM.deletar = 0 AND SUM.id_usuario = ' . $_SESSION['id_usuario'];
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id_modulo'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id_modulo'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome_modulo'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>

        <!--TELAS-->
        <?php
            unset($queryModulosUser2);
            $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 2 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

            $merge = array_merge($queryModulosUser, $queryModulosUser2);
            $queryModulosM = $merge[0] . $merge[1];
        
            $a = $conn->query($queryModulosM);
        
            if ($liberado = $a->fetch_assoc()) {
            echo '<hr><li class="nav-heading">Telas</li>';
            }
            
        ?>
        
        <?php
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM bpm_modulos where sub_modulo = ' . $modulosM['id_modulo'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);
                
                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id_modulo'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id_modulo'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM bpm_modulos SM LEFT JOIN bpm_usuario_modulo SUM ON (SUM.id_modulo = SM.id) where SM.sub_modulo = ' . $modulosM['id_modulo'] . ' and SM.deletar = 0 AND SUM.id_usuario = ' . $_SESSION['id_usuario'];
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id_modulo'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id_modulo'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome_modulo'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>

        <!--OUTROS-->
        <?php
            unset($queryModulosUser2);
            $queryModulosUser2 = array('2' => " WHERE SM.sub_modulo = 0 AND SM.localizacao = 3 AND SM.deletar = 0 AND U.id_usuario = " . $_SESSION['id_usuario']);

            $merge = array_merge($queryModulosUser, $queryModulosUser2);
            $queryModulosM = $merge[0] . $merge[1];
        
            $a = $conn->query($queryModulosM);
        
            if ($liberado = $a->fetch_assoc()) {
            echo '<hr><li class="nav-heading">Outros</li>';
            }
            
        ?>
        
        <?php
            $resultadoModulosM = $conn->query($queryModulosM);

            while ($modulosM = $resultadoModulosM->fetch_assoc()) {

                $querySubmenu = 'SELECT * FROM bpm_modulos where sub_modulo = ' . $modulosM['id_modulo'] . ' and deletar = 0';
                $resuSubmenu = $conn->query($querySubmenu);

                if ($submenu = $resuSubmenu->fetch_assoc()) {

                    $linkmodulosub = '" data-bs-target="#modulo'.$modulosM['id_modulo'].'" data-bs-toggle="collapse" href="#">';
                    $iconeSeta = '<i class="bi bi-chevron-down ms-auto"></i>';

                    $submodulo = '<ul id="modulo'.$modulosM['id_modulo'].'" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                                        <li>';
                    $querySubmenuM = 'SELECT * FROM bpm_modulos SM LEFT JOIN bpm_usuario_modulo SUM ON (SUM.id_modulo = SM.id) where SM.sub_modulo = ' . $modulosM['id_modulo'] . ' and SM.deletar = 0 AND SUM.id_usuario = ' . $_SESSION['id_usuario'];
                    $resuSubmenuM = $conn->query($querySubmenuM);
                    while ($submenuM = $resuSubmenuM->fetch_assoc()) {
                        $submodulo .= '<a href="' . $submenuM['endereco'] . '?pg=' . $modulosM['id_modulo'] . '">
                                                    <i class="bi bi-circle"></i><span>' . $submenuM['nome'] . '</span>
                                                </a>';
                    }
                    $submodulo .= '
                                            </li>
                                        </ul>';
                } else {
                    $linkmodulosub = 'href="' . $modulosM['endereco'] . '?pg='.$modulosM['id_modulo'].'">';
                    $submodulo = '';
                    $iconeSeta = '';
                }

                echo '<li class="nav-item">
                                <a class="nav-link';
                echo $_GET['pg'] == $modulosM['id_modulo'] ? ' "' : ' collapsed"';
                echo $linkmodulosub;
                echo $modulosM['icone'];
                echo '<span> ' . $modulosM['nome_modulo'] . '</span>';
                echo $iconeSeta;
                echo '</a>';
                echo $submodulo;
                echo '</li>';
            }
        ?>
        
    </ul>
</aside><!-- End Sidebar-->