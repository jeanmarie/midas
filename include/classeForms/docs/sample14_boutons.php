<html>
<head>
<title>SAMPLE 14 - Modifier les libellés des boutons</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample13_sliders.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample15_consultation.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">MODIFICATION DU LIBELLE DES BOUTONS </span></span>
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

    $f->frm_Init();
	#$f->frm_Protection();
//	$f->frm_ActiverBtnValider();
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

											   
	$f->frm_LibBoutons("OK","Sortir","Annuler");


	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
