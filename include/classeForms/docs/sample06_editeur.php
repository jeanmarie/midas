<?php
	session_start();
	$_SESSION['FCKEDITOR_USERFILESPATH'] = '/tmp/';
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


<script>
	alert('utilisation de FCKeditor');
</script>

<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample06_memo_editeur.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample36_memo_editeur_onglet.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS  EDITEUR WYSIWIG HTML </span></span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;


    $f->frm_Init();
	#$f->frm_Protection();

    $f->frm_ObjetEditeur("EDITEUR",    array( "label" => "Champ Editeur",
											   "width" => "600px",
											   "height" => "350px",
											   "userfilespath" => "/tmp/",											   
											   "default" => "\Ceci c'est la <b>valeur par défaut\n</b> passé au <um>champ \"Editeur\"</um><br>Le contenu de ce  champ est évidemment à sauvegarder dans un champ mémo "
											  )
						);

    $f->frm_ObjetChampTexte("Tel",    array( "label" => "N° de téléphone",
											   "default" => "12.34.56.78.90",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

	$f->frm_Ouvrir();

	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "\$_SESSION() = ";
	print_r($_SESSION);
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
