<?php
	$maxfiles    = 2;
	$cochedefaut = ( isset($_POST['PREVIEW']) )  ? $_POST['PREVIEW']  : "1";
	$nomfichier  = ( isset($_POST['UPLOADER']) ) ? $_POST['UPLOADER'] : "";
	$defaut      = ( isset($_POST['TEXT']) )     ? $_POST['TEXT']     : "Ceci est la description de l`événement";

?>
<html>
<head>
<title>SAMPLE 46 - Téléchargement jusqu'a un nombre maximum de fichiers</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample45_uploader_multi.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample47_uploader_filesinorder.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>UPLOADER MULTI-FICHIERS SANS PREFIXE (avec nombre maxi=<?php print $maxfiles; ?>)</span>
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
												"attrib" => "R",
											    "label" => "Télécharger de 1 à $maxfiles images",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier,

												"multifiles"    => true,
												"multifilesmax" => $maxfiles,

												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => true,
												"help" => "Télécharger de 1 à $maxfiles images",
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
