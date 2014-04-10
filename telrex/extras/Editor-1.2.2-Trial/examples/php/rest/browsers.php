<?php

/*
 * Example PHP implementation used for the REST example.
 * This file defines a DTEditor class instance which can then be used, as
 * required, by the CRUD actions.
 */

// DataTables PHP library
include( dirname(__FILE__)."/../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Validate;

// Build our Editor instance and process the data coming from _POST
$editor = Editor::inst( $db, 'browsers' )
	->fields(
		Field::inst( 'engine' )->validator( 'Validate::required' ),
		Field::inst( 'browser' )->validator( 'Validate::required' ),
		Field::inst( 'platform' ),
		Field::inst( 'version' ),
		Field::inst( 'grade' )->validator( 'Validate::required' )
	);
