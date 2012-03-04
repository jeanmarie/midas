<?php
	include('classeForms.php');		

	$f = New Forms;
	$f->frm_uploader( array(	'title'         => 'photo mettre à la bonne taille',
								'target'        => '../../../rubappli/tmp/',
								'maxfilesize'   => 2048*1024,
								'delete'       => true,
								'space'        => '_',
								'filter'       => true,
								'extensions'   => 'JPG|JPEG'
							) 
					 );
?>
