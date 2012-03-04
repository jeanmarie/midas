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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample38_sortselect_separator.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample40_multiliste_blocs.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>LISTE A CHOIX MULTIPLE </span>
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
	

	$def1 = ( empty($_POST['LISTE_T1']) ) ?  "" : $_POST['LISTE_T1'];
	$def2 = ( empty($_POST['LISTE_T2']) ) ?  "3,4,6" : $_POST['LISTE_T2'];
	$def3 = ( empty($_POST['LISTE_T3']) ) ?  "1,6"   : $_POST['LISTE_T3'];



												  
    $f->frm_ObjetMultiListe("LISTE_T1",       array(
											    "label" => "Choix multiple, mode 'normal', choix obligatoire",
												"default" => $def1,
												"attrib" => "R",
												"rows" => "10",
												"help" => "Choix multiple, mode 'normal', choix obligatoire",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T2",       array(
											    "label" => "Mode 'save' l'état est mémorisé mais on peut effacer en réappuyant dessus",
												"default" => $def2,
												"rows" => "10",
												"mode" => "save",
												"help" => "Mode 'save' l'état est mémorisé mais on peut effacer en réappuyant dessus",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T3",       array(
											    "label" => "Mode 'append' l'état est mémorisé mais on ne peut désactiver la sélection qu'en appuyant sur la barre d'icone",
												"default" => $def3,
												"rows" => "10",
												"mode" => "append",
												"help" => "Mode 'append' l'état est mémorisé mais on ne peut désactiver la sélection qu'en appuyant sur la barre d'icone",
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
