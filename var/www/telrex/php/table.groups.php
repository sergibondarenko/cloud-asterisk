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
Editor::inst( $db, 'groups' )
	->fields(
		Field::inst( '1' ),
		Field::inst( '2' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( '3' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( '4' ),
		Field::inst( '5' ),
		Field::inst( '6' ),
		Field::inst( '7' ),
		Field::inst( '8' ),
		Field::inst( '9' ),
		Field::inst( '10' ),
		Field::inst( '11' ),
		Field::inst( '12' ),
		Field::inst( '13' ),
		Field::inst( '14' ),
		Field::inst( '15' ),
		Field::inst( '16' )
	)
	->process( $_POST )
	->json();

