<?php
	include('classeForms.php');		

	$f = New Forms;

    $f->frm_Init();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("Prénom",   array( "label" => "Prénom : (I*)",
	                                           "attrib" => "RI",
											   "size" => "40",
											   "default" => "Prénom par défaut")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );

    $f->frm_ObjetChampTexte("Tel",      array( "label" => "Téléphone (*)",
	                                           "attrib" => "R",
	                                           "default" => "02.51.81.87.10",
											   "mask" => "##.##.##.##.##")
											  );

    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U)",
	                                           "attrib" => "U",
											   "size" => "50",
											   "default" => "PARIS",
											   "maxlength" => "50")
											  );

											   

    $f->frm_ObjetBoutonsRadio("CHOIX", array("label" => "Urgence",
	                                          "default" => "2",
											  "orientation" => "H",
											  "help" => "sélectionner le degre d'urgence",
									     ),
								  	     array( "1" => "Bloquant", "2" => "Normal", "3" => "Confort" )  
							 );
							 


    $ret = $f->frm_Aiguiller();
	switch ( $ret ) {
	
		case "A0" :

		case "A1" :
			$f->frm_ChampsRecopier();
			if (isset($_POST['CHOIX']))
				if ( $_POST['CHOIX'] != '3' ) {
					$f->frm_ChampEnErreur("CHOIX", "<h1>ATTENTION</h1>Confort doit etre cochées");
				}
			if (isset($_POST['VILLE']))
				if ( $_POST['VILLE'] != 'NANTES' ) {
					$f->frm_ChampEnErreur("VILLE", "La ville doit être NANTES");
				}
			break;


	}

?>
<html>
<head>
<title>SAMPLE12 - Marquage des champs en erreur</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample09_listes_bascule.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample13_sliders.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">GESTION DES CHAMPS EN ERREUR </span></span>
    <?php		
	$f->frm_Ouvrir();
	
	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";	
?>
  </p>

<p>il faut positionner les valeurs VILLE = NANTES et URGENCE = Confort </p>
<p>pour que le marquage des champs en erreur disparaisse </p>
</blockquote>
</body>
</html>
