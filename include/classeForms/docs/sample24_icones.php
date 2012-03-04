<?php
	include('classeForms.php');		

	$f = New Forms;
    $f->frm_Init(false,"150px");

	$f->frm_OngletDefinir( array("width" => "550px", "height" => "400px") );


	$f->frm_OngletNouveau('Titulaire');
	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("NOM",      array( "label" => "Nom (*)", "attrib" => "RU")
		 								    );
    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_1",    array(  "label" => "Selecteur d'icones (R)",
											   "attrib" => "R",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/alcazar.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_2",    array(  "label" => "Selecteur d'icones (n°=2)",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/dupont.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_3",    array(  "label" => "Selecteur d'icones (n°=3)",
											   "attrib" => "U",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/dupond.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);
    $f->frm_SautLignes();											   
    $f->frm_ObjetChampIcone("ICONE_4",    array(  "label" => "Icone en affichage seulement (+)",
											   "attrib" => "+",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "./icones/haddock.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

    $f->frm_ObjetChampIcone("ICONE_5",    array(  "label" => "Icone en taille 64x64",
											   "url" => "sample23_icones_popup.php",
											   "width" => "64",
											   "height" => "64",
											   "path" => "./icones/",
											   "default" => "./icones/tintin.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
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
	include('_data_top_menu.php');

?>	

<blockquote>
  <p class="titre1 style1">&nbsp;</p>
  <p class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample23_icones.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample25_confirm.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">SELECTEUR D'IMAGES</span>
  </p>
<table width="500" border="0">
  <tr>
    <td>&nbsp;</td>
    <td><?php		
	$f->frm_Ouvrir();
?></td>
  </tr>
</table>



</blockquote>

</body>
</html>
