<?php
	session_start();
	unset($_SESSION['FCKEDITOR_USERFILESPATH']);
?>
<html>
<head>
<title>CLASSEFORMS : Mémo et Editeur</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes_longues_script.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample06_editeur.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS MEMO ET EDITEUR WYSIWIG HTML </span></span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;


    $f->frm_Init();
	$f->frm_InitConfirm('Valider la saisie ?');
	$f->frm_InitConfirmCancel('Annuler la saisie ?');
    $f->frm_ObjetChampMemo("MEMO",  array( "label" => "Champ Mémo",
	                                       "attrib" => "RU",
										   "rows" => "8",
										   "default" => "Ceci est la valeur par défaut passé au champ \"mémo\"",
										   "help" => "Saisie libre dans cette zone",   
										   "width" => "400px",
										   "linesafter" => 1
										   )
									);
    $f->frm_SautLignes(1);	
	
    $f->frm_ObjetEditeur("EDITEUR",    array( "label" => "Champ Editeur",
											   "width" => "600px",
											   "height" => "250px",
											   "userfilespath" => "/tmp/fckeditor/",
											   "default" => "\Ceci c'est la <b>valeur par défaut\n</b> passé au <um>champ \"Editeur\"</um><br>Le contenu de ce  champ est évidemment à sauvegarder dans un champ mémo "
											  )
						);

    $ret = $f->frm_Aiguiller();
		
	switch ( $ret ) {
	
		case "A0" :
			break;
			
		case "A1" :
   			$f->frm_ChampsRecopier();

			break;

		default :
   			header("Location: index.htm#ANNEXES");


	}
	
	$f->frm_Ouvrir(true);

	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
	/*
	$str = $_POST['EDITEUR'];
	for ($i=0;$i<strlen($str);$i++) {
		print "<br>".substr($str,$i,1). "&nbsp;" . ord( substr($str,$i,1) );
	}
	*/
	

?>
  </p>
</blockquote>
</body>
</html>
