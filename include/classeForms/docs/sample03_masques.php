<html>
<head>
<title>Manipulation des masques de saisie</title>
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



<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample02_protection.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample04_dates.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION DES MASQUES DANS LES CHAMPS TEXTES </span></span> 
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"400px");
	#$f->frm_Protection();


	
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "N° de téléphone (mask=##.##.##.##.##)",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Entier simple entre 1 et 1000 (mask=#,inter=1_1000)",
	                                           "attrib" => "RN",
											   "mask" => "#",
											   "default" => "0",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));

    $f->frm_ObjetChampTexte("MONEY_EURO_CTS",  array( "label" => "Mon salaire en € avec centimes (mask=€#_###.00)",
	                                           "attrib" => "N",
											   "mask" => "€#_###.00",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales obligatoire €#_###.00"));
											   
    $f->frm_ObjetChampTexte("MONEY_EURO",      array( "label" => "Mon salaire en € sans les centimes (mask=€#_###.##)",
	                                           "attrib" => "RN",
											   "mask" => "€#_###.##",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales non obligatoire €#_###.##"));

    $f->frm_ObjetChampTexte("LETTRES",         array( "label" => "Rien que des 10 lettres (mask=xxxxxxxxxx)",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES",    array( "label" => "5 chiffres ou lettres (mask=*****)",
	                                           "attrib" => "U",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES_RO",    array( "label" => "READONLY (+)",
	                                           "attrib" => "U+",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));
											   
											   
    $f->frm_ObjetChampTexte("NOMBRE_SIGNE",    array( "label" => "Nombre entier signé (mask=+#####)",	
	                                           "attrib" => "RN",
											   "default" => "0",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));
											   
											   
    $f->frm_ObjetChampTexte("NOMBRE_SIGNE_DIS",    array( "label" => "DISABLED (-)",	
	                                           "attrib" => "N-",
											   "mask" => "+#####",
											   "default" => "10",
											   "help" => "Saisir un entier signé +#####"));
											   
    $f->frm_ObjetChampTexte("PCT",    array( "label" => "Pourcentage entier",
	                                           "attrib" => "N",
											   "mask" => "%#",
											   "help" => "Saisir un avec le masque %#"));


    $f->frm_ObjetChampTexte("PCT_DECIMALES",    array( "label" => "Pourcentage avec 2 décimales non obligatoires",
	                                           "attrib" => "N",
											   "mask" => "%#.##",
											   "help" => "Saisir un avec le masque %#.##"));

    $f->frm_ObjetChampTexte("PCT_DECIMALES_O",    array( "label" => "Pourcentage avec 2 décimales obligatoires",
	                                           "attrib" => "N",
											   "mask" => "%#.00",
											   "help" => "Saisir un avec le masque %#.00"));

    $f->frm_InitFocus();
	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
