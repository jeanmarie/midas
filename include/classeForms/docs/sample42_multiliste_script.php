<html>
<head>
<title>Manipulation d'une liste à choix multiple</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<blockquote>
  <p>&nbsp;  </p>
  <p><span class="titre1 style1"><strong><a href="index.php#ANNEXES"><br>
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample41_multiliste_onglets.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample43_uploader_simple.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </strong>ANALYSE DES CHOIX PAR SCRIPT </span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"250px");

	$tableau1 = array( 	"1" => "08:00 - 09:00", 
						"2" => "09:00 - 10:00", 
						"3" => "10:00 - 11:00", 
						"4" => "11:00 - 12:00", 
						"5" => "12:00 - 13:00", 
						"6" => "13:00 - 14:00", 
						"7" => "14:00 - 15:00",
						"8" => "15:00 - 16:00",
						"9" => "16:00 - 17:00",
						 );
	

	$def1 = ( empty($_POST['LISTE_T1']) ) ?  "2,3,4" : $_POST['LISTE_T1'];
	$def2 = ( empty($_POST['LISTE_T2']) ) ?  "4,5" : $_POST['LISTE_T2'];
	$def3 = ( empty($_POST['LISTE_T3']) ) ?  "1,2"   : $_POST['LISTE_T3'];



												  
    $f->frm_ObjetMultiListe("LISTE_T1",       array(
											    "label" => "5 choix MAXI mais quelconques",
												"default" => $def1,
												"attrib" => "R",
												"rows" => "auto",
												"modeblock" => true,
												"modeblockrestore" => true,
												"limit" => "5",
												"limitmessage" => "Il n'est pas permis de faire + de 5 choix",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T2",       array(
											    "label" => "3 choix mais CONTINUS",
												"default" => $def2,
												"rows" => "auto",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"limit" => "3",
												"limitmessage" => "Il n'est pas permis de sélectionner un véhicule pour une durée supérieure à 3 heures",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
	$f->frm_SautLignes(1);
    $f->frm_ObjetMultiListe("LISTE_T3",       array(
											    "label" => "50 choix au maximum",
												"default" => $def3,
												"rows" => "auto",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"limit" => "50",
												"limitmessage" => "Il n'est pas permis de sélectionner un véhicule pour une durée supérieure à 50 heures",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Le bouton TOUT SELECTIONNER fonctionne quand même malgré le parametre \"limit\" => 50 car cette limite ne peut pas être atteinte compte tenu du nombre d'éléments dans la liste",
												"width" => "120px"),
								  	          $tableau1
											  );
											  
											  
	$f->frm_SautLignes(1);
	
    $f->frm_ObjetChampTexte("TEL",    array( "label" => "N° de téléphone",
											   "default" => "12.34.56.78.90",
											   "mask" => "##.##.##.##.##",
											   "help" => "Saisir le numéro de téléphone a travers le masque ##.##.##.##.##"));

    $f->frm_ObjetMultiListe("NOMCHAMP",       array(
											    "label" => "SCRIPT customisé",
												"default" => $def3,
												"rows" => "auto",

												"script" => "Custom()",

												"mode" => "save",
												"help" => "Selectionner des lignes de la liste",
												"width" => "120px"),
								  	          $tableau1
											  );


	$f->frm_Ouvrir();
	print "<hr><pre>\$_POST()=";
	print_r($_POST);
	print "</pre>";

?>
	<script language="JavaScript" type="text/JavaScript">
	function Custom() {
		if (oNOMCHAMP.MultiSelect_onChange()) { 
			valeurTEL = MM_findObj('TEL').value;
			alert('Le script Custom() est appelé à chaque changement de valeur et peut par exemple afficher la valeur du champ du dessus : "'+valeurTEL+'"\nnombre d options = '+oNOMCHAMP.MultiSelect_Counter() ); 
			oNOMCHAMP.MultiSelect_SaveChange(); 
		}	
	}
	</script> 
  </p>
</blockquote>
</body>
</html>
