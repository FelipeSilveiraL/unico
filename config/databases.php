<?php

	//SERVIDOR UNICO
	$ipservidorUnico = "10.100.1.67";	
	$portaUnico = "3306";
	$userUnico = "unico";
	$passUnico = "Servopa123#";
	$dbnameUnico = "unico";

	//SERVIDOR NOTAS
	$ipservidorNotas = "10.100.1.67";	
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

	// ########### UNICO ###########
	$conn = new mysqli($ipservidorUnico, $userUnico, $passUnico, $dbnameUnico, $portaUnico);
	if ($conn->connect_error) {
		die("ERRO CONEXÂO SERVIDOR UNICO: " . $conn->connect_error);
	}

	// ########### DBNOTAS ###########
	$connNOTAS = new mysqli($ipservidorNotas, $userNotas, $passNotas, $dbnameNotas, $portaNotas);
	if ($connNOTAS->connect_error) {
		die("ERRO CONEXÂO SERVIDOR DBNOTAS: " . $connNOTAS->connect_error);
	}

	// ########### LOCAL - UNICO ###########
	/*$connLOCALUnico = new mysqli($ipservidorLocal, $userLocal, $passLocal, $dbnameLocal, $portaLocal);
	if ($connLOCALUnico->connect_error) {
		die("ERRO CONEXÂO SERVIDOR LOCAL-UNICO: " . $connLOCALUnico->connect_error);
	}*/
	
?>







