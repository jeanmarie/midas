<?php 
/***************************
 * gestion de la caisse
 * 
 */
session_start();
 incluse(include"/php/classeForms.php");
$f= New Form;
$f-frm_Init(false, "120px");
$f->frm_InitPalette(4);
	
	definition_des_champs();

	$ret = $f->frm_Aiguiller();
	switch ( $ret ) {
		case "A0" :
			break;
			
		case "A1" :
			break;
	}
	?>
	
<html>
	<head>
		<title>La Rampe - Gestion de la caisse</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="/css/style.css rel="stylesheet" type="text/css">
	</head>
<body>	
	<h1>Gestion de la caisse</h1>
	<blockquote>
	<?php
		$f->frm_Ouvrir();
	?>
	
	</blockquote>
</body>
</html>

<?php
/* 
 * definition des champs
 */

 function  definition_des_champs() {
 	global $f;
	$f->frm_ObjetChampTexte("DATE_1",array(
		"label" => "Date",
		"attrib" => "DP",
		"default" => "TIMER", 
		"help" => "Saisir une date ou la sélectionner dans au calendrier")
		);	

	$f->frm_ObjetChampTexte("CASH_500",array(
		"label" => "500 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 500 €")
		);	
	$f->frm_ObjetChampTexte("CASH_200",array(
		"label" => "200 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 200 €")
		);	
	$f->frm_ObjetChampTexte("CASH_100",array(
		"label" => "100 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 100 €")
		);			
	$f->frm_ObjetChampTexte("CASH_050",array(
		"label" => "050 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 50 €")
		);	
	$f->frm_ObjetChampTexte("CASH_020",array(
		"label" => "200 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 20 €")
		);		
	$f->frm_ObjetChampTexte("CASH_010",array(
		"label" => "010 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 010 €")
		);
	$f->frm_ObjetChampTexte("CASH_005",array(
		"label" => "5 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 5 €")
		);
						$f->frm_ObjetChampTexte("CASH_002",array(
		"label" => "2 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 2 €")
		);
	$f->frm_ObjetChampTexte("CASH_001",array(
		"label" => "1 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 1 €")
		);
	$f->frm_ObjetChampTexte("CASH_00050",array(
		"label" => "0,50 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,50 €")
		);
	$f->frm_ObjetChampTexte("CASH_00020",array(
		"label" => "0,20 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,20 €")
		);
	$f->frm_ObjetChampTexte("CASH_00010",array(
		"label" => "0,10 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,10 €")
		);
	$f->frm_ObjetChampTexte("CASH_00005",array(
		"label" => "0,05 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,05 €")
		);
	$f->frm_ObjetChampTexte("CASH_00002",array(
		"label" => "0,02 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,02 €")
		);
	$f->frm_ObjetChampTexte("CASH_00001",array(
		"label" => "0,01 €",
		"attrib" => "",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,01 €")
		);		
 }

