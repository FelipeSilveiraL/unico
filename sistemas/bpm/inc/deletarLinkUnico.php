<?php
session_start();
require_once('../../../config/databases.php');

$delete = "DELETE FROM MFP_WEB WHERE ID_LINK = ".$_GET['id_link'];
$result = oci_parse($connBpmgp, $delete);
oci_execute($result);

oci_close($connBpmgp);

header('Location: ../front/mfpWeb.php?pg='.$_GET['pg'].'&msn=14');
?>