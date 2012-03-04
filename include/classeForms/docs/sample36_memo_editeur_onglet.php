<html>
<head>
<title>CLASSEFORMS : Mémo et Editeur</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>&nbsp;</p>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p><span class="titre1 style1"><strong><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample35_bufferedoutput.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample37_sortselect.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>UN EDITEUR DANS UN ONGLET </span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;


    $f->frm_Init();
	#$f->frm_Protection();
	$f->frm_OngletDefinir( array("width" => "550px", "height" => "350px") );


	$f->frm_OngletNouveau('MEMO');
	
	$f->frm_SautLignes();
    $f->frm_ObjetChampMemo("MEMO",  array( "label" => "Champ Mémo",
	                                       "attrib" => "RU",
										   "rows" => "20",
									       "height" => "300px",
										   "default" => "Ceci est la valeur par défaut passé au champ \"mémo/BLOB\"",
										   "help" => "Saisie libre dans cette zone",   
										   "width" => "400px",
										   "linesafter" => 1
										   )
									);
	$f->frm_OngletNouveau('EDITEUR n°=1');
	$f->frm_SautLignes();
	
    $f->frm_ObjetEditeur("EDITEUR",    array( "label" => "Champ Editeur",
											   "width" => "400px",
											   "height" => "300px",
											   "default" => "Ceci est la <b>valeur par défaut</b> passé au <um>champ \"Editeur\"</um><br>Le contenu de ce  champ est évidemment à sauvegarder dans un champ BLOB/mémo "
											  )
						);
	$f->frm_OngletNouveau('EDITEUR n°=2');
	$f->frm_SautLignes();
	
    $f->frm_ObjetEditeur("EDITEUR2",    array( "label" => "Champ Editeur",
											   "width" => "400px",
											   "height" => "300px",
											   "default" => "et maintenant la <u>valeur par défaut</u> passé au <um>champ \"Editeur n°=2\"</um><br><br>Le contenu de ce  champ est aussi à sauvegarder dans un champ BLOB/MEMO "
											  )
						);

    $ret = $f->frm_Aiguiller();
		
	switch ( $ret ) {
	
		case "A0" :
			break;
			
		case "A1" :
   			$f->frm_ChampsRecopier();

			break;
	}
	
	$f->frm_Ouvrir(true);

			print_r( $_POST );		

?>
  </p>
</blockquote>
</body>
</html>
