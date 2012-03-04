<?php

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"300px");
	$url_cible = 'index.php#TIMEOUT_EXEMPLE';
	$f->frm_InitTimeOut(30,$url_cible);

    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par d�faut")
											  );
    $f->frm_ObjetChampTexte("Pr�nom",   array( "label" => "Pr�nom : (I*)",
	                                           "attrib" => "RI",
											   "size" => "40",
											   "default" => "Pr�nom par d�faut")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );

    $f->frm_ObjetChampTexte("Tel",      array( "label" => "T�l�phone (*)",
	                                           "attrib" => "R",
	                                           "default" => "02.51.81.87.10",
											   "mask" => "##.##.##.##.##")
											  );

    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U)",
	                                           "attrib" => "U",
											   "size" => "50",
											   "default" => "PARIS",
											   "maxlength" => "50")
											  );

											   

    $f->frm_ObjetBoutonsRadio("CHOIX", array("label" => "Urgence (IL FAUT COCHER CONFORT)",
	                                          "default" => "2",
											  "orientation" => "H",
											  "help" => "s�lectionner le degre d'urgence",
									     ),
								  	     array( "1" => "Bloquant", "2" => "Normal", "3" => "Confort" )  
							 );
							 


    $ret = $f->frm_Aiguiller();
	switch ( $ret ) {
	
		case "A0" :
			break;

		case "A1" :
			$f->frm_Message( array( 	'text' => "La fiche modifi�e a �t� correctement enregistr�e, en cliquant sur l'icone ci-contre ou ouvre l'url dans une autre fen�tre, a utiliser par exemple pour une impression PDF � suivre",
										'url'  => $url_cible,
										'icon' => './icones/alcazar.gif',
										'target' => '_blank',
										'timeout' => 10 ) );
			break;

		default :
			header('Location: '.$url_cible);

	}
?>
<html>
<head>
<title>Manipulation des champs dates et heure</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample50_message_ok.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample52_titre_simple.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">MESSAGE SIMPLE APRES VALIDATION</span></span>
  <br>    
    <?php		

	
	$f->frm_Ouvrir();
/*	
	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";	
*/
?>
  </p>

</blockquote>
</body>
</html>
