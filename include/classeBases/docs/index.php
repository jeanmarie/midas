<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CLASSEBASES.PHP : La gestion simplifiée des bases de données en PHP</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
h1 {
	font-size: 18px;
	color: #990000;
}
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #710000;
}
h2 {
	font-size: 16px;
	font-weight: bold;
	color: #CC0000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.exemples {
	font-family: "Courier New", Courier, mono;
	font-size: 11px;
	color: #000000;
}
h3 {
	color: #990000;
	font-size: 14px;
}
.sommaire {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #999999;
}
.style11 {color: #0033CC}
.style12 {color: #009966}
.style13 {color: #CC0000}
.style14 {color: #993300}
.Style15 {
	color: #FF0000;
	font-weight: bold;
}
.exemples_rouge {
	font-weight: bold;
	color: #FF0000;
}
-->
</style>
</head>

<body>
<?php
	include('classeMenu.php');
    $mn = New PopMenu();	
	$mn->ShowPopMenu('/_datamenu.js');
?>	
<br>
<br>
<div align="center"></div>
<h1 align="center">DOCUMENTATION SUR LE GESTIONNAIRE DE BASES DE DONNEES : ClasseBases.php</h1>
<p align="center" class="exemples">AUTEUR : FRANCK OBERLECHNER, Ing&eacute;nieur Syst&egrave;me et R&eacute;seaux </p>
<p align="center" class="exemples">version 1.01 du 27/06/2006 </p>
<hr>
<p align="center" class="exemples">&nbsp;</p>
<blockquote>
  <h2><a name="SOMMAIRE"></a> SOMMAIRE</h2>
  <blockquote>
    <p class="sommaire">1. <a href="#PREAMBULE">Pr&eacute;ambule</a></p>
    <p class="sommaire">2. <a href="#INSTALLATION">Installation de la classe</a></p>
    <p class="sommaire">3. <a href="#LISTEORDRES">Les ordres disponibles</a></p>
    <blockquote>
      <p class="sommaire">3.1 <a href="#ORDRES_BASE">Les ordres de base </a></p>
      <p class="sommaire">3.2 <a href="#ORDRES_AVANCES">Les ordres avan&ccedil;&eacute;s </a></p>
    </blockquote>
    <p class="sommaire">A. <a href="#ANNEXES">Les annexes </a></p>
    <p class="sommaire">&nbsp;</p>
  </blockquote>
  <h2>&nbsp;</h2>
</blockquote>
<hr>
<blockquote>
  <h2><a name="PREAMBULE"></a>1) PREAMBULE</h2>
  <blockquote>
    <p>La classe <strong>ClasseBases.php</strong> permet de g&eacute;rer les bases de donn&eacute;es en faisant abstraction de leur type. Dans l'exemple ci-dessous on illustre les 3 fa&ccedil;ons diff&eacute;rentes de g&eacute;rer une base ODBC (Access) , mySQL &lt;= 4.0 ou mySQL &gt;=4.1</p>
    <h3>ODBC</h3>
    <blockquote>
      <p class="exemples"> <span class="style11">$link</span> = <strong>odbc_connect</strong>($nomDSN,$bdd_user,$bdd_pwd);<br>
        <span class="style12">$resultat_requete</span> = <strong>odbc_exe</strong>c(<span class="style11">$link</span>,$bdd_requete);<br>
  while ( <strong>odbc_fetch_row</strong>(<span class="style12">$resultat_requete</span>) ) {</p>
      <blockquote>
        <p class="exemples">print  <strong>odbc_result</strong>($<span class="style12">resultat_requete</span>, $nomchamp) </p>
      </blockquote>
      <p class="exemples"> }<br>
        <strong>odbc_clos</strong>e(<span class="style11">$link</span>)    </p>
    </blockquote>
    <h3>mySQL &lt;=4.0</h3>
    <blockquote>
      <p class="exemples"> <span class="style11">$link</span> =  <strong>mysql_connect</strong>($bdd_host,$bdd_user,$bdd_pwd);<br>
        <strong>mysql_select_db</strong>($nombase);<br>
        <span class="style12">$resultat_requete</span> = <strong>mysql_query</strong>($bdd_requete); <br>
        while  


 (<span class="style13">$row</span> = 


        <strong>mysql_fetch_array</strong> ( <span class="style12">$resultat_requete</span> , MYSQL_ASSOC

)

 ) {</p>
      <blockquote>
        <p class="exemples">print <strong>$row[</strong>$nomchamp];</p>
      </blockquote>
      <p class="exemples"> }<br>
        <strong>mysql_close</strong>(<span class="style11">$link</span>);</p>
    </blockquote>
    <h3>mySQL &gt;=4.1 ( MYSQLI ) </h3>
    <blockquote>
      <p class="exemples"> <span class="style11">$link</span> = new <strong>mysqli</strong>($bdd_host,$bdd_user,$bdd_pwd,$nombase);<br>
      <span class="style12">$resultat_requete</span> = <span class="style11">$link</span> -&gt; <strong>query</strong>($bdd_requete);<br>
      while ( <span class="style13">$row</span> = <span class="style12">$resultat_requete</span> -&gt; <strong>fetch_array</strong>(MYSQLI_BOTH) ) {</p>
      <blockquote>
        <p class="exemples">print <strong>$row[</strong>$nomchamp];</p>
      </blockquote>
      <p class="exemples"> }<br>
          <strong>mysqli_close</strong>(<span class="style11">$link</span>)</p>
    </blockquote>
    <h3>LE MEME PROGRAMME AVEC classeBases :</h3>
    <blockquote>
      <p> <span class="exemples">$base = New Bdd;<br>
$base-&gt;<strong>bdd_connecter_base</strong>($nombase);<br>
$base-&gt;<strong>bdd_execsql</strong>($bdd_requete);<br>
$ligne = $base-&gt;<strong>bdd_lire_ligne</strong>();<br>
while ($ligne) {</span></p>
      <blockquote>
        <p><span class="exemples">print         $base-&gt;<strong>bdd_lire_champ</strong>($nomchamp;<br>
        $ligne = $base-&gt;<strong>bdd_lire_ligne</strong>();</span></p>
      </blockquote>
      <p><span class="exemples">        } <br>
        $base-&gt;<strong>bdd_fermer</strong>();</span><br>
      </p>
    </blockquote>
    <p>Ce n'est pas plus court mais c'est compl&egrave;tement ind&eacute;pendant de la base de donn&eacute;es </p>
  </blockquote>
  <hr>
  <h2><a name="INSTALLATION"></a>2) INSTALLATION DE LA CLASSE<a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <blockquote>
    <p>D&eacute;finir un r&eacute;pertoire &quot;include_path&quot; en modifiant le fichier de configuration de PHP %SYSTEMROOT%\PHP.INI sous IIS </p>
    <blockquote>
      <p>        <span class="exemples">;;;;;;;;;;;;;;;;;;;;;;;;;<br>
        ; Paths and Directories ;<br>
        ;;;;;;;;;;;;;;;;;;;;;;;;;
        </span>      </p>
      <p class="exemples">; UNIX: &quot;/path1:/path2&quot; <br>
        ;include_path = &quot;.:/php/includes&quot;<br>
        ;<br>
        ; Windows: &quot;\path1;\path2&quot;<br>
        <strong>include_path</strong> = &quot;d:/wwwroot/rubappli/communs&quot;</p>
    </blockquote>
    <p>D&eacute;compresser dans le r&eacute;pertoire &quot;<span class="exemples">include_path</span>&quot; du serveur PHP le fichier <strong>classeForms.php</strong> et le r&eacute;pertoire <strong>classeForms</strong> (ce r&eacute;pertoire contient toutes les ressources n&eacute;cessaires &agrave; la classe) <br>
      On obtient l'arborescence :    </p>
  </blockquote>
  <ol>
    <blockquote>
      <p class="exemples">.../R&eacute;pertoire_Include</p>
      <blockquote>
        <p class="exemples">classeBases.php<br>
        classeBases&lt;dir&gt;</p>
      </blockquote>
    </blockquote>
  </ol>
  <blockquote>
    <p>Editer le fichier <strong>_classePath.php</strong> et modifier la ligne DEFINE en terminant par un &quot;/&quot; obligatoirement, la constante INCLUDEPATH doit pointer sur le r&eacute;pertoire ou se situe le fichier <strong>classeForms.php</strong> et <strong>_classePath.php </strong></p>
  </blockquote>
  <ol>
    <blockquote>
      <p class="exemples">// PARAMETRAGE :<br>
      DEFINE('INCLUDEPATH','<strong>/rubappli/communs/</strong>');</p>
      <p class="exemples">&nbsp;</p>
    </blockquote>
  </ol>
  <blockquote>
    <p>Dans le r&eacute;pertoire d'inclusion cr&eacute;er le fichier : <strong>_classeBases_description.php</strong></p>
    <p>Ce fichier d&eacute;crit le ou les bases &agrave; ouvrir, leurs types (<strong>ODBC, MYSQL, MYSQLI</strong>) et leurs param&egrave;tres de connexion (<strong>HOST, USER, PWD</strong>) </p>
    <p>exemple :</p>
    <blockquote>
      <p> <strong>$tablebases[&quot;NOMBASE_MYSQLI&quot;] = array(&quot;MYSQL&quot;,&quot;127.0.0.1&quot;,&quot;root&quot;,&quot;pwd&quot;,[&quot;nombase_mysql&quot;] );</strong><br>
&quot;nombase_mysql&quot; est optionnel, a defaut c'est &quot;NOMBASE_MYSQLI&quot; qui est utilis&eacute;<br>
        <br>
         <strong>$tablebases[&quot;NOMBASE_MYSQL&quot;] = array(&quot;MYSQL&quot;,&quot;127.0.0.1&quot;,&quot;root&quot;,&quot;&quot;);</strong><br>
         <strong>$tablebases[&quot;NOMBASE_ODBC&quot;] = array(&quot;ODBC&quot;);</strong><br>
      </p>
    </blockquote>
    <p>C'est tout ! la classe est maintenant exploitable directement </p>
    <h2>&nbsp;    </h2>
  </blockquote>
</blockquote>
<hr>
<h2><a name="LISTEORDRES" id="LISTEORDRES"></a>3) LA LISTE DES ORDRES <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a><br>
  <br>
</h2>
<h3><a name="ORDRES_BASE"></a>3.1 LES ORDRES DE BASE </h3>
<ul>
  <li><strong>bdd_connecter_base</strong>()  : c'est utiliser ou non le fichier de description des bases. Avec bdd_connecter_base, il suffit de passer comme param&egrave;tre le nom de la base pour que tous les param&egrave;tres de type et de connexion soient r&eacute;cup&eacute;r&eacute;s automatiquement. </li>
  <li><strong>bdd_connecter</strong>() : a besoin de 4 param&egrave;tres <br>
    <br>
    $bdd_typebase : le type de base &quot;<strong>MYSQL</strong>&quot;, &quot;<strong>MYSQLI</strong>&quot; ou &quot;<strong>ODBC</strong>&quot;<br>
    $bdd_host : le nom du serveur ou son adresse IP (inutile pour une connexion ODBC car la liaison pointe sur un DSN)<br>
    $bdd_nombase : le nom de la base de donn&eacute;es<br>
    $bdd_user ,$bdd_pwd : la paire nom d'utilisateur / mot de passe (inutile pour ODBC) <br>
  </li>
  <li><strong>bdd_execsql</strong>($requete_sql) : c'est faire appel &agrave; une requete au standard SQL ( VOIR ANNEXE &quot;MEMENTO REQUETES SQL&quot; ) </li>
  <li><strong>bdd_lire_ligne</strong>() : dans une boucle while, lit enregistrement apr&egrave;s enregistrement correspondant &agrave; la requ&ecirc;te.<br>
  </li>
  <li><strong>bdd_lire_champ</strong>($nomchamp) : lecture de la valeur d'un champ, on passe comme parametre soit un nom soit un indice</li>
  <li><strong>bdd_resultats_vers_tableau</strong>() : retourne le r&eacute;sultat d'une requ&ecirc;te dans un tableau associatif <br>
  </li>
  <li><strong>bdd_fermer</strong>() : fermeture de la base <br>
    <br>
    <br>
  </li>
</ul>
<h3> <span class="exemples"><a name="ORDRES_AVANCES" id="ORDRES_AVANCES"></a></span>3.1 LES ORDRES AVANCES </h3>
<blockquote>
  <p><strong>GESTION DE LA DATE ET L'HEURE </strong></p>
</blockquote>
<ul>
  <li><strong>bdd_lire_date</strong>($nomchamp) : comme la fonction pr&eacute;c&eacute;dante avec mise en forme d'une date &agrave; la fran&ccedil;aise <br>
  ( transforme un champ AAAA-MM-JJ en JJ/MM/AAAA )</li>
  <li><strong>bdd_lire_heure</strong>() : idem mais retourne juste HH:MM </li>
  <li><strong>bdd_lire_dateheure</strong>($nomchamp) : idem date mais au format final : JJ/MM/AAAA HH:MM <br>
  (fonctionne sur un champ de type DATETIME)<br>
  </li>
  <li><strong>bdd_dateheure_courante</strong>() : retourne la date du serveur au format &quot;JJ/MM/AAAA HH:MM&quot; </li>
  <li><strong>bdd_datetime_courant</strong>() : retourne la date du serveur au format fichier DATETIME &quot;AAAA-MM-JJ HH:MM&quot; </li>
  <li><strong>bdd_convertir_timestamptodate</strong>() : transforme un timestamp au format &quot;AAAA-MM-JJ HH:MM&quot;<br>
    <br>
  </li>
  <li><strong>bdd_datetosql</strong>($date_jjmmaaaa) : convertit une date '18/02/1996'  --&gt; '1996-02-18'</li>
  <li><strong>bdd_sqltodate</strong>($date_aaaammjj) : convertit une date '1996-02-18' --&gt; '18/02/1996'</li>
</ul>
<blockquote>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><strong><br>
    <br>
    GESTION DE LA STRUCTURE DE LA BASE </strong></p>
</blockquote>
<ul>
  <li><strong>bdd_listerchamps</strong>($nomtable) : retour un tableau du nom des champs d'une table </li>
  <li><strong>bdd_listertypechamps</strong>($nomtable) : retour d'un tableau associatif &quot;NOMCHAMP&quot; =&gt; &quot;TYPE DE CHAMP&quot; </li>
  <li><strong>bdd_listertables</strong>() : lister les tables de la base ouverte </li>
</ul>
<blockquote>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><strong><br>
    FONCTIONS ASSOCIEES A LA GESTION DES FORMULAIRES </strong></p>
</blockquote>
<ul>
  <li><strong>bdd_creationrequete</strong>($nomtable,$nomchampclef,$action,$tableauvaleur) : G&eacute;n&eacute;ration automatique d'une requete <br>
  en SELECT ($action=&quot;C&quot;), INSERT ($action=&quot;A&quot;), UPDATE ($action=&quot;M&quot;) ou DELETE ($action=&quot;E&quot;) en croisant les variables $_POST de la page et le nom des champs d'une table<br>
  Cette fonction est a utiliser conjointement avec <strong>classeForms</strong> <br>
  </li>
  <li><strong>bdd_tableversliste</strong>($tabparam) : permet d'alimenter le champ LISTE de classeform en retournant un tableau &quot;ID&quot; =&gt; &quot;LIBELLE&quot; <br>
    <blockquote>
      <p> <span class="exemples">// CHARGEMENT DE TOUTES LES NATURES<br>
  $base-&gt;bdd_execsql(&quot;SELECT * FROM Client ORDER BY nom_client,prenom_client&quot;); <br>
  $tablenat = $base-&gt;bdd_tableversliste( array(<span class="style14">&quot;id_client&quot;</span>,<span class="style11">&quot;nom_client&quot;,&quot;prenom_client&quot;</span>) );<br>
      </span><span class="exemples">// LE &quot;LIBELLE&quot; EST LA CONCATENATION DES CHAMPS SUIVANT L'ID </span><br>
      </p>
    </blockquote>
  </li>
  <li><strong>bdd_tableversarray</strong>($nomchampclef,$hash) : retourne sous forme d'un tableau multidimensionnel les r&eacute;sultats d'une requete quelconque<br>
    <br> 
    si appel par <span class="exemples">bdd_tableversarray()</span> alors on obtient un tableau de la forme<br>
    <span class="exemples">$tab = array( 0 =&gt; array( &quot;AGENT_NOM&quot; =&gt; &quot;DURAND&quot; ), 1 =&gt; array( &quot;AGENT_NOM&quot; =&gt; &quot;DUPONT&quot; ) );</span><br>
<br>
 si appel par <span class="exemples">bdd_tableversarray(&quot;NOMCHAMPCLEF&quot;)</span> alors l'indice de chaque &eacute;l&eacute;ment n'est plus un rang mais la valeur de la clef <br>
 <span class="exemples">$tab = array( &quot;10&quot; =&gt; array( &quot;AGENT_NOM&quot; =&gt; &quot;DURAND&quot; ), &quot;12&quot; =&gt; array( &quot;AGENT_NOM&quot; =&gt; &quot;DUPONT&quot; ) ); <br>
 <br>
 </span></li>
  <li><strong>bdd_tableversarrayjs</strong>() : retourne un tableau de type javascript pratique pour alimenter les scripts sous ce langage. La tableau est de la forme
    <blockquote>
      <p><span class="exemples">var <strong>myData1</strong> = [<br>
[&quot;12&quot;,&quot;Action scolaire&quot;],<br>
[&quot;22&quot;,&quot;Action Sociale&quot;],<br>
...<br>
[&quot;24&quot;,&quot;Urbanisme&quot;]<br>
];</span> </p>
    </blockquote>
  </li>
  <li><strong>bdd_table2xml</strong>() : retourne un objet de type XML ou chaque ligne est le champ d'un enregistrement. Les param&egrave;tres optionnels sont : <br>
    1) $libtab
: sera le nom de l'objet XML par d&eacute;faut <span class="exemples"><strong>XmlId0</strong></span> <br>
2) $tableau : la liste des champ a garder de la requete, par d&eacute;faut tous les champs retourn&eacute; par la requete SQL sont pr&eacute;sent.<br>
Le nom de chaque champ est en majuscule.</li>
</ul>
<ul><blockquote><p class="exemples">&lt;!-- Objet XML genere par la fonction bdd_table2xml()--&gt;<br>
&lt;xml id=&quot;<strong>XmlId0</strong>&quot;&gt;<br>
&lt;request&gt;<br>
&lt;record&gt;<br>
&lt;AGENT_ID&gt;90&lt;/AGENT_ID&gt;<br>
&lt;AGENT_NOM&gt;BON&lt;/AGENT_NOM&gt;<br>
&lt;AGENT_PRENOM&gt;Michel&lt;/AGENT_PRENOM&gt;<br>
&lt;AGENT_DATE_CREATION&gt;2003-09-01 00:00:00&lt;/AGENT_DATE_CREATION&gt;<br>
&lt;/record&gt;<br>
      ...<br>
&lt;record&gt;<br>
&lt;AGENT_ID&gt;58&lt;/AGENT_ID&gt;<br>
&lt;AGENT_NOM&gt;DUPONT&lt;/AGENT_NOM&gt;<br>
&lt;AGENT_PRENOM&gt;Jacques&lt;/AGENT_PRENOM&gt;<br>
&lt;AGENT_DATE_CREATION&gt;2003-09-01 00:00:00&lt;/AGENT_DATE_CREATION&gt;<br>
&lt;/record&gt;<br>
&lt;/request&gt;<br>
&lt;/xml&gt;<br>
&lt;!-- Nombre d'elements dans l'objet XML = 129 --&gt;</p>
  </blockquote>
</ul>
<p>&nbsp;</p>
<ul>
  <li><strong>bdd_tableperefils</strong>() permet d'alimenter la fonction <strong>frm_Objet2Listes</strong>() des formulaires <strong>classeForms</strong> en retournant un tableau unique p&egrave;re/fils en retournant un tableau de la forme : 
    <blockquote>
      <p class="exemples"> array( <br>
        &quot;1&quot; =&gt; &quot;Homme&quot;, <br>
        &quot;2&quot; =&gt; &quot;Femme&quot;, <br>
&quot;1.1&quot; =&gt; &quot;Jean&quot;, <br>
&quot;1.2&quot; =&gt; &quot;Paul&quot;, <br>
&quot;2.1&quot; =&gt; &quot;Brigitte&quot;, <br>
&quot;2.2&quot; =&gt; &quot;Paulette&quot;, <br>
&quot;2.3&quot; =&gt; &quot;Cathy&quot; ) </p>
      <p>  TablePereFils(1,2,3,4,5,6,7)</p>
      <p>  Liste des param&egrave;tres :<br>
   1 . Pointeur vers l'objet Base de donn&eacute;es &quot;Bdd&quot;<br>
   2 . Nom de la table PERE<br>
   3 . Nom de l'identifiant dans la table PERE<br>
   4 . Nom du libell&eacute; dans la table PERE<br>
   5 . Nom de l'identifiant dans la table FILS<br>
   6 . Nom du libell&eacute; dans la table FILS<br>
   7 . Pointeur de la tablea FILS vers la table PERE</p>
    </blockquote>
    <p class="exemples">&nbsp; </p>
  </li>
</ul>
<blockquote>
  <p><strong>FONCTIONS ASSOCIEES A LA GESTION DES FORMULAIRES </strong></p>
  <blockquote>
    <p><strong><a name="BDD_AUTO"></a>La collection BDD_AUTO </strong></p>
    <p>les fonctions <strong>bdd_auto_init</strong>(), <strong>bdd_auto_security</strong>(), <strong>bdd_auto_sql</strong>(), <strong>bdd_auto_header</strong>()              sont des fonctions sp&eacute;cialis&eacute;es  pour simplifier l'usage de classeForm.</p>
  </blockquote>
  <ul>
    <li><strong>bdd_auto_init</strong>() n&eacute;cessite 3 param&egrave;tres : <br>
    1 - Le nom de la table mise &agrave; jour par le formulaire<br>
      2 - le nom de la clef primaire<br>
      3 - le nom de la page qui sera appel&eacute;e en cas de validation ou d'annulation de saisie<br>
      <br>
    </li>
    <li><strong>bdd_auto_security</strong>()  [ optionnelle ] permet en ajout ou en modification d'initialiser un champ &agrave; une valeur donn&eacute;e. Elle n&eacute;cessite 2 param&egrave;tres : <br>
    1 - Le nom du champ<br>
      2 - La valeur de ce champ<br>
      On utilisera cette fonction par exemple pour affecter &agrave; une commande le lien vers le client qui la passe, la valeur du code client sera initialis&eacute;e au logon puis v&eacute;hicul&eacute;e de page en page par une variable de session <br>
      <br>
    </li>
    <li><strong>bdd_auto_sql</strong>() n&eacute;cessite 1 seul param&egrave;tre : <br>
      1 - L'initiale de l'action souhait&eacute;e : &quot;A&quot; pour Ajouter, &quot;M&quot; pour Modifier, &quot;C&quot; pour chercher et &quot;E&quot; pour effacer <br>
    </li>
  </ul>
  <ul>
    <li><strong>bdd_auto_sql</strong>() ne n&eacute;cessite pas de param&egrave;tre : <br>
      effectue un branchement &agrave; l'URL d&eacute;finie au d&eacute;but </li>
  </ul>
  <blockquote>
    <p><a href="#A1"><img src="php_script_ico.png" width="32" height="32" border="0"></a></p>
    <p><strong><a name="BDD_PARAM"></a>La collection BDD_PARAM</strong></p>
    <p>les fonctions <strong>bdd_param_init</strong>(),<strong>bdd_param_security</strong>(), <strong>bdd_param_rec</strong>(), <strong>bdd_param_load</strong>()              sont des fonctions sp&eacute;cialis&eacute;es  pour simplifier l'usage de la gestion d'un fichier de param&egrave;tres qui aurait la structure suivante :</p>
    <span class="exemples">nom_table_param</span>
    <table width="313" border="1">
      <tr>
        <td width="52">param_id</td>
        <td width="245">INTEGER (PRIMARY KEY) </td>
      </tr>
      <tr>
        <td>param_clef</td>
        <td>VARCHAR(50) (INDEXE) </td>
      </tr>
      <tr>
        <td>param_valeur</td>
        <td>VARCHAR(255)</td>
      </tr>
      <tr>
        <td bgcolor="#CCCCCC">param_num_client</td>
        <td bgcolor="#CCCCCC">INTEGER (optionnel)</td>
      </tr>
    </table>
    <br>
    pour une table de param&egrave;tres simples
    partag&eacute;e par tous les utilisateurs le champ &quot;param_num_client&quot; est inutile. ( bdd_param_security() aussi )
    <p>&nbsp; </p>
  </blockquote>
  <ul>
    <li><strong>bdd_param_init</strong>() n&eacute;cessite 3 param&egrave;tres : <br>
      1 - Le nom de la table des param&egrave;tres<br>
      2 - le nom du champ clef (param_clef) <br>
    3 - le nom du champ valeur (param_valeur)<br>
      <br>
    </li>
    <li><strong>bdd_param_security</strong>()  [ optionnelle ] permet en ajout ou en modification d'initialiser un champ &agrave; une valeur donn&eacute;e. Elle n&eacute;cessite 2 param&egrave;tres : <br>
      1 - Le nom du champ<br>
      2 - La valeur de ce champ<br>
      On utilisera cette fonction par exemple pour affecter un param&egrave;tre &agrave; chaque client<br>
      <br>
    </li>
    <li><strong>bdd_param_load</strong>() n&eacute;cessite 2 param&egrave;tre (dont 1 optionnel) : <br>
      1 - le nom de l'&eacute;tiquette du param&egrave;tre &agrave; chercher <br>
      2 - [ optionel ] la valeur par d&eacute;faut si inexistant dans la table<br>
    </li>
  </ul>
  <ul>
    <li><strong>bdd_param_rec</strong>() n&eacute;cessite 2 param&egrave;tre (dont 1 optionnel) : <br>
1 - le nom de l'&eacute;tiquette du param&egrave;tre &agrave; chercher <br>
2 - [ optionel ] la valeur par d&eacute;faut si inexistant dans la table</li>
  </ul>
  <blockquote>
    <p>&nbsp;</p>
    <p>Dans n'importe quelle page aillant besoin d'un param&egrave;tre de la table, il est facile de r&eacute;cup&eacute;rer la valeur en 3 lignes : </p>
    <p><span class="exemples">$base-&gt;<strong>bdd_param_init</strong>(&quot;nom_table_param&quot;,&quot;param_clef&quot;,&quot;param_valeur&quot;);<br>
$base-&gt;<strong>bdd_param_security</strong>('param_num_client',<em>$_SESSION['NUM_CLIENT']</em>);</span></p>
    <p class="exemples">$chemin_lu = $base-&gt;<strong>bdd_param_load</strong>(&quot;PARAM1&quot;,&quot;valeur_par_defaut&quot;);</p>
    <p><br>
      <br>
      <a href="#A2"><img src="php_script_ico.png" alt="A2" width="32" height="32" border="0"></a></p>
  </blockquote>
  <p><strong>FONCTIONS DIVERSES</strong></p>
</blockquote>
<ul>
  <li><strong>bdd_formatsql</strong>() : convertit une chaine qui peut s'ins&eacute;rer dans une requete g&eacute;n&eacute;r&eacute;e &quot;&agrave; la main&quot; en &eacute;chappant les guillemets simples et les carat&egrave;res sp&eacute;ciaux \x </li>
</ul>
<hr>
<p>&nbsp;</p>
<h2><a name="ANNEXES" id="ANNEXES"></a>A) ANNEXES </h2>
<p><strong><a name="A1"></a>A-1 UN SOURCE QUI GERE TOUTES LES FONCTIONS SUR LES ENREGISTREMENT COLLABORATEURS:</strong> <a href="#BDD_AUTO"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></p>
<p class="exemples">&lt;?php</p>
<p class="exemples"> session_start();<br>
  <br>
  include('classeBases.php');<br>
  include('./inc_base.php'); <br>
  <br>
  include('classeForms.php');</p>
<p class="exemples"> $base = New Bdd;<br>
  $base-&gt;bdd_connecter_base(BASE);<br>
  $delete = isset($_GET['DELETE']);</p>
<p class="exemples"> $base-&gt;<strong>bdd_auto_init</strong>('inv_compte_collaborateurs','COLLAB_ID','hd_collaborateurs_lister.php');<br>
  $base-&gt;<strong>bdd_auto_security</strong>('COLLAB_CPT_ID',<em>$_SESSION['NUMERO_DU_CLIENT']</em>);<br>
  <br>
</p>
<p class="exemples"> // DEFINITION DU FORMULAIRE ##############################################################################<br>
  $f = New Forms; <br>
  $f-&gt;frm_Init($delete,'150px');<br>
  definition_des_champs();</p>
<p class="exemples"> // ILLUSTRATION DE LA RE-ENTRANCE FORMULAIRE ############################################################# <br>
  $ret = $f-&gt;frm_Aiguiller('COLLAB_ID');<br>
  $valeurpardefaut = false; <br>
  switch ( $ret ) {<br>
  <br>
  // AJOUT 1ER APPEL ############################################################# <br>
  case &quot;A0&quot; :<br>
  $f-&gt;frm_InitConfirm(&quot;Ajouter ce nouveau collaborateur ?&quot;);<br>
  break;<br>
  <br>
  // AJOUT RE-ENTRANT ############################################################# <br>
  case &quot;<span class="Style15">A1</span>&quot; : <br>
  $_POST['COLLAB_PWD'] = (String) mt_rand(10000, 99999);<br>
  $base-&gt;<strong>bdd_auto_sql</strong>( <span class="exemples_rouge">&quot;A&quot;</span> );<br>
  $base-&gt;<strong>bdd_auto_header</strong>();<br>
  <br>
  case &quot;<span class="exemples_rouge">M0</span>&quot; :<br>
  // MODIFICATION 1ER APPEL ############################################################# <br>
  $f-&gt;frm_InitConfirm(&quot;Enregistrer les modifications ?&quot;);<br>
  $f-&gt;frm_InitConfirmCancel(&quot;R&eacute;tablir les donn&eacute;es avant la modification ?&quot;);<br>
  $base-&gt;<strong>bdd_auto_sql</strong>( <span class="exemples_rouge">&quot;C&quot;</span> );<br>
  $f-&gt;frm_ChargerLesChamps($base-&gt;bdd_resultats_vers_tableau()); <br>
  break;</p>
<p class="exemples"> case &quot;<span class="exemples_rouge">M1</span>&quot; :<br>
  // MODIFICATION RE-ENTRANT ############################################################# <br>
  $base-&gt;<strong>bdd_auto_sql</strong>( <span class="exemples_rouge">&quot;M&quot;</span> );<br>
  $base-&gt;<strong>bdd_auto_header</strong>();<br>
</p>
<p class="exemples"> case &quot;<span class="exemples_rouge">L0</span>&quot; :<br>
  // EFFACEMENT 1ER APPEL ############################################################# <br>
  $f-&gt;frm_InitConfirm(&quot;Effacer ce collaborateur  ?&quot;);<br>
  $f-&gt;frm_LibBoutons('Effacer','Quitter','R&eacute;tablir');<br>
  $base-&gt;<strong>bdd_auto_sql</strong>( <span class="exemples_rouge">&quot;C&quot;</span> );<br>
  $f-&gt;frm_ChargerLesChamps($base-&gt;bdd_resultats_vers_tableau()); <br>
  break;</p>
<p class="exemples"> // EFFACEMENT RE-ENTRANT ############################################################# <br>
  case &quot;<span class="exemples_rouge">L1</span>&quot; :<br>
  // ATTENTION ON ZAPE !<br>
  $base-&gt;<strong>bdd_auto_sql</strong>( <span class="exemples_rouge">&quot;E&quot;</span> );<br>
  $base-&gt;<strong>bdd_auto_header</strong>();<br>
  <br>
  default :<br>
  $base-&gt;<strong>bdd_auto_header</strong>();</p>
<p class="exemples"> }<br>
</p>
<p class="exemples">?&gt;</p>
<p class="exemples">&lt;html&gt;<br>
&lt;head&gt;<br>
&lt;title&gt;www.oberlechner.net - EDITER UN UTILISATEUR&lt;/title&gt;<br>
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=ISO-8859-1&quot; /&gt;<br>
&lt;link href=&quot;/css/style.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;<br>
&lt;/head&gt;</p>
<p class="exemples">&lt;body&gt;<br>
&lt;p&gt;<br>
&lt;?php <br>
  include('classeMenu.php');<br>
  $mn = New PopMenu($_SESSION['DEFAULT_SKIN']); <br>
  $mn-&gt;ShowPopMenu('_datamenu.js');<br>
  include('./inc_menu_dynamique.php');<br>
  $idclient = <em>$_SESSION['NUMERO_DU_CLIENT']</em>;<br>
  ?&gt;<br>
&lt;/p&gt;<br>
&lt;br&gt;<br>
&lt;br&gt;<br>
&lt;br&gt;<br>
&lt;blockquote&gt;&lt;img src=&quot;../../popmenu/icones16-16/beos_group.gif&quot; width=&quot;16&quot; height=&quot;16&quot;&gt;<br>
&lt;?php<br>
  $initiale = substr($ret,0,1);<br>
  if ( $initiale=='A' ) {<br>
  $titrefenetre = &quot;&lt;b&gt;SAISISSEZ UN NOUVEAU COLLABORATEUR&lt;/b&gt;&quot;;<br>
  } elseif ( $initiale=='L' ) {<br>
  if ( $statutlu==ADMIN ) {<br>
  $titrefenetre = &quot;&lt;b&gt;EFFACER UN ADMINISTRATEUR EST INTERDIT&lt;/b&gt;&quot;;<br>
  } else {<br>
  $titrefenetre = &quot;&lt;b&gt;EFFACER L'UTILISATEUR CI DESSOUS&lt;/b&gt;&quot;;<br>
  }<br>
  } else {<br>
  $titrefenetre = &quot;&lt;b&gt;MODIFIER LES DONNEES D'UN UTILISATEUR&lt;/b&gt;&quot;;<br>
  }<br>
  print  &quot;&lt;span class=titre1&gt;&quot;.$titrefenetre.&quot;&lt;/span&gt;&lt;p&gt;&quot;;<br>
  $f-&gt;frm_Ouvrir();<br>
  print  &quot;&lt;/p&gt;&quot;;</p>
<p class="exemples">?&gt;<br>
&lt;/blockquote&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;</p>
<p>&nbsp;</p>
<p class="exemples">&lt;?php<br>
  function definition_des_champs() {<br>
  global $f, $tabstatut ;</p>
<p class="exemples"> $f-&gt;frm_ObjetChampTexte(&quot;COLLAB_NOM&quot;,    array( &quot;attrib&quot; =&gt; &quot;R&quot;,<br>
&quot;label&quot; =&gt; &quot;Nom du collaborateur :&quot;,<br>
&quot;width&quot;    =&gt; &quot;300px&quot;,<br>
&quot;help&quot;  =&gt; &quot;Saisissez le nom du collaborateur&quot;<br>
  )<br>
  );</p>
<p class="exemples"> $f-&gt;frm_ObjetChampTexte(&quot;COLLAB_EMAIL&quot;,    array( &quot;attrib&quot; =&gt; &quot;RM&quot;,<br>
&quot;label&quot; =&gt; &quot;Adresse de messagerie :&quot;,<br>
&quot;width&quot;    =&gt; &quot;300px&quot;<br>
  )<br>
  );</p>
<p class="exemples">  $f-&gt;frm_SautLignes(1); <br>
  <br>
  $f-&gt;frm_ObjetCoche(&quot;COLLAB_ACTIF&quot;,      array( &quot;label&quot; =&gt; &quot;Activit&eacute;&quot;, <br>
&quot;title&quot; =&gt; &quot;Le compte est actif&quot;,<br>
&quot;help&quot; =&gt; &quot;D&eacute;cocher pour rendre le collaborateur inactif&quot;,<br>
&quot;default&quot; =&gt; &quot;1&quot;<br>
  )<br>
  );</p>
<p class="exemples">}<br>?&gt;</p>
<hr>
<p><strong><a name="A2"></a>A-2 UN SOURCE QUI GERE TOUTES LES FONCTIONS DE LA GESTION D'UNE TABLE DE PARAMETRES </strong><a href="#BDD_PARAM"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></p>
<p class="exemples">&lt;?php<br>
session_start();<br> include('classeBases.php');<br>
  include('./inc_base.php'); <br>
  <br>
include('classeForms.php');</p>
<p class="exemples">$base = New Bdd;<br>
  $base-&gt;bdd_connecter_base(BASE);<br>
  $base-&gt;<strong>bdd_param_init</strong>(&quot;nom_table_param&quot;,&quot;param_clef&quot;,&quot;param_valeur&quot;);<br>
  $base-&gt;<strong>bdd_param_security</strong>('param_num_client',<em>$_SESSION['NUM_CLIENT']</em>);<br>
  <br>
  // DEFINITION DU FORMULAIRE ##############################################################################<br>
  $f = New Forms; <br>
  $f-&gt;frm_Init($delete,'150px');</p>
<p class="exemples"> definition_des_champs();</p>
<p class="exemples"> // ILLUSTRATION DE LA RE-ENTRANCE FORMULAIRE ############################################################# <br>
  $ret = $f-&gt;frm_Aiguiller('');<br>
  $valeurpardefaut = false; <br>
  switch ( $ret ) {<br>
  <br>
  // MODIF 1ER APPEL ############################################################# <br>
  case &quot;A0&quot; :<br>
  $f-&gt;frm_ChampInitialiserValeur(&quot;PARAM1&quot;,     $base-&gt;<strong>bdd_param_load</strong>(&quot;PARAM1&quot;,10)  );<br>
  $f-&gt;frm_ChampInitialiserValeur(&quot;PARAM2&quot;,     $base-&gt;<strong>bdd_param_load</strong>(&quot;PARAM2&quot;,&quot;valeur par d&eacute;faut n&deg;=2&quot;)  );<br>
  $f-&gt;frm_ChampInitialiserValeur(&quot;PARAM3&quot;,     $base-&gt;<strong>bdd_param_load</strong>(&quot;PARAM3&quot;,&quot;5&quot;)  );<br>
  <br>
  break;<br>
  <br>
  // MODIF RE-ENTRANT ############################################################# <br>
  case &quot;A1&quot; : <br>
  $base-&gt;<strong>bdd_param_rec</strong>(&quot;PARAM1&quot;);<br>
  $base-&gt;<strong>bdd_param_rec</strong>(&quot;PARAM2&quot;);<br>
  $base-&gt;<strong>bdd_param_rec</strong>(&quot;PARAM3&quot;);</p>
<p class="exemples"> $f-&gt;frm_ChampsRecopier();<br>
  <br>
  break;<br>
  <br>
  default:<br>
  header('location: hd_logon_ok.php');<br>
  break; </p>
<p class="exemples"> }<br>
</p>
<p class="exemples">?&gt;<br>
&lt;html&gt;<br>
&lt;head&gt;<br>
&lt;title&gt;Param&egrave;trage du client &lt;/title&gt;<br>
&lt;meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=ISO-8859-1&quot; /&gt;<br>
&lt;link href=&quot;/css/style.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;<br>
&lt;/head&gt;</p>
<p class="exemples">&lt;body&gt;<br>
&lt;p&gt;<br>
&lt;?php <br>
  include('classeMenu.php');<br>
  $mn = New PopMenu($_SESSION['DEFAULT_SKIN']); <br>
  $mn-&gt;ShowPopMenu('_datamenu.js');<br>
  include('./inc_menu_dynamique.php');<br>
  $idclient = <em>$_SESSION['NUM_CLIENT']</em>;</p>
<p class="exemples">?&gt; <br>
&lt;br&gt;<br>
&lt;br&gt;<br>
&lt;blockquote&gt;&lt;br&gt;&lt;img src=&quot;../../popmenu/icones16-16/services.gif&quot; width=&quot;16&quot; height=&quot;16&quot;&gt; &lt;span class=&quot;titre1&quot;&gt;PARAMETRAGES DIVERS&lt;/span&gt;<br>
&lt;br&gt;<br>
&lt;?php<br>
$f-&gt;frm_Ouvrir();<br>
  if ($ret=='A1') {<br>
  print &quot;&lt;b&gt;Les param&egrave;tres sont enregistr&eacute;s !&lt;/b&gt;&quot;;<br>
  }</p>
<p class="exemples">?&gt;<br>
&lt;/blockquote&gt;<br>
&lt;/body&gt;<br>
&lt;/html&gt;<br>
&lt;?php<br>
  function definition_des_champs() {<br>
  global $f,$tablecomiques;<br>
</p>
<p>&nbsp;</p>
<p class="exemples"> $f-&gt;frm_ObjetChampTexte(&quot;PARAM1&quot;,    array( &quot;attrib&quot; =&gt; &quot;RN&quot;,<br>
&quot;label&quot; =&gt; &quot;Parametre n&deg;=1&quot;,<br>
&quot;maxlength&quot; =&gt; &quot;4&quot;,<br>
&quot;width&quot;    =&gt; &quot;50px&quot;,<br>
&quot;mask&quot; =&gt; &quot;####&quot;,<br>
)<br>
  );</p>
<p class="exemples"> $f-&gt;frm_ObjetChampTexte(&quot;PARAM2&quot;,    array( &quot;attrib&quot; =&gt; &quot;RU&quot;,<br>
&quot;label&quot; =&gt; &quot;Parametre n&deg;=2&quot;,<br>
&quot;maxlength&quot; =&gt; &quot;200&quot;,<br>
&quot;width&quot;    =&gt; &quot;200px&quot; )<br>
  );<br>
  $f-&gt;frm_SautLignes(1);</p>
<p class="exemples"> $f-&gt;frm_ObjetSlider(&quot;PARAM3&quot;,     array(&quot;label&quot; =&gt; &quot;Parametre n&deg;=3&quot;, <br>
&quot;orientation&quot; =&gt; &quot;H&quot;,<br>
&quot;width&quot; =&gt; &quot;80px&quot;,<br>
&quot;mini&quot;=&gt; &quot;0&quot;,<br>
&quot;maxi&quot;=&gt;&quot;10&quot;,<br>
);</p>
<p>&nbsp;</p>
<p class="exemples">}<br>
</p>
<p class="exemples">?&gt;</p>
<p class="exemples">&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
