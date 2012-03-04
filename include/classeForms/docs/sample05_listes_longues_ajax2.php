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
		if (objLISTE_LONGUE.LongList_IsTheValueAdded()) {
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_ajax.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues_ajax_param.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES LONGUES &quot; (Filtres dynamiques AJAX et ajout possible) </span></span>
    <?php		

	include('classeForms.php');		

	$def_LISTE_LONGUE = ( isset($_POST['LISTE_LONGUE']) )  ? $_POST['LISTE_LONGUE']    : "";	
	if ($def_LISTE_LONGUE=="-1") {
		$def_LISTE_LONGUE = $_POST['LISTE_LONGUE_EDIT'];
	}

	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']  : "1";										
	$mode_debug = ( isset($_POST['MODE_DEBUG']) )  ? stripslashes($_POST['MODE_DEBUG'])       : "";	

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$def_NOM = ( isset($_POST['NOM']) )  ? $_POST['NOM']       : "CHAMP QUELCONQUE QUI DEVIENT INACTIF SI VALEUR AJOUTEE CI DESSOUS";	

	

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "U",
											   "width" => "250px",
											   "help" => "Saisir un nom"));


	
	$f->frm_SautLignes(1);
    $f->frm_ObjetListeLongue("LISTE_LONGUE",   array("label" => "AJOUT POSSIBLE à partir de 3 caractères, RECHERCHE AUTO quelque soit le nombre de caractères",
							 "default" => $def_LISTE_LONGUE,
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
							 "rows" => "15",
							 "help" => "<h1>choisir une commune du département mais la saisie d'une nouvelle est possible (c'est absurde je sais) à partir de 3 caractères minimum</h1>",
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
