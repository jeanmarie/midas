<html>
<head>
<title>SAMPLE15 - tester les protections de la page HTML</title>
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



<blockquote>
  <p>&nbsp;</p>
  <p><span class="titre1"><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample02_nolabel.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample03_masques.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>TESTER LA PROTECTION DE LA GRILLE : Les clics droits sont neutralis&eacute;s</span><br>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init();
	$f->frm_Protection();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "width" => "350", 
											   "maxlength" => "50", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom \"par défaut\"")
											  );
    $f->frm_ObjetChampTexte("Prénom",   array( "label" => "Prénom : (I*)",
	                                           "attrib" => "RI",
											   "width" => "360", 
											   "default" => "Prénom par défaut")
											  );

    $f->frm_ObjetCoche("Cocher",   array( "label" => "Cocher", "title" => "Déplacement",
											"help" => "Sélectionner pour saisir ",
											"default" => "0",
											"activation" => array("Tel","Rue","Liste","ville") )
											  );


    $f->frm_ObjetChampTexte("Tel",      array( "label" => "Téléphone (*)",
	                                           "attrib" => "R",
											   "default" => "01.02.03.04.05",
											   "mask" => "##.##.##.##.##")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );

    $f->frm_ObjetListe("Liste",        array("label" => "Sexe", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "size" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );


    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U)",
	                                           "attrib" => "U",
											   "size" => "50",
											   "default" => "LA CHAPELLE SUR ERDRE", 
											   "maxlength" => "50")
											  );

											   


	$f->frm_Ouvrir();
?>
        
</p>
</blockquote>
</body>
</html>
