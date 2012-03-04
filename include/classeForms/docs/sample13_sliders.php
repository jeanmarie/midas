<html>
<head>
<title>FORM29 - Exemple de SLIDERS</title>
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
<br>
<blockquote>
  <p>  <span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample12_champenerreur.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample14_boutons.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMP SLIDER</span></span>
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
											   "width" => "200px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "10")
											  );

											   

    $f->frm_ObjetSlider("Slider01",     array("label" => "Colonnes", 
										      "orientation" => "H",
											  "width" => "80px",
											  "mini"=> "1",
											  "maxi"=>"3",
											  "default" => "2",
											  "help" => "choisir le nombre de colonnes (1,2 ou 3)")
										);
     $f->frm_ObjetSlider("Slider03",     array("label" => "Lignes", "orientation" => "V", 
										     "height" => "100px",
										     "width" => "80px",
											 "mini"=> "0",
											 "maxi"=>"100",
											 "default" => "8",
											 "help" => "choisir le nombre de lignes (0-100)")
										);

    $f->frm_ObjetSlider("Slider02",     array("label" => "Largeur auto", "orientation" => "V", 
											 "mini"=> "0",
											 "maxi"=>"100",
											 "default" => "8",
											 "help" => "choisir le nombre de lignes (0-100)")
										);

    $f->frm_ObjetSlider("Slider04",     array("label" => "Hauteur auto", "orientation" => "H", 
											 "mini"=> "0",
											 "maxi"=>"100",
											 "default" => "69",
											 "help" => "choisir le nombre de lignes (0-100)")
										);

    $f->frm_ObjetSlider("Slider05",     array("label" => "Champ texte étendu", "orientation" => "H", 
											 "mini"=> "0",
											 "maxi"=>"10000000",
											 "default" => "5000000",
											 "size" => "12",
											 "help" => "choisir le nombre de lignes (0~10.000.000)")
										);


	$f->frm_Ouvrir();
	

	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";	
	
?>
  </p>
</blockquote>
</body>
</html>
