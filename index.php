<?php 
/***************************
 * gestion de la caisse
 * 
 ***************************/
 
session_start();
include("include/classeForms.php");
include("include/classeBases.php");
$base = New Bdd;
$base->bdd_connecter_base(midas);
echo "initialisation treminée";
$f= New Forms;
$f->frm_Init(false, "80px");
	
definition_des_champs();

	$ret = $f->frm_Aiguiller();
	switch ( $ret ) {
		case "A0" :
			 $generation = 0;
			break;
			
		case "A1" :
			 $generation = 1;
			break;
	}
$f->frm_InitPalette(1);

$f->frm_ActiverBtnValider();
	
/* 
 * definition des champs
 */

 function  definition_des_champs() {
 	global $f;

$f->frm_OngletDefinir( array("width" => "600px", "height" => "300px","default" => "caisse_début" ) );

	$f->frm_ObjetChampTexte("DATE_1",array(
                "label" => "Date",
                "attrib" => "DP",
                "default" => "TIMER",
                "help" => "Saisir une date ou la sélectionner dans au calendrier")
                );
	$f->frm_ObjetChampTexte("AGENT",array(
                "label" => "Agent",
                "attrib" => "RU",
                "default" => "",
                "help" => "Saisir vos initiale")
                );				

$f->frm_OngletNouveau('caisse début');

	$f->frm_ObjetChampTexte("CASH_500",array(
		"label" => "500 €",
		"attrib" => "",
		"width" => "50px", 
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 500 €")
		);	
	$f->frm_ObjetChampTexte("CASH_200",array(
		"label" => "200 €",
		"attrib" => "",
		"width" => "50px", 
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 200 €")
		);	
	$f->frm_ObjetChampTexte("CASH_100",array(
		"label" => "100 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 100 €")
		);			
	$f->frm_ObjetChampTexte("CASH_050",array(
		"label" => "050 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 50 €")
		);	
	$f->frm_ObjetChampTexte("CASH_020",array(
		"label" => "200 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 20 €")
		);		
	$f->frm_ObjetChampTexte("CASH_010",array(
		"label" => "010 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 010 €")
		);
	$f->frm_ObjetChampTexte("CASH_005",array(
		"label" => "5 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 5 €")
		);
	$f->frm_ObjetChampTexte("CASH_002",array(
		"label" => "2 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 2 €")
		);
	$f->frm_ObjetChampTexte("CASH_001",array(
		"label" => "1 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 1 €")
		);
	$f->frm_ObjetChampTexte("CASH_00050",array(
		"label" => "0,50 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,50 €")
		);
	$f->frm_ObjetChampTexte("CASH_00020",array(
		"label" => "0,20 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,20 €")
		);
	$f->frm_ObjetChampTexte("CASH_00010",array(
		"label" => "0,10 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,10 €")
		);
	$f->frm_ObjetChampTexte("CASH_00005",array(
		"label" => "0,05 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,05 €")
		);
	$f->frm_ObjetChampTexte("CASH_00002",array(
		"label" => "0,02 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,02 €")
		);
	$f->frm_ObjetChampTexte("CASH_00001",array(
		"label" => "0,01 €",
		"attrib" => "",
		 "width" => "50px",
		"default" => "0", 
		"help" => "Saisir le nombre de billet de 0,01 €")
		);
				
$f->frm_OngletNouveau('caisse fin');

	$f->frm_ObjetChampTexte("F-CASH_500",array(
                "label" => "500 €",
                "attrib" => "",
                "width" => "50px",
                "default" => "0",
                "help" => "Saisir le nombre de billet de 500 €")
                );
        $f->frm_ObjetChampTexte("F-CASH_200",array(
                "label" => "200 €",
                "attrib" => "",
                "width" => "50px",
                "default" => "0",
                "help" => "Saisir le nombre de billet de 200 €")
                );
        $f->frm_ObjetChampTexte("F-CASH_100",array(
                "label" => "100 €",
                "attrib" => "",
                 "width" => "50px",
                "default" => "0",
                "help" => "Saisir le nombre de billet de 100 €")
                );
		$f->frm_ObjetChampTexte("F-CASH_050",array(
				"label" => "050 €",
				"attrib" => "",
		 		"width" => "50px",
				"default" => "0", 
				"help" => "Saisir le nombre de billet de 50 €")
				);	
		$f->frm_ObjetChampTexte("F-CASH_020",array(
			"label" => "200 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 20 €")
			);		
		$f->frm_ObjetChampTexte("F-CASH_010",array(
			"label" => "010 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 010 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_005",array(
			"label" => "5 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 5 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_002",array(
			"label" => "2 €",
			"attrib" => "",
			 "width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 2 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_001",array(
			"label" => "1 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 1 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_00050",array(
			"label" => "0,50 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,50 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_00020",array(
			"label" => "0,20 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,20 €")
			);	
		$f->	frm_ObjetChampTexte("F-CASH_00010",array(
			"label" => "0,10 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,10 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_00005",array(
			"label" => "0,05 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,05 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_00002",array(
			"label" => "0,02 €",
			"attrib" => "",
		 	"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,02 €")
			);
		$f->frm_ObjetChampTexte("F-CASH_00001",array(
			"label" => "0,01 €",
			"attrib" => "",
			"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,01 €")
			);
$f->frm_OngletNouveau('Chèques');							
				
		$f->frm_ObjetChampTexte("CHEQUE_MONTANT",array(
			"label" => "Montant",
			"attrib" => "n",
			"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,01 €")
			);	
		$f->frm_ObjetChampTexte("CHEQUE_NOMBRE",array(
			"label" => "Nombre",
			"attrib" => "n",
			"width" => "50px",
			"default" => "0", 
			"help" => "Saisir le nombre de billet de 0,01 €")
			);							
 }

?>

<html>
        <head>
                <title>La Rampe - Gestion de la caisse</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link href="/css/style.css" rel="stylesheet" type="text/css">
        </head>
<body>
        <h1>Gestion de la caisse</h1>
        <blockquote>
        <?php
			$f->frm_Ouvrir();
        	$f->frm_Fermer();
		?>

        </blockquote>
</body>
</html>

