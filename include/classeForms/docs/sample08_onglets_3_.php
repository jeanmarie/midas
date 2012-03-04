<?php
	include('classeForms.php');		

	$f = New Forms;
    $f->frm_Init(false,"180");

	$f->frm_OngletDefinir( array("width" => "300px", "height" => "200px") );


	$f->frm_OngletNouveau('Titulaire');
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("NOM",      array( "label" => "Nom (*)", "attrib" => "RU", "width" => "250px")
		 								    );

	$f->frm_OngletNouveau('Adresse'); 
	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("NOMRUE",   array( "label" => "Voie",
											"attrib" => "RI",
											"width" => "200px",
											"help" => "saisir le type et le nom de la voie")
											);

	$f->frm_OngletNouveau('Informations'); 
	
		$f->frm_SautLignes();
	    $f->frm_ObjetChampTexte("INFO1",   array( "label" => "Libre",
											"attrib" => "RN",
											"width" => "50px")
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

<table width="800" border="2">
  <tr>
    <td width="150" nowrap>&nbsp;</td>
    <td width="*">***<?php		
	$f->frm_Ouvrir();
?>***</td>
  </tr>
</table>

</blockquote>


</body>
</html>
