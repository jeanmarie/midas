<html>
<head>
<title>Manipulation de listes</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_cascade7.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_liste_longue_seule.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES EDITABLES &quot; </span></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tableau1 = array( "1" => "1-Paris", "2" => "2-Lyon", "3" => "3-Marseille", "4" => "4-Toulouse", "5" => "5-Bordeaux", "6" => "6-Nantes" );
	
	// ANALYSE DES VALEURS ENREGISTREES

	// POUR LA 1ERE LISTE
	if ( isset($_POST['LISTE_1']) ) {
		if  ($_POST['LISTE_1']==-1)
			$def_liste1 = $_POST['LISTE_1_EDIT'];
		else		
			$def_liste1 = $_POST['LISTE_1'];
	
	} else {
		$def_liste1 = "Bruxelles";
	}

	// POUR LA 2EME LISTE
	if ( isset($_POST['LISTE_2']) ) {
		if  ($_POST['LISTE_2']==-1)
			$def_liste2 = $_POST['LISTE_2_EDIT'];
		else		
			$def_liste2 = $_POST['LISTE_2'];
	
	} else {
		$def_liste2 = "2";
	}


	// POUR LA 3EME LISTE
	if ( isset($_POST['LISTE_3']) ) {
		if  ($_POST['LISTE_3']==-1)
			$def_liste3 = $_POST['LISTE_3_EDIT'];
		else		
			$def_liste3 = $_POST['LISTE_3'];
	
	} else {
		$def_liste3 = $tableau1[3];
	}

	if ( isset($_POST['ACTIVER_LISTE5']) ) {
		$etatcoche = $_POST['ACTIVER_LISTE5'];
	} else {
		$etatcoche = "1";
	}

	// POUR LA 5EME LISTE
	if ( isset($_POST['LISTE_5']) ) {
		if  ($_POST['LISTE_5']==-1)
			$def_liste5 = $_POST['LISTE_5_EDIT'];
		else		
			$def_liste5 = $_POST['LISTE_5'];
	
	} else {
		$def_liste5 = $tableau1[5];
	}
							
    $f->frm_ObjetChampTexte("TEXTE",      array( "label" => "Texte normal",
												 "default" => "Mot quelconque",
												 "width" => "200px", 
												 )
											  );
						 
	$f->frm_SautLignes(1);
	
    $f->frm_ObjetListeEditable("LISTE_1",    array(
											 "label" => "Liste éditable n°=1",
	                                         "attrib" => "RI", 
											 "default" => $def_liste1,
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle (les valeurs hors liste sont en italique)",
											 ),
											 $tableau1 );

    $f->frm_ObjetListeEditable("LISTE_2",    array(
											 "label" => "Liste éditable n°=2",
											 "default" => $def_liste2,
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );

    $f->frm_ObjetListeEditable("LISTE_3",    array(
											 "label" => "Liste éditable n°=3",
											 "default" => $def_liste3,
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );
	$f->frm_SautLignes(1);

    $f->frm_ObjetListeEditable("LISTE_4",    array(
											 "label" => "Liste éditable inactive",
											 "default" => "2",
	                                         "attrib" => "-", 
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );

	$f->frm_SautLignes(2);
    $f->frm_ObjetCoche("ACTIVER_LISTE5",   array( "label" => "Cocher pour activer", "title" => "Activer le champ suivant",
											"help" => "Sélectionner Si nécessaire",
											"activation" => array("LISTE_5"),
											"default" => $etatcoche )
											  );

    $f->frm_ObjetListeEditable("LISTE_5",    array(
											 "label" => "Liste éditable activable",
											 "default" => $def_liste5,
											 "width" => "200px", 
											 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
											 ),
											 $tableau1 );

											 
	$f->frm_ActiverBtnValider(); 
	$f->frm_Ouvrir();
	
	print "<hr>";
	print '$def_liste1 = '.$def_liste1;
	print '<br>$def_liste2 = '.$def_liste2;
	print '<br>$def_liste3 = '.$def_liste3;
	
	print "<hr><pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
		
	
?>
  </p>
</blockquote>
</body>
</html>
