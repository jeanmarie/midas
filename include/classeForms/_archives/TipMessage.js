<!---
var tp_ua = navigator.userAgent
var tp_ps = navigator.productSub 
var tp_dom = (document.getElementById)? 1:0
var tp_ie4 = (document.all&&!tp_dom)? 1:0
var tp_ie5 = (document.all&&tp_dom)? 1:0
var tp_nn4 =(navigator.appName.toLowerCase() == "netscape" && parseInt(navigator.appVersion) == 4)
var tp_nn6 = (tp_dom&&!tp_ie5)? 1:0
var tp_sNav = (tp_nn4||tp_nn6||tp_ie4||tp_ie5)? 1:0
var tp_cssFilters = ((tp_ua.indexOf("MSIE 5.5")>=0||tp_ua.indexOf("MSIE 6")>=0)&&tp_ua.indexOf("Opera")<0)? 1:0
var tp_Count=0,tp_sbw=0,tp_move=0,tp_hs="",tp_mx,tp_my,tp_scl,tp_sct,tp_ww,tp_wh,tp_obj,tp_sl,tp_st,tp_ih,tp_iw,tp_vl,tp_hl,tp_sv,tp_evlh,tp_evlw,tp_tbody
var HideTip = "eval(tp_obj+tp_sv+tp_hl+';'+tp_obj+tp_sl+'=0;'+tp_obj+tp_st+'=-800')"
var tp_doc_root = ((tp_ie5&&tp_ua.indexOf("Opera")<0||tp_ie4)&&document.compatMode=="CSS1Compat")? "document.documentElement":"document.body"
var PX = (tp_nn6)? "px" :"" 

var tp_FiltersEnabled = 1 // if your not going to use transitions or filters in any of the tips set this to 0

if(tp_sNav) {
	window.onresize = tp_ReloadTip
	document.onmousemove = tp_MoveTip
	if(tp_nn4) document.captureEvents(Event.MOUSEMOVE) 
}	
if(tp_nn4||tp_nn6) {
	tp_mx = "e.pageX"
	tp_my = "e.pageY"
	tp_scl = "window.pageXOffset"
	tp_sct = "window.pageYOffset"	
	if(tp_nn4) {
		tp_obj = "document.TipLayer."
		tp_sl = "left"
		tp_st = "top"
		tp_ih = "clip.height"
		tp_iw = "clip.width"
		tp_vl = "'show'"
		tp_hl = "'hide'"
		tp_sv = "visibility="
	}
	else tp_obj = "document.getElementById('TipLayer')."
} 
if(tp_ie4||tp_ie5) {
	tp_obj = "TipLayer."
	tp_mx = "event.x"
	tp_my = "event.y"
	tp_scl = "eval(tp_doc_root).scrollLeft"
	tp_sct = "eval(tp_doc_root).scrollTop"
	if(tp_ie5) {
		tp_mx = tp_mx+"+"+tp_scl 
		tp_my = tp_my+"+"+tp_sct
	}
}
if(tp_ie4||tp_dom){
	tp_sl = "style.left"
	tp_st = "style.top"
	tp_ih = "offsetHeight"
	tp_iw = "offsetWidth"
	tp_vl = "'visible'"
	tp_hl = "'hidden'"
	tp_sv = "style.visibility="
}
if(tp_ie4||tp_ie5||tp_ps>=20020823) {
	tp_ww = "eval(tp_doc_root).clientWidth"
	tp_wh = "eval(tp_doc_root).clientHeight"
}	 
else { 
	tp_ww = "window.innerWidth"
	tp_wh = "window.innerHeight"
	tp_evlh = eval(tp_wh)
	tp_evlw = eval(tp_ww)
	tp_sbw=15
}	

function tp_applyCssFilter(){
	if(tp_cssFilters&&tp_FiltersEnabled) { 
		var dx = " progid:DXImageTransform.Microsoft."
		TipLayer.style.filter = "revealTrans()"+dx+"Fade(Overlap=1.00 enabled=0)"+dx+"Inset(enabled=0)"+dx+"Iris(irisstyle=PLUS,motion=in enabled=0)"+dx+"Iris(irisstyle=PLUS,motion=out enabled=0)"+dx+"Iris(irisstyle=DIAMOND,motion=in enabled=0)"+dx+"Iris(irisstyle=DIAMOND,motion=out enabled=0)"+dx+"Iris(irisstyle=CROSS,motion=in enabled=0)"+dx+"Iris(irisstyle=CROSS,motion=out enabled=0)"+dx+"Iris(irisstyle=STAR,motion=in enabled=0)"+dx+"Iris(irisstyle=STAR,motion=out enabled=0)"+dx+"RadialWipe(wipestyle=CLOCK enabled=0)"+dx+"RadialWipe(wipestyle=WEDGE enabled=0)"+dx+"RadialWipe(wipestyle=RADIAL enabled=0)"+dx+"Pixelate(MaxSquare=35,enabled=0)"+dx+"Slide(slidestyle=HIDE,Bands=25 enabled=0)"+dx+"Slide(slidestyle=PUSH,Bands=25 enabled=0)"+dx+"Slide(slidestyle=SWAP,Bands=25 enabled=0)"+dx+"Spiral(GridSizeX=16,GridSizeY=16 enabled=0)"+dx+"Stretch(stretchstyle=HIDE enabled=0)"+dx+"Stretch(stretchstyle=PUSH enabled=0)"+dx+"Stretch(stretchstyle=SPIN enabled=0)"+dx+"Wheel(spokes=16 enabled=0)"+dx+"GradientWipe(GradientSize=1.00,wipestyle=0,motion=forward enabled=0)"+dx+"GradientWipe(GradientSize=1.00,wipestyle=0,motion=reverse enabled=0)"+dx+"GradientWipe(GradientSize=1.00,wipestyle=1,motion=forward enabled=0)"+dx+"GradientWipe(GradientSize=1.00,wipestyle=1,motion=reverse enabled=0)"+dx+"Zigzag(GridSizeX=8,GridSizeY=8 enabled=0)"+dx+"Alpha(enabled=0)"+dx+"Dropshadow(OffX=3,OffY=3,Positive=true,enabled=0)"+dx+"Shadow(strength=3,direction=135,enabled=0)"
	}
}

function tp_stm(t,s) {
  if(tp_sNav) {
  	if(t.length<2||s.length<25) {
		var ErrorNotice = "DHTML TIP MESSAGE VERSION 1.2 ERROR NOTICE.\n"
		if(t.length<2&&s.length<25) alert(ErrorNotice+"It looks like you removed an entry or more from the Style Array and Text Array of this tip.\nTheir should be 25 entries in every Style Array even though empty and 2 in every Text Array. You defined only "+s.length+" entries in the Style Array and "+t.length+" entry in the Text Array. This tip won't be viewed to avoid errors")
		else if(t.length<2) alert(ErrorNotice+"It looks like you removed an entry or more from the Text Array of this tip.\nTheir should be 2 entries in every Text Array. You defined only "+t.length+" entry. This tip won't be viewed to avoid errors.")
		else if(s.length<25) alert(ErrorNotice+"It looks like you removed an entry or more from the Style Array of this tip.\nTheir should be 25 entries in every Style Array even though empty. You defined only "+s.length+" entries. This tip won't be viewed to avoid errors.")
 	}
  	else {
		var ab = "" ;var ap = ""
		var titCol = (s[0])? "COLOR='"+s[0]+"'" : ""
		var txtCol = (s[1])? "COLOR='"+s[1]+"'" : ""
		var titBgCol = (s[2])? "BGCOLOR='"+s[2]+"'" : ""
		var txtBgCol = (s[3])? "BGCOLOR='"+s[3]+"'" : ""
		var titBgImg = (s[4])? "BACKGROUND='"+s[4]+"'" : ""	
		var txtBgImg = (s[5])? "BACKGROUND='"+s[5]+"'" : ""
		var titTxtAli = (s[6] && s[6].toLowerCase()!="left")? "ALIGN='"+s[6]+"'" : ""
		var txtTxtAli = (s[7] && s[7].toLowerCase()!="left")? "ALIGN='"+s[7]+"'" : ""   
		var add_height = (s[15])? "HEIGHT='"+s[15]+"'" : ""
		if(!s[8])  s[8] = "Verdana,Arial,Helvetica"
		if(!s[9])  s[9] = "Verdana,Arial,Helvetica"					
		if(!s[12]) s[12] = 1
		if(!s[13]) s[13] = 1
		if(!s[14]) s[14] = 200
		if(!s[16]) s[16] = 0
		if(!s[17]) s[17] = 0
		if(!s[18]) s[18] = 10
		if(!s[19]) s[19] = 10
		tp_hs = s[11].toLowerCase() 
		if(tp_ps==20001108){
		if(s[2]) ab="STYLE='border:"+s[16]+"px solid"+" "+s[2]+"'"
		ap="STYLE='padding:"+s[17]+"px "+s[17]+"px "+s[17]+"px "+s[17]+"px'"}
		var closeLink=(tp_hs=="sticky")? "<TD ALIGN='right'><FONT SIZE='"+s[12]+"' FACE='"+s[8]+"'><A HREF='javascript:void(0)' ONCLICK='tp_stickyhide()' STYLE='text-decoration:none;color:"+s[0]+"'><B>Close</B></A></FONT></TD>":""
		var title=(t[0]||tp_hs=="sticky")? "<TABLE WIDTH='100%' BORDER='0' CELLPADDING='0' CELLSPACING='0'><TR><TD "+titTxtAli+"><FONT SIZE='"+s[12]+"' FACE='"+s[8]+"' "+titCol+"><B>"+t[0]+"</B></FONT></TD>"+closeLink+"</TR></TABLE>" : ""
		var txt="<TABLE "+titBgImg+" "+ab+" WIDTH='"+s[14]+"' BORDER='0' CELLPADDING='"+s[16]+"' CELLSPACING='0' "+titBgCol+" ><TR><TD>"+title+"<TABLE WIDTH='100%' "+add_height+" BORDER='0' CELLPADDING='"+s[17]+"' CELLSPACING='0' "+txtBgCol+" "+txtBgImg+"><TR><TD "+txtTxtAli+" "+ap+" VALIGN='top'><FONT SIZE='"+s[13]+"' FACE='"+s[9]+"' "+txtCol +">"+t[1]+"</FONT></TD></TR></TABLE></TD></TR></TABLE>"
		if(tp_nn4) {
			with(eval(tp_obj+"document")) {
				open()
				write(txt)
				close()
			}
		}
		else eval(tp_obj+"innerHTML=txt")
		tp_tbody = {
			Pos:s[10].toLowerCase(), 
			Xpos:s[18],
			Ypos:s[19], 
			Transition:s[20],
			Duration:s[21], 
			Alpha:s[22],
			ShadowType:s[23].toLowerCase(),
			ShadowColor:s[24],
			Width:parseInt(eval(tp_obj+tp_iw)+3+tp_sbw)
		}
		if(tp_ie4) { 
			TipLayer.style.width = s[14]
	 		tp_tbody.Width = s[14]
		}
		tp_Count=0	
		tp_move=1
 	 }
  }
}

function tp_MoveTip(e) {
	if(tp_move) {
		var X,Y,MouseX = eval(tp_mx),MouseY = eval(tp_my); tp_tbody.Height = parseInt(eval(tp_obj+tp_ih)+3)
		tp_tbody.wiw = parseInt(eval(tp_ww+"+"+tp_scl)); tp_tbody.wih = parseInt(eval(tp_wh+"+"+tp_sct))
		switch(tp_tbody.Pos) {
			case "left" : X=MouseX-tp_tbody.Width-tp_tbody.Xpos; Y=MouseY+tp_tbody.Ypos; break
			case "center": X=MouseX-(tp_tbody.Width/2); Y=MouseY+tp_tbody.Ypos; break
			case "float": X=tp_tbody.Xpos+eval(tp_scl); Y=tp_tbody.Ypos+eval(tp_sct); break	
			case "fixed": X=tp_tbody.Xpos; Y=tp_tbody.Ypos; break		
			default: X=MouseX+tp_tbody.Xpos; Y=MouseY+tp_tbody.Ypos
		}

		if(tp_tbody.wiw<tp_tbody.Width+X) X = tp_tbody.wiw-tp_tbody.Width
		if(tp_tbody.wih<tp_tbody.Height+Y+tp_sbw) {
			if(tp_tbody.Pos=="float"||tp_tbody.Pos=="fixed") Y = tp_tbody.wih-tp_tbody.Height-tp_sbw
			else Y = MouseY-tp_tbody.Height
		}
		if(X<0) X=0 
		eval(tp_obj+tp_sl+"=X+PX;"+tp_obj+tp_st+"=Y+PX")
		tp_ViewTip()
	}
}

function tp_ViewTip() {
  	tp_Count++
	if(tp_Count == 1) {
		if(tp_cssFilters&&tp_FiltersEnabled) {	
			for(Index=28; Index<31; Index++) { TipLayer.filters[Index].enabled = 0 }
			for(s=0; s<28; s++) { if(TipLayer.filters[s].status == 2) TipLayer.filters[s].stop() }
			if(tp_tbody.Transition == 51) tp_tbody.Transition = parseInt(Math.random()*50)
			var applyTrans = (tp_tbody.Transition>-1&&tp_tbody.Transition<24&&tp_tbody.Duration>0)? 1:0
			var advFilters = (tp_tbody.Transition>23&&tp_tbody.Transition<51&&tp_tbody.Duration>0)? 1:0
			var which = (applyTrans)?0:(advFilters)? tp_tbody.Transition-23:0 
			if(tp_tbody.Alpha>0&&tp_tbody.Alpha<100) {
	  			TipLayer.filters[28].enabled = 1
	  			TipLayer.filters[28].opacity = tp_tbody.Alpha
			}
			if(tp_tbody.ShadowColor&&tp_tbody.ShadowType == "simple") {
	  			TipLayer.filters[29].enabled = 1
	  			TipLayer.filters[29].color = tp_tbody.ShadowColor
			}
			else if(tp_tbody.ShadowColor&&tp_tbody.ShadowType == "complex") {
	  			TipLayer.filters[30].enabled = 1
	  			TipLayer.filters[30].color = tp_tbody.ShadowColor
			}
			if(applyTrans||advFilters) {
				eval(tp_obj+tp_sv+tp_hl)
	  			if(applyTrans) TipLayer.filters[0].transition = tp_tbody.Transition
	  			TipLayer.filters[which].duration = tp_tbody.Duration 
	  			TipLayer.filters[which].apply()
			}
		}
 		eval(tp_obj+tp_sv+tp_vl)
		if(tp_cssFilters&&tp_FiltersEnabled&&(applyTrans||advFilters)) TipLayer.filters[which].play()
		if(tp_hs == "sticky") tp_move=0
  	}
}

function tp_stickyhide() {
	eval(HideTip)
}

function tp_ReloadTip() {
	 if(tp_nn4&&(tp_evlw!=eval(tp_ww)||tp_evlh!=eval(tp_wh))) location.reload()
	 else if(tp_hs == "sticky") eval(HideTip)
}

function tp_htm() {
	if(tp_sNav) {
		if(tp_hs!="keep") {
			tp_move=0; 
			if(tp_hs!="sticky") eval(HideTip)
		}	
	} 
}

-->