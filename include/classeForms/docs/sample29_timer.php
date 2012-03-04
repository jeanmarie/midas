<html>
<head>
<title>SAMPLE 29 - Ajout d'un champ TIMER</title>
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

  <blockquote>
    <h3>&nbsp;</h3>
    <h3><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample28_scroller_coche_radio.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample30_javascript.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION D'UN CHAMP TIMER DYNAMIQUE </span></span></h3>

  <?php
	include('classeForms.php');		


	$f = New Forms;

	$tab_format_timer = array( "0" => "FRENCH (JJ/MM/AAAA)", "1" => "SQL (AAAA/MM/JJ)");
	$formatdefaut = ( isset($_POST['FORMAT_TIMER']) ) ? $_POST['FORMAT_TIMER'] : "0";
	$formatdefauttimer = ($formatdefaut=="0") ? "french" : "";
	
	$tab_icone_timer = array( "0" => "Pas d'icone", "1" => "Sablier visible");
	$iconedefaut = ( isset($_POST['ICONE_TIMER']) ) ? $_POST['ICONE_TIMER'] : "0";	
	$iconedefauttimer = ($iconedefaut=="1");
	
    $f->frm_Init();
	// $f->frm_ActiverBtnValider();

    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom :",    
	                                           "attrib" => "U", 
											   "help" => "saisir n'importe quoi")
											  );

    $f->frm_ObjetChampTexte("TIMESTAMP",     array( "label" => "Time stamp (attrib=T)",
	                                         "attrib" => "T",
											 "help" => "sélectionner une date dans le calendrier",
											 "default" => "TIMER")
											 );

	$f->frm_SautLignes(2);
	
    $f->frm_ObjetTimer("MON_TIMER", 	array("label" => "Horloge",
											  "width" => "70px",
											  "icon" => $iconedefauttimer ,
											  "format" => $formatdefauttimer)
											  );
	$f->frm_SautLignes();

    $f->frm_ObjetBoutonsRadio("FORMAT_TIMER", array("label" => "Format timer",
	                                          "default" => $formatdefaut,
											  "help" => "cocher le format voulu est sortie" ),
								  	     $tab_format_timer
										);

    $f->frm_ObjetBoutonsRadio("ICONE_TIMER", array("label" => "Sablier visible",
	                                          "default" => $iconedefaut  ),
								  	     $tab_icone_timer
										);	$f->frm_Ouvrir();
	print "<hr><pre>";
	print_r($_POST);
	print "</pre>";
?>

</blockquote>
</body>
</html>
