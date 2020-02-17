<?php

class URL{

  public static function display($url=""){
  	echo BASE_URL.$url;
  	return;
  } // End of get_url function

  public static function href($url=""){
  	return BASE_URL.$url;
  } // End of get_url function

  public static function current_page() {
  	 $page_url = 'http';
  	 if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")) {$page_url .= "s";}
  	 $page_url .= "://";
  	 if ($_SERVER["SERVER_PORT"] != "80") {
  	  $page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  	 } else {
  	  $page_url .= $_SERVER["SERVER_NAME"];

  	  $page_url .= $_SERVER["REQUEST_URI"];
      
  	 }
  	 return $page_url;
  }

  public static function redirect($destination = 'login.php?action=no-access') {
  		$url = BASE_URL . $destination; // Define the URL.
  		header("Location: $url");
  		exit(); // Quit the script.
  } // End of redirect function


  public static function get($name,$default=""){
    if (isset($_GET[$name]) && (!empty($_GET[$name])))
      return $_GET[$name];
    else return $default;
  }

  public static function readable($name){
    $name = trim($name);
    return strtolower(str_replace(' ', '-',Text::truncate(preg_replace('/[^0-9a-z\s-]/i',"",$name),80,0,'')));
  }
}
