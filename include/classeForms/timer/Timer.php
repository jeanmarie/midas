
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
<!--
.styling{
	font: bold 15px MS Sans Serif;
	padding: 3px;
	text-align: center;
}
body {
	background-color: #CCCCCC;
}
-->
</style>
</head>

<body>
<p>A
  <span id="digitalclock" class="styling"></span>B

  <script>
<!--

/*****************************************
* LCD Clock script- by Javascriptkit.com
* Featured on/available at http://www.dynamicdrive.com/
* This notice must stay intact for use
*****************************************/
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_findObj(n, d) { //v4.01 
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) { 
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);} 
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n]; 
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); 
  if(!x && d.getElementById) x=d.getElementById(n); return x; 
} 
-->
</script>

<script>
<!--
var alternate=0
function TOTO_show(){

	var clockobjhidden=MM_findObj("TOTO");
	var clockobjview=MM_findObj("TOTO_VIEW");

	var Digital=new Date();

	var annee=Digital.getYear();
	var mois=Digital.getMonth();
	var jour=Digital.getDay();

	var hours=Digital.getHours();
	var minutes=Digital.getMinutes();
	var secondes=Digital.getSeconds();

	// ajout du "0" devant les mois < 10
	if (mois.toString().length==1) mois="0"+mois;
	// ajout du "0" devant les jours < 10
	if (jour<=9)	jour="0"+jour;

	// ajout du "0" devant les heures < 10
	if (hours.toString().length==1) hours="0"+hours;
	// ajout du "0" devant les minutes < 10
	if (minutes<=9)	minutes="0"+minutes;
	// ajout du "0" devant les secondes < 10
	if (secondes<=9) secondes="0"+secondes;

	if (alternate==0)
		car_comma = ':';
	else
		car_comma = ' ';
	clockobjview.value   = hours+car_comma+minutes+car_comma+secondes;
	clockobjhidden.value = annee+'/'+mois+'/'+jour+' '+hours+':'+minutes+':'+secondes;
	alternate=(alternate==0)? 1 : 0
	setTimeout("TOTO_show()",1000);
}


//-->
  </script>
</p>
<?php
	print_r($_POST);
?>
<form name="form1" method="POST" action="">
  <p><span class="styling">TIMER AUTOMATIQUE</span>  
    <input id='TOTO_VIEW' type="text" value="*" readonly="true">
    <input name='TOTO' type="hidden" value="*">
    
    <img src="sablier_a.gif" width="16" height="16">    </p>
  <p>
    <input name="textfield" type="text" value="sqdqsd">
    <input name="hiddenField" type="hidden" value="koko">
    <br>
    <input type="submit" name="Submit" value="Submit">
    </p>
</form>
<script>
	TOTO_show();
</script>
</body>
</html>
