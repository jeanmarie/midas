// JavaScript Document

/*
   ------------------------------------------------------------------------------
	classe pour gerer l'initialisation de la liste de fichiers multiples 
   ------------------------------------------------------------------------------
*/
function Uploader_MultiFiles_init(ChampDonnees,Prefix) {
	this.objChampDonnees = MM_findObj(ChampDonnees);
	this.nomChampDonnees = ChampDonnees;
	this.objListe        = MM_findObj(ChampDonnees+'_VIEW');
	this.Prefix          = Prefix;

	this.message1     = ''; 
	this.message2     = ''; 
}

Uploader_MultiFiles_init.prototype.MultiFiles_set = function() {
	var chaine=this.objChampDonnees.value;
	var tableau=chaine.split('\t');
	var ol = this.objListe;
	if (tableau.length>0) {
		ol.length = tableau.length;
		for (var i=0; i<tableau.length; i++) {
			ol.options[i].value = tableau[i];
			ol.options[i].text  = tableau[i].substring(this.Prefix.length);
		}
	}
}










/*
   ------------------------------------------------------------------------------
	classe pour gerer les actions possibles des boutons (AJOUT,EFFACER,PREVIEW)
   ------------------------------------------------------------------------------
*/

function Uploader_Command_init(ChampDonnees, urlbase) {
	this.nomChampDonnees = ChampDonnees;
	this.objChampDonnees = MM_findObj(ChampDonnees)
	this.nomChampView    = ChampDonnees+'_VIEW';
	this.objChampView    = MM_findObj(this.nomChampView);
	this.urlbase         = urlbase;
	
	this.mode_multi      = false;
	this.maxfiles        = -1;

	this.message1     = 'Fichier déjà sélectionné'; 
	this.message2     = 'Aucun fichier à effacer'; 
	this.message3     = 'Aucun fichier de sélectionné pour effacement'; 
	this.message4     = 'Aucun fichier à visualiser'; 
	this.message5     = 'Taille réelle'; 
	this.message6     = 'Sélectionner un fichier à visualiser';
	this.message7     = 'Le Nombre maximun de fichiers autorisés est atteint';
	this.message8     = 'Le sélecteur est inactif, la prévisualisation n\'est pas autorisée !';
	this.message9     = 'Le sélecteur est inactif, action impossible !';

	this.objPopupWin = new PopupWindow(); 
	this.objPopupWin.windowProperties="toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=yes,alwaysRaised,dependent"; 
	this.objPopupWin.setSize(420,180); 
	this.objPopupWin.offsetY = 22;
	this.objPopupWin.autoHide(false); 

}

Uploader_Command_init.prototype.Command_MultiFiles = function(maxfiles) {
	this.maxfiles   = maxfiles;
	this.mode_multi = true;
}


Uploader_Command_init.prototype.Command_add = function() {
	// si le champ est desactive = on ne fait rien
	if (this.objChampView.disabled) {
		alert(this.message9);
		return false;
	}
	if (this.mode_multi) {
		// dans le cas des uploader "multi-fichiers" avec un nombre maxi
		if (this.maxfiles!=-1) {
			if (this.maxfiles<=this.objChampView.length) {
				alert(this.message7+' ('+this.maxfiles+')');
				return false;
			}
		}
	} else {
		// dans le cas des uploader "mono-fichier" on ne peut ajouter un fichier sans l'effacer au prealable
		if (this.objChampDonnees.value!='') {
			alert(this.message1);
			return false;
		}
	}
	this.objPopupWin.setUrl(this.urlbase+'&ACTION=ADD'); 
	this.objPopupWin.showPopup(this.nomChampView);
	return true;
}

Uploader_Command_init.prototype.Command_delete = function() {
	// si le champ est desactive = on ne fait rien
	if (this.objChampView.disabled) {
		alert(this.message9);
		return false;
	}
	if (!this.mode_multi) {
		// dans le cas des uploader "mono-fichier" on ne effacer un fichier qui n'est pas défini
		if (this.objChampDonnees.value=='') {
			alert(this.message2);
			return false;
		}
	} else {
		// dans le cas des uploader "multi-fichier" on ne effacer un fichier que si selectionné dans la liste
		if (this.Command_option_selected() == -1) {
			alert(this.message3);
			return false;
		}
	}
	this.objPopupWin.setUrl(this.urlbase+'&ACTION=DELETE'); 
	this.objPopupWin.showPopup(this.nomChampView);
	return true;
}

// COMMANDES POUR MONTER ET DESCENDRE UN FICHIER DANS LA LISTE

Uploader_Command_init.prototype.Command_up = function() {
	var ol = this.objChampView;
	// pour monter un fichier il en faut au moins 2
	if ( ol.length<2 ) return false;
	// ...et l'objet doit etre actif
	if (ol.disabled) {
		alert(this.message9);
		return false;
	}	
	// ... et que le fichier selectionne ne soit pas le 1er
	var sel = this.Command_option_selected();
	if ( (sel==-1) && (sel==0) ) return false;
	// on permutte avec le précédant
	var s_value = ol.options[sel].value;
	var s_text  = ol.options[sel].text;
	ol.options[sel].value = ol.options[sel-1].value;
	ol.options[sel].text  = ol.options[sel-1].text;
	ol.options[sel].selected = false;
	ol.options[sel-1].value = s_value;
	ol.options[sel-1].text  = s_text;
	ol.options[sel-1].selected = true;
	this.Command_UpdateMainField();	
	return true;
}

Uploader_Command_init.prototype.Command_down = function() {
	var ol = this.objChampView;
	// pour monter un fichier il en faut au moins 2 et champ actif
	if ( ol.length<2 ) return false;
	// ...et l'objet doit etre actif
	if (ol.disabled) {
		alert(this.message9);
		return false;
	}		
	// ... et que le fichier selectionne ne soit pas le dernier
	var sel = this.Command_option_selected();
	if ( (sel==-1) && (sel==ol.length-1) ) return false;
	// on permutte avec le suivant
	var s_value = ol.options[sel].value;
	var s_text  = ol.options[sel].text;
	ol.options[sel].value = ol.options[sel+1].value;
	ol.options[sel].text  = ol.options[sel+1].text;
	ol.options[sel].selected = false;
	ol.options[sel+1].value = s_value;
	ol.options[sel+1].text  = s_text;
	ol.options[sel+1].selected = true;
	this.Command_UpdateMainField();
	return true;
}

Uploader_Command_init.prototype.Command_UpdateMainField = function () {
	var fieldvalue = '';
	var ol =  this.objChampView;
	for (var i=0; i<ol.length; i++) {
		if (i>0) fieldvalue += '\t';
		fieldvalue += ol.options[i].value;
	}
	this.objChampDonnees.value = fieldvalue;
}


// initialisation d'un objet PREVIEW
Uploader_Command_init.prototype.Command_Preview_init = function(target,prefix) {
	this.target       = target;
	this.extensions   = 'gif|jpeg|jpg|png';
	this.imagewidth   = 200;
 	this.objFieldName = this.objChampDonnees;
	this.Prefix       = prefix;
}



// appel au preview (retourne une chaine de caractère dynamique pour les fonctions de Tooltips
Uploader_Command_init.prototype.Command_Preview = function() {
	libretour = '';
	if (this.mode_multi) {
		// en mode multi le preview n'est pas autorise quand l'objet est inactif
		if (this.objChampView.disabled) return this.message8;		
		var i = this.Command_option_selected();
		if (i == -1) {
			if (this.objChampView.length==0) {
				return this.message4; 
			} else {
				return this.message6; 
			}
		}
		fichierchoisi = this.objChampView.options[i].value;
		fichierview   = this.objChampView.options[i].text;
	} else {
		fichierchoisi = this.objChampDonnees.value;
		fichierview   = fichierchoisi.substring(this.Prefix.length);
		if (fichierchoisi=='') {
			return this.message4; 
		}
	}
	var file_url = new PathInfo(fichierchoisi);
	if (fichierchoisi=='') {
		libretour = this.message4; 
	} else { 
		var re = new RegExp(this.extensions ,'i');
		// verifions que l'extension du fichier est bien dans la liste des images autorisées
		if ( re.test(file_url.extension) ) {
			preload_image = new Image(); 
			preload_image.src=this.target+fichierchoisi;
			largeuraffichee = Math.min(this.imagewidth,preload_image.width);
			if (largeuraffichee==0) largeuraffichee=this.imagewidth;
			libretour =  '<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\"><tr><td align=\"center\">';
			libretour += '<img id="photopopup" src="'+preload_image.src+'" width="'+largeuraffichee+'">';
			libretour += '</td></tr><tr><td align=\"center\" class=\"classeformslabel\">';
			libretour += '<b>'+fichierview;
			if (preload_image.width>0) {
				libretour += '</b><br>(';
				if (largeuraffichee!=preload_image.width) {
					libretour += this.message5+' = ';
				}
				libretour += preload_image.width+'x'+preload_image.height+')';
			}
			libretour += '</td></tr></table>';
		} else {
			// sinon un message est affiché
			libretour =  '<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\"><tr><td align=\"center\" class=\"classeformslabel\">';
			libretour += '<b>'+fichierview+'</b> n\'est pas visualisable (extentions autorisées : '+this.extensions+')';
			libretour += '</td></tr></table>';
			
		}
	}
	return libretour;
}

// ------------------------------
// FONCTIONS PRIVEES DE LA CLASSE
// ------------------------------

// pour trouver l'element de liste selectionné
Uploader_Command_init.prototype.Command_option_selected = function() {
	var ol = this.objChampView;
	for (var i=0; i<ol.length; i++) {
		if (ol.options[i].selected) return i;
	}
	return -1;
}
