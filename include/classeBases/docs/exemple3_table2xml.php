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
		
	    $requete2  = "SELECT agent_id, agent_nom, agent_prenom, agent_date_creation FROM agents"; 

	    $base = New Bdd;
        $base->bdd_connecter_base("annuaire");
        $base->bdd_execsql($requete2);

		$base->bdd_table2xml();	
		print $base->bdd_xml_lastname();
		$base->bdd_fermer();
?>
</body>
</html>
