<?php
/**
 * PHP grocery CRUD
 *
 * LICENSE
 *
 * This source file is subject to the GPL license that is bundled
 * with this package in the file licence.txt.
 *
 * @package    	grocery CRUD
 * @copyright  	Copyright (c) 2010 through 2011, John Skoumbourdis
 * @license    	http://www.gnu.org/licenses/gpl.html GNU GPL v3
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 */

// ------------------------------------------------------------------------

/**
 * PHP grocery Exceptions
 *
 * Log and Show the Exceptions of grocery CRUD
 *
 * @package    	grocery CRUD
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 * @version    	1.0.0
 */
class grocery_Exceptions
{
	private $errors = array(
		0  => 'An unexpected error has occured.',
		1  => 'You have already insert a table name once...',
		2  => 'The table name cannot be empty.',
		3  => 'The config file must be an array.',
		4  => 'The state is unknown , I don\'t know what I will do with your data!',
		5	 => 'This variable must be boolean.',
		6  => 'On the state "edit" the Primary key cannot be null',
		7  => 'On the state "delete" the Primary key cannot be null',
		8  => 'On the state "insert" you must have post data',
		9  => 'On the state "update" you must have post data',
		10 => 'On the state "update" the Primary key cannot be null',
		11 => 'The table name does not exist. Please check you database and try again.',
		12 => 'The template does not exist. Please check your files and try again.',
		13 => 'It is impossible to get data. Please check your model and try again.',
		14 => 'This user is not allowed to do this operation'
	);
	
	/**
	 * 
	 * Log the error and print it
	 * @param string $code
	 * @return void
	 */
	public function show_error($error_message = null, $trace = null)
	{
		if($trace !== null)
			$error_message .= " :: \n".$trace; 
		
		log_message('error', $error_message);
		show_error( $error_message );
	}	
}