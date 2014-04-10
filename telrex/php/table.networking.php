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
Editor::inst( $db, 'networking' )
	->fields(
		Field::inst( 'ip_addr' )
			->validator( 'Validate::ip_required' ),
		Field::inst( 'mask' )
			->validator( 'Validate::ip_required' ),
                Field::inst( 'dfgw' )
			->validator( 'Validate::ip_required' ),
		Field::inst( 'dns' )
			->validator( 'Validate::ip_required' )
	)
	->process( $_POST )
	->json();

