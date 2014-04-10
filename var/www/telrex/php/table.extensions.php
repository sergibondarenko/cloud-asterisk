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
Editor::inst( $db, 'extensions' )
	->fields(
		Field::inst( 'comments' ),
		Field::inst( 'context' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( 'exten' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( 'priority' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( 'app' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( 'appdata' )
	)
	->process( $_POST )
	->json();

