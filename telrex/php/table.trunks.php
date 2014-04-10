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
Editor::inst( $db, 'siptrunks' )
	->fields(
		/*Field::inst( 'id' )
			->validator( 'Validate::maxLen_required', 25 ),*/
		Field::inst( 'name' )
			->validator( 'Validate::maxLen_required', 15 ),
		Field::inst( 'auth' )
			->validator( 'Validate::maxLen_required', 40 ),
		Field::inst( 'fromdomain' ),				
		Field::inst( 'type' )
			->validator( 'Validate::required' ),
		Field::inst( 'context' )
			->validator( 'Validate::maxLen_required', 12 ),
		Field::inst( 'host' )
			->validator( 'Validate::maxLen_required', 25 ),
		Field::inst( 'secret' )
			->validator( 'Validate::maxLen_required', 15 ),
		Field::inst( 'qualify' )
			->validator( 'Validate::required' ),
		Field::inst( 'nat' )
			->validator( 'Validate::required' ),
		Field::inst( 'directmedia' )
			->validator( 'Validate::required' ),
		Field::inst( 'dtmfmode' )
			->validator( 'Validate::required' )
		
	)
	->process( $_POST )
	->json();
