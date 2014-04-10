<?php

/*
 * Example PHP implementation used for the REST 'get' interface
 */

include( "browsers.php" );

$editor
	->process($_POST)
	->json();

