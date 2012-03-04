// JavaScript Document
//          librairie utilisée par l'objet PHP $f->frm_uploader()

// CONSTRUCTEUR DE LA CLASSE
function Uploader(btn_name,field_name) {
	this.BtnName   = btn_name;
	this.FieldName = field_name;
	// determinons si mode "mono" ou "multi" fichiers
	this.mode_mono   = (typeof multifilesmax == 'undefined');
	this.parent_field       = MM_findObj(return_field,window.opener.document);
	this.parent_field_view  = MM_findObj(return_field+'_VIEW',window.opener.document);
	this.file_is_image      = false;
	this.image_is_resized   = false;
}

Uploader.prototype.Uploader_init = function () {
	this.objBtnName   = MM_findObj(this.BtnName);
	this.objFieldName = MM_findObj(this.FieldName);
}

Uploader.prototype.Uploader_onChange = function () {
	if (this.objFieldName.value!='') {
		this.objBtnName.disabled = false;
	}
}


Uploader.prototype.Uploader_Go = function () {
	this.objBtnName.disabled   = true;
	var fichierchoisi = new PathInfo(this.objFieldName.value);
	var re = new RegExp(file_type,'i');
	// verifions que l'extension du fichier est bien dans la liste des images autorisées
	if ( re.test(fichierchoisi.extension) ) {
		document.forms.FRM_UPLOADER.submit();	
	} else {
		alert('"'+this.objFieldName.value+'" n\'est pas un fichier autorisé !\n\n( '+file_type+' uniquement )');
		this.objFieldName.value = "";
	}
}

Uploader.prototype.Uploader_Message = function (icone,message) {
	document.write('<br><p><div align="center">');
	document.write('<table width="90%" border="0"><tr><td>');
	document.write('<img src="'+resources_path+'uploader/'+icone+'">');
	document.write('</td><td class="classemessage">');
	document.write(message+'</td>');
	document.write('</td></tr></table></div></p>');
}

Uploader.prototype.Uploader_UpdateField_add = function (filename) {
	if (this.mode_mono) {
		// Mise a jour dans la fenetre appelante du champ cache qui contient le chemin complet
		// si il existe on ajoute devant un prefixe ( id )
		this.parent_field.value=prefix_file+filename; 
		// Mise a jour dans la fenetre appelante du champ qui contient juste le nom du fichier
		this.parent_field_view.value=filename; 
	} else {
		if ( !this.Uploader_FindInList(filename) ) {
			this.Uploader_AddToList(filename);
		}
	}
}

Uploader.prototype.Uploader_UpdateField_delete = function () {
	var deleted_file_view = '';
	if (this.mode_mono) {
		// Mise a jour dans la fenetre appelante du champ cache qui contient le chemin complet
		this.parent_field.value=''; 
		// Mise a jour dans la fenetre appelante du champ qui contient juste le nom du fichier
		deleted_file_view = this.parent_field_view.value;
		this.parent_field_view.value=''; 
	} else {
		deleted_file_view = deleted_file.substring(prefix_file.length);
		// on effacer aussi la ligne de la liste
		this.Uploader_DeleteFromList();
	}
	return deleted_file_view;
}


Uploader.prototype.Uploader_FindInList = function(filename) {
	var ol = this.parent_field_view;
	// si la liste est vide aucun risque de le trouver
	if (ol.length==0) return false;
	for (var i=0; i<ol.length; i++) {
		if (ol.options[i].text == filename ) return true;
	}
	return false;
}

Uploader.prototype.Uploader_AddToList = function(filename) {
	var ol = this.parent_field_view;
	// on commence par deselectionner les options du dessus
	for (var i=0; i<ol.length; i++) {
		ol.options[i].selected = false;
	}
	// on ajoute le fichier a la liste visible
	var i = ol.length++;
	ol.options[i].text  = filename;
	ol.options[i].value = prefix_file+filename;
	ol.options[i].selected = true;
	// mais aussi au champ cache qui contient tous les fichiers
	this.Uploader_UpdateMainField();
}

Uploader.prototype.Uploader_DeleteFromList = function() {
	var option2delete = this.Uploader_OptionSelected();
	var ol = this.parent_field_view;
	// on remonte toutes les options qui suivent
	for (var i=option2delete; i<ol.length-1; i++) {
		ol.options[i].text  = ol.options[i+1].text;
		ol.options[i].value = ol.options[i+1].value;
	}
	ol.length--;
	// mais aussi au champ cache qui contient tous les fichiers
	this.Uploader_UpdateMainField();
}


Uploader.prototype.Uploader_UpdateMainField = function () {
	var fieldvalue = '';
	var ol = this.parent_field_view;
	for (var i=0; i<ol.length; i++) {
		if (i>0) fieldvalue += '\t';
		fieldvalue += ol.options[i].value;
	}
	this.parent_field.value = fieldvalue;
}



Uploader.prototype.Uploader_TestBeforeDelete = function () {
	if (this.mode_mono) {
		return (this.parent_field_view.value!='');
	} else {
		return (this.Uploader_OptionSelected!=-1);
	}
}

Uploader.prototype.Uploader_OptionSelected = function () {
	var ol = this.parent_field_view;
	for (var i=0; i<ol.length; i++) {
		if (ol.options[i].selected) return i;
	}
	return -1;
}


Uploader.prototype.Uploader_ShowNameToDelete = function () {
	if (upl.mode_mono) {
		MM_findObj(upl.FieldName+'_VIEW').value = this.parent_field_view.value;
		this.objFieldName.value                 = this.parent_field.value;
	} else {
		i = this.Uploader_OptionSelected();						
		MM_findObj(upl.FieldName+'_VIEW').value = this.parent_field_view.options[i].text;
		this.objFieldName.value                 = this.parent_field_view.options[i].value;
	}
}

//---------------------------------------------------------------



	// DEBUT DU PROGRAMME
	if (typeof window.opener == 'undefined') {
		alert('uploader_x.js : ERREUR window.opener n\'est pas defini !');
		self.close();
	} else {

		// Initialisation des parametres de chemin de la page courante et de la page appelante
		var this_url   = new PathInfo();
		var opener_url = new PathInfo(window.opener.document.URL);
		// par securite on verifie que la page appelante est dans le repertoire de la page courante

		if (window_opener=='') {
			if (this_url.dir!=opener_url.dir) {
				load_error_code = -2;
			}
		}


		// Initialisation de l'objet Uploader 'NOM DU BOUTON' 'NOM DU CHAMP DE DONNEES'
		var upl        = new Uploader('UPLOAD','FILE_NAME');
		switch (load_error_code) {

			// CAS DU 1ER APPEL A LA FENETRE
			case -1 :
			
				// CAS DE L'AJOUT
				if (action=='ADD') {
					document.write('<form method="POST" name="FRM_UPLOADER" enctype="multipart/form-data" action="">');
					document.write('<input name="MAX_FILE_SIZE" type="hidden" value="'+max_file_size+'" />');

					document.write('<p class="classetitre">'+window_title+'</p>');
					document.write('<p><input type="file" name="'+upl.FieldName+'" size="60" class="classeformschampnormal" onChange="upl.Uploader_onChange()"><p>');
					message_ok = '<img src="'+resources_path+'uploader/info4.gif"> La taille du fichier doit être < <b>'+max_file_size_text+'</b>';
					if (resizing) {
						if (resize_prefix=='') {
							message_ok += '&nbsp;<img src="'+resources_path+'uploader/picture6.gif" title="l\'image va être redimensionnée ('+resize_msg+')">';
						} else {
							message_ok += '&nbsp;<img src="'+resources_path+'uploader/picture4.gif" title="Une vignette de l\'image va être créée ('+resize_msg+')">';
						}
					}
					// AFFICHAGE DU MESSAGE EN DESSOUS DU SELECTEUR
					document.write('<div class="classebutton">'+message_ok+'</div>');

					document.write('<input name="RETURNFIELD" type="hidden" value="'+return_field+'" />');
					document.write('<p><div align="center"><input type="button" value="Charger le fichier sur le site" id="'+upl.BtnName+'" class="classebutton" disabled="disabled" onClick="upl.Uploader_Go()">');
					document.write('</div></p></form>');
					upl.Uploader_init();
				} else {
					// CAS DE L'EFFACEMENT
					if (upl.Uploader_TestBeforeDelete()) {
						document.write('<form method="POST" name="FRM_UPLOADER" action="">');
						document.write('<input name="MAX_FILE_SIZE" type="hidden" value="'+max_file_size+'" />');
	
						document.write('<div align="center"><p class="classetitre">EFFACER LE FICHIER SUIVANT</p>');
						document.write('<p><input type="text" id="'+upl.FieldName+'_VIEW" value="" size="60" class="classeformschampnormal" readonly="true""><p>');
						document.write('<p><input type="hidden" name="'+upl.FieldName+'" value="" size="60" class="classeformschampnormal" readonly="true""><p>');

						document.write('<input name="RETURNFIELD" type="hidden" value="'+return_field+'" />');
						document.write('<br><p><div align="center"><input type="button" value="Effacer" id="'+upl.BtnName+'" class="classemessage" onClick="upl.Uploader_Go();document.forms.FRM_UPLOADER.submit()">');
						document.write('</div></p></form>');
						upl.Uploader_init();
						upl.Uploader_ShowNameToDelete();
					} else {
						self.close();
						break;
					}
				}
				break;

			// CAS OU LA PAGE N'A PAS ETE APPELEE PAR UNE PAGE DU SITE (HACKER)
			case -2 :
				alert('uploader.js : ERREUR -2 la page est apelee d\'un autre site !');
				self.close();
				break;


			case 0 :

				// CAS OU LE TELECHARGEMENT EST CORRECT
				if (action=='ADD') {
					var file_url   = new PathInfo(uploaded_file);
					// appel a la fonction de mise a jour du champ "pere"
					upl.Uploader_UpdateField_add(file_url.basename);
					document.write('<form method="POST" enctype="multipart/form-data" action=""><br>');
		
					message_ok = 'Le fichier ';
					if (file_is_image) {
						message_ok += 'image';
					}
					message_ok += ' <b>'+file_url.basename+' ('+size_file_text+')</b><br> a bien été chargé sur le serveur';
					if (file_resized) {
						message_ok += ', puis redimensionné';
						if (resize_msg!='') {
							message_ok += ' <i>('+resize_msg+')</i>';
						}
					}
					
					message_ok += ' !';
					upl.Uploader_Message('upload_ok.gif', message_ok);
					document.write('<p><div align="center"><input type="button" value="Fermer la fenêtre" id="'+upl.BtnName+'" class="classemessage" onClick="self.close();"></div>');
					document.write('</p></form>');
					break;
				} else {
					// CAS OU L'EFFACEMENT EST CORRECT
					var deleted_file_view = upl.Uploader_UpdateField_delete();					
					document.write('<form method="POST" action=""><br>');
					var delete_lib = '';
					if (deleted_from_server) {
						delete_lib = ' et du serveur';
					}
					upl.Uploader_Message('upload_delete.gif', 'Le fichier <b>'+deleted_file_view+'</b> a été effacé de la sélection'+delete_lib+'<br>');
					document.write('<p><div align="center"><input type="button" value="Fermer la fenêtre" id="'+upl.BtnName+'" class="classemessage" onClick="self.close();"></div>');
					document.write('</p></form>');
				break;

				}
				break;

			// CAS OU PAS DE TELECHARGEMENT
			default :

				document.write('<form method="POST" action="">');
				upl.Uploader_Message('upload_error.gif', load_error_msg+'<br>La copie vers le serveur a échouée!');
				document.write('<p><div align="center"><input type="button" value="Fermer la fenêtre" id="'+upl.BtnName+'" class="classebutton" onClick="self.close();"></div>');
				document.write('</p></form>');
				break;

		}
	}

	// FIN DE PROGRAMME



