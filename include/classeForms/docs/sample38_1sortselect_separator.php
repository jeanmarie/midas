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
  <p>&nbsp;  </p>
  <p><span class="titre1 style1"><strong><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample37_sortselect.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample38_sortselect_separator.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>LISTE A TRIER AVEC OPTION SEPARATEUR&#8212;</span>
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
	

	$defliste = ( empty($_POST['LISTE']) ) ?  "6" : $_POST['LISTE'];

	$def1   = ( isset($_POST['LISTE_T1']) )        ?  $_POST['LISTE_T1'] : "6,5,4,3,2,1";
	$cochedefaut = ( isset($_POST['ACTIVATION']) )     ?  $_POST['ACTIVATION'] : "0";
	$cocheRO  = ( isset($_POST['READONLY']) )  ? $_POST['READONLY']  : "1";

	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION (Cocher pour activer)", "title" => "Activer",
											"help" => "Sélectionner pour activer la liste ci-dessous",
											"default" => $cochedefaut, 
											"attrib" => ($cocheRO =="1") ? "+" : "",
											"activation" => array("LISTE_T1")  )
											  );
												  
    $f->frm_ObjetSortSelect("LISTE_T1",       array(
											    "label" => "Liste pré-triée en ordre inverse",
												"default" => $def1,
												"rows" => "10",
												"attrib" => ($cocheRO =="1") ? "+" : "",
												"separators" => "true",
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableau1
											  );

	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("READONLY",      array( "label" => "Lecture seule", 
											"title" => "L'objet ci-dessus est en lecture seule (après validation du formulaire au prochain appel)",
											"help" => "La prise en compte de l'option se fera à la prochaine validation",
											"default" => $cocheRO, 
											  )
										);
	$f->frm_ActiverBtnValider();
	$f->frm_Ouvrir();
	print "<hr><pre>\$_POST()=";
	print_r($_POST);
	print "</pre>";

?>
  </p>
</blockquote>
</body>
</html>
