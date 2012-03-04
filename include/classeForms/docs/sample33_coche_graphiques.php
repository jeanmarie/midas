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
	
    $f->frm_Init(false,'250px');
	$tableau1 = array( "1" => "Homme", "2" => "Femme", "3" => "MIXTE");
	$tableau2 = array( "1" => "Train", "2" => "Voiture", "3" => "Avion", "4" => "Camion" );

	$tableau3 = array( "1" => "Paris", "2" => "Lyon", "3" => "Marseille", "4" => "Toulouse", "5" => "Bordeaux", "6" => "Nantes" );
	$tableau4 = array(  "1.1" => "Tour effel", "1.2" => "Sacré coeur", 
						"2.1" => "Fourvière", "2.2" => "Bellecour",
						"3.1" => "Canebière", "3.2" => "Notre dame de la garde",
						"4.1" => "Capitole",  "4.2" => "Saint-Sernin",
						"5.1" => "Place de la bourse", "5.2" => "Chateau Haut-Brion",
						"6.1" => "Place du commerce",  "6.2" => "Usines LU");	


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

    $f->frm_ObjetCoche("COCHE2",      array( "label" => "C2 : Coche pilotée", "title" => "Un déplacement est nécessaire",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut)
											  );

	$f->frm_SautLignes();	

    $f->frm_ObjetCoche("COCHE3",      array( "label" => "C3 : Décochée & desactivée (+)", "title" => "On ne peut rien faire",
											"attrib" => "+",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "0")
											  );

    $f->frm_ObjetCoche("COCHE31",      array( "label" => "C3' : Cochée & desactivée (+)", "title" => "On ne peut rien faire",
											"attrib" => "+",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "1")
											  );


    $f->frm_ObjetCoche("COCHE4",      array( "label" => "C4 : Cochée & en lecture seule (-)", "title" => "On ne peut rien faire",
											"attrib" => "-",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "1")
											  );

    $f->frm_ObjetCoche("COCHE41",      array( "label" => "C4' : Décochée & en lecture seule (-)", "title" => "On ne peut rien faire",
											"attrib" => "-",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "0")
											  );

	$f->frm_SautLignes();	

    $f->frm_ObjetCoche("COCHE5",      array( "label" => "C5 : valeur A=on/B=off", "title" => "Valeur A/B",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "B",
											"valueon" => "A",
											"valueoff" => "B"
											)
									  );

    $f->frm_ObjetCoche("COCHE6",      array( "label" => "C6 : valeur A=on/B=off", 
											"title" => "Valeur A/B sans valeur par défaut",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"valueon" => "A",
											"valueoff" => "B"
											)
									  );
	$f->frm_SautLignes();	

    $f->frm_ObjetCoche("COCHE7",      array( "label" => "C7 sans titre (0/1)", 
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "0"
											)
									  );

											   
	$f->frm_SautLignes(2);											 

    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION", "title" => "Cocher pour activer les champs ci dessous",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut, 
											"activation" => array("ACTIVE1","ACTIVE2","COCHE8")  )
											  );
					 
	
    $f->frm_ObjetChampTexte("ACTIVE1",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("ACTIVE2",      array( "label" => "Date : (*)",    
	                                           "attrib" => "RDP", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "TIMER")
											  );											  	
    $f->frm_ObjetCoche("COCHE8",      array( "label" => "C8 : Pilotée par la coche ci dessus", 
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "1"
											)
									  );
	
	$f->frm_SautLignes(2);					
	
										  
    $f->frm_ObjetCoche("NOACTIVATION",      array( "label" => "DEACTIVATION", "title" => "Cocher pour désactiver les champs ci dessous",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => $cochedefaut, 
											"noactivation" => array("DESACTIVE1","DESACTIVE2","COCHE9")  )
											  );
					 
	
    $f->frm_ObjetChampTexte("DESACTIVE1",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("DESACTIVE2",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );				
    $f->frm_ObjetCoche("COCHE9",      array( "label" => "C9 : Pilotée par la coche ci dessus", 
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "1"
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
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample07_coche_radio.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample33_coche_simples.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span></strong>DES(ACTIVATION) DYNAMIQUE AVEC CHAMP OBLIGATOIRE</h4>

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
