<?php
# ***** SETTINGS ***** #
# ******************** #

/* 
 *	Most important setting...
 *	The $debug variable is used to set error management.
 *	To debug a specific page, add this to the index.php page:
 *	To debug the entire site, do

$debug = TRUE;

 *	before this next conditional.
 */

// Assume debugging is off.
//$debug = TRUE; //Remove this when you are through


if (!isset($debug)) {
	$debug = FALSE;
}


//Check if it is an ordinary page 
if (isset($dashboard)){
	redirect_invalid_admin();
}

# ****** LIST OF CLASSES PRESENT **********#
# *****************************************#
# 1. get_url($url) - Get the full url in http
# 2. redirect($destination) - Redirects to a destination
# 3. redirect_invalid_admin() - Redirects a user not logged
# 4. display_alert()
# 5. get_action()
# 5. get_status()

function debug($variable){
	return var_dump($variable);
}

function get_url($url=""){
	echo BASE_URL.$url;
	return;
} // End of get_url function
function get_image($url){
	echo BASE_IMAGE_URL.$url;
	return;
} // End of get_url function

function get_href($url){
	return BASE_URL.$url;
} // End of get_url function

function redirect($destination = 'login.php?err=2') {
		$url = BASE_URL . $destination; // Define the URL.
		header("Location: $url");
		exit(); // Quit the script.
} // End of redirect fucntion

function redirect_invalid_admin() {	
	// Check if the person is not the admin
	
	$destination = 'admin/?err=1';
	$current_page_URL =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
	$current_page_URL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	//check if the $_SESSION client_type is set
	if (!((isset($_SESSION['name'])) && ($_SESSION['name'] != ""))){
		$url =  BASE_URL.$destination.'&continue='.$current_page_URL; // Define the URL.
		header("Location: $url");
		exit(); // Quit the script.
	}
	
} // End of redirect_invalid_admin() function.

function is_valid_admin(){
	if (!((isset($_SESSION['name'])) && ($_SESSION['name'] != "")))
		return true;
	else return false;

}

function get_number($number){
	return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
}

function get_letters($letters){
	return preg_replace("/[^a-zA-Z]+/", "", $letters);
}
// ************ REDIRECTION ************ //
// ****************************************** //


function display_alert($all_error = false){

	global $success, $info, $warning,$errors, $error;
	 
	 //Errors All has the highest priority
	if ($all_error){
	 	if (!empty($errors)){
	 		$error = "";
	 		foreach($errors as $value){
				$error .= "<p> - $value</p>";
			}
			echo	'<div class="alert alert-danger alert-dismissable">
	  					<strong>Errors!</strong><br>'.$error.'</div>';
  			return;		

	 	}
		
  	}

  	if (isset($error))
  		$errors['error'] = $error;


	if ((isset($errors['error'])) && (!empty($errors['error']))){

		echo	'<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-remove"></i> '. $errors['error'] . '	
				</div> ';
	} else if ((isset($warning)) && (!empty($warning))){

		echo	'<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-warning"></i> '. $warning. '	
				</div> ';
	} else if ((isset($info)) && (!empty($info))){

		echo	'<div class="alert alert-info alert-dismissable">
					<i class="fa fa-info-circle"></i> '. $info . '	
				</div> ';
	} else if ((isset($success)) && (!empty($success))){

		echo	'<div class="alert alert-success alert-dismissable">
					<i class="fa fa-check-circle"></i> '. $success . '	
				</div> ';
	} 
}

function get_action($action = "",$message){
	global $success, $info, $warning, $error;
	if (isset($action)){
		if ($action == 'add') $success = "Your $message has been successfully added";
		else if ($action == 'update') $success = "Your $message has been successfully updated";
		else if ($action == 'delete') $info = "Your $message has been successfully deleted";
		else if ($action == 'error') $error = "Invalid request";
		else if ($action == 'pause') $info = "Your $message has been successfully paused";
		else if ($action == 'resume') $info = "Your $message has been successfully resumed";
		else if ($action == 'invalid') $warning = "The selected $message is invalid";
		else if ($action == 'not-found') $warning = "The $message cannot be found in the database";
		else if ($action == 'high-priority') $warning = "Your priority cannot be greater than 10";
		else if ($action == 'less-priority') $warning = "Your priority cannot be lesser than 0";
	}
}

function get_active_menu($page_name="home", $word = "active",$no_class=true){
	global $title;

	if ($title == $page_name){
        if ($no_class)
		  echo 'class = "'.$word.'"';
        else
            echo $word;
	}

}

function get_plural($number,$singular,$plural="",$zero=""){

    //return for value for 1
    if ($number == 1){
        return $number.' '.$singular;
    }

    // return the value for 0
    if (!empty($zero) && ($number == 0))
        return $zero;

    // Try to generate the plural
    $last_letter = strtolower($singular[strlen($singular)-1]);
    switch($last_letter) {
        // case 'y':
        //     return $number.' '.substr($singular,0,-1).'ies';
        case 's':
            return $number.' '.$singular.'es';
        default:
            return $number.' '.$singular.'s';

    }
    return $number.' '.$plural;
}

function get_only_plural($number,$singular,$plural="",$zero=""){

	//return for value for 1
	if ($number == 1){
		return $singular;
	}

	// return the value for 0
	if (!empty($zero) && ($number == 0))
		return $zero;

	// Try to generate the plural
	$last_letter = strtolower($singular[strlen($singular)-1]);
    switch($last_letter) {
        // case 'y':
        //     return substr($singular,0,-1).'ies';
        case 's':
            return $singular.'es';
        default:
            return $singular.'s';

    }
	return $plural;
}


#-############################################
# TRUNCATE FUNCTIONS
#-############################################

function truncate($string, $limit, $break=".", $pad="...")
{

	// Usage:
	// 1. The default action is to break on the first "." after $limit characters and then pad with "...".
	// 2. Truncate at word breaks - $shortdesc = myTruncate($description, 300, " ");

	// 3. Truncate at maximum length
	// Original PHP code by Chirp Internet: www.chirp.com.au
	
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;

}
// Please acknowledge use of this code by including this header.

function myTruncate2($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  $string = substr($string, 0, $limit);
  if(false !== ($breakpoint = strrpos($string, $break))) {
    $string = substr($string, 0, $breakpoint);
  }

  return $string . $pad;
}


function truncateWords($input, $numwords, $padding="")
  {
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;

    //usage
     // $shortdesc = truncateWords($description, 10, "...");
  // echo "<p>$shortdesc</p>";
  }


  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  
#-############################################
# END TRUNCATE FUNCTIONS
#-############################################

function format_header($header,$first_words=1){
    $header_array = explode(" ",$header);

    $output = "";
    $count = 1;

    foreach ($header_array as $key => $value) {

        if ($count == 1)
            $output = "<span>";

        $output .= " ".$value;

        if ($count == $first_words)
            $output .= "</span>";

        $count++;

    }

    return $output;
}

function get_breadcrumbs($array="",$base_url){
      // Include the home page
    $pages = array_merge(array('Blissville Condos' => ''),$array);
        
        $count = 0;
        $breadcrumb = "";
        
    foreach($pages as $title => $link){

      $count++;
      //Replace the last link with #
      if($count == count($pages)){
          $breadcrumb.= '<li class="active">'.$title.'</li>';  
      } else {
      // Generate the Breadcrumb
          $breadcrumb.= '<li><a title="Go to '.$title.'" href="'.$base_url.$link.'">'.$title.'</a></li>';   
      }

    }

    return $breadcrumb;
}

function get_active_tab($name_of_tab, $current_active_tab,$class_name = 'active'){
	if ($name_of_tab == $current_active_tab)
		echo  $class_name;
	return;
}

function highlight_search_term($word,$term = ""){
	global $search_term;



	if (empty($term))
		$term = $search_term;

	return preg_replace("/($term)/i",'<span class="text-danger">$1</span>', $word);

	
	// return str_replace($term, "<span class='text-danger'>$term</span>", $word);
	// return preg_replace("/$term/i","<b>$term</b>",$word);
}



function convert_to_php_date($sql_date){//formats date from mysql
	if (empty($sql_date)) return;
	$phpdate = strtotime($sql_date);
	// $formattedphpdate = date('m/d/Y', $phpdate );
	$formattedphpdate = date('F, d Y', $phpdate);
	return $formattedphpdate;

}

function formatted_date($sql_date){//formats date from mysql
	if (empty($sql_date)) return;
	$phpdate = strtotime($sql_date);
	$formattedphpdate = date('M. j, Y (D)', $phpdate);
	return $formattedphpdate;

}

function formatted_time($sql_date){//formats date from mysql
	if (empty($sql_date)) return;
	$phpdate = strtotime($sql_date);
	$formattedphpdate = date('h:i a', $phpdate );
	return $formattedphpdate;

}

function get_timeago( $ptime ){
    $estimated_time = time() - $ptime;

    if( $estimated_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimated_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function get_readable_url($name){
	$name = trim($name);
 return strtolower(str_replace(' ', '-',truncate(preg_replace('/[^0-9a-z\s-]/i',"",$name),80,0,'')));
}



function reverse_sort_order($sort_order = 'ASC', $sorted_item="",$default= 'ASC'){
  global $sort;

  if ($sort == $sorted_item){ //reverse only if it is the current sorted_item
    if (strtoupper($sort_order) == 'DESC')
      $sort_order = 'ASC';
    else $sort_order = 'DESC';
  }
  else {
    $sort_order = $default;
  }
  return strtolower($sort_order);
}

function get_sort_icon($sort_order = 'ASC',$sorted_item){
  global $sort; //sort contains the name of the item being sorted
  if ($sort == $sorted_item){
    if (strtoupper($sort_order) == 'DESC')
      $sort_icon = '<i class="fa fa-caret-down"></i>';
    else $sort_icon = '<i class="fa fa-caret-up"></i>';

    return $sort_icon;
  }
  

}

//used to get the present page url
function get_page_url($get_uri = true) {
	 $pageURL = 'http';
	 if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"];
	  if ($get_uri){
	  	$pageURL .= $_SERVER["REQUEST_URI"];
	  }
	 }
	 return $pageURL;
}


  
#-############################################
# NUMBER FUNCTIONS
#-############################################

function get_price($price){
	return number_format($price);
}

function get_in_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';

    
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}


function get_number_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $negative    = 'negative ';
    $separator   = ', ';


    $dictionary  = array(
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return false;
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 1000:
            $string = $number;
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = $number / $baseUnit; // base like 40 in 40 million
            $remainder = $number % $baseUnit;
            $string = $numBaseUnits . ' ' . $dictionary[$baseUnit];
            // if ($remainder) {
            //     $string .= $remainder < 100 ? $conjunction : $separator;
            //     $string .= convert_number_and_words($remainder);
            // }
            break;
    }
    
    return ucwords($string);
}

  
#-############################################
# END NUMBER FUNCTIONS
#-############################################


?>
