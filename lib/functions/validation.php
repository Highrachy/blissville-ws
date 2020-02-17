<?php

function exists($name,$method="POST"){

	$form_variables = form_method($method);
	//Get the submitted form
	if(isset($form_variables[$name]) && $form_variables[$name] != ""){
		return true;
	}

	return false;

}

function is_required($field_name){
	#check if a field is required
	if (!isset($field_name) || $field_name == "")
		return false;
	else return true;
	
}

function is_valid_email($email){
	#checks if an email is valid.
	if (PHP_VERSION >= 5.2)
  	return filter_var($email, FILTER_VALIDATE_EMAIL);
	else return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i', $email);
}

function is_number($value){
		#Check if the value is a valid number
        return is_numeric($value);	
}

function is_alphanum($string)
{
	#return if it is an alphabet or number
    return ctype_alnum ($string);
}


function is_valid_username($username,$length="6-50"){
	//if dash is present in the length
	if (strpos($length,'-') !== false){
		list($start, $end) = explode("-", $length);
		if (!is_number($start)) $start = 6;
		if (!is_number($end)) $end = 50;
} else {
	//if dash is not present, assign the end as 250
	if (!is_number($length)) $start = 6;
		else $start= $length;
	$end=250;
}
        #alphabet, digit, @, _ and . are allow. Minimum 6 character. Maximum 50 characters (email address may be more)
        return preg_match('/^[a-zA-Z\d_@.]{'.$start.','.$end.'}$/i', $username);
}



function strong_password($password){
        #must contain 8 characters, 1 uppercase, 1 lowercase and 1 number
        return preg_match('/^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/', $password);
}

function same($pass1,$pass2){		
		#compares two values together
		 if ($pass1 != $pass2) return false; else return true;
}

function minimum_length($name,$length=1){
		#if the length is not a number, or less than 1 assume that the length is 1
		if ((!is_numeric($length)) or ($length < 1)) $length = 1;
		
		#Do the comparison
		if (strlen($name) < $length) return false;
		else return true;
}

function maximum_length($name,$length=1){
		#if the length is not a number, or less than 1 assume that the length is 1
		if ((!is_numeric($length)) or ($length < 1)) $length = 1;
		
		#Do the comparison
		if (strlen($name) > $length) return false;
		else return true;
}

function check_range($name,$length="0-10"){
		#List the value returned from the array into $start and end
		list($start, $end) = explode("-", $length);
		if (!is_number($start)) $start = 0;
		if (!is_number($end)) $start = 10;
              if (strlen($name) < $start || strlen($name) > $end)	
			  return false;
			  else return true;
}

function is_valid_image($picture){
			if (!((preg_match('/^image\/p?jpeg$/i', $_FILES[$picture]['type']) or
			preg_match('/^image\/gif$/i', $_FILES[$picture]['type']) or
			preg_match('/^image\/(x-)?png$/i', $_FILES[$picture]['type']))))
			return false; else return true;
}

function is_valid_file($file){
	if ((!isset($_FILES[$file])) || !(is_file($_FILES[$file]['tmp_name'])))
	return false; else return true;
		
}
function form_method($method="POST"){
	#compare the source of submission
	#if(strcmp($_SERVER['REQUEST_METHOD'],'POST')==0)
	#	return $_POST;
	#else return $_GET;
	
	if ($method != "POST") return $_GET;
	else return $_POST;
	
}
function validate($name,$command,$method="POST"){
	
	global $errors;
	$length = "";
	#if = is in the command, assign it into the command and length
	if (strpos($command,"=") !==  false){
		list($command, $length) = explode("=", $command);	
	}
	
	$form_variables = form_method($method);
	//Get the submitted form
	if(isset($form_variables[$name])){
	
		#Check if to use $_POST OR $_GET
		if ($command == 'image')
			$input_value = $name;
	    else $input_value = $form_variables[$name];
		 
		
		#Assume the $result returned is true
		$result=true;
		switch($command)
		{
			case 'req':
						{
							$result = is_required($input_value);
							break;
						}

			case 'email':
						{
							$result = is_valid_email($input_value);
							break;
						}
			case 'num':
						{
							$result = is_number($input_value);
							break;
						}

			case 'alphanum':
						{
							$result = is_alphanum($input_value);
							break;
						}
			case 'username':
						{
							$result = is_valid_username($input_value,$length);
							break;
						}

			case 'password':
						{
							$result = strong_password($input_value);
							break;
						}
						
			case 'same':
						{
							$result = same($input_value,$form_variables[$length]);
							break;
						}			
			case 'minlen':
						{
							$result = minimum_length($input_value,$length);
							break;
						}
						
			case 'maxlen':
						{
							$result = maximum_length($input_value,$length);
							break;
						}
						
			case 'range':
						{
							$result = check_range($input_value,$length);
							break;
						}
						
			case 'image':
						{
							$result = is_valid_image($input_value);
							break;
						}
			
			case 'upload':
						{
							$result = is_valid_file($input_value);
							break;
						}
			default: $result = false;
		 
		}//switch
		return $result;
	} 
}

function assign($name,$command="",$error="",$method="POST"){
	
	global $errors;
	if ($command == "") $command = $name;
	if ($error == "") $error = "Please enter a valid ".ucfirst($name);
	if (validate($name,$command,$method)){ #if the Validation is correct
		#get the form method
		$form_variables = form_method($method);
		
		return $form_variables[$name];
	} else { #if the validation fails
			$errors[$name] = $error;
	}
	
}

function sanitize_number($str)
{
        #letters and space only
        return preg_match('/[^0-9]/', '', $str);
}

function sanitize_email($email){
	#removes illegal characters from the email
	if (PHP_VERSION >= 5.2)
	return filter_var($email, FILTER_SANITIZE_EMAIL);
	else return  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $email);
}

function sanitize_alphanum($string)
{
		#“HELLO! Do we have 90 idiots running around here?” => “HELLO Do we have 90 idiots running around here”
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
}

function show_errors($name,$help_text="",$error_class="error",$help_class="help-block"){
	global $errors;
	if (isset($errors[$name])){
		echo '<div class="'.$error_class.'">'.$errors[$name].'</div>';
	} else {
		if (!empty($help_text))
		echo '<div class="'.$help_class.'">'.$help_text.'</div>';
	}
}


	# - All Functions
		# 1.   is_required($field_name)
		# 2.   is_valid_email($email)
		# 3.   is_number($value)
		# 4.   is_alphanum($string)
		# 5.   is_valid_username($username,$length="6-50")
		# 6.   strong_password($password)
		# 7.   same($pass1,$pass2)
		# 8.   minimum_length($name,$length=1)
		# 9.   maximum_length($name,$length=1)
		# 10.  check_range($name,$length="0-10")
		# 11.  is_valid_image($picture)
		# 12.  is_valid_file($file)
	
	# - validate($name,$command)
	# - command
		# 1.  req        -  is_required($field_name)
		# 2.  email      -  is_valid_email($email)
		# 3.  num        -  is_number($value)
		# 4.  alphanum   -  is_alphanum($string)
		# 5.  username   -  is_valid_username($username,$length="6-50")
		# 6.  password   -  strong_password($password)
		# 7.  same       -  same($pass1,$pass2)
		# 8.  minlen     -  minimum_length($name,$length=1)
		# 9.  maxlen     -  maximum_length($name,$length=1)
		# 10. range      -  check_range($name,$length="0-10")
		# 11. image      -  is_valid_image($picture)
		# 12. file       -  is_valid_file($file)
	
	
	//$data['name'] = assign('name','num','Invalid Number',"get");
	//$data['email'] = "";
	
	
	// echo "Your name is ".$data['name']." and Your email is ".$data['email'];
	//echo "<br><br>The error is ".$errors[0];

function whole_number($value){
	if (PHP_VERSION >= 5.2)
		return filter_var($value, FILTER_VALIDATE_INT);
	else return is_int($value);

}

function decimal_number($value){
	if (PHP_VERSION >= 5.2)
		return filter_var($value, FILTER_VALIDATE_FLOAT);
	else return is_float($value);

}


function email_exist($email){
        $email_error = false;
        $Email = htmlspecialchars(stripslashes(strip_tags(trim($email))));
        if ($Email == '') { $email_error = true; }
        elseif (!eregi('^([a-zA-Z0-9._-])+@([a-zA-Z0-9._-])+\.([a-zA-Z0-9._-])([a-zA-Z0-9._-])+', $Email)) {
			 $email_error = true; }
        else {
        list($Email, $domain) = split('@', $Email, 2);
                if (!checkdnsrr($domain, 'MX')) { $email_error = true; }
                else {
                $array = array($Email, $domain);
                $Email = implode('@', $array);
                }
        }

        if ($email_error) { return false; } else{return true;}
}



function is_valid_colour($color){
        #CCC
        #CCCCC
        #FFFFF
        return preg_match('/^#(?:(?:[a-f0-9]{3}){1,2})$/i', $color);
}

function is_valid_ip($ip)
{
	if (PHP_VERSION >= 5.2)
	  return filter_var($ip, FILTER_VALIDATE_IP);
	  else return preg_match('/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',$ip);
}

function is_valid_url($url)
{
  return filter_var($url, FILTER_VALIDATE_URL);
}

function url_exist($url)
{
		$url = @parse_url($url);

		if (!$url)
		{
				return false;
		}

		$url = array_map('trim', $url);
		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
		$path = (isset($url['path'])) ? $url['path'] : '';

		if ($path == '')
		{
				$path = '/';
		}

		$path .= (isset($url['query'])) ? '?$url[query]' : '';

		if (isset($url['host']) AND $url['host'] != @gethostbyname($url['host']))
		{
				if (PHP_VERSION >= 5)
				{
						$headers = @get_headers('$url[scheme]://$url[host]:$url[port]$path');
				}
				else
				{
						$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);

						if (!$fp)
						{
								return false;
						}
						fputs($fp, 'HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n');
						$headers = fread($fp, 4096);
						fclose($fp);
				}
				$headers = (is_array($headers)) ? implode('\n', $headers) : $headers;
				return (bool)preg_match('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
		}
		return false;
}


?>

