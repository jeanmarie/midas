<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>classeBases : Test SELECT sur une base</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
	    include('classeBases.php');
		include('classeTableau.php');
		
	    $requete2  = "SELECT * FROM agents"; 
	    $base = New Bdd;
        $base->bdd_connecter_base("annuaire");
        $base->bdd_execsql($requete2);
        $ligne = $base->bdd_lire_ligne();
		while  ($ligne) {
			print  "indice '1' = " .$base->bdd_lire_champ(1) . "<br>";
			print  "champs 'agent_nom' + 'agent_prenom' = " .$base->bdd_lire_champ("agent_nom")." ".$base->bdd_lire_champ("agent_prenom") . "<br>";
	        $ligne = $base->bdd_lire_ligne();
	    } 
		$base->bdd_fermer();
?>
</body>
</html>
