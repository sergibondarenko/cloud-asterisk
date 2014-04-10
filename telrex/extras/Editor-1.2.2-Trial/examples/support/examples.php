<?php

if ( isset( $_POST['src'] ) && preg_match( '/php\/[a-zA-Z_]+\.php/', $_POST['src'] ) !== 0 ) {
	echo htmlspecialchars( file_get_contents( '../'.$_POST['src'] ) );
}
else {
	echo '';
}


