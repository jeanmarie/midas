<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EFFACER LE REPERTOIRE TEMPORAIRE DES FICHIERS TELECHARGES</title>
</head>

<body>
<p>
  <?php

$rep_temp = '../../../rubappli/tmp';
$cpt = 0;
if ($handle = opendir($rep_temp)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
			unlink($rep_temp.'/'.$file);
            echo "<b> $file </b> effacé !<br>\n";
			$cpt++;
        }
    }
    closedir($handle);
}
if ($cpt==0) {
	print "Le répertoire temporaire était vide !";
} else {
	print "nombre de fichiers effacés = " . $cpt;
}

?>
</p>
<p><a href="javascript:self.close();">fermer la fenetre</a> </p>
</body>
</html>
