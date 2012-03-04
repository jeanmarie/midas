<html>
<head>
<title>Sample19 : Objet Popup</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<p>&nbsp;</p>
<blockquote>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample18_touslesobjets.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample20_separateurs.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION DE FENETRES POPUP POUR LE CHOIX DE VALEURS </span></span>
    <?php		


	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"300px");
	
    $f->frm_ObjetChampPopup("POPUP_1",    array(   "label" => "POPUP (avec retour id et valeur) <br>ET LISTE PHP",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id",
											   "default" => "10",
											   "defaultview" => "SIVOM",
											   "winwidth" => "240",
											   "winheight" => "290",
											   "rows" => "20"
											 )
							);


    $f->frm_SautLignes();											   

    $f->frm_ObjetChampPopup("POPUP_2",    array(   "label" => "POPUP (avec retour valeur seule) <br>ET LISTE JAVASCRIPT",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_js.php",
											   "return" => "value",
										       "default" => "Action scolaire",
											   "winwidth" => "500",

											   "help" => "Choisir une option"								   
											 )
							);
    $f->frm_SautLignes();				
	
    $f->frm_ObjetChampPopup("POPUP_3",    array(   "label" => "CHAMP n°=2 (lecture seule)",
											   "attrib" => "+",
											   "width" => "200px",
											   "return" => "value",
											   "default" => "Action scolaire"
											 )
							);
    $f->frm_SautLignes();				

	$f->frm_ObjetChampPopup("POPUP_4",    array(   "label" => "POPUP (taille automatique)",
											   "attrib" => "",
											   "width" => "250px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id"					   
											 )
							);					
    $f->frm_SautLignes();				

	$f->frm_ObjetChampPopup("POPUP_SANSURL",    array(   "label" => "POPUP (sans URL = ERREUR)",
											   "attrib" => "",
											   "width" => "200px",
											   "return" => "id"
											 )
							);			

    $f->frm_SautLignes(3);	
    $f->frm_ObjetChampTexte("PARAMETRE_5",      array( "label" => "PARAMETRE POUR POP UP SUIVANT",    
	                                           "attrib" => "N+", 
											   "default" => "10")
											  );
											   
	$f->frm_ObjetChampPopup("POPUP_5",    array(   "label" => "POPUP (avec Paramètre fixe)",
											   "attrib" => "",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",		
											   "help" => "Aide sur ce champ",
											   "return" => "id",
											   "winwidth" => "240",
											   "winheight" => "390",
											   "param"  => "PARAMETRE_5"
											 )
							);		

    $f->frm_SautLignes();	

    $f->frm_ObjetListe("LISTE_PARAMETRE_6",        array("label" => "PARAMETRE POUR POP UP SUIVANT", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste",   "width" => "200"),
								  	    array( "1" => "(1) PARIS", "2" => "(2) LYON", "3" => "(3) MARSEILLE", "4" => "(4) TOULOUSE") );								

	$f->frm_ObjetChampPopup("POPUP_6",    array(   "label" => "POPUP (avec Paramètre variable)",
											   "attrib" => "R",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",											   "return" => "id",
											   "winwidth" => "240",
											   "winheight" => "390",
											   "param"  => "LISTE_PARAMETRE_6"
											 )
							);		
	$f->frm_Ouvrir();
	print "<pre>";
	print_r($_POST);
	print "</pre>";
?>
  </p>
</blockquote>
</body>
</html>
