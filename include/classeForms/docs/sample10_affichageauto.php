<html>
<head>
<title>SAMPLE10 - Affichage automatique des champs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
	include('_data_top_menu.php');

?>	
<blockquote>
<p>&nbsp;</p>


<br>
<?php
	$tableau = array( "1"=>"Lundi", 
							 "2"=>"Mardi", 
							 "3"=>"Mercredi",
							 "4"=>"Jeudi",
							 "5"=>"Vendredi",
							 "6"=>"Samedi",
							 "7"=>"Dimanche",
							 "8"=>"RENE\"Jean",
							 "9"=>"TOTO'@dfdf.fr"
							 );

	include("classeForms.php");		

	$f = New Forms;

    $f->frm_Init(false,"150px");
	#$f->frm_Protection();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "width" => "200px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );

											   
    $f->frm_ObjetListeEditable("Liste",    array("label" => "Liste éditable n°=1",
	                                             "attrib" => "RI", 
											   	 "default" => "XAVIER Charles",
												 "width" => "200px", 
												 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
												 "linesafter" => "2"
												 ),
											$tableau );

    $f->frm_ObjetListeEditable("Liste2",    array("label" => "Liste éditable n°=2",
											   	 "default" => "2",
												 "width" => "200px", 
												 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
												 ),
											$tableau );

    $f->frm_ObjetListe("Liste3",        array("label" => "Liste classique",
											"orientation" => "V",
											"default" => "2",
											"help" => "choisir une ligne de la liste surtout pas le dernier merci",
											"width" => "200px"
											),
								  	    $tableau );


	$f->frm_Ouvrir();
?>

</blockquote>
</body>
</html>
