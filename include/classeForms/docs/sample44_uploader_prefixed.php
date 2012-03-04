<?php
	
	$cochedefaut = ( isset($_POST['PREVIEW']) )  ? $_POST['PREVIEW']  : "1";
	$nomfichier  = ( isset($_POST['UPLOADER']) ) ? $_POST['UPLOADER'] : "";
	$defaut      = ( isset($_POST['TEXT']) )     ? $_POST['TEXT']     : "Ceci est la l�gende par d�faut";

?>
<html>
<head>
<title>SAMPLE 44 - T�l�chargement de fichiers avec ajout d'un pr�fixe</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample43_uploader_simple.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample44_uploader_resizing.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>UPLOADER AVEC AJOUT DE PREFIXE  <?php  if ($cochedefaut=="1") print "(MODE PREVIEW)";
?></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");


												  
    $f->frm_ObjetUploader("UPLOADER",       array(
											    "label" => "T�l�charger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier,
												"attrib" => "R",
												"prefix" => "MONPREFIX_".sprintf("%05s", mt_rand(1,99999)).'_',
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => ($cochedefaut=="1"),
												"help" => "T�l�charger un fichier",
												"width" => "200px")
								  	         
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetChampTexte("TEXT",    array( "label" => "L�gende de la photo",
											   "default" => $defaut,
											   "width" => "200px",
											   "help" => "Saisir la l�gende qui apparaitra sous la photographie publi�e"
											)
							);


	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("PREVIEW",      array( "label" => "PREVIEW", 
											"title" => "le fichier peut �tre visualis� (apr�s validation du formulaire au prochain appel)",
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
  <p><a href="../../../rubappli/tmp/" target="_blank">voir le contenu du r&eacute;pertoire de t&eacute;l&eacute;chargement </a></p>
  <p><a href="sample48_erase_dir.php" target="_blank">Effacer le contenu du r&eacute;pertoire cible </a></p>
</blockquote>
</body>
</html>
