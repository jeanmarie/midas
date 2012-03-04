<?php
	$prefix = "12345_";
	$cochedefaut = ( isset($_POST['PREVIEW']) )  ? $_POST['PREVIEW']  : "1";
	$nomfichier  = ( isset($_POST['UPLOADER']) ) ? $_POST['UPLOADER'] : "";
	$defaut      = ( isset($_POST['TEXT']) )     ? $_POST['TEXT']     : "Ceci est la description de l`événement";

?>
<html>
<head>
<title>SAMPLE 45 - Téléchargement de plusieurs fichiers simultanéments</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample44_uploader_prefixed.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample46_uploader_multifilesmax.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>UPLOADER MULTI-FICHIERS  <?php  if (!empty($prefix)) print "(PREFIX=\"".$prefix."\")";
?></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");

    $f->frm_ObjetChampTexte("TEXT",    array( "label" => "Nom de l'événement",
											   "default" => $defaut,
											   "width" => "250px",
											   "help" => "Saisir le nom de l événement qui apparaitra comme titre"
											)
							);

												  
	$f->frm_SautLignes(2);
    $f->frm_ObjetUploader("UPLOADER",       array(
												"attrib" => "",
											    "label" => "Télécharger la ou les photos",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier,

												"multifiles"    => true,
												"multifilesmax" => -1,
												"prefix" => $prefix,

												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => true,
												"help" => "Télécharger un ou plusieurs fichiers",
												"width" => "200px")
								  	         
											  );
											  
	$f->frm_SautLignes(1);


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
