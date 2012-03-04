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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_liste_longue_seule.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues_script.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES LONGUES &quot; (Filtres dynamiques sur tables pr&eacute;charg&eacute;es, ne convient pas aux grandes tables de plusieurs centaines d'&eacute;l&eacute;ments) </span></span>
    <?php		

	include('classeForms.php');		

	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']  : "1";										
	$def_LISTE_LONGUE = ( isset($_POST['LISTE_LONGUE']) )  ? $_POST['LISTE_LONGUE']       : "";	
	$def_LISTE_LONGUE2 = ( isset($_POST['LISTE_LONGUE2']) )  ? $_POST['LISTE_LONGUE2']    : "";	
	$def_LISTE_LONGUE4 = ( isset($_POST['LISTE_LONGUE4']) )  ? $_POST['LISTE_LONGUE4']    : "";	
	if ($def_LISTE_LONGUE2=="-1") {
		$def_LISTE_LONGUE2 = $_POST['LISTE_LONGUE2_EDIT'];
	}
	if ($def_LISTE_LONGUE4=="-1") {
		$def_LISTE_LONGUE4 = $_POST['LISTE_LONGUE4_EDIT'];
	}

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tablecom = array("035" => "La Chapelle-sur-Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce", "070" => "Saint-Herblain", "080" => "Rezé", "090" => "Saint-Sébastien-sur-Loire", "100" => "Bouguenais", "110" => "Coueron" );

	$def_NOM = ( isset($_POST['NOM']) )  ? $_POST['NOM']       : "my_name";	

	
    $f->frm_ObjetBoutonsRadio("BTN_RAD", array("label" => "Activer",
	                                          "default" =>$radio_activation,
											  "help" => "Activation d'une liste après l'autre",
											  "activation" => array("LISTE_LONGUE",array("LISTE_LONGUE2","LISTE_LONGUE4") ) ),
								  	     array( "1" => "Liste 1", "2" => "Liste 2" )
										);

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "U",
											   "maxlength" => 20,	
											   "width" => 300,
											   "help" => "Saisir un nom"));

	$f->frm_SautLignes(2);
	
				
    $f->frm_ObjetListeLongue("LISTE_LONGUE",   array("label" => "Communes",
							 "default" => $def_LISTE_LONGUE,		
							 "attrib" => "RU",
							 "rows" => "5",
							 "help" => "choisir une commune du d'épartement",
							 "width" => "250"),
							 $tablecom );
    
	$f->frm_SautLignes(1);			
	
    $f->frm_ObjetListeLongue("LISTE_LONGUE2",   array("label" => "Saisie possible",
							 "default" => $def_LISTE_LONGUE2,
							 "addvalue"	=> true,
							 "maxlength" => 30,	
							 "attrib" => "R",
							 "rows" => "6",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "250"),
							 $tablecom );
	$f->frm_SautLignes(2);			

    $f->frm_ObjetListeLongue("LISTE_LONGUE4",   array("label" => "Saisie si > 3 caractères",
							 "default" => $def_LISTE_LONGUE4,
							 "addvalue"	=> true,
							 "addminlength"	=> 3,
							 "maxlength" => 30,	
							 "attrib" => "RU",
							 "rows" => "6",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "250"),
							 $tablecom );
	$f->frm_SautLignes(2);			
	
    $f->frm_ObjetListeLongue("LISTE_LONGUE3",   array("label" => "Lecture seule",
							 "default" => "035",
							 "attrib" => "+",
							 "rows" => "4",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "250"),
							 $tablecom );
											 										 
	//$f->frm_ActiverBtnValider(); 
	$f->frm_Ouvrir();
	

	
	print "<hr><pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
		
	
?>
  </p>
</blockquote>
</body>
</html>
