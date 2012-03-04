<html>
<head>
<title>CLASSEFORMS : Coches et boutons radio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>
<?php
	include('_data_top_menu.php');

?>	



<blockquote>
  <h4>&nbsp;</h4>
  <h4><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample06_memo_editeur.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample07_radio.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style1 style3"><strong>CHAMP COCHE ET RADIO AVEC ACTIVATION/DESACTIVATION DYNAMIQUE DE CHAMPS</strong></span></span></h4>
<?php 
	if (isset($_GET['COCHER'])) {
		print "CASES COCHEES PAR DEFAUT";
		$cochedefaut = "1";
	} else {
		print "CASES DECOCHEES PAR DEFAUT";
		$cochedefaut = "0";
	}
	$def_DATE = ( isset($_POST['DATE']) )  ? $_POST['DATE']    : "";
	$def_TIMESTAMP = ( isset($_POST['TIMESTAMP']) )  ? $_POST['TIMESTAMP']    : "TIMER";

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,'250px');
	$tableau1 = array( "1" => "Homme", "2" => "Femme", "3" => "MIXTE");
	$tableau2 = array( "1" => "Train", "2" => "Voiture", "3" => "Avion", "4" => "Camion" );

	$tableau3 = array( "1" => "Paris", "2" => "Lyon", "3" => "Marseille", "4" => "Toulouse", "5" => "Bordeaux", "6" => "Nantes" );
	$tableau4 = array(  "1.1" => "Tour effel", "1.2" => "Sacré coeur", 
						"2.1" => "Fourvière", "2.2" => "Bellecour",
						"3.1" => "Canebière", "3.2" => "Notre dame de la garde",
						"4.1" => "Capitole",  "4.2" => "Saint-Sernin",
						"5.1" => "Place de la bourse", "5.2" => "Chateau Haut-Brion",
						"6.1" => "Place du commerce",  "6.2" => "Usines LU");	

	//------------------------------------------------------------	
    $f->frm_ObjetBoutonsRadio("BtnRad", array("label" => "<b>Sexe (mode activation)</b>",
	                                          "default" => "1",
											  "help" => "cocher Homme ou Femme pour choisir un prénom",
											  "activation" => array("H","F","AUTRE","") ),
								  	     array( "1" => "Homme", "2" => "Femme", "3" => "Mixte", "4" => "Aucun de ces choix")
										);
    $f->frm_ObjetChampTexte("H",        array( "label" => "Prénom masculin", "attrib" => "R", "default" => "Jean"));
    $f->frm_ObjetChampTexte("F",        array( "label" => "Prénom féminin  (U)", "attrib" => "R", "default" => "Paulette"));
    $f->frm_ObjetChampTexte("AUTRE",    array( "label" => "Prénom mixte (U)", "attrib" => "R", "default" => "Camille"));

	//------------------------------------------------------------	
	$f->frm_SautLignes();
    $f->frm_ObjetBoutonsRadio("BtnRad2", array("label" => "<b>Sexe (mode noactivation)</b>",
	                                          "default" => "3",
											  "help" => "cocher Homme ou Femme pour choisir un prénom",
											  "orientation" => "V",
	  										  "noactivation" => array("H2","F2",array("AUTRE2",'H2','F2') ) ),
								  	     $tableau1
										);
    $f->frm_ObjetChampTexte("H2",        array( "label" => "Prénom masculin", "attrib" => "R", "default" => "Jean"));
    $f->frm_ObjetChampTexte("F2",        array( "label" => "Prénom féminin  (U)", "attrib" => "R", "default" => "Paulette", "linesafter" => 1));
    $f->frm_ObjetChampTexte("AUTRE2",    array( "label" => "Prénom mixte (U)", "attrib" => "R", "default" => "Camille"));

	//------------------------------------------------------------	
	$f->frm_SautLignes();
    $f->frm_ObjetBoutonsRadio("BtnRad3", array("label" => "<b>Sexe (mode intersection)</b>",
	                                          "default" => "1",
											  "help" => "cocher Homme ou Femme pour choisir un prénom",
	  										  "activation" => array(array("H3","AUTRE3"),array("F3","AUTRE3")) ),
								  	     array( "1" => "Homme", "2" => "Femme")
										);
    $f->frm_ObjetChampTexte("H3",        array( "label" => "Prénom masculin", "attrib" => "R", "default" => "Jean"));
    $f->frm_ObjetChampTexte("F3",        array( "label" => "Prénom féminin  (U)", "attrib" => "R", "default" => "Paulette", "linesafter" => 1));
    $f->frm_ObjetChampTexte("AUTRE3",    array( "label" => "Prénom mixte (U)", "attrib" => "R", "default" => "Camille"));

	//------------------------------------------------------------

	$f->frm_SautLignes(2);
	
    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION (Cocher pour activer)", "title" => "Un déplacement est nécessaire",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut, 
											"activation" => array("DATE","TIMESTAMP","VILLE","HOTEL","MOYEN","LISTE_BASCULE","LISTE_LONGUE","LISTE_VERT","LISTE_1","TEXTEPOPUP1","MULTILISTE_L1","UPLOADER1")  )
											  );
											   
    $f->frm_ObjetChampTexte("DATE",        array( "label" => "Date sans calendrier vierge (attrib=D)",
	                                         "attrib" => "RDP",
											 "default" => $def_DATE,
											 )
											 );
											   
    $f->frm_ObjetChampTexte("TIMESTAMP",     array( "label" => "Time stamp (attrib=T)",
	                                         "attrib" => "T",
											 "help" => "sélectionner une date dans le calendrier",
											 "default" => $def_TIMESTAMP)
											 );
											 
    $f->frm_ObjetChampPopup("TEXTEPOPUP1",    array(   "label" => "Champ Texte/Popup",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id",
											   "default" => "10",
											   "defaultview" => "DIX"
											 )
							);		
    $f->frm_ObjetChampTexte("VILLE",    array( "label" => "Ville accueil", "attrib" => "RU", "default" => "MARSEILLE"));
    $f->frm_ObjetChampTexte("HOTEL",    array(  "label" => "Nom de l'hotel", "attrib" => "RU", "default" => "HOTEL DU VIEUX PORT" ));

    $f->frm_ObjetListe("MOYEN",         array("label" => "Mode déplacement", "attrib" => "", 
											  "help" => "choisir un mode de déplacement",  "width" => "200px", "linesafter" => 1),
										$tableau2
								  	     );

    $f->frm_ObjetBascule("LISTE_BASCULE",    array(
											 "label" => "Listes en bascule",
											 "default" => "1,2,3",
											 "attrib" => "R",
											 "sort" => true,
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "100px"
											 ),
								  	         $tableau3 );					

    $f->frm_ObjetListeLongue("LISTE_LONGUE",	array(
												"label" => "Liste longue avec filtre (*)",
												"default" => "2",		
												"attrib" => "RU",
							 					"rows" => "4",
												"help" => "Utiliser le champ de filtrage pour trouver et choisir une ville",
							 					"width" => "200px",),
											 $tableau3 
											 );		
											 
    $f->frm_Objet2Listes("LISTE_VERT",         array(
												"label" => "2 listes en liaison (V)",
												"orientation" => "V",
												"default" => "2.2",
												"help" => "choisir une option et une sous-option",   
	                                            "width" => "200px",
												"title1" => "---choisir la ville---",
												"title2" => "---choisir la curiosité---"),

 								   			 array( "1" => "Paris", "2" => "Lyon", "3" => "Marseille", "4" => "Toulouse",
													"1.1" => "Tour effel", "1.2" => "Sacré coeur", 
													"2.1" => "Fourvière", "2.2" => "Bellecour",
													"3.1" => "Canebière", "3.2" => "Notre dame de la garde",
													"4.1" => "Capitole",  "4.2" => "Saint-Sernin")
										     );
    $f->frm_ObjetListeEditable("LISTE_1",    array(
											 "label" => "Liste éditable n°=1",
	                                         "attrib" => "RI", 
											 "default" => "Bruxelles",
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle (les valeurs hors liste sont en italique)",
											 ),
											 $tableau3);

    $f->frm_ObjetMultiListe("MULTILISTE_L1",       array(
											    "label" => "Liste à choix multiple",
											    "attrib" => "R",
												"default" => "2,3,4",
												"rows" => "10",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "100px"),
								  	          $tableau3
											  );									 							  

    $f->frm_ObjetUploader("UPLOADER1",       array(
											    "label" => "Télécharger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => '',
												"attrib" => "",
												"preview" => true,
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"help" => "Télécharger un fichier",
												"width" => "200px")
								  	         
											  );

	//------------------------------------------------------------

	$f->frm_SautLignes();


    $f->frm_ObjetCoche("NOACTIVATION",      array( "label" => "NOACTIVATION (Cocher pour desactiver)", "title" => "Un déplacement est nécessaire",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut, 
											"noactivation" => array("VILLE2","HOTEL2","MOYEN2","LISTE_BASCULE2","LISTE_LONGUE2","LISTE_2","TEXTEPOPUP2","UPLOADER2")  )
											  );

    $f->frm_ObjetChampPopup("TEXTEPOPUP2",    array(   "label" => "Champ Texte/Popup",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id",
											   "default" => "10",
											   "defaultview" => "DIX"
											 )
							);											 							  
											
    $f->frm_ObjetChampTexte("VILLE2",    array( "label" => "Ville accueil", "attrib" => "RU", "default" => "MARSEILLE"));
    $f->frm_ObjetChampTexte("HOTEL2",    array(  "label" => "Nom de l'hotel", "attrib" => "RU", "default" => "HOTEL DU VIEUX PORT" ));

    $f->frm_ObjetListe("MOYEN2",         array("label" => "Mode déplacement", "attrib" => "R", 
											  "help" => "choisir un mode de déplacement",  "width" => "200px", "linesafter" => 1),
										$tableau2
								  	     );

    $f->frm_ObjetBascule("LISTE_BASCULE2",    array(
											 "label" => "Listes en bascule",
											 "default" => "1,2,3",
											 "attrib" => "R",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "100px"
											 ),
								  	         $tableau3 );					
    $f->frm_ObjetListeLongue("LISTE_LONGUE2",	array(
												"label" => "Liste longue avec filtre (*)",
												"default" => "2",		
												"attrib" => "RU",
							 					"rows" => "4",
												"help" => "Utiliser le champ de filtrage pour trouver et choisir une ville",
							 					"width" => "200px",),
											 $tableau3 
											 );	

    $f->frm_ObjetListeEditable("LISTE_2",    array(
											 "label" => "Liste éditable n°=2",
											 "attrib" => "",
											 "default" => "2",
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau3);
    $f->frm_ObjetUploader("UPLOADER2",       array(
											    "label" => "Télécharger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => '',
												"attrib" => "",
												"preview" => true,
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"help" => "Télécharger un fichier",
												"width" => "200px")
								  	         
											  );
 	 
	//------------------------------------------------------------

											   
	$f->frm_SautLignes(2);											 


					 
	
	


						 



	$f->frm_Ouvrir();
?>

  <p><a href="sample07_coche_radio.php
<?php  if (!$cochedefaut) print "?COCHER"; ?>
">inverser les case &agrave; cocher au chargement de la page</a> </p>
</blockquote>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
