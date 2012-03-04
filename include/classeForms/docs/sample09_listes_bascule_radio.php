<html>
<head>
<title>Manipulation de liste en bascule</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample09_listes_bascule.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample12_champenerreur.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTE EN BASCULE AVEC OU SANS TRI&quot; PILOTES AVEC UN CHAMP RADIO  </span></span>
    <?php		
	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']  : "1";
	$defaut1          = ( isset($_POST['LISTE_BASCULE1']) )   ? $_POST['LISTE_BASCULE1']     : "2,1,3";
	$defaut2          = ( isset($_POST['LISTE_BASCULE2']) )   ? $_POST['LISTE_BASCULE2']     : "4,3,1";
	$defaut3          = ( isset($_POST['LISTE_BASCULE3']) )   ? $_POST['LISTE_BASCULE3']     : "4,3,1";

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tableau1 = array( "1" => "1-Paris", "2" => "2-Lyon", "3" => "3-Marseille", "4" => "4-Toulouse", "5" => "5-Bordeaux", "6" => "6-Nantes" );
	
    $f->frm_ObjetBoutonsRadio("BTN_RAD", array("label" => "Activer",
	                                          "default" =>$radio_activation,
											  "help" => "Activation d'une bascule après l'autre",
											  "activation" => array("LISTE_BASCULE1","LISTE_BASCULE2","LISTE_BASCULE3") ),
								  	     array( "1" => "Liste 1", "2" => "Liste 2", "3" => "Liste 3" )
										);

    $f->frm_SautLignes(1);			
										   
											 
    $f->frm_ObjetBascule("LISTE_BASCULE1",    array(
											 "label" => "Listes en bascule (obligatoire)",
											 "default" => $defaut1,
											 "attrib" => "R",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "120px"
											 ),
								  	         $tableau1 );											 
    $f->frm_SautLignes(2);			

    $f->frm_ObjetBascule("LISTE_BASCULE2",    array(
											 "label" => "2) tri manuel",
											 "default" => $defaut2,
											 "attrib" => "",
											 "rows"   => "10",
											 
											 "sort"   => true,
											 
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite triable",
											 "help" => "choisir une ville [optionnel]",
											 "width" => "120px"
											 ),
								  	         $tableau1 );											 

    $f->frm_SautLignes(2);			

    $f->frm_ObjetBascule("LISTE_BASCULE3",    array(
											 "label" => "3) tri manuel",
											 "default" => $defaut3,
											 "attrib" => "",
											 "rows"   => "10",
											 
											 "sort"   => true,
											 
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite triable",
											 "help" => "choisir au moins une ville",
											 "width" => "120px"
											 ),
								  	         $tableau1 );											 

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
