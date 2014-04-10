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


/*
 * Example PHP implementation used for the join.html example
 */
$editor = Editor::inst( $db, 'users' )
	->field( 
		Field::inst( 'first_name' )->validator( 'Validate::required' ),
		Field::inst( 'last_name' )->validator( 'Validate::required' )
	)
	->join(
		Join::inst( 'dept', 'object' )
			->join(
				array( 'id', 'user_id' ),
				array( 'id', 'dept_id' ),
				'user_dept'
			)
			->field(
				Field::inst( 'id' )->validator( 'Validate::required' ),
				Field::inst( 'name' )
			),
		Join::inst( 'access', 'array' )
			->join(
				array( 'id', 'user_id' ),
				array( 'id', 'access_id' ),
				'user_access'
			)
			->field(
				Field::inst( 'id' )->validator( 'Validate::required' ),
				Field::inst( 'name' )
			),
		Join::inst( 'extra', 'object' )
			->join( 'id', 'user_id' )
			->field(
				Field::inst( 'comments' ),
				Field::inst( 'review' )
			)
	);

// The "process" method will handle data get, create, edit and delete 
// requests from the client
$out = $editor
	->process($_POST)
	->data();


// When there is no 'action' parameter we are getting data, and in this
// case we want to send extra data back to the client, with the options
// for the 'department' select list and 'access' radio boxes
if ( !isset($_POST['action']) ) {
	// Get department details
	$out['dept'] = $db
		->select( 'dept', 'id as value, name as label' )
		->fetchAll();

	$out['access'] = $db
		->select( 'access', 'id as value, name as label' )
		->fetchAll();
}

// Send it back to the client
echo json_encode( $out );

