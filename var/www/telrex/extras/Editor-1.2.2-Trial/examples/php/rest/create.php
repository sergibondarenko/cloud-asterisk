<?php

/*
 * Example PHP implementation used for the REST 'create' interface.
 */

include( "browsers.php" );

$editor
	->process($_POST)
	->json();

