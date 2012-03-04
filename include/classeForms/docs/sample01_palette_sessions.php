<?php
	session_start();
	if ( !isset( $_SESSION['DEFAULT_SKIN']) ) {
		$_SESSION['DEFAULT_SKIN'] = 0;
	}
	include('classeForms.php');		

	$f = New Forms;
	$tableaubascule = array( "1"=>"Lundi", 
							 "2"=>"Mardi", 
							 "3"=>"Mercredi",
							 "4"=>"Jeudi",
							 "5"=>"Vendredi",
							 "6"=>"Samedi",
							 "7"=>"Dimanche");
	
    $f->frm_Init(false);

	// changement de palette
	if (!isset($_GET['PALETTE'])) {
		if ( isset($_SESSION['DEFAULT_SKIN']) ) {
			$codepalette = $_SESSION['DEFAULT_SKIN'];
		} else {
			$codepalette = 0;
		}
	} else {
		$codepalette = $_GET['PALETTE'];
		$_SESSION['DEFAULT_SKIN'] = $codepalette;	
	}
		
	$f->frm_InitPalette($codepalette);
		
	$f->frm_OngletDefinir( array("width" => "550px", "height" => "300px") );

	#$f->frm_Protection();
    $f->frm_ObjetChampTexte("Nom0",      array( "label" => "Nom0 (erreur)")
											  );
    $f->frm_ObjetChampTexte("Aucun",    array( "label" => "champ obligatoire","help" => "champ qui ne fait rien mais est obligatoire","attrib" => "R"));

    $f->frm_ObjetChampTexte("CDate",    array( "label" => "Date avec calendrier",
	                                           "attrib" => "DP",
											   "help" => "Saisir la date de début"));
											   
											   
											   
											   
$f->frm_OngletNouveau('Coordonnées');	
    $f->frm_ObjetChampTexte("Nom",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("Prénom",   array( "label" => "Prénom : (I*)",
	                                           "attrib" => "RI",
											   "size" => "40",
											   "default" => "Prénom par défaut")
											  );
    $f->frm_ObjetChampTexte("Rue",      array( "label" => "Rue : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );

    $f->frm_ObjetChampTexte("numero",   array( "label" => "Numéro : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
											  );
	$f->frm_SautLignes(1);	
	
    $f->frm_ObjetChampTexte("Tel",      array( "label" => "Téléphone (*)",
	                                           "attrib" => "R",
	                                           "default" => "02.51.81.87.10",
											   "mask" => "##.##.##.##.##")
											  );

    $f->frm_ObjetChampTexte("Ville",    array( "label" => "Ville :(U)",
	                                           "attrib" => "U",
											   "size" => "40",
											   "maxlength" => "50")
											  );

    $f->frm_ObjetChampTexte("CDateW",    array( "label" => "Date avec calendrier",
	                                           "attrib" => "DP",
											   "help" => "Saisir la date de début"));		

	$f->frm_SautLignes(1);	
	
    $f->frm_ObjetCoche("Cocher01",   array( "label" => "Cocher", "title" => "Ne fait rien du tout", "default" => "1"
									     ) 
							 );											   									   
    $f->frm_ObjetCoche("Cocher02",   array( "label" => "Cocher", "attrib" => "+", "title" => "lecture seule", "default" => "1"
									     ) 
							 );											   									   
    $f->frm_ObjetCoche("Cocher03",   array( "label" => "Cocher", "attrib" => "+",  "title" => "lecture seule", "default" => "0"
									     ) 
							 );											   									   

    $f->frm_ObjetCoche("Cocher",   array( "label" => "Cocher", "title" => "ACTIVATION",
											"help" => "Sélectionner pour activer des champs ",
 										    "activation" => array("CDate3","COMMENTAIRE")
									     ) 
							 );											   									   




$f->frm_OngletNouveau('Détails');	
    $f->frm_ObjetBoutonsRadio("BtnRad0", array("label" => "Urgence",
	                                          "default" => "2",
											  "orientation" => "H",
											  "help" => "sélectionner le degre d'urgence",
									     ),
								  	     array( "1" => "Bloquant", "2" => "Normal", "3" => "Confort" )  
							 );
							 

    $f->frm_ObjetChampTexte("CDate2",   array( "label" => "Date sans calendrier",
	                                           "attrib" => "D"));
    $f->frm_ObjetChampTexte("CDate3",    array( "label" => "Time stamp",
	                                           "attrib" => "T",
											   "help" => "sélectionner une date date le calendrier",
											   "default" => "TIMER"));

											   
    $f->frm_ObjetChampMemo("commentaire",   array( "label" => "Commentaire (RU",
	                                           "attrib" => "RU",
											   "size" => "200",
											   "rows" => "4",
											   "help" => "AIDE = Memo par défaut il peut s'etendre sur plusieurs lignes",
											   "default" => "  Memo par défaut il peut s'etendre sur plusieurs lignes"));
											   
    $f->frm_ObjetChampTexte("Time",     array( "label" => "Time (*)", "attrib" => "RH", "default" => "10:33"));

	$f->frm_SautLignes(1);	
	
    $f->frm_ObjetBoutonsRadio("BtnRad", array("label" => "Sexe",
	                                          "default" => "3",
											  "help" => "cocher H/F",
											  "activation" => array("H","F","Liste") ),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Liste ci dessous" )  
										);
    $f->frm_ObjetChampTexte("H",        array( "label" => "Homme (L)", "attrib" => "L", "default" => "c'est un homme","help" => "champ activé quand Homme est coché"));
    $f->frm_ObjetChampTexte("F",        array( "label" => "Femme  (U-)", "attrib" => "U-", "default" => "c'est une femme","help" => "champ activé quand Femme est coché"));
    $f->frm_ObjetListe("Liste",        array("label" => "Sexe", "attrib" => "-", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "size" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );

$f->frm_OngletNouveau('Voyage');	

    $f->frm_ObjetCoche("Cocher1",   array( "label" => "Cocher", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "true" )
											  );

    $f->frm_ObjetCoche("Cocher2",   array( "label" => "Cocher 2", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "false" )
											  );
    $f->frm_ObjetCoche("Cocher3",   array( "label" => "Cocher 3", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"activation" => array("Liste__","Liste1"),
											"default" => "1" )
											  );
	$f->frm_SautLignes(1);	
	
    $f->frm_ObjetListe("Liste__",        array("label" => "Sexe", "orientation" => "V", "default" => "2", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "size" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );


	$f->frm_SautLignes(1);	
	
	$f->frm_ObjetCoche("Cocher4",   array( "label" => "Cocher 4", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "true" )
											  );

    $f->frm_Objet2Listes("Liste1",  array("label" => "Province", "attrib" => "", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   
	                                               "width" => "200", "title1" => "---choisir le Genre---", "title2" => "---choisir le Prénom---"),
 								   array( "1" => "Homme", "2" => "Femme", 
											        "1.1" => "Jean", "1.2" => "Paul", "2.1" => "Brigitte", "2.2" => "Paulette", "2.3" => "Cathy" )
										  );
$f->frm_OngletNouveau('Commune');	


	$tablecom = array("035" => "La Chapelle sur Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce");
    $f->frm_ObjetListeLongue("Liste2",   array("label" => "Communes",
							 "field" => "DEPT",		
//							 "default" => "035",		
							 "attrib" => "RU",
							 "rows" => "4",
							 "help" => "choisir une commune du département",
							 "width" => "250"),
							 $tablecom );
    $f->frm_SautLignes(1);	
	
    $f->frm_ObjetBascule("ListeBascule",     array("label" => "Jours Semaine",
											 "default" => "1",
											 "attrib" => "R",
											 "rows"=>"10",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "help" => "choisir au moins un jour de la semaine dans la liste gauche",
											 "width" => "150px"),
								  	    $tableaubascule );

$f->frm_OngletNouveau('Editeur');	

    $f->frm_SautLignes(1);	

    $f->frm_ObjetEditeur("EDITEUR",    array( "label" => "Champ Editeur",
											   "width" => "400px",
											   "height" => "250px",
											   "default" => "\Ceci c'est la <b>valeur par défaut\n</b> passé au <um>champ \"Editeur\"</um><br>Le contenu de ce  champ est évidemment à sauvegarder dans un champ mémo "
											  )
						);

	$f->frm_ChampEnErreur("BtnRad", "<h1>le nom contient des blancs</h1>");
	$f->frm_ChampEnErreur("COCHER2", "Doit etre coché");
	$f->frm_ChampEnErreur("NOM0", "frm_ChampEnErreur");
	$f->frm_ChampEnErreur("NOM", "frm_ChampEnErreur");



	##########################################################################

    $ret = $f->frm_Aiguiller();
	switch ( $ret ) {
	
		case "A0" :
			$action = "APPEL A LA FENETRE EN AJOUT n°1";
			break;

		case "A1" :
			$action = "APPEL A LA FENETRE EN AJOUT n°2 et +";
			break;

		case "M0" :
			$action = "APPEL A LA FENETRE EN MODIFICATION n°1";
			break;

		case "M1" :
			$action = "APPEL A LA FENETRE EN MODIFICATION n°2 et +";
			break;

		case "MQ" :
			$action = "QUITTER MODIF ";
			break;

		case "AQ" :
			$action = "QUITTER AJOUT ";
			break;

		case "L0" :
			$action = "LECTURE SEULE";
			break;			

		case "LQ" :
			$action = "QUITTER VISU ($ret)";
 		    header("Location: AfficherResultats.php");			
			break;
	}

?>
<html>
<head>
<title>SAMPLE01 - Exemple de palettes disponibles</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<?php
	include('_data_top_menu.php');

?>



<h4>&nbsp;</h4>
<blockquote>
  <h4><span class="titre1 style1"><a href="index.php#ANNEXES"><br>
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <img src="fleche_.gif" width="16" height="16" border="0"><a href="sample02_protection_sessions.php"><img src="fleche.gif" width="16" height="16" border="0"></a> <span class="style3">CHOIX D'UNE PALETTE PRE-DEFINIE</span></span></h4>
  <blockquote>
    <h4>
      <?php		
	print "<h1>PALETTE = $codepalette</h1>";
	print "SESSION[DEFAULT_SKIN] = " . $_SESSION['DEFAULT_SKIN']; 
	$f->frm_Ouvrir();
?>
    </h4>
  </blockquote>
  <p>voir la m&ecirc;me grille mais de la couleur : </p>
  <ul>
    <li><a href="sample01_palette_sessions.php?PALETTE=0">rouge (defaut) </a></li>
    <li><a href="sample01_palette_sessions.php?PALETTE=1">bleu</a></li>
    <li><a href="sample01_palette_sessions.php?PALETTE=2">gris</a></li>
    <li><a href="sample01_palette_sessions.php?PALETTE=3">jaune</a></li>
    <li><a href="sample01_palette_sessions.php?PALETTE=4">vert</a></li>
    <li><a href="sample01_palette_sessions.php?PALETTE=5">orange</a></li>
    <li><a href="sample01_palette_sessions.php">COULEUR DE SESSION</a> ou bien aller &agrave; la <a href="sample02_protection_sessions.php">page suivante</a> la couleur sera concervee </li>

  </ul>
</blockquote>
</body>
</html>
