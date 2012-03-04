<html>
<head>
<title>Sample 31 - SELECTEUR DE COULEURS</title>
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
  <p><span class="titre1"><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample30_javascript.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample32_boutonspreactive.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span>DEFINITION DE CHAMP &quot;SELECTEUR DE COULEUR&quot; (Fond et Texte) </span>
  
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
	#$f->frm_Protection();
	$f->frm_InitScroller("400","90","#FFE0D2",false);

	
    $f->frm_ObjetChampTexte("TELE",    array( "label" => "Champ Fixe",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "#",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));

											   
    $f->frm_ObjetChampTexte("MONEY_EURO",      array( "label" => "Champ Fixe",
	                                           "attrib" => "N",
											   "mask" => "€#_###.##",
											   "help" => "Saisir le salaire à travers le masque, 2 décimales non obligatoire €#_###.##"));
							
	$f->frm_SautLignes(2);
	
    $f->frm_ObjetColorPicker("LE_FOND",      array( "label" => "Couleur du fond",
											   "help" => "Saisir une couleur pour le fond",
											   "default" => "3399CC",
											   "width" => "110px",
 											   "target" => "background")
											   );

    $f->frm_ObjetColorPicker("LE_TEXTE",      array( "label" => "Couleur du texte",
											   "help" => "Saisir une couleur pour le texte",
											   "default" => "660033",											  
											   "target" => "text")
											   );

	$f->frm_SautLignes(2);
	
    $f->frm_ObjetColorPicker("LE_FOND2",      array( "label" => "Couleur du fond (non modifiable)",
											   "help" => "Saisir une couleur pour le fond",
											   "attrib" => "-",
											   "default" => "FFFF33",
											   "target" => "background")
											   );

    $f->frm_ObjetColorPicker("LE_TEXTE2",      array( "label" => "Couleur du texte (non modifiable)",
											   "attrib" => "+",
											   "help" => "Saisir une couleur pour le texte",
											   "default" => "993399",
											   "target" => "text")
											   );


	$f->frm_Ouvrir();
	print_r($_POST);
?>
  </p>
</blockquote>
</body>
</html>
