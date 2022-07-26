<?php

/* ==== TELAS ====*/
$tela = basename($_SERVER['PHP_SELF']);

/* ==== REGRAS ====*/

//MEUS SISTEMAS
if($tela == "index.php"){if($_GET['pg'] != '1'){echo '<script>window.location.href = "index.php?pg=1";</script>';}}
//CONFIGURAÇÕES
if($tela == "usuarios.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "usuarios.php?pg=2";</script>';}}
if($tela == "usuariosEditar.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "usuariosEditar.php?pg=2";</script>';}}
if($tela == "usuarioNovo.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "usuarioNovo.php?pg=2";</script>';}}
if($tela == "dropdowns.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "dropdowns.php?pg=2";</script>';}}
if($tela == "dropdownsAcao.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "dropdownsAcao.php?pg=2";</script>';}}
if($tela == "sistema.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "sistema.php?pg=2";</script>';}}
if($tela == "sistemaAlterar.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "sistemaAlterar.php?pg=2";</script>';}}
if($tela == "api.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "api.php?pg=2";</script>';}}
//AJUDA
if($tela == "ajuda.php"){if($_GET['pg'] != '3'){echo '<script>window.location.href = "ajuda.php?pg=3";</script>';}}

?>