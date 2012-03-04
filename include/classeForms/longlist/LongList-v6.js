// Classe d'objets LONGLIST

/*

	  b = new LongList('NOMCHAMP','b','./');		
		b.LongList_LoadList('1','Un','2','Deux','3','Trois','4','Quatre','5','Cinq','6','Six','21','Vingt-et-un','31','Trente-et-un','81','Quatre-vingt-un');
		b.LongList_Size('150px','5');
		b.LongList_Class('classeformschampnormal','classeformschampreadonly');
		b.LongList_AddValue();		
		b.LongList_ReadOnly();
		b.LongList_Show();		
		
		
		MAIS AUSSI POUR LES SCRIPTS EXTERNES :
		b.LongList_ValueIsAdded();

*/


function LongList(ChampDonnees,nomobj,filepath) {	
	this.nomChampDonnees        = ChampDonnees;
	this.objChampDonnees        = MM_findObj(ChampDonnees);
	this.ValeurInitiale         = MM_findObj(ChampDonnees).value;
	this.AjouterValeur          = false;
	this.AjouterTailleMini      = 0;
	this.ReadOnly               = false;
	this.objectsDisabled        = false;
	this.objectsEvents          = '';
	this.objectscript           = '';
	this.attribut               = '';
	this.IsTheValueAdded        = false;
	this.IsAjax                 = false;
	this.UrlAjax                = '';
	this.RechercheAjax          = true;
	this.AjaxBtn                = 'search_btn_'+this.nomChampDonnees;
	this.AjaxBtnValidation      = 'search_btn_validation_'+this.nomChampDonnees;
	this.AjaxAlert              = false;
	this.AjaxDerniereRequete    = '';     // pour ne pas faire plusieurs fois des requetes inutiles
	this.AjaxAjoutPossible      = false;  // pour que l'ajout soit possible
	this.AjaxModeDebug          = false;  // pour voir le fichier XML produit
	
	this.TableauAjaxParams      = new Array();

	this.MinLengthSearch        = 1;
	this.objBtnSearch           = '';
	this.objBtnSearchValidation = '';
	
	if (typeof filepath == 'undefined') {
		this.FilePath             = './';
	} else {
		this.FilePath             = filepath;
	}
	
	this.nomobj                 = nomobj;
	this.nomChampEdit           = ChampDonnees+'_EDIT';
	this.nomChampListe          = ChampDonnees+'_LIST';
	this.TableauTotal           = new Array();

	this.nbreIndices            = 0;
	this.ListWidth              = '100px';
	this.ListMaxLength          = -1;
	this.ListLoadMaxLength      = -1;
	
	this.ListRows               = 5;
	this.ListClass              = '';
	this.ListClassReadOnly      = '';
	this.idNull                 = '-1';
	
	this.icone_raz              = 'erase_filter.gif';
	this.icone_search_ajax      = this.FilePath+'search_on.gif';
	this.icone_search_ajax_off  = this.FilePath+ 'search_off.gif';
	this.icone_add              = this.FilePath+ 'plus4.gif';
	this.icone_add_off          = this.FilePath+ 'plus4_off.gif';
	this.icone_searching_ajax  	= this.FilePath+'ajax-loader_16.gif';
	this.icone_debug            = this.FilePath+'xml.gif';
	this.icone_debug_tips       = 'Cliquer pour voir le fichier XML retourné';
	this.icone_search_tips	    = 'Lancer la recherche';
	this.icone_valid_tips	    = 'Ajouter la valeur saisie';
	this.icone_raz_tips         = 'Effacer le filtre';
	this.icone_undo             = 'list_reset.gif';
	this.icone_undo_tips        = 're-sélectionner le choix initial';
	
	this.flags = 'i'; 


	// INITIALISATION DU HASH VALEUR => "TEXTE"
	this.LongList_LoadList = function() {
		TableIn = this.LongList_LoadList.arguments;
		for (i=0;i<TableIn.length;i++) {
			this.TableauTotal[this.TableauTotal.length] = { _value:TableIn[i], _text:TableIn[i+1] };
			this.ListLoadMaxLength = TableIn[i+1].length;
			i++;
		}
		this.nbreIndices += i;
	};

	// INITIALISATION DE L'URL AJAX
	this.LongList_AjaxUrl = function(_url,_minlen) {
		this.IsAjax  = true;
		this.UrlAjax = _url; 
		this.MinLengthSearch = _minlen;
	}

	// INITIALISATION DU MODE DEBUG
	this.LongList_ModeDebug = function() {
		this.AjaxModeDebug = true;
	}


	// INITIALISATION DU HASH NOM_POST => "expression a evaluer"
	this.LongList_AjaxParams = function() {
		this.TableauAjaxParams = this.LongList_AjaxParams.arguments;
	};
	
	// INITIALISATION DE LA TAILLE DES OBJETS
	this.LongList_Size = function(_width,_rows) {
		this.ListWidth              = _width;
		this.ListRows               = _rows;
	};

	// INITIALISATION DE LA TAILLE DES OBJETS
	this.LongList_MaxLength = function(_ml) {
		this.ListMaxLength          = _ml;
	};

	// INITIALISATION DES EVEMENTS DE L'OBJET
	this.LongList_Events = function(evenements) {
		this.objectsEvents 	        = evenements;
	};

	// INITIALISATION DES EVEMENTS DE L'OBJET
	this.LongList_Script = function(nomscript) {
		this.objectscript = nomscript;
	};


	// INITIALISATION DE LA CLASSE DES OBJETS
	this.LongList_Class = function(_class,_classRO) {
		this.ListClass              = _class;
		this.ListClassReadOnly      = _classRO;
	};

	// INITIALISATION DE LA TAILLE DES OBJETS
	this.LongList_AddValue = function() {
		this.AjouterValeur = true;
	};

	// AJOUT AUTORISE SI + DE x CARACTERES
	this.LongList_AddMinLength = function(_minlen) {
		this.AjouterTailleMini = _minlen;
		if (_minlen>0) {
			this.icone_valid_tips += ' si au minimum '+_minlen+' caractères';
		}
	};



	// L'OBJET EST EN LECTURE SEULE
	this.LongList_ReadOnly = function() {
		this.ReadOnly        = true;
	};

	// L'OBJET EST INACTIF
	this.LongList_Disabled = function() {
		this.objectsDisabled    = true;
	};

	this.LongList_IsTheValueAdded = function() {
		return (this.objChampDonnees.value == this.idNull);
	}

	// AFFICHAGE DES OBJETS
	this.LongList_Show = function(attrib) {
		this.attribut = attrib;
		var objclass = '';
		var objclassRO = '';

		if (this.ListClass!='') {
			var objclass = 'class="'+this.ListClass+'" ';
		}

		if (this.ListClassReadOnly!='') {
			var objclassRO = 'class="'+this.ListClassReadOnly+'" ';
		}
	
		if (this.ReadOnly) {
			objclass = objclassRO = 'class="'+this.ListClassReadOnly+'" ';
		} 
		
	
		var transformation = '';
		if (typeof this.attribut != 'undefined') {		
			switch (this.attribut){
				case 'U':
					transformation = 'text-transform:uppercase;';
					break;
				case 'L':
					transformation = 'text-transform:lowercase;';
					break;
				case 'I':
					transformation = 'text-transform:capitalize;';
					break;
			} 
		}

		// DAND LE CAS OU CETTE OPTION EST SELECTIONNEE L'ID DEVIENT UN NOM POUR PASSER UNE VARIABLE POST
		if (this.AjouterValeur) {
			name_id = 'name';
		} else {
			name_id = 'id';
		}
		if (this.ReadOnly) {
			this.icone_raz              = 'off_erase_filter.gif';
			this.icone_raz_tips         = '';
			this.icone_undo             = 'off_list_reset.gif';
			this.icone_undo_tips        = '';		
			document.write('<input '+name_id+'="'+this.nomChampEdit+'" type="hidden" value="">' );
			document.write('<input '+name_id+'="'+this.nomChampEdit+'" type="text" value=""  style="'+transformation+'width:'+this.ListWidth+'" ReadOnly="true"' );
		} else {
			// la fonction de filtrage n'est pas la meme en mode AJAX
			if (this.IsAjax) {
				var fctfiltre = '.LongList_filter_ajax()';
			} else {
				var fctfiltre = '.LongList_filter()';
			}			
			document.write('<input '+name_id+'="'+this.nomChampEdit+'" type="text" value=""  style="'+transformation+'width:'+this.ListWidth+'" '+this.objectsEvents+' onKeyUp="'+this.nomobj+fctfiltre+'"' );
			if (this.objectsDisabled) {
				document.write('disabled="true" ');
			}
			if (this.ListMaxLength!=-1) {
				document.write('maxlength="'+this.ListMaxLength+'" ');
			}
		}

		document.write( objclassRO+'>&nbsp;' );
		// AFFICHAGE DES BOUTONS GRAPHIQUES
		if (this.ReadOnly) {
			document.write('<img src="'+this.FilePath+this.icone_raz+'" border="0">' );
			document.write('<img src="'+this.FilePath+this.icone_undo+'" border="0">' );
		} else {
			if (this.IsAjax) {
				// si la recherche est automatique a partir de 1 caractere l'icone devient inutile
				if (this.MinLengthSearch!=1) {
					if (this.MinLengthSearch!=-1) {
						this.icone_search_tips += ' (automatique à partir de '+this.MinLengthSearch+' caractères)';
					}
					document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.LongList_search()"><img id="'+this.AjaxBtn +'" src="'+this.icone_search_ajax_off+'" border="0" title="'+this.icone_search_tips+'"></a>&nbsp;' );
					this.objBtnSearch = MM_findObj(this.AjaxBtn);
				}
				if (this.AjouterValeur) {
					document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.LongList_search_validation()"><img id="'+this.AjaxBtnValidation +'" src="'+this.icone_add_off+'" border="0" title="'+this.icone_valid_tips+'"></a>&nbsp;' );
					this.objBtnSearchValidation = MM_findObj(this.AjaxBtnValidation);
				}
				// Si le mode debug AJAX est activé
				if (this.AjaxModeDebug) {						
					document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.LongList_getxml()"><img src="'+this.icone_debug+'" border="0" title="'+this.icone_debug_tips+'"></a>&nbsp;' );
				}

			}
			document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.LongList_raz()"><img src="'+this.FilePath+this.icone_raz+'" border="0" title="'+this.icone_raz_tips +'"></a>' );
			document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.LongList_reset_and_focus()"><img src="'+this.FilePath+this.icone_undo+'" border="0"title="'+this.icone_undo_tips +'"></a>' );
		}
		document.write('<br><select id="'+this.nomChampListe+'" size="'+this.ListRows +'" style="'+transformation+'width:'+this.ListWidth+'"' );

		// DES EVENEMENTS SONT DEJA PROGRAMMES PAR LE PHP, ON RAJOUTE A onClick() LE TRAITEMENT SUR LA LISTE
		rx = new RegExp("onClick=\"", "");
		document.write(this.objectsEvents.replace(rx, 'onClick="'+this.nomobj+'.LongList_onClickEvent();'));
		document.write(' onChange="'+this.nomobj+'.LongList_onChangeEvent()" ' );
		if (this.objectsDisabled) {
			document.write('disabled="true" ');
		}
		document.write( objclass );
		document.write('></select>');
		// LES OBJECTIFS VIENNENT DE NAITRE ON PEUT LES MEMORISER MAIS PAS AVANT

		this.objChampEdit           = MM_findObj(this.nomChampEdit);
		this.objChampListe          = MM_findObj(this.nomChampListe);
		this.LongList_InitListe(this.ValeurInitiale,true);
	};


	// INITIALISATION DE LA LISTE AU DEBUT
	this.LongList_InitListe = function(valeur_a_trouver,premier_appel) {
		var ol = this.objChampListe;
		if (this.IsAjax) {
			// traitement de la liste AJAX
			if (this.objChampDonnees.value!='') {
				// chargement AJAX sur l' ID
				this.LongList_ajaxloading(false);
			} else {
			}
			if (premier_appel && ol.length==0) {
				this.objChampEdit.className  = this.ListClass;
				this.objChampListe.className = this.ListClassReadOnly;			
			} else {
		//		this.objChampEdit.className  = this.ListClassReadOnly;
				this.objChampListe.className = this.ListClass;			
			}
			if (this.objectscript!='') {
				eval(this.objectscript);
			}
		} else {
			// traitement de la liste normale (pré-chargée)
			var trouve=0;
			ol.length = this.TableauTotal.length; 
			for (var i=0;i<this.TableauTotal.length;i++) {
				ol.options[i].value = this.TableauTotal[i]._value;
				ol.options[i].text  = this.TableauTotal[i]._text;
				if (this.TableauTotal[i]._value==valeur_a_trouver) { 
					trouve++;
					ol.options[i].selected = true;
					this.objChampEdit.value = this.TableauTotal[i]._text;
				} else {
					ol.options[i].selected = false;
				}
			}
			if (premier_appel && this.AjouterValeur && (trouve==0)) {
				this.objChampEdit.className  = this.ListClass;
				this.objChampListe.className = this.ListClassReadOnly;			
				this.objChampEdit.value    = valeur_a_trouver;
				this.objChampDonnees.value = this.idNull;
				// si un script a ete defini il est executé
				if (this.objectscript!='') {
					eval(this.objectscript);
				}	
			}
		}
	}

	// QUAND ON CHANGE LA LIGNE ACTIVE DE LA LISTE 
	this.LongList_onChangeEvent = function() {
		this.LongList_List2field();
	}
	
	// QUAND ON CLIQUE SUR UNE LIGNE DE LA LISTE
	this.LongList_onClickEvent = function() {
		//if (this.objChampListe.length==1) {
			this.LongList_List2field();
		// }
	}

	// QUAND ON CHANGE UNE VALEUR DE LA LISTE LISTE 
	
	// ..ON COPIE LA VALEUR DANS LA ZONE DE FILTRE
	this.LongList_List2field = function() {
		if (this.ReadOnly) {
			this.LongList_InitListe(this.ValeurInitiale,false);
		}
		var ol = this.objChampListe;		
		// RECUPERATION DE LA VALEUR DE LA LISTE ET DE SON CHAMP TEXTE
		if (this.IsAjax) {
			this.AjaxAjoutPossible = false;	
			this.LongList_validbtn_state();
			// traitement de la liste AJAX
			var valeur_a_trouver = ol.value;
			for (var i=0;i<ol.length;i++) {
				if (valeur_a_trouver==ol.options[i].value) { 
					this.objChampEdit.value    = ol.options[i].text;
					this.objChampDonnees.value = valeur_a_trouver;
					if (this.AjouterValeur) {
						this.objChampEdit.className = this.ListClassReadOnly;
						this.objChampListe.className = this.ListClass;		
					}
					// si un script a ete defini il est executé
					if (this.objectscript!='') {
						eval(this.objectscript);
					}	
					this.RechercheAjax = false;
					return;
				}
			}
			
		} else {
			// traitement non ajax
			for (var i=0;i<this.TableauTotal.length;i++) {
				if (this.TableauTotal[i]._value==ol.value) { 
					this.objChampEdit.value    = this.TableauTotal[i]._text;
					this.objChampDonnees.value = this.TableauTotal[i]._value;
					if (this.AjouterValeur) {
						this.objChampEdit.className = this.ListClassReadOnly;
						this.objChampListe.className = this.ListClass;		
					}
					// si un script a ete defini il est executé
					if (this.objectscript!='') {
						eval(this.objectscript);
					}		
					return;
				}
			}
		}
	}

	/* quand on appuie sur la croix 2 comportements différents :
		- non ajax, le filtre est effacé et la liste affiché en entier
		- ajax, le filtre est effacé et la liste aussi
	*/
	
	this.LongList_raz = function() {
		if ( !(typeof EtatVerrouillerFormulaire == 'undefined') ) {
			if (EtatVerrouillerFormulaire) return;
		}
		if (this.ReadOnly || this.objChampEdit.disabled) {
			return;
		}		
		this.objChampEdit.value    = '';
		this.objChampDonnees.value = '';
		this.IsTheValueAdded       = false;
		if (this.IsAjax) {
			var ol = this.objChampListe;		
			ol.length=0;
			this.objChampEdit.className  = this.ListClass;
			this.objChampListe.className = this.ListClassReadOnly;
			this.AjaxDerniereRequete     = '';
		} else {
			this.LongList_InitListe('',false);
			this.objChampEdit.className  = this.ListClassReadOnly;
			this.objChampListe.className = this.ListClass;
		}
		// si un script a ete defini il est executé
		if (this.objectscript!='') {
			eval(this.objectscript);
		}
		this.AjaxAjoutPossible = false;
		this.LongList_validbtn_state();
		this.LongList_searchbtn_state();
		this.objChampEdit.focus();
	}


	// quand on appuie sur la fleche en retrait
	this.LongList_reset_and_focus = function() {
		this.LongList_reset();
		if (!this.objChampListe.readOnly && !this.objChampListe.disabled) { 		
			this.objChampListe.focus();
		}		
	}
	
	this.LongList_reset = function() {
		if ( !(typeof EtatVerrouillerFormulaire == 'undefined') ) {
			if (EtatVerrouillerFormulaire) return;
		}
		if (this.objChampEdit.disabled) {
			return;
		}
		this.AjaxDerniereRequete     = '';
		this.objChampEdit.value    = '';
		this.LongList_searchbtn_state();
		this.objChampDonnees.value = this.ValeurInitiale;
		this.RechercheAjax = true;

		this.LongList_InitListe('',true);
		this.AjaxAjoutPossible = false;
		this.LongList_validbtn_state();
		
		// si un script a ete defini il est executé
		if (this.objectscript!='') {
			eval(this.objectscript);
		}

	}

	// fonction appelee quand on clique sur le bouton "rechercher"
	this.LongList_search = function() {
		if (this.objChampEdit.value<this.MinLengthSearch || this.objChampEdit.disabled) return;
		this.LongList_ajaxloading(true);
	}

	// fonction appelee quand on clique sur le bouton "XML" de debuggage
	this.LongList_getxml = function() {
		if (this.objChampEdit.disabled) {
			alert('Objet inactif');
			return;
		}
		var NouvelleRequete = 'TEXT='+this.LongList_sansAccent_pour_Ajax(this.objChampEdit.value);
		
		// LA REQUETE PEUT MAINTENANT COMMENCER
		
		// transformation du bouton de recherche en bouton animé
		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		var _objChampListe = this.objChampListe ;

// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				alert(XmlDoc.responseText); 
			}
		} // fin de methode "onreadystatechange" modifie pour le debuggage
		
		XmlDoc.open("POST",this.UrlAjax,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		
		var param_supp = '';
		// si des parametres supplementaires ont ete definis
		for (var i=0;i<this.TableauAjaxParams.length;i++) {
			param_supp = param_supp+'&'+this.TableauAjaxParams[i]+'='+encodeURIComponent(AccentToNoAccent(eval(this.TableauAjaxParams[i+1])));
			i++;
		}
		XmlDoc.send(NouvelleRequete+param_supp);
				

}



	// cette fonction est appelée quand on clique sur le PLUS
	this.LongList_search_validation = function() {
		if (this.objChampEdit.disabled) return;
		if (this.objChampEdit.value=='') {
			alert('Aucune valeur à ajouter');
		} else {
			this.objChampEdit.className   = this.ListClass;
			this.objChampListe.className  = this.ListClassReadOnly;			
			// attribut applique au champ EDIT
			this.objChampEdit.value = this.LongList_attribfilter(this.objChampEdit.value);
			this.objChampDonnees.value =this.idNull;
			this.objChampListe.length=0;		
		}
		this.AjaxAjoutPossible = false;
		// si un script a ete defini il est executé
		this.LongList_script_eval();
		this.LongList_validbtn_state();

	}

// fonction de chargement de la liste
	this.LongList_ajaxloading = function(recherche_texte) {
//		alert('loading');
		if (!this.RechercheAjax) return;
		// preparation de la requete POST executer plus bas
		if (recherche_texte) {
			var NouvelleRequete = 'TEXT='+this.LongList_sansAccent_pour_Ajax(this.objChampEdit.value);
		} else {
			var NouvelleRequete = 'VALUE='+this.LongList_sansAccent_pour_Ajax(this.objChampDonnees.value);
		}
		if (NouvelleRequete==this.AjaxDerniereRequete) return;
		
		// LA REQUETE PEUT MAINTENANT COMMENCER
		
		// transformation du bouton de recherche en bouton animé
		this.objBtnSearch.src=this.icone_searching_ajax;
		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		var _objChampListe = this.objChampListe ;
		// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				reponse = DOM_clean(XmlDoc.responseXML.documentElement);
				//------------------------------------------------------------------		
			
				var ol = _objChampListe;
				
				x=reponse.getElementsByTagName('option');
				ol.length = x.length; 
				cpt_ok    = 0;
				for (i=0;i<x.length;i++) {
					if (x[i].childNodes[0]) {
						// recuperation de l'attribut qui contient "value" de l'option
						ol.options[cpt_ok].value = x[i].attributes.getNamedItem("value").nodeValue;
						// recuperation de la valeur qui contient "text" de l'option
						ol.options[cpt_ok].text  = x[i].childNodes[0].nodeValue;
						ol.options[cpt_ok].selected  = false;
						cpt_ok++;
					}
				}
				ol.length = cpt_ok; 
				eval(_obj_to_call+'.LongList_after_ajax()');
				//------------------------------------------------------------------
			}
		} // fin de methode "onreadystatechange"
		
		XmlDoc.open("POST",this.UrlAjax,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		
		var param_supp = '';
		// si des parametres supplementaires ont ete definis
		for (var i=0;i<this.TableauAjaxParams.length;i++) {
			param_supp = param_supp+'&'+this.TableauAjaxParams[i]+'='+encodeURIComponent(AccentToNoAccent(eval(this.TableauAjaxParams[i+1])));
//			&CHAMP1='+escape(MM_findObj('textfield').value)
			i++;
		}
		XmlDoc.send(NouvelleRequete+param_supp);
		this.AjaxDerniereRequete = NouvelleRequete;
				
	}

	// fonction appelee en fin de requete AJAX
	this.LongList_after_ajax = function() {
		cpt_ok = this.objChampListe.length;
		this.AjaxAjoutPossible = false;
		var champ = this.objChampEdit;
		// si aucune valeur n'a ete trouvee
		if (cpt_ok==0) {
			if (this.AjouterValeur) {
				// si le champ a au minimum X caracteres
				if (this.objChampEdit.value.length>=this.AjouterTailleMini) {
					this.objChampEdit.className   = this.ListClass;
					this.objChampListe.className  = this.ListClassReadOnly;
					this.objChampDonnees.value    = this.idNull;
				}
			} else {
				this.objChampDonnees.value = '';
			}
			this.objBtnSearch.src=this.icone_search_ajax_off;
			if (this.AjaxAlert) {
				alert('Aucun enregistrement trouvé !');
			}
		// si une valeur au moins a ete trouvee
		} else {					
			this.objBtnSearch.src=this.icone_search_ajax_off;
			this.objChampEdit.className   = this.ListClassReadOnly;
			this.objChampListe.className  = this.ListClass;
			this.RechercheAjax = false;
			if (cpt_ok==1) {
				// dans le cas ou il n'y a qu'un seul enregistrement on le selectionne
				this.objChampListe.options[0].selected  = true;
				this.objChampDonnees.value = this.objChampListe.options[0].value;
				this.AjaxAjoutPossible = (this.objChampListe.options[0].text!=this.objChampEdit.value && this.objChampEdit.value.length>0);
				
			} else {
				if (this.AjouterValeur) {
					this.objChampEdit.className   = this.ListClassReadOnly;
					this.objChampListe.className  = this.ListClass;
					// on peut ajouter la valeur que si taille minimum
					this.AjaxAjoutPossible = (this.objChampEdit.value.length>=this.AjouterTailleMini);
				}
				this.objChampDonnees.value = '';
			}
		}
		// si un script a ete defini il est executé
		this.LongList_script_eval();

		this.LongList_validbtn_state();
		
/*		
		// ATTENTION si on active le focus le RESET formulaire ne fonctionne plus
		if (!champ.disabled && ! champ.Readonly) {
			 champ.focus();
		}
*/
	}

	// application de la transformation en fonction de l'attribut
	this.LongList_attribfilter = function(chaine) {
		if (typeof this.attribut != 'undefined') {		
			switch (this.attribut){
				case 'U':
					chaine = chaine.toUpperCase(); 
					break;
				case 'L':
					chaine = chaine.toLowerCase(); 
					break;
				case 'I':
			} 
		}
		return chaine;
	}

	// cette fonction est appelée a chaque touche dans le champ "filtre"
	this.LongList_filter = function() {
		fv=this.LongList_attribfilter(this.objChampEdit.value); 
		// suppresion des espaces en début et fin et remplacement des espaces multiples en 1 seul
		fv=fv.replace(/^\s*|\s*$/g,""); 
		fv=fv.replace(/\s+/g," "); 
		if (fv=='') {
			this.objChampEdit.value = '';
		}
		this.LongList_searchbtn_state();
		if (this.objChampEdit.value=='') {
			this.LongList_raz();
			return;
		}
		this.LongList_searchbtn_state();
			
		// Initialize the regexp 
		var _RegExp = new RegExp(this.objChampEdit.value, 'i'); 
		var ol = this.objChampListe;
		var j=0;
		var correspondance_exacte = false;
		var correspondance_id     = -1;
		ol.length = this.TableauTotal.length;
		for (var i=0;i<this.TableauTotal.length;i++) {
			if (_RegExp.test(this.TableauTotal[i]._text)) {
				ol.options[j].value = this.TableauTotal[i]._value;
				ol.options[j].text  = this.TableauTotal[i]._text;
				ol.options[j].selected = false;
				j++;
				if ( this.objChampEdit.value.toUpperCase()==this.TableauTotal[i]._text.toUpperCase()) {
					correspondance_exacte = true;
					correspondance_id     = i;
				}
			}
		}
		ol.length = j;
		if (this.AjouterValeur) {
			// si j est nul c'est qu'on a rien trouvé dans la liste devenu vide
			if (j==0 && this.objChampEdit.value.length>=this.AjouterTailleMini) {
				this.IsTheValueAdded         = true;
				this.objChampListe.className = this.ListClassReadOnly;				
			} else {
				this.IsTheValueAdded         = false;
				this.objChampListe.className = this.ListClass;
			}
			// on teste si il y a correspondance exacte
			if (correspondance_exacte) {
				this.objChampDonnees.value   = this.TableauTotal[correspondance_id]._value;
				this.objChampEdit.value      = this.TableauTotal[correspondance_id]._text;
				this.objChampEdit.className  = this.ListClassReadOnly;				
				ol.options[0].selected = true;
			} else {
				if (this.objChampEdit.value!='' && this.objChampEdit.value.length>=this.AjouterTailleMini) {
					this.objChampDonnees.value   = this.idNull;
					this.objChampEdit.className  = this.ListClass ;
				} else {
					this.objChampDonnees.value   = '';
					this.objChampEdit.className  = this.ListClassReadOnly ;
				}
			}
			this.LongList_script_eval();

		} else {
			// si on n'est pas en mode "AJOUT" et que rien ne correspond au filtre on efface le champ de donnnées
			if (j==0) {
				this.objChampDonnees.value = '';

			}
		}
	}

	// cette fonction est appelée a chaque touche dans le champ "filtre" en mode ajax
	this.LongList_filter_ajax = function() {
		this.objChampEdit.value = this.LongList_attribfilter(this.objChampEdit.value)
		fv=this.objChampEdit.value; 
		fv=fv.replace(/^\s*|\s*$/g,""); 
		fv=fv.replace(/\s+/g," "); 
		if (fv=='') {
			this.objChampEdit.value = '';
		}		
		this.RechercheAjax = true;
		
		this.LongList_searchbtn_state();
		if (this.objChampEdit.value=='') {
			this.LongList_raz();
			return;
		}
		// si le nombre de caractères tapés est supérieur à la limite alors appeler le chargement AJAX
		if (this.objChampEdit.value.length>=this.MinLengthSearch && this.MinLengthSearch!=-1) {
			// recherche "TEXTE"
			this.LongList_ajaxloading(true);	
		} else {
			this.objChampEdit.className   = this.ListClassReadOnly;
			this.objChampListe.className  = this.ListClassReadOnly;
			// si un script a ete defini il est executé
			this.LongList_script_eval();

		}
		this.LongList_searchbtn_state();
	}
	
	this.LongList_sansAccent_pour_Ajax = function(str) {
		return AccentToNoAccent(str);
	}

	// cette fonction est appelée pour mettre a jour le bouton AJAX "recherche"
	this.LongList_searchbtn_state = function() {
		if (!this.IsAjax || this.ReadOnly ) return;
		if (this.RechercheAjax) {
			this.objBtnSearch.src = this.icone_search_ajax;
		} else {
			this.objBtnSearch.src = this.icone_search_ajax_off;
		}
	}

	// cette fonction est appelée pour mettre a jour le bouton AJAX "valider l'ajout"
	this.LongList_validbtn_state = function() {
		if (!this.IsAjax || this.ReadOnly ) return;
		if (this.AjaxAjoutPossible) {
			this.objBtnSearchValidation.src = this.icone_add;
		} else {
			this.objBtnSearchValidation.src = this.icone_add_off;
		}
	}

	// cette fonction est appelée pour evaluer un eventuel script
	this.LongList_script_eval = function() {
	// si un script a ete defini il est executé
		if (this.objectscript!='') {
			eval(this.objectscript);
		}
	}
	
	
};   // Fin de classe LongList









