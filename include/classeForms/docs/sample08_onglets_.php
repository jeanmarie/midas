<?php
	include('classeForms.php');		

	$f = New Forms;
    $f->frm_Init(false,"150px");

	    $f->frm_ObjetChampTexte("DATEABON0", array( "label" => "Date d'inscription","attrib" => "DP","linesafter" => "1")
											);

	$f->frm_OngletDefinir( array("width" => "450px", "height" => "200px") );


	$f->frm_OngletNouveau('Titulaire');
		$f->frm_SautLignes();
	    $f->frm_ObjetTimer("MON_TIMER", 	array("label" => "Horloge",
											  "width" => "70px",
											  "icon" => $iconedefauttimer ,
											  "format" => $formatdefauttimer)
											  );	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("NOM",      array( "label" => "Nom (*)", "attrib" => "RU", "width" => "250px")
		 								    );
	    $f->frm_ObjetChampTexte("PRENOM",   array( "label" => "Prénom (*)", "attrib" => "I")
		 								    );
	    $f->frm_ObjetChampTexte("DATEABON", array( "label" => "Date d'inscription","attrib" => "DP","linesafter" => "1")
											);
	    $f->frm_ObjetCoche("ADRESSEABON",   array( "label" => "Coordonnée", "title" => "Saisie de l'adresse",
											"help" => "Saisir les coordonnées complète de l'abonné",
 										    "activation" => array("NUMRUE","NOMRUE","CP","VILLE") ) 
							                );			

	$f->frm_OngletNouveau('Adresse'); 
	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("NUMRUE",   array( "label" => "N°",
											"attrib" => "RN",
											"width" => "50px",
											"help" => "saisir le numéro de la rue")
											);
	    $f->frm_ObjetChampTexte("NOMRUE",   array( "label" => "Voie",
											"attrib" => "RI",
											"width" => "200px",
											"help" => "saisir le type et le nom de la voie")
											);
	    $f->frm_ObjetChampTexte("CP",       array( "label" => "Code postal",
											"attrib" => "RN",
											"width" => "80px",
											"help" => "saisir le code postal")
											);
	    $f->frm_ObjetChampTexte("VILLE",    array( "label" => "VILLE", 
											"attrib" => "U",
											"width" => "200px")
		 								    );

	$f->frm_OngletNouveau('Informations'); 
	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("INFO1",   array( "label" => "Libre",
											"attrib" => "RN",
											"width" => "50px")
											);

	    $f->frm_ObjetChampTexte("INFO2",   array( "label" => "Libre",
											"attrib" => "RN",
											"width" => "50px")
											);
    	$f->frm_ObjetColorPicker("LE_FOND",      array( "label" => "Couleur du fond",
											   "help" => "Saisir une couleur pour le fond",
											   "default" => "3399CC",
											   "width" => "110px",
 											   "target" => "background")
											   );
    	$f->frm_ObjetChampIcone("ICONE_1",    array(  "label" => "Selecteur d'icones (R)",
											   "attrib" => "R",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/alcazar.gif",
											   "winwidth" => "250",
											   "winheight" => "100"
											 )
							);
//	$f->frm_OngletDefaut('Adresse'); 
	//$f->frm_OngletDefaut(2); 

	
?>
<html>
<head>
<title>CLASSEFORMS - Exemple d'onglets</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<?php
	//include('_data_top_menu.php');

?>

<blockquote>
  <p>&nbsp;</p>
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample07_radio_onglets2.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample09_listes_bascule.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">GESTION DES ONGLETS </span></span>
  </p>

<table width="500" border="2">
  <tr>
    <td width="150" nowrap>&nbsp;</td>
    <td width="*"><?php		
	$f->frm_Ouvrir();
?></td>
  </tr>
</table>

</blockquote>


</body>
</html>
