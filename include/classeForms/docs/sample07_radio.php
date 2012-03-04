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
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample07_coche_radio.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample07_radio_2.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style1 style3"><strong>CHAMP RADIO AVEC ACTIVATION/DESACTIVATION DYNAMIQUE DE CHAMPS</strong></span></span></h4>
<?php 
	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']            : "2";
	$defaut1          = ( isset($_POST['LISTE_BASCULE1']) )   ? $_POST['LISTE_BASCULE1']     : "1,3";
	$def_tel       = ( isset($_POST['TEL']) )              ? $_POST['TEL']                : "12.34.56.78.90";	

	$def_homme     = ( isset($_POST['HOMME']) )            ? $_POST['HOMME']              : "Jean";	
	$def_homme2    = ( isset($_POST['HOMME2']) )           ? $_POST['HOMME2']             : "Jean-Paul";	

	$def_femme     = ( isset($_POST['FEMME']) )            ? $_POST['FEMME']              : "Paulette";	
	$def_autre     = ( isset($_POST['AUTRE']) )            ? $_POST['AUTRE']              : "Camille";	

	$def_moyen     = ( isset($_POST['MOYEN']) )            ? $_POST['MOYEN']              : "1";	
	$def_multiliste = ( isset($_POST['MULTILISTE']) )      ? $_POST['MULTILISTE']         : "";	

	$tableau1 = array( "1" => "Homme", "2" => "Femme", "3" => "MIXTE");
	$tableau2 = array( "1" => "Train", "2" => "Voiture", "3" => "Avion", "4" => "Camion" );

	$def_autres       = ( isset($_POST['TEL']) )              ? $_POST['TEL']                : "12.34.56.78.90";	



	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,'250px');

    $f->frm_ObjetBoutonsRadio("BTN_RAD", array("label" => "Activer",
	                                          "default" =>$radio_activation,
											  "orientation" => "V",
											  "help" => "Activation d'un ou plusieurs champs suivant l'état",
											  "activation" => array(
											  						array("LISTE_BASCULE1"),
											  					    array("TEL","HOMME"),
																	array("FEMME","AUTRE","HOMME2","MULTILISTE"),
																	"MOYEN"
															       ) 
											   ),
								  	     array( "1" => "Liste d'un seul champ", 
										        "2" => "Liste de 2 champs" ,
												"3" => "Liste de 3 champs"  ,
												"4" => "Champ unique" )
										);

    $f->frm_SautLignes(1);			
    $f->frm_ObjetBascule("LISTE_BASCULE1",    array(
											 "label" => "Listes en bascule (obligatoire)",
											 "default" => $defaut1,
											 "attrib" => "R",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "120px"
											 ),
								  	         $tableau1 );											 

    $f->frm_SautLignes(2);			

    $f->frm_ObjetChampTexte("TEL",    array( "label" => "N° de téléphone",
											   "default" => $def_tel,
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetChampTexte("HOMME",        array( "label" => "Prénom masculin", "attrib" => "R", "default" => $def_homme));
    $f->frm_SautLignes(2);			





    $f->frm_ObjetChampTexte("FEMME",        array( "label" => "Prénom féminin  (U)", "attrib" => "R", "width" => '100px', "default" => $def_femme));
    $f->frm_ObjetChampTexte("AUTRE",    array( "label" => "Prénom mixte (U)", "attrib" => "R", "width" => '100px', "default" => $def_autre));
    $f->frm_ObjetChampTexte("HOMME2",        array( "label" => "Prénom masculin", "attrib" => "R", "width" => '100px', "default" => $def_homme2));
    $f->frm_ObjetMultiListe("MULTILISTE",       array(
											    "label" => "Liste à choix multiple",
											    "attrib" => "",
												"default" => $def_multiliste,
												"rows" => "4",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "100px"),
								  	          $tableau2
											  );
    $f->frm_SautLignes(2);			


    $f->frm_ObjetListe("MOYEN",         array("label" => "Mode déplacement", "attrib" => "", 'default' => $def_moyen,
											  "help" => "choisir un mode de déplacement",  "width" => "200px"),
										$tableau2
								  	     );



						 



	$f->frm_Ouvrir();
	print "<pre>";
	print_r ($_POST);
	print "</pre>";
	
?>

</blockquote>
</body>
</html>
