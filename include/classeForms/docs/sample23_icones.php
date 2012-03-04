<html>
<head>
<title>Sample23 : Objet Selecteur d'icones</title>
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
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample22_arbres.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample24_icones.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">SELECTEUR D'IMAGES</span></span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
    $f->frm_ObjetChampTexte("MONNom",      array( "label" => "Nom",
												 "attrib" => "R",
												 "default" => "TINTIN"
												 )
											  );	

    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_1",    array(  "label" => "Selecteur d'icones (R)",
											   "attrib" => "R",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_2",    array(  "label" => "Selecteur d'icones (n°=2)",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/dupont.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_3",    array(  "label" => "Selecteur d'icones (n°=3)",
											   "attrib" => "U",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/dupond.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);
    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_4",    array(  "label" => "Icone en affichage seulement (+)",
											   "attrib" => "+",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/haddock.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_ObjetChampIcone("ICONE_5",    array(  "label" => "Icone en taille 64x64",
											   "url" => "sample23_icones_popup.php",
											   "width" => "64",
											   "height" => "64",
											   "path" => "./icones/",
											   "default" => "./icones/tintin.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);


	$f->frm_Ouvrir();
	print_r($_POST);
?>
  </p>
</blockquote>
</body>
</html>
