<html>
<head>
<title>Manipulation des arbre</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p>&nbsp;  </p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample21_separateurs_onglets.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample23_icones.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION DES ARBRES POUR LE CHOIX DE VALEURS</span></span>
    <?php
print_r($_POST);
?>
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
	$tableau1 = array( "1" => "Paris", "2" => "Lyon", "3" => "Marseille", "4" => "Toulouse", "5" => "Bordeaux", "6" => "Nantes" );

	# TABLEAU PERE / FILS
	$tableau2 = array( array("0","France (0)",-1), 
					   array("1","Paris (1)",0),
					   array("2","Marseille (2)",0),
					   array("3","Lyon (3)",0),
					   array("4","Place de la Concorde (4)",1),
					   array("5","Montmartre (5)",1),
					   array("6","Vieux port (6)",2),
					   array("7","Notre Dame de la Garde (7)",2),
					   array("8","Place Bellecourt (8)",3),
					   array("9","La croix rousse (9)",3),
					   array("10","Invalides (10)",1),
					   array("11","Sacré Coeur (11)",5),
					   array("12","La place du tertre (12)",5),
					   array("13","Trifouilly (13)",0),
					   array("14","Place du marché (14)",13),
					 );
					   

    $f->frm_ObjetChampTexte("NOM",    array(   "label" => "TOUT LE CHAMP EN MAJUSCULE (U)",
											   "attrib" => "RU",
											   "width" => "300px",
											   "default" => "TOUT LE CHAMP EN MAJUSCULE",
											   "help" => "Chaque caractère est transformé en majuscule"));

    $f->frm_ObjetChampTexte("PRENOM",    array( "label" => "Initiale En Majuscule (I)",
											   "attrib" => "I",
											   "width" => "300px",
											   "default" => "Initiale En Majuscule",
											   "help" => "Chaque caractère est transformé en minuscule sauf l'initiale de chaque mot en majuscule"));

    $f->frm_SautLignes();		
    $f->frm_ObjetListe("LISTE_DEROUL",         array(
											    "label" => "Liste déroulante",
												"title" => "----- Choisir une VILLE -----",
												"default" => "5",
												"help" => "choisir une ville de la liste",
												"width" => "300px"),
								  	          $tableau1
											  );

    $f->frm_SautLignes();		
    $f->frm_ObjetChampArbre("FEUILLE1",    array( "label" => "Arbre n°=1 (defaut=5)",
											   "attrib" => "",
											   "width" => "300px",
											   "height" => "150px",
											   "default" => "5",
											   "title" => "Titre de l'arbre",
											   "lines" => "false",
											   ),
											   $tableau2
										);
    $f->frm_SautLignes();		
    $f->frm_ObjetChampArbre("FEUILLE2",    array( "label" => "Arbre n°=2 (pas de defaut) OBLIGATOIRE",
											   "attrib" => "R",
											   "width" => "300px",
											   "height" => "150px",
											   "title" => "Ville",
											   "lines" => "true",
											   ),
											   $tableau2
										);
    $f->frm_SautLignes();		
    $f->frm_ObjetChampArbre("FEUILLE3",    array( "label" => "Arbre n°=3 (defaut=4) LECTURE SEULE",
											   "attrib" => "+",
											   "width" => "300px",
											   "height" => "150px",
											   "default" => "4"
											   ),
											   $tableau2
										);

    $f->frm_SautLignes();		
    $f->frm_ObjetChampArbre("FEUILLE4",    array( "label" => "Arbre n°=4 (La racine est selectionnable",
											   "attrib" => "",
											   "width" => "300px",
											   "height" => "150px",
											   "title" => "Ville",
											   "lines" => "true",
											   "rootselector" => "true",
											   ),
											   $tableau2
										);

	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
