<html>
<head>
<title>SAMPLE 25 - Confirmation de l'ajout / modification avant d'enregistrer</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample24_icones.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample27_scroller.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>
        <?php
	include('classeForms.php');		
	if ( isset($_GET['ID']) )
		print "<h3>MODIFIER UN ENREGISTREMENT AVEC CONFIRMATION <br>";
	else
		print "<h3>AJOUTER UN NOUVEL ENREGISTREMENT AVEC CONFIRMATION <br>";

	$f = New Forms;

    $f->frm_Init();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi")
											  );
    $f->frm_ObjetChampTexte("Prenom",   array( "label" => "Prénom : (I)",
	                                           "attrib" => "I",
											   "size" => "40")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (N)",
	                                           "attrib" => "N",
											   "size" => "5",
											   "maxlength" => "5")
 	                                           
											  );

    $f->frm_ObjetChampTexte("Tel",      array( "label" => "Téléphone",
	                                           "attrib" => "",
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
							 


    $ret = $f->frm_Aiguiller("ID");
	switch ( $ret ) {
	
		case "A0" :
			$f->frm_InitConfirm("Ajout d'une nouvelle adresse ?");
			$f->frm_InitConfirmCancel("Annuler l'ajout ?");
			
			break;
			
		case "A1" :
			$f->frm_InitConfirm("Ajout d'une nouvelle adresse ?");
			$f->frm_InitConfirmCancel("Annuler l'ajout ?");
			$f->frm_ChampsRecopier();
			break;

		case "M0" :
			$f->frm_InitConfirm("Enregistrer les modifications ?");
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			$f->frm_ChampInitialiserValeur("NOM", "MODIFIER-LE-NOM");
			$f->frm_ChampInitialiserValeur("PRENOM", "MODIFIER-LE-PRENOM");
			$f->frm_ChampInitialiserValeur("RUE", "15");
			$f->frm_ChampInitialiserValeur("TEL", "01.02.03.04.05");
			$f->frm_ChampInitialiserValeur("VILLE", "MODIFIER-LA-VILLE");
			break;
			
		case "M1" :
			$f->frm_InitConfirm("Enregistrer les modifications ?");
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			$f->frm_ChampsRecopier();
			break;

		case "AQ" :
		case "MQ" :
			header("Location: index.htm");
	}

	$f->frm_Ouvrir();
	print "<br>";
	if ( isset($_GET['ID']) )
		print '<a href="sample25_confirm.php">voir le mode &quot;Ajout&quot;</a>';
	else
		print '<a href="sample25_confirm.php?ID=10">voir le mode &quot;Modification&quot;</a>';
?>
        
      </h3>
        </p>
</blockquote>
</body>
</html>
