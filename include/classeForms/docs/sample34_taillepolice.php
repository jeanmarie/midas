<html>
<head>
<title>Changement de la taille des fontes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<p>&nbsp;</p>
<blockquote>
  <h4><strong><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample33_coche_graphiques.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample35_bufferedoutput.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span></strong>MODIFIER LA TAILLE DE LA POLICE <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"400px");
	$taillefonte = 10;
	if (isset($_POST['TAILLEPOLICE'])) {
		$taillefonte = $_POST['TAILLEPOLICE'];
		$f->frm_InitFont($taillefonte);
	}
	#$f->frm_Protection();


	
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "N° de téléphone",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Entier simple 1 à 1000",
	                                           "attrib" => "N",
											   "mask" => "#",
											   "default" => "500",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));

    $f->frm_ObjetChampTexte("MONEY_EURO_CTS",  array( "label" => "Mon salaire en €",
	                                           "attrib" => "N",
											   "mask" => "€#_###.00",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales obligatoire €#_###.00"));
											   
    $f->frm_ObjetChampTexte("MONEY_EURO",      array( "label" => "Mon salaire en € sans les cts",
	                                           "attrib" => "N",
											   "mask" => "€#_###.##",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales non obligatoire €#_###.##"));

    $f->frm_ObjetChampTexte("LETTRES",         array( "label" => "Rien que des 10 lettres",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));

    $f->frm_ObjetChampTexte("LETTRES_CHIFFRES",    array( "label" => "5 chiffres ou lettres",
	                                           "attrib" => "U",
											   "mask" => "*****",
											   "help" => "Saisir à travers le masque *****"));

										   
											   
    $f->frm_ObjetChampTexte("NOMBRE_SIGNE",    array( "label" => "Nombre entier signé",	
	                                           "attrib" => "N",
											   "default" => "0",
											   "mask" => "+#####",
											   "help" => "Saisir un entier signé +#####"));
											   
											   										   
    $f->frm_ObjetChampTexte("PCT",    array( "label" => "% entier",
	                                           "attrib" => "N",
											   "mask" => "%#",
											   "help" => "Saisir un avec le masque %#"));


    $f->frm_ObjetSlider("TAILLEPOLICE",     array("label" => "TAILLE DE LA POLICE STANDARD", 
										      "orientation" => "H",
											  "width" => "80px",
											  "mini"=> "9",
											  "maxi"=>"20",
											  "default" => $taillefonte,
											  "help" => "choisir la taille de la police par défaut (9 à 20)")
										);
    $f->frm_SautLignes(2);			

	$f->frm_Ouvrir();
?>
  </h4>
</blockquote>
</body>
</html>
