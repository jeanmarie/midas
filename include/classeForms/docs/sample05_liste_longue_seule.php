<html>
<head>
<title>Manipulation de listes</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
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
  <p>&nbsp;</p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_editables.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_longues.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTE LONGUE &quot;(Filtres dynamiques sur tables pr&eacute;charg&eacute;es, ne convient pas aux grandes tables de plusieurs centaines d'&eacute;l&eacute;ments)</span></span>
    <?php		

	include('classeForms.php');		

	$radio_ajout = ( isset($_POST['AJOUT']) )          ? $_POST['AJOUT']  : "0";										
	$def_LISTE_LONGUE = ( isset($_POST['LISTE_LONGUE']) )  ? $_POST['LISTE_LONGUE']       : "";	
	if ($def_LISTE_LONGUE=="-1") {
		$def_LISTE_LONGUE = $_POST['LISTE_LONGUE_EDIT'];
	}

	$f = New Forms;
	
    $f->frm_Init(false,"150px");

	$tablecom = array("035" => "La Chapelle-sur-Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce", "070" => "Saint-Herblain", "080" => "Rezé", "090" => "Saint-Sébastien-sur-Loire", "100" => "Bouguenais", "110" => "Coueron" );

	$def_NOM = ( isset($_POST['NOM']) )  ? $_POST['NOM']       : "my_name";	

	
			
    $f->frm_ObjetListeLongue("LISTE_LONGUE",   array("label" => "Communes",
							 "default" => $def_LISTE_LONGUE,		
							 "attrib" => "RU",
							 "rows" => "5",
							 "addvalue"	=> $radio_ajout,
							 "help" => "choisir une commune du d'épartement",
							 "width" => "250"),
							 $tablecom );

    $f->frm_ObjetBoutonsRadio("AJOUT", array("label" => "Mode",
	                                          "default" => $radio_ajout,
											  "help" => "cocher Homme ou Femme pour choisir un prénom",
											  ),
								  	    array("0" => "Normal", "1" => "Ajout possible")
										);
							 
    
	$f->frm_ActiverBtnValider(); 
	$f->frm_Ouvrir();
	

	
	print "<hr><pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
		
	
?>
  </p>
</blockquote>
</body>
</html>
