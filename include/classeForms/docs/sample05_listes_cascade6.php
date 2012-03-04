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
<script>
	function raz_liste() {
		objRECHERCHER_NIVEAU.CascadingLists_erase();
		return;
		
		
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
	include('_data_top_menu.php');

?>



<blockquote>
  <p>&nbsp;</p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_cascade5.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_cascade7.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES EN CASCADE&quot; AVEC NIVEAU OPTIONNEL ET INTERACTION AVEC D'AUTRES CHAMPS </span></span>
    <?php		

	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

	include('classeForms.php');		
	
	$f = New Forms;
	
    $f->frm_Init(false,"150px");
	$f->frm_LibBoutons('Rechercher','Quitter','Annuler');


	$nom_champ_niveau = 'TOTO';
	$def_ACTIVATION = ( isset($_POST['ACTIVATION']) )  ? stripslashes($_POST['ACTIVATION'])       : "";	
	$def_FILTRE     = ( isset($_POST['FILTRE']) )  ? stripslashes($_POST['FILTRE'])       : "A";	

	$def_RECHERCHER_NIVEAU       = ( isset($_POST['RECHERCHER_NIVEAU']) )  ? stripslashes($_POST['RECHERCHER_NIVEAU'])       : "44";	
	$def_RECHERCHER_NIVEAU_LEVEL = ( isset($_POST[$nom_champ_niveau]) )    ? stripslashes($_POST[$nom_champ_niveau])       : "DEPT";	



	// CHARGEMENT DES AGENTS DE LA TABLE "testbaseadr"
	$requete  = "SELECT * 
					FROM insee_regions
						ORDER BY reg_nom"; 	    
    $base->bdd_execsql($requete);	
	$tableau_regions = $base->bdd_tableversliste( array("reg_id","reg_nom") );											   

										



    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "Filtrer", "title" => "Les villes sont filtrées par la lettre ci-dessous",
											"default" =>  $def_ACTIVATION, 
											"script" => "raz_liste()",
											"activation" => array("FILTRE")  )
											  );
											  
    $f->frm_ObjetChampTexte("FILTRE",    array( "label" => "Nom",
											   "default" => $def_FILTRE,
											   "attrib" => "RU",
											   "width" => "20px",
											   "maxlength" => '1',
											   "help" => "Saisir un nom"));
											   											 
	$f->frm_SautLignes(2);	
    $f->frm_ObjetListesCascade("RECHERCHER_NIVEAU",       array(
												"label" => "Recherche multi-niveau",
											    "attrib" => "R",
												"orientation" => "V",
												//----------------------------------------------------
												"multilevel" => true,
												"levelfield" => $nom_champ_niveau,												
												"default" => $def_RECHERCHER_NIVEAU,
												"defaultlevel" => $def_RECHERCHER_NIVEAU_LEVEL,
												"erase" => true,
												"reset" => true,
												"ajaxmodedebug" => true,
											 	"ajaxparams" => array(
								 					'FILTRE' => "MM_findObj('FILTRE').value",
								 					'ACTIVATION' => "MM_findObj('ACTIVATION').value",
												),
												
												//----------------------------------------------------
												"help" => "choisir une option et un niveau pour lancer une recherche",   
	                                            "width" => "200px",
												"ajax" => "sample05_listes_cascade_params_called.php",
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
