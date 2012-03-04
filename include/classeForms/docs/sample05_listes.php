<html>
<head>
<title>Manipulation de listes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<?php
	include('_data_top_menu.php');

?>



<blockquote>
  <p>&nbsp;</p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample04_dates.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_cascade.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTE&quot; </span></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tableau1 = array( "1" => "Paris", "2" => "Lyon", "3" => "Marseille", "4" => "Toulouse", "5" => "Bordeaux", "6" => "Nantes" );
	
	$tableau2 = array(  "1.1" => "Tour effel", "1.2" => "Sacré coeur", 
						"2.1" => "Fourvière", "2.2" => "Bellecour",
						"3.1" => "Canebière", "3.2" => "Notre dame de la garde",
						"4.1" => "Capitole",  "4.2" => "Saint-Sernin",
						"5.1" => "Place de la bourse", "5.2" => "Chateau Haut-Brion",
						"6.1" => "Place du commerce",  "6.2" => "Usines LU");

	$def_RECHERCHER_NIVEAU       = ( isset($_POST['RECHERCHER_NIVEAU']) )  ? stripslashes($_POST['RECHERCHER_NIVEAU'])       : "44";	
	$def_RECHERCHER_NIVEAU_LEVEL = ( isset($_POST['RECHERCHER_NIVEAU_LEVEL']) )    ? stripslashes($_POST['RECHERCHER_NIVEAU_LEVEL'])       : "DEPT";	


	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");
	$requete  = "SELECT * 
					FROM insee_regions
						ORDER BY reg_nom"; 	    
    $base->bdd_execsql($requete);	
	$tableau_regions = $base->bdd_tableversliste( array("reg_id","reg_nom") );

												   
    $f->frm_ObjetListe("LISTE_DEROUL",         array(
											    "label" => "Liste déroulante",
												"title" => "----- Choisir une VILLE -----",
												"default" => "5",
												"help" => "choisir une ville de la liste",
												"width" => "200px"),
								  	          $tableau1
											  );

    $f->frm_ObjetListe("LISTE_TITLEVALUE",         array(
											    "label" => "avec valeur nulle",
												"title" => "----- Choisir une VILLE -----",
												"titlevalue" => 0,
												"default" => 0,
												"help" => "choisir une ville de la liste dans ce cas la valeur nulle correspond au non choix (titlevalue)",
												"width" => "200px"),
								  	          $tableau1
											  );
											  
											  
    $f->frm_ObjetListe("LISTE_OBLIG",           array(
											    "label" => "Choix obligatoire (*)",
												"attrib" => "R",
												"default" => "5",
												"help" => "choisir  OBLIGATOIREMENT une ville de la liste",
												"width" => "200px"),
								  	          $tableau1 
											  );

    $f->frm_ObjetListe("LISTE_LNG",			    array(
											    "label" => "Liste normale",
												"default" => "3",
												"rows" => 5,
												"help" => "choisir une ville de la liste",
												"width" => "200px"),
								  	          $tableau1 
											  );

    $f->frm_ObjetListeLongue("LISTE_LONGUE",	array(
												"label" => "Liste longue avec filtre (*)",
												"default" => "2",		
												"attrib" => "RU",
							 					"rows" => "4",
												"help" => "Utiliser le champ de filtrage pour trouver et choisir une ville",
							 					"width" => "200px",),
											 $tableau1 
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
	
    $f->frm_Objet2Listes("LISTE_HORIZ",       array(
												"label" => "2 listes en liaison (H)",
												"orientation" => "H",
												"default" => "1.2",
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

    $f->frm_ObjetListesCascade("RECHERCHER_NIVEAU",       array(
												"label" => "Recherche multi-niveau",
											    "attrib" => "R",
												"orientation" => "V",
												//----------------------------------------------------
												"multilevel" => true,
												"default" => $def_RECHERCHER_NIVEAU,
												"defaultlevel" => $def_RECHERCHER_NIVEAU_LEVEL,
												"erase" => true,
												"reset" => true,
												//----------------------------------------------------
												"help" => "choisir une option et un niveau pour lancer une recherche",   
	                                            "width" => "200px",
												"ajax" => "sample05_listes_cascade_V_called.php",
												"list" => array( 
															array( 'id'     => 'REGION',
																   'title' => "---choisir une région---",
																   'width' => '200px' ),
															array( 'id'     => 'DEPT',
																   'title' => "---choisir le département---",
																   'width' => '250px' ),
															array( 'id'     => 'VILLE',
																   'title' => "---choisir la ville---",
																   'width' => '300px' ),


															)
														),
 								   			$tableau_regions
										     );											 

	$f->frm_SautLignes(1);	
	
    $f->frm_ObjetListeEditable("LISTE_1",    array(
											 "label" => "Liste éditable n°=1",
	                                         "attrib" => "RI", 
											 "default" => "Bruxelles",
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle (les valeurs hors liste sont en italique)",
											 ),
											 $tableau1 );

    $f->frm_ObjetListeEditable("LISTE_2",    array(
											 "label" => "Liste éditable n°=2",
											 "default" => "2",
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );

    $f->frm_ObjetListeEditable("LISTE_3",    array(
											 "label" => "Liste éditable inactive",
											 "default" => "2",
	                                         "attrib" => "-", 
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );
											 
    $f->frm_ObjetBascule("LISTE_BASCULE",    array(
											 "label" => "Listes en bascule",
											 "default" => "1,2,3",
											 "attrib" => "R",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "200px"
											 ),
								  	         $tableau1 );											 



	$f->frm_Ouvrir();
	
	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
		
	
?>
  </p>
</blockquote>
</body>
</html>
