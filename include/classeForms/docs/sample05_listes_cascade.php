<html>
<head>
<title>Manipulation de listes</title>
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
    <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample05_listes.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample05_listes_cascade2.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHAMPS &quot;LISTES EN CASCADE&quot; SUR 36000 COMMUNES !  </span></span>
    <?php		

	include('classeBases.php');
	$base = New Bdd;
    $base->bdd_connecter_base("oberlechner.net");

	include('classeForms.php');		
	
	$f = New Forms;
	
    $f->frm_Init(false,"150px");


	$def_NOM = ( isset($_POST['NOM']) )  ? stripslashes($_POST['NOM'])       : "abécédé";	

	$def_LISTES_CASCADES_H = ( isset($_POST['LISTES_CASCADES_H']) )  ? stripslashes($_POST['LISTES_CASCADES_H'])       : "";	
	$def_LISTES_CASCADES_V = ( isset($_POST['LISTES_CASCADES_V']) )  ? stripslashes($_POST['LISTES_CASCADES_V'])       : "35696";	




	// CHARGEMENT DES AGENTS DE LA TABLE "testbaseadr"
	$requete  = "SELECT * 
					FROM insee_regions
						ORDER BY reg_nom"; 	    
    $base->bdd_execsql($requete);	
	$tableau_regions = $base->bdd_tableversliste( array("reg_id","reg_nom") );											   

    $f->frm_ObjetChampTexte("NOM",    array( "label" => "Nom",
											   "default" => $def_NOM,
											   "attrib" => "R",
											   "width" => "200px",
											   "help" => "Saisir un nom"));
											   											 

	$f->frm_SautLignes(1);	
    $f->frm_ObjetListesCascade("LISTES_CASCADES_H",       array(
												"label" => "listes en liaison (H)",
												"orientation" => "H",
												"default" => $def_LISTES_CASCADES_H,
												"help" => "choisir une option et une sous-option",   
	                                            "width" => "200px",
												"ajax" => "sample05_listes_cascade_H_called.php",
												"list" => array( 
															array( 'id'     => 'REGION',
																   'title' => "---choisir une région---",
																   'width' => '150px' ),
															array( 'id'     => 'DEPT',
																   'title' => "---choisir le département---",
																   'width' => '200px' ),

															)
														),
 								   			$tableau_regions
										     );											 

	$f->frm_SautLignes(1);
    $f->frm_ObjetListesCascade("LISTES_CASCADES_V",       array(
												"label" => "listes en liaison (V)",
												"orientation" => "V",
											    "attrib" => "R",
												"default" => $def_LISTES_CASCADES_V,
												"help" => "choisir une option et une sous-option",   
	                                            "width" => "200px",
												"list" => array( 
															array( 'id'     => 'REGION',
																   'title' => "---choisir une région---",
															       'ajax' => "sample05_listes_cascade_V_called.php?KOKO=1",																   
																   'width' => '150px' ),
															array( 'id'     => 'DEPT',
																   'title' => "---choisir le département---",
															       'ajax' => "sample05_listes_cascade_V_called.php",																   
																   'width' => '200px' ),
															array( 'id'     => 'VILLE',
																   'title' => "---choisir la ville---",
															       'ajax' => "sample05_listes_cascade_V_called.php",																   
																   'width' => '350px' ),

															)
														),
 								   			$tableau_regions
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
