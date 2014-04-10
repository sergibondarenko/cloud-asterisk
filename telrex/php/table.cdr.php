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
Editor::inst( $db, 'cdr' )
	->fields(
		Field::inst( 'calldate' ),
		Field::inst( 'clid' ),
		Field::inst( 'src' ),
		Field::inst( 'dst' ),
		Field::inst( 'dcontext' ),
		Field::inst( 'channel' ),
		Field::inst( 'dstchannel' ),
		Field::inst( 'lastapp' ),
		Field::inst( 'lastdata' ),
		Field::inst( 'duration' ),
		Field::inst( 'billsec' ),
		Field::inst( 'disposition' )/*,
		Field::inst( 'amaflags' ),
		Field::inst( 'accountcode' ),
		Field::inst( 'uniqueid' ),
		Field::inst( 'userfield' )*/
	)
	->process( $_POST )
	->json();
