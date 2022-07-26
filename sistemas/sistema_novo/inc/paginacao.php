<?php

/* ==== TELAS ====*/
$tela = basename($_SERVER['PHP_SELF']);

/* ==== REGRAS ====*/
//index.php
if($tela == "index.php"){if($_GET['pg'] != '1'){echo '<script>window.location.href = "index.php?pg=1";</script>';}}