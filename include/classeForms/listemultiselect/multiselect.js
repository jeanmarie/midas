// Classe d'objets MULTISELECT


/*

	b = new MultiSelect('dmc_list','dmc');
	b.MultiSelect_ModeChange('append'); 
		---> 3 modes possibles { 'normal', 'save','append' }
	b.MultiSelect_ModeBlock('la plage horaire doit etre continue',mode_restore);
		---> Message par defaut et mode de restauration en cas de mauvaise selection
		     true : restauration des derniers bons choix connus
			 false : toute la selection est effacée


*/



// CONSTRUCTEUR DE LA CLASSE
function MultiSelect(ListeAtrier, ChampDonnees) {	
	this.objListe                = MM_findObj(ListeAtrier);
	this.objChampDonnees         = MM_findObj(ChampDonnees);

	this.type_comportement_selection = 'normal';

	this.type_mode_block             = false;
	this.type_mode_block_restore     = false;	
	this.message_mode_block = 'La sélection doit être continue !';

	this.nbre_choice                 = 0;
	this.max_choice                  = -1;
	this.message_max_choice = 'Le nombre maximum de choix autorisés est dépassé !';

	this.sauveEtat = new Array( );
	this.sauveEtatInitial = new Array( );
	this.sauveDernierEtatOK = new Array( );
	for(var i=0; i<this.objListe.options.length; i++) {
		// CALCUL DU NOMBRE DE CHOIX INITIAL
		if (this.objListe.options[i].selected) this.nbre_choice++;
		this.sauveEtat[this.sauveEtat.length] = this.objListe.options[i].selected;
		this.sauveEtatInitial[this.sauveEtatInitial.length] = this.objListe.options[i].selected;
		this.sauveDernierEtatOK[this.sauveDernierEtatOK.length] = this.objListe.options[i].selected;
	}
	this.MultiSelect_SaveChange();
};


MultiSelect.prototype.MultiSelect_onChange = function () {
	var ol = this.objListe;
	switch (this.type_comportement_selection){
		case 'normal':
			break;
			
		case 'save':
			for(var i=0; i<ol.options.length; i++) {
				if(ol.options[i].selected && !this.sauveEtat[i]) {
					this.sauveEtat[i] = true;
				} else if(ol.options[i].selected && this.sauveEtat[i]) {
					this.sauveEtat[i] = false;
				}
			}
			for(var i=0; i<ol.options.length; i++) {
				ol.options[i].selected = this.sauveEtat[i];
			}
			break;
			
		case 'append':
			for(var i=0; i<ol.options.length; i++) {
				if(ol.options[i].selected && !this.sauveEtat[i]) {
					this.sauveEtat[i] = true;
				}
			}
			for(var i=0; i<ol.options.length; i++) {
				ol.options[i].selected = this.sauveEtat[i];
			}
			break;
		// CAS DE LA LECTURE SEULE
		case 'readonly':
			this.MultiSelect_Reset();
			break;

		default:
			break;
	}
	// SI LES CHOIX NON CONTIGUES SONT INTERDIT ON VA VERIFIER QUE LA SELECTION EST UN BLOC
	if (this.type_mode_block) {
		if (this.BlockControl()) {
			if (this.CounterControl()) {
				return true;
			}
		}
	} else {
		if (this.CounterControl()) {
			return true;
		}
	}
	return false;
}

// SAUVEGARDE DE LA SELECTION DANS LE CHAMP NOMME
MultiSelect.prototype.MultiSelect_SaveChange = function () {
	var ol = this.objListe;
	var valeur_out = '';
	for(var i=0; i<ol.options.length; i++) {
		if(ol.options[i].selected) {
			if (valeur_out.length>0) valeur_out+=',';
			valeur_out+=ol.options[i].value;
		}
		this.sauveDernierEtatOK[i] = ol.options[i].selected;
	}
	this.objChampDonnees.value = valeur_out;
}

// COMPTAGE DU NOMBRE DE LIGNES SELECTIONNEES
MultiSelect.prototype.CounterControl = function () {
	var ol = this.objListe;
	this.nbre_choice                 = 0;
	for(var i=0; i<ol.options.length; i++) {
		if(ol.options[i].selected) {
			this.nbre_choice++;
		}
	}
	if (this.max_choice<1) {
		return true;
	} else {
		if (this.nbre_choice>this.max_choice) {
			// on envoi le message qui indique un choix trop nombreux
			alert(this.message_max_choice);
			this.MultiSelect_RestoreOK();
			return false;
		} else {
			return true;
		}
	}
}

// CONTROLE DU MODE "BLOC"
MultiSelect.prototype.BlockControl = function () {
	var ol = this.objListe;
	var cptbloc = 0;
	var finbloc = false;
	for(var i=0; i<ol.options.length; i++) {
		if(ol.options[i].selected) {
			if (cptbloc==0) {
				cptbloc=1;
			} else if (finbloc) {
				cptbloc++;
				finbloc = false;
			}
		} else {
			if (cptbloc>0) finbloc = true;
		}
	}
	if (cptbloc>1) {
		// on envoi le message qui indique un choix discontinu
		alert(this.message_mode_block);
		if (this.type_mode_block_restore) {
			this.MultiSelect_RestoreOK();
		} else {
			this.MultiSelect_InitAll();
		}
		return false;
	}
	return true;
}

// REINITIALISATION DES VALEURS D'ORIGINE DE LA LISTE
MultiSelect.prototype.MultiSelect_Reset = function () {
	if (this.MultiSelect_TestReadOnly()) return;
	for(var i=0; i<this.objListe.options.length; i++) {
		this.sauveEtat[i] = this.objListe.options[i].selected = this.sauveEtatInitial[i];
	}
	this.MultiSelect_SaveChange();
}

// TOUT SELECTIONNER OU TOUT DESELECTIONNER
MultiSelect.prototype.MultiSelect_InitAll = function (choix) {
	// LA TOUCHE EST INTERDITE EN LECTURE SEULE MAIS AUSSI SI UN NOMBRE DE CHOIX MAXI EST DEFINI
	if (this.MultiSelect_TestReadOnly()) return;
	if (this.type_comportement_selection == 'readonly') {
		return;
	}
	// "TOUT SELECTIONNER" n'est pas possible quand max_choice est defini et si sa valeur est < au nombre d'elements
	if (choix && this.max_choice!=-1 && this.max_choice<this.objListe.length) {
		alert(this.message_max_choice);
		return;
	}
	for(var i=0; i<this.objListe.options.length; i++) {
		this.sauveEtat[i] = this.objListe.options[i].selected = choix;
	}
	this.MultiSelect_SaveChange();
}

// REINITIALISATION DES VALEURS A LA DERNIERE BONNE SELECTION
MultiSelect.prototype.MultiSelect_RestoreOK = function () {
	for(var i=0; i<this.objListe.options.length; i++) {
		this.sauveEtat[i] = this.objListe.options[i].selected = this.sauveDernierEtatOK[i];
	}
	this.MultiSelect_SaveChange();
}


// CONTROLE SI LA LISTE EST ACTIVE OU NON 
MultiSelect.prototype.MultiSelect_TestReadOnly = function () {
	return  (this.objListe.disabled);
}

// RETOURNE LE NOMBRE D'ELEMENTS SELECTIONNES
MultiSelect.prototype.MultiSelect_Counter = function () {
	return this.nbre_choice;
}





// INITIALISATION DU COMPORTEMENT
MultiSelect.prototype.MultiSelect_ModeChange = function (mode) {
	this.type_comportement_selection = mode; 
}

// INITIALISATION DU NOMBRE MAXIMUM DE CHOIX POSSIBLES
MultiSelect.prototype.MultiSelect_MaxChoice = function (cptmaxi,msg) {
	this.max_choice = cptmaxi; 
	if (typeof msg == "string") {
		this.message_max_choice = msg;
	}
}

MultiSelect.prototype.MultiSelect_ModeBlock = function (restore_state,msg) {
	this.type_mode_block = true; 
	if (typeof msg == "string") {
		this.message_mode_block = msg;
	}
	if (typeof restore_state == "boolean") {
		this.type_mode_block_restore = restore_state;
	}
}
