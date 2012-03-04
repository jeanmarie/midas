<?php
	header("Content-Type: text/xml"); 
	header("Cache-Control: no-cache");
	print '<?xml version="1.0" encoding="ISO-8859-15"?>';
	print "\n<root>";
	if ($_POST['PARAM']=='1') {
		donnees_dynamiques();
	} else {
		donnees_statiques();
	}
	print "\n</root>\n";




function donnees_dynamiques() {
	for ($i=1;$i<=500;$i++) {
		print "\n";
		print '<option value="'.$i.'">'.$i.'</option>';
	}
}

function donnees_statiques() {
		print "\n";
		print '<option value="1">';
		print stripslashes(htmlspecialchars($_POST['CHAMP1']));
		print '</option>';
		print "\n";
		print '<option value="2">Deux</option>';
		print "\n";
		print '<option value="3">Trois</option>';
		print "\n";
		print '<option value="4">Quatre</option>';
		print "\n";
		print '<option value="5">'.htmlspecialchars('Cinq é & à ] @ ').'</option>';
}

?>