<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}



function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function MM_setTextOfTextfield(objName,x,newText) { //v3.0
  var obj = MM_findObj(objName); if (obj) obj.value = newText;
}
//-->
</script>
<style type="text/css">
<!--
body {
	background-color: #FFEBE1;
}
-->
</style></head>

<body>
<script src="cochegraphic.js"></script>
<p>&nbsp;</p>
<form name="form1" method="post" action="">
  <input name="textfield" type="text" value="defaut">
  <p><input name="KOKO" type="hidden" value="0">
 <a onClick="obj1.ogc_click()">
	<script>
		var obj1 = new objGraphicCoche('KOKO');
		obj1.ogc_bitmap('','coche_design_on.gif','coche_design_off.gif','coche_design_disabled_on.gif','coche_design_disabled_off.gif');
		obj1.ogc_show();
	</script>
	</a>
   Coche 1</p>

   <p><input name="KiKi" type="hidden"  value="1">
  <a onClick="obj2.ogc_click()">
	<script>
		var obj2 = new objGraphicCoche('KiKi',false,'cocher ICI pour activer Kiki');	
		obj2.ogc_bitmap('','coche_rouge_on.gif');
		obj2.ogc_show();
	</script>
  </a> Coche 2
</p>

   <p><input name="ME" type="hidden" value="1">
  <a onClick="obj3.ogc_click()">
	<script>
		var obj3 = new objGraphicCoche('ME',true);	
		obj3.ogc_show();
	</script>
  </a> Coche 3
</p>
  <p>
    <input type="submit" name="Submit" value="Submit">
    <input type="Reset" name="Reset" value="Reset" onClick="obj1.ogc_reset();obj2.ogc_reset();obj3.ogc_reset()">
	
    <input name="button1" type="button" onClick="obj1.ogc_disable();" value="Disable 1">
    <input name="button2" type="button" onClick="obj1.ogc_enable();" value="Enable 1">
	
    <input name="button1" type="button" onClick="obj2.ogc_disable();" value="Disable 2">
    <input name="button2" type="button" onClick="obj2.ogc_enable();" value="Enable 2">
	
    <input name="button1" type="button" onClick="obj3.ogc_disable();" value="Disable 3">
    <input name="button2" type="button" onClick="obj3.ogc_enable();" value="Enable 3">

</p>
</form>
<?php
	print "<PRE>";
	print_r($_POST);
	print "</PRE>";
?>
<p>&nbsp;</p>
</body>
</html>
