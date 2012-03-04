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
.sommaire {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #999999;
}
-->
</style>
</head>

<body>
<?php
	include('_data_top_menu.php');

?>
<br><br>	
<h1 align="center"><a href="index.php"><img src="new4-167.gif" width="16" height="16" border="0"></a>HISTORIQUE DES MODIFICATIONS DE LA CLASSE : ClasseForms.php</h1>
<p align="center" class="exemples">AUTEUR : FRANCK OBERLECHNER, Ing&eacute;nieur Syst&egrave;me et R&eacute;seaux </p>
<hr>
<h1 align="left">LES NOUVEAUX OBJETS OU NOUVELLES FONCTIONS <a href="index.php"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></h1>
<blockquote>
  <table width="815" border="1" cellpadding="5" cellspacing="0">
    <tr>
      <td valign="top" class="exemples">2008 Mai </td>
      <td><ul>
          <li>Gestion AJAX de la liste longue <a href="sample05_listes_longues_ajax_param.php">(voir exemple)</a></li>
          <li>Cr&eacute;ation d'un nouvel objet  frm_ObjetListesCascade, traitement AJAX de listes en cascade </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2008 Avril </td>
      <td> <ul>
        <li>int&eacute;gration de la nouvelle version AJAX de FCKEditor v2.6 et son gestionnaire de fichiers </li>
        <li>ajout de l'ordre frm_MasquerLabel() qui permet de ne pas afficher la colonne des labels de champ </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2007 Novembre </td>
      <td><ul>
          <li>int&eacute;gration des correctifs aimablement sugg&eacute;r&eacute;s par Robert BRACCAGNI sur la compatibilit&eacute; FIREFOX </li>
          <li>le bouton radio peut activer des champs communs <a href="sample07_radio_2.php">(voir exemple)</a>   </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2007 Octobre </td>
      <td><ul>
          <li>Ajout de la methode <a href="sample60_focus.php">frm_InitFocus()</a> pour activer un champ en entrant dans un formulaire</li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2007 Aout </td>
      <td><ul>
          <li>Ajout de l'attribut 'titlevalue' pour l'objet liste quand la liste est d&eacute;roulante et que le non choix doit etre egal &agrave; une valeur par d&eacute;faut </li>
        </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2007 Mai </td>
      <td><ul>
          <li>Les formulaires peuvent avoir une dur&eacute;e de vie limit&eacute;e et revenir &agrave; une autre page si rien n'est saisi,<br> 
          voir <a href="sample49_timeout.php">l'exemple </a></li>
          <li>frm_Message() permet en section A1, M1, L1 d'informer que la sauvegarde s'est bien produite (voir <a href="sample50_message_ok.php">l'exemple</a>) </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2007 F&eacute;vrier </td>
      <td><ul>
        <li>L'objet <a href="sample07_radio.php">frm_ObjetBoutonsRadio</a> sait maintenant g&eacute;rer sur chacune de ses options 1 ou plusieurs champs, son impl&eacute;mentation conjointe avec des <a href="sample07_radio_onglets.php">onglets </a>permet une ergonomie in&eacute;gal&eacute;e. </li>
      </ul>      </td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2006 D&eacute;cembre </td>
      <td><ul>
          <li>L'objet <strong><a href="sample43_uploader_simple.php">Uploader</a></strong> pour t&eacute;l&eacute;charger des fichiers sur le site et les enregistrer simultan&eacute;ment dans un enregistrement d'une table le nom de ces fichiers ( remplace avantageusement feu l'objet Selecteur ) </li>
          <li>L'objet <strong><a href="sample09_listes_bascule.php">Bascule</a></strong> est r&eacute;&eacute;crit pour simplifier la gestion des boutons qui deviennent graphiques par la m&ecirc;me occasion. un nouvelle option &quot;sort&quot; permet de trier les options de la liste de droite </li>
          <li>Le code est optimis&eacute; pour minimiser le code PHP, en contre partie la biblioth&egrave;que commune Commun.js grandit mais pas de probl&egrave;me puisqu' apr&egrave;s le 1er t&eacute;l&eacute;chargement elle se situe dans le cache du navigateur </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2006 Novembre </td>
      <td><ul>
          <li>L'objet <strong><a href="sample39_multiliste_normale.php">MultiListe</a></strong> pour une liste &agrave; choix multiple avec choix cons&eacute;cutifs ou non </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2006 Mai </td>
      <td><ul>
          <li>L'attribut script permet un appel depuis chaque objet &agrave; une action param&egrave;trable manuellement. </li>
          </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2006 Mars </td>
      <td><ul>
          <li>L'apparition de FIREFOX v1.5 g&eacute;n&egrave;re un bug dans la gestion des dates (le code dateformat.js est modif&eacute;)<br>
            merci &agrave; Robert Braccagni pour sa contribution</li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2005 Octobre </td>
      <td><ul>
          <li>L'objet <strong>SortSelect</strong> pour trier les &eacute;l&eacute;ments d'une liste </li>
          <li>L'objet <strong>Editeur</strong> ne s'appuie plus sur la biblioth&egrave;que &quot;dhtmleditor&quot; mais sur l'excellent editeur html opensource <a href="http://www.fckeditor.net" target="_blank">FCKeditor </a>, l'objet peut &ecirc;tre int&eacute;gr&eacute; maintenant &agrave; un onglet (ce que dhtmleditor ne savait pas faire avec Mozilla ) et la barre d'outils prend la couleur du th&egrave;me </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2005 Septembre </td>
      <td><ul>
          <li>La g&eacute;n&eacute;ration du code se fait en direct avec un <strong>print</strong> ou bufferis&eacute;e avec un retour possible dans une<strong> variable<br>
            </strong>voir les fonction<strong> frm_initbuffer()</strong> et<strong> frm_flushbuffer()</strong></li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2005 Juin </td>
      <td><ul>
        <li>L'objet <strong>Coche</strong> (checkbox) devient graphique ce qui signifie que les graphiques sont personnalisables et que associ&eacute; &agrave; un champ de type hidden la valeur de la coche est retourn&eacute;e syst&eacute;matiquement m&ecirc;me quand elle n'est pas activ&eacute;e </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2005 Mai </td>
      <td><ul>
        <li>La classe inclut d&eacute;sormais le fichier <strong>_classePath</strong> qui d&eacute;finit la constante INCLUDEPATH, cette d&eacute;finition est utilis&eacute;e par toutes les autres classes de la collection </li>
        <li>D&egrave;s que l'on presse le bouton &quot;Valider&quot; les 2 boutons se d&eacute;sactivent ca qui permet d'&eacute;viter une annulation pendant une validation et donc laisser un enregistrement dans un &eacute;tat incertain. </li>
      </ul></td>
    </tr>
    <tr>
      <td width="128" valign="top" class="exemples">2005 Avril </td>
      <td width="661"><ul>
        <li>L'objet <strong>Colorpicker </strong>pour les couleurs de texte et de fond </li>
      </ul></td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2005 Mars</td>
      <td><ul>
          <li>L'objet <strong>Scrollers</strong></li>
          <li>L'objet <strong>Timer</strong> </li>
          <li>L'attribut <strong>script</strong> des champs textes </li>
          <li>La fonction <strong>frm_InitConfirmCancel()</strong> qui permet de demander confirmation de l'&eacute;v&eacute;nement .reset() provoqu&eacute; par le bouton &quot;R&eacute;tablir&quot; </li>
      </ul></td>
    </tr>
  </table>
  <p align="left" class="exemples">&nbsp;</p>
</blockquote>
<hr>
<h1 align="left">LES BUG CORRIGES <a href="index.php"><img src="btnmini_retour.gif" width="23" height="19" border="0"></a></h1>
<blockquote>
  <table width="815" border="1" cellpadding="5" cellspacing="0">
    <tr>
      <td valign="top" class="exemples">2007<br>
      Mai</td>
      <td><ul>
        <li>Depuis la mise &agrave; jour de l'objet calendar en version 1.0, il &eacute;tait devenu dans firefox incompatible avec les onglets.<br>
          la modification du z-index de .calendar dans le fichier &quot;calendar-system.css&quot; corrige ce probl&egrave;me
</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td valign="top" class="exemples">2006 Juillet </td>
      <td><ul>
          <li>Un guillemet pr&eacute;sent dans la chaine &quot;valeur par d&eacute;faut&quot; des champs textes provoquait la troncature de la chaine&agrave; ce caract&egrave;re. Les champs sont initialis&eacute;s non plus en HTML : VALUE=&quot;Valeur par D&eacute;faut&quot; mais en javascript</li>
        <li>Le RESET du formulaire ne r&eacute;tablissait que les valeurs et pas l'&eacute;tat de l'objet (disabled ou non). L'&eacute;tat de tous les champs qui compose un objet du formulaire sont sauvegard&eacute;s au chargement de la page et restaur&eacute;s quand on clique sur &quot;R&eacute;tablir&quot;</li>
      </ul></td>
    </tr>
    <tr>
      <td class="exemples">2005 Oct</td>
      <td><ul>
          <li>Le style ( italic ou normal ) du champ comboBox n'etait pas remis &agrave; z&eacute;ro apr&egrave;s avoir appuy&eacute; sur &quot;R&eacute;tablir&quot;, un champ XXX_STYLE est ajout&eacute; pour sauvegarder son &eacute;tat iniital </li>
      </ul></td>
    </tr>
    <tr>
      <td width="84" class="exemples">2005 Mars</td>
      <td width="699"><ul>
        <li>La fonction javascript handleEnter() de Communs.js charg&eacute; de g&eacute;rer le passage au champ suivant par la touche ENTER saute les champs en lecture seule ( ReadOnly = &quot;true&quot; ) et passe au premier champ actif qui suit </li>
      </ul></td>
    </tr>
  </table>
</blockquote>
</body>
</html>
