<?php	

DEFINE('CLASSEFORMS_VERSION','version 1.21 du 10/10/2008');


require_once('_classePath.php');

// Chargement du code de couleur par défaut du site
require_once('_classeSkin.php');

// PARAMETRAGE :
// DEFINE('CHEMINRESSOURCES_CF',INCLUDEPATH.'classeForms/');
DEFINE('CHEMINRESSOURCES_CF',INCLUDEPATH.'classeForms/');

define('CF_LIBJS_2LISTESBASCULES','2listesbascule.js');
define('CF_LIBJS_LONGUELISTE',    'LongList-v7.js');
define('CF_LIBJS_FCKEDITOR',      'FCKeditor_2.6'); 
define('CF_LIBJS_UPLOADER',       'uploader_1.js'); 
define('CF_LIBJS_LISTESCASCADE',  'ListesCascades-v1.js'); 

// FONCTIONS DE LA CLASSE :
// frm_Init()
// frm_InitPalette()
// frm_InitConfirm()
// frm_InitConfirmCancel()
// frm_InitTimeOut()
// frm_InitFocus()
// frm_InitScroller()

// --- Fonction de bufferisation des sorties
// frm_initbuffer()
// frm_flushbuffer()

// --- Fonctions de définition des objets
// frm_ObjetChampTexte
// frm_ObjetChampMemo
// frm_ObjetEditeur
// frm_ObjetBoutonsRadio
// frm_ObjetListe
// frm_ObjetListeEditable
// frm_ObjetListeLongue
// frm_ObjetMultiListe
// frm_Objet2Listes
// frm_ObjetBascule
// frm_ObjetCoche
// frm_ObjetSlider
// frm_ObjetChampPopup
// frm_ObjetChampArbre
// frm_ObjetChampIcone
// frm_ObjetTimer
// frm_ObjetColorPicker

// frm_ObjetChampCache

// --- Fonctions de définition des onglets
// frm_OngletDefinir
// frm_OngletNouveau
// _frm_OngletOuvrir
// _frm_OngletFermer

// --- Fonctions de séparateurs
// frm_EnteteDefinir
// frm_EnteteOuvrir
// frm_EnteteFermer

// --- Fonctions de test de la grille
// frm_Aiguiller()

// --- Fonctions pour modifier l'etat d'un objet
// frm_ChampEnErreur()
// frm_ChampActif()
// frm_ChampLectureSeule()
// frm_ChargerLesChamps()
// frm_ChampInitialiserValeur()
// frm_ChampRecupererValeur() // recuperation de la valeeur par defaut qui va etre affichee
// frm_ChampsRecopier()
// frm_ChampDateActuelle()
// frm_ChampTimeStampActuel()
// frm_ActiverBtnValider()
// frm_LibBoutons()
// frm_SautLignes()

// frm_Ouvrir()
//     ou en mode manuel les fonctions ci dessous pour placer les objets dans la page HTML
// frm_Reentrant() : a utiliser avant ou apres Ouvrir() mais apres l'aiguillage
// frm_AfficheObjet()
// frm_AfficheBtnValider()
// frm_AfficheBtnAnnulerQuitter()
// frm_Fermer()
// frm_AvertirEtSortir()
// frm_Message()
// frm_TitreInit()
// frm_TitreAffiche()


DEFINE('OBJET_TEXTE',         0);
DEFINE('OBJET_MEMO',          1);
DEFINE('OBJET_RADIO',         2);
DEFINE('OBJET_LISTE',         3);
DEFINE('OBJET_2LISTES',       4);
DEFINE('OBJET_COCHE',         5);
DEFINE('OBJET_LISTELONGUE',   7);
DEFINE('OBJET_BASCULE',       8);
DEFINE('OBJET_EDITEUR',       9);
DEFINE('OBJET_LISTEDITABLE', 10);
DEFINE('OBJET_SLIDER',       11);
DEFINE('OBJET_POPUP',        12);
DEFINE('OBJET_TREE',         13);
DEFINE('OBJET_ICONE',        14);
DEFINE('OBJET_TIMER',        15);
DEFINE('OBJET_COLORPICKER',  16);
DEFINE('OBJET_SORTSELECT',   17);
DEFINE('OBJET_MULTILISTE',   18);
DEFINE('OBJET_UPLOADER',     19);
DEFINE('OBJET_LISTESCASCADE', 20);


class Forms
{
	var $frm_tableobjets;
	var $frm_tablemasks;
	var $frm_tablelignes;
	var $frm_tableerreurs;
	var $frm_tableonglets;
	var $frm_tableongletchamp;	// a chaque onglet correspond une 1er champ
	var $frm_tablechamponglet;  // a chaque champ correspond un onglet si il existe
	var $frm_tableongletsattributs;
	var $frm_nbreobjets;
    // COMPTEUR DE CODE, POUR N'ENVOYER LE CODE JAVASCRIPT QUE SI IL EST REQUIS
	var $mask_compteur;
	var $mask_upper;
	var $mask_numerique;
	var $mask_initial;
	var $mask_date;
	var $mask_datepicker;
	var $mask_complexe;
	var $cpt_help;
	var $cpt_champscaches;
	var $evenements_objets;
	var $objet_attrib;
	var $objet_mask;
	var $objet_help;	
	var $objet_erreur;
	var $objet_type;		
	var $objet_style;		// utilise par les 3 fonctions _frm_style _raz, _ajouter, _afficher
	var $objet_caseacocher;
	var $objet_listelongue;
	var $objet_listeeditable;
	var $objet_multiliste;
	var $objet_bascule;
	var $objet_editeur;
	var $objet_onglet;
	var $objet_icone;	
	var $objet_timer;	
	var $objet_timer_nom;	
	var $objet_colorpicker;	
	var $objet_sortselect;
	var $objet_uploader;
	var $objet_listescascades;
	
	var $objet_onglet_ouvert;
	var $objet_separateur;
	var $objet_separateur_ouvert;
	var $objet_en_cours;
	var $objet_readonly;
	var $ongletpardefaut;
	var $indiceongletpardefaut;
	var $objet_slider;
	var $objet_btnvalider_actif;
	var $onglet_en_cours;
	var $separateur_en_cours;
	var $champ_validation;
	var $checkform;
	var $modeautomatique;
	var $form_ouvert;
	var $form_actionencours = '';
	var $form_reentrant;
	var $form_confirm;
	var $nomduformulaire = "classformulaire";
	var $nomduchampclef  = "";
	var $valeurchampclef = "";
	var $quitterformulaire;
	var $exitcode = "";
	var $cpt_en_erreurs;
	var $btnlib_Valider;
	var $btnlib_Quitter;
	var $btnlib_Retablir;
	var $checkbox_valueoff;
	var $checkbox_valueon;

	// PARAMETRAGE DES SKINS
	var $taillepolice = "10";
	var $styleerreurborder       = "border:inset";

	// PALETTE DE COULEUR (INITIALISEE PAR LA FONCTION frm_InitPalette()
	var $couleurtitre;
	var $couleurchampnormal;
	var $couleurchampobligatoire;   
	var $couleurchamperreur;   

	var $formulaireenlectureseule = false;
	var $largeurlabel             = '100px';	// LARGEUR DE LA COLONNE LABEL
	var $largeuronglet            = '300px';

	var $objet_scroller           = false;
	var $scroller_auto            = true;
	var $scroller_x               = '';	        // LARGEUR DE LA ZONE DE SCROLL
	var $scroller_y               = '';	        // HAUTEUR DE LA ZONE DE SCROLL
	var $scroller_color           = '';	        // COULEUR DE LA ZONE DE SCROLL
	var $scroller_obj_open        = -1;	        // INDICE DU DERNIER OBJET EN DEHORS DE LA ZONE DE SCROLL
	var $scroller_obj_close       = -1;	        // INDICE DU DERNIER OBJET DANS LA ZONE DE SCROLL
	var $objet_scroller_open      = false;

	var $directoutput             = true;
	var $bufferout                = '';


	// PARAMETRE DES MESSAGES DE SORTIE
	var $form_msg     = '';
	var $form_msg_url = '';
	
		
	function frm_print( $sortie ) {
		if ($this->directoutput) {
			print $sortie ;
		} else {
			$this->bufferout .= $sortie;
		}
	}
	function frm_initbuffer() {
		$this->directoutput = false;
		$this->bufferout  = '';
	}
	function frm_flushbuffer() {
		$this->directoutput = true;
		return $this->bufferout;
	}

	
	function frm_Init($modelectureseule=false,$taillelabel="100px",$focusfirst=false)
	{
		$this->frm_typeobjet      = array();   // Type de chaque objet (0=texte, 1=nombre)
		$this->frm_tableobjets    = array();   // Tableau des noms de champ
		$this->frm_tableattributs = array();
		$this->frm_tablelignes    = array();
		$this->frm_tableerreurs   = array();

		$this->frm_tableonglets   = array();         // tableau des noms des onglets
		$this->frm_tableongletchamp       = array();    // tableau du 1er champ de chaque onglet
		$this->frm_tableongletsattributs  = array();    // tableau des paramètres de tous les onglets
		$this->frm_tablechamponglet		  = array();    // a chaque champ correspond un onglet si il existe

		$this->frm_tablesautdelignes	  = array();    // a chaque objet a le nbre de ligne a sauter avant

		$this->frm_tableseparateur        = array();    // comme pour les onglets on mémorise le libellé du séparateur
		$this->frm_tableseparateurchamp   = array();    // comme pour les onglets on mémorise le 1er champ de la zone separateur
		$this->frm_tableseparateurattributs = array();
		$this->frm_tablechampseparateur	  = array();    // a chaque champ correspond un séparateur  si il existe
		
		$this->frm_nbreobjets     = 0;
		$this->frm_skin			  = 0;
		$this->skin_name      = "";
		$this->objet_en_cours     = 0;
		// COMPTEUR DE CODE, POUR N'ENVOYER LE CODE JAVASCRIPT QUE SI IL EST REQUIS
		$this->mask_compteur      = 0;
		$this->mask_upper         = 0;
		$this->mask_numerique     = 0;
		$this->mask_initial       = 0;
		$this->mask_date          = 0;
		$this->mask_complexe      = 0;
		$this->mask_datepicker    = 0;
		$this->checkform          = 0;
		$this->cpt_help           = 0;
		$this->cpt_en_erreurs     = 0;      // variable positionnee pour compter le nombre d'appel a la fonction
		$this->cpt_champscaches   = 0;
		$this->objet_champtexte   = 0;
		$this->objet_attrib       = "";
	    $this->objet_mask         = "";
		$this->objet_help         = "";
		$this->objet_erreur       = "";    
		$this->objet_style        = "";   
		$this->objet_listelongue  = 0;
		$this->objet_listeeditable = 0;
		$this->objet_bascule      = 0;
		$this->objet_caseacocher  = 0;
		$this->objet_champradio   = 0;
		$this->objet_onglet       = 0;
		$this->objet_icone        = 0;
		$this->objet_timer        = 0;
		$this->objet_timer_nom    = "";
		$this->objet_separateur   = -1;
		$this->objet_onglet_ouvert    = false;
		$this->objet_separateur_ouvert = false;
		$this->objet_editeur      = 0;
		$this->objet_slider       = 0;
		$this->objetsautdeligne   = 0;
		$this->objet_popup        = 0;
		$this->objet_arbre        = 0;
		$this->objet_colorpicker  = 0;
		$this->objet_sortselect   = 0;
		$this->objet_multiliste   = 0;
		$this->objet_uploader     = 0;
		$this->objet_uploader_preview = 0;
		$this->objet_listescascades = 0;
		$this->timestamp_formulaire = time();
		

		$this->objet_btnvalider_actif = false;  // Par défaut le bouton sera toujours inactif jusqu'a ce qu'un champ soit activé
		$this->onglet_en_cours       = -1;
		$this->separateur_en_cours   = -1;
		$this->indiceongletpardefaut = -1;
		$this->ongletpardefaut    = "";
		$this->modeautomatique    = true;
		$this->form_ouvert        = false;
		$this->form_reentrant     = false;
		$this->form_confirm       = false;
		$this->form_cancel 		  = false;
		if ($focusfirst) {
			$this->form_focus 		  = 0;   // SI PRECISE ALORS ON SE POSITIONNE SUR LE 1ER CHAMP
		} else {
			$this->form_focus 		  = -1;  // NOM DU CHAMP A ACTIVER EN 1ER
		}
		$this->form_focus_and_select = false;
		
		
		$this->form_css = "form_css";            // nom de l'objet javascript qui centralise tous les styles

		$this->timeout_nomobj = $this->nomduformulaire. '_timeout';  // nom de l'objet javascript qui gere le timeout
		$this->timeout_url   = '';                 
		$this->timeout_tempo = -1;                 
		$this->timeout_idcounteur = '';                 

		$this->form_cancel_mess   = "";
		$this->form_confirm_mess  = "";
		$this->form_actionencours = "A0";

		// Titre automatique du formulaire
		$this->form_titre         = '';
		$this->form_titre_icone   = '';
		$this->form_titre_class   = '';
		$this->form_titre_masquer = false;  // si un message est defini alors le titre est masqué
		
		
		$this->nomduchampclef     = ""; // Variable initialisee par la fct Aiguillage
		$this->valeurchampclef    = ""; //idem variable vehiculee par le champ caché "$this->nomduchampclef"
		$this->quitterformulaire  = false;			
		$this->exitcode	          = ""; // positionné par Aiguillage()
		$this->formulaireenlectureseule = $modelectureseule;
		$this->largeurlabel       = $taillelabel;
		$this->masquerlabel       = false; // afficher ou non la colonne label (voir fonction frm_MasquerLabel() )
		
		// PAR DEFAUT LA LARGEUR DANS LES ONGLETS EST LA MEME QUE EN DEHORS
		$this->ongletspace        = $taillelabel;
		$this->btnlib_Valider     = "Valider";
		$this->btnlib_Quitter     = "Quitter";
		$this->btnlib_Retablir    = "Rétablir";

		/* ORDRE DE PRIORITE DES COULEURS DU THEME EST LE SUIVANT :
		   --------------------------------------------------------
		   
		   1) LA VARIABLE DE SESSION 'DEFAULT_SKIN'
		   2) LE COOKIE 'DEFAULT_SKIN'
		   3) LA FONCTION frm_InitPalette DEFINIE DANS LE CODE
		   4) LA CONSTANTE 'DEFAULT_SKIN' DANS _classeSkin.php
		   
		*/
		// SI UNE CONSTANTE EST DEFINIE POUR LE SKIN TOUT LE SITE EN PROFITE
		if ( isset($_SESSION['DEFAULT_SKIN']) )
			$this->frm_InitPalette($_SESSION['DEFAULT_SKIN']);
		elseif ( isset($_COOKIE['DEFAULT_SKIN']) ) 
			$this->frm_InitPalette($_COOKIE['DEFAULT_SKIN']);
		elseif ( defined('DEFAULT_SKIN') ) {
			$this->frm_InitPalette(DEFAULT_SKIN);
		} else {
			$this->frm_InitPalette();
		}
		$this->checkbox_valueoff = "0";
		$this->checkbox_valueon  = "1";
		// CETTE VARIABLE DOIT ETRE EFFACEE SYSTEMATIQUEMENT POUR NE PAS TRAINER
		unset($_SESSION['FCKEDITOR_USERFILESPATH']);
	}

	// MASQUER LA COLONNE LABEL DES CHAMPS (POUR GAGNER DE LA PLACE)
	function frm_MasquerLabel() {
		$this->masquerlabel = true;
		$taillelabel = '0px';
		$this->largeurlabel       = $taillelabel;
		$this->ongletspace        = $taillelabel;		
	}

	// INITIALISE UNE PALETTE PRE-DEFINIE
	function frm_InitPalette($numero=0) {
		$this->frm_skin = $numero;
		// DU + CLAIR AU + FONCE
		switch ($this->frm_skin) {
			// PALETTE BLEUE

			case 1:
				$this->couleurchampnormal      = "#D8EBFC";
				$this->couleurchampobligatoire = "#C7E1FC";   
				$this->couleurchamperreur      = "#9CCCF8"; 
				$this->couleurtitre            = "#146DB6";
				$this->couleurfond             = "#F7FBFF";
				$this->skin_name               = "blue";
				break;

			// PALETTE GRISE
			case 2:
				$this->couleurchampnormal      = "#F4F3EA";
				$this->couleurchampobligatoire = "#E2DFC7";   
				$this->couleurchamperreur      = "#D7D2B0"; 
				$this->couleurtitre            = "#333333";
				$this->couleurfond             = "#EFEDDE";
				$this->skin_name               = "grey";
				break;
				
			// PALETTE JAUNE
			case 3:
				$this->couleurchampnormal      = "#FFFFCC";
				$this->couleurchampobligatoire = "#FAF5A5";   
				$this->couleurchamperreur      = "#F7EF5E"; 
				$this->couleurtitre            = "#7C690E";
				$this->couleurfond             = "#FFFFEA";
				$this->skin_name               = "yellow";
				break;

			// PALETTE VERTE
			case 4:
				$this->couleurchampnormal      = "#DDFFE3";
				$this->couleurchampobligatoire = "#BFFFCB";   // #D2FFBF
				$this->couleurchamperreur      = "#77FF8E";  //#B5FF95
				$this->couleurtitre            = "#006600";
				$this->couleurfond             = "#F0FFF2";
				$this->skin_name               = "green";
				break;

			// PALETTE ORANGE
			case 5:
				$this->couleurchampnormal      = "#FFE1C4";
				$this->couleurchampobligatoire = "#FFD5AA";   
				$this->couleurchamperreur      = "#FFC58A"; 
				$this->couleurtitre            = "#400000";
				$this->couleurfond             = "#FFEAD5";
				$this->skin_name               = "orange";
				break;


			// PALETTE MAUVE
			case 6:
				$this->couleurchampnormal      = "#e7c3ff";
				$this->couleurchampobligatoire = "#dea9ff";   
				$this->couleurchamperreur      = "#d289ff"; 
				$this->couleurtitre            = "#070040";
				$this->couleurfond             = "#eed5ff";			
				$this->skin_name               = "purple";
				break;
				
			// PALETTE ROUGE PAR DEFAUT
			default:
				$this->couleurchampnormal      = "#F9EBE6";
				$this->couleurchampobligatoire = "#F5DED6";   
				$this->couleurchamperreur      = "#E9BDAD";   // UTILISE POUR LES CHAMPS EN ERREUR
				$this->couleurtitre            = "#9C0000";
				$this->couleurfond             = "#FDF5F4";
				$this->skin_name               = "red";
		}
	}

	// INITIALISE LE FAIT QUE LA VALIDATION DU FORMULAIRE DEVRA EST CONFIRMEE PAR BOITE DE DIALOGUE
	// AVEC UN MESSAGE STANDARD OU PERSONALISE
	function frm_InitConfirm($message_confirmation="") {
		$this->form_confirm = true;
		$this->form_confirm_mess = addslashes($message_confirmation);
	}
	
	// INITIALISE LE FAIT QUE LA VALIDATION DU FORMULAIRE DEVRA EST CONFIRMEE PAR BOITE DE DIALOGUE
	// AVEC UN MESSAGE STANDARD OU PERSONALISE
	function frm_InitFont($taillepolice="") {
			if (!empty($taillepolice)) $this->taillepolice = $taillepolice;
	}
	

	// QUAND ON APPUIE SUR LE BOUTON "RETABLIR" ON DEMANDE CONFIRMATION AVANT DE FAIRE .reset()
	// AVEC UN MESSAGE STANDARD OU PERSONALISE
	function frm_InitConfirmCancel($message_confirmation="") {
		$this->form_cancel = true;
		$this->form_cancel_mess = addslashes($message_confirmation);
	}	


	function frm_InitTimeOut($tempo,$url,$idcounter='') {
		$this->timeout_tempo = $tempo;                 
		$this->timeout_url   = $url;                 
		$this->timeout_idcounteur = $idcounter;     
	}	
	
	// INITIALISATION DU FOCUS SUR UN CHAMP PRECIS PAR DEFAUT LE 1ER
	function frm_InitFocus($indice_ou_nom=0,$toutselectionner=false) {	
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			$i = $indice_ou_nom;
			if ($i>$this->frm_nbreobjets ) 
				$this->frm_print( "\n<br>frm_InitFocus() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>" );

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);
			if ($i==-1) {
				$this->frm_print( "\n<br>frm_InitFocus()=$i : Le champ <b>\"$indice_ou_nom\"</b> n'est pas défini<br>" );
				return;
			}
		}
		$this->form_focus_and_select = $toutselectionner;
		$this->form_focus = $i;            
	}	


		
	// INITIALISATION DE LA TAILLE DE LA ZONE DE SCROLL
	function frm_InitScroller($tx="",$ty="",$couleurfond="",$modeauto=true) {
		if  ( !empty($tx) && !empty($ty) ) {
			$this->objet_scroller = true;
			$this->scroller_x = $tx;
			$this->scroller_y = $ty;			
			$this->scroller_color = (empty($couleurfond)) ? $this->couleurchampobligatoire : $couleurfond;
			$this->scroller_auto = $modeauto;
			$this->scroller_obj_open  = -1;
			$this->scroller_obj_close = -1;
		}		
	}
	// OUVERTURE D'UNE ZONE DE SCROLL
	function frm_ScrollerOpen() {
		$this->scroller_obj_open = count($this->frm_typeobjet);
	}

	// FERMETUREE D'UNE ZONE DE SCROLL
	function frm_ScrollerClose() {
		$this->scroller_obj_close = count($this->frm_typeobjet);
	}
	
	// MODIFIER L'INTITULES DES BOUTONS [ Valider ] - [ Quitter / Rétablir ]
	function frm_LibBoutons($libValider='',$libQuitter='',$libRetablir='')	 {
		$this->btnlib_Valider  = $libValider;
		if (!empty($libQuitter)) $this->btnlib_Quitter  = $libQuitter;	
		if (!empty($libRetablir)) $this->btnlib_Retablir = $libRetablir;
	}

	function frm_SautLignes($nlignesavant=1) {
		$this->objetsautdeligne = $nlignesavant;
	}

	// DEFINITION ET AFFICHAGE DU TITRE
	function frm_TitreInit($tabattributs=array()) {

		$this->form_titre         = '';
		$this->form_titre_icone   = '';
		$this->form_titre_class   = '';
		$this->form_titre_masquer = false;
				
		// le texte du message est le seul champ obligatoire
		if (!empty($tabattributs['text'])) {
			$this->form_titre = $tabattributs['text'];
		}		
		$this->form_titre_class = 'classeformstitle';
		if (!empty($tabattributs['class'])) {
			$this->form_titre_class = $tabattributs['class'];
		}
		if (isset($tabattributs['maskedifmessage'])) {
			$this->form_titre_masquer = $tabattributs['maskedifmessage'];
		}
		if (empty($tabattributs['icon'])) {
			$this->form_titre_icone = '';
		} else {
			$this->form_titre_icone = $tabattributs['icon'];
		}		
	}

	function frm_TitreAffiche() {
		// SI UN MESSAGE A ETE DEFINI ET QUE L'OPTION DE MASQUAGE EST ACTIVEE ON NE FAIT RIEN
		if ( $this->frm_IsMessage() && $this->form_titre_masquer ) return;
		if ( !empty($this->form_titre) ) {
			$this->frm_print( "\n<!-- Titre defini par la fonction frm_TitreInit() -->" );
			$this->frm_print( "\n<p>" );			
			if ( !empty($this->form_titre_icone) ) {
				$this->frm_print( "<img src=\"".$this->form_titre_icone."\" border=\"0\">&nbsp;" );
			}
			$this->frm_print( "<span class=\"".$this->form_titre_class."\">".$this->form_titre."</span>" );			
			$this->frm_print( "</p>" );			
		}
	}

	// DEFINITION ET AFFICHAGE DU MESSAGE DE SORTIE
	function frm_Message($tabattributs=array()) {
		// le texte du message est le seul champ obligatoire
		if (!empty($tabattributs['text'])) {
			$this->form_msg = $tabattributs['text'];
		}		
		$this->form_msg_class = '';
		if (!empty($tabattributs['class'])) {
			$this->form_msg_class = $tabattributs['class'];
		}		
		if (!empty($tabattributs['url'])) {
			$this->form_msg_url = $tabattributs['url'];
			$this->form_msg_target = '';
			if (!empty($tabattributs['target'])) {
				$this->form_msg_target = $tabattributs['target'];
			} else {		
				// LE TIMEOUT N'EST PRIS EN COMPTE QU'AVEC UNE URL DE BRANCHEMENT ET PAS DE TARGET
				if (!empty($tabattributs['timeout'])) {
					$this->form_msg_timeout = $tabattributs['timeout'];
				}
			}		
		}		
		if (empty($tabattributs['icon'])) {
			$this->form_msg_icon = '';
		} else {
			$this->form_msg_icon = $tabattributs['icon'];
		}		

	}

	// ON TESTE SI UN MESSAGE A ETE DEFINI
	function frm_IsMessage() {
		return !empty($this->form_msg);
	}
	

	function frm_message_out() {
		$this->frm_print( "\n<!-- Message envoye par la fonction frm_Message() -->" );
		if (!empty($this->form_msg_timeout)) {
			$this->timeout_url   = $this->form_msg_url;
			$this->timeout_tempo = $this->form_msg_timeout;
			$this->timeout_nomobj = 'objMessage';
			$this->js_timeout();
		}
		$this->timeout_url   = $this->form_msg_url;
		$this->frm_print( "\n<table width=\"80%\" border=\"0\"><tr><td width=\"40\" valign=\"top\">" );
		if (!empty($this->form_msg_icon)) {
			if (!ereg('^[/|.]',$this->form_msg_icon)) {
				if (!ereg('$.gif',$this->form_msg_icon)) {
					$this->form_msg_icon .= '.gif';		
				}
				$this->form_msg_icon = CHEMINRESSOURCES_CF.'message/'.$this->form_msg_icon;
			}
			if (!empty($this->form_msg_target)) {
				$target = ' target="'.$this->form_msg_target.'"';
			}
			if (!empty($this->form_msg_url)) {
				$this->frm_print( '<a href="'.$this->form_msg_url.'"'.$target.'>');
			}
			$this->frm_print( '<img src="'.$this->form_msg_icon.'" border="0">' );
			if (!empty($this->form_msg_url)) {
				$this->frm_print( '</a>' );
			}
			$this->frm_print( '</td>' );
		}
		if (empty($this->form_msg_class)) {
			$this->frm_print( '<td>' );			
		} else {
			$this->frm_print( '<td class="'.$this->form_msg_class.'">' );			
		}
		$this->frm_print( $this->form_msg );
		$this->frm_print( "\n</td></tr></table>\n" );
	}

	// GESTION DES ONGLETS ----------------------------------------------------------------

	// Definition de la taille de l'onglet (width, height)
	function frm_OngletDefinir($tabattributs=array()) 
	{
		$this->frm_tableongletsattributs = $tabattributs;
		if (!empty($this->frm_tableongletsattributs['default'])) {
			$this->ongletpardefaut = $this->frm_tableongletsattributs['default'];
		}		
		if (!empty($this->frm_tableongletsattributs['space'])) {
			$this->ongletspace = $this->frm_tableongletsattributs['space'];
		}		

	}
	
	function frm_OngletNouveau($titre) 
	{
		$this->objet_onglet++;
		$this->onglet_en_cours++;
		if ($this->ongletpardefaut==$titre) {
			$this->indiceongletpardefaut = $this->onglet_en_cours;
		}
		array_push($this->frm_tableonglets, $titre);
		array_push($this->frm_tableongletchamp , "");			
	}


	function frm_OngletDefaut($titre_indice_defaut) {
		if ($this->onglet_en_cours>-1) {
			if (is_string($titre_indice_defaut)) {
				$indice = 0;
				foreach ($this->frm_tableonglets as $nomonglet) {
					if ($nomonglet==$titre_indice_defaut) { $this->indiceongletpardefaut = $indice;	}
					$indice++;
				}
			} else {
				$this->indiceongletpardefaut = $titre_indice_defaut;
			}
		}
	}

	function _frm_OngletOuvrir() 
	{
		// AU 1ER ONGLET ON AFFICHE LA BALISE DE DEBUT 
		if ($this->onglet_en_cours==-1) {
				// if ($this->objet_en_cours>1) {
					$this->frm_print( "\n</table> <!-- Fermeture du tableau des 1ers champs --> <br>" );
		//		}
				if ($this->objet_separateur_ouvert) $this->frm_print( "<blockquote>" );
				
				$this->frm_print( "\n<!-- DEBUT DES ONGLETS --> \n" );
				$this->frm_print( "<div id=\"".$this->nomduformulaire."_ONGLETS\" class=\"tab-pane\"> \n");
				$this->frm_print( "<script type=\"text/javascript\"> \n" );
				$this->frm_print( $this->nomduformulaire."ONGLETS = new WebFXTabPane( document.getElementById( \"".$this->nomduformulaire."_ONGLETS\" ),false ); \n");
				$this->frm_print( "</script> \n" );
		}
		// ENSUITE CELLE DE L'ONGLET 
		$this->onglet_en_cours++;
		$this->objet_onglet_ouvert	= true;

		// SI TOUS LES ONGLETS DEFINIS ONT ETE AFFICHE
		if ($this->onglet_en_cours > $this->objet_onglet) return;

		// ON FERME L'ONGLET PRECEDENT
		if ($this->onglet_en_cours>0) {		
			$this->frm_print( "  </table> <!-- Fermeture de l'onglet precedant --> \n</div> \n\n" );
		}

		$nom_tab = $this->nomduformulaire."_ONGLET_".$this->onglet_en_cours;
		$this->frm_print( "\n<!-- DEBUT DE L'ONGLET \"".$this->frm_tableonglets[$this->onglet_en_cours]."\" -->" );

		$this->frm_print( "\n<div class=\"tab-page\" id=\"".$nom_tab."\"><h2 class=\"tab\">".$this->frm_tableonglets[$this->onglet_en_cours]."</h2>" );
		$this->frm_print( "\n  <script type=\"text/javascript\"> ".$this->nomduformulaire."ONGLETS.addTabPage( document.getElementById( \"".$nom_tab."\" ) );</script>\n" );

		$this->frm_print( '  <table border="0" cellspacing="0" width="100%">' );
	}

	function _frm_OngletFermer() {
		if ($this->onglet_en_cours>-1) {
				$this->objet_onglet_ouvert	= false;
				if ($this->modeautomatique) $this->frm_print( "  </table> <!-- Fermeture d'un onglet ouvert -->" );
				$this->frm_print( "\n</div> \n" );
				$this->frm_print( "\n</div> <!-- Fermeture d'un DIV - FIN DES ONGLET -->" );
				
				$this->frm_print( "\n<script type=\"text/javascript\"> " );
				$this->frm_print( "setupAllTabs(); " );
			
				if ($this->indiceongletpardefaut>-1) {
					// AFFICHAGE DE L'ONGLET PAR DEFAUT
					$this->frm_print( $this->nomduformulaire."ONGLETS.setSelectedIndex(".$this->indiceongletpardefaut."); " );
				}
				$this->frm_print( "</script> \n" );
				if ($this->objet_separateur_ouvert) $this->frm_print( "</blockquote>" );
				$this->onglet_en_cours=-1;
		}
	}

		
	// CHAQUE OBJET CHAMP FAIT APPEL A CETTE FONCTION AU MOMENT DE SA DECLARATION
	function _frm_Onglet_SauverChamp($nomchamp) {
		// si aucun onglet n'est défini on ne fait rien
		if ($this->onglet_en_cours==-1) return;
		// sinon on enregistre le nom du 1er champ
		if (empty($this->frm_tableongletchamp[$this->onglet_en_cours])) {
			$this->frm_tableongletchamp[$this->onglet_en_cours] = $nomchamp;
		}
	}	

	// CHAQUE OBJET CHAMP FAIT APPEL A CETTE FONCTION AU MOMENT DE SON AFFICHAGE (JUSTE AVANT)
	// POUR SAVOIR SI IL A UN ONGLET ASSOCIE (MODE AUTOMATQUE UNIQUEMENT)
	function _frm_OngletAssocie($nomchamp) {
		if ($this->modeautomatique) {
			$ret = array_search($nomchamp, $this->frm_tableongletchamp,true);
			if ( !is_bool($ret) ) $this->_frm_OngletOuvrir();
		}
	}	




	// DEBUT DU TRAITEMENT DES ENTETES ----------------------------------------------------------------



	// frm_EnteteDefinir
	function frm_EnteteDefinir($exclusif=false,$save=false) 
	{
		$this->frm_Entete_Save     = $save;
		$this->frm_Entete_Exclusif = $exclusif;
		$this->objet_separateur    = 0;

	}

	// frm_EnteteNouveau
	function frm_EnteteNouveau($libelle_entete, $expand=false) 
	{
		if($this->objet_separateur==-1) {
			$this->frm_EnteteDefinir();
		}
		$this->objet_separateur++;
		$this->separateur_en_cours++;
		
		array_push($this->frm_tableseparateur, $libelle_entete);
		array_push($this->frm_tableseparateurchamp , "");			
		array_push($this->frm_tableseparateurattributs , $expand);			
	}


	// frm_EnteteOuvrir
	function frm_EnteteOuvrir() 
	{
		if ($this->objet_en_cours>0 && $this->separateur_en_cours==-1) $this->frm_print( "\n</table> <!-- Fermeture du tableau avant le 1er separateur -->" );

		// AU 1ER SEPARATEUR ON AFFICHE LA BALISE DE DEBUT 
		$this->separateur_en_cours++;

		// SI TOUS LES SEPARATEURS DEFINIS ONT ETE AFFICHES
		if ($this->separateur_en_cours > $this->objet_separateur) return;


		// ON FERME L'ONGLET PRECEDENT
		if ($this->separateur_en_cours>0) {		
			$this->_frm_EnteteFermer();
		}

		$this->frm_print( "\n\n<!-- DEBUT DE SEPARATEUR \"".$this->frm_tableseparateur[$this->separateur_en_cours]."\"--> \n\n" );
		$this->frm_print( '<h3 class="titreheader" style="cursor:hand; cursor:pointer" onClick="expandcontent(\'separ_'.$this->separateur_en_cours.'\')"><img src="'.CHEMINRESSOURCES_CF.'foldout/arrow_down.gif"> ' );

		$this->frm_print( $this->frm_tableseparateur[$this->separateur_en_cours]."</h3>\n" );
		$this->frm_print( '<div id="separ_'.$this->separateur_en_cours.'" class="switchcontent"' );
		if ($this->frm_tableseparateurattributs[$this->separateur_en_cours])
			$this->frm_print( ' style="display:block;"' );
		$this->frm_print( ">\n" );
		$this->_frm_EnteteFermer();
		$this->frm_print( '<table border="0" cellspacing="0" width="100%">' );		


		$this->objet_separateur_ouvert = true;

	}
	// _frm_EnteteFermer
	function _frm_EnteteFermer() 
	{
		if ($this->objet_separateur_ouvert) {
		
			$this->frm_print( "\n</table> <!-- Fermeture du seperateur courant -->" );
			$this->frm_print( "\n</div> \n\n" );
			$this->objet_separateur_ouvert = false;
		}
	}

	// CHAQUE OBJET CHAMP FAIT APPEL A CETTE FONCTION AU MOMENT DE SA DECLARATION
	function _frm_Separateur_SauverChamp($nomchamp) {
		// si aucun separateur n'est défini on ne fait rien
		if ($this->separateur_en_cours==-1) return;
		// sinon on enregistre le nom du 1er champ du paragraphe
		if (empty($this->frm_tableseparateurchamp[$this->separateur_en_cours])) {
			$this->frm_tableseparateurchamp[$this->separateur_en_cours] = $nomchamp;
		}
	}	

	// CHAQUE OBJET CHAMP FAIT APPEL A CETTE FONCTION AU MOMENT DE SON AFFICHAGE (JUSTE AVANT)
	// POUR SAVOIR SI IL A UN SEPARATEUR ASSOCIE (MODE AUTOMATQUE UNIQUEMENT)
	function _frm_SeparateurAssocie($nomchamp) {
		if ($this->modeautomatique) {
			$ret = array_search($nomchamp, $this->frm_tableseparateurchamp,true);
			if ( !is_bool($ret) ) $this->frm_EnteteOuvrir(); 
		}
	}	



	// FIN DES ENTETES ----------------------------------------------------------------
	
	

	// Souligne en gras le label d'un champ spécifié et donne un message d'erreur
    function frm_ChampEnErreur($nomchamp, $messageerreur = "")
    {
		// LES ERREURS SONT IGNOREE EN CAS DE FORMULAIRE EN LECTURE SEULE
		if ($this->formulaireenlectureseule) return;
	    $nomchamp = strtoupper($nomchamp);
		$this->frm_tableerreurs[$nomchamp] = $messageerreur;
		if (!empty($messageerreur)) $this->cpt_help++;
		$this->cpt_en_erreurs++;
    }	

	// Désactiver une champ avant son affichage
    function frm_ChampActif($indice_ou_nom, $actif = true)
    {
		if (empty($indice_ou_nom)) return;
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			$i = $indice_ou_nom;
			if ($i>$this->frm_nbreobjets ) 
				$this->frm_print( "\n<br>frm_ChampActif() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>" );

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);
			if ($i==-1) {
				$this->frm_print( "\n<br>frm_ChampActif()=$i : Le champ <b>\"$indice_ou_nom\"</b> n'est pas défini<br>" );
				return;
			}
		}
		if ($actif) 
			// Pour réactiver un champ désactivé dans  sa valeur par défaut on supprime les - par des blancs
		   $this->frm_tableattributs[$i]['attrib'] = str_replace('-','',$this->frm_tableattributs[$i]['attrib']);
		else {
			if(isset($this->frm_tableattributs[$i]['attrib'])) 
				$this->frm_tableattributs[$i]['attrib'] .= '-';
			else
		   		$this->frm_tableattributs[$i]['attrib'] = '-';
		}

    }	

	// Désactiver une champ avant son affichage
    function frm_ChampLectureSeule($indice_ou_nom, $readonly = true)
    {
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			$i = $indice_ou_nom;
			if ($i>$this->frm_nbreobjets ) 
				$this->frm_print( "\n<br>frm_ChampLectureSeule() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>" );

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);
			if ($i==-1) {
				$this->frm_print( "\n<br>frm_ChampLectureSeule()=$i : Le champ <b>\"$indice_ou_nom\"</b> n'est pas défini<br>" );
				return;
			}
		}
		if ( isset($this->frm_tableattributs[$i]['attrib']) ) {
			if ($readonly) 
			   $this->frm_tableattributs[$i]['attrib'] .= '+';
			else
				// Pour réactiver un champ désactivé dans  sa valeur par défaut on supprime les - par des blancs
			   $this->frm_tableattributs[$i]['attrib'] = str_replace('+','',$this->frm_tableattributs[$i]['attrib']);
		} else {
		   $this->frm_tableattributs[$i]['attrib'] = '+';		
		}
    }	


	function frm_AfficheMessage() 
	{
		if ($this->cpt_en_erreurs>0) {
			$this->frm_print( "<span class=\"classeformslabelerreur\"><b>ATTENTION :</b><br>Les champs repérés indiquent des erreurs de cohérence<br>" );
			$this->frm_print( "Le formulaire ne sera enregistré que lorsqu'elles seront toutes corrigées.<span>" );
		}
	}

	function frm_ChampDateActuelle()
	{
		return date("d/m/Y",time());
	}
	
	function frm_ChampTimeStampActuel()
	{
		return date("d/m/Y H:i",time());
	}
	
	// initialiser tous les champs avec les valeurs du tableau 
	// a utiliser avec la fonction "bdd_resultats_vers_tableau()"
	function frm_ChargerLesChamps($tableau_bdd) {
		$nbrechampscharges = 0;
		if ( !is_array($tableau_bdd) ) return false;
		// CONVERTIR EN MAJUSCULE LES CHAMPS CLEF DE $tableau_bdd
		$tableauchamps = array_change_key_case($tableau_bdd, CASE_UPPER);
		// POUR TOUS LES CHAMPS DE LA GRILLE ON VA CHERCHER LE RESULTAT CORRESPONDANT
		for ($i=0;$i<$this->frm_nbreobjets;$i++) {
			$nomchamp = $this->frm_tableobjets[$i];
 			if (array_key_exists($nomchamp, $tableauchamps)) {
				// TRAITEMENT POUR LES CHAMPS TEXTE
				if ($this->frm_typeobjet[$i]==OBJET_TEXTE) {
					if ( isset($this->frm_tableattributs[$i]['attrib']) )
						$attrib = $this->frm_tableattributs[$i]['attrib'];
					else
						$attrib = "";
					$timestamp = !( strpos($attrib ,"T") === false );
					$date      = !( strpos($attrib ,"D") === false );
					$retour    = $tableauchamps[$nomchamp];
					// traitement spécial de la date et du timestamp
					if ($date || $timestamp) {
						$d = $tableauchamps[$nomchamp];
						if ( !empty($d) ) {
							$retour = substr($d,8,2)."/".substr($d,5,2)."/".substr($d,0,4);
							if($timestamp) {
								$retour = $retour . " " . substr($d,11,5);						
							}
						} else {
							$retour = "";
						}
					}
					$this->frm_tableattributs[$i]['default'] = $retour;		

				// TRAITEMENT PARTICULIER DE LA LISTE A TRIER C'EST L'ATTRIBUT 'order' QU'IL FAUT INITIALISER
				} elseif ($this->frm_typeobjet[$i]==OBJET_SORTSELECT) {
					$this->frm_tableattributs[$i]['order'] = $tableauchamps[$nomchamp];		
				} else {
					$this->frm_tableattributs[$i]['default'] = $tableauchamps[$nomchamp];		
				}
				$nbrechampscharges ++;
			}
		}
		return $nbrechampscharges;
	}
	
	// Initialiser la valeur par défaut d'un champ
	function frm_ChampInitialiserValeur($indice_ou_nom,$valeurpardefaut,$valeurpardefautvue="") {
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			$i = $indice_ou_nom;
			if ($i>$this->frm_nbreobjets ) 
				$this->frm_print( "\n<br>frm_ChampInitialiserValeur() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>" );

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);
			if ($i==-1) {
				$this->frm_print( "\n<br>frm_ChampInitialiserValeur()=$i : Le champ <b>\"$indice_ou_nom\"</b> n'est pas défini<br>" );
				return;
			}
		}
		$this->frm_tableattributs[$i]['default'] = $valeurpardefaut;
		if (!empty($valeurpardefautvue) &&($this->frm_typeobjet[$i]==OBJET_POPUP)) {
				$this->frm_tableattributs[$i]['defaultview'] = $valeurpardefautvue;
		}
	}

	// Fonction utilisateur pour recuperer la valeur par défaut d'un champ que l'on ne connait pas necessairement
	// quand la grille est iniitialisee globalement par la fonction $f->frm_ChargerLesChamps( $base->bdd_resultats_vers_tableau() );
	function frm_ChampRecupererValeur($indice_ou_nom) {
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			$i = $indice_ou_nom;
			if ($i>$this->frm_nbreobjets ) 
				$this->frm_print( "\n<br>frm_ChampRecupererValeur() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>" );

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);
			if ($i==-1) {
				$this->frm_print( "\n<br>frm_ChampRecupererValeur()=$i : Le champ <b>\"$indice_ou_nom\"</b> n'est pas défini<br>" );
				return;
			}
		}
		$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
		if (!empty($valeurpardefautvue) &&($this->frm_typeobjet[$i]==OBJET_POPUP)) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['defaultview'];
		}
		return $valeurpardefaut;
	}
	
	
	
	// Initialiser la valeur par défaut d'un champ
	function frm_ChampRetournerValeur($indice_ou_nom) {
		// INDICE OU NOM DU CHAMP
		if ( is_int($indice_ou_nom) ) {
			if ($indice_ou_nom>$this->frm_nbreobjets ) {
				$this->frm_print( "\n<br>frm_ChampRetournerValeur() : Le champ <b>n° $indice_ou_nom </b> n'est pas défini<br>");
				return;
			}

		} else {
			$i = $this->_frm_trouverindice($indice_ou_nom);		
			if (!$i) {
				$this->frm_print( "\n<br>frm_ChampRetournerValeur() : Le champ <b>\" $indice_ou_nom \"</b> n'est pas défini<br>" );
				return;
			}
		}
		if( isset($_POST[$this->frm_tableobjets[$i]])) {		
			return $_POST[$this->frm_tableobjets[$i]];
		} else
			return;
	}


	// Recopier tous les champs vers le formulaire réentrant (ne fait rien au 1er appel de la fonction)
	function frm_ChampsRecopier() {
		for ($indice=0;$indice<$this->frm_nbreobjets ;$indice++) {
			// BALAYAGE DE TOUS LES CHAMPS ET ON RECOPIE TOUS LES CHAMPS QUI ONT UNE VARIABLE "POST" CORRESPONDANTE
			if (isset($_POST[$this->frm_tableobjets[$indice]])) {
				$valeurrecuperee = $_POST[$this->frm_tableobjets[$indice]];
				$this->frm_tableattributs[$indice]['default'] = stripslashes($valeurrecuperee);
			}
		}
	}

	// Tester si le formulaire est nouveau ou réentrant
	// de plus si aucune clef n'est passe comme parametre ce formulaire ne pourra realiser que des ajouts
	// Retourne : M0, M1, A0, A1, AQ, MQ, L0, LQ
	// Mais aussi dans le cas de champs en attributs "S" (pour sortie) la valeur $this->ExitCode est initialisee
	function frm_Aiguiller($nomduchampclef = "") {
	    $this->nomduchampclef = strtoupper(trim($nomduchampclef));
		$ch1_hidden = $this->nomduformulaire."hidden";
		// test d'existance du champ qui mémorise la derniere action
		// premier lancement de la grille
		if ( isset($_POST[$ch1_hidden]) ) {
			// si il existe c'est que la grille e deja ete executee au moins une fois
			$this->form_reentrant = true;
			// EN LECTURE SEULE ON NE PEUT CEPENDANT QUE SORTIR
			if (false) {
				$this->exitcode = $_POST[$this->nomduformulaire."exitcode"];
				$this->form_actionencours = ($this->exitcode == "QUITTER") ? "LQ" : "L1"; 
				return $this->form_actionencours;
			}
			// le champ "hidden" est reconduit automatiquement
			$this->form_actionencours = substr($_POST[$ch1_hidden],0,1) . "1" ;
			if ( isset($_POST[$nomduchampclef]) ) $this->valeurchampclef   = $_POST[$nomduchampclef];
			// mais aussi le champ "exitcode" est initialise
			$this->exitcode = $_POST[$this->nomduformulaire."exitcode"];
			// si le bouton valider n'existe pas 2 possibilités :
			if ( !isset($_POST['ClassFormValider']) ) {
			    // ...c'est que le bouton "Quitter" a ete pressé dans ce cas ClassFormulaireExitCode='QUITTER'
				if ($this->exitcode == "QUITTER") {
					$this->form_actionencours = substr($_POST[$ch1_hidden],0,1) . "Q"; 
					$this->quitterformulaire  = true;
				} else {
					$this->form_actionencours = substr($_POST[$ch1_hidden],0,1) . "1"; 
				}
			}

		} else {
			$this->valeurchampclef = "";
			// EN LECTURE SEULE
			if ($this->formulaireenlectureseule) {
				$this->form_actionencours = "L0"; 
				if ( isset($_GET[$nomduchampclef]) ) {
					$this->valeurchampclef    = $_GET[$nomduchampclef];
				}
				return $this->form_actionencours;
			}		
			// si le champ "hidden" sauvegardant la valeur de la clef n'existe pas 
			// alors on va l'initialiser
			if ( isset($_GET[$nomduchampclef]) ) {
				$this->valeurchampclef    = $_GET[$nomduchampclef];
			} else {
				// si le parametre passé en minuscule
				$nomduchampclef = strtolower($nomduchampclef);
				if ( isset($_GET[$nomduchampclef]) ) {
					$this->valeurchampclef    = $_GET[$nomduchampclef];
				}
			}
			// si aucune clef n'est definie alors la modif devient un ajout
			if ( empty($this->valeurchampclef) ) {
				$this->form_actionencours = "A0";
				$this->valeurchampclef    = "";
			} else 
				$this->form_actionencours = "M0"; 
		}
		return $this->form_actionencours;
	}

	// CONNAITRE APRES L'AIGUILLAGE SI LE FORMULAIRE EST REENTRANT
    function frm_Reentrant() {
		return $this->form_reentrant;
	}
	// DEFINITIONS DES OBJETS "CHAMPS"
	
	// Creation d'un nouvel objet de type TEXTE
    function frm_ObjetChampTexte($nomchamp, $attributs)
    {
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_TEXTE);
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_champtexte++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	



    function frm_ObjetChampMemo($nomchamp, $attributs)
    {
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_MEMO);	 
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

    function frm_ObjetBoutonsRadio($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_RADIO);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_champradio++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

    function frm_ObjetListe($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_LISTE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

    function frm_ObjetListeLongue($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_LISTELONGUE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_listelongue++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	



    function frm_Objet2Listes($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_2LISTES);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

    function frm_ObjetBascule($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_BASCULE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_bascule++;
			$this->cpt_help++;
			$this->_ObjetsTroncCommun($nomchamp);		
		}
    }	

    function frm_ObjetCoche($nomchamp, $attributs)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_COCHE);	 
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_caseacocher++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	


	// Creation d'un nouvel objet de type CACHE (HIDDEN)
    function frm_ObjetChampCache($nomchamp, $valeur)
    {
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, 99);
			array_push($this->frm_tableobjets, $nomchamp);
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, array("default" => $valeur) );
			$this->frm_nbreobjets++;
			$this->cpt_champscaches++;
			// un champ cache n'appartient pas a un onglet
			array_push($this->frm_tablechamponglet, -1);
			// ni a un paragraphe
			array_push($this->frm_tablechampseparateur, -1);
			array_push($this->frm_tablesautdelignes, $this->objetsautdeligne);			
			$this->objetsautdeligne = 0;
		}
    }	

	// Creation d'un nouvel objet de type EDITEUR
    function frm_ObjetEditeur($nomchamp, $attributs)
    {
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_EDITEUR);
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_editeur++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

	// Creation d'un nouvel objet de type LISTE EDITABLE (Combo box)
    function frm_ObjetListeEditable($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_LISTEDITABLE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_listeeditable++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

	// Creation d'un nouvel objet de type SLIDER
    function frm_ObjetSlider($nomchamp, $attributs)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_SLIDER);
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_slider++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

	// Creation d'un nouvel objet de type TEXTE avec POPUP
    function frm_ObjetChampPopup($nomchamp, $attributs)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_POPUP);
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_popup++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }	

	// Creation d'un nouvel objet de type ARBRE
	function frm_ObjetChampArbre($nomchamp, $attributs, $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_TREE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_arbre++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }		
	
	// Creation d'un nouvel objet de type selecteur d'icones
	function frm_ObjetChampIcone($nomchamp, $attributs)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_ICONE);	 
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_icone++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }		

	// Creation d'un objet de type TIMER un seul par formulaire est autorisé
	function frm_ObjetTimer($nomchamp, $attributs=array())
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			if ($this->objet_timer==0) {
				array_push($this->frm_typeobjet, OBJET_TIMER);	 
				array_push($this->frm_tablelignes, "");
				array_push($this->frm_tableattributs, $attributs);
				$this->objet_timer++;
				$this->objet_timer_nom = $nomchamp;
				$this->_ObjetsTroncCommun($nomchamp);
			}
		}
    }		

	// Creation d'un objet de type COLORPICKER 
	function frm_ObjetColorPicker($nomchamp, $attributs=array())
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_COLORPICKER);	 
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_colorpicker++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }				

	// Creation d'un objet de type SORTLIST 
	function frm_ObjetSortSelect($nomchamp, $attributs=array(), $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_SORTSELECT);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_sortselect++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }				

	// Creation d'un objet de type SORTLIST 
	function frm_ObjetMultiListe($nomchamp, $attributs=array(), $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_MULTILISTE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_multiliste++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }				

	// Creation d'un objet de type UPLOADER 
	function frm_ObjetUploader($nomchamp, $attributs=array())
    {	
	    $nomchamp = strtoupper($nomchamp);

		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_UPLOADER);	 
			array_push($this->frm_tablelignes, "");
			array_push($this->frm_tableattributs, $attributs);
			if (isset($attributs['preview'])) {
				if ($attributs['preview']) $this->objet_uploader_preview++;
			}
			$this->objet_uploader++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }				

	// Creation d'un objet de type LISTES EN CASCADE (1..n) 
	function frm_ObjetListesCascade($nomchamp, $attributs=array(), $lignes)
    {	
	    $nomchamp = strtoupper($nomchamp);
		if ($this->_frm_testsidoublonnomchamp($nomchamp)) {
			array_push($this->frm_typeobjet, OBJET_LISTESCASCADE);	 
			array_push($this->frm_tablelignes, $lignes);
			array_push($this->frm_tableattributs, $attributs);
			$this->objet_listescascades++;
			$this->_ObjetsTroncCommun($nomchamp);
		}
    }			



	
	// APPELE PAR TOUS LES OBJETS SAUF LES CACHES
    function _ObjetsTroncCommun($nomchamp)
    {	
			array_push($this->frm_tableobjets, $nomchamp);
			$this->frm_nbreobjets++;
			$this->_frm_Onglet_SauverChamp($nomchamp);
			$this->_frm_Separateur_SauverChamp($nomchamp);
			array_push($this->frm_tablechamponglet, $this->objet_onglet-1);
			array_push($this->frm_tablechampseparateur, $this->objet_separateur-1);
			array_push($this->frm_tablesautdelignes, $this->objetsautdeligne);
			$this->objetsautdeligne = 0;
    }	


	################################ FIN DE L'ENREGISTREMENT DES OBJETS ############################


    function frm_Ouvrir($modeautomatique = true)
    {
		
		if ($this->quitterformulaire) return $this->_frm_grilleannulee();
		$this->form_ouvert         = true;
		$this->onglet_en_cours     = -1;
		$this->separateur_en_cours = -1;
		$this->modeautomatique     = $modeautomatique;
		// la touche "Valider" est toujours active
		// si  le formulaire est reentrant 
		// si la fonction frm_ActiverBtnValider() a ete appelle
		// si il existe au moins 1 SLIDER dans le formulaire
		$this->objet_btnvalider_actif = $this->form_reentrant || $this->objet_btnvalider_actif || $this->objet_slider>0;
		if   (!empty($this->btnlib_Valider) && ($this->formulaireenlectureseule))  $this->objet_btnvalider_actif = true;
		for ($i=0;$i<$this->frm_nbreobjets;$i++) {

		    // ANALYSE DES CHAMPS "ATTRIB" "MASK" "HELP" POUR DETERMINER LE CODE JAVASCRIPT A GENERER
			// MAIS AUSSI 
			if (!empty($this->frm_tableattributs[$i]['help'])) {
			    $this->cpt_help++; 
			}
			if (!empty($this->frm_tableattributs[$i]['attrib'])) {
			    $this->objet_attrib = strtoupper($this->frm_tableattributs[$i]['attrib']);
			}
			if (!empty($this->frm_tableattributs[$i]['mask'])) {
			    $this->objet_mask   = $this->frm_tableattributs[$i]['mask'];
			}



		    if ( !( strpos($this->objet_attrib,"R") === false )) { $this->checkform++; }
		    if ( !( strpos($this->objet_attrib,"U") === false )) { $this->checkform++;$this->mask_compteur++; $this->mask_upper++; }
		    if ( !( strpos($this->objet_attrib,"N") === false )) {$this->checkform++; $this->mask_compteur++; $this->mask_numerique++; }
		    if ( !( strpos($this->objet_attrib,"D") === false )) { $this->mask_compteur++; $this->mask_date++; $this->checkform++;}
		    if ( !( strpos($this->objet_attrib,"T") === false )) { $this->checkform++; $this->mask_datepicker++;}
		    if ( !( strpos($this->objet_attrib,"I") === false )) { $this->mask_compteur++; $this->mask_initial++; }
		    if ( !( strpos($this->objet_attrib,"H") === false )) { $this->mask_compteur++; $this->mask_complexe++; }
			if ( !( strpos($this->objet_attrib,"P") === false )) { $this->mask_datepicker++; }
			// "W" est un attribut de champ texte pour en faire une saisie "passWord"

		    if ( !empty($this->objet_mask)) { $this->mask_compteur++; $this->mask_complexe++; }

		}
        $this->js_init(); 
		$this->css_feuilledestyle_define();

		// SI UN TITRE A ETE DEFINI ON L'AFFICHE EN MODE AUTOMATIQUE
		if ( !empty($this->form_titre) && $modeautomatique)  {
			$this->frm_TitreAffiche();
		}
		if (!empty($this->form_msg)) {
			$this->css_feuilledestyle_show();
			$this->frm_message_out();
			return false;
		}

		// sauvegarde des valeurs des champs INPUT pour mieux les restaurer en cas de RESET du formulaire
		$this->js_champtexte();
		
		// ecriture du code javascript strictement nécessaire	
		if ($this->checkform >0 )        	$this->js_checkform();
		if ($this->mask_date > 0)        	$this->js_dateformat();
		if ($this->mask_datepicker>0 )   	$this->js_Calendar();
		if ($this->cpt_help > 0) 		 	$this->js_TipMessage(); 
	    if ($this->objet_caseacocher>0) {
											$this->js_changeBox();
											$this->js_ActiverDesactiverSurCoche();  
										}
		if ($this->objet_champradio>0)   	$this->js_ActiverDesactiverSurRadio();  
		
		if ($this->objet_listelongue>0)  	$this->js_ListeLongue();
		if ($this->objet_bascule>0)      	$this->js_Bascule();
		if ($this->objet_editeur>0)      	$this->js_Editeur();
		if ($this->objet_onglet>0)       	$this->js_TabPane();
		if ($this->mask_complexe > 0)    	$this->js_MaskEdit();
		if ($this->objet_listeeditable > 0)	$this->js_ComboBox();
		if ($this->objet_slider > 0)		$this->js_Slider_avant();
		// ATTENTION uploader doit etre devant popup ABSOLUMENT 
		if ($this->objet_uploader > 0)      $this->js_Uploader();
		// les fonctions POPUP sont utilisées par les icones et le selecteur de couleurs
		if ($this->objet_popup>0 || $this->objet_icone>0 || $this->objet_colorpicker || $this->objet_uploader>0)			
											$this->js_Popup();
		if ($this->objet_separateur > 0)    $this->js_Separateur();
		if ($this->objet_arbre > 0)         $this->js_Arbre();
		if ($this->objet_timer > 0)         $this->js_Timer();
		if ($this->objet_sortselect > 0)    $this->js_SortSelect();
		if ($this->objet_multiliste > 0)    $this->js_MultiListe();
		if ($this->objet_uploader_preview > 0)  $this->js_Uploader_preview();
		if ($this->objet_listescascades > 0)  $this->js_ListesCascade();


		// Fermeture du code JavaScript
		
		$this->frm_print( "\n<!-- FIN DU CODE JAVASCRIPT OPTIONNEL -->\n\n\n\n\n\n" );
		$this->css_feuilledestyle_show();

		$this->frm_print( "\n<!-- DEBUT DE DEFINITION DU FORMULAIRE -->\n" );
		$this->frm_print( "\n<!-- " );
		if ( defined(DEFAULT_SKIN) )
			$this->frm_print( "DEFAULT_SKIN = ".DEFAULT_SKIN );
		else
			$this->frm_print( "DEFAULT_SKIN n'a pas ete defini" );
		$this->frm_print( " -->\n" );

		$this->frm_print( "\n<form name=\"".$this->nomduformulaire."\" method=\"POST\" " );
		$this->frm_print( "action=\"\"\n      " );	


		// Retourner une chaine compatible avec la fonction "YY_checkform()"
		$this->frm_print( $this->_frm_controler_formulaire() );
		$this->frm_print( ">\n" );

		$this->frm_print( $this->_frm_afficherchampcache() );
		
		if ($this->cpt_champscaches>0) {
			$this->frm_print( "\n<!-- DEFINITION DES CHAMPS CACHES DU FORMULAIRE (".$this->cpt_champscaches.") -->\n" );
			for ($i=0;$i<$this->frm_nbreobjets;$i++) {
				// filtrage sur le type "99" des champs caches
				if ($this->frm_typeobjet[$i] == 99) {
					$this->frm_print( "\n\t<input name=\"" . $this->frm_tableobjets[$i]."\" type=\"hidden\" value=\"". htmlspecialchars($this->frm_tableattributs[$i]['default'])."\">" );
				}
			}
			$this->frm_print( "\n" );
		}

		if ($this->modeautomatique) {
			if ($this->objet_scroller && $this->scroller_auto) {
				$this->frm_print( "\n<!-- TEST A O $i -->\n" );
				$this->_frm_scroller_open();
				
			}
			$this->frm_print( "\n<!-- DEBUT DE DEFINITION AUTOMATIQUE DES CHAMPS DU FORMULAIRE -->\n\n" );

			// Ouverture du tableau en début de formulaire		
			$this->frm_print( '<table border="0" cellspacing="0" width="100%">' );

			// Traitement objet par objet ---------------------------------------------------
			for ($i=0;$i<$this->frm_nbreobjets;$i++) {
			
				if ($this->objet_scroller && !$this->scroller_auto) {

					// Si un scroller est defini en mode manuel et qu'il faut le fermer				
					if ($i==$this->scroller_obj_close && $this->scroller_obj_close<>-1) {
						$this->frm_print( "\n<!-- TEST F $i -->\n" );
						$this->frm_print( "\n</table>" );
						$this->_frm_scroller_close();
						$this->frm_print( "\n<table border=\"0\" cellspacing=\"0\">" );
					}
					
					// Si un scroller est defini en mode manuel et qu'il faut l'ouvrir
					if ($i==$this->scroller_obj_open && $this->scroller_obj_open<>-1) {
						$this->frm_print( "\n</table>" );
						$this->frm_print( "\n<!-- TEST O $i -->\n" );
						$this->_frm_scroller_open();
						$this->frm_print( "\n<table border=\"0\" cellspacing=\"0\">" );
					}					
				}
				
				// on ne traite que les champs NON CACHES
				if ($this->frm_typeobjet[$i] != 99) {
					$this->frm_AfficheObjet($i);
					$this->frm_print( "\n\t</td>\n    </tr>\n" );
				}



				$this->objet_en_cours++;
			} // FIN DE BOUCLE DES OBJETS ---------------------------------------------------

				
			// SI DES ONGLETS ONT ETE DEFINIS, ON LES FERME
			if ($this->objet_onglet>0)	{
				$this->_frm_OngletFermer();
			}
			// Ouverture du tableau pour placer les boutons VALIDER/Annuler
			if ($this->separateur_en_cours>0) {
				$this->_frm_EnteteFermer();
			} elseif ($this->objet_onglet==0) {
				$this->frm_print( "\n</table> <!-- Fermeture du tableau principal --> " );
			}

			// Fermeture su scroller automatique si ouvert
			if ($this->objet_scroller_open) {
				$this->_frm_scroller_close();
			}
			
			$this->frm_print( "\n<!-- BLOC BOUTONS -->\n" );

			if ($this->objet_onglet==0) {
				$this->frm_print( "\n<table border=\"0\" cellspacing=\"0\"><tr>" );
				$this->frm_print( "\n<td width=\"".$this->largeurlabel."\" nowrap>&nbsp;" );
			} else {
			  	// $this->frm_print( "\n<table width=\"".$this->largeuronglet."\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">" );
				$this->frm_print( '<table border="0" cellspacing="0" width="'.$this->largeuronglet.'">' );
			  	$this->frm_print( "\n<tr><td width=\"".$this->largeurlabel."\">&nbsp;</td><td width=\"*\">" );
			}
			if ($this->objet_separateur>0) {
				$this->frm_print( "<br><a href=# onCLick=\"expandall();\"><img src=\"".CHEMINRESSOURCES_CF."foldout/expand_all.gif\" border=\"0\"></a>&nbsp;" );
				$this->frm_print( "<a href=# onCLick=\"collapseall();\"><img src=\"".CHEMINRESSOURCES_CF."foldout/collapse_all.gif\" border=\"0\"></a>" );
			}

			if ($this->objet_onglet==0) {
				$this->frm_print( "</td><td nowrap>&nbsp;<br>" );
			}
			$this->frm_AfficheBtnValider();
			$this->frm_AfficheBtnAnnulerQuitter();

			if ($this->objet_onglet==0) {			
			    $this->frm_print( "\n</td></tr>\n</table> <!-- Fermeture du tableau des boutons -->\n" ); 
			} else {
			 //   $this->frm_print( "</div></td></tr></table>&nbsp; <!-- Fermeture du tableau des boutons apres un onglet -->" );
			}
			$this->frm_Fermer();
		} else {
			$this->frm_print( "\n<!-- DEBUT DE DEFINITION MANUELLE DES CHAMPS DU FORMULAIRE -->\n\n" );		
		}
		return true;
    }	


	function frm_AfficheObjet($indice_ou_nom) {
			if ($this->modeautomatique) {
			// EN MODE AUTOMATIQUE C'EST L'INDICE DE L'OBJET QUI EST UTILISE
				$i = $indice_ou_nom;
			} else {
			// EN MODE MANUEL LE PARAMETRE EST SOIT L'INDICE DE L'OBJET SOIT SON NOM
				if ( is_int($indice_ou_nom) ) {
					$i = $indice_ou_nom;
				} else {
					// DANS LE CAS DU NOM IL FAUT RETROUVER SON INDEX
					$indice_ou_nom = strtoupper($indice_ou_nom);
					$i = -1;
					for ($indice=0;$indice<$this->frm_nbreobjets ;$indice++) {
					    if ($this->frm_tableobjets[$indice] == $indice_ou_nom) $i = $indice;						
					}
					// si on ne trouve pas l'objet alors on ne fait rien
					if ($i == -1) {
						$this->frm_print( "\n<br>frm_AfficheObjet() : <s>Le champ \"$indice_ou_nom\" est introuvable !</s><br>" );
						return;
					}
				}
			}
			// INITIALISONS CES VARIABLES AU PROFIT DE TOUTES LES SOUS-FONCTIONS
			$this->objet_help   = "";
			$this->objet_attrib = "";
			$this->objet_mask   = "";
			$this->objet_style  = "";
			$this->objet_type   = "";

			if ($this->objet_separateur>0) 
				$this->_frm_SeparateurAssocie($this->frm_tableobjets[$i]);

			if ($this->objet_onglet>0) 
				$this->_frm_OngletAssocie($this->frm_tableobjets[$i]);

			// Impression de la colonne "Label" si le mode automatique a ete selectionne
			if($this->modeautomatique) {
				$this->_frm_objet_colonnelabel($i);
			}
		    $this->_frm_evenements_raz();
			$this->_frm_style_raz();
			
			if (!empty($this->frm_tableattributs[$i]['attrib'])) {
	 			$this->objet_attrib = strtoupper($this->frm_tableattributs[$i]['attrib']);
			}
			if (!empty($this->frm_tableattributs[$i]['mask'])) {
				$this->objet_mask   = $this->frm_tableattributs[$i]['mask'];
			}
			if (!empty($this->frm_tableattributs[$i]['help'])) {
				$this->objet_help   = strtoupper($this->frm_tableattributs[$i]['help']);
			}
			// INDIQUE SI L'OBJET EST EN ERREUR
			if (!empty($this->frm_tableerreurs[$this->frm_tableobjets[$i]])) {
				$this->objet_help   = $this->frm_tableerreurs[$this->frm_tableobjets[$i]];
				$this->frm_print( "\n\n\t<!-- LE CHAMP SUIVANT A ETE POSITIONNE \"EN ERREUR\" PAR LA FONCTION frm_ChampEnErreur() -->" );
			}
			
			$this->objet_type = $this->frm_typeobjet[$i];
			
			// ANALYSE SI L'OBJET EST EN LECTURE SEULE OU TOUTE LA GRILLE
			$this->objet_readonly = $this->formulaireenlectureseule;
			if (!empty($this->objet_attrib)) {
				$this->objet_readonly =  !( strpos($this->objet_attrib,"+") === false ) || $this->objet_readonly;
			}			
			
			if($this->modeautomatique) { 
				$this->frm_print( "<p>" );
				$this->_frm_sautligne($i);
			}

			switch ($this->objet_type) {

   				case OBJET_TEXTE:
        			$this->TraiteChampTexte($i);
        			break;
   				case OBJET_MEMO:
        			$this->TraiteChampMemo($i);
        			break;
   				case OBJET_RADIO:
        			$this->TraiteBoutonsRadio($i);
        			break;
   				case OBJET_LISTE:
        			$this->TraiteListe($i);
        			break;
   				case OBJET_2LISTES:
        			$this->Traite2Listes($i);
        			break;
   				case OBJET_COCHE:
        			$this->TraiteCoche($i);
        			break;
   				case OBJET_LISTELONGUE:
        			$this->TraiteListeLongue($i);
        			break;
   				case OBJET_BASCULE:
        			$this->TraiteBascule($i);
        			break;
   				case OBJET_EDITEUR:
        			$this->TraiteEditeur($i);
        			break;
   				case OBJET_LISTEDITABLE:
        			$this->TraiteListeEditable($i);
        			break;
   				case OBJET_SLIDER:
        			$this->TraiteSlider($i);
        			break;
   				case OBJET_POPUP:
        			$this->TraiteChampPopup($i);
        			break;
   				case OBJET_TREE:
        			$this->TraiteChampArbre($i);
        			break;
   				case OBJET_ICONE:
        			$this->TraiteChampIcone($i);
        			break;
   				case OBJET_TIMER:
        			$this->TraiteTimer($i);
        			break;
   				case OBJET_COLORPICKER:
        			$this->TraiteColorPicker($i);
        			break;
   				case OBJET_SORTSELECT:
        			$this->TraiteSortSelect($i);
        			break;
				case OBJET_MULTILISTE:
        			$this->TraiteMultiListe($i);
        			break;
				case OBJET_UPLOADER:
        			$this->TraiteUploader($i);
        			break;
				case OBJET_LISTESCASCADE:
        			$this->TraiteListesCascade($i);
        			break;
					


			} // fin de switch
			$this->_frm_fieldisdisabled($i);

			if($this->modeautomatique) $this->frm_print( "\t</p>" );

	}


	function frm_AfficheBtnValider() {

		if  (!empty($this->btnlib_Valider)) {
			$this->frm_print( "\n" );
			$this->frm_print( '<input name="ClassFormValider" type="submit" class="classeformsbouton" id="ClassFormValider" style="width:100px" value="'.$this->btnlib_Valider.'" ' );
			// SI IL EXISTE QU'UN SEUL CHAMP ON NE DESACTIVE PAS LE BOUTON VALIDER
			if ( ($this->frm_nbreobjets>1)  && (!$this->objet_btnvalider_actif)) $this->frm_print( 'disabled="true"' );
			// si au moins un objet editeur existe alors
			if ($this->objet_editeur>0)	$this->frm_print( "onClick=\"dhtmlEditorPrepareSubmit()\"" );

			$this->frm_print( ' >' );
		}
	}
	
	
	function frm_ActiverBtnValider($boutonvalideractif = true) {
		$this->objet_btnvalider_actif = $boutonvalideractif;
	}

	function frm_AfficheBtnAnnulerQuitter() {
	    $this->frm_print( "\n" );
		$this->frm_print( '<input name="ClassFormAnnulerQuitter" type="button" class="classeformsbouton" id="ClassFormAnnulerQuitter" onClick="' );
		// SI LE BOUTON VALIDER DOIT RESTER ACTIF ALORS ON SAUTE LA LIGNE SUIVANTE
		if (!$this->objet_btnvalider_actif) {
			$this->frm_print( 'tmt_disableField(\'ClassFormValider\',1);' );
		}
		$this->frm_print( 'Resetousubmit();' );
		// if (!$this->objet_btnvalider_actif) 
		// $this->frm_print( 'PasserEtatQuitter()' );
		$this->frm_print( '"  style="width:' );
		if (empty($this->btnlib_Valider)) $this->frm_print( "200px" ); else $this->frm_print( "100px" );
		$this->frm_print( '" value="'.$this->btnlib_Quitter.'"' );
		$this->frm_print( " >" );

		// DANS LE CAS D'UN ONGLET ON FERME LE TABLEAU
		if ($this->objet_onglet>0) {
			$this->frm_print( "\n</td></tr>\n</table> <!-- Fermeture apres un onglet -->" );
		}

		// DEFINITION DU TIMEOUT SI EXISTANT
		if ($this->timeout_tempo>0)	{
			$this->js_timeout();
		}
               

				
	}

	function frm_Fermer() {
		// POUR QUE LA FERMETURE NE S'EXECUTE QU'UNE FOIS
		if (!($this->form_ouvert) ) return;
	    $this->form_ouvert  = true;
		if ($this->form_focus!=-1) {
			$this->frm_print( "\n<!-- FOCUS SUR LE CHAMP : ".$this->form_focus." -->" );
			$this->frm_print( "\n<script type=\"text/javascript\">" );
			// pointons le 1er champ de l'objet
			$libJS = ($this->form_focus_and_select) ? 'true' : 'false';
			$this->frm_print( "\n\tNM_focusfirstfield('".$this->_frm_premierdelobjet($this->frm_tableobjets[$this->form_focus])."',".$libJS.");" );
			$this->frm_print( "\n</script>" );
		}

		if ($this->modeautomatique) {
			$this->frm_print( "\n<!-- FIN DE DEFINITION AUTOMATIQUE DES CHAMPS DU FORMULAIRE -->\n\n\n" );
		} else {
			$this->frm_print( "\n<!-- FIN DE DEFINITION MANUELLE DES CHAMPS DU FORMULAIRE -->\n\n\n" );
		}					
		$this->frm_print( "\n</form>" );
		if ($this->objet_slider > 0) $this->js_Slider_apres();

	}

	################################################################################################
	#                         F O N C T I O N S      P R I V E E S	
	################################################################################################


	function _frm_controler_formulaire() {

		$chaineretour  = "";
		if  ($this->formulaireenlectureseule) {
			// CREATION DE LA CHAINE DE RETOUR AUCUN CONTROLE SUR LES CHAMPS
		
			$chaineretour = "onSubmit=\"document.MM_returnValue=true;MM_setTextOfTextfield('".$this->nomduformulaire."exitcode','','VALIDER');";
			// SI UN MESSAGE EST DEFINI PAR LA FONCTION $f->frm_InitConfirm()
			if (!empty($this->form_confirm_mess)) {
				$chaineretour .= "tmt_confirm('".$this->form_confirm_mess."');";
			}
			
			$chaineretour .= "if (document.MM_returnValue) {tmt_disableField('ClassFormValider',1);tmt_disableField('ClassFormAnnulerQuitter',1);} return document.MM_returnValue\" ";
			return $chaineretour;
		}

		// Traitement objet par objet
		for ($i=0;$i<$this->frm_nbreobjets;$i++) {
		    $mask = "";
			$attribut = "";
			if (  isset($this->frm_tableattributs[$i]['attrib']) )
				$attribut = $this->frm_tableattributs[$i]['attrib'];
			if (!empty($attribut)) {
				// Tous les objets en lecture seule sont ignores
			    if( !( strpos($attribut,"+") === false )) {
					continue;
			    }
				$finmessage = "n\'est pas valide";
				$nomduchamp = "";
				$interval   = "";


				// SI LE CHAMP APPARTIENT A UN ONGLET ON PRECIDE LEQUEL
				if ($this->frm_tablechamponglet[$i]>-1) {					
					$nomduchamp = "[ " .$this->frm_tableonglets[$this->frm_tablechamponglet[$i]] . " ]    ";
				}
 
			    if ( !empty($this->frm_tableattributs[$i]['label']) ) {
				  	$nomduchamp = $nomduchamp  . "( " . strip_tags($this->frm_tableattributs[$i]['label']) ." )";
				} else {
					$nomduchamp = $nomduchamp  . "{ " . $this->frm_tableobjets[$i] . " }";
				}
	 			$attribut = strtoupper($this->frm_tableattributs[$i]['attrib']);
				if (!empty($this->frm_tableattributs[$i]['mask'])) {
					$mask     = $this->frm_tableattributs[$i]['mask'];
				}
				if (!empty($this->frm_tableattributs[$i]['inter'])) {
					$interval     = $this->frm_tableattributs[$i]['inter'];
				}
				
				// analyse de l'attribut initial pour le transformer en attribut compatible YY_checkform()
				$attrib_YY_1 = "";
				$attrib_YY_2 = "";
				switch ($this->frm_typeobjet[$i]) {
				
				case OBJET_TEXTE: 				
				case OBJET_POPUP: 				
				   // TRAITEMENT DU CHAMP TEXTE
			    	if ( !( strpos($attribut,"R") === false )) $attrib_YY_1  .="#";
				    if ( !( strpos($attribut,"U") === false )) { $attrib_YY_1  .="q"; $attrib_YY_2 = "0"; } 
					elseif ( !( strpos($attribut,"I") === false )) { $attrib_YY_1  .="q";   $attrib_YY_2 = "0"; }
					elseif ( !( strpos($attribut,"L") === false )) { $attrib_YY_1  .="q";	$attrib_YY_2 = "0"; }			
					elseif ( !( strpos($attribut,"M") === false )) { $attrib_YY_1  .="S";	$attrib_YY_2 = "2";  $finmessage = "doit être au format email : \'nomdestinataire@nomdomaine.xxx\'"; }
					elseif ( !( strpos($attribut,"D") === false )) { $attrib_YY_1  .="^\\([0-9][0-9]\\)\\/\\([0-9][0-9]\\)\\/\\([0-9]{4}\\)$#1#2#3";	$attrib_YY_2 = "3";  $finmessage = "date au format JJ/MM/AAAA"; }
					elseif ( !( strpos($attribut,"H") === false )) { $attrib_YY_1  .="^\\(0[0-9]|1[0-9]|2[0-3]\\)\\:\\([0-5][0-9]\\)$";	                $attrib_YY_2 = "4";  $finmessage = "L\' heure doit être dans l\'intervalle [00:00-23:59]"; }
					elseif ( !( strpos($attribut,"N") === false )) {
						if ( !( strpos($interval,"_") === false ))     {$attrib_YY_1  .= $interval;	$attrib_YY_2 = "1";  $finmessage = "doit être dans l\'intervalle : [ ".str_replace("_","..",$interval)." ]"; }
					}
					break;

				case OBJET_ICONE: 				
				   if( !( strpos($attribut,"R") === false )) {
					    $attrib_YY_1  = "#";	
						$attrib_YY_2  = ""; 
						$finmessage = "une image doit être choisie dans la liste";
				   }
   				   break;
									
				case OBJET_MEMO:
				   // TRAITEMENT DU CHAMP MEMO
				   if( !( strpos($attribut,"R") === false )) {
					    $attrib_YY_1  = "1";	
						$attrib_YY_2  = "1"; 
						$finmessage = "ne doit pas être vide";
				   }
				   if (!empty($mask)) {
					   if ( is_integer( (integer) $mask) ) {
						    $attrib_YY_1  = $mask;	
							$attrib_YY_2  = "1"; 
							$finmessage = "doit contenir au moins $mask caractère(s)";
					   }
				   }
   				   break;

				case OBJET_LISTE:
				case OBJET_2LISTES:
				   // TRAITEMENT D'UNE LISTE NORMALE
				   $obligatoire = false;
				   if( !( strpos($attribut,"R") === false )) {
				   		if (!empty($this->frm_tableattributs[$i]['rows'])) {
							$obligatoire = ($this->frm_tableattributs[$i]['rows']==1);
						} else
						{
							$obligatoire = true;
						}
				   }
				   if ($obligatoire) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "1"; 
						$finmessage = "une valeur de cette liste doit être sélectionnée";				   
				 	}
					break;


				case OBJET_LISTELONGUE:
				   // TRAITEMENT DU MIXTE TEXTE / LISTE
				   $obligatoire = false;
				   if( !( strpos($attribut,"R") === false )) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "0"; 
						$finmessage = "une valeur de cette liste doit être sélectionnée";				   
				 	}
					break;
				case OBJET_LISTESCASCADE:
				   // TRAITEMENT DU MIXTE TEXTE / LISTE
				   $obligatoire = false;
				   if( !( strpos($attribut,"R") === false )) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "0"; 
				   		if ($this->frm_tableattributs[$i]['multilevel']) {						
							$finmessage = "une valeur d\'une des listes doit être obligatoirement sélectionnée";
						} else {
							$finmessage = "une valeur de la dernière liste doit être obligatoirement sélectionnée";				   
						}
				 	}
					break;

				case OBJET_TREE: 				
				   // TRAITEMENT DU CHAMP ARBRE
			    	if ( !( strpos($attribut,"R") === false )) $attrib_YY_1  .="#";
					$attrib_YY_1  .="q";
					$attrib_YY_2  = "0";
					$finmessage = "un élément de l\'arbre doit être sélectionné";
					break;
				


				case OBJET_BASCULE:			
				   // TRAITEMENT DE 2 LISTES EN BASCULE
					if( !( strpos($attribut,"R") === false )) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "0"; 
						$finmessage = "au moins une valeur de la liste doit être sélectionnée";  
					}
					break;

				case OBJET_MULTILISTE:			
				   // TRAITEMENT DE LA LISTES A CHOIX MULTIPLE
					if( !( strpos($attribut,"R") === false )) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "0"; 
						$finmessage = "au moins une valeur de la liste doit être sélectionnée";  
					}
					break;
					
				case OBJET_LISTEDITABLE:			
				   // TRAITEMENT DE LA LISTE EDITABLE
			    	if ( !( strpos($attribut,"R") === false )) $attrib_YY_1  .="#";
				    if ( !( strpos($attribut,"U") === false )) { $attrib_YY_1  .="q"; $attrib_YY_2 = "0"; } 
					elseif ( !( strpos($attribut,"I") === false )) { $attrib_YY_1  .="q";   $attrib_YY_2 = "0"; }
					break;					


				case OBJET_UPLOADER:			
				   // TRAITEMENT DU CHAMP DE TELECHARGEMENT DE FICHIER
					if( !( strpos($attribut,"R") === false )) {
				    	$attrib_YY_1  = "#q";	
						$attrib_YY_2  = "0"; 
						$finmessage = "au moins un fichier doit être sélectionné";  
					}
					break;
					

				} //Fin de Switch/Case qui determine l'expression du masque

				// ON VA DETERMINER MAINTENANT LE NOM DU CHAMP A CONTROLER
				switch ($this->frm_typeobjet[$i]) {

				case OBJET_LISTEDITABLE :
					// DANS LE CAS DU CHAMP "Liste Editable" ON CONTROLE LE CHAMP_EDIT
					$champatester = $this->frm_tableobjets[$i]."_EDIT";
					break;
				case OBJET_POPUP :
					// DANS LE CAS DES POPUP ON TEST SOIT LE CHAMP "X" SOIT LE CHAMP "X_VIEW"
					$id_en_retour = true;
					if ( !empty($this->frm_tableattributs[$i]['return'])) {
						$id_en_retour = !($this->frm_tableattributs[$i]['return']=='value');
					} 
					if ($id_en_retour) {
						$champatester = $this->frm_tableobjets[$i]."_VIEW";
					} else {
						$champatester = $this->frm_tableobjets[$i];
					}
					break;
					
				default :
				// DANS TOUS LES AUTRES CAS LE CHAMP A TESTER EST LE CHAMP "NOMME"
					$champatester = $this->frm_tableobjets[$i];
					break;
				}
				
				// ON RETOURNE LA CHAINE QUE SI LES ATTRIBUTS ONT ETE INITIALISES
				if ( !(empty($attrib_YY_1)) || !(empty($attrib_YY_2)) ) {
					$chaineretour .= ",'".$champatester."','".$attrib_YY_1."','".$attrib_YY_2."','".addslashes($nomduchamp)." ". $finmessage ."'";	
				}
			}
		}

		$chainetotaleretour = "onSubmit=\"document.MM_returnValue=true;MM_setTextOfTextfield('".$this->nomduformulaire."exitcode','','VALIDER');";
		// CREATION DE LA CHAINE DE CONTROLE DE VALIDATION DU FORMULAIRE
		if ( !empty($chaineretour) ) {
			$chainetotaleretour .= $this->objcheckform.".checkform('classformulaire'" . $chaineretour .");";
		}
		if ($this->form_confirm) {
			if ( empty($this->form_confirm_mess) ) {
				$action = substr( $this->form_actionencours,0,1);
				switch ($action) {
					case "A": 
						$message = "Ajouter ce nouvel enregistrement ?";
						break;
					default:
						$message = "Enregistrer la modification ?";
						break;
				}
			} else {
				$message = $this->form_confirm_mess;
			}
			$chainetotaleretour .= "tmt_confirm('".$message."');";
		}
		$chainetotaleretour .= "if (document.MM_returnValue) {EtatVerrouillerFormulaire=true;tmt_disableField('ClassFormValider',1);tmt_disableField('ClassFormAnnulerQuitter',1); } return document.MM_returnValue\" ";
		return $chainetotaleretour;
	}



	
	###############
	# CHAMP TEXTE #
	###############
    function TraiteChampTexte($i) {
		$this->frm_print( "\n\n\t<!-- CHAMP TEXTE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" mask=\"$this->objet_mask\" -->\n\n" );
	    $this->frm_print( "\t<input id=\"". $this->frm_tableobjets[$i] ."\" name=\"" . $this->frm_tableobjets[$i] . "\" " );
		// SI L'ATTRIBUT EST "W" LE CHAMP TEXTE DEVIENT UN CHAMP "PASSWORD"
   		if ( !( strpos($this->objet_attrib,"W") === false )) {
			$this->frm_print( "type=\"password\" " );
		} else {
			$this->frm_print( "type=\"text\" " );
		}
		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_affichesize($i);
		$this->_frm_affichemaxlength($i);
		$this->_frm_affichenumerique($i);
		$this->_frm_affichedate($i);
		$this->_frm_affichetimestamp($i);
		$this->_frm_afficheheure($i);  // L'HEURE DOIT PRECEDER LE MASQUE
		$this->_frm_affichemasque($i);
		$this->_frm_definitstyletransform($i);
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_desactivation() );
		
		// ENTER passe au champ suivant au lieu de valider le formulaire
		$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 
		// ajout s'il existe un script a l'evenement "onBlur"
		$this->_frm_callscript($i);
		
		// Effacer les blancs en tete et les blancs multiples
		$this->_frm_evenements_ajouter("onBlur"    , "alltrim('" .$this->frm_tableobjets[$i] ."')", 1);
		if ( !( strpos($this->objet_attrib,"B") === false )) 
			$this->_frm_evenements_ajouter("onBlur"    , "pasdeblanc('" .$this->frm_tableobjets[$i] ."')", 0);		
		$this->frm_print( $this->_frm_afficheclasse($i) );
		
		$this->_frm_change_etat_boutons();
		$this->_frm_submit($i);
		// Retour du style
		$this->frm_print( $this->_frm_style_afficher() );
		// Retour de tous les événements de l'objet		
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print(  ">\n" );
		$this->_frm_affichedefaut($i);
		
		$this->_frm_affichedatepicker($i);

	}



	##############
	# CHAMP MEMO #
	##############
    function TraiteChampMemo($i) {
		$this->frm_print( "\n\n\t<!-- CHAMP MEMO (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
	    $this->frm_print( "\t<textarea id=\"". $this->frm_tableobjets[$i]  . "\" name=\"" . $this->frm_tableobjets[$i] . "\""  );

		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_afficherows($i);
		$this->_frm_definitstylewidth($i);
		$this->_frm_affichemaxlength($i);
		$this->_frm_affichenumerique($i);
		$this->frm_print( $this->_frm_afficheclasse($i) );
		$this->frm_print( $this->_frm_desactivation() );
		$this->_frm_change_etat_boutons();
		$this->_frm_definitstyletransform($i);
		
		// Effacer les blancs en tete
		$this->_frm_evenements_ajouter("onBlur"    , "trim('" .$this->frm_tableobjets[$i] ."')", 1);
		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() . ">" );
		// NE SURTOUT DEPLACER LA LIGNE CI DESSOUS
 	    $this->_frm_affichedefaut($i);
		// ---------------------------------------
		$this->frm_print( "</textarea>\n" );
	}


	#######################
	# CHAMP BOUTONS RADIO #
	#######################
    function TraiteBoutonsRadio($i) {
		$orientation     = "";
		$valeurdefaut    = "";
		$activation      = "";
		$noactivation      = "";

		$this->frm_print( "\n\n\t<!-- BOUTONS RADIO (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n" );
		if (!empty($this->frm_tableattributs[$i]['orientation'])) {
			$orientation  = $this->frm_tableattributs[$i]['orientation'];
		}
		if (!empty($this->frm_tableattributs[$i]['default']) || $this->frm_tableattributs[$i]['default']=='0') {
			$valeurdefaut = $this->frm_tableattributs[$i]['default'];
		}
		if (!empty($this->frm_tableattributs[$i]['activation'])) {
			$activation   = $this->frm_normaliser_attributs($this->frm_tableattributs[$i]['activation']);
		}
		if (!empty($this->frm_tableattributs[$i]['noactivation'])) {
			$noactivation   = $this->frm_tableattributs[$i]['noactivation'];
		}
		// Pour tous les boutons radio
	    $cptboutonsradio = 0;
		$lectureseule =  $this->objet_readonly;

        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
			$this->frm_print( "\n\n\t" );
			// if (  $orientation == "V"  ) $this->frm_print( "<span class=\"classeformsbtradiovertical\">" );
			$this->frm_print( "<label><input type=\"radio\" id=".$this->frm_tableobjets[$i]. " name=\"" .$this->frm_tableobjets[$i]."\" value=\"".htmlspecialchars($valeur)."\"" );
			
			// Si le parametre defaut est renseigné on coche le bouton
			if ($valeurdefaut == $valeur) {
				$this->frm_print( " checked" );
			} elseif ($this->objet_readonly)
				$this->frm_print( " disabled=\"true\"" );
				
			// si elle existe on renseigne l'aide
			$this->_frm_afficheligneaide($i);

			// AJOUT SI IL EXISTE DE L'APPEL AU SCRIPT
			if (!empty($this->frm_tableattributs[$i]['script'])) {
				$this->_frm_evenements_ajouter("onClick",$this->frm_tableattributs[$i]['script'],0 );
			}
			// ENTER passe au champ suivant au lieu de valider le formulaire
			$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 
			$this->frm_print( $this->_frm_desactivation() );

			$champ_a_activer    = array();
			$champ_a_desactiver = array();
			// Si la table "activation" a été renseignée alors ...
			if  ( is_array($activation) && !($lectureseule) ) {
				// en cas de clic sur l'option on desactivera tous les autres champs 
				for ($nbreactivations=0;$nbreactivations<count($activation);$nbreactivations++) {
					if ($nbreactivations != $cptboutonsradio) {
						if ( !empty($activation[$nbreactivations])) {
							foreach ($activation[$nbreactivations] as $champ_a_traiter) {
								$champ_a_traiter = strtoupper($champ_a_traiter);
								// Desactivation dynamique
								array_push($champ_a_desactiver,$champ_a_traiter);
							}
						}
					} else {
						if ( !empty($activation[$nbreactivations])) {
							foreach ($activation[$nbreactivations] as $champ_a_traiter) {
						 		$champ_a_traiter = strtoupper($champ_a_traiter);							 							 
							 	// réactivation dynamique
								array_push($champ_a_activer,$champ_a_traiter);
							}
						}
					}
				}
				// ON DESACTIVE D'ABORD APRES AVOIR SUPPRIMER LES DOUBLONS
				if (count($champ_a_desactiver)>0) {
					$champ_a_desactiver    = array_unique($champ_a_desactiver);
					foreach ($champ_a_desactiver as $elem) {
					   	$this->_frm_evenements_ajouter("onClick",  $this->_frm_activationobjet($elem,"1"), 0);						
					}
				}
				// ON ACTIVE ENSUITE LES CHAMPS QUI DOIVENT L'ETRE
				if (count($champ_a_activer)>0) {
					$champ_a_activer    = array_unique($champ_a_activer);				
					foreach ($champ_a_activer as $elem) {
					   	$this->_frm_evenements_ajouter("onClick",  $this->_frm_activationobjet($elem,"0"), 0);						
					}
				}
				// on activera dynamiquement le champ lié (ou le 1er des champs de la liste) qui vient d'etre réactivé
				if ($nbreactivations != $cptboutonsradio) {
					$champ_lie = $activation[$cptboutonsradio];
					if ( !empty($champ_lie) ) {
						if ( is_array($champ_lie) ) {
							$champ_lie = array_shift($champ_lie);
							
						}					
						// SI AU MOINS UN ONGLET EXISTE ALORS
						if ($this->objet_onglet>0) {
							$ret = array_search(strtoupper($champ_lie),$this->frm_tableobjets);
							if (!is_bool($ret)) {
								$this->_frm_evenements_ajouter("onClick", "ActiverOngletSurRadio(".$this->frm_tablechamponglet[$ret].")", 0);
							}
						}
						// ...ON L'ACTIVE AVANT D'ACTIVER LE 1ER CHAMP
						$this->_frm_evenements_ajouter("onClick","NM_focusfield('".$this->_frm_premierdelobjet(strtoupper($champ_lie))."')", 0);
					}

				}
	 		   // MAIS AUSSI : on désactive les champs liés dont la valeur ne correspond pas au choix (nbre btn - 1)
				if ( isset($activation) ) {
					if (empty($valeurdefaut) && $valeurdefaut!='0') {
						foreach (array_merge($champ_a_activer,$champ_a_desactiver) as $elem) {		
							$this->frm_ChampActif($elem, false);
						}
					} elseif ($valeurdefaut == $valeur) {
						foreach ($champ_a_desactiver as $elem) {		
							$this->frm_ChampActif($elem, false);
						}
						foreach ($champ_a_activer as $elem) {		
							$this->frm_ChampActif($elem, true);
						}
					}
				}
			}		

			// Si la table "noactivation" a été renseignée alors ...
			if  ( is_array($noactivation) && !($lectureseule) ) {
				// en cas de clic sur l'option on desactivera tous les autres champs 
				for ($nbreactivations=0;$nbreactivations<count($noactivation);$nbreactivations++) {
					if ($nbreactivations != $cptboutonsradio) {
						if ( !empty($noactivation[$nbreactivations])) {
							if ( is_array($activation[$nbreactivations]) ) {
								foreach ($activation[$nbreactivations] as $champ_a_traiter) {
									$champ_a_traiter = strtoupper($noactivation[$nbreactivations]);
									// Desactivation dynamique
								    $this->_frm_evenements_ajouter("onClick", $this->_frm_activationobjet($champ_a_traiter,"0"), 0);
								}
							} else {
								$champ_a_traiter = strtoupper($noactivation[$nbreactivations]);
								// Desactivation dynamique
							    $this->_frm_evenements_ajouter("onClick", $this->_frm_activationobjet($champ_a_traiter,"0"), 0);
							}
						}
					} else {
						if ( !empty($noactivation[$nbreactivations])) {
							if ( is_array($activation[$nbreactivations]) ) {
								foreach ($activation[$nbreactivations] as $champ_a_traiter) {
							 		$champ_a_traiter = strtoupper($noactivation[$nbreactivations]);							 							 
								 	// réactivation dynamique de chaque éléments
							     	$this->_frm_evenements_ajouter("onClick",  $this->_frm_activationobjet($champ_a_traiter,"1"), 0);
								}
							} else {
						 		$champ_a_traiter = strtoupper($noactivation[$nbreactivations]);							 							 
							 	// réactivation dynamique
						     	$this->_frm_evenements_ajouter("onClick",  $this->_frm_activationobjet($champ_a_traiter,"1"), 0);
							}
						}
					}
				}
				// MAIS AUSSI : on active les champs liés dont la valeur correspond au choix ( 1 seul )
			   if ($valeurdefaut == $valeur) {
		   			if ( is_array($activation[$nbreactivations]) ) {
						foreach ( $activation[$nbreactivations] as $champ_unitaire) {
					   		$this->frm_ChampActif( $champ_unitaire, false);						
						}
					} else {
//				   		$this->frm_ChampActif( $noactivation[$cptboutonsradio], false);
					}
			   }
			}		

			$this->_frm_change_etat_boutons();

			// ... et modifier le libellé du texte "Quitter" en "Rétablir"
			$this->_frm_evenements_ajouter("onClick", "MM_setTextOfTextfield('ClassFormAnnulerQuitter','','Rétablir')", 1);		
			$this->_frm_submit($i,"onClick");
			$this->frm_print( $this->_frm_style_afficher() );
			$this->frm_print( $this->_frm_evenements_afficher() );
		    $this->_frm_evenements_raz();				
		    $this->_frm_style_raz();				
			
			// Si le champ a été marqué comme "en erreur"
			if (array_key_exists($this->frm_tableobjets[$i],$this->frm_tableerreurs)) {
				$stylelabel   = "classeformslabelerreur";
			} else {
				$stylelabel   = "classeformslabel";
			}
			$this->frm_print( "></label>" );
			// if (  $orientation == "V"  ) $this->frm_print( "</span>");
			if ($valeurdefaut == $valeur) { 
				$gras_avant = "<b>";
				$gras_apres = "</b>";
			} else {
				$gras_avant = "";
				$gras_apres = "";
			}				
			$this->frm_print( "\n\t    <span class=\"$stylelabel\">$gras_avant" . $libelle . "$gras_apres</span>");
			if ( $orientation == "V" ) {
				$this->frm_print( "<br>" );
			}
			$cptboutonsradio++;
		} // fin du foreach
		$this->frm_print( "\n" );
	}



	######################
	# CHAMP LISTE SIMPLE #
	######################
    function TraiteListe($i) {
	    $cptlignes = 0;
		$this->frm_print( "\n\n\t<!-- CHAMP LISTE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n");
		$valeurdefaut = "";
		$activation   = "";
		if ( !empty($this->frm_tableattributs[$i]['default']) || ($this->frm_tableattributs[$i]['default']=="0") ) {
			$valeurdefaut = $this->frm_tableattributs[$i]['default'];
		}
		$plusieurslignes = false;
		if (!empty($this->frm_tableattributs[$i]['rows'])) {
			$plusieurslignes = ($this->frm_tableattributs[$i]['rows']>1); 
		}
		// Dans le cas ou la valeur par defaut n'existe pas alors
		if (!empty($this->frm_tableattributs[$i]['title'])) {
			$title       = $this->frm_tableattributs[$i]['title'];
		} else {
			$title       = "----Choisir une option----";
		}
		if (!empty($this->frm_tableattributs[$i]['activation'])) {
			$activation   = $this->frm_tableattributs[$i]['activation'];
		}
	    $this->frm_print( "\n\t<select id=\"". $this->frm_tableobjets[$i] ."\" name=\"" . $this->frm_tableobjets[$i] ."\"" );
		$this->_frm_afficherows($i);
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_afficheclasse($i) );
		// ENTER passe au champ suivant au lieu de valider le formulaire
		$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 
		$this->frm_print( $this->_frm_desactivation() );

		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_submit($i);
		$this->_frm_change_etat_boutons();

		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );


		$affichertitreliste = !(empty($title));
		// si c'est une liste a plusieurs lignes alors on n'affiche pas l'invite

		if ($plusieurslignes) {
			$affichertitreliste = false;
			// si la liste est obligatoire et que la valeur par defaut n'est pas renseignee
			// alors on pointe par defaut le 1er de la liste			
			if (empty($valeurdefaut)) {
				if( !( strpos($this->objet_attrib,"R") === false ) && !$this->objet_readonly ) {
					foreach ($this->frm_tablelignes[$i] as $valeur => $libelle) {
						$valeurdefaut = $valeur;
						break;
					}
				}
			}
			if ($this->objet_readonly) {
				if (empty($valeurdefaut)) $vd = 'false'; else $vd =$valeurdefaut;
				$this->frm_print( " onChange=\"SelectionneIndiceListe(this,'".$vd."')\" " );
			}
		}
		// AJOUT SI IL EXISTE DE L'APPEL AU SCRIPT
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$this->frm_print( " onChange='".addslashes($this->frm_tableattributs[$i]['script'])."'" );
		}

		$this->frm_print( ">" ); 

		// DANS LE CAS DU FORMULAIRE DE VISU SEULE LA VALEUR PAR DEFAUT EST AFFICHEE
		if ($this->objet_readonly && !$plusieurslignes) {  //  
			if ( !empty($valeurdefaut) || ($valeurdefaut=="0") ) {
				$this->frm_print( "\n\t\t<option value=" . $valeurdefaut . " SELECTED>" );
				$this->frm_print( $this->frm_tablelignes[$i][$valeurdefaut]."</>" );
			}
		} else {
			// creation des lignes de la liste
			$objetjavascript = "obj" .$this->frm_tableobjets[$i];

			$this->frm_print( "\n\t<script type=\"text/javascript\">" );
			$this->frm_print( "\n\t\t".$objetjavascript." = new SelectList('".addslashes($valeurdefaut)."');" );		
			$this->frm_print( "\n\t\t".$objetjavascript.".SelectList_Show(" );
			$cpt=0;
			if ( $affichertitreliste )	{
				$titlevalue = '';
				if ( !empty($this->frm_tableattributs[$i]['titlevalue']) || ($this->frm_tableattributs[$i]['titlevalue']=='0') ) {				
					$titlevalue = $this->frm_tableattributs[$i]['titlevalue'];
				}			
				$this->frm_print( "'".$titlevalue."','".addslashes($title)."'" );
				$cpt++;
			}
	        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
				if ($cpt!=0) $this->frm_print( "," );
				$this->frm_print( "'".addslashes($valeur)."','".addslashes($libelle)."'" );
				$cpt++;
			}
			$this->frm_print( ');' );
			$this->frm_print( "\n\t</script>" );
			
		}		
	    $this->frm_print( "\n\t</select>\n" );
		
	}

	
	############################
	# CHAMP MIXTE LISTE LONGUE #
	############################
    function TraiteListeLongue($i) {
		// -----------------------------------------------------------------------------------------------------
		$taillelimite = 1000;  // pour une gestion temps réel du filtre le nombre d'élément du tableau doit etre <
		// -----------------------------------------------------------------------------------------------------
	    $cptlignes = 0;
		$valeurpardefaut = "";
		$rechercheseule = true;
		$objetjavascript = "obj" .$this->frm_tableobjets[$i];

		if ( !empty($this->frm_tableattributs[$i]['default'])) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
		}
		$rows = '5';
		if (!empty($this->frm_tableattributs[$i]['rows'])) {
			$rows = $this->frm_tableattributs[$i]['rows']; 
		}		
		$width = '150px';
		if (!empty($this->frm_tableattributs[$i]['width'])) {
			$width = $this->frm_tableattributs[$i]['width']; 
		}		
		$addvalue = false;
		if (!empty($this->frm_tableattributs[$i]['addvalue'])) {
			$addvalue = $this->frm_tableattributs[$i]['addvalue']; 
		}
		$addminlength = 0;
		if (!empty($this->frm_tableattributs[$i]['addminlength'])) {
			$addminlength = $this->frm_tableattributs[$i]['addminlength']; 
		}
		$ajax = '';
		if (!empty($this->frm_tableattributs[$i]['ajax'])) {
			$ajax = $this->frm_tableattributs[$i]['ajax']; 
			// recherche permise a partir de x caracteres
			$ajaxsearchminlength = 0;
			if (!empty($this->frm_tableattributs[$i]['ajaxsearchminlength'])) {
				$ajaxsearchminlength = $this->frm_tableattributs[$i]['ajaxsearchminlength']; 
			}

			// recherche automatique des que le champ filtre est modifié
			$ajaxautosearch = false;
			if (!empty($this->frm_tableattributs[$i]['ajaxautosearch'])) {
				$ajaxautosearch = $this->frm_tableattributs[$i]['ajaxautosearch']; 
			}
			if ($ajaxautosearch) {
				$ajax_min_lenght = 1;
			} else {
				// ...ou bien a partir de quelques caracteres sur des grosses tables
				$ajax_min_lenght = -1;
				if (!empty($this->frm_tableattributs[$i]['ajaxautosearchminlength'])) {
					$ajax_min_lenght = $this->frm_tableattributs[$i]['ajaxautosearchminlength']; 
				}
			}
			// parametres supplementaires pour POST ajax
			$ajaxparams = array();
			if (!empty($this->frm_tableattributs[$i]['ajaxparams'])) {
				$ajaxparams = $this->frm_tableattributs[$i]['ajaxparams']; 
			}

			// parametres supplementaires pour POST ajax
			$ajaxmodedebug = false;
			if (!empty($this->frm_tableattributs[$i]['ajaxmodedebug'])) {
				$ajaxmodedebug = $this->frm_tableattributs[$i]['ajaxmodedebug']; 
			}

 

		}

		$this->frm_print( "\n\n\t<!-- CHAMPS LISTE LONGUE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n" );	
		$this->frm_print( "\n\t<input type=\"hidden\" name=\"".$this->frm_tableobjets[$i]."\" value=\"".$valeurpardefaut."\" " );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( ">" );

		$this->frm_print( "\n\t<!-- Initialisation de l'objet entierement pas javascript -->" );
		$this->frm_print( "\n\t<script type=\"text/javascript\">" );
		$nomchampvu = $this->frm_tableobjets[$i].'_EDIT_'.$this->timestamp_formulaire;
		$this->frm_print( "\n\t\t".$objetjavascript." = new LongList('".$this->frm_tableobjets[$i]."','".$nomchampvu."','".$objetjavascript."','".CHEMINRESSOURCES_CF."longlist/');" );
		
		if (empty($ajax)) {
			// creation des lignes de la liste
			$this->frm_print( "\n\t\t".$objetjavascript.".LongList_LoadList(" );		
			$cpt=0;
    	    foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
					if ($cpt!=0) $this->frm_print( "," );
					$this->frm_print( "'".addslashes($valeur)."','".addslashes($libelle)."'" );
					$cpt++;
			}
			$this->frm_print( ");" );
		} else {
			// option "ajax", la liste est enrichie par l'appel a l'url
			$this->frm_print( "\n\t\t".$objetjavascript.".LongList_AjaxUrl('".$ajax."',".$ajax_min_lenght.");" );		
			if (count($ajaxparams)>0) {			
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_AjaxParams(" );
				$cpt=0;
	    	    foreach ( $ajaxparams as $nom_post => $expression) {
					if ($cpt!=0) $this->frm_print( "," );
					$this->frm_print( "'".addslashes($nom_post)."','".addslashes($expression)."'" );
					$cpt++;
				}				
				$this->frm_print( ");" );		
			}
			if (!empty($ajaxsearchminlength)) {
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_SearchMinLength(".$ajaxsearchminlength.");" );		
			}
			// activation du mode DEBUG
			if ($ajaxmodedebug) {
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_ModeDebug();" );		
			}
		}

		$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Size('".$width."','".$rows."');" );
		if ($addvalue) {
			// en cas d'ajout d'une valeur elle peut etre limitee en taille
			if ( !empty($this->frm_tableattributs[$i]['maxlength'])) { 
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_MaxLength(".$this->frm_tableattributs[$i]['maxlength'].");" );
			}
			$this->frm_print( "\n\t\t".$objetjavascript.".LongList_AddValue();" );		
			$this->frm_print( "\n\t\t".$objetjavascript.".LongList_AddMinLength(".$addminlength.");" );		
		}
		$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Class('".$this->_frm_classe($i)."','classeformschampreadonly');" );
		$evenements = "onFocus=\"ReactiverBtnValider();PasserEtatAnnuler()\" onClick=\"ReactiverBtnValider();PasserEtatAnnuler()\" onKeyPress=\"return handleEnter(this,event);\"";
		if ( !empty($this->objet_help) && !$this->objet_readonly ) { 
			$evenements .=	" onMouseOver=\"docTips.show(\'hlp".$this->frm_tableobjets[$i]."\')\" onMouseOut=\"docTips.hide()\"";			
		}

		$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Events('".$evenements."');" );

		if  ($this->objet_readonly) {
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_ReadOnly();" );
		} else if (!empty($this->objet_attrib)) {
			if ( !( strpos($this->objet_attrib,"+") === false )) {
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_ReadOnly();" );
			}
			if ( !( strpos($this->objet_attrib,"-") === false )) {
				$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Disabled();" );
			}
		}
		// le script est appelé a chaque changement d'etat
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Script('".$this->frm_tableattributs[$i]['script']."');" );				
		}		

		$attrib = '';
	    if ( !(strpos($this->objet_attrib,"U") === false)) {
			$attrib = "'U'";
		}
	    if ( !(strpos($this->objet_attrib,"I") === false)) {
			$attrib = "'I'";
		}
	    if ( !(strpos($this->objet_attrib,"L") === false)) {
			$attrib = "'L'";
		}
		$this->frm_print( "\n\t\t".$objetjavascript.".LongList_Show(".$attrib.");" );				
		$this->frm_print( "\n\t </script>\n" );
	}



	###########################
	# CHAMP LISTES EN CASCADE #
	###########################
    function TraiteListesCascade($i) {
		$nomobjet = $this->frm_tableobjets[$i];
		$objetjavascript = "obj".$nomobjet;
		
		$largeur_globale = '200px';
		if (!empty($this->frm_tableattributs[$i]['width'])) {
			$largeur_globale = $this->frm_tableattributs[$i]['width'];
		}
		$valeurdefaut = '';
		if (!empty($this->frm_tableattributs[$i]['default'])) {
			$valeurdefaut = $this->frm_tableattributs[$i]['default'];
		}
		$clef_root = 'ROOT';
		if (!empty($this->frm_tableattributs[$i]['root'])) {
			$clef_root = $this->frm_tableattributs[$i]['root'];
		}
		// parametres supplementaires pour POST ajax
		$ajaxparams = array();
		if (!empty($this->frm_tableattributs[$i]['ajaxparams'])) {
			$ajaxparams = $this->frm_tableattributs[$i]['ajaxparams']; 
		}

		$this->frm_print( "\n\n\t<!-- OBJET LISTESCASCADE (".$nomobjet.") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n" );

		$this->frm_print( "\n\t<input type=\"hidden\" name=\"".$nomobjet."\" value=\"".$valeurdefaut."\" " );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( ">" );

		$this->frm_print( "\n\t<!-- Initialisation de l'objet entierement pas javascript -->" );
		$this->frm_print( "\n\t<script type=\"text/javascript\">" );

		$this->frm_print( "\n\t\t".$objetjavascript." = new CascadingLists('".$this->frm_tableobjets[$i]."','".$objetjavascript."','".CHEMINRESSOURCES_CF."cascadinglists/');" );
		if (!empty($this->frm_tableattributs[$i]['orientation'])) {
			if ($this->frm_tableattributs[$i]['orientation']=='V' ) {
				$orientation = 'V';
			} else {
				$orientation = 'H';
			}
			$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Orientation('".$orientation."');" );		
		}
		// activation du mode de debuggage
		if ($this->frm_tableattributs[$i]['ajaxmodedebug']) {
			$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_ModeDebug();" );		
		}	
		$url_ajax_globale = '';
		// le script est appelé a chaque changement d'etat
		if (!empty($this->frm_tableattributs[$i]['ajax'])) {
			$url_ajax_globale = $this->frm_tableattributs[$i]['ajax'];
		}		
		
		if (!$this->objet_readonly) {
			if (count($this->frm_tablelignes[$i])>0) {
				// creation des lignes de la liste
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_LoadList(" );		
				$cpt=0;
    		    foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
					if ($cpt!=0) $this->frm_print( "," );
					$this->frm_print( "'".addslashes($valeur)."','".addslashes($libelle)."'" );
					$cpt++;
				}
				$this->frm_print( ");" );
			} else {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_InitRootList('".$clef_root."');" );		
			}
		} 
		$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Class('".$this->_frm_classe($i)."','classeformschampreadonly');" );

		$evenements = "onFocus=\"ReactiverBtnValider();PasserEtatAnnuler()\" onClick=\"ReactiverBtnValider();PasserEtatAnnuler()\" onKeyPress=\"return handleEnter(this,event);\"";
		if ( !empty($this->objet_help) && !$this->objet_readonly ) { 
			$evenements .=	" onMouseOver=\"docTips.show(\'hlp".$this->frm_tableobjets[$i]."\')\" onMouseOut=\"docTips.hide()\"";			
		}

		$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Events('".$evenements."');" );

		// le script est appelé a chaque changement d'etat
		if (count($this->frm_tableattributs[$i]['list'])>0) {
			foreach ($this->frm_tableattributs[$i]['list'] as $_valeur) {
				if (!empty($_valeur['id'])) {
					// la largeur peut etre individualisee ou bien globale				
					$largeur = $_valeur['width'];
					if (empty($largeur)) {
						$largeur = $largeur_globale;
					}
					// idem pour l'url d'appel				
					$url_ajax = $_valeur['ajax'];
					if (empty($url_ajax)) {
						$url_ajax = $url_ajax_globale;
					}
					if (empty($url_ajax)) {
						$this->frm_print( "\n\t\talert('frm_ObjetListesCascade : l`url de base n`est pas renseignée (attribut `ajax`)!');" );	
					} else {					
						$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_AddList('".addslashes($_valeur['id'])."','".addslashes($_valeur['title'])."','".$largeur."','".$url_ajax."');" );	
					}
				}
			}
		}
		// etat de l'objet
		if  ($this->objet_readonly) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_ReadOnly();" );
		} else if (!empty($this->objet_attrib)) {
			if ( !( strpos($this->objet_attrib,"+") === false )) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_ReadOnly();" );
			}
			if ( !( strpos($this->objet_attrib,"-") === false )) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Disabled();" );
			}
		}
		// le script va gere une variable multi-niveau
		if (!empty($this->frm_tableattributs[$i]['multilevel'])) {
			$levelfield = $nomobjet.'_LEVEL';
			if (!empty($this->frm_tableattributs[$i]['levelfield'])) {
				$levelfield = $this->frm_tableattributs[$i]['levelfield'];
			}
			$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_MultiLevel('".$levelfield."');" );				
			if (!empty($this->frm_tableattributs[$i]['defaultlevel'])) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_DefaultLevel('".$this->frm_tableattributs[$i]['defaultlevel']."');" );				
			}		
		}		
		if (count($ajaxparams)>0) {			
			$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_AjaxParams(" );
			$cpt=0;
    	    foreach ( $ajaxparams as $nom_post => $expression) {
				if ($cpt!=0) $this->frm_print( "," );
				$this->frm_print( "'".addslashes($nom_post)."','".addslashes($expression)."'" );
				$cpt++;
			}				
			$this->frm_print( ");" );		
		}
		
		
		// le script est appelé a chaque changement d'etat
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Script('".$this->frm_tableattributs[$i]['script']."');" );				
		}		
		// affichage du bouton pour effacer les listes
		if ($this->frm_tableattributs[$i]['erase']) {
			if ($this->frm_tableattributs[$i]['erase']) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_BtnErase();" );				
			}
		}		
		// affichage du bouton pour effacer les listes
		if (!empty($this->frm_tableattributs[$i]['reset'])) {
			if ($this->frm_tableattributs[$i]['reset']) {
				$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_BtnReset();" );				
			}
		}		

		$this->frm_print( "\n\t\t".$objetjavascript.".CascadingLists_Show();" );				
		$this->frm_print( "\n\t </script>\n" );
	}







	########################
	# CHAMP 2 LISTES LIEES #
	########################
    function Traite2Listes($i) {
	    $cptlignes = 0;
		$valeurdefaut   = "";
		$merepardefaut  = "";
		$fillepardefaut = "";
		$orientation    = "";
		$title1         = "";
		$title2         = "";
		$nomdufils      =  $this->frm_tableobjets[$i];
		$nom_champ_pere = "PERE_" . $nomdufils;
		$this->frm_print( "\n\n\t<!-- CHAMPS AVEC LISTES MERE/FILLE ".$this->frm_tableobjets[$i]." : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
		if (!empty($this->frm_tableattributs[$i]['default'])) {
			$valeurdefaut = $this->frm_tableattributs[$i]['default'];
		}
		if (!empty($this->frm_tableattributs[$i]['orientation'])) {
			$orientation  = $this->frm_tableattributs[$i]['orientation'];
		}
		
		if (!empty($this->frm_tableattributs[$i]['title1'])) {
			$title1       = $this->frm_tableattributs[$i]['title1'];
		}
		if (!empty($this->frm_tableattributs[$i]['title2'])) {
			$title2       = $this->frm_tableattributs[$i]['title2'];
		}
		if ( empty($title1) ) { $title1 = "-- Choisir une option --"; }
		if ( empty($title2) ) { $title2 = "-- Choisir une option --"; }
		$tablevaleurs_mere  = array();
		$tablevaleurs_fille = array();

		// Pour toute les lignes on separe la table "mere" de la "fille"
        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
		    if (  (strpos($valeur,".")) === false ) {
				$tablevaleurs_mere["$valeur"] = $libelle;
			} else {
				// traitement d'une fille : memorisation dans la table
				$tablevaleurs_fille["$valeur"] = $libelle;
				// ...et tester si c'est la valeur par defaut
			    list($idpere,$id) = explode(".",$valeur);	
				if (!empty($valeurdefaut) && empty($merepardefaut)) {
					// et on en profite pour memoriser les id mere et fille par defaut
					if ($id == $valeurdefaut) {
						$merepardefaut  = $idpere;
						$fillepardefaut = $id;
					}						
				}
			}
		}

		// Dans le cas d'une orientation Horizontale (ou sans indication), on va creer un tableau a 2 colonnes
		if ( empty($orientation)) { $orientation = "H"; }


		// Liste Mère
		$this->frm_print( "\n\t<!-- DEFINITION DE LA LISTE \"MERE\" (defaut = \"$merepardefaut\") -->" );
		if  ($orientation == "H") { 
			$this->frm_print( "\n\n\t<!-- ORIENTATION HORIZONTALE -->" );
			$this->frm_print( "\n\t<table width=\"100%\" border=\"0\" cellspacing=\"0\"><tr><td width=\"10px\" nowrap>" ); 
		} else 
			$this->frm_print( "\n\n\t<!-- ORIENTATION VERTICALE -->" );

	    $this->frm_print( "\n\t<p><select id=\"".$nom_champ_pere ."\" name=\"" . $nom_champ_pere ."\" " );
		if (!$this->objet_readonly) {
			$this->frm_print( "onChange=\"" . $nom_champ_pere . "_ChangeDetail(this.form);\"" );
		}
		$this->_frm_lectureseule($i);
	    $this->frm_print( $this->_frm_afficheclasse($i) );
		$this->_frm_definitstylewidth($i);
		$this->_frm_afficheligneaide($i);
		$this->frm_print( $this->_frm_style_afficher() );				
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( ">" );
		// DANS UN FORMULAIRE EN VISU SEULE UNE VALEUR EST AFFICHEE
		if ($this->objet_readonly) {
			$this->frm_print( "\n\t\t<option value=\"$merepardefaut\">".$tablevaleurs_mere[$merepardefaut]."</>" );

		} else {
			$this->frm_print( "\n\t\t<option value=\"0\">$title1</>" );
			// Pour toute les lignes de la liste "Mere" (celle dont la clef ne comtient pas de ".")
	        foreach ($tablevaleurs_mere as $valeur => $libelle) {
				$this->frm_print( "\n\t\t<option value=\"" . htmlspecialchars($valeur)."\"" );
				// affichage eventuel de la valeur par defaut
				if ($valeur == $merepardefaut) $this->frm_print( " selected" );
				$this->frm_print( ">$libelle</>" );
			}
		}		
	    $this->frm_print( "\n\t</select>" );
		
		// Liste Fille
		$this->_frm_style_raz();				
		$this->frm_print( "\n\t<!-- DEFINITION DE LA LISTE \"FILLE\" (defaut = \"$fillepardefaut\") -->" );
		if  ($orientation == "H") { $this->frm_print( "\n\t</td><td width=\"*\">" ); }
		
	    $this->frm_print( "\n\t<div id=\"DIV_" .$this->frm_tableobjets[$i] . "\">\n\t" );
		$this->frm_print( "<select id=\"".$this->frm_tableobjets[$i]."\" name=\"" . $this->frm_tableobjets[$i] ."\"" );
		$this->frm_print( $this->_frm_afficheclasse($i) );

		// si elle existe on renseigne l'aide

		// $this->_frm_afficheligneaide($i);
		$this->_frm_change_etat_boutons();
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( ">" );
		
		// Si une valeur par defaut existe alors...
		if (!empty($valeurdefaut)) {					
			if  (!$this->objet_readonly) $this->frm_print( "\n\t\t<option value=\"0\">$title2</>" );
			foreach ($tablevaleurs_fille as $valeurf => $libellef) {
	
			    list($idmerelu,$idfillelu) = explode(".",$valeurf);
				// DANS UN FORMULAIRE EN VISU SEULE UNE VALEUR EST AFFICHEE
				if ($this->objet_readonly) {
					if ( ($merepardefaut == $idmerelu) && ($fillepardefaut == $idfillelu)) {
						$this->frm_print( "\n\t\t<option selected\">".$libellef."</>" );
					}
				} else {
					// on ne retient que les valeurs "soeurs"  (qui ont la même mère)
					if ($merepardefaut == $idmerelu) {
						$this->frm_print( "\n\t\t<option value=\"$idfillelu\"" );
						if ($fillepardefaut == $idfillelu) {
							$this->frm_print( " selected" );
						}
						$this->frm_print( ">".$libellef."</>" );
					}
				}
			}
		} else {
			// si pas de valeur par defaut alors on affiche le libellé par défaut
			$this->frm_print( "\n\t\t<option value=\"0\">$title2</>" );
		}
		
	    $this->frm_print( "\n\t</select>\n\t</div>" );
		if  ($orientation == "H") { 
			$this->frm_print( "\n\t</td></tr></table>" ); 
		}
		$this->frm_print( "</p>" );
	
		$this->frm_print( " \n" );
		$this->frm_print( "\n<!-- CODE JAVASCRIPT necessaire a la manipulation de 2 listes liées -->\n" );
		$this->frm_print( "\n<SCRIPT language=JavaScript><!--\n" );
		$this->frm_print( "\tIE = (document.all)?1:0; \n" );
		$this->frm_print( "\tNS = (document.layers)?1:0; \n\t" );
		$this->frm_print( $nomdufils ."_0='';" );
		// initialisation des valeurs dynamiques du tableau "fille"
		foreach ($tablevaleurs_mere as $valeurm => $libellem) {
			$this->frm_print( "\n\t" . $nomdufils . "_".$valeurm."='" );
			foreach ($tablevaleurs_fille as $valeurf => $libellef) {
			    list($idpere,$id) = explode(".",$valeurf);
				if ($valeurm == $idpere) {	
					$this->frm_print( "<option value=\"$id\">".addslashes($libellef)."</>" );
				}
			}
			$this->frm_print( "';" );
		}
		$this->frm_print( "\n\tfunction PERE_" . $nomdufils . "_ChangeDetail(pos) { \n" );
		$this->frm_print( "\t\tpos = pos.PERE_$nomdufils.options[pos.PERE_$nomdufils.selectedIndex].value; \n" );
		$this->frm_print( "\t\ttemp = '<select id=\"$nomdufils\" name=\"$nomdufils\" ". $this->_frm_style_afficher() . $this->_frm_afficheclasse($i) . " onFocus=\"tmt_disableField(\'ClassFormValider\',0);PasserEtatAnnuler()\" >" );
		$this->frm_print( "\<option value=\"0\" selected>$title2</>' + eval(\"" . $nomdufils . "_\" + pos) + '</select>'; \n" );
		$this->frm_print( "\t\tif(IE){	DIV_$nomdufils.innerHTML=(temp)  } \n" );
		$this->frm_print( "\t\tif (/Mozilla\\/5\\.0/.test(navigator.userAgent)) { \n" );
		$this->frm_print( "\t\t\tvar x = document.getElementById('DIV_$nomdufils'); \n" );
		$this->frm_print( "\t\t\tx.innerHTML=temp; \n" );
		$this->frm_print( "\t\t}  \n" );
		$this->frm_print( "\t} \n" );
		$this->frm_print( "\n--></SCRIPT>\n" );
	}				




	#############################
	# CHAMP 2 LISTES EN BASCULE #
	#############################
    function TraiteBascule($i) {
		$this->frm_print( "\n\n\t<!-- OBJET BASCULE (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
	    $cptlignes = 0;
		$sortitems = false;
		$valeurpardefaut = "";
		$rechercheseule = true;
		$titregauche = "";
		$titredroite = "";
		$nomobjet = $this->frm_tableobjets[$i];
		$objetjavascript = "obj" .$this->frm_tableobjets[$i];
		if ( !empty($this->frm_tableattributs[$i]['default'])) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
		}
		if ( !empty($this->frm_tableattributs[$i]['title1'])) {
			$titregauche = $this->frm_tableattributs[$i]['title1'];
		}		
		if ( !empty($this->frm_tableattributs[$i]['title2'])) {
			$titredroite = $this->frm_tableattributs[$i]['title2'];
		}		
		if ( isset($this->frm_tableattributs[$i]['sort'])) {
			$sortitems = ($this->frm_tableattributs[$i]['sort']);
		}		
		$this->frm_print( "\n\t<p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n" );
		$this->frm_print( "<tr><td rowspan=\"2\" nowrap>" );
		// Affichage si il existe du titre de la liste GAUCHE
		if (!empty($titregauche)) $this->frm_print( "<span class=\"classeformslabel\">".$titregauche."</span><br>" );
		// Affichage de la liste GAUCHE
		$this->frm_print( "\n\t  <select multiple id=\"".$nomobjet."_G\" " );
	
			$this->_frm_evenements_raz();
			$this->_frm_afficherows($i);
			$this->_frm_definitstylewidth($i);
			$this->frm_print( $this->_frm_afficheclasse($i) );
			$this->_frm_evenements_ajouter("onClick", $objetjavascript.".Bascule_UnselectAll('D')", 0);	 
			$this->_frm_afficheligneaide($i);
			if  ($this->objet_readonly) {
				$this->frm_print( ' readonly="true"' );
			} else {
				$this->_frm_change_etat_boutons();
			}
			$this->frm_print( $this->_frm_style_afficher() );				
			$this->frm_print( $this->_frm_evenements_afficher() );
			$etatlu = $this->_frm_desactivation();
			$this->frm_print( $etatlu );

		$this->frm_print( ">\n\t  </select> \n" );
		
		$this->frm_print( "\t</td><td height=\"33\" align=\"right\" valign=\"top\"> " );
		
		if ( !empty($titregauche) || !empty($titredroite) ) $this->frm_print( "<span class=\"classeformslabel\"> <br></span>\n" );		

		// definition des icones
		$off = ($this->objet_readonly) ? 'off_' : $this->skin_name.'_';
		$icone_select_all   = $off.'bascule_right_all.gif';
		$icone_select_one   = $off.'bascule_right_one.gif';
		$icone_unselect_all = $off.'bascule_left_all.gif';
		$icone_unselect_one = $off.'bascule_left_one.gif';
		$icone_move_up      = $off.'bascule_up.gif';
		$icone_move_down    = $off.'bascule_down.gif';
		
		// Affichage des boutons de selection (EN HAUT) si le formulaire n'est pas en lecture seule
			$this->frm_print( "\t\t&nbsp;");
			if  (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.SelectionnerTout()) { ReactiverBtnValider();PasserEtatAnnuler(); }" ');
				$this->frm_print( $etatlu.'>' );
			}
			$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_select_all.'"' );
			if  (!$this->objet_readonly) {
 				$this->frm_print( ' border="0" title="Sélectionner tous les éléments"></a>' );
 				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.Selectionner()) { ReactiverBtnValider();PasserEtatAnnuler(); }" ');
				$this->frm_print( $etatlu );
			}
			$this->frm_print( '><img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_select_one.'"' );
			if  (!$this->objet_readonly) {
 				$this->frm_print( ' border="0" title="Sélectionner les éléments choisis à gauche"></a' );
			} 
			$this->frm_print( '>&nbsp;' );

			// ajout de l'icone MOVE UP si "sort" defini
			if ($sortitems) {
				$this->frm_print( "<br>" );
				if  (!$this->objet_readonly) {
					$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.Bascule_MoveUp()) { ReactiverBtnValider();PasserEtatAnnuler(); }" ');
					$this->frm_print( $etatlu.'>' );
				}
				$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_move_up.'"' );
				if  ($this->objet_readonly) {
					$this->frm_print( '>' );
				} else {
					$this->frm_print( ' border="0" title="Monter d\'une ligne l\'élément sélectionné dans la liste de droite"></a>' );
				}
				$this->frm_print( '&nbsp;' );
			}
			$this->frm_print( "</td>\n\n" );
		
		$this->frm_print( "\t<td rowspan=\"2\">" );
		if (!empty($titredroite)) $this->frm_print( "<span class=\"classeformslabel\">".$titredroite."</span><br>" );
		// Affichage de la liste DROITE
		$this->frm_print( "\n\t  <select multiple id=\"".$nomobjet."_D\" " );
			$this->_frm_evenements_raz();
			if  ($this->objet_readonly) {
				$this->frm_print( ' readonly="true"' );
			} else {
				$this->_frm_change_etat_boutons();
			}
			$this->_frm_afficherows($i);
			$this->_frm_definitstylewidth($i);
			$this->frm_print( $this->_frm_afficheclasse($i) );
			$this->_frm_evenements_ajouter("onClick", $objetjavascript.".Bascule_UnselectAll('G')", 0);	 
			$this->_frm_afficheligneaide($i);
			$this->frm_print( $this->_frm_style_afficher() );				
			$this->frm_print( $this->_frm_evenements_afficher() );
			$this->frm_print( $etatlu );
			$this->frm_print( ">\n\t  </select>\n" );

			$this->frm_print( "\t</td></tr><tr><td align=\"right\" valign=\"bottom\" nowrap> \n" );

			// ajout de l'icone MOVE DOWN si "sort" defini
			if ($sortitems) {
				if  (!$this->objet_readonly) {
					$this->frm_print( '<a href="javascript:void(0)" onClick="if('.$objetjavascript.'.Bascule_MoveDown()) { ReactiverBtnValider(); PasserEtatAnnuler(); }" ');
					$this->frm_print( $etatlu.'>' );
				}
				$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_move_down.'"' );

				if  (!$this->objet_readonly) {
					$this->frm_print( ' border="0" title="Descendre d\'une ligne l\'élément sélectionné dans la liste de droite"></a' );
				}
				$this->frm_print( ">&nbsp;<br>" );			
			}

		// Affichage des boutons de déselection (EN BAS) 
			$this->frm_print( "\t\t&nbsp;" );
			if  (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if('.$objetjavascript.'.DeselectionnerTout()) { ReactiverBtnValider(); PasserEtatAnnuler(); }" ');
				$this->frm_print( $etatlu.'>' );
			}
			$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_unselect_all.'"' );
			if  (!$this->objet_readonly) {
				$this->frm_print( ' border="0" title="Désélectionner tous les éléments">' );
				$this->frm_print( '</a><a href="javascript:void(0)" onClick="if('.$objetjavascript.'.Deselectionner()) { ReactiverBtnValider(); PasserEtatAnnuler(); }" ');
				$this->frm_print( $etatlu );
			}
			$this->frm_print( '><img src="'.CHEMINRESSOURCES_CF.'2listesbascule/'.$icone_unselect_one.'"' );
			if  (!$this->objet_readonly) {
				$this->frm_print( ' border="0" title="Désélectionner les éléments choisis"></a' );
			}
			$this->frm_print( ">&nbsp;</td>\n\n" );

		
		// Affichage du champ caché		
		$this->frm_print( "\t</tr>\n\t</table>\n" );
		$this->frm_print( "\t  <!-- Le champs suivant est le champ des valeurs des options sélectionnées\n" );
		$this->frm_print( "\t       Il est utilisé pour initialiser la liste de droite et aussi pour récupérer les choix\n" );
		$this->frm_print( "\t       Les valeurs sont séparées par des virgules --> \n" );
		$this->frm_print( "\t  <input name=\"".$nomobjet."\" type=\"hidden\" " );
		$this->_frm_affichedefaut($i);
		$this->frm_print( $etatlu );
		$this->frm_print( "></p>\n" );

		// Affichage du script d'initialisation des valeurs possibles et de l'objet "bascule"
		$this->frm_print( "\n\t<!-- CODE JAVASCRIPT d'initialisation de l'objet bascule \"".$this->frm_tableobjets[$i]."\" -->\n" );
		$this->frm_print( "\n\t<script language=\"JavaScript\" type=\"text/JavaScript\">\n" );

		$sortlib = ($sortitems) ? 'true' : 'false';
		$this->frm_print( "\n\t".$objetjavascript." = new Bascule('".$nomobjet."',".$sortlib.");" );
		// creation des lignes de la liste
		$this->frm_print( "\n\t".$objetjavascript.".Bascule_LoadList(" );		
		$cpt=0;
        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
				if ($cpt!=0) $this->frm_print( "," );
				$this->frm_print( "'".addslashes($valeur)."','".addslashes($libelle)."'" );
				$cpt++;
		}
		$this->frm_print( ");\n" );
		$this->frm_print( "\t".$objetjavascript.".Bascule_Show();\n" );		
		$this->frm_print( "</script> \n" );
	}





	#######################
	# CHAMP LISTE A TRIER #
	#######################
    function TraiteSortSelect($i) {
		$this->frm_print( "\n\n\t<!-- OBJET SORTSELECT (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n" );
		$nomobjet = $this->frm_tableobjets[$i];
		$objetjavascript = "js"  .$this->frm_tableobjets[$i];
		$objetselect     = $this->frm_tableobjets[$i]."_SELECT";

		if ( !empty($this->frm_tableattributs[$i]['default'])) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
		}
		$separateurs  = isset( $this->frm_tableattributs[$i]['separators'] );
				
		$this->frm_print( "\n\t<p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"*\">\n" );
		$this->frm_print( "\n\t<tr><td rowspan=\"2\">" );
		$this->frm_print( "<select id=\"".$objetselect."\"  " );

		$this->_frm_evenements_raz();
		$this->_frm_afficherows($i);
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_afficheclasse($i) );
		$this->frm_print( $this->_frm_desactivation() );
		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_submit($i);
		if ( !$this->objet_readonly  ) {
			$this->_frm_change_etat_boutons();
		}

		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );
		
					
		$this->frm_print( "></select></td>" );

		$chemin = CHEMINRESSOURCES_CF.'sortselect/';

		if ($this->objet_readonly) {
			$off = 'off_';
			$coul = '';
		} else {
			$off = '';
			$coul = $this->skin_name.'_';
		}
		
		$icone_up    = $chemin.$off.$coul."bascule_up.gif";
		$icone_down  = $chemin.$off.$coul."bascule_down.gif";
		$icone_plus  = $chemin.$off."plus.gif";
		$icone_moins = $chemin.$off."moins.gif";
		
		// AFFICHAGE DES BOUTONS 
		$this->frm_print( "\n\n\t<td align='left' valign='top'>" );
		if ( !$this->objet_readonly  ) {
			$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.SortSelectGoUp()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
		}
		$this->frm_print( '<img src="'.$icone_up.'" width="16" height="16"');
		if ( !$this->objet_readonly  ) {
			$this->frm_print( ' title="Faire remonter la ligne courante dans la liste" border="0"></a' );
		}
		$this->frm_print( '><br>' );
		// SI LES SEPARATEURS SONT DEMANDES ON AFFICHE LE BOUTON "+" POUR INSERER UN SEPARATEUR
		if ($separateurs) {
			if ( !$this->objet_readonly  ) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.SortSelectInsert()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
			}
			$this->frm_print( '<img src="'.$icone_plus.'" width="16" height="16"' );
			if ( !$this->objet_readonly  ) {
				$this->frm_print( ' title="Insérer un séparateur dans la liste" border="0"></a' );
			}	
			$this->frm_print( '>' );
		}
		$this->frm_print( "</td></tr><tr>" );
		$this->frm_print( "\n\t<td align='left' valign='bottom'>" );
		// SI LES SEPARATEURS SONT DEMANDES ON AFFICHE LE BOUTON "-" POUR SUPPRIMER UN SEPARATEUR
		if ($separateurs) {
			if ( !$this->objet_readonly  ) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.SortSelectDelete()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
			}
			$this->frm_print( '<img src="'.$icone_moins.'" width="16" height="16"' );
			if ( !$this->objet_readonly  ) {
				$this->frm_print( ' title="Supprimer le séparateur courant" border="0"></a' );
			}
			$this->frm_print( '><br>' );
		}
		if ( !$this->objet_readonly  ) {
			$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$objetjavascript.'.SortSelectGoDown()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
		}
		$this->frm_print( '<img src="'.$icone_down.'" width="16" height="16"' );
		if ( !$this->objet_readonly  ) {
			$this->frm_print( ' title="Faire descendre la ligne courante dans la liste" border="0"></a' );
		}
		$this->frm_print( "></td></tr></table>" );

		$lignedefaut  = '';
		// si une valeur a ete definie elle ecrase celle sui vient d'etre calculee
		if (!empty($this->frm_tableattributs[$i]['default'])) {
			$lignedefaut = $this->frm_tableattributs[$i]['default'];
		}

		// Affichage du champ caché	qui contient l'ordre desire
		$this->frm_print( "\n\t  <!-- Le champ suivant est le champ des valeurs triees\n" );
		$this->frm_print( "\t       Il est utilisé pour initialiser l'ordre de la liste ci-dessus\n" );
		$this->frm_print( "\t       Les valeurs sont séparées par des virgules --> \n" );
		$this->frm_print( "\t  <input name=\"".$nomobjet."\" type=\"hidden\" value=\"".$lignedefaut."\"" );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( "></p>\n" );

		// Affichage du script d'initialisation des valeurs possibles et de l'objet "bascule"
		$this->frm_print( "\n\t<!-- CODE JAVASCRIPT d'initialisation de l'objet SortSelect \"".$this->frm_tableobjets[$i]."\" -->\n" );
		$this->frm_print( "\n\t<script language=\"JavaScript\" type=\"text/JavaScript\">\n" );
		$this->frm_print( "\n\t".$objetjavascript." = new SortSelect('".$objetselect ."','".$nomobjet."');" );	
		// creation des lignes de la liste
		$this->frm_print( "\n\t".$objetjavascript.".SortSelect_LoadList(" );		
		$cpt=0;
        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
				if ($cpt!=0) $this->frm_print( "," );
				$this->frm_print( "'".addslashes($valeur)."','".addslashes($libelle)."'" );
				$cpt++;
		}
		$this->frm_print( ");" );
		
		if ($separateurs) {
			if ( !empty($this->frm_tableattributs[$i]['separatorvalue'])) {
				$this->frm_print( "\n\t".$objetjavascript.".SortSelectSeparatorValue('".$this->frm_tableattributs[$i]['separatorvalue']."');" );	
			}		
			if ( !empty($this->frm_tableattributs[$i]['separatortext'])) {
				$this->frm_print( "\n\t".$objetjavascript.".SortSelectSeparatorText('".$this->frm_tableattributs[$i]['separatortext']."');" );	
			}		
		}
		$this->frm_print( "\n\t".$objetjavascript.".SortSelect_InitialiserListe();" );	
		$this->frm_print( "\n\t</script> \n" );
	}



	################################
	# CHAMP LISTE A CHOIX MULTIPLE #
	################################
    function TraiteMultiListe($i) {
		$nomobjet = $this->frm_tableobjets[$i];
		$objetjavascript = "o".$nomobjet;

		$chemin = CHEMINRESSOURCES_CF."listemultiselect/img/";
		$off = ($this->objet_readonly) ? 'off_' : '';
		$icone_select_all   = $chemin.$off."list_selectall.gif";
		$icone_unselect_all = $chemin.$off."list_unselectall.gif";
		$icone_reset        = $chemin.$off."list_reset.gif";

		$this->frm_print( "\n\n\t<!-- OBJET MULTILISTE (".$nomobjet.") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n" );
		$valeurdefaut = "";
		$activation   = "";
		if ( !empty($this->frm_tableattributs[$i]['default']) || ($this->frm_tableattributs[$i]['default']=="0") ) {
			$valeurdefaut = $this->frm_tableattributs[$i]['default'];
		}
		$mode = "normal";
		if (!empty($this->frm_tableattributs[$i]['mode'])) {
			$mode = $this->frm_tableattributs[$i]['mode'];
		}
		$taille = 'auto';
		if (!empty($this->frm_tableattributs[$i]['rows'])) {
			$taille = $this->frm_tableattributs[$i]['rows'];
		}		
		if ($taille=='auto') {
			$taille = count($this->frm_tablelignes[$i]);
		}
		// ANALYSE SI ON DEMANDE DES BLOCS D'ELEMENTS CONSECUTIFS
		$modeblock =  isset($this->frm_tableattributs[$i]['modeblock'] );
		if ($modeblock) {
			$modeblockrestore = false;
			if (!empty($this->frm_tableattributs[$i]['modeblockrestore'])) {
				$modeblockrestore = $this->frm_tableattributs[$i]['modeblockrestore'];
			}
			$modeblockmsg = '';
			if (!empty($this->frm_tableattributs[$i]['modeblockmessage'])) {
				$modeblockmsg = $this->frm_tableattributs[$i]['modeblockmessage'];
			}
		}
		// ANALYSE SI ON DEMANDE UN NOMBRE MAXI  DE CHOIX
		$limit = -1;
		if (!empty($this->frm_tableattributs[$i]['limit'])) {
			$limit = $this->frm_tableattributs[$i]['limit'];
			if (!empty($this->frm_tableattributs[$i]['limitmessage'])) {
				$limitmsg = $this->frm_tableattributs[$i]['limitmessage'];
			}
		}

		// SI LA BARRE D'OUTILS A ETE DEMANDEE OU SI ON EST EN MODE 'append'
		$toolbar = !empty($this->frm_tableattributs[$i]['toolbar']) || ($mode=="append");

		if (!empty($this->frm_tableattributs[$i]['activation'])) {
			$activation   = $this->frm_tableattributs[$i]['activation'];
		}
		$this->frm_print( '<table border="0" cellspacing="1" cellpadding="0"><tr><td width="*">' );
	    $this->frm_print( "\n\t<select  multiple=\"multiple\" id=\"". $nomobjet ."_LISTE\" " );
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_afficheclasse($i) );
		// ENTER passe au champ suivant au lieu de valider le formulaire
		$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 

		$this->frm_print( ' size="'.$taille.'"' );
		$this->frm_print( $this->_frm_desactivation() );

		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_submit($i);
		$this->_frm_change_etat_boutons();

		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );
		// SI UN SCRIPT EXISTE IL EST AJOUTE ICI
		$nomscript = '';
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$nomscript = $this->frm_tableattributs[$i]['script'];
		} else {
			$nomscript = 'if ('.$objetjavascript.'.MultiSelect_onChange()) { '.$objetjavascript.'.MultiSelect_SaveChange(); }"';
		}
		$this->frm_print( 'onChange="'.$nomscript.'"' );	 
		$this->frm_print( ">" ); 

		// Pour toute les lignes
		$valeurdefautrecherche = ','.$valeurdefaut.',';

        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
			$this->frm_print( "\n\t\t<option value=\"" . $valeur."\"" );
			if ( !(strpos($valeurdefautrecherche ,','.$valeur.',') === false)) {						
			   $this->frm_print( " selected" );
			}
			$this->frm_print( ">$libelle</>" );
		}
	    $this->frm_print( "\n\t</select>\n" );
		$this->frm_print( '</td><td width="*" align="left" valign="top">');
		if ($toolbar) {
			if (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="'.$objetjavascript.'.MultiSelect_InitAll(true);ReactiverBtnValider();PasserEtatAnnuler();">' );
			}
			$this->frm_print( '<img src="'.$icone_select_all.'" width="16" height="16" ' );
			if (!$this->objet_readonly) {
				$this->frm_print( '	title="Tout s&eacute;lectionner" border="0"></a');
			}
			$this->frm_print( '><br>' );
			if (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="'.$objetjavascript.'.MultiSelect_Reset();ReactiverBtnValider();PasserEtatAnnuler();">' );
			}
			$this->frm_print( '<img src="'.$icone_reset.'" width="16" height="16"' );
			if (!$this->objet_readonly) {
				$this->frm_print( ' title="R&eacute;tabir la s&eacute;lection initiale" border="0"></a');
			}
			$this->frm_print( '><br>' );
			if (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="'.$objetjavascript.'.MultiSelect_InitAll(false);ReactiverBtnValider();PasserEtatAnnuler();">' );
			}
			$this->frm_print( '<img src="'.$icone_unselect_all.'" width="16" height="16"' );
			if (!$this->objet_readonly) {
				$this->frm_print( ' title="Effacer la s&eacute;lection" border="0"></a' );
			}
			$this->frm_print( '>' );
		}
		$this->frm_print( '</td></tr></table>' );
		
		$this->frm_print( "\n\t  <!-- Le champ suivant est le champ des valeurs triees\n" );
		$this->frm_print( "\t       Les valeurs sont séparées par des virgules --> \n" );
		$this->frm_print( "\t  <input name=\"".$nomobjet  .'" type="hidden" value="'.$valeurdefaut.'"' );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( "></p>\n" );
	
		// Affichage du script d'initialisation des valeurs selectionnes
		$this->frm_print( "\n\t<!-- CODE JAVASCRIPT d'initialisation de l'objet MultiListe \"".$nomobjet."\" -->\n" );
		$this->frm_print( "\n\t<script language=\"JavaScript\" type=\"text/JavaScript\">" );
		$this->frm_print( "\n\t\t".$objetjavascript." = new MultiSelect('".$nomobjet ."_LISTE','".$nomobjet."');" );	
		if ($this->objet_readonly) {
			$this->frm_print( "\n\t\t".$objetjavascript.".MultiSelect_ModeChange('readonly');" );	
		} else {
			$this->frm_print( "\n\t\t".$objetjavascript.".MultiSelect_ModeChange('".$mode ."');" );	
			if ($modeblock) {
				$lib_br = ($modeblockrestore) ? 'true' : 'false';
				$lib_bm = (empty($modeblockmsg)) ? '' : ",'".addslashes($modeblockmsg)."'";
				$modeblockmsg = '';
				$this->frm_print( "\n\t\t".$objetjavascript.".MultiSelect_ModeBlock(".$lib_br.$lib_bm.");" );	
			}
			if ($limit!=-1) {
				$lib_limit = (empty($limitmsg)) ? '' : ",'".addslashes($limitmsg)."'";
				$this->frm_print( "\n\t\t".$objetjavascript.".MultiSelect_MaxChoice(".$limit.$lib_limit.");" );	
			}
		}
		$this->frm_print( "\n\t</script> \n" );		
	}




	#######################
	# CHAMP CASE A COCHER #
	#######################
    function TraiteCoche($i) {
		$nomboj = "obj".$this->frm_tableobjets[$i];

		$activation      = "";
		if (!empty($this->frm_tableattributs[$i]['activation'])) {
			$activation   = $this->frm_tableattributs[$i]['activation'];
		}
		$noactivation      = "";
		if (!empty($this->frm_tableattributs[$i]['noactivation'])) {
			$noactivation   = $this->frm_tableattributs[$i]['noactivation'];
		}		
		$this->checkbox_valueoff = "0";
		$this->checkbox_valueon  = "1";
		if (!empty($this->frm_tableattributs[$i]['valueon'])) {
			$this->checkbox_valueon   = $this->frm_tableattributs[$i]['valueon'];
		}		
		if (!empty($this->frm_tableattributs[$i]['valueoff'])) {
			$this->checkbox_valueoff  = $this->frm_tableattributs[$i]['valueoff'];
		}		
		
		$this->frm_print( "\n\n\t<!-- CHAMP COCHE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
	    $this->frm_print( "\t<input name='". $this->frm_tableobjets[$i]."' type=\"hidden\" " );

 	    $this->_frm_affichedefaut($i);
		$this->frm_print( ">\n\t<a " );
		$this->_frm_afficheligneaide($i);
		// le script est appelé a chaque changement d'etat
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$this->_frm_evenements_ajouter("onClick",$this->frm_tableattributs[$i]['script'], 0);				
		}		
		// Un click sur la coche réactive le bouton de validation si modifié
		$this->_frm_evenements_ajouter("onClick", "ReactiverBtnValider()", 0);
		// ... et modifier le libellé du texte "Quitter" en "Annuler"
		$this->_frm_evenements_ajouter("onClick", "PasserEtatAnnuler()", 0);

		$this->_frm_evenements_ajouter("onClick", $nomboj.".ogc_click()", 1);		
		$this->_frm_evenements_ajouter("onClick", "ReactiverBtnValider()", 1);		
		// ... et modifier le libellé du texte "Quitter" en "Rétablir"
		$this->_frm_evenements_ajouter("onClick", "MM_setTextOfTextfield('ClassFormAnnulerQuitter','','Rétablir')", 1);		
		
		// Si la table "activation" a été renseignée 
		// alors en fonction de la valeur par defaut (valueon=true,valueoff=false)
		// on active ou non les champs liés
		$listedescoches = "";
		if  ( is_array($activation) ) {
			$chainelistechamps = "";
			for ($nbreactivations=0;$nbreactivations<count($activation);$nbreactivations++) {
				if ( !empty($activation[$nbreactivations]) ) {
					$champatraiter = strtoupper($activation[$nbreactivations]);
					$indice_champ = $this->_frm_trouverindice($champatraiter);					
					// SI L'OBJET EXISTE BIEN
					if ($indice_champ<>-1) {
						// ON VA DETERMINE L'ETAT DE LA COCHE "VRAI" ou "FAUX"
						$caseestcochee = false;
						// analysons la valeur par defaut
						if ( !empty($this->frm_tableattributs[$i]['default'])) {
							$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
							if ( is_bool($valeurpardefaut) ) {
								$caseestcochee = $valeurpardefaut;
							} elseif ( is_string($valeurpardefaut) ) {
								$valeurpardefaut = strtoupper(trim($valeurpardefaut));
								$caseestcochee = ( $valeurpardefaut==$this->checkbox_valueon)  ;
							}
						}
						// SI LE CHAMP A DESACTIVE EST UNE COCHE
						if ($this->frm_typeobjet[$indice_champ]==OBJET_COCHE) {
							$listedescoches .= ",'".$champatraiter."'";
						} else {
							foreach( $this->_frm_tousleschampsdunobjet($champatraiter) as $nomchamp2)
								$chainelistechamps .= ",'".$nomchamp2."'";
						}
						if (!$caseestcochee) {
							// on desactive le champ si la case est decochee
							if (isset($this->frm_tableattributs[$indice_champ]['attrib']))
								$this->frm_tableattributs[$indice_champ]['attrib'] .= "-";
							else
								$this->frm_tableattributs[$indice_champ]['attrib'] = "-";
							// on ajoute le (ou les )champ a la liste des champs a desactiver/reactiver
						}
					} // fin de "si champ valide"
				} 
			} // fin de bloucle "pour tous les elements a activer
			$this->_frm_evenements_ajouter("onClick", "ActiverChampSurCoche('".$this->frm_tableobjets[$i]."'".$chainelistechamps.")", 0);
			if ( !empty($listedescoches) ) {
				$this->_frm_evenements_ajouter("onClick", "ActiverCocheSurCoche('".$this->frm_tableobjets[$i]."'".$listedescoches.")", 0);
			}
			// SI AU MOINS UN ONGLET EXISTE ALORS
			if ($this->objet_onglet>0) {
				$ret = array_search(strtoupper($activation[0]),$this->frm_tableobjets);
				if (!is_bool($ret)) {
					$this->_frm_evenements_ajouter("onClick", "ActiverOngletSurCoche('".$this->frm_tableobjets[$i]."',".$this->frm_tablechamponglet[$ret].")", 0);
				}
			}
		} // fin de traitement d'activation


		// Si la table "noactivation" a été renseignée 
		// alors en fonction de la valeur par defaut (1=true,0=false)
		// on active ou non les champs liés
		$listedescoches = "";
		if  ( is_array($noactivation) ) {
			$chainelistechamps = "";
			for ($nbreactivations=0;$nbreactivations<count($noactivation);$nbreactivations++) {
				if ( !empty($noactivation[$nbreactivations]) ) {
					$champatraiter = strtoupper($noactivation[$nbreactivations]);
					$indice_champ = $this->_frm_trouverindice($champatraiter);					
					if ($indice_champ<>-1) {
						$caseestcochee = false;
						// analysons la valeur par defaut
						if ( !empty($this->frm_tableattributs[$i]['default'])) {
							$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
							if ( is_bool($valeurpardefaut) ) {
								$caseestcochee = $valeurpardefaut;
							} elseif ( is_string($valeurpardefaut) ) {
								$valeurpardefaut = strtoupper(trim($valeurpardefaut));
								$caseestcochee = ( $valeurpardefaut=="TRUE" ) || ( $valeurpardefaut=="1" )  ;
							}
						}
						// SI LE CHAMP A DESACTIVE EST UNE COCHE
						if ($this->frm_typeobjet[$indice_champ]==OBJET_COCHE) {
							$listedescoches .= ",'".$champatraiter."'";
						} else {
							// on ajoute le (ou les )champ a la liste des champs a desactiver/reactiver
							foreach( $this->_frm_tousleschampsdunobjet($champatraiter) as $nomchamp2)
									$chainelistechamps .= ",'".$nomchamp2."'";
						}
						if ($caseestcochee) {
							// on desactive le champ si la case est decochee
							if (isset($this->frm_tableattributs[$indice_champ]['attrib']))
								$this->frm_tableattributs[$indice_champ]['attrib'] .= "-";
							else
								$this->frm_tableattributs[$indice_champ]['attrib'] = "-";
						}
					} // fin de "si champ valide"
				} 
			} // fin de bloucle "pour tous les elements a activer
			$this->_frm_evenements_ajouter("onClick", "DesactiverChampSurCoche('".$this->frm_tableobjets[$i]."'".$chainelistechamps.")", 0);
			if ( !empty($listedescoches) ) {
				$this->_frm_evenements_ajouter("onClick", "DesactiverCocheSurCoche('".$this->frm_tableobjets[$i]."'".$listedescoches.")", 0);
			}

		} // fin de traitement de noactivation

		
		// La ligne suivante doitintervenir apres celle de l'interpretation des des/activations
		$this->frm_print( $this->_frm_style_afficher() );				
		$this->frm_print( $this->_frm_evenements_afficher() );

		$this->frm_print( "\n\t>" );

		$this->frm_print( "\n\t<script>" );
					

		$libactifounon = ($this->objet_readonly  ||  !( strpos($this->objet_attrib,"-") === false ) )  ? 'false' : 'true';
		$this->frm_print( "\n\t\t var ".$nomboj." = new objGraphicCoche('".$this->frm_tableobjets[$i]."',".$libactifounon.",'','".$this->checkbox_valueoff."','".$this->checkbox_valueon."');" );
		$this->frm_print( "\n\t\t ".$nomboj.".ogc_bitmap('".CHEMINRESSOURCES_CF."checkbox/img/','skin".$this->frm_skin."_on.gif','skin".$this->frm_skin."_off.gif','skinX_disabled_on.gif','skinX_disabled_off.gif');" );
		$this->frm_print( "\n\t\t ".$nomboj.".ogc_show();" );
		$this->frm_print( "\n\t</script>" );
		$this->frm_print( "\n\t</a>\n" );

		// ---------------------------------------
		if (!empty($this->frm_tableattributs[$i]['title'])) {
			// Si le champ a été marqué comme "en erreur"
			if (array_key_exists($this->frm_tableobjets[$i],$this->frm_tableerreurs)) {
				$stylelabel   = "classeformslabelerreur";
			} else {
				$stylelabel   = "classeformslabel";
			}
			$this->frm_print( "&nbsp;<span class=\"$stylelabel\">".$this->frm_tableattributs[$i]['title'] . '</span>' );
		}
		$this->frm_print( "\n" );
	}




	
	
	
	#######################
	# CHAMP EDITEUR DHTML #
	#######################
	function TraiteEditeur($i) {

			// Taille X et Y de l'editeur
			$taille_X = 300;
			if (!empty($this->frm_tableattributs[$i]['width'])) {
				// le "px" ne sont pas les bienvenus
				$taille_X = str_replace ("px","",$this->frm_tableattributs[$i]['width'] );
			}
			$taille_Y = 150;
			if (!empty($this->frm_tableattributs[$i]['height'])) {
				$taille_Y = str_replace ("px","",$this->frm_tableattributs[$i]['height'] );
			}	
			$userfilespath = '';
			if (!empty($this->frm_tableattributs[$i]['userfilespath'])) {
				$userfilespath = $this->frm_tableattributs[$i]['userfilespath'];
			}	
			
			$this->frm_print( "\n\n\t<!-- CHAMP EDITEUR DHTML (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type taille x=". $taille_X ." y=". $taille_Y. " -->\n\n" );

			$this->frm_print( "\t<textarea id='".$this->frm_tableobjets[$i]."' name='".$this->frm_tableobjets[$i]."' style=\"width:".$taille_X.";height:".$taille_Y."\">" );
			$this->_frm_affichedefaut($i);	
			$this->frm_print( "</textarea>\n" );

			$this->frm_print( "\t<SCRIPT> \n" );
			$this->frm_print( "\t<!-- \n" );
			$nomobj = $this->frm_tableobjets[$i];

			$this->frm_print( "\t\t// RACINE DU TELECHARGEMENT DES FICHIERS : ");
			if (empty($userfilespath)) {
				$this->frm_print( "NON DEFINI DANS L'ATTRIBUT userfilespath" );
			} else {
				$_SESSION['FCKEDITOR_USERFILESPATH'] = $userfilespath;
				$this->frm_print( "$userfilespath" );
			}
			$this->frm_print( "\n\t\tvar sBasePath = '".CHEMINRESSOURCES_CF.CF_LIBJS_FCKEDITOR."/'; \n" );
			$this->frm_print( "\t\tvar obj".$nomobj." = new FCKeditor( '".$this->frm_tableobjets[$i]."' ) ; \n" );
			$this->frm_print( "\t\tobj".$nomobj.".BasePath = sBasePath ; \n" );


			$this->frm_print( "\t\tobj".$nomobj.".Config['CustomConfigurationsPath'] = '".CHEMINRESSOURCES_CF."FCKeditor_custom/toolbar_config.js' ; \n" );
			if ($this->objet_readonly) {
				$this->skin_name = "readonly";
			}
//			$this->frm_print( "\t\tobj".$nomobj.".Config['SkinPath'] = '".CHEMINRESSOURCES_CF."FCKeditor_custom/".$this->skin_name."/' ; \n" );

			$this->frm_print( "\t\tobj".$nomobj.".ToolbarSet = 'classeForms' ; \n" );
			$this->frm_print( "\t\tobj".$nomobj.".Width = $taille_X ; \n" );
			$this->frm_print( "\t\tobj".$nomobj.".Height = $taille_Y ; \n" );
			$this->frm_print( "\t\tobj".$nomobj.".ReplaceTextarea(); \n" );
			if (!$this->objet_readonly) {
				// INITIALISATION DE L'OBJET PAR JAVASCRIPT
				$this->frm_print( "\t\tsave_".$nomobj." = MM_findObj('".$nomobj."').value; \n" );
				$this->frm_print( "\t\tfunction ".$nomobj."_reset() { \n" );
				$this->frm_print( "\t\t var oEditor = FCKeditorAPI.GetInstance('".$nomobj."') ; \n" );
				// on restore que si l'objet a change
				$this->frm_print( "\t\tif (oEditor.IsDirty()) oEditor.SetHTML(save_".$nomobj.");\n" );
				$this->frm_print( "\t\t}\n" );

			}
				
			$this->frm_print( "\t//--> \n" );
			$this->frm_print( "\t</SCRIPT>\n" );

	}


	########################
	# CHAMP LISTE EDITABLE #
	########################
	function TraiteListeEditable($i) {
		$this->frm_print( "\n\n\t<!-- CHAMP LISTE EDITABLE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
		$nomobjet = $this->frm_tableobjets[$i];

		$taille = "50px";
		if (!empty($this->frm_tableattributs[$i]['width'])) {
			$taille = $this->frm_tableattributs[$i]['width'];
		}
		$stylelisteditable = "font-family:Verdana,Arial,Helvetica,sans-serif; width:".$taille.";font-size: ".$this->taillepolice."px; background-color:";
		// DETERMINATION DE LA COULEUR DU FOND EN FONCTION DE LECTURE SEULE/NORMAL/OBLIGATOIRE
		if ($this->objet_readonly) {
			$stylelisteditable .= "#FFFF";
		} elseif ( strpos($this->objet_attrib,"R") === false ) {
			$stylelisteditable .= $this->couleurchampnormal;
		} else {
			$stylelisteditable .= $this->couleurchampobligatoire;
		}
		// INITIALISATION DES VARIABLES PAR DEFAUT AFFICHEE ET CACHEE
		$valeurpardefaut = "";
		$valeuraffichee  = "";
		if ( !empty($this->frm_tableattributs[$i]['default'])) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['default'];		
			// TESTE SI LA VALEUR PAR DEFAUT EST UN ELEMENT DE LA LISTE PASSEE EN PARAMETRE
			if (isset($this->frm_tablelignes[$i][$valeurpardefaut])) {
				$valeuraffichee = $this->frm_tablelignes[$i][$valeurpardefaut];
				$stylepardefaut = "normal";
			} elseif ( !((array_search($valeurpardefaut, $this->frm_tablelignes[$i])===false)) ) {
				$valeurpardefaut = array_search($valeurpardefaut, $this->frm_tablelignes[$i]);
				$valeuraffichee = $this->frm_tablelignes[$i][ $valeurpardefaut ];
				$stylepardefaut = "normal";				
			} else {
				// SINON ON AFFICHE LA VALEUR EN ITALIQUE
		   		$valeuraffichee = $valeurpardefaut;
				$valeurpardefaut = -1;
				$stylepardefaut = "italic";
			}
			$this->_frm_style_ajouter("font-style:".$stylepardefaut);
		}
		$this->frm_print( "\n\t<script language=\"JavaScript\">" );							
		$this->frm_print( "\n\t\tvar ".$nomobjet."_restrict = 'No';" );
		$this->frm_print( "\n\t\tvar ".$nomobjet."_norec = '50';" );
		$this->frm_print( "\n\t\tvar ".$nomobjet."_style = '".$stylelisteditable."';" );
		$this->frm_print( "\n\t\tvar ".$nomobjet."_edittype = 'E';" );
		$this->frm_print( "\n\t\tvar ".$nomobjet."_el = new Array(\"\"" );
		// Pour toute les lignes du tableau des valeurs
        foreach ( $this->frm_tablelignes[$i] as $valeur => $libelle) {
			$this->frm_print( ",\"$valeur\",\"".addslashes($libelle)."\"" );
		}
		$this->frm_print( ");" );
		$this->frm_print( "\n\t</script>" );

		$this->frm_print( "\n\n\t<!-- Champ de saisie ou modifié par le choix des éléments de la liste -->" );
	    $this->frm_print( "\n\t<input id=\"". $nomobjet ."_EDIT\"  name=\"". $nomobjet ."_EDIT\" " );
		$this->_frm_definitstylewidth($i);
		$this->_frm_affichemaxlength($i);
		$this->frm_print( $this->_frm_afficheclasse($i) );
		$this->_frm_afficheligneaide($i);
		$this->frm_print( $this->_frm_style_afficher() );				
		$this->frm_print( $this->_frm_evenements_afficher() );
		// si une touche est pressée sur le champ Selecteur il ne se passe rien
		$this->_frm_evenements_ajouter("onKeyDown", "return di_inputKeyDown(this,event)", 0);
		$this->_frm_evenements_ajouter("onKeyPress", "return di_inputKeyPress(this,event)", 0);	 
		$this->_frm_evenements_ajouter("onBlur", "di_onBlur(this,event)", 0);	
		$this->_frm_evenements_ajouter("onKeyUp", "autoComplete(this, event)", 0);
		
		// Tous les champs réactivent le bouton de validation si modifié
		$this->_frm_evenements_ajouter("onClick", "ReactiverBtnValider()", 1);		
		// ... et modifier le libellé du texte "Quitter" en "Rétablir"
		$this->_frm_evenements_ajouter("onClick", "MM_setTextOfTextfield('ClassFormAnnulerQuitter','','Rétablir')", 1);		
		$this->_frm_lectureseule($i);
		$this->_frm_change_etat_boutons();
		$this->frm_print( $this->_frm_desactivation() );		
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print( ">" );	

		$this->frm_print( "\n\t<script type=\"text/javascript\">\n" );
		$this->frm_print( "\t\ttextFields.TextValue_set('".$this->frm_tableobjets[$i]."_EDIT','".addslashes($valeuraffichee)."');\n\t</script>\n" );		

		// EN LECTURE SEULE LE BOUTON N'EST PAS AFFICHE
		if (!$this->objet_readonly) {		
			$this->frm_print( "\n\n\t<!-- Bouton pour ouvrir la liste -->" );
			$this->frm_print( "\n\t<input id=\"". $nomobjet ."_V\" name=\"". $nomobjet . "_V\" style=\"font:'Times New Roman','Vernada','serif'; width:20px; height:20px\" value=\"&#9660;\" " );
			$this->frm_print( $this->_frm_desactivation() );
			$this->frm_print( "\n\t\tonfocus=\"di_vFocused('". $nomobjet. "')\"" );
		  	$this->frm_print( "\n\t\tonclick=\"return di_buttonPressed('".$nomobjet."')\" tabIndex=\"-1\" type=\"button\">" );
			$this->frm_print( "\n" );
			$this->frm_print( "\n\n\t<!-- Valeur cachée de la selection -->" );
			$this->frm_print( "\n\t<input id=\"". $nomobjet . "\"  name=\"". $nomobjet ."\" type=\"hidden\" value=\"$valeurpardefaut\"" );
			$this->frm_print( $this->_frm_desactivation() );		
			$this->frm_print( ">" );

			$this->frm_print( "\n\n\t<!-- Valeur sauvegardee du style -->" );
			$this->frm_print( "\n\t<input id=\"". $nomobjet . "_STYLE\" type=\"hidden\" value=\"$stylepardefaut\">" );

		}
	}


	################
	# CHAMP SLIDER #
	##############"#
    function TraiteSlider($i) {

		$orientation_v = false;
		if ( !empty($this->frm_tableattributs[$i]['orientation'])) {
			$orientation_v = ($this->frm_tableattributs[$i]['orientation']=='V');
		} 

		$this->frm_print( "\n\n\t<!-- CHAMP SLIDER (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" mask=\"$this->objet_mask\" -->\n\n" );
		$nomobjetjs = "obj_".$this->frm_tableobjets[$i];
		$this->frm_print( "\t<table border=\"0\"><tr valign=\"bottom\">\n" );
		$this->frm_print( "\t<td>" );		
		// DEFINITION DU SLIDER
		$this->frm_print( "<div id=\"div_". $this->frm_tableobjets[$i] ."\" class=\"slider\" tabIndex=\"1\"" );
		if ($orientation_v) {
			 if (empty($this->frm_tableattributs[$i]['width'])) 
			 	$this->frm_tableattributs[$i]['width'] = 20;
		} else {
			 if (empty($this->frm_tableattributs[$i]['height'])) 
				$this->frm_tableattributs[$i]['height'] = 20;
		}
		$this->_frm_definitstyleheight($i);
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( " > \n" );
		$this->frm_print( "\t<input id=\"". $this->frm_tableobjets[$i] ."_input\" class=\"slider-input\" />\n" );
		$this->frm_print( "\t</div>" );
		$this->frm_print( "</td>\n" );
		
		// DEFINITION DU CHAMP DU SAISI ASSOCIE
		$this->objet_style = "";
		// si "size" n'est pas renseigne alors la largeur est de 50px
		$largeurdef = ( empty($this->frm_tableattributs[$i]['size'])) ? "width:50px;" : "";
		$this->frm_print( "\n\t<td><input id=\"". $this->frm_tableobjets[$i] ."_champ\" name=\"".$this->frm_tableobjets[$i]."\" style=\"".$largeurdef." text-align:right;\" onchange=\"".$nomobjetjs.".setValue(parseInt(this.value))\" " );
		$this->_frm_lectureseule($i);
		$this->_frm_affichedefaut($i);
		$this->_frm_affichesize($i);		
		$this->_frm_afficheligneaide($i);
		$this->frm_print( $this->_frm_desactivation() );
		
		// ENTER passe au champ suivant au lieu de valider le formulaire
		$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 
		// Effacer les blancs en tete et les blancs multiples
		$this->_frm_evenements_ajouter("onBlur"    , "alltrim('" .$this->frm_tableobjets[$i] ."')", 1);
		if ( !( strpos($this->objet_attrib,"B") === false )) 
			$this->_frm_evenements_ajouter("onBlur"    , "pasdeblanc('" .$this->frm_tableobjets[$i] ."')", 0);		
		$this->frm_print( $this->_frm_afficheclasse($i) );
		
		$this->_frm_change_etat_boutons();
		// Retour du style
		$this->frm_print( $this->_frm_style_afficher() );
		// Retour de tous les événements de l'objet		
		$this->frm_print( $this->_frm_evenements_afficher() . "\n" );

		$this->frm_print( "\t/>\n" );
		$this->frm_print( "\t</td></tr></table>\n" );			

		$this->frm_print( "\n\t<script language=\"JavaScript\">" );		
		$this->frm_print( "\n\t\tvar ".$nomobjetjs." = new Slider(document.getElementById(\"div_". $this->frm_tableobjets[$i]."\"), document.getElementById(\"". $this->frm_tableobjets[$i] ."_input\")" );
		// SI ORIENTAION VERTICALE		
		if ( !empty($this->frm_tableattributs[$i]['orientation'])) {
			if ($this->frm_tableattributs[$i]['orientation']=='V') $this->frm_print( ",'vertical'" );
		} 
		$this->frm_print( ");" );
		if  (!$this->objet_readonly) {
			$this->frm_print( "\n\t\t".$nomobjetjs.".onchange = function () { ReactiverBtnValider();PasserEtatAnnuler(); document.getElementById(\"". $this->frm_tableobjets[$i] ."_champ\").value = ".$nomobjetjs.".getValue() };" );
		} else {
			$this->frm_print( "\n\t\t".$nomobjetjs.".onchange = function () { ".$nomobjetjs.".setValue(" );
			if ( !empty($this->frm_tableattributs[$i]['default'])) {
				$this->frm_print( $this->frm_tableattributs[$i]['default'] );
			} 
			$this->frm_print( "); };" );
		}
		
		// BORNE MINIMUM
		$this->frm_print( "\n\t\t".$nomobjetjs.".setMinimum(" );
		if ( !empty($this->frm_tableattributs[$i]['mini'])) {
			$this->frm_print( $this->frm_tableattributs[$i]['mini'] );		
		} else {
			$this->frm_print( "0" );		
		}
		$this->frm_print( ");" );

		// BORNE MINIMUM
		$this->frm_print( "\n\t\t".$nomobjetjs.".setMaximum(" );
		if ( !empty($this->frm_tableattributs[$i]['maxi'])) {
			$this->frm_print( $this->frm_tableattributs[$i]['maxi'] );		
		} else {
			$this->frm_print( "100" );		
		}
		$this->frm_print( ");" );
		$this->frm_print( "\n\t</script>\n" );

	}



	###############
	# CHAMP POPUP #
	###############
    function TraiteChampPopup($i) {
	
		// 2 cas possibles : la valeur de retour doit etre un 'id' ou une valeur 'value'
		$id_en_retour = true;
		if ( !empty($this->frm_tableattributs[$i]['return'])) {
			$id_en_retour = !($this->frm_tableattributs[$i]['return']=='value');
		} 
		if ($id_en_retour) {
			$nomchampvisible = $this->frm_tableobjets[$i].'_VIEW';
			$this->frm_print( "\n\n\t<!-- CHAMP TEXTE/POPUP ET RETOUR ID (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" mask=\"$this->objet_mask\" -->\n\n" );
			$this->frm_print( "\t<input name=\"" . $this->frm_tableobjets[$i]."\" type=\"hidden\" " );
			if ( isset($this->frm_tableattributs[$i]['defaultview']) ) {
				$this->_frm_affichedefaut($i);
			}
			$this->frm_print( ">\n\n" );

		} else {
			$nomchampvisible = $this->frm_tableobjets[$i];
			$this->frm_print( "\n\n\t<!-- CHAMP TEXTE/POPUP ET RETOUR VALUE (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" mask=\"$this->objet_mask\" -->\n\n" );
		}
		
		
	    $this->frm_print( "\t<input type=\"text\" id=\"". $nomchampvisible ."\"" );
		if (!$id_en_retour) $this->frm_print( " name=\"" . $nomchampvisible . "\"" );
		$this->_frm_lectureseule($i);
		if ($id_en_retour) {
			if ( isset($this->frm_tableattributs[$i]['defaultview']) ) {
			    $this->frm_print( ' value="'. htmlspecialchars($this->frm_tableattributs[$i]['defaultview']) . '" ' );			
			}
		    $this->frm_print( ' readonly="true" ' );			
		} else {
			$this->_frm_affichedefaut($i);
		}
		$this->_frm_afficheligneaide($i);
		$this->_frm_affichesize($i);
		$this->_frm_affichemaxlength($i);
		$this->_frm_affichenumerique($i);
		$this->_frm_affichemasque($i);
		$this->_frm_definitstyletransform($i);
		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_desactivation() );
		
		// ENTER passe au champ suivant au lieu de valider le formulaire
		$this->_frm_evenements_ajouter("onKeyPress", "return handleEnter(this,event)", 0);	 
		// Effacer les blancs en tete et les blancs multiples
		$this->_frm_evenements_ajouter("onBlur"    , "alltrim('" .$this->frm_tableobjets[$i] ."')", 1);
		if ( !( strpos($this->objet_attrib,"B") === false )) 
			$this->_frm_evenements_ajouter("onBlur"    , "pasdeblanc('" .$this->frm_tableobjets[$i] ."')", 0);		
		$this->frm_print( $this->_frm_afficheclasse($i) );
		
		$this->_frm_change_etat_boutons();
		$this->_frm_submit($i);
		// Retour du style
		$this->frm_print( $this->_frm_style_afficher() );
		// Retour de tous les événements de l'objet		
		$this->frm_print( $this->_frm_evenements_afficher() . ">\n" );
		
		// BOUTON d'appel a la fenetre popup
		$this->frm_print( "\n\t<input type=\"button\" id=\"".$this->frm_tableobjets[$i]."_BTN\" class=\"classeformslabel\" value=\"...\"  " );
		if  ($this->objet_readonly) {
			$this->frm_print( " disabled=\"true\" " );
		} else {
		    $this->_frm_evenements_raz();
			$this->_frm_evenements_ajouter("onClick", $this->frm_tableobjets[$i]."_Click();return false", 0);	 
			$this->_frm_evenements_ajouter("onFocus", "ReactiverBtnValider();PasserEtatAnnuler();return false", 0);	 
			$this->frm_print( $this->_frm_evenements_afficher() );
			$this->frm_print( $this->_frm_desactivation() );
			if (!empty($this->objet_attrib)) {
				if ( !( strpos($this->objet_attrib,"-") === false )) {
				    $this->frm_print( " disabled=\"true\" " );
				}
			}
		}
		$this->frm_print( ">" );
	}


	
	###########################
	# CHAMP SELECTEUR D'ICONE #
	###########################
    function TraiteChampIcone($i) {
		$libicone = "Cliquer ici pour choisir une autre image";
		// la valeur de retour doit etre le nom du fichier image selectionne
		$this->frm_print( "\n\n\t<!-- CHAMP TEXTE/POPUP ET RETOUR ID (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type attrib=\"$this->objet_attrib\" mask=\"$this->objet_mask\" -->\n\n" );
		$this->frm_print( "\t<input name=\"" . $this->frm_tableobjets[$i]."\" type=\"hidden\" " );
		$this->_frm_affichedefaut($i);
		$this->frm_print( ">\n\n" );

		$chemin_icone = "";
		if (!empty($this->frm_tableattributs[$i]['path'])) {
			$chemin_icone = $this->frm_tableattributs[$i]['path'];
		}
		$nom_icone = "";
		if (!empty($this->frm_tableattributs[$i]['default'])) {
			$nom_icone = $this->frm_tableattributs[$i]['default'];
		} else {
			$libicone = "Cliquer ici pour choisir une image";
		}
		// AFFICHAGE DE L'IMAGE CLIQUABLE
		$nomchampvisible = $this->frm_tableobjets[$i]."_IMG";
		if (!$this->objet_readonly) {
			// Affichage de la fleche gauche
			$this->frm_print( "\t<img  name='".$this->frm_tableobjets[$i]."_al' src='".CHEMINRESSOURCES_CF."images/al.gif'>\n" );
		    $this->frm_print( "\t<a href=\"#\" id=\"".$this->frm_tableobjets[$i]."_BTN\" " );
			$this->_frm_affichedefaut($i);	
			$this->_frm_change_etat_boutons();
			// Retour de tous les événements de l'objet
			$this->_frm_evenements_ajouter("onClick", $this->frm_tableobjets[$i]."_Click();return false", 0);	 
 			$this->_frm_evenements_ajouter("onMouseOver","MM_swapImage('".$this->frm_tableobjets[$i]."_al','','".CHEMINRESSOURCES_CF."images/al_a.gif','".$this->frm_tableobjets[$i]."_ar','','".CHEMINRESSOURCES_CF."images/ar_a.gif',0)", 0);	 
			$this->_frm_evenements_ajouter("onMouseOut", "MM_swapImage('".$this->frm_tableobjets[$i]."_al','','".CHEMINRESSOURCES_CF."images/al.gif','".$this->frm_tableobjets[$i]."_ar','','".CHEMINRESSOURCES_CF."images/ar.gif',0)", 0);	 

			$this->frm_print( $this->_frm_evenements_afficher() . ">\n" );
		}
		$nom_icone = basename($nom_icone);
		$this->frm_print( "\t   <img src='".$chemin_icone.$nom_icone."' id='". $nomchampvisible ."' name='" . $nomchampvisible . "' border='0' " );
		// AFFICHAGE SI PRECISE DE LA LARGEUR ET LA HAUTEUR STANDARD DE L'IMAGE
		if (!empty($this->frm_tableattributs[$i]['width'])) {
			$this->frm_print( " width='". $this->frm_tableattributs[$i]['width'] . "'" );
		}
		if (!empty($this->frm_tableattributs[$i]['height'])) {
			$this->frm_print( " height='". $this->frm_tableattributs[$i]['height'] . "'" );
		}


		if (!$this->objet_readonly) $this->frm_print( "title=\"".$libicone."\"" );		
		$this->frm_print( ">" );
		if (!$this->objet_readonly) {
			$this->frm_print( "</a>\n" );
			// Affichage de la fleche droite
			$this->frm_print( "\t<img name='".$this->frm_tableobjets[$i]."_ar' src='".CHEMINRESSOURCES_CF."images/ar.gif'>\n" );
		}

	}

	#######################
	# CHAMP ARBRE DHTML #
	#######################
	function TraiteChampArbre($i) {

			// Taille X et Y de l'editeur
			$taille_X = 300;
			if (!empty($this->frm_tableattributs[$i]['width'])) {
				// le "px" ne sont pas les bienvenus
				$taille_X = str_replace ("px","",$this->frm_tableattributs[$i]['width'] );
			}	
			$taille_Y = 50;
			if (!empty($this->frm_tableattributs[$i]['height'])) {
				$taille_Y = str_replace ("px","",$this->frm_tableattributs[$i]['height'] );
			}	
			if (!empty($this->frm_tableattributs[$i]['title'])) {
				$TitreDeLaRacine = $this->frm_tableattributs[$i]['title'];
			} else {
				$TitreDeLaRacine = "";
			}
			if (isset($this->frm_tableattributs[$i]['default'])) {
				$valdef = $this->frm_tableattributs[$i]['default'];
			} else {
				$valdef = "";
			}				
			$lignes = "true";
			if (!empty($this->frm_tableattributs[$i]['lines'])) {
				$lignes = strtolower($this->frm_tableattributs[$i]['lines']);
			}				

			$selecteur_racine = false;
			if (!empty($this->frm_tableattributs[$i]['rootselector'])) {
				$selecteur_racine = ( $this->frm_tableattributs[$i]['rootselector'] == "true" );
			}						

			// LES ICONES PERSONALISEES
			$iconroot = "";
			if (!empty($this->frm_tableattributs[$i]['iconroot'])) {
				$iconroot = $this->frm_tableattributs[$i]['iconroot'];
			}		
			$icondiropened = "";
			if (!empty($this->frm_tableattributs[$i]['icondiropened'])) {
				$icondiropened = $this->frm_tableattributs[$i]['icondiropened'];
			}
			$icondirclosed = "";
			if (!empty($this->frm_tableattributs[$i]['icondirclosed'])) {
				$icondirclosed = $this->frm_tableattributs[$i]['icondirclosed'];
			}
			
			$this->frm_print( "\n\n\t<!-- CHAMP ARBRE DHTML (".$this->frm_tableobjets[$i].") : objet n°$i type=$this->objet_type taille x=". $taille_X ." y=". $taille_Y. " -->\n\n" );
			$this->frm_print( "<script type=\"text/javascript\"> \n" );
			$this->frm_print( "<!-- \n" );
			$this->frm_print( "// DEFINITION DE L'ARBRE DHTML\n" );
			if (!$this->objet_readonly) {
				$this->frm_print( "function SaveTree_t$i(newText) { \n" );
				$this->frm_print( "  var obj = MM_findObj('".$this->frm_tableobjets[$i]."'); \n" );
				$this->frm_print( "  if (obj) obj.value = newText; \n" );
				$this->frm_print( "  ReactiverBtnValider(); \n" );
				$this->frm_print( "  PasserEtatAnnuler(); \n" );
				$this->frm_print( "} \n\n" );
			}
			// CREATION DE L'ARBRE

			$this->frm_print( "\nt$i = new dTree('t$i',1);" );
			$this->frm_print( "\nt$i.config.useCookies = false;" );	
			$this->frm_print( "\nt$i.icondirectory('".CHEMINRESSOURCES_CF."dtree/img/');" );
			$this->frm_print( "\nt$i.config.closeSameLevel=true;" );
			if (!empty($iconroot))
				$this->frm_print( "\nt$i.icon.root = '".$iconroot."';" );
			$this->frm_print( "\nt$i.config.useLines=".$lignes.";\n" );
			$this->frm_print( "\nt$i.config.useStatusText=true;\n" );
			if ($this->objet_readonly)
				$this->frm_print( "\nt$i.config.readOnly=true;\n" );

			// CREATION DE LA RACINE
			$this->frm_print( "t$i.add(0,-1,'".addslashes($TitreDeLaRacine)."'" );
			if ($selecteur_racine) {
				$this->frm_print( ",'javascript:SaveTree_t$i(0)'" );
			}
			$this->frm_print( "); \n" );


			
			
			
			foreach ( $this->frm_tablelignes[$i] as $table_element) {
				$tt = array();
				foreach ($table_element as $indice => $valeur) {
					array_push($tt, $valeur);
				}
				$this->frm_print( "t$i.add(".$tt[0].",".$tt[2].",'".addslashes($tt[1])."','" );
				if ($this->objet_readonly) {
					if (!empty($valdef) ) 
						$this->frm_print( "javascript:t$i.closeAll();t$i.openTo($valdef, true)" );
					else
						$this->frm_print( "#" );
				} else
					$this->frm_print( "javascript:SaveTree_t$i(".$tt[0].")" );
		
	
				$iconcloded = (isset($tt[3])) ? $tt[3] : $icondirclosed;
				$iconopened = (isset($tt[4])) ? $tt[4] : $icondiropened;
				$this->frm_print( "','','','".$iconcloded."','".$iconopened."');\n" );
			}
			$this->frm_print( "//--> \n" );
			$this->frm_print( "</script>\n" );

			// CHAMP CACHE QUI CONTIENT LA VALEUR EN RETOUR
			$this->frm_print( "\n\t<input name=\"" . $this->frm_tableobjets[$i]."\" type=\"hidden\" value=\"". htmlspecialchars($valdef)."\">\n" );

			// OUVERTURE DU TABLEAU
			$this->frm_print( '<table width="'.$taille_X.'" height="'.$taille_Y.'" border="1" cellpadding="5" cellspacing="0" style="border: thin inset;" bgcolor="' );
			
			if (!$this->objet_readonly) {
				if ( !( strpos($this->objet_attrib,"R") === false )) 
					$this->frm_print( $this->couleurchampobligatoire );
				else
					$this->frm_print( $this->couleurchampnormal );
			} else {
				$this->frm_print( "\" style=\"cursor: crosshair;\"" );
			}

			$this->frm_print( "\">\n\t<tr><td align=\"left\" valign=\"top\" nowrap>" );
			// AFFICHAGE DE L'ARBRE
			$this->frm_print( "\n<script type=\"text/javascript\">" );
			$this->frm_print( "\n\t<!--" );
			$this->frm_print( "\n\t // Afficher l'objet javascript de l'arbre" );
			$this->frm_print( "\n\t document.write(t$i);" );
			if ( isset($valdef) && strlen($valdef)>0 ) {
				$this->frm_print( "\n\t // pointer l'element $valdef" );
				$this->frm_print( "\n\t t$i.openTo($valdef, true); " );
			}
			$this->frm_print( "\n\t-->" );
			$this->frm_print( "\n</script>\n" );

			// FERMETURE DU TABLEAU	
			$this->frm_print( "\n  </td></tr>\n</table>" );
	}


	###############
	# CHAMP TIMER #
	###############
    function TraiteTimer($i) {
	
		$this->frm_print( "\n\n\t<!-- CHAMP TIMER (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
		$this->frm_print( "\t<input id=\"".$this->frm_tableobjets[$i]."_VIEW\" type=\"text\" readonly=\"true\"  class=\"classeformschampreadonly\" " );
		$this->_frm_affichedefaut($i);
		$this->_frm_style_ajouter("font-family: 'Courier New', Courier, mono; font-size: 12px; 	text-align:center; 	font-weight:bold;");
		$this->_frm_definitstylewidth($i);
		
		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( ">\n" );
		if (!empty($this->frm_tableattributs[$i]['icon'])) {
			if ( !($this->frm_tableattributs[$i]['icon'] === "false") ) {
				if (!$this->objet_readonly) {
					$this->frm_print( "\t<img src='".CHEMINRESSOURCES_CF."timer/sablier_a.gif'>\n" );
				}
			}
		}		
		$this->frm_print( "\t<input name=\"".$this->frm_tableobjets[$i]."\" type=\"hidden\" value=\"\">\n" );
		if (!$this->objet_readonly) {
			$this->frm_print( "\t<script><!--\n\t\t".$this->objet_timer_nom."_show();  \n\t-->\n\t</script>\n" );
		}

		
	}



	#####################
	# CHAMP COLORPICKER #
	#####################
    function TraiteColorPicker($i) {
	
		$picker_background = false;
		if (!empty($this->frm_tableattributs[$i]['target'])) {
			if ( !($this->frm_tableattributs[$i]['target'] === "text") ) {
				$picker_background = true;
			}
		}		
		$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
		$this->frm_print( "\n\n\t<!-- CHAMP COLORPICKER (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
		$this->frm_print( "\t<input name=\"".$this->frm_tableobjets[$i]."\" id=\"".$this->frm_tableobjets[$i]."\" type=\"text\" readonly=\"true\" " );
		$this->frm_print( $this->_frm_desactivation() );

		$this->_frm_style_ajouter("font-family: 'Courier New', Courier, mono; font-size: 11px; 	text-align:center; 	font-weight:bold; border:thin outset;");
		// LE STYLE DU CHAMP EST AFFECTE PAR LA COULEUR DU FOND OU DU TEXTE
		if ($picker_background) {
			$this->_frm_style_ajouter("background-color: #".$valeurpardefaut);
		} else {		
			if ( !isset($this->frm_tableattributs[$i]['default']) ) $this->frm_tableattributs[$i]['default'] = "000000";
			if ( empty($this->frm_tableattributs[$i]['default']) )  $this->frm_tableattributs[$i]['default'] = "000000";	
			$this->_frm_style_ajouter("color: #".$this->frm_tableattributs[$i]['default']);
		}


		
		$this->_frm_affichedefaut($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_affichesize($i);

		$this->_frm_definitstylewidth($i);

		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print( ">\n" );
		
		if ($this->objet_readonly) {
			$icone_colorpicker = ($picker_background) ? "color_bg_off.gif" : "color_text_off.gif";
			$this->frm_print( "\t<img src='".CHEMINRESSOURCES_CF."colorpicker/".$icone_colorpicker."'>\n" );
		} else {
			$icone_colorpicker = ($picker_background) ? "color_bg.gif" : "color_text.gif";

			$this->frm_print( "\t<a href=\"javascript:ReactiverBtnValider();PasserEtatAnnuler();".$this->frm_tableobjets[$i]."_Click();\">" );
			$this->frm_print( "<img src='".CHEMINRESSOURCES_CF."colorpicker/".$icone_colorpicker."' border='0' title='Choisir une couleur dans la palette'></a>\n" );
		}
	}

	#####################
	# CHAMP UPLOADER    #
	#####################
    function TraiteUploader($i) {
		define('UPLOADER_MULTIFILES_SIZE',8);
		$nomobjet = $this->frm_tableobjets[$i];
		$multifiles = false;
		$multisort  = false;
		// on analyse et formate le paramatrage simple/multi fichier(s)
		if (!empty($this->frm_tableattributs[$i]['multifiles'])) {
			$multifiles = $this->frm_tableattributs[$i]['multifiles'];
			if (!empty($this->frm_tableattributs[$i]['multifilesmax'])) {
				$multifilesmax = $this->frm_tableattributs[$i]['multifilesmax'];
			} else {
				$multifilesmax = $this->frm_tableattributs[$i]['multifilesmax'] = -1;
			}
			// si le nombre de fichier maxi est =1, la close "multifiles" est annuléee
			if ( $multifilesmax==1 || $multifilesmax==0)  {
				$this->frm_tableattributs[$i]['multifiles'] = false;
			}
			if 	(empty($this->frm_tableattributs[$i]['size'])) {
				$this->frm_tableattributs[$i]['size'] = UPLOADER_MULTIFILES_SIZE;
			}
			if 	(!empty($this->frm_tableattributs[$i]['multisort'])) {
				$multisort = ($this->frm_tableattributs[$i]['multisort']);
			}

		} else {
			$this->frm_tableattributs[$i]['multifiles'] = false;
		}
		
		$prefix = "";
		if ( !empty($this->frm_tableattributs[$i]['prefix'])) {
			$prefix = $this->frm_tableattributs[$i]['prefix'];
		}
		$target = "";
		if (!empty($this->frm_tableattributs[$i]['target'])) {
			$target = $this->frm_tableattributs[$i]['target'];
		} else {
			echo '<b>ATTENTION L\'Objet Uploader "'.$nomobjet.'"</b> a besoin du parametre "target"';
			exit; 
		}
		$preview = false;
		if (!empty($this->frm_tableattributs[$i]['preview'])) {
			$preview = $this->frm_tableattributs[$i]['preview'];
		}		

		$this->objet_readonly =  !( strpos($this->objet_attrib,"+") === false ) || $this->objet_readonly;
		$this->frm_print( "\n\n\t<!-- CHAMP UPLOADER (".$this->frm_tableobjets[$i].") : objet n°$i  type=$this->objet_type attrib=\"$this->objet_attrib\" -->\n\n" );
		// champ qui contient le chemin complet (il est cache)
		$this->frm_print( "\t<input name=\"".$nomobjet."\" type=\"hidden\"" );
		$this->frm_print( $this->_frm_desactivation() );
		$this->frm_print( ">\n" );

		$this->frm_print('<table border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">');
		if ($multifiles) {
			$sautligne = '<br>&nbsp;';
			$this->frm_print( "\n\t<!-- UPLOADER MULTI-FICHIERS : LISTE -->\n" );
			$this->frm_print( "\t<select id=\"".$nomobjet."_VIEW\" OnClick=\"ReactiverBtnValider();PasserEtatAnnuler();\"" );			
		} else {			
			$sautligne = '';
			$this->frm_print( "\n\t<!-- UPLOADER SIMPLE FICHIER : SIMPLE CHAMP TEXTE -->\n" );
			$this->frm_print( "\t<input id=\"".$nomobjet."_VIEW\" type=\"text\" readonly=\"true\" " );
		}
		$this->_frm_lectureseule($i);
		$this->_frm_afficheligneaide($i);
		$this->_frm_affichesize($i);

		$this->_frm_definitstylewidth($i);
		$this->frm_print( $this->_frm_desactivation() );


		$this->frm_print( $this->_frm_style_afficher() );
		$this->frm_print( $this->_frm_evenements_afficher() );
		$this->frm_print( $this->_frm_afficheclasse($i) );
		
		$this->frm_print( ">\n\n" );
		// fermeture de la liste
		if ($multifiles) {
			$this->frm_print( "\t</select>\n" );			
		}
		$this->frm_print('</td><td valign="top">');

		$this->frm_print( "\t<script type=\"text/javascript\">\n" );

		$filename = '';	
		if (!empty($this->frm_tableattributs[$i]['default'])) {
			$filename = $this->frm_tableattributs[$i]['default'];
		}
		// initialisation des champs par défaut
		if ( !empty($filename) ) { 
			$this->frm_print( "\t\ttextFields.TextValue_set('".$nomobjet."','".addslashes($filename)."');\n" );
			if ($multifiles) {
				$nomobjet_js = 'oUploaderList_'.$nomobjet;
				$this->frm_print( "\t\t".$nomobjet_js." = new Uploader_MultiFiles_init('".$nomobjet."','".$prefix."');\n" );
				$this->frm_print( "\t\t".$nomobjet_js.".MultiFiles_set();\n" );
			} else {
				$this->frm_print( "\t\ttextFields.TextValue_set('".$nomobjet."_VIEW','".addslashes(substr($filename,strlen($prefix)))."');\n" );
			
			}
		}
		$this->frm_print( "\t\tSaveFields.SaveFieldValue_add('".$nomobjet."');\n");
		$this->frm_print( "\t\tSaveFields.SaveFieldValue_add('".$nomobjet."_VIEW');\n");
		$this->frm_print( "\t</script>\n" );

		
		
		$off = ($this->objet_readonly) ? 'off_' : '';
		$icone_file_new    = $off."file_new.gif";
		$icone_file_delete = $off."file_delete.gif";
		$icone_file_view   = $off."file_view.gif";
		$icone_file_up     = $off."file_up.gif";
		$icone_file_down   = $off."file_down.gif";
		// comportement particulier du "preview" : on peut avoir un preview sur un MONO uploader en lecture seule si un nom de fichier existe
		$preview_actif = (!$this->objet_readonly || (!$multisort && $this->objet_readonly && !empty($filename)));
		if  ($preview_actif) {
			$icone_file_view   = "file_view.gif";
		} else {
			$icone_file_view   = "off_file_view.gif";
		}

		$nomobjbtn = "objbtn_".$this->frm_tableobjets[$i];
		$this->frm_print( "\t<!-- UPLOADER : BOUTONS DE COMMANDE -->\n" );
		print "&nbsp;";
		if ($multisort ) {
			// affichage de la fleche vers le haut
			if (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$nomobjbtn.'.Command_up()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
			}
			$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'uploader/'.$icone_file_up.'"' );
			if (!$this->objet_readonly) {
				$this->frm_print( ' border="0" title="Monter le fichier dans la liste"></a' );
			}
			$this->frm_print( '>&nbsp;'.$sautligne );
		}
			// affichage du bouton AJOUTER
		if (!$this->objet_readonly) {
			$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$nomobjbtn.'.Command_add()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
		}	
		$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'uploader/'.$icone_file_new.'"' );
		if (!$this->objet_readonly) {
			$this->frm_print( ' border="0" title="Ajouter un fichier"></a' );
		}
		$this->frm_print( '>&nbsp;'.$sautligne );
		if (!$this->objet_readonly) {
			$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$nomobjbtn.'.Command_delete()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
		}
		$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'uploader/'.$icone_file_delete.'"' );
		if (!$this->objet_readonly) {
			$this->frm_print( ' border="0" title="Effacer le fichier sélectionné"></a' );
		}
		$this->frm_print( '>&nbsp;'.$sautligne );

		if ($preview) {
			if ($preview_actif) {
				$this->frm_print( '<a href="javascript:void(0)" onMouseOver="objShadowToolTips.showTooltip(event,'.$nomobjbtn.'.Command_Preview());" onMouseOut="objShadowToolTips.hideTooltip();">' );
			}
			$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'uploader/'.$icone_file_view.'"' );
			if ($preview_actif) {
				$this->frm_print( ' border="0"></a>' );
			}
			$this->frm_print( $sautligne );
		}
		if ($multisort ) {
			// affichage de la fleche vers le bas
			if (!$this->objet_readonly) {
				$this->frm_print( '<a href="javascript:void(0)" onClick="if ('.$nomobjbtn.'.Command_down()) { ReactiverBtnValider(); PasserEtatAnnuler(); }">' );
			}
			$this->frm_print( '<img src="'.CHEMINRESSOURCES_CF.'uploader/'.$icone_file_down.'"' );
			if (!$this->objet_readonly) {
				$this->frm_print( ' border="0" title="Descendre le fichier dans la liste"></a' );
			}
			$this->frm_print( '>'.$sautligne );
		}
		
		// CREATION DE L'OBJET JAVASCRIPT
		$this->frm_print( "\n\n\t<script type=\"text/javascript\">\n\t<!--" );
		$this->frm_print( "\n\t\t // DEFINITION DU BLOC DE BOUTONS DE COMMANDE DE L'UPLOADER" );
		$nomobj    = "objpopup_".$this->frm_tableobjets[$i];
		$nomobjbtn = "objbtn_".$this->frm_tableobjets[$i];
		$prefix    = '';

		// CREATION DE LA CHAINE DE PARAMETRES "GET"
		if ( !empty($this->frm_tableattributs[$i]['url'])) {
			$params = '';
			if ( !empty($this->frm_tableattributs[$i]['prefix'])) {
				$prefix = $this->frm_tableattributs[$i]['prefix'];
				$params .= '&PREFIX='.$prefix;
			}
			if ( !empty($this->frm_tableattributs[$i]['overwrite'])) {
				if ($this->frm_tableattributs[$i]['overwrite']) {
					$params .= '&OVERWRITE=YES';
				}
			}
			// ANALYSONS SI L'IMAGE VA ETRE REDIMENSIONNEE
			$is_resized = false;
			if ( !empty($this->frm_tableattributs[$i]['resize_to'])) {
				$params     .= '&RESIZE_TO='.$this->frm_tableattributs[$i]['resize_to'];
				$is_resized  = true;
			} else {
				if ( !empty($this->frm_tableattributs[$i]['resize_x_to'])) {
					$params     .= '&RESIZE_X_TO='.$this->frm_tableattributs[$i]['resize_x_to'];
					$is_resized  = true;
				}
				if ( !empty($this->frm_tableattributs[$i]['resize_y_to'])) {
					$params     .= '&RESIZE_Y_TO='.$this->frm_tableattributs[$i]['resize_y_to'];
					$is_resized  = true;
				}
			}
			// ET SI OUI, ALORS SI ON CREE UNE VIGNETTE EN MEME TEMPS OU QUE C'EST L'ORIGINAL QUI EST REDIMENSIONNE
			if ($is_resized) {
				if ( !empty($this->frm_tableattributs[$i]['resize_prefix'])) {
					$params     .= '&RESIZE_PREFIX='.$this->frm_tableattributs[$i]['resize_prefix'];
					$is_resized  = true;
				}
			}
			
			if ($this->frm_tableattributs[$i]['multifiles']) {
					$params .= '&MULTIFILESMAX='.$this->frm_tableattributs[$i]['multifilesmax'];
			}
			$this->frm_print( "\n\t\t var Uploader_urlbase='".$this->frm_tableattributs[$i]['url']. "?RETURNFIELD=".$this->frm_tableobjets[$i]."&CLASS=".substr($this->couleurchampnormal,1).$params."';" );
		} else {
			$this->frm_print( "\n\t\t $nomobj.populate(\"<B>ATTENTION :<br>frm_ObjetUploader()</b> doit contenir un paramètre 'url'\");" );
		}

		$this->frm_print( "\n\t\t var $nomobjbtn = new Uploader_Command_init('".$this->frm_tableobjets[$i]."',Uploader_urlbase);" );
		// SI L'OBJET UPLOADER EST MULTI FICHIER
		if ($this->frm_tableattributs[$i]['multifiles']) {
			$this->frm_print( "\n\t\t ".$nomobjbtn.".Command_MultiFiles(".$this->frm_tableattributs[$i]['multifilesmax'].");" );
		}
		// SI L'OBJET UPLOADER CONTIENT UN OBJET PREVIEW
		if ($this->frm_tableattributs[$i]['preview']) {
			$this->frm_print( "\n\t\t ".$nomobjbtn.".Command_Preview_init('".$this->frm_tableattributs[$i]['target']."','".$prefix."');" );
		}	
		$this->frm_print( "\n\t-->\n\t</script>\n\n" );
			

		$this->frm_print('</td></tr></table>');

	}




	################ FIN DE DEFINITION DES OBJETS ##################
	
	
	
	
	
	// INITIALISE LES PARAMETRES D'UPLOAD
	function frm_Uploader( $attributs=array() ) {

		// DESACTIVATION DES WARNING
		error_reporting(0);

		// ANALYSE DES PARAMETRES

		// PARAMETRE ARCHI-OBLIGATOIRE LE REPERTOIRE DE DESTINATION 
		// Si non renseigner on arret tout !
		if ( empty($attributs['target'])) {
			print "<b>ATTENTION</b> : frm_Uploader() doit contenir OBLIGATOIREMENT le parametre 'target'<br>";
			exit;
		}
		$target_dir= $attributs['target'];

		// ------------ NOM DES EXTENSIONS AUTORISEES (PAR DEFAUT LES IMAGES)
		if ( !empty($attributs['extensions'])) {
			$file_type = strtoupper($attributs['extensions']);
		} else {
			$file_type = "GIF|PNG|JPG|JPEG";
		}

		// ------------ NOM DE LA FENETRE APPELANTE
		if ( !empty($attributs['opener'])) {
			$opener = $attributs['opener'];
		} else {
			$opener = "";
		}

		// ------------ NOM DU TITRE DE LA FENETRE
		if ( !empty($attributs['title'])) {
			$title = $attributs['title'];
		} else {
			$title = "Sélectionnez un fichier";
		}
		// ------------ TAILLE MAXIMUM DU FICHIER
		if ( !empty($attributs['maxfilesize'])) {
			$maxfilesize = (integer) $attributs['maxfilesize'];
		} else {
			$maxfilesize = 1048576;
		}

		// ------------ EFFACEMENT PHYSIQUE DES FICHIERS
		$delete = false;
		if ( !empty($attributs['delete'])) {
			$delete = $attributs['delete'];
		}

		// ------------ FILTRAGE DES CARACTERES SPECIAUX
		$filtrage_carac = true;
		if ( !empty($attributs['filter'])) {
			$filtrage_carac = $attributs['filter'];
		}
		
		// ------------ REMPLACEMENT DES ESPACES PAR UN CARACTERE SPECIFIQUE
		$space_with = ' ';
		if ( isset($attributs['space'])) {
			$space_with = $attributs['space'];
		}
		$resize_to   = $_REQUEST['RESIZE_TO'];
		$resize_x_to = $_REQUEST['RESIZE_X_TO'];
		$resize_y_to = $_REQUEST['RESIZE_Y_TO'];
		$resise_msg  = '';
		$resizing = !empty($resize_x_to) || !empty($resize_y_to) || !empty($resize_to);
		$resizing_mode = -1;
		if (!empty($resize_to)) {
			$resise_msg = 'Bord le plus long fixé à '.$resize_to.' pixels';
			$resizing_mode = 1;
		} elseif (!empty($resize_x_to)) {
			$resise_msg = 'Largeur fixée à '.$resize_x_to.' pixels';
			$resizing_mode = 2;
		} elseif (!empty($resize_y_to)) {
			$resise_msg = 'Hauteur fixée à '.$resize_y_to.' pixels';
			$resizing_mode = 3;
		}
		$resizing_original_file = $resizing && empty($_REQUEST['RESIZE_PREFIX']);
		
		$overwrite = ( !empty($_REQUEST['OVERWRITE']));

							
		$erreur     = -1;
		$lib_erreur = '';
		$files_type = '';
		$file_is_image = false;
		$resume_action = '';
		if( isset($_POST['MAX_FILE_SIZE']) ) { // si formulaire soumis 
			// CAS D'UN AJOUT
			if ($_REQUEST['ACTION']=='ADD') {
			    $tmp_file  = $_FILES['FILE_NAME']['tmp_name'];
			    $name_file = stripslashes($_FILES['FILE_NAME']['name']);
			    $size_file = $_FILES['FILE_NAME']['size'];
			    $files_type = strtolower($_FILES['FILE_NAME']['type']);
				
				/* Ultime test pour le redimensionnement :
				 - la fonction GD doit exister
				 - le type d'image doit etre autorise
				 */
				$file_is_image = ($files_type=='image/jpg' || $files_type=='image/jpeg' || $files_type=='image/pjpeg');
				$resizing = $resizing && function_exists('imagecopyresampled') && $file_is_image;



			    if( !is_uploaded_file($tmp_file) ) {
			        $erreur = 1;
					$lib_erreur = "Le fichier n'a pas été chargé dans le fichier temporaire $tmp_file";
			    } else if ( !preg_match('@\.('.$file_type.')$@i',$name_file ) || preg_match('[\x00|\x1F|\x7F|\x9F|\\\]', $name_file) ) {
				// on vérifie maintenant l'extension
				    $erreur = 2;
					$lib_erreur = 'L\'extension du fichier '.$name_file.' n\'est pas compatible avec celles autorisées = '.$file_type;
				} else if (file_exists($target_dir.$_REQUEST['PREFIX'].$name_file) && !$overwrite) {
					$erreur = 3;
					$lib_erreur = 'Le fichier '.$target_dir.$_REQUEST['PREFIX'].$name_file.' existe déjà dans le répertoire cible et ne peut être écrasé sans l\'option "overwrite"';
				} else if ( $size_file > $maxfilesize ) {
					$lib_erreur = "Le fichier est trop gros : $size_file > $maxfilesize";
					$erreur = 4;		
			    // on copie le fichier dans le dossier de destination
				} else {
					if ($filtrage_carac) {
						$name_file = $this->frm_FiltrerCaracteresSpeciaux($name_file);
					}
					if ($space_with!=' ') {
						$name_file = str_replace(' ',$space_with,$name_file);
					}
					$fichier_cible = $target_dir.$_REQUEST['PREFIX'].$name_file;
					if ( !move_uploaded_file($tmp_file, $fichier_cible))  {
						$lib_erreur = "Le fichier n'a pas été chargé : ".$fichier_cible;
		    		    $erreur = 5;
					} else {
						// le fichier a bien ete copie
						$resume_action .= "\tLe fichier charge : ".$fichier_cible;

						$lib_erreur = "Le fichier physique suivant a bien été téléchargé : ".$fichier_cible;
		    		    $erreur = 0;
						
						// traitement du redimensionnement de l'image
						if ($resizing) {
							
							if ($resizing_original_file) {
								$fichier_cible_resized = $fichier_cible;
								$resume_action .= "\n\test redimensionne a la volee";
							} else {
								$fichier_cible_resized = $target_dir.$_REQUEST['RESIZE_PREFIX'].$_REQUEST['PREFIX'].$name_file;						
								$resume_action .= "\n\test redimensionne et copie en vignette\n\tsous le fichier : ".$fichier_cible_resized;
							}

							list($width, $height) = getimagesize($fichier_cible) ; 
							switch ($resizing_mode) {
								case 1: // adaptation au bord le plus long
								  	if ($height > $width) {   // If Height Is Greater Than Width
										$modheight = $resize_to; 
										$diff = $height / $modheight;
										$modwidth = $width / $diff; 
							      	} else {    // Otherwise, Assume Width Is Greater Than Height (Will Produce Same Result If Width Is Equal To Height)
										$modwidth = $resize_to; 
										$diff = $width / $modwidth;
										$modheight = $height / $diff; 
							      	} 
									break;


								case 2: // redimension de X, Y est recalcule
									$modwidth = $resize_x_to; 
									$diff = $width / $modwidth;
									$modheight = $height / $diff; 
									break;

								case 3: // redimension de Y, X est recalcule
									$modheight = $resize_y_to; 
									$diff = $height / $modheight;
									$modwidth = $width / $diff; 
									break;
									
							}
							// creation d'une image temporaire en memoire
							$tn = imagecreatetruecolor($modwidth, $modheight) ; 
							$image = imagecreatefromjpeg($fichier_cible) ; 
							imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
							imagejpeg($tn, $fichier_cible_resized, 100) ; 
							imagedestroy($tn);
							// fin du redimensionnement de l'image 
						} else {
								$resume_action .= "\n\tn'a fait l'objet d'aucune modification";
								if (!empty($_REQUEST['PREFIX'])) $resume_action .= " autre que l'ajout du prefixe a son nom";
						}
					}
				}
			// CAS D'UN EFFACEMENT
			} else if (isset($_POST['FILE_NAME'])) {
				$name_file = $_POST['FILE_NAME'];
				if ($delete) {
					$nom_complet = $target_dir.$name_file;
					if (file_exists($nom_complet)) {
						if (unlink($target_dir.$name_file)) {
							$resume_action = "le fichier ".$nom_complet." vient d'être effacé !";							
							$erreur = 0;
						} else {
				    	    $erreur = 6;
						}
					} else {
			    	    $erreur = 0;
					}
				 } else {
		    	    $erreur = 0;
				 }
							
			}
		}

		$file_err  = array(
				1 => "Le fichier est introuvable",
				2 => "Ce type de fichier n'est pas autorisé<br><b>(".str_replace('|',',',$file_type)." uniquement)</b>",
				3 => "Le fichier <b> $name_file </b>existe déjà",
				4 => "Le fichier <b> $name_file </b> est trop volumineux pour être chargé<br><b>(".$this->ByteSize($size_file)." > ".$this->ByteSize($maxfilesize).")</b>",
				5 => "Le fichier <b> $name_file </b> n'a pas été copié",
				6 => "Le fichier <b> $name_file </b> n'a pas été copié",
				);

		print "<html>\n<head><title>SELECTEUR DE FICHIER</title>\n";
		// SANS LA CLOSE SUIVANTE LES CARACTERES ACCENTUES NE PASSENT PAS DANS LE CHAMP APPELANT
		print '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		
		print "\n<style type=\"text/css\">\n<!--\n";
		print ".classeformschampnormal { \n";
		print "	font-family: Verdana, Arial, Helvetica, sans-serif; \n";
		print "	font-size: 10px; \n";
		print "	background-color: #".$_GET['CLASS']."; \n";
		print "} \n";
		
		print "body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }\n";
		print ".classebutton { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }\n";
		print ".classemessage { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }\n";

		print ".classetitre { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; font-style: normal; font-weight: bold; color: #990000; }\n";
		print "-->\n</style>\n";
		print "</head>\n<body>\n";

		print "<!-- PAGE APPELANTE : \"".$_SERVER["HTTP_REFERER"]."\"\n";
		if (!empty($resume_action)) {
			print "     RESUME DE L'ACTION :\n";
			print $resume_action;
		}
		print "\n-->\n";

		if ($erreur>0) {
			print "<!-- \n\t ERREUR n°= $erreur \n\t \" $lib_erreur \" \n-->\n";
		}
		// INITIALISATION DES VARIABLES javascript
		print "<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";

		if (!empty($files_type)) {
			print "\t// TYPE DU FICHIER TELECHARGE = ".$files_type."\n";
		}
		print "\tvar max_file_size       = ".$maxfilesize.";\n";
		print "\tvar max_file_size_text  = '".$this->ByteSize($maxfilesize)."';\n";
		print "\tvar prefix_file         = '".addslashes($_REQUEST['PREFIX'])."';\n";
		print "\tvar file_type           = '".$file_type."';\n";
		print "\tvar resources_path      = '".CHEMINRESSOURCES_CF."';\n";
		print "\tvar load_error_code     = ".$erreur.";\n";
		print "\tvar window_opener       = '".$opener."';\n";
		print "\tvar window_title        = '".addslashes($title)."';\n";
		$multifilesmax = $_REQUEST['MULTIFILESMAX'];
		if (!empty($multifilesmax)) {
		    print "\tvar multifilesmax       = ".$multifilesmax.";\n";
		}
		if ($erreur==0)  {
			if ($_REQUEST['ACTION']=='ADD') {
				print "\tvar uploaded_file       = '".addslashes($target_dir.$name_file)."';\n";
				print "\tvar size_file           = ".$size_file.";\n";
				print "\tvar size_file_text      = '".$this->ByteSize($size_file)."';\n";
			} else {
				print "\tvar deleted_file        = '".addslashes($name_file)."';\n";
				$deletelib = ($delete) ? 'true' : 'false';
				print "\tvar deleted_from_server = ".$deletelib.";\n";
			}
		}
		// TRAITEMENT AJOUT 'ADD' OU SUPPRESSION 'DELETE'
		print "\tvar action              = '".$_REQUEST['ACTION']."';\n";

		// TRAITEMENT DES REDIMENSIONNEMENT
		print "\tvar resize_x_to         = '".$_REQUEST['RESIZE_X_TO']."';\n";
		print "\tvar resize_y_to         = '".$_REQUEST['RESIZE_Y_TO']."';\n";
		print "\tvar resize_to           = '".$_REQUEST['RESIZE_TO']."';\n";
		print "\tvar resize_prefix       = '".addslashes($_REQUEST['RESIZE_PREFIX'])."';\n";
		print "\tvar resize_msg          = '".addslashes($resise_msg)."';\n";

		print "\tvar resizing            = ";
		print ($resizing) ? 'true' : 'false';
		print ";\n";
		print "\tvar file_resized        = ";
		print ($resizing_original_file) ? 'true' : 'false';
		print ";\n";
		print "\tvar file_is_image       = ";
		print ($file_is_image) ? 'true' : 'false';
		print ";\n";

		print "\tvar return_field        = '".$_REQUEST['RETURNFIELD']."';\n";
		print "\tvar load_error_msg      = '".addslashes($file_err[$erreur])."';\n";
		
		print "-->\n</script>\n";			
		print "<script language=\"JavaScript\" type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."Communs.js\"></script>\n";			
		print "<script language=\"JavaScript\" type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."uploader/".CF_LIBJS_UPLOADER."\"></script>\n";			
		
		print "<pre>";
		print "</pre>";
		print "</body></html>";
		
		
	}
	
	
function ByteSize($bytes)  { 
    $size = $bytes / 1024; 
	if($size < 1024)  { 
        $size = number_format($size, 2); 
        $size .= ' Kb'; 
	} else { 
        if($size / 1024 < 1024) { 
           $size = number_format($size / 1024, 2); 
           $size .= ' Mb'; 
    	} else if ($size / 1024 / 1024 < 1024) { 
           $size = number_format($size / 1024 / 1024, 2); 
           $size .= ' Gb'; 
    	}  
    } 
    return $size; 
} 
	
	
	
	
	
	
	
	


	// Retourner l'indice d'un objet en fonction de son nom
	function _frm_trouverindice($nomchamp) {
		$nomchamp = strtoupper(trim($nomchamp));
		if ( !(array_key_exists($nomchamp, $this->frm_tableobjets)===false) ) return -1;
		$ret = array_search($nomchamp, $this->frm_tableobjets,true);
		if ( is_bool($ret) ) return -1;
		return $ret;
	}



	function _frm_activationobjet($nomchamp, $activer) {
		$tableretour = $this->_frm_tousleschampsdunobjet($nomchamp);
		if (empty($tableretour)) return "";
		$coderetour = "";
		foreach($tableretour as $champ) {
			if (!empty($coderetour)) $coderetour .= ";";
			$coderetour .= "tmt_disableField('".$champ."',".$activer.")";
		}
		return $coderetour;
	}

	function _frm_premierdelobjet($nomchamp) {
		$tableretour = $this->_frm_tousleschampsdunobjet($nomchamp);
		if (empty($tableretour)) {
			return "";
		} else {
			return $tableretour[0];
		}
	}

	// Retourner un tableau correspondant au nom de tous champs d'un objet
	function _frm_tousleschampsdunobjet($nomchamp) {
		// 1) trouver l'indice d'un objet
		$ret = $this->_frm_trouverindice($nomchamp);
		if ($ret == -1) return "";
		$tableretour = array();

		// déduire son type de l'objet
		switch ($this->frm_typeobjet[$ret]) {
   				case OBJET_2LISTES:  // 2 listes
					array_push($tableretour, "PERE_".$nomchamp);
        			break;
					
   				case OBJET_LISTELONGUE:	// Texte / Liste
					array_push($tableretour, $nomchamp."_EDIT_".$this->timestamp_formulaire);
					array_push($tableretour, $nomchamp."_LIST");
        			break;
					
   				case OBJET_BASCULE:	// Bascule = 2 listes
					array_push($tableretour, $nomchamp ."_G");
					array_push($tableretour, $nomchamp ."_D");
        			break;

   				case OBJET_LISTEDITABLE:	// Liste Editable
					array_push($tableretour, $nomchamp ."_EDIT");
					array_push($tableretour, $nomchamp ."_V");
        			break;

   				case OBJET_SORTSELECT:	// Liste a Trier
					array_push($tableretour, $nomchamp ."_SELECT");
        			break;

   				case OBJET_MULTILISTE:	// Liste a choix multiple
					array_push($tableretour, $nomchamp ."_LISTE");
        			break;
					
   				case OBJET_POPUP:	// Texte/Popup
					$id_en_retour = true;
					if ( !empty($this->frm_tableattributs[$ret]['return'])) {
						$id_en_retour = !($this->frm_tableattributs[$ret]['return']=='value');
					} 
					array_push($tableretour, $nomchamp ."_BTN");
					if ($id_en_retour) {
						array_push($tableretour, $nomchamp ."_VIEW");
					}
        			break;
					
   				case OBJET_UPLOADER:	// Selecteur de fichier
					array_push($tableretour, $nomchamp ."_VIEW");
					break;
					
				case OBJET_LISTESCASCADE:
					for ($i=0;$i<count($this->frm_tableattributs[$ret]['list']);$i++) {					
						array_push($tableretour, $nomchamp ."_LIST_".$i);
					}													
				default: // tous les autres objets : RIEN A AJOUTER
					break;
		}				
		// le champ "nommé" est systematiquement reference
		array_push($tableretour, $nomchamp);
		return $tableretour;
	}



	// enregistre l'etat de tous les champs de l'objet
	function  _frm_fieldisdisabled($i) {
		$this->frm_print( "\n\t<script type=\"text/javascript\">\n" );
		// on ajoute le (ou les )champ a la liste des champs a desactiver/reactiver
		$chainelistechamps = '';
		foreach( $this->_frm_tousleschampsdunobjet($this->frm_tableobjets[$i]) as $nomchamp2) {
			if (!empty($chainelistechamps)) {
				$chainelistechamps .= ",";
			}
			$chainelistechamps .= "'".$nomchamp2."'";
		}

		$this->frm_print( "\t\tStateFields.FieldIsDisabled_save(".$chainelistechamps.");\n\t</script>\n" );
	}



	
	// Permet de mémoriser dans un champ caché le type d'action en cours A,M
	function _frm_afficherchampcache() {
		$this->frm_print( "\n\n\t<!-- CHAMP CACHE DE MEMORISATION DE L'ACTION EN COURS : A0,A1 pour un ajout M0,M1 pour une modification -->" );
	    $this->frm_print( "\n\t<input name=\"" . $this->nomduformulaire. "hidden\" type=\"hidden\" value=\"".$this->form_actionencours."\">" ); 	

		$this->frm_print( "\n\n\t<!-- CHAMP CACHE DE MEMORISATION DE LA TOUCHE DE SORTIE Submit() -->" );
	    $this->frm_print( "\n\t<input name=\"" . $this->nomduformulaire. "exitcode\" type=\"hidden\" value=\"".$this->exitcode."\">" );	

		$this->frm_print( "\n\t<!-- Si 1er appel a la page alors =\"\" (VIDE),\n\t      si réentrance de la page alors =QUITTER =VALIDER ou =SUBMIT_NOMDUCHAMPDESORTIE avec l'attribut =\"S\" -->\n" );
		if ( !empty($this->valeurchampclef) ){
			$this->frm_print( "\n\t<!-- CHAMP CACHE DE MEMORISATION DE LA VALEUR DE LA CLEF DE L'ENREGISTREMENT EN COURS DE MODIFICATION -->" );
		    $this->frm_print( "\n\t<input name=\"" . $this->nomduchampclef. "\" type=\"hidden\" value=\"".$this->valeurchampclef."\">\n" );	
		}
	}




	// Modifier les boutons Valider et Annuler dès qu'un champ est modifié
	function _frm_change_etat_boutons() {	
		// Tous les champs réactivent le bouton de validation si modifié
		$this->_frm_evenements_ajouter("onFocus", "ReactiverBtnValider()", 1);
		// ... et modifier le libellé du texte "Quitter" en "Annuler"
		$this->_frm_evenements_ajouter("onFocus", "PasserEtatAnnuler()", 0);
		}



	// Tester l'existance dans la table des objets du nouveau champ
	function _frm_testsidoublonnomchamp($nomatester) {	
		if (in_array ($nomatester, $this->frm_tableobjets)) {
    		$this->frm_print( "<h1><b>ATTENTION :</b> Le nom de champ \"" . $nomatester . "\" a été doublonné !</h1>\n" );
			return false;
  		} else {
			return true;
		}		
	}
	
	// RAZ des evenement javascript "OnBlur, OnFocus..."
	function _frm_evenements_raz() {
			$this->evenements_objets = array( "onChange"    => "",
											  "oncontextmenu" => "",
											  "onDblClick"  => "",
											  "onFocus"     => "",
											  "onFocusIn"   => "",
											  "onKeyDown"   => "",
											  "onKeyUp"     => "",
											  "onKeyPress"  => "",
											  "onBlur"      => "",
											  "onFocusOut"  => "",
											  "onClick"     => "",
											  "onMouseOver" => "",
											  "onMouseOut"  => "",
											  "onMouseMove" => ""											  
  										    );
	}
	// Ajouter un evenement javascript "OnBlur, OnFocus..." Après=0 ou Avant=1
	function _frm_evenements_ajouter($evt_type, $avt_action, $avant) {
	    if ($avant == 1) {
			$this->evenements_objets[$evt_type] = $avt_action . ";" . $this->evenements_objets[$evt_type];
		} else {
			$this->evenements_objets[$evt_type] = $this->evenements_objets[$evt_type] . $avt_action . ";" ;
		}
	}

	// Ajouter un evenement javascript "OnBlur, OnFocus..." Avant=0 ou Après=1
	function _frm_evenements_afficher() {
		if  ($this->formulaireenlectureseule) return "";
	    $varevt = "";
        foreach ($this->evenements_objets as $evt => $value) {
		    if ( !empty($value) ) {
	    		$varevt = $varevt . "\n\t    $evt=\"$value\" ";
			}
		}
		return $varevt;
	}

	// RAZ des styles
	function _frm_style_raz() {
		$this->objet_style = "";
	}
	
	// Ajouter un evenement style pour le cumuler avec l'existant
	function _frm_style_ajouter($style_a_appliquer) {
		$this->objet_style .= $style_a_appliquer . ";";

	}
	// Afficher les styles cumules
	function _frm_style_afficher() {
		if ( !empty($this->objet_style) )
			return " style=\"" . $this->objet_style . "\"";
	}

	
	// Afficher le tableau et la colonne LABEL
	function _frm_objet_colonnelabel($i) {
		// Traitement particulier quand un champ a été marqué par la fonction "frm_ChampEnErreur()"
		if (array_key_exists($this->frm_tableobjets[$i],$this->frm_tableerreurs)) {
			$stylelabel   = "classeformslabelerreur";
		} else {
			$stylelabel   = "classeformslabel";
		}
		if ($this->modeautomatique) {		
	  		$this->frm_print( "\n    <tr>" );
		    $this->frm_print( "\n\t<td nowrap width=\"" );
			// SI ON SE TROUVE DANS UN ONGLET ALORS ON AFFICHE LA LARGEUR SPECIFIQUE
			if ($this->objet_onglet_ouvert) 
				$this->frm_print( $this->ongletspace );
			else
				$this->frm_print( $this->largeurlabel );
			$this->frm_print( "\" valign=\"top\">" );
			if ($this->objet_separateur_ouvert && !$this->objet_onglet_ouvert) 
				$this->frm_print( "<blockquote>" );
			else
				$this->frm_print( "<p>" );
			$this->_frm_sautligne($i);
		}
		if (!$this->masquerlabel) {
			if ( empty($this->frm_tableattributs[$i]['label']) ) {
				$this->frm_print( "&nbsp;" );
			} else {
				$this->frm_print( "<span class=\"$stylelabel\">" );
				$this->frm_print( $this->frm_tableattributs[$i]['label'] );
			}
		}
		$this->frm_print( "</span>" );
		if ($this->modeautomatique) {
			if ($this->objet_separateur_ouvert && !$this->objet_onglet_ouvert) 
				$this->frm_print( "</blockquote>" );
			else
				$this->frm_print( "</p>" );
			$this->frm_print( "</td>\n\t<td width=\"*\" nowrap valign=\"baseline\">" );
		}
	}

	function _frm_afficheligneaide($i) {

		if ( !empty($this->objet_help) && !$this->objet_readonly ) { 
			$this->_frm_evenements_ajouter("onMouseOver", "docTips.show('hlp".$this->frm_tableobjets[$i]."')", 0);			
			$this->_frm_evenements_ajouter("onMouseOut",  "docTips.hide()", 0);		
		}
	}
	// affiche pour l'objet de 1 a N lignes avant le champ pour aérer le formulaire
	function _frm_sautligne($i) {
		if ($this->frm_tablesautdelignes[$i]>0) {
			for ($nblignes=0; $nblignes<$this->frm_tablesautdelignes[$i] ;$nblignes++) {
				$this->frm_print( "<br>" );
			}
		}
	}


		
	function _frm_affichesize($i) {
		if ( !empty($this->frm_tableattributs[$i]['size'])) { 
			$this->frm_print( ' size="'. $this->frm_tableattributs[$i]['size'] . '" ' );
		}
	}
	
	function _frm_affichedefaut($i) {
		$valeurpardefaut = "";
		if ( !isset($this->frm_tableattributs[$i]['default']) ) {
			if ($this->objet_type==OBJET_COCHE) {
				$this->frm_print( ' value="'.$this->checkbox_valueoff.'" ' );
			}
			return;
		}
		$valeurlue = $this->frm_tableattributs[$i]['default'];	
		if ( !empty($valeurlue) || strlen($valeurlue)>0 ) {
			$valeurpardefaut = $this->frm_tableattributs[$i]['default'];
			switch($this->objet_type) {
 		       // dans le cas d'un champ texte on verifie si c'est un champ DATE ou TIMESTAMP
			   // et si la valeur par défaut = "TIMER"
			   case OBJET_TEXTE:
			   		$datecourante = "";
					$valeur_out   = "";
					if ( strtoupper($valeurpardefaut)=="TIMER")	{
				   		if ( !( strpos($this->objet_attrib,"D") === false )) {
							$datecourante = $this->frm_ChampDateActuelle();
						}
					   	if ( !( strpos($this->objet_attrib,"T") === false )) {
							$datecourante = $this->frm_ChampTimeStampActuel();
						}					
						if (empty($datecourante)) 
							$valeur_out  = htmlspecialchars($valeurpardefaut);
						else
							$valeur_out  = $datecourante;
					} else {
						// DANS LE CAS D'UN CHAMP DATE ON TRONQUE A 10 CARACTERES POUR ELIMINER L'HEURE SI ELLE EXISTE	
				   		if ( !( strpos($this->objet_attrib,"D") === false )) {
							$valeurpardefaut = substr($valeurpardefaut,0,10);
						}		
						if ( !( strpos($this->objet_attrib,"N") === false ) && (empty($valeurpardefaut)) )  {
							$valeurpardefaut = "0";
						}
						$valeur_out = $valeurpardefaut;
					}
					$this->frm_print( "\n\t<script type=\"text/javascript\">\n" );
					$this->frm_print( "\t\ttextFields.TextValue_set('".$this->frm_tableobjets[$i]."','".addslashes($valeur_out)."');\n\t</script>\n" );		
					break;
 		       // dans le cas d'un champ memo il faut le placer entre les balises "textarea"
			   case OBJET_MEMO:
					$this->frm_print( htmlspecialchars($valeurpardefaut) );
					break;
 		       // dans le cas d'un champ "case a cocher"
			   case OBJET_COCHE:  
					$this->frm_print( " value=\"".$valeurpardefaut."\"" );
					break;
					// dans le cas de l'editeur
			   case OBJET_EDITEUR: 
					$this->frm_print( htmlentities($valeurpardefaut) );
					break;
			   case OBJET_TIMER: 
					$this->frm_print( ' value="'.substr($valeurpardefaut,11,8).'" ' );
					break;
			   case OBJET_COLORPICKER: 
					$this->frm_print( ' value="'.$valeurpardefaut.'" ' );
					break;					
			   default :
				    $this->frm_print( ' value="'. htmlspecialchars($valeurpardefaut) . '" ' );

					
			}
		} else {
			// DANS LE CAS D'UNE VALEUR PAR DEFAUT = "0" ou vide 
			switch($this->objet_type) {
 		       // dans le cas d'un champ texte on verifie si c'est un champ (N)umérique dans ce cas on positionne un 0
			   case OBJET_TEXTE:
					if ( !( strpos($this->objet_attrib,"N") === false ) ) { 
						$this->frm_print( "\n\t<script type=\"text/javascript\">\n" );
						$this->frm_print( "\t\ttextFields.TextValue_set('".$this->frm_tableobjets[$i]."','0');\n\t</script>\n" );		
					}
					break;
 		       // dans le cas d'un champ "case a cocher"
			   case OBJET_COCHE:  
					$this->frm_print( " value=\"".$this->checkbox_valueoff."\" " );
					break;
			}
		}
	}

	function _frm_affichemaxlength($i) {
		if ( !empty($this->frm_tableattributs[$i]['maxlength'])) { 
			$largeur = $this->frm_tableattributs[$i]['maxlength'];
			$this->frm_print( ' maxlength="'. $largeur . '" ' );
			if ( empty($this->frm_tableattributs[$i]['width'])) {
				$largeur++;
				$this->frm_print( ' size="' . $largeur . '" ' );
			}
		}
	}


	function _frm_affichenumerique($i) {
		// Si le champ est formaté en "numérique"
		if ( !( strpos($this->objet_attrib,"N") === false )) {
		    // $this->_frm_evenements_ajouter("onKeyPress", "if(!isNS4){if(event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;}else{if(event.which < 45 || event.which > 57) return false;}", 0);
			$this->_frm_evenements_ajouter("onKeyPress", "if(!isNS4){ if(event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;}else{ if(event.which !=8 && event.which !=0 && (event.which < 45 || event.which > 57)) return false;}", 0);
		}
	}

	function _frm_submit($i, $codeevt="onChange") {
		// Si le champ (liste en général) doit effectuer un SUBMIT a chaque changement de valeur
		if ( !( strpos($this->objet_attrib,"S") === false )) {
		    $this->_frm_evenements_ajouter($codeevt,  "MM_setTextOfTextfield('".$this->nomduformulaire."exitcode','','SUBMIT_".$this->frm_tableobjets[$i]."')", 0);
		    $this->_frm_evenements_ajouter($codeevt,  "document.forms.".$this->nomduformulaire.".submit()", 0);
		}		
	}	

	function _frm_affichedate($i) {
		// Si le champ est formaté comme une date
		if ( !( strpos($this->objet_attrib,"D") === false )) {
		    $this->frm_print( " size='12' maxlength='10'" );
		    $this->_frm_evenements_ajouter("onKeyUp", "DateFormat(this,this.value,event,false,'3')", 0);
		    $this->_frm_evenements_ajouter("onBlur",  "DateFormat(this,this.value,event,true,'3')", 0);
		}		
	}	

	function _frm_affichetimestamp($i) {
		// Si le champ est formaté comme une date
		if ( !( strpos($this->objet_attrib,"T") === false )) {
		    $this->frm_print( " size='19' maxlength='18' readonly=true " );
		}		
	}	



	function _frm_afficheheure($i) {
		// Si le champ est formaté pour une heure
		if ( !( strpos($this->objet_attrib,"H") === false )) {
		    $this->frm_tableattributs[$i]['mask'] = "##:##";
			$this->objet_mask = "##:##";
		}	
	}	


	function _frm_affichedatepicker($i) {
		if  ($this->objet_readonly) return;
		// Si le champ est formaté comme une date ou un time stamp
		$dateoutimestamp = "";				
		if ( !( strpos($this->objet_attrib,"D") === false ))	$dateoutimestamp = "D";
		if ( !( strpos($this->objet_attrib,"T") === false ))	$dateoutimestamp = "T";
		$datepicker = !( strpos($this->objet_attrib,"P") === false );

		// Si le champ demande le "datepicker" == "P" avec une date ou dans le cas d'un "timestamp"
			if ( ($datepicker && ($dateoutimestamp == "D") ) || ($dateoutimestamp == "T") ) {

				if ($dateoutimestamp == "D") {
					$ifFormat = '';
					$libShowTime = 'false';
					$iconedatepicker = 'calendar2.gif';
				} else {
					$ifFormat  = ' %H:%M';
					$libShowTime = "'24'";
					$iconedatepicker = 'calendar.gif';
				}

				$objCalendar = 'obj'.$this->frm_tableobjets[$i];			
				$this->frm_print( "\n\t<!-- DATE PICKER : SELECTIONNE UNE DATE DANS UN CALENDRIER -->" );
				$this->frm_print( "\n\t<img src=\"".CHEMINRESSOURCES_CF."images/".$iconedatepicker."\" id=\"".$this->frm_tableobjets[$i]."_ICON\" width=\"16\" height=\"16\" valign=\"baseline\"" );
			    $this->_frm_evenements_raz();
				$this->_frm_evenements_ajouter("onClick", "ReactiverBtnValider();PasserEtatAnnuler();".$objCalendar.".JsCalendar_Show();", 0);	 

				$this->_frm_afficheligneaide($i);
				$this->frm_print( $this->_frm_evenements_afficher() );
				$this->frm_print( ">" );
				$this->frm_print( "\n\t<script type=\"text/javascript\"> \n" );
				$this->frm_print( "\n\t\t".$objCalendar." = new JsCalendar('".$this->frm_tableobjets[$i]."', '%d/%m/%Y".$ifFormat."',".$libShowTime.",true);" );
				if (!empty($this->frm_tableattributs[$i]['script'])) {
					$this->frm_print( "\n\t\t".$objCalendar.".JsCalendar_script('".$this->frm_tableattributs[$i]['script']."');" );
				}
				$this->frm_print( "\n\t</script> \n" );
				
			}
		
	}	

	function _frm_affichemasque($i) {
		if ( !empty($this->objet_mask)) {
			// $lgmask = strlen($this->objet_mask)+1;
		    // $this->frm_print( " size='" . $lgmask . "' maxlength='".strlen($this->objet_mask)."'" );
			$this->_frm_evenements_ajouter("onKeyDown","objMaskEdit_".$this->frm_tableobjets[$i].".isAllowKeyPress(event,this)", 0);
			$this->_frm_evenements_ajouter("onKeyUp","objMaskEdit_".$this->frm_tableobjets[$i].".getKeyPress(event,this)", 0);
			$this->_frm_evenements_ajouter("onBlur","this.value=objMaskEdit_".$this->frm_tableobjets[$i].".format(this.value)", 0);
		}
	}


	function _frm_afficherows($i) {
		// Nombre de ligne d'une LISTE ou d'un champ MEMO
		$taille = "";
		if (!empty($this->frm_tableattributs[$i]['rows'])) {
			$taille = $this->frm_tableattributs[$i]['rows'];
		}
		// par defaut le nombre de ligne = 3
		// pour les listes longue, les bascules ou les listes  e trier
		if ($this->frm_typeobjet[$i]==OBJET_LISTE || $this->frm_typeobjet[$i]==OBJET_LISTELONGUE 
		 || $this->frm_typeobjet[$i]==OBJET_BASCULE || $this->frm_typeobjet[$i]==OBJET_SORTSELECT) {
			if ( empty($taille)) { 
				$taille = 1; 
			}
			// pour les bascules le nombre de ligne par defaut ou minimum est "7"
			if( ($this->frm_typeobjet[$i]==OBJET_BASCULE) && ($taille<7) ) { 
				$taille = 7; 
			}
			// pour les bascules le nombre de ligne par defaut ou minimum est "5"
			if( ($this->frm_typeobjet[$i]==OBJET_SORTSELECT) && ($taille<5) ) { 
				$taille = 5; 
			}
			$this->frm_print( ' size="'. $taille . '" ' );
		} else {
			if ( empty($taille)) { $taille = 3; }
			$this->frm_print( ' rows="'. $taille . '" ' );
		}
	}


	function _frm_definitstylewidth($i) {
		// Nombre de ligne d'une LISTE ou d'un champ MEMO
		if (!empty($this->frm_tableattributs[$i]['width'])) {
			$taille = $this->frm_tableattributs[$i]['width'];
			if ( !empty($taille)) { 
				$this->_frm_style_ajouter("width:". $taille);
			}
		} else {
			if ($this->frm_typeobjet[$i]==OBJET_COLORPICKER)
				$this->_frm_style_ajouter("width:70px");
		}
	}
	
	function _frm_definitstyleheight($i) {
		// Hauteur d'un objet
		if (!empty($this->frm_tableattributs[$i]['height'])) {
			$taille = $this->frm_tableattributs[$i]['height'];
			if ( !empty($taille)) { 
				$this->_frm_style_ajouter("height:". $taille);
			}
		}
	}

	// ajouter un script a l'evenement "onBlur"
	function _frm_callscript($i) {
		if (!empty($this->frm_tableattributs[$i]['script'])) {
			$nomscript = $this->frm_tableattributs[$i]['script'];
			if ( !empty($nomscript)) { 
				$this->_frm_evenements_ajouter("onBlur",  $nomscript, 0);		
			}
		}
	}
	
	// Elimination du libellé 'px' en fin de chaine (utiliser pour placer les POPUP)
	function _frm_retirer_px($lib) {
		$libmaj = strtoupper($lib);
	    if ( !(strpos($libmaj,"PX") === false)) {
			return substr($lib,0,strpos($libmaj,"PX"));
		} else {
			return $lib;
		}
	}

	function _frm_definitstyletransform($i) {
		// ANALYSE DES ATTRIBUTS PASSES EN PARA%ETRE POUR L'OBJET
	    if ( !(strpos($this->objet_attrib,"U") === false)) {
		       $this->_frm_style_ajouter("text-transform:uppercase");
			   $this->_frm_evenements_ajouter("onBlur","NM_changeCase('".$this->frm_tableobjets[$i]."',0)",0);
		}
	    if ( !(strpos($this->objet_attrib,"L") === false)) {
		       $this->_frm_style_ajouter("text-transform:lowercase");
			   $this->_frm_evenements_ajouter("onBlur","NM_changeCase('".$this->frm_tableobjets[$i]."',1)",0);
		}
	    if ( !(strpos($this->objet_attrib,"M") === false)) {
		       $this->_frm_style_ajouter("text-transform:lowercase");
			   $this->_frm_evenements_ajouter("onBlur","NM_changeCase('".$this->frm_tableobjets[$i]."',1)",0);
		}
	    if ( !(strpos($this->objet_attrib,"I") === false)) {
		       $this->_frm_style_ajouter("text-transform:capitalize");
			   $this->_frm_evenements_ajouter("onBlur","NM_InitialCap('".$this->frm_tableobjets[$i]."')",0);
		}
	    if ( !(strpos($this->objet_attrib,"N") === false)) {
		       $this->_frm_style_ajouter("text-align: right");
		}
	}
	
	// APPELE PAR TOUS LES OBJECTS BASCULE EN LECTURE SEULE
	function _frm_lectureseule($i) {

		if  ($this->objet_readonly) {
			switch ($this->frm_typeobjet[$i]) {
   				case OBJET_TEXTE:
   				case OBJET_MEMO:
   				case OBJET_LISTELONGUE: 
				case OBJET_LISTEDITABLE: 
   				case OBJET_SORTSELECT: 
   				case OBJET_MULTILISTE: 
					$this->frm_print( " readonly=\"true\" " );
					break;
   				case OBJET_LISTE: // LISTE
   				case OBJET_2LISTES: // 2 LISTES
				case OBJET_POPUP:
					// $this->frm_print( " onChange=\"MM_setTextOfTextfield('".$this->frm_tableobjets[$i]."','','".$this->frm_tableattributs[$i]['default']."')\"" );
					break;
   				case OBJET_COCHE:
					// $this->frm_print( " onClick=\"return false\" " );
					break;
				default:
					$this->frm_print( " disabled=\"true\" " );
			}
		}
	}

	function _frm_desactivation() {
		if  (!$this->objet_readonly) {
			// Si l'attribut du champ contient "-" alors il est désactivé
			if (!empty($this->objet_attrib)) {
				if ( !( strpos($this->objet_attrib,"-") === false )) {
			    	return " disabled=\"true\" ";
				}
			}
		}
	}


	function _frm_classe($i) {
		$styleacomposer = "classeformschamp";
	    // En fonction du caractère lecture seule on non
		// si le formulaire est déclaré a l'initialisation "en lecture seule" = pareil
	    if ( $this->objet_readonly) {
	       $styleacomposer .= "readonly";
	    // En fonction du caractère obligatoire ou non ou si champ numerique
		} elseif ( !( strpos($this->objet_attrib,"R") === false )) {
	       $styleacomposer .= "obligatoire"; 
		} else {
	       $styleacomposer .= "normal"; 
		}
		// si une erreur a été positionnée sur le champ alors la classe devient...
		if (array_key_exists($this->frm_tableobjets[$i],$this->frm_tableerreurs)) {
			$styleacomposer = "classeformschamperreur"; 
		}		
		return $styleacomposer;
	}
	
	function _frm_afficheclasse($i) {

		return " class=\"" . $this->_frm_classe($i) . "\" ";
	}

	function _frm_scroller_open() {
		$this->objet_scroller_open = true;
		$this->frm_print( "\n<!-- DEBUT DE ZONE SCROLLABLE -->\n" );		
		// Ouverture du tableau en début de formulaire		
		$this->frm_print( '<div id="scroll" style="width:'.$this->scroller_x.';height:'.$this->scroller_y.';overflow:auto' );
		if ( !empty($this->scroller_color) ) $this->frm_print( ';background-color:'.$this->scroller_color );
		$this->frm_print( '">' );
	}

	function _frm_scroller_close() {
		$this->objet_scroller_open = false;
		$this->frm_print( "\n<!-- FIN DE ZONE SCROLLABLE -->\n" );		
		// Ouverture du tableau en début de formulaire		
		$this->frm_print( '</div>' );
	}				

	// retourne l'indice d'un objet cherche par son nom ou -1 si inexistant
	function _frm_trouveindice($nomachercher) {
		$nomachercher = strtoupper($nomachercher);
		$i = 0;
		while ( $i<$this->frm_nbreobjets) {
			if ( $this->frm_tableobjets[$i]== $nomachercher ) return $i;
			$i++;
		} 
		return -1;
	}	
	
	// appelee par Ouvrir() si la touche "quitter" est pressée
	function _frm_grilleannulee() {
		$this->frm_print( "<hr>" );
		$this->frm_print( "Vous avez pressé la touche <b>QUITTER (libellé=\"".$this->btnlib_Quitter."\")</b><br>Si vous voyez ces lignes c'est que les lignes suivantes sont manquantes :<br>" );	
		$this->frm_print( "<blockquote>	switch ( \$f->frm_Aiguiller('NOM_DE_CLEF') ) {<br>" );
		$this->frm_print( "...<br>" );		
		$this->frm_print( "case \"AQ\" :<br>" );
		$this->frm_print( "case \"MQ\" :<br>" );
		$this->frm_print( "<blockquote>" );
		$this->frm_print( "<b>header(\"Location: /url_de_branchement.htm\");</b><br>" );
		$this->frm_print( "break;<br>" );
		$this->frm_print( "</blockquote>}<br>" );
		$this->frm_print( "\t\$f->frm_Ouvrir();</blockquote>" );
		$this->frm_print( "<h4><span style='color: red;'>ATTENTION POUR FONCTIONNER AUCUNE SORTIE DE CARACTERE NE DOIT DEVANCER header()</span></h4><br>" );
		$this->frm_print( "<hr>" );
		return false;
	}
	
	
	#####################################################################################################################
    # CODE JAVASCRIPT GENERE DYNAMIQUEMENT EN PHP
	#####################################################################################################################
	

    function frm_Protection()  {			
				$this->frm_print( "<SCRIPT language=JavaScript> \n" );
				$this->frm_print( "<!-- \n" );
				$this->frm_print( "//Disable right click script III- By Renigade (renigade@mediaone.net) \n" );
				$this->frm_print( "//For full source code, visit http://www.dynamicdrive.com \n" );
				$this->frm_print( "function clickIE() {if (document.all) {(message);return false;}} \n" );
				$this->frm_print( "function clickNS(e) {if  \n" );
				$this->frm_print( "(document.layers||(document.getElementById&&!document.all)) { \n" );
				$this->frm_print( "if (e.which==2||e.which==3) {return false;}}} \n" );
				$this->frm_print( "if (document.layers)  \n" );
				$this->frm_print( "{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} \n" );
				$this->frm_print( "else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} \n" );
				$this->frm_print( "document.oncontextmenu=new Function(\"return false\") \n" );
				$this->frm_print( "// -->  \n" );
				$this->frm_print( "</script> \n" );	
	}	
	
	function js_init() {
				$this->frm_print( "\n<!-- CLASSEFORMS : ".CLASSEFORMS_VERSION." -->\n" );
				$this->frm_print( "\n<!-- JAVASCRIPT SYSTEMATIQUE DE LA CLASSE \"ClasseForms\" -->\n" );
				$this->frm_print( "\t<script language=\"JavaScript\" type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."Communs.js\"></script>\n\n" );			

				$this->frm_print( "\n<!-- FIN DU CODE SYSTEMATIQUE STATIQUE -->\n\n" );
				
				$this->frm_print( "\n<script language=\"JavaScript\" type=\"text/JavaScript\">\n<!-- " );
				$this->frm_print( "// PERMET DE CHANGER L'ETAT DU BOUTON QUITTER EN ANNULER ET INVERSEMENT \n" );
				$this->frm_print( "var EtatInitialBtnQuitter = true; \n" );
				$this->frm_print( "var EtatVerrouillerFormulaire = false; \n" );
				
				$this->frm_print( "function PasserEtatAnnuler() { \n" );
				$this->frm_print( "	EtatInitialBtnQuitter = false; \n" );
				$this->frm_print( "	MM_setTextOfTextfield('ClassFormAnnulerQuitter','','".$this->btnlib_Retablir."'); \n" );
				// SI UN TIME OUT A ETE DEFINI
				if ($this->timeout_tempo>0)	{
					$this->frm_print( "	".$this->timeout_nomobj.".AutoRedirection_stop(); \n" );
				}

				$this->frm_print( "} \n" );
				
				$this->frm_print( "function PasserEtatQuitter() {  \n" );
				$this->frm_print( "	EtatInitialBtnQuitter = true; \n" );
				$this->frm_print( "	MM_setTextOfTextfield('ClassFormAnnulerQuitter','','".$this->btnlib_Quitter."'); \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "function ReactiverBtnValider() {  \n" );
				// $this->frm_print( "	alert('reactiver'); \n" );
				$this->frm_print( "	if (!EtatVerrouillerFormulaire) tmt_disableField('ClassFormValider',0); \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "\n// ATTENTION : CETTE FONCTION RETABLIT DANS LEUR ETAT D'ORIGINE TOUS LES CONTROLES\n" );
				$this->frm_print( "function Resetousubmit() { \n" );
				$this->frm_print( "   if (EtatInitialBtnQuitter) { \n" );
				// SI LA CONFIRMATION A ETE CONFIGUREE PAR LA FONCTION frm_InitConfirmCancel() ALORS ON DEMANDE AVANT .reset()
				if ($this->form_cancel) {
					if (empty($this->form_cancel_mess)) $this->form_cancel_mess = "Annuler la saisie du formulaire ?";
					$this->frm_print( "       if (!confirm(unescape('".$this->form_cancel_mess."'))) { return false; }\n" );
				}
				$this->frm_print( "       tmt_disableField('ClassFormAnnulerQuitter',1); \n" );
				$this->frm_print( "       tmt_disableField('ClassFormValider',1); \n" );
				$this->frm_print( "       MM_setTextOfTextfield('".$this->nomduformulaire."exitcode','','QUITTER'); \n" );
				$this->frm_print( "       document.forms.".$this->nomduformulaire.".submit(); \n" );
				$this->frm_print( "       return true; \n" );
				$this->frm_print( "   } else { \n" );
				$this->frm_print( "       <!-- LE CODE CI DESSOUS EST EXECUTE QUAND ON CLIQUE SUR 'RETABLIR' -->\n" );
				
				// SI LA CONFIRMATION A ETE CONFIGUREE PAR LA FONCTION frm_InitConfirmCancel() ALORS ON DEMANDE AVANT .reset()
				if ($this->form_cancel) {
					if (empty($this->form_cancel_mess)) $this->form_cancel_mess = "Annuler la saisie du formulaire ?";
					$this->frm_print( "       if (!confirm(unescape('".$this->form_cancel_mess."'))) { return false; }\n" );
				}
				$this->frm_print( "\n\t SaveFields.SaveFieldValue_save(); // SAUVEGARDE DES CHAMPS AVANT RESET" );

				$this->frm_print( "\n\t //------ RESET HTML DES CHAMPS --------------------------------" );
				$this->frm_print( "\n\t document.forms.".$this->nomduformulaire.".reset();" );
				$this->frm_print( "\n\t //-------------------------------------------------------------" );
				$this->frm_print( "\n\t textFields.TextValue_reset();" );
				$this->frm_print( "\n\t SaveFields.SaveFieldValue_restore(); // RESTAURATION DES CHAMPS" );
				$this->frm_print( "\n\t StateFields.FieldIsDisabled_restore();" );

				for ($i=0;$i<$this->frm_nbreobjets;$i++) {
				
					switch ($this->frm_typeobjet[$i]) {
					
						// SI DES OBJETS BASCULES EXISTENT ALORS ON AJOUTE AU RESET L'INITIALISATION DES 2 LISTES
						case OBJET_BASCULE :
							$this->frm_print( "\n       obj" .$this->frm_tableobjets[$i].".InitialiserListes();" );
							break;

						// SI DES ARBRES EXISTENT ALORS ON AJOUTE AU RESET L'INITIALISATION DE 2 CHAMPS (CACHE+ARBRE)

						case OBJET_TREE :
							if (!empty($this->frm_tableattributs[$i]['default'])) {
								$valdef = $this->frm_tableattributs[$i]['default'];
							} else {
								$valdef = "";
							}
							$this->frm_print( "\n       t$i.closeAll();" );
							if ( !empty($valdef) ) {							
								$this->frm_print( "\n       var obj = MM_findObj('".$this->frm_tableobjets[$i]."');" );
								$this->frm_print( "\n       if (obj) obj.value = ".$valdef.";" );
								$this->frm_print( "\n       t$i.openTo(".$valdef.", true);" );
							} else {
								$this->frm_print( "\n       t$i.openTo(0, true);" );
							}
							break;
							
						// SI DES SELECTEURS D'ICONES EXISTENT ALORS ON REMET L'ICONE D'ORIGINE
						case OBJET_ICONE :
							$chemin_icone = "";
							if (!empty($this->frm_tableattributs[$i]['path'])) {
								$chemin_icone = $this->frm_tableattributs[$i]['path'];
							}
							$nom_icone = "";
							if (!empty($this->frm_tableattributs[$i]['default'])) {
								$nom_icone = basename($this->frm_tableattributs[$i]['default']);
							}
							if (!empty($nom_icone)) {
								$icone_a_restaurer = $chemin_icone.$nom_icone;
							} else {
								$icone_a_restaurer = "";
							}
							$this->frm_print( "\n\t\t\tMM_swapImage('".$this->frm_tableobjets[$i]."_IMG','','".$icone_a_restaurer."',1); " );
							break;
							
						case OBJET_COLORPICKER :
							$this->frm_print( "\n       ".$this->frm_tableobjets[$i]."_Reset();  // RESET ColorPicker" );
							break;

						case OBJET_COCHE :
							$this->frm_print( "\n       obj".$this->frm_tableobjets[$i].".ogc_reset();  // RESET Checkbox" );
							break;
							
						case OBJET_SORTSELECT :
							$this->frm_print( "\n       js".$this->frm_tableobjets[$i].".SortSelectReset();  // RESET SortSelect" );
							break;

						case OBJET_EDITEUR :
							$this->frm_print( "\n         ".$this->frm_tableobjets[$i]."_reset();  // RESET dhtmlEditor" );
							break;

						case OBJET_LISTEDITABLE :
							$this->frm_print( "\n       var obj  = MM_findObj('".$this->frm_tableobjets[$i]."_EDIT'); // RESET ComboBox" );
							$this->frm_print( "\n       var objs = MM_findObj('".$this->frm_tableobjets[$i]."_STYLE');" );
							$this->frm_print( "\n       if (obj) obj.style.fontStyle = objs.value;" );
							break;
							
						case OBJET_LISTELONGUE :
							$this->frm_print( "\n         obj".$this->frm_tableobjets[$i].".LongList_reset();  // RESET liste longue" );
							break;
						case OBJET_LISTESCASCADE :
							$this->frm_print( "\n         obj".$this->frm_tableobjets[$i].".CascadingLists_reset();  // RESET des listes en cascade" );
							break;

					}
			//	$this->frm_print( "\n\t alert('".$i."');" );

				}
				
				// SI DES ONGLET EXISTE ON REACTIVE LE 1ER
				if ($this->objet_onglet>0) {				
					$idtab = ($this->indiceongletpardefaut!=-1) ? $this->indiceongletpardefaut : '0';
					$this->frm_print( "\n       ".$this->nomduformulaire."ONGLETS.setSelectedIndex(".$idtab.");" );
				}


				if ($this->objet_slider>0) {
					$this->frm_print( "\n       ".$this->nomduformulaire."_init_sliders();" );
				}
				// SI DES CHAMPS TEXTES EXISTENT ON LES REINITIALISE A LEUR VALEUR PAR DEFAUT
			//	$this->frm_print( "\n\t alert('PasserEtatQuitter'); \n" );
				$this->frm_print( "\n\t tmt_disableField('ClassFormValider',1); \n" );

				$this->frm_print( "\n\t PasserEtatQuitter(); \n" );
				
				$this->frm_print( "   } \n" );
				$this->frm_print( "} \n" );
								
				$this->frm_print( "-->\n</script> \n" );

				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour initialiser les champs texte -->\n" );
				$this->frm_print( "<script type=\"text/javascript\">\n" );
				$this->frm_print( "\tvar textFields  = new TextValue_init();\n" );					
				$this->frm_print( "\tvar StateFields = new FieldIsDisabled_init();\n" );		
				$this->frm_print( "\tvar SaveFields  = new SaveFieldValue_init();\n" );		
				$this->frm_print( "</script>\n\n" );		
								
				$this->frm_print( "\n<!-- FIN DU CODE SYSTEMATIQUE DYNAMIQUE -->\n" );
				
	}
	

	function js_checkform() {
				$this->frm_print( "\n<!-- CODE JAVASCRIPT necessaire pour les controles de formulaire -->\n" );
				$this->frm_print( "<script type=\"text/javascript\"> \n" );
				$this->frm_print( "\t// appel par la methode onSubmit() de la fonction de verification de saisie\n" );
				$this->objcheckform = 'objcheck_'.$this->nomduformulaire;
				$this->frm_print( "\tvar ".$this->objcheckform." = new checkform_init();\n" );
				// SI AU MOINS UN SEPARATEUR DE PARAGRAPHE EXISTE ALORS ON EXPEND TOUS LES PARAGRAPHES AVANT DE POINTER LE 1er
				if ($this->objet_separateur>0) {
					$this->frm_print( "\t".$this->objcheckform.".checkform_separateur();\n" );
				}
				// SI UN ONGLET EXISTE ALORS LE POINTAGE SUR LE 1ER CHAMP EST INACTIVE				
				if ($this->objet_onglet<>0) {
					$this->frm_print( "\t".$this->objcheckform.".checkform_onglet();\n" );
				}
				$this->frm_print( "\t</script>\n" );

	}

	function js_champtexte() {
	
	}	
	
	function js_dateformat() {
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les controles de date -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."dateformat/DateFormat.js\"></script>\n\n" );			
	}	

	function js_MaskEdit() {
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour la gestion des masques de saisie -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."maskedit/masks.js\"></script>\n" );		
				$this->frm_print( "<script language=\"JavaScript1.2\">\n" );
				$this->frm_print( "<!--//\n" );
				for ($i=0;$i<$this->frm_nbreobjets;$i++) {
					$attrib = "";
					$mask = "";
					if (!empty($this->frm_tableattributs[$i]['attrib'])) {
			 			$attrib = strtoupper($this->frm_tableattributs[$i]['attrib']);
					}
					// L'OBJET TIME DECLARE UN MASQUE IMPLICITE 
					if ( !( strpos($attrib,"H") === false )) {
						$this->frm_tableattributs[$i]['mask'] = "##:##";
					}
					if (!empty($this->frm_tableattributs[$i]['mask'])) {
						$mask   = $this->frm_tableattributs[$i]['mask'];
						
						$typemasque = ($attrib=='N') ? ", \"number\"" : "";
					    if( strpos($attrib,"N") === false) {
					        $typemasque = "";
						} else {
							$typemasque = ", \"number\"";
						}
						$this->frm_print( "\tobjMaskEdit_".$this->frm_tableobjets[$i]." = new Mask(\"".$mask."\"".$typemasque."); \n" );
					}
				}
				$this->frm_print( "//-->\n" );
				$this->frm_print( "</script>\n\n" );

	}	


	function js_TipMessage() {
				$this->frm_print( "\n<!-- BALISE DE POSITIONNEMENT DE L'AIDE -->\n" );
				$this->frm_print( "<DIV id=docTipsLayer style=\"Z-INDEX: 1000; LEFT: 0px; VISIBILITY: hidden; WIDTH: 10px; POSITION: absolute; TOP: 0px\"></DIV> \n\n" );
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les bulles d'aide -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."tooltips/ToolTips.js\"></script>\n\n" );

				$this->frm_print( "<SCRIPT language=JavaScript> \n" );
				$this->frm_print( "<!-- \n" );
				$this->frm_print( "var docTips = new TipObj('docTips'); \n" );
				$this->frm_print( "with (docTips) \n" );
				$this->frm_print( "{ \n" );
				for ($_i=0;$_i<$this->frm_nbreobjets;$_i++) {
					$messageaide = "";
					// Le message d'erreur est prioritaire sur le message normal
					// (qui peut d'ailleurs ne pas exister)

					if (array_key_exists($this->frm_tableobjets[$_i],$this->frm_tableerreurs)) {
							$messageaide = "<b>" .$this->frm_tableerreurs[$this->frm_tableobjets[$_i]] ."</b>";
					} elseif (!empty($this->frm_tableattributs[$_i]['help'])) {
						    $messageaide = $this->frm_tableattributs[$_i]['help'];
					}
					if  (!empty($messageaide)) {
						$this->frm_print( "	tips.hlp".$this->frm_tableobjets[$_i]." = new Array('page.scrollX() + page.winW()', -20, 120,'".addslashes($messageaide)."');  \n" );
					}
				}
				$this->frm_print( "\n\ttemplate = '<table bgcolor=\"".$this->couleurtitre."\" cellpadding=\"1\" cellspacing=\"0\" width=\"%2%\" border=\"0\">' + \n" );
				$this->frm_print( "\t'<tr><td><table bgcolor=\"".$this->couleurchampnormal."\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" border=\"0\">' + \n" );
				$this->frm_print( "\t'<tr><td class=\"tipClass\">%3%</td></tr></table></td></tr></table>'; \n" );
				$this->frm_print( "} \n" );
				$this->frm_print( "//--> \n" );
				$this->frm_print( "</SCRIPT> \n" );

				$this->frm_print( "<STYLE type=text/css>.tipClass { \n" );
				$this->frm_print( "	FONT: 10px Vernada, Arial, Helvetica; COLOR: ".$this->couleurtitre." \n" );
				$this->frm_print( "} \n" );
				$this->frm_print( "</STYLE> \n" );

	}

	
	function js_ChangeBox() {	
				$this->frm_print( "\n<!-- CODE JAVASCRIPT necessaire pour les cases a cocher -->\n" );
				$this->frm_print( "  <script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."checkbox/checkbox.js\"></script> \n" );
				$this->frm_print( "  <script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."checkbox/checkbox_php.js\"></script> \n" );

	}	

	function js_ActiverDesactiverSurCoche()	{
				$this->frm_print( "<script language=\"javascript\"> \n" );

				// La fonction suivante n'est utile qu'au onglets
				if ($this->objet_onglet>0) {
					$this->frm_print( "function ActiverOngletSurCoche() { \n" );
					$this->frm_print( "	args=ActiverOngletSurCoche.arguments \n" );
					$this->frm_print( "	objcoche = eval('obj'+args[0]+'.obj_coche'); \n" );
//					$this->frm_print( "alert(objcoche); " );
					$this->frm_print( "	if (objcoche) { \n" );
					$this->frm_print( "			".$this->nomduformulaire."ONGLETS.setSelectedIndex(args[1]); \n" );
					$this->frm_print( "	} \n" );
					$this->frm_print( "} \n" );
				}

				$this->frm_print( "</script> \n" );
	}	
	function js_ActiverDesactiverSurRadio()	{
				$this->frm_print( "<script language=\"javascript\"> \n" );

				// La fonction suivante n'est utile qu'au onglets
				if ($this->objet_onglet>0) {
					$this->frm_print( "function ActiverOngletSurRadio(numOnglet) { \n" );
					$this->frm_print( "	".$this->nomduformulaire."ONGLETS.setSelectedIndex(numOnglet); \n" );
					$this->frm_print( "} \n" );
				}

				$this->frm_print( "</script> \n" );
	}	

		
	function js_NewWindow()	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT necessaire pour ouvrir une fenetre centree -->\n" );
				$this->frm_print( "<script language=\"javascript\"> \n" );
				$this->frm_print( "function NewWindow(mypage,myname,w,h,scroll){ \n" );
				$this->frm_print( "var win = null; \n" );
				$this->frm_print( "LeftPosition = (screen.width) ? (screen.width-w)/2 : 0; \n" );
				$this->frm_print( "TopPosition = (screen.height) ? (screen.height-h)/2 : 0; \n" );
				$this->frm_print( "settings = \n" );
				$this->frm_print( "'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable' \n" );
				$this->frm_print( "win = window.open(mypage,myname,settings) \n" );
				$this->frm_print( "} \n" );
				$this->frm_print( " \n" );
				$this->frm_print( "</script> \n" );
	}
	


	// Calendrier Popup pour recuperer une date
	function js_Calendar() {
				$this->frm_print( "  <!-- importation necessaire a l'emploi de Calendar --> \n" );
				$this->frm_print( "\n<!-- DEFINITION DES STYLES DU CALENDRIER -->\n" );
				$this->frm_print( "<link type=\"text/css\" rel=\"StyleSheet\" href=\"".CHEMINRESSOURCES_CF."jscalendar-1.0/calendar-system.css\" /> \n" );

				$this->frm_print( "  <script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."jscalendar-1.0/calendar.js\"></script> \n" );
				$this->frm_print( "  <script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."jscalendar-1.0/lang/calendar-fr.js\"></script> \n" );
				$this->frm_print( "  <script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."jscalendar-1.0/calendar-setup.js\"></script> \n" );

	}

	function js_ListeLongue() {
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour la gestion des listes longues -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."longlist/".CF_LIBJS_LONGUELISTE."\"></script>\n\n" );	 	
	}	

	function js_Bascule() {	
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les 2 listes en bascule -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."2listesbascule/".CF_LIBJS_2LISTESBASCULES."\"></script>\n" );
	}

 	function js_ListesCascade() 
	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les listes en cascade -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."cascadinglists/".CF_LIBJS_LISTESCASCADE."\"></script>\n" );
	
	}

	function js_Editeur() {	
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour l'editeur DHTML -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF.CF_LIBJS_FCKEDITOR."/fckeditor.js\"></script>\n" );
				if  (!$this->formulaireenlectureseule) {
					$this->frm_print( "\t<script type=\"text/javascript\"> \n" );
					$this->frm_print( "\tfunction DoSomething( editorInstance ) { ReactiverBtnValider(); PasserEtatAnnuler(); } \n" );
					$this->frm_print( "\tfunction FCKeditor_OnComplete( editorInstance ) { editorInstance.Events.AttachEvent( 'OnSelectionChange', DoSomething ); } \n" );
					$this->frm_print( "\t</script> \n" );

				
				}
				
	}

	function js_ComboBox() {	
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les Listes Editables -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."combobox/ComboBox.js\"></script>\n" );
	}

	function js_TabPane() {

				$height = '100px';
				$width  = $this->largeuronglet;
				if (!empty($this->frm_tableongletsattributs['height'])) {
					$height   = $this->frm_tableongletsattributs['height'];
				}
				if (!empty($this->frm_tableongletsattributs['width'])) {
					$width   = $this->frm_tableongletsattributs['width'];
					$this->largeuronglet = $width;
				}
				$this->frm_print( "\n<!-- DEFINITION DES STYLES DES ONGLETS -->\n" );
				$this->frm_print( "<link type=\"text/css\" rel=\"StyleSheet\" href=\"".CHEMINRESSOURCES_CF."tabpane/TabPane.css\" /> \n" );

				$this->frm_print( "<!-- Les styles ci-dessous permettent de définir la taille de l'onglet -->\n" );
				$this->frm_print( "<style type=\"text/css\"> \n" );
				$this->frm_print( "\t.dynamic-tab-pane-control .tab-page { z-index: 2; height: ".$height."; width: ".$width.";}\n" );
				$this->frm_print( "</style> \n" );

				$this->frm_print( "\n<!-- CODE JAVASCRIPT DES ONGLETS -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."tabpane/TabPane.js\"></script> \n" );

	}


	function js_Slider_avant() {
		
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les Sliders -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."slider/js/range.js\"></script>\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."slider/js/timer.js\"></script>\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."slider/js/slider.js\"></script>\n" );
				$this->frm_print( "\t<link type=\"text/css\" rel=\"StyleSheet\" href=\"".CHEMINRESSOURCES_CF."slider/css/swing/swing.css\" /> \n" );
				// ACTIVATION DU STYLE "SLIDER"
				$this->frm_print( "\t<script language=\"JavaScript\">\n" );
				$this->frm_print( "\t\t".$this->form_css.".css_slider();\n");
				$this->frm_print( "\t</script>\n" );

	}
	
	function js_Slider_apres() {	
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les Sliders -->\n" );
				$this->frm_print( "\n<SCRIPT language=JavaScript> \n" );
				$this->frm_print( "<!-- \n" );
				
				$this->frm_print( $this->nomduformulaire."_init_sliders();\n" );
				$this->frm_print( "window.onresize = function () {\n" );
				for ($i=0;$i<$this->frm_nbreobjets;$i++) {
					// si l'objet est un "slider"
					if ($this->frm_typeobjet[$i] == OBJET_SLIDER) {
						$this->frm_print( "\tobj_".$this->frm_tableobjets[$i].".recalculate();\n" );
					}
				}
				$this->frm_print( "};\n" );						
				
				$this->frm_print( "function ".$this->nomduformulaire."_init_sliders() { \n" );
				for ($i=0;$i<$this->frm_nbreobjets;$i++) {
					// si l'objet est un "slider"
					if ($this->frm_typeobjet[$i] == OBJET_SLIDER) {
						$this->frm_print( "\tobj_".$this->frm_tableobjets[$i].".setValue(" );
						if ( !empty($this->frm_tableattributs[$i]['default'])) {
							$this->frm_print( $this->frm_tableattributs[$i]['default'] );
						} else {
							$this->frm_print( "0" );
						}
						$this->frm_print( ");\n" );
					}
				}

				$this->frm_print( "}\n" );
				
				$this->frm_print( "// -->\n" );
				$this->frm_print( "</script>\n\n" );	


	}

	function js_Popup() {
		
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les fenetres popup -->\n" );
				$this->frm_print( "\t<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."popup/PopupWindow.js\"></script>\n" );
				$this->frm_print( "\t<script language=\"JavaScript\">\n" );
				$this->frm_print( "\t// Creation des objets PopupWindow (popup, icones, selecteur de couleurs, uploader)\n" );
				for ($i=0;$i<$this->frm_nbreobjets;$i++) {

					switch ($this->frm_typeobjet[$i]) {
					// si l'objet est un "PopUp", un "Selecteur d'icones ou de couleurs"
					case OBJET_POPUP :
					case OBJET_ICONE :
						$nomobj = "obj_".$this->frm_tableobjets[$i];
						$this->frm_print( "\n\tvar $nomobj = new PopupWindow(); \n" );
						$this->frm_print( "\t$nomobj.windowProperties=\"toolbar=no,location=no,status=no,menubar=no,resizable=yes,alwaysRaised,dependent,scrollbars=" );
						if ($this->frm_typeobjet[$i] == OBJET_POPUP) {
							$this->frm_print( "no" );
						} else {
							$this->frm_print( "yes" );
						}
						$this->frm_print( "\"; \n" );
						// analyse des paramatres LARGEUR, HAUTEUR, MODE DE PASSATION DES PARAMETRES VALEUR OU ID

						// si la largeur du champ est connue alors on positionne la fenetre par rapport au bord gauche
						if ( isset($this->frm_tableattributs[$i]['width']) ) {
							$winwidth = $this->_frm_retirer_px($this->frm_tableattributs[$i]['width']);
							$offsetX = $winwidth + 5;
							$this->frm_print( "\t$nomobj.offsetX = -".$offsetX."; \n" );
						} else {
							$winwidth = 240;
						}
					
						if ( !empty($this->frm_tableattributs[$i]['winwidth'])) {
							$winwidth = $this->frm_tableattributs[$i]['winwidth'];
						} 						
						$winheight = 170;
						if ( !empty($this->frm_tableattributs[$i]['winheight'])) {
							$winheight = $this->frm_tableattributs[$i]['winheight'];
						} else {
						}
						// TRAITEMENT DIFFERENT POPUP/ICONE
						if ($this->frm_typeobjet[$i] == OBJET_POPUP) {
							$coderetour = "id";
							if ( isset($this->frm_tableattributs[$i]['return']) ) {
							    $coderetour = htmlspecialchars($this->frm_tableattributs[$i]['return']);	
							}
						} else {
							$coderetour = "value";	
						}
						
						$rows = 10;
						if ( !empty($this->frm_tableattributs[$i]['rows'])) {
							$rows = $this->frm_tableattributs[$i]['rows'];
						}

						$parametres_get = "?FORMULAIRE=$this->nomduformulaire&RETURN=$coderetour&ROWS=$rows&SKIN=$this->frm_skin&WINWIDTH=$winwidth&FIELD=".$this->frm_tableobjets[$i];
						// Fin des parametres obligatoires
						if ( !empty($this->frm_tableattributs[$i]['title'])) {
							$parametres_get = $parametres_get . "&TITLE=".$this->frm_tableattributs[$i]['title'];
						}
						if ( isset($this->frm_tableattributs[$i]['attrib']) )
							if ( !( strpos($this->frm_tableattributs[$i]['attrib'],"R") === false )) {
								$parametres_get = $parametres_get . "&ATTRIB=R";
							}

						// POUR LES ICONES IL PASSER COMME PARAMETRE AUSSI LE CHEMIN DES ICONES
						if ($this->frm_typeobjet[$i] == OBJET_ICONE) {
							if ( !empty($this->frm_tableattributs[$i]['path'])) {
								$parametres_get = $parametres_get . "&PATH=" . $this->frm_tableattributs[$i]['path'];
							}											
						}
						
						$this->frm_print( "\t$nomobj.offsetY = 22;\n" );					
						$this->frm_print( "\t$nomobj.setSize($winwidth,$winheight); \n" );
						$this->frm_print( "\t$nomobj.autoHide(); \n\n" );

						// creation de la fonction immediate sur clic
						$this->frm_print( "\tfunction ".$this->frm_tableobjets[$i]."_Click() {\n" );
						// la variable "urlbase" est calculee au dernier moment
						if ( !empty($this->frm_tableattributs[$i]['url'])) {
	 						$this->frm_print( "\t   var urlbase='".$this->frm_tableattributs[$i]['url']. $parametres_get."'; \n" );
							if ( !empty($this->frm_tableattributs[$i]['param'])) {
		 						$this->frm_print( "\t   var obj = MM_findObj('".$this->frm_tableattributs[$i]['param']."'); if (obj) { urlbase=urlbase+'&PARAM='+obj.value } \n" );
							}
							// quand la valeur par defaut est un id et pas une chaine on la passe en paramatre
							if ( $coderetour=="id" ) {
		 						$this->frm_print( "\t   var obj = MM_findObj('".$this->frm_tableobjets[$i]."'); if (obj) { if (obj.value) urlbase=urlbase+'&DEFAULT='+obj.value } \n" );
							}
							$this->frm_print( "\t   $nomobj.setUrl(urlbase); \n" );
						} else {
							$this->frm_print( "\t   $nomobj.populate(\"<B>ATTENTION :<br>frm_ObjetChampPopup()</b> doit contenir un paramètre 'url'\");\n" );
						}

						$this->frm_print( "\t   ".$nomobj.".showPopup('".$this->frm_tableobjets[$i]."_BTN');\n" );
						$this->frm_print( "\t}\n" );
						break;



					// POUR LES ICONES IL PASSER COMME PARAMETRE AUSSI LE CHEMIN DES ICONES
					case OBJET_COLORPICKER :
						$nomobj = "obj_".$this->frm_tableobjets[$i];
						$this->frm_print( "\n// PARAMETRAGE DE COLORPICKER\n" );
						$this->frm_print( "\n\tvar $nomobj = new PopupWindow(); \n" );
						$this->frm_print( "\t$nomobj.windowProperties=\"toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes,alwaysRaised,dependent\"; \n" );
						$this->frm_print( "\t$nomobj.setSize(650,230); \n" );
						$this->frm_print( "\t$nomobj.offsetY = 22;\n" );					
						$this->frm_print( "\t$nomobj.autoHide(); \n\n" );
										
						// creation de la fonction immediate sur clic
						$this->frm_print( "\tfunction ".$this->frm_tableobjets[$i]."_Click() {\n" );
						// la variable "urlbase" est calculee au dernier moment
						$parametres_get = "?FORMULAIRE=$this->nomduformulaire&FIELD=".$this->frm_tableobjets[$i];							
						if ( !empty($this->frm_tableattributs[$i]['target'])) {
							if (strtoupper($this->frm_tableattributs[$i]['target'])=="TEXT") {
								$parametres_get .= "&TARGET=TEXT";
								$target_text = true;
							} else {
								$parametres_get .= "&TARGET=BACKGROUND";
								$target_text = false;
							}
						}
	 					$this->frm_print( "\t   var urlbase='".CHEMINRESSOURCES_CF."colorpicker/colorpicker.php".$parametres_get ."'; \n" );
	 					$this->frm_print( "\t   var obj = MM_findObj('".$this->frm_tableobjets[$i]."');\n" );
						$this->frm_print( "\t   if (obj) {\n" );
						$this->frm_print( "\t       if (obj.disabled) { alert('Le Sélecteur de couleur est désactivé !'); return; }  \n" );
						$this->frm_print( "\t       if (obj.value) urlbase=urlbase+'&DEFAULT='+obj.value; \n" );
						$this->frm_print( "\t   }\n" );
						$this->frm_print( "\t   $nomobj.setUrl(urlbase); \n" );
						$this->frm_print( "\t   ".$nomobj.".showPopup('".$this->frm_tableobjets[$i]."');\n" );

						$this->frm_print( "\t}\n\n" );
						// CREATION DE LA FONCTION QUI RETABLIT LA VALEUR D'ORIGINE
						$this->frm_print( "\tfunction ".$this->frm_tableobjets[$i]."_Reset() {\n" );
						if ($target_text) {
							$couleurdefaut = "000000";
							if ( isset($this->frm_tableattributs[$i]['default']) ) {
								if ( !empty($this->frm_tableattributs[$i]['default']) )
									$couleurdefaut = $this->frm_tableattributs[$i]['default'];
							}
							$this->frm_print( "\t   var obj=MM_findObj('".$this->frm_tableobjets[$i]."'); if (obj) { obj.style.color = '#".$couleurdefaut."'; }\n" );				
						} else {
							$couleurdefaut = "FFFFFF";
							if ( isset($this->frm_tableattributs[$i]['default']) ) {
								if ( !empty($this->frm_tableattributs[$i]['default']) )
									$couleurdefaut = $this->frm_tableattributs[$i]['default'];
							}								
							$this->frm_print( "\t   var obj = MM_findObj('".$this->frm_tableobjets[$i]."'); if (obj) { obj.style.backgroundColor = '#".$couleurdefaut."'; }\n" );				
						}							
						$this->frm_print( "\t}\n" );
						break;

					}
				}
				$this->frm_print( "\t</script>\n" );
	}

	function js_Separateur() {
		
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les séparateurs -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."foldout/foldout.js\"></script>\n" );
				$this->frm_print( "<style type=\"text/css\"> \n" );
				$this->frm_print( "<!-- \n" );
				$this->frm_print( ".titreheader { \n" );
				$this->frm_print( "	font-family: Arial, Helvetica, sans-serif; \n" );
				$this->frm_print( "	font-size: 14px; \n" );
				$this->frm_print( "	font-weight: bold; \n" );
				$this->frm_print( "	background-color: ".$this->couleurchamperreur ."; \n" );
				$this->frm_print( "	background-position: center; \n" );
				$this->frm_print( " filter: Shadow(color='#777777', Direction=135, Strength=5); \n" );
				$this->frm_print( "} \n" );
				$this->frm_print( "--> \n" );
				$this->frm_print( "</style> \n" );

				// PERSONALISATION DU COMPORTEMENT
				$this->frm_print( "<script type=\"text/javascript\">\n" );
				$this->frm_print( "\tvar collapseprevious=\"" );
				if ($this->frm_Entete_Exclusif)
					$this->frm_print( "yes" );
				else
					$this->frm_print( "no" );
				$this->frm_print( "\"\n</script>\n" );
	}

	function js_Arbre() {
		
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les arbres -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."dtree/dtree.js\"></script>\n" );
				$this->frm_print( "<link type=\"text/css\" rel=\"StyleSheet\" href=\"".CHEMINRESSOURCES_CF."dtree/dtree.css\" /> \n" );
				$this->frm_print( "<style type=\"text/css\"> \n" );
				$this->frm_print( "<!-- \n" );
				$this->frm_print( ".dtree a.nodeSel { color: white; background-color: #B1B1B1; }\n" );
				$this->frm_print( "--> \n" );
				$this->frm_print( "</style> \n" );

	}

	function js_Timer() {
				if ($this->formulaireenlectureseule) return;
				$formatfrench = false;
				$i = $this->_frm_trouveindice($this->objet_timer_nom);
				if ( !empty($this->frm_tableattributs[$i]['format'])) {
					$formatfrench = ($this->frm_tableattributs[$i]['format']=='french');
				} 			
				$this->frm_print( "\n<!-- CODE JAVASCRIPT necessaire pour le champ timer -->\n" );
				$this->frm_print( "<script><!-- \n" );
				$this->frm_print( "var alternate=0; \n" );
				$this->frm_print( "function ".$this->objet_timer_nom."_show(){ \n" );
				$this->frm_print( "	var clockobjhidden=MM_findObj(\"".$this->objet_timer_nom."\"); \n" );
				$this->frm_print( "	var clockobjview=MM_findObj(\"".$this->objet_timer_nom."_VIEW\"); \n" );
				$this->frm_print( "	var Digital=new Date(); \n" );

				$this->frm_print( "	var annee=Digital.getYear(); \n" );
				$this->frm_print( "	if(annee<1000) annee+=1900; \n" );
				$this->frm_print( "	var mois=Digital.getMonth()+1; \n" );
				$this->frm_print( "	var jour=Digital.getDate(); \n" );
				$this->frm_print( "	var hours=Digital.getHours(); \n" );
				$this->frm_print( "	var minutes=Digital.getMinutes(); \n" );
				$this->frm_print( "	var secondes=Digital.getSeconds(); \n" );

				$this->frm_print( "	// ajout du \"0\" devant les mois < 10 \n" );
				$this->frm_print( "	if (mois.toString().length==1) mois=\"0\"+mois; \n" );
				$this->frm_print( "	// ajout du \"0\" devant les jours < 10 \n" );
				$this->frm_print( "	if (jour<=9)	jour=\"0\"+jour; \n" );

				$this->frm_print( "	// ajout du \"0\" devant les heures < 10 \n" );
				$this->frm_print( "	if (hours.toString().length==1) hours=\"0\"+hours; \n" );
				
				$this->frm_print( "	// ajout du \"0\" devant les minutes < 10 \n" );
				$this->frm_print( "	if (minutes<=9)	minutes=\"0\"+minutes; \n" );
				$this->frm_print( "	// ajout du \"0\" devant les secondes < 10 \n" );
				$this->frm_print( "	if (secondes<=9) secondes=\"0\"+secondes; \n" );
				$this->frm_print( " \n" );
				$this->frm_print( "	if (alternate==0) \n" );
				$this->frm_print( "		car_comma = ':'; \n" );
				$this->frm_print( "	else \n" );
				$this->frm_print( "		car_comma = ' '; \n" );
				$this->frm_print( "	clockobjview.value   = hours+car_comma+minutes+car_comma+secondes; \n" );
				if ($formatfrench) {
					$this->frm_print( "	clockobjhidden.value = jour+'/'+mois+'/'+annee+' '+hours+':'+minutes+':'+secondes; \n" );
				} else {
					$this->frm_print( "	clockobjhidden.value = annee+'/'+mois+'/'+jour+' '+hours+':'+minutes+':'+secondes; \n" );
				}
				$this->frm_print( "	alternate=(alternate==0)? 1 : 0 \n" );
				$this->frm_print( "	setTimeout(\"".$this->objet_timer_nom."_show()\",1000); \n" );	
				$this->frm_print( "} \n" );
				$this->frm_print( "//--> \n" );
				$this->frm_print( "  </script> \n" );

	}


	function js_SortSelect()
	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les listes a trier -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."sortselect/sortselect.js\"></script>\n" );
	}

	function js_MultiListe()
	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les listes a choix multiple -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."listemultiselect/multiselect.js\"></script>\n" );
	}

	function js_Uploader()
	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les champs de telechargement -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."uploader/uploaderlib.js\"></script>\n" );
	}
	function js_Uploader_preview()
	{
				$this->frm_print( "\n<!-- CODE JAVASCRIPT EXTERNE necessaire pour les preview de fichiers telecharges -->\n" );
				$this->frm_print( "<script type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."shadowtooltips/shadowtooltips.js\"></script>\n" );
				
				$this->frm_print( "<script type=\"text/javascript\">\n" );
				$this->frm_print( "\tobjShadowToolTips = new showTooltip_init();" );
				$this->frm_print( "\n</script>\n" );
	}


	function css_feuilledestyle_define()
	{
				$this->frm_print( "\n<!-- DEFINITION DES STYLES CSS DU FORMULAIRE -->\n" );
				$this->frm_print( "<script type=\"text/javascript\">\n" );
				$this->frm_print( "\t".$this->form_css." = new css_init('". $this->couleurchampnormal."','".
																$this->couleurchampobligatoire."','".
																$this->couleurchamperreur."','".
																$this->couleurtitre."','".
																$this->couleurfond."','".
																$this->skin_name."','".
																$this->taillepolice."');\n" );
				if ($this->formulaireenlectureseule) {
					$this->frm_print( "\t".$this->form_css.".css_readonly();\n");
				}
				if ($this->objet_uploader_preview>0) {
					$this->frm_print( "\t".$this->form_css.".css_uploader_preview();\n");
				}
				if ($this->mask_datepicker>0 ) {
					$this->frm_print( "\t".$this->form_css.".css_calendar();\n");
				}
				if ($this->objet_onglet>0) {
					$this->frm_print( "\t".$this->form_css.".css_tabs();\n");
				}
				if ($this->objet_editeur>0) {
					$this->frm_print( "\t".$this->form_css.".css_editor();\n");
				}
				
				$this->frm_print( "</script>\n" );
	}
	
	function css_feuilledestyle_show()
	{
				$this->frm_print( "\n<!-- ENVOI DES STYLES CSS DU FORMULAIRE PREALABLEMENT DEFINIS -->\n" );
				$this->frm_print( "<script type=\"text/javascript\">\n" );
				$this->frm_print( "\t".$this->form_css.".css_show();\n");
				$this->frm_print( "</script>\n" );
	}
	
	
	
	
	// fonction de gestion des fenetres appelees par POPUP
	function frm_popup_called($nomtableaujs_ou_php,$fonctionexternejs="",$presenceboutons=true,$seulement_numeriques=true) {

		$this->frm_print( "\n<!-- JAVASCRIPT SYSTEMATIQUE DE LA CLASSE \"ClasseForms\" -->\n" );
		$this->frm_print( "\t<script language=\"JavaScript\" type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."Communs.js\"></script>\n\n" );			
		// Affichage des paramètres GET

		$this->frm_print( "\n<!-- PARAMETRES PASSE PAR L'URL (POUR DEBUGGAGE) --\n" );
		foreach ($_GET as $valeur => $libelle) {
			$this->frm_print( "\n\tGET['".$valeur."'] = ".$libelle );
		}
		$this->frm_print( "\n-->\n\n\n" );	
		$this->frm_print( "\n<!-- TABLEAU PASSE EN PARAMETRE = " );
		$tableau_js = is_string($nomtableaujs_ou_php);
		if ($tableau_js) {
			$this->frm_print( "JAVASCRIPT (".$nomtableaujs_ou_php.") -->\n" );
		} else {
			$this->frm_print( "PHP -->\n" );
		}
		if ( !empty($fonctionexternejs) ) {
			if ( substr($fonctionexternejs,strlen($fonctionexternejs),1)!=";" ) $fonctionexternejs .= ";";
		}

		$this->js_popup_called($tableau_js,$fonctionexternejs,$seulement_numeriques);	
		$this->frm_InitPalette($_GET['SKIN']);
		$this->css_feuilledestyle_define();
		$this->css_feuilledestyle_show();

		$this->frm_print( '<div align="left">' );
		$this->frm_print( "\n<FORM NAME=\"Formulaire\">\n" );
		$this->frm_print( '<SELECT name="Liste" size="'.$_GET['ROWS'] );
		$largeur = $_GET['WINWIDTH'] - 20;
		$this->frm_print( '" onDblClick="Reporter(this,true)" ' );
		$this->frm_print( '" onkeypress="if(quelletouche()==13) Reporter(this,true);" ' );
		$this->frm_print( 'style="width:'.$largeur.'" class="' );
		$this->frm_print( ( isset($_GET['ATTRIB']) ) ? "classeformschampobligatoire" : "classeformschampnormal" );
		$this->frm_print( "\">" );
		if (!$tableau_js) {
			$premiereligne = true;
			foreach ($nomtableaujs_ou_php as $valeur => $libelle) {
				$this->frm_print( "\n<option value=\"".$valeur."\"" );
				// 2 cas : - si presence des boutons alors on selectionne si il existe la valeur par defaut
				//         - si pas de bouton un valeur par defaut est obligatoire si inexistante 
				if ($presenceboutons) {
					if ( isset($_GET['DEFAULT']) ) { if ($valeur==$_GET['DEFAULT']) $this->frm_print( " selected" ); }
				} else {
					if ( isset($_GET['DEFAULT']) ) { 
						if ($valeur==$_GET['DEFAULT']) $this->frm_print( " selected" );  
					} else {
						if ($premiereligne) {
							$this->frm_print( " selected" );
							$premiereligne = false; 
						}
					}
				}
				$this->frm_print( ">".$libelle."</>" );
			}
		}
		$this->frm_print( "\n<script>\n<!--\n" );
		$this->frm_print( "\tparams = getParams(); \n" );
		if ($tableau_js) $this->frm_print( "\tCreateListe(".$nomtableaujs_ou_php."); \n" );
		$this->frm_print( "\n-->\n</script>\n" );
		$this->frm_print( "</SELECT>\n" );
		if ($presenceboutons) {
			$this->frm_print( "<table width=\"".$largeur."\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>" );
			$this->frm_print( "<td><input type=\"button\" name=\"OK\" value=\"OK\" class=\"classeformsminibouton\" onClick=\"Reporter(document.forms[0].Liste,true)\">\n" );
			$this->frm_print( "<input type=\"button\" name=\"Cancel\" value=\"Annuler\" class=\"classeformsminibouton\" onClick=\"self.close()\"></td>" );
			$this->frm_print( "\n<td><div align=\"right\"><input type=\"button\" name=\"Erase\" value=\"Effacer\" class=\"classeformsminibouton\" onClick=\"Reporter(document.forms[0].Liste,false)\">" );
			$this->frm_print( "</div></td></tr></table>" );
		}
		$this->frm_print( "</FORM>\n</div>\n" );
	}
	
	// fonction de gestion javascript des fenetres appelees par POPUP
	function js_popup_called($listejs,$fonctionexternejs,$seulement_numeriques) {
				$this->frm_print( "<SCRIPT language=\"javascript\"> \n" );
				$this->frm_print( "<!-- \n" );
				$this->frm_print( "function getParams() { \n" );
				$this->frm_print( "	var url = document.location.href; \n" );
				$this->frm_print( "	var idx = url.indexOf(\"?\"); \n" );
				$this->frm_print( "	var params = new Array(); \n" );
				$this->frm_print( "	if (idx != -1) { \n" );
				$this->frm_print( "		var pairs = url.substring(idx+1, url.length).split('&'); \n" );
				$this->frm_print( "		for (var i=0; i<pairs.length; i++) { \n" );
				$this->frm_print( "			nameVal = pairs[i].split('='); \n" );
				$this->frm_print( "			params[nameVal[0]] = nameVal[1]; \n" );
				$this->frm_print( "   		} \n" );
				$this->frm_print( "	} \n" );
				$this->frm_print( "	// retourne un hash    params['NomVariable'] = 'valeur' \n" );
				$this->frm_print( "	return params; \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "function Reporter(L,valider) { \n" );		
				$this->frm_print( " if (L.options.selectedIndex!=-1) { \n" );
				$this->frm_print( "   var choix=L.options[L.options.selectedIndex].value; \n" );
				if ($seulement_numeriques) {
					$this->frm_print( "   if (isNaN(choix) && valider) return false; \n" );	
				}
				$this->frm_print( "   if (choix=='-1' && valider) return false; \n" );	
				$this->frm_print( " }\n" );
				$this->frm_print( " valider = valider && (choix); \n" );
				$this->frm_print( " if (params['RETURN']=='id') { \n" );
				$this->frm_print( "   if (valider) { \n" );
				$this->frm_print( "     window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']+'_VIEW'].value=L.options[L.options.selectedIndex].text; \n" );
				$this->frm_print( "     window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']].value=choix; \n" );
				$this->frm_print( "   } else { \n" );
				$this->frm_print( "     window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']+'_VIEW'].value=''; \n" );
				$this->frm_print( "     window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']].value=''; \n" );
				$this->frm_print( "   }\n" );
				$this->frm_print( " } else { \n" );
				$this->frm_print( "   if (valider) { \n" );
				$this->frm_print( "		window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']].value=L.options[L.options.selectedIndex].text;  \n" );
				$this->frm_print( "   } else { \n" );

				$this->frm_print( "     window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']].value=''; \n" );
				$this->frm_print( "   }\n" );
				$this->frm_print( " } \n" );
				$this->frm_print( " ".$fonctionexternejs." \n" );
				$this->frm_print( " self.close();\n" );
				$this->frm_print( "} \n" );
				$this->frm_print( " \n" );
				if ($listejs) {
					$this->frm_print( "function CreateListe(tabvaleurs) { \n" );
					$this->frm_print( " var def=params['DEFAULT']; \n" );
					$this->frm_print( "	for (var i=0; i<tabvaleurs.length; i++) { \n" );
					$this->frm_print( "		document.write('<option value=\"'+tabvaleurs[i][0]+'\"'); \n" );
					$this->frm_print( "		if (def==tabvaleurs[i][0]) document.write('selected'); \n" );
					$this->frm_print( "		document.write('>'); \n" );
					$this->frm_print( "		for (var j=1; j<tabvaleurs[i].length; j++) document.write(tabvaleurs[i][j]+' '); \n" );
					$this->frm_print( "		document.write('</option>'); \n" );
					$this->frm_print( "	} \n" );
					$this->frm_print( "} \n" );
				}
				$this->frm_print( "function quelletouche() {\n" );
				$this->frm_print( " var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode; \n" );
				$this->frm_print( " return keyCode;\n" );
				$this->frm_print( "}\n" );				
				$this->frm_print( "--> \n" );
				$this->frm_print( "</SCRIPT> \n" );
	}
	
	
	// fonction de gestion des fenetres appelees par ICONE
	function frm_icone_popup_called() {
		// Affichage des paramètres GET
		$this->frm_print( "\n<!-- PARAMETRES PASSE PAR L'URL (POUR DEBUGGAGE) --\n" );
		foreach ($_GET as $valeur => $libelle) {
			$this->frm_print( "\n\tGET['".$valeur."'] = ".$libelle  );
		}
		$this->frm_print( "\n-->\n\n\n" );	
		$dir = $_GET['PATH'];
		$this->js_icone_popup_called($_GET['FIELD'],$dir);

		// Ouvre un dossier bien connu, et liste tous les fichiers
		$tabimage = array();
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
					if ( filetype($dir . $file)=='file' ) {
						$path_parts = pathinfo($file);
						$ext = strtolower($path_parts["extension"]);
						if ($ext=='gif' || $ext=='png' || $ext='jpg')	array_push($tabimage, $file);
					}
		        }
		    closedir($dh);
		    }
		} else {
			$this->frm_print( "<b>ERREUR</b> : Aucune icone dans le répertoire spécifié !" );
			$this->frm_print( "( PATH=$dir )" );
		}
		if (empty($tabimage)) return; 
		
		// Affichage des images
		foreach ($tabimage as $ficimage) {
			$this->frm_print( "\n<a href=\"#\" onClick=\"sc('".$ficimage."')\"><img src=\"".$dir.$ficimage."\" title=\"".$ficimage."\"border=\"0\"></a>" );
		}
	}

	function js_icone_popup_called($cible,$path) {
				$this->frm_print( "<script language=\"JavaScript\" type=\"text/JavaScript\"> \n" );
				$this->frm_print( "<!-- \n" );

				$this->frm_print( "function getParams() { \n" );
				$this->frm_print( "	var url = document.location.href; \n" );
				$this->frm_print( "	var idx = url.indexOf(\"?\"); \n" );
				$this->frm_print( "	var params = new Array(); \n" );
				$this->frm_print( "	if (idx != -1) { \n" );
				$this->frm_print( "		var pairs = url.substring(idx+1, url.length).split('&'); \n" );
				$this->frm_print( "		for (var i=0; i<pairs.length; i++) { \n" );
				$this->frm_print( "			nameVal = pairs[i].split('='); \n" );
				$this->frm_print( "			params[nameVal[0]] = nameVal[1]; \n" );
				$this->frm_print( "   		} \n" );
				$this->frm_print( "	} \n" );
				$this->frm_print( "	// retourne un hash    params['NomVariable'] = 'valeur' \n" );
				$this->frm_print( "	return params; \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "function MM_findObj2(n, d) { //v4.01 \n" );
				$this->frm_print( "  var p,i,x;   \n" );
				$this->frm_print( "  if(!d) d=window.opener.document;  \n" );
				$this->frm_print( "  if((p=n.indexOf(\"?\"))>0&&parent.frames.length) { \n" );
				$this->frm_print( "  	d=parent.frames[n.substring(p+1)].document;  \n" );
				$this->frm_print( "	n=n.substring(0,p); \n" );
				$this->frm_print( "  } \n" );
				$this->frm_print( "  if(!(x=d[n])&&d.all) x=d.all[n];  \n" );
				$this->frm_print( "  for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n]; \n" );
				$this->frm_print( "  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); \n" );
				$this->frm_print( "  if(!x && d.getElementById) x=d.getElementById(n); return x; \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "function MM_swapImage2() { //v3.0 \n" );
				$this->frm_print( "  var i,j=0,x,a=MM_swapImage2.arguments; window.opener.document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3) \n" );
				$this->frm_print( "   if ((x=MM_findObj2(a[i]))!=null){window.opener.document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];} \n" );
				$this->frm_print( "} \n" );

				$this->frm_print( "function sc(imagefinale) { // \"swap_and_close\" \n" );
				$this->frm_print( "	MM_swapImage2('".$cible."_IMG','','".$path."'+imagefinale,1); \n" );
				$this->frm_print( "	window.opener.document.forms[params['FORMULAIRE']].elements[params['FIELD']].value='".$path."'+imagefinale; \n" );
				$this->frm_print( "	self.close(); \n" );
				$this->frm_print( "} \n" );
			
				$this->frm_print( "// RECUPERATION DES PARAMETRES \"GET\"\n" );
				$this->frm_print( "	params = getParams(); \n" );
				$this->frm_print( "//--> \n" );
				$this->frm_print( "</script> \n" );
	}
	
	function frm_AvertirEtSortir($message='',$url2go='') {
		$this->frm_print( "\n\n<script language=\"JavaScript\" type=\"text/JavaScript\">" );
		$this->frm_print( "\n<!--" );
		$this->frm_print( "\n\t// Message positionne par la fonction frm_AvertirEtSortir()" );
		$this->frm_print( "\n\talert('".addcslashes($message,"\n\"';")."');" );
		if (!empty($url2go)) {
			$this->frm_print( "\n\twindow.location.href='".$url2go."';" );			
		}
		$this->frm_print( "\n-->" );
		$this->frm_print( "\n</script>\n" );
	}


	function js_timeout() {
		$this->frm_print( "\n<!-- Definition du TIMEOUT -->" );
		$this->frm_print( "\n<script language=\"JavaScript\" type=\"text/javascript\" src=\"".CHEMINRESSOURCES_CF."timeout/timeout.js\"></script>" );			

		$this->frm_print( "\n<script language=\"JavaScript\" type=\"text/JavaScript\">" );
		$this->frm_print( "\n<!--" );
		$this->frm_print( "\n\t".$this->timeout_nomobj." = new AutoRedirection('".$this->timeout_url."',".$this->timeout_tempo.",'".$this->timeout_nomobj."');" );
		if (!empty($this->timeout_idcounteur)) {
			$this->frm_print( "\n\t".$this->timeout_nomobj.".AutoRedirection_idcounter('".$this->timeout_idcounteur."');" );
		}
		if ( substr($this->form_actionencours,1,1)=='1' && empty($this->form_msg_timeout) ) {
			$this->frm_print( "\n\t".$this->timeout_nomobj.".AutoRedirection_stop();" );
		} else {
			$this->frm_print( "\n\t".$this->timeout_nomobj.".AutoRedirection_init();" );
		}
		$this->frm_print( "\n-->" );
		$this->frm_print( "\n</script>\n" );
	}

	function frm_normaliser_attributs($tableau) {
		// pour les activations des champs par les coches et boutons radio on transforme les chaines en tableau a 1 seul élements
		$tableau_out  = array();
		for ($i=0;$i<count($tableau);$i++) {
			if ( is_array($tableau[$i]) ) {
				array_push($tableau_out,$tableau[$i]);
			} else {
				array_push($tableau_out,array($tableau[$i]));
			}
		}
		return $tableau_out;
	}



	function frm_FiltrerCaracteresSpeciaux($string) { 
		$string= strtr($string,  
					   	"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöø°ÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
						"AAAAAAaaaaaaOOOOOOoooooooEEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"); 
		return $string; 
	} 		
		
} // Fin de la classe Forms


?>