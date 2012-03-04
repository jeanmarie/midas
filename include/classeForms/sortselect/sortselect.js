// Classe d'objets SORTSELECT

// Le tableau de toutes les valeurs possible doit etre déclaré avant le constructeur

// la classe est initialisee par le methode Bascule :
// 		b = new SortSelect('list','textfield');
// 			'list' 				:	nom de la liste
// 			'textfield'     	:	Champ cache qui initialise et recupere les valeurs des options choisie
//			dataArray        	:	Tableau des valeurs possibles (hash _value/_text)
// Le tableau de toutes les valeurs possible doit etre déclaré avec la methode suivante :


// ATTENTION :
//	. Si un bouton RESET est dans le formulaire ne pas oublier de lui rajouter les methodes :
// 		onclick="objetbascule1.InitialiserSortSelect();objetbascule2.InitialiserListes();..."
//		autant de fois que d'objets bascules présents dans le formulaire
//  . La fonction MM_findObj(n, d) est obligatoire pour que la classe puisse fonctionner

// CONSTRUCTEUR DE LA CLASSE SortSelect
function SortSelect(ListeAtrier, ChampDonnees) {	
	this.objListe               = MM_findObj(ListeAtrier);
	this.objChampDonnees        = MM_findObj(ChampDonnees);
	this.TableauTotal           = new Array();
	this.separateur_valeur      = "-";
	this.separateur_texte       = "---------------------------------------------";
	this.nbreIndices            = 0;
};



// INITIALISATION DU HASH VALEUR => "TEXTE"
SortSelect.prototype.SortSelect_LoadList = function(TableauTotal) {
		TableIn = this.SortSelect_LoadList.arguments;
		for (i=0;i<TableIn.length;i++) {
			this.TableauTotal[this.TableauTotal.length] = { _value:TableIn[i], _text:TableIn[i+1] };
			i++;
		}
		this.nbreIndices += i;
	};
	
	
// FONCTION QUI CHERCHE DANS LA TABLE ORIGINALE ET RETOURNE LE RANG
SortSelect.prototype.FindIndex = function(valeurAtrouver) {
	j=0;
	while ( j<this.TableauTotal.length ) {
		if (this.TableauTotal[j]._value==valeurAtrouver) return j;
		j++;
	}
	return -1;
}


// FONCTION QUI FILTRE LES INDICES QUI NE SONT PAS DANS LA TABLE
SortSelect.prototype.FiltrerIndexes = function() {
	var tabOrdre      = this.objChampDonnees.value.split(",");
	var TmpChampDonnees = '';
	var nbrevaleur = 0; // les separateurs ne comptent pas

	// on va profiter du balayage de la table pour "pointer" les elements trouves
	for (var i=0; i<tabOrdre.length; i++) {
		if (tabOrdre[i]==this.separateur_valeur) {
			if (TmpChampDonnees!='') TmpChampDonnees+=','; 
			TmpChampDonnees+=this.separateur_valeur;
		} else {
			var id_trouve = this.FindIndex(tabOrdre[i]);
			if (id_trouve!=-1) {
				if (TmpChampDonnees!='') TmpChampDonnees+=','; 
				TmpChampDonnees+=tabOrdre[i];
				nbrevaleur++;
			}
		}
	}
	this.objChampDonnees.value = TmpChampDonnees;
	return nbrevaleur;
}

SortSelect.prototype.SortSelect_InitialiserListe = function() {
	this.nbreIndices = this.FiltrerIndexes();
	this.sauvegardeDonnees =  this.objChampDonnees.value;

	// initialisation de la liste en fonction de la valeur de "ChampDonnees"
	var tabOrdre      = this.sauvegardeDonnees.split(",");
	var l = this.objListe;
	// SI LE CHAMP ORDRE EST VIDE ON PLACE TOUT LE TABLEAU DANS LA LISTE DANS L'ORDRE DES INDICES
	if (this.nbreIndices==0) {
		// ON FIXE LA LONGUEUR DE LA LISTE A CELLE DU TABLEAU DES VALEURS
		this.objListe.length = this.TableauTotal.length;
		for (var i=0; i<this.TableauTotal.length; i++) {
			l.options[i].value = this.TableauTotal[i]._value;
			l.options[i].text = this.TableauTotal[i]._text;
		}
	} else {
		// SI LE CHAMP ORDRE/INDICES CONTIENT LE NOMBRE EXACT DE DONNEES DE LA TABLE
		var LTOT= this.TableauTotal.length;
		if (this.nbreIndices==LTOT) {
			for (var i=0; i<tabOrdre.length; i++) {
				if (tabOrdre[i]==this.separateur_valeur) {
					l.length++;
					l.options[i].value = this.separateur_valeur;
					l.options[i].text  = this.separateur_texte;
				} else {
					indicetable = this.FindIndex(tabOrdre[i]);
					if (indicetable>-1) {
						l.length++;
						l.options[i].value = this.TableauTotal[indicetable]._value;
						l.options[i].text  = this.TableauTotal[indicetable]._text;
					}
				}
			}
		} else {
			// SI LE CHAMP ORDRE NE CORRESPOND PAS AU NOMBRE D'ELEMENTS DU TABLEAU IL AFFICHE LES MANQUANTS A LA FIN

			// on commence par initialiser une table de booleens pour "pointer" les elements
			var t_LignePresente = new Array();
			t_LignePresente.length = this.TableauTotal.length;
			for (var i=0; i<this.TableauTotal.length; i++) {
				t_LignePresente[i] = false;
			}
			for (var i=0; i<tabOrdre.length; i++) {
				// si l'element en cours est un separateur
				if (tabOrdre[i]==this.separateur_valeur) {
					l.length++;
					l.options[i].value = this.separateur_valeur;
					l.options[i].text  = this.separateur_texte;
				} else {
					indicetable = this.FindIndex(tabOrdre[i]);
					if (indicetable>-1) {
						// SI L'INDICE A ETE TROUVE
						t_LignePresente[indicetable] = true;
						l.length++;
						l.options[i].value = this.TableauTotal[indicetable]._value;
						l.options[i].text  = this.TableauTotal[indicetable]._text;
					}
				}
			}
			// APRES AVOIR PLACE TOUS LES ELEMENTS TROUVES ON AJOUTE LES ABSENTS
			for (var i=0; i<this.TableauTotal.length; i++) {
				if ( !t_LignePresente[i] ) {
					ll = l.length++;
					l.options[ll].value = this.TableauTotal[i]._value;
					l.options[ll].text  = this.TableauTotal[i]._text;					
				}
			}
			// ON REPLACE LE CHAMP INDICES AINSI FILTRE PUIS COMPLETE
			libchampdonnees = '';
			for (var i=0; i<l.length; i++) {
				if (libchampdonnees!='') libchampdonnees+=',';
				libchampdonnees += l.options[i].value;
			}
			this.objChampDonnees.value = libchampdonnees;
		}
	}

};




// FONCTION QUI CHERCHE DANS LA TABLE ORIGINALE ET RETOURNE LE RANG
SortSelect.prototype.FindIndexSelected = function() {
	trouve = false;
	j=0;
	while ( (j<this.objListe.length) && (!trouve) ) {
		if (this.objListe[j].selected) return j;
		j++;
	}
	return -1;
}

// FONCTION QUI CHERCHE DANS LE SELECT LA LIGNE CORRESPONDANT A UNE VALEUR
SortSelect.prototype.FindSelect = function(valeurAtrouver) {
	trouve = false;
	j=0;
	while ( (j<this.objListe.length) && (!trouve) ) {
		if (this.objListe[j].value==valeurAtrouver) return j;
		j++;
	}
	return -1;
}


// FONCTION FAIT MONTER UN ELEMENT
SortSelect.prototype.SortSelectGoUp = function() {
	// si la liste est desactivee les fleches sont inoperantes
	var l = this.objListe;
	if (l.disabled) return false;
	var selectedline = this.FindIndexSelected();
	// si aucune ligne selectionnee ou la 1ere on ne fait rien
	if (selectedline<1) return false;	
	// on permute avec la ligne du dessus

	// si c'est un separateur qui est selectionne
	if (l.options[selectedline].value==this.separateur_valeur) return false;	

	var temp = new Option();
	temp.value = l.options[selectedline-1].value
	temp.text  = l.options[selectedline-1].text
	l.options[selectedline-1].value = l.options[selectedline].value;
	l.options[selectedline-1].text  = l.options[selectedline].text;
	l.options[selectedline].value = temp.value;
	l.options[selectedline].text  = temp.text;
	// monter la selection
	l.options[selectedline-1].selected = true;
	l.options[selectedline].selected = false;
	this.SaveChange();
	return true;
}

// FONCTION FAIT MONTER DESCENDRE UN ELEMENT
SortSelect.prototype.SortSelectGoDown = function() {
	// si la liste est desactivee les fleches sont inoperantes
	var l = this.objListe;
	if (l.disabled) return false;
	var selectedline = this.FindIndexSelected();
	// si aucune ligne selectionnee ou la 1ere on ne fait rien
	if ( (selectedline==-1) || (selectedline==this.objListe.length-1) ) return false;
	// si c'est un separateur qui est selectionne
	if (l.options[selectedline].value==this.separateur_valeur) return false;	
	// on permute avec la ligne du dessous
	var temp = new Option();
	temp.value = l.options[selectedline+1].value
	temp.text  = l.options[selectedline+1].text
	l.options[selectedline+1].value = l.options[selectedline].value;
	l.options[selectedline+1].text  = l.options[selectedline].text;
	l.options[selectedline].value = temp.value;
	l.options[selectedline].text  = temp.text;
	// monter la selection
	l.options[selectedline+1].selected = true;
	l.options[selectedline].selected = false;
	this.SaveChange();
	return true;
}

// INSERTION D'UN SEPARATEUR
SortSelect.prototype.SortSelectInsert = function() {
	// si la liste est desactivee les fleches sont inoperantes
	var l = this.objListe;
	if (l.disabled) return false;
	var selectedline = this.FindIndexSelected();
	// si aucune ligne selectionnee ou la 1ere on ne fait rien
	if (selectedline<1) return false;	
	// si la ligne actuelle ou du dessus est un "-" alors on ne fait rien
	if (l.options[selectedline-1].value==this.separateur_valeur || l.options[selectedline].value==this.separateur_valeur ) return false;
	
	// on descend le tableau d'une ligne
	l.length++;
	for (var i=l.length-1; i>selectedline; i--) {
		l.options[i].value = l.options[i-1].value;
		l.options[i].text  = l.options[i-1].text;
	}
	l.options[selectedline].value = this.separateur_valeur;
	l.options[selectedline].text  = this.separateur_texte;
	l.options[selectedline+1].selected = true;
	l.options[selectedline].selected = false;
	this.SaveChange();
	return true;

}

// FONCTION FAIT MONTER DESCENDRE UN ELEMENT
SortSelect.prototype.SortSelectDelete = function() {
	// si la liste est desactivee les fleches sont inoperantes
	var l = this.objListe;
	if (l.disabled) return false;
	var selectedline = this.FindIndexSelected();
	// si aucune ligne selectionnee ou separateur
	if ( (selectedline==-1) || (l.options[selectedline].value!=this.separateur_valeur) ) return false;
	
	// on remonte le tableau d'une ligne
	for (var i=selectedline; i<l.length-1; i++) {
		l.options[i].value = l.options[i+1].value;
		l.options[i].text  = l.options[i+1].text;
	}

	l.length = l.length -1;
	this.SaveChange();
	return true;
}


// SAUVEGARDE DANS LE CHAMP HIDDEN
SortSelect.prototype.SaveChange = function() {
	l = this.objListe;
	var sauvegarde = '';
	for (var i=0; i<l.length; i++) {

		if (sauvegarde.length>0) sauvegarde +=',';
		sauvegarde = sauvegarde+l.options[i].value;

	}
	this.objChampDonnees.value = sauvegarde;
}

// SAUVEGARDE DANS LE CHAMP HIDDEN
SortSelect.prototype.SortSelectReset = function() {
		this.objChampDonnees.value = this.sauvegardeDonnees;
		this.SortSelect_InitialiserListe();
		if (this.sauvelignedefaut>-1) {
			this.objListe.options[this.sauvelignedefaut].selected = true;
		}
}


// MODIFICATION DE LA VALEUR DU SEPARATEUR ( A APPELER AVANT SortSelect_InitialiserListe )
SortSelect.prototype.SortSelectSeparatorValue = function(sepValeur) {
	this.separateur_valeur      = sepValeur;
}

// MODIFICATION DU SEPARATEUR VISUEL ( A APPELER AVANT SortSelect_InitialiserListe )
SortSelect.prototype.SortSelectSeparatorText = function(sepText) {
	this.separateur_texte  = sepText;
}




