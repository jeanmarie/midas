<html>
<head>
<title>SAMPLE 32 - Bouton "valider" préactivé</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<p>&nbsp;</p>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p><strong><span class="titre1 style1"><a href="index.php#ANNEXES"><img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample31_colorpicker.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample33_coche_graphiques.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span>LE BOUTON &quot;VALIDER&quot; EST PRE-ACTIVE</strong><br>
    <?php

	include("classeForms.php");		

	$f = New Forms;

    $f->frm_Init();
	#$f->frm_Protection();
	$f->frm_ActiverBtnValider();

    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
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

											   
	// $f->frm_LibBoutons("OK","Sortir","Annuler");
	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
