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
Editor::inst( $db, 'sipfriends' )
	->fields(
		Field::inst( 'name' )
			->validator( 'Validate::maxLen_required', 18 ),
		/*Field::inst( 'auth' ),*/
		Field::inst( 'defaultuser' ),
		Field::inst( 'callerid' ),
		Field::inst( 'type' )
			->validator( 'Validate::required' ),
		Field::inst( 'context' )
			->validator( 'Validate::required' ),
		Field::inst( 'host' )
			->validator( 'Validate::maxLen_required', 25 ),
		Field::inst( 'secret' ),
		Field::inst( 'qualify' )
			->validator( 'Validate::required' ),
		Field::inst( 'nat' )
			->validator( 'Validate::required' ),
		Field::inst( 'directmedia' )
			->validator( 'Validate::required' ),
		Field::inst( 'dtmfmode' )
			->validator( 'Validate::required' ),
		Field::inst( 'hasvoicemail' )
		
	)
	->process( $_POST )
	->json();
