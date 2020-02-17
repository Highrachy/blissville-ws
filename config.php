<?php
if (!session_start())
session_start();
# ******************** #
# ***** SETTINGS ***** #

// Errors are emailed here.
$contact_email = 'harunpopson@gmail.com';

//Default TimeZone
date_default_timezone_set('Africa/Lagos');


// Determine whether we're working on a local server
// or on the real server:
if (stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')) {
	$local = $debug = TRUE;
	$configs = include('inc/local.config.php');
} else {
	$local = $debug = FALSE;
	$configs = include('inc/main.config.php');
}

// Define the constants:
define('SITE_NAME','Blissville');

define ('DB_HOST', $configs['host']);
define ('DB_USER', $configs['username']);
define ('DB_PASSWORD', $configs['password']);
define ('DB_NAME', $configs['db']);
define ('BASE_WWW',	$configs['base_www']);
define ('BASE_URL',	$configs['base_www']);
define ('GMAP_API', $configs['gmap_api']);

define ('IMAGE_URL',	'assets/img/');
define ('BASE_IMAGE_URL',	BASE_URL.IMAGE_URL);


//payment pages
// define ('NORMAL_PAYMENT',	'https://paystack.com/pay/J93LvVdL6B');
// define ('FOUR_BEDROOM_PAYMENT',	'https://paystack.com/pay/J93LvVdL6B');
// define ('FIVE_BEDROOM_PAYMENT',	'https://paystack.com/pay/J93LvVdL6B');


//Remove when you are through
$debug = TRUE;



// $path = $_SERVER['DOCUMENT_ROOT'];
// $path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
$server_dir = realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
define('SERVER_DIR',$server_dir);

define('INCLUDE_DIR',SERVER_DIR.'inc/');
define('CLASS_DIR',INCLUDE_DIR.'class/');

define('UPLOAD_PATH','assets/uploads/');

define('UPLOAD_DIR',SERVER_DIR.UPLOAD_PATH);
define('UPLOAD_URL',BASE_URL.UPLOAD_PATH);


//Class Autoloader
function my_autoloader($className) {
    $className = strtolower($className);
    $path = CLASS_DIR."{$className}.class.php";

    if (file_exists($path)) {

        require_once($path);

    } else {

        die("The file {$className}.php could not be found.");

    }
}

spl_autoload_register('my_autoloader');

$db = new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


// if the no_fuctions is defined
// if (!isset($no_config_functions)){
//     @require_once('inc/functions.php');
// }
//
# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler.
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

    global $debug, $contact_email;

    // Build the error message.
    $message = "An error occurred in script '$e_file' on line $e_line: \n<br />$e_message\n<br />";

    // Add the date and time.
    $message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";

    // Append $e_vars to the $message.
    $message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";

    if ($debug) { // Show the error.

        echo '<p class="error">' . $message . '</p>';

    } else {

        // Log the error:
        error_log ($message, 1, $contact_email); // Send email.

        // Only print an error message if the error isn't a notice or strict.
        if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
            echo '<p class="error">A system error occurred. We apologize for the inconvenience.</p>';
        }

    } // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

# ***** ERROR MANAGEMENT ***** #
# **************************** #
