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

	if (isset($_POST['VALUE'])) {
			$id = $_POST['VALUE'];	
	    	$requete  = "SELECT com_id,com_nom
						 FROM insee_communes
							WHERE com_id='".$id."'
							AND com_dep='44'";
		    $base->bdd_execsql($requete);
			print "\n<!-- VALUE=".$id."-->";
			UneLigne($id);
	} else {
    	$requete  = "SELECT com_id,com_nom
						 FROM insee_communes
							WHERE com_nom LIKE '%".$_POST['TEXT']."%' 
							AND   com_dep='44'
 								ORDER BY com_nom"; 
	    $base->bdd_execsql($requete);
		print "\n<!-- TEXT=".$_POST['TEXT']."-->";
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
	print stripslashes(htmlspecialchars($base->bdd_lire_champ("com_nom")));
	print '</option>';

}
?>