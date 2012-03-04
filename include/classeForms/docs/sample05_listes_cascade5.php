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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_cascade4.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_cascade6.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES EN CASCADE&quot; AVEC NIVEAU OPTIONNEL DONT ON PEUT NOMMER LE CHAMP </span></span>
    <?php		

	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

	include('classeForms.php');		
	
	$f = New Forms;
	
    $f->frm_Init(false,"150px");
	$f->frm_LibBoutons('Rechercher','Quitter','Annuler');


	$nom_champ_niveau = 'TOTO';
	$def_NOM = ( isset($_POST['NOM']) )  ? stripslashes($_POST['NOM'])       : "abécédé";	

	$def_RECHERCHER_NIVEAU       = ( isset($_POST['RECHERCHER_NIVEAU']) )  ? stripslashes($_POST['RECHERCHER_NIVEAU'])       : "44";	
	$def_RECHERCHER_NIVEAU_LEVEL = ( isset($_POST[$nom_champ_niveau]) )    ? stripslashes($_POST[$nom_champ_niveau])       : "DEPT";	



	// CHARGEMENT DES AGENTS DE LA TABLE "testbaseadr"
	$requete  = "SELECT * 
					FROM insee_regions
						ORDER BY reg_nom"; 	    
    $base->bdd_execsql($requete);	
	$tableau_regions = $base->bdd_tableversliste( array("reg_id","reg_nom") );											   

										

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "R",
											   "width" => "200px",
											   "help" => "Saisir un nom"));
											   											 

	$f->frm_SautLignes(1);	
    $f->frm_ObjetListesCascade("RECHERCHER_NIVEAU",       array(
												"label" => "Recherche multi-niveau",
											    "attrib" => "R",
												"orientation" => "V",
												//----------------------------------------------------
												"multilevel" => true,
												"levelfield" => $nom_champ_niveau,												
												"default" => $def_RECHERCHER_NIVEAU,
												"defaultlevel" => $def_RECHERCHER_NIVEAU_LEVEL,
												//----------------------------------------------------
												"help" => "choisir une option et un niveau pour lancer une recherche",   
	                                            "width" => "200px",
												"ajax" => "sample05_listes_cascade_V_called.php",
												"list" => array( 
															array( 'id'     => 'REGION',
																   'title' => "---choisir une région---",
																   'width' => '150px' ),
															array( 'id'     => 'DEPT',
																   'title' => "---choisir le département---",
																   'width' => '200px' ),
															array( 'id'     => 'VILLE',
																   'title' => "---choisir la ville---",
																   'width' => '300px' ),


															)
														),
 								   			$tableau_regions
										     );											 

	

	$f->frm_Ouvrir();
	
	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
		
	
?>
  </p>
</blockquote>
</body>
</html>
