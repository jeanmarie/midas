<html>
<head>
<title>SAMPLE15 - tester l'attribut Lecture seule d'un champ</title>
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
  <p><span class="titre1"><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample15_consultation.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample16_attributs.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>TESTER L'ATTRIBUT &quot;LECTURE SEULE&quot; D'UN CHAMP</span><br>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
    $f->frm_Init(false,'200px');
	$f->frm_Protection();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (RU+)",    
	                                           "attrib" => "RU+", 
											   "width" => "350", 
											   "maxlength" => "50", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut (lecture seule)")
											  );
    $f->frm_ObjetChampTexte("Prénom",   array( "label" => "Prénom : (RI)",
	                                           "attrib" => "RI",
											   "width" => "360", 
											   "default" => "Prénom par défaut")
											  );

    $f->frm_ObjetCoche("Cocher",   array( "label" => "Cocher", "title" => "Activation",
                                          "attrib" => "",
										  "help" => "Sélectionner pour saisir ",
										  "default" => "1",
										  "activation" => array("Tel","Rue","Liste","ville") )
											  );


    $f->frm_ObjetChampTexte("Tel",      array( "label" => "Téléphone (R+)",
	                                           "attrib" => "R+",
											   "default" => "01.02.03.04.05",
											   "mask" => "##.##.##.##.##")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (RN)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );
    $f->frm_ObjetChampPopup("POPUP",    array(   "label" => "Popup normal",
											   "attrib" => "U",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php"
											 )
							);
							
    $f->frm_ObjetChampPopup("POPUPRO",    array(   "label" => "Popup normal (U+)",
											   "attrib" => "U+",
											   "width" => "200px",
											   "url" => "sample19_popup_php.php",
											   "default" => "10",
											   "defaultview" => "DEFAULT VIEW"
											 )
							);							
							
    $f->frm_SautLignes();	
    $f->frm_ObjetListe("Liste",        array("label" => "Options", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste",   "width" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Enfant" ) );

    $f->frm_SautLignes();	
    $f->frm_ObjetListe("Liste2",        array("label" => "Sexe", "rows" => "5", "default" => "1", "help" => "choisir une ligne de la liste2", "attrib" => "+"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Enfant", "4" => "Chien", "5" => "Chat", "6"=>"Hamster" ) );


    $f->frm_SautLignes();	
	
    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U+)",
	                                           "attrib" => "U",
											   "width" => "200px",
											   "default" => "LA CHAPELLE SUR ERDRE", 
											   "maxlength" => "50")
											  );

    $f->frm_ObjetChampTexte("Ville2",    array( "label" => "Ville :(U) + <b>frm_ChampLectureSeule()</b>",
	                                           "attrib" => "U",
											   "width" => "200px",
											   "default" => "LA CHAPELLE SUR ERDRE", 
											   "maxlength" => "50")
											  );
											   
    $f->frm_ObjetCoche("Cocher2",   array( "label" => "Cocher", "title" => "Lecture seule",
                                          "attrib" => "+",
										  "help" => "Sélectionner pour saisir ",
										  "default" => "1" )
											  );

	$f->frm_ChampLectureSeule('Ville2');

	$f->frm_Ouvrir();

?>
  </p>
<p><strong>2 possibilit&eacute;s :</strong></p>
<p>1) A la d&eacute;claration de l'objet &quot;attrib&quot; =&gt; &quot;+&quot; </p>
<p>2) Apr&egrave;s la d&eacute;claration de l'objet at avant son affichage par la fonction <strong>frm_ChampLectureSeule() </strong></p>
</blockquote>

</body>
</html>
