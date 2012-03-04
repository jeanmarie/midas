<?php
	include('classeForms.php');		

	$f = New Forms;
	$tableaubascule = array( "1"=>"Lundi", 
							 "2"=>"Mardi", 
							 "3"=>"M'ercredi",
							 "4"=>"J\"eudi",
							 "5"=>"Vendredi",
							 "6"=>"Samedi",
							 "7"=>"Dimanche");

	# TABLEAU PERE / FILS
	$tableautree = array( array("0","France (0)",-1,""), 
					   array("1","Paris (1)",0,""),
					   array("2","Marseille (2)",0,""),
					   array("3","Lyon (3)",0,""),
					   array("4","Place de la Concorde (4)",1,""),
					   array("5","Montmartre (5)",1,""),
					   array("6","Vieux port (6)",2,""),
					   array("7","Notre Dame de la Garde (7)",2,""),
					   array("8","Place Bellecourt (8)",3,""),
					   array("9","La croix rousse (9)",3,""),
					   array("10","Invalides (10)",1,""),
					   array("11","Sacré Coeur (11)",5,""),
					   array("12","La place du tertre (12)",5,""),
					);

	$tableauAtrier = array( 	"1" => "1-Paris", 
						"2" => "2-Lyon", 
						"3" => "3-Marseille", 
						"4" => "4-Toulouse", 
						"5" => "5-Bordeaux", 
						"6" => "6-Nantes" );
	
	$readonly = isset($_GET['RO']);
    $f->frm_Init($readonly,'200px');
    $f->frm_InitConfirm();
	//$f->frm_Protection();
    $f->frm_ObjetTimer("OBJET_TIMER", 	array("label" => "Horloge",
											  "width" => "70px",
											  "default" => "2005/04/01 18:50:10",
											  "icon" => true,
											  "format" => "french")
											  );
											  

	$f->frm_SautLignes(1);
	
    $f->frm_ObjetColorPicker("LE_FOND",      array( "label" => "Couleur du fond",
											   "help" => "Saisir une couleur pour le fond",
											   "default" => "3399CC",
											   "width" => "110px",
 											   "target" => "background")
											   );

    $f->frm_ObjetColorPicker("LE_TEXTE",      array( "label" => "Couleur du texte",
											   "help" => "Saisir une couleur pour le texte",
											   "default" => "660033",											  
											   "target" => "text")
											   );

	$f->frm_SautLignes(1);
    $f->frm_ObjetChampIcone("ICONE_1",    array(  "label" => "Selecteur d'icones",
											   "attrib" => "U",
											   "url" => "sample23_icones_popup.php",
											   "path" => "./icones/",
											   "default" => "tintin.gif",
											   "winwidth" => "250",
											   "winheight" => "120"
											 )
							);

	$f->frm_SautLignes(1);
							
    $f->frm_ObjetChampTexte("OT_INACTIF",      array( "label" => "Nom 2 (inactif)",
												 "attrib" => "-",
												 "default" => "INACTIF"
												 )
											  );
    $f->frm_ObjetChampTexte("OT_READONLY",      array( "label" => "Nom 1 (lecture seule)",
												 "attrib" => "+",
												 "default" => "READ ONLY !")
											  );

    $f->frm_ObjetChampTexte("OT_PASSWORD",      array( "label" => "Mot de passe",
												 "attrib" => "W",
												 "default" => "PWD")
											  );

											  										  
    $f->frm_SautLignes();			
												  
    $f->frm_ObjetChampTexte("OT_NORMAL",    array( 	"label" => "champ normal :",
													"help" => "champ qui ne fait rien de particulier",
													"maxlength" => 50,													
											));
    $f->frm_ObjetChampTexte("OT_OBLIGATOIRE",      array( "label" => "Nom : (U*)",    
	                                           "attrib" => "RU", 
											   "size" => "40", 
											   "maxlength" => "20", 
											   "help" => "saisir n'importe quoi", 
											   "default" => "Nom par défaut")
											  );
    $f->frm_ObjetChampTexte("OT_INITIALE",   array( "label" => "Prénom : (I*)",
	                                           "attrib" => "RI",
											   "size" => "40",
											   "default" => "Prénom par défaut")
											  );
    $f->frm_ObjetChampTexte("OT_NUMERIC",      array( "label" => "Rue : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
 	                                           
											  );

    $f->frm_ObjetChampTexte("OT_NUMERO",   array( "label" => "Numéro : (N*)",
	                                           "attrib" => "RN",
											   "size" => "5",
											   "maxlength" => "5",
											   "default" => "3")
											  );
    $f->frm_ObjetChampTexte("OT_MASQUE",      array( "label" => "Téléphone (*)",
	                                           "attrib" => "R",
	                                           "default" => "02.51.81.87.10",
											   "mask" => "##.##.##.##.##")
											  );

											   

    $f->frm_ObjetBoutonsRadio("OBJET_RADIO", array("label" => "Urgence",
	                                          "default" => "2",
											  "orientation" => "H",
											  "help" => "sélectionner le degre d'urgence",
									     ),
								  	     array( "1" => "Bloquant", "2" => "Normal", "3" => "Confort" )  
							 );
							 
    $f->frm_ObjetChampTexte("OT_DATE_DP",    array( "label" => "Date avec calendrier",
	                                           "attrib" => "DP",
											   "help" => "Saisir la date de début"));
    $f->frm_ObjetChampTexte("OT_DATE_D",   array( "label" => "Date sans calendrier",
	                                           "attrib" => "D"));
    $f->frm_ObjetChampTexte("OT_DATE_T",    array( "label" => "Time stamp",
	                                           "attrib" => "T",
											   "help" => "sélectionner une date date le calendrier",
											   "default" => "TIMER"));

											   
    $f->frm_ObjetChampMemo("MEMO",   array( "label" => "Commentaire (RU",
	                                           "attrib" => "RU",
											   "width" => "250",
											   "rows" => "4",
											   "help" => "AIDE = Memo par défaut il peut s'etendre sur plusieurs lignes",
											   "default" => "  Memo par défaut il peut s'etendre sur plusieurs lignes"));
											   
    $f->frm_ObjetChampTexte("OT_TIME",     array( "label" => "Time (*)", "attrib" => "RH", "default" => "10:33"));

    $f->frm_ObjetBoutonsRadio("BtnRad2", array("label" => "Zero",
	                                          "default" => "0",
											  "help" => "cocher 0/2/3" ),
								  	    array( "0" => "Zero", "1" => "Un", "2" => "Deux" )  
										);
    $f->frm_SautLignes();	
										
    $f->frm_ObjetBoutonsRadio("BtnRad", array("label" => "Sexe",
	                                          "default" => "3",
											  "help" => "cocher H/F",
											  "activation" => array("H","F","Liste") ),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Liste ci dessous" )  
										);




    $f->frm_ObjetChampTexte("H",        array( "label" => "Homme (L)", "attrib" => "L", "default" => "c'est un homme","help" => "champ activé quand Homme est coché"));
    $f->frm_ObjetChampTexte("F",        array( "label" => "Femme  (U-)", "attrib" => "U-", "default" => "c'est une femme","help" => "champ activé quand Femme est coché"));

    $f->frm_ObjetListe("Liste",         array("label" => "Liste 1 ligne", "attrib" => "-", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "width" => "200px"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );

    $f->frm_SautLignes(2);	

    $f->frm_ObjetListe("ListeZero",     array("label" => "Liste Chiffres", "orientation" => "V", "default" => "0",  "width" => "200px"),
								  	    array( "0" => "Zero", "1" => "Un", "2" => "Deux" ) );

    $f->frm_SautLignes();		
    $f->frm_ObjetListe("Listelignes",   array("label" => "Plusieurs lignes", "attrib" => "", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "width" => "200px", "rows"=>"3"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );

    $f->frm_ObjetCoche("Cocher1",   array( "label" => "Cocher", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "true" )
											  );

    $f->frm_ObjetCoche("Cocher2",   array( "label" => "Cocher 2", "title" => "Déplacement",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"default" => "false" )
											  );
    $f->frm_ObjetCoche("Cocher3",   array( "label" => "Cocher 3", "title" => "Activer ou non les 2 champs qui suivent",
											"help" => "Sélectionner Si un déplacement est nécessaire",
											"activation" => array("Liste__","Liste1"),
											"default" => "1" )
											  );
    $f->frm_ObjetListe("Liste__",        array("label" => "Sexe", "orientation" => "V", "default" => "2", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   "size" => "200"),
								  	    array( "1" => "Homme", "2" => "Femme", "3" => "Rue" ) );


    $f->frm_Objet2Listes("Liste1",  array("label" => "Province", "attrib" => "", "orientation" => "V", "default" => "1", "help" => "choisir une ligne de la liste surtout pas le dernier merci",   
	                                               "width" => "200px", "title1" => "---choisir le Genre---", "title2" => "---choisir le Prénom---"),
 								   array( "1" => "Homme", "2" => "Femme", 
											        "1.1" => "J'ean", "1.2" => "P\"aul", "2.1" => "Brigitte", "2.2" => "P'aulette", "2.3" => "C\"athy" )
										  );


	$tablecom = array("035" => "La Chapelle sur Erdre", "010" => "Orvault", "020" => "Nantes", "040" => "Carquefou", "050" => "Thouare", "060" => "Sainte-Luce");
    $f->frm_ObjetListeLongue("Liste2",   array("label" => "Communes",
//							 "field" => "DEPT",		
							 "default" => "035",		
							 "attrib" => "RU",
							 "rows" => "4",
							 "help" => "choisir une commune du département",
							 "width" => "250"),
							 $tablecom );

    $f->frm_ObjetBascule("ListeBascule",     array("label" => "Jours Semaine",
											 "default" => "1",
											 "attrib" => "R",
											 "rows"=>"10",
											 "title1" => "Liste gauche", 
											 "title2" => "Liste droite",
											 "sort"  => true,
											 "help" => "choisir au moins un jour de la semaine dans la liste gauche",
											 "width" => "100px"),
								  	    $tableaubascule );

/*    $f->frm_ObjetSlider("Slider01",     array("label" => "Colonnes", 
										      "orientation" => "H",
											  "width" => "80px",
											  "mini"=> "1",
											  "maxi"=>"3",
											  "default" => "2",
											  "help" => "choisir le nombre de colonnes (1,2 ou 3)")
										);
     $f->frm_ObjetSlider("Slider02",     array("label" => "Lignes", "orientation" => "V", 
										     "height" => "100px",
										     "width" => "80px",
											 "mini"=> "0",
											 "maxi"=>"100",
											 "default" => "8",
											 "help" => "choisir le nombre de lignes (0-100)")
										);										
*/
	$tableauLE = array( "1"=>"Lundi", 
							 "2"=>"Mardi", 
							 "3"=>"Mercredi",
							 "4"=>"Jeudi",
							 "5"=>"Vendredi",
							 "6"=>"Samedi",
							 "7"=>"Dimanche",
							 "8"=>"RENE\"Jean",
							 "9"=>"TOTO'@dfdf.fr"
							 );
											   
    $f->frm_ObjetListeEditable("ListeLE",    array("label" => "Sexe",
	                                             "attrib" => "RI", 
											   	 "default" => "XAVIER Charles",
												 "width" => "250px", 
												 "maxlength" => 20,													
												 "help" => "Saisir une valeur de la liste ou saisir une nouvelle",
												 ),
											$tableauLE );
    $f->frm_SautLignes(1);			
    $f->frm_ObjetChampPopup("TEXTEPOPUP",    array(   "label" => "Champ POPUP",
											   "attrib" => "U",
											   "width" => "250px",
											   "url" => "sample19_popup_php.php",
											   "return" => "id",
											   "default" => "10",
											   "defaultview" => "SIVOM",
											   "winwidth" => "400",
											   "help" => "Appuyer sur le bouton pour choisir une valeur"
											 )
							);
    $f->frm_ObjetChampPopup("TEXTEPOPUP2",    array(   "label" => "Champ POPUP Obligatoire",
											   "attrib" => "U",
											   "width" => "250px",
											   "url" => "sample19_popup_php.php",
											   "return" => "value",
											   "winwidth" => "400",
											   "help" => "Appuyer sur le bouton pour choisir une valeur"
											 )
							);
    $f->frm_SautLignes(2);	

	
    $f->frm_ObjetEditeur("EDITEUR",    array( "label" => "Champ Editeur",
											   "width" => "400px",
											   "height" => "300px",
											   "default" => "Ceci est la <b>valeur par défaut</b> passé au <um>champ \"Editeur\"</um><br>Le contenu de ce champ est évidemment à sauvegarder dans un champ mémo"
											  )
						);



    $f->frm_SautLignes(1);			
    $f->frm_ObjetChampArbre("FEUILLE1",    array( "label" => "Arbre n°=1 (defaut=5)",
											   "attrib" => "",
											   "width" => "350px",
											   "height" => "150px",
											   "default" => "5",
											   "title" => "Mairie"
											   ),
											   $tableautree
										);
										
    $f->frm_SautLignes(1);			

    $f->frm_ObjetSortSelect("SORTSELECT",       array(
											    "label" => "Liste pré-triée en ordre inverse",
												"default" => "",
												"order" => "6,5,4,3,2,1",
												"rows" => "10",
												"help" => "Trier la liste",
												"width" => "200px"),
								  	          $tableauAtrier
											  );
											  
    $f->frm_ObjetMultiListe("MULTILISTE",       array(
											    "label" => "Liste à choix multiple",
											    "attrib" => "R",
												"default" => "2,3,4",
												"rows" => "10",
												"modeblock" => true,
												"modeblockrestore" => true,
												"modeblockmessage" => "Les blocs doivent être continus, l'ancienne sélection est restaurée",
												"mode" => "append",
												"toolbar" => "true",
												"help" => "Selectionner des lignes de la liste",
												"width" => "200px"),
								  	          $tableauAtrier
											  );
    $f->frm_SautLignes(1);	
	
    $f->frm_ObjetUploader("SELECTEUR",       array(
												"attrib" => "",
											    "label" => "Télécharger la ou les photos",
												"url" => "sample43_uploader_simple_called.php",
												"default" => "",
												"multifiles"    => true,
												"multifilesmax" => -1,
												"multisort"    => true,
												"prefix" => "",
												"size"   => "10",
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"preview" => true,
												"help" => "Télécharger un ou plusieurs fichiers",
												"width" => "200px")
								  	         
											  );

   $f->frm_ObjetUploader("MONO_UPLOADER",       array(
											    "label" => "Télécharger une photo",
												"url" => "sample43_uploader_simple_called.php",
												"default" => $nomfichier,
												"preview" => true,
												"attrib" => "",
												"overwrite" => true,
												"target" => '../../../rubappli/tmp/',
												"help" => "Télécharger un fichier",
												"width" => "200px")
								  	         
											  );											  											   							
	$f->frm_ChampEnErreur("BtnRad", "<h1>le nom contient des blancs</h1>");
	$f->frm_ChampEnErreur("Cocher2", "Doit etre coché");
	$f->frm_ChampEnErreur("SelectFichier", "doit contenir un nom de fichier");


	##########################################################################

    $ret = $f->frm_Aiguiller();
	switch ( $ret ) {
	
		case "A0" :
			$action = "APPEL A LA FENETRE EN AJOUT n°1";
			$f->frm_InitConfirm("Ajouter un Enregistrement ?");
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			break;

		case "A1" :
			$action = "APPEL A LA FENETRE EN AJOUT n°2 et +";
			$f->frm_InitConfirm("Ajouter un Enregistrement ?");
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			break;

		case "M0" :
			$action = "APPEL A LA FENETRE EN MODIFICATION n°1";
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			break;

		case "M1" :
			$action = "APPEL A LA FENETRE EN MODIFICATION n°2 et +";
			$f->frm_InitConfirmCancel("Rétablir les données avant la modification ?");
			break;

		case "MQ" :
			$action = "QUITTER MODIF ";
 		    header("Location: index.htm#ANNEXES");
			break;

		case "AQ" :
			$action = "QUITTER AJOUT ";
 		    header("Location: index.htm#ANNEXES");
			break;

		case "L0" :
			$f->frm_LibBoutons("Effacer","Annuler","");		
			$f->frm_InitConfirm("Effacer l'Enregistrement ?");
			$action = "LECTURE SEULE";
			break;			

		case "L1" :
			$f->frm_LibBoutons("Effacer","Sortir","");		
			$f->frm_InitConfirm("Effacer l'Enregistrement ?");
			$action = "LECTURE SEULE+";
			break;			
			
		case "LQ" :
			$action = "QUITTER VISU ($ret)";
 		    header("Location: index.htm#ANNEXES");
			break;
	}


?>
<html>
<head>
<title>sample18_touslesobjets.php - Exemple de tous les champs possibles</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
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
  <img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample17_sautlignes.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample19_popup.php"><img src="fleche.gif" width="16" height="16" border="0"></a> TOUS LES OBJETS DISPONIBLES </span></h4>
  <table width="830" border="0" cellspacing="0">
    <tr bgcolor="#000066">
      <td width="146">&nbsp;</td>
      <td width="572">&nbsp;</td>
      <td width="106">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#000066">&nbsp;</td>
      <td>    
<?php		
	print "<h1>$action</h1>";
	$f->frm_Ouvrir();
?>
</td>
      <td bgcolor="#CC6633">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#000066">&nbsp;</td>
      <td bgcolor="#CC6633">&nbsp;</td>
      <td bgcolor="#CC6633">&nbsp;</td>
    </tr>
  </table>
  <h4>  </h4>

<p><a href="sample18_touslesobjets.php<?php if (!$readonly) print "?RO"; ?>">voir la m&ecirc;me grille mais <?php if (!$readonly) print " en lecture seule"; else print " en mise à jour"; ?> </a></p>

<?php
	print "<br><br<\$_POST=<br></b>";
	print "<pre>";
	print_r($_POST);
	print "</pre>";

?>
</blockquote>
</body>
</html>
