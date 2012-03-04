<html>
<head>
<title>Manipulation d'une liste à trier</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p>&nbsp;</p>
  <p>  <span class="titre1 style1"><strong><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample36_memo_editeur_onglet.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample38_1sortselect_separator.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>LISTE A TRIER</span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");

	$tableau1 = array( 	"1" => "1-Paris", 
						"2" => "2-Lyon", 
						"3" => "3-Marseille", 
						"4" => "4-Toulouse", 
						"5" => "5-Bordeaux", 
						"6" => "6-Nantes" );
	
	$coche    = ( isset($_POST['ACTIVATION']) ) ?  $_POST['ACTIVATION'] : "0";
	$def1     = ( isset($_POST['LISTE_T1']) ) ?  $_POST['LISTE_T1'] : "6,5,4,-,1,-";
	$def2     = ( isset($_POST['LISTE_T2']) ) ?  $_POST['LISTE_T2'] : "7,6,5,4,2,3,15";
	$def3     = ( isset($_POST['LISTE_T3']) ) ?  $_POST['LISTE_T3'] : "";
	$def4     = ( isset($_POST['LISTE_T4']) ) ?  $_POST['LISTE_T4'] : "";
	$def5     = ( isset($_POST['LISTE_T5']) ) ?  $_POST['LISTE_T5'] : "1,3,2,4,6,5";

    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION (Cocher pour activer)", "title" => "Activation des listes ci-dessous",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $coche, 
											"activation" => array("LISTE_T1","LISTE_T2"),
											"noactivation" => array("LISTE_T3"),
										  )
						  );

	
	$f->frm_SautLignes(2);

												  
    $f->frm_ObjetSortSelect("LISTE_T1",       array(
											    "label" => "Liste pré-triée en ordre inverse",
												"default" => $def1,
												"rows" => "10",
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
												  
    $f->frm_ObjetSortSelect("LISTE_T2",      array(
											    "label" => "Liste à trier",
												"rows" => "6",
												"default" => $def2,
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableau1
											  );
											  
    $f->frm_ObjetSortSelect("LISTE_T3",      array(
											    "label" => "Liste à trier n°=3",
												"rows" => "6",
												"default"   => $def3,
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableau1
											  );
											  											  
    $f->frm_ObjetSortSelect("LISTE_T4",      array(
												"attrib" => "+",
											    "label" => "Liste à trier READONLY (+)",
												"rows" => "6",
												"default" => $def4,
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableau1
											  );
											  
 

	$f->frm_Ouvrir();

	print "<hr><pre>\$_POST()=";
	print_r($_POST);
	print "</pre>";

?>
  </p>
</blockquote>
</body>
</html>
