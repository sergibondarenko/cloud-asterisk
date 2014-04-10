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
Editor::inst( $db, 'voicemails' )
	->fields(
		Field::inst( 'customer_id' )
			->validator( 'Validate::maxLen_required', 11 ),
		Field::inst( 'context' )
			->validator( 'Validate::maxLen_required', 20 ),
		Field::inst( 'mailbox' )
			->validator( 'Validate::maxLen_required', 11 ),
		Field::inst( 'password' )
			->validator( 'Validate::maxLen_required', 5 ),
		Field::inst( 'fullname' )
			->validator( 'Validate::maxLen_required', 40 ),
		Field::inst( 'email' )
			->validator( 'Validate::maxLen_required', 50 )
	)
	->process( $_POST )
	->json();

