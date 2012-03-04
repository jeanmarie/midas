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
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample07_radio.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample07_radio_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style1 style3"><strong>CHAMP COCHE ET RADIO AVEC ACTIVATION/DESACTIVATION DYNAMIQUE DE CHAMPS</strong></span></span></h4>
<?php 
	$def_RADIO = ( isset($_POST['BTNRADIO3']) )  ? $_POST['BTNRADIO3']    : "";
	$def_DATE = ( isset($_POST['DATE']) )  ? $_POST['DATE']    : "";
	$def_TIMESTAMP = ( isset($_POST['TIMESTAMP']) )  ? $_POST['TIMESTAMP']    : "TIMER";

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,'250px');
	$tableau1 = array( "1" => "Un", "2" => "Deux", "3" => "Trois","4" => "Quatre (seulement Time stamp)", "5" => "Aucun des champs", "6"=>"Tous les champs");

    $f->frm_ObjetChampTexte("QUELCONQUE",        array( "label" => "Quelconque", "attrib" => "R", "default" => "Anything..."));
    $f->frm_ObjetBoutonsRadio("BTNRADIO3", array("label" => "<b>Sexe (mode intersection)</b>",
	                                          "default" => $def_RADIO,
											  "orientation" => "V",
											  "help" => "cocher Homme ou Femme pour choisir un prénom",
	  										  "activation" => array(
											  					array("H3","AUTRE3"),
																array("F3","AUTRE3","TOUT_SAUF_H"),
																array("AUTRE3","TOUT_SAUF_H","DATE","QUATRE"),
																"QUATRE",
																"",
																array("H3","F3","AUTRE3","TOUT_SAUF_H","DATE","QUATRE")
															)
											),
					  	     $tableau1
	);

    $f->frm_ObjetChampTexte("H3",        array( "label" => "Prénom masculin", "attrib" => "R", "default" => "Jean"));
    $f->frm_ObjetChampTexte("F3",        array( "label" => "Prénom féminin  (U)", "attrib" => "R", "default" => "Paulette", "linesafter" => 1));
    $f->frm_ObjetChampTexte("AUTRE3",    array( "label" => "Prénom mixte (U)", "attrib" => "R", "default" => "Camille"));
    $f->frm_ObjetChampTexte("TOUT_SAUF_H", array( "label" => "Tout sauf masculin", "attrib" => "R", "default" => "Tout sauf 1"));
    $f->frm_ObjetChampTexte("DATE",        array( "label" => "<strong>Date</strong> sans calendrier vierge (attrib=D)",
	                                         "attrib" => "RDP",
											 "default" => $def_DATE,
											 )
											 );
											   
    $f->frm_ObjetChampTexte("QUATRE",     array( "label" => "Time stamp (attrib=T)",
	                                         "attrib" => "T",
											 "help" => "sélectionner une date dans le calendrier",
											 "default" => $def_TIMESTAMP)
											 );
											 


	$f->frm_Ouvrir();
	print "<hr>";
	print "<pre>";
	print_r($_POST);
	print "</pre>";
?>

  <p>&nbsp;</p>
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
