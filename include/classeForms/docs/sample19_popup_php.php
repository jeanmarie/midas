<html>
<head>
<title>choisir une option</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
</HEAD> 
<BODY> 


<?php

	$myData	= array( "12"=>"Action scolaire",
					 "22"=>"Action Sociale",
					 "26"=>"Bâtiments",
					 "19"=>"Bibliothèque",
					 "27"=>"Cabinet du Maire",
					 "17"=>"Capellia",
					 "28"=>"Communication",
					 "16"=>"Direction de la Culture",
					 "21"=>"Direction de l'Action Sociale et de l'Emploi",
					 "11"=>"Direction de l'Enfance, de la Jeunesse et des Sports",
					 "3"=>"Direction des Services de Gestion",
					 "7"=>"Direction du Cadre de Vie",
					 "4"=>"Direction Générale des Services",
					 "23"=>"Emploi",
					 "25"=>"Environnement",
					 "14"=>"Jeunesse",
					 "13"=>"Petite Enfance",
					 "30"=>"Police Municipale",
					 "1"=>"Service Informatique",
					 "8"=>"Service de l'Administration Générale",
					 "6"=>"Service des Finances",
					 "5"=>"Service du Personnel",
					 "29"=>"Service Marchés / Logistique",
					 "10"=>"SIVOM",
					 "15"=>"Sports",
					 "24"=>"Urbanisme"
					 );

	include('classeForms.php');		
	$f = New Forms;
	
    $f->frm_Init();
	$f->frm_popup_called($myData);

	if (isset($_GET['PARAM'])) {
		print "<h5>\$_GET['PARAM']=".$_GET['PARAM']."</h5>";
		print "<p>Ce paramètre permet d'exécuter une requête conditionnelle qui chargera les valeurs de la liste ci-dessus</p>";
		print "<p><b>Exemple :</b> Afficher seulement les communes d'un département c'est accélérer le chargement des valeurs</p>";
		
	}
?>


</body>
</html>
<?php
?>