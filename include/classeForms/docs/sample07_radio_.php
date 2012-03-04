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
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample07_radio_onglets.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample08_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style1 style3"><strong>CHAMP RADIO AVEC ACTIVATION/DESACTIVATION DYNAMIQUE DE CHAMPS</strong></span></span> (variante avec Onglet par d&eacute;faut) </h4>
  <?php 
	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']         : "0";
	$def_un        = ( isset($_POST['UN']) )               ? $_POST['UN']                 : "Un";	
	$def_deux      = ( isset($_POST['DEUX']) )             ? $_POST['DEUX']               : "Deux";	
	$def_trois     = ( isset($_POST['TROIS']) )            ? $_POST['TROIS']              : "Trois";	



	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false);

	$radio_activation = (isset($_POST['BTN_RAD']))?$_POST['BTN_RAD']:"1";

    $f->frm_ObjetBoutonsRadio("BTN_RAD", array("default" => $radio_activation,
											"label" => "Critère de recherche",   
											  "orientation" => "V",
											  "activation" => array( array("UN","DEUX"),
												                    "DEUX",
																	"TROIS"),
											  "help" => "Sélectionner le filtre",
									     ),
								  	     array( "0" => "Nom du candidat",
												"1" => "Filière",
												"2" => "Niveau d'études")  
							 );							

	$f->frm_SautLignes();
    $f->frm_ObjetChampTexte("UN",          array( "label" => "Un", "attrib" => "R", "default" => $def_un));

    $f->frm_ObjetChampTexte("DEUX",        array( "label" => "Deux", "attrib" => "R", "default" => $def_deux));

    $f->frm_ObjetChampTexte("TROIS",        array( "label" => "Trois", "attrib" => "R", "default" => $def_trois));



 // Fin de définition des champs

	$f->frm_Ouvrir();
	
	print "<pre>";
	print_r ($_POST);
	print "</pre>";
	
?>

</blockquote>
</body>
</html>
