<html>
<head>
<title>Manipulation de listes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>



<?php		
	include('_data_top_menu.php');

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tableau1 = array( "1" => "Paris", "2" => "Lyon");
	
	$tableau21 = array(  "1" => "Tour effel",
						 "2" => "Sacré coeur",
						 "3" => "avenue de champs élysées",
						 "4" => "Opéra Garnier");
						 
	$tableau22 = array(  "1" => "Fourvière",
						 "2" => "Olympique lyonnais",
						 "3" => "Parc de la tête d'or",
						 "4" => "La croix rousse");
											   
	// ANALYSE DE LA REENTRANCE "SUBMIT()"
	$tableauliste2 = array();
	if (isset($_POST['LISTE1'])) {
		if ($_POST['LISTE1']=="1") 
			$tableauliste2 = $tableau21;
		elseif ($_POST['LISTE1']=="2") 
			$tableauliste2 = $tableau22;

	}	

	$tableauliste3 = array();
	if (isset($_POST['BTNRAD'])) {
		if ($_POST['BTNRAD']=="1") 
			$tableauliste3 = $tableau21;
		elseif ($_POST['BTNRAD']=="2") 
			$tableauliste3 = $tableau22;

	}	

    $f->frm_ObjetChampTexte("DATE_1",        array( "label" => "Date manuelle ou avec calendrier (attrib=DP)",
	                                         "attrib" => "RDP",
											 "default" => "TIMER",
											 "help" => "Saisir une date ou la sélectionner dans au calendrier")
											 );
											 
    $f->frm_ObjetChampTexte("NOM",      array( "label" => "Nom (*)", "attrib" => "RU", "width" => "200px", "default" => "CECI EST MON NOM..."));

	// CHAMPS QUI NOUS INTERRENT
    $f->frm_ObjetListe("LISTE1",         array(
											    "label" => "Ville",
												"attrib" => "S",
												"title" => "----- Choisir une VILLE -----",
												"help" => "choisir une ville de la liste",
												"width" => "200px"),
								  	          $tableau1
											  );
											  
    $f->frm_ObjetListe("LISTE2",         array(
											    "label" => "Liste déroulante dépendante",
												"attrib" => "R",
												"help" => "choisir une lieu de la ville",
												"width" => "200px",
												"linesafter" => "2"),
								  	         $tableauliste2
											  );


	// CHAMPS QUI NOUS INTERRENT AUSSI
    $f->frm_ObjetBoutonsRadio("BTNRAD",         array(
											    "label" => "Ville",
												"attrib" => "S",
												"help" => "choisir une ville de la liste",
												"orientation" => "H"
												),
								  	          $tableau1
											  );
											  
    $f->frm_ObjetListe("LISTE3",         		array(
											    "label" => "Liste déroulante dépendante",
												"attrib" => "R",
												"help" => "choisir une lieu de la ville",
												"width" => "200px",
												"linesafter" => "2"
												),
								  	         $tableauliste3
											  );

	$ret = $f->frm_Aiguiller();										  
	$f->frm_ChampsRecopier();
	$f->frm_Ouvrir();
?>
</body>
</html>
