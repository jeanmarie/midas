<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>AJAX exemple de remplissage d'une liste longue</title>
<script type="text/javascript" src="../Communs.js"></script>
<script type='text/javascript'>





function gophp(quelle_select,param){
	var objgif = MM_findObj('gifloader');
	objgif.style.visibility="visible";
	var XmlDoc = HttpRequest();
	// On défini ce qu'on va faire quand on aura la réponse
	XmlDoc.onreadystatechange = function() {
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
			reponse = DOM_clean(XmlDoc.responseXML.documentElement);
			
			//------------------------------------------------------------------
			
			var valeur = reponse.getElementsByTagName("option")[1].firstChild.nodeValue;
			MM_findObj('textfield2').value=valeur;
			
			var ol = MM_findObj(quelle_select)
			x=reponse.getElementsByTagName('option');
			ol.length = x.length; 
			cpt_ok    = 0;
			for (i=0;i<x.length;i++) {
				if (x[i].childNodes[0]) {
					// recuperation de l'attribut qui contient "value" de l'option
					ol.options[cpt_ok].value = x[i].attributes.getNamedItem("value").nodeValue;
					// recuperation de la valeur qui contient "text" de l'option
					ol.options[cpt_ok].text  = x[i].childNodes[0].nodeValue;
					ol.options[cpt_ok].selected  = false;
					cpt_ok++;
				}
			}			
			ol.length = cpt_ok; 
			objgif.style.visibility="hidden";		
			//------------------------------------------------------------------
		}
	}
	XmlDoc.open("POST","ajax_xml_options.php",true);
	XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;"); 
	XmlDoc.send('PARAM='+param+'&CHAMP1='+escape(MM_findObj('textfield').value) );
				
}

function classeTest() {
}

classeTest.prototype.gophp_debut_fin = function(quelle_select,debut,fin){
	var objgif = MM_findObj('gifloader');
	objgif.style.visibility="visible";
	var XmlDoc = HttpRequest();
	// On défini ce qu'on va faire quand on aura la réponse
	XmlDoc.onreadystatechange = function() {
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(XmlDoc.readyState == 4 && XmlDoc.status == 200){
			reponse = DOM_clean(XmlDoc.responseXML.documentElement);
			
			//------------------------------------------------------------------
			
			var valeur = reponse.getElementsByTagName("option")[1].firstChild.nodeValue;
			MM_findObj('textfield2').value=valeur;
			
			var ol = MM_findObj(quelle_select)
			x=reponse.getElementsByTagName('option');
			ol.length = x.length; 
			cpt_ok    = 0;
			for (i=0;i<x.length;i++) {
				if (x[i].childNodes[0]) {
					// recuperation de l'attribut qui contient "value" de l'option
					ol.options[cpt_ok].value = x[i].attributes.getNamedItem("value").nodeValue;
					// recuperation de la valeur qui contient "text" de l'option
					ol.options[cpt_ok].text  = x[i].childNodes[0].nodeValue;
					ol.options[cpt_ok].selected  = false;
					cpt_ok++;
				}
			}			
			ol.length = cpt_ok; 
			objgif.style.visibility="hidden";		
			//------------------------------------------------------------------
		}
	}
	XmlDoc.open("POST","ajax_xml_options2.php",true);
	XmlDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded;"); 
	XmlDoc.send('DEBUT='+debut+'&FIN='+fin );
				
}



		</script>
	    <style type="text/css">
<!--
.Style1 {
	font-family: "Courier New", Courier, monospace;
	font-size: xx-small;
}
-->
        </style>
</head>
	<body>
	    <form name="form1" method="post" action="">
	      <label>
	      <input type="text" name="textfield">
          <img src="ajax-loader_16.gif" name="gifloader" width="16" height="16" id="gifloader" style="visibility:hidden"><br>
          <input name="textfield2" type="text" size="100">
          <br>
          <select name="select" size="5" style="width:200px" >
            <option value="Un">1</option>
          </select>
          <select name="select2" size="5" style="width:200px" >
          </select>
          <select name="select3" size="5" style="width:200px" >
          </select>
          <select name="select4" size="5" style="width:200px" >
          </select>
          <select name="select5" size="5" style="width:200px" >
          </select>
<br>
          <input type='button' value='appel au fichier XML (donn&eacute;es statiques)' onclick='gophp("select",0)' />
	      </label>
            <input name="button" type='button' onclick='gophp("select",1)' value='appel au fichier XML (donn&eacute;essdynamiques)' />
	        <input type="submit" name="Submit" value="Envoyer">
	    </form>
		<script>
			gophp("select",1);
			toto = new classeTest(); 
			toto.gophp_debut_fin("select2",1,100);
			toto.gophp_debut_fin("select3",101,199);
			toto.gophp_debut_fin("select4",200,299);
			toto.gophp_debut_fin("select5",300,399);
		</script>
        <p><a href="xml_static_options.php">lien vers XML </a></p>
        <p><a href=".">lien vers repertoire </a></p>
        <p>pour remplir la liste le fichier XML doit &ecirc;tre au format </p>
        <p class="Style1">&lt;root&gt;</p>
        <blockquote>
          <p class="Style1">&lt;option value=&quot;1&quot;&gt;Un&lt;/option&gt;</p>
          <p class="Style1">...</p>
        </blockquote>
        <p class="Style1">&lt;/root&gt; </p>
        <p class="Style1">&nbsp;</p>
<?php
	if (isset($_POST['textfield2'])) {
		print '<hr>';
		print '<pre>';
		print_r($_POST);
		print '</pre>';
		
	}
?>
	</body>
</html>