<?php

	header("Content-Type: text/xml"); 
	header("Cache-Control: no-cache");
	print '<?xml version="1.0" encoding="ISO-8859-15"?>';
	print "\n<root>";

	/* 2 CAS POSSIBLES :
	   - ON RECHERCHE LA VALEUR CORRESPONDANTE A UN ID PRECIS $_POST['VALUE']
	   - ON RECHERCHE LES VALEURS QUI CONTIENNENT UNE CHAINE %$_POST['TEXT']%
	*/
	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

	// RECUPERATION D'UN ENREGISTREMENT PRECIS
	if (isset($_POST['VALUE'])) {
			$id = $_POST['VALUE'];	
	    	$requete  = "SELECT com_id,
							CONCAT(com_article,' ',com_nom,' (',com_dep,')') AS nom_commune
						 FROM insee_communes
							WHERE com_id='".$id."'";
		    $base->bdd_execsql($requete);
			UneLigne($id);
	// RECUPERATION DE PLUSIEURS ENREGISTREMENTS
	} else {
		if ($_POST['ACTIVER_DEPARTEMENT']=='1') {
			$complement = " AND com_dep='".$_POST['DEPARTEMENT']."' ";
		} else {
			$complement = '';
			print "\n<!-- RECHERCHE NATIONALE=OUI -->";
		}
		print "\n<!-- TEXT=".$_POST['TEXT']."-->";
		$requete  = "SELECT com_id,
							CONCAT(com_article,' ',com_nom,' (',com_dep,')') AS nom_commune
						 FROM insee_communes
							WHERE com_nom LIKE '%".$_POST['TEXT']."%'"
							 . $complement . "						
 								ORDER BY com_nom"; 
	    $base->bdd_execsql($requete);
    	while($base->bdd_lire_ligne()) {
			UneLigne($base->bdd_lire_champ("com_id"));
		}	
	}

	print "\n</root>\n";

// TRAITEMENT D'UNE LIGNE
function UneLigne($id) {
	global $base;
	print "\n";
	print '<option value="'. $id.'">';
	print stripslashes(htmlspecialchars($base->bdd_lire_champ("nom_commune")));
	print '</option>';

}

?>