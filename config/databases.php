<?php

//SERVIDOR UNICO
$ipservidorUnico = "10.100.1.67";
$portaUnico = "3306";
$userUnico = "unico";
$passUnico = "Servopa123#";
$dbnameUnico = "unico";

//SERVIDOR BLOG
$ipservidorBlog = "10.100.1.67";
$portaBlog = "3306";
$userBlog = "blog";
$passBlog = "Servopa123#";
$dbnameBlog = "blog";

//SERVIDOR LOCAL - UNICO

$ipservidorLocal = "localhost";
$userLocal = "servopa";
$passLocal = "qtbvar03";
$dbnameLocal = "unico";

//SERVIDOR NOTAS
$ipservidorNotas = "10.100.1.67";
$portaNotas = "3306";
$userNotas = "dbnotas";
$passNotas = "#CAvpnGSVP20";
$dbnameNotas = "dbnotas_hom";

//SERVIDOR VETORH
$serverName = "10.129.1.253\\SQLSERVOPA";
$userVetorh = 'Selbetti';
$passVetorh = 'Selbetti2021#';
$dbnameVetorh = 'Vetorh';

//SERVIDOR BPMGP
$userBpmgp = "bpmgp";
$passBpmgp = "bpmgpSVP21#";
$dbstrBpmgp = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.100.1.209)(PORT = 1526)) (CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = BPMGP)))";

//SERVIDOR SELBETTI
$userSelbetti = "Selbetti";
$passSelbetti = "Selbetti123#";
$dbstrSelbetti = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.100.1.209)(PORT = 1525)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = SELBETTIPROD)))";

//SERVIDOR APOLLO
$userApollo = "gruposervopa";
$passApollo = "ninguemsabe";
$dbstrApollo = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.100.1.209)(PORT = 1523)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = APOLLO)))";

//SERVIDOR NBS
$userNbs = "nbs";
$passNbs = "new";
$dbstrNbs = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.100.1.209)(PORT = 1522))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = NBS)))";

//SERVIDOR NBS RIBEIRAO
$userNbsRibeirao = "nbs";
$passNbsRibeirao = "new";
$dbstrNbsRibeirao = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.100.1.209)(PORT = 1524)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = HARLEY)))";

// ----------------------------------------------------------------------------------------------------------------//

// ########### UNICO ###########
$conn = new mysqli($ipservidorUnico, $userUnico, $passUnico, $dbnameUnico, $portaUnico);

if ($conn->connect_error) {
	die("ERRO CONEXÂO SERVIDOR UNICO: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// ########### BLOG ###########
$connBlog = new mysqli($ipservidorBlog, $userBlog, $passBlog, $dbnameBlog, $portaBlog);

if ($connBlog->connect_error) {
	die("ERRO CONEXÂO SERVIDOR BLOG: " . $connBlog ->connect_error);
}
$connBlog->set_charset("utf8mb4");

// ########### DBNOTAS ###########
$connNOTAS = new mysqli($ipservidorNotas, $userNotas, $passNotas, $dbnameNotas, $portaNotas);

if ($connNOTAS->connect_error) {
	die("ERRO CONEXÂO SERVIDOR DBNOTAS: " . $connNOTAS->connect_error);
}
$connNOTAS->set_charset("utf8mb4");

// ########### LOCAL - UNICO ###########
$connLOCALUnico = new mysqli($ipservidorLocal, $userLocal, $passLocal, $dbnameLocal);
if ($connLOCALUnico->connect_error) {
	die("ERRO CONEXÂO SERVIDOR LOCAL-UNICO: " . $connLOCALUnico->connect_error);
}

// ########### VETORH ###########
$connectionInfo = array("Database" => $dbnameVetorh, "UID" => $userVetorh, "PWD" => $passVetorh);

$connVetorh = sqlsrv_connect($serverName, $connectionInfo);

if (!$connVetorh) {
	echo "ERRO CONEXÂO SERVIDOR VETORH: " . $serverName . ".<br />";
	die(print_r(sqlsrv_errors(), true));
}

// ########### BPMGP ###########
$connBpmgp = oci_connect($userBpmgp, $passBpmgp, $dbstrBpmgp,  $encoding = "AL32UTF8");

if (!$connBpmgp) {
	echo 'ERRO CONEXÂO SERVIDOR BPMGP - Homologação <br />';
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// ########### SELBETTI ###########
$connSelbetti = oci_connect($userSelbetti, $passSelbetti, $dbstrSelbetti);

if (!$connSelbetti) {
	echo 'ERRO CONEXÂO SERVIDOR SELBETTI - Homologação <br />';
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// ########### APOLLO ###########
$connApollo = oci_connect($userApollo, $passApollo, $dbstrApollo);

if (!$connApollo) {
	echo 'ERRO CONEXÂO SERVIDOR APOLLO - Homologação <br />';
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// ########### NBS ###########
$connNbs = oci_connect($userNbs, $passNbs, $dbstrNbs);

if (!$connNbs) {
	echo 'ERRO CONEXÂO SERVIDOR NBS - Homologação <br />';
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


// ########### NBS RIBEIRAO ###########
$connNbsRibeirao = oci_connect($userNbsRibeirao, $passNbsRibeirao, $dbstrNbsRibeirao);

if (!$connNbsRibeirao) {
	echo 'ERRO CONEXÂO SERVIDOR NBS - RIBEIRAO <br />';
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
