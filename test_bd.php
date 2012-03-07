<?php
include("include/classeForms.php");
	include("include/classeBases.php");
	$p=$_GET['PASS'];
echo $p ." ---<br>";
	$base = New Bdd;
	$base->bdd_connecter("mysql",'localhost',"midas","root",$p);
echo " int en cours<br>";

	$base->bdd_auto_init("caisse","id_caisse","testdb.php");

echo " init terminée <br>";

	$nomtable='caisse';
echo "nom de la table : " .	$nomtable ."<br>";
	$t=$base->bdd_listertables();
print_r($t);
$s=$base->bdd_listerchamps($nomtable) ;
print_r($s);
?>