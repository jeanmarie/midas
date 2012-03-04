<html>
<head>
<title>choisir une option</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
</HEAD> 
<BODY> 
<SCRIPT language="javascript">
var myData1 = [
	["12","Action scolaire"],
	["22","Action Sociale"],
	["26","Bâtiments"],
	["19","Bibliothèque"],
	["27","Cabinet du Maire"],
	["17","Capellia"],
	["28","Communication"],
	["16","Direction de la Culture"],
	["21","Direction de l\'Action Sociale et de l\'Emploi"],
	["11","Direction de l\'Enfance, de la Jeunesse et des Sports"],
	["3","Direction des Services de Gestion"],
	["7","Direction du Cadre de Vie"],
	["4","Direction Générale des Services"],
	["23","Emploi"],
	["25","Environnement"],
	["14","Jeunesse"],
	["13","Petite Enfance"],
	["30","Police Municipale"],
	["1","Service Informatique"],
	["8","Service de l\'Administration Générale"],
	["6","Service des Finances"],
	["5","Service du Personnel"],
	["29","Service Marchés / Logistique"],
	["10","SIVOM"],
	["15","Sports"],
	["24","Urbanisme"]
];

function externe() {
	alert('appel a une fonction externe !');
}
</SCRIPT>

<?php

	include('classeForms.php');		
	$f = New Forms;
	
    $f->frm_Init();
	$f->frm_popup_called('myData1','externe()');



?>


</body>
</html>
<?php
?>