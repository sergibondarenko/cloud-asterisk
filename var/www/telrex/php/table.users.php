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
Editor::inst( $db, 'users' )
	->fields(
		Field::inst( 'username' )
			->validator( 'Validate::maxLen_required', 40 ),
		Field::inst( 'password' )
			->validator( 'Validate::maxLen_required', 40 )/*,
		Field::inst( 'permissions' ),
		Field::inst( 'homedir' )*/
	)
	->process( $_POST )
	->json();

