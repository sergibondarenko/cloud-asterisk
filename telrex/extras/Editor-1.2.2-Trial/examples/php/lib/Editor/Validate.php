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


/**
 * Validation methods for the DataTables Editor.
 *
 * These methods will typically be applied through the {@link Field::validator}
 * method and thus the arguments to be passed will be automatically resolved
 * by Editor.
 *
 * Note that for ***required*** parameters you can add *_required* to the end of
 * of the validation name, in order to automatically applied the *required*
 * method.
 *
 *  @example
 *    <code>
 *      // Ensure that a value is given for a field
 *      Field::inst( 'engine' )->validator( 'Validate::required' )
 *    </code>
 *
 *  @example
 *    <code>
 *      // Validation with options
 *      Field::inst( 'reg_date' )->validator( 'Validate::date_format', 'D, d M y' )
 *    </code>
 *
 *  @example
 *    <code>
 *      // Required e-mail address
 *      Field::inst( 'reg_date' )->validator( 'Validate::email_required' )
 *    </code>
 *
 *  @example
 *    <code>
 *      // Custom validation - closure
 *      Field::inst( 'engine' )->validator( function($val, $data, $opts) {
 *         if ( ! preg_match( '/^1/', $val ) ) {
 *           return "Value <b>must</b> start with a 1";
 *         }
 *         return true;
 *      } )
 *    </code>
 */
class Validate {
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Magic methods
	 */

	/**
	 * "Magic" method to automatically apply the required check to any of the static
	 * methods simply by adding '_required' to the end of the method's name.
	 *  @internal
	 */
	public static function __callStatic( $name, $arguments ) {
		if ( preg_match( '/_required$/', $name ) ) {
			$req = Validate::required( $arguments[0], $arguments[1], $arguments[2] );
			if ( $req !== true ) {
				return $req;
			}

			return call_user_func_array( 
				__NAMESPACE__.'\Validate::'.str_replace( '_required', '', $name ),
				$arguments
			);
		}
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Basic validation
	 */

	/**
	 * No validation - all inputs are valid.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return true
	 */
	public static function none( $val, $data, $opts ) {
		return true;
	}


	/**
	 * Required field - there must be a value.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	static function required( $val, $data, $opts ) {
		if ( $val == "" ) {
			return "This field is required";
		}
		return true;
	}


	/**
	 * Boolean value.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function boolean( $val, $data, $opts ) {
		// If empty string is given, check if required - default false
		if ( filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === false ) {
			return "Please enter true or false";
		}
		return true;
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Number validation methods
	 */

	/**
	 * Check that any input is numeric.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function numeric ( $val, $data, $opts ) {
		if ( ! is_numeric( $val ) ) {
			return "This input must be given as a number";
		}
		return true;
	}

	/**
	 * Check for a numeric input and that it is greater than a given value.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array|int $opts If given as an integer, then this is the min value
	 *    that is allowed for the input. If given as an array, then the parameter
	 *    'min' is used from the array for the minimum value.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function minNum ( $val, $data, $opts ) {
		$numeric = DTValidate::numeric( $val, $data, $opts );
		if ( $numeric !== true ) {
			return $numeric;
		}

		$min = is_array($opts) ? $opts['min'] : $opts;
		if ( $val < $min ) {
			return "Number is too small, must be ".$min." or larger";
		}
		return true;
	}

	/**
	 * Check for a numeric input and that it is less than a given value.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array|int $opts If given as an integer, then this is the max value
	 *    that is allowed for the input. If given as an array, then the parameter
	 *    'max' is used from the array for the maximum value.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function maxNum ( $val, $data, $opts ) {
		$numeric = DTValidate::numeric( $val, $data, $opts );
		if ( $numeric !== true ) {
			return $numeric;
		}

		$max = is_array($opts) ? $opts['max'] : $opts;
		if ( $val > $max ) {
			return "Number is too large, must be ".$max." or smaller";
		}
		return true;
	}

	/**
	 * Check for a numeric input and it is both greater and smaller than given 
	 * numbers.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array $opts The properties 'min' and 'max' are used from the array
	 *    as the minimum and maximum allowed values of the number, respectively.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function minMaxNum ( $val, $data, $opts ) {
		$numeric = DTValidate::numeric( $val, $data, $opts );
		if ( $numeric !== true ) {
			return $numeric;
		}

		$min = DTValidate::minNum( $val, $data, $opts );
		if ( $min !== true ) {
			return $min;
		}

		return DTValidate::maxNum( $val, $data, $opts );
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * String validation methods
	 */

	/**
	 * E-mail address.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function email( $val, $data, $opts ) {
		if ( filter_var($val, FILTER_VALIDATE_EMAIL) === false ) {
			return "Please enter a valid e-mail address";
		}
		return true;
	}


	/**
	 * Min length of a string.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array|int $opts If given as an integer, then this is the min length
	 *    that is allowed for the value. If given as an array, then the parameter
	 *    'min' is used from the array for the minimum length.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function minLen( $val, $data, $opts ) {
		$min = is_array($opts) ? $opts['min'] : $opts;

		if ( strlen( $val ) < $min ) {
			return "The input is too short. ".$min." characters required (".($min-strlen($val))." more to go)";
		}
		return true;
	}

	/**
	 * Max length of a string.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array|int $opts If given as an integer, then this is the max length
	 *    that is allowed for the value. If given as an array, then the parameter
	 *    'max' is used from the array for the minimum length.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function maxLen( $val, $data, $opts ) {
		$max = is_array($opts) ? $opts['max'] : $opts;

		if ( strlen( $val ) > $max ) {
			return "The input is ".(strlen($val)-$max)." characters too long";
		}
		return true;
	}

	/**
	 * Require a string with a certain min or max of characters
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array $opts The properties 'min' and 'max' are used from the array
	 *    as the minimum and maximum allowed lengths of the string, respectively.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function minMaxLen( $val, $data, $opts ) {
		$min = DTValidate::minLen( $val, $data, $opts );
		if ( $min === true ) {
			return DTValidate::maxLen( $val, $data, $opts );
		}
		return $min;
	}


	/**
	 * IP address.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function ip( $val, $data, $opts ) {
		if ( filter_var($val, FILTER_VALIDATE_IP) === false ) {
			return "Please enter a valid IP address";
		}
		return true;
	}


	/**
	 * URL address.
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param null $opts No extra options available
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function url( $val, $data, $opts ) {
		if ( filter_var($val, FILTER_VALIDATE_URL) === false ) {
			return "Please enter a valid URL";
		}
		return true;
	}



	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Date validation methods
	 */

	/**
	 * Check that a valid date input is given
	 *  @param string $val The value to check for validity
	 *  @param string[] $data The full data set submitted
	 *  @param array|string $opts If given as a string, then $opts is the date
	 *    format to check the validity of. If given as an array, then the
	 *    date format is in the 'format' parameter, and the return error
	 *    message in the 'message' parameter.
	 *  @return string|true true if the value is valid, a string with an error
	 *    message otherwise.
	 */
	public static function dateFormat( $val, $data, $opts ) {
		$format = is_array($opts) ? $opts['format'] : $opts;

		$date = date_create_from_format($format, $val);
		if ( ! $date ) {
			return isset( $opt['message'] ) ?
				$opts['message'] :
				"Date is not in the expected format";
		}
		return true;
	}
}

