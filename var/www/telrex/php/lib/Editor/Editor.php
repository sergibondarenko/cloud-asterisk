<?php
/**
 * DataTables PHP libraries.
 *
 * PHP libraries for DataTables and DataTables Editor, utilising PHP 5.3+.
 *
 *  @author    SpryMedia
 *  @copyright 2012 SpryMedia ( http://sprymedia.co.uk )
 *  @license   http://editor.datatables.net/license DataTables Editor
 *  @link      http://editor.datatables.net
 */

namespace DataTables;
if (!defined('DATATABLES')) exit();

use
	DataTables,
	DataTables\Editor,
	DataTables\Editor\Join,
	DataTables\Editor\Field;


/**
 * DataTables Editor base class for creating editable tables.
 *
 * Editor class instances are capable of servicing all of the requests that
 * DataTables and Editor will make from the client-side - specifically:
 * -   Get data
 * -   Create new record
 * -   Edit existing record
 * -   Delete existing records
 *
 * The Editor instance is configured with information regarding the
 * database table fields that you which to make editable, and other information
 * needed to read and write to the database (table name for example!).
 *
 * This documentation is very much focused on describing the API presented
 * by these DataTables Editor classes. For a more general overview of how
 * the Editor class is used, and how to install Editor on your server, please
 * refer to the {@link http://editor.datatables.net/tutorials Editor tutorials}.
 *
 *  @example 
 *    A very basic example of using Editor to create a table with four fields.
 *    This is all that is needed on the server-side to create a editable
 *    table - the {@link process} method determines what action DataTables /
 *    Editor is requesting from the server-side and will correctly action it.
 *    <code>
 *      Editor::inst( $db, 'browsers' )
 *          ->fields(
 *              Field::inst( 'first_name' )->validator( 'Validate::required' ),
 *              Field::inst( 'last_name' )->validator( 'Validate::required' ),
 *              Field::inst( 'country' ),
 *              Field::inst( 'details' )
 *          )
 *          ->process( $_POST )
 *          ->json();
 *    </code>
 */
class Editor extends Ext {
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

	/**
	 * Constructor.
	 *  @param Database $db An instance of the DataTables Database class that we can
	 *    use for the DB connection. Can be given here or with the 'db' method.
	 *    <code>
	 *      456
	 *    </code>
	 *  @param string|array $table The table name in the database to read and write
	 *    information from and to. Can be given here or with the 'table' method.
	 *  @param string $pkey Primary key column name in the table given in the $table
	 *    parameter. Can be given here or with the 'pkey' method.
	 */
	function __construct( $db=null, $table=null, $pkey=null )
	{
		// Set constructor parameters using the API - note that the get/set will
		// ignore null values if they are used (i.e. not passed in)
		$this->db( $db );
		$this->table( $table );
		$this->pkey( $pkey );
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private properties
	 */

	/** @var DataTables\Database */
	private $_db = null;

	/** @var DataTables\Editor\Field[] */
	private $_fields = array();

	/** @var array */
	private $_formData;

	/** @var string */
	private $_idPrefix = 'row_';

	/** @var DataTables\Editor\Join[] */
	private $_join = array();

	/** @var string */
	private $_pkey = 'id';

	/** @var string[] */
	private $_table = array();

	/** @var array */
	private $_where = array();

	/** @var array */
	private $_out = array(
		"id" => -1,
		"error" => "",
		"fieldErrors" => array(),
		"data" => array()
	);



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

	/**
	 * Get the data constructed in this instance.
	 * 
	 * This will get the PHP array of data that has been constructed for the 
	 * command that has been processed by this instance. Therefore only useful after
	 * process has been called.
	 *  @return array Processed data array.
	 */
	public function data ()
	{
		return $this->_out;
	}


	/**
	 * Get / set the DB connection instance
	 *  @param Database $_ DataTable's Database class instance to use for database
	 *    connectivity. If not given, then used as a getter.
	 *  @return Database|self The Database connection instance if no parameter
	 *    is given, or self if used as a setter.
	 */
	public function db ( $_=null )
	{
		return $this->_getSet( $this->_db, $_ );
	}


	/**
	 * Get / set field instances.
	 * 
	 * The list of fields designates which columns in the table that Editor will work
	 * with (both get and set).
	 *  @param Field $_... Instances of the {@link Field} class, given as a single 
	 *    instance of {@link Field}, an array of {@link Field} instances, or multiple
	 *    {@link Field} instance parameters for the function.
	 *  @return Field[]|self Array of fields, or self if used as a setter.
	 *  @see {@link Field} for field documentation.
	 */
	public function field ( $_=null )
	{
		if ( $_ !== null && !is_array($_) ) {
			$_ = func_get_args();
		}
		return $this->_getSet( $this->_fields, $_, true );
	}


	/**
	 * Get / set field instances.
	 * 
	 * An alias of {@link field}, for convenience.
	 *  @param Field $_... Instances of the {@link Field} class, given as a single 
	 *    instance of {@link Field}, an array of {@link Field} instances, or multiple
	 *    {@link Field} instance parameters for the function.
	 *  @return Field[]|self Array of fields, or self if used as a setter.
	 *  @see {@link Field} for field documentation.
	 */
	public function fields ( $_=null )
	{
		if ( $_ !== null && !is_array($_) ) {
			$_ = func_get_args();
		}
		return $this->_getSet( $this->_fields, $_, true );
	}


	/**
	 * Get / set the DOM prefix.
	 *
	 * Typically primary keys are numeric and this is not a valid ID value in an
	 * HTML document - is also increases the likelihood of an ID clash if multiple
	 * tables are used on a single page. As such, a prefix is assigned to the 
	 * primary key value for each row, and this is used as the DOM ID, so Editor
	 * can track individual rows.
	 *  @param string $_ Primary key's name. If not given, then used as a getter.
	 *  @return string|self Primary key value if no parameter is given, or
	 *    self if used as a setter.
	 */
	public function idPrefix ( $_=null )
	{
		return $this->_getSet( $this->_idPrefix, $_ );
	}


	/**
	 * Get / set join instances.
	 * 
	 * The list of Join instances that Editor will join the parent table to (i.e. the one
	 * that the {@link table} and {@link fields} methods refer to in this class instance).
	 *  @param Join $_,... Instances of the {@link Join} class, given as a single instance 
	 *    of {@link Join}, an array of {@link Join} instances, or multiple {@link Join} 
	 *    instance parameters for the function.
	 *  @return Join[]|self Array of joins, or self if used as a setter.
	 *  @see {@link Join} for joining documentation.
	 */
	public function join ( $_=null )
	{
		if ( $_ !== null && !is_array($_) ) {
			$_ = func_get_args();
		}
		return $this->_getSet( $this->_join, $_, true );
	}


	/**
	 * Get the JSON for the data constructed in this instance.
	 * 
	 * Basically the same as the {@link data} method, but in this case we echo, or
	 * return the JSON string of the data.
	 *  @param boolean $print Echo the JSON string out (true, default) or return it
	 *    (false).
	 *  @return string|self self if printing the JSON, or JSON representation of 
	 *    the processed data if false is given as the first parameter.
	 */
	public function json ( $print=true )
	{
		if ( $print ) {
			echo json_encode( $this->_out );
			return $this;
		}
		return json_encode( $this->_out );
	}


	/**
	 * Get / set the table name.
	 * 
	 * The table name designated which DB table Editor will use as its data source for
	 * working with the database. Multiple names can be given in an array, which can be
	 * useful if applying a WHERE condition over multiple tables. Note that this is not
	 * required for working with the the 'join' method, which supplies its own table 
	 * names.
	 *  @param string|array $_,... Table names given as a single string, an array of
	 *    strings or multiple string parameters for the function.
	 *  @return string[]|self Array of tables names, or self if used as a setter.
	 */
	public function table ( $_=null )
	{
		if ( $_ !== null && !is_array($_) ) {
			$_ = func_get_args();
		}
		return $this->_getSet( $this->_table, $_, true );
	}


	/**
	 * Get / set the primary key.
	 *
	 * The primary key must be known to Editor so it will know which rows are being
	 * edited / deleted upon those actions. The default value is 'id'.
	 *  @param string $_ Primary key's name. If not given, then used as a getter.
	 *  @return string|self Primary key value if no parameter is given, or
	 *    self if used as a setter.
	 */
	public function pkey ( $_=null )
	{
		return $this->_getSet( $this->_pkey, $_ );
	}


	/**
	 * Process a request from the Editor client-side to get / set data.
	 *  @param array $data Typically $_POST or $_GET as required by what is sent by Editor
	 *  @return self
	 */
	public function process ( $data )
	{
		$this->_formData = isset($data['data']) ? $data['data'] : null;

		$this->_db->transaction();

		try {
			if ( !isset($data['action']) ) {
				/* Get data */
				$this->_out = array_merge( $this->_out, $this->_get( null, $data ) );
			}
			else if ( $data['action'] == "remove" ) {
				/* Remove rows */
				$this->_remove( $data );
			}
			else {
				/* Create or edit row */

				// Individual field validation
				for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
					$field = $this->_fields[$i];
					$validation = $field->validate( $this->_formData );

					if ( $validation !== true ) {
						$this->_out['fieldErrors'][] = array(
							"name" => $field->name(),
							"status" => $validation
						);
					}
				}

				// Global validation
				$this->_out['error'] = "";

				// Global validation - if you want global validation - do it here
				$this->_out['error'] = "";

				if ( count($this->_out['fieldErrors']) === 0 ) {
					if ( $data['action'] == "create" ) {
						$this->_out['row'] = $this->_insert();
					}
					else {
						$this->_out['row'] = $this->_update( $data['id'] );
					}
				}
			}

			$this->_db->commit();
		}
		catch (Exception $e) {
			// xxx error feedback
			$this->_db->rollback();
		}

		return $this;
	}


	/**
	 * Where condition to add to the query used to get data from the database.
	 * 
	 * Can be used in two different ways, as where( field, value ) or as an array of
	 * conditions to use: where( array('fieldName', ...), array('value', ...) );
	 *
	 * Please be very careful when using this method! If an edit made by a user using
	 * Editor removes the row from the where condition, the result is undefined (since
	 * Editor expects the row to still be available, but the condition removes it from
	 * the result set).
	 *  @param string|string[] $key   Single field name, or an array of field names.
	 *  @param string|string[] $value Single field value, or an array of values.
	 *  @param string          $op    Condition operator: <, >, = etc
	 *  @return string[]|self Where condition array, or self if used as a setter.
	 */
	public function where ( $key=null, $value=null, $op='=' )
	{
		if ( $key === null ) {
			return $this->_where;
		}

		$this->_where[] = array(
			"key"   => $key,
			"value" => $value,
			"op"    => $op
		);

		return $this;
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private methods
	 */

	/**
	 * Get an array of objects from the database to be given to DataTables as a
	 * result of an sAjaxSource request, such that DataTables can display the information
	 * from the DB in the table.
	 *  @param integer $id Primary key value to get an individual row (after create or
	 *    update operations). Gets the full set if not given.
	 *  @param array $http HTTP parameters from GET or POST request (so we can service
	 *    server-side processing requests from DataTables).
	 *  @private
	 */
	private function _get( $id=null, $http=null )
	{
		$ssp = array();
		$isSSP = isset( $http['sEcho'] );

		$query = $this->_db
			->query('select')
			->table( $this->_table )
			->get( $this->_pkey )
			->get( $this->_fields('get') );

		$this->_get_where( $query );

		// Server-side processing specific handling
		if ( $isSSP ) {
			// Add the server-side processing conditions
			$this->_ssp_limit( $query, $http );
			$this->_ssp_sort( $query, $http );
			$this->_ssp_filter( $query, $http );

			// Get the number of rows in the result set
			$ssp_set_count = $this->_db
				->query('select')
				->table( $this->_table )
				->get( 'COUNT('.$this->_pkey.') as cnt' );
			$this->_get_where( $ssp_set_count );
			$this->_ssp_filter( $ssp_set_count, $http );
			$ssp_set_count = $ssp_set_count->exec()->fetch();

			// Get the number of rows in the full set
			$ssp_full_count = $this->_db
				->query('select')
				->table( $this->_table )
				->get( 'COUNT('.$this->_pkey.') as cnt' );
			$this->_get_where( $ssp_full_count );
			$ssp_full_count = $ssp_full_count->exec()->fetch();

			$ssp = array(
				"sEcho" => intval( $http['sEcho'] ),
				"iTotalRecords" => $ssp_full_count['cnt'],
				"iTotalDisplayRecords" => $ssp_set_count['cnt']
			);
		}

		if ( $id !== null ) {
			$query->where( $this->_pkey, $id );
		}

		$res = $query->exec();
		if ( ! $res ) {
			throw new Exception('Error executing SQL for data get');
		}

		$out = array();
		while ( $row=$res->fetch() ) {
			$inner = array();
			$inner['DT_RowId'] = $this->_idPrefix . $row[ $this->_pkey ];

			for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
				$field = $this->_fields[$i];
				if ( $field->apply('get') ) {
					$inner[ $field->name() ] = $field->val('get', $row);
				}
			}

			$out[] = $inner;
		}

		for ( $i=0 ; $i<count($this->_join) ; $i++ ) {
			$this->_join[$i]->data( $this, $out );
		}

		return array_merge( array('aaData'=>$out), $ssp );
	}


	/**
	 * Insert a new row in the database
	 *  @private
	 */
	private function _insert( )
	{
		$set = array();

		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( 'set', $this->_formData ) ) {
				$set[ $field->dbField() ] = $field->val('set', $this->_formData);
			}
		}

		$res = $this->_db->insert( $this->_table, $set );
		if ( ! $res ) {
			return;
		}

		$id = $res->insertId();

		// Join tables
		for ( $i=0 ; $i<count($this->_join) ; $i++ ) {
			$this->_join[$i]->create( $this, $id, $this->_formData );
		}

		$this->_out['id'] = $this->_idPrefix . $id;

		// Get the data for the row so we can feed it back to the client and redraw
		// the whole row with the full data set from the server.
		$row = $this->_get( $id );
		return $row['aaData'][0];
	}


	/**
	 * Update a row in the database
	 *  @param string $id The DOM ID for the row that is being edited.
	 *  @private
	 */
	private function _update( $id )
	{
		$set = array();
		$id = str_replace( $this->_idPrefix, "", $id );

		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( 'set', $this->_formData ) ) {
				$set[ $field->dbField() ] = $field->val('set', $this->_formData);
			}
		}

		$res = $this->_db->update( $this->_table, $set, array($this->_pkey => $id) );
		if ( ! $res ) {
			return;
		}

		// And the join tables
		for ( $i=0 ; $i<count($this->_join) ; $i++ ) {
			$this->_join[$i]->update( $this, $id, $this->_formData );
		}

		$this->_out['id'] = $this->_idPrefix . $id;

		// Get the data for the row so we can feed it back to the client and redraw
		// the whole row with the full data set from the server.
		$row = $this->_get( $id );
		return $row['aaData'][0];
	}


	/**
	 * Delete one or more rows from the database
	 *  @private
	 */
	private function _remove( )
	{
		$ids = array();

		// Strip the ID prefix that the client-side sends back
		for ( $i=0 ; $i<count($this->_formData) ; $i++ ) {
			$ids[] = str_replace( $this->_idPrefix, "", $this->_formData[$i] );
		}

		// Remove rows from the master table
		$stmt = $this->_db
			->query( 'delete' )
			->table( $this->_table )
			->or_where( $this->_pkey, $ids )
			->exec();

		// And from the join tables
		for ( $i=0 ; $i<count($this->_join) ; $i++ ) {
			$this->_join[$i]->remove( $this, $ids );
		}
	}
	

	/**
	 * Create an array of the DB fields to use for a get / set operation.
	 *  @param string $direction Direction: 'get' or 'set'.
	 *  @return array List of fields
	 *  @private
	 */
	private function _fields ( $direction )
	{
		$fields = array();

		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->apply( $direction, $this->_formData ) ) {
				$fields[] = $field->dbField();
			}
		}

		return $fields;
	}


	/*  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *  *
	 * Server-side processing methods
	 */

	/**
	 * Convert a column index to a database field name - used for server-side
	 * processing requests.
	 *  @param array $http HTTP variables (i.e. GET or POST)
	 *  @param int $index Index in the DataTables' submitted data
	 *  @returns string DB field name
	 *  @private
	 */
	private function _ssp_field( $http, $index )
	{
		$dataProp = $http['mDataProp_'.$index];

		// For proper security spin through the fields, to make sure this is a known
		// field (i.e. someone hasn't just changed the mDataProp_{} value on the 
		// submit)
		for ( $i=0 ; $i<count($this->_fields) ; $i++ ) {
			$field = $this->_fields[$i];

			if ( $field->name() == $dataProp ) {
				return $dataProp;
			}
		}

		throw new Exception('Unknown field: '.$dataProp .' (index '.$index.')');
	}


	/**
	 * Sorting requirements to a server-side processing query.
	 *  @param Query $query Query instance to apply sorting to
	 *  @param array $http HTTP variables (i.e. GET or POST)
	 *  @private
	 */
	private function _ssp_sort ( $query, $http )
	{
		for ( $i=0 ; $i<$http['iSortingCols'] ; $i++ ) {
			if ( $http['bSortable_'.$i] == 'true' ) {
				$query->order(
					$this->_ssp_field( $http, $http['iSortCol_'.$i] ) .' '.
					($http['sSortDir_'.$i]==='asc' ? 'asc' : 'desc')
				);
			}
		}
	}


	/**
	 * Add DataTables' 'where' condition to a server-side processing query. This
	 * works for both global and individual column filtering.
	 *  @param Query $query Query instance to apply the WHERE conditions to
	 *  @param array $http HTTP variables (i.e. GET or POST)
	 *  @private
	 */
	private function _ssp_filter ( $query, $http )
	{
		// Global filter
		$fields = $this->_fields;

		if ( $http['sSearch'] != "" ) {
			$query->where( function ($q) use (&$fields, $http) {
				for ( $i=0 ; $i<count($fields) ; $i++ ) {
					$field = $fields[$i];

					$q->or_where( $field->name(), '%'.$http['sSearch'].'%', 'like' );
				}
			} );
		}

		// Column filters
		$i = 0;
		while ( isset( $http['sSearch_'.$i] ) ) {
			$search = $http['sSearch_'.$i];

			if( $search != "" &&  $http['bSearchable_'.$i] == 'true' ) {
				$query->where( $this->_ssp_field( $http, $i ), '%'.$search.'%', 'like' );
			}

			$i++;
		}
	}


	/**
	 * Add a limit / offset to a server-side processing query
	 *  @param Query $query Query instance to apply the offset / limit to
	 *  @param array $http HTTP variables (i.e. GET or POST)
	 *  @private
	 */
	private function _ssp_limit ( $query, $http )
	{
		if ( $http['iDisplayLength'] != -1 ) { // -1 is 'show all' in DataTables
			$query
				->offset( $http['iDisplayStart'] )
				->limit( $http['iDisplayLength'] );
		}
	}


	/**
	 * Add local WHERE condition to query
	 *  @param Query $query Query instance to apply the WHERE conditions ti
	 *  @private
	 */
	private function _get_where ( $query )
	{
		for ( $i=0 ; $i<count($this->_where) ; $i++ ) {
			$query->where(
				$this->_where[$i]['key'],
				$this->_where[$i]['value'],
				$this->_where[$i]['op']
			);
		}
	}
}


