<html><head>
<title>COLOR PICKER</title>

<style type="text/css">
<!--
.subtext { font-family:helvetica,arial; font-size:8pt; background-color:#CCCCCC; layer-background-color:#CCCCCC;}
.title { font-family:helvetica,arial; font-size:13pt; font-weight:bold; }

.red { position:absolute; left:20px;   top:59px; width:256; height:10; z-index:1; visibility:visible; background-image:url(redback.gif); layer-background-image:url(redback.gif); clip:rect(0px 256px 10px 0px);}
.green { position:absolute; left:20px; top:87px; width:256; height:10; z-index:1; visibility:visible; background-image:url(greenback.gif); layer-background-image:url(greenback.gif); clip:rect(0px 256px 10px 0px);}
.blue { position:absolute; left:20px;  top:114px; width:256; height:10; z-index:1; visibility:visible; background-image:url(blueback.gif); layer-background-image:url(blueback.gif); clip:rect(0px 256px 10px 0px);}

.redSlider { position:absolute; left:6px;   top:41px; width:32; height:20; z-index:2; visibility:visible; background-image:url(scroll-boxh2.gif); layer-background-image:url(scroll-boxh2.gif); clip:rect(0px 32px 20px 0px);}
.greenSlider { position:absolute; left:6px; top:69px; width:32; height:20; z-index:2; visibility:visible; background-image:url(scroll-boxh2.gif); layer-background-image:url(scroll-boxh2.gif); clip:rect(0px 32px 20px 0px);}
.blueSlider { position:absolute; left:6px;  top:96px; width:32; height:20; z-index:2; visibility:visible; background-image:url(scroll-boxh2.gif); layer-background-image:url(scroll-boxh2.gif); clip:rect(0px 32px 20px 0px);}

.display { position:absolute; left:288px;    top:46px; width:50px; height:80px; z-index:1; visibility:visible; background-color:#000000; layer-background-color:#000000; }
.hexValue { position:absolute; left:21px;    top:140px; width:320; height:20; z-index:1; visibility:visible;}
.titleBar { position:absolute; left:20px;    top:17px; width:320; height:20; z-index:1; background-color:#DDDDDD; layer-background-color:#DDDDDD;}
.colorTable { position:absolute; left:348px; top:17px; width:320; height:200; z-index:1; visibility:visible;}
//-->
</style>

<?php
	$couleurdefaut = isset($_GET['DEFAULT']) ? $_GET['DEFAULT'] : "000000";
	$target_text = ( $_GET['TARGET'] == 'TEXT' );
?>

<script type='text/javascript'>
<!--   Andrew Houser (houser@houserdesign.com) -->
<!-- Web Site:  http://www.houserdesign.com -->
<!-- Extra codign for mozilla compatability by htmlfixit.com //-->

<!-- Begin
function init() {
	ns4 = (document.layers)?true:false;
	ie_moz = (document.getElementById)?true:false;
	if(!e)var e=window.event;
	// ns6 = ((document.getElementById)&&(!ie_moz))?true:false;
	// document.write("**" + ns6 + "**" + "**" + ie_moz + "**" + "**" + ns4 + "**");
	if ((!ns4) && (!document.all)){display = document.getElementById('display');}
	sliderMin = 7;
	sliderMax = 263;
	rValue=0;
	gValue=0;
	bValue=0;
	r1 = '0';
	r2 = '0';
	g1 = '0';
	g2 = '0';
	b1 = '0';
	b2 = '0';
	Rgb = '0';
	rGb = '0';
	rgB = '0';
	rActive = false;
	gActive = false;
	bActive = false;
	document.onmousedown = mouseDown
	document.onmousemove = mouseMove
	document.onmouseup = mouseUp
	if (ns4) document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);

	// See if this works for moz as well.
	// if ((document.getElementByID) && (!document.all)){ document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);}

    // FH was here./////////
    if (window.Event) {
        if (document.captureEvents) {
            document.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);
		} else {
            window.captureEvents(Event.MOUSEDOWN | Event.MOUSEMOVE | Event.MOUSEUP);
		}
	}
     /////////////////////

	if (ns4) {
		domRed = document.redSlider;
		domRed.xpos = parseInt(domRed.left);
		domRed.ypos = parseInt(domRed.top);
		domRed.w = domRed.clip.width;
		domRed.h = domRed.clip.height;
		domGreen = document.greenSlider;
		domGreen.xpos = parseInt(domGreen.left);
		domGreen.ypos = parseInt(domGreen.top);
		domGreen.w = domGreen.clip.width;
		domGreen.h = domGreen.clip.height;
		domBlue = document.blueSlider;
		domBlue.xpos = parseInt(domBlue.left);
		domBlue.ypos = parseInt(domBlue.top);
		domBlue.w = domBlue.clip.width;
		domBlue.h = domBlue.clip.height;
		domDisplay = document.display;
		domValue = document.hexValue.document.frmValue.valueDisp;
		domredValue = document.hexValue.document.frmValue.RgbDisp;
		domgreenValue = document.hexValue.document.frmValue.rGbDisp;
		domblueValue = document.hexValue.document.frmValue.rgBDisp;
	} else {
		domRed = document.getElementById('redSlider').style;
		domRed.xpos = document.getElementById('redSlider').offsetLeft;
		domRed.ypos = document.getElementById('redSlider').offsetTop;
		domRed.w = document.getElementById('redSlider').clientWidth;
		domRed.h = document.getElementById('redSlider').clientHeight;

		domGreen = document.getElementById('greenSlider').style;
		domGreen.xpos = document.getElementById('greenSlider').offsetLeft;
		domGreen.ypos = document.getElementById('greenSlider').offsetTop;
		domGreen.w = document.getElementById('greenSlider').clientWidth;
		domGreen.h = document.getElementById('greenSlider').clientHeight;
	
		domBlue = document.getElementById('blueSlider').style;
		domBlue.xpos = document.getElementById('blueSlider').offsetLeft;
		domBlue.ypos = document.getElementById('blueSlider').offsetTop;
		domBlue.w = document.getElementById('blueSlider').clientWidth;
		domBlue.h = document.getElementById('blueSlider').clientHeight;
		domDisplay = display;

		if ((!ns4) && (!document.all)){
			frmValue = document.getElementById('frmValue');
		}

		domValue = frmValue.valueDisp;
		domredValue = frmValue.RgbDisp;
		domgreenValue = frmValue.rGbDisp;
		domblueValue = frmValue.rgBDisp;
	}
	hexArray = new Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
}

function mouseDown(e) {

	if ((document.getElementByID) && (!document.all)) {
		var ele = e.button;
	} else if (document.all) {
		var ele = event.button;
	}

	if ((ns4 && e.which!=1) || (ie_moz && ele!=1)) return true;

	if ((ns4) || (document.all)){
		var x = (ns4)? e.pageX : event.x+document.body.scrollLeft;
		var y = (ns4)? e.pageY : event.y+document.body.scrollTop;
	}

// FH added this.
	if ((document.getElementByID) && (!document.all)) {
		var x = moz_get_coords('xco');
		var y = moz_get_coords('yco');
		alert(x);
		alert(y);
	}

	if (x > domRed.xpos && x < domRed.xpos+domRed.w && y > domRed.ypos && y < domRed.ypos+domRed.h){ 
		rActive = true; dragObject = domRed;
	}
	if (x > domGreen.xpos && x < domGreen.xpos+domGreen.w && y > domGreen.ypos && y < domGreen.ypos+domGreen.h){ 
		gActive = true; dragObject = domGreen; 
	}
	if (x > domBlue.xpos && x < domBlue.xpos+domBlue.w && y > domBlue.ypos && y < domBlue.ypos+domBlue.h){ 
		bActive = true; dragObject = domBlue; 
	}
	if (rActive==true || gActive==true || bActive==true){
		if (x>=dragObject.xpos && x<=dragObject.xpos+dragObject.w) {
			dragObject.dragOffsetX = x-dragObject.xpos
		}
		return false
	} else {
		return true
	}
}


function mouseMove(e) {

	if ((ns4) || (document.all)){
		var x = (ns4)? e.pageX : event.x+document.body.scrollLeft;
		var y = (ns4)? e.pageY : event.y+document.body.scrollTop;
	}

	//FH added this.
	if ((document.getElementByID) && (!document.all)) {
		var x = moz_get_coords('xco');
		var y = moz_get_coords('yco');
		alert(x);
		alert(y);
	}

	if (rActive) {
		rMoveTo = x-dragObject.dragOffsetX;
		if (rMoveTo > sliderMax) rMoveTo = sliderMax;
		if (rMoveTo < sliderMin) rMoveTo = sliderMin;
		domRed.xpos = rMoveTo;
		domRed.left = domRed.xpos;
		rValue = (domRed.xpos+4)-sliderMin;
		calcValue(rMoveTo-sliderMin, 'red');
	}
	if (gActive) {
		gMoveTo = x-dragObject.dragOffsetX;
		if (gMoveTo > sliderMax) gMoveTo = sliderMax;
		if (gMoveTo < sliderMin) gMoveTo = sliderMin;
		domGreen.xpos = gMoveTo;
		domGreen.left = domGreen.xpos;
		gValue = (domGreen.xpos+4)-sliderMin;
		calcValue(gMoveTo-sliderMin, 'green');
	}
	if (bActive) {
		bMoveTo = x-dragObject.dragOffsetX;
		if (bMoveTo > sliderMax) bMoveTo = sliderMax;
		if (bMoveTo < sliderMin) bMoveTo = sliderMin;
		domBlue.xpos = bMoveTo;
		domBlue.left = domBlue.xpos;
		bValue = (domBlue.xpos+4)-sliderMin;
		calcValue(bMoveTo-sliderMin, 'blue');
	}
	return true
}


function mouseUp(e) {

// var x = (ns4)? e.pageX : event.x+document.body.scrollLeft
// var y = (ns4)? e.pageY : event.y+document.body.scrollTop

	if ((ns4) || (document.all)){
		var x = (ns4)? e.pageX : event.x+document.body.scrollLeft;
		var y = (ns4)? e.pageY : event.y+document.body.scrollTop;
	}

	if ((document.getElementByID) && (!document.all)) {
		var x = event.pageX;
		var y = event.pageY;
	}

	rActive = false;
	gActive = false;
	bActive = false;
	return true
}

function calcValue(base, color) {
	base -= 1;
	if (base < 16) {
		first = 0; 
	} else { 
		first = parseInt(base/16); 
	}
	if (base < 0 ) { 
		second = 0;
		base = 0;
	} else { 
		second = parseInt(base%16); 
	}
	c1=hexArray[first];
	c2=hexArray[second];
	if (color == 'red') { 
		r1 = c1; r2 = c2; Rgb=base; 
	} else if (color == 'green') { 
		g1 = c1; g2 = c2; rGb=base; 
	} else { 
		b1 = c1; b2 = c2; rgB=base; 
	}
	domValue.value = eval('"'+r1+r2+g1+g2+b1+b2+'"');
	domredValue.value = eval('"'+Rgb+'"');
	domgreenValue.value = eval('"'+rGb+'"');
	domblueValue.value = eval('"'+rgB+'"');
	if (ns4) { 
		domDisplay.bgColor = eval('"#'+r1+r2+g1+g2+b1+b2+'"'); 
	} else { 
		domDisplay.style.backgroundColor = eval('"#'+r1+r2+g1+g2+b1+b2+'"'); 
	}
	return true;
}
function manualSet(value,color) {

	if (value < 0) value=0;
	if (value > 255) value=255;
	++value;
	calcValue(value,color);
	if (color == 'red'){ 
		domRed.xpos = value+sliderMin-4; domRed.left = domRed.xpos; 
	} else if (color == 'green'){ 
		domGreen.xpos = value+sliderMin-4; domGreen.left = domGreen.xpos; 
	} else { domBlue.xpos = value+sliderMin-4; domBlue.left = domBlue.xpos; 
	}
}


function convertHex(hexString) {
	if(hexString == null) hexString = domValue.value;
	inputHexArray = new Array(6);
	for(i=0;i<=5;++i) {
		inputHexArray[i] = hexString.charAt(i);
	}
	for(i=0;i<=5;++i) {
		tempHexVal = inputHexArray[i];
		for(j=0;j<=15;++j) {
			if(tempHexVal == hexArray[j]) tempHexVal = j;
		}
		inputHexArray[i] = tempHexVal;
	}
	Rgb = (inputHexArray[0]*16)+inputHexArray[1]+1;
	calcValue(Rgb,'red');
	manualSet(Rgb,'red');
	rGb = (inputHexArray[2]*16)+inputHexArray[3]+1;
	calcValue(rGb,'green');
	manualSet(rGb,'green');
	rgB = (inputHexArray[4]*16)+inputHexArray[5]+1;
	calcValue(rgB,'blue');
	manualSet(rgB,'blue');
}

// FH added this.
function moz_get_coords(what)
{
    if (window.Event)
      {
        if (document.captureEvents)
            {
            document.captureEvents(Event.MOUSEMOVE);
            }
       else {
            window.captureEvents(Event.MOUSEMOVE);
            }
      }
var coordinate = document.onmousemove = get_co_ordinates(what);
return coordinate;
}

function get_co_ordinates(e)
{
     var mx = (window.Event) ? e.pageX : event.clientX;
     var my = (window.Event) ? e.pageY : event.clientY;
     // alert('x is : '+mx+' y is :'+my);
     if (what == 'xco')
        {return mx;}
     if (what == 'yco')
        {return my;}
}

// End -->
</script>
<?php
	print "\n<script type='text/javascript'>";
	print "\n<!--";
	print "\nfunction ReturnValue() {";
	print "\n	var choix=document.forms[\"frmValue\"].elements[\"valueDisp\"].value;";
	print "\n	window.opener.document.forms[\"".$_GET['FORMULAIRE']."\"].elements[\"".$_GET['FIELD']."\"].value=choix;";

	print "\n	if (ns4) { ";	
	if ($target_text) {
		print "\n		window.opener.document.forms[\"".$_GET['FORMULAIRE']."\"].elements[\"".$_GET['FIELD']."\"].color = eval('\"#'+choix+'\"'); ";
		print "\n	} else { ";
		print "\n		window.opener.document.forms[\"".$_GET['FORMULAIRE']."\"].elements[\"".$_GET['FIELD']."\"].style.color = eval('\"#'+choix+'\"'); ";
	} else {
		print "\n		window.opener.document.forms[\"".$_GET['FORMULAIRE']."\"].elements[\"".$_GET['FIELD']."\"].bgColor = eval('\"#'+choix+'\"'); ";
		print "\n	} else { ";
		print "\n		window.opener.document.forms[\"".$_GET['FORMULAIRE']."\"].elements[\"".$_GET['FIELD']."\"].style.backgroundColor = eval('\"#'+choix+'\"'); ";
	}
	print "\n	}";
	print "\n}";
	print "\n// End -->\n</script>";
?>
</head>

<body text="#000000" link="#0000FF" vlink="#800080" alink="#FF0000" onload="init();convertHex('<?php print $couleurdefaut; ?>')">

<div class="red" id="red"></div>
<div class="green" id="green"></div>
<div class="blue" id="blue"></div>

<div class="redSlider" id="redSlider" name="redSlider"></div>
<div class="greenSlider" id="greenSlider" name="greenSlider"></div>
<div class="blueSlider" id="blueSlider" name="blueSlider"></div>
<div class="colorTable" id="colorTable" name="colorTable">
<table border='0' cellpadding='0' cellspacing='1'>
<tr><td colspan='18' align='center' class="subtext" id="subtext">Standard 216 Color Palette</td>
</tr>
<tr><td>
<script type='text/javascript'>
<!--
document.write('<table border="0" cellpadding="2" cellspacing="0">\n');
clr = new Array('00','33','66','99','CC','FF');
for(k=0;k<6;++k){
for(j=0;j<6;){
document.write('<tr>\n');
for(m=0;m<3;++m){
for(i=0;i<6;++i){
document.write('<td bgcolor=#'+clr[k]+clr[j+m]+clr[i]+'>');
document.write('<a href="javascript:void(null)" ');
document.write('onClick="convertHex(\''+clr[k]+clr[j+m]+clr[i]+'\')\;">');
document.write('<img src="blank.gif" width="11" height="11" border="0" alt="" /></a></td>\n');
}
}
j+=3;
document.write('</tr>\n');
}
}
document.write('</table>\n');
//-->
</script>
</td></tr>
</table>
</div>
<div class="display" id="display"><img src="blank.gif" width='50' height='80' border='1' alt='' /></div>
<div class="titleBar" id="titleBar">
<table border='0' cellpadding='2' cellspacing='0' width='320'>
<tr>
<td class="title" id="title"><?php if ($target_text) print "Choisir la couleur du texte"; else print "Choisir une couleur pour le fond"; ?></td>
</tr>
</table>
</div>
<div class="hexValue" id="hexValue">
  <form name="frmValue" id="frmValue" action="slider.html" method="post">
<table border='0' cellpadding='2' cellspacing='0' width='320' bgcolor='#EEEEEE'>
<tr>
<td align='center'>
<table border='0' cellpadding='2' cellspacing='0'>
<tr>
<td class="subtext">Rouge (R)</td>
<td class="subtext">Vert (G)</td>
<td class="subtext">Bleu (B)</td>
</tr>
<tr>
<td><input type='text' size='3' maxlength='3' name="RgbDisp" id="RgbDisp" value="0" onblur="manualSet(this.value,'red');" /></td>
<td><input type='text' size='3' maxlength='3' name="rGbDisp" id="rGbDisp" value="0" onblur="manualSet(this.value,'green');" /></td>
<td><input type='text' size='3' maxlength='3' name="rgBDisp" id="rgBDisp" value="0" onblur="manualSet(this.value,'blue');" /></td>
</tr>
</table>
</td>
<td align='center'>
<table border='0' cellpadding='2' cellspacing='0'>
<tr>
<td class="subtext">Hexdecimal</td>
</tr>
<tr>
<td><input type='text' size='7' maxlength='7' name="valueDisp" id="valueDisp" value="000000" onblur="convertHex();" /></td>
</tr>
</table>
</td>
</tr>
<tr><td><div align="center"><input name="ok" type="button" value="OK" style='width:75px' onClick="ReturnValue();self.close();" class="subtext">&nbsp;
      <input name="cancel" type="button" id="cancel" value="Annuler" style='width:75px'  onClick="self.close();" class="subtext">
</div></td><td><div align="right">
  <input name="cancel2" type="button" id="cancel2" value="Rétablir" style='width:75px'  onClick="convertHex('<?php print $couleurdefaut; ?>');" class="subtext">
</div></td></tr>
</table>
  </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><?php print_r($_GET); ?>
</body>
</html>


