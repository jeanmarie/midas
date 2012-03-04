// Classe d'objets LONGLIST

/*

	  b = new CascadingLists('NOMCHAMP',...);		
		
		
		MAIS AUSSI POUR LES SCRIPTS EXTERNES :
		b.CascadingLists_erase(); // qui efface toutes les listes

*/


function CascadingLists(ChampDonnees,nomobj,filepath) {	
	this.nomChampDonnees        = ChampDonnees;
	this.nomobj                 = nomobj;
	this.idChampList            = ChampDonnees+'_LIST_';
	this.idChampNiveau          = ChampDonnees+'_LEVEL';
	this.idIconeAjax            = ChampDonnees+'_SEARCHING_';
	this.FilePath               = filepath;
	this.objChampDonnees        = MM_findObj(ChampDonnees);
	this.objChampNiveau         = false;
	this.ValeurInitiale         = this.objChampDonnees.value;	
	this.NiveauEnCours          = -1;
	this.ReadOnly               = false;
	this.objectsDisabled        = false;
	this.AjaxModeDebug          = false;
	this.MultiLevel             = false;
	this.ShowBtnErase           = false;
	this.ShowBtnReset           = false;
	this.DefaultLevelChaine     = '';
	this.DefaultLevelNum        = 0;
	this.niveaudefaut           = '';
	this.objectsEvents          = '';
	this.UrlAjax                = '';
	this.clefroot               = '';

	this.ListClass              = '';
	this.ListClassReadOnly      = '';
	this.ListOrientation        = 'V';
	this.ListAttributs          = Array();
	this.ListNombre             = 0;
	this.TableauRacine          = Array();
	this.TableauObjetListe      = Array();
	this.TableauAjaxParams      = Array();

	this.icone_searching_on  	= this.FilePath+'ajax-loader_16.gif';
	this.icone_searching_off  	= this.FilePath+'blank.gif';
	this.icone_debug            = this.FilePath+'xml.gif';
	this.icone_debug_tips       = 'MODE DEBUG ACTIF : Cliquer pour voir le fichier XML retourné';
	this.icone_erase            = this.FilePath+'erase_choice.gif';
	this.icone_reset            = this.FilePath+'reset_choice.gif';
	this.icone_erase_tips       = 'Effacer les listes';
	this.icone_reset_tips       = 're-sélectionner le choix initial';	
	
	// INITIALISATION DU HASH VALEUR => "TEXTE"
	this.CascadingLists_LoadList = function() {
		TableIn = this.CascadingLists_LoadList.arguments;
		for (i=0;i<TableIn.length;i++) {
			this.TableauRacine[this.TableauRacine.length] = { _value:TableIn[i], _text:TableIn[i+1] };
			i++;
		}
		this.nbreIndices += i;
	};


	
	// INITIALISATION DE L'URL AJAX
	this.CascadingLists_AjaxUrl = function(_url,_minlen) {
		this.UrlAjax = _url; 
	}

	this.CascadingLists_InitRootList = function(_clefroot) {
		this.clefroot = _clefroot;
	}

	// INITIALISATION DU MODE DEBUG
	this.CascadingLists_ModeDebug = function() {
		this.AjaxModeDebug = true;
	}

	// INITIALISATION DU BOUTON ERASE
	this.CascadingLists_BtnErase = function() {
		this.ShowBtnErase = true;
	}

	// INITIALISATION DU BOUTON ERASE
	this.CascadingLists_BtnReset = function() {
		this.ShowBtnReset = true;
	}

	
	// INITIALISATION DES EVEMENTS DE L'OBJET
	this.CascadingLists_Events = function(evenements) {
		this.objectsEvents 	        = evenements;
	};
	
	// INITIALISATION DE LA CLASSE DES OBJETS
	this.CascadingLists_Class = function(_class,_classRO) {
		this.ListClass              = _class;
		this.ListClassReadOnly      = _classRO;
	};
	// INITIALISATION DE L'ORIENTATION DES LISTES
	this.CascadingLists_Orientation = function(H_ou_V) {
		this.ListOrientation       = H_ou_V;
	};

	// INITIALISATION D'UNE LISTE
	this.CascadingLists_AddList = function(id,title,width,url) {
		this.ListAttributs[this.ListAttributs.length] = { _id:id, _title:title, _width:width, _url:url };
		this.ListNombre ++;		
	};

	// RECUPERATION DU NIVEAU NUMERIQUE CORRESPONDANT A LA CHAINE
	this.CascadingLists_ListLevel = function(_DefaultLevel) {
		for (i=0;i<this.ListAttributs.length;i++) {
			if (_DefaultLevel==this.ListAttributs[i]._id) return i;
		}
		return -1;
	};


	// INITIALISATION DU HASH NOM_POST => "expression a evaluer"
	this.CascadingLists_AjaxParams = function() {
		this.TableauAjaxParams = this.CascadingLists_AjaxParams.arguments;
	};
	

	// L'OBJET EST EN LECTURE SEULE
	this.CascadingLists_ReadOnly = function() {
		this.ReadOnly        = true;
	};

	// L'OBJET EST EN MODE MULTI-NIVEAU
	this.CascadingLists_MultiLevel = function(_levelfield) {
		this.idChampNiveau     = _levelfield;
		this.MultiLevel        = true;
	};
	// INITALISATION DU NIVEAU PAR DEFAUT
	this.CascadingLists_DefaultLevel = function(_DefaultLevel) {
		this.DefaultLevelChaine      = _DefaultLevel;
	};


	// L'OBJET EST DESACTIVE AU DEBUT
	this.CascadingLists_Disabled = function() {
		this.objectsDisabled = true;
	};

	// RECUPERATION EN 1 SEULE CHAINE DE LA LISTE DES PARAMETRES
	this.CascadingLists_AutresParametres = function() {
		var param_supp = '';
		// si des parametres supplementaires ont ete definis
		for (var i=0;i<this.TableauAjaxParams.length;i++) {
			param_supp = param_supp+'&'+this.TableauAjaxParams[i]+'='+encodeURIComponent(eval(this.TableauAjaxParams[i+1]));
			i++;
		}
		return param_supp;
		
	};





// AFFICHAGE DES OBJETS
	this.CascadingLists_Show = function(attrib) {
		this.attribut  = attrib;
		var objclass   = '';
		var objclassRO = '';

		// DANS LE CAS DE LA GESTION MULTI-NIVEAU ON AJOUTE UN CHAMP CACHE QUI MEMORISE LE NIVEAU CORRESPONDANT A L'ID
		if (this.MultiLevel) {
			document.write('<input type="hidden" name="'+this.idChampNiveau+'" value="'+this.DefaultLevelChaine+'">' );
			this.objChampNiveau    = MM_findObj(this.idChampNiveau);

		}
		if (this.ListClass!='') {
			var objclass = 'class="'+this.ListClass+'" ';
		}

		if (this.ListClassReadOnly!='') {
			var objclassRO = 'class="'+this.ListClassReadOnly+'" ';
		}
	
		if (this.ReadOnly) {
			objclass = objclassRO = 'class="'+this.ListClassReadOnly+'" ';
		} 
		
		
		// affichage des listes les une apres les autres
		for (i=0;i<this.ListNombre;i++) {
			if (this.ListOrientation=='V' && (i>0)) {
				document.write('<br>' );
			}
			document.write('<select id="'+this.idChampList+i+'" size="1" style="width:'+this.ListAttributs[i]._width+'"' );
			// DES EVENEMENTS SONT DEJA PROGRAMMES PAR LE PHP, ON RAJOUTE A onClick() LE TRAITEMENT SUR LA LISTE
			if (!this.ReadOnly) {
				rx = new RegExp("onClick=\"", "");
				document.write(this.objectsEvents.replace(rx, 'onClick="'+this.nomobj+'.CascadingLists_onClickEvent('+i+');'));
				document.write(' onChange="'+this.nomobj+'.CascadingLists_onChangeEvent('+i+',true)" ' );
				if (this.objectsDisabled) {
					document.write('disabled="true" ');
				}			
			}
			// quand pas de valeur par defaut RO pour tous sauf la 1er
			if (this.ValeurInitiale=='') {
				if (i>0) {
					document.write( objclassRO );
				} else {
					document.write( objclass );
				}
			// quand il y a une valeur par defaut, RO pour tous sauf la dernier
			} else {
				document.write( objclass );
			}
			document.write('>');
			document.write('<option value="">'+this.ListAttributs[i]._title+'</>');
			if (i==0) {
				for (j=0;j<this.TableauRacine.length;j++) {
				 	document.write('<option value="'+this.TableauRacine[j]._value+'">'+this.TableauRacine[j]._text+'</>');
				}
				
			}
			document.write('</select>');
	
			// memorisation de l'objet "liste" nouvellement cree dans un tableau
			this.TableauObjetListe[i] = MM_findObj(this.idChampList+i);

			if ( (this.ListOrientation=='H' && i==this.ListNombre-1) || this.ListOrientation=='V') {
				document.write('<img id="'+this.idIconeAjax+i+'" src="'+this.icone_searching_off+'">');
			}
			// Si le mode debug AJAX est activé
			if (this.AjaxModeDebug) {						
				document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.CascadingLists_getxml('+i+')"><img src="'+this.icone_debug+'" border="0" title="'+this.icone_debug_tips+'"></a>&nbsp;' );
			}
		} // fin de boucle sur la creation des listes

		// affichage des boutons de commande
		if (this.ShowBtnErase) {
			document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.CascadingLists_erase()"><img src="'+this.icone_erase+'" border="0" title="'+this.icone_erase_tips+'"></a>' );			
		}

		if (this.ShowBtnReset) {
			document.write('<a href="javascript:void(0)" onClick="'+this.nomobj+'.CascadingLists_reset('+i+')"><img src="'+this.icone_reset+'" border="0" title="'+this.icone_reset_tips+'"></a>' );			
		}
		if (this.TableauRacine.length==0) {
			this.CascadingLists_LoadListAjax();
		}

		if (this.ValeurInitiale!='') {
			if (this.MultiLevel) {
				this.CascadingLists_GetMultiLevelDefaultValue();
			} else {
				this.CascadingLists_GetDefaultValue();
			}
		}

	}; // fin de methode show()



	// INITIALISATION DU HASH VIA AJAX
	this.CascadingLists_LoadListAjax = function() {
		level = 0;
		// preparation de la requete POST executer plus bas
		var NouvelleRequete = 'LEVEL='+this.clefroot;

		var _objChampListe = this.TableauObjetListe[0];
		if (!_objChampListe) return;
//		_objChampListe.disabled = true;
 
		// LA REQUETE PEUT MAINTENANT COMMENCER
		
		// transformation du bouton de recherche en bouton animé
		this.CascadingLists_MajIcone(level,true);

		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		var _list_default_lib = this.ListAttributs[level]._title;
		var _NiveauEnCours = level;
		var _TagXml = this.ListAttributs[level]._id;
		
		// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				reponse = DOM_clean(XmlDoc.responseXML.documentElement);
				//------------------------------------------------------------------		

				var ol = _objChampListe;
				
				x=reponse.getElementsByTagName(_TagXml);
				if (x[0]) {
					// la liste = titre + nbre elements
					ol.length = x.length+1;
					cpt_ok    = 0;
					// on prend le libellé par defaut
					ol.options[cpt_ok].value = "";
					ol.options[cpt_ok].text  = _list_default_lib;
					cpt_ok++; 
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
					// on pre-selectionne le libelle				
					ol.options[0].selected  = true;
					ol.length = cpt_ok; 
				} else {
					alert('ListesCascades.js : fichier XML mal formé (tag attendu='+_TagXml+')!');
				}
				eval(_obj_to_call+'.CascadingLists_after_LoadListAjax()');
				//------------------------------------------------------------------
			}
		} // fin de methode "onreadystatechange"

		XmlDoc.open("POST",this.ListAttributs[level]._url,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		XmlDoc.send(NouvelleRequete+this.CascadingLists_AutresParametres());
		this.AjaxDerniereRequete = NouvelleRequete;
				
		for (i=0;i<_objChampListe.length;i++) {
			this.TableauRacine[this.TableauRacine.length] = { _value:_objChampListe.value, _text:_objChampListe.text };
			i++;
		}
		this.nbreIndices += i;
	};

	// fonction appelee en fin de requete AJAX
	this.CascadingLists_after_LoadListAjax = function() {
		_NiveauEnCours = 0;
		this.CascadingLists_MajIcone(_NiveauEnCours,false);
		// en fonction des resultats on passe le champ en couleurs
		var ol = this.TableauObjetListe[_NiveauEnCours];
		ol.disabled = false;
		this.CascadingLists_LaBonneCouleur(_NiveauEnCours);
		// en multi-niveau on doit initialiser si premiere liste par defaut la valeur de la liste
		if (this.MultiLevel && this.DefaultLevelChaine==this.ListAttributs[_NiveauEnCours]._id) {
			ol.value = this.ValeurInitiale;
		}
	}


	this.CascadingLists_onClickEvent = function(level) {
		// quand on clique sur une liste qui n'a qu'une ligne, on fait la requete du pere
		if (this.TableauObjetListe[level].length<=1 && level>0) {
			var sauve_valeur = this.TableauObjetListe[level].value;
			this.CascadingLists_onChangeEvent(level-1,true);
			this.TableauObjetListe[level].value = sauve_valeur;
		}
	};

	this.CascadingLists_onChangeEvent = function(level,_saving) {
		obj=this.TableauObjetListe[level];
		if (this.MultiLevel) {
			if (obj.value=='') {
				if (_saving) {
					if (level>0) {
						level--;
						this.CascadingLists_SaveLevel(level);
						obj=this.TableauObjetListe[level];
					} else {
						this.CascadingLists_SaveLevel(level);
					}
					this.objChampDonnees.value=obj.value;
				}
			}
		}
		// pour toutes les listes sauf la derniere on fait un appel AJAX
		if (level<this.ListNombre-1) {
			this.CascadingLists_EffacerListesInferieures(level);
			obj=this.TableauObjetListe[level];
			// on ne doit pas reagir quand aucune option n'est choisie
			if (obj.value!='') {
				if (this.ListAttributs[level+1]._url!='') {
					this.CascadingLists_ajaxloading(level+1,obj.value);
					this.CascadingLists_SaveLevel(level);
				} else {
					alert('ERREUR l\'attribut "ajax" de l\'url a appeler n\'est pas defini !');
				}
			} else {
				this.CascadingLists_LaBonneCouleur(level);					
			}
		// si derniere liste alors on copie la valeur dans le champ cache
		} else {		
			if (obj) {
				if (this.MultiLevel) {
					this.CascadingLists_SaveLevel(level);
				} else {
					this.objChampDonnees.value=obj.value;
				}
			}
		// pour toutes les autres listes du dessus on fait un appel a AJAX
		}
	};

	this.CascadingLists_SaveLevel = function(level) {
		if (!this.MultiLevel) return;
		
		// MEMORISATION DU NIVEAU EN COURS
		this.objChampNiveau.value = this.ListAttributs[level]._id;

		// MEMORISATION DE L'ID
		obj=this.TableauObjetListe[level];
		if (obj) {			
			this.objChampDonnees.value = obj.value;
		}
	};



// fonction de chargement de la liste recherche 
	this.CascadingLists_ajaxloading = function(level,id) {
		this.NiveauEnCours = level;
		// preparation de la requete POST executer plus bas
		var NouvelleRequete = 'LEVEL='+this.ListAttributs[level-1]._id+'&ID='+id;
		if (NouvelleRequete==this.AjaxDerniereRequete) return;

		var _objChampListe = this.TableauObjetListe[level];
		if (!_objChampListe) return;
		// on descative avant la recherche
		_objChampListe.disabled = true;
 
		// LA REQUETE PEUT MAINTENANT COMMENCER
		
		// transformation du bouton de recherche en bouton animé
		this.CascadingLists_MajIcone(level,true);

		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		var _list_default_lib = this.ListAttributs[level]._title;
		var _NiveauEnCours = level;
		var _TagXml = this.ListAttributs[level]._id;
		// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				reponse = DOM_clean(XmlDoc.responseXML.documentElement);
				//------------------------------------------------------------------		
			
				var ol = _objChampListe;
				
				x=reponse.getElementsByTagName(_TagXml);
				if (x[0]) {
					// la liste = titre + nbre elements
					ol.length = x.length+1;
					cpt_ok    = 0;
					// on prend le libellé par defaut
					ol.options[cpt_ok].value = "";
					ol.options[cpt_ok].text  = _list_default_lib;
					cpt_ok++; 
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
					// on pre-selectionne le libelle				
					ol.options[0].selected  = true;
					ol.length = cpt_ok; 
				} else {
					alert('ListesCascades.js : fichier XML mal formé (tag attendu='+_TagXml+')!');
				}
				eval(_obj_to_call+'.CascadingLists_after_ajax('+_NiveauEnCours+')');
				//------------------------------------------------------------------
			}
		} // fin de methode "onreadystatechange"
		XmlDoc.open("POST",this.ListAttributs[level]._url,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		XmlDoc.send(NouvelleRequete+this.CascadingLists_AutresParametres());
		this.AjaxDerniereRequete = NouvelleRequete;
				
	}


	// fonction appelee quand on clique sur le bouton "XML" de debuggage
	this.CascadingLists_getxml = function(level) {
		if (this.objChampDonnees.disabled) {
			alert('Objet inactif');
			return;
		}
		// pour toutes les listes sauf la derniere
		if (level<this.ListNombre-1) {
			id=this.TableauObjetListe[level].value;
		} else {
			id=this.objChampDonnees.value;
		}
		// on ne fait rien quand aucune option n'est selectionnee sauf pour la derniere
		if ( (id=='') && (level<this.ListNombre-1) ) return;
		// preparation de la requete POST executer plus bas
		var NouvelleRequete = 'LEVEL='+this.ListAttributs[level]._id+'&ID='+id;
		alert('APPEL A LA PAGE : "'+this.ListAttributs[level]._url+'", avec comme parametres POST '+NouvelleRequete+' '+this.CascadingLists_AutresParametres() );
		// LA REQUETE PEUT MAINTENANT COMMENCER	
		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				if (XmlDoc.responseText=='') {
					alert('ListesCascades.js : Le fichier XML est vide !');
				} else {
					alert(XmlDoc.responseText); 
				}
			}
		} // fin de methode "onreadystatechange" modifie pour le debuggage
		
		XmlDoc.open("POST",this.ListAttributs[level]._url,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		XmlDoc.send(NouvelleRequete+this.CascadingLists_AutresParametres());
				

	}


	// fonction appelee en fin de requete AJAX
	this.CascadingLists_after_ajax = function(_NiveauEnCours) {
		this.CascadingLists_MajIcone(_NiveauEnCours,false);
		// en fonction des resultats on passe le champ en couleurs
		var ol = this.TableauObjetListe[_NiveauEnCours];
		ol.disabled = false;
		this.CascadingLists_LaBonneCouleur(_NiveauEnCours);
	}

	this.CascadingLists_MajIcone = function(icone_level,on_off) {
		if (this.ListOrientation=='H') {
			icone_level = this.ListNombre-1;
		}
		obj=MM_findObj(this.idIconeAjax+icone_level);
		if (obj) {
			if (on_off) {
				obj.src=this.icone_searching_on;
			} else {
				obj.src=this.icone_searching_off;
			}
		}
	}

	this.CascadingLists_GetDefaultValue = function() {
		// preparation de la requete POST executer plus bas
		var level = this.ListNombre-1;
		var NouvelleRequete = 'LEVEL='+this.ListAttributs[level]._id+'&ID='+this.ValeurInitiale;
		var _objChampListe = this.TableauObjetListe[level];
		if (!_objChampListe) return;
		_objChampListe.disabled = false;
		var _idChampList = this.idChampList;
 
		// LA REQUETE PEUT MAINTENANT COMMENCER
		var XmlDoc = HttpRequest();
		var _obj_to_call = this.nomobj;
		// transformation du bouton de recherche en bouton animé
		this.CascadingLists_MajIcone(level,true);
		// memorisation de la table des attributs
		var _TabTagXml = this.ListAttributs;
		
		// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				reponse = DOM_clean(XmlDoc.responseXML.documentElement);
				//------------------------------------------------------------------		
				// pour tous les niveaux
				for (niveau=0;niveau<_TabTagXml.length;niveau++) {
					var ol =  MM_findObj(_idChampList+niveau);
					x=reponse.getElementsByTagName(_TabTagXml[niveau]._id);	
					var i=0;
					if (x[i]) {				
						if (x[i].childNodes[0]) {
							// cas du 1er niveau quand pas en lecture seule
							if ((niveau==0) && (ol.length!=1)) {
								ol.value = x[i].attributes.getNamedItem("value").nodeValue;
							} else {
								// recuperation de l'attribut qui contient "value" de l'option
								ol.options[0].value = x[i].attributes.getNamedItem("value").nodeValue;
								// recuperation de la valeur qui contient "text" de l'option
								ol.options[0].text  = x[i].childNodes[0].nodeValue;
								ol.options[0].selected  = false;
							}  
						}
					} 				
				} // fin de boucle sur niveau
				eval(_obj_to_call+'.CascadingLists_after_GetDefaultValue()');
				//------------------------------------------------------------------
			}
			
		} // fin de methode "onreadystatechange"
		XmlDoc.open("POST",this.ListAttributs[level]._url,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		XmlDoc.send(NouvelleRequete+this.CascadingLists_AutresParametres());		
	}

	// fonction appelee en fin de requete AJAX
	this.CascadingLists_after_GetDefaultValue = function() {
		var level = this.ListNombre-1;
		this.CascadingLists_MajIcone(level,false);
		// en fonction des resultats on passe le champ en couleurs
		var ol = this.TableauObjetListe[level];
		// si le champ est actif on active le dernier champ
		ol.disabled  = this.objChampDonnees.disabled;
		this.CascadingLists_LaBonneCouleur(level);
	}



	this.CascadingLists_GetMultiLevelDefaultValue = function() {
		// si la valeur du niveau demande est celle de la derniere liste c'est le traitement normal
		var level = this.CascadingLists_ListLevel(this.DefaultLevelChaine);
		if (level==this.ListNombre-1) {
			this.CascadingLists_GetDefaultValue();
			return;
		}
		obj = this.TableauObjetListe[level];
		if (level==0) {
			// si la valeur par defaut est celle de la 1ere liste
			obj.value = this.ValeurInitiale;
			this.CascadingLists_EffacerListesInferieures(level);
			this.CascadingLists_onChangeEvent(level,false);
			return;			
		} else {
			// si la valeur par defaut est celle de la 1ere liste
			obj.value = this.objChampDonnees.value;
		}
		// transformation du bouton de recherche en bouton animé
		this.CascadingLists_MajIcone(level,true);

		// preparation de la requete POST executer plus bas
		var NouvelleRequete = 'LEVEL='+this.ListAttributs[level]._id+'&ID='+this.ValeurInitiale;
		var _idChampList = this.idChampList;
		var _obj_to_call = this.nomobj;
		var _levelbase   = level;
		// memorisation de la table des attributs
		var _TabTagXml = this.ListAttributs;
 
		// LA REQUETE PEUT MAINTENANT COMMENCER
		var XmlDoc = HttpRequest();
		
		// On défini ce qu'on va faire quand on aura la réponse
		XmlDoc.onreadystatechange = function() {
			// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
			if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
				reponse = DOM_clean(XmlDoc.responseXML.documentElement);
				//------------------------------------------------------------------		
				// pour tous les niveaux
				for (niveau=0;niveau<=_levelbase+1;niveau++) {
					var ol =  MM_findObj(_idChampList+niveau);
					x=reponse.getElementsByTagName(_TabTagXml[niveau]._id);	
					var i=0;
					if (x[i]) {				
						if (x[i].childNodes[0]) {
							// cas du 1er niveau quand pas en lecture seule
							switch (niveau) {
								case 0:
									ol.value = x[i].attributes.getNamedItem("value").nodeValue;
									break;
								
								// traitement de la liste immediatement en dessous
								case _levelbase+1:
									// la liste = titre + nbre elements
									ol.length = x.length+1;
									var cpt_ok    = 0;
									// on prend le libellé par defaut
									ol.options[cpt_ok].value = "";
									ol.options[cpt_ok].text  = _TabTagXml[niveau]._title;
									cpt_ok++; 
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
									// on pre-selectionne le libelle				
									ol.options[0].selected  = true;
									ol.length = cpt_ok; 
									break;

								default:
									ol.length = 1;
									// recuperation de l'attribut qui contient "value" de l'option
									ol.value = ol.options[0].value = x[i].attributes.getNamedItem("value").nodeValue;
									// recuperation de la valeur qui contient "text" de l'option
									ol.options[0].text  = x[i].childNodes[0].nodeValue;
									ol.options[0].selected  = false;
									break;
																	
							}  
						}
					} 				
				} // fin de boucle sur niveau
				eval(_obj_to_call+'.CascadingLists_after_GetMultilevelDefaultValue('+_levelbase+')');
				//------------------------------------------------------------------
			}
			
		} // fin de methode "onreadystatechange"
		XmlDoc.open("POST",this.ListAttributs[level]._url,true); // appel asynchrone
		XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=UTF-8"); 
		XmlDoc.send(NouvelleRequete+this.CascadingLists_AutresParametres());			
	}



	// fonction appelee en fin de requete AJAX
	this.CascadingLists_after_GetMultilevelDefaultValue = function(_level) {
		this.CascadingLists_MajIcone(_level,false);
		// en fonction des resultats on passe le champ en couleurs
		_level++;
		this.CascadingLists_LaBonneCouleur(_level);
		var ol = this.TableauObjetListe[_level];
		// si le champ est actif on active le dernier champ
		ol.disabled = this.objChampDonnees.disabled;
	}

	this.CascadingLists_LaBonneCouleur = function(_level) {
		// alert('en orange jusqu a '+_level+' inclus, blanc au dela');
		for (var i=0;i<this.ListNombre;i++) {
			if (i<=_level) {
				this.TableauObjetListe[i].className = this.ListClass;
			} else {
				this.TableauObjetListe[i].className = this.ListClassReadOnly;
			}
		}
	}

	// effacement des sous-listes
	this.CascadingLists_EffacerListesInferieures = function(level) {
		for (i=level+1;i<this.ListNombre;i++) {
			// on va modifier la liste
			obj=this.TableauObjetListe[i];
			if (obj) {
				// remettre le titre par defaut
				obj.length = 1;
				obj.value = obj.options[0].value = "";
				obj.options[0].text  = this.ListAttributs[i]._title;
			}
		}
		// et enfin le champ de donnée a zero
		this.objChampDonnees.value = '';
	}
	
	
	
	// QUAND ON FAIT "RETABLIR" LE CHAMP EST REMIS A SA VALEUR DU DEBUT
	this.CascadingLists_reset = function() {
		this.CascadingLists_EffacerListesInferieures(0);
		// cas ou la valeur initiale est nulle
		if (this.ValeurInitiale=='') {
			if (this.MultiLevel) {
				var a_partir_de = this.CascadingLists_ListLevel(this.DefaultLevelChaine)+1;
			} else {
				var a_partir_de = 1;
			}
			this.CascadingLists_LaBonneCouleur(a_partir_de);

		} else {
			this.objChampDonnees.value = this.ValeurInitiale;
			if (this.MultiLevel) {
				this.objChampNiveau.value = this.DefaultLevelChaine;
				this.CascadingLists_GetMultiLevelDefaultValue();
			} else {
				this.CascadingLists_GetDefaultValue();
			}
		}
//		alert('donnee='+this.objChampDonnees.value+'\nniveau='+this.objChampNiveau.value+'\n\nvaleur0='+this.ValeurInitiale+'\nniveau init='+this.DefaultLevelChaine);
 
	};

	// QUAND ON FAIT "RETABLIR" LE CHAMP EST REMIS A SA VALEUR DU DEBUT
	this.CascadingLists_erase = function() {
		if (this.objChampDonnees.disabled) {
			alert('Les listes sont inactives, cette fonction est inopérande !');
			return;
		}
		this.CascadingLists_EffacerListesInferieures(0);
		// raz du champ de donnees et de la 1ere liste
		this.TableauObjetListe[0].value = '';
		this.objChampDonnees.value = '';
		// cas ou la valeur initiale est nulle
		if (this.MultiLevel) {
			this.objChampNiveau.value = this.ListAttributs[0]._id;
		}
		this.CascadingLists_LaBonneCouleur(0);
//		alert('donnee='+this.objChampDonnees.value+'\nniveau='+this.objChampNiveau.value+'\n\nvaleur0='+this.ValeurInitiale+'\nniveau init='+this.DefaultLevelChaine);
	};


};   // Fin de classe CascadingLists









