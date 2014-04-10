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
Editor::inst( $db, 'queue_log' )
	->fields(
		Field::inst( 'time' ),
		Field::inst( 'callid' ),
		Field::inst( 'queuename' ),
		Field::inst( 'agent' ),
		Field::inst( 'event' ),
		Field::inst( 'data1' ),
		Field::inst( 'data2' ),
		Field::inst( 'data3' ),
		Field::inst( 'data4' ),
		Field::inst( 'data5' )/*,
		Field::inst( 'billsec' ),
		Field::inst( 'disposition' ),
		Field::inst( 'amaflags' ),
		Field::inst( 'accountcode' ),
		Field::inst( 'uniqueid' ),
		Field::inst( 'userfield' )*/
	)
	->process( $_POST )
	->json();
