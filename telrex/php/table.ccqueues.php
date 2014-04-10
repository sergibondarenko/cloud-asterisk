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
Editor::inst( $db, 'queues' )
	->fields(
		Field::inst( 'name' )
			->validator( 'Validate::maxLen_required', 128 ),
		Field::inst( 'musiconhold' )
			->validator( 'Validate::maxLen_required', 128 )
	)
	->process( $_POST )
	->json();

