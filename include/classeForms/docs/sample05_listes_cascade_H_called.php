<?php

	header("Content-Type: text/xml"); 
	header("Cache-Control: no-cache");
	print '<?xml version="1.0" encoding="ISO-8859-15"?>';
	print "\n<root>";


	/* PLUSIEURS CAS POSSIBLES :
	   - ON RECHERCHE LA VALEUR CORRESPONDANTE A UN ID PRECIS $_POST['ID']
	   - EN FONCTION DU NIVEAU $_POST['LEVEL']  
	*/
	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

	switch ($_POST['LEVEL']) {
	
		case 'REGION':
		   	$requete  = "SELECT dep_id,dep_nom
							 FROM insee_departements
								WHERE dep_regionid='".$_POST['ID']."'
									ORDER BY dep_nom"; 
		    $base->bdd_execsql($requete);
		   	while($base->bdd_lire_ligne()) {
				UneLigne('DEPT',$base->bdd_lire_champ("dep_id"),$base->bdd_lire_champ("dep_nom"));
			}
			break;

		case 'DEPT': // recuperation d'un departement precis		
		   	$requete  = "SELECT dep_id,dep_nom, reg_id,reg_nom
							 FROM insee_departements
							 INNER JOIN insee_regions      ON dep_regionid=reg_id
								WHERE dep_id='".$_POST['ID']."'";
		    $base->bdd_execsql($requete);
			UneLigne('DEPT',$base->bdd_lire_champ("dep_id"),$base->bdd_lire_champ("dep_nom"));
			UneLigne('REGION',  $base->bdd_lire_champ("reg_id"), $base->bdd_lire_champ("reg_nom"));
			break;

	}
	print "\n</root>\n";


// TRAITEMENT D'UNE LIGNE
function UneLigne($level,$id,$valeur) {
	print "\n";
	print '<'.$level.' value="'. $id.'">';
	print stripslashes(htmlspecialchars($valeur));
	print '</'.$level.'>';
}
?>