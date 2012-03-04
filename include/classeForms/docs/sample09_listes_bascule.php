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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_ajax_param3.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample09_listes_bascule_radio.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTE EN BASCULE AVEC OU SANS TRI &quot; </span></span>
    <?php		
	$coche_activation = ( isset($_POST['ACTIVATION']) )       ? $_POST['ACTIVATION']  : "1";
	$defaut           = ( isset($_POST['LISTE_BASCULE']) )    ? $_POST['LISTE_BASCULE']     : "2,1,3";
	$defaut2          = ( isset($_POST['LISTE_BASCULE2']) )   ? $_POST['LISTE_BASCULE2']     : "4,3,1";

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tableau1 = array( "1" => "1-Paris", "2" => "2-Lyon", "3" => "3-Marseille", "4" => "4-Toulouse", "5" => "5-Bordeaux", "6" => "6-Nantes" );
	
    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION", "title" => "Activer les bascules ci-dessous",
											"help" => "Sélectionner pour activer le choix",
											"default" => $coche_activation, 
											"activation" => array("LISTE_BASCULE","LISTE_BASCULE2")  )
											  );

    $f->frm_SautLignes(1);			
										   
											 
    $f->frm_ObjetBascule("LISTE_BASCULE",    array(
											 "label" => "Listes en bascule (tri auto)",
											 "default" => $defaut,
											 "attrib" => "R",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins une ville",
											 "width" => "120px"
											 ),
								  	         $tableau1 );											 
    $f->frm_SautLignes(2);			

    $f->frm_ObjetBascule("LISTE_BASCULE2",    array(
											 "label" => "non obligatoire+tri manuel",
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
											 "label" => "en lecture seule",
											 "default" => "1,3",
											 "attrib" => "+",
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
