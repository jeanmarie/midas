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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample03_masques.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;DATE&quot;</span></span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"300px");
	$def_DATE_1 = ( isset($_POST['DATE_1']) )  ? $_POST['DATE_1']    : "01/02/2005 10:00:00";
	$def_DATE_2 = ( isset($_POST['DATE_2']) )  ? $_POST['DATE_2']    : "";
	$def_TIMESTAMP = ( isset($_POST['TIMESTAMP']) )  ? $_POST['TIMESTAMP']    : "TIMER";
	$def_TIMESTAMP2 = ( isset($_POST['TIMESTAMP2']) )  ? $_POST['TIMESTAMP2']    : "";

	
    $f->frm_ObjetChampTexte("DATE_1",        array( "label" => "Date manuelle ou avec calendrier (attrib=DP)",
	                                         "attrib" => "DP",
											 "default" => $def_DATE_1,
											 "help" => "Saisir une date ou la sélectionner dans au calendrier")
											 );
											   
    $f->frm_ObjetChampTexte("DATE_2",        array( "label" => "Date sans calendrier vierge (attrib=D)",
	                                         "attrib" => "D",
											 "default" => $def_DATE_2,
											 )
											 );
    $f->frm_ObjetChampTexte("DATE_3",        array( "label" => "Date lecture seule (attrib=DP+)",
	                                         "attrib" => "DP+",
											 "default" => "TIMER",
											 )
											 );
											   
    $f->frm_ObjetChampTexte("TIMESTAMP",     array( "label" => "Time stamp (attrib=T)",
	                                         "attrib" => "T",
											 "help" => "sélectionner une date dans le calendrier",
											 "default" => $def_TIMESTAMP)
											 );

    $f->frm_ObjetChampTexte("TIMESTAMP2",     array( "label" => "Time stamp vierge",
	                                         "attrib" => "T",
											 "default" => $def_TIMESTAMP2,											 
											 "help" => "sélectionner une date dans le calendrier")
											 );

    $f->frm_ObjetChampTexte("TIMESTAMP3",     array( "label" => "Time stamp (+)",
	                                         "attrib" => "T+",
											 "default" => "TIMER",											 
											 "help" => "sélectionner une date dans le calendrier")
											 );


	$f->frm_Ouvrir();
	
	print "<pre>";
	print "\$_POST() = ";
	print_r($_POST);
	print "</pre>";
	
	
?>
  </p>
</blockquote>
</body>
</html>
