// Copyright 2001, 2003 InterAKT Online. All rights reserved.

if (typeof HTMLElement!="undefined" && ! HTMLElement.prototype.insertAdjacentElement) {

	HTMLElement.prototype.insertAdjacentElement = function (where,parsedNode) {
		switch (where){
			case 'beforeBegin':
				this.parentNode.insertBefore(parsedNode,this)
				break;
			case 'afterBegin':
				this.insertBefore(parsedNode,this.firstChild);
				break;
			case 'beforeEnd':
				this.appendChild(parsedNode);
				break;
			case 'afterEnd':
				if (this.nextSibling) this.parentNode.insertBefore(parsedNode,this.nextSibling);
				else this.parentNode.appendChild(parsedNode);
			break;
		}
	}

	HTMLElement.prototype.insertAdjacentHTML = function (where,htmlStr) {
		var r = this.ownerDocument.createRange();
		r.setStartBefore(this);
		var parsedHTML = r.createContextualFragment(htmlStr);
		this.insertAdjacentElement(where,parsedHTML)
	}

	HTMLElement.prototype.insertAdjacentText = function (where,txtStr) {
		var parsedText = document.createTextNode(txtStr)
		this.insertAdjacentElement(where,parsedText)
	}
}



var diKey_delete = 46;
var diKey_backspace = 8;
var diKey_Enter = 13;
var diKey_Tab = 9;
var diKey_Escape = 27;
var diKey_up = 38;
var diKey_down = 40;
var diKey_left = 37;
var diKey_right = 39;
var diKey_pageup = 33;
var diKey_pagedown = 34;
var diKey_debut = 36;
var diKey_fin = 35;

window.to = new Array();

function moveXbySlicePos (x, img) {
	if (!document.layers) {
		var NPbPiQqbMKKZ = navigator.platform ? navigator.platform == "Win32" : false;
		var LFKRRWmkCpkB = document.all && !NPbPiQqbMKKZ && getExplorerVersion() >= 4.5;
		var par = img;
		var AMzBokMfEnvp = 0;
		while(par){ 
			if( par.leftMargin && ! NPbPiQqbMKKZ ) x += parseInt(par.leftMargin);
			if( (par.offsetLeft != AMzBokMfEnvp) && par.offsetLeft ) x += parseInt(par.offsetLeft);
			if( par.offsetLeft != 0 ) AMzBokMfEnvp = par.offsetLeft;
			par = LFKRRWmkCpkB ? par.parentElement : par.offsetParent; 
		} 
	} else if (img.x) x += img.x; return x; 
}

function moveYbySlicePos (y, img) {
	if(!document.layers) {
		var NPbPiQqbMKKZ = navigator.platform ? navigator.platform == "Win32" : false;
		var LFKRRWmkCpkB = document.all && !NPbPiQqbMKKZ && getExplorerVersion() >= 4.5;
		var par = img; var AMzBokMfEnvp = 0;
		while(par){
			if( par.topMargin && !NPbPiQqbMKKZ ) y += parseInt(par.topMargin);
			if( (par.offsetTop != AMzBokMfEnvp) && par.offsetTop ) y += parseInt(par.offsetTop);
			if( par.offsetTop != 0 ) AMzBokMfEnvp = par.offsetTop;
			par = LFKRRWmkCpkB ? par.parentElement : par.offsetParent; 
		} 
	} else if (img.y >= 0) y += img.y; return y; 
}

function di_drawRange(sel, diTableauValeurs, EIntOJwkuJpF, NAiMUjTsvnEg) {
	var j=0; 
	for(var i=EIntOJwkuJpF; j<NAiMUjTsvnEg && i*2<diTableauValeurs.length; i++) {
		if(sel.options[j]){
			sel.options[j].text = diTableauValeurs[i*2];
			sel.options[j].value = diTableauValeurs[i*2-1]; 
		} else {
			sel.options[sel.options.length] = new Option(diTableauValeurs[i*2], diTableauValeurs[i*2-1]);
		}
		j++;
	}
}

function di_openSelect(el) {
	var sel = el.sel; 
	if (el.addButton) el.addButton.disabled = true;
	var diTableauValeurs = eval("window." + el.diTableauValeurs);
	sel.virtualStart = 1;
	di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec);
	di_syncSelection(el, true);
	var pos = new Object();
	pos.x = moveXbySlicePos(0, el);
	pos.y = moveYbySlicePos(el.offsetHeight, el);
	sel.style.left = pos.x + "px";
	sel.style.top = pos.y + "px";
	sel.style.display='block';
	pos.x = moveXbySlicePos(0, el);
	pos.y = moveYbySlicePos(el.offsetHeight, el);
	sel.style.left = pos.x + "px";
	sel.style.top = pos.y + "px";
	sel.style.display='none';
	setTimeout(function() { sel.style.top = parseInt(sel.style.top) + 1 + "px"; sel.style.display = "block"; }, 10);
}

function di_syncWithSelection(el) {
	if(el.sel.selectedIndex == -1) { return; }
	di_setAddDisabled(el, true);
	el.value = el.sel.options[el.sel.selectedIndex].text;
	if (el.edittype == 'E') {
		el.hidden.value = el.sel.options[el.sel.selectedIndex].value;
	} else {
		el.hidden.value = el.sel.options[el.sel.selectedIndex].text; 
	}
	var PGIVvZqwXNYO = el.value.length;
	if(el.setSelectionRange) {
		el.setSelectionRange(PGIVvZqwXNYO, PGIVvZqwXNYO); 
	} else if (el.createTextRange) {
		var BXMAGqKQYXNp = el.createTextRange();
		BXMAGqKQYXNp.moveStart('character', PGIVvZqwXNYO);
		BXMAGqKQYXNp.moveEnd('character', PGIVvZqwXNYO);
		BXMAGqKQYXNp.select();
	}
}

function di_setAddDisabled(el, dis) {
	// si la valeur saisie dans xxx_EDIT n'est pas dans la liste alors on change dynamiquement de normal en gras
//	el.style.color      = (dis) ? "#000000" : "#CC3366";
//	el.style.fontWeight = (dis) ? "normal" : "bold";
	el.style.fontStyle = (dis) ? "" : "italic";
	if(el.edittype == 'S') { return; }
	if (el.addButton) el.addButton.disabled = dis;
	
}

function di_syncSelection(el, nwfAOAPWYGnq) {
	if (!el.diTableauValeurs) { di_initialize(el.id.replace(/_EDIT$/, '')); }
	var cXyVWvleMnDn = el.value;
	var sel = el.sel;
	if(cXyVWvleMnDn.length == 0) {
		if (el.edittype != 'E') { el.hidden.value = el.value; } 
		di_setAddDisabled(el, true);
		return;
	}
	var diTableauValeurs = eval("window." + el.diTableauValeurs);
	var NPqzyYIqDuFI = -1;
	for (var i=2; i<diTableauValeurs.length;i+=2) {
		if ((diTableauValeurs[i].toLowerCase()).indexOf(cXyVWvleMnDn.toLowerCase())==0) {
			NPqzyYIqDuFI = i/2;
			break;
		} 
	}
	if(NPqzyYIqDuFI>0 && diTableauValeurs[NPqzyYIqDuFI*2].length == cXyVWvleMnDn.length) {
		di_setAddDisabled(el, true);
		// quand l'élément saisi est dans la liste alors le bouton ADD est desactive
	} else {
		di_setAddDisabled(el, false);
		// dans le cas d'un nouvel element la valeur cachée est forcee à -1
		el.hidden.value = -1;
	}
	if (el.edittype != 'E') { el.hidden.value = el.value; } 
	if(NPqzyYIqDuFI != -1 && el.edittype == 'E') { 
		el.hidden.value = diTableauValeurs[NPqzyYIqDuFI*2-1];
	}
	if(nwfAOAPWYGnq && cXyVWvleMnDn.length==0) { NPqzyYIqDuFI = 0; } 
	if(NPqzyYIqDuFI < sel.virtualStart-1 || NPqzyYIqDuFI >= sel.virtualStart + el.norec-1) {
		var tmp = NPqzyYIqDuFI - Math.floor(el.norec/2) + 1;
		if(tmp < 1) { 
			sel.virtualStart = 1; 
		} else if(tmp+el.norec-1 > (diTableauValeurs.length-1)/2) { 
			sel.virtualStart = (diTableauValeurs.length-1)/2-el.norec+1;
			NPqzyYIqDuFI = el.norec -((diTableauValeurs.length-1)/2 - NPqzyYIqDuFI) -1;
		} else { 
			sel.virtualStart = tmp;
			NPqzyYIqDuFI = Math.floor(el.norec/2);
		}
		if(NPqzyYIqDuFI > 0) { NPqzyYIqDuFI--; } 
		di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec); 
	} else { 
		NPqzyYIqDuFI -= sel.virtualStart; 
	} 
	try { 
		sel.selectedIndex = NPqzyYIqDuFI;
		if(sel.selectedIndex != NPqzyYIqDuFI) { 
			di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec);
			sel.selectedIndex = NPqzyYIqDuFI; 
		} 
	}
	catch (e) { alert("first: " + NPqzyYIqDuFI); }
}

function di_onBlur(el, evtclavier) {
	if (!el.diTableauValeurs) { 
		di_initialize(el.id.replace(/_EDIT$/, '')); 
	} 
	if (el.edittype != 'E') { el.hidden.value = el.value; } 
	window.to[el.id] = setTimeout('di_closeList("'+el.id+'")', 100);
}

function di_inputKeyDown(el, evtclavier) {
	window.browserSupportsOnKeyDown = true;
	return di_inputKeyDownOrPress(el, evtclavier);
}

function di_inputKeyPress(el, evtclavier) {
	if (!window.browserSupportsOnKeyDown) {
		return di_inputKeyDownOrPress(el, evtclavier);
	} else { 
		window.browserSupportsOnKeyDown=false;
	}
}

function di_inputKeyDownOrPress(el, evtclavier) {
	var ds = el.name.substr(0, el.name.length-5); 
	if (!el.diTableauValeurs) { 
		di_initialize(ds); 
	}
	var sel = el.sel; 
	switch (evtclavier.keyCode) { 
		case diKey_Escape:
		case diKey_Tab:
			if(sel.style.display == 'block') {
				if(sel.selectedIndex != -1){ di_syncWithSelection(el); } 
				di_closeList(el.id); 
			} 
			return true;
		case diKey_Enter:
			if(sel.selectedIndex != -1){ di_syncWithSelection(el); }
			if(sel.style.display == 'block') {
				di_closeList(el.id);
				evtclavier.cancelBubble = true;
				if (evtclavier.stopPropagation) {
					evtclavier.stopPropagation();
				}
			}
			return false;
		case diKey_down:
			if(sel.style.display == 'none') { 
				di_openSelect(el);
			} else { 
				di_listIncrementSel(el);
				di_syncWithSelection(el);
			}
			break;
		case diKey_up:
			if(sel.style.display == 'block') {
				di_listDecrementSel(el);
				di_syncWithSelection(el);
			} 
			break; 
		case diKey_pageup:
			if(sel.style.display == 'block') {
				di_listDecrementSel(el, 5);
				di_syncWithSelection(el);
			} 
			break; 
		case diKey_pagedown:
			if(sel.style.display == 'block') {
				di_listIncrementSel(el, 5);
				di_syncWithSelection(el);
			} 
			break; 
		}
		return true;
}

function di_initialize(di_NomObjet) { 
	var el = document.getElementById(di_NomObjet + '_EDIT');
	if (!el.diTableauValeurs) {
		el.diTableauValeurs = di_NomObjet + "_el";
		el.norec = parseInt(eval(di_NomObjet + "_norec"));
		el.edittype = eval(di_NomObjet + "_edittype");
		el.altstyle = eval(di_NomObjet + "_style"); 
		el.restrict = eval(di_NomObjet + "_restrict"); 
		el.addButton = document.getElementById(di_NomObjet + "_add");
		el.hidden = document.getElementById(di_NomObjet);
		di_sortDatasource(eval('window.' + el.diTableauValeurs)); 
	}
	if (!el.sel) {
		text = '<SELECT tabindex="-1" name='+di_NomObjet+'_sel id='+di_NomObjet+'_sel size=5 style="position:absolute; display:none;'+el.altstyle+'"' + 'onFocus="di_listFocused(this.el)"'+ 'onDblClick="di_listDblClicked(this.el)"'+ 'onClick="di_listClicked(this.el, event)">'+ '</SELECT>';
		document.body.insertAdjacentHTML("beforeEnd", text);
		el.sel = document.getElementById(di_NomObjet + "_sel");
		el.addButton = document.getElementById(di_NomObjet + "_add"); 
		el.iframe = document.getElementById(di_NomObjet + "_iframe");
		if (el.addButton) el.addButton.el = el;
		el.sel.el = el;
		el.sel.style.left = moveXbySlicePos(0, el); 
		el.sel.style.top = moveYbySlicePos(22, el); 
		if (el.sel.style.pixelWidth) { 
			el.sel.style.pixelWidth += 19; 
		} 
	}
}

function di_buttonPressed(di_NomObjet) {
	var el = document.getElementById(di_NomObjet + '_EDIT');
	if (!el.diTableauValeurs) {
		di_initialize(di_NomObjet); 
	}
	var sel = el.sel;
	if(sel.style.display == 'none') { 
		di_openSelect(el); 
	} else { 
		di_closeList(el.id); 
	} 
}


function di_sortDatasource(diTableauValeurs) { 
	var sw = true; 
	var n = diTableauValeurs.length;
	while (sw) {
		sw = false;
		for (var i=1;i<=n-3;i+=2) {
			if (diTableauValeurs[i+1].toLowerCase() > diTableauValeurs[i+3].toLowerCase()) { 
				sw = true; 
				var tmp = diTableauValeurs[i+1];
				diTableauValeurs[i+1] = diTableauValeurs[i+3];
				diTableauValeurs[i+3] = tmp;
				tmp = diTableauValeurs[i]; 
				diTableauValeurs[i] = diTableauValeurs[i+2]; 
				diTableauValeurs[i+2] = tmp;
			} 
		}
		n -= 2;
	} 
}

function di_closeList(diIdObjet) {
	var el = document.getElementById(diIdObjet);
	var sel = el.sel; 
	if (sel) {
		sel.style.display='none';
	} 
}

function di_vFocused(di_NomObjet) { 
	var el = document.getElementById(di_NomObjet + '_EDIT');
	clearTimeout(window.to[el.id]);
	el.focus();
}

function di_listFocused(el) {
	clearTimeout(window.to[el.id]); 
	el.focus();
}

function di_listClicked(el, e) { 
	if (el.sel.exScrollTop == null) {
		el.sel.exScrollTop = 0;
	}
	el.sel.ex2ScrollTop = el.sel.exScrollTop; 
	el.sel.exScrollTop = el.sel.scrollTop; 
	di_syncWithSelection(el); 
}

function di_listDblClicked(el) { 
	if (el.sel.ex2ScrollTop != el.sel.scrollTop) { return; } 
	di_closeList(el.id); 
}

function di_listIncrementSel(el, rxjhRZGdJwKO) {
	if(!rxjhRZGdJwKO) { rxjhRZGdJwKO = 1; } 
	var sel = el.sel;
	if(sel.selectedIndex < sel.options.length-rxjhRZGdJwKO) {
		sel.selectedIndex += rxjhRZGdJwKO; 
	} else {
		var diTableauValeurs = eval("window." + el.diTableauValeurs);
		if((sel.virtualStart-1) + el.norec + rxjhRZGdJwKO <= (diTableauValeurs.length-1)/2) {
			sel.virtualStart += rxjhRZGdJwKO; di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec);
		} else if((sel.virtualStart-1) + el.norec < (diTableauValeurs.length-1)/2) {
			sel.virtualStart = (diTableauValeurs.length-1)/2 - el.norec + 1;
			di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec);
			sel.selectedIndex = el.norec-1; 
		} else { }
	}
}

function di_listDecrementSel(el, rxjhRZGdJwKO) {
	if(!rxjhRZGdJwKO) { rxjhRZGdJwKO = 1; }
	var sel = el.sel;
	if(sel.selectedIndex >= 0 + rxjhRZGdJwKO) {
		sel.selectedIndex -= rxjhRZGdJwKO; 
	} else {
		var diTableauValeurs = eval("window." + el.diTableauValeurs);
		if(sel.virtualStart > rxjhRZGdJwKO) {
			sel.virtualStart-= rxjhRZGdJwKO;
			di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec);
		} else if(sel.virtualStart >1) {
			sel.virtualStart = 1; 
			di_drawRange(sel, diTableauValeurs, sel.virtualStart, el.norec); 
			sel.selectedIndex = 0; 
		} else {
			sel.selectedIndex = 0; 
		} 
	} 
}

function di_updateForm(bt) { 
	bt = document.getElementById(bt);
	if (!bt.form.btns) { 
		bt.form.btns = new Array();
	} 
	bt.form.btns[bt.form.btns.length] = bt; 
	if (!bt.form.onsubmit) { 
//		bt.form.onsubmit = di_checkSubmit; 
	} 
}


function di_checkSubmit() { 
	var sw = true; 
	for (i in this.btns) {
		if (!this.btns[i].disabled) { sw = false; } 
	} 
	if (sw) { return true; } 
	setTimeout("di_checkSubmit1('" + this.btns[0].id + "')", 1); 
	return sw; 
} 


function autoComplete (el, evt) { 
	if(evt.keyCode == diKey_Enter) { 
		if (el.edittype != 'E') { 
			el.hidden.exvalue = el.value; 
		} 
		return; 
	} 
	if (evt.keyCode == diKey_backspace || evt.keyCode == diKey_delete) {
		el.exValue = el.value; 
		di_syncSelection(el); 
		return; 
	} 
	if (evt.keyCode == diKey_up || evt.keyCode == diKey_right || evt.keyCode == diKey_down || evt.keyCode == diKey_left || evt.keyCode == diKey_pageup || evt.keyCode == diKey_pagedown) { return; }
	if (el.exValue && el.exValue == el.value) { return; } 
	di_syncSelection(el); 
	if (!el.diTableauValeurs) { di_initialize(el.name.substr(0, el.name.length-5)); }
	dataArray = eval("window." + el.diTableauValeurs); 
	var QzBgtUIqDuJp = false; 
	for (var i = 1; i < dataArray.length; i+=2) {
		if ((QzBgtUIqDuJp = dataArray[i+1].toLowerCase().indexOf(el.value.toLowerCase()) == 0)) { break; }
	} 
	if (QzBgtUIqDuJp) { 
		di_setAddDisabled(el, true);
		var nApIRvlYNnAM = el.value; 
		if (typeof el.selectionStart != 'undefined') {
			if (evt.keyCode == 16) { return; } 
			el.value = dataArray[i+1]; 
			el.setSelectionRange(nApIRvlYNnAM.length, el.value.length); 
		} else if (el.createTextRange) { 
			if (evt.keyCode == 16) { return; }
			el.value = dataArray[i+1]; 
			var BXMAGqKQYXNp = el.createTextRange(); 
			BXMAGqKQYXNp.moveStart('character', nApIRvlYNnAM.length); 
			BXMAGqKQYXNp.moveEnd('character', el.value.length); 
			BXMAGqKQYXNp.select(); 
		} 
	} 
	el.exValue = el.value; 
	if (el.edittype != 'E') { el.hidden.value = el.value; } 
} 
