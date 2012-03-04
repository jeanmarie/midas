<html>
<head>
<title>Manipulation d'une liste à choix multiple</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample39_multiliste_normale.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample41_multiliste_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>LISTE DE CHOIX DE VALEURS DANS UNE PLAGE </span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");

	$tableau1 = array( 	"1" => "08:00 - 09:00", 
						"2" => "09:00 - 10:00", 
						"3" => "10:00 - 11:00", 
						"4" => "11:00 - 12:00", 
						"5" => "12:00 - 13:00", 
						"6" => "13:00 - 14:00", 
						"7" => "14:00 - 15:00",
						"8" => "15:00 - 16:00",
						"9" => "16:00 - 17:00",
						"10" => "17:00 - 18:00",
						 );
	

	$def1 = ( empty($_POST['LISTE_T1']) ) ?  "2,3,4" : $_POST['LISTE_T1'];
	$def2 = ( empty($_POST['LISTE_T2']) ) ?  "3,4,6" : $_POST['LISTE_T2'];
	$def3 = ( empty($_POST['LISTE_T3']) ) ?  "1,2,3,4"   : $_POST['LISTE_T3'];



												  
    $f->frm_ObjetMultiListe("LISTE_T1",       array(
											    "label" => "Choix multiple<br>mode 'normal'",
												"default" => $def1,
												"rows" => "10",
												"modeblock" => true,
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T2",       array(
											    "label" => "Mode 'save'<br>bloc continu avec restauration de la sélection",
												"default" => $def2,
												"rows" => "10",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"mode" => "save",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T3",       array(
											    "label" => "bloc continu avec effacement en cas d'erreur",
												"default" => $def3,
												"rows" => "10",
												"mode" => "append",
												"modeblock" => true,
												"modeblockrestore" => false,
												"modeblockmessage" => "ATTENTION : 'La plage horaire doit être continue, toute la sélection est effacée",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
												  
	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION (Cocher pour activer)", "title" => "Activer",
											"help" => "Sélectionner pour activer la liste ci-dessous",
											"default" => $cochedefaut, 
											"activation" => array("LISTE_T4")  )
											  );

    $f->frm_ObjetMultiListe("LISTE_T4",       array(
											    "label" => "Liste en attribut '-'",
												"default" => "2,3,4,5",
												"rows" => "10",
												"toolbar" => "true",
												"attrib" => "-",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T5",       array(
											    "label" => "Liste en attribut '+'",
												"default" => "1,2,3,7,8",
												"toolbar" => "true",
												"rows" => "10",
												"attrib" => "+",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
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
