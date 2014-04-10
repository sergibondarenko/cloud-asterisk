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
Editor::inst( $db, 'musiconhold' )
	->fields(
		Field::inst( 'name' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'directory' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'application' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'mode' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'digit' ),
			//->validator( 'Validate::maxLen_required', 11 ),
		Field::inst( 'sort' ),
			//->validator( 'Validate::maxLen_required', 11 )
		Field::inst( 'format' )
	)
	->process( $_POST )
	->json();

