<html>
<head>
<title>Sample19 : Objet Popup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>



<?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
    $f->frm_ObjetChampPopup("NOM0",    array(   "label" => "POPUP (avec retour id et valeur) <br>ET LISTE PHP",
											   "attrib" => "RU",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id",
											   "default" => "",
											   "defaultview" => "",
											   "rows" => "20"
											 )
							);
								
    $f->frm_ObjetChampPopup("PRENOM",    array(   "label" => "POPUP avec retour valeur seule ET LISTE JAVASCRIPT",
											   "attrib" => "RU",
											   "width" => "200px",
											   "url" => "sample19_popup_js.php",
											   "return" => "value",
										       "default" => "10",
											   "help" => "Choisir une option"								   
											 )
							);
    $f->frm_SautLignes();				
	


	$f->frm_Ouvrir();
	print_r($_POST);
?>
</body>
</html>
