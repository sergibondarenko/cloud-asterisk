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
Editor::inst( $db, 'queue_members' )
	->fields(
		Field::inst( 'uniqueid' ),
		Field::inst( 'membername' ),
			//->validator( 'Validate::maxLen_required', 40 ),
		Field::inst( 'queue_name' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'interface' ),
			//->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'penalty' ),
			//->validator( 'Validate::maxLen_required', 11 ),
		Field::inst( 'paused' )
			//->validator( 'Validate::maxLen_required', 11 )
	)
	->process( $_POST )
	->json();

