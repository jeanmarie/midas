<html>
<head>
<title>CLASSEFORMS : Coches et boutons radio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
	if (isset($_GET['COCHER'])) {
		$cochedefaut = "1";
	} else {
		$cochedefaut = "0";
	}

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,'250px',true);


    $f->frm_ObjetChampTexte("OT_OBLIGATOIRE",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
	$f->frm_SautLignes();	

    $f->frm_ObjetCoche("COCHE1",      array( "label" => "C1 : Coche pilotée", "title" => "Un déplacement est nécessaire",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut
										  )
											  );

						 
    $ret = $f->frm_Aiguiller();
	switch ( $ret ) {
	
		case "A0" :
			break;

		case "A1" :
			$f->frm_ChampsRecopier();
			break;
			
		case "AQ" :
			header("Location: index.htm#ANNEXES");
			break;
	}

?>
</head>

<body>
<?php
	include('_data_top_menu.php');

?>


<blockquote>
  <h4>&nbsp;</h4>
  <h4><strong><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample33_coche_graphiques.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample08_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span></strong>DES(ACTIVATION) DYNAMIQUE AVEC CHAMP OBLIGATOIRE</h4>

<table width="200" border="0">
  <tr valign="top">
    <td><?php 
	if ($cochedefaut=="1") {
		print "CASES COCHEES PAR DEFAUT";
	} else {
		print "CASES DECOCHEES PAR DEFAUT";
	}


	$f->frm_Ouvrir();
	;
?></td>
    <td><?php print "<pre>"; print_r($_POST); print "</pre>"; ?></td>
  </tr>
</table>

  <p><a href="sample33_coche_graphiques.php
<?php  if (!$cochedefaut) print "?COCHER"; ?>
">inverser les case &agrave; cocher au chargement de la page</a> </p>
  <p>&nbsp;</p>
</blockquote>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
