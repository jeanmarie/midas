<html>
<head>
<title>SAMPLE20_separateurs.php - Positionnement de séparateur quand le nombre de champs est trop important</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample19_popup.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample21_separateurs_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION DES PARAGRAPHES</span></span>
    <?php
	$sauveretat = false;
	$modeexclusif = isset($_GET['EXCLUSIF']);

	print "<h3>FONCTIONNEMENT DES PARAGRAPHES EN MODE : ";
	if ($modeexclusif)
		print "EXCLUSIF";
	else
		print "NORMAL";
	print "</H3>";
	
	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"400px");
	$f->frm_EnteteDefinir($modeexclusif,$sauveretat);
	
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "N° de téléphone (mask=##.##.##.##.##)",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));


$f->frm_EnteteNouveau("CHAPITRE N°=1");

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Entier simple entre 1 et 1000 (mask=#,inter=1_1000)",
	                                           "attrib" => "N",
											   "mask" => "#",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));


    $f->frm_ObjetChampTexte("MONEY_EURO_CTS",  array( "label" => "Mon salaire en € avec centimes (mask=€#_###.00)",
	                                           "attrib" => "N",
											   "mask" => "€#_###.00",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales obligatoire €#_###.00"));

											   
    $f->frm_ObjetChampTexte("MONEY_EURO",      array( "label" => "Mon salaire en € sans les centimes (mask=€#_###.##)",
	                                           "attrib" => "N",
											   "mask" => "€#_###.##",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales non obligatoire €#_###.##"));
$f->frm_EnteteNouveau("CHAPITRE N°=2 (PRE-DEPLOYE)",true);

    $f->frm_ObjetChampTexte("LETTRES",         array( "label" => "Rien que des 10 lettres (mask=xxxxxxxxxx)",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES",    array( "label" => "5 chiffres ou lettres (mask=*****)",
	                                           "attrib" => "U",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));

    $f->frm_ObjetChampTexte("NOMBRE_SIGNE",    array( "label" => "Nombre entier signé (mask=+#####)",	
	                                           "attrib" => "RN",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));

$f->frm_EnteteNouveau("CHAPITRE N°=3");

    $f->frm_ObjetChampTexte("NOMBRE_SIGNE2",    array( "label" => "Nombre entier signé (mask=+#####)",	
	                                           "attrib" => "RN",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));

	    $f->frm_ObjetChampTexte("NOM",      array( "label" => "Nom (*)", "attrib" => "RU")
		 								    );
	    $f->frm_ObjetChampTexte("PRENOM",   array( "label" => "Prénom (*)", "attrib" => "I")
		 								    );
	    $f->frm_ObjetChampTexte("DATEABON", array( "label" => "Date d'inscription","attrib" => "DP","linesafter" => "1")
											);


	    $f->frm_ObjetChampTexte("NUMRUE",   array( "label" => "N°",
											"attrib" => "RN",
											"width" => "50px",
											"help" => "saisir le numéro de la rue")
											);
	    $f->frm_ObjetChampTexte("NOMRUE",   array( "label" => "Voie",
											"attrib" => "RI",
											"width" => "200px",
											"help" => "saisir le type et le nom de la voie")
											);
	    $f->frm_ObjetChampTexte("CP",       array( "label" => "Code postal",
											"attrib" => "RN",
											"width" => "80px",
											"help" => "saisir le code postal")
											);
	    $f->frm_ObjetChampTexte("VILLE",    array( "label" => "VILLE", 
											"attrib" => "U",
											"width" => "200px")
		 								    );



	$f->frm_Ouvrir();
?>
  </p>
  <p><a href="sample20_separateurs.php?EXCLUSIF=OUI">
    <?php
	if ($modeexclusif)
		print "<a href='sample20_separateurs.php'>paragraphes en mode &quot;normal&quot;";
	else
		print "<a href='sample20_separateurs.php?EXCLUSIF=OUI'>paragraphes en mode &quot;exclusif&quot;";
?>
  </a> </p>
</blockquote>
</body>
</html>
