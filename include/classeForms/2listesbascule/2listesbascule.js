// Classe d'objets BASCULE



// la classe est initialisee par le methode Bascule :
// 		b = new Bascule('list1',true);
// 			'list1','list2' 	:	2 listes gauche et droite
// 			false|true      	:	le tri est demandé

// Le tableau de toutes les valeurs possible doit etre passé par la fonction
// 		b.Bascule_LoadList('1','Paris','2','Marseille',...);


// ATTENTION :
//	. Si un bouton RESET est dans le formulaire ne pas oublier de lui rajouter les methodes :
// 		onclick="objetbascule1.InitialiserListes();objetbascule2.InitialiserListes();..."
//		autant de fois que d'objets bascules présents dans le formulaire
//  . La fonction MM_findObj(n, d) est obligatoire pour que la classe puisse fonctionner

function Bascule(ChampDonnees, sortitems) {	
	this.objChampDonnees        = MM_findObj(ChampDonnees);
	ListeGauche                 = ChampDonnees+'_G';
	ListeDroite                 = ChampDonnees+'_D';
	this.objListeGauche         = MM_findObj(ListeGauche);
	this.objListeDroite         = MM_findObj(ListeDroite);

	this.sauvegardeDonnees = this.objChampDonnees.value;
	this.derniereaction  = "";
	this.sortitems       = sortitems;  // Automatically sort items within lists? (1 or 0)
	this.tableautotal    = new Array();


}

// INITIALISATION DU HASH VALEUR => "TEXTE"
Bascule.prototype.Bascule_LoadList = function() {
		TableIn = this.Bascule_LoadList.arguments;
		for (i=0;i<TableIn.length;i++) {
			this.tableautotal[this.tableautotal.length] = { _value:TableIn[i], _text:TableIn[i+1] };
			i++;
		}
		this.nbreIndices += i;
	};


// AFFICHAGE
Bascule.prototype.Bascule_Show = function() {
	if (this.sortitems) {
		this.InitialiserListes();
	} else {
		this.InitialiserListesEnOrdre();
	}
};


Bascule.prototype.move = function(sens) {
	if (sens=="S") {
		fbox = this.objListeGauche;
		tbox = this.objListeDroite		
	} else {
		fbox = this.objListeDroite		
		tbox = this.objListeGauche;
	}
	// Si on inverse le sens de selection alors on efface la selection cible
	if (this.derniereaction != sens) {
		for(var i=0; i<tbox.options.length; i++) tbox.options[i].selected = false;
	}
	for(var i=0; i<fbox.options.length; i++) {
		if(fbox.options[i].selected && fbox.options[i].value != "") {
			var no = new Option();
			no.value    = fbox.options[i].value;
			no.text     = fbox.options[i].text;
			no.selected = fbox.options[i].selected;
			tbox.options[tbox.options.length] = no;
			fbox.options[i].value = "";
			fbox.options[i].text = "";
	   }
	}
	this.BumpUp(fbox);
	// if (this.sortitems) this.SortD(tbox);
	// this.ActiverBoutons();
}

Bascule.prototype.moveall = function(fbox,tbox) {
	for(var i=0; i<fbox.options.length; i++) {
		if(fbox.options[i].value != "") {
			var no = new Option();
			no.value = fbox.options[i].value;
			no.text = fbox.options[i].text;
			no.selected = true;
			tbox.options[tbox.options.length] = no;
	   }
	}
	fbox.options.length = 0;
	// this.ActiverBoutons();
}



// Tasser les éléments de la liste source
Bascule.prototype.BumpUp = function(box)  {
	for(var i=0; i<box.options.length; i++) {
		if(box.options[i].value == "")  {
			for(var j=i; j<box.options.length-1; j++)  {
				box.options[j].value = box.options[j+1].value;
				box.options[j].text = box.options[j+1].text;
			}
			var ln = i;
			break;
	   }
	}
	if(ln < box.options.length)  {
		box.options.length -= 1;
		this.BumpUp(box);
	}

	// on selectionne l'avant dernier element de la liste source si
	// le dernier vient d'etre basculé
	if (box.options.length>0) {
		var sauveselection = -1;
		for(var i=0; i<box.options.length; i++) {
			if(box.options[i].selected && sauveselection==-1) sauveselection = i;
			box.options[i].selected = false;
		}
		if (sauveselection==-1) {
			box.options[box.options.length-1].selected = true;
		} else {
			box.options[sauveselection].selected = true;
		}
	}
}

// trier les valeurs de la liste Box
Bascule.prototype.SortD = function(box)  {
	var temp_opts = new Array();
	var temp = new Object();
	for(var i=0; i<box.options.length; i++)  {
		temp_opts[i] = box.options[i];
	}
	for(var x=0; x<temp_opts.length-1; x++)  {
		for(var y=(x+1); y<temp_opts.length; y++)  {
			if(temp_opts[x].text > temp_opts[y].text)  {
				// permutter les libellés
				temp = temp_opts[x].text;
				temp_opts[x].text = temp_opts[y].text;
				temp_opts[y].text = temp;
				// et les valeurs
				temp = temp_opts[x].value;
				temp_opts[x].value = temp_opts[y].value;
				temp_opts[y].value = temp;
				// et les selections
				temp = temp_opts[x].selected;
				temp_opts[x].selected = temp_opts[y].selected;
				temp_opts[y].selected = temp;


			}
		}
	}
	for(var i=0; i<box.options.length; i++)  {
		box.options[i].value = temp_opts[i].value;
		box.options[i].text = temp_opts[i].text;
	}
}

// quand on clique sur une des 2 listes on déselectionne les options de l'autre liste
Bascule.prototype.Bascule_UnselectAll = function(sens) {
	if (sens=='G') {
		var ol = this.objListeGauche;
	} else {
		var ol = this.objListeDroite;
	}
	for(var i=0; i<ol.options.length; i++) {
		ol.options[i].selected = false;
	}
}

// si l'option "sort" est demandee on offre la possibilité de tri les valeurs selectionnees
Bascule.prototype.Bascule_MoveUp = function() {
	if ( this.objListeGauche.disabled ) return false;
	if ( !this.Bascule_UnSeulElement() ) {
		this.Bascule_UnselectAll('D');
		return false;
	}
	var ol = this.objListeDroite;
	// ... et plus d'un element 
	if (ol.length==1) return;
	var sel = this.Bascule_Element2move();
	// ... et que l'element ne soit pas le 1er
	if ( (sel==-1) && (sel==0) ) return;
	// on permutte avec le précédant
	var s_value = ol.options[sel].value;
	var s_text  = ol.options[sel].text;
	ol.options[sel].value = ol.options[sel-1].value;
	ol.options[sel].text  = ol.options[sel-1].text;
	ol.options[sel].selected = false;
	ol.options[sel-1].value = s_value;
	ol.options[sel-1].text  = s_text;
	ol.options[sel-1].selected = true;
	this.SaugevarderSelection();
	this.Bascule_UnselectAll('G');
	return true;

}

Bascule.prototype.Bascule_MoveDown = function() {
	if ( this.objListeGauche.disabled ) return false;
	if ( !this.Bascule_UnSeulElement() ) {
		this.Bascule_UnselectAll('D');
		return false;
	}
	var ol = this.objListeDroite;
	// ... et plus d'un element 
	if (ol.length==1) return;
	
	// ... et que le fichier selectionne ne soit pas le dernier
	var sel = this.Bascule_Element2move();
	if ( (sel==-1) && (sel==ol.length-1) ) return;
	// on permutte avec le suivant
	var s_value = ol.options[sel].value;
	var s_text  = ol.options[sel].text;
	ol.options[sel].value = ol.options[sel+1].value;
	ol.options[sel].text  = ol.options[sel+1].text;
	ol.options[sel].selected = false;
	ol.options[sel+1].value = s_value;
	ol.options[sel+1].text  = s_text;
	ol.options[sel+1].selected = true;
	this.SaugevarderSelection();
	this.Bascule_UnselectAll('G');	
	return true;

}


// on va compter le nombre d'element coche a droite, un seul est permis
Bascule.prototype.Bascule_UnSeulElement = function() {
	var ol = this.objListeDroite;
	if (ol.length==0) return false;
	var cpt=0;
	for(var i=0; i<ol.options.length; i++) {
		if (ol.options[i].selected) {
			cpt++;
		}
	}
	return (cpt==1);	
}

// pour trouver l'element de liste de droite selectionné qui doit monter ou descendre
Bascule.prototype.Bascule_Element2move = function() {
	var ol = this.objListeDroite;
	for (var i=0; i<ol.length; i++) {
		if (ol.options[i].selected) return i;
	}
	return -1;
}

Bascule.prototype.SaugevarderSelection = function() {
	var box = this.objListeDroite;
	var chaineselection = '';
	for(var i=0; i<box.options.length; i++) {
		if( box.options[i].value != "") {
			if (chaineselection != "") chaineselection = chaineselection + ",";
			chaineselection = chaineselection + box.options[i].value
		}
	}
	if (this.objChampDonnees) this.objChampDonnees.value = chaineselection;
}


Bascule.prototype.Selectionner = function() {
	if (this.objListeGauche.length==0 || this.objListeGauche.disabled ) return false;
	this.move("S");
	this.SaugevarderSelection();
	this.derniereaction = "S";
	return true;
};

Bascule.prototype.SelectionnerTout =function() {
	if (this.objListeGauche.length==0 || this.objListeGauche.disabled ) return false;
	this.moveall(this.objListeGauche,this.objListeDroite);
	this.SaugevarderSelection();
	this.derniereaction = "S";
	return true;
};

Bascule.prototype.Deselectionner = function() {
	if (this.objListeDroite.length==0 || this.objListeDroite.disabled) return false;
	this.move("D");
	this.SaugevarderSelection();
	this.derniereaction = "D";
	return true;
};

Bascule.prototype.DeselectionnerTout = function() {
	if (this.objListeDroite.length==0 || this.objListeDroite.disabled) return false;
	this.moveall(this.objListeDroite,this.objListeGauche);
	this.SaugevarderSelection();
	this.derniereaction = "D";
	return true;
};

Bascule.prototype.InitialiserListes = function() {
	// initialisation des 2 champs en fonction de la valeur de "ChampDonnees"
	var chainedonnees = this.sauvegardeDonnees;
	var tabValeursDroites = chainedonnees.split(",");

	// initialisation de la taille des 2 listes
	this.objListeGauche.length = this.tableautotal.length;
	this.objListeDroite.length = this.tableautotal.length;
	// initialisation d'un tableau de booleens de la taille du nombre total d'elements
	var ElementSelected = new Array(); 
	for(var i=0; i<this.tableautotal.length; i++)  {
	    ElementSelected[i] = false;
	}
	var nbreselectionnes = 0;


	// initialisation de la liste de droite
	for(var i=0; i<tabValeursDroites.length; i++)  {
		for(var j=0; j<this.tableautotal.length; j++)  {
			if (tabValeursDroites[i]==this.tableautotal[j]._value) {
			    ElementSelected[j] = true;
				this.objListeDroite[nbreselectionnes].value = this.tableautotal[j]._value;
				this.objListeDroite[nbreselectionnes].text  = this.tableautotal[j]._text;
				this.objListeDroite[nbreselectionnes].selected = false;
				nbreselectionnes++;
				break;
			} 
		}
	}

	// initialisation de la liste de gauche
	var g=0;
	for(var i=0; i<this.tableautotal.length; i++)  {
		// 2e balayage de la table complete en ne gardant que les selectionnes
		if (!ElementSelected[i]) {
			this.objListeGauche[g].value = this.tableautotal[i]._value;
			this.objListeGauche[g].text  = this.tableautotal[i]._text;
			this.objListeGauche[g].selected = false;
			g++;			
		}
	}
	this.objListeGauche.length = g;
	this.objListeDroite.length = nbreselectionnes;
};


Bascule.prototype.InitialiserListesEnOrdre = function() {
	// initialisation des 2 champs en fonction de la valeur de "ChampDonnees"
	var chainedonnees = this.sauvegardeDonnees;
	var tabValeursDroites = chainedonnees.split(",");

	// initialisation de la taille des 2 listes
	this.objListeGauche.length = this.tableautotal.length;
	this.objListeDroite.length = this.tableautotal.length;
	var g=0
	var d=0;
	var nbreselectionnes = 0;
	for(var i=0; i<this.tableautotal.length; i++)  {
		// balayage de la table des selectionnes
		valeurselectionnee = false;
		for(var j=0; j<tabValeursDroites.length; j++)  {
			if (tabValeursDroites[j]==this.tableautotal[i]._value) {
				valeurselectionnee = true;
				nbreselectionnes++;
				break;
			}
		}
		if (valeurselectionnee) {
			this.objListeDroite[d].value = this.tableautotal[i]._value;
			this.objListeDroite[d].text  = this.tableautotal[i]._text;
			this.objListeDroite[d].selected = false;
			d++;

		} else {
			this.objListeGauche[g].value = this.tableautotal[i]._value;
			this.objListeGauche[g].text  = this.tableautotal[i]._text;
			this.objListeGauche[g].selected = false;
			g++;			
		}
	}
	this.objListeGauche.length = this.tableautotal.length - nbreselectionnes;
	this.objListeDroite.length = nbreselectionnes;

}





