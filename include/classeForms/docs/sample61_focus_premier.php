<html>
<head>
<title>SAMPLE 61 - Activer un champ le 1er champ du formulairet</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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


<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample60_focus.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample62_focus_et_selection.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">ACTIVER LE 1ER CHAMP DU FORMULAIRE </span></span>
    <?php

	$tableau = array( "1"=>"Lundi", 
							 "2"=>"Mardi", 
							 "3"=>"Mercredi",
							 "4"=>"Jeudi",
							 "5"=>"Vendredi",
							 "6"=>"Samedi",
							 "7"=>"Dimanche",
							 "8"=>"RENE\"Jean",
							 "9"=>"TOTO'@dfdf.fr"
							 );

	include("classeForms.php");		

	$f = New Forms;

	// -------------- ACTIVATION DU 1ER CHAMP

    $f->frm_Init(false,"150px",true);

    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "R", 
											   "width" => "200px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );

    $f->frm_ObjetChampTexte("Nombre",      array( "label" => "Nombre :",    
	                                           "attrib" => "RN", 
											   "width" => "50px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "10")
											  );
    $f->frm_ObjetListe("LISTE_OBLIG",           array(
											    "label" => "Choix obligatoire (*)",
												"attrib" => "R",
												"default" => "5",
												"help" => "choisir  OBLIGATOIREMENT un élément de la liste",
												"width" => "200px"),
								  	          $tableau 
											  );
											  
    $f->frm_ObjetBoutonsRadio("BtnRad", array("label" => "Genre",
	                                          "default" => "1",
											  "help" => "cocher Homme ou Femme pour choisir un prénom"),
								  	     array('1'=>'Masculin', '2'=> 'Feminin')
										);

    $f->frm_InitFocus();
											   

	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
