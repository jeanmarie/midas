<html>
<head>
<title>SAMPLE 30 - Appel a du code javascript externe</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<p>
<?php
	include('_data_top_menu.php');

?>
</p>
<p>&nbsp; </p>
<p>
  <script language="JavaScript" type="text/JavaScript">
<!--

function addition() {
	KW_calcForm('AJOUT_RESULTAT',100,-1,'#AJOUT_1','+','#AJOUT_2','+','#AJOUT_3');
}

function soustraction() {
	KW_calcForm('SOUST_RESULTAT',100,-1,'#SOUST_1','-','#SOUST_2');
}


function controledate(codeerr) {
	if (codeerr=="1") alert('je sort du champ date');
	if (codeerr=="2") alert('je sort du champ timestamp');

}

//-->
</script>
</p>
<blockquote>
  <p><span class="titre1"><span class="titre1 style1"><a href="index.php#ANNEXES"><img src="new4-167.gif" width="16" height="16" border="0"></a> <a href="sample29_timer.php"><img src="fleche_.gif" width="16" height="16" border="0"></a><a href="sample31_colorpicker.php"><img src="fleche.gif" width="16" height="16" border="0"></a> </span>EXECUTION DE CODE EXTERNE : POUR REALISER ICI DES CALCULS</span>
    <?php		

	include('classeForms.php');		

	$f = New Forms;
	
    $f->frm_Init(false,"200px");
	#$f->frm_Protection();

	$f->frm_InitConfirm("Vous allez enregistrer ces résultats ?");
	$f->frm_InitConfirmCancel();

	

    $f->frm_ObjetChampTexte("AJOUT_1",    array( "label" => "Ajouter :",
	                                           "attrib" => "N",
											   "script" => "addition()"
											   )
							);


    $f->frm_ObjetChampTexte("AJOUT_2",    array( "label" => "a :",
	                                           "attrib" => "N",
											   "script" => "addition()"
											   )
							);
    $f->frm_ObjetChampTexte("AJOUT_3",    array( "label" => "et a :",
	                                           "attrib" => "N",
											   "script" => "addition()"
											   )
							);
    $f->frm_ObjetChampTexte("AJOUT_RESULTAT",    array( "label" => "donne :",
	                                           "attrib" => "N-",
											   "mask" => "#")
							);
	$f->frm_SautLignes(2);

    $f->frm_ObjetChampTexte("SOUST_1",    array( "label" => "Cette valeur :",
	                                           "attrib" => "N",
											   "script" => "soustraction()",
											   "mask" => "#")
							);


    $f->frm_ObjetChampTexte("SOUST_2",    array( "label" => "moins :",
	                                           "attrib" => "N",
											   "script" => "soustraction()",
											   "mask" => "#")
							);

    $f->frm_ObjetChampTexte("SOUST_RESULTAT",    array( "label" => "donne :",
	                                           "attrib" => "N+",
											   "mask" => "#")
							);


	$f->frm_SautLignes(2);
							
    $f->frm_ObjetChampTexte("DATE_1",        array( "label" => "Date manuelle ou avec calendrier (attrib=DP)",
	                                         "attrib" => "DP",
											 "default" => $def_DATE_1,
											 "script" => "controledate(1)",
											 "help" => "Saisir une date ou la sélectionner dans au calendrier")
											 );

    $f->frm_ObjetChampTexte("DATE_2",        array( "label" => "Date manuelle ou avec calendrier (attrib=TP)",
	                                         "attrib" => "TP",
											 "default" => $def_DATE_1,
											 "script" => "controledate(2)",
											 "help" => "Saisir une date ou la sélectionner dans au calendrier")
											 );
							
							
	$f->frm_Ouvrir();
?>
  </p>
  <hr>
  <p>&lt;script language=&quot;JavaScript&quot; type=&quot;text/JavaScript&quot;&gt;<br>
&lt;!--</p>
  <blockquote>
    <p>function addition() {<br>
      KW_calcForm('AJOUT_RESULTAT',100,-1,'#AJOUT_1','+','#AJOUT_2','+','#AJOUT_3');<br>
      }</p>
    <p>function soustraction() {<br>
      KW_calcForm('SOUST_RESULTAT',100,-1,'#SOUST_1','-','#SOUST_2');<br>
      }</p>
    <p>function controledate(codeerr) {<br>
if (codeerr==&quot;1&quot;) alert('je sort du champ date');<br>
if (codeerr==&quot;2&quot;) alert('je sort du champ timestamp');<br>
}</p>
  </blockquote>
  <p>//--&gt;<br>
&lt;/script&gt;</p>
</blockquote>
</body>
</html>
