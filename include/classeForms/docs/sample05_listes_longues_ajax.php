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

<script>
<!-- ACTIVATION OU NON DE L'OBJET DE SELECTION DU TYPE D'EXPEDITEUR -->
	function mon_script() {
		var obj = MM_findObj('NOM');
		if (objLISTE_LONGUE4.LongList_IsTheValueAdded()) {
			if (obj) obj.disabled = true;
			// alert('mon_script() -> valeur ajoutee, champ "NOM" désactivé');
		} else {
			if (obj) obj.disabled = false;
			// alert('mon_script() -> valeur dans la liste, champ "NOM" réactivé');
		}
	}
</script>

<blockquote>
  <p>&nbsp;</p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_script.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues_script.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES LONGUES &quot; (Filtres dynamiques AJAX) </span></span>
    <?php		

	include('classeForms.php');		

	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']  : "1";										
	$def_LISTE_LONGUE = ( isset($_POST['LISTE_LONGUE']) )  ? $_POST['LISTE_LONGUE']       : "";	
	$def_LISTE_LONGUE2 = ( isset($_POST['LISTE_LONGUE2']) )  ? $_POST['LISTE_LONGUE2']    : "";	
	if ($def_LISTE_LONGUE2=="-1") {
		$def_LISTE_LONGUE2 = $_POST['LISTE_LONGUE2_EDIT'];
	}
	$def_LISTE_LONGUE4 = ( isset($_POST['LISTE_LONGUE4']) )  ? $_POST['LISTE_LONGUE4']    : "";	
	if ($def_LISTE_LONGUE4=="-1") {
		$def_LISTE_LONGUE4 = $_POST['LISTE_LONGUE4_EDIT'];
	}
	$mode_debug = ( isset($_POST['MODE_DEBUG']) )  ? stripslashes($_POST['MODE_DEBUG'])       : "";	

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tablecom = array("035" => "La Chapelle-sur-Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce", "070" => "Saint-Herblain", "080" => "Rezé", "090" => "Saint-Sébastien-sur-Loire", "100" => "Bouguenais", "110" => "Coueron" );

	$def_NOM = ( isset($_POST['NOM']) )  ? $_POST['NOM']       : "CE CHAMP EST INACTIF QUAND UNE VALEUR EST AJOUTEE DANS LA DERNIERE LISTE";	

	
    $f->frm_ObjetBoutonsRadio("BTN_RAD", array("label" => "Activer",
	                                          "default" =>$radio_activation,
											  "help" => "Activation d'une liste après l'autre",
											  "activation" => array("LISTE_LONGUE",array("LISTE_LONGUE2","LISTE_LONGUE4")) ),
								  	     array( "1" => "Liste 1", "2" => "Liste 2" )
										);

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "U",
											   "width" => 500,
											   "help" => "Saisir un nom"));

	$f->frm_SautLignes(2);
	
				
    $f->frm_ObjetListeLongue("LISTE_LONGUE",   array("label" => "Communes de la Loire-Atlantique",
							 "default" => $def_LISTE_LONGUE,		
							 "attrib" => "RU",
							 "rows" => "5",
							// -------------------------------------------------
							 "ajax" => "sample05_listes_longues_ajax_called.php",
							 "ajaxmodedebug" => $mode_debug,
							 "ajaxautosearch" => true,
							// "ajaxautosearchminlength" => 1,
							// -------------------------------------------------
							 "help" => "choisir une commune du département",
							 "width" => "250"),
							 array() 
							 );
    
	$f->frm_SautLignes(1);			
	
    $f->frm_ObjetListeLongue("LISTE_LONGUE2",   array("label" => "Ajout possible, RECHERCHE auto à partir de 3 caractères",
							 "default" => $def_LISTE_LONGUE2,
							 "addvalue"	=> true,
							 "maxlength" => 30,	
							 "attrib" => "RU",
							// -------------------------------------------------
							 "ajax" => "sample05_listes_longues_ajax_called.php",
							 "ajaxautosearchminlength" => 3,
							 "ajaxmodedebug" => $mode_debug,
							// -------------------------------------------------
							 "rows" => "6",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "250"),
							  array()  );

    $f->frm_ObjetListeLongue("LISTE_LONGUE4",   array("label" => "AJOUT POSSIBLE à partir de 3 caractères, RECHERCHE AUTO quelque soit le nombre de caractères",
							 "default" => $def_LISTE_LONGUE4,
							 "addvalue"	=> true,
							 "addminlength" => 3,
							 "maxlength" => 30,	
							 "attrib" => "RU",
							 "script" => "mon_script()",
							// -------------------------------------------------
							 "ajax" => "sample05_listes_longues_ajax_called.php",
							 "ajaxautosearch" => true,
							 "ajaxmodedebug" => $mode_debug,
							// -------------------------------------------------
							 "rows" => "6",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "250"),
							  array()  );


    $f->frm_ObjetCoche("MODE_DEBUG",   array( "label" => "Mode debug", 
											"title" => "Activer le mode debug au prochain appel à la page",
											"default" => $mode_debug,
											 )
									  );	   
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
