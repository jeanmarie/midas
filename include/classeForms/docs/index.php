<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CLASSEFORMS.PHP : La gestion simplifiée des formulaires en PHP</title>
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
.style2 {font-family: "Courier New", Courier, mono; font-size: 12px; color: #000000; font-style: italic; }
.style3 {color: #009933}
.sommaire {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #999999;
}
.style4 {color: #FF0000}
.style5 {font-family: "Courier New", Courier, mono; font-size: 11px; color: #FF0000; }
.style6 {color: #3366FF}
.style7 {color: #0000FF}
.style9 {font-family: "Courier New", Courier, mono; font-size: 11px; color: #000000; font-weight: bold; }
.style10 {
	font-size: large;
	font-weight: bold;
}
.style11 {color: #0033CC}
.style12 {color: #993300}
.style13 {font-family: "Courier New", Courier, mono; font-size: 11px; color: #993300; }
.Style14 {
	color: #FF3300;
	font-weight: bold;
}
.Style15 {color: #FF0033}
-->
</style>
</head>

<body>
<?php
	include('_data_top_menu.php');
?>

<br><br>
<h1 align="center"><br>
  <br>
  DOCUMENTATION SUR LE GESTIONNAIRE DE FORMULAIRES : ClasseForms.php</h1>
<p align="center" class="exemples">AUTEUR : FRANCK OBERLECHNER, Ing&eacute;nieur Syst&egrave;me et R&eacute;seaux </p>
<p align="center" class="exemples">Derni&egrave;re mise &agrave; jour : Mai 2008</p>
<hr>
<p align="center" class="exemples">&nbsp;</p>
<blockquote>
  <h2><a name="SOMMAIRE"></a> SOMMAIRE</h2>
  <blockquote>
    <p class="sommaire">1. <a href="#PREAMBULE">Pr&eacute;ambule</a></p>
    <p class="sommaire">2.<a href="#REENTRANCE"> Principe de r&eacute;-entrance </a></p>
    <p class="sommaire">3. <a href="#INSTALLATION">Installation de la classe</a></p>
    <p class="sommaire">4. <a href="#NOUVEAU_FORMULAIRE">D&eacute;claration d'un formulaire</a> </p>
    <p class="sommaire">5. <a href="#DECLARATION">D&eacute;claration des objets</a></p>
    <p><span class="sommaire">6. <a href="#CONTROLESAISIE">Controle de saisie des objets </a></span></p>
    <p><span class="sommaire">7. <a href="#MODIFICATION_OBJETS">Modification de l'&eacute;tat des objets</a></span></p>
    <p class="sommaire">8. <a href="#MISENFORME">Mise en forme des champs du formulaire </a></p>
    <p class="sommaire">9. <a href="#CODERREENTRANCE">Codage de la r&eacute;-entrance</a></p>
    <p class="sommaire">10. <a href="#UPLOAD">La gestion des Upload</a> ( Copie d'un fichier local vers le serveur WEB ) </p>
    <p class="sommaire">11. <a href="#BUFFER">Les sortie diff&eacute;r&eacute;es</a></p>
    <p class="sommaire">12. <a href="#TIMEOUT">La fonction Timeout</a> </p>
    <p class="sommaire">13. <a href="#TIMEOUT">La fonction Message </a></p>
    <p class="sommaire">14. <a href="#FOCUS">La fonction Focus </a></p>
    <p class="sommaire">A. <a href="#ANNEXES"><strong>TOUS LES EXEMPLES</strong></a></p>
    <p class="sommaire">B. <a href="historique.php"><strong>L'historique des modifications de la classe </strong></a></p>
  </blockquote>
  <h2>&nbsp;</h2>
</blockquote>
<hr>
<blockquote>
  <h2><a name="PREAMBULE"></a>1) PREAMBULE</h2>
  <blockquote>
    <p>La classe ClasseForms.php permet de d&eacute;clarer les &eacute;l&eacute;ments d'un formulaire sous forme d'objets. Ils sont ensuite transform&eacute;s en HTML et associ&eacute;s &agrave; du code JAVASCRIPT pour la gestion des interactions entre les objets.</p>
    <p>Types d'objets : </p>
    <ul>
      <li><a href="#champtexte">Champs Texte</a>, </li>
      <li><a href="#champ_texte_date">Champs Date avec ou sans calendrier Popup, Time stamp, </a></li>
      <li><a href="#champtextepopup">Champ TextePopUp</a></li>
      <li><a href="#champtimer">Champ Timer</a><br>
      </li>
      <li><a href="#champ_memo_editeur">Champs m&eacute;mo (saisie libre sur plusieurs lignes) et Editeur de type Word</a><br>
      </li>
      <li><a href="champlistesimple">Listes simples, avec filtres,</a> avec<a href="#listeeditable"> zone saisissable</a> (COMBO BOX), &agrave; <a href="#multiliste">choix multiple </a></li>
      <li><a href="#champlistesimple">Listes double en bascule, Paire de listes chain&eacute;es (MERE/FILLE),</a> <a href="#listescascade">Listes en cascade </a><br>
      </li>
      <li><a href="#champcoche">Coches, Boutons radio,</a></li>
      <li><a href="#champcache">Champ cach&eacute;</a> </li>
      <li><a href="#champslider">Slider</a></li>
      <li><a href="#onglets">Onglets</a></li>
      <li><a href="#champtree">Arbres hi&eacute;rarchiques </a></li>
      <li><a href="#champicones">S&eacute;lecteur d'icones</a> </li>
      <li><a href="#champcolorpicker">S&eacute;lecteur de couleur</a> </li>
      <li><a href="#sortselect">Listes &agrave; trier</a></li>
      <li><a href="#uploader">Gestionnaire de t&eacute;l&eacute;chargement</a> </li>
    </ul>
    <p>Fonctions associ&eacute;es &agrave; ces objets : </p>
    <ul>
      <li>Masques de saisie, </li>
      <li>activations/d&eacute;sactivations dynamique sur coche, </li>
      <li>champs d'aide &quot;Tooltips&quot; sous forme de bulles d'aide, </li>
      <li>controle de validit&eacute; des champs avant validation du formulaire </li>
      <li>Choix d'une palette pr&eacute;d&eacute;finie pour tous les objets (SKINS)</li>
    </ul>
    <blockquote>
      <p><img src="image01_vuegenerale.gif" width="424" height="272"></p>
    </blockquote>
    <p>Une biblioth&egrave;que d'objets formulaire DHTML g&eacute;n&eacute;r&eacute; par PHP dynamiquement ne pr&eacute;sente un int&eacute;r&ecirc;t que si elle est compatible avec tous les navigateurs. Les scripts sont donc compatibles avec Internet Explorer (v6+) et Mozilla (1.3+). </p>
    <p>Les exemples PHP ex&eacute;cutables sont signal&eacute;s par l'icone <img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"> ( la classe doit &ecirc;tre install&eacute;e au pr&eacute;alable ) </p>
  </blockquote>
  <hr>
  <h2><a name="REENTRANCE"></a>2) LA RE-ENTRANCE </h2>
  <blockquote>
    <p>La gestion des pages est ici simplififi&eacute;e par le principe de r&eacute;-entrance des pages :</p>
    <p>Une m&ecirc;me page servira &agrave; ajouter, modifier, corriger et enfin enregistrer les donn&eacute;es du formulaire grace &agrave; l'appel en boucle de la page mais &agrave; un comportement diff&eacute;rent en fonction de l'action pr&eacute;c&eacute;dente. </p>
    <p><img src="diagramme_reentrance.gif"></p>
  </blockquote>
  <hr>
  <h2><a name="INSTALLATION"></a>3) INSTALLATION <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <blockquote>
    <p>D&eacute;finir un r&eacute;pertoire &quot;include_path&quot; en modifiant le fichier de configuration de PHP %SYSTEMROOT%\PHP.INI sous IIS </p>
    <blockquote>
      <p>        <span class="exemples">;;;;;;;;;;;;;;;;;;;;;;;;;<br>
        ; Paths and Directories ;<br>
        ;;;;;;;;;;;;;;;;;;;;;;;;;
        </span>
      </p>
      <p class="exemples">; UNIX: &quot;/path1:/path2&quot; <br>
        ;include_path = &quot;.:/php/includes&quot;<br>
        ;<br>
        ; Windows: &quot;\path1;\path2&quot;<br>
        <strong>include_path</strong> = &quot;d:/wwwroot/rubappli/communs&quot;</p>
    </blockquote>
    <p>D&eacute;compresser dans le r&eacute;pertoire &quot;<span class="exemples">include_path</span>&quot; du serveur PHP le fichier <strong>classeForms.php</strong> et le r&eacute;pertoire <strong>classeForms</strong> (ce r&eacute;pertoire contient toutes les ressources n&eacute;cessaires &agrave; la classe) <br>
      On obtient l'arborescence :
    </p>
  </blockquote>
  <ol>
    <blockquote>
      <p class="exemples">.../R&eacute;pertoire_Include</p>
      <blockquote>
        <p class="exemples"><span class="Style15">_classePath.php</span><br>
          classeForms.php<br>
        classeForms &lt;dir&gt;</p>
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
    </blockquote>
  </ol>
  <blockquote>
    <p class="Style14">ATTENTION pour que toutes les pages de votre site fonctionnent, d&eacute;finir de pr&eacute;f&eacute;rence un chemin absolu ( commencant par un / et donnant le chemin complet depuis la racine du site ) </p>
    <p>C'est tout ! la classe est maintenant exploitable directement </p>
    <p><strong>EN OPTION : DEFINITION D'UN THEME DE COULEUR IMPLICITE POUR TOUT LE SITE </strong></p>
    <blockquote>
      <p>Cr&eacute;er un fichier <strong>_classeSkin.php</strong> dans le r&eacute;pertoire des inclusions </p>
      <p class="exemples">&lt;?php</p>
      <blockquote>
        <p class="exemples"> // 0: Rouge, 1:Bleu, 2:Gris, 4:Vert, 5:Orange<br>
      DEFINE('DEFAULT_SKIN', 5);</p>
      </blockquote>
      <p class="exemples"> ?&gt;</p>
      <p>ce fichier est utilis&eacute; par les autres classes <strong>classeTableau</strong>, <strong>classeGrid</strong> tous les objets g&eacute;r&eacute;s par ces classes b&eacute;n&eacute;ficient du m&ecirc;me th&egrave;me de couleurs. </p>
    </blockquote>
    <h2>ATTENTION : L'INSTALLATION COMPLETE EST NECESSAIRE POUR TESTER LES EXEMPLES QUI SUIVENT </h2>
  </blockquote>
  <hr>
  <h2><a name="NOUVEAU_FORMULAIRE" id="NOUVEAU_FORMULAIRE"></a>4) DECLARATION DU FORMULAIRE <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a>
    </h3>
  </h2>
  <blockquote>
    <p>On ne peut d&eacute;clarer qu'un seul formulaire &quot;ClasseForms&quot; par page.</p>
    <blockquote>
      <p class="exemples">Syntaxe :</p>
      <blockquote>
        <table width="606" border="0">
          <tr>
            <td valign="top" class="exemples">&lt;?php</td>
            <td valign="top"><p>balise de d&eacute;but de code PHP,</p>
            <p>ATTENTION LE CODE QUI SUIT DOIT PRECEDER LA BALISE &lt;HTML&gt;<br>
              <br> 
            </p></td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td width="272" valign="top"><span class="exemples">include('classeForms.php'); <br>
              <br>
  </span></td>
            <td width="324" valign="top">appel au code de la classe</td>
          </tr>
          <tr>
            <td valign="top"><span class="exemples">$f = New Forms;</span></td>
            <td valign="top">cr&eacute;ation d'un nouvel objet &quot;formulaire&quot; : $f </td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td valign="top"><span class="exemples">$f-&gt;frm_Init(<em>$readonly,'200px'</em>,$premierchamp);</span></td>
            <td valign="top"><p>Iinitialisation de l'objet :<br>
                
              les 2 param&egrave;tres sont optionnels. <br>
                <br>
                <strong>1)</strong>               = true, si on veut qu'une grille ne soit pas modifi&eacute;e et ne serve que de visu. Une m&ecirc;me page PHP peut donc servir &agrave; la modification, a l'ajout ou pour une simple visualisation. C'est le codage qui le d&eacute;terminera<br>
               <a href="#LECTURESEULE">voir le comportement du mode &quot;lecture seule&quot;</a>            </p>
              <p><strong>2)</strong> = '200px', c'est la largeur de la colonne label des champs en mode affichage automatique (voir la fonction frm_Ouvrir() ), cette option est inutile si on utilise l'ordre <a href="#masquerlabel">frm_MasquerLabel()</a><br> 
                <a href="#largeurcolonne"><br>
              </a><img src="image08_largeurlabel.gif" width="321" height="209" border="2"></p>
              <p><strong>3)</strong> [optionnel] par d&eacute;faut = false, permet au chargement du formulaire de se retrouver directement sur le 1er champ.</p>
              <p>si un ordre     $f-&gt;frm_InitFocus('NOM_PREMIER_CHAMP'); est d&eacute;fini post&eacute;rieurement c'est ce champ l&agrave; qui sera activ&eacute; </p>
              <p align="right">                <br> 
              </p></td>
          </tr>
          <tr>
            <td valign="top"><span class="style2"><a name="masquerlabel" id="masquerlabel"></a>$f-&gt;frm_MasquerLabel();</span></td>
            <td valign="top"><p>ne pas afficher la colonne label m&ecirc;me si des label ont &eacute;t&eacute; d&eacute;finis dans les objets </p>
                <p align="right"> <a href="sample02_nolabel.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p></td>
          </tr>
          <tr>
            <td valign="top"><span class="style2"><a name="protection"></a>$f-&gt;frm_Protection();</span></td>
            <td valign="top"><p>permet de d&eacute;sactiver le clic droit sur la page (Fonction optionnelle)</p>
              <p align="right">                  <a href="sample02_protection.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p></td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td valign="top" bgcolor="#F2F2F2"><span class="style2"><a name="fileupload"></a>$f-&gt;frm_InitUpload($taillemaxi, $chemindestination, $attributsautorises);<br>
<br>&nbsp;
            </span></td>
            <td valign="top"><p>permet dans le cas de la pr&eacute;sence d'un <a href="#selecteur">champ S&eacute;lecteur de fichier</a> d'activer la fonction UPLOAD : 3 param&egrave;tres &quot;chaine de caract&egrave;res&quot; sont obligatoires :<br>              
              </p>
              <p>1 - Le chemin de destination (obligatoire) <br>
                2 - La taille maximum du fichier en Octets t&eacute;l&eacute;chargeable (optionnel) <br>            
                3 - Les suffixes de fichiers autoris&eacute;s (le s&eacute;parateur &eacute;tant la virgule &quot;,&quot; ) exemple : &quot;DOC,XLS,TXT&quot; (optionnel)<br>
                <br>
                <br>            
                <br>            
              </p></td>
          </tr>
          <tr>
            <td valign="top"><span class="style2">$f-&gt;frm_InitConfirm();</span></td>
            <td valign="top"><p>permet de demander une confirmation d'enregistrement si tous les tests sont OK avant validation du formulaire</p>
              <p><br> 
              </p></td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td valign="top" class="exemples"><em><a name="initpalette"></a>$f-&gt;frm_InitPalette($codepalette);</em></td>
            <td valign="top"><p>permet d'initialiser la couleur de tous les objets disponbible en une seule ligne :</p>
            <p>$codepalette = 1 ( bleu ), =2 (Gris), =3 (Jaune)<br>
              La palette par d&eacute;faut est rouge.<br>
              Pour d&eacute;finir de nouvelles palettes modifier le switch/case de la fonction. <br>
              <a href="#palettespredefinies">voir le rendu</a></p>
            <p align="right"><a href="sample01_palette.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"><br>
              <br>
            </a></p></td>
          </tr>
          <tr>
            <td valign="top" class="exemples"><span class="style2"><a name="taillepolice"></a>$f-&gt;frm_InitFont(&quot;10&quot;);</span></td>
            <td valign="top"><p>on peut changer la taille de la fonte, par d&eacute;faut sans appel &agrave; cette fonction la taille est = 10 </p>
            <p align="right"><a href="sample34_taillepolice.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p></td>
          </tr>
          <tr>
            <td valign="top" class="exemples">. Appel &agrave; une fonction qui d&eacute;finit les objets ou aux fonctions <a href="#DECLARATION">frm_*</a> directement. <br>              <br></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top" class="exemples">. Appel aux <a href="#MODIFICATION_OBJETS">fonctions qui modifient les caract&eacute;ristiques des objets</a> </td>
            <td valign="top">Ces fonctions permettent en fonction de la r&eacute;entrance de modifier les champs dans leur d&eacute;finition (activation ou non, changer la valeur par d&eacute;faut, pointage en erreur..)<br> </td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td valign="top" class="exemples"> <p>$ret = $f-&gt;frm_Aiguiller();<br>
              switch ( $ret ) {...}<br>
              <br>
            </p>            </td>
            <td valign="top">Analyse de la r&eacute;-entrance voir chapitre traitant le sujet </td>
          </tr>
          <tr>
            <td valign="top" class="exemples">?&gt;<br>
            <br></td>
            <td valign="top">Fin de d&eacute;finition des objets du formulaire </td>
          </tr>
          <tr>
            <td valign="top" class="exemples"><p class="style3">&lt;html&gt;<br>
&lt;head&gt;<br>
&lt;title&gt;...&lt;/title&gt;<br>
&lt;/head&gt;<br>
&lt;body&gt;</p>
            <p class="style3">...<br>
              &lt;?php
              <br>
            </p>              </td>
            <td valign="top">Insertion ici du code HTML de pr&eacute;sentation, les menus titres de fen&ecirc;tre sont &agrave; placer ici. </td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td valign="top" class="exemples">$f-&gt;frm_Ouvrir(<em>$modeautomatique</em>);</td>
            <td valign="top"><p>Affichage des champs d&eacute;finis ci-dessus <br>
              2 modes sont possibles ( automatique=par d&eacute;faut <br>
            ou manuel ) </p>
            <p>Mode automatique :</p>
            <blockquote>
              <p>tous les champs sont plac&eacute;s automatiquement dans l'ordre de leur d&eacute;finition. Ils sont plac&eacute;s dans un tableau &agrave; 2 colonnes :<br>
                  . A gauche : le &quot;label&quot;
    qui donne la signification du champ<br>
    . A droite : le champ.<br>
    Tous
    les champs sont alors align&eacute;s. </p>
            </blockquote>
            <p>Mode manuel : </p>
            <blockquote>
              <p>Tous les champs sont &agrave; placer manuellement, il est possible de les placer dans l'ordre que l'on veut, plusieurs par ligne. Le &quot;label&quot; n'est pas affich&eacute;, il faut le saisir manuellement </p>
              <p><a href="#MODE_MANUEL">voir le chapitre &quot;Affichage des champs en mode manuel&quot; </a><br>
                <br>
              </p>
            </blockquote></td>
          </tr>
          <tr>
            <td valign="top" class="exemples"><p>if ($f-&gt;frm_Reentrant()) {</p>
            <p>...  </p>
            <p>} </p></td>
            <td valign="top">Si la page est r&eacute;entrante alors la fonction retourne vrai </td>
          </tr>
          <tr>
            <td valign="top" class="exemples">$f-&gt;frm_Fermer();</td>
            <td valign="top">Pour fermer le formulaire (envoi la balise &lt;/FORM&gt; et ferme le tableau ouvert en mode automatique )<br> </td>
          </tr>
          <tr>
            <td valign="top" class="exemples">?&gt;</td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table>
      </blockquote>
    </blockquote>
  </blockquote>
  <hr>
  <h2><a name="DECLARATION"></a>5) DECLARATION DES OBJETS <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <blockquote>
    <p>Tous les champs devoient &ecirc;tre unique dans la grille, les &eacute;ventuels doublons sont signal&eacute;s.</p>
    <p>Le nom des champs doit &ecirc;tre <strong>en majuscule</strong> pour correspondre &agrave; leurs valeur retourn&eacute;e par $_POST['NOMCHAMP']. </p>
    <h3><a name="champtexte"></a>5.1) CHAMPS TEXTE </h3>
    <blockquote>
      <p>Le champ texte permet toute saisie en une seule ligne de donn&eacute;es. Ces donn&eacute;es peuvent &ecirc;tre format&eacute;e par des masques.</p>
      <blockquote>
        <p class="exemples"><strong>Syntaxe :</strong></p>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td width="277" align="right" valign="top"><p align="left" class="exemples">$f-&gt;frm_ObjetChampTexte(&quot;NOM&quot;,array(<br>
              <br>
              <br>
              <br>
              <br>
              </p>            </td>
            <td width="440"><p class="exemples">&quot;label&quot; =&gt; &quot;Nom :&quot;,<br>
&quot;attrib&quot; =&gt; &quot;RU&quot;, <br>
&quot;width&quot; =&gt; &quot;100px&quot;, <br>
&quot;maxlength&quot; =&gt; &quot;20&quot;, <br>
&quot;help&quot; =&gt; &quot;ceci est le texte de l'aide&quot;, <br>
&quot;default&quot; =&gt; &quot;Nom par d&eacute;faut&quot;)<br> 
);<br>
<br>
            </p>            </td>
          </tr>
          <tr>
            <td align="right" valign="top"><p align="left" class="exemples">$f-&gt;frm_ObjetChampTexte(&quot;TEL&quot;,array(<br>
                    <br>
                    <br>
                    <br>
                    <br>
            </p></td>
            <td><p class="exemples">&quot;label&quot; =&gt; &quot;T&eacute;l&eacute;phone (*)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;R&quot;,<br>
&quot;default&quot; =&gt; &quot;02.50.10.02.03&quot;,<br>
&quot;mask&quot; =&gt; &quot;##.##.##.##.##&quot;)<br>
);<br>
<br>
            </p></td>
          </tr>
          <tr valign="top" class="exemples">
            <td align="right"> <div align="left">$f-&gt;frm_ObjetChampTexte(&quot;MONEY&quot;,array(</div></td>
            <td> <p>&quot;label&quot; =&gt; &quot;Mon salaire en &euro; sans les centimes (mask=&euro;#_###.##)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;N&quot;,<br>
&quot;mask&quot; =&gt; &quot;&euro;#_###.##&quot;,<br>
&quot;help&quot; =&gt; &quot;Saisir le salaire &agrave; travers le masque, 2 d&eacute;cimales non obligatoire &euro;#_###.##&quot;)<br>
);<br>
<br>
            </p>            </td>
          </tr>
          <tr valign="top" class="exemples">
            <td align="right"> <div align="left">$f-&gt;frm_ObjetChampTexte(&quot;DATE_1&quot;,array( </div></td>
            <td>&quot;label&quot; =&gt; &quot;Date manuellemen ou avec calendrier (attrib=DP)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;DP&quot;,<br>
&quot;default&quot; =&gt; &quot;TIMER&quot;, <br>
&quot;help&quot; =&gt; &quot;Saisir une date ou la s&eacute;lectionner dans au calendrier&quot;)<br>
);</td>
          </tr>
        </table>
        <p><strong>D&eacute;tail des param&egrave;tres:</strong></p>
      </blockquote>
    </blockquote>
    <ul>
      <li><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</li>
      <li><strong>default</strong> : affectation d'une valeur par d&eacute;faut, dans le cas des champs DATE et TIMESTAMP si = &quot;TIMER&quot; alors l'horloge du serveur est r&eacute;cup&eacute;r&eacute;e. </li>
      <li><strong><a name="attribtexte"></a>attrib</strong> : attributs des champs
          <blockquote>
            <p><strong>&quot;R&quot;</strong> : champ obligatoire</p>
            <p><strong>&quot;+&quot;</strong> : Lecture seule ( m&ecirc;me action que la fonction<strong> <a href="#READONLY">frm_ChampLectureSeule()</a> ) </strong><br>
              <strong>&quot;-&quot;</strong> : D&eacute;sactiver le champ ( m&ecirc;me action que la fonction<strong> <a href="#CHAMPACTIF">frm_ChampActif()</a></strong> ) <br>
              <br>
              <strong>&quot;U&quot;</strong> : transformation en majuscule<br>
              <strong>&quot;L&quot;</strong> : transformation en minuscule<br>
              <strong></strong><strong>&quot;I&quot;</strong> : transformation avec l'initiale en majuscule le reste du mot en minuscule</p>
            <p><strong>&quot;M&quot;</strong> : pour une adresse email du type : nom@domaine.com </p>
            <p><strong>&quot;N&quot;</strong> : pour num&eacute;rique, le cadrage est automatiquement plac&eacute; &agrave; droite, les caract&egrave;res alphanum&eacute;riques autre que +, -, . sont ignor&eacute;s.</p>
            <p><strong>&quot;W&quot;</strong> : pr&eacute;formate le champ texte en type PASSWORD</p>
            <p><img src="image21_attributs.gif" width="518" height="213" border="2"></p>
            <p><a href="sample16_attributs.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
            <p><strong><a name="champ_texte_date"></a>&quot;D&quot;</strong> : pr&eacute;formate la saisie au format date &quot;jj/mm/aaaa&quot;, la saisie de l'ann&eacute;e sur 2 caract&egrave;res est automatiquement compl&eacute;t&eacute;e &agrave; 4. ( en ajoutant <strong>&quot;P&quot;</strong> un bouton calendrier est ajout&eacute; &agrave; droite )<br>
              <strong>&quot;T&quot;</strong> : pr&eacute;formate la date au format &quot;timestamp&quot; jj/mm/aaaa hh:mm, un bouton calendrier est rajout&eacute; automatiquement la saisie manuelle n'est pas possible <br>
              <strong>&quot;H&quot;</strong> :
      format de saisie HH:MM <br>
      <img src="image05_dates.gif" width="613" height="260" border="2"><br>
      <br>
            </p>
            <p align="left"><a href="sample04_dates.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
            <p>exemple de combinaisons : <strong>RDP</strong> (champ date obligatoire avec bouton &quot;calendrier&quot;), <strong>RN</strong> (num&eacute;rique obligatoire) </p>
          </blockquote>
      </li>
      <li><strong><a name="masques"></a>mask</strong> : d&eacute;finit un masque de saisie dynamique (voir possibilit&eacute;s ci-dessous) <br>
        <br>
        <blockquote>
              <p><img src="image04_masques.gif" width="732" height="277" border="2">        </p>
        </blockquote>
      </li>
    </ul>
    <blockquote>
      <p align="left"><a href="sample03_masques.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
    <ul>
      <li><strong>width</strong> : d&eacute;finit la largeur </li>
      <li><strong>maxlength</strong> : nombre de caract&egrave;res maximun</li>
      <li><strong>help</strong> : affiche au niveau du champ &agrave; droite de la fen&ecirc;tre une bulle d'aide, le libell&eacute; de l'aide peut contenir des balises HTML ( &lt;b&gt;&lt;/b&gt; pour mettre un mot en gras par exemple</li>
    </ul>
  </blockquote>
</blockquote>
<p>&nbsp;</p>
<hr>
<blockquote>
  <blockquote>
    <p>&nbsp;</p>
  </blockquote>
</blockquote>
<blockquote>
  <blockquote>
    <h3 id="champlistesimple" name="champlistesimple"><a name="champ_memo_editeur" id="champ_memo_editeur"></a>5.2) CHAMPS MEMO ET EDITEUR DE TYPE WORD </h3>
    <p>Le champ m&eacute;mo permet toute saisie libre en une ou plusieurs lignes. </p>
    <p>Le champ editeur permet une saisie format&eacute;e comme un &eacute;diteur de type WORD l'objet utilise l'excellente librairie <a href="http://www.fckeditor.net" target="_blank">FCKeditor</a> un peu lourde &agrave; charger &agrave; la 1ere visite mais ne fois dans le cache du navigateur quelle puissance ! </p>
    <blockquote>
      <p class="exemples"><strong>Syntaxe :</strong></p>
      <table width="721" border="0" cellspacing="0">
        <tr>
          <td width="277" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetChampMemo(&quot;MEMO&quot;, array(<br>
                  <br>
                  <br>
                  <br>
          </p></td>
          <td width="440"><p class="exemples">&quot;label&quot; =&gt; &quot;Champ M&eacute;mo&quot;,<br>
&quot;attrib&quot; =&gt; &quot;RU&quot;,<br>
&quot;default&quot; =&gt; &quot;Ceci est la valeur par d&eacute;faut pass&eacute; au champ &quot;,<br>
&quot;help&quot; =&gt; &quot;Saisie libre dans cette zone&quot;, <br>
&quot;width&quot; =&gt; &quot;400px&quot;)<br>
    );<br>
              <br>
          </p></td>
        </tr>
        <tr>
          <td height="112" align="right" valign="top"><p align="left" class="exemples">$f-&gt;frm_ObjetEditeur(&quot;EDITEUR&quot;, array(<br>
                  <br>
                  <br>
                  <br>
                  <br>
          </p></td>
          <td><p class="exemples">&quot;label&quot; =&gt; &quot;Champ Editeur&quot;,<br>
&quot;width&quot; =&gt; &quot;400px&quot;,<br>
&quot;height&quot; =&gt; &quot;150px&quot;,<br>
&quot;userfilespath&quot; =&gt; &quot;/tmp/&quot;,<br>
&quot;default&quot; =&gt; &quot;Ceci est la &lt;b&gt;valeur par d&eacute;faut&lt;/b&gt; pass&eacute; au &lt;um&gt;champ \&quot;Editeur\&quot;&lt;/um&gt;&lt;br&gt;Le contenu de ce champ est &eacute;videmment &agrave; sauvegarder dans un champ m&eacute;mo&quot;)<br>
    );<br>
              <br>
          </p></td>
        </tr>
      </table>
      <p><strong>D&eacute;tail des param&egrave;tres:</strong></p>
    </blockquote>
    <ul>
      <li><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</li>
      <li><strong>attrib</strong> : attributs des champs
          <blockquote>
            <p><strong>&quot;R&quot;</strong> : champ obligatoire<br>
                <br>
                <strong>&quot;U&quot;</strong> : transformation en majuscule<br>
                <strong>&quot;I&quot;</strong> : transformation avec l'initiale en majsucule le reste du mot en minuscule</p>
            <p><strong>&quot;N&quot;</strong> : pour num&eacute;rique, le cadrage est automatiquement plac&eacute; &agrave; droite, les caract&egrave;res alphanum&eacute;riques autre que +, -, . sont ignor&eacute;s.</p>
            <p><strong>&quot;+&quot;</strong> : Lecture seule ( m&ecirc;me action que la fonction<strong> frm_ChampLectureSeule() ) </strong><br>
              <strong>&quot;-&quot;</strong> : D&eacute;sactiver le champ ( m&ecirc;me action que la fonction<strong> frm_ChampActif()</strong> ) </p>
          </blockquote>
      </li>
    </ul>
    <blockquote>
      <p><strong>&quot;D&quot;</strong> : pr&eacute;formate la saisie au format date &quot;jj/mm/aaaa&quot;, la saisie de l'ann&eacute;e sur 2 caract&egrave;res est automatiquement compl&eacute;t&eacute;e &agrave; 4. ( en ajoutant <strong>&quot;P&quot;</strong> un bouton calendrier est ajout&eacute; &agrave; droite )<br>
          <strong>&quot;T&quot;</strong> : pr&eacute;formate la date au format &quot;timestamp&quot; jj/mm/aaaa hh:mm, un bouton calendrier est rajout&eacute; automatiquement la saisie manuelle n'est pas possible <br>
        <strong>&quot;H&quot;</strong> : format de saisie HH:MM </p>
      <p>&nbsp;</p>
      <p><strong>MEMO = rows</strong> : le nombre de lignes du champ</p>
      <p><strong>EDITEUR = height</strong>: hauteur de la zone de saisie en pixels</p>
      <p><strong>Param&egrave;tres sp&eacute;cifiques &agrave; l' &eacute;diteur :</strong></p>
      <p> <strong>&quot;userfilespath&quot; </strong>=&gt; &quot;/tmp/&quot; : racine du gestionnaire de fichiers <span class="Style15"><strong>ATTENTION</strong> pour la prise en compte de cette option la page doit avoir une session d'ouverte. </span></p>
      <p></p>
      <p><br>
        <img src="image07_memo_editeur.gif" width="525" height="362" border="2"><br>
        <br>
        Si le formulaire est en lecture seul toute la barre d'outils disparait :</p>
      <p><img src="image25_editeurlecture.gif" width="525" height="274" border="2"></p>
      <p><a href="sample06_memo_editeur.php" align="left"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <p>&nbsp;</p>
    </blockquote>
    <h3 align="left"><a name="champlistesimple" id="champlistesimple"></a>5.3) CHAMPS LISTES SIMPLES ET COMPLEXES </h3>
    <blockquote>
      <blockquote>
        <p class="exemples">&nbsp;</p>
      </blockquote>
      <p>5 fonctions permettent de g&eacute;rer des listes de mani&egrave;re diff&eacute;rente :</p>
      <ul>
        <li class="sommaire"><strong>frm_ObjetListe</strong> : liste simple on choisit un &eacute;l&eacute;ment de la liste <br>
        </li>
        <li class="sommaire"><strong>frm_ObjetListeLongue</strong> : filtrage d'une liste avec de nombreux &eacute;l&eacute;ments pour simplifier la recherche , la saisie d'une valeur est possible <br>
        </li>
        <li class="sommaire"><strong>frm_Objet2Listes</strong> : cr&eacute;ation de 2 listes en liaison. La valeur retourn&eacute;e est la valeur du fils s&eacute;lectionn&eacute;e. les valeurs sont pass&eacute;es en un seul tableau de &quot;hash&quot; qui doit &ecirc;tre de la forme : 
          <blockquote>
            <p><span class="exemples">array( &quot;1&quot; =&gt; &quot;Valeur P&egrave;re 1&quot;, &quot;2&quot; =&gt; &quot;Valeur P&egrave;re 2&quot;, <br>
              &quot;1.1&quot; =&gt; &quot;Valeur fils 1 du p&egrave;re 1&quot;, &quot;1.2&quot; =&gt; &quot;Valeur fils 2 du p&egrave;re 1&quot;,<br>
              &quot;2.1&quot; =&gt; &quot;</span><span class="exemples">Valeur fils 1 du p&egrave;re 2 &quot;, &quot;1.2&quot; =&gt; &quot;Valeur fils 2 du p&egrave;re 2 &quot;<br>
              ... 
              )</span><br>
            </p>
          </blockquote>
        </li>
        <li class="sommaire"><strong>frm_ObjetListeEditable</strong> : comportement &quot;combo box&quot;, choix de valeur parmi une liste avec la possibilit&eacute; de saisir une valeur propre. Le champ de donn&eacute;es est cach&eacute; et &agrave; pour nom le nom du champ &quot;NOMDUCHAMP&quot;, la valeur de saisie se nomme &quot;NOMDUCHAMP_EDIT&quot;. Quand la valeur n'est pas dans la liste les caract&egrave;res du champ deviennent <em>italique</em> et la valeur retourn&eacute;e par &quot;NOMDUCHAMP&quot; = -1 <br>
        </li>
        <li class="sommaire"><strong>frm_ObjetListeBascule</strong> : cr&eacute;ation de 2 listes avec possibilit&eacute; de faire glisser des valeurs de droite &agrave; gauche et r&eacute;ciproquement. <br>
          - 
          Les indices des lignes s&eacute;lectionn&eacute;es sont concat&eacute;n&eacute;es dans un seul champ (cach&eacute;) avec la virgule &quot;,&quot; comme s&eacute;parateur. Ce champ se nomme &quot;NOMDUCHAMP&quot;. <br>
        - La valeur par d&eacute;faut fonctionne de m&ecirc;me : si les indices 1,3,4 sont pass&eacute;s par d&eacute;faut alors default = &quot;1,3,4&quot;</li>
      </ul>
      <p class="exemples"><strong>Syntaxe :</strong></p>
      <table width="721" border="0" cellspacing="0">
        <tr>
          <td width="310" align="right" valign="top"><p align="left" class="exemples">$f-&gt;frm_ObjetListe(&quot;LISTE_NORMALE&quot;, array(<br>
                  <br>
                  <br>
                  <br>
                  <br>
          </p></td>
          <td width="407"><p class="exemples"> 
&quot;label&quot; =&gt; &quot;Liste d&eacute;roulante &quot;,<br>
&quot;title&quot; =&gt; &quot;----- Choisir une VILLE -----&quot;,<br>
&quot;default&quot; =&gt; &quot;5&quot;,<br>
&quot;help&quot; =&gt; &quot;choisir une ville de la liste&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;),<br>
      $tableau1 <br>
      );<br>
  &nbsp;<br>
          </p></td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top"> $f-&gt;frm_ObjetListe(&quot;LISTE_OBLIG&quot;, array(</td>
          <td>&quot;label&quot; =&gt; &quot;Capitale (*)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;R&quot;,<br>
&quot;default&quot; =&gt; &quot;5&quot;,<br>
&quot;help&quot; =&gt; &quot;choisir OBLIGATOIREMENT une ville de la liste&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;),<br>
      $tableau1 <br>
      );<br>
  &nbsp;</td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top"> $f-&gt;frm_ObjetListe(&quot;LISTE_LNG&quot;, array(<br></td>
          <td>&quot;label&quot; =&gt; &quot;Liste normale&quot;,<br>
&quot;default&quot; =&gt; &quot;3&quot;,<br>
&quot;rows&quot; =&gt; 5,<br>
&quot;help&quot; =&gt; &quot;choisir une ville de la liste&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;),<br>
      $tableau1 <br>
      );<br>
  &nbsp; </td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top"> $f-&gt;frm_ObjetListeLongue(&quot;LISTE_LONGUE&quot;</td>
          <td>,array(<br>
 &quot;label&quot; =&gt; &quot;Liste longue avec filtre (*)&quot;,<br>
&quot;default&quot; =&gt; &quot;2&quot;, <br>
&quot;attrib&quot; =&gt; &quot;RU&quot;,<br>
&quot;addvalue&quot; =&gt; true, <br>
&quot;rows&quot; =&gt; &quot;4&quot;,<br>
&quot;help&quot; =&gt; &quot;Utiliser le champ de filtrage pour trouver et choisir une ville&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;,),<br>
      $tableau1 <br>
      );<br>
  &nbsp;</td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top"> $f-&gt;frm_Objet2Listes(&quot;LISTE_VERT&quot;, array(<br></td>
          <td>&quot;label&quot; =&gt; &quot;2 listes en liaison (V)&quot;,<br>
&quot;orientation&quot; =&gt; &quot;V&quot;,<br>
&quot;default&quot; =&gt; &quot;2.2&quot;,<br>
&quot;help&quot; =&gt; &quot;choisir une option et une sous-option&quot;, <br>
&quot;width&quot; =&gt; &quot;200px&quot;,<br>
&quot;title1&quot; =&gt; &quot;---choisir la ville---&quot;,<br>
&quot;title2&quot; =&gt; &quot;---choisir la curiosit&eacute;---&quot;)<br>
      ,<br>
      array( &quot;1&quot; =&gt; &quot;Paris&quot;, &quot;2&quot; =&gt; &quot;Lyon&quot;,<br>&quot;3&quot; =&gt; &quot;Marseille&quot;, &quot;4&quot; =&gt; &quot;Toulouse&quot;,<br>&quot;1.1&quot; =&gt; &quot;Tour effel&quot;, &quot;1.2&quot; =&gt; &quot;Sacr&eacute; coeur&quot;, <br>&quot;2.1&quot; =&gt; &quot;Fourvi&egrave;re&quot;, &quot;2.2&quot; =&gt; &quot;Bellecour&quot;,<br>&quot;3.1&quot; =&gt; &quot;Canebi&egrave;re&quot;, &quot;3.2&quot; =&gt; &quot;Notre dame de la garde&quot;,<br>&quot;4.1&quot; =&gt; &quot;Capitole&quot;, &quot;4.2&quot; =&gt; &quot;Saint-Sernin&quot;)<br>
        <br>
        );<br>
    &nbsp; </td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top"> $f-&gt;frm_ObjetListeEditable(&quot;Liste&quot;, array(<br></td>
          <td>&quot;label&quot; =&gt; &quot;Liste &eacute;ditable&quot;,<br>
&quot;attrib&quot; =&gt; &quot;RI&quot;, <br>
&quot;default&quot; =&gt; &quot;Bruxelles&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;, <br>
&quot;help&quot; =&gt; &quot;Saisir une valeur de la liste ou saisir une nouvelle (les valeurs hors liste sont en italique)&quot;,<br>
      ),<br>
      $tableau1 );<br>
  &nbsp;</td>
        </tr>
        <tr class="exemples">
          <td align="left" valign="top">$f-&gt;frm_ObjetBascule(&quot;LISTE_BASCULE&quot;, array(</td>
          <td>&quot;label&quot; =&gt; &quot;Listes en bascule&quot;,<br>
&quot;default&quot; =&gt; &quot;1,2,3&quot;,<br>
&quot;attrib&quot; =&gt; &quot;R&quot;,<br>
&quot;rows&quot;=&gt;&quot;10&quot;,<br>
&quot;title1&quot; =&gt; &quot;Liste gauche&quot;, <br>
&quot;title2&quot; =&gt; &quot;Liste droite&quot;,<br>
&quot;help&quot; =&gt; &quot;choisir au moins une ville&quot;,<br>
&quot;width&quot; =&gt; &quot;100px&quot;<br>
    ),<br>
    $tableau1 ); <br> 
&nbsp;</td>
        </tr>
      </table>
      <p><strong>ATTRIBUTS COMMUNS </strong></p>
    </blockquote>
    <ul>
      <li><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</li>
      <li><strong>default</strong> : valeur par d&eacute;faut (indice du tableau ou valeur quelconque possible pour la fonction frm_ObjetListeEditable()</li>
      <li><strong>width</strong> : largeur en pixels du champ liste </li>
      <li><strong>help</strong> : bulle d'aide </li>
      <li><strong>attrib</strong> : attributs des champs
          <blockquote>
            <p><strong>&quot;R&quot;</strong> : champ obligatoire<br>
              <strong>&quot;U&quot;</strong> : transformation en majuscule<br>
              <strong>&quot;I&quot;</strong> : transformation avec l'initiale en majsucule le reste du mot en minuscule</p>
            <p><strong>&quot;+&quot;</strong> : Lecture seule ( m&ecirc;me action que la fonction<strong> frm_ChampLectureSeule() ) </strong><br>
              <strong>&quot;-&quot;</strong> : D&eacute;sactiver le champ 
              ( m&ecirc;me action que la fonction<strong> frm_ChampActif()</strong> ) </p>
          </blockquote>
      </li>
      <li>              <strong>rows</strong> : nombre de lignes de la liste, dans le cas de la bascule, la valeur implicite et minimale = 7 </li>
      <li><strong>orientation</strong> : V pour vertical, H pour Horizontal</li>
      <li><strong>title</strong> : c'est le titre de la liste, n'apparait que dans les listes d&eacute;roulantes ( le param&egrave;tre <strong>rows</strong> non d&eacute;fini ) </li>
      <li><strong>titlevalue</strong> : vient completer title en lui donnant une valeur par d&eacute;faut ( tr&egrave;s utile dans le cas d'un choix non obligatoire qui ne doit pas prendre la valeur NULL dans la base) </li>
      <li><strong>title1, title2</strong> : titre des 2 listes<br>
      </li>
    </ul>
    <blockquote>
      <p><strong>MATRICE DES PARAMETRES</strong></p>
      <table width="582" border="1" cellspacing="0">
        <tr bgcolor="#FFDBCE">
          <td><strong>PARAMETRES</strong></td>
          <td><strong>ObjetListe</strong></td>
          <td><strong>ObjetListeLongue</strong></td>
          <td><strong>Objet2Listes</strong></td>
          <td><strong>ObjetListeEditable</strong></td>
          <td><strong>ObjetListesCascade</strong></td>
          <td><strong>ObjetBascule</strong></td>
        </tr>
        <tr bgcolor="#FFDDDD">
          <td><strong>label</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr bgcolor="#FFDDDD">
          <td><strong>default</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr bgcolor="#FFDDDD">
          <td><strong>width</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr bgcolor="#FFDDDD">
          <td><strong>help</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr bgcolor="#FFDDDD">
          <td><strong>attrib</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr>
          <td><strong>rows</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">&nbsp;&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">X </div></td>
        </tr>
        <tr>
          <td><strong>orientation</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><strong>title</strong></td>
          <td><div align="center">X</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
        </tr>
        <tr>
          <td><strong>titlevalue</strong></td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><strong>title1, title2</strong></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">X</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">&nbsp;</div></td>
          <td><div align="center">X</div></td>
        </tr>
        <tr>
          <td><strong>sort</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
        </tr>
        <tr>
          <td><strong>addvalue</strong></td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><strong>script</strong></td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="center">X</div></td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>        <strong><img src="image06_listes.gif" width="617" height="529" border="2"></strong></p>
<p><a href="sample05_listes.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
<p><a name="listeeditable"></a>cas particulier de l'objet <strong>frm_ObjetListeEditable</strong> :</p>
<p>ATTENTION CE CHAMP EST INCOMPATIBLE AVEC LES ONGLETS </p>
<p>si l'objet a pour nom &quot;LISTEEDITABLE&quot;, la page retourne 2 variables POST issues de champs </p>
<ul>
<li>$_POST['<strong>LISTEEDITABLE</strong>'] , l'indice dans la table de l'objet s&eacute;lectionn&eacute; ou -1 si l'&eacute;l&eacute;ment n'est pas dans la table (c'est un champ &quot;hidden&quot; ) <br>
<br>
</li>
<li>$_POST['<strong>LISTEEDITABLE_EDIT</strong>'], le libell&eacute;  du champ </li>
</ul>
<p>pour initialiser la valeur de l'objet on dispose de 3 possibilit&eacute;s :</p>
<ul>
  <li>soit on passe l'indice de l'&eacute;l&eacute;ment du tableau (num&eacute;rique) </li>
  <li>soit une des valeurs pr&eacute;sente dans le tableau (chaine de caract&egrave;res) <br>
  </li>
  <li>ou enfin une chaine quelconque qui n'est pas dans la liste, et qui apparait alors en italique</li>
</ul>
      <p> <span class="exemples">// ANALYSE DES VALEURS ENREGISTREES</span></p>
      <p class="exemples">if ( isset($_POST['LISTE_1']) ) {</p>
      <blockquote>
      <p class="exemples"> // SI L'INDICE EST =-1 ALORS C'EST UNE CHAINE QU'IL FAUT PASSER EN VALEUR &quot;PAR DEFAUT&quot; <br>
      if ($_POST['LISTE_1']==-1)
      $def_liste1 = $_POST['LISTE_1_EDIT'];<br>
      else 
      $def_liste1 = $_POST['LISTE_1'];<br>
      </p>
      </blockquote>
      <p class="exemples"> } else {</p>
      <blockquote>
      <p class="exemples"> $def_liste1 = &quot;Bruxelles&quot;;</p>
      </blockquote>
      <p class="exemples"> }</p>
      <p class="exemples"><a href="sample05_listes_editables.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      <p><a name="listebascule" id="listebascule"></a>cas particulier de l'objet <strong>frm_ObjetBascule</strong> : </p>
      <p><strong>sort</strong> : quand cette option est <em>true</em> alors les &eacute;l&eacute;ments de la liste de droite sont triables.</p>
      <p>le champ qui correspond au nom de l'objet est un objet cach&eacute; qui contient la liste des indices des options s&eacute;lectionn&eacute;es s&eacute;par&eacute;s par une virgule. Le choix de ce s&eacute;parateur n'est pas un hasard puisqu'en SQL on peut s&eacute;lectionner plusieurs enregistrements qui ont un identifiant parmi une liste de valeurs s&eacute;par&eacute;s par une virgule :</p>
      <p><strong>SELECT * FROM MaTable WHERE id_table IN (1,2,3,4) </strong></p>
      <p><img src="image09_bascule.gif" width="502" height="162" border="2"></p>
      <p><a href="sample09_listes_bascule.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      <p><a name="listelongue" id="listelongue"></a>cas particulier de l'objet <strong>frm_ObjetListeLongue</strong> : </p>
      <p><strong>addvalue</strong> : quand cette option est <em>true</em> la zone de filtre devient en m&ecirc;me temps un champ de saisie </p>
      <p><strong>addminlength</strong> : taille minimum ajoutable, si =5 par exemple les mots de moins de 5 caract&egrave;res ne sont pas ajoutables </p>
      <p>L'interpretation de la valeur retour se fait comme suit :</p>
      <p>Avec la d&eacute;claration du champ &quot;NOM_DU_CHAMP&quot;  sont retourn&eacute;s 2 variables $_POST : &quot;NOM_DU_CHAMP&quot; qui contient l'indice dans la table ou -1 si nouvelle saisie, et &quot;NOM_DU_CHAMP_EDIT&quot;la valeur de la nouvelle saisie </p>
      <p><strong>script</strong> : expression ex&eacute;cut&eacute;e a chaque changement d'&eacute;tat de l'objet, l'exemple <a href="sample05_listes_longues_script.php">sample05_listes_longues_script.php</a> permet par exemple d'activer un autre champ  quand la valeur saisie avec l'attribut &quot;addvalue&quot; n'est pas dans la liste.</p>
      <p><img src="image44_listelongue.gif" width="610" height="253" border="2"></p>
      <p class="style10"><a href="sample05_listes_longues.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      <p class="style10">Nouveaux attributs AJAX :</p>
      <p>Dans ce cas le tableau des valeurs est vide, la liste est recalcul&eacute;e dynamiquement </p>
      <p><strong>ajax</strong> : le seul param&egrave;tre obligatoire, c'est le nom de l'URL qui retourne un XML, par d&eacute;faut le param&egrave;tre est pass&eacute; en POST et se nomme:</p>
    </blockquote>
    <ul>
      <li><strong>'TEXT'</strong> pour une recherche plein texte</li>
      <li><strong>'VALUE'</strong> pour trouver un enregistrement pr&eacute;cis sur son identifiant</li>
    </ul>
    <blockquote>
      <p>mais on peut aussi envoyer d'autres param&egrave;tres au moyen d'un HASH de la forme :</p>
      <p> &quot;<strong>ajaxparams</strong>&quot; =&gt; array(</p>
      <blockquote>
        <p> 'DEPARTEMENT' =&gt; &quot;MM_findObj('DEPARTEMENT').value&quot;,<br>
          'NOM'         =&gt; &quot;MM_findObj('NOM').value&quot;,</p>
      </blockquote>
      <p>);</p>
      <p><strong>ajaxsearchminlength</strong> : la recherche est interdite en si le nombre de caracteres est en dessous de cette limite. Cet attribut empeche le script de durer trop longtemps et de planter le navigateur dans le cas de tables importantes,</p>
      <p><strong>ajaxautosearch</strong> : true / false, appel a chaque modification du filtre, peut &ecirc;tre assez lent sur une table importante </p>
      <p><strong>ajaxautosearchminlength</strong> : l'appel est manuel quand le filtre a moins de x caract&egrave;res et est automatique au dessus, cet attribut est pratique pour les grandes tables </p>
      <p><strong>ajaxmodedebug</strong> : true / false, par l'ajout d'une icone on peut appeler la page qui retourne le fichier XML et v&eacute;rifier le contenu retourn&eacute; dans une fen&ecirc;tre d'alerte et ainsi v&eacute;rifier si une erreur de syntaxe ne vient pas fausser la structure du fichier XML </p>
      <p>&nbsp; </p>
      <p><a href="sample05_listes_cascade.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      <p><a name="listescascade" id="listescascade"></a>cas particulier de l'objet <strong>frm_ObjetListesCascade</strong> : </p>
      <p><img src="image46_listescascades.gif" width="325" height="321" border="2"></p>
      <p> L'objet permet de g&eacute;rer de 2 &agrave; x listes en cascades, avec alimentation des listes en AJAX via un fichier XML <br>
      et dans 2 modes particuliers :</p>
      <ol>
        <li>normal : le mode par d&eacute;faut, pour valider l'objet il faut obligatoirement (si attribut &quot;R&quot; ) une value de la liste la plus basse.<br>
          <br>
        </li>
        <li>multi-niveau : le mode qui permet de  choisir au moins une valeur mais dans un niveau quelconque. Il sera utilis&eacute; pour r&eacute;aliser un filtre de recherche. <br> 
          <br>
        L'interpretation des valeurs en retour se fait comme suit : <br>
        Avec la d&eacute;claration du champ &quot;NOM_DU_CHAMP&quot;  sont retourn&eacute;s 2 variables $_POST : &quot;NOM_DU_CHAMP&quot; qui contient l'indice dans la table, et &quot;NOM_DU_CHAMP_LEVEL&quot; le nom du niveau pr&eacute;alablement d&eacute;fini <br>
        <br>
        ce mode est activable par la directive : <br>
        <strong>'multilevel'</strong> =&gt; true </li>
      </ol>
      <p><strong>ajax</strong> : le seul param&egrave;tre obligatoire, c'est le nom de l'URL qui retourne un XML, par d&eacute;faut le param&egrave;tre est pass&eacute; en POST et se nomme comme l'id. <br>
      Ici encore 2 modes d'appels : </p>
      <ol>
        <li>1 seule page PHP pour toutes les listes et on analyse la valeur du $_POST['ID'] pour ex&eacute;cuter le code qui retournera le bon XML.<br>
        </li>
        <li>1 page par liste,  permet de faire une page par liste, </li>
      </ol>
      <p><strong>list</strong> : le tableau de tableau qui contient tous les param&egrave;tres de chaque liste, de la forme </p>
      <p> <span class="exemples">'list' =&gt; array(</span></p>
      <blockquote>
        <p class="exemples"> array( 'id'     =&gt; 'REGION',<br>
  'title' =&gt; &quot;---choisir une r&eacute;gion---&quot;, <br>
  'width' =&gt; '150px' ),<br>
  <br>
  array( 'id'     =&gt; 'DEPT',<br>
  'title' =&gt; &quot;---choisir le d&eacute;partement---&quot;,<br>
  'width' =&gt; '200px' ),<br>
  <br>
  array( 'id'     =&gt; 'VILLE',<br>
  'title' =&gt; &quot;---choisir la ville---&quot;,<br>
  'width' =&gt; '300px' ),</p>
      </blockquote>
      <p><span class="exemples">        ),</span><br>
      </p>
      <p>&nbsp; </p>
      <p><strong>ajaxmodedebug</strong> : true / false, par l'ajout d'une icone on peut appeler la page qui retourne le fichier XML et v&eacute;rifier le contenu retourn&eacute; dans une fen&ecirc;tre d'alerte et ainsi v&eacute;rifier si une erreur de syntaxe ne vient pas fausser la structure du fichier XML </p>
      <p><strong>script</strong> : expression ex&eacute;cut&eacute;e a chaque changement d'&eacute;tat de l'objet, l'exemple <a href="sample05_listes_longues_script.php">sample05_listes_longues_script.php</a> permet par exemple d'activer un autre champ  quand la valeur saisie avec l'attribut &quot;addvalue&quot; n'est pas dans la liste.</p>
      <p><br>
<img src="image47_listescascades.gif" width="50" height="39" border="2"></p>
      <p>&quot;<strong>erase</strong>&quot; =&gt; true, permet en affichant la croix d'effacer tous les niveaux de liste. <br>
&quot;<strong>reset</strong>&quot; =&gt; true, permet pour cet objet de revenir &agrave; la valeur initiale. </p>
      <p>&quot;<strong>ajaxparams</strong>&quot; =&gt; array(</p>
      <blockquote>
        <p> 'FILTRE' =&gt; &quot;MM_findObj('FILTRE').value&quot;</p>
      </blockquote>
      <p>);</p>
      <p>permet d'envoyer au fichier appel&eacute; des param&egrave;tres suppl&eacute;mentaire en variable POST, on peut par exemple modifier les crit&egrave;res de recherche et de filtre en fonction de la valeur d'autres objets</p>
      <p><strong>On peut choisir de ne pas initialiser a la cr&eacute;ation de l'objet la liste racine : </strong>dans ce cas le dernier param&egrave;tre de l'objet est &eacute;gal &agrave; array() = liste vide</p>
      <p>il suffit ensuite d'interpreter dans la page appel&eacute;e la variable POST['ROOT'] ( voir exemple  sample05_listes_cascade7.php et la page appel&eacute;e sample05_listes_cascade_root_called.php ) </p>
      <p>on peut remplacer cette variable par d&eacute;faut en initialisant l'attribut 'root' =&gt; 'TITI' la page appel&eacute;e sample05_listes_cascade_root_called.php devra donc analyser cette valeur 'TITI' </p>
      <p>&nbsp;</p>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<blockquote><blockquote>
  <blockquote></blockquote>
    <h3><a name="champcoche" id="champcoche"></a>5.4) CHAMPS COCHES ET BOUTONS RADIO </h3>
    <p>2 fonctions permettent de manipuler des coches et des boutons radio pour activer au nom des champs li&eacute;s au choix </p>
    <blockquote>
      <p><strong>frm_ObjetCoche</strong> : case &agrave; cocher <br>
      </p>
      <p><strong>frm_ObjetBoutonsRadio</strong> : Boutons radios <br>
      </p>
    </blockquote>
    <p><strong class="exemples">Syntaxe :</strong></p>
  </blockquote>
  <blockquote>
    <table width="721" border="0" cellspacing="0">
      <tr>
        <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetCoche(&quot;DEPLACER&quot;, array( <br>
                <br>
                <br>
                <br>
                <br>
        </p></td>
        <td width="407"><p class="exemples"> &quot;label&quot; =&gt; &quot;Mobilit&eacute;&quot;, &quot;title&quot; =&gt; &quot;Un d&eacute;placement est n&eacute;cessaire&quot;,<br>
&quot;help&quot; =&gt; &quot;S&eacute;lectionner Si un d&eacute;placement est n&eacute;cessaire&quot;,<br>
&quot;default&quot; =&gt; &quot;0&quot;, <br>
&quot;activation&quot; =&gt; array(&quot;CHAMP1&quot;,&quot;CHAMP2&quot;,&quot;CHAMP3&quot;) )<br>
        );<br>
        <br>
&nbsp;<br>
        </p></td>
      </tr>
      <tr class="exemples">
        <td align="right" valign="top"> <div align="left">$f-&gt;frm_ObjetBoutonsRadio(&quot;BTNSRAD&quot;, array(</div></td>
        <td>&quot;label&quot; =&gt; &quot;Sexe&quot;,<br>
&quot;default&quot; =&gt; &quot;1&quot;,<br>
&quot;help&quot; =&gt; &quot;cocher Homme ou Femme pour choisir un pr&eacute;nom&quot;,<br>
&quot;activation&quot; =&gt; array(&quot;CHAMP1&quot;,&quot;CHAMP2&quot;) ),<br>
        $tableau1<br>
        );</td>
      </tr>
    </table>
    <p><strong>PARAMETRES COMMUNS </strong></p>
    <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
    <p><strong>default</strong> : valeur par d&eacute;faut (indice du tableau ou valeur quelconque possible pour la fonction frm_ObjetListeEditable()</p>
    <p><strong>help</strong> : bulle d'aide </p>
    <p><strong>activation</strong> =&gt; array(&quot;champ1&quot;,&quot;champ2&quot;,...) : permet d'activer un ou plusieurs champs par la case &agrave; cocher ou faire correspondre &agrave; une option du bouton radio un champ qui s'activera quand elle sera s&eacute;lectionn&eacute;e. On peut d&eacute;finir un tableau de tableau de champ (<a href="#RADIO_MULTICHAMPS">voir ci dessous</a>) <br>
      <br>
    <strong>noactivation</strong> =&gt; array(&quot;champ1&quot;,&quot;champ2&quot;,...) : permet de d&eacute;sactiver un ou plusieurs champs par la case &agrave; cocher ( un seul pour un bouton radio, plusieurs pour une coche) </p>
    <p>      <strong>SPECIFIQUE &quot;COCHE&quot; </strong></p>
    <p><strong>valueon, valueoff </strong> : par d&eacute;faut respectivement '0' et '1' mais on peut prendre 'O', 'N' ou n'importe quelle valeur </p>
    <p><br>
      <br>
      <strong>SPECIFIQUE &quot;BOUTON RADIO&quot; </strong></p>
    <p><strong>orientation</strong> : V pour vertical, H pour Horizontal
    </p>
    <blockquote>
        <p><img src="image08_coche_radio.gif" width="660" height="330" border="2"></p>
        <p><a href="sample07_coche_radio.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
        <p><a name="RADIO_MULTICHAMPS"></a>LES BOUTONS RADIOS GERENT DEPUIS LA VERSION 1.09 L'ACTIVATION DE 1 A n CHAMP PAR OPTION RADIO</p>
        <p>on d&eacute;finit un tableau de tableaux :</p>
        <p class="exemples">activation =&gt; array(&quot;champ1&quot;, array(&quot;champ2-1&quot;,&quot;champ2-2&quot;),&quot;champ 3&quot;,...) </p>
        <p><img src="image43_radiobtn_01.gif" width="333" height="525" border="2"></p>
        <p><a href="sample07_radio.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
        <h2><a href="sample07_coche_radio.php"></a></h2>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<blockquote>
  <blockquote>
    <h3><br>
      <a name="uploader" id="uploader"></a>5.5) UPLOADER DE FICHIER</h3>
    <blockquote>
      <p>L'utilisation du s&eacute;lecteur de fichier standard HTML a &eacute;t&eacute; int&eacute;gr&eacute; dans une fen&ecirc;tre POPUP pour ne pas planter tout le formulaire quand un probl&egrave;me survient (fichier trop gros pour le serveur et la page retourn&eacute;e par le serveur est une &quot;internal error&quot; )</p>
      <p><strong>L'objet fonctionne en mode simple fichier :</strong></p>
      <p>dans ce cas, La valeur de l'objet contient le nom physique du fichier sans son chemin (qui est connu puisqu'&eacute;gal &agrave; la valeur de &quot;target&quot; ) Le nom du fichier choisi par le s&eacute;lecteur peut &ecirc;tre pr&eacute;fix&eacute; d'un identifiant ( voir param&egrave;tre &quot;prefix&quot; ) </p>
      <p><img src="image41_uploader.gif" width="435" height="265" border="2"></p>
      <p><strong>...ou en mode &quot;multi-fichier&quot; :</strong></p>
      <p>dans ce cas, La valeur de l'objet contient les noms physique des fichiers sans leur chemin et s&eacute;par&eacute;s par des tabulations ( '\t' ) l'enregistrement dans une table d'une telle chaine doit &ecirc;tre faite dans un champ de type BLOB, TEXT ou bien manuellement dans plusieurs enregistrements d'une table en faisant une boucle sur chacun des fichiers </p>
      <p><img src="image42_uploader.gif" width="457" height="338"></p>
      <p>il offre en outre la possibilit&eacute; de faire une pr&eacute;visualisation des images, de faire des tris.</p>
      <p><strong>PARAMETRES OBLIGATOIRES </strong></p>
      <p><strong>url</strong> : c'est le nom de la page PHP qui g&egrave;re le chargement (voir syntaxe de cette <a href="#uploader_called">page ci-dessous</a>) </p>
      <p><strong>target</strong> : le chemin relatif ou <a href="#uploader_safemode">absolu</a> du r&eacute;pertoire qui recevra les fichiers t&eacute;l&eacute;charg&eacute;s c'est le seul param&egrave;tre obligatoire.<br>
      </p>
      <p><strong>PARAMETRES OPTIONNELS VISUELS</strong></p>
      <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
      <p><strong>default</strong> : valeur par d&eacute;faut, chaine qui contient le ou les noms de fichiers (quand il y en a plusieurs ils sont s&eacute;par&eacute;s par le param&egrave;tre TAB ('\t')<br>
      Cette valeur n'est pas utilisable a moins de v&eacute;rifier la pr&eacute;sence du fichier auquel elle fait r&eacute;f&eacute;rence. </p>
      <p><strong>help</strong> : bulle d'aide </p>
      <p><strong>width</strong> : largeur du champ texte ou de la liste en pixels </p>
      <p><strong>size</strong> : nombre de lignes de la liste ( en mode multi-fichiers ) </p>
      <p><strong>PARAMETRES OPTIONNELS MAIS MODIFIANT LE COMPORTEMENT DU TELECHARGEMENT </strong></p>
      <p><strong>attrib</strong> : vide ou 'R' pour rendre le choix d'un fichier obligatoire </p>
      <p><strong>overwrite</strong> : true ou false pour permettre ou non le t&eacute;l&eacute;chargement d'un fichier qui existe d&eacute;j&agrave;</p>
      <p><strong>preview</strong> : true ou false, permet de pr&eacute;visualiser les fichiers qui viennent d'&ecirc;tre t&eacute;l&eacute;charg&eacute;s. </p>
      <p><strong>prefix</strong> :  il peut &ecirc;tre int&eacute;ressant dans un contexte multi-utilisateurs de pr&eacute;fixer les fichiers par l'identifiant de l'utilisateur par exemple. On &eacute;vite alors des &eacute;crasements de fichiers et on cloisonne les t&eacute;l&eacute;chargements quitte &agrave; les doublonner.</p>
      <p><strong>multifiles</strong> : true ou false pour permettre le t&eacute;l&eacute;chargement d'un fichier ou plusieurs fichiers</p>
      <p><strong></strong><strong>multifilesmax</strong> : nombre maximum de fichiers autoris&eacute;s &agrave;  t&eacute;l&eacute;charger. ( -1 = pas de limite ) </p>
      <p>&nbsp;</p>
      <p><strong>PARAMETRES DE REDIMENSIONNEMENT D'IMAGES</strong></p>
      <p><strong>resize_to</strong> : d&eacute;finition de la taille en pixels du bord le plus long de l'image </p>
      <p><strong>resize_x_to</strong> : d&eacute;finition de la largeur en pixels de l'image </p>
      <p><strong></strong><strong>resize_y_to</strong> : d&eacute;finition de la hauteur en pixels de l'image </p>
      <p><strong>2 cas possibles :</strong></p>
      <ul>
        <li>le fichier image original est redimensionn&eacute; directement<br>
          <br>
        </li>
        <li>le fichier original est charg&eacute; sur le site mais n'est pas modifi&eacute;, une vignette est cr&eacute;&eacute;e simultan&eacute;ment avec les dimensions sp&eacute;cifi&eacute;es <br>
          <br>
        <strong>resize_prefix</strong> : d&eacute;finition du pr&eacute;fixe qui sera ajout&eacute; au fichier d'origine pour constituer la vignette. </li>
      </ul>
      <p><strong></strong></p>
      <p><br>
        <a href="#UPLOAD">voir la description complete du m&eacute;canisme d'upload </a></p>
      <p><img src="loading.gif" width="107" height="13"></p>
      <p><strong class="exemples">Syntaxe :</strong></p>
    </blockquote>
  </blockquote>
  <blockquote>
    <blockquote>
      <table width="721" border="0" cellspacing="0">
        <tr>
          <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetUploader(&quot;SelectFichier&quot;, <br>
          </p></td>
          <td width="407"><p class="exemples"> array( <br>
 &quot;label&quot; =&gt; &quot;Selecteur de fichier&quot;, <br>
 &quot;help&quot; =&gt; &quot;S&eacute;lectionner un fichier&quot;,<br>
 &quot;attrib&quot; =&gt; &quot;R&quot;,
           <br>
&quot;width&quot; =&gt; &quot;400px&quot;,<br>
....<br>
) <br>
          );<br>
          <br>
          </p></td>
        </tr>
      </table>
      <p><strong><a name="uploader_called"></a>Syntaxe de la page appel&eacute;e :</strong></p>
      <p class="exemples">&lt;?php</p>
      <blockquote>
        <p class="exemples">        // session_start(); si les autres pages utilisent les sessions r&eacute;ctiver cette ligne</p>
        <p class="exemples"> <br>
          include('classeForms.php'); </p>
        <p class="exemples"> $f = New Forms;<br>
          $f-&gt;frm_uploader( array(	</p>
        <blockquote>
          <p class="exemples"><strong>'target'</strong>=&gt;'../../../rubappli/tmp/',<br>
            'maxfilesize'=&gt;2048*1024,<br>
            'delete'=&gt;false</p>
        </blockquote>
        <p class="exemples">          ) );</p>
      </blockquote>
      <p class="exemples">        ?&gt;</p>
      <p>Aucun code HTML n'est requis  les param&egrave;tres de la fonction <strong>frm_uploader()</strong> sont : </p>
      <p><strong>OBLIGATOIRE : </strong></p>
      <p><strong>target</strong> : le chemin relatif du r&eacute;pertoire qui recevra les fichiers t&eacute;l&eacute;charg&eacute;s par rapport &agrave; la page qui contient cette fonction. <strong>C'est le seul param&egrave;tre obligatoire</strong>. Il n'est pas pass&eacute; en param&egrave;tre GET comme les autres par la fen&ecirc;tre principal qui contient le formulaire pour raison de s&eacute;curit&eacute; </p>
      <p><strong>OPTIONNELS : </strong></p>
      <p><strong>extensions</strong> : liste des extensions autoris&eacute;es s&eacute;par&eacute;es par le caract&egrave;re &quot;|&quot; par d&eacute;faut &quot;GIF|PNG|JPG|JPEG&quot; seuls les images sont autoris&eacute;es. La syntaxe doit &ecirc;tre pr&eacute;cise car la chaine est utilis&eacute;e par des expressions r&eacute;guli&egrave;res de contr&ocirc;le. </p>
      <p><strong>maxfilesize</strong> : taille maximum en octets, 2*1024*1024 &lt;=&gt; 2Mo  </p>
      <p><strong>opener</strong> : nom de la page autoris&eacute;e &agrave; appeler cette page, par d&eacute;faut seules les pages du m&ecirc;me r&eacute;pertoire que la page appel&eacute;e sont autoris&eacute;es </p>
      <p><strong>title</strong> : titre de la fen&ecirc;tre, par d&eacute;faut <em>&quot;S&eacute;lectionnez un fichier&quot;</em></p>
      <p><strong>space</strong> : 'caract&egrave;re' dans les noms de fichier les espaces sont remplac&eacute;s par un caract&egrave;re sp&eacute;cifique. Cette fonction permet d'&eacute;viter que les noms de fichiers soient vus sous IE comme &quot;Nom%20de%20fichier&quot;. Le caract&egrave;re le mieux adapt&eacute; est '_'.<br>
        Une chaine vide supprime tous les blancs </p>
      <p><strong>filter</strong> : true / false filtrage des caract&egrave;res sp&eacute;ciaux, par d&eacute;faut cette option est &agrave; &quot;true&quot;. <br>
        <br>
        &quot;&Agrave;&Aacute;&Acirc;&Atilde;&Auml;&Aring;&agrave;&aacute;&acirc;&atilde;&auml;&aring;&Ograve;&Oacute;&Ocirc;&Otilde;&Ouml;&Oslash;&ograve;&oacute;&ocirc;&otilde;&ouml;&oslash;&Egrave;&Eacute;&Ecirc;&Euml;&euro;&egrave;&eacute;&ecirc;&euml;&Ccedil;&ccedil;&Igrave;&Iacute;&Icirc;&Iuml;&igrave;&iacute;&icirc;&iuml;&Ugrave;&Uacute;&Ucirc;&Uuml;&ugrave;&uacute;&ucirc;&uuml;&yuml;&Ntilde;&ntilde;&quot;<br>
        <br>
        qui sont remplac&eacute;s par les caract&egrave;res suivants : <br>
        <br>
&quot;AAAAAAaaaaaaOOOOOOooooooEEEEEeeeeCcIIIIiiiiUUUUuuuuyNn&quot; <em></em></p>
      <p><strong></strong></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><a href="sample43_uploader_simple.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
      <p><a name="uploader_safemode"></a><span class="style4"><strong>NOTA : Les chemins absolus ne sont pas autoris&eacute;s par les serveurs en &quot;safe mode&quot;. C'est le cas des serveurs des fournisseurs d'acc&egrave;s </strong></span></p>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <h3><a name="champslider" id="champslider"></a>5.6) CHAMP &quot;SLIDER&quot; </h3>
    <blockquote>
      <p>L'utilisation du slider permet une saisie simplifi&eacute;e et graphique de nombre entier compris dans un intervalle donn&eacute; </p>
      <p><strong>width</strong> : c'est la largeur total du bloc graphique en pixels.</p>
      <p><strong>size</strong> : C'est la largeur du champ texte en nombre de caract&egrave;res </p>
      <p><strong></strong></p>
      <p><img src="image19_sliders.gif" width="380" height="375" border="2"></p>
      <p><span class="exemples"><strong>Syntaxe :</strong></span></p>
    </blockquote>
  </blockquote>
  <blockquote>
    <blockquote>
      <table width="721" border="0" cellspacing="0">
        <tr>
          <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetSlider(&quot;Slider01&quot;, <br>
          </p></td>
          <td width="407"><p class="exemples">array(&quot;label&quot; =&gt; &quot;Nombre de colonnes &quot;, <br>
&quot;orientation&quot; =&gt; &quot;H&quot;,<br>
&quot;width&quot; =&gt; &quot;80px&quot;,<br>
&quot;mini&quot;=&gt; &quot;1&quot;,<br>
&quot;maxi&quot;=&gt;&quot;3&quot;,<br>
&quot;default&quot; =&gt; &quot;2&quot;,<br>
&quot;size&quot; =&gt; &quot;5&quot;, <br>
&quot;help&quot; =&gt; &quot;choisir le nombre de colonnes (1,2 ou 3)&quot;)<br>
            );<br>
            <br>
              </p>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="exemples">$f-&gt;frm_ObjetSlider(&quot;Slider02&quot;, </span></td>
          <td width="407"><p class="exemples">array(&quot;label&quot; =&gt; &quot;Nombre de lignes &quot;, <br>
&quot;orientation&quot; =&gt; &quot;V&quot;,<br>
&quot;height&quot; =&gt; &quot;120px&quot;,<br>
&quot;mini&quot;=&gt; &quot;1&quot;,<br>
&quot;maxi&quot;=&gt;&quot;10&quot;,<br>
&quot;default&quot; =&gt; &quot;8&quot;,<br>
&quot;help&quot; =&gt; &quot;choisir le nombre de lignes (1 &agrave; 10)&quot;)<br>
              );<br>
          </p></td>
        </tr>
      </table>
      <p><a href="sample13_sliders.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<blockquote>
  <blockquote>
    <h3><a name="champtextepopup" id="champtextepopup"></a>5.7) CHAMP &quot;TEXTE ET POPUP &quot; </h3>
    <blockquote>
      <p>L'utilisation des champs &quot;Texte et popup&quot; permet de faire appel via une fen&ecirc;tre POPUP a une liste puis en choisissant une valeur le champ est automatiquement mise &agrave; jour. L'avantage est dans l'usage de listes longues qui ne sont form&eacute;es que quand c'est n&eacute;cessaire.</p>
      <p>Une URL est d&eacute;finie c'est elle qui est appel&eacute;e quand on presse sur le bouton <img src="image27_petitbouton.gif" width="22" height="23">.</p>
      <p>Cette URL est soit une fen&ecirc;tre en HTML (il faut dans ce cas tout g&eacute;rer, le retour des valeurs compris ) soit une page PHP qui en 10 lignes g&egrave;re tout (<a href="#popuppageappelee">voir syntaxe de la page appel&eacute;e</a>) </p>
      <p><strong>PARAMETRES GENERAUX </strong></p>
      <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
      <p><strong>attrib</strong> : tous les attributs des champs texte ( R, U, +, -, I ...)</p>
      <p><strong>url</strong> : nom de la page appel&eacute;e sans aucun param&egrave;tre GET </p>
      <blockquote>
        <p><span class="exemples">&quot;url&quot; =&gt; &quot;sample19_popup_called.php&quot;,</span> </p>
      </blockquote>
      <p><strong>width</strong> : largeur du champ texte </p>
      <p><strong>return</strong> : d&eacute;finit le mode de retour des valeurs (2 cas) </p>
      <blockquote>
        <p><strong>&quot;id&quot;</strong> : le champ est compos&eacute; de 2 champs, un est cach&eacute; &quot;la clef&quot; l'autre visible &quot;la valeur&quot;. Il permet de g&eacute;rer la paire &quot;clef / valeur&quot; d'une liste HTML </p>
        <p class="exemples">&lt;option value=&quot;clef&quot;&gt;la valeur affich&eacute;e&lt;/option&gt;</p>
        <p><strong>&quot;value&quot;</strong> : le champ est unique,  il permet une saisie assist&eacute;e depuis une liste d'&eacute;l&eacute;ment mais aussi une saisie libre </p>
      </blockquote>
      <p><strong>default</strong> : valeur par d&eacute;faut = indice du tableau ( &quot;return&quot; =&gt; &quot;id&quot; ) ou valeur affich&eacute;e ( &quot;return&quot; =&gt; &quot;value&quot; )</p>
      <p><strong>defaultview</strong> : valeur par d&eacute;faut affich&eacute;e dans le champ visible ( &quot;return&quot; =&gt; &quot;id&quot; ) </p>
      <p><strong>help</strong> : bulle d'aide </p>
      <p>&nbsp;</p>
      <p><strong>PARAMETRES DE MISE EN FORME DE LA FENETRE APPELEE</strong></p>
      <p><strong>winwidth, winheight</strong> : largeur et hauteur de la fenetre en pixels (implicitement la largeur de la page correspond &agrave; celle du champ </p>
      <p><strong>rows :</strong> hauteur de la liste en nombre de lignes, la liste est centr&eacute;e automatiquement</p>
      <p><strong> param :</strong> pour permettre un comportement diff&eacute;rent de la fen&ecirc;tre en fonction de la valeur d'un autre champ, ce param&egrave;tre prend le nom d'un autre champ. </p>
      <blockquote>
        <p class="exemples"><strong>exemple ci dessous</strong> : une liste de villes permet un pr&eacute;-choix. Quand on appelle la fen&ecirc;tre, celle ci recoit en param&egrave;tre la valeur de la clef de la ville on peut faire une requ&ecirc;te en fonction pour filtrer les valeurs qui lui correspondent.</p>
        <p class="exemples">dans l'exemple ci-dessous, PARAM=1</p>
      </blockquote>
      <p><img src="image26_touslespopup.gif" width="490" height="556" border="2"></p>
      <p><span class="exemples"><strong>Syntaxe :</strong></span></p>
    </blockquote>
  </blockquote>
  <blockquote>
    <blockquote>
      <table width="721" border="0" cellspacing="0">
        <tr>
          <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetChampPopup(&quot;NOMPOPUP&quot;, <br>
          </p></td>
          <td width="407"><p class="exemples">array( &quot;label&quot; =&gt; &quot;POPUP (avec retour id+valeur)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;U&quot;,<br>
&quot;width&quot; =&gt; &quot;200px&quot;,<br>
&quot;url&quot; =&gt; &quot;sample19_popup_called.php&quot;,<br>
&quot;return&quot; =&gt; &quot;id&quot;,<br>
&quot;default&quot; =&gt; &quot;10&quot;,<br>
&quot;defaultview&quot; =&gt; &quot;SIVOM&quot;,<br>
&quot;winwidth&quot; =&gt; &quot;240&quot;,<br>
&quot;winheight&quot; =&gt; &quot;240&quot;,<br>
&quot;rows&quot; =&gt; &quot;10&quot; ) <br>
);<br>
              <br>
          </p></td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="exemples">$f-&gt;frm_ObjetChampPopup(&quot;NOMPOPUPMINI&quot;,</span></td>
          <td width="407"><p class="exemples">  array( &quot;label&quot; =&gt; &quot;POPUP (taille automatique)&quot;,<br>

&quot;width&quot; =&gt; &quot;250px&quot;,<br>
&quot;url&quot; =&gt; &quot;sample19_popup_called.php&quot;,<br>
&quot;return&quot; =&gt; &quot;id&quot; )<br>
); <br>
          </p></td>
        </tr>
      </table>
      <h3><a name="popuppageappelee"></a>PAGE APPELEE</h3>
      <p>La page appel&eacute;e est constitu&eacute;e de code <span class="style7">javascript</span> et de <span class="style4">php</span>. On peut simplifier son codage par l'emploi de la fonction <span class="style5">$f-&gt;frm_popup_called</span></p>
      <p><strong>param&egrave;tre n&deg;=1</strong> : La fonction sait g&eacute;rer 2 type de tableau : les tableaux javascript &agrave; 2 dimensions et les tableaux PHP.</p>
      <blockquote>
        <p>Dans le cas d'un<strong> tableau javascript,</strong> on passe en chaine 'le nom de la table' &agrave; 2 dimensions qui contient les donn&eacute;es. </p>
        <p>Ce tableau peut &ecirc;tre g&eacute;n&eacute;r&eacute; par une fonction PHP qui ex&eacute;cute une requ&ecirc;te sur une base de donn&eacute;es ( voir la fonction de la classe classeBases :<br>
          $base-&gt;bdd_tableversarrayjs();          <br>
        <br>
          <span class="exemples style6">var <strong>myData1</strong> = [<br>
          [&quot;12&quot;,&quot;Action scolaire&quot;],<br>
          [&quot;22&quot;,&quot;Action Sociale&quot;],<br>
  ...<br>
  [&quot;24&quot;,&quot;Urbanisme&quot;]<br>
  ];</span> </p>
        <p>Dans le cas d'un<strong> tableau php,</strong> on passe en param&egrave;tre le  tableau &agrave; 2 dimensions qui contient les donn&eacute;es. </p>
        <p>Ce tableau peut &ecirc;tre g&eacute;n&eacute;r&eacute; par une fonction PHP qui ex&eacute;cute une requ&ecirc;te sur une base de donn&eacute;es ( voir la fonction de la classe classeBases :<br>
  $tableservices = $base-&gt;bdd_tableversliste()<br>
<br>
  <br>
  <span class="exemples style4">$tableservice<strong></strong> = array( &quot;12&quot; =&gt;,&quot;Action scolaire&quot;,<br>
  &quot;22&quot; =&gt; &quot;Action Sociale&quot;,<br>
  ...<br>
  &quot;24&quot; =&gt; &quot;Urbanisme&quot;);</span></p>
      </blockquote>
      <p><strong>param&egrave;tre n&deg;=2 (optionnel</strong>) : nom de la fonction javascript qui est appel&eacute;e quand la valeur s&eacute;lectionn&eacute;e est chang&eacute;e. On peut modifier l'&eacute;tat d'objet de la fen&ecirc;tre appelante par la fonction javascript :</p>
      <p class="exemples">window.opener.document.forms[params['FORMULAIRE']].elements['CHAMP_A_MODIFIER].value = 'xxx';</p>
      <p align="center">ou bien </p>
      <p class="exemples">window.opener.document.forms[params['FORMULAIRE']].elements['CHAMP_A_MODIFIER].disabled=true;</p>
      <p><strong>param&egrave;tre n&deg;=3 (optionnel</strong>) : afficher ou non les boutons &quot;OK&quot;, &quot;VALIDER&quot;, &quot;EFFACER&quot; (true ou false) par d&eacute;faut ils sont affich&eacute;s.<br>
        &quot;EFFACER&quot; permet d'&eacute;ffacer completement le champ sinon c'est impossible autrement </p>
      <p><strong>param&egrave;tre n&deg;=4 (optionnel</strong>) : Tous les valeurs sont strictement num&eacute;rique, toutes les autres lignes qui ont une valeur non num&eacute;rique ne sont pas s&eacute;lectionnables </p>
      <p>PAR DEFAUT TOUTES LES VALEURS DOIVENT ETRE NUMERIQUES <br> 
      </p>
      <p>Cette astuce permet de cr&eacute;er dans la liste des s&eacute;parateurs qui sont inertes (les lignes de s&eacute;paration et blanche.</p>
      <p class="exemples"></p>
      <p><img src="image28_popup_called.gif" width="262" height="208"></p>
      <p>&nbsp; </p>
      <p class="style4">&lt;?php</p>
      <blockquote>
        <p class="style4">$tablearticles = array();<br>
          $tablearticles<strong>['A0']</strong> = &quot;------ AGENT ---------------------------------&quot;;<br>
          if (empty($tableart_agent)) {<br>
          $tablearticles<strong>['A1']</strong> = &quot; L'agent n'a pas d'article !&quot;;<br>
          } else {<br>
          foreach ( $tableart_agent as $valeur =&gt; $libelle) $tablearticles[$valeur] = $libelle;<br>
          }<br>
          $tablearticles<strong>['S0']</strong> = &quot;&quot;; <br>
          $tablearticles<strong>['S1'] </strong>= &quot;------ SERVICE ---------------------------------&quot;;<br>
          if (empty($tableart_service)) {<br>
          $tablearticles<strong>['S2']</strong> = &quot; Le service de l'agent n'a pas d'article !&quot;;<br>
          } else {<br>
          foreach ( $tableart_service as $valeur =&gt; $libelle) $tablearticles[$valeur] = $libelle;<br>
          }<br>
          <br>
          $tablearticles<strong>['T0']</strong> = &quot;&quot;;<br>
          $tablearticles<strong>['T1']</strong> = &quot;------ TOUS LES ARTICLES ---------------------------------&quot;;<br>
          foreach ( $tableart_tous as $valeur =&gt; $libelle) $tablearticles[$valeur] = $libelle;<br>
        </p>
      </blockquote>
      <p class="style4">?&gt; </p>
      <p>Dans l'exemple ci dessous on concat&egrave;ne 3 tableaux et on ins&egrave;re entre chaque des s&eacute;parateurs inertes dans la valeur est ALPHABETIQUE </p>
      <p>&nbsp;</p>
      <p><span class="exemples"><strong>Syntaxe d'une page appel&eacute;e :</strong></span></p>
      <table width="100%"  border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#FFFFCC">
          <td width="54%" valign="top">CODE AVEC TABLEAU JAVASCRIPT </td>
          <td width="46%" valign="top">CODE AVEC TABLEAU PHP </td>
        </tr>
        <tr>
          <td valign="top"><p class="exemples">&lt;HTML&gt;<br>
  ...<br>
&lt;BODY&gt; <br>
          </p>
            <p class="exemples style6">&lt;SCRIPT language=&quot;javascript&quot;&gt;<br>
                <br>
  var <strong>myData1</strong> = [<br>
  [&quot;12&quot;,&quot;Action scolaire&quot;],<br>
  [&quot;22&quot;,&quot;Action Sociale&quot;],<br>
  ...<br>
  [&quot;24&quot;,&quot;Urbanisme&quot;]<br>
  ];<br>
  <br>
  function <strong>externe()</strong> {<br>
  alert('appel a une fonction externe !');<br>
  }<br>
  <br>
&lt;/SCRIPT&gt; </p>
            <p class="exemples style4">&lt;?php</p>
            <blockquote>
              <p class="style5"> include('classeForms.php'); <br>
    $f = New Forms;<br>
    <br>
    $f-&gt;frm_Init();<br>
    $f-&gt;frm_popup_called('<strong>myData1</strong>','<strong>externe()</strong>');</p>
            </blockquote>
            <p class="exemples"><span class="style4">?&gt;</span><br>
&lt;/body&gt;<br>
&lt;/html&gt;</p></td>
          <td valign="top"><p class="exemples">&lt;HTML&gt;<br>
...<br>
&lt;BODY&gt; <br>
<span class="style4">&lt;?php</span></p>
            <blockquote>
              <p class="style4"> $myData = array( &quot;12&quot;=&gt;&quot;Action scolaire&quot;,<br>
&quot;22&quot;=&gt;&quot;Action Sociale&quot;,<br>
&quot;26&quot;=&gt;&quot;B&acirc;timents&quot;,<br>
&quot;19&quot;=&gt;&quot;Biblioth&egrave;que&quot;,<br> 
    ...
    <br>
&quot;10&quot;=&gt;&quot;SIVOM&quot;,<br>
&quot;15&quot;=&gt;&quot;Sports&quot;,<br>
&quot;24&quot;=&gt;&quot;Urbanisme&quot;<br>
      );</p>
              <p class="style4"> include('classeForms.php'); <br>
      $f = New Forms;<br>
      <br>
      $f-&gt;frm_Init();<br>
      $f-&gt;frm_popup_called($myData);</p>
            </blockquote>
            <p class="style4"><br>
              ?&gt; <span class="exemples"><br>
&lt;/body&gt;<br>
&lt;/html&gt;</span></p></td>
        </tr>
        <tr bgcolor="#FFFFCC">
          <td colspan="2" valign="top"><div align="center">FONCTION DE LA CLASSE PHP &quot;classeBases&quot; POUR GENERER UN TABLEAU </div></td>
        </tr>
        <tr>
          <td valign="top"><span class="style4">$base-&gt;bdd_connecter_base(&quot;svpinfo&quot;);<br>
              <br>
$requete = &quot;SELECT * FROM article,Modele ORDER BY art_numinv&quot;;<br>
<br>
$base-&gt;bdd_execsql($requete); <br>
$base-&gt;bdd_tableversarrayjs( array(&quot;art_id&quot;,&quot;art_numinv&quot;,&quot;mod_nom&quot;),&quot;NomTableauJS&quot; ); <br>
}</span></td>
          <td valign="top"><span class="style4"> $base-&gt;bdd_connecter_base(&quot;svpinfo&quot;);<br>
            <br>
$requete = &quot;SELECT * FROM article,Modele  ORDER BY art_numinv&quot;;<br>
<br>
$base-&gt;bdd_execsql($requete); <br>
$tableservices = $base-&gt;bdd_tableversliste( array(&quot;art_id&quot;,&quot;art_numinv&quot;,&quot;mod_nom&quot;) ); <br>
}</span></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <blockquote>
        <blockquote>
          <p></p>
        </blockquote>
      </blockquote>
      <p><a href="sample19_popup.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </blockquote>
</blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="champtree" id="champtree"></a>5.8) CHAMP &quot;ARBRE HIERARCHIQUE &quot; </h3>
      <blockquote>
        <p>L'utilisation des champs arbres permet de choisir une valeur dans un arbre </p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
        <p><strong>attrib</strong> : les 2 attributs qui restent ( R, + ) sont &quot;obligatoire&quot; et &quot;lecture seule&quot;</p>
        <p><strong>width</strong> : largeur du champ </p>
        <p><strong>height</strong> : hauteur du champ </p>
        <p><strong>default</strong> : valeur par d&eacute;faut = indice du noeud dans le tableau </p>
        <p><strong>lines</strong> : fait apparaitre les lignes ou non ( true | false ) </p>
        <p><strong>rootselector</strong> : la racine de l'arbre est s&eacute;lectionnable ( &quot;true&quot; si oui )</p>
        <p><strong>iconroot</strong> : nom complet (chemin inclus) de l'image de l'icone qui symbolise la racine de l'arbre </p>
        <p><strong>icondirclosed, icondiropened </strong> : nom de complet de l'image de l'icone qui symbolise un dossier ouvert ou ferm&eacute; </p>
        <p></p>
        <p></p>
        <p><br>
          <strong>$tableauTree : est le tableau de tableau de valeurs avec 3 champs :</strong></p>
        <ul>
          <li><strong>L'indice de l'enregistrement</strong></li>
          <li><strong>Le titre du noeud</strong></li>
          <li><strong>l'indice p&egrave;re ( -1 si racine de l'arbre ) </strong></li>
        </ul>
        <p><span class="exemples"><strong>Syntaxe :</strong></span></p>
      </blockquote>
    </blockquote>
    <blockquote>
      <blockquote>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td align="left" valign="top"><span class="style9">$tableauTree = </span></td>
            <td width="407"><p class="exemples"> array( </p>
                <blockquote>
                  <p class="exemples">array(&quot;0&quot;,&quot;France (0)&quot;,-1), <br>
          array(&quot;1&quot;,&quot;Paris (1)&quot;,0),<br>
          array(&quot;2&quot;,&quot;Marseille (2)&quot;,0),<br>
          array(&quot;3&quot;,&quot;Lyon (3)&quot;,0),<br>
          array(&quot;4&quot;,&quot;Place de la Concorde (4)&quot;,1),<br>
          array(&quot;5&quot;,&quot;Montmartre (5)&quot;,1),<br>
          array(&quot;6&quot;,&quot;Vieux port (6)&quot;,2),<br>
          array(&quot;7&quot;,&quot;Notre Dame de la Garde (7)&quot;,2),<br>
          array(&quot;8&quot;,&quot;Place Bellecourt (8)&quot;,3),<br>
          array(&quot;9&quot;,&quot;La croix rousse (9)&quot;,3),<br>
          array(&quot;10&quot;,&quot;Invalides (10)&quot;,1),<br>
          array(&quot;11&quot;,&quot;Sacr&eacute; Coeur (11)&quot;,5),<br>
          array(&quot;12&quot;,&quot;La place du tertre (12)&quot;,5),<br>
          array(&quot;13&quot;,&quot;Trifouilly (13)&quot;,0),</p>
                </blockquote>
                <p class="exemples"> );<br>
              </p></td>
          </tr>
        </table>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td align="right" valign="top">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="310" align="right" valign="top"><p align="left" class="exemples">     $f-&gt;frm_ObjetChampArbre(&quot;FEUILLE1&quot;,<br>
            </p></td>
            <td width="407"><p class="exemples"> array( &quot;label&quot; =&gt; &quot;Arbre n&deg;=1 (defaut=5)&quot;,<br>
&quot;attrib&quot; =&gt; &quot;&quot;,<br>
&quot;width&quot; =&gt; &quot;300px&quot;,<br>
&quot;height&quot; =&gt; &quot;150px&quot;,<br>
&quot;default&quot; =&gt; &quot;5&quot;,<br>
&quot;lines&quot; =&gt; &quot;false&quot;,
<br>
&quot;title&quot; =&gt; &quot;Nom de l'arbre&quot;<br>
),<br>
<strong>$tableauTree</strong><br>
);<br>
              <br>
            </p></td>
          </tr>
          <tr>
            <td align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetChampArbre(&quot;FEUILLE2&quot;,<br>
            </p></td>
            <td><p class="exemples"> array( &quot;label&quot; =&gt; &quot;Arbre n&deg;=3 (defaut=4) LECTURE SEULE&quot;,<br>
&quot;attrib&quot; =&gt; <strong>&quot;+&quot;</strong>,<br>
&quot;width&quot; =&gt; &quot;300px&quot;,<br>
&quot;height&quot; =&gt; &quot;150px&quot;,<br>
&quot;default&quot; =&gt; &quot;4&quot;<br>
),<br>
<strong>$tableauTree</strong><br>
);<br>
            </p></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <table width="200" border="0">
          <tr valign="top">
            <td><p>Arbre n&deg;=1 : pas de ligne, non obligatoire </p>
              <p><img src="image29_tree_normal.gif" width="307" height="202"></p></td>
            <td><p>Arbre n&deg;=2 : lecture seulement</p>
              <p><img src="image30_tree_readonly.gif" width="305" height="167"></p></td>
          </tr>
          <tr valign="top">
            <td><p><br>
              Arbre n&deg;=3 : personnalisation des icones de l'arbre </p>
            <p><img src="image30_tree_customicons.gif" width="307" height="155"></p></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <p><a href="sample22_arbres.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
        <h3>&nbsp;</h3>
      </blockquote>
    </blockquote>
  </blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="champcolorpicker" id="champcolorpicker"></a>5.9) CHAMP &quot;SELECTEUR D'ICONES &quot; </h3>
      <blockquote>
        <p>L'utilisation du champ s&eacute;lecteur de couleur (de fond ou de textet) permet de choisir pr&eacute;cisement un couleur et retourne une chaine de 6 caract&egrave;res au format HEXADECIMAL.</p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
        <p><strong>attrib</strong> : les 2 attributs qui restent ( R, + ) sont &quot;obligatoire&quot; et &quot;lecture seule&quot;</p>
        <p><strong>width</strong> : largeur standard du champ [optionnel] </p>
        <p><strong>default</strong> : valeur par d&eacute;faut de la couleur de fond ou de texte [optionnel], par d&eacute;faut le fond est vide (blanc) le texte est noir.</p>
        <p><strong>target</strong> : choix de la couleur du texte &quot;<strong>TEXT</strong>&quot; ou du fond <strong>'BACKGROUND</strong>&quot;<br>
        </p>
        <p><span class="exemples"><strong>Syntaxe :</strong></span></p>
      </blockquote>
    </blockquote>
    <blockquote>
      <blockquote>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td width="407">&nbsp;</td>
          </tr>
        </table>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetColorPicker(&quot;LE_FOND&quot;,<br>
            </p></td>
            <td width="407"><p class="exemples"> array( &quot;label&quot; =&gt; &quot;Couleur du fond&quot;,<br>
&quot;help&quot; =&gt; &quot;Saisir une couleur pour le fond&quot;,<br>
&quot;default&quot; =&gt; &quot;3399CC&quot;,<br>
&quot;target&quot; =&gt; &quot;background&quot;)<br>
);<br>
<br>
              <br>
            </p></td>
          </tr>
          <tr>
            <td align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetColorPicker(&quot;LE_TEXT&quot;,<br>
            </p></td>
            <td><p class="exemples"> array( &quot;label&quot; =&gt; &quot;Couleur du texte&quot;,<br>
&quot;help&quot; =&gt; &quot;Saisir une couleur pour le texte&quot;,<br>
&quot;default&quot; =&gt; &quot;660033&quot;,<br>
&quot;target&quot; =&gt; &quot;text&quot;)<br>
);<br>
<br>
      <br>
      <br>
            </p></td>
          </tr>
        </table>
        <p><img src="image36_colorpicker1.gif" width="417" height="138" border="1"></p>
        <p><img src="image37_colorpicker2.gif" width="662" height="268"></p>
        <p class="exemples"><a href="sample31_colorpicker.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
        <h3>&nbsp;</h3>
      </blockquote>
    </blockquote>
  </blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="champtimer" id="champtimer"></a>5.10) CHAMP &quot;TIMER&quot; </h3>
      <blockquote>
        <p>L'utilisation d'un champ timer permet d'alimenter un champ TIMESTAMP de base de donn&eacute;es avec l'horloge du client. Pour g&eacute;rer l'horloge c&ocirc;t&eacute; serveur on le fera par programmation.</p>
        <p>Le format en retour peut &ecirc;tre SQL (AAAA/MM/JJ HH:MM:SS) ou fran&ccedil;ais (JJ/MM/AAAA HH:MM:SS)</p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p>&nbsp;  </p>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetTimer(&quot;MON_TIMER&quot;,<br>
            </p></td>
            <td width="407"><p class="exemples"> array(&quot;label&quot; =&gt; &quot;Horloge&quot;,<br>
&quot;width&quot; =&gt; &quot;70px&quot;,<br>
&quot;icon&quot; =&gt; true / false,<br>
&quot;format&quot; =&gt; &quot;french&quot; / &quot;iso&quot; <br>
)<br>
);<br>
        <br>
        <br>
            </p></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p><strong><img src="image35_timer.gif" width="416" height="146" border="2"></strong></p>
        <p><a href="sample29_timer.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      </blockquote>
    </blockquote>
  </blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="champtimer" id="champtimer"></a>5.11) CHAMP &quot;SELECTEUR DE COULEURS &quot; (ColorPicker)</h3>
      <blockquote>
        <p>L'utilisation d'un champ timer permet d'alimenter un champ TIMESTAMP de base de donn&eacute;es avec l'horloge du client. Pour g&eacute;rer l'horloge c&ocirc;t&eacute; serveur on le fera par programmation.</p>
        <p>Le format en retour peut &ecirc;tre SQL (AAAA/MM/JJ HH:MM:SS) ou fran&ccedil;ais (JJ/MM/AAAA HH:MM:SS)</p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p>&nbsp; </p>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td width="310" align="right" valign="top"><p align="left" class="exemples"> $f-&gt;frm_ObjetTimer(&quot;MON_TIMER&quot;,<br>
            </p></td>
            <td width="407"><p class="exemples"> array(&quot;label&quot; =&gt; &quot;Horloge&quot;,<br>
&quot;width&quot; =&gt; &quot;70px&quot;,<br>
&quot;icon&quot; =&gt; true / false,<br>
&quot;format&quot; =&gt; &quot;french&quot; / &quot;iso&quot; <br>
              )<br>
              );<br>
              <br>
              <br>
            </p></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p><strong><img src="image35_timer.gif" width="416" height="146" border="2"></strong></p>
        <p><a href="sample29_timer.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      </blockquote>
    </blockquote>
  </blockquote>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="sortselect" id="sortselect"></a>5.12) CHAMP &quot;LISTE A TRIER &quot; (SortSelect)</h3>
      <blockquote>
        <p>L'utilisation d'un champ SortSelect permet de trier une liste</p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
        <p><strong>width</strong> : largeur standard du champ [optionnel] </p>
        <p><strong>default</strong> : chaine qui comprend les indices du tableau tri&eacute; s&eacute;par&eacute;s par une virgule &quot;,&quot; </p>
        <p><strong>rows</strong> : nombre de lignes de la liste </p>
        <p><strong>help</strong> : Aide en ligne<br>
        </p>
        <p><strong>separators</strong> : si la chaine est &quot;true&quot; alors les s&eacute;parateurs sont autoris&eacute;s on peut alors ins&eacute;rer ou supprimer un s&eacute;parateur de lignes </p>
        <p><strong>separatorvalue</strong> : valeur dans la chaine &quot;ordre&quot; qui sera prise en compte pour signifier le s&eacute;p&eacute;rateur ( par d&eacute;faut = &quot;-&quot; le moins ) </p>
        <p><strong>separatortext</strong> : chaine de caract&egrave;re qui symbolisera visuellement le s&eacute;parateur  ( par d&eacute;faut une chaine plusieurs &quot;-&quot; ) </p>
        <table width="200" border="0">
  <tr valign="bottom">
    <td><p><img src="image38_sortselect.gif" width="225" height="87"></p>
      <p>Sans l'option &quot;<strong>separators</strong>&quot; </p></td>
    <td><p><img src="image39_sortselect.gif" width="226" height="137"></p>
      <p>Avec l'option &quot;<strong>separators</strong>&quot;</p></td>
  </tr>
</table>
</p>
        <table width="721" border="0" cellspacing="0">
          <tr>
            <td width="310" align="right" valign="top"><p align="left" class="exemples"> frm_ObjetSortSelect(&quot;LISTE_T2&quot;<br>
            </p></td>
            <td width="407"><p class="exemples"> array(<br>
&quot;label&quot; =&gt; &quot;Liste &agrave; trier&quot;,<br>
&quot;rows&quot; =&gt; &quot;10&quot;,<br>
&quot;separators&quot; =&gt; &quot;true&quot;,<br>
<em>&quot;separatorvalue&quot; =&gt; &quot;*&quot;,<br>
&quot;separatortext&quot; =&gt; &quot;___________________________&quot;,</em><br>
&quot;default&quot; =&gt; $def2,<br>
&quot;order&quot; =&gt; $ordre2,<br>
&quot;help&quot; =&gt; &quot;Trier la liste&quot;,<br>
&quot;width&quot; =&gt; &quot;100px&quot;),<br>
$tableau1<br>
);<br>
<br>
              <br>
              <br>
            </p></td>
          </tr>
          <tr>
            <td colspan="2" align="right" valign="top"> <div align="left">
              <p>avec le hash :</p>
              <p class="exemples">$tableau1 = array( &quot;1&quot; =&gt; &quot;1-Paris&quot;,&quot;2&quot; =&gt; &quot;2-Lyon&quot;,&quot;3&quot; =&gt; &quot;3-Marseille&quot;,&quot;4&quot; =&gt; &quot;4-Toulouse&quot;,&quot;5&quot; =&gt; &quot;5-Bordeaux&quot;,<br>
&quot;6&quot; =&gt; &quot;6-Nantes&quot; );</p>
            </div></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p><a href="sample37_sortselect.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      </blockquote>
    </blockquote>
  </blockquote>
  <p>&nbsp;</p>
  <hr>
  <blockquote>
    <blockquote>
      <h3><a name="multiliste" id="multiliste"></a>5.13) CHAMP &quot;LISTE A CHOIX MULTIPLE &quot; (MultiListe)</h3>
      <blockquote>
        <p>L'utilisation d'un champ MultiListe permet un choix de plusieurs &eacute;l&eacute;ments d'une liste l'objet poss&egrave;de nativement de nombreuses fonctions de controle de validit&eacute; de la saisie (bloc contigus, nombre maximum de choix...) </p>
        <p><img src="image40_multiselect.gif" width="149" height="125"></p>
        <p><strong>PARAMETRES GENERAUX </strong></p>
        <p><strong>attrib</strong> : 'R' pour obligatoire, une option au minimum doit &ecirc;tre choisie. </p>
        <p><strong></strong><strong>label</strong> : c'est le texte qui apparait dans la colonne des labels (mode affichage automatique) et quand une erreur de saisie est d&eacute;tect&eacute;e &agrave; la validation du formulaire.</p>
        <p><strong>width</strong> : largeur standard du champ [optionnel] </p>
        <p><strong>default</strong> : valeur des lignes s&eacute;lectionn&eacute;es s&eacute;par&eacute;s par une virgule &quot;,&quot; </p>
        <p><strong>rows</strong> : nombre de lignes de la liste, l'option <strong>'auto'</strong> ajuste la taille au nombre d'&eacute;l&eacute;ments </p>
        <p><strong>help</strong> : Aide en ligne</p>
        <p><strong>mode</strong> : mode d'actication des lignes : </p>
        <blockquote>
          <p><em>'normal'</em> c'est l'option par d&eacute;faut les s&eacute;lections ne sont pas cumul&eacute;es,</p>
          <p> <em>'save'</em> les s&eacute;lections sont cumulables mais peuvent &ecirc;tre annul&eacute;es en r&eacute;appuyant sur les lignes </p>
          <p><em>'append'</em> les s&eacute;lections sont cumulables mais ne peuvent peuvent &ecirc;tre annul&eacute;es quand r&eacute;appuyant sur les icones de la barre d'outils appel&eacute;e par l'option 'toolbar'</p>
          <p><a href="sample39_multiliste_normale.php"><img src="php_script_ico.png" width="32" height="32" border="0"></a></p>
        </blockquote>
        <p><br>
            <strong>toolbar</strong> : Affichage de la barre d'outils &quot;Tout S&eacute;lectionner&quot;, &quot;Annuler toutes les s&eacute;lection&quot; et &quot;Retour &agrave; la derni&egrave;re s&eacute;lection&quot; . Cette option est implicite dans le cas du mode 'append' </p>
        <p><strong></strong></p>
        <p><strong>modeblock</strong> : activation de mode &quot;bloc&quot; qui n'autorise que des blocs de valeurs continus. valeur : <em>true</em></p>
        <blockquote>
          <p><strong>modeblockrestore</strong> : quand cette condition n'est pas remplis on a 2 comportement possible : <em>true</em>, restauration de la derni&egrave;re s&eacute;lection valide ou <em>false</em>, la liste est effac&eacute;e. <br>
            <br>
          <strong>modeblockmessage</strong> : message qui est affich&eacute; </p>
          <p><a href="sample40_multiliste_blocs.php"><img src="php_script_ico.png" width="32" height="32" border="0"></a></p>
        </blockquote>
        <p><strong>limit </strong>: C'est le nombre maximum d'&eacute;l&eacute;ment que l'on peut s&eacute;lectionner</p>
        <blockquote>
          <p><strong>limitmessage</strong> : message qui est affich&eacute; quand le nombre est d&eacute;pass&eacute;</p>
        </blockquote>
        <p>&nbsp;</p>
        <p><strong></strong><strong>script</strong> : Pour un r&eacute;glage encore plus fin il est toujours possible de remplacer le script par d&eacute;faut par un script sp&eacute;cifique. Cette option n'est pas compatible avec 'toolbar' qui ex&eacute;cute pour chaque icone ses propres scripts ni avec l'option </p>
        <p><a href="sample42_multiliste_script.php"><img src="php_script_ico.png" width="32" height="32" border="0"></a></p>
        <p>Le script par d&eacute;faut est : ( le nom de l'objet javascript est le nom du champ pr&eacute;fix&eacute; de 'o' ) </p>
        <pre class="exemples" id="line334">if (oNOMCHAMP.MultiSelect_onChange()) { oNOMCHAMP.MultiSelect_SaveChange(); }</pre>
        <p>il suffit d'intercaler le script comme suit :</p>
        <blockquote>
          <pre class="exemples" id="line334">if (oNOMCHAMP.MultiSelect_onChange()) {
 <strong>
alert('Hello'); 
</strong>oNOMCHAMP.MultiSelect_SaveChange(); 

}

</pre>
        </blockquote>
        <p>Les fonctions suivantes sont disponibles dans les scripts:</p>
        <p> <span class="exemples">oNOMCHAMP.MultiSelect_RestoreOK()</span> : restaure la derni&egrave;re selection correcte. <br>
          <span class="exemples"><br>
        oNOMCHAMP.MultiSelect_InitAll(boolean)</span> : selectionne tous les objets ou le annule tous</p>
        <p><span class="exemples">oNOMCHAMP.MultiSelect_Reset()</span> : pour r&eacute;initialiser &agrave; la valeur d'origine les s&eacute;lections de la liste </p>
        <p><span class="exemples">oNOMCHAMP.MultiSelect_Counter()</span> : retourne le nombre d'options selectionn&eacute;es </p>
        <p></p>
        <p>&nbsp;  </p>
        <p><strong></strong></p>
      </blockquote>
    </blockquote>
  </blockquote>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <h3><a name="champcache" id="champcache"></a>5.20) CHAMP CACHE </h3>
    <blockquote>
      <p>L'utilisation du champ cach&eacute; permet de v&eacute;hiculer une variable et de la retourner en POST</p>
      <p><span class="exemples"><strong>Syntaxe :</strong></span>
      </p>
      <blockquote>
        <p>frm_ObjetChampCache(&quot;NOMDUCHAMP&quot;, &quot;VALEUR_PAR_DEFAUT&quot;); </p>
      </blockquote>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <h3><a name="onglets" id="onglets"></a>5.21) LES ONGLETS</h3>
    <blockquote>
      <p>L'utilisation des onglets permet de condenser sur une seule page sans bouger les ascenseurs, un nombre important de champs class&eacute;s et distribu&eacute;s logiquement. Dans le cas suivant, l'activation de la case &agrave; cocher active les champs d&eacute;pendants de cet objet mais aussi l'onglet du 1er champ de cette liste.</p>
      <p>2 fonctions permettent de manipuler les onglets :
      </p>
      <blockquote>
        <p><strong>frm_OngletDefinir</strong> : appel&eacute;e une seul fois avant la d&eacute;finition du 1er champ</p>
        <blockquote>
          <p>          <strong>width, height</strong> = dimension de l'onglet<br>
            <strong>space</strong> = largeur de tabulation entre le libelle et le champ lui-m&ecirc;me<br>
            <strong>default</strong> = &quot;Le nom de l'onglet&quot;          </p>
        </blockquote>
        <p>          <strong>frm_OngletNouveau</strong> : Appel&eacute;e au d&eacute;but de chaque onglet, la femeture de l'onglet est d&eacute;clench&eacute;e par l'appel &agrave; un nouvel onglet ou la fin du formulaire </p>
        <p><strong>frm_OngletDefaut</strong> : Appel&eacute;e apres la d&eacute;finition des onglets pour Modifier l'onglet qui sera affich&eacute; au chargement de la page, indiff&eacute;remment l'indice ou le nom de l'onglet ( le 1er &eacute;tant = 0) </p>
        <blockquote>
          <p>$f-&gt;frm_OngletDefinir(&quot;Adresse&quot;); ou <br>
          $f-&gt;frm_OngletDefinir(1); </p>
        </blockquote>
        <p><strong></strong></p>
      </blockquote>
      <p><strong class="exemples">Syntaxe :</strong>
      </p>
      <blockquote>
        <p>$f = New Forms;<br>
          $f-&gt;frm_Init(false,&quot;150px&quot;);</p>
        <p>$f-&gt;<strong>frm_OngletDefinir</strong>( array(&quot;width&quot; =&gt; &quot;550px&quot;, &quot;height&quot; =&gt; &quot;200px&quot;,&quot;default&quot; =&gt; &quot;Titulaire&quot; ) );</p>
        <p>$f-&gt;frm_ObjetChampTexte(&quot;CHAMP1&quot;, ... // ces 2 champs ne sont pas dans les onglets <br>
          $f-&gt;frm_ObjetChampTexte(&quot;CHAMP2&quot;, ...<br>
        </p>
        <p>$f-&gt;<strong>frm_OngletNouveau</strong>('Titulaire');
        </p>
        <blockquote>
          <p><span class="exemples"><br>
            $f-&gt;frm_ObjetChampTexte(&quot;NOM&quot;, ... <br>
            $f-&gt;frm_ObjetChampTexte(&quot;PRENOM&quot;, ...<br>
            $f-&gt;frm_ObjetChampTexte(&quot;DATEABON&quot;, ...<br>
            <br>
            $f-&gt;frm_ObjetCoche(&quot;ADRESSEABON&quot;,...</span>
          </p>
        </blockquote>
        <p> $f-&gt;<strong>frm_OngletNouveau</strong>('Adresse');
        </p>
        <blockquote>
          <p> $f-&gt;frm_ObjetChampTexte(&quot;NUMRUE&quot;, ...<br>
            $f-&gt;frm_ObjetChampTexte(&quot;NOMRUE&quot;, ... <br>
            $f-&gt;frm_ObjetChampTexte(&quot;CP&quot;, ...<br>
            $f-&gt;frm_ObjetChampTexte(&quot;VILLE&quot;, ...</p>
        </blockquote>
        <p>&nbsp;</p>
      </blockquote>
      <p><img src="image10_onglets.gif" width="574" height="528"></p>
      <p>En cas de validation du formulaire sans avoir saisi les champs obligatoires, on obtient une erreur sitant le nom de l'onglet et celui du champ incorrect.</p>
      <p><img src="image11_onglets_erreur.gif" width="441" height="224"></p>
      <p><a href="sample08_onglets.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <h3><a name="onglets" id="onglets"></a>5.22) LES SEPARATEURS DE PARAGRAPHES</h3>
    <blockquote>
      <p>L'utilisation des s&eacute;parateurs de paragraphes permet de condenser comme les onglets sur une seule page sans bouger les ascenseurs, un nombre important de champs class&eacute;s et distribu&eacute;s logiquement. </p>
      <p>2 fonctions permettent de manipuler les s&eacute;parateurs : </p>
      <blockquote>
        <p><strong>frm_EnteteDefinir</strong> : appel&eacute;e une seul fois avant la d&eacute;finition du 1er champ</p>
        <blockquote>
          <p> <strong>2 param&egrave;tres : </strong><br>
            <br>
              <strong>exclusif</strong> = ouverture exclusive des paragraphes (l'ouverture d'un par nouveau ferme automatiquement l'ancien paragraphe) <br>
              valeur : true / false<br>
            <br>
              <strong>sauvegarder l'&eacute;tat</strong> = sauvegarde par cookie de l'&eacute;tat des paragraphes <br>
          valeur : true / false</p>
        </blockquote>
        <p> <strong>frm_EnteteNouveau</strong> : Appel&eacute;e au d&eacute;but de chaque paragraphe, sa fermeture  est d&eacute;clench&eacute;e par la d&eacute;finition d'un nouveau paragraphe ou la fin du formulaire </p>
        <blockquote>
          <p><strong>2 param&egrave;tres : </strong><br>
              <br>
              <strong>titre</strong> = titre du paragraphe<br>
    valeur : chaine de caract&egrave;res<br>
    <br>
    <strong>Pr&eacute;-d&eacute;ploy&eacute;</strong> = d&eacute;ploiement automatique du paragraphe<br>
    valeur : true / false</p>
        </blockquote>
      </blockquote>
      <p><strong class="exemples">Syntaxe :</strong> </p>
      <blockquote>
        <p>$f = New Forms;<br>
          $f-&gt;frm_Init(false,&quot;150px&quot;);</p>
        <p> <strong>$f-&gt;frm_EnteteDefinir</strong>($modeexclusif,$sauveretat);</p>
        <p>$f-&gt;frm_ObjetChampTexte(&quot;CHAMP1&quot;, ... <br>
          $f-&gt;frm_ObjetChampTexte(&quot;CHAMP2&quot;, ...<br>
// ces 2 champs ne sont pas dans le 1er paragraphe        </p>
        <p>$f-&gt;<strong>frm_EntereNouveau</strong>('CHAPITRE N&deg;=1'); </p>
        <blockquote>
          <p><span class="exemples"><br>
            $f-&gt;frm_ObjetChampTexte(&quot;...<br>
            $f-&gt;frm_ObjetChampTexte(&quot;...<br>
            $f-&gt;frm_ObjetChampTexte(&quot;...</span></p>
        </blockquote>
        <p> $f-&gt;<strong>frm_EntereNouveau</strong>('CHAPITRE N&deg;=2'); </p>
        <blockquote>
          <p class="exemples"> $f-&gt;frm_ObjetChampTexte(...<br>
            $f-&gt;frm_ObjetChampTexte(... <br>
            $f-&gt;frm_ObjetChampTexte(...<br>
          $f-&gt;frm_ObjetChampTexte(...</p>
        </blockquote>
      </blockquote>
      <p class="style4">COMPORTEMENT EN CAS D'ERREUR DE SAISIE : Les paragraphes sont automatiquement d&eacute;ploy&eacute;s </p>
      <p><img src="image31_separateurs.gif" width="623" height="326" border="1"></p>
      <p><a href="sample20_separateurs.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </blockquote>
</blockquote>
<hr>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <h3><a name="onglets" id="onglets"></a>5.23) LES SCROLLER DE CHAMPS </h3>
    <blockquote>
      <p>L'utilisation d'un nombre important de champ et la n&eacute;cessit&eacute; de voir en permanence les boutons peut amener &agrave; l'emploi de scroller (fonctions CSS standards) </p>
      <p>3 fonctions permettent de manipuler les scrollers : </p>
      <blockquote>
        <p> <strong>frm_InitScroller(...)</strong> : appel&eacute;e une seul fois avant la d&eacute;finition du 1er champ</p>
        <blockquote>
          <p> <strong>4 param&egrave;tres : </strong><br>
              <br>
              <strong>la largeur en pixel </strong> = obligatoire<br>
              <strong>la hauteur en pixel </strong> = obligatoire</p>
          <p><strong>la couleur du fond</strong> = pour faire ressortir la zone de scroll on peut lui donner une couleur (mettre en blanc par d&eacute;faut) <br>
            <br>
            <strong>le mode automatique ou manuel </strong> = en mode automatique tous les champs qui seront d&eacute;finis seront dans la zone de scroll. En mode manuel, il faut ouvrir et fermer la zone de scroll. </p>
        </blockquote>
        <p> 	<strong>frm_ScrollerOpen(), frm_ScrollerClose()</strong>: Appel&eacute;e entre chaque d&eacute;finition de champ, pas de param&egrave;tre</p>
        <blockquote>
          <p>&nbsp;</p>
        </blockquote>
      </blockquote>
      <p><strong class="exemples">Syntaxe :</strong> </p>
      <blockquote>
        <p> <span class="exemples">$f = New Forms;<br>
          <br>
          $f-&gt;frm_Init(false,&quot;200px&quot;);<br>
          <br>
          <strong>$f-&gt;frm_InitScroller(&quot;400&quot;,&quot;90&quot;,&quot;#FFE0D2&quot;,false);</strong></span></p>
        <p> <span class="exemples"><br>
  $f-&gt;frm_ObjetChampTexte(&quot;Champ1&quot;, ... </span></p>
        <p class="exemples"> $f-&gt;frm_ObjetChampTexte(&quot;Champ2&quot;, ... </p>
        <p class="exemples">...<br>
          <br>
          <strong>$f-&gt;frm_ScrollerOpen();</strong></p>
        <p class="exemples"><br>
  $f-&gt;frm_ObjetChampTexte(&quot;Champ3&quot;, ...<br>
        ..</p>
        <p class="exemples"><strong>$f-&gt;frm_ScrollerClose();</strong></p>
        <p class="exemples">$f-&gt;frm_Ouvrir();</p>
      </blockquote>
      <p class="style4"><img src="image34_scroller_manuel.gif" width="460" height="269" border="2"></p>
      <h2><a href="sample27_scroller.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a><a href="sample27_scroller2.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"><br>
      </a></h2>
      <h2>ATTENTION : NE PLACER DANS LA ZONE DE SCROLL QUE DES CHAMPS DE TYPE &quot;TEXTE&quot; CAR SINON LES OBJETS COMPLEXES PEUVENT AVOIR UN COMPORTEMENT IMPREVU (Voir exemple ci-dessous) </h2>
      <p><a href="sample28_scroller_coche_radio.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a>les popups sont d&eacute;call&eacute;s </p>
    </blockquote>
  </blockquote>
</blockquote>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr>
<h2><a name="CONTROLESAISIE" id="CONTROLESAISIE"></a>6) CONTROLE DE SAISIE DES OBJETS <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <blockquote>
        <p>2 modes de saisie des informations peuvent co-&eacute;xister :</p>
      <h3>6.1) CONTROLE COTE &quot;CLIENT&quot;</h3>
        <blockquote>
          <p>Ce mode de saisie effectu&eacute; en Javascript est effectu&eacute; &agrave; la vol&eacute;e (cas des attributs &quot;masques&quot; et &quot;N&quot; ) ou &agrave; la validation du formulaire ( submit() ) pour l'attribut obligatoire &quot;R&quot; par exemple.</p>
          <p>Controle &agrave; la validation, quand un ou plusieurs champs ne sont pas remplis correctement, une fen&ecirc;tre d'alerte apparait &agrave; la validation en donnant la liste des champs &agrave; modifier :</p>
          <p><img src="image13_controlesubmit.gif" width="449" height="172"> </p>
          <p>Quand la fen&ecirc;tre d'alerte est ferm&eacute;e le curseur est positionn&eacute; sur le 1er champ en erreur.<br>
          </p>
          <p>Une exception au controle des champs est l'attribut &quot;S&quot; ( submit() ) il est prioritaire sur tout attribut &quot;R&quot;, il provoque une sortie du code (<a href="#attributS"> voir chapitre traitant l'attribut &quot;S&quot;</a> ) </p>
          <p><a name="confirmation"></a>La fonction <strong>frm_InitConfirm()</strong> permet <strong>si tous les tests pr&eacute;c&eacute;dents sont OK </strong>de demander confirmation d'enregistrement :</p>
          <p><img src="image18_confirmation.gif" width="245" height="126"> </p>
          <p>dans le cas d'un ajout<br>
            ou &quot;Enregistrement de la modification ?&quot; dans le cas d'une modification. </p>
          <p>on peut definir un message sur mesure en appelant la fonction par <strong>frm_InitConfirm(&quot;Message a afficher en cas de validation&quot;) </strong></p>
          <p>&nbsp;</p>
          <p><strong>Par la fonction frm_InitConfirmCancel() </strong>on peut comme avec la fonction frm_InitConfirm() demander la confirmation pour r&eacute;tablir les valeurs par d&eacute;faut. Cette fonction est tr&egrave;s pratique dans le cas des grilles qui ont beaucoup de champs &agrave; saisir. </p>
          <p><a href="sample25_confirm.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
        </blockquote>
      <h3>6.2) CONTROLE COTE &quot;SERVEUR&quot;</h3>
        <blockquote>
          <p>Ce mode est enti&egrave;rement &agrave; programmer dans la section &quot;aiguillage&quot; de la r&eacute;entrance <a href="diagramme_reentrance.gif" target="_blank">(voir sch&eacute;ma)</a></p>
        </blockquote>
        <p>&nbsp;</p>
    </blockquote>
  </ol>
  <hr>
<h2></h2>
<h2><a name="MODIFICATION_OBJETS" id="MODIFICATION_OBJETS"></a>7) MODIFICATION DE L'ETAT DES OBJETS <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <p>Les fonctions suivantes permettent de modifier l'&eacute;tat d'un champ (valeur par d&eacute;faut, activation ou non...) apr&egrave;s sa d&eacute;finition mais avant son affichage</p>
<h3><a name="champerreur"></a>7.1) Marquer un champ en erreur </h3>
  <ol>
    <blockquote>
      <p>Lors de la r&eacute;entrance du formulaire (A1 ou M1), la valeur des champs peut-&ecirc;tre test&eacute;e ( $_POST['NOM_DU_CHAMP'] ) si la valeur ne correspondant pas a celle attendu, il faut marquer le champ par la fonction :<span class="exemples">frm_ChampEnErreur(</span>)</p>
      <p><strong class="exemples">syntaxe : </strong>
      </p>
      <blockquote>
        <p><span class="exemples">frm_ChampEnErreur('NOMCHAMP','MESSAGE D\'ERREUR');</span></p>
        <p><img src="image15_champenerreur.gif" width="574" height="196" border="2"></p>
      </blockquote>
      <p><strong class="exemples">exemple :</strong>
      </p>
      <blockquote>
        <p>//APRES LA DEFINITION DES CHAMPS </p>
        <p>if ( $_POST['CHOIX'] != '3' ) {<br>
          $f-&gt;frm_ChampEnErreur(&quot;CHOIX&quot;, &quot;&lt;h1&gt;ATTENTION&lt;/h1&gt;Confort doit etre coch&eacute;es&quot;);<br>
          }<br>
          if ( $_POST['VILLE'] != 'NANTES' ) {<br>
          $f-&gt;frm_ChampEnErreur(&quot;VILLE&quot;, &quot;La ville doit &ecirc;tre NANTES&quot;);<br>
          } </p>
        <p>// AVANT L'AFFICHAGE DES CHAMPS </p>
      </blockquote>
      <p><a href="sample12_champenerreur.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
<h3><a name="CHAMPACTIF"></a>7.2) Activer un champ</h3>
  <ol>
    <blockquote>
      <p>Dans le m&ecirc;me principe des autres fonctions du chapitre 7) <span class="exemples">frm_ChampActif()</span> permet d'activer ou non un champ en fonction de tests et ce quelque soit l'&eacute;tat d&eacute;fini par d&eacute;faut. </p>
    </blockquote>
</ol>
  <h3><a name="READONLY"></a>7.3) D&eacute;finir un champ en lecture seule</h3>
  <ol>
    <blockquote>
      <p><span class="exemples">frm_ChampLectureSeule()</span> permet de d&eacute;finir qu'un champ est en lecture seule</p>
    </blockquote>
  </ol>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h3>7.4) Initialiser la valeur d'un champ</h3>
  <ol>
    <blockquote>
      <p>Comme la fonction pr&eacute;c&eacute;dente, <span class="exemples">frm_ChampInitialiserValeur()</span> permet de modifier la valeur par d&eacute;faut du champ. </p>
      <p><strong class="exemples">syntaxe :</strong>
      </p>
      <blockquote>
        <p class="exemples"> frm_ChampInitialiserValeur(&quot;NOM_DU_CHAMP&quot;,&quot;Valeur du Champ&quot;);</p>
      </blockquote>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
<h3>7.5) Initialiser tous les champs</h3>
  <ol>
    <blockquote>
      <p>Comme la fonction pr&eacute;c&eacute;dente, <span class="exemples">frm_ChampInitialiserValeur()</span> permet de modifier la valeur par d&eacute;faut du champ de tous les champs d&eacute;clar&eacute; par rapport aux valeurs d'un tableau hash. Ce tableau sera g&eacute;n&eacute;r&eacute; par la fonction bdd_resultats_vers_tableau() de la classe &quot;classeBase&quot;.</p>
      <p><strong class="exemples">syntaxe :</strong> </p>
      <blockquote>
        <p class="exemples"> frm_ChargerLesChamps( array(&quot;NOMCHAMP1&quot; =&gt; &quot;Valeur1&quot;, ...) );</p>
      </blockquote>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
  <h3></h3>
  <h3>7.6) Recopier tous les champs de r&eacute;entrance</h3>
  <ol>
    <blockquote>
      <p>Pour simplifier le codage d'une page r&eacute;entrante, un seul appel &agrave; la fonction <span class="exemples">frm_ChampsRecopier()</span> permet de donner comme valeur par d&eacute;faut &agrave; tous les champs la valeur $_POST venant de la page pr&eacute;c&eacute;dante. On les trouvera dans la section de code A1 et M1. </p>
      <p><strong class="exemples">syntaxe :</strong>
      </p>
      <blockquote>
        <p> case &quot;M1&quot; :<br>
          <br>
          <span class="exemples">// SI AUCUNE ERREUR NE SUBSISTE ALORS ON ENREGISTRE LA MODIFICATION ET ON SORT<br>
          if ($cpterreur==0) {<br>
          $requete = $base-&gt;bdd_creationrequete(&quot;agents&quot;,&quot;agent_id&quot;,&quot;M&quot; );<br>
          $base-&gt;bdd_execsql($requete); <br>
          header(&quot;Location: maj_annuaire.php#&quot;.$_POST['AGENT_ID']);<br>
          }<br>
          // SINON ON REAFFICHE LE FORMULAIRE<br>
          $requete = &quot;SELECT * FROM agents WHERE agent_id=&quot; . $_GET['agent_id'];<br>
          $base-&gt;bdd_execsql($requete); <br>
          $titrefenetre = &quot;MISE A JOUR DE : &quot; . <br>
          $base-&gt;bdd_lire_champ(&quot;agent_prenom&quot;) .&quot;&amp;nbsp;&quot; .$base-&gt;bdd_lire_champ(&quot;agent_nom&quot;); <br>
          <strong>$f-&gt;frm_ChampsRecopier();</strong></span><br>
          break;    <br>
        </p>
      </blockquote>
    </blockquote>
  </ol>
<h3>7.7) Activer le bouton Valider d&egrave;s le d&eacute;but de la saisie</h3>
  <ol>
    <blockquote>
      <p>Par d&eacute;faut le bouton &quot;valider&quot; d'un formulaire est d&eacute;sactiv&eacute; jusqu'&agrave; modification d'un champ dans le 1er appel de la page (A0 ou M0).<br>
        Une fois la page r&eacute;entrante, le bouton &quot;valider&quot; est toujours activ&eacute;. La fonction : <span class="exemples">frm_ActiverBtnValider()</span> permet de forcer l'activation du bouton d&egrave;s le d&eacute;but de la page. </p>
    </blockquote>
</ol>
<h3><a name="codejavascript"></a>7.8) Ex&eacute;cuter un code javascript externe &agrave; la sortie d'un champ texte (CALCUL par exemple)</h3>
<ol>
  <blockquote>
    <p>Pour r&eacute;aliser des calculs entre les champs textes ou toute autre action utiliser l'attribut &quot;script&quot; en placer comme valeur le nom de la fonction javascript execut&eacute;e &agrave; chaque sortie ou validation du champ </p>
    <p>exemple <span class="exemples">&quot;addition()&quot;</span><br>
    </p>
    <p>la page doit alors contenir le code sp&eacute;cifique ce code n'est pas g&eacute;r&eacute; par <strong>classeforms</strong> </p>
    <p> <span class="exemples">&lt;script language=&quot;JavaScript&quot; type=&quot;text/JavaScript&quot;&gt;<br>
&lt;!--</span></p>
    <blockquote>
      <p class="exemples">function <strong>addition(</strong>) {<br>
      KW_calcForm('AJOUT_RESULTAT',100,-1,'#AJOUT_1','+','#AJOUT_2','+','#AJOUT_3');<br>
      }</p>
      <p class="exemples">function <strong>soustraction()</strong> {<br>
      KW_calcForm('SOUST_RESULTAT',100,-1,'#SOUST_1','-','#SOUST_2');<br>
      }</p>
    </blockquote>
    <p class="exemples">//--&gt;<br>
&lt;/script&gt;</p>
    <p><a href="sample30_javascript.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a>         </p>
  </blockquote>
</ol>
<hr>
<h2><a name="MISENFORME" id="MISENFORME"></a>8) MISE EN FORME DES CHAMPS DU FORMULAIRE <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
<h3>8.1) AFFICHAGE DES CHAMPS EN MODE AUTOMATIQUE </h3>
  <ol>
    <blockquote>
      <p>Par d&eacute;faut, le moyen le plus simple d'afficher les champs qui ont &eacute;t&eacute; d&eacute;clar&eacute; est le mode automatique. Les champs sont ins&eacute;r&eacute;s dans un tableau &agrave; 2 colonnes (la colonne de gauche comprend le label, celle de droite le champ lui m&ecirc;me.</p>
      <p> Ce mode permet n&eacute;anmoins de faire varier la positions des champs en <strong>largeur</strong> :
      </p>
      <blockquote>
        <p><span class="exemples">$f-&gt;frm_Init(<em>$readonly,'200px'</em>);</span> </p>
      </blockquote>
      <p>et de faire des <a href="#attributS">sauts de lignes</a> entre les champs : </p>
      <blockquote>
        <p><span class="exemples">$f-&gt;frm_SautLignes(<em>2</em>);</span> </p>
      </blockquote>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
  <h3>8.2) AFFICHAGE DES CHAMPS EN MODE MANUEL</h3>
  <ol>
    <blockquote>
      <p>Quand le positionnement automatique ne correspond pas &agrave; ce que l'on veut il ya toujours la possibilit&eacute; de placer les champs manuellement. Dans ce cas la g&eacute;n&eacute;ration du tableau qui re&ccedil;oit les labels dans la colonne de gauche et les champs dans celle de droite ne se fait pas</p>
      <p><span class="exemples"><strong>syntaxe :</strong></span>          </p>
      <blockquote>
        <p><span class="exemples">$f-&gt;frm_Ouvrir(false);</span> </p>
        <p><img src="image17_manuel_vueediteur2.gif" width="630" height="177" class="exemples"></p>
      </blockquote>
      <p><strong class="exemples">ATTENTION NE PAS OUBLIER DE PLACER MANUELLEMENT LES BOUTONS DE VALIDATION ET D'ANNULATION </strong>
      </p>
      <blockquote>
        <p>&lt;?php $f-&gt;frm_AfficheBtnValider(); ?&gt;<br>
&lt;?php $f-&gt;frm_AfficheBtnAnnulerQuitter(); ?&gt;</p>
      </blockquote>
      <p><strong class="exemples">LA VUE CI-DESSOUS EST CELLE DE L'EDITEUR EN MODE RENDU </strong>
      </p>
      <blockquote>
        <p><img src="image16_manuel_vueediteur.gif" width="500" height="203" border="2"></p>
      </blockquote>
    </blockquote>
  </ol>
<h3><a name="attributS"></a>8.3) MODIFIER LES LIBELLES DES BOUTONS</h3>
  <ol>
    <blockquote>
      <p>Par d&eacute;faut les boutons ont les libell&eacute;s suivants :</p>
      <p><img src="image20_boutons.gif" width="269" height="122" border="2"> </p>
      <p> Il est possible de modifier le libell&eacute; des boutons suivants par l'usage de la fonction :</p>
      <p><span class="exemples">Implicitement : $f-&gt;frm_LibBoutons('Valider','Quitter','R&eacute;tablir');</span> </p>
      <p>On peut choisir par exemple : $f-&gt;frm_LibBoutons('OK','Sortir','Annuler'); </p>
      <p><a href="sample14_boutons.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
    </blockquote>
  </ol>
  <h3><a name="attributS"></a>8.4) PREACTIVER LE BOUTON VALIDER </h3>
  <ol>
    <blockquote>
      <p>Le bouton Valider est inactif jusqu'a ce qu'on rendre dans un champ et quand il y a plus d'un champ dans le formulaire : </p>
      <p>Il est possible cependant de pr&eacute;-activer le bouton VALIDER</p>
      <p><span class="exemples">D&eacute;claration de la fonction : $f-&gt;frm_ActiverBtnValider();</span> </p>
      <p><a href="sample32_boutonspreactive.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
  <h3><a name="attributS"></a>8.5) SAUT DE LIGNES</h3>
  <ol>
    <blockquote>
      <p>Pour r&eacute;aliser des sauts de lignes entre les objets utiliser la fonction <span class="exemples">$f-&gt;frm_SautLignes()</span></p>
      <p><img src="image24_sautdelignes.gif" width="509" height="252" border="2"></p>
      <p><span class="exemples">Implicitement : $f-&gt;frm_SautLignes();</span>          </p>
      <blockquote>
        <p>provoque 1 seul saut de ligne avant l'objet suivant</p>
      </blockquote>
      <p><span class="exemples">$f-&gt;frm_SautLignes(2);</span>          </p>
      <blockquote>
        <p>provoque 2 sauts de lignes avant l'objet suivant</p>
      </blockquote>
      <p><a href="sample17_sautlignes.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
    </blockquote>
  </ol>
  <p>&nbsp;</p>
<hr>
<h2><a name="CODERREENTRANCE" id="CODERREENTRANCE"></a>9) CODAGE DE LA RE-ENTRANCE <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <blockquote>
        <p>Comme d&eacute;crit dans le sch&eacute;ma, il faut analyser en PHP avant d'envoyer la 1ere balise HTML les codes $_POST pour savoir dans quel &eacute;tat doit se trouver la page.</p>
      <h3>9.1) APPEL D'UNE FENETRE EN MODE &quot;AJOUT&quot; </h3>
        <blockquote>
          <p>par convention l'appel d'une page en ajout se fait sans param&egrave;tre GET <br>
            ( syntaxe d'appel : <span class="exemples">nom_page.php</span> ) </p>
          <p>Dans ce cas les &eacute;tats que pourra prendre la page seront :</p>
          <p><strong>A0</strong> : 1er appel &agrave; la page, on met les champs &agrave; blanc </p>
          <p><strong>A1</strong> : on analyse les champs (r&eacute;cup&eacute;r&eacute; en $_POST) </p>
          <p><strong>AQ</strong> : la touche &quot;quitter&quot; a &eacute;t&eacute; press&eacute;e on branche &agrave; la page suivant (liste, menu g&eacute;n&eacute;ral...) par la fonction <br>
            <span class="exemples">header(&quot;Location: AfficherResultats.php&quot;); </span><br>
          </p>
        </blockquote>
      <h3>9.2) APPEL D'UNE FENETRE EN MODE &quot;MODIFICATION&quot; </h3>
        <blockquote>
          <p>par convention l'appel d'une page en ajout se fait avec un ou plusieurs param&egrave;tres GET <br>
            ( syntaxe d'appel : <span class="exemples">nom_page.php?id=100</span> ) </p>
          <p>Dans ce cas les &eacute;tats que pourra prendre la page seront :</p>
          <p><strong>M0</strong> : 1er appel &agrave; la page, on r&eacute;cup&egrave;re le param&egrave;re $_GET, on lit l'enregistrement correspondant &agrave; la valeur de la clef </p>
          <p><strong>M1</strong> : on analyse les champs (r&eacute;cup&eacute;r&eacute; en $_POST) </p>
          <p><strong>MQ</strong> : la touche &quot;quitter&quot; a &eacute;t&eacute; press&eacute;e on branche &agrave; la page suivant (liste, menu g&eacute;n&eacute;ral...) par la fonction <br>
            <span class="exemples">header(&quot;Location: AfficherResultats.php&quot;); </span><br>
          </p>
        </blockquote>
      <h3><a name="LECTURESEULE"></a>9.3) APPEL D'UNE FENETRE EN MODE &quot;CONSULTATION&quot; </h3>
        <blockquote>
          <p>par convention l'appel d'une page en ajout se fait avec  plusieurs param&egrave;tres GET <br>
            ( syntaxe d'appel : <span class="exemples">nom_page.php?id=100&amp;RO=yes</span> ) </p>
          <p>Dans ce cas les &eacute;tats que pourra prendre la page seront :</p>
          <p><strong>L0</strong> : 1er appel &agrave; la page, on r&eacute;cup&egrave;re les param&egrave;res $_GET, on lit l'enregistrement correspondant &agrave; la valeur de la clef </p>
          <p><strong>L1</strong> : n-ieme appel &agrave; la page, on r&eacute;cup&egrave;re les param&egrave;res $_GET, on lit peut dans ce cas </p>
          <p><strong>LQ</strong> : la touche &quot;quitter&quot; (c'est la seule affich&eacute;e dans ce cas) a &eacute;t&eacute; press&eacute;e on branche &agrave; la page suivant (liste, menu g&eacute;n&eacute;ral...) par la fonction <br>
            <span class="exemples">header(&quot;Location: AfficherListe.php&quot;); </span></p>
          <p>Pour utiliser un formulaire en consultation c'est facile :
          </p>
          <blockquote>
            <p>&lt;?php<br>
              $consultation = isset($_GET['RO']);<br>
              <br>
              $f-&gt;frm_Init($consultation,'200px');<br>
              ...
            </p>
            <p>?&gt;</p>
          </blockquote>
          <p><img src="image22_Consulte_2boutons.gif" width="488" height="245" border="2"></p>
          <p><br>
            $f-&gt;frm_LibBoutons(&quot;Effacer&quot;,&quot;Sortir&quot;,&quot;&quot;);</p>
          <p>Dans le cas ou on choisit le bouton &quot;Effacer&quot;, La page sera r&eacute;-entrante avec le statut <strong>&quot;L1&quot; </strong></p>
          <p><br>
            <br>
            <img src="image23_Consulte_1bouton.gif" width="490" height="249" border="2"></p>
          <p>$f-&gt;frm_LibBoutons(<strong>&quot;&quot;</strong>,&quot;Sortir&quot;,&quot;&quot;); <br>
          </p>
          <p>La chaine n&deg;=1 doit &ecirc;tre une chaine vide</p>
          <p>Dans ce cas, La page sera r&eacute;-entrante avec le statut <strong>&quot;LQ&quot; </strong></p>
          <p><span class="exemples"><a href="sample15_consultation.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></span><br>
          </p>
        </blockquote>
      <h3>9.4) AIGUILLER VERS LE BON CODE A EXECUTER </h3>
        <blockquote>
          <p>Dans les 3 cas pr&eacute;c&eacute;dants, il est n&eacute;cessaire de faire un appel &agrave; la fonction frm_Aiguiller() (les objets doivent pr&eacute;alablement &ecirc;tre d&eacute;clar&eacute;s) </p>
          <p><span class="exemples">$ret = $f-&gt;frm_Aiguiller('NOM_DE_LA_CLEF');<br>
          switch ( $ret ) {</span>
          </p>
          <blockquote>
            <p> case &quot;A0&quot; :<br>
              $action = &quot;APPEL A LA FENETRE EN AJOUT n&deg;1&quot;;<br>
              break;</p>
            <p> case &quot;A1&quot; :<br>
              $action = &quot;APPEL A LA FENETRE EN AJOUT n&deg;2 et +&quot;;<br>
              // controler les variables $_POST<br>
              // si pb faire appel &agrave; la fonction &quot;frm_ChampsRecopier()&quot;, tous les champs sont recopi&eacute;s <br>
              // si pas de pb alors :<br>
              //    - on sauvegarde des donn&eacute;es<br>
              // - on branche 
                    header(&quot;Location: AfficherListe.php&quot;); <br>
              break;</p>
            <p> case &quot;AQ&quot; :<br>
              header(&quot;Location: AfficherListe.php&quot;); <br>
              break;</p>
          </blockquote>
          <p><span class="exemples">        }</span><br>
          </p>
        </blockquote>
      <h3><a name="attributS"></a>9.5) L'ATTRIBUT &quot;S&quot; POUR &quot;SUBMIT()&quot; </h3>
        <blockquote>
          <p>L'attribut &quot;S&quot; permet en cas de changement de valeur d'un champ de forcer la r&eacute;entrance du formulaire, il suffit d'analyser sa valeur pour d&eacute;finir de nouveaux  champs ou modifier des valeurs. On peut l'utiliser principalement avec des boutons radios ou des listes.</p>
          <p>Exemple d'application : On souhaite par exemple renseigner une liste avec les 36000 communes de France. Le chargement et l'affichage donnerait des temps de r&eacute;ponse catastrophique. On pr&eacute;f&eacute;rera d&eacute;finir une liste des d&eacute;partement avec l'attribut &quot;S&quot; et dans la r&eacute;entrance charger uniquement les communes de ce d&eacute;partement apr&egrave;s un filtrage sur le d&eacute;partement choisi. </p>
          <p><strong class="exemples">Syntaxe :  </strong></p>
          <p><span class="exemples">$ret = $f-&gt;frm_Aiguiller('NOM_DE_LA_CLEF');<br>
          switch ( $ret ) {</span></p>
          <p><a href="sample11_submit.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
        </blockquote>
        <h3><a name="attributS"></a>9.6) SAUVEGARDER DES VALEURS DE CHAMPS </h3>
        <blockquote>
          <p>Il est parfois n&eacute;cessaire de m&eacute;moriser des param&egrave;trage environnementaux ou des choix par d&eacute;faut sans que cel&agrave; soit n&eacute;cessaire dans une base de donn&eacute;es dans ce cas on choisira :</p>
          <p>- les variables de session si la dur&eacute;e de vie de l'information est limit&eacute;e au temps ou l'utilisateur est connect&eacute; &agrave; l'application</p>
          <p>- les cookies pour m&eacute;moriser des informations sur plusieurs mois<br>
            exemple : on veut proposer par d&eacute;faut &agrave; un utilisateur le choix du format d'&eacute;tiquette qu'il utilise tout le temps. </p>
          <p><strong class="exemples">Syntaxe : </strong></p>
          <p class="exemples">... les champs viennent d'&ecirc;tre d&eacute;fini </p>
          <p><span class="exemples">$ret = $f-&gt;frm_Aiguiller('NOM_DE_LA_CLEF');<br>
      switch ( $ret ) {		</span></p>
          <blockquote>
            <p><span class="exemples">case &quot;A0&quot; :<br>
              ...
            <br>
            $f-&gt;frm_ChampInitialiserValeur(&quot;ETIQUETTES&quot;, <strong>$_COOKIE[&quot;ETI_ID&quot;]</strong> );<br>
            break;<br>
            <br>
            case &quot;A1&quot; :<br>
            ...
            <br>
            <strong>setcookie(&quot;ETI_ID&quot;, $_POST['ETIQUETTES'], time()+86400*9999); </strong><br>
            break;</span></p>
          </blockquote>
          <p><span class="exemples">}</span></p>
          <p>Explications : la valeur est potionn&eacute;e </p>
          <blockquote>
            <p>&nbsp;</p>
            <p><a href="sample11_submit.php" target="_blank" class="exemples"></a></p>
          </blockquote>
        </blockquote>
    </blockquote>
  </ol>
  <hr>
  <h2><a name="UPLOAD" id="UPLOAD"></a>10) LE CODAGE DES UPLOAD (TELECHARGEMENTS)<a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <blockquote>
      <p>Php nativement offre des fonctions qui associ&eacute;es &agrave; l'objet &quot;<a href="#uploader">uploader</a>&quot; permettent de t&eacute;l&eacute;charger sur le serveur des fichiers locaux.<br>
        <br>
        <strong>TECHNOLOGIE HTML : </strong></p>
      <p>les objets selecteur de fichiers doivent &ecirc;tre associ&eacute;s &agrave; un formulaire avec les param&egrave;tres suivants :</p>
      <p class="exemples">&lt;form action=&quot;&quot; method=&quot;post&quot; <strong>enctype=&quot;multipart/form-data&quot;</strong> name=&quot;form1&quot; id=&quot;form1&quot;&gt;<br>
&lt;input <strong>type=&quot;file&quot;</strong> name=&quot;file&quot; /&gt;<br>
&lt;/form&gt; </p>
      <p><strong>TECHNOLOGIE PHP : </strong></p>
      <p>La taille maximum d'un fichier t&eacute;l&eacute;chargeable est fix&eacute; par plusieurs param&egrave;tres :</p>
      <ul>
        <li>Le fichier php.in , <br>
          <br>
        si <strong>safe_mode = On</strong>, alors on ne peut modifier la limite syst&egrave;me &quot;PHP&quot; dynamiquement il faut modifier les param&egrave;tres <span class="exemples"><strong>upload_max_filesize</strong></span><strong> et <span class="exemples"><strong> post_max_size</strong></span> comme suit </strong> avec obligatoirement <span class="exemples"><strong>upload_max_filesize</strong></span><strong> &lt;= <span class="exemples"><strong> post_max_size</strong></span></strong></li>
      </ul>
      <blockquote>
        <p class="exemples">;;;;;;;;;;;;;;;;<br>
        ; File Uploads ;<br>
        ;;;;;;;;;;;;;;;;</p>
        <p class="exemples">; Whether to allow HTTP file uploads.<br>
        file_uploads = On</p>
        <p class="exemples">; Temporary directory for HTTP uploaded files (will use system default if not<br>
        ; specified).<br>
        ;upload_tmp_dir =</p>
        <p><span class="exemples">; Maximum allowed size for uploaded files.<br>
          <strong>upload_max_filesize = 200M</strong></span><br>
        </p>
        <p class="exemples">....</p>
        <p class="exemples"><br>
        ; Maximum size of POST data that PHP will accept.<br>
        <strong>post_max_size = 200M</strong></p>
        <p><br>
        </p>
      </blockquote>
      <ul>
        <li>le champ texte cach&eacute; MAX_FILE_SIZE qui conditionne la taille maximale pour le formualire</li>
      </ul>
      <blockquote>
        <p class="exemples"> &lt;input name=&quot;MAX_FILE_SIZE&quot; type=&quot;hidden&quot; value=&quot;100000000&quot;&gt; </p>
      </blockquote>
      <p><a href="sample43_uploader_simple.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    </blockquote>
  </ol>
  <hr>
  <h2><a name="BUFFER" id="BUFFER"></a>11) LES SORTIES DIFFEREES <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <p>Il peut &ecirc;tre interressant quand on g&eacute;n&egrave;re des sections d'une page &agrave; partir de variables de diff&eacute;rer les sorties et placer tout le code g&eacute;n&eacute;r&eacute; dans une variable:</p>
    <blockquote>
      <p class="exemples">EXEMPLE :</p>
      <p class="exemples"><span class="style12">&lt;?php</span></p>
      <blockquote>
        <p class="style13"> 	$f = New Forms;</p>
        <p class="style13">          <strong>$f-&gt;frm_initbuffer();</strong><br>
          <br>
          $f-&gt;frm_Init($readonly,'200px');<br>
          $f-&gt;frm_InitConfirm();<br>
          $f-&gt;frm_Objet...</p>
        <p class="style13">$f-&gt;frm_Ouvrir(); // la sortie n'est pas effective</p>
        <p class="style13"><strong>$buffer = $f-&gt;frm_flushbuffer()</strong>;<br>
        </p>
      </blockquote>
      <p class="exemples"><span class="style12"> ?&gt;</span></p>
      <p class="exemples">....</p>
      <p class="exemples"><span class="style11">&lt;h4&gt;&lt;span class=&quot;titre1 style1&quot;&gt;TOUS LES OBJETS DISPONIBLES &lt;/span&gt;</span><br>
        <span class="style12">&lt;?php</span></p>
      <blockquote>
        <p class="style13"> print &quot;&lt;h1&gt;$action&lt;/h1&gt;&quot;;<br>
          print &quot;&lt;hr&gt;&quot;;</p>
        <p class="style13">// c'est ici que sortira tout le code li&eacute; au formulaire (rien avant) <br>
          print <strong>$buffer;</strong></p>
      </blockquote>
      <p class="exemples"><span class="style12"> ?&gt;</span><br>
        <span class="style11">&lt;/h4&gt; </span></p>
    </blockquote>
    <p><a href="sample35_bufferedoutput.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    <blockquote>
      <p></p>
    </blockquote>
  </ol>
  <hr>
  <h2><a name="TIMEOUT" id="TIMEOUT"></a>12) LA FONCTION &quot;TIMEOUT&quot; <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <p>Il peut &ecirc;tre interressant de donner une dur&eacute;e de vie &agrave; un formulaire, qui branche automatiquement une page si rien n'est saisi pendant un d&eacute;lai fix&eacute;. </p>
    <p>ATTENTION le timeout n'est pas activ&eacute; quand la page est r&eacute;entrante A1,M1,L1 (une erreur de saisie &agrave; corriger absolument par exemple) </p>
    <blockquote>
      <p class="exemples">EXEMPLE :</p>
      <p class="exemples">&lt;?php</p>
      <blockquote>
        <p class="exemples"> $f = New Forms;<br>
        <br>
        $f-&gt;frm_Init(false,&quot;400px&quot;);<br>
        <br>
        $f-&gt;frm_InitTimeOut(10,'index.php#ANNEXES','COOL_REDIRECT_COUNTER');<br>
....
<br>
        </p>
      </blockquote>
      <p class="exemples"> ?&gt;</p>
      <p>&quot;COOL_REDIRECT_COUNTER&quot; est optionnel, il suffit de positionner le code ci dessous pour rendre visible le compte &agrave; rebours </p>
      <p class="exemples">&lt;DIV id=COOL_REDIRECT_COUNTER&gt;X&lt;/DIV&gt; </p>
    </blockquote>
    <p><a href="sample49_timeout.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
    <blockquote>
      <p></p>
    </blockquote>
  </ol>
  <hr>
  <h2><a name="FRM_MESSAGE" id="FRM_MESSAGE"></a>13) LA FONCTION &quot;MESSAGE&quot; <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
    <p>On peut informer par un message que l'enregistrement a bien &eacute;t&eacute; ajout&eacute;, modifi&eacute;, effac&eacute; ou enregistr&eacute;. </p>
    <p>Le message est configur&eacute; par la fonction frm_Message() dans la section ci-dessous mais la sortie effective est r&eacute;alis&eacute;e par l'ordre 	$f-&gt;frm_Ouvrir(); situ&eacute; entre les balises &lt;BODY&gt;...&lt;/BODY&gt;</p>
    <p>Il est possible de personaliser la sortie avec la fonction frm_IsMessage() qui retourne vrai si un message a &eacute;t&eacute; d&eacute;fini. </p>
    <p>Les icones disponibles sont appel&eacute;e par l'attribut <span class="exemples">'icon' =&gt; 'ICON_SAVE'</span> sans son suffixe .gif ,<br> 
    on peut aussi d&eacute;finir toute icone en pr&eacute;cisant son chemin d'acc&egrave;s relatif ou absolu et son nom et suffixe. </p>
    <p> Les autres attributs sont :</p>
    <p><span class="exemples">'url'=&gt; 'nom_de_page.php',</span> url de branchement quand on clique sur l'icone </p>
    <p><span class="exemples">'target'=&gt; '_blank'</span>, quand on clique sur l'icone on se branche sur le lien de l'Url, ATTENTION cette option annule la temporisation ci dessous </p>
    <p><span class="exemples">'timeout'=&gt; 5</span> : La dur&eacute;e en seconde de la temporisation</p>
    <p></p>
    <p>&nbsp; </p>
    <table width="104%" border="0">
      <tr>
        <td><img src="../message/ICON_BOOK_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOOK_ADD</span></td>
        <td><img src="../message/ICON_BOOK_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOOK_DELETE</span></td>
        <td><img src="../message/ICON_BOOK_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOOK_NEW</span></td>
        <td><img src="../message/ICON_BOOK_PREF.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOOK_PREF</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_BOX_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOX_ADD</span></td>
        <td><img src="../message/ICON_BOX_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOX_DELETE</span></td>
        <td><img src="../message/ICON_BOX_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOX_NEW</span></td>
        <td><img src="../message/ICON_BOX_PREF.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_BOX_PREF</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_CARD_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD_ADD</span></td>
        <td><img src="../message/ICON_CARD_DELETE.gif" alt="ICONE" width="32" height="32"><span class="exemples">ICON_CARD_DELETE</span></td>
        <td><img src="../message/ICON_CARD_NEW.gif" alt="ICONE" width="32" height="32"><span class="exemples">ICON_CARD_NEW</span></td>
        <td><img src="../message/ICON_CARD_PREF.gif" alt="ICONE" width="32" height="32"><span class="exemples">ICON_CARD_PREF</span></td>
        <td><img src="../message/ICON_CARD_OK.gif" alt="ICONE" width="32" height="32"><span class="exemples">ICON_CARD_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_DATA_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_ADD</span></td>
        <td><img src="../message/ICON_DATA_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_DELETE</span></td>
        <td><img src="../message/ICON_DATA_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_NEW</span></td>
        <td><img src="../message/ICON_DATA_PREF.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_ADD</span></td>
        <td><img src="../message/ICON_DATA_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_ADD</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_DATA_DISK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA_DISK</span></td>
        <td>&nbsp;</td>
        <td><img src="../message/ICON_DATABASE_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATABASE_ADD</span></td>
        <td><img src="../message/ICON_DATABASE_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATABASE_DELETE</span></td>
        <td><img src="../message/ICON_SAVE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SAVE</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_DISK_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DISK_OK</span></td>
        <td>&nbsp;</td>
        <td><img src="../message/ICON_DOC_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DOC_OK</span></td>
        <td><img src="../message/ICON_DOC_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DOC_DELETE</span></td>
        <td><img src="../message/ICON_DOC2_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DOC2_DELETE</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SCROLL_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SCROLL_ADD</span></td>
        <td><img src="../message/ICON_SCROLL_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SCROLL_DELETE</span></td>
        <td><img src="../message/ICON_SCROLL_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SCROLL_OK</span></td>
        <td><img src="../message/ICON_SCROLL_PREF.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SCROLL_PREF</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_CARD2_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD2_ADD</span></td>
        <td><img src="../message/ICON_CARD2_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD2_DELETE</span></td>
        <td><img src="../message/ICON_CARD2_EDIT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD2_EDIT</span></td>
        <td><img src="../message/ICON_CARD2_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD2_NEW</span></td>
        <td><img src="../message/ICON_CARD2_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CARD2_NEW</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_DATA2_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_ADD</span></td>
        <td><img src="../message/ICON_DATA2_CLEAN.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_CLEAN</span></td>
        <td><img src="../message/ICON_DATA2_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_DELETE</span></td>
        <td><img src="../message/ICON_DATA2_DISK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_DISK</span></td>
        <td><img src="../message/ICON_DATA2_EXPORT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_EXPORT</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_DATA2_IMPORT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DATA2_IMPORT</span></td>
        <td>&nbsp;</td>
        <td><img src="../message/ICON_LOCK_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_LOCK_ADD</span></td>
        <td><img src="../message/ICON_LOCK_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_LOCK_DELETE</span></td>
        <td><img src="../message/ICON_LOCK_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_LOCK_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_GROUP_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_GROUP_ADD</span></td>
        <td><img src="../message/ICON_GROUP_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_GROUP_DELETE</span></td>
        <td><img src="../message/ICON_GROUP_EDIT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_GROUP_EDIT</span></td>
        <td><img src="../message/ICON_GROUP_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_GROUP_NEW</span></td>
        <td><img src="../message/ICON_GROUP_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_GROUP_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_PACK_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PACK_ADD</span></td>
        <td><img src="../message/ICON_PACK_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PACK_DELETE</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_PC1_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PC1_ADD</span></td>
        <td><img src="../message/ICON_PC1_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PC1_DELETE</span></td>
        <td><img src="../message/ICON_PC1_LOCKED.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PC1_LOCKED</span></td>
        <td><img src="../message/ICON_PC1_UNLOCK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PC1_UNLOCK</span></td>
        <td><img src="../message/ICON_PC1_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PC1_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_PICT1_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PICT1_ADD</span></td>
        <td><img src="../message/ICON_PICT1_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PICT1_DELETE</span></td>
        <td><img src="../message/ICON_PICT1_EDIT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PICT1_EDIT</span></td>
        <td><img src="../message/ICON_PICT1_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PICT1_NEW</span></td>
        <td><img src="../message/ICON_PICT1_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_PICT1_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_USER1_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_USER1_ADD</span></td>
        <td><img src="../message/ICON_USER1_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_USER1_DELETE</span></td>
        <td><img src="../message/ICON_USER1_EDIT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_USER1_EDIT</span></td>
        <td><img src="../message/ICON_USER1_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_USER1_NEW</span></td>
        <td><img src="../message/ICON_USER1_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_USER1_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_CRT_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CRT_ADD</span></td>
        <td><img src="../message/ICON_CRT_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CRT_DELETE</span></td>
        <td><img src="../message/ICON_CRT_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_CRT_OK</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_FILE_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_ADD</span></td>
        <td><img src="../message/ICON_FILE_DEL.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_DEL</span></td>
        <td><img src="../message/ICON_FILE_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_DELETE</span></td>
        <td><img src="../message/ICON_FILE_EDIT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_EDIT</span></td>
        <td><img src="../message/ICON_FILE_EXPORT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_EXPORT</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_FILE_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FILE_OK</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SERVER_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SERVER_ADD</span></td>
        <td><img src="../message/ICON_SERVER_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SERVER_DELETE</span></td>
        <td><img src="../message/ICON_SERVER_NEW.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SERVER_NEW</span></td>
        <td><img src="../message/ICON_SERVER_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SERVER_OK</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SUCCESS.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SUCCESS</span></td>
        <td><img src="../message/ICON_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DELETE</span></td>
        <td><img src="../message/ICON_DELETE2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DELETE2</span></td>
        <td><img src="../message/ICON_DELETE3.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DELETE3</span></td>
        <td><img src="../message/ICON_DELETE4.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DELETE4</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_FORWARD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_FORWARD</span></td>
        <td><img src="../message/ICON_DELETE3.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_DELETE3</span></td>
        <td><img src="../message/ICON_OK2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_OK2</span></td>
        <td><img src="../message/ICON_SAVE2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SAVE2</span></td>
        <td><img src="../message/ICON_ERROR.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_ERROR</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SKETCH_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_ADD</span></td>
        <td><img src="../message/ICON_SKETCH_DELETE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_DELETE</span></td>
        <td><img src="../message/ICON_SKETCH_FORWARD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_FORWARD</span></td>
        <td><img src="../message/ICON_SKETCH_IMPORT.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_IMPORT</span></td>
        <td><img src="../message/ICON_SKETCH_OK.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_OK</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SKETCH_SAVE.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_SAVE</span></td>
        <td><img src="../message/ICON_SKETCH_WARN.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_WARN</span></td>
        <td><img src="../message/ICON_SKETCH_WARN2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_SKETCH_WARN2</span></td>
        <td><img src="../message/ICON_STOP.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> ICON_STOP</span></td>
        <td><img src="../message/ICON_PROP.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_PROP</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_EMAIL1.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
        ICON_EMAIL1</span></td>
        <td><img src="../message/ICON_EMAIL2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL2</span></td>
        <td><img src="../message/ICON_EMAIL3.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL3</span></td>
        <td><img src="../message/ICON_EMAIL4.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL4</span></td>
        <td><img src="../message/ICON_EMAIL5.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL5</span></td>
      </tr>
      <tr>
        <td><img src="../message/ICON_EMAIL6.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL6</span></td>
        <td><img src="../message/ICON_EMAIL7.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_EMAIL7</span></td>
        <td><img src="../message/ICON_PDF.gif" width="32" height="32"><br>
        <span class="exemples">ICON_PDF</span></td>
        <td><img src="../message/ICON_PDF2.gif" width="32" height="32"><br>
          <span class="exemples">ICON_PDF</span>2</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_QUESTION1.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_QUESTION1</span></td>
        <td><img src="../message/ICON_QUESTION2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_QUESTION2</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_GEAR.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_GEAR</span></td>
        <td><img src="../message/ICON_GEAR_ADD.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_GEAR_ADD</span></td>
        <td><img src="../message/ICON_GEAR_WARN.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_GEAR_WARN</span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><img src="../message/ICON_SHIELD1.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_SHIELD1</span></td>
        <td><img src="../message/ICON_SHIELD2.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_SHIELD2</span></td>
        <td><img src="../message/ICON_SHIELD3.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_SHIELD3</span></td>
        <td><img src="../message/ICON_SHIELD4.gif" alt="ICONE" width="32" height="32"> <span class="exemples"> <br>
ICON_SHIELD4</span></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <blockquote>
      <p class="exemples">EXEMPLE :</p>
      <p class="exemples">&lt;?php</p>
      <blockquote>
        <p class="exemples"> $ret = $f-&gt;frm_Aiguiller();<br>
        switch ( $ret ) {<br>
        <br>
        case &quot;A0&quot; :</p>
        <blockquote>
          <p class="exemples">          break;</p>
        </blockquote>
        <p class="exemples"> case &quot;A1&quot; :</p>
        <blockquote>
          <p class="exemples">            if ( &quot;il n'a pas d'erreur&quot; ) {</p>
          <blockquote>
            <p class="exemples"><br>
              <strong>$f-&gt;frm_Message</strong>( array( 	'text' =&gt; &quot;La fiche modifi&eacute;e a &eacute;t&eacute; correctement enregistr&eacute;e&quot;,<br>
              'url'  =&gt; $url_cible,<br>
              'icon' =&gt; 'ICON_SAVE',<br>
              'timeout' =&gt; 5 ) );</p>
          </blockquote>
          <p class="exemples">            } else {</p>
          <blockquote>
            <p class="exemples"> <strong>$f-&gt;frm_ChampsRecopier</strong>();<br>
              <strong>$f-&gt;frm_ChampEnErreur</strong>(&quot;CHOIX&quot;, &quot;&lt;h1&gt;ATTENTION&lt;/h1&gt;Confort doit etre coch&eacute;es&quot;);</p>
          </blockquote>
          <p class="exemples">            }<br>
            break;</p>
        </blockquote>
        <p class="exemples"> default :</p>
        <blockquote>
          <p class="exemples">          header('Location: '.$url_cible);</p>
        </blockquote>
        <p class="exemples"> }</p>
      </blockquote>
      <p class="exemples">?&gt;...</p>
      <p class="exemples">&lt;HTML&gt;...</p>
      <p class="exemples">&lt;?php</p>
      <blockquote>
        <p class="exemples">if (!<strong>f$-&gt;frm_IsMessage()</strong>) {</p>
        <blockquote>
          <p class="exemples">print '&lt;span class=&quot;titre1&quot;&gt; TITRE AFFICHE AVANT LE FORMULAIRE&lt;/span&gt;'; </p>
        </blockquote>
        <p class="exemples">} </p>
        <p class="exemples"><strong>$f-&gt;frm_Ouvrir()</strong>;</p>
        <p class="exemples">if (<strong>f$-&gt;frm_Reentrant()</strong>) {</p>
        <blockquote>
          <p class="exemples">print '&lt;hr&gt;';</p>
        </blockquote>
        <p class="exemples">}</p>
      </blockquote>
      <p class="exemples">?&gt;</p>
    </blockquote>
    <p><a href="sample50_message_ok.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></p>
  </ol>
  <p>&nbsp;</p>
  <p></p>
  <ol>
    <blockquote></blockquote>
  </ol>
  <hr>
  <h2><a name="FOCUS" id="FOCUS"></a>14) LA FONCTION &quot;FOCUS&quot; <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol>
Il peut &ecirc;tre interressant de &quot;rentrer&quot; directement dans le formulaire en pla&ccedil;ant le curseur directement dans un champ pr&eacute;cis ou plus implement le 1er chanp ( surtout pour des saisies enchain&eacute;es ). <br>
Pour r&eacute;aliser cette fonction 2 m&eacute;thodes : <br>
<br>
<ol>
  <li><span class="exemples">$f-&gt;frm_Init(false,&quot;150px&quot;,<strong>true</strong>);</span><br>
    <br>
    place le curseur sur le 1er champ saisissable du formulaire, les champs inactifs ou en lecture seule sont &quot;saut&eacute;s&quot;<br>
    <br>
  </li>
  <li><span class="exemples"> $f-&gt;frm_Init(false,&quot;150px&quot;);<br>
    // DEFINITION DES CHAMPS<br>
    ... 
    <br> 
    $f-&gt;<strong>frm_InitFocus</strong>(&quot;NOMDUCHAMP&quot;);<br>
    $f-&gt;frm_Ouvrir();<br>
    <br>
  </span>place le curseur sur le champ pr&eacute;cis&eacute; en param&egrave;tre </li>
  </ol>
<p>La fonction frm_InitFocus() pr&eacute;sente un autre int&eacute;r&ecirc;t : pouvoir s&eacute;lectionner le champ.</p>
<p><span class="exemples">$f-&gt;<strong>frm_InitFocus</strong>(&quot;NOMDUCHAMP&quot;,<strong>true</strong>);</span> // le champ est s&eacute;lectionn&eacute; </p>
<p><img src="image45_selection.gif" width="399" height="168" border="2"> </p>
<p><span class="exemples">$f-&gt;<strong>frm_InitFocus</strong>(&quot;NOMDUCHAMP&quot;,<strong>false</strong>);</span> // le champ ne sera pas s&eacute;lectionn&eacute;</p>
<p><a href="sample60_focus.php" class="exemples"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a> </p>
<blockquote>
  <p class="exemples">&nbsp;</p>
    </blockquote>
  </ol>
  <p>&nbsp; </p>
  <hr>
  <h3>&nbsp;</h3>
  <h2><a name="ANNEXES" id="ANNEXES"></a>A) LES EXEMPLES <a href="#SOMMAIRE"><img src="btnmini_debutpage.gif" width="22" height="21" border="0"></a></h2>
  <ol><blockquote><p>&nbsp;</p>
    <h3><a name="palettespredefinies" id="palettespredefinies"></a>A.1) Exemples de codes <a href="javascript:history.go(-1);"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></h3>
    <table width="948" border="1" cellpadding="2" cellspacing="0">
      <tr>
        <td width="232" valign="top"><a href="sample01_palette.php">sample01_palette.php</a></td>
        <td width="26"><div align="center"><a href="#initpalette"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td width="670">Utilisation des skins </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample02_nolabel.php">sample02_nolabel.php</a></td>
        <td><div align="center"><a href="#masquerlabel"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Masquer la colonne des labels de champs </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample02_protection.php">sample02_protection.php</a></td>
        <td><div align="center"><a href="#protection"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Protection du clic droit </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample03_masques.php">sample03_masques.php</a></td>
        <td><div align="center"><a href="#masques"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Utilisation des masques de saisie d'in fichier texte </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample04_dates.php">sample04_dates.php</a></td>
        <td><div align="center"><a href="#champ_texte_date"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Utilisation des formats date et timestamp dans un champ texte </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes.php">sample05_listes.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Diff&eacute;rentes listes </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade.php">sample05_listes_cascade.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade, &eacute;volution de l'objet frm_Objet2Listes() qui &eacute;tait limit&eacute; &agrave; 2 </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade2.php">sample05_listes_cascade2.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade avec option de debuggage </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade3.php">sample05_listes_cascade3.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade pilot&eacute;e par bouton radio </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade4.php">sample05_listes_cascade4.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade multi-niveau </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade4.php">sample05_listes_cascade5.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade multi-niveau avec retour dans un champ particulier </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade6.php">sample05_listes_cascade6.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade multi-niveau avec envoi de parametres a la page qui g&eacute;n&egrave;re du XML </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_cascade7.php">sample05_listes_cascade7.php</a></td>
        <td><div align="center"><a href="#listescascade"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en cascade avec initialisation de 1ere liste en AJAX </td>
      </tr>
      <tr>
<td valign="top"><a href="sample05_listes_editables.php">sample05_listes_editables.php</a></td>
<td><div align="center"><a href="#listeeditable"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
<td>Listes &eacute;ditables </td>
</tr>
      <tr>
        <td valign="top"><a href="sample05_liste_longue_seule.php">sample05_liste_longue_seule.php</a></td>
        <td><div align="center"><a href="#listelongue"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste longue seule avec filtrage dynamique </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_longues.php">sample05_listes_longues.php</a></td>
        <td><div align="center"><a href="#listelongue"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes longues avec filtrage dynamique </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_longues_ajax.php">sample05_listes_longues_ajax.php</a></td>
        <td><div align="center"><a href="#listelongue"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes longues avec filtrage dynamique de type AJAX (donn&eacute;es en XML) </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_longues_ajax_param.php">sample05_listes_longues_ajax_param.php</a></td>
        <td><div align="center"><a href="#listelongue"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes longues avec filtrage dynamique de type AJAX (donn&eacute;es en XML) et prise en compte d'autres champs pour modifier les filtres </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample05_listes_longues_script.php">sample05_listes_longues_script.php</a></td>
        <td><div align="center"><a href="#listelongue"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes longues avec filtrage dynamique, sasie possible et script </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample09_listes_bascule.php">sample09_listes_bascule.php</a></td>
        <td><div align="center"><a href="#listebascule"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en bascule avec ou sans option de tri </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample09_listes_bascule.php">sample09_listes_bascule_radio.php</a></td>
        <td><div align="center"><a href="#listebascule"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Listes en bascule avec ou sans option de triavec activation par champ radio </td>
      </tr>
      <tr>
  <td valign="top"><a href="sample06_memo_editeur.php">sample06_memo_editeur.php</a></td>
  <td><div align="center"><a href="#champ_memo_editeur"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
  <td>Champs m&eacute;mo et editeur de texte </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample06_memo_editeur.php">sample06_editeur.php</a></td>
        <td><div align="center"><a href="#champ_memo_editeur"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champs &eacute;diteur de texte FCKeditor </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample36_memo_editeur_onglet.php">sample36_memo_editeur_onglet.php</a></td>
        <td><div align="center"><a href="#champ_memo_editeur"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>idem mais dans un onglet </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample33_coche_simples.php">sample33_coche_simple.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ checkbox</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample07_coche_radio.php">sample07_coche_radio.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ radio et coche, activation dynamique de champs </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample07_radio.php">sample07_radio.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ radio avec activation dynamique de groupes de champs </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample07_radio_2.php">sample07_radio_2.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>idem avec champ en intersection </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample07_radio_onglets.php">sample07_radio_onglets.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ radio avec activation dynamique de groupes de champs r&eacute;partis dans des onglets </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample07_radio_onglets2.php">sample07_radio_onglets2.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ radio avec activation dynamique de groupes de champs r&eacute;partis dans des onglets </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample33_coche_graphiques.php">sample33_coche_graphiques.php</a></td>
        <td><div align="center"><a href="#champlistesimple"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champs checkbox modifi&eacute;s </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample08_onglets.php">sample08_onglets.php</a></td>
        <td><div align="center"><a href="#onglets"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Utililisation des onglets pour simplifier les formulaires trop denses </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample11_submit.php">sample11_submit.php</a></td>
        <td><div align="center"><a href="#attributS"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Gestion dynamique de la r&eacute;entrance sur un champ</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample12_champenerreur.php">sample12_champenerreur.php</a></td>
        <td><div align="center"><a href="#champerreur"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Gestion par programmation des champs en erreur </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample13_sliders.php">sample13_sliders.php</a></td>
        <td><div align="center"><a href="#champslider"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Emploi des Sliders pour choisir graphiquement des nombre entier dans un intervalle donn&eacute; </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample14_boutons.php">sample14_boutons.php</a></td>
        <td><div align="center"><a href="#attributS"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Modification du libell&eacute; des boutons standards </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample15_consultation.php">sample15_consultation.php</a></td>
        <td><div align="center"><a href="#LECTURESEULE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Gestion du mode consultation d'un formulaire</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample15_readonly.php">sample15_readonly.php</a></td>
        <td><div align="center"><a href="#LECTURESEULE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Gestion du mode lecture seule de certains champ d'un formulaire</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample16_attributs.php">sample16_attributs.php</a></td>
        <td><div align="center"><a href="#attribtexte"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Attributs de saisie des champs textes (U,I, L, M) </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample17_sautlignes.php">sample17_sautlignes.php</a></td>
        <td><div align="center"><a href="#attributS"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Affichage de saut de ligne entre les champs </td>
      </tr>
      <tr bgcolor="#EFEFEF">
        <td valign="top"><p>&nbsp;</p>
          <p><a href="sample18_touslesobjets.php">            sample18_TOUSLESOBJETS.php</a></p>            <p><br> 
          </p></td>
        <td><div align="center"></div></td>
        <td>Catalogue de tous les objets &agrave; afficher </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample19_popup.php">sample19_popup.php</a></td>
        <td><div align="center"><a href="#champtextepopup"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ Popup appelant une autre page dans une fen&ecirc;tre popup plac&eacute;e automatiquement sous le champ </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample20_separateurs.php">sample20_separateurs.php</a></td>
        <td><div align="center"><a href="#onglets"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Champ Entete de s&eacute;paration de paragraphe, permet comme avec les onglets de g&eacute;rer un nombre important de champs </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample21_separateurs_onglets.php">sample21_separateurs_onglets</a></td>
        <td><div align="center"><a href="#onglets"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>idem mais avec des onglets &agrave; g&eacute;rer pour un nombre tr&egrave;s important de champs </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample22_arbres.php">sample22_arbres.php</a></td>
        <td><div align="center"><a href="#champtree"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Gestion d'arbres</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample23_icones.php">sample23_icones.php</a></td>
        <td><div align="center"><a href="#champcolorpicker"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Selecteur d'icones (s'appuie sur le m&eacute;canisme des champs POPUP) </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample24_icones.php">sample24_icones.php</a></td>
        <td><div align="center"><a href="#champcolorpicker"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Selecteur d'icones dans un onglet </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample25_confirm.php">sample25_confirm.php</a></td>
        <td><div align="center"><a href="#confirmation"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Confirmation d'un ajout ou d'une modification par boite de dialogue </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample27_scroller.php">sample27_scroller.php</a><br>            
          <a href="sample27_scroller2.php">sample27_scroller2.php</a><br>
        <a href="sample28_scroller_coche_radio.php">sample28_scroller_coche_radio.php</a><br></td>
        <td><div align="center"><a href="#onglets"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Affichage d'une zone de scroll pour que les boutons valider/annuler restent immobiles<br>
        2 modes possibles &quot;automatique ou manuel&quot; </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample29_timer.php">sample29_timer</a></td>
        <td><div align="center"><a href="#champtimer"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>la gestion du champ heure dynamique </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample30_javascript.php">sample30_javascript</a></td>
        <td><div align="center"><a href="#codejavascript"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Ex&eacute;cuter un javascript a chaque sortie de champ pour r&eacute;aliser un calcul par exemple. </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample31_colorpicker.php">sample31_colorpicker</a></td>
        <td><div align="center"><a href="#champcolorpicker"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>S&eacute;lecteur de couleur de fond ou de texte(utilise les fonctions popups pour charger le s&eacute;lecteur) </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample34_taillepolice.php">sample34_taillepolice.php</a></td>
        <td><div align="center"><a href="#taillepolice"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Taille par d&eacute;faut de la police de caract&egrave;re </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample35_bufferedoutput.php">sample35_bufferedoutput.php</a></td>
        <td><div align="center"><a href="#BUFFER"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Bufferisation des sorties </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample37_sortselect.php">sample37_sortselect.php</a></td>
        <td><div align="center"><a href="#sortselect"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste &agrave; trier </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample38_sortselect_separator.php">sample38_sortselect_separator.php</a></td>
        <td><div align="center"><a href="#sortselect"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste &agrave; trier avec s&eacute;parateurs &agrave; ins&eacute;rer </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample39_multiliste_normale.php">sample39_multiliste_normale.php</a></td>
        <td><div align="center"><a href="#multiliste"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste &agrave; choix multiple simple </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample40_multiliste_blocs.php">sample41_multiliste_bloc.php</a></td>
        <td><div align="center"><a href="#multiliste"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste &agrave; choix multiple avec v&eacute;rification que la s&eacute;lection est bien une plage d'&eacute;l&eacute;ments contigus </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample42_multiliste_script.php">sample42_multiliste_script.php</a></td>
        <td><div align="center"><a href="#multiliste"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Liste &agrave; choix multiple avec v&eacute;rification du nombre d'options s&eacute;lectionn&eacute;es</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample43_uploader_simple.php">sample43_uploader_simple.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>T&eacute;l&eacute;chargement de fichiers dans un r&eacute;pertoire particulier, test de l'option &quot;overwrite&quot; </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample44_uploader_prefixed.php">sample44_uploader_prefixed.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Idem avec  test de l'option &quot;preview&quot; pour les fichiers images </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample44_uploader_resizing.php">sample44_uploader_resizing.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>redimensionnement des fichiers images </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample45_uploader_multi.php">sample45_uploader_multi.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>T&eacute;l&eacute;chargement de 1 &agrave; n fichiers simultan&eacute;ments, chaque ajout enrichit une liste </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample46_uploader_multifilesmax.php">sample46_uploader_multifilesmax.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>idem avec un nombre maximum de fichier </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample47_uploader_filesinorder.php">sample47_uploader_filesinorder.php</a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>idem avec la possibilit&eacute; de changer l'ordre des fichiers dans la liste </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample49_timeout.php">sample49_timeout.php </a><a name="TIMEOUT_EXEMPLE" id="TIMEOUT_EXEMPLE"></a></td>
        <td><div align="center"><a href="#uploader"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Fenetre de saisie avec timeout</td>
      </tr>
      <tr>
        <td valign="top"><a href="sample50_message_ok.php">sample50_message_ok.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Message de bon enregistrement et timeout </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample51_message_simple.php">sample51_message_simple.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Message de bon enregistrement </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample51_message_simple_target.php">sample51_message_simple_target.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Message de bon enregistrement avec branchement dans une autre fen&ecirc;tre </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample52_titre_simple.php">sample52_titre_simple.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Affichage d'un titre simplement </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample53_titre_ou_message.php">sample53_titre_ou_message.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Affichage d'un titre ou un message simplement </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample60_focus.php">sample60_focus.php</a></td>
        <td><div align="center"><a href="#FOCUS"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Activation d'un champ particulier du formulaire </td>
      </tr>
      <tr>
        <td valign="top"><a href="sample60_focus.php">sample61_focus_premier.php</a></td>
        <td><div align="center"><a href="#FRM_MESSAGE"><img src="aide5.gif" width="16" height="16" border="0"></a></div></td>
        <td>Activation du 1er champ du formulaire </td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <blockquote>
      <p><span class="exemples"><a href="sample18_touslesobjets.php"><img src="php_script_ico.png" alt="Voir un exemple (si installation achev&eacute;e)" width="32" height="32" border="0"></a></span></p>
    </blockquote>
    <h3><a name="palettespredefinies" id="palettespredefinies"></a>A.2) Utilisation des palettes pr&eacute;-d&eacute;finies <a href="javascript:history.go(-1);"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></h3>
    <p><img src="image03_palettes.gif" width="580" height="381" border="2"></p>
  </blockquote>
  </ol>
  <blockquote>
    <p>&nbsp;</p>
</blockquote>
  <ol>
    <blockquote>
      <p>&nbsp;</p>
    </blockquote>
  </ol>
</body>
</html>
