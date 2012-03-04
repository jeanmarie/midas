<?php
	$maxfiles     = 10;
	$coche_activation = ( isset($_POST['ACTIVATION']) )  ? $_POST['ACTIVATION']  : "1";
	$cochedefaut  = ( isset($_POST['READONLY']) )  ? $_POST['READONLY']  : "1";
	$nomfichier   = ( isset($_POST['MONO_UPLOADER']) ) ? $_POST['MONO_UPLOADER'] : "";
	$nomfichier2   = ( isset($_POST['MONO_UPLOADER2']) ) ? $_POST['MONO_UPLOADER2'] : "";
	$multifichiers = ( isset($_POST['MULTI_UPLOADER']) ) ? $_POST['MULTI_UPLOADER'] : "";
	$nomsfichiers = ( isset($_POST['UPLOADER']) ) ? $_POST['UPLOADER'] : "";
	$defaut       = ( isset($_POST['TEXT']) )     ? $_POST['TEXT']     : "Ceci est la description de l`événement";

?>
<html>
<head>
<title>SAMPLE 47 - Téléchargement et tri de fichiers</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample46_uploader_multifilesmax.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><img src="fleche.gif" width="16" height="16" border="0"> </strong>UPLOADER MULTI-FICHIERS AVEC TRI SANS PREFIXE (avec nombre maxi=<?php print $maxfiles; ?>)</span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
    $f->frm_Init(false,'250px');

    $f->frm_ObjetChampTexte("TEXT",    array( "label" => "Nom de l'événement",
											   "default" => $defaut,
											   "width" => "250px",
											   "help" => "Saisir le nom de l événement qui apparaitra comme titre"
											)
							);

	$f->frm_SautLignes(2);
    $f->frm_ObjetCoche("ACTIVATION",      array( "label" => "ACTIVATION", "title" => "Activer les 2 sélecteurs ci-dessous",
											"help" => "Sélectionner pour activer le choix",
											"default" => $coche_activation, 
											"activation" => array("MONO_UPLOADER","MULTI_UPLOADER")  )
											  );


   $f->frm_ObjetUploader("MONO_UPLOADER",       array(
											    "label" => "Télécharger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier,
												"preview" => true,
												"attrib" => "",
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"help" => "Télécharger un fichier",
												"width" => "200px")
								  	         
											  );

    $f->frm_ObjetUploader("MULTI_UPLOADER",       array(
												"attrib" => "",
											    "label" => "Télécharger de 1 à $maxfiles images",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $multifichiers,
												"title" => "Télécharger plusieurs photos",

												"multifiles"    => true,
												"multifilesmax" => $maxfiles,
												"multisort"    => true,

												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => true,
												"help" => "Télécharger de 1 à $maxfiles images",
												"width" => "200px",
												"size" => $maxfiles )
								  	         
											  );
												  
	$f->frm_SautLignes(2);
	$attrib = ($cochedefaut=="1") ? '+' : '';

    $f->frm_ObjetUploader("UPLOADER_RO1",       array(
												"attrib" => $attrib,
											    "label" => "Télécharger de 1 à $maxfiles images",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomsfichiers,

												"multifiles"    => true,
												"multifilesmax" => $maxfiles,
												"multisort"    => true,

												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => true,
												"help" => "Télécharger de 1 à $maxfiles images",
												"width" => "200px",
												"size" => $maxfiles )
								  	         
											  );
											  
   $f->frm_ObjetUploader("MONO_UPLOADER2",       array(
											    "label" => "Télécharger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier2,
												"preview" => true,
												"attrib" => $attrib,
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"help" => "Télécharger un fichier image",
												"width" => "200px")
								  	         
											  );

	$f->frm_SautLignes(1);
    $f->frm_ObjetCoche("READONLY",      array( "label" => "Lecture seule", 
											"title" => "Les 2 objets UPLOADER ci-dessus sont en lecture seule (après validation du formulaire au prochain appel)",
											"help" => "La prise en compte de l'option se fera à la prochaine validation",
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
