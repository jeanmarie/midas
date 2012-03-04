<html>
<head>
<title>SAMPLE20_separateurs.php - Positionnement de séparateur quand le nombre de champs est trop important</title>
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
  <p><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample19_popup.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample21_separateurs_onglets.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">UTILISATION DES PARAGRAPHES</span></span>

  </p>
  <table width="750" border="0">
    <tr>
      <td width="67" bgcolor="#99FF00">&nbsp;</td>
      <td width="673"><a href="sample20_separateurs.php?EXCLUSIF=OUI">
    <?php
	$sauveretat = false;
	$modeexclusif = isset($_GET['EXCLUSIF']);

	print "<h3>FONCTIONNEMENT DES PARAGRAPHES EN MODE : ";
	if ($modeexclusif)
		print "EXCLUSIF";
	else
		print "NORMAL";
	print "</H3></a>";
	
	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"400px");
	$f->frm_EnteteDefinir($modeexclusif,$sauveretat);
	
    $f->frm_ObjetChampTexte("Tel",    array( "label" => "N° de téléphone (mask=##.##.##.##.##)",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));


$f->frm_EnteteNouveau("CHAPITRE N°=1");

    $f->frm_ObjetChampTexte("ENTIER_SIMPLE",    array( "label" => "Entier simple entre 1 et 1000 (mask=#,inter=1_1000)",
	                                           "attrib" => "N",
											   "mask" => "#",
											   "inter" => "1_1000",
											   "help" => "Saisir un nombre entier simple # dans l'intervalle [1..1000]"));



$f->frm_EnteteNouveau("CHAPITRE N°=2 (PRE-DEPLOYE)",true);

    $f->frm_ObjetChampTexte("LETTRES",         array( "label" => "Rien que des 10 lettres (mask=xxxxxxxxxx)",
											   "mask" => "xxxxxxxxxx",
											   "help" => "Saisir des lettres à travers le masque x"));


	$f->frm_Ouvrir();
?>
     
      </a></td>
    </tr>
    <tr>
      <td bgcolor="#996633">&nbsp;</td>
      <td bgcolor="#00CC99"></td>
    </tr>
  </table>

</blockquote>
</body>
</html>
