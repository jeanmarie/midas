<?php
	header("Content-Type: text/xml"); 
	header("Cache-Control: no-cache");
	print '<?xml version="1.0" encoding="ISO-8859-15"?>';
	print "\n<root>";
	for ($i=$_POST['DEBUT'];$i<=$_POST['FIN'];$i++) {
		print "\n";
		print '<option value="'.$i.'">'.$i.'</option>';
	}
	print "\n</root>\n";





?>