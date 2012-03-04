<html>
<head>
<title>Manipulation des attributs</title>
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


<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><span class="titre1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample16_attributs.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample18_touslesobjets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>AERER L'AFFICHAGE EN SAUTANT DES LIGNES </span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"280px",true);
	
    $f->frm_ObjetChampPopup("POPUP",    array(   "label" => "CHAMP n°=0",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php"
											 )
							);

    $f->frm_ObjetChampTexte("NOM",    array(   "label" => "CHAMP n°=1",
											   "attrib" => "U",
											   "width" => "200px"
											   ));

    $f->frm_SautLignes();											   

    $f->frm_ObjetChampTexte("PRENOM",    array( "label" => "CHAMP n°=2 (SAUT DE 1 LIGNE AVANT)",
											   "attrib" => "I",
											   "width" => "200px"
											   ));
    $f->frm_SautLignes(2);				
	
    $f->frm_ObjetChampTexte("MINUSCULE",    array( "label" => "CHAMP n°=3 (SAUT DE 2 LIGNES AVANT)",
											   "attrib" => "L",
											   "width" => "200px"
											   ));
    $f->frm_SautLignes(3);				
	
    $f->frm_ObjetChampTexte("EMAIL",    array( "label" => "CHAMP n°=4  (SAUT DE 3 LIGNES AVANT)",
											   "attrib" => "M",
											   "width" => "200px"
											  ));

	$f->frm_Ouvrir();
?>
  </p>
</blockquote>
</body>
</html>
