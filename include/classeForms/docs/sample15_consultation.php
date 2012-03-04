<html>
<head>
<title>SAMPLE15 - tester le mode consultation</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample14_boutons.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample15_readonly.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3"></span></span>TESTER LA GRILLE EN MODE &quot;CONSULTATION&quot;</span><br>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	$boutonssimple = isset($_GET['SIMPLE']);
    $f->frm_Init(true);
	$f->frm_Protection();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "width" => "350", 
											   "maxlength" => "50", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("Prénom",   array( "label" => "Prénom : (I*)",
	                                           "attrib" => "RI",
											   "width" => "360", 
											   "default" => "Prénom par défaut")
											  );

    $f->frm_ObjetCoche("Cocher",   array( "label" => "Cocher", "title" => "Déplacement",
											"help" => "Sélectionner pour saisir ",
											"default" => "1",
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

    $f->frm_SautLignes();	
    $f->frm_ObjetListe("Liste",        array("label" => "Options", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste",   "width" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Enfant" ) );

    $f->frm_SautLignes();	
    $f->frm_ObjetListe("Liste2",        array("label" => "Sexe", "rows" => "5", "default" => "1", "help" => "choisir une ligne de la liste2",   "width" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Enfant", "4" => "Chien", "5" => "Chat", "6"=>"Hamster" ) );

    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U)",
	                                           "attrib" => "U",
											   "size" => "50",
											   "default" => "LA CHAPELLE SUR ERDRE", 
											   "maxlength" => "50")
											  );

											   

	if ($boutonssimple) { 
		$f->frm_LibBoutons("","Sortir",""); 
	} else {
		$f->frm_LibBoutons("Effacer","Sortir",""); 
	}
	$f->frm_Ouvrir();
	print "<br>";
	if ($boutonssimple) { 
		print '<a href="sample15_consultation.php">Voir ce formulaire en version double bouton</a>';
	} else {
		print '<a href="sample15_consultation.php?SIMPLE">Voir ce formulaire en version simple bouton</a>';
	}
?>
  </p>
</blockquote>
<p>&nbsp; </p>
</body>
</html>
