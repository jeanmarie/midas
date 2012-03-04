<html>
<head>
<title>SAMPLE 60 - Activer un champ par défaut</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample53_titre_ou_message.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample61_focus_premier.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">ACTIVER UN CHAMP PARTICULIER (ici &quot;NOMBRE&quot;) ET EVENTUELLEMENT LE RENDRE PRE-SELECTIONNE </span></span>
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
//	$f->frm_ActiverBtnValider();
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "R", 
											   "width" => "200px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );

    $f->frm_ObjetChampTexte("Nombre",      array( "label" => "Nombre :",    
	                                           "attrib" => "RN", 
											   "width" => "50px", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "10")
											  );
    $f->frm_ObjetListe("LISTE_OBLIG",           array(
											    "label" => "Choix obligatoire (*)",
												"attrib" => "R",
												"default" => "5",
												"help" => "choisir  OBLIGATOIREMENT un élément de la liste",
												"width" => "200px"),
								  	          $tableau 
											  );
											  
	$valeur = (isset($_POST['SELECTION'])) ? $_POST['SELECTION'] : '1';
    $f->frm_ObjetBoutonsRadio("SELECTION", array("label" => "SELECTION",
	                                          "default" => $valeur),
								  	     array('1'=>'Oui', '2'=> 'Non')
										);

	if (isset($_POST['SELECTION'])) {
		$valeur = ($_POST['SELECTION']=='1');
	} else {
		$valeur = true;
	}
    $f->frm_InitFocus("Nombre", $valeur);
											   
	$ret = $f->frm_Aiguiller();


	$f->frm_Ouvrir();
	if ($f->frm_Reentrant()) {
		print '<hr>';
		print 'ces 2 barres horizontales apparaissent quand le formulaire est ré-entrant ( frm_Reentrant )';
		print '<hr>';
	}
?>
  </p>
</blockquote>
</body>
</html>
