<?php
	$cochedefaut = ( isset($_POST['OVERWRITE']) ) ? $_POST['OVERWRITE'] : "1";

?>
<html>
<head>
<title>SAMPLE 43 - T�l�chargement de fichiers</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p>&nbsp;  </p>
  <p><span class="titre1 style1"><strong><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample42_multiliste_script.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample44_uploader_prefixed.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>UPLOADER SIMPLE <?php   	if ($cochedefaut=="1") print "(MODE OVERWRITE)";
?></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");

												  
    $f->frm_ObjetUploader("UPLOADER",       array(
											    "label" => "T�l�charger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => '',
												"attrib" => "R",
												"overwrite" => ($cochedefaut==1),
												"target" => '../../../rubappli/tmp/',
												"help" => "T�l�charger un fichier",
												"width" => "200px")
								  	         
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "L�gende de la photo",
											   "default" => "Ceci est la l�gende par d�faut",
											   "width" => "200px",
											   "help" => "Saisir la l�gende qui apparaitra sous la photographie publi�e"
											)
							);

	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("OVERWRITE",      array( "label" => "OVERWRITE", 
											"title" => "le fichier sera �cras� si d�j� existant (apr�s validation du formulaire au prochain appel)",
											"help" => "La prise en compte de l'option se fera � la prochaine validation",
											"default" => $cochedefaut, 
											  )
										);

	$f->frm_Ouvrir();

	print "<hr><pre>\$_POST()=";
	print_r($_POST);
	print "</pre>";

?>
</p>
  <p><a href="../../../rubappli/tmp/" target="_blank">voir le contenu du r&eacute;pertoire de t&eacute;l&eacute;chargement  </a></p>
  <p><a href="sample48_erase_dir.php" target="_blank">Effacer le contenu du r&eacute;pertoire cible </a></p>
</blockquote>
</body>
</html>
