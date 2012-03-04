// CHECKBOX.JS - Franck OBERLECHNER - Mai 2005

// Classe d'objet javascript pour la gestion de checkbox graphiques
// Pour eviter une limitation HTML qui ne retourne pas au SUBMIT la valeur d'un checkbox inactif
// on cree un champ de type "hidden" qui est la valeur prise en compte au submit

//   <p><input name="KiKi" type="hidden"  value="1">
//  <a onClick="obj2.ogc_click()">
//	<script>
//				var obj2 = new objGraphicCoche('KiKi',false,'cocher ICI pour activer Kiki');	
//[OPIONNEL]	obj2.ogc_bitmap('','default_on_rouge.gif');
//				obj2.ogc_show();
//	</ script>
//  </a>

// Dans le cas d'un bouton RESET associer a ce bouton la methode : 
//	obj2.ogc_reset(); qui replacera la coche dans sont etat initial

// Les methodes .ogc_select(forcer) ou .ogc_unselect(forcer) permettent de selectionner par programmation l'objet



	
	function objGraphicCoche(nomchamp,actif,libelle_aide,valeur_off,valeur_on) {	
		// initialisation des propriétés de l'objet
		this.nomchamp = nomchamp;
		this.desactive        = !actif;
		this.desactive_defaut = !actif; 
		this.rep_defaut = 'img/';

		this.nom_image_on           = 'default_on.gif';
		this.nom_image_off			= 'default_off.gif';
		this.nom_image_dis_on       = 'default_disabled_on.gif';
		this.nom_image_dis_off		= 'default_disabled_off.gif';
		
		this.obj_coche_on           = this.rep_defaut+ this.nom_image_on;
		this.obj_coche_off          = this.rep_defaut+ this.nom_image_off;
		this.obj_coche_disabled_on  = this.rep_defaut+ this.nom_image_dis_on;
		this.obj_coche_disabled_off = this.rep_defaut+ this.nom_image_dis_off;

		if (valeur_off) {
			this.valeur_off = valeur_off;
		} else {
			this.valeur_off = "0";
		}
		if (valeur_on) {
			this.valeur_on = valeur_on;
		} else {
			this.valeur_on = "1";
		}
		this.valeur_defaut    = MM_findObj(this.nomchamp).value; 
		
		this.libelle_aide = "";
		if (libelle_aide) {
			this.libelle_aide = libelle_aide;
		} 

	//METHODES DE LA CLASSE
	this.ogc_refresh = function() {
		icone_coche = '';
		if (this.obj_coche) {
			if (this.desactive) {
				icone_coche = this.obj_coche_disabled_on;
			} else {
				icone_coche = this.obj_coche_on;
			}
		} else {
			if (this.desactive) {
				icone_coche = this.obj_coche_disabled_off;
			} else {
				icone_coche = this.obj_coche_off;
			}

		}
		MM_swapImage(this.nomchamp+'_IMG','',icone_coche,1);		
	}

	this.ogc_click = function() {
		// Si la coche est désactivée on ne fait rien
		if (this.desactive) return;
		this.obj_coche = !this.obj_coche;		
		if (this.obj_coche) {
			MM_setTextOfTextfield(this.nomchamp,'',this.valeur_on);
		} else {
			MM_setTextOfTextfield(this.nomchamp,'',this.valeur_off);
		}
		this.ogc_refresh();
	}
	
	this.ogc_reset = function() {
		this.obj_coche = (this.valeur_defaut==this.valeur_on);
		this.desactive = this.desactive_defaut;
		this.ogc_refresh();
	}

	this.ogc_enable = function() {
		this.desactive = false;
		this.ogc_refresh();
	}	

	this.ogc_disable = function() {
		this.desactive = true;
		this.ogc_refresh();
	}	

	this.ogc_select = function(forcer) {
		if ( this.desactive && !forcer ) return;
		this.obj_coche = true;
		this.ogc_refresh();
	}	

	this.ogc_unselect = function(forcer) {
		if ( this.desactive && !forcer ) return;
		this.obj_coche = false;
		this.ogc_refresh();
	}	

	this.ogc_bitmap = function (rep_bitmap,c_on,c_off,c_dis_on,c_dis_off) {
		// 2 parametres obligatoires : le chemin et le nom du fichier coche "ON"
		if (rep_bitmap=='') {
			rep_bitmap = this.rep_defaut;
		} else {
			this.obj_coche_on           = rep_bitmap+ this.nom_image_on;
			this.obj_coche_off          = rep_bitmap+ this.nom_image_off;
			this.obj_coche_disabled_on  = rep_bitmap+ this.nom_image_dis_on;
			this.obj_coche_disabled_off = rep_bitmap+ this.nom_image_dis_off;
		}	
		if (c_on)     
			this.obj_coche_on  = rep_bitmap+c_on;
		if (c_off)     
			this.obj_coche_off = rep_bitmap+c_off; 
		if (c_dis_on)  
			this.obj_coche_disabled_on  = rep_bitmap+c_dis_on;
		if (c_dis_off) 
			this.obj_coche_disabled_off = rep_bitmap+c_dis_off;		
	}
	
	this.ogc_show = function () {
		// préchargement des images
		// alert(this.obj_coche_on+'\n'+this.obj_coche_off+'\n'+this.obj_coche_disabled_on+'\n'+this.obj_coche_disabled_off);

		MM_preloadImages(this.obj_coche_on);
		MM_preloadImages(this.obj_coche_off);
		MM_preloadImages(this.obj_coche_disabled_on);
		MM_preloadImages(this.obj_coche_disabled_off);
		
		// creation de l'objet HTML 
		if (this.valeur_defaut==this.valeur_on) {
			this.obj_coche = true;
			document.write('<img src="'+this.obj_coche_on);
		} else {
			this.obj_coche = false;
			document.write('<img src="'+this.obj_coche_off);
		}
		document.write('" alt="'+this.libelle_aide+'" name="'+this.nomchamp+'_IMG" border="0">');
		this.ogc_refresh();		

	}


}