<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>classeBases : Test SELECT sur une base</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
}
.style1 {font-size: large}
-->
</style>
</head>
<?php
	    include('classeBases.php');
		include('classeTableau.php');

	    $base = New Bdd;
?>

<body>
<p class="style1">COMPARER LES RESULTATS SUR LA MEME BASE EN <strong>ODBC / MYSQL</strong> <br>
  les 2 bases ANNUAIRES ont &eacute;t&eacute; connect&eacute;e manuellement </p>
<table width="100%" border="0">
  <tr>
    <td width="50%"><h2>ODBC</h2></td>
    <td width="50%"><h2>MYSQLi</h2></td>
  </tr>
  <tr valign="top">
    <td>
<?php	
        $base->bdd_connecter("ODBC","","annuaire");
		TraitementIdem();				
		$base->bdd_fermer();
		
?>

	</td>
    <td>
<?php	
        $base->bdd_connecter("MYSQLI","192.168.0.10","annuaire","root","cha00teau");
		TraitementIdem();				
		$base->bdd_fermer();
		

?>
	
	</td>
  </tr>
</table>
</body>
</html>

<?php	
		
	function TraitementIdem() {

		global $base;
	    $requete2  = "SELECT * FROM agents"; 
				
        $base->bdd_execsql($requete2);
        $ligne = $base->bdd_lire_ligne();
		$cpt = 0;
		print "<b>Les 10 permiers enregistrements de la base</b><br>";
		while  ($ligne && $cpt<10) {
			print  "indice '1' = " .$base->bdd_lire_champ(1) . "<br>";
			print  "champs 'agent_nom' + '_prenom' + '_date_creation'= <br>" .$base->bdd_lire_champ("agent_nom")." ".$base->bdd_lire_champ("agent_prenom")." ".$base->bdd_lire_date("agent_date_creation")." ".$base->bdd_lire_champ("agent_email") . "<br>";
	        $ligne = $base->bdd_lire_ligne();
			$cpt++;
	    } 

	    $requete2  = "SELECT * FROM agents WHERE agent_id<10"; 				
        $base->bdd_execsql($requete2);
		print "<b>fonction : bdd_tableversarray()</b><br>";
		print "<pre>";
		$tab =  $base->bdd_tableversarray();
		print_r($tab);
		print "</pre>";			

	    $requete2  = "SELECT * FROM agents WHERE agent_id<10"; 				
        $base->bdd_execsql($requete2);
		print "<b>fonction : bdd_tableversxml()</b><br>";
		print "<pre>";
//		$base->bdd_tableversxml( array("AGENT_ID","AGENT_NOM") );
		$base->bdd_tableversxml();
		print "</pre>";			
		
		
		print "<br><b>Le nom de tous les champs : ->bdd_listerchamps()</b><br>";
		print "<pre>";
		$tab =  $base->bdd_listerchamps("agents");
		print_r($tab);
		print "</pre>";
		
		print "<b>Le type de champs : ->bdd_listertypechamps()</b><br>";
		print "<pre>";
		$tab =  $base->bdd_listertypechamps("agents");
		print_r($tab);
		print "</pre>";



		print "<pre>";
		$tab =  $base->bdd_listertables();
		print_r($tab);
		print "</pre>";
	}
?>