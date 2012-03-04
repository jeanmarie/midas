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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_ajax_param.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues_ajax_param3.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES LONGUES &quot; (Filtres dynamiques AJAX et param&egrave;tres suppl&eacute;mentaires) </span></span>
    <?php		

	include('classeForms.php');		
	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

   	$requete  = "SELECT dep_id,dep_nom
						 FROM insee_departements
								ORDER BY dep_nom"; 
    $base->bdd_execsql($requete);
	$tableau_dept = $base->bdd_tableversliste( array("dep_id","dep_nom") );

	
	$def_DEPARTEMENT = ( isset($_POST['DEPARTEMENT']) )  ? $_POST['DEPARTEMENT']       : "44";	
	$def_LISTE_LONGUE = ( isset($_POST['LISTE_LONGUE']) )  ? $_POST['LISTE_LONGUE']    : "";	
	$radio_activation = ( isset($_POST['ACTIVER_DEPARTEMENT']) )          ? $_POST['ACTIVER_DEPARTEMENT']  : "1";										

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	/*
	$tableau_dept = array(
						"44" => "Loire-Atlantique", 
						"85" => "Vendée", 
						"49" => "Maine-et-Loire"
						);
	*/
	$def_NOM = ( isset($_POST['NOM']) )  ? stripslashes($_POST['NOM'])       : "abécédé";	
	$mode_debug = ( isset($_POST['MODE_DEBUG']) )  ? stripslashes($_POST['MODE_DEBUG'])       : "";	

	

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "",
											   "width" => "250px",
											   "help" => "Saisir un nom"));
    $f->frm_SautLignes(1);	
    $f->frm_ObjetCoche("ACTIVER_DEPARTEMENT",   array( "label" => "Recherche", 
											"title" => "Activé le filtrage par département",
											"activation" => array("DEPARTEMENT"),
											"default" => $radio_activation,
											"script"=> "objLISTE_LONGUE.LongList_raz()"
												 )
											  );	
	$f->frm_SautLignes(1);

    $f->frm_ObjetListe("DEPARTEMENT",         array(
											    "label" => "Département",
												"attrib" => "R",
												"title" => "----- Choisir un département -----",
												"default" => $def_DEPARTEMENT,
												"help" => "choisir un département dans la liste",
												"width" => "250px",

												"script"=> "objLISTE_LONGUE.LongList_raz()"
												
												),
								  	          $tableau_dept
											  );
	// $f->frm_SautLignes(1);
	
				
    $f->frm_ObjetListeLongue("LISTE_LONGUE",   array("label" => "Communes",
							 "default" => $def_LISTE_LONGUE,		
							 "attrib" => "RU",
							 "rows" => "15",
							// -------------------------------------------------
							 "ajax" => "sample05_listes_longues_ajax_params3_called.php",
							 "ajaxmodedebug" => $mode_debug,
							 "ajaxautosearchminlength" => 4,
							 "ajaxsearchminlength" => 2,
							 "ajaxautosearch" => false,
							 "ajaxparams" => array(
				 					'DEPARTEMENT' => "MM_findObj('DEPARTEMENT').value",
				 					'NOM'         => "MM_findObj('NOM').value",
									'ACTIVER_DEPARTEMENT'     => "MM_findObj('ACTIVER_DEPARTEMENT').value",
												),
							// -------------------------------------------------
							 "help" => "choisir une commune, <h3>ATTENTION ne pas saisir les articles</h3>",
							 "width" => "450"),
							 array() 
							 );

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
