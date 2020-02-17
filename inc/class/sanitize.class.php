<?php

class Sanitize {
	public static function number($string)
	{
	        #numbers only
	        return preg_match('/[^0-9]/', '', $string);
	}

	public static function email($email){
		#removes illegal characters from the email
		if (PHP_VERSION >= 5.2)
		return filter_var($email, FILTER_SANITIZE_EMAIL);
		else return  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $email);
	}

	public static function alphabet($string)
	{
			#“HELLO! Do we have 90 idiots running around here?” => “HELLO Do we have 90 idiots running around here”
	        return preg_replace('/[^a-zA-Z]/', '', $string);
	}

	public static function alphanum($string)
	{
			#“HELLO! Do we have 90 idiots running around here?” => “HELLO Do we have 90 idiots running around here”
	        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
	}
}

// $string = '!**%figure 1987@yahoo.com';

// echo $string;
// echo "<br>".Sanitize::number($string);
// echo "<br>".Sanitize::alphabet($string);
// echo "<br>".Sanitize::alphanum($string);
// echo "<br>".Sanitize::email($string);