<?php

/* ==== TELAS ====*/
$pegatela = basename($_SERVER['PHP_SELF']);
$tela = $pegatela;

/* ==== REGRAS ====*/
//index.php
if($tela == "index.php"){if($_GET['pg'] != '1'){echo '<script>window.location.href = "index.php?pg=1";</script>';}}
//lancamento.php
if($tela == "lancamento.php"){if($_GET['pg'] != '2'){echo '<script>window.location.href = "lancamento.php?pg=2";</script>';}}
//espelhar_usuarios.php
if($tela == "espelhar_usuarios.php"){if($_GET['pg'] != '4'){echo '<script>window.location.href = "espelhar_usuarios.php?pg=4&tela=2";</script>';}}
//configuracao.php
if($tela == "configuracao.php"){if($_GET['pg'] != '4'){echo '<script>window.location.href = "configuracao.php?pg=4";</script>';}}
//ajuda.php
if($tela == "ajuda.php"){if($_GET['pg'] != '5'){echo '<script>window.location.href = "ajuda.php?pg=5";</script>';}}
//relatorio.php
if($tela == "relatorio.php"){if($_GET['pg'] != '6'){echo '<script>window.location.href = "relatorio.php?pg=6";</script>';}}

