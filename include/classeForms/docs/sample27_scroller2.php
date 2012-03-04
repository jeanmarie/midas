<html>
<head>
<title>Sample 27 - DEFINITION DE SCROLLER</title>
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
  <p><span class="titre1"><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample27_scroller.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample28_scroller_coche_radio.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>DEFINITION DE SCROLLER</span>
  
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
	#$f->frm_Protection();
	$f->frm_InitScroller("400","90","",false);

	
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "Champ Fixe",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "#",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));

    $f->frm_ObjetChampTexte("MONEY_EURO_CTS",  array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "€#_###.00",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales obligatoire €#_###.00"));
											   
    $f->frm_ObjetChampTexte("MONEY_EURO",      array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "€#_###.##",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales non obligatoire €#_###.##"));
	
	$f->frm_ScrollerOpen();
    $f->frm_ObjetChampTexte("LETTRES",         array( "label" => "DEBUT DE ZONE SCROLL",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES",    array( "label" => "Champ scroll",
	                                           "attrib" => "U",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));

    $f->frm_ObjetChampTexte("NOMBRE_SIGNE",    array( "label" => "Champ scroll",	
	                                           "attrib" => "RN",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));

    $f->frm_ObjetChampTexte("LETTRES2",         array( "label" => "Champ scroll",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES2",    array( "label" => "Champ scroll",
	                                           "attrib" => "U",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));

    $f->frm_ObjetChampTexte("NOMBRE_SIGNE2",    array( "label" => "Champ scroll",	
	                                           "attrib" => "RN",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));

    $f->frm_ObjetChampTexte("PCT_DECIMALES",    array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "%#.##",
											   "help" => "Saisir un avec le masque %#.##"));

    $f->frm_ObjetChampTexte("PCT_DECIMALES_O",    array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "%#.00",
											   "help" => "Saisir un avec le masque %#.00"));

    $f->frm_ObjetChampTexte("PCT",    array( "label" => "FIN DE ZONE SCROLL",
	                                           "attrib" => "N",
											   "mask" => "%#",
											   "help" => "Saisir un avec le masque %#"));


	$f->frm_ScrollerClose();


	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
