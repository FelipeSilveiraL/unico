<?php
//regras de administrador
switch ($_GET['pg']) {
    case 4:
        var_dump($_SESSION['administrador']);
        if($_SESSION['administrador'] == 0){
            echo '<script>window.location.href = "index.php?pg=1";</script>';
        }        
        break;
}
?>