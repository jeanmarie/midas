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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_ajax_param.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues_ajax.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES LONGUES&quot; ET SCRIPT </span></span>
<script>
	function toto() {
		if (objLISTE_LONGUE2.LongList_IsTheValueAdded()) {
			MM_findObj('LISTE_DEROUL').disabled = false;
			// alert('activer');
		} else {
			MM_findObj('LISTE_DEROUL').disabled = true;
			// alert('désactiver');
		}
		// alert(MM_findObj('LISTE_LONGUE2').value);

	}
</script>
    <?php		

	include('classeForms.php');		

	$cochedefaut = ( isset($_POST['ACTIVATION']) )          ? $_POST['ACTIVATION']  : "1";										

	$def_LISTE_DEROUL = ( isset($_POST['LISTE_DEROUL']) )  ? $_POST['LISTE_DEROUL']    : '';

	$valeur_par_defaut = "ORVAUL";
	if ($_POST['LISTE_LONGUE2']=='-1') {
		$def_LISTE_LONGUE2 = $_POST['LISTE_LONGUE2_EDIT'];	
	} else {
		$def_LISTE_LONGUE2 = ( isset($_POST['LISTE_LONGUE2']) )  ? $_POST['LISTE_LONGUE2']    : $valeur_par_defaut;	
	}
	$radio_activation = ( isset($_POST['BTN_RAD']) )          ? $_POST['BTN_RAD']            : "1";
	$tableau_civ = array( 	"1" => "Particulier", 
							"2" => "Commune" ,
							"3" => "Entreprise"  ,
							"4" => "Etat" 
						);
	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tablecom = array("035" => "La Chapelle-sur-Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce", "070" => "Saint-Herblain", "080" => "Rezé", "090" => "Saint-Sébastien-sur-Loire", "100" => "Bouguenais", "110" => "Coueron" );

	$def_NOM = ( isset($_POST['NOM']) )  ? $_POST['NOM']       : "my_name";	


	$f->frm_SautLignes(1);


    $f->frm_ObjetListe("LISTE_DEROUL",         array(
											    "label" => "Nature si nouvelle valeur saisie ci-dessous",
												"title" => "----- Choisir une option -----",
												"default" => $def_LISTE_DEROUL,
												"attrib" => "R-",
												"width" => "200px"),
								  	          $tableau_civ
											  );
	$f->frm_SautLignes(1);
											  				
    $f->frm_ObjetListeLongue("LISTE_LONGUE2",   array("label" => "Saisie possible",
							 "default" => $def_LISTE_LONGUE2,
							 "addvalue"	=> true,	
							 "attrib" => "RI",
							 "rows" => "6",
							 "script" => "toto()",
							 "help" => "choisir une commune du d'épartement mais la saisie d'une nouvelle est possible",
							 "width" => "200"),
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
