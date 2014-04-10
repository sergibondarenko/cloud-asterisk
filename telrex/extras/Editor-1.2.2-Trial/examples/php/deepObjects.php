<?php

/*
 * Example PHP implementation used for the index.html example
 */

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
$json = Editor::inst( $db, 'browsers' )
	->fields(
		Field::inst( 'engine' )->validator( 'Validate::required' ),
		Field::inst( 'browser' )->validator( 'Validate::required' ),
		Field::inst( 'platform' ),
		Field::inst( 'version' ),
		Field::inst( 'grade' )->validator( 'Validate::required' )
	)
	->process( $_POST )
	->data();


// If getting data for the table, manipulate the output so it contains nested
// objects for the deepObjects example.
//
// You typically wouldn't do this here(!), but we do so for the deepObjects 
// example to show how the client-side can cope with nested objects
if ( !isset($_POST['action']) ) {
	for ( $i=0 ; $i<count($json['aaData']) ; $i++ ) {
		$json['aaData'][$i] = nestData( $json['aaData'][$i] );
	}
}
else {
	// create, edit or remove
	$json['row'] = nestData( $json['row'] );
}

echo json_encode( $json );



function nestData( $row )
{
	return array(
		"DT_RowId" => $row['DT_RowId'],
		"engine" => $row['engine'],
		"browser" => $row['browser'],
		"details" => array(
			"platform" => $row['platform'],
			"version" => $row['version'],
			"grade" => $row['grade']
		)
	);
}

