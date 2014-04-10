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

namespace DataTables\Editor;
if (!defined('DATATABLES')) exit();

use
	DataTables,
	DataTables\Editor,
	DataTables\Editor\Join,
	DataTables\Editor\Field;


/**
 * Field definitions for the DataTables Editor.
 *
 * Each Database column that is used with Editor can be described with this 
 * Field method (both for Editor and Join instances). It basically tells
 * Editor what table column to use, how to format the data and if you want
 * to read and/or write this column.
 *
 * Field instances are used with the {@link Editor::field} and 
 * {@link Join::field} methods to describe what fields should be interacted
 * with by the editable table.
 *
 *  @example
 *    Simply get a column with the name "city". No validation is performed.
 *    <code>
 *      Field::inst( 'city' )
 *    </code>
 *
 *  @example
 *    Get a column with the name "first_name" - when edited a value must
 *    be given due to the "required" validation from the {@link Validate} class.
 *    <code>
 *      Field::inst( 'first_name' )->validator( 'Validate::required' )
 *    </code>
 *
 *  @example
 *    Working with a date field, which is validated, and also has *get* and
 *    *set* formatters.
 *    <code>
 *      Field::inst( 'registered_date' )
 *          ->validator( 'Validate::dateFormat', 'D, d M y' )
 *          ->getFormatter( 'Format::date_sql_to_format', 'D, d M y' )
 *          ->setFormatter( 'Format::date_format_to_sql', 'D, d M y' )
 *    </code>
 */
class Field extends DataTables\Ext {
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Constructor
	 */

	/**
	 * Field instance constructor.
	 *  @param string $dbField Name of the database column
	 *  @param string $name Name to use in the JSON output from Editor and the
	 *    HTTP submit from the client-side when editing. If not given then the
	 *    $dbField name is used.
	 */
	function __construct( $dbField=null, $name=null )
	{
		if ( $dbField !== null && $name === null ) {
			// Allow just a single parameter to be passed - each can be 
			// overridden if needed later using the API.
			$this->dbField( $dbField );
			$this->name( $dbField );
		}
		else {
			$this->dbField( $dbField );
			$this->name( $name );
		}
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Private parameters
	 */

	/** @var string */
	private $_dbField = null;

	/** @var boolean */
	private $_get = true;

	/** @var mixed */
	private $_getFormatter = null;

	/** @var mixed */
	private $_getFormatterOpts = null;

	/** @var string */
	private $_name = null;

	/** @var boolean */
	private $_set = true;

	/** @var mixed */
	private $_setFormatter = null;

	/** @var mixed */
	private $_setFormatterOpts = null;

	/** @var mixed */
	private $_validator = null;

	/** @var mixed */
	private $_validatorOpts = null;



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */


	/**
	 * Get / set the DB field name.
	 *  @param string $_ Value to set if using as a setter.
	 *  @return string|self The name of the db field if no parameter is given,
	 *    or self if used as a setter.
	 */
	public function dbField ( $_=null )
	{
		return $this->_getSet( $this->_dbField, $_ );
	}


	/**
	 * Get / set the 'get' property of the field.
	 *
	 * A field can be marked as write only when setting the get property to false
	 * here.
	 *  @param boolean $_ Value to set if using as a setter.
	 *  @return boolean|self The get property if no parameter is given, or self
	 *    if used as a setter.
	 */
	public function get ( $_=null )
	{
		return $this->_getSet( $this->_get, $_ );
	}


	/**
	 * Get formatter for the field's data.
	 *
	 * When the data has been retrieved from the server, it can be passed through
	 * a formatter here, which will manipulate (format) the data as required. This
	 * can be useful when, for example, working with dates and a particular format
	 * is required on the client-side.
	 *
	 * Editor has a number of formatters available with the {@link Format} class
	 * which can be used directly with this method.
	 *  @param function|string $_ Value to set if using as a setter. Can be given as
	 *    a closure function or a string with a reference to a function that will
	 *    be called with call_user_func().
	 *  @param mixed $opts Variable that is passed through to the get formatting
	 *    function - can be useful for passing through extra information such as
	 *    date formatting string, or a required flag. The actual options available
	 *    depend upon the formatter used.
	 *  @return function|string|self The get formatter if no parameter is given, or 
	 *    self if used as a setter.
	 */
	public function getFormatter ( $_=null, $opts=null )
	{
		if ( $opts !== null ) {
			$this->_getFormatterOpts = $opts;
		}
		return $this->_getSet( $this->_getFormatter, $_ );
	}


	/**
	 * Get / set the 'name' property of the field.
	 *
	 * The name is typically the same as the dbField name, since it makes things
	 * less confusing(!), but it is possible to set a different name for the data
	 * which is used in the JSON returned to DataTables in a 'get' operation and
	 * the field name used in a 'set' operation.
	 *  @param string $_ Value to set if using as a setter.
	 *  @return string|self The name property if no parameter is given, or self
	 *    if used as a setter.
	 */
	public function name ( $_=null )
	{
		return $this->_getSet( $this->_name, $_ );
	}


	/**
	 * Get / set the 'set' property of the field.
	 *
	 * A field can be marked as read only when setting the get property to false
	 * here.
	 *  @param boolean $_ Value to set if using as a setter.
	 *  @return boolean|self The set property if no parameter is given, or self
	 *    if used as a setter.
	 */
	public function set ( $_=null )
	{
		return $this->_getSet( $this->_set, $_ );
	}


	/**
	 * Set formatter for the field's data.
	 *
	 * When the data has been retrieved from the server, it can be passed through
	 * a formatter here, which will manipulate (format) the data as required. This
	 * can be useful when, for example, working with dates and a particular format
	 * is required on the client-side.
	 * Editor has a number of formatters available with the {@link Format} class
	 * which can be used directly with this method.
	 *  @param function|string $_ Value to set if using as a setter. Can be given as
	 *    a closure function or a string with a reference to a function that will
	 *    be called with call_user_func().
	 *  @param mixed $opts Variable that is passed through to the get formatting
	 *    function - can be useful for passing through extra information such as
	 *    date formatting string, or a required flag. The actual options available
	 *    depend upon the formatter used.
	 *  @return function|string|self The set formatter if no parameter is given, or 
	 *    self if used as a setter.
	 */
	public function setFormatter ( $_=null, $opts=null )
	{
		if ( $opts !== null ) {
			$this->_setFormatterOpts = $opts;
		}
		return $this->_getSet( $this->_setFormatter, $_ );
	}


	/**
	 * Get / set the 'validator' of the field.
	 *
	 * The validator can be used to check if any abstract piece of data is valid
	 * or not according to the given rules of the validation function used.
	 * Editor has a number of validation available with the {@link Validate} class
	 * which can be used directly with this method.
	 *  @param function|string $_ Value to set if using as the validation method. 
	 *    Can be given as a closure function or a string with a reference to a 
	 *    function that will be called with call_user_func().
	 *  @param mixed $opts Variable that is passed through to the validation
	 *    function - can be useful for passing through extra information such as
	 *    date formatting string, or a required flag. The actual options available
	 *    depend upon the validation function used.
	 *  @return function|string|self The validation method if no parameter is given, 
	 *    or self if used as a setter.
	 */
	public function validator ( $_=null, $opts=null )
	{
		if ( $opts !== null ) {
			$this->_validatorOpts = $opts;
		}
		return $this->_getSet( $this->_validator, $_ );
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Public methods
	 */

	/**
	 * Check to see if a field should be used for a particular action (get or set).
	 *
	 * Called by the Editor / Join class instances - not expected for general
	 * consumption - internal.
	 *  @param string $direction Direction that the data is travelling  - 'get' is
	 *    reading data, and 'set' is writing it to the DB.
	 *  @param array $data Data submitted from the client-side when setting.
	 *  @return boolean true if the field should be used in the get / set.
	 *  @internal
	 */
	public function apply ( $direction, $data=null )
	{
		if ( $direction === 'get' ) {
			// Get action - can we get this field
			return $this->_get;
		}
		else {
			// Note that validation must be done on input data before we get here
			// Set action - can we set this field
			if ( ! $this->_set ) {
				return false;
			}

			// Not required, and not given, so don't include
			if ( !isset( $data[$this->_name] ) ) {
				return false;
			}

			// Default is to include
			return true;
		}
	}


	/**
	 * Get the value of the field, taking into account if it is coming from the
	 * DB or from a POST. If formatting has been specified for this field, it
	 * will be applied here.
	 *
	 * Called by the Editor / Join class instances - not expected for general
	 * consumption - internal.
	 *  @param string $direction Direction that the data is travelling  - 'get' is
	 *    reading data, and 'set' is writing it to the DB.
	 *  @param array $data Data submitted from the client-side when setting or the
	 *    data for the row when getting data from the DB.
	 *  @return string Value for the field
	 *  @internal
	 */
	public function val ( $direction, $data )
	{
		if ( $direction === 'get' ) {
			// Three cases for the getFormatter - closure, string or null
			if ( $this->_getFormatter ) {
				if ( is_string( $this->_getFormatter ) ) {
					// Don't require the Editor namespace if DataTables validator is given as a string
					if ( strpos($this->_getFormatter, "Format::") === 0 ) {
						return call_user_func( "\\DataTables\\Editor\\".$this->_getFormatter, $data[ $this->_dbField ], $data, $this->_getFormatterOpts );
					}
					return call_user_func( $this->_getFormatter, $data[ $this->_dbField ], $data, $this->_getFormatterOpts );
				}
				$getFormatter = $this->_getFormatter;
				return $getFormatter( $data[ $this->_dbField ], $data, $this->_getFormatterOpts );
			}
			return $data[ $this->_dbField ];
		}
		else {
			// Three cases for the setFormatter - closure, string or null
			if ( $this->_setFormatter ) {
				if ( is_string( $this->_setFormatter ) ) {
					// Don't require the Editor namespace if DataTables validator is given as a string
					if ( strpos($this->_setFormatter, "Format::") === 0 ) {
						return call_user_func( "\\DataTables\\Editor\\".$this->_setFormatter, $data[ $this->_dbField ], $data, $this->_setFormatterOpts );
					}
					return call_user_func( $this->_setFormatter, $data[ $this->_dbField ], $data, $this->_setFormatterOpts );
				}
				$setFormatter = $this->_setFormatter;
				return $setFormatter( $data[ $this->_dbField ], $data, $this->_setFormatterOpts );
			}
			return $data[ $this->_name ];
		}
	}


	/**
	 * Check the validity of the field based on the data submitted.
	 *
	 * Called by the Editor / Join class instances - not expected for general
	 * consumption - internal.
	 *  @param array $data Data submitted from the client-side 
	 *  @return boolean Indicate if a field is valid or not.
	 *  @internal
	 */
	public function validate ( $data )
	{
		// Three cases for the validator - closure, string or null
		if ( ! $this->_validator ) {
			return true;
		}

		$val = isset($data[ $this->_name ]) ? $data[ $this->_name ] : null;

		if ( is_string( $this->_validator ) ) {
			// Don't require the Editor namespace if DataTables validator is given as a string
			if ( strpos($this->_validator, "Validate::") === 0 ) {
				return call_user_func( "\\DataTables\\Editor\\".$this->_validator, $val, $data, $this->_validatorOpts );
			}
			return call_user_func( $this->_validator, $val, $data, $this->_validatorOpts );
		}
		$validator = $this->_validator;
		return $validator( $val, $data, $this );
	}
}

