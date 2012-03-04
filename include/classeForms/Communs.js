//verify for netscape/mozilla
var isNS4 = (navigator.appName=="Netscape")?1:0;
 
// Check browser version 
var isNav4 = false, isNav5 = false, isIE4 = false 
// Variable globales de DateFormat.js 
var strSeperator = "/";  
// If you are using any Java validation on the back side you will want to use the / because  
// Java date validations do not recognize the dash as a valid date separator. 
var vDateType = 3; // Global value for type of date format 
//                1 = mm/dd/yyyy 
//                2 = yyyy/dd/mm  (Unable to do date check at this time) 
//                3 = dd/mm/yyyy 
var vYearType = 4; //Set to 2 or 4 for number of digits in the year for Netscape 
var vYearLength = 2; // Set to 4 if you want to force the user to enter 4 digits for the year before validating. 
var err = 0; // Set the error code to a default of zero 

if(navigator.appName == "Netscape") { 
	if (navigator.appVersion < "5") { 
		isNav4 = true; 
		isNav5 = false; 
	} else if (navigator.appVersion > "4") { 
		isNav4 = false; 
		isNav5 = true; 
   } 
} else { 
	isIE4 = true; 
} 

var dFilterStep 

function MM_findObj(n, d) { //v4.01 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) { 
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);} 
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n]; 
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); 
  if(!x && d.getElementById) x=d.getElementById(n); return x; 
} 
function MM_setTextOfTextfield(objName,x,newText) { 
  var obj = MM_findObj(objName); if (obj) obj.value = newText; 
} 

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments;
  document.MM_sr=new Array;
  for(i=0;i<(a.length-2);i+=3)
  	if ((x=MM_findObj(a[i]))!=null){
		document.MM_sr[j++]=x;
		if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];
	}
}

function NM_copyField(f1,f2){ 
 	MM_findObj(f2).value=MM_findObj(f1).value; 
} 
function tmt_reFormat(f,re,s){ 
	fv=MM_findObj(f).value;var rex=new RegExp(unescape(re),"g"); 
	if(rex.test(fv)){MM_findObj(f).value=fv.replace(rex,unescape(s));} 
} 
function alltrim(f){ 
	fv=MM_findObj(f).value; 
	fv=fv.replace(/^\s*|\s*$/g,""); 
	fv=fv.replace(/\s+/g," "); 
	MM_findObj(f).value=fv; 
} 
function pasdeblanc(f){ 
	fv=MM_findObj(f).value; 
	MM_findObj(f).value=fv.replace(/\s+/g,""); 
} 
function trim(f){ 
	fv=MM_findObj(f).value; 
	fv=fv.replace(/^\s*|\s*$/,""); 
	MM_findObj(f).value=fv; 
} 
function tmt_disableField(){ 
	if(document.getElementById){var args=tmt_disableField.arguments; 
	for(var i=0;i<args.length;i=i+2){var obj=MM_findObj(args[i]); 
	if(obj){(args[i+1])?obj.disabled=true:obj.disabled=false;}}} 
} 

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}


function NM_focusfield(objName){ 
	var obj = MM_findObj(objName);  
	if (obj) { 
		if (!obj.readOnly && !obj.disabled) { 
			obj.focus(); 
//			alert('focus('+objName+')');
		}
	}

} 

function NM_focusfirstfield(nomchamp,selectionner){ 

	// focus sur le champ precisé ou si inactif le 1er suivant
	field = MM_findObj(nomchamp); 
	var i; 
	for (i = 0; i < field.form.elements.length; i++) { 
	    // pointage du champ passe en parametre 
		if (field == field.form.elements[i]) break;  
	} 
	j = i; 
	while ( true ) { 
		// POUR EVITER DE BOUCLER SI AUCUN CHAMP ACTIF
		if (j==field.form.elements.length) return; 
		objet = field.form.elements[j]; 
		if (objet.type=='text'||objet.type=='textarea'||objet.type=='radio'||objet.type=='checkbox'||objet.type=='select-one'||objet.type=='button') { 
			if (!objet.readOnly) { 
				if (!objet.disabled) { 
					objet.focus();  
					if (selectionner) objet.select();
					return; 
				} 
			}
		} 
		j++; 
	}
} 



function NM_changeCase(){ 
	if(document.getElementById){var args=NM_changeCase.arguments; 
	for(var i=0;i<args.length;i=i+2){var obj=MM_findObj(args[i]); 
	if(obj){(args[i+1])?obj.value=obj.value.toLowerCase():obj.value=obj.value.toUpperCase();}}} 
} 

function NM_InitialCap(objName){ 
	var obj = MM_findObj(objName); 
	var index; var tmpStr; var tmpChar; var preString; var postString; var strlen; 
	 tmpStr = obj.value.toLowerCase(); 
	 strLen = tmpStr.length; 
	if (strLen > 0)  { 
	for (index = 0; index < strLen; index++)  { 
	if (index == 0)  { 
	 tmpChar = tmpStr.substring(0,1).toUpperCase(); 
	 postString = tmpStr.substring(1,strLen); 
	 tmpStr = tmpChar + postString; 
	} 
	else { 
	 tmpChar = tmpStr.substring(index, index+1); 
	if (tmpChar == " " && index < (strLen-1))  { 
	 tmpChar = tmpStr.substring(index+1, index+2).toUpperCase(); 
	 preString = tmpStr.substring(0, index+1); 
	 postString = tmpStr.substring(index+2,strLen); 
	 tmpStr = preString + tmpChar + postString;}}}} 
	 obj.value = tmpStr; 
} 
function MK_dynamicForm() { //v4.0  
  document.forms.classformulaire.submit(); 
} 
  function MM_displayStatusMsg(msgStr) { //v1.0 
    status=msgStr; 
    document.MM_returnValue = true; 
  } 
  function tmt_confirm(msg) { 
     if (document.MM_returnValue==true)
  		document.MM_returnValue=(confirm(unescape(msg))); 
  } 
function handleEnter (field, event) {  
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;  
		if (keyCode == 13) {  
			var i; 
			for (i = 0; i < field.form.elements.length; i++) { 
			    // pointage du champ passe en parametre 
				if (field == field.form.elements[i]) break;  
			} 
			i = (i + 1) % field.form.elements.length;  
			j = i; 
			while ( true ) { 
				if (j==field.form.elements.length) j=0; 
				objet = field.form.elements[j]; 
				if (objet.type=='text'||objet.type=='textarea'||objet.type=='radio'||objet.type=='checkbox'||objet.type=='select-one') { 
					if (!objet.readOnly) { 
						if (!objet.disabled) { 
							objet.focus();  
							return false; 
						} 
					}
				} 
				j++; 
			} 
			return false; 
		}   
		else  
		return true;  
}  


function NewWindow(mypage,myname,w,h,scroll){ 
var win = null; 
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0; 
TopPosition = (screen.height) ? (screen.height-h)/2 : 0; 
settings = 
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable' 
win = window.open(mypage,myname,settings) 
} 
 
function SelectionneIndiceListe(L,valeuratrouver) { 
if (!valeuratrouver) { L.options.selectedIndex=-1; return; }
var indice=false, i=0; 
while (!indice && i<L.options.length) {
  if (L.options[i].value==valeuratrouver) indice=i; 
  i++; } 
  L.options.selectedIndex = indice; 
} 


function KW_getVal(o){
	var retVal="0";if (o.type=="select-one")
	{retVal=(o.selectedIndex==-1)?0:o.options[o.selectedIndex].value;}
	else if (o.length>1){for (var i=0;i<o.length;i++) if (o[i].checked) retVal=o[i].value;
	} else if (o.type=="checkbox") {retVal=(o.checked)?o.value:0;} else {
	retVal=Number(o.value)}return parseFloat(retVal);
}

function KW_calcForm() {
	var str="",a=KW_calcForm.arguments; 
	for (var i=3;i<a.length;i++) {	
		str+=(a[i].indexOf("#")==-1)?a[i]:KW_getVal(MM_findObj(a[i].substring(1)));
	}
	t=Math.round(a[1]*eval(str))/a[1];
	tS=t.toString();
	if(a[2]>0){tSp=tS.indexOf(".");
	if(tSp==-1)	tS+=".";
	tSp=tS.indexOf(".");
	while(tSp!=(tS.length-1-a[2])){
		tS+="0";
		tSp=tS.indexOf(".");
	}
	} MM_findObj(a[0]).value=tS;
}

/* 
	var this_url = new PathInfo();
	document.write('<br><b>dom =</b> '+this_url.dom);
	document.write('<br><b>basename</b> = '+this_url.basename);
	document.write('<br><b>extension</b> = '+this_url.extension);
	document.write('<br><b>args</b> = '+this_url.args);
	document.write('<br><b>page</b> = '+this_url.page);
	document.write('<br><b>dir</b> = '+this_url.dir);	

	pour la page http://www.oberlechner.net/dir/test.html?toto=1
	on obtient :
		.dom       = www.oberlechner.net
		.basename  = test.html
		.extension = html
		.args      = toto=1
		.page      = test
		.dir       = http://www.oberlechner.net/dir/
	
*/

function PathInfo(url) {
	if (typeof url == "undefined") {
		url = location.href;
	}
	
	// on separe en 2 la chaine de par et d'autre de "?" les paramètres
	posq = url.indexOf('?');
	if ( posq==-1 ) {
		url2      = url;
		this.args = '';
	} else {
		url2      = url.substring(0, posq);
		this.args = url.substring(posq+1);
	}


	this.dir = url2.substring(0, url2.lastIndexOf('\/'));
	// si la chaine commence par un point ou un slash, il s'agit de d'un chemin relatif
	if ( url.match(/^[\.\/]/g) ) {
		this.dom = ''; 
	} else {
		// determinons le domaine
		this.dom = this.dir; 
		// eliminons http:// devant
		if (this.dom.substr(0,7) == 'http:\/\/') {
			this.dom = this.dom.substr(7);
		} else if (this.dom.substr(0,6) == 'ftp:\/\/') {
			this.dom = this.dom.substr(6);
		}
	}
	// separons le domaine du chemin
	this.path = ''; 
	var pos = this.dom.indexOf('\/'); 
	if (pos > -1) {
		this.dom = this.dom.substr(0,pos);
		this.path = this.dom.substr(pos+1); 
	}
	this.page = url2.substring(this.dir.length+1, url2.length+1);

	// eliminons eventuellement les ancres nommees
	pos = this.page.indexOf('#');
	if (pos>-1) {
		this.page = this.page.substring(0, pos);
	}
	this.extension = ''; 
	pos = this.page.indexOf('.');
	if (pos > -1) {
		this.extension =this.page.substring(pos+1); 
		this.page = this.page.substr(0,pos);
	}
	this.basename = this.page;
	if (this.extension != '') this.basename += '.' + this.extension;
	if (this.basename == '') this.page = 'index';

}

// ------------------------------------------------------------------------------------------------

// Classe qui Permet d'initialiser un champ TEXTE en js pour permetre la prise en compte des caracteres speciaux (") par exemple
function TextValue_init() {
	this.cpt_textfield  = 0; 
	this.tab          = new Array();	

}

// initialisation individuelle
TextValue_init.prototype.TextValue_set = function ( fieldname, defvalue ) {
	this.tab[this.tab.length] = {_fieldname:fieldname, _defvalue:defvalue};
	this.cpt_textfield++;
	MM_setTextOfTextfield(fieldname,'',defvalue);
};

// initialisation de tous les champs enregistres
TextValue_init.prototype.TextValue_reset = function () {
	for (var i=0;i<this.cpt_textfield;i++) {
		MM_setTextOfTextfield(this.tab[i]._fieldname,'',this.tab[i]._defvalue);
	//	alert(i+'='++':'+defvalue);
	}
};

// ------------------------------------------------------------------------------------------------

// Classe qui permet de sauvegarder l'etat des champs
function FieldIsDisabled_init() {
	this.cpt_textfield  = 0; 
	this.tab          = new Array();	

}

// sauvegarde de l'etat du ou des champs specifies
FieldIsDisabled_init.prototype.FieldIsDisabled_save = function ( tabfields ) {
	var args=this.FieldIsDisabled_save.arguments; 
	for (i=0;i<args.length;i++) {	
		this.tab[this.tab.length] = {_fieldname:args[i], _isdisabled:MM_findObj(args[i]).disabled};
	}
};

// resturation de l'etat inital de tous les champs specifies
FieldIsDisabled_init.prototype.FieldIsDisabled_restore = function () {
	for (i=0;i<this.tab.length;i++) {	
		MM_findObj(this.tab[i]._fieldname).disabled = this.tab[i]._isdisabled;
	}
}

// ------------------------------------------------------------------------------------------------

// Classe qui permet de sauvegarder/restaurer la valeur d'un champ specifie
function SaveFieldValue_init() {
	this.cpt_textfield  = 0; 
	this.tabfield_name  = new Array();	
	this.tabfield_value = new Array();
}

SaveFieldValue_init.prototype.SaveFieldValue_add = function(fieldname) {
	this.tabfield_name[this.tabfield_name.length] = fieldname;
	this.cpt_textfield++;
}

// sauvegarde de la valeur du ou des champs prealablement definis
SaveFieldValue_init.prototype.SaveFieldValue_save = function () {
	if (this.cpt_textfield==0) return;
	this.tabfield_value = new Array();
	for (i=0;i<this.cpt_textfield;i++) {	
		this.tabfield_value[this.tabfield_value.length] = MM_findObj(this.tabfield_name[i]).value;
	}
}

// restauration de l'etat inital de tous les champs specifies
SaveFieldValue_init.prototype.SaveFieldValue_restore = function () {
	if (this.cpt_textfield==0) return;
	for (i=0;i<this.cpt_textfield;i++) {	
		var obj = MM_findObj(this.tabfield_name[i]);
		obj.value = this.tabfield_value[i];
	}
}



/*
------------------------------------------------------------------------------------------------
	Objet qui gere la validation d'un formulaire
------------------------------------------------------------------------------------------------
*/
function checkform_init() {
	this.objet_separateur = false;
	this.objet_onglet     = false;
}

checkform_init.prototype.checkform_separateur = function() {   
	this.objet_separateur = true;
}

checkform_init.prototype.checkform_onglet = function() {   
	this.objet_onglet     = true;
}



checkform_init.prototype.checkform = function() {   
  var a=this.checkform.arguments, oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;   
  var premier=-1;   
  for (i=1; i<a.length;i=i+4){   
	// l'attribut n°=1 doit commencer par un # sinon il n'est pas obligatoire  
    if (a[i+1].charAt(0)=='#'){   
		r=true;   
		a[i+1]=a[i+1].substring(1);  
	} else {  
	 	r=false  
	}   
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));   
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));   
    // si le champ est desactive alors il ne peut pas etre obligatoire   
	if (o.disabled) { r=false; }  
    v=o.value;  
	// t = attribut n°=2  
	t=a[i+2];   
	// dans le cas des chams texte  
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){   
      if (r&&v.length==0) {err=true}   
      if (v.length>0)   
	      if (t==1){ //fromto   
	        ma=a[i+1].split('_');  
			if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}   
      	  } else if (t==2){   
	        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");  
			if(!rx.test(v)) err=true;   
		  } else if (t==3){ // date   
	        ma=a[i+1].split("#");at=v.match(ma[0]);   
	        if(at){   
	          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];   
	          dte=new Date(cy,cm,cd);   
	          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm) {err=true};   
	        } else {  
			  err=true  
			}   
		} else if (t==4){ // time   
	        ma=a[i+1].split("#");at=v.match(ma[0]);  
			if(!at){err=true}   
		} else if (t==5){   
            if(o1.length) o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];   
			if(!o1.checked){err=true}   
		} else if (t==6){ // the same   
            if(v!=MM_findObj(a[i+1]).value){err=true}   
		}   
	// dans les autres cas  
	// CAS DES BOUTONS RADIO	  
    } else if (!o.type&&o.length>0&&o[0].type=='radio'){   
		at = a[i].match(/(.*)\[(\d+)\].*/i);   
		o2=(o.length>1)?o[at[2]]:o;   
		if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}   
		if (t==2){   
	        oo=false;   
			for(j=0;j<o.length;j++){oo=oo||o[j].checked}   
		        if(!oo){s+='* '+a[i+3]+'\n'}   
			}   
	    } else if (o.type=='checkbox'){   
			if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}   
		// dans le cas des listes			  
		} else if (o.type=='select-one'||o.type=='select-multiple'){  
			if(o.size>1) {  
				if(r&&t==1) {  
					cptselectionne = 0;  
					for (var idx=0;idx<o.options.length;idx++) {  
						if(o.options[idx].selected) { cptselectionne++; }   
					}  
					err= (cptselectionne == 0);  
				}  
			} else {  
				// dans le cas d'une liste a une seule ligne, la premiere est un libellé  
				if(r&&t==1&&o.selectedIndex/1==0){err=true}   
			}  
		} else if (o.type=='textarea'){
			if((!o.disabled) && (v.length==0) ){err=true}   
		} else if (o.type=='file'){   
			if(v.length<1){err=true}   
	    }   
	    if (err){
			s+='* '+a[i+3]+'\n'; 
			err=false;   
			if(premier==-1) premier=o; 
		}
	}   
	if (s!=''){  
    	alert('LES INFORMATIONS SUIVANTES DOIVENT ETRE MODIFIEES :\n_____________________________________________________________\n\n'+s);

		// SI AU MOINS UN SEPARATEUR DE PARAGRAPHE EXISTE ALORS ON EXPEND TOUS LES PARAGRAPHES AVANT DE POINTER LE 1er
		if (this.objet_separateur) expandall();

		// SI UN ONGLET EXISTE ALORS LE POINTAGE SUR LE 1ER CHAMP EST INACTIVE
		if (!this.objet_onglet) {
			if (premier.type!='hidden') premier.focus();
		}
	}   
	document.MM_returnValue = (s=='');      
}   


/* 
------------------------------------------------------------------------------------------------
	Initialisation des couleurs :
				$this->couleurchampnormal      = "#F4F3EA";
				$this->couleurchampobligatoire = "#E2DFC7";   
				$this->couleurchamperreur      = "#D7D2B0"; 
				$this->couleurtitre            = "#333333";
				$this->couleurfond             = "#EFEDDE";
				$this->skin_name               = "grey";
------------------------------------------------------------------------------------------------
*/

function css_init(couleurchampnormal,couleurchampobligatoire,couleurchamperreur,couleurtitre,couleurfond,skin_name,taillepolice) {
	this.couleurchampnormal      = couleurchampnormal ;
	this.couleurchampobligatoire = couleurchampobligatoire;
	this.couleurchamperreur      = couleurchamperreur;
	this.couleurtitre            = couleurtitre;
	this.couleurfond             = couleurfond;
	this.skin_name               = skin_name;
	this.taillepolice            = taillepolice;
	this.police                  = 'font-family: Verdana, Arial, Helvetica, sans-serif;';
	
	this.objet_slider             = false;
	this.formulaireenlectureseule = false;
	this.objet_uploader_preview   = false;
	this.objet_calendar           = false;
	this.objet_tabs               = false;
	this.objet_editor             = false;

	// le style ci dessous doit sortir sans attendre
	document.writeln( "<style type=\"text/css\">\n<!--" );

	document.writeln( ".classeformstitle {" );
	document.writeln( " font-family: Verdana, Arial, Helvetica, sans-serif; " );
	document.writeln( "	font-size: 18px;" );
	document.writeln( "	font-style: normal;" );
	document.writeln( "	font-weight: bold;" );
	document.writeln( "	color: "+this.couleurtitre+";" );
	document.writeln( "}" );

	document.writeln( "-->\n</style>" );
}


css_init.prototype.css_readonly = function() {
	this.formulaireenlectureseule = true;
}

css_init.prototype.css_slider = function() {
	this.objet_slider = true;
}

css_init.prototype.css_uploader_preview = function() {
	this.objet_uploader_preview = true;
}

css_init.prototype.css_calendar = function() {
	this.objet_calendar = true;
}

css_init.prototype.css_tabs = function() {
	this.objet_tabs = true;
}

css_init.prototype.css_editor = function() {
	this.objet_editor             = false;
}



css_init.prototype.css_show = function() {
	document.writeln( "<style type=\"text/css\">\n<!--" );

	document.writeln( ".classeformschampreadonly {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	background-color: #FFFFFE;" );
	document.writeln( "}" );
			
	document.writeln( ".classeformschampnormal {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	background-color: "+this.couleurchampnormal+";" );
	document.writeln( "}" );

	document.writeln( ".classeformschampobligatoire {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	background-color: "+this.couleurchampobligatoire+";" );
	document.writeln( "}" );


	document.writeln( ".classeformschamperreur {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	background-color: "+this.couleurchamperreur+";" );
	document.writeln( "}" );

	document.writeln( ".classeformsliste{" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	background-color: "+this.couleurchamperreur+";" );
	document.writeln( " font-weight: bold;" );
	document.writeln( "}" );

	document.writeln( ".classeformslabel {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "}" );
				
	document.writeln( ".classeformslabelerreur  {" );
	document.writeln( this.police );
	document.writeln( "	font-size: "+this.taillepolice+"px;" );
	document.writeln( "	color: "+this.couleurtitre+";" );
	document.writeln( "	text-decoration: underline;" );
	document.writeln( "}" );

	document.writeln( ".classeformsbouton {" );
	document.writeln( this.police );
	document.writeln( "	font-size: 10px;" );
	document.writeln( "	cursor:hand;" );
	document.writeln( "	font-weight: bold;" );
	document.writeln( "}" );


	document.writeln( ".classeformsminibouton {" );
	document.writeln( this.police );
	document.writeln( "	font-size: 9px;" );
	document.writeln( "	cursor:hand;" );
	document.writeln( "}" );

	document.writeln( ".classeformsbtradiovertical {" );
	document.writeln( "	height: auto;" );
	document.writeln( "	width: auto;" );
	document.writeln( "	border-top: none;" );
	document.writeln( "	border-right: none;" );
	document.writeln( "	border-bottom: none;" );
	document.writeln( "	border-left: outset;" );
	document.writeln( "}" );

	if (this.objet_slider) {
		document.writeln( ".dynamic-slider-control {" );
		if  (!this.formulaireenlectureseule) {
			document.writeln( "	background-color: "+this.couleurchampnormal+";" );
		}
		document.writeln( "	cursor:hand;" );
		document.writeln( "}" );
	}
	
	// si presence d'un objet "uploader" avec l'option "preview"
	if (this.objet_uploader_preview) {
		document.writeln( "#shadowtooltips_tooltip {" );
		document.writeln( " background-color: "+this.couleurfond+";" );
		document.writeln( "	border:2px solid "+this.couleurchampobligatoire+";" );
		document.writeln( "	position:absolute;" );
		document.writeln( "	display:none;" );
		document.writeln( "	z-index:20000;" );
		document.writeln( "	padding:2px;" );
		document.writeln( "	font-size: "+this.taillepolice+"px;" );
		document.writeln( "	-moz-border-radius:6px;	/* Rounded edges in Firefox */" );
		document.writeln( this.police );
		
		document.writeln( "}" );
		document.writeln( "#shadowtooltips_tooltipShadow {" );
		document.writeln( "	position:absolute;" );
		document.writeln( "	background-color:#555;" );
		document.writeln( "	display:none;" );
		document.writeln( "	z-index:10000;" );
		document.writeln( "	opacity:0.7;" );
		document.writeln( "	filter:alpha(opacity=70);" );
		document.writeln( "	-khtml-opacity: 0.7;" );
		document.writeln( "	-moz-opacity: 0.7;" );
		document.writeln( "	-moz-border-radius:6px;	/* Rounded edges in Firefox */" );
		document.writeln( "}");
	}

	// si presence d'un objet "calendar"
	if (this.objet_calendar) {
		document.writeln( ".calendar         { background: "+this.couleurchampnormal+"; }" );
		document.writeln( ".calendar table   { background: "+this.couleurchampnormal+"; }" );
		document.writeln( ".calendar .button { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar .nav    { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar thead .title   { background: "+this.couleurtitre+"; }" );
		document.writeln( ".calendar thead .name    { background: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar thead .weekend { color: "+this.couleurtitre+"; }" );
		document.writeln( ".calendar thead .hilite  { background-color: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar thead .active  { background-color: "+this.couleurchampnormal+"; }" );
		document.writeln( ".calendar table .wn      { background: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar tbody .rowhilite td    { background: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar tbody .rowhilite td.wn { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar tbody td.hilite { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar tbody td.active { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar tbody td.selected { background: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar tbody td.weekend  { color: "+this.couleurtitre+"; }" );
		document.writeln( ".calendar tbody td.today    { color: "+this.couleurtitre+"; }" );
		document.writeln( ".calendar tbody .disabled   { color: "+this.couleurtitre+"; }" );
		document.writeln( ".calendar tfoot .ttip       { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".calendar tfoot .hilite     { background: "+this.couleurtitre+"; }" );
		document.writeln( ".combo             { background: "+this.couleurchamperreur+"; }" );
		document.writeln( ".combo .active     { background: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".combo .hilite     { background: "+this.couleurchampnormal+"; }" );
		document.writeln( ".calendar td.time  { background-color: "+this.couleurchampobligatoire+"; }" );
		document.writeln( ".calendar td.time .ampm { border: 1px solid "+this.couleurtitre+"; }" );
		document.writeln( ".calendar td.time span.hilite { background-color: "+this.couleurtitre+"; }" );	
	}

	// si presence d'onglets
	if (this.objet_tabs) {
		if (this.formulaireenlectureseule) {
			var colcadretexte = this.couleurchamperreur;
			var colfontab     = this.couleurchampnormal;
			var colfondnormal = "White";
		} else {
			var colcadretexte = this.couleurtitre;
			var colfontab     = this.couleurchampobligatoire;
			var colfondnormal = this.couleurfond;
		}
		document.writeln( ".dynamic-tab-pane-control .tab-row .tab { \n" );
		// SI LE FORMULAIRE EST EN LECTURE SEULE ALORS ON GRISE LE FOND DE L'ONGLET
		document.writeln( "	background:	    "+colfontab+";" );
		document.writeln( "	border-color:	"+colcadretexte+";" );
		document.writeln( "} " );

		document.writeln( ".dynamic-tab-pane-control .tab-row .tab.selected {" );
		document.writeln( "	border:			1px solid "+colcadretexte+";" );
		document.writeln( "	border-bottom:	0;" );  // NE PAS EFFACER SOUS PEINE DE DECALLAGE
		document.writeln( "	background:		"+colfondnormal+";" );
		document.writeln( "}" );

		document.writeln( ".dynamic-tab-pane-control .tab-row .tab a {" );
		document.writeln( "	color:			"+colcadretexte+";" );
		document.writeln( "}" );

		document.writeln( ".dynamic-tab-pane-control .tab-page {" );
		document.writeln( "	border:			1px solid "+colcadretexte+";" );
		document.writeln( "	background:		"+colfondnormal+";" );
		document.writeln( "}" );
		
	}
	if (this.objet_editor) {
		document.writeln( ".TB_ToolbarSet, .TB_Expand, .TB_Collapse {" );
		document.writeln( "	background-color: "+this.couleurchampnormal+";" );
		document.writeln( "}" );

		document.writeln( ".TB_ToolbarSet, .TB_Expand, .TB_Collapse {" );
		document.writeln( "	border-top: "+this.couleurchampnormal+" 1px outset;" );
		document.writeln( "	border-bottom: "+this.couleurchampnormal+" 1px outset;" );
		document.writeln( "}" );
	}


	// fin de definition des styles des objet 
	document.writeln( "-->\n</style>" );
//	if (this.objet_uploader_preview) alert('ok');

}



/* objet qui ecrit les options des listes
	appel : 
		objChampList = new SelectList(defaut);
		objChampList.SelectList_Show('1','Un','2','Deux',....);

*/
function SelectList(default_option) {	
	this.default_option = default_option;
	this.Script = '';

	this.SelectList_Script = function() {
	}

	this.SelectList_Show = function() {
		TableIn = this.SelectList_Show.arguments;
		// boucle de 2 en 2
		for (var i=0;i<TableIn.length;i++) {
			document.writeln('<option value="'+TableIn[i]+'"');
			if (this.default_option==TableIn[i]) document.write(' selected');
			// on ajoute +1 pour envoyer le libellé de la ligne de la liste
			i++;
			document.writeln('>'+TableIn[i]+'</>');
		}
	}
} // Fin de classe "SelectList"




/* 
objet qui permet d'utiliser la classe js-calendar en mode "objet"
*/
function JsCalendar(id, format, showsTime, showsOtherMonths) {	
	this.el = MM_findObj(id);
	this.format = format;
	this.showsTime = showsTime;
	this.showsOtherMonths = showsOtherMonths;
	this.script_post_calendar = '';

	this.selected = function(cal, date) {
	  cal.sel.value = date; // just update the date in the input field.
	  if (cal.dateClicked) {
	    cal.callCloseHandler(); // this calls "onClose" (see above)
		// si un script a ete defini on l'execute
		if (cal.script_post_calendar!='') {
			eval(cal.script_post_calendar);
		}
	  } 
	}

	this.closeHandler = function(cal) {
	  cal.hide();                        // hide the calendar
	}

	this.JsCalendar_Show = function() {
		if (this.el.disabled) {
			alert('Le champ est inactif');
			return false;
		}
		// first-time call, create the calendar.
		var cal = new Calendar(1, null, this.selected, this.closeHandler);
		
		// uncomment the following line to hide the week numbers
		cal.weekNumbers = true;
    	if (typeof this.showsTime == "string") {
      		cal.showsTime = true;
      		cal.time24 = (this.showsTime == "24");
    	}
		if (this.showsOtherMonths) {
			cal.showsOtherMonths = true;
		}
		cal.setRange(1900, 2070);        // min/max year allowed.
		cal.create();
		cal.setDateFormat(this.format);    // set the specified date format
		cal.parseDate(this.el.value);      // try to parse the text in field
		cal.sel = this.el;                 // inform it what input field we use
		cal.script_post_calendar = this.script_post_calendar;
		// the reference element that we pass to showAtElement is the button that
		// triggers the calendar.  In this example we align the calendar bottom-right
		// to the button.
		cal.showAtElement(this.el, "B1");        // show the calendar
		return false;
	}


	this.JsCalendar_script = function(script) {
		this.script_post_calendar = script;
	}

} // fin de classe jsCalendar


/* 
	ENSEMBLE DE FONCTION POUR REALISER DES APPELS ASYNCHRONES TYPE "AJAX"
*/

		
function HttpRequest() {
	var XmlDoc = null;
	if(window.ActiveXObject){ // Internet Explorer 
		try {
			XmlDoc = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			XmlDoc = new ActiveXObject("Microsoft.XMLHTTP");
		}
	} else if (window.XMLHttpRequest){ // Firefox et autres
		XmlDoc = new XMLHttpRequest(); 
		XmlDoc.overrideMimeType('text/xml'); 
	} else { // XMLHttpRequest non supporté par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   XmlDoc = false; 
	} 
	return XmlDoc;
}

// Node cleaner
function DOM_cleanNode(c){
	if(!c.data.replace(/\s/g,'')) {
		c.parentNode.removeChild(c);
	}
}

function DOM_clean(d){
	var bal=d.getElementsByTagName('*');
	for(i=0;i<bal.length;i++){
		a=bal[i].previousSibling;
		if(a && a.nodeType==3)
			DOM_cleanNode(a);
		b=bal[i].nextSibling;
		if(b && b.nodeType==3)
			DOM_cleanNode(b);
	}
	return d;
} 




// Remplace toutes les occurences d'une chaine
function Character_replaceAll(str, search, repl) {
	while (str.indexOf(search) != -1) {
		str = str.replace(search, repl);
	}
	return str;
}

// Remplace les caractères accentués
function AccentToNoAccent(str) {
	var norm = new Array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë',
				'Ì','Í','Î','Ï', 'Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý',
				'Þ','ß', 'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î',
				'ï','ð','ñ', 'ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ý','þ','ÿ');
	var spec = new Array('A','A','A','A','A','A','A','C','E','E','E','E',
				'I','I','I','I', 'D','N','O','O','O','0','O','O','U','U','U','U','Y',
				'b','s', 'a','a','a','a','a','a','a','c','e','e','e','e','i','i','i',
				'i','d','n', 'o','o','o','o','o','o','u','u','u','u','y','y','b','y');
	for (var i = 0; i < spec.length; i++) {
		str = Character_replaceAll(str, norm[i], spec[i]);
	}
	return str;
}
