<html>
<head>
<title>Manipulation des attributs</title>
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
  <p><span class="titre1 style1"><span class="titre1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample15_readonly.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample17_sautlignes.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>TOUS LES ATTRIBUTS D'UN CHAMP TEXTE</span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px",true);
	
    $f->frm_ObjetChampTexte("NOM",    array(   "label" => "TOUT LE CHAMP EN MAJUSCULE (U)",
											   "attrib" => "U",
											   "width" => "300px",
											   "default" => "TOUT LE CHAMP EN MAJUSCULE",
											   "help" => "Chaque caractère est transformé en majuscule"));

    $f->frm_ObjetChampTexte("PRENOM",    array( "label" => "Initiale En Majuscule (I)",
											   "attrib" => "I",
											   "width" => "300px",
											   "default" => "Initiale En Majuscule",
											   "help" => "Chaque caractère est transformé en minuscule sauf l'initiale de chaque mot en majuscule"));

    $f->frm_ObjetChampTexte("MINUSCULE",    array( "label" => "tout le champ en minuscule (L)",
											   "attrib" => "L",
											   "width" => "300px",
											   "default" => "tout le champ en minuscule",
											   "help" => "Chaque caractère est transformé en minuscule"));

    $f->frm_ObjetChampTexte("EMAIL",    array( "label" => "champ d'adresse e-mail (M)",
											   "attrib" => "M",
											   "width" => "300px",
											   "default" => "nom@domaine.com",
											   "help" => "Chaque caractère est transformé en minuscule un controle est fait a la validation de la grille"));

    $f->frm_ObjetChampTexte("PASSWORD",    array( "label" => "Mot de passe (W)",
											   "attrib" => "W",
											   "width" => "50px",
											   "default" => "123456",
											   "help" => "Saisie un mot de passe"));

	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
