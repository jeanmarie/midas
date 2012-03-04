<?php
	include('classeForms.php');		

	$f = New Forms;
	$f->frm_uploader( array(	'target'      => '../../../rubappli/tmp/',
								'maxfilesize' => 2048*1024,''
								'delete'      => false,
								'space'       => '_',
								'filter'      => true,
								'extensions'  => 'GIF|PNG|JPG|JPEG|PDF'
							) 
					 );
?>
