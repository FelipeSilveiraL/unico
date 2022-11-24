<?php

	//SERVIDOR UNICO
	$ipservidorUnico = "10.100.1.66";	
	$portaUnico = "3306";
	$userUnico = "unico";
	$passUnico = "Servopa123#";
	$dbnameUnico = "unico";

	//SERVIDOR NOTAS
	$ipservidorNotas = "10.100.1.66";	
	$portaNotas = "3306";
	$userNotas = "dbnotas";
	$passNotas = "#CAvpnGSVP20";
	$dbnameNotas = "dbnotas";

	//SERVIDOR LOCAL(UNICO)
	$ipservidorLocal = "localhost";	
	$portaLocal = "3306";
	$userLocal = "servopa";
	$passLocal = "qtbvar03";
	$dbnameLocal = "unico";

	//SERVIDOR VETORH
	$serverName = "10.129.1.253\\SQLSERVOPA"; //serverName\instanceName
	$userVetorh = 'Selbetti';
	$passVetorh = 'Selbetti2021#';
	$dbnameVetorh = 'Vetorh';


	// ########### UNICO ###########
	$conn = new mysqli($ipservidorUnico, $userUnico, $passUnico, $dbnameUnico, $portaUnico);
	if ($conn->connect_error) {
		die("ERRO CONEXÂO SERVIDOR UNICO: " . $conn->connect_error);
	}
	$conn->set_charset("utf8mb4");

	// ########### DBNOTAS ###########
	$connNOTAS = new mysqli($ipservidorNotas, $userNotas, $passNotas, $dbnameNotas, $portaNotas);
	if ($connNOTAS->connect_error) {
		die("ERRO CONEXÂO SERVIDOR DBNOTAS: " . $connNOTAS->connect_error);
	}

	// ########### LOCAL - UNICO ###########
	$connLOCALUnico = new mysqli($ipservidorLocal, $userLocal, $passLocal, $dbnameLocal, $portaLocal);
	if ($connLOCALUnico->connect_error) {
		die("ERRO CONEXÂO SERVIDOR LOCAL-UNICO: " . $connLOCALUnico->connect_error);
	}
	
	// ########### VETORH ###########
	$connectionInfo = array("Database"=>$dbnameVetorh, "UID"=>$userVetorh, "PWD"=>$passVetorh);

	$connVetorh = sqlsrv_connect($serverName, $connectionInfo);

	if(!$connVetorh) {
		echo "ERRO CONEXÂO SERVIDOR VETORH: ".$serverName.".<br />";
		die(print_r(sqlsrv_errors(), true));
	}
