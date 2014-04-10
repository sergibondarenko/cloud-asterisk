<?php


// DataTables PHP library
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Validate;


// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'agents' )
	->fields(
		Field::inst( '1' )
			->validator( 'Validate::maxLen_required', 10 ),
		Field::inst( '2' )
			->validator( 'Validate::maxLen_required', 15 ),
		Field::inst( '3' )
			->validator( 'Validate::maxLen_required', 40 ),
		Field::inst( '4' )
	)
	->process( $_POST )
	->json();

